<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webkul\Shop\Models\Vendor;

class VendorController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // return $this->_config['view'];
        return view($this->_config['view']);
    }

    public function save()
    {
        

        // dd(request()->all());
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'additional_notes' => 'required',
            'facebook_link' => 'required',
            'instagram_link' => 'required',
            'twitter_link' => 'required',
            'youtube_link' => 'required',
            'gstin' => 'required',
            // 'vat_id' => 'required',
            'owner_name' => 'required',
            'owner_email' => 'required|email',
            'owner_phone' => 'required',
            'owner_address' => 'required',
            'owner_city' => 'required',
            'owner_state' => 'required',
            'owner_country' => 'required',
            'owner_pincode' => 'required',
        ]);
        $data = request()->input();
        
        $vendor = Vendor::create($data);
        $vendor->status = 0;
            
        $prefix = '/storage/vendor/'.$data['email'].'/';
        if (request()->hasFile('gst_certificate')) {
            $data['gst_certificate'] = request()->file('gst_certificate')->store('vendor/' . $data['email']);

            $vendor->gst_certificate = $prefix.request()->file('gst_certificate')->hashName();
        }

        if (request()->hasFile('mca_certificate')) {
            $data['mca_certificate'] = request()->file('mca_certificate')->store('vendor/' . $data['email']);

            $vendor->mca_certificate = $prefix.request()->file('mca_certificate')->hashName();
        }

        if (request()->hasFile('other_certificate')) {
            $data['other_certificate'] = request()->file('other_certificate')->store('vendor/' . $data['email']);

            $vendor->other_certificate = $prefix.request()->file('other_certificate')->hashName();
        }

        if (request()->hasFile('profile_image')) {
            $data['profile_image'] = request()->file('profile_image')->store('vendor/' . $data['email']);

            $vendor->profile_image = $prefix.request()->file('profile_image')->hashName();
        }

        if (request()->hasFile('store_images')) {
            $images = request()->file('store_images');
            $path = '';
            foreach ($images as $key => $image) {
                $saved[$key] = $images[$key]->store('vendor/' . $data['email']);
                $path = $path.$prefix.$images[$key]->hashName() . ',';
            }

            $vendor->store_images = substr($path, 0, -1);
        }

        $vendor->save();

        return view($this->_config['view']);
    }
}
