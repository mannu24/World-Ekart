<header class="header header--1" data-sticky="true" id="headerSticky">
    <nav class="navigation">
        <div class="ps-container">
            <div class="navigation__right justify-content-end">
                <ul class="navigation__extra">
                    <li><a href="{{ route('shop.cms.page', 'become-a-vendor') }}">Sell on WorldEkart</a></li>
                    <li><a href="{{ route('track-order') }}">Track your Order</a></li>
                    @include('shop::layouts.top-nav.locale-currency')
                </ul>
            </div>
        </div>
    </nav>

    <div class="header__top">
        <div class="ps-container">
            <div class="header__left">
                <a href="{{ route('shop.home.index') }}" class="ps-logo">
                    @if ($logo = core()->getCurrentChannel()->logo_url)
                        <img class="logo" src="{{ $logo }}" alt="" />
                    @else
                        <img class="logo" src="{{ bagisto_asset('images/logo_light.png') }}" alt="" />
                    @endif
                </a>
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span>Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li><a href="/shop"><i class="icon-star"></i>Hot Promotions</a></li>
                            <li class="menu-item-has-children has-mega-menu"><a href="/shop"><i
                                        class="icon-laundry"></i>Consumer Electronic</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Electronic</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Home Audio &amp; Theathers</a></li>
                                            <li><a href="/shop">TV &amp; Videos</a></li>
                                            <li><a href="/shop">Camera, Photos &amp; Videos</a></li>
                                            <li><a href="/shop">Cellphones &amp; Accessories</a></li>
                                            <li><a href="/shop">Headphones</a></li>
                                            <li><a href="/shop">Videosgames</a></li>
                                            <li><a href="/shop">Wireless Speakers</a></li>
                                            <li><a href="/shop">Office Electronic</a></li>
                                        </ul>
                                    </div>
                                    <div class="mega-menu__column">
                                        <h4>Accessories &amp; Parts</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Digital Cables</a></li>
                                            <li><a href="/shop">Audio &amp; Video Cables</a></li>
                                            <li><a href="/shop">Batteries</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="/shop"><i class="icon-shirt"></i>Clothing &amp; Apparel</a></li>
                            <li><a href="/shop"><i class="icon-lampshade"></i>Home, Garden &amp; Kitchen</a>
                            </li>
                            <li><a href="/shop"><i class="icon-heart-pulse"></i>Health &amp; Beauty</a></li>
                            <li><a href="/shop"><i class="icon-diamond2"></i>Yewelry &amp; Watches</a></li>
                            <li class="menu-item-has-children has-mega-menu"><a href="/shop"><i
                                        class="icon-desktop"></i>Computer &amp; Technology</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Computer &amp; Technologies</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Computer &amp; Tablets</a></li>
                                            <li><a href="/shop">Laptop</a></li>
                                            <li><a href="/shop">Monitors</a></li>
                                            <li><a href="/shop">Networking</a></li>
                                            <li><a href="/shop">Drive &amp; Storages</a></li>
                                            <li><a href="/shop">Computer Components</a></li>
                                            <li><a href="/shop">Security &amp; Protection</a></li>
                                            <li><a href="/shop">Gaming Laptop</a></li>
                                            <li><a href="/shop">Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="/shop"><i class="icon-baby-bottle"></i>Babies &amp; Moms</a></li>
                            <li><a href="/shop"><i class="icon-baseball"></i>Sport &amp; Outdoor</a></li>
                            <li><a href="/shop"><i class="icon-smartphone"></i>Phones &amp; Accessories</a></li>
                            <li><a href="/shop"><i class="icon-book2"></i>Books &amp; Office</a></li>
                            <li><a href="/shop"><i class="icon-car-siren"></i>Cars &amp; Motocycles</a></li>
                            <li><a href="/shop"><i class="icon-wrench"></i>Home Improments</a></li>
                            <li><a href="/shop"><i class="icon-tag"></i>Vouchers &amp; Services</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header__center">
                {{-- @include('shop::layouts.particals.search-bar') --}}
                <searchbar-component route="{{ route('shop.search.index') }}"></searchbar-component>
            </div>
            <div class="header__right">
                <div class="header__actions">
                    {{-- <a class="header__extra" href="/account/compare"><i class="icon-chart-bars"></i><span><i>0</i></span></a> --}}
                    {{-- <a class="header__extra" href="/account/wishlist"><i class="icon-heart"></i><span><i>0</i></span></a> --}}
                    {{-- @include('shop::partials.wishlist', ['isText' => false])
                    @include('shop::checkout.cart.mini-cart') --}}
                    @include('shop::layouts.particals.wishlist', ['isText' => true])
                    @include('shop::checkout.cart.mini-cart')
                    {{-- <div class="ps-cart--mini">
                        <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items"><span>No products in cart</span></div>
                        </div>
                    </div> --}}
                    @guest('customer')
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                            <div class="ps-block__right">
                                <a href="{{ route('customer.session.index') }}">
                                    {{ __('shop::app.header.sign-in') }}
                                </a>
                                <a href="{{ route('customer.register.index') }}">
                                    {{ __('shop::app.header.sign-up') }}
                                </a>
                            </div>
                        </div>
                    @endguest
                    @auth('customer')
                        @php
                            $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                        @endphp
                        <div class="ps-block--user-account">
                            <i class="icon-user"></i>
                            <div class="ps-block__content">
                                <ul class="ps-list--arrow">
                                    <li>
                                        <a href="{{ route('customer.profile.index') }}">{{ __('shop::app.header.profile') }}</a>
                                    </li>
                                    @if ($showWishlist)
                                        <li>
                                            <a href="{{ route('customer.wishlist.index') }}">{{ __('shop::app.header.wishlist') }}</a>
                                        </li>
                                    @endif
                                    <li class="ps-block__footer">
                                        <form id="customerLogout" action="{{ route('customer.session.destroy') }}" method="POST">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="{{ route('customer.session.destroy') }}"
                                            onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                                            {{ __('shop::app.header.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="ps-container">
            {{-- <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span>Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li><a href="/shop"><i class="icon-star"></i>Hot Promotions</a></li>
                            <li class="menu-item-has-children has-mega-menu"><a href="/shop"><i
                                        class="icon-laundry"></i>Consumer Electronic</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Electronic</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Home Audio &amp; Theathers</a></li>
                                            <li><a href="/shop">TV &amp; Videos</a></li>
                                            <li><a href="/shop">Camera, Photos &amp; Videos</a></li>
                                            <li><a href="/shop">Cellphones &amp; Accessories</a></li>
                                            <li><a href="/shop">Headphones</a></li>
                                            <li><a href="/shop">Videosgames</a></li>
                                            <li><a href="/shop">Wireless Speakers</a></li>
                                            <li><a href="/shop">Office Electronic</a></li>
                                        </ul>
                                    </div>
                                    <div class="mega-menu__column">
                                        <h4>Accessories &amp; Parts</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Digital Cables</a></li>
                                            <li><a href="/shop">Audio &amp; Video Cables</a></li>
                                            <li><a href="/shop">Batteries</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="/shop"><i class="icon-shirt"></i>Clothing &amp; Apparel</a></li>
                            <li><a href="/shop"><i class="icon-lampshade"></i>Home, Garden &amp; Kitchen</a>
                            </li>
                            <li><a href="/shop"><i class="icon-heart-pulse"></i>Health &amp; Beauty</a></li>
                            <li><a href="/shop"><i class="icon-diamond2"></i>Yewelry &amp; Watches</a></li>
                            <li class="menu-item-has-children has-mega-menu"><a href="/shop"><i
                                        class="icon-desktop"></i>Computer &amp; Technology</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Computer &amp; Technologies</h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="/shop">Computer &amp; Tablets</a></li>
                                            <li><a href="/shop">Laptop</a></li>
                                            <li><a href="/shop">Monitors</a></li>
                                            <li><a href="/shop">Networking</a></li>
                                            <li><a href="/shop">Drive &amp; Storages</a></li>
                                            <li><a href="/shop">Computer Components</a></li>
                                            <li><a href="/shop">Security &amp; Protection</a></li>
                                            <li><a href="/shop">Gaming Laptop</a></li>
                                            <li><a href="/shop">Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="/shop"><i class="icon-baby-bottle"></i>Babies &amp; Moms</a></li>
                            <li><a href="/shop"><i class="icon-baseball"></i>Sport &amp; Outdoor</a></li>
                            <li><a href="/shop"><i class="icon-smartphone"></i>Phones &amp; Accessories</a></li>
                            <li><a href="/shop"><i class="icon-book2"></i>Books &amp; Office</a></li>
                            <li><a href="/shop"><i class="icon-car-siren"></i>Cars &amp; Motocycles</a></li>
                            <li><a href="/shop"><i class="icon-wrench"></i>Home Improments</a></li>
                            <li><a href="/shop"><i class="icon-tag"></i>Vouchers &amp; Services</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="navigation__right justify-content-center">
                {{-- <sidebar-header heading= "{{ __('velocity::app.menu-navbar.text-category') }}">
                    <div class="main-category fs16 unselectable fw6 left">
                        <i class="rango-view-list align-vertical-top fs18"></i>
            
                        <span class="pl5">{{ __('velocity::app.menu-navbar.text-category') }}</span>
                    </div>
                </sidebar-header> --}}
                <mega-menu></mega-menu>
                {{-- <ul class="navigation__extra">
                    <li><a href="{{ route('shop.cms.page', 'become-a-vendor') }}">Sell on WorldEkart</a></li>
                    <li><a href="{{ route('track-order') }}">Track your Order</a></li>
                    @include('shop::layouts.top-nav.locale-currency')
                </ul> --}}
            </div>
        </div>
    </nav>
</header>
{{-- <header class="sticky-header">
    <div class="row remove-padding-margin velocity-divide-page">
        <a class="left navbar-brand" href="{{ route('shop.home.index') }}" aria-label="Logo">
            <img class="logo" src="{{ core()->getCurrentChannel()->logo_url ?? asset('themes/velocity/assets/images/logo-text.png') }}" alt="" />
        </a>

        <div class="right searchbar">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    @include('velocity::shop.layouts.particals.search-bar')
                </div>

                <div class="col-lg-7 col-md-12 vc-full-screen">
                    <div class="left-wrapper">

                        {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}

                            @include('velocity::shop.layouts.particals.wishlist', ['isText' => true])

                        {!! view_render_event('bagisto.shop.layout.header.wishlist.after') !!}

                        {!! view_render_event('bagisto.shop.layout.header.compare.before') !!}

                            @include('velocity::shop.layouts.particals.compare', ['isText' => true])

                        {!! view_render_event('bagisto.shop.layout.header.compare.after') !!}

                        {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                            @include('shop::checkout.cart.mini-cart')

                        {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header> --}}

@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50) {
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })();
    </script>
@endpush
