@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

@php
    $list = $toolbarHelper->getCurrentMode() == 'list' ? true : false;

    $productBaseImage = productimage()->getProductBaseImage($product);

    $totalReviews = $reviewHelper->getTotalReviews($product);

    $avgRatings = ceil($reviewHelper->getAverageRating($product));
@endphp

{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}
    @if (isset($list) && $list)
        <div class="ps-product ps-product--wide">
            <div class="ps-product__thumbnail">
                <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                    <img loading="lazy" src="{{ $productBaseImage['medium_image_url'] }}"
                    :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`" />
                </a>
                @if (!$product->getTypeInstance()->haveSpecialPrice() && $product->new)
                    <span class="ps-product__badge new">New</span>
                @endif
            </div>
            <div class="ps-product__container">
                <div class="ps-product__content w-60">
                    <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}" class="ps-product__title">{{ $product->name }}</a>
                    <p class="ps-product__vendor">Sold by: {{ $product->brand_label }}</p>
                    @if ($totalReviews)
                        <div class="ps-product__rating">
                            <star-ratings ratings="{{ $avgRatings }}"></star-ratings>
                            <span>{{ __('velocity::app.products.ratings', ['totalRatings' => $totalReviews ]) }}</span>
                        </div>
                    @else
                        <div class="ps-product__rating">
                            <span>{{ __('velocity::app.products.be-first-review') }}</span>
                        </div>
                    @endif
                    <div class="ps-product__desc"><span>Description:</span> {{ $product->shortDescription }}</div>
                </div>
                <div class="ps-product__shopping">
                    @include ('shop::products.price', ['product' => $product])
                    @include ('shop::products.add-to-cart', [
                        'addWishlistClass'  => 'pl10',
                        'product'           => $product,
                        'addToCartBtnClass' => 'medium-padding',
                        'showCompare'       => core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false,
                    ])
                    <ul class="ps-product__actions justify-content-around">
                        <li>
                            @include ('shop::products.ul-wishlist')
                        </li>
                        <li v-if="!isMobile()">
                            <product-quick-view-btn :quick-view-details="{{ json_encode($velocityHelper->formatProduct($product)) }}"></product-quick-view-btn>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-2 col-6">
            <div class="ps-product">
                <div class="ps-product__thumbnail">
                    <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                        <img loading="lazy" class="logo" alt="{{ $product->name }}" src="{{ $productBaseImage['large_image_url'] }}" :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`" />
                    </a>
                    @if (!$product->getTypeInstance()->haveSpecialPrice() && $product->new)
                        <span class="ps-product__badge new">New</span>
                    @endif
                    <ul class="ps-product__actions justify-content-around">
                        <li>
                            @include ('shop::products.ul-wishlist')
                        </li>
                        <li v-if="!isMobile()">
                            <product-quick-view-btn :quick-view-details="{{ json_encode($velocityHelper->formatProduct($product)) }}"></product-quick-view-btn>
                        </li>
                    </ul>
                </div>
                <div class="ps-product__container">
                    <div class="ps-product__content">
                        <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}" class="ps-product__title">{{ $product->name }}</a>
                        @if ($totalReviews)
                            <div class="ps-product__rating">
                                <star-ratings ratings="{{ $avgRatings }}"></star-ratings>
                                <span>{{ __('velocity::app.products.ratings', ['totalRatings' => $totalReviews ]) }}</span>
                            </div>
                        @else
                            <div class="ps-product__rating">
                                <span>{{ __('velocity::app.products.be-first-review') }}</span>
                            </div>
                        @endif
                        @include ('shop::products.price', ['product' => $product])
                        @include ('shop::products.add-to-cart', [
                            'product'           => $product,
                            'btnText'           => $btnText ?? null,
                            'detail_mobile'     => true,
                            'moveToCart'        => $moveToCart ?? null,
                            'wishlistMoveRoute' => $wishlistMoveRoute ?? null,
                            'reloadPage'        => $reloadPage ?? null,
                            'addToCartForm'     => $addToCartForm ?? false,
                            'addToCartBtnClass' => $addToCartBtnClass ?? '',
                            'showCompare'       => core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false,
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endif

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}
