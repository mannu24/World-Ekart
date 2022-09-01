@php
    $cart = cart()->getCart();
    $cartItemsCount = $cart ? $cart->items->count() : trans('shop::app.minicart.zero');
@endphp
<header class="header header--mobile">
    <div class="navigation--mobile">
        <div class="navigation__left">
            <a href="{{ route('shop.home.index') }}" class="ps-logo">
                @if ($logo = core()->getCurrentChannel()->logo_url)
                    <img class="logo" src="{{ $logo }}" alt="" />
                @else
                    <img class="logo" src="{{ bagisto_asset('images/logo_light.png') }}" alt="" />
                @endif
            </a>
        </div>
        <div class="navigation__right text-right align-items-center">
            @if (core()->getConfigData('general.content.shop.wishlist_option') == "1")
                @include('shop::layouts.particals.wishlist', ['isText' => true])
            @endif
            @guest('customer')
                <a href="{{ route('customer.session.index') }}" class="header__extra"><i class="icon-user"></i></a>
            @endguest
            @auth('customer')
                <form id="customerLogout" action="{{ route('customer.session.destroy') }}" method="POST">
                    @csrf @method('DELETE')
                </form>
                <a href="{{ route('customer.session.destroy') }}" class="header__extra" onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                    <i class="fa fa-sign-out"></i>
                </a>
            @endauth
        </div>
    </div>
    <div class="ps-search--mobile mt-2">
        <searchbar-component route="{{ route('shop.search.index') }}"></searchbar-component>
    </div>
</header>

<div class="navigation--list">
    <div class="navigation__content">
        <a class="navigation__item" onclick="open_drawer()"><i class="icon-menu"></i><span>Menu</span></a>
        {{-- <a class="navigation__item"><i class="icon-list4"></i><span>Categories</span></a> --}}
        <a class="navigation__item" href="{{ route('shop.checkout.cart.index') }}"><i class="icon-bag2"></i><span>Cart</span></a>
        <a class="navigation__item" href="{{ route('customer.profile.index') }}"><i class="icon-user"></i><span>Profile</span></a>
    </div>
</div>

<div>
    <div class="ant-drawer ant-drawer-right ps-panel--mobile d-none" id="menu-drawer" tabindex="-1">
        <div class="ant-drawer-mask"></div>
        <div tabindex="0" aria-hidden="true" data-sentinel="start" style="width: 0px; height: 0px; overflow: hidden; outline: none; position: absolute;"></div>
        <div class="ant-drawer-content-wrapper">
            <div class="ant-drawer-content" aria-modal="true" role="dialog">
                <div class="ant-drawer-wrapper-body">
                    <div class="ant-drawer-body">
                        <div class="ps-panel--wrapper">
                            <div class="ps-panel__header">
                                <h3>World Ekart Menu</h3>
                                <span class="ps-panel__close" onclick="close_drawer()"><i class="icon-cross"></i></span>
                            </div>
                            <div class="ps-panel__content">
                                <mega-menu :mobile="true"></mega-menu>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div tabindex="0" aria-hidden="true" data-sentinel="end" style="width: 0px; height: 0px; overflow: hidden; outline: none; position: absolute;"></div>
    </div>
</div>