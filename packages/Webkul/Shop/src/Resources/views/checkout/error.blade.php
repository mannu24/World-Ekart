@extends('shop::layouts.master')

@section('page_title')
Payment Not Sucessful
@stop

@section('content-wrapper')

    <div class="order-success-content" style="min-height: 300px;">
        <h1>Payment Not Sucessfull</h1>

        <p>{{ $msg }}</p>

       
        <div class="misc-controls">
            <a style="display: inline-block" href="{{ route('shop.home.index') }}" class="btn btn-lg btn-primary">
                {{ __('shop::app.checkout.cart.continue-shopping') }}
            </a>
        </div>
        
    
        
    </div>
@endsection
