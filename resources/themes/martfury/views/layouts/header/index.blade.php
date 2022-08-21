<?php
    $term = request()->input('term');
    $image_search = request()->input('image-search');

    if (! is_null($term)) {
        $serachQuery = 'term='.request()->input('term');
    }
?>

<header class="header header--1" data-sticky="true" id="headerSticky">
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
                <searchbar-component route="{{ route('shop.search.index') }}"></searchbar-component>
            </div>
            <div class="header__right">
                <div class="header__actions">
                    {{-- <a class="header__extra" href="/account/compare"><i class="icon-chart-bars"></i><span><i>0</i></span></a> --}}
                    {{-- <a class="header__extra" href="/account/wishlist"><i class="icon-heart"></i><span><i>0</i></span></a> --}}
                    @include('shop::partials.wishlist', ['isText' => false])
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
            <div class="navigation__left">
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
            <div class="navigation__right">
                <ul class="menu">
                    <li class="menu-item-has-children dropdown"><a href="/">Home</a>
                        <ul class="sub-menu">
                            <li class="menu-item-has-children dropdown"><a href="/">Marketplace Full Width</a>
                            </li>
                            <li class="menu-item-has-children dropdown"><a href="/home/auto-part">Home Auto
                                    Parts</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/technology">Home
                                    Technology</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/organic">Home Organic</a>
                            </li>
                            <li class="menu-item-has-children dropdown"><a href="/home/market-place">Home
                                    Marketplace V1</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/market-place-2">Home
                                    Marketplace V2</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/market-place-3">Home
                                    Marketplace V3</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/market-place-4">Home
                                    Marketplace V4</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/electronic">Home
                                    Electronic</a></li>
                            <li class="menu-item-has-children dropdown"><a href="/home/furniture">Home
                                    Furniture</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="/shop">Shop</a>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Catalog Pages</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/shop">Shop Default</a></li>
                                    <li><a href="/shop/shop-fullwidth">Shop Fullwidth</a></li>
                                    <li><a href="/shop/shop-categories">Shop Categories</a></li>
                                    <li><a href="/shop/shop-sidebar">Shop Sidebar</a></li>
                                    <li><a href="/shop/shop-sidebar-without-banner">Shop Without Banner</a></li>
                                    <li><a href="/shop/shop-carousel">Shop Carousel</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Product Layout</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/product/3">Default</a></li>
                                    <li><a href="/product/extended/7">Extended</a></li>
                                    <li><a href="/product/full-content/7">Full Content</a></li>
                                    <li><a href="/product/boxed/7">Boxed</a></li>
                                    <li><a href="/product/sidebar/7">Sidebar</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Product Types</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/product/3">Simple</a></li>
                                    <li><a href="/product/image-swatches/11">Image swatches</a></li>
                                    <li><a href="/product/countdown/10">Countdown</a></li>
                                    <li><a href="/product/affiliate/7">Affiliate</a></li>
                                    <li><a href="/product/on-sale/7">On sale</a></li>
                                    <li><a href="/product/groupped/22">Grouped</a></li>
                                    <li><a href="/product/out-of-stock/7">Out Of Stock</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Ecomerce Pages</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/account/shopping-cart">Shopping Cart</a></li>
                                    <li><a href="/account/checkout">Checkout</a></li>
                                    <li><a href="/account/wishlist">Whishlist</a></li>
                                    <li><a href="/account/compare">Compare</a></li>
                                    <li><a href="/account/order-tracking">Order Tracking</a></li>
                                    <li><a href="/account/login">My Account</a></li>
                                    <li><a href="/account/login">Login / Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="/">Pages</a>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Basic Page</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/page/about-us">About Us</a></li>
                                    <li><a href="/page/contact-us">Contact</a></li>
                                    <li><a href="/page/faqs">Faqs</a></li>
                                    <li><a href="/page/page-404">404 Page</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Vendor Pages</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/vendor/become-a-vendor">Become a Vendor</a></li>
                                    <li><a href="/store/global-office">Vendor Store</a></li>
                                    <li><a href="/stores">Store List</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item-has-children has-mega-menu"><a href="/blog">Blogs</a>
                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <h4>Blog Layout</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/blog">Grid</a></li>
                                    <li><a href="/blog/blog-small-thumbnail">Small Thumb</a></li>
                                    <li><a href="/blog/blog-left-sidebar">Left Sidebar</a></li>
                                    <li><a href="/blog/blog-right-sidebar">Right Sidebar</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu__column">
                                <h4>Single Blog</h4>
                                <ul class="mega-menu__list">
                                    <li><a href="/post/default">Single 1</a></li>
                                    <li><a href="/post/detail-2">Single 2</a></li>
                                    <li><a href="/post/detail-3">Single 3</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navigation__extra">
                    {{-- <li><a href="{{ route('become-a-vendor') }}">Sell on WorldEkart</a></li> --}}
                    <li><a href="{{ route('shop.cms.page', 'become-a-vendor') }}">Sell on WorldEkart</a></li>
                    <li><a href="{{ route('track-order') }}">Track your Order</a></li>
                    @include('shop::layouts.header.locale-currency')
                </ul>
            </div>
        </div>
    </nav>
</header>
<header class="header header--mobile">
    <div class="header__top">
        <div class="header__left">
            <p>Welcome to Martfury Online Shopping Store !</p>
        </div>
        <div class="header__right">
            <ul class="navigation__extra">
                <li><a href="/vendor/become-a-vendor">Sell on Martfury</a></li>
                <li><a href="/account/order-tracking">Tract your order</a></li>
                <li>
                    <div class="ps-dropdown"><a href="/">USD</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="/">USD</a></li>
                            <li><a href="/">EURO</a></li>
                            <li><a href="/">GBP</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="ps-dropdown language"><a href="#"><img src="../../static/img/flag/en.png"
                                alt="martfury" />English</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="#"><img src="../../static/img/flag/germany.png" alt="martfury" />Germany</a>
                            </li>
                            <li><a href="#"><img src="../../static/img/flag/fr.png" alt="martfury" />France</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="/"><img src="../../static/img/logo_light.png"
                    alt="martfury" /></a></div>
        <div class="navigation__right"><a class="header__extra" href="#"><i
                    class="icon-bag2"></i><span><i>0</i></span></a>
            <div class="header__extra"><i class="icon-user"></i></div>
        </div>
    </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="/" method="get">
            <div class="form-group--nest"><input type="text" class="form-control"
                    placeholder="Search something..." /><button><i class="icon-magnifier"></i></button></div>
        </form>
    </div>
</header>

{{-- 
<div class="header" id="header">
    <div class="header-bottom" id="header-bottom">
        @include('shop::layouts.header.nav-menu.navmenu')
    </div>
</div> --}}

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs" defer></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet" defer></script> --}}

    <script>
        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            @auth('customer')
                @php
                    $compareCount = app('Webkul\Velocity\Repositories\VelocityCustomerCompareProductRepository')
                        ->count([
                            'customer_id' => auth()->guard('customer')->user()->id,
                        ]);
                @endphp

                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html({{ $compareCount }});
            @endauth

            @guest('customer')
                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html(comparedItems ? comparedItems.length : 0);
            @endguest

            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);

                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
    </script>
@endpush