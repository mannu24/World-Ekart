<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Webkul\Admin\Http\Requests\ConfigurationForm;
use Webkul\Core\Repositories\CoreConfigRepository;
use Webkul\Admin\DataGrids\VendorRequestsDataGrid;
use Webkul\Core\Tree;
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

    public function index()
    {
        if (request()->ajax()) {
            // return "hello";
            return app(VendorRequestsDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    public function view($id)
    {
        $vendor = DB::table('vendor_registration')->where('id',$id)->first();


        return view($this->_config['view'], compact('vendor'));
    }

    public function approve($id)
    {
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

    public function delete($id)
    {
        $vendor = DB::table('vendor_registration')->where('id',$id)->update(['status'=>2]);
       

        session()->flash('success', 'Deleted Succesfully');
        return redirect('/admin/vendors-requests');
    }

    public function destroy($id)
    {
        // $this->adminRepository->findOrFail($id);

        // if ($this->adminRepository->count() == 1) {
        //     return response()->json(['message' => trans('admin::app.response.last-delete-error', ['name' => 'Admin'])], 400);
        // }

        // if (auth()->guard('admin')->user()->id == $id) {
        //     return response()->json([
        //         'redirect' => route('super.users.confirm', ['id' => $id]),
        //     ]);
        // }

        try {

            $item = DB::table('vendor_registration')->where('id',$id)->update(['status'=>2]);
            // $item->status = 2;
            // $item->save();

            return response()->json(['message' => 'Deleted Successfully']);
        } catch (\Exception $e) {}

        return response()->json(['message' => 'Deletion Failed'], 500);
    }
}
