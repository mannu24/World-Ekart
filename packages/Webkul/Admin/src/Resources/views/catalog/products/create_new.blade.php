@extends('admin::layouts.content')

@section('page_title')
{{ __('admin::app.catalog.products.add-title') }}
@stop

@push('css')
<style>
.table td .label {
    margin-right: 10px;
}

.table td .label:last-child {
    margin-right: 0;
}

.table td .label .icon {
    vertical-align: middle;
    cursor: pointer;
}
</style>
@endpush

@section('content')
<product-create></product-create>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
<script type="text/x-template" id="product-create">
    <div class="container">
            <div id="checkout" class="checkout-process row col-md-12 align-items-stretch">
                <h1 class="col-12">{{ __('velocity::app.checkout.checkout') }}</h1>
                <div class="col-lg-7 col-md-12">
                    <div class="step-content information" id="address-section">
                        @include('shop::checkout.onepage.customer-info')
                    </div>
                    <div class="step-content shipping" id="shipping-section" v-if="showShippingSection">
                        <shipping-section :key="shippingComponentKey" @onShippingMethodSelected="shippingMethodSelected($event)">
                        </shipping-section>
                    </div>
                    <div class="step-content payment" id="payment-section" v-if="showPaymentSection">
                        <payment-section @onPaymentMethodSelected="paymentMethodSelected($event)"> </payment-section>
                        <coupon-component @onApplyCoupon="getOrderSummary" @onRemoveCoupon="getOrderSummary"> </coupon-component>
                    </div>
                    <div class="step-content review" id="summary-section" v-if="showSummarySection">
                        <review-section :key="reviewComponentKey">
                            <div slot="summary-section">
                                {{-- <summary-section discount="1" :key="summaryComponentKey" @onApplyCoupon="getOrderSummary" @onRemoveCoupon="getOrderSummary"></summary-section> --}}
                            </div>
                            <div slot="place-order-btn">
                                <div class="mb-20">
                                    <button type="button" class="ps-btn" @click="placeOrder()" :disabled="!isPlaceOrderEnabled" 
                                        v-if="selected_payment_method.method != 'paypal_smart_button' && selected_payment_method.method != 'cashfree'" id="checkout-place-order-button">
                                        {{ __('shop::app.checkout.onepage.place-order') }}
                                    </button>
                                    <form v-if="selected_payment_method.method == 'cashfree'" id="redirectForm" method="post" action="{{ route('cashfree')}}">
                                        @csrf
                                    <input class="d-none" name="appId" :value="selected_payment_method.method" />
                                    <input class="d-none" name="orderId" />
                                    <input class="d-none" name="orderAmount" />
                                    <input class="d-none" name="orderCurrency" />
                                    <input class="d-none" name="orderNote" />
                                    <input class="d-none" name="customerName" />
                                    <input class="d-none" name="customerEmail" />
                                    <input class="d-none" name="customerPhone" />
                                    <input class="d-none" name="returnUrl" />
                                    <input class="d-none" name="notifyUrl" />
                                    <p :value="selected_payment_method"></p>
                                        <button trpe="submit" class="ps-btn" :value="selected_payment_method.method" >Pay Now</button>
                                    </form>
                                </div>
                            </div>
                        </review-section>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 offset-lg-1 order-summary-container top pt0">
                    <summary-section :key="summaryComponentKey"></summary-section>
                    <div class="paypal-button-container mt10"></div>
                </div>
            </div>
        </div>
    </script>
@endpush