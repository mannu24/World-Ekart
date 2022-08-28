{!! view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]) !!}

<p class="d-inline">
    <label class="{{! $product->haveSufficientQuantity(1) ? 'badge-danger' : 'badge-success' }} badge disable-box-shadow">
            @if ( $product->haveSufficientQuantity(1) === true )
                {{ __('shop::app.products.in-stock') }}
            @elseif ( $product->haveSufficientQuantity(1) > 0 )
                {{ __('shop::app.products.available-for-order') }}
            @else
                {{ __('shop::app.products.out-of-stock') }}
            @endif
    </label>
</p>

{!! view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]) !!}