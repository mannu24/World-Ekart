@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection

@section('content-wrapper')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('shop::app.customer.signup-form.title') }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ant-form ant-form-horizontal ps-form--account register pt-50 pb-50" method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">
                {{ csrf_field() }}
                <ul class="ps-tab-list">
                    <li><a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a></li>
                    <li class="active"><a href=".">{{ __('shop::app.customer.signup-form.title') }}</a></li>
                </ul>
                <div class="ps-tab active" id="register">
                    <div class="ps-form__content">
                        <h4 class="text-center">{{ __('shop::app.customer.signup-form.title_new')}}</h4>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="control-group ant-form-item-control-input-content" :class="[errors.has('first_name') ? 'has-error' : '']">
                                                <label for="first_name" class="required">{{ __('shop::app.customer.signup-form.firstname') }}</label>
                                                <input type="text" class="form-control" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                                                <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
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
                                            <div class="control-group ant-form-item-control-input-content" :class="[errors.has('last_name') ? 'has-error' : '']">
                                                <label for="last_name" class="required">{{ __('shop::app.customer.signup-form.lastname') }}</label>
                                                <input type="text" class="form-control" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                                                <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
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
                                            <div class="control-group ant-form-item-control-input-content" :class="[errors.has('email') ? 'has-error' : '']">
                                                <label for="email" class="required">{{ __('shop::app.customer.signup-form.email') }}</label>
                                                <input type="email" class="form-control" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
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
                                            <div class="control-group ant-form-item-control-input-content" :class="[errors.has('password') ? 'has-error' : '']">
                                                <label for="password" class="required">{{ __('shop::app.customer.signup-form.password') }}</label>
                                                <input type="password" class="form-control" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
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
                                            <div class="control-group ant-form-item-control-input-content" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                                <label for="password_confirmation" class="required">{{ __('shop::app.customer.signup-form.confirm_pass') }}</label>
                                                <input type="password" class="form-control" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;">
                                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <input type="checkbox" id="checkbox2" class="form-control" name="is_subscribed">
                                    <label for="checkbox2">{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</label>
                                </div>
                            </div>
                        @endif
                        <div class="form-group submit">
                            <button type="submit" class="ps-btn ps-btn--fullwidth">{{ __('shop::app.customer.signup-form.button_title') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <div class="auth-content">

    <div class="sign-up-text">
        {{ __('shop::app.customer.signup-text.account_exists') }} - <a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a>
    </div>

    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

    <form method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

        {{ csrf_field() }}

        <div class="login-form">
            <div class="login-text">{{ __('shop::app.customer.signup-form.title') }}</div> --}}




            {{-- <div class="signup-confirm" :class="[errors.has('agreement') ? 'has-error' : '']">
                <span class="checkbox">
                    <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'">
                    <label class="checkbox-view" for="checkbox2"></label>
                    <span>{{ __('shop::app.customer.signup-form.agree') }}
                        <a href="">{{ __('shop::app.customer.signup-form.terms') }}</a> & <a href="">{{ __('shop::app.customer.signup-form.conditions') }}</a> {{ __('shop::app.customer.signup-form.using') }}.
                    </span>
                </span>
                <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
            </div> --}}

            {{-- <span class="checkbox">
                <input type="checkbox" id="checkbox1" name="checkbox[]">
                <label class="checkbox-view" for="checkbox1"></label>
                Checkbox Value 1
            </span> --}}

            {{-- <div class="control-group">

                {!! Captcha::render() !!}

            </div> --}}

            {{-- @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                <div class="control-group">
                    <input type="checkbox" id="checkbox2" name="is_subscribed">
                    <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                </div>
            @endif --}}


            {{-- <button class="btn btn-primary btn-lg" type="submit">
                
            </button> --}}

        </div>
    </form>

    {{-- {!! view_render_event('bagisto.shop.customers.signup.after') !!} --}}
</div>
@endsection

@push('scripts')
{{-- 
    <script>
        $(function(){
            $(":input[name=first_name]").focus();
        });
    </script>

{!! Captcha::renderJS() !!} --}}

@endpush