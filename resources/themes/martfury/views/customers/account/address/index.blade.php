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
@section('account-content')
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
                                            <span class="bold">{{ auth()->guard('customer')->user()->name }}</span>
                                            <ul class="address-card-list">
                                                <li class="mt-5p">{{ $address->company_name }}</li>
                                                <li class="mt-5p">{{ $address->first_name }}</li>
                                                <li class="mt-5p">{{ $address->last_name }}</li>
                                                <li class="mt-5p">{{ $address->address1 }}</li>
                                                <li class="mt-5p">{{ $address->city }}</li>
                                                <li class="mt-5p">{{ $address->state }}</li>
                                                <li class="mt-5p">{{ core()->country_name($address->country) }} {{ $address->postcode }}</li>
                                                <li class="mt-5p"> {{ __('shop::app.customer.account.address.index.contact') }} : {{ $address->phone }}</li>
                                            </ul>
                                            <div class="control-links mt-20">
                                                <span>
                                                    <a href="{{ route('customer.address.edit', $address->id) }}" class="btn btn-outline-warning btn-lg">
                                                        {{ __('shop::app.customer.account.address.index.edit') }}
                                                    </a>
                                                </span>
                    
                                                <span>
                                                    <a href="javascript:void(0);" class="btn btn-outline-danger btn-lg" onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}')">
                                                        {{ __('shop::app.customer.account.address.index.delete') }}
                                                    </a>
                    
                                                    <form id="deleteAddressForm" action="{{ route('address.delete', $address->id) }}" method="post">
                                                        @method('delete')
                                                        
                                                        @csrf
                                                    </form>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('customer.address.create') }}" class="btn btn-lg btn-warning">{{ __('shop::app.customer.account.address.index.add') }}</a>
                    </div>
                </figure>
            </div>
        </div>
    </div>
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
