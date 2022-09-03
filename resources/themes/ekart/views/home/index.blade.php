@extends('shop::layouts.master')

@inject ('productRatingHelper', 'Webkul\Product\Helpers\Review')

@php
    $channel = core()->getCurrentChannel();

    $homeSEO = $channel->home_seo;

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    {{ isset($metaTitle) ? $metaTitle : "" }}
@endsection

@section('head')
    @if (isset($homeSEO))
        @isset($metaTitle)
            <meta name="title" content="{{ $metaTitle }}" />
        @endisset

        @isset($metaDescription)
            <meta name="description" content="{{ $metaDescription }}" />
        @endisset

        @isset($metaKeywords)
            <meta name="keywords" content="{{ $metaKeywords }}" />
        @endisset
    @endif
@endsection

@push('css')
    @if (! empty($sliderData))
        <link rel="preload" as="image" href="{{ Storage::url($sliderData[0]['path']) }}">
    @else
        <link rel="preload" as="image" href="{{ asset('/themes/velocity/assets/images/banner.webp') }}">
    @endif

    <style type="text/css">
        .product-price span:first-child, .product-price span:last-child {
            font-size: 18px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content-wrapper')
    @include('shop::home.slider')
    <div class="ps-site-features mt-30">
        <div class="ps-container">
            <div class="ps-block--site-features">
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-rocket"></i></div>
                    <div class="ps-block__right"><h4>Free Delivery</h4><p>For all oders over $99</p></div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-sync"></i></div>
                    <div class="ps-block__right"><h4>90 Days Return</h4><p>If goods have problems</p></div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                    <div class="ps-block__right"><h4>Secure Payment</h4><p>100% secure payment</p></div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                    <div class="ps-block__right"><h4>24/7 Support</h4><p>Dedicated support</p></div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-gift"></i></div>
                    <div class="ps-block__right"><h4>Gift Service</h4><p>Support gift service</p></div>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection
@section('full-content-wrapper') --}}
    {{-- @if ($velocityMetaData)
        {!! DbView::make($velocityMetaData)->field('home_page_content')->render() !!}
    @else --}}
        <div class="col-12 py-5">
            @include('shop::home.advertisements.advertisement-four')
        </div>
        @include('shop::home.featured-products')
        <div class="col-12 py-5">
            @include('shop::home.advertisements.advertisement-three')
        </div>
        @include('shop::home.new-products')
        <div class="col-12 py-5">
            @include('shop::home.advertisements.advertisement-two')
        </div>
        @include('shop::home.customer-reviews')
        @include('shop::home.hot-categories')
        {{-- @endif --}}
@endsection

