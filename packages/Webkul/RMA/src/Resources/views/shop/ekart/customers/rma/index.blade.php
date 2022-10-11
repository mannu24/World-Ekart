@extends('shop::customers.account.index')

@section('page_title')
    Order Returns
@endsection

@if (auth()->guard('customer')->user())
    @section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption class="d-flex justify-content-between mb-3">
                        Customer Order Returns
                        <a 
                            @if(auth()->guard('customer')->user())
                                href="{{ route('rma.customers.guestcreaterma') }}"
                            @else
                                href="{{ route('rma.customers.create') }}"
                            @endif
                        class="ps-btn btn-small">Request New Return</a>
                    </figcaption>
                    <div class="ps-block__content">
                    </div>
                </figure>
            </div>
        </div>
    </div>
@else
    @section('content-wrapper')
        <div class="account-content row no-margin velocity-divide-page">
            <div class="account-layout full-width mt10">
@endif

    <div class="account-head mb-20">
        <h1 class="account-heading display-inbl">
            {{ __('rma::app.shop.customer-rma-index.heading') }}
        </h1>
        
        <a
            @if(auth()->guard('customer')->user())
                href="{{ route('rma.customers.guestcreaterma') }}"
            @else
                href="{{ route('rma.customers.create') }}"
            @endif
            class="theme-btn remove-decoration float-right">
            {{ __('rma::app.shop.customer-rma-index.create') }}
        </a>
    </div>

    {!! view_render_event('customer.account.rma.list.before') !!}
        <div class="account-table-content">

            {!! app('Webkul\RMA\DataGrids\RMAList')->render() !!}

        </div>
    {!! view_render_event('customer.account.rma.list.after') !!}

@if (! auth()->guard('customer')->user())
    </div>
</div>
@endif

@endsection

@push('css')
    <style>
        .account-table-content {
            margin-top: 60px;
        }
    </style>
@endpush
