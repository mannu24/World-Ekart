<div class="form-container review-checkout-conainer">
    <accordian :title="'{{ __('shop::app.checkout.onepage.summary') }}'" :active="true">
        <div class="form-header" slot="header">
            <h3 class="h4 d-inline-block">
                {{ __('shop::app.checkout.onepage.summary') }}
            </h3>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div slot="body">
            <div class="address-summary row">
                @if ($billingAddress = $cart->billing_address)
                    <div class="billing-address col-lg-6 col-md-12">
                        <div class="card-title">
                            <b>{{ __('shop::app.checkout.onepage.billing-address') }}</b>
                        </div>
                        <div class="card-content">
                            <ul type="none">
                                <li>
                                    {{ $billingAddress->company_name ?? '' }}
                                </li><br />
                                <li>
                                    {{ $billingAddress->name }}
                                </li><br />
                                <li>
                                    {{ $billingAddress->address1 }}, <br />
                                </li><br />

                                <li>
                                    {{ $billingAddress->postcode . " " . $billingAddress->city }}
                                </li><br />

                                <li>
                                    {{ $billingAddress->state }}
                                </li><br />

                                <li>
                                    {{ core()->country_name($billingAddress->country) }}
                                </li><br />

                                <li>
                                    {{ __('shop::app.checkout.onepage.contact') }} : {{ $billingAddress->phone }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if ($cart->haveStockableItems() && $shippingAddress = $cart->shipping_address)
                    <div class="shipping-address col-lg-6 col-md-12">
                        <div class="card-title">
                            <b>{{ __('shop::app.checkout.onepage.shipping-address') }}</b>
                        </div>
                        <div class="card-content">
                            <ul>
                                <li>
                                    {{ $shippingAddress->company_name ?? '' }}
                                </li><br/>
                                <li>
                                    {{ $shippingAddress->name }}
                                </li><br/>
                                <li>
                                    {{ $shippingAddress->address1 }},<br/>
                                </li><br/>

                                <li>
                                    {{ $shippingAddress->postcode . " " . $shippingAddress->city }}
                                </li><br />

                                <li>
                                    {{ $shippingAddress->state }}
                                </li><br />

                                <li>
                                    {{ core()->country_name($shippingAddress->country) }}
                                </li><br />

                                <li>
                                    {{ __('shop::app.checkout.onepage.contact') }} : {{ $shippingAddress->phone }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

            </div>
            <div class="cart-item-list">
                <h4 class="font-weight-bolder">{{ __('velocity::app.checkout.items') }}</h4>
                @foreach ($cart->items as $item)
                    @php
                        $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
                    @endphp
                    <div class="row col-12 px-0">
                        <div class="col-2 max-sm-img-dimension">
                            <img src="{{ $productBaseImage['medium_image_url'] }}" alt="" />
                        </div>
                        <div class="col-10 px-0 h4">
                            {!! view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]) !!}
                                <div class="row mb-10">
                                    <span class="col-12 font-weight-bolder">{{ $item->product->name }}</span>
                                </div>
                            {!! view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]) !!}

                            <div class="row col-12 justify-content-start mb-10">
                                {!! view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]) !!}
                                        <span class="value">
                                            {{ core()->currency($item->base_price) }}
                                        </span>
                                {!! view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]) !!}

                                <i class="fas fa-times px-2"></i>

                                {!! view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]) !!}
                                    <span class="value">
                                        {{ $item->quantity }} ({{ __('shop::app.checkout.onepage.quantity') }})
                                    </span>
                                {!! view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]) !!}
                            </div>

                            <div class="row col-12">
                                <b>{{ core()->currency($item->base_total) }}</b>
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.options.before', ['item' => $item]) !!}

                                @if (isset($item->additional['attributes']))
                                    <div class="item-options">

                                        @foreach ($item->additional['attributes'] as $attribute)
                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                        @endforeach

                                    </div>
                                @endif

                            {!! view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]) !!}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="order-description row h4 cart-details align-items-stretch">
                <div class="col-lg-5 col-md-12">
                    @if ($cart->haveStockableItems())
                        <div class="shipping mb-20">
                            <div class="decorator">
                                <i class="icon shipping-icon"></i>
                            </div>

                            <div class="text">

                                <div class="info">
                                    {{ $cart->selected_shipping_rate->method_title }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="payment mb-20">
                        <div class="decorator">
                            <i class="icon payment-icon"></i>
                        </div>

                        <div class="text">
                            <h4 class="font-weight-bolder h4">
                                {{ core()->getConfigData('sales.paymentmethods.' . $cart->payment->method . '.title') }}
                            </h4>

                            <span>{{ __('shop::app.customer.account.order.view.payment-method') }}</span>
                        </div>
                    </div>

                    <slot name="place-order-btn"></slot>
                </div>

                <div class="col-lg-6 col-md-12 order-summary-container pt-0 offset-lg-1">
                    <slot name="summary-section"></slot>
                </div>
            </div>
        </div>
    </accordian>
</div>
