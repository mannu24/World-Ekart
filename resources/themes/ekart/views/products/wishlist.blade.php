@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

    @auth('customer')
        @php
            /* search wishlist on the basis of product's id so that wishlist id can be catched */
            $wishlist = $wishListHelper->getWishlistProduct($product);

            /* link making */
            $href = isset($route) ? $route : ($wishlist ? route('customer.wishlist.remove', $wishlist->id) : route('customer.wishlist.add', $product->product_id));

            /* method */
            $method = isset($route) ? 'POST' : ( $wishlist ? 'DELETE' : 'POST' );

            /* is confirmation needed */
            $isConfirm = isset($route) ? 'true' : 'false';

            /* title */
            $title = $wishlist ? __('velocity::app.shop.wishlist.remove-wishlist-text') : __('velocity::app.shop.wishlist.add-wishlist-text');
        @endphp

        <a class="{{ $addWishlistClass ?? '' }} text-right" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{ $title }}"
        onclick="submitWishlistForm('{{ $href }}','{{ $method }}',{{ $isConfirm }},'{{ csrf_token() }}' )">

            <wishlist-component active="{{ $wishlist ? false : true }}"></wishlist-component>
            @if (isset($text)){!! $text !!}@endif
        </a>
    @endauth

    @guest('customer')
        <form id="wishlist-{{ $product->product_id }}" action="{{ route('customer.wishlist.add', $product->product_id) }}" method="POST">
            @csrf
        </form>
        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{ __('velocity::app.shop.wishlist.add-wishlist-text') }}"
            onclick="document.getElementById('wishlist-{{ $product->product_id }}').submit();">
            <wishlist-component active="false"></wishlist-component>
        </a>
    @endauth