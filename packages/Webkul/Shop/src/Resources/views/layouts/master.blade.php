<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">

    <link rel="stylesheet" href="{{ bagisto_asset('css/shop.css') }}">

    @if ($favicon = core()->getCurrentChannel()->favicon_url)
    <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
    <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
    @if (! request()->is('/'))
    <meta name="description" content="{{ core()->getCurrentChannel()->description }}" />
    @endif
    @show

    @stack('css')

    {!! view_render_event('bagisto.shop.layout.head') !!}

    <style>
    {
         ! ! core()->getConfigData('general.content.custom_scripts.custom_css') ! !
    }
    </style>
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
                // this.long =  position.coords.longitude
            }
            get_loc_info()
        }

    }

    async function get_loc_info() {
        delete axios.defaults.headers.common["X-Requested-With"];
        await axios.get("https://us1.locationiq.com/v1/reverse.php?key=pk.ccd52f9f8b4fee4e363dc8cad72e1c8e&lat=" +
            localStorage.getItem('lat') + "&lon=" + localStorage.getItem('long') + "&format=json").then((
            res) => {

            var country_code = res.data.address.country_code.toUpperCase()
            // localStorage.setItem('fetched_country', country_code)
            setCookie('country', country_code, 30)
            localStorage.setItem('fetch_status', true)
            window.location.reload()
        })
    }

    function c_data() {
        alert('jhgfdg')
        if (getCookie('country') == undefined) {
            setCookie('country', 'IN', 30)
            fetch_country()

        }
    }
    window.onpaint = c_data()
    </script>

</head>


<body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif
    style="scroll-behavior: smooth;">

    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    <div id="app">
        <flash-wrapper ref='flashes'></flash-wrapper>

        <div class="main-container-wrapper">

            {!! view_render_event('bagisto.shop.layout.header.before') !!}

            @include('shop::layouts.header.index')

            {!! view_render_event('bagisto.shop.layout.header.after') !!}

            @yield('slider')

            <main class="content-container">

                {!! view_render_event('bagisto.shop.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('bagisto.shop.layout.content.after') !!}

            </main>

        </div>

        {!! view_render_event('bagisto.shop.layout.footer.before') !!}

        @include('shop::layouts.footer.footer')

        {!! view_render_event('bagisto.shop.layout.footer.after') !!}

        @if (core()->getConfigData('general.content.footer.footer_toggle'))
        <div class="footer">
            <p style="text-align: center;">
                @if (core()->getConfigData('general.content.footer.footer_content'))
                {{ core()->getConfigData('general.content.footer.footer_content') }}
                @else
                {!! trans('admin::app.footer.copy-right') !!}
                @endif
            </p>
        </div>
        @endif

        <overlay-loader :is-open="show_loader"></overlay-loader>

        <go-top bg-color="#0041ff"></go-top>
    </div>

    <script type="text/javascript">
    window.flashMessages = [];

    @if($success = session('success'))
    window.flashMessages = [{
        'type': 'alert-success',
        'message': "{{ $success }}"
    }];
    @elseif($warning = session('warning'))
    window.flashMessages = [{
        'type': 'alert-warning',
        'message': "{{ $warning }}"
    }];
    @elseif($error = session('error'))
    window.flashMessages = [{
        'type': 'alert-error',
        'message': "{{ $error }}"
    }];
    @elseif($info = session('info'))
    window.flashMessages = [{
        'type': 'alert-info',
        'message': "{{ $info }}"
    }];
    @endif

    window.serverErrors = [];

    @if(isset($errors))
    @if(count($errors))
    window.serverErrors = @json($errors - > getMessages());
    @endif
    @endif
    </script>

    <script type="text/javascript" src="{{ bagisto_asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

    @stack('scripts')

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    <div class="modal-overlay"></div>

    <script>
    $(document).ready(function() {
        console.log("ready!");
        alert("jhgghjk")
    }); {
        !!core() - > getConfigData('general.content.custom_scripts.custom_javascript') !!
    }
    </script>

</body>

</html>