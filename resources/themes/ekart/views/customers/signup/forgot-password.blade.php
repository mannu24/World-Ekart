@extends('shop::layouts.master')

@section('page_title')
{{ __('velocity::app.customer.forget-password.forgot-password')}}
@endsection

@section('content-wrapper')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('velocity::app.customer.forget-password.forgot-password')}}</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account min-vh-auto">
        <div class="container">
            <form method="POST" action="{{ route('customer.forgot-password.store') }}" @submit.prevent="onSubmit" class="ant-form ant-form-horizontal ps-form--account pt-100 pb-100 register">
                {{ csrf_field() }}
                <div class="ps-tab active" id="sign-in">
                    <div class="ps-form__content">
                        <h4>{{ __('velocity::app.customer.forget-password.recover-password')}}</h4>
                        <p>{{ __('velocity::app.customer.forget-password.recover-password-text')}}</p>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="ant-form-item-control-input-content control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                                <label for="email" class="required">{{ __('shop::app.customer.forgot-password.email') }}</label>
                                                <input type="email" class="ant-input form-control" name="email" v-validate="'required|email'">
                                                <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group submit">
                            <button type="submit"class="ps-btn ps-btn--fullwidth">{{ __('shop::app.customer.forgot-password.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')

{!! Captcha::renderJS() !!}

@endpush