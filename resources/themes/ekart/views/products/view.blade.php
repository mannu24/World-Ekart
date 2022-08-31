@extends('shop::layouts.master')

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')
@inject ('productViewHelper', 'Webkul\Product\Helpers\View')
@php
    $customAttributeValues = $productViewHelper->getAdditionalData($product);
    $related_products = $product->related_products()->get() ;
@endphp

@php
$reviews = $reviewHelper->getReviews($product)->paginate(4);
$total = $reviewHelper->getTotalReviews($product);

$avgRatings = $reviewHelper->getAverageRating($product);
$avgStarRating = round($avgRatings);
$percentageRatings = $reviewHelper->getPercentageRating($product);

$productImages = [];
$images = productimage()->getGalleryImages($product);

foreach ($images as $key => $image) {
    array_push($productImages, $image['medium_image_url']);
}
@endphp

@section('page_title')
    {{ trim($product->meta_title) != '' ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description"
        content="{{ trim($product->meta_description) != '' ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}" />

    <meta name="keywords" content="{{ $product->meta_keywords }}" />

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) !!}
        </script>
    @endif

    <?php $productBaseImage = productimage()->getProductBaseImage($product, $images); ?>

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="{{ $product->name }}" />

    <meta name="twitter:description" content="{{ $product->description }}" />

    <meta name="twitter:image:alt" content="" />

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="{{ $product->name }}" />

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:description" content="{{ $product->description }}" />

    <meta property="og:url" content="{{ route('shop.productOrCategory.index', $product->url_key) }}" />
@stop

