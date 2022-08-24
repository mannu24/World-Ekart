<form data-vv-scope="address-form" class="custom-form">
    <div class="form-container" v-if="! this.new_billing_address">
        <accordian :active="true" :title="'{{ __('shop::app.checkout.onepage.billing-address') }}'">
            <div class="form-header" slot="header">
                <h3 class="d-inline-block font-weight-bolder">
                    {{ __('shop::app.checkout.onepage.billing-address') }}
                </h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div slot="body">
                <div class="address-container align-items-stretch row">
                    <div :key="index" class="col-lg-6 col-md-12 address-holder" v-for='(addresses, index) in this.allAddress'>
                        <div class="card">
                            <div class="align-items-baseline card-body justify-content-around row">
                                <div class="col-1">
                                    <input type="radio" name="billing[address_id]" :value="addresses.id" v-model="address.billing.address_id" 
                                        v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.billing-address') }}&quot;"
                                        @change="validateForm('address-form')" />
                                    <span class="checkmark"></span>
                                </div>
                                <div class="col-10">
                                    <h5 class="card-title font-weight-bolder" v-text="`${addresses.first_name} ${addresses.last_name}`"></h5>
                                    <ul type="none">
                                        <li v-text="addresses.address1"></li>
                                        <li v-text="addresses.city"></li>
                                        <li v-text="addresses.state"></li>
                                        <li>
                                            <span v-text="addresses.country"></span>
                                            <span v-text="addresses.postcode"></span>
                                        </li>
                                        <li>{{ __('shop::app.customer.account.address.index.contact') }} : @{{ addresses.phone }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 address-holder d-block">
                        <div class="card">
                            <div @click="validateFormAfterAction" class="card-body add-address-button">
                                <div class="cursor-pointer" @click="newBillingAddress()">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>{{ __('shop::app.checkout.onepage.new-address') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div :class="`col-12 mt-15 has-error ${errors.has('address-form.billing[address_id]') ? 'has-error' : ''}`">
                    <span class="control-error" v-if="errors.has('address-form.billing[address_id]')" v-text="errors.first('address-form.billing[address_id]')"></span>
                </div>
                @if ($cart->haveStockableItems())
                    <div class="mt-20 mb-10" v-if="address.billing.address_id">
                        <span class="ps-checkbox h4 d-inline-block">
                            <input id="billing[use_for_shipping]" class="form-control" type="checkbox" name="billing[use_for_shipping]" v-model="address.billing.use_for_shipping" @change="validateFormAfterAction" />
                            <label for="billing[use_for_shipping]">{{ __('shop::app.checkout.onepage.use_for_shipping') }}</label>
                        </span>
                    </div>
                @endif
            </div>
        </accordian>
    </div>
    <div class="form-container" v-else>
        <accordian :title="'{{ __('shop::app.checkout.onepage.billing-address') }}'" :active="true">
            <div class="form-header" slot="header">
                <h3 class="font-weight-bolder d-inline-block">
                    {{ __('shop::app.checkout.onepage.billing-address') }}
                </h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="col-12 px-0" slot="body">
                <div class="col-12 form-group text-right">
                    @auth('customer')
                        @if(count(auth('customer')->user()->addresses))
                            <a class="ps-btn btn-small" @click="backToSavedBillingAddress()">{{ __('shop::app.checkout.onepage.back') }}</a>
                        @endif
                    @endauth
                </div>            
                @include('shop::checkout.onepage.customer-new-form', ['billing' => true])
            </div>
        </accordian>
    </div>

    @if ($cart->haveStockableItems())
        <div class="form-container" v-if="! address.billing.use_for_shipping && ! this.new_shipping_address">
            <accordian :active="true" :title="'{{ __('shop::app.checkout.onepage.shipping-address') }}'">
                <div class="form-header" slot="header">
                    <h3 class="font-weight-bolder d-inline-block">
                        {{ __('shop::app.checkout.onepage.shipping-address') }}
                    </h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="address-container row align-items-stretch" slot="body">
                    <div class="col-lg-6 col-md-12 address-holder" v-for='(addresses, index) in this.allAddress'>
                        <div class="card">
                            <div class="align-items-baseline card-body justify-content-around row">
                                <div class="col-1">
                                    <input type="radio" name="shipping[address_id]" :value="addresses.id" v-model="address.shipping.address_id"
                                        v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.shipping-address') }}&quot;"
                                        @change="validateForm('address-form')" />
                                    <span class="checkmark"></span>
                                </div>
                                <div class="col-10">
                                    <h5 class="card-title font-weight-bolder" v-text="`${addresses.first_name} ${addresses.last_name}`"></h5>
                                    <ul type="none">
                                        <li v-text="addresses.address1"></li>
                                        <li v-text="addresses.city"></li>
                                        <li v-text="addresses.state"></li>
                                        <li>
                                            <span v-text="addresses.country"></span>
                                            <span v-text="addresses.postcode"></span>
                                        </li>
                                        <li>{{ __('shop::app.customer.account.address.index.contact') }} : @{{ addresses.phone }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 address-holder d-block">
                        <div class="card">
                            <div @click="validateFormAfterAction" class="card-body add-address-button">
                                <div class="cursor-pointer" @click="newShippingAddress()">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>{{ __('shop::app.checkout.onepage.new-address') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div :class="`col-12 mt-15 has-error ${errors.has('address-form.shipping[address_id]') ? 'has-error' : ''}`">
                        <span class="control-error" v-if="errors.has('address-form.shipping[address_id]')" v-text="errors.first('address-form.shipping[address_id]')"></span>
                    </div>
                </div>
            </accordian>
        </div>
        <div class="form-container" v-if="! address.billing.use_for_shipping && this.new_shipping_address">
            <accordian :active="true" :title="'{{ __('shop::app.checkout.onepage.shipping-address') }}'">
                <div class="form-header" slot="header">
                    <h3 class="font-weight-bolder d-inline-block">
                        {{ __('shop::app.checkout.onepage.shipping-address') }}
                    </h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="col-12 px-0" slot="body">
                    <div class="col-12 form-group text-right">
                        @auth('customer')
                            @if(count(auth('customer')->user()->addresses))
                                <a class="ps-btn btn-small" @click="backToSavedShippingAddress()">
                                    {{ __('shop::app.checkout.onepage.back') }}
                                </a>
                            @endif
                        @endauth
                    </div>
                    @include('shop::checkout.onepage.customer-new-form', ['shipping' => true])
                </div>
            </accordian>
        </div>
    @endif
</form>
