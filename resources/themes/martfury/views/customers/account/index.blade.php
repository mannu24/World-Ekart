@extends('shop::layouts.master')

@section('content-wrapper')
    <div class="ps-page--my-account">
        <div class="ps-breadcrumb border-bottom">
            <div class="container">
                @yield('account-breadcrumb')
            </div>
        </div>
        <section class="ps-my-account ps-page--account pb-50">
            <div class="container">
                <div class="row align-items-start">
                    @include('shop::customers.account.partials.sidemenu')
                    @yield('account-content')
                </div>
            </div>
        </section>
    </div>
@endsection
