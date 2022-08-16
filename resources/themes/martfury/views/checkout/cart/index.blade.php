@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('shop.home.index') }}">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('shop::app.checkout.cart.title') }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header"><h1>Shopping Cart</h1></div>
            <form action="{{ route('shop.checkout.cart.update') }}" method="POST" @submit.prevent="onSubmit">
                <div class="ps-section__content">
                    @if ($cart)
                            <table class="table  ps-table--shopping-cart ps-table--responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @csrf
                                    @foreach ($cart->items as $key => $item)
                                        @php
                                            $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);

                                            if (is_null ($item->product->url_key)) {
                                                if (! is_null($item->product->parent)) {
                                                    $url_key = $item->product->parent->url_key;
                                                }
                                            } else {
                                                $url_key = $item->product->url_key;
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="ps-product--cart">
                                                    <div class="ps-product__thumbnail">
                                                        <a href="{{ route('shop.productOrCategory.index', $url_key) }}">
                                                            <img src="{{ $productBaseImage['medium_image_url'] }}" alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__content">{{ $item->product->name }}</div>
                                                </div>
                                            </td>
                                            <td class="price">{{ core()->currency($item->base_price) }}</td>
                                            <td>
                                            @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                                <div class="form-group--number">
                                                    <button class="up" onclick="updateCartQunatity('add',{{ $item->id }})">+</button>
                                                    <button class="down" onclick="updateCartQunatity('sub',{{ $item->id }})">-</button>
                                                    <input class="form-control" name="qty[{{$item->id}}]" id="cart-quantity-{{ $item->id }}" type="number" value={{$item->quantity}} readonly="true"/>
                                                </div>
                                                {{-- <quantity-changer
                                                    :control-name="'qty[{{$item->id}}]'"
                                                    quantity="{{$item->quantity}}">
                                                </quantity-changer> --}}
                                            @endif
                                            </td>
                                            <td data-label="total">
                                                <strong>{{ core()->currency($item->base_price*$item->quantity) }}</strong>
                                            </td>
                                            <td>
                                                <a href="{{ route('shop.checkout.cart.remove', $item->id) }}" onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')"><i class="icon-cross"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @else
                        <div class="alert alert-info"><p class="mb-0">{{ __('shop::app.checkout.cart.empty') }}</p></div>
                    @endif
                    <div class="ps-section__cart-actions">
                        <a href="{{ route('shop.home.index') }}" class="ps-btn">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>
                        @if ($cart->hasProductsWithQuantityBox())
                            <button type="submit" class="ps-btn" id="update_cart_button">{{ __('shop::app.checkout.cart.update-cart') }}</button>
                        @endif
                    </div>
                </div>
                <div class="ps-section__footer">
                    <div class="row justify-space-between">
                        <div class="col-xl-8 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="row">
                                <coupon-component></coupon-component>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--shopping-total">
                                <div class="ps-block__header">
                                    <p> Subtotal <span> {{ core()->currency($cart->base_sub_total) }}</span> </p>
                                </div>
                                @if ($cart->selected_shipping_rate)
                                    <div class="ps-block__header">
                                        <p>{{ __('shop::app.checkout.total.delivery-charges') }}
                                            <span> {{ core()->currency($cart->selected_shipping_rate->base_price) }}</span>
                                        </p>
                                    </div>
                                @endif
                                @if ($cart->base_tax_total)
                                    @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount )
                                    <div class="ps-block__header">
                                        <p>{{ __('shop::app.checkout.total.tax') }} {{ $taxRate }} %
                                            <span> {{ core()->currency($baseTaxAmount) }}</span>
                                        </p>
                                    </div>
                                    @endforeach
                                @endif
                                <div class="ps-block__content">
                                    <ul class="ps-block__product">
                                        @foreach ($cart->items as $item)
                                            <li>
                                                <span class="ps-block__estimate">
                                                    <a href="/product/[pid]" class="ps-product__title">
                                                        {{ $item->name }} <br /> x {{ $item->quantity }}
                                                    </a>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <h3>{{ __('shop::app.checkout.total.grand-total') }}<span>{{ core()->currency($cart->base_grand_total) }}</span></h3>
                                </div>
                            </div>
                            @if (! cart()->hasError())
                                @php
                                    $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
                                    // dd($cart->items) ;
                                @endphp
                                <proceed-to-checkout
                                    href="{{ route('shop.checkout.onepage.index') }}"
                                    add-class="ps-btn"
                                    text="{{ __('shop::app.checkout.cart.proceed-to-checkout') }}"
                                    is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                                    minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}">
                                </proceed-to-checkout>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    {{-- <section class="cart">
        @if ($cart)
            <div class="title">{{ __('shop::app.checkout.cart.title') }}</div>
            <div class="cart-content">
                <div class="left-side">
                    <form action="{{ route('shop.checkout.cart.update') }}" method="POST" @submit.prevent="onSubmit">

                        <div class="cart-item-list" style="margin-top: 0">
                            @csrf
                            @foreach ($cart->items as $key => $item)
                                @php
                                    $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);

                                    if (is_null ($item->product->url_key)) {
                                        if (! is_null($item->product->parent)) {
                                            $url_key = $item->product->parent->url_key;
                                        }
                                    } else {
                                        $url_key = $item->product->url_key;
                                    }
                                @endphp

                                <div class="item mt-5">
                                    <div class="item-image" style="margin-right: 15px;">
                                        <a href="{{ route('shop.productOrCategory.index', $url_key) }}"><img src="{{ $productBaseImage['medium_image_url'] }}" alt="" /></a>
                                    </div>

                                    <div class="item-details">

                                        {!! view_render_event('bagisto.shop.checkout.cart.item.name.before', ['item' => $item]) !!}

                                        <div class="item-title">
                                            <a href="{{ route('shop.productOrCategory.index', $url_key) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </div>

                                        {!! view_render_event('bagisto.shop.checkout.cart.item.name.after', ['item' => $item]) !!}


                                        {!! view_render_event('bagisto.shop.checkout.cart.item.price.before', ['item' => $item]) !!}

                                        <div class="price">
                                            {{ core()->currency($item->base_price) }}
                                        </div>

                                        {!! view_render_event('bagisto.shop.checkout.cart.item.price.after', ['item' => $item]) !!}


                                        {!! view_render_event('bagisto.shop.checkout.cart.item.options.before', ['item' => $item]) !!}

                                        @if (isset($item->additional['attributes']))
                                            <div class="item-options">

                                                @foreach ($item->additional['attributes'] as $attribute)
                                                    <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                @endforeach

                                            </div>
                                        @endif

                                        {!! view_render_event('bagisto.shop.checkout.cart.item.options.after', ['item' => $item]) !!}


                                        {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.before', ['item' => $item]) !!}

                                        <div class="misc">
                                            @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                                <quantity-changer
                                                    :control-name="'qty[{{$item->id}}]'"
                                                    quantity="{{$item->quantity}}">
                                                </quantity-changer>
                                            @endif

                                            <span class="remove">
                                                <a href="{{ route('shop.checkout.cart.remove', $item->id) }}" onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.remove-link') }}</a></span>

                                            @auth('customer')
                                                    @php
                                                        $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                                                    @endphp

                                                    @if ($showWishlist)
                                                        <span class="towishlist">
                                                            @if ($item->parent_id != 'null' ||$item->parent_id != null)
                                                                <a
                                                                    href="javascript:void(0);"
                                                                    onclick="moveToWishlist('{{ __('shop::app.checkout.cart.cart-remove-action') }}', '{{ route('shop.movetowishlist', $item->id) }}')">
                                                                    {{ __('shop::app.checkout.cart.move-to-wishlist') }}
                                                                </a>
                                                            @else
                                                                <a
                                                                    href="javascript:void(0);"
                                                                    onclick="moveToWishlist('{{ __('shop::app.checkout.cart.cart-remove-action') }}', '{{ route('shop.movetowishlist', $item->child->id) }}')">
                                                                    {{ __('shop::app.checkout.cart.move-to-wishlist') }}
                                                                </a>
                                                            @endif
                                                        </span>
                                                    @endif
                                            @endauth
                                        </div>

                                        {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.after', ['item' => $item]) !!}

                                        @if (! cart()->isItemHaveQuantity($item))
                                            <div class="error-message mt-15">
                                                * {{ __('shop::app.checkout.cart.quantity-error') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

                <div class="right-side">
                    <coupon-component></coupon-component>

                    {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                </div>
            </div>
            @include ('shop::products.view.cross-sells')
        @endif
    </section> --}}
@endsection

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script type="text/x-template" id="quantity-changer-template">
        <div class="quantity control-group" :class="[errors.has(controlName) ? 'has-error' : '']">
            <div class="wrap">
                <label>{{ __('shop::app.products.quantity') }}</label>

                <button type="button" class="decrease" @click="decreaseQty()">-</button>

                <input
                    ref="quantityChanger"
                    class="control"
                    :name="controlName"
                    :model="qty"
                    v-validate="validations"
                    data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;"
                    @keyup="setQty($event)">

                <button type="button" class="increase" @click="increaseQty()">+</button>
            </div>

            <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
        </div>
    </script>

    <script>
        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                },

                minQuantity: {
                    type: [Number, String],
                    default: 1
                },

                validations: {
                    type: String,
                    default: 'required|numeric|min_value:1'
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            mounted: function() {
                this.$refs.quantityChanger.value = this.qty > this.minQuantity
                    ? this.qty
                    : this.minQuantity;
            },

            watch: {
                qty: function (val) {
                    this.$refs.quantityChanger.value = ! isNaN(parseFloat(val)) ? val : 0;

                    this.qty = ! isNaN(parseFloat(val)) ? this.qty : 0;

                    this.$emit('onQtyUpdated', this.qty);

                    this.$validator.validate();
                }
            },

            methods: {
                setQty: function({ target }) {
                    this.qty = parseInt(target.value);
                },

                decreaseQty: function() {
                    if (this.qty > this.minQuantity)
                        this.qty = parseInt(this.qty) - 1;
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;
                }
            }
        });

        function removeLink(message) {
            if (! confirm(message)) {
                event.preventDefault();
                return;
            }
        }

        function moveToWishlist(message, route) {
            if (! confirm(message)) {
                event.preventDefault();
                return;
            }

            axios.post(route, {'redirect': false})
                .then((response) => {
                    location.reload();
                });
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity-'+index).value;
            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }

            document.getElementById('cart-quantity-'+index).value = quantity;

            event.preventDefault();
        }
    </script>
@endpush