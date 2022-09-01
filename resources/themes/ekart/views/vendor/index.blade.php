@extends('shop::layouts.master')

@section('page_title') Seller Registration Form @endsection

@section('content-wrapper')

<div class="ps-page--my-account">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>Seller Registration Form</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form method="POST" action="{{route('shop.vendor.save')}}" enctype="multipart/form-data" class="ant-form ant-form-horizontal mw-100 ps-form--account pt-50 pb-50">
                @csrf
                <div class="ps-tab">
                    <div class="ps-form__content">
                        <accordian title="Store Details" :active="true">
                            <div class="form-header" slot="header">
                                <h3 class="h4 d-inline-block">Store Details</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div slot="body">
                                <div class="row justify-content-start">
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="text-capitalize required">name</label>
                                        <input type="text" class="form-control" name="name" v-validate="'required'" value="{{ old('name') }}">
                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('email') ? 'has-error' : '']">
                                        <label for="email" class="text-capitalize required">email</label>
                                        <input type="email" class="form-control" name="email" v-validate="'required'" value="{{ old('email') }}">
                                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('phone') ? 'has-error' : '']">
                                        <label for="phone" class="text-capitalize required">phone</label>
                                        <input type="text" class="form-control" name="phone" v-validate="'required'" value="{{ old('phone') }}">
                                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone_no') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-12" :class="[errors.has('address') ? 'has-error' : '']">
                                        <label for="address" class="text-capitalize required">address</label>
                                        <input type="text" class="form-control" name="address" v-validate="'required'" value="{{ old('address') }}">
                                        <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('city') ? 'has-error' : '']">
                                        <label for="city" class="text-capitalize required">city</label>
                                        <input type="text" class="form-control" name="city" v-validate="'required'" value="{{ old('city') }}">
                                        <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                                    </div>

                                    @include ('shop::vendor.country-state', ['countryCode' => old('country'), 'stateCode' => old('state')])

                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('pincode') ? 'has-error' : '']">
                                        <label for="pincode" class="text-capitalize required">pincode</label>
                                        <input type="text" class="form-control" name="pincode" v-validate="'required'" value="{{ old('pincode') }}">
                                        <span class="control-error" v-if="errors.has('pincode')">@{{ errors.first('pincode') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('display_name') ? 'has-error' : '']">
                                        <label for="display_name" class="text-capitalize required">display name</label>
                                        <input type="text" class="form-control" name="display_name" v-validate="'required'"
                                            value="{{ old('display_name') }}">
                                        <span class="control-error" v-if="errors.has('display_name')">@{{ errors.first('display_name') }}</span>
                                    </div>

                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('gstin') ? 'has-error' : '']">
                                        <label for="gstin" class="text-capitalize required">GSTIN</label>
                                        <input type="text" class="form-control" name="gstin" v-validate="'required'"
                                            value="{{ old('gstin') }}">
                                        <span class="control-error" v-if="errors.has('gstin')">@{{ errors.first('gstin') }}</span>
                                    </div>

                                    <div class="control-group form-group col-12" :class="[errors.has('description') ? 'has-error' : '']">
                                        <label for="description" class="text-capitalize required">Store description</label>
                                        <input type="text" class="form-control" name="description" v-validate="'required'" value="{{ old('description') }}">
                                        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-12" :class="[errors.has('additional_notes') ? 'has-error' : '']">
                                        <label for="additional_notes" class="text-capitalize required">additional notes</label>
                                        <input type="text" class="form-control" name="additional_notes" v-validate="'required'"
                                            value="{{ old('additional_notes') }}">
                                        <span class="control-error" v-if="errors.has('additional_notes')">@{{ errors.first('additional_notes') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-3" :class="[errors.has('facebook_link') ? 'has-error' : '']">
                                        <label for="facebook_link" class="text-capitalize required">facebook link</label>
                                        <input type="text" class="form-control" name="facebook_link" v-validate="'required'"
                                            value="{{ old('facebook_link') }}">
                                        <span class="control-error" v-if="errors.has('facebook_link')">@{{ errors.first('facebook_link') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-3" :class="[errors.has('instagram_link') ? 'has-error' : '']">
                                        <label for="instagram_link" class="text-capitalize required">instagram link</label>
                                        <input type="text" class="form-control" name="instagram_link" v-validate="'required'"
                                            value="{{ old('instagram_link') }}">
                                        <span class="control-error" v-if="errors.has('instagram_link')">@{{ errors.first('instagram_link') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-3" :class="[errors.has('twitter_link') ? 'has-error' : '']">
                                        <label for="twitter_link" class="text-capitalize required">twitter link</label>
                                        <input type="text" class="form-control" name="twitter_link" v-validate="'required'"
                                            value="{{ old('twitter_link') }}">
                                        <span class="control-error" v-if="errors.has('twitter_link')">@{{ errors.first('twitter_link') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-3" :class="[errors.has('youtube_link') ? 'has-error' : '']">
                                        <label for="youtube_link" class="text-capitalize required">youtube link</label>
                                        <input type="text" class="form-control" name="youtube_link" v-validate="'required'"
                                            value="{{ old('youtube_link') }}">
                                        <span class="control-error" v-if="errors.has('youtube_link')">@{{ errors.first('youtube_link') }}</span>
                                    </div>
                                </div>
                            </div>
                        </accordian>
                        {{--                     
                        <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('vat_id') ? 'has-error' : '']">
                            <label for="vat_id" class="text-capitalize required">vat id</label>
                            <input type="text" class="form-control" name="vat_id" v-validate="'required'"
                                value="{{ old('vat_id') }}">
                            <span class="control-error" v-if="errors.has('vat_id')">@{{ errors.first('vat_id') }}</span>
                        </div> --}}
                        <accordian title="Owner Details" :active="false">
                            <div class="form-header" slot="header">
                                <h3 class="h4 d-inline-block">Owner Details</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div slot="body">
                                <div class="row justify-content-start">
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('owner_name') ? 'has-error' : '']">
                                        <label for="owner_name" class="text-capitalize required">owner name</label>
                                        <input type="text" class="form-control" name="owner_name" v-validate="'required'"
                                            value="{{ old('owner_name') }}">
                                        <span class="control-error" v-if="errors.has('owner_name')">@{{ errors.first('owner_name') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('owner_email') ? 'has-error' : '']">
                                        <label for="owner_email" class="text-capitalize required">owner email</label>
                                        <input type="text" class="form-control" name="owner_email" v-validate="'required'"
                                            value="{{ old('owner_email') }}">
                                        <span class="control-error" v-if="errors.has('owner_email')">@{{ errors.first('owner_email') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('owner_phone') ? 'has-error' : '']">
                                        <label for="owner_phone" class="text-capitalize required">owner phone</label>
                                        <input type="text" class="form-control" name="owner_phone" v-validate="'required'"
                                            value="{{ old('owner_phone') }}">
                                        <span class="control-error" v-if="errors.has('owner_phone')">@{{ errors.first('owner_phone') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-12 col-lg-8" :class="[errors.has('owner_address') ? 'has-error' : '']">
                                        <label for="owner_address" class="text-capitalize required">owner address</label>
                                        <input type="text" class="form-control" name="owner_address" v-validate="'required'"
                                            value="{{ old('owner_address') }}">
                                        <span class="control-error" v-if="errors.has('owner_address')">@{{ errors.first('owner_address') }}</span>
                                    </div>
                                    
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('owner_pincode') ? 'has-error' : '']">
                                        <label for="owner_pincode" class="text-capitalize required">owner pincode</label>
                                        <input type="text" class="form-control" name="owner_pincode" v-validate="'required'"
                                            value="{{ old('owner_pincode') }}">
                                        <span class="control-error" v-if="errors.has('owner_pincode')">@{{ errors.first('owner_pincode') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group col-md-6 col-lg-4" :class="[errors.has('owner_city') ? 'has-error' : '']">
                                        <label for="owner_city" class="text-capitalize required">owner city</label>
                                        <input type="text" class="form-control" name="owner_city" v-validate="'required'"
                                            value="{{ old('owner_city') }}">
                                        <span class="control-error" v-if="errors.has('owner_city')">@{{ errors.first('owner_city') }}</span>
                                    </div>
                                
                                    @include ('shop::vendor.country-state-owner', ['owner_countryCode' => old('owner_country'), 'owner_stateCode' => old('owner_state')])
                                </div>
                            </div>
                        </accordian>

                        <accordian title="Certificate Section" :active="false">
                            <div class="form-header" slot="header">
                                <h3 class="h4 d-inline-block">Certificate Section</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div slot="body">
                                <div class="row justify-content-start">
                                    <div class="control-group form-group custom-file col-md-6 col-lg-4" :class="[errors.has('gst_certificate') ? 'has-error' : '']">
                                        <label for="gst_certificate" class="text-uppercase mr-md-5 custom-file-label" style="padding-top: 8px">gst certificate</label>
                                        <input type="file" accept="" class="custom-file-input" name="gst_certificate" v-validate="'required'"
                                            value="{{ old('gst_certificate') }}">
                                        <span class="control-error" v-if="errors.has('gst_certificate')">@{{ errors.first('gst_certificate') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group custom-file col-md-6 col-lg-4" :class="[errors.has('mca_certificate') ? 'has-error' : '']">
                                        <label for="mca_certificate" class="text-uppercase mr-md-5 custom-file-label" style="padding-top: 8px">mca certificate</label>
                                        <input type="file" accept="" class="custom-file-input" name="mca_certificate" v-validate="'required'"
                                            value="{{ old('mca_certificate') }}">
                                        <span class="control-error" v-if="errors.has('mca_certificate')">@{{ errors.first('mca_certificate') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group custom-file col-md-6 col-lg-4" :class="[errors.has('other_certificate') ? 'has-error' : '']">
                                        <label for="other_certificate" class="text-uppercase mr-md-5 custom-file-label" style="padding-top: 8px">other certificate</label>
                                        <input type="file" accept="" class="custom-file-input" name="other_certificate" v-validate="'required'"
                                            value="{{ old('other_certificate') }}">
                                        <span class="control-error" v-if="errors.has('other_certificate')">@{{ errors.first('other_certificate') }}</span>
                                    </div>
                                
                                    <div class="control-group form-group custom-file col-md-6 col-lg-4" :class="[errors.has('profile_image') ? 'has-error' : '']">
                                        <label for="profile_image" class="text-uppercase mr-md-5 custom-file-label" style="padding-top: 8px">profile image</label>
                                        <input type="file" accept="" class="custom-file-input" name="profile_image" v-validate="'required'"
                                            value="{{ old('profile_image') }}">
                                        <span class="control-error" v-if="errors.has('profile_image')">@{{ errors.first('profile_image') }}</span>
                                    </div>
                                    <div class="control-group form-group custom-file col-md-6 col-lg-4" :class="[errors.has('store_images') ? 'has-error' : '']">
                                        <label for="store_images" class="text-uppercase mr-md-5 custom-file-label" style="padding-top: 8px">store images</label>
                                        <input type="file" accept="" multiple class="custom-file-input" name="store_images[]" v-validate="'required'"
                                            value="{{ old('store_images') }}">
                                        <span class="control-error" v-if="errors.has('store_images')">@{{ errors.first('store_images') }}</span>
                                    </div>
                                </div>
                            </div>
                        </accordian>
                        <div class="control-group form-group mt-20">
                            <button type="submit" class="ps-btn">{{ __('shop::app.reviews.submit') }}</button>
                        </div>
                    </div>            
                </div>
            </form>
        </div>
    </div>
</div>

@endsection