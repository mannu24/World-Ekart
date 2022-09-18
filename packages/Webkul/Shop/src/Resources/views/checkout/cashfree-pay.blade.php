@extends('shop::layouts.master')

@section('page_title')
    Continue With CashFree 
@stop

@section('content-wrapper')

    <div class="order-success-content" style="min-height: 300px;">
    <form action="<?php echo $url; ?>" name="frm1" method="post">
      <input type="hidden" name="signature" value="{{ $signature }}"/>
      <input type="hidden" name="orderNote" value="{{ $postData['orderNote'] }}"/>
      <input type="hidden" name="customerEmail" value="{{ $postData['customerEmail'] }}"/>
      <input type="hidden" name="customerPhone" value="{{ $postData['customerPhone'] }}"/>
      <input type="hidden" name="orderAmount" value="{{ $postData['orderAmount'] }}"/>
      <input type ="hidden" name="notifyUrl" value="{{ $postData['notifyUrl'] }}"/>
      <input type ="hidden" name="returnUrl" value="{{ $postData['returnUrl'] }}"/>
      <input type="hidden" name="appId" value="{{ $postData['appId'] }}"/>
      <input type="hidden" name="orderId" value="{{ $postData['orderId'] }}"/>
      <input type="hidden" name="customerName" value="{{ $postData['customerName'] }}"/>
      <input type="hidden" name="orderCurrency" value="{{ $postData['orderCurrency'] }}"/>
      <button type="submit" class="ps-btn">Redirecting to Payment Page.....</button>
  </form>
        
    </div>
    
@endsection
@push('scripts')
<script>

        $( document ).ready(function() {
            document.frm1.submit()
        });
        </script>
@endpush
