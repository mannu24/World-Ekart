@extends('shop::layouts.master')

@section('page_title')
{{ __('shop::app.customer.reset-password.title')}}
@endsection

@section('content-wrapper')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('shop::app.customer.reset-password.title')}}</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form method="POST" action="{{ route('customer.reset-password.store') }}" @submit.prevent="onSubmit" class="ant-form ant-form-horizontal ps-form--account pt-50 pb-50">
                <input type="hidden" name="token" value="{{ $token }}"> {{ csrf_field() }}
                <div class="ps-tab active" id="sign-in">
                    <div class="ps-form__content">
                        <h4 class="text-center">{{ __('shop::app.customer.login-form.title')}}</h4>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="ant-form-item-control-input-content control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                                <label for="email" class="required">{{ __('shop::app.customer.reset-password.email') }}</label>
                                                <input type="email" id="email" class="ant-input form-control" name="email" v-validate="'required|email'" value="{{ old('email') }}">
                                                <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="ant-form-item-control-input-content control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                                <label for="password" class="required">{{ __('shop::app.customer.reset-password.password') }}</label>
                                                <input type="password" v-validate="'required|min:6'" class="ant-input form-control" ref="password" name="password"/>
                                                <span class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="ant-form-item-control-input-content control-group" :class="[errors.has('confirm_password') ? 'has-error' : '']">
                                                <label for="confirm_password" class="required">{{ __('shop::app.customer.reset-password.confirm-password') }}</label>
                                                <input type="password" v-validate="'required|min:6'" class="ant-input form-control" name="password_confirmation"/>
                                                <span class="control-error" v-if="errors.has('password_confirmation')" v-text="errors.first('password_confirmation')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group submit">
                            <button type="submit"class="ps-btn ps-btn--fullwidth">{{ __('shop::app.customer.login-form.button_title') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection