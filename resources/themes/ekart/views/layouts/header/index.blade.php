<header class="header header--1" id="headerSticky">
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
                <mega-menu :mobile="false" :vertical="true"></mega-menu>
            </div>
            <div class="header__center">
                <searchbar-component route="{{ route('shop.search.index') }}"></searchbar-component>
            </div>
            <div class="header__right">
                <div class="header__actions">
                    @include('shop::layouts.particals.wishlist', ['isText' => true])
                    @include('shop::checkout.cart.mini-cart')
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
            <div class="navigation__right justify-content-center">
                <mega-menu :mobile="false" :vertical="false"></mega-menu>
            </div>
        </div>
    </nav>
</header>
@include('shop::layouts.header.mobile')
@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50) {
                    document.querySelector('#headerSticky').classList.add('header-shadow','header--sticky');
                } else {
                    document.querySelector('#headerSticky').classList.remove('header-shadow','header--sticky');
                }
            });
        })();

        function open_drawer() {
            $('#menu-drawer').removeClass('d-none').addClass('ant-drawer-open') ;
        }
        function close_drawer() {
            $('#menu-drawer').addClass('d-none').removeClass('ant-drawer-open') ;
        }

    </script>
@endpush
