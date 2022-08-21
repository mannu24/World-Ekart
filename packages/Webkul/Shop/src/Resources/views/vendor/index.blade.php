@extends('shop::layouts.master')

@section('page_title')
{{ __('shop::app.search.page-title') }}
@endsection

@section('content-wrapper')



<form method="POST" action="{{route('shop.vendor.save')}}" enctype="multipart/form-data">
    @csrf

    <div class="heading mt-10 mb-25">
        <span>{{ __('shop::app.vendor.register-store') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
        <label for="name" class="required">
            {{ __('shop::app.vendor.name') }}
        </label>
        <input type="text" class="control" name="name" v-validate="'required'" value="{{ old('name') }}">
        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
        <label for="email" class="required">
            {{ __('shop::app.vendor.email') }}
        </label>
        <input type="email" class="control" name="email" v-validate="'required'" value="{{ old('email') }}">
        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
        <label for="phone" class="required">
            {{ __('shop::app.vendor.phone') }}
        </label>
        <input type="text" class="control" name="phone" v-validate="'required'" value="{{ old('phone') }}">
        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone_no') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
        <label for="address" class="required">
            {{ __('shop::app.vendor.address') }}
        </label>
        <input type="text" class="control" name="address" v-validate="'required'" value="{{ old('address') }}">
        <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
        <label for="city" class="required">
            {{ __('shop::app.vendor.city') }}
        </label>
        <input type="text" class="control" name="city" v-validate="'required'" value="{{ old('city') }}">
        <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('state') ? 'has-error' : '']">
        <label for="state" class="required">
            {{ __('shop::app.vendor.state') }}
        </label>
        <input type="text" class="control" name="state" v-validate="'required'" value="{{ old('state') }}">
        <span class="control-error" v-if="errors.has('state')">@{{ errors.first('state') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('country') ? 'has-error' : '']">
        <label for="country" class="required">
            {{ __('shop::app.vendor.country') }}
        </label>
        <input type="text" class="control" name="country" v-validate="'required'" value="{{ old('country') }}">
        <span class="control-error" v-if="errors.has('country')">@{{ errors.first('country') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('pincode') ? 'has-error' : '']">
        <label for="pincode" class="required">
            {{ __('shop::app.vendor.pincode') }}
        </label>
        <input type="text" class="control" name="pincode" v-validate="'required'" value="{{ old('pincode') }}">
        <span class="control-error" v-if="errors.has('pincode')">@{{ errors.first('pincode') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('display_name') ? 'has-error' : '']">
        <label for="display_name" class="required">
            {{ __('shop::app.vendor.display_name') }}
        </label>
        <input type="text" class="control" name="display_name" v-validate="'required'"
            value="{{ old('display_name') }}">
        <span class="control-error" v-if="errors.has('display_name')">@{{ errors.first('display_name') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
        <label for="description" class="required">
            {{ __('shop::app.vendor.description') }}
        </label>
        <input type="text" class="control" name="description" v-validate="'required'" value="{{ old('description') }}">
        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('additional_notes') ? 'has-error' : '']">
        <label for="additional_notes" class="required">
            {{ __('shop::app.vendor.additional_notes') }}
        </label>
        <input type="text" class="control" name="additional_notes" v-validate="'required'"
            value="{{ old('additional_notes') }}">
        <span class="control-error" v-if="errors.has('additional_notes')">@{{ errors.first('additional_notes') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('facebook_link') ? 'has-error' : '']">
        <label for="facebook_link" class="required">
            {{ __('shop::app.vendor.facebook_link') }}
        </label>
        <input type="text" class="control" name="facebook_link" v-validate="'required'"
            value="{{ old('facebook_link') }}">
        <span class="control-error" v-if="errors.has('facebook_link')">@{{ errors.first('facebook_link') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('instagram_link') ? 'has-error' : '']">
        <label for="instagram_link" class="required">
            {{ __('shop::app.vendor.instagram_link') }}
        </label>
        <input type="text" class="control" name="instagram_link" v-validate="'required'"
            value="{{ old('instagram_link') }}">
        <span class="control-error" v-if="errors.has('instagram_link')">@{{ errors.first('instagram_link') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('twitter_link') ? 'has-error' : '']">
        <label for="twitter_link" class="required">
            {{ __('shop::app.vendor.twitter_link') }}
        </label>
        <input type="text" class="control" name="twitter_link" v-validate="'required'"
            value="{{ old('twitter_link') }}">
        <span class="control-error" v-if="errors.has('twitter_link')">@{{ errors.first('twitter_link') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('youtube_link') ? 'has-error' : '']">
        <label for="youtube_link" class="required">
            {{ __('shop::app.vendor.youtube_link') }}
        </label>
        <input type="text" class="control" name="youtube_link" v-validate="'required'"
            value="{{ old('youtube_link') }}">
        <span class="control-error" v-if="errors.has('youtube_link')">@{{ errors.first('youtube_link') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('gstin') ? 'has-error' : '']">
        <label for="gstin" class="required">
            {{ __('shop::app.vendor.gstin') }}
        </label>
        <input type="text" class="control" name="gstin" v-validate="'required'"
            value="{{ old('gstin') }}">
        <span class="control-error" v-if="errors.has('gstin')">@{{ errors.first('gstin') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('vat_id') ? 'has-error' : '']">
        <label for="vat_id" class="required">
            {{ __('shop::app.vendor.vat_id') }}
        </label>
        <input type="text" class="control" name="vat_id" v-validate="'required'"
            value="{{ old('vat_id') }}">
        <span class="control-error" v-if="errors.has('vat_id')">@{{ errors.first('vat_id') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_name') ? 'has-error' : '']">
        <label for="owner_name" class="required">
            {{ __('shop::app.vendor.owner_name') }}
        </label>
        <input type="text" class="control" name="owner_name" v-validate="'required'"
            value="{{ old('owner_name') }}">
        <span class="control-error" v-if="errors.has('owner_name')">@{{ errors.first('owner_name') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_email') ? 'has-error' : '']">
        <label for="owner_email" class="required">
            {{ __('shop::app.vendor.owner_email') }}
        </label>
        <input type="text" class="control" name="owner_email" v-validate="'required'"
            value="{{ old('owner_email') }}">
        <span class="control-error" v-if="errors.has('owner_email')">@{{ errors.first('owner_email') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_phone') ? 'has-error' : '']">
        <label for="owner_phone" class="required">
            {{ __('shop::app.vendor.owner_phone') }}
        </label>
        <input type="text" class="control" name="owner_phone" v-validate="'required'"
            value="{{ old('owner_phone') }}">
        <span class="control-error" v-if="errors.has('owner_phone')">@{{ errors.first('owner_phone') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_address') ? 'has-error' : '']">
        <label for="owner_address" class="required">
            {{ __('shop::app.vendor.owner_address') }}
        </label>
        <input type="text" class="control" name="owner_address" v-validate="'required'"
            value="{{ old('owner_address') }}">
        <span class="control-error" v-if="errors.has('owner_address')">@{{ errors.first('owner_address') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_city') ? 'has-error' : '']">
        <label for="owner_city" class="required">
            {{ __('shop::app.vendor.owner_city') }}
        </label>
        <input type="text" class="control" name="owner_city" v-validate="'required'"
            value="{{ old('owner_city') }}">
        <span class="control-error" v-if="errors.has('owner_city')">@{{ errors.first('owner_city') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_state') ? 'has-error' : '']">
        <label for="owner_state" class="required">
            {{ __('shop::app.vendor.owner_state') }}
        </label>
        <input type="text" class="control" name="owner_state" v-validate="'required'"
            value="{{ old('owner_state') }}">
        <span class="control-error" v-if="errors.has('owner_state')">@{{ errors.first('owner_state') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_country') ? 'has-error' : '']">
        <label for="owner_country" class="required">
            {{ __('shop::app.vendor.owner_country') }}
        </label>
        <input type="text" class="control" name="owner_country" v-validate="'required'"
            value="{{ old('owner_country') }}">
        <span class="control-error" v-if="errors.has('owner_country')">@{{ errors.first('owner_country') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('owner_pincode') ? 'has-error' : '']">
        <label for="owner_pincode" class="required">
            {{ __('shop::app.vendor.owner_pincode') }}
        </label>
        <input type="text" class="control" name="owner_pincode" v-validate="'required'"
            value="{{ old('owner_pincode') }}">
        <span class="control-error" v-if="errors.has('owner_pincode')">@{{ errors.first('owner_pincode') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('gst_certificate') ? 'has-error' : '']">
        <label for="gst_certificate" class="required">
            {{ __('shop::app.vendor.gst_certificate') }}
        </label>
        <input type="file" accept="" class="control" name="gst_certificate" v-validate="'required'"
            value="{{ old('gst_certificate') }}">
        <span class="control-error" v-if="errors.has('gst_certificate')">@{{ errors.first('gst_certificate') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('mca_certificate') ? 'has-error' : '']">
        <label for="mca_certificate" class="required">
            {{ __('shop::app.vendor.mca_certificate') }}
        </label>
        <input type="file" accept="" class="control" name="mca_certificate" v-validate="'required'"
            value="{{ old('mca_certificate') }}">
        <span class="control-error" v-if="errors.has('mca_certificate')">@{{ errors.first('mca_certificate') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('other_certificate') ? 'has-error' : '']">
        <label for="other_certificate" class="required">
            {{ __('shop::app.vendor.other_certificate') }}
        </label>
        <input type="file" accept="" class="control" name="other_certificate" v-validate="'required'"
            value="{{ old('other_certificate') }}">
        <span class="control-error" v-if="errors.has('other_certificate')">@{{ errors.first('other_certificate') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('profile_image') ? 'has-error' : '']">
        <label for="profile_image" class="required">
            {{ __('shop::app.vendor.profile_image') }}
        </label>
        <input type="file" accept="" class="control" name="profile_image" v-validate="'required'"
            value="{{ old('profile_image') }}">
        <span class="control-error" v-if="errors.has('profile_image')">@{{ errors.first('profile_image') }}</span>
    </div>

    <div class="control-group" :class="[errors.has('store_images') ? 'has-error' : '']">
        <label for="store_images" class="required">
            {{ __('shop::app.vendor.store_images') }}
        </label>
        <input type="file" accept="" multiple class="control" name="store_images[]" v-validate="'required'"
            value="{{ old('store_images') }}">
        <span class="control-error" v-if="errors.has('store_images')">@{{ errors.first('store_images') }}</span>
    </div>

    <button type="submit" class="btn btn-lg btn-primary">
        {{ __('shop::app.reviews.submit') }}
    </button>

</form>


@endsection