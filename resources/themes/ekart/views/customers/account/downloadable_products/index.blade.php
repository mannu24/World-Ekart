@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.downloadable_products.title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.downloadable_products.title') }}</li>
    </ul>
@endsection
@section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption>{{ __('shop::app.customer.account.downloadable_products.title') }}</figcaption>
                    <div class="ps-block__content">
                        <datagrid-plus src="{{ route('customer.downloadable_products.index') }}"></datagrid-plus>
                    </div>
                </figure>
            </div>
        </div>
    </div>
@endsection