@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.address.index.page-title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.address.index.title') }}</li>
    </ul>
@endsection
@section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption>{{ __('shop::app.customer.account.address.index.title') }}</figcaption>
                    <div class="ps-block__content">
                        @if ($addresses->isEmpty())
                            <p>{{ __('shop::app.customer.account.address.index.empty') }}</p>
                        @else
                            <div class="address-holder">
                                @foreach ($addresses as $address)
                                    <div class="address-card">
                                        <div class="details">
                                            <h4 class="bold mb-3">{{ $address->first_name }} {{ $address->last_name }}</h4>
                                            <ul class="address-card-list" type="none">
                                                @if ($address->company_name)
                                                    <li><span class="bold d-inline">Company - </span>{{ $address->company_name }}</li>
                                                @endif
                                                {{-- <li>{{ $address->first_name }}</li>
                                                <li>{{ $address->last_name }}</li> --}}
                                                <li>{{ $address->address1 }}</li>
                                                <li>{{ $address->city }}</li>
                                                <li>{{ $address->state }}</li>
                                                <li>{{ core()->country_name($address->country) }} {{ $address->postcode }}</li>
                                                <li> {{ __('shop::app.customer.account.address.index.contact') }} : {{ $address->phone }}</li>
                                            </ul>
                                            <div class="control-links mt-20">
                                                <span>
                                                    <a href="{{ route('customer.address.edit', $address->id) }}" class="ps-btn btn-small">
                                                        {{ __('shop::app.customer.account.address.index.edit') }}
                                                    </a>
                                                </span>
                                                <span>
                                                    <a href="javascript:void(0);" class="ps-btn btn-danger btn-small" onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}')">
                                                        {{ __('shop::app.customer.account.address.index.delete') }}
                                                    </a>
                                                    <form id="deleteAddressForm" action="{{ route('address.delete', $address->id) }}" method="post">
                                                        @method('delete') @csrf
                                                    </form>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('customer.address.create') }}" class="ps-btn">{{ __('shop::app.customer.account.address.index.add') }}</a>
                    </div>
                </figure>
            </div>
        </div>
    </div>
    {{-- @if ($addresses->isEmpty())
        <a href="{{ route('customer.address.create') }}" class="theme-btn light unset address-button">
            {{ __('shop::app.customer.account.address.index.add') }}
        </a>
    @endif
    <div class="account-head mt-3">
        <span class="account-heading">
            {{ __('shop::app.customer.account.address.index.title') }}
        </span>

        @if (! $addresses->isEmpty())
            <span class="account-action">
                <a href="{{ route('customer.address.create') }}" class="theme-btn light unset float-right">
                    {{ __('shop::app.customer.account.address.index.add') }}
                </a>
            </span>
        @endif
    </div>
    <div class="account-table-content">
        @if ($addresses->isEmpty())
            <div>{{ __('shop::app.customer.account.address.index.empty') }}</div>
        @else
            <div class="row address-holder no-padding">
                @foreach ($addresses as $address)
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="card m-1">
                            <div class="card-body">
                                <h5 class="card-title fw6">{{ $address->first_name }} {{ $address->last_name }}</h5>

                                <ul type="none">
                                    <li>{{ $address->address1 }}</li>
                                    <li>{{ $address->city }}</li>
                                    <li>{{ $address->state }}</li>
                                    <li>{{ core()->country_name($address->country) }} {{ $address->postcode }}</li>
                                    <li>
                                        {{ __('shop::app.customer.account.address.index.contact') }} : {{ $address->phone }}
                                    </li>
                                </ul>

                                <a class="card-link" href="{{ route('customer.address.edit', $address->id) }}">
                                    {{ __('shop::app.customer.account.address.index.edit') }}
                                </a>

                                <a class="card-link" href="javascript:void(0);" onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}')">
                                    {{ __('shop::app.customer.account.address.index.delete') }}
                                </a>

                                <form id="deleteAddressForm" action="{{ route('address.delete', $address->id) }}" method="post">
                                    @method('delete')

                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div> --}}
@endsection
@push('scripts')
    <script>
        function deleteAddress(message) {
            if (! confirm(message)) {
                return;
            }

            $('#deleteAddressForm').submit();
        }
    </script>
@endpush
@if ($addresses->isEmpty())
    <style>
        a#add-address-button {
            position: absolute;
            margin-top: 92px;
        }

        .address-button {
            position: absolute;
            z-index: 1 !important;
            margin-top: 110px !important;
        }
    </style>
@endif
