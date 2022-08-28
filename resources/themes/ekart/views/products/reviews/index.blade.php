@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.reviews.product-review-page-title') }}
@endsection

@php
    $ratings = [
        '', '', '', ''
    ];

    $ratings = [
        10, 30, 20, 15, 25
    ];

    $totalReviews = 25;
    $totalRatings = array_sum($ratings);

@endphp

@push('css')
    <style>
        .reviews {
            display: none !important;
        }
    </style>
@endpush

@section('full-content-wrapper')
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{ '/'.$product->url_key }}">{{ $product->name }}</a></li>
                <li>Reviews</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row review-page-container">
            @include ('shop::products.view.small-view', ['product' => $product,'index' => true])

            <div class="col-lg-7 col-md-12 fs16">
                <h2 class="full-width mb30">Rating and Reviews</h2>

                @include ('shop::products.view.reviews', ['index' => true])
            </div>
        </div>
    </div>
@endsection