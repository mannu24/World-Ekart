<div class="ps-form__orders">
    <h3>{{ __('shop::app.checkout.total.order-summary') }}</h3>
    <div class="ps-block--checkout-order">
        <div class="ps-block__content">
            <figure class="ps-block__items"><figcaption>
                <strong>{{ intval($cart->items_qty) }}
                    {{ __('shop::app.checkout.total.sub-total') }}
                    {{ __('shop::app.checkout.total.price') }}</strong>
                <small>{{ core()->currency($cart->base_sub_total) }}</small>
            </figcaption></figure>
            @if ($cart->selected_shipping_rate)
                <figure class="ps-block__items"><figcaption>
                    <strong>{{ __('shop::app.checkout.total.delivery-charges') }}</strong>
                    <small>{{ core()->currency($cart->selected_shipping_rate->base_price) }}</small>
                </figcaption></figure>
            @endif
            @if ($cart->base_tax_total)
                <figure class="ps-block__items">
                    @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount )
                    <figcaption>
                        <strong id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ __('shop::app.checkout.total.tax') }} {{ $taxRate }} %</strong>
                        <small id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ core()->currency($baseTaxAmount) }}</small>
                    </figcaption>
                    @endforeach
                </figure>
            @endif
            <figure class="ps-block__items" id="discount-detail" @if ($cart->base_discount_amount && $cart->base_discount_amount > 0) style="display: block;" @else style="display: none;" @endif><figcaption>
                <strong>{{ __('shop::app.checkout.total.disc-amount') }}</strong>
                <small>-{{ core()->currency($cart->base_discount_amount) }}</small>
            </figcaption></figure>
            <figure class="ps-block__total">
                <h3>
                    {{ __('shop::app.checkout.total.grand-total') }}
                    <strong>{{ core()->currency($cart->base_grand_total) }}</strong>
                </h3>
            </figure>
        </div>
    </div>
</div>