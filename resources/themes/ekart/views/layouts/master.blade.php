<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- title --}}
    <title>@yield('page_title')</title>

    {{-- meta data --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function fetch_country() {
            var fetch_status = localStorage.getItem('fetch_status')
            if (fetch_status == undefined || fetch_status == false) {

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
                function showPosition(position) {
                    localStorage.setItem('lat', position.coords.latitude)
                    localStorage.setItem('long', position.coords.longitude)
                }
                get_loc_info()
            }
        }

        async function get_loc_info() {
            const response = await fetch(
                "https://us1.locationiq.com/v1/reverse.php?key=pk.ccd52f9f8b4fee4e363dc8cad72e1c8e&lat=" +
                localStorage.getItem('lat') + "&lon=" + localStorage.getItem('long') + "&format=json");

            const myJson = await response.json(); //extract JSON from the http response
            var country_code = myJson.address.country_code.toUpperCase()
            setCookie('country', country_code, 30)
            localStorage.setItem('fetch_status', true)
            window.location.reload()
        }

        function c_data() {
            if (getCookie('country') == undefined) {
                setCookie('country', 'IN', 30)
            }
            fetch_country()
        }
        window.onpaint = c_data()

    </script>
    {!! view_render_event('bagisto.shop.layout.head') !!}

    {{-- for extra head data --}}
    @yield('head')

    {{-- seo meta data --}}
    @yield('seo')

    {{-- fav icon --}}
    @if ($favicon = core()->getCurrentChannel()->favicon_url)
    <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
    <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    {{-- all styles --}}
    @include('shop::layouts.styles')

</head>

<body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction === 'rtl') class="rtl" @endif>
    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    {{-- main app --}}
    <div id="app">
        <product-quick-view v-if="$root.quickView"></product-quick-view>

        <div class="main-container-wrapper">

            @section('body-header')
            {{-- top nav which contains currency, locale and login header --}}
            {{-- @include('shop::layouts.top-nav.index') --}}

            {!! view_render_event('bagisto.shop.layout.header.before') !!}

            {{-- primary header after top nav --}}
            @include('shop::layouts.header.index')

            {!! view_render_event('bagisto.shop.layout.header.after') !!}

            <div class="main-content-wrapper">

                {{-- secondary header --}}
                {{-- <header class="row velocity-divide-page vc-header header-shadow active">

                            mobile header
                            <div class="vc-small-screen container">
                                @include('shop::layouts.header.mobile')
                            </div>

                            desktop header
                            Down Line for sIDE BAR CATEGORY
                            @include('shop::layouts.header.desktop')

                        </header> --}}

                <div class="row no-gutters">
                    {{-- <sidebar-component
                                main-sidebar=true
                                id="sidebar-level-0"
                                url="{{ url()->to('/') }}"
                    category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
                    add-class="category-list-container pt10">
                    </sidebar-component> --}}

                    <div class="col-12 no-padding content" id="home-right-bar-container">
                        {{-- <div class="container-right row no-margin col-12 no-padding"> --}}
                        {!! view_render_event('bagisto.shop.layout.content.before') !!}

                        @yield('content-wrapper')

                        {!! view_render_event('bagisto.shop.layout.content.after') !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            @show

            <div class="container">
                {!! view_render_event('bagisto.shop.layout.full-content.before') !!}

                @yield('full-content-wrapper')

                {!! view_render_event('bagisto.shop.layout.full-content.after') !!}
            </div>
        </div>

        {{-- overlay loader --}}
        <velocity-overlay-loader></velocity-overlay-loader>

        <go-top bg-color="#fff" :radius="0" fg-color="#333" box-shadow="0px 0px 10px rgba(0, 0, 0, .2)"></go-top>
    </div>

    {{-- footer --}}
    @section('footer')
    {!! view_render_event('bagisto.shop.layout.footer.before') !!}

    @include('shop::layouts.footer.index')

    {!! view_render_event('bagisto.shop.layout.footer.after') !!}
    @show

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    {{-- alert container --}}
    <div id="alert-container"></div>
    @if (core()->getCurrentChannel()->currencies->count() > 1)
    <div class="left-corner-dropdown">
        <select class="form-control shadow text-uppercase" onchange="window.location.href = this.value"
            aria-label="Locale">
            @foreach (core()->getCurrentChannel()->currencies as $currency)
            @if (isset($searchQuery) && $searchQuery)
            <option value="?{{ $searchQuery }}&currency={{ $currency->code }}"
                {{ $currency->code == core()->getCurrentCurrencyCode() ? 'selected' : '' }}>{{ $currency->code }}
            </option>
            @else
            <option value="?currency={{ $currency->code }}"
                {{ $currency->code == core()->getCurrentCurrencyCode() ? 'selected' : '' }}>{{ $currency->code }}
            </option>
            @endif
            @endforeach
        </select>
        <div class="select-icon-container"><span class="select-icon rango-arrow-down"></span></div>
    </div>
    @endif

    {{-- all scripts --}}
    @include('shop::layouts.scripts')
</body>

</html>