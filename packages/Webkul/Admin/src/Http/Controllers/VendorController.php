<?php

namespace Webkul\Admin\Http\Controllers;

use Webkul\Admin\DataGrids\VendorRequestsDataGrid;
use Webkul\Admin\DataGrids\PaymentEarningsDataGrid;
use Webkul\Admin\DataGrids\PaymentEarningsAdminDataGrid;
use Webkul\Admin\DataGrids\PaymentHistoryAdminDataGrid;
use Webkul\User\Repositories\AdminRepository;
use Webkul\User\Repositories\RoleRepository;
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
        AdminRepository $adminRepository,
        RoleRepository $roleRepository
    ) {
        $this->adminRepository = $adminRepository;

        $this->roleRepository = $roleRepository;

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

    public function approve($id) {
        $vendor = DB::table('vendor_registration')->where('id',$id)->update(['status'=>1]);
        $vendor = DB::table('vendor_registration')->where('id',$id)->first();

        $data = [];
        $data['name'] = $vendor->name;
        $data['email'] = $vendor->email;
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
        
        return view($this->_config['view']);
    }

    public function view_admin($id=null) {
        if (request()->ajax()) {
            return app(PaymentEarningsAdminDataGrid::class)->toJson();
        }
        
        return view($this->_config['view']);
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

    public function cancel_payment($id)
    {
        $payment = DB::table('vendor_payment_request')->where('id',$id)->first() ;

        if($payment->status == 'Pending'){ 
            DB::table('vendor_payment_request')->where('id',$id)->update(['status'=>'Cancelled']) ;
            session()->flash('success', 'Cancelled Succesfully');
            return redirect()->back() ;
        }
        session()->flash('error', 'Cancellation Failed!');
        return redirect()->back() ;
    }

    public function delete_payment($id)
    {
        $del = DB::table('vendor_payment_request')->where('id',$id)->delete() ;
        if($del) return response()->json(['message' => 'Deleted Successfully!']);

        return response()->json(['message' => 'Deletion Failed'], 500);

    }

    
    public function edit($id)
    {
        $request = DB::table('vendor_payment_request')->where('id',$id)->first();
        return view($this->_config['view'], compact('request'));
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

}
