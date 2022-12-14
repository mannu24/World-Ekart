@if ($cart)
    <script type="text/x-template" id="coupon-component-template">
        <form class="col-lg-6" method="post" @submit.prevent="applyCoupon">
            @csrf
            <figure>
                <figcaption> Coupon Discount </figcaption>
                <div class="form-group" :class="[error_message ? 'has-error' : '']">
                    <input type="text" class="form-control" v-model="coupon_code" name="code" placeholder="{{ __('shop::app.checkout.onepage.enter-coupon-code') }}">
                    <div class="control-error">@{{ error_message }}</div>
                </div>
                <div class="form-group">
                    <button class="ps-btn btn-small ps-btn--outline" :disabled="disable_button">{{ __('shop::app.checkout.onepage.apply-coupon') }}</button>
                </div>
            </figure>
            <div class="applied-coupon-details" v-if="applied_coupon">
                <label>{{ __('shop::app.checkout.total.coupon-applied') }}</label>
                <label class="right" style="display: inline-flex; align-items: center;">
                    <b>@{{ applied_coupon }}</b>
                    <span class="icon cross-icon" title="{{ __('shop::app.checkout.total.remove-coupon') }}" v-on:click="removeCoupon"></span>
                </label>
            </div>
        </form>
    </script>

    <script>
        Vue.component('coupon-component', {
            template: '#coupon-component-template',

            inject: ['$validator'],

            data: function() {
                return {
                    coupon_code: '',
                    error_message: '',
                    applied_coupon: "{{ $cart->coupon_code }}",
                    route_name: "{{ request()->route()->getName() }}",
                    disable_button: false,
                }
            },

            watch: {
                coupon_code: function (value) {
                    if (value != '') {
                        this.error_message = '';
                    }
                }
            },

            methods: {
                applyCoupon: function() {
                    if (! this.coupon_code.length) {
                        this.error_message = '{{ __('shop::app.checkout.total.invalid-coupon') }}';

                        return;
                    }

                    this.error_message = null;

                    this.disable_button = true;

                    let code = this.coupon_code;

                    axios
                        .post(
                            '{{ route('shop.checkout.cart.coupon.apply') }}', {code}
                        ).then(response => {
                            if (response.data.success) {
                                this.$emit('onApplyCoupon');

                                this.applied_coupon = this.coupon_code;
                                this.coupon_code = '';

                                window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                                this.$root.addFlashMessages();

                                this.redirectIfCartPage();
                            } else {
                                this.error_message = response.data.message;
                            }

                            this.disable_button = false;
                        }).catch(error => {
                            this.error_message = error.response.data.message;

                            this.disable_button = false;
                        });
                },

                removeCoupon: function () {
                    let self = this;

                    axios
                        .delete('{{ route('shop.checkout.coupon.remove.coupon') }}')
                        .then(function(response) {
                            self.$emit('onRemoveCoupon')

                            self.applied_coupon = '';

                            self.disable_button = false;

                            window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                            self.$root.addFlashMessages();

                            self.redirectIfCartPage();
                        })
                        .catch(function(error) {
                            window.flashMessages = [{'type': 'alert-error', 'message': error.response.data.message}];

                            self.$root.addFlashMessages();
                        });
                },

                redirectIfCartPage: function() {
                    if (this.route_name != 'shop.checkout.cart.index') return;

                    setTimeout(function() {
                        window.location.reload();
                    }, 700);
                }
            }
        });
    </script>
@endif