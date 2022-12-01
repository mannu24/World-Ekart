@php
    $count = core()->getConfigData('catalog.products.homepage.no_of_new_product_homepage');
    $count = $count ? $count : 10;
    $direction = core()->getCurrentLocale()->direction == 'rtl' ? 'rtl' : 'ltr';
@endphp

<product-collections-new
    product-id="all-collections"
    product-title="{{ __('shop::app.home.featured-products') }}"
    product-route="{{ route('velocity.category.details', ['category-slug' => 'all-collections', 'count' => $count]) }}"
    locale-direction="{{ $direction }}"
    count="{{ (int) $count }}">
</product-collections-new>