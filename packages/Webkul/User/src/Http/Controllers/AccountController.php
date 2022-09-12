<?php

namespace Webkul\User\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Event;
use DB ;
use Webkul\Shop\Models\Vendor;


class AccountController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_config = request('_config');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->guard('admin')->user();
        $vendor = Vendor::where('id',$user->vendor_id)->first();
        return view($this->_config['view'], compact('user','vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $isPasswordChanged = false;
        $user = auth()->guard('admin')->user();
        $vendor = Vendor::where('id',$user->vendor_id)->first();

        $this->validate(request(), [
            'name'             => 'required',
            'email'            => 'email|unique:admins,email,' . $user->id,
            'password'         => 'nullable|min:6|confirmed',
            'current_password' => 'required|min:6',
            'bank_name'        => 'required',
            'acc_name'         => 'required',
            'acc_no'           => 'required|numeric',
            'ifsc_code'        => 'required',
            'upi_id'           => 'required',
        ]);
        if($user->role_id==2) {
            $data_v = request()->validate([
                'store_name'       => 'required',
                'store_email'      => 'required|email',
                'phone'            => 'required|numeric',
                'address'          => 'required',
                'city'             => 'required',
                'state'            => 'required',
                'pincode'          => 'required|numeric',
                'country'          => 'required',
                'gstin'            => 'required',
                'description'      => 'nullable',
                'display_name'     => 'required',
                'additional_notes' => 'nullable',
                'facebook_link'    => 'nullable|url',
                'instagram_link'   => 'nullable|url',
                'twitter_link'     => 'nullable|url',
                'youtube_link'     => 'nullable|url',
            ]) ; 
            $vendor->update($data_v);
        }

        $data = request()->input();

        if (! Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {
            session()->flash('warning', trans('admin::app.users.users.password-match'));

            return redirect()->back();
        }

        if (! $data['password']) {
            unset($data['password']);
        } else {
            $isPasswordChanged = true;
            $data['password'] = bcrypt($data['password']);
        }

        if (request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('admins/' . $user->id);
        }
        
        if (isset($data['remove_image']) && $data['remove_image'] !== '') {
            $data['image'] = null;
        }

        $user->update($data);

        if ($isPasswordChanged) {
            Event::dispatch('user.admin.update-password', $user);
        }

        session()->flash('success', trans('admin::app.users.users.account-save'));

        return back();
    }
}