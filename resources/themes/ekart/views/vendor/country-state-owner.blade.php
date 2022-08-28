<country-state-owner></country-state-owner>

@push('scripts')
    <script type="text/x-template" id="country-state-owner-template">
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 control-group form-group" :class="[errors.has('owner_country') ? 'has-error' : '']">
                    <label for="owner_country" class="{{ core()->isCountryRequired() ? 'required' : '' }}">
                        {{ __('shop::app.customer.account.address.create.country') }}
                    </label>
                    <select class="form-control" id="owner_country" type="text" name="owner_country" v-model="owner_country" v-validate="'{{ core()->isCountryRequired() ? 'required' : '' }}'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.country') }}&quot;">
                        <option value=""></option>
                        @foreach (core()->countries() as $country)
                            <option  value="{{ $country->code }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <span class="control-error" v-text="errors.first('owner_country')" v-if="errors.has('owner_country')"></span>
                </div>
                <div class="col-12 col-md-6 col-lg-6 control-group form-group" :class="[errors.has('owner_state') ? 'has-error' : '']">
                    <label for="owner_state" class="{{ core()->isStateRequired() ? 'required' : '' }}">
                        {{ __('shop::app.customer.account.address.create.state') }}
                    </label>
                    <input class="form-control" id="owner_state" type="text" name="owner_state" v-model="owner_state" v-validate="'{{ core()->isStateRequired() ? 'required' : '' }}'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;" v-if="! haveStates()"/>
                    <select class="form-control" id="owner_state" name="owner_state" v-model="owner_state" v-validate="'{{ core()->isStateRequired() ? 'required' : '' }}'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;" v-if="haveStates()">
                        <option value="">{{ __('shop::app.customer.account.address.create.select-state') }}</option>
                        <option v-for='(state, index) in countryStates[owner_country]' :value="state.code">
                            @{{ state.default_name }}
                        </option>
                    </select>
                    <span class="control-error" v-if="errors.has('owner_state')">@{{ errors.first('owner_state') }}</span>
                </div>
            </div>
        </div>
    </script>
    <script>
        Vue.component('country-state-owner', {
            template: '#country-state-owner-template',

            inject: ['$validator'],

            data: function () {
                return {
                    owner_country: "{{ $owner_countryCode ?? '' }}",

                    owner_state: "{{ $owner_stateCode }}",

                    countryStates: @json(core()->groupedStatesByCountries())
                }
            },

            methods: {
                haveStates: function () {
                    if (this.countryStates[this.owner_country] && this.countryStates[this.owner_country].length)
                        return true;

                    return false;
                },
            }
        });
    </script>
@endpush