@push('css')
    <style type="text/css">
        .related-products {
            width: 100%;
        }

        .recently-viewed {
            margin-top: 20px;
        }

        .store-meta-images>.recently-viewed:first-child {
            margin-top: 0px;
        }

        .main-content-wrapper {
            margin-bottom: 0px;
        }

        .buynow {
            height: 40px;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content-wrapper')
    {{-- @php dd($product,$total,$avgRatings,$avgStarRating) ; @endphp --}}
    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/shop">Shop</a></li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            <product-view>
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <div class="ps-page__container">
                        <div class="ps-page__left">
                            <div class="ps-product--detail ps-product--fullwidth">
                                <div class="ps-product__header">
                                    @include ('shop::products.view.gallery')
                                    <div class="ps-product__info">
                                        <header>
                                            <h1>{{ $product->name }}</h1>
                                            <div class="ps-product__meta flex-wrap flex-md-nowrap">
                                                @if ($product->brand)
                                                    <p>Brand:
                                                        <a class="ml-2 text-capitalize" href="{{ route('shop.vendor.page',['name' => strtolower($product->brand_label) ]) }}">{{ $product->brand_label }}</a>
                                                    </p>
                                                @endif
                                                @include ('shop::products.view.stock', ['product' => $product])
                                                @if (Webkul\Tax\Helpers\Tax::isTaxInclusive() && $product->getTypeInstance()->getTaxCategory())
                                                    <p class="d-inline">
                                                        <label class="badge badge-secondary">{{ __('velocity::app.products.tax-inclusive') }}</label>
                                                    </p>
                                                @endif
                                                @if ($total)
                                                    <div class="ps-product__rating">
                                                        <star-ratings push-class="mr-2" :ratings="{{ $avgStarRating }}"></star-ratings>
                                                        <span>
                                                            {{ __('shop::app.reviews.ratingreviews', [
                                                                'rating' => $avgRatings, 'review' => $total,
                                                            ]) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            {!! $product->getTypeInstance()->getPriceHtml() !!}
                                        </header>
                                        <div class="ps-product__desc">
                                            @if ($product->brand)
                                                <p>Sold By:<a href="{{ route('shop.vendor.page',['name' => strtolower($product->brand_label) ]) }}">
                                                    <strong class="ml-2">{{ $product->brand_label }}</strong>
                                                </a></p>
                                            @endif
                                            @if (count($product->getTypeInstance()->getCustomerGroupPricingOffers()) > 0)
                                                <ul class="ps-list--dot">
                                                    @foreach ($product->getTypeInstance()->getCustomerGroupPricingOffers() as $offers)
                                                        <li> {{ $offers }} </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <p>{!! $product->short_description !!}</p>
                                        </div>
                                        
                                        @include ('shop::products.view.configurable-options')

                                        @include ('shop::products.view.downloadable')

                                        @include ('shop::products.view.grouped-products')

                                        @include ('shop::products.view.bundle-options')

                                        <div class="ps-product__shopping align-items-center pb-0 mb-0 pb-md-5 mb-md-4">
                                            @if ($product->getTypeInstance()->showQuantityBox())
                                                <figure>
                                                    <figcaption>Quantity</figcaption>
                                                    <quantity-changer quantity-text="{{ __('shop::app.products.quantity') }}"></quantity-changer>
                                                </figure>
                                            @else
                                                <input type="hidden" name="quantity" value="1">
                                            @endif
                                            @include ('shop::products.add-to-cart', [
                                                'form' => false,
                                                'product' => $product,
                                                'showCartIcon' => false,
                                                'showCompare' =>
                                                    core()->getConfigData('general.content.shop.compare_option') == '1'
                                                        ? true
                                                        : false,
                                            ])
                                            <div class="ps-product__actions">@include ('shop::products.ul-wishlist')</div>
                                            <div class="col-12 p-0">
                                                <button type="submit" class="ps-btn btn-small btn-block @if (!$product->getTypeInstance()->showQuantityBox()) mt-25 @endif" {{ ! $product->isSaleable(1) ? 'disabled' : '' }}>
                                                    {{ __('shop::app.products.buy-now') }}
                                                </button>
                                            </div>
                                        </div>
                                        {{-- <div class="ps-product__specification">
                                            <a class="report" href="/page/blank">Report
                                                Abuse</a>
                                            <p><strong>SKU:</strong> SF1133569600-1</p>
                                            <p class="categories"><strong> Categories:</strong><a href="/shop">Consumer
                                                    Electronics</a><a href="/shop">Refrigerator</a><a href="/shop">Babies
                                                    &amp; Moms</a></p>
                                            <p class="tags"><strong> Tags</strong><a href="/shop">sofa</a><a
                                                    href="/shop">technologies</a><a href="/shop">wireless</a></p>
                                        </div> --}}
                                        {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}
                                        <div class="ps-product__actions-mobile">
                                            @include ('shop::products.add-to-cart', [
                                                'form' => false,
                                                'product' => $product,
                                                'showCartIcon' => false,
                                                'addToCartBtnClass' => 'btn-small',
                                                'detail_mobile' => true ,
                                                'showCompare' =>
                                                    core()->getConfigData('general.content.shop.compare_option') == '1'
                                                        ? true
                                                        : false,
                                            ])
                                            <button type="submit" class="ps-btn btn-small" {{ ! $product->isSaleable(1) ? 'disabled' : '' }}>{{ __('shop::app.products.buy-now') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-product__content ps-tab-root">
                                    <tabs big="true">
                                        <tab name="Description" :selected="true">
                                            {!! $product->description !!}
                                        </tab>
                                        <tab name="Specification" :selected="false">
                                            efgh
                                        </tab>
                                        <tab name="Reviews ({{ $total }})" :selected="false">
                                            @include ('shop::products.view.reviews')
                                        </tab>
                                        {{-- <tab name="Questions and Answers" :selected="false">
                                            mnop
                                        </tab> --}}
                                    </tabs>
                                </div>
                            </div>
                        </div>
                        <div class="ps-page__right">
                            <section>
                                <aside class="widget widget_product widget_features">
                                    <p><i class="icon-network"></i> Shipping worldwide</p>
                                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                                </aside>
                                <aside class="widget widget_sell-on-site">
                                    <p><i class="icon-store"></i> Become a Seller?<a target="_blank" href="/page/become-a-seller"> Register Now !</a></p>
                                </aside>
                                @include ('shop::products.list.recently-viewed')
                            </section>
                        </div>
                    </div>
                </div>
            </product-view>
            @if ($related_products->count())
                <div class="ps-section--default ps-related-products">
                    @include ('shop::products.view.related-products')
                </div> 
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

    <script type="text/javascript" src="{{ asset('themes/velocity/assets/js/jquery-ez-plus.js') }}"></script>

    <script type='text/javascript' src='https://unpkg.com/spritespin@4.1.0/release/spritespin.js'></script>

    <script type="text/x-template" id="product-view-template">
        <form method="POST" id="product-form" @click="onSubmit($event)" action="{{ route('cart.add', $product->product_id) }}">
            <input type="hidden" name="is_buy_now" v-model="is_buy_now">
            <slot v-if="slot"></slot>
            <div v-else>
                <div class="spritespin"></div>
            </div>
        </form>
    </script>

    <script>
        Vue.component('product-view', {
            inject: ['$validator'],
            template: '#product-view-template',
            data: function() {
                return {
                    slot: true,
                    is_buy_now: 0,
                }
            },

            mounted: function() {
                let currentProductId = '{{ $product->url_key }}';
                let existingViewed = window.localStorage.getItem('recentlyViewed');

                if (!existingViewed) {
                    existingViewed = [];
                } else {
                    existingViewed = JSON.parse(existingViewed);
                }

                if (existingViewed.indexOf(currentProductId) == -1) {
                    existingViewed.push(currentProductId);

                    if (existingViewed.length > 3)
                        existingViewed = existingViewed.slice(Math.max(existingViewed.length - 4, 1));

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(existingViewed));
                } else {
                    var uniqueNames = [];

                    $.each(existingViewed, function(i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });

                    uniqueNames.push(currentProductId);

                    uniqueNames.splice(uniqueNames.indexOf(currentProductId), 1);

                    window.localStorage.setItem('recentlyViewed', JSON.stringify(uniqueNames));
                }
            },

            methods: {
                onSubmit: function(event) {
                    if (event.target.getAttribute('type') != 'submit')
                        return;

                    event.preventDefault();

                    this.$validator.validateAll().then(result => {
                        if (result) {
                            this.is_buy_now = event.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function() {
                                document.getElementById('product-form').submit();
                            }, 0);
                        }
                    });
                },
            }
        });

        window.onload = function() {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {
                for (let i = 0; i < thumbFrame.length; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function() {
                if (thumbList && productHeroImage) {

                    for (let i = 0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };
    </script>

    <script>
        $(document).ready(function(){
            $('body').on('change','.ant-radio-input',function() {
                if($(this).is(':checked')==true) {
                    if($(this).attr('type')=='radio') {
                        $('body .ant-radio').removeClass('ant-radio-checked')
                    }
                    $(this).parent().addClass('ant-radio-checked') ;
                }
                else {
                    $(this).parent().removeClass('ant-radio-checked') ;
                }
            });
        });
    </script>

@endpush
