{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}

    @if (isset($form) && !$form)
        <button type="submit" {{ ! $product->isSaleable() ? 'disabled' : '' }} class="ps-btn btn-small {{ $addToCartBtnClass ?? '' }}">
            @if (! (isset($showCartIcon) && !$showCartIcon))
                <i class="fas fa-shopping-cart pr-2"></i>
            @endif
            {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') :  __('shop::app.products.add-to-cart') }}
        </button>
    @elseif(isset($addToCartForm) && !$addToCartForm)
        <form method="POST" class="d-flex justify-content-center" action="{{ route('cart.add', $product->product_id) }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" {{ ! $product->isSaleable() ? 'disabled' : '' }} class="ps-btn btn-small {{ $addToCartBtnClass ?? '' }}">
                @if (! (isset($showCartIcon) && !$showCartIcon))
                    <i class="fas fa-shopping-cart pr-2"></i>
                @endif
                    {{ ($product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}
            </button>
        </form>
    @else
        <add-to-cart
            form="true"
            csrf-token='{{ csrf_token() }}'
            product-flat-id="{{ $product->id }}"
            product-id="{{ $product->product_id }}"
            reload-page="{{ $reloadPage ?? false }}"
            move-to-cart="{{ $moveToCart ?? false }}"
            wishlist-move-route="{{ $wishlistMoveRoute ?? false }}"
            add-class-to-btn="{{ $addToCartBtnClass ?? '' }}"
            is-enable={{ ! $product->isSaleable() ? 'false' : 'true' }}
            show-cart-icon={{ ! (isset($showCartIcon) && ! $showCartIcon) }}
            btn-text="{{ (! isset($moveToCart) && $product->type == 'booking') ?  __('shop::app.products.book-now') : $btnText ?? __('shop::app.products.add-to-cart') }}">
        </add-to-cart>
    @endif
{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}