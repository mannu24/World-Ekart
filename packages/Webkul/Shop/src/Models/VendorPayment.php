<?php

namespace Webkul\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\Admin;
use Webkul\Shop\Contracts\Vendor as VendorContract;

class VendorPayment extends Model implements VendorContract
{
    protected $fillable = [
        'vendor_id',
        'status',
        'amount',
        'transaction_no',
        'payment_via',
        'paid_at',
        'created_at',
        'updated_at',
    ];
    protected $table = 'vendor_payment_request';

    public function admin() {
        return $this->belongsTo(Admin::class,'vendor_id','id');
    }
}