<div class="ps-form__orders">
    <h3>{{ __('velocity::app.checkout.cart.cart-summary') }}</h3>
    <div class="ps-block--checkout-order">
        <div class="ps-block__content">
            <figure>
                <figcaption><strong>Product</strong><strong>total</strong></figcaption>
            </figure>
            <figure>
                <figcaption>
                    <strong>{{ __('velocity::app.checkout.sub-total') }}</strong>
                    <small>{{ core()->currency($cart->base_sub_total) }}</small>
                </figcaption>
            </figure>
            @if ($cart->selected_shipping_rate)
                <figure>
                    <figcaption>
                        <strong>{{ __('shop::app.checkout.total.delivery-charges') }}</strong>
                        <small>{{ core()->currency($cart->selected_shipping_rate->base_price) }}</small>
                    </figcaption>
                </figure>
            @endif
            @if ($cart->base_tax_total)
                @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount)
                    <figure>
                        <figcaption>
                            <strong id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">
                                {{ __('shop::app.checkout.total.tax') }} {{ $taxRate }} %
                            </strong>
                            <small id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ core()->currency($baseTaxAmount) }}</small>
                        </figcaption>
                    </figure>
                @endforeach
            @endif
            @if ($cart->base_discount_amount && $cart->base_discount_amount > 0)
                <figure>
                    <figcaption id="discount-detail">
                        <strong>{{ __('shop::app.checkout.total.disc-amount') }}</strong>
                        <small>-{{ core()->currency($cart->base_discount_amount) }}</small>
                    </figcaption>
                </figure>                
            @endif
            <figure class="ps-block__total payable-amount mb-0" id="grand-total-detail">
                <h3>{{ __('shop::app.checkout.total.grand-total') }}
                    <strong id="grand-total-amount-detail">{{ core()->currency($cart->base_grand_total) }}</strong>
                </h3>
            </figure>
        </div>
    </div>
    <div class="row">
        @php
            $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
        @endphp
        @if (Cart::hasError())
            <button class="ps-btn" disabled>{{ __('velocity::app.checkout.proceed') }}</button>
        @else
            <proceed-to-checkout href="{{ route('shop.checkout.onepage.index') }}"
                add-class="theme-btn text-uppercase col-12 remove-decoration fw6 text-center"
                text="{{ __('velocity::app.checkout.proceed') }}"
                is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}">
            </proceed-to-checkout>
        @endif
    </div>
</div>