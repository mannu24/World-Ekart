@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.wishlist.customer-name', ['name' => $customer->name]) }}
@endsection
@section('content-wrapper')
    @inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="ps-section--account-setting">
                    <div class="ps-section__content bg-transparent pb-5">
                        <figure class="ps-block--address">
                            <figcaption class="d-flex justify-content-between">
                                {{ __('shop::app.customer.account.wishlist.customer-name', ['name' => $customer->name]) }}
                            </figcaption>
                            <div class="ps-block__content">
                                @foreach ($items as $item)
                                    @include('shop::customers.account.wishlist.wishlist-product', ['item' => $item])
                                @endforeach
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection