@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.profile.index.title-new') }}</li>
    </ul>
@endsection
@push('css')
    <style>
        .account-head {
            height: 50px;
        }
    </style>
@endpush
@section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-page__content">
            <div class="ps-form--account-setting">
                <form class="ps-form__content" method="post" action="{{ route('customer.profile.store') }}" @submit.prevent="onSubmit">
                    @csrf
                    <div class="row">
                        <div class="col-12 ps-form__header">
                            <h3>{{ __('shop::app.customer.account.profile.index.tab-title') }}</h3>
                        </div>
                        <div class="col-sm-6 form-group control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <label for="first_name" class="required">{{ __('shop::app.customer.account.profile.fname') }}</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') ?? $customer->first_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;">
        
                            <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                        </div>
                        <div class="col-sm-6 form-group control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <label for="last_name" class="required">{{ __('shop::app.customer.account.profile.lname') }}</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') ?? $customer->last_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;">
        
                            <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                        </div>
                        <div class="col-sm-6 form-group control-group" :class="[errors.has('gender') ? 'has-error' : '']">
                            <label for="email" class="required">{{ __('shop::app.customer.account.profile.gender') }}</label>
                            <select name="gender" class="form-control" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.gender') }}&quot;">
                                <option value=""  @if ($customer->gender == "") selected @endif>{{ __('admin::app.customers.customers.select-gender') }}</option>
                                <option value="Other"  @if ($customer->gender == "Other") selected @endif>{{ __('shop::app.customer.account.profile.other') }}</option>
                                <option value="Male"  @if ($customer->gender == "Male") selected @endif>{{ __('shop::app.customer.account.profile.male') }}</option>
                                <option value="Female" @if ($customer->gender == "Female") selected @endif>{{ __('shop::app.customer.account.profile.female') }}</option>
                            </select>
        
                            <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                        </div>
                        <div class="col-sm-6 form-group control-group"  :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                            <label for="date_of_birth">{{ __('shop::app.customer.account.profile.dob') }}</label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') ?? $customer->date_of_birth }}" v-validate="" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.dob') }}&quot;">
        
                            <span class="control-error" v-if="errors.has('date_of_birth')">@{{ errors.first('date_of_birth') }}</span>
                        </div>
                        <div class="col-sm-6 form-group control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="required">{{ __('shop::app.customer.account.profile.email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') ?? $customer->email }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.email') }}&quot;">
        
                            <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                        </div>
                        <div class="col-sm-6 form-group control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                            <label for="phone">{{ __('shop::app.customer.account.profile.phone') }}</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $customer->phone }}" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.phone') }}&quot;">
        
                            <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                        </div>
                        <div class="col-sm-4 form-group control-group" :class="[errors.has('oldpassword') ? 'has-error' : '']">
                            <label for="password">{{ __('shop::app.customer.account.profile.opassword') }}</label>
                            <input type="password" class="form-control" name="oldpassword" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.opassword') }}&quot;" v-validate="'min:6'">
        
                            <span class="control-error" v-if="errors.has('oldpassword')">@{{ errors.first('oldpassword') }}</span>
                        </div>
                        <div class="col-sm-4 form-group control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password">{{ __('shop::app.customer.account.profile.password') }}</label>
                            <input type="password" id="password" class="form-control" name="password" ref="password" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.password') }}&quot;" v-validate="'min:6'">
        
                            <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                        </div>
                        <div class="col-sm-4 form-group control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                            <label for="password">{{ __('shop::app.customer.account.profile.cpassword') }}</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.cpassword') }}&quot;" v-validate="'min:6|confirmed:password'">
        
                            <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                        </div>
                        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                            <div class="col-sm-6 form-group control-group">
                                <input type="checkbox" id="checkbox2" name="subscribed_to_news_letter"@if (isset($customer->subscription)) value="{{ $customer->subscription->is_subscribed }}" {{ $customer->subscription->is_subscribed ? 'checked' : ''}} @endif>
                                <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group submit">
                        <button type="submit" class="ps-btn">{{ __('shop::app.customer.account.profile.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- 
    <div class="account-head mb-0">
        <span class="account-heading">
            {{ __('shop::app.customer.account.profile.index.title') }}
        </span>

        <span class="account-action">
            <a href="{{ route('customer.profile.edit') }}" class="theme-btn light unset float-right">
                {{ __('shop::app.customer.account.profile.index.edit') }}
            </a>
        </span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}

    <div class="account-table-content profile-page-content">
        <div class="table">
            <table>
                <tbody>
                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.before', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.fname') }}</td>

                        <td>{{ $customer->first_name }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.first_name.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.lname') }}</td>

                        <td>{{ $customer->last_name }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.last_name.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.gender') }}</td>

                        <td>{{ $customer->gender ?? '-' }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.gender.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.dob') }}</td>

                        <td>{{ $customer->date_of_birth ?? '-' }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.date_of_birth.after', ['customer' => $customer]) !!}

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.email') }}</td>

                        <td>{{ $customer->email }}</td>
                    </tr>

                    {!! view_render_event('bagisto.shop.customers.account.profile.view.table.after', ['customer' => $customer]) !!}
                </tbody>
            </table>
        </div>

        <button
            type="submit"
            class="theme-btn mb20" onclick="window.showDeleteProfileModal();">
            {{ __('shop::app.customer.account.address.index.delete') }}
        </button>

        <div id="deleteProfileForm" class="d-none">
            <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
                @csrf

                <modal id="deleteProfile" :is-open="modalIds.deleteProfile">
                    <h3 slot="header">
                        {{ __('shop::app.customer.account.address.index.enter-password') }}
                    </h3>

                    <i class="rango-close"></i>

                    <div slot="body">
                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="required">{{ __('admin::app.users.users.password') }}</label>

                            <input type="password" v-validate="'required|min:6'" class="control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>

                            <span class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></span>
                        </div>

                        <div class="page-action">
                            <button type="submit"  class="theme-btn mb20">
                                {{ __('shop::app.customer.account.address.index.delete') }}
                            </button>
                        </div>
                    </div>
                </modal>
            </form>
        </div>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!} --}}
@endsection

@push('scripts')
    <script>
        /**
         * Show delete profile modal.
         */
        function showDeleteProfileModal() {
            document.getElementById('deleteProfileForm').classList.remove('d-none');

            window.app.showModal('deleteProfile');
        }
    </script>
@endpush