@php
    $productBaseImage = productimage()->getProductBaseImage($product);
@endphp

<div class="col-lg-3 col-md-12 text-center">
    <a class="row" href="{{ route('shop.productOrCategory.index', $product->url_key) }}">
        <img src="{{ $productBaseImage['medium_image_url'] }}" class="col-12" alt="" />
    </a>

    <a class="row pt-15 pb-25" href="{{ route('shop.productOrCategory.index', $product->url_key) }}">
        <h2 class="col-12 h1 text-center text-primary">{{ $product->name }}</h2>
    </a>

    @if(isset($index))
        @if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
            <a class="ps-btn ps-btn--outline btn-small" href="{{ route('shop.reviews.create', ['slug' => $product->url_key ]) }}">{{ __('velocity::app.products.write-your-review') }}
            </a>
        @endif
    @endif

</div>