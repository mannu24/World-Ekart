<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Webkul\Core\Traits\PDFHandler;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Shop\DataGrids\OrderDataGrid;

class OrderController extends Controller
{
    use PDFHandler;

    /**
     * Current customer.
     *
     * @var \Webkul\Customer\Contracts\Customer
     */
    protected $currentCustomer;

    /**
     * OrderrRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * InvoiceRepository object
     *
     * @var \Webkul\Sales\Repositories\InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\InvoiceRepository  $invoiceRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository
    ) {
        $this->middleware('customer');

        $this->currentCustomer = auth()->guard('customer')->user();

        $this->orderRepository = $orderRepository;

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
        if (request()->ajax()) {
            return app(OrderDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $order = $this->orderRepository->findOneWhere([
            'customer_id' => $this->currentCustomer->id,
            'id'          => $id,
        ]);

        $shipment = $order->shipments->first() ;
        $title = '' ;
        if($shipment) $title = DB::table('courier_titles')->where('name', $shipment->carrier_title)->first() ;

        if (! $order) {
            abort(404);
        }

        return view($this->_config['view'], compact('order', 'title'));
    }

    /**
     * Print and download the for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);

        if ($invoice->order->customer_id !== $this->currentCustomer->id) {
            abort(404);
        }
        $pdf = view('shop::customers.account.orders.pdf', compact('invoice'))->render() ;
        
        return $this->downloadPDF( $pdf, 'Invoice-' . $invoice->created_at->format('d-m-Y'));
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        /* find by order id in customer's order */
        $order = $this->currentCustomer->all_orders()->find($id);

        /* if order id not found then process should be aborted with 404 page */
        if (! $order) {
            abort(404);
        }

        $result = $this->orderRepository->cancel($order);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    }
}
