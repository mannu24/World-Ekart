@extends('shop::layouts.master')

@section('page_title') Seller Registration Saved @endsection

@section('content-wrapper')
    
<div class="ps-page--shop">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>Seller Registration</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="order-success-content row col-12 offset-1">
            <h1 class="row col-12">Seller Registration Successfull!</h1>
            <p class="row col-12 h4 pt-30">Random Instructions Text</p>
            <p class="row col-12 h4">{{ __('shop::app.checkout.success.info') }}</p>
            {{ view_render_event('bagisto.shop.checkout.continue-shopping.before') }}
                <div class="row col-12 mt-30">
                    <span class="mb-30 mr-10">
                        <a href="{{ route('shop.home.index') }}" class="ps-btn">
                            {{ __('shop::app.checkout.cart.continue-shopping') }}
                        </a>
                    </span>
                </div>
            {{ view_render_event('bagisto.shop.checkout.continue-shopping.after') }}
        </div>
    </div>
</div>
   
@endsection
