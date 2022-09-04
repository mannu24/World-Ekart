@extends('shop::layouts.master')
@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

@section('page_title') {{ $vendor->display_name }} - Seller @endsection
@push('css')
    <style type="text/css">
        .category-container {
            min-height: unset;
        }

        .toolbar-wrapper .col-4:first-child {
            display: none !important;
        }

        .toolbar-wrapper .col-4:last-child {
            right: 0;
            position: absolute;
        }


        @media only screen and (max-width: 992px) {
            .main-content-wrapper .vc-header {
                box-shadow: unset;
            }

             .toolbar-wrapper .col-4:last-child {
                left: 175px;
            }

            .toolbar-wrapper .sorter {
                left: 35px;
                position: relative;
            }

            .quick-view-btn-container,
            .rango-zoom-plus,
            .quick-view-in-list {
                display: none;
            }

        }
    </style>
@endpush
@php
    $products = $vendor->user->products ;
    if($products){
        $total = $avgStarRating = $percentageRatings = 0 ;
        foreach ($products as $key => $product) {
            $total += $reviewHelper->getTotalReviews($product);
            $avgRatings = $reviewHelper->getAverageRating($product);
            $avgStarRating += round($avgRatings);
        }
        $avgStarRating = round($avgStarRating/($total !=0 ? $total : 1) ) ;
    }
@endphp
@section('content-wrapper')
<div class="ps-page--shop">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ 'Sellers' }}</li>
                <li>{{ $vendor->display_name }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-vendor-store">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__left">
                    <div class="ps-block--vendor">
                        <div class="ps-block__thumbnail">
                            @if (file_exists(public_path($vendor->profile_image)))
                                <img src="{{ asset($vendor->profile_image) }}" alt="martfury">
                            @else
                                <img src="{{ asset('themes/ekart/assets/images/not-found.jpg') }}" alt="martfury">
                            @endif
                        </div>
                        <div class="ps-block__container">
                            <div class="ps-block__header">
                                <h4>{{ $vendor->display_name }}</h4>
                                @if ($products->count())
                                    @if ($total)
                                        <div class="ps-product__rating">
                                            <star-ratings ratings="{{ $avgStarRating }}"></star-ratings><br>
                                            <p>{{ __('velocity::app.products.ratings', ['totalRatings' => $total ]) }}</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="ps-block__divider"></div>
                            <div class="ps-block__content">
                                <p><strong>Description: </strong>{{ $vendor->description }}
                                </p>
                                <span class="ps-block__divider"></span>
                                <p><strong>Address: </strong>
                                    {{
                                        $vendor->address.' '.$vendor->city.', '.($vendor->state ? $vendor->state.', ' : '' ).$vendor->country
                                    }}
                                </p>
                                @if (!is_null($vendor->facebook_link) || !is_null($vendor->twitter_link) || !is_null($vendor->instagram_link) || !is_null($vendor->youtube_link) )
                                    <figure>
                                        <figcaption>Follow us on Social Media</figcaption>
                                        <ul class="ps-list--social-color">
                                            @if ($vendor->facebook_link)
                                                <li><a class="facebook" target="_blank" href="{{ $vendor->facebook_link }}"><i class="fa fa-facebook"></i></a></li>
                                            @endif
                                            @if ($vendor->twitter_link)
                                                <li><a class="twitter" target="_blank" href="{{ $vendor->twitter_link }}"><i class="fa fa-twitter"></i></a></li>
                                            @endif
                                            @if ($vendor->instagram_link)
                                                <li><a class="instagram" target="_blank" href="{{ $vendor->instagram_link }}"><i class="fa fa-instagram"></i></a></li>
                                            @endif
                                            @if ($vendor->youtube_link)
                                                <li><a class="youtube" target="_blank" href="{{ $vendor->youtube_link }}"><i class="fa fa-youtube"></i></a></li>
                                            @endif
                                        </ul>
                                    </figure>
                                @endif
                            </div>
                            <div class="ps-block__footer">
                                @if ($vendor->phone)
                                    <p>Call us directly
                                        <strong><a href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></strong>
                                    </p>
                                @endif
                                <p>If you have any question</p>
                                <a class="ps-btn ps-btn--fullwidth" href="{{ route('shop.contact.index') }}">Contact Seller</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__right">
                    <div class="ps-store-products">
                        <div class="ps-block--shop-features">
                            <div class="ps-block__header"><h3>Best Seller Products</h3></div>
                            <div class="ps-block__content">
                                @if ($top_products->count() > 0)
                                    <carousel-component :slides-per-page="{{ $toolbarHelper->getCurrentMode() == 'list' ? 1 : 3 }}" pagination-enabled="hide" :slides-count="{{ $top_products->count() }}">
                                        @foreach ($top_products as $key => $item)
                                            <slide :slot="`slide-{{ $key }}`">
                                                @include('shop::products.list.card', [
                                                    'list' => false,
                                                    'product' => $item->product_flats->first(),
                                                ])
                                            </slide>
                                        @endforeach
                                    </carousel-component>
                                @endif
                            </div>
                        </div>
                        <div class="ps-shopping">
                            <div class="ps-shopping__header">
                                <div class="ps-shopping__actions flex-column flex-md-row">
                                    <p class="w-100"> <strong class="mr-2">{{ $products->count() }}</strong>
                                        @if ($products->count() == 1)
                                            {{ __('shop::app.search.found-result') }}
                                        @else
                                            {{ __('shop::app.search.found-results') }}
                                        @endif    
                                    </p>
                                    @include ('shop::products.list.toolbar',['hide' => true])
                                </div>
                            </div>
                            <div class="ps-shopping__content vendor-store">
                                <div class="row justify-content-start">
                                    @if (!$products->count())
                                        <h2 class="col-12">{{ __('shop::app.products.whoops') }}</h2>
                                        <h3 class="col-12">{{ __('shop::app.search.no-results') }}</h3>
                                    @else
                                        @foreach ($products as $productFlat)
                                            @if ($toolbarHelper->getCurrentMode() == 'grid')
                                                @include('shop::products.list.card', [
                                                    'cardClass' => 'category-product-image-container',
                                                    'product' => $productFlat->product_flats->first(),
                                                ])
                                            @else
                                                <div class="col-12">
                                                    @include('shop::products.list.card', [
                                                        'list' => true,
                                                        'product' => $productFlat->product_flats->first(),
                                                    ])
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection