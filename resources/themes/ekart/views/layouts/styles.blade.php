{{-- preloaded fonts --}}
{{-- <link rel="preload" href="{{ asset('themes/velocity/assets/fonts/font-rango/rango.ttf') . '?o0evyv' }}" as="font" crossorigin="anonymous" /> --}}
{{-- <link rel="preload" href="{{ asset('themes/ekart/assets/fonts/font-awesome/css/font-awesome.min.css') }}"/> --}}
<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
{{-- bootstrap --}}
<link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/bootstrap.min.css') }}" />

{{-- bootstrap flipped for rtl --}}
@if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction === 'rtl')
    <link href="{{ asset('themes/velocity/assets/css/bootstrap-flipped.css') }}" rel="stylesheet">
@endif

{{-- mix versioned compiled file --}}
<link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- <link rel="stylesheet" href="{{ asset(mix('/css/velocity.css', 'themes/velocity/assets')) }}" /> --}}
<link rel="stylesheet" href="{{ bagisto_asset('css/style.css') }}">
<link rel="stylesheet" href="{{ bagisto_asset('css/custom.css') }}">

{{-- extra css --}}
@stack('css')

{{-- custom css --}}
<style>
    {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
</style>
