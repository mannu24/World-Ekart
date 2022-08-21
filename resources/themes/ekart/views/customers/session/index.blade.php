@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('shop::app.customer.login-form.page-title') }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit" class="ant-form ant-form-horizontal ps-form--account pt-50 pb-50">
                {{ csrf_field() }}
                <ul class="ps-tab-list">
                    <li class="active"><a href=".">{{ __('shop::app.customer.signup-text.title') }}</a></li>
                    <li><a href="{{ route('customer.register.index') }}">{{ __('shop::app.customer.login-text.title') }}</a></li>
                </ul>
                <div class="ps-tab active" id="sign-in">
                    <div class="ps-form__content">
                        <h4 class="text-center">{{ __('shop::app.customer.login-form.title')}}</h4>
                        <div class="form-group">
                            <div class="ant-form-item">
                                <div class="ant-row ant-form-item-row">
                                    <div class="ant-col ant-form-item-control">
                                        <div class="ant-form-item-control-input">
                                            <div class="ant-form-item-control-input-content control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                                <label for="email" class="required">{{ __('shop::app.customer.login-form.email') }}</label>
                                                {{-- <input type="text" class="" placeholder="Username or email address" value="" id="username" /> --}}
                                                <input type="email" class="ant-input form-control" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
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
                                                <label for="password" class="required">{{ __('shop::app.customer.login-form.password') }}  </label>
                                                <input type="password" v-validate="'required|min:6'" class="ant-input form-control" id="password" name="password" data-vv-as="&quot;{{ __('shop::app.customer.login-form.password') }}&quot;" value=""/>
                                                <span class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ps-checkbox d-md-inline">
                                <input type="checkbox" onclick="myFunction()" class="form-control" id="shoPassword"/>
                                <label for="shoPassword">{{ __('shop::app.customer.login-form.show-password') }}</label>
                            </div>
                            <a href="{{ route('customer.forgot-password.create') }}" class="float-right">
                                {{ __('shop::app.customer.login-form.forgot_pass') }}  
                            </a>
                        </div>
                        <div class="mt10">
                            @if (Cookie::has('enable-resend'))
                                @if (Cookie::get('enable-resend') == true)
                                    <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                @endif
                            @endif
                        </div>
                        <div class="form-group submit">
                            <button type="submit"class="ps-btn ps-btn--fullwidth">{{ __('shop::app.customer.login-form.button_title') }}</button>
                        </div>
                    </div>
                    @if (core()->getConfigData('customer.settings.social_login.enable_facebook') || core()->getConfigData('customer.settings.social_login.enable_google'))
                        <div class="ps-form__footer">
                            <p>Connect with:</p>
                            <ul class="ps-list--social">
                                @if (core()->getConfigData('customer.settings.social_login.enable_facebook'))
                                    <li><a class="facebook" href="{{ route('customer.social-login.index', 'facebook') }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if (core()->getConfigData('customer.settings.social_login.enable_google'))
                                    <li><a class="google" href="{{ route('customer.social-login.index', 'google') }}"><i class="fa fa-google-plus"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){       
        $(":input[name=email]").focus();
    });
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
@endpush



