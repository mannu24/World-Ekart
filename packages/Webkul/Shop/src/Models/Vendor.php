<?php

namespace Webkul\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\Product;
use Webkul\Shop\Contracts\Vendor as VendorContract;

class Vendor extends Model implements VendorContract
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'display_name',
        'description',
        'additional_notes',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
        'gstin',
        'vat_id',
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

    public function products() {
        return $this->hasMany(Product::class,'user_id','id');
    }
}