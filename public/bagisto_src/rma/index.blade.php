@extends('shop::customers.account.index')

@section('page_title')
    Order Returns
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li>Order Returns</li>
    </ul>
@endsection

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
                        {!! view_render_event('customer.account.rma.list.before') !!}
                            <div class="account-table-content">
                                {!! app('Webkul\RMA\DataGrids\RMAList')->render() !!}
                            </div>
                        {!! view_render_event('customer.account.rma.list.after') !!}
                    </div>
                </figure>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .account-table-content {
            margin-top: 60px;
        }
    </style>
@endpush
