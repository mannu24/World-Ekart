@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.success.title') }}
@stop

@section('content-wrapper')
    <div class="container">
        <div class="order-success-content row col-12 offset-1">
            <h1 class="row col-12">Thank you for placing order with World E-kart!</h1>
            <p class="row col-12 h3 pt-30">
                {{ __('shop::app.checkout.success.order-id-info', ['order_id' => $order->increment_id]) }}
            </p>
            <p class="row col-12 h3">
                {{ __('shop::app.checkout.success.info') }}
            </p>
            {{ view_render_event('bagisto.shop.checkout.continue-shopping.before', ['order' => $order]) }}
                <div class="row col-12 mt-30">
                    <span class="mb-30 mr-10">
                        <a href="{{ route('shop.home.index') }}" class="ps-btn">
                            {{ __('shop::app.checkout.cart.continue-shopping') }}
                        </a>
                    </span>

                    @guest('customer')
                        <span class="mb-30 mr-10">
                            <a href="{{ route('customer.register.index') }}" class="ps-btn">
                                {{ __('shop::app.checkout.cart.continue-registration') }}
                            </a>
                        </span>
                    @endguest
                </div>
            {{ view_render_event('bagisto.shop.checkout.continue-shopping.after', ['order' => $order]) }}
        </div>
    </div>
@endsection
