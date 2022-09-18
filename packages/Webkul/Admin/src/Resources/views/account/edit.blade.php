@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.account.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <form method="POST" action="" enctype="multipart/form-data" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        {{ __('admin::app.account.title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.save') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    <input name="_method" type="hidden" value="PUT">

                    <accordian title="{{ __('admin::app.account.general') }}" :active="false">
                        <div slot="body">
                            <upload-profile-image></upload-profile-image>
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.account.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" value="{{ old('name') ?: $user->name }}"  data-vv-as="&quot;{{ __('admin::app.account.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('admin::app.account.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" value="{{ old('email') ?: $user->email }}"  data-vv-as="&quot;{{ __('admin::app.account.email') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>
                    @if (auth()->guard('admin')->user()->role_id == 2)
                        <accordian title="Store Details" :active="false">
                            <div slot="body">
                                <div :class="[errors.has('store_name') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">name</label>
                                    <input type="text" class="control" name="store_name" v-validate="'required'" value="{{ old('store_name') ?: $vendor->name }}">
                                    <span class="control-error" v-if="errors.has('store_name')">@{{ errors.first('store_name') }}</span>
                                </div>
                            
                                <div :class="[errors.has('store_email') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">email</label>
                                    <input type="email" class="control" name="store_email" v-validate="'required|email'" value="{{ old('store_email') ?: $vendor->email }}">
                                    <span class="control-error" v-if="errors.has('store_email')">@{{ errors.first('store_email') }}</span>
                                </div>
                            
                                <div :class="[errors.has('phone') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">phone</label>
                                    <input type="tel" onkeypress="validate()" maxlength="15" class="control" name="phone" v-validate="'required|numeric'" value="{{ old('phone') ?: $vendor->phone }}">
                                    <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                </div>
                            
                                <div :class="[errors.has('address') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">address</label>
                                    <input type="text" class="control" name="address" v-validate="'required'" value="{{ old('address') ?: $vendor->address }}">
                                    <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                                </div>
                            
                                <div :class="[errors.has('city') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">city</label>
                                    <input type="text" class="control" name="city" v-validate="'required'" value="{{ old('city') ?: $vendor->city }}">
                                    <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                                </div>
                            
                                <div :class="[errors.has('country') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">Country</label>
                                    <input type="text" class="control" name="country" v-validate="'required'" value="{{ old('country') ?: $vendor->country }}">
                                    <span class="control-error" v-if="errors.has('country')">@{{ errors.first('country') }}</span>
                                </div>
                            
                                <div :class="[errors.has('state') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">State</label>
                                    <input type="text" class="control" name="state" v-validate="'required'" value="{{ old('state') ?: $vendor->state }}">
                                    <span class="control-error" v-if="errors.has('state')">@{{ errors.first('state') }}</span>
                                </div>

                                <div :class="[errors.has('pincode') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">pincode</label>
                                    <input type="tel" class="control" onkeypress="validate()" maxlength="10" name="pincode" v-validate="'required'" value="{{ old('pincode') ?: $vendor->pincode }}">
                                    <span class="control-error" v-if="errors.has('pincode')">@{{ errors.first('pincode') }}</span>
                                </div>
                            
                                
                                <div :class="[errors.has('gstin') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">GSTIN</label>
                                    <input type="text" class="control" name="gstin" readonly value="{{ old('gstin') ?: $vendor->gstin }}">
                                    <span class="control-error" v-if="errors.has('gstin')">@{{ errors.first('gstin') }}</span>
                                </div>
                                
                                <div :class="[errors.has('description') ? 'has-error' : '']" class="control-group col-12">
                                    <label class="required" style="text-transform:capitalize;">Store description</label>
                                    <input type="text" class="control" name="description" v-validate="'required'" value="{{ old('description') ?: $vendor->description }}">
                                    <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                </div>
                                
                                <div :class="[errors.has('display_name') ? 'has-error' : '']" class="control-group">
                                    <label class="required" style="text-transform:capitalize;">display name</label>
                                    <input type="text" v-validate="'required'" class="control" name="display_name" value="{{ old('display_name') ?: $vendor->display_name }}">
                                    <span class="control-error" v-if="errors.has('display_name')">@{{ errors.first('display_name') }}</span>
                                </div>

                                <div :class="[errors.has('additional_notes') ? 'has-error' : '']" class="control-group col-12">
                                    <label style="text-transform:capitalize;">additional notes</label>
                                    <input type="text" class="control" name="additional_notes" value="{{ old('additional_notes') ?: $vendor->additional_notes }}">
                                    <span class="control-error" v-if="errors.has('additional_notes')">@{{ errors.first('additional_notes') }}</span>
                                </div>
                            
                                <div :class="[errors.has('facebook_link') ? 'has-error' : '']" class="control-group">
                                    <label style="text-transform:capitalize;">facebook link</label>
                                    <input type="url" v-validate="'url'" class="control" name="facebook_link" value="{{ old('facebook_link') ?: $vendor->facebook_link }}">
                                    <span class="control-error" v-if="errors.has('facebook_link')">@{{ errors.first('facebook_link') }}</span>
                                </div>
                            
                                <div :class="[errors.has('instagram_link') ? 'has-error' : '']" class="control-group">
                                    <label style="text-transform:capitalize;">instagram link</label>
                                    <input type="url" v-validate="'url'" class="control" name="instagram_link" value="{{ old('instagram_link') ?: $vendor->instagram_link }}">
                                    <span class="control-error" v-if="errors.has('instagram_link')">@{{ errors.first('instagram_link') }}</span>
                                </div>
                            
                                <div :class="[errors.has('twitter_link') ? 'has-error' : '']" class="control-group">
                                    <label style="text-transform:capitalize;">twitter link</label>
                                    <input type="url" v-validate="'url'" class="control" name="twitter_link" value="{{ old('twitter_link') ?: $vendor->twitter_link }}">
                                    <span class="control-error" v-if="errors.has('twitter_link')">@{{ errors.first('twitter_link') }}</span>
                                </div>
                            
                                <div :class="[errors.has('youtube_link') ? 'has-error' : '']" class="control-group">
                                    <label style="text-transform:capitalize;">youtube link</label>
                                    <input type="url" v-validate="'url'" class="control" name="youtube_link" value="{{ old('youtube_link') ?: $vendor->youtube_link }}">
                                    <span class="control-error" v-if="errors.has('youtube_link')">@{{ errors.first('youtube_link') }}</span>
                                </div>
                            </div>
                        </accordian>
                        <accordian title="Bank Details" :active="false">
                            <div slot="body">
                                <div class="control-group" :class="[errors.has('bank_name') ? 'has-error' : '']">
                                    <label for="bank_name" class="required">Bank Name</label>
                                    <input type="text" v-validate="'required'" class="control" id="bank_name" name="bank_name" value="{{ old('bank_name') ?: $user->bank_name }}" />
                                    <span class="control-error" v-if="errors.has('bank_name')">@{{ errors.first('bank_name') }}</span>
                                </div>
                                <div class="control-group" :class="[errors.has('ifsc_code') ? 'has-error' : '']">
                                    <label for="ifsc_code" class="required">IFSC Code</label>
                                    <input type="text" v-validate="'required'" class="control" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code') ?: $user->ifsc_code }}" />
                                    <span class="control-error" v-if="errors.has('ifsc_code')">@{{ errors.first('ifsc_code') }}</span>
                                </div>
                                <div class="control-group" :class="[errors.has('acc_no') ? 'has-error' : '']">
                                    <label for="acc_no" class="required">Account Number</label>
                                    <input type="tel" onkeypress="validate()" maxlength="25" v-validate="'required|numeric'" class="control" id="acc_no" name="acc_no" value="{{ old('acc_no') ?: $user->acc_no }}" />
                                    <span class="control-error" v-if="errors.has('acc_no')">@{{ errors.first('acc_no') }}</span>
                                </div>
                                <div class="control-group" :class="[errors.has('acc_name') ? 'has-error' : '']">
                                    <label for="acc_name" class="required">Account Holder Name</label>
                                    <input type="text" v-validate="'required'" class="control" id="acc_name" name="acc_name" value="{{ old('acc_name') ?: $user->acc_name }}" />
                                    <span class="control-error" v-if="errors.has('acc_name')">@{{ errors.first('acc_name') }}</span>
                                </div>
                                <div class="control-group" :class="[errors.has('upi_id') ? 'has-error' : '']">
                                    <label for="upi_id" class="required">UPI ID</label>
                                    <input type="text" v-validate="'required'" class="control" id="upi_id" name="upi_id" value="{{ old('upi_id') ?: $user->upi_id }}" />
                                    <span class="control-error" v-if="errors.has('upi_id')">@{{ errors.first('upi_id') }}</span>
                                </div>
                            </div>
                        </accordian>
                    @endif

                    <accordian title="{{ __('admin::app.account.change-password') }}" :active="false">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">{{ __('admin::app.account.password') }}</label>
                                <input type="password" v-validate="'min:6'" class="control" id="password" name="password" ref="password" data-vv-as="&quot;{{ __('admin::app.account.password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation">{{ __('admin::app.account.confirm-password') }}</label>
                                <input type="password" v-validate="'min:6|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('admin::app.account.confirm-password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian title="{{ __('admin::app.account.current-password') }}" :active="true">
                        <div slot="body">
                        <div class="control-group" :class="[errors.has('current_password') ? 'has-error' : '']">
                            <label for="current_password" class="required">{{ __('admin::app.account.current-password') }}</label>
                            <input type="password" v-validate="'required|min:6'" class="control" id="current_password" name="current_password" data-vv-as="&quot;{{ __('admin::app.account.current-password') }}&quot;"/>
                            <span class="control-error" v-if="errors.has('current_password')">@{{ errors.first('current_password') }}</span>
                        </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script type="text/x-template" id="upload-profile-image-template">
        <div class="form-group" style="margin-bottom: 40px;">
            <label style="display:block" class="mb-15">Store Profile Image</label>
            <div class="image-upload-brick">
                <input
                    type="file"
                    name="image"
                    id="upload-profile"
                    ref="imageInput"
                    @change="addImageView($event)"
                >

                <i class="icon upload-icon"></i>

                <img class="preview" :src="imageData" v-if="imageData.length > 0">
            </div>
            <div class="image-info-brick">
                <span class="field-info">
                    {{ __('admin::app.account.upload-image-info') }}
                </span>
            </div>

            @if ($user->image_url)
                <div style="margin-top: 10px;">
                    <input 
                        type="checkbox"
                        name="remove_image"
                    />

                    <label for="remove" class="">
                        {{ __('admin::app.account.remove-image') }}
                    </label>
                </div>      
            @endif
        </div>
    </script>
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;
            if (theEvent.type === 'paste')
                key = event.clipboardData.getData('text/plain');
            else {
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>    
    <script>
        Vue.component('upload-profile-image', {
            template: '#upload-profile-image-template',

            data: function() {
                return {
                    imageData: "{{ asset($user->image) }}",
                }
            },

            methods: {
                addImageView () {
                    var imageInput = this.$refs.imageInput;

                    if (imageInput.files && imageInput.files[0]) {
                        if (imageInput.files[0].type.includes('image/')) {
                            var reader = new FileReader();

                            reader.onload = (e) => {
                                this.imageData = e.target.result;
                            }

                            reader.readAsDataURL(imageInput.files[0]);
                        } else {
                            imageInput.value = '';

                            alert('{{ __('admin::app.account.image_upload_message') }}');
                        }
                    }
                }
            }
        });
    </script>
@endpush
