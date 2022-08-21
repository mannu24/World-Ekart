@php
    $currentCustomer = auth()->guard('customer')->user();
@endphp
@extends('shop::customers.account.index')
@section('page_title')
    {{ __('shop::app.customer.account.address.create.page-title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.address.index.title') }}</li>
    </ul>
@endsection

@section('account-content')
<div class="col-lg-9">
    <div class="ps-page__content">
        <div class="ps-form--account-setting">
            <div class="ps-form__header"><h3>{{ __('shop::app.customer.account.address.create.title') }}</h3></div>
            <form class="ps-form__content" id="customer-address-form" method="post" action="{{ route('customer.address.store') }}" @submit.prevent="onSubmit">
                @csrf
                <div class="row">
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                        <label for="first_name" class="required">{{ __('shop::app.customer.account.address.create.first_name') }}</label>
                        <input class="form-control" type="text" name="first_name" value="{{ old('first_name') ?? $currentCustomer->first_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.first_name') }}&quot;">
                        <span class="control-error" v-text="errors.first('first_name')" v-if="errors.has('first_name')"></span>
                    </div>
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                        <label for="last_name" class="required">{{ __('shop::app.customer.account.address.create.last_name') }}</label>
                        <input class="form-control" type="text" name="last_name" value="{{ old('last_name') ?? $currentCustomer->last_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.last_name') }}&quot;">
                        <span class="control-error" v-text="errors.first('last_name')" v-if="errors.has('last_name')"></span>
                    </div>
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('company_name') ? 'has-error' : '']">
                        <label for="company_name">{{ __('shop::app.customer.account.address.create.company_name') }}</label>
                        <input class="form-control" type="text" name="company_name" value="{{ old('company_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.company_name') }}&quot;">
                        <span class="control-error" v-text="errors.first('company_name')" v-if="errors.has('company_name')"></span>
                    </div>
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('city') ? 'has-error' : '']">
                        <label for="city" class="required">{{ __('shop::app.customer.account.address.create.city') }}</label>
                        <input class="form-control" type="text" name="city" value="{{ old('city') }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.city') }}&quot;">
                        <span class="control-error" v-text="errors.first('city')" v-if="errors.has('city')"></span>
                    </div>
                    @php $addresses = old('address1') ?? explode(PHP_EOL, ''); @endphp
                    <div class="col-sm-12 control-group form-group {{ $errors->has('address1.*') ? 'has-error' : '' }}">
                        <label for="address1" class="required">{{ __('shop::app.customer.account.address.create.street-address') }}</label>
                        <input class="form-control" id="address1" type="text" name="address1[]" value="{{ $addresses[0] ?? '' }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.street-address') }}&quot;">
                        <span class="control-error" v-text="'{{ $errors->first('address1.*') }}'"></span>
                    </div>
                    @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                        <div class="col-sm-12 control-group form-group" style="margin-top: -25px;">
                            @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                                <input class="form-control" id="address_{{ $i }}" type="text" name="address1[{{ $i }}]">
                            @endfor
                        </div>
                    @endif
                </div>
                @include ('shop::customers.account.address.country-state', ['countryCode' => old('country'), 'stateCode' => old('state')])
                <div class="row">
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('postcode') ? 'has-error' : '']">
                        <label for="postcode" class="{{ core()->isPostCodeRequired() ? 'required' : '' }}">{{ __('shop::app.customer.account.address.create.postcode') }}</label>
                        <input class="form-control" type="text" name="postcode" value="{{ old('postcode') }}" v-validate="'{{ core()->isPostCodeRequired() ? 'required' : '' }}'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.postcode') }}&quot;">
                        <span class="control-error" v-text="errors.first('postcode')" v-if="errors.has('postcode')"></span>
                    </div>
                    <div class="col-sm-6 control-group form-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone" class="required">{{ __('shop::app.customer.account.address.create.phone') }}</label>
                        <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.phone') }}&quot;">
                        <span class="control-error" v-text="errors.first('phone')" v-if="errors.has('phone')"></span>
                    </div>
                    <div class="col-sm-6 control-group form-group">
                        <span class="checkbox">
                            <input class="form-control" id="default_address" type="checkbox" name="default_address" {{ old('default_address') ? 'checked' : '' }} >
                            <label class="checkbox-view" for="default_address"></label>
                            {{ __('shop::app.customer.account.address.default-address') }}
                        </span>
                    </div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="ps-btn">{{ __('shop::app.customer.account.address.create.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
