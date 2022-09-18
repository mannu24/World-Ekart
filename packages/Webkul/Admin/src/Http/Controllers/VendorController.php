<?php

namespace Webkul\Admin\Http\Controllers;

use Webkul\Admin\DataGrids\VendorRequestsDataGrid;
use Webkul\Admin\DataGrids\PaymentEarningsDataGrid;
use Webkul\Admin\DataGrids\PaymentEarningsAdminDataGrid;
use Webkul\Admin\DataGrids\PaymentHistoryAdminDataGrid;
use Webkul\User\Repositories\AdminRepository;
use Webkul\User\Repositories\RoleRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * Core config repository instance.
     *
     * @var \Webkul\Core\Repositories\CoreConfigRepository
     */
    protected $coreConfigRepository;

    /**
     * Order repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Order item repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderItemRepository
     */
    protected $orderItemRepository;

    /**
     * Tree instance.
     *
     * @var \Webkul\Core\Tree
     */
    protected $configTree;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\CoreConfigRepository  $coreConfigRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        AdminRepository $adminRepository,
        RoleRepository $roleRepository
    ) {
        $this->adminRepository = $adminRepository;

        $this->roleRepository = $roleRepository;

        $this->orderRepository = $orderRepository;

        $this->orderItemRepository = $orderItemRepository;

        $this->_config = request('_config');

        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function index() {
        if (request()->ajax()) {
            return app(VendorRequestsDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    public function view($id) {
        $vendor = DB::table('vendor_registration')->where('id',$id)->first();
        return view($this->_config['view'], compact('vendor'));
    }

    public function view_user($id) {
        $user = DB::table('admins')->where('id',$id)->first() ;
        $vendor = DB::table('vendor_registration')->where('id',$user->vendor_id)->first();
        $statistics = [
            'total_sales'    => $this->currentOrders($id)->sum('base_grand_total_invoiced') - $this->currentOrders($id)->sum('base_grand_total_refunded'),
            'this_month_sales'    => $this->currentOrders($id,date('m'))->sum('base_grand_total_invoiced') - $this->currentOrders($id,date('m'))->sum('base_grand_total_refunded'),
            'payout_received'    => $this->all_payouts($id)->where('status','Approved')->sum('amount_requested'),
            'balance_left'    => $this->balance_left($id),
        ];
        return view($this->_config['view'], compact('vendor','user','statistics'));
    }

    public function approve($id) {
        $vendor = DB::table('vendor_registration')->where('id',$id)->update(['status'=>1]);
        $vendor = DB::table('vendor_registration')->where('id',$id)->first();

        $data = [];
        $data['name'] = $vendor->name;
        $data['email'] = $vendor->email;
        $data['image'] = $vendor->profile_image;
        // $data['password'] = Str::random(10);
        // $data['password_confirmation'] = Str::random(10);
        $data['password'] = '12345678';
        $data['password_confirmation'] = '12345678';
        $data['role_id'] = 2;
        $data['status'] = 1;
        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
            $data['api_token'] = Str::random(80);
        }

        $this->adminRepository->create($data);

        session()->flash('success', 'Approved Successfully');
        return redirect('/admin/vendors-requests');
    }

    public function delete($id) {
        $vendor = DB::table('vendor_registration')->where('id',$id)->update(['status'=>2]);
       

        session()->flash('success', 'Deleted Succesfully');
        return redirect('/admin/vendors-requests');
    }

    public function destroy($id) {
        try {
            DB::table('vendor_registration')->where('id',$id)->update(['status'=>2]);
            return response()->json(['message' => 'Deleted Successfully']);
        } catch (\Exception $e) {}

        return response()->json(['message' => 'Deletion Failed'], 500);
    }

    public function payment_earnings() {
        if (request()->ajax()) {
            return app(PaymentEarningsDataGrid::class)->toJson();
        }

        $statistics = [
            'total_sales'    => $this->currentOrders()->sum('base_grand_total_invoiced') - $this->currentOrders()->sum('base_grand_total_refunded'),
            'this_month_sales'    => $this->currentOrders(date('m'))->sum('base_grand_total_invoiced') - $this->currentOrders(date('m'))->sum('base_grand_total_refunded'),
            'payout_received'    => $this->all_payouts()->where('status','Approved')->sum('amount_requested'),
            'balance_left'    => $this->balance_left(),
        ];
        
        return view($this->_config['view'], compact('statistics'));
    }

    public function request_payment() {

        $data = request()->validate([
            'amount_requested' => 'required|numeric',
        ]);

        $user = auth()->guard('admin')->user() ;
        if(is_null($user->bank_name) || is_null($user->ifsc_code) || is_null($user->upi_id) || is_null($user->acc_no) || is_null($user->acc_name)){
            session()->flash('error','Complete Bank Details in Profile!') ;
            return redirect()->back();
        }

        if($data['amount_requested']>$this->balance_left()) {
            session()->flash('error','Invalid Amount Requested!') ;
            return redirect()->back();
        }

        $data['status'] = 'Pending' ;
        $data['vendor_id'] = $user->id ;
        try {
            DB::table('vendor_payment_request')->insert($data) ;
            session()->flash('success', 'Request Submitted Succesfully!');
            return redirect()->back();
        } catch (\Exception $e) {}
        session()->flash('error','Request Failed') ;
        return redirect()->back();
    }

    public function cancel_payment($id) {
        $payment = DB::table('vendor_payment_request')->where('id',$id)->first() ;

        if($payment->status == 'Pending'){ 
            DB::table('vendor_payment_request')->where('id',$id)->update(['status'=>'Cancelled']) ;
            session()->flash('success', 'Cancelled Succesfully');
            return redirect()->back() ;
        }
        session()->flash('error', 'Cancellation Failed!');
        return redirect()->back() ;
    }

    public function delete_payment($id) {
        $del = DB::table('vendor_payment_request')->where('id',$id)->delete() ;
        if($del) return response()->json(['message' => 'Deleted Successfully!']);

        return response()->json(['message' => 'Deletion Failed'], 500);

    }

    public function view_admin($id=null,$v = null) {
        if (request()->ajax()) {
            return app(PaymentEarningsAdminDataGrid::class)->toJson();
        }
        
        return view($this->_config['view']);
    }
    
    public function edit($id) {
        $request = DB::table('vendor_payment_request')->where('id',$id)->first();
        $id = $request->vendor_id ;
        $vendor = DB::table('admins')->find($id) ;
        $statistics = [
            'total_sales'    => $this->currentOrders($id)->sum('base_grand_total_invoiced') - $this->currentOrders($id)->sum('base_grand_total_refunded'),
            'this_month_sales'    => $this->currentOrders($id,date('m'))->sum('base_grand_total_invoiced') - $this->currentOrders($id,date('m'))->sum('base_grand_total_refunded'),
            'payout_received'    => $this->all_payouts($id)->where('status','Approved')->sum('amount_requested'),
            'balance_left'    => $this->balance_left($id),
        ];
        return view($this->_config['view'], compact('request','statistics','vendor'));
    }

    public function payment_paid() {
        
        $data = request()->validate([
            'amount_requested' => 'required|numeric',
            'amount_paid' => 'required|numeric|lte:amount_requested',
            'transaction_no' => 'required|string',
            'payment_via' => 'required|string',
        ]);
        $id = request()->input('id') ;
        $data['status'] = 'Approved' ;
        $data['paid_at'] = now() ;
        $data['updated_at'] = now() ;
        try{
            DB::table('vendor_payment_request')->where('id',$id)->update($data) ;
            session()->flash('success', 'Request Approved!');
            return redirect()->route('admin.payment-request.history') ;
        } catch(e) {}
        session()->flash('failed', 'Error Occured!');
        return redirect()->back() ;
    }
    
    public function history_admin() {
        if (request()->ajax()) {
            return app(PaymentHistoryAdminDataGrid::class)->toJson();
        }
        
        return view($this->_config['view']);
    }

    function all_payouts($id = null) {
        $v_id = $id!=null ? $id : auth()->guard('admin')->user()->id ;
        return DB::table('vendor_payment_request')->addSelect('id', 'amount_requested', 'created_at', 'status', 'amount_paid','paid_at','payment_via')->where('vendor_id',$v_id) ;
    }

    function currentOrders($id = null,$month = null) {
        $v_id = $id!=null ? $id : auth()->guard('admin')->user()->id ;
        $p_ids = DB::table('products')->where('user_id', $v_id)->pluck('id');
        $o_ids = DB::table('order_items')->whereIn('product_id', $p_ids)->pluck('order_id');
        if($month) {
            return $this->orderRepository->whereIn('orders.id',$o_ids)->whereMonth('created_at','=',$month);
        }
        else {
            return $this->orderRepository->whereIn('orders.id',$o_ids);
        }
    }
    
    function balance_left($id = null) {
        return $this->currentOrders($id)->sum('base_grand_total_invoiced') - $this->currentOrders($id)->sum('base_grand_total_refunded') - $this->all_payouts($id)->where('status','Approved')->sum('amount_requested') ;        
    }
}
