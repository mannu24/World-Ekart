{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}
    @if (! (isset($showWishlist) && !$showWishlist) && core()->getConfigData('general.content.shop.wishlist_option'))
        @include('shop::products.wishlist', [
            'addClass' => $addWishlistClass ?? ''
        ])
    @endif
{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}