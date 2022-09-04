@php
    $direction = core()->getCurrentLocale()->direction == 'rtl' ? 'rtl' : 'ltr';
@endphp

<product-collections
    product-id="fearured-products-carousel"
    product-title="Best Seller Products"
    product-route="{{ route('velocity.category.details', ['category-slug' => 'featured-products', 'count' => 10]) }}"
    locale-direction="{{ $direction }}"
    count="{{ 10 }}">
</product-collections>