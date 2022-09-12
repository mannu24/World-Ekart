<?php

namespace Webkul\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\Admin;
use Webkul\Shop\Contracts\Vendor as VendorContract;

class Vendor extends Model implements VendorContract
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'display_name',
        'description',
        'additional_notes',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
        'gstin',
        'status',
        'owner_name',
        'owner_email',
        'owner_phone',
        'owner_address',
        'owner_city',
        'owner_state',
        'owner_country',
        'owner_pincode',
    ];
    protected $table = 'vendor_registration';

    public function user() {
        return $this->hasOne(Admin::class,'vendor_id','id');
    }
}