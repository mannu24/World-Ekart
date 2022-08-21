@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
    <cart-component></cart-component>
@endsection

@push('css')
    <style type="text/css">
        @media only screen and (max-width: 600px) {
            .rango-delete {
                margin-top: 10px;
                margin-left: -10px !important;
            }
        }
    </style>
@endpush

@push('scripts')
    @include('shop::checkout.cart.coupon')
    <script type="text/x-template" id="cart-template">
        <div>
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
                                @if (!is_null($cart))
                                        <table class="table  ps-table--shopping-cart ps-table--responsive">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>{{ __('velocity::app.checkout.subtotal') }}</th>
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
                                                            {{-- <div class="form-group--number">
                                                                <button class="up" onclick="updateCartQunatity('add',{{ $item->id }})">+</button>
                                                                <button class="down" onclick="updateCartQunatity('sub',{{ $item->id }})">-</button>
                                                                <input class="form-control" name="qty[{{$item->id}}]" id="cart-quantity-{{ $item->id }}" type="number" value={{$item->quantity}} readonly="true"/>
                                                            </div> --}}
                                                            <quantity-changer
                                                                :control-name="'qty[{{$item->id}}]'"
                                                                quantity="{{$item->quantity}}">
                                                            </quantity-changer>
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
                                    @if ($cart && $cart->hasProductsWithQuantityBox())
                                        <button type="submit" class="ps-btn" id="update_cart_button">{{ __('shop::app.checkout.cart.update-cart') }}</button>
                                    @endif
                                </div>
                            </div>
                            @if (!is_null($cart))
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
                                                    {{-- <ul class="ps-block__product">
                                                        @foreach ($cart->items as $item)
                                                            <li>
                                                                <span class="ps-block__estimate">
                                                                    <a href="/product/[pid]" class="ps-product__title">
                                                                        {{ $item->name }} <br /> x {{ $item->quantity }}
                                                                    </a>
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul> --}}
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
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="container">
                <section class="cart-details row no-margin col-12">
                    <h2 class="fw6 col-12">{{ __('shop::app.checkout.cart.title') }}</h2>
    
                    @if ($cart)
                        <div class="cart-details-header col-lg-7 col-md-12">
                            <div class="row cart-header col-12 no-padding">
                                <span class="col-8 fw6 fs16 pr0">
                                    {{ __('velocity::app.checkout.items') }}
                                </span>
    
                                <span class="col-2 fw6 fs16 no-padding text-right">
                                    {{ __('velocity::app.checkout.qty') }}
                                </span>
    
                                <span class="col-2 fw6 fs16 text-right pr0">
                                    {{ __('velocity::app.checkout.subtotal') }}
                                </span>
                            </div>
    
                            <div class="cart-content col-12">
                                <form
                                    method="POST"
                                    @submit.prevent="onSubmit"
                                    action="{{ route('shop.checkout.cart.update') }}">
    
                                    <div class="cart-item-list">
                                        @csrf
    
                                        @foreach ($cart->items as $key => $item)
                                            @php
                                                $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
    
                                                $product = $item->product;
    
                                                $productPrice = $product->getTypeInstance()->getProductPrices();
    
                                                if (is_null ($product->url_key)) {
                                                    if (! is_null($product->parent)) {
                                                        $url_key = $product->parent->url_key;
                                                    }
                                                } else {
                                                    $url_key = $product->url_key;
                                                }
                                            @endphp
    
                                            <div class="row col-12">
                                                <a
                                                    title="{{ $product->name }}"
                                                    class="product-image-container col-2"
                                                    href="{{ route('shop.productOrCategory.index', $url_key) }}">
    
                                                    <img
                                                        class="card-img-top"
                                                        alt="{{ $product->name }}"
                                                        src="{{ $productBaseImage['large_image_url'] }}"
                                                        :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`">
                                                </a>
    
                                                <div class="product-details-content col-6 pr0">
                                                    <div class="row item-title no-margin">
                                                        <a
                                                            href="{{ route('shop.productOrCategory.index', $url_key) }}"
                                                            title="{{ $product->name }}"
                                                            class="unset col-12 no-padding">
    
                                                            <span class="fs20 fw6 link-color">{{ $product->name }}</span>
                                                        </a>
                                                    </div>
    
                                                    @if (isset($item->additional['attributes']))
                                                        @foreach ($item->additional['attributes'] as $attribute)
                                                            <div class="row col-12 no-padding no-margin display-block item-attribute">
                                                                <label class="no-margin">
                                                                    {{ $attribute['attribute_name'] }}:
                                                                </label>
                                                                <span>
                                                                    {{ $attribute['option_label'] }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @endif
    
                                                    <div class="row col-12 no-padding no-margin item-price">
                                                        <div class="product-price">
                                                            <span>{{ core()->currency($item->base_price) }}</span>
                                                        </div>
                                                    </div>
    
                                                    @php
                                                        $moveToWishlist = trans('shop::app.checkout.cart.move-to-wishlist');
    
                                                        $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                                                    @endphp
    
                                                    <div class="no-padding col-12 cursor-pointer fs16 item-actions">
                                                        @auth('customer')
                                                            @if ($showWishlist)
                                                                @if ($item->parent_id != 'null' || $item->parent_id != null)
                                                                    <div class="d-inline-block">
                                                                        @include('shop::products.wishlist', [
                                                                            'route' => route('shop.movetowishlist', $item->id),
                                                                            'text' => "<span class='align-vertical-super'>$moveToWishlist</span>"
                                                                        ])
                                                                    </div>
                                                                @else
                                                                    <div class="d-inline-block">
                                                                        @include('shop::products.wishlist', [
                                                                            'route' => route('shop.movetowishlist', $item->child->id),
                                                                            'text' => "<span class='align-vertical-super'>$moveToWishlist</span>"
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endauth
    
                                                        <div class="d-inline-block">
                                                            <a
                                                                class="unset"
                                                                href="{{ route('shop.checkout.cart.remove', ['id' => $item->id]) }}"
                                                                @click="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">
    
                                                                <span class="rango-delete fs24"></span>
                                                                <span class="align-vertical-super">{{ __('shop::app.checkout.cart.remove') }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="product-quantity col-3 no-padding">
                                                    @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                                        <quantity-changer
                                                            :control-name="'qty[{{$item->id}}]'"
                                                            quantity="{{ $item->quantity }}"
                                                            quantity-text="{{ __('shop::app.products.quantity') }}">
                                                        </quantity-changer>
                                                    @else
                                                        <p class="fw6 fs16 no-padding text-center ml15">--</p>
                                                    @endif
                                                </div>
    
                                                <div class="product-price fs18 col-1">
                                                    <span class="card-current-price fw6 mr10">
                                                        {{ core()->currency( $item->base_total) }}
                                                    </span>
                                                </div>
    
                                                @if (! cart()->isItemHaveQuantity($item))
                                                    <div class="control-error mt-4 fs16 fw6">
                                                        * {{ __('shop::app.checkout.cart.quantity-error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
    
                                    {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                                        <div class="misc">
                                            <a
                                                class="theme-btn light fs16 text-center"
                                                href="{{ route('shop.home.index') }}">
                                                {{ __('shop::app.checkout.cart.continue-shopping') }}
                                            </a>
    
                                            @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                                <button
                                                    type="submit"
                                                    class="theme-btn light unset">
    
                                                    {{ __('shop::app.checkout.cart.update-cart') }}
                                                </button>
                                            @endif
                                        </div>
    
                                    {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                                </form>
                            </div>
    
                            @include ('shop::products.view.cross-sells')
                        </div>
                    @endif
    
                    {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
    
                        @if ($cart)
                            <div class="col-lg-4 col-md-12 offset-lg-1 row order-summary-container">
                                @include('shop::checkout.total.summary', ['cart' => $cart])
    
                                <coupon-component></coupon-component>
                            </div>
                        @else
                            <div class="fs16 col-12 empty-cart-message">
                                {{ __('shop::app.checkout.cart.empty') }}
                            </div>
    
                            <a
                                class="fs16 mt15 col-12 remove-decoration continue-shopping"
                                href="{{ route('shop.home.index') }}">
    
                                <button type="button" class="theme-btn remove-decoration">
                                    {{ __('shop::app.checkout.cart.continue-shopping') }}
                                </button>
                            </a>
                        @endif
    
                    {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                </section>
            </div> --}}
        </div>
    </script>

    <script type="text/javascript" id="cart-template">
        (() => {
            Vue.component('cart-component', {
                template: '#cart-template',

                data: function () {
                    return {
                        isMobileDevice: this.isMobile(),
                    }
                },

                methods: {
                    removeLink(message) {
                        if (! confirm(message)) {
                            event.preventDefault();
                        }
                    }
                }
            })
        })();
    </script>
@endpush