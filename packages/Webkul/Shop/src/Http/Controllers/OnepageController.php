<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Checkout\Facades\Cart;
use Webkul\Checkout\Http\Requests\CustomerAddressForm;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Payment\Facades\Payment;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Shop\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OnepageController extends Controller
{
    /**
     * Order repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;


    protected $invoiceRepository;

    /**
     * Customer repository instance.
     *
     * @var \Webkul\Customer\Repositories\CustomerRepository
     */
    protected $customerRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        InvoiceRepository $invoiceRepository
    ) {
        $this->orderRepository = $orderRepository;

        $this->customerRepository = $customerRepository;
        $this->invoiceRepository = $invoiceRepository;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Event::dispatch('checkout.load.index');

        if (!auth()->guard('customer')->check() && !core()->getConfigData('catalog.products.guest-checkout.allow-guest-checkout')) {
            return redirect()->route('customer.session.index');
        }

        if (auth()->guard('customer')->check() && auth()->guard('customer')->user()->is_suspended) {
            session()->flash('warning', trans('shop::app.checkout.cart.suspended-account-message'));

            return redirect()->route('shop.checkout.cart.index');
        }

        if (Cart::hasError()) {
            return redirect()->route('shop.checkout.cart.index');
        }

        $cart = Cart::getCart();

        if (
            (!auth()->guard('customer')->check() && $cart->hasDownloadableItems())
            || (!auth()->guard('customer')->check() && !$cart->hasGuestCheckoutItems())
        ) {
            return redirect()->route('customer.session.index');
        }

        $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        if (!$cart->checkMinimumOrder()) {
            session()->flash('warning', trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]));

            return redirect()->back();
        }

        Cart::collectTotals();

        return view($this->_config['view'], compact('cart'));
    }

    /**
     * Return order short summary.
     *
     * @return \Illuminate\Http\Response
     */
    public function summary()
    {
        $cart = Cart::getCart();

        return response()->json([
            'html' => view('shop::checkout.total.summary', compact('cart'))->render(),
        ]);
    }

    /**
     * Saves customer address.
     *
     * @param  \Webkul\Checkout\Http\Requests\CustomerAddressForm  $request
     * @return \Illuminate\Http\Response
     */
    public function saveAddress(CustomerAddressForm $request)
    {
        $data = $request->all();

        if (!auth()->guard('customer')->check() && !Cart::getCart()->hasGuestCheckoutItems()) {
            return response()->json(['redirect_url' => route('customer.session.index')], 403);
        }

        $data['billing']['address1'] = implode(PHP_EOL, array_filter($data['billing']['address1']));
        $data['shipping']['address1'] = implode(PHP_EOL, array_filter($data['shipping']['address1']));

        if (Cart::hasError() || !Cart::saveCustomerAddress($data)) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        $cart = Cart::getCart();

        Cart::collectTotals();

        if ($cart->haveStockableItems()) {
            if (!$rates = Shipping::collectRates()) {
                return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
            }

            return response()->json($rates);
        }

        return response()->json(Payment::getSupportedPaymentMethods());
    }

    /**
     * Saves shipping method.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveShipping()
    {
        $shippingMethod = request()->get('shipping_method');

        if (Cart::hasError() || !$shippingMethod || !Cart::saveShippingMethod($shippingMethod)) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        Cart::collectTotals();

        return response()->json(Payment::getSupportedPaymentMethods());
    }

    /**
     * Saves payment method.
     *
     * @return \Illuminate\Http\Response
     */
    public function savePayment()
    {
        $payment = request()->get('payment');

        if (Cart::hasError() || !$payment || !Cart::savePaymentMethod($payment)) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        Cart::collectTotals();

        $cart = Cart::getCart();

        return response()->json([
            'jump_to_section' => 'review',
            'html'            => view('shop::checkout.onepage.review', compact('cart'))->render(),
        ]);
    }

    /**
     * Saves order.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveOrder()
    {
        if (Cart::hasError()) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        Cart::collectTotals();

        $this->validateOrder();

        $cart = Cart::getCart();
        $products = DB::table('cart_items')->where('cart_id',$cart->id)->pluck('product_id');
        $vendor_ids = DB::table('products')->whereIn('id',$products)->pluck('user_id');
        
        if ($redirectUrl = Payment::getRedirectUrl($cart)) {
            return response()->json([
                'success'      => true,
                'redirect_url' => $redirectUrl,
            ]);
        }
        $step_data = Cart::prepareDataForOrder();
        $mul_ord_data = [];
        foreach ($vendor_ids as $key => $vid) {
            $mul_ord_data[$vid] = $step_data;
            $mul_ord_data[$vid]['total_item_count'] = 0;
            $mul_ord_data[$vid]['total_qty_ordered'] = 0;
            $mul_ord_data[$vid]['grand_total'] = 0 ;
            $mul_ord_data[$vid]['base_grand_total'] = 0;
            $mul_ord_data[$vid]['sub_total'] = 0;
            $mul_ord_data[$vid]['base_sub_total'] = 0;
            $mul_ord_data[$vid]['items'] = [];
            $mul_ord_data[$vid]['shipping_amount'] = 0;
            $mul_ord_data[$vid]['base_shipping_amount'] = 0;
            $mul_ord_data[$vid]['shipping_invoiced'] = 0;
            $mul_ord_data[$vid]['base_shipping_invoiced'] = 0;

            foreach ($step_data['items'] as $key => $sdi) {
                if($sdi['product']->user_id == $vid){

                    $mul_ord_data[$vid]['total_item_count'] = $mul_ord_data[$vid]['total_item_count'] + $sdi['qty_ordered'];

                    $mul_ord_data[$vid]['total_qty_ordered'] = $mul_ord_data[$vid]['total_qty_ordered'] + $sdi['qty_ordered'];

                    $mul_ord_data[$vid]['grand_total'] = $mul_ord_data[$vid]['grand_total'] + (float)$sdi['total'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);

                    $mul_ord_data[$vid]['base_grand_total'] = $mul_ord_data[$vid]['base_grand_total'] + (float)$sdi['total'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);

                    $mul_ord_data[$vid]['sub_total'] = $mul_ord_data[$vid]['sub_total'] + (float)$sdi['total'];

                    $mul_ord_data[$vid]['base_sub_total'] = $mul_ord_data[$vid]['base_sub_total'] + (float)$sdi['total'];

                    $mul_ord_data[$vid]['user_id'] = $vid;

                    $mul_ord_data[$vid]['shipping_amount'] = $mul_ord_data[$vid]['shipping_amount'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);

                    $mul_ord_data[$vid]['base_shipping_amount'] = $mul_ord_data[$vid]['base_shipping_amount'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);

                    $mul_ord_data[$vid]['shipping_invoiced'] = $mul_ord_data[$vid]['shipping_invoiced'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);

                    $mul_ord_data[$vid]['base_shipping_invoiced'] = $mul_ord_data[$vid]['base_shipping_invoiced'] + ($sdi['qty_ordered'] * $sdi['product']->delivery_charge);


                    $mul_ord_data[$vid]['user_id'] = $vid;

                    
                    $mul_ord_data[$vid]['items'][] = $sdi; 
                }
            }
        }
        // dd($mul_ord_data);
        foreach ($mul_ord_data as $key => $value) {
            $order = $this->orderRepository->create($value);
        }

        Cart::deActivateCart();

        Cart::activateCartIfSessionHasDeactivatedCartId();

        session()->flash('order', $order);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Order success page.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        if (!$order = session('order')) {
            return redirect()->route('shop.checkout.cart.index');
        }

        return view($this->_config['view'], compact('order'));
    }

    public function error($response)
    {
        $msg = session('error');
        return view($this->_config['view'], compact('msg'));
    }

    /**
     * Validate order before creation.
     *
     * @return void|\Exception
     */
    public function validateOrder()
    {
        $cart = Cart::getCart();

        $minimumOrderAmount = core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        if (auth()->guard('customer')->check() && auth()->guard('customer')->user()->is_suspended) {
            throw new \Exception(trans('shop::app.checkout.cart.suspended-account-message'));
        }

        if (!$cart->checkMinimumOrder()) {
            throw new \Exception(trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]));
        }

        if ($cart->haveStockableItems() && !$cart->shipping_address) {
            throw new \Exception(trans('shop::app.checkout.cart.check-shipping-address'));
        }

        if (!$cart->billing_address) {
            throw new \Exception(trans('shop::app.checkout.cart.check-billing-address'));
        }

        if ($cart->haveStockableItems() && !$cart->selected_shipping_rate) {
            throw new \Exception(trans('shop::app.checkout.cart.specify-shipping-method'));
        }

        if (!$cart->payment) {
            throw new \Exception(trans('shop::app.checkout.cart.specify-payment-method'));
        }
    }

    /**
     * Check customer is exist or not.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkExistCustomer()
    {
        $customer = $this->customerRepository->findOneWhere([
            'email' => request()->email,
        ]);

        if (!is_null($customer)) {
            return 'true';
        }

        return 'false';
    }

    /**
     * Login for checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForCheckout()
    {
        $this->validate(request(), [
            'email' => 'required|email',
        ]);

        if (!auth()->guard('customer')->attempt(request(['email', 'password']))) {
            return response()->json(['error' => trans('shop::app.customer.login-form.invalid-creds')]);
        }

        Cart::mergeCart();

        return response()->json(['success' => 'Login successfully']);
    }

    /**
     * To apply couponable rule requested.
     *
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon()
    {
        $this->validate(request(), [
            'code' => 'string|required',
        ]);

        $code = request()->input('code');

        $result = $this->coupon->apply($code);

        if ($result) {
            Cart::collectTotals();

            return response()->json([
                'success' => true,
                'message' => trans('shop::app.checkout.total.coupon-applied'),
                'result'  => $result,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('shop::app.checkout.total.cannot-apply-coupon'),
            'result'  => null,
        ], 422);
    }

    /**
     * Initiates the removal of couponable cart rule.
     *
     * @return array
     */
    public function removeCoupon()
    {
        $result = $this->coupon->remove();

        if ($result) {
            Cart::collectTotals();

            return response()->json([
                'success' => true,
                'message' => trans('admin::app.promotion.status.coupon-removed'),
                'data'    => [
                    'grand_total' => core()->currency(Cart::getCart()->grand_total),
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('admin::app.promotion.status.coupon-remove-failed'),
            'data'    => null,
        ], 422);
    }

    /**
     * Check for minimum order.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkMinimumOrder()
    {
        $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        $status = Cart::checkMinimumOrder();

        return response()->json([
            'status'  => !$status ? false : true,
            'message' => !$status ? trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) : 'Success',
        ]);
    }

    public function cashfree_pay()
    {
        // $domain = 'http://localhost:8000';
        $domain = config()['app']['url'];
        $cart = Cart::getCart();
        $billingAddress = $cart->billing_address;
        $shipping_rate = $cart->total_delivery ; // shipping rate
        $discount_amount = $cart->discount_amount; // discount amount
        $total_amount =  ($cart->sub_total + $cart->tax_total + $shipping_rate) - $discount_amount; // total amount
        // $pay_data = Payment::getSupportedPaymentMethods();
        // dd($pay_data);
        if(core()->getConfigData('sales.paymentmethods.cashfree.test_mode') == true){

            $mode = "test"; //<------------ Change to TEST for test server, PROD for production
        }
        else{
            $mode = "PROD";
        }

        // extract($_POST);
        $secretKey = core()->getConfigData('sales.paymentmethods.cashfree.key_secret');
        $postData = array(
            "appId" => core()->getConfigData('sales.paymentmethods.cashfree.app_id'),
            "orderId" => str_random(10),
            "orderAmount" => $total_amount,
            "orderCurrency" => 'INR',
            "orderNote" => 'Cashfree Payment',
            "customerName" => $billingAddress->name,
            "customerPhone" => $billingAddress->phone,
            "customerEmail" => $billingAddress->email,
            "returnUrl" => $domain.'/cashfree-save',
            "notifyUrl" => $domain.'/checkout/onepage',
        );
        ksort($postData);
        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }
        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);

        if ($mode == "PROD") {
            $url = "https://www.cashfree.com/checkout/post/submit";
        } else {
            $url = "https://test.cashfree.com/billpay/checkout/post/submit";
        }

        return view('shop::checkout.cashfree-pay',compact('url','signature','postData'));
    }

    public function cashfree_save(){
        // dd(request()->all());
        $response = request()->all();
        if($response['txStatus'] == 'SUCCESS'){

            $order = $this->orderRepository->create(Cart::prepareDataForOrder());
            $this->orderRepository->update(['status' => 'processing'], $order->id);
            if ($order->canInvoice()) {
                $this->invoiceRepository->create($this->prepareInvoiceData($order));
            }
            Cart::deActivateCart();
            session()->flash('order', $order);
            // Order and prepare invoice
            return redirect()->route('shop.checkout.success');
        }
        else{
            session()->flash('error',$response['txMsg']);
            // Order and prepare invoice
            return redirect()->route('shop.checkout.error');
        }

    }

    protected function prepareInvoiceData($order)
    {
        $invoiceData = ["order_id" => $order->id,];

        foreach ($order->items as $item) {
            $invoiceData['invoice']['items'][$item->id] = $item->qty_to_invoice;
        }

        return $invoiceData;
    }
}
