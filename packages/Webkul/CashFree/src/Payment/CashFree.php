<?php

namespace Webkul\CashFree\Payment;

use Webkul\Payment\Payment\Payment;

class CashFree extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'cashfree';

    public function getRedirectUrl()
    {
        
    }
}