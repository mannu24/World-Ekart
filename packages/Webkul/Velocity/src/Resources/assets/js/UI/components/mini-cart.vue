<template>
    <div class="ps-cart--mini">
        <a class="header__extra" href="#">
            <i class="icon-bag2"></i>
            <span><i v-text="cartItems.length"></i></span>
        </a>
        <div class="ps-cart__content">
            <div class="ps-cart__items">
                <div v-if="cartItems.length != 0">
                    <div class="ps-product--cart-mobile" :key="index" v-for="(item, index) in cartItems">
                        <div class="ps-product__thumbnail">
                            <a :href="`${$root.baseUrl}/${item.url_key}`">
                                <img 
                                :src="`${item.images.medium_image_url}`" alt="Product Image">
                            </a>
                        </div>
                        <div class="ps-product__content">
                            <a class="ps-product__title" :href="`${$root.baseUrl}/${item.url_key}`" v-html="item.name"></a>
                            <p><small>
                                {{ isTaxInclusive == '1' ? item.base_total_with_tax : item.base_total }}
                                 x {{item.quantity}}
                            </small></p>
                            <a class="ps-product__remove"  @click="removeProduct(item.id)">
                                <i class="icon-cross"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <span v-else>No products in cart</span>
            </div>
            <div class="ps-cart__footer" v-if="cartItems.length != 0">
                <h3> {{ subtotalText }}:
                    <strong>{{ isTaxInclusive == '1' ? cartInformation.base_sub_total : cartInformation.base_sub_total }}</strong>
                </h3>
                <figure>
                    <a class="ps-btn" :href="viewCartRoute">{{ viewCartText }}</a>
                    <a class="ps-btn" :href="checkoutRoute" @click="checkMinimumOrder($event)">{{ checkoutText }}</a>
                </figure>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.hide {
    display: none !important;
}
</style>

<script>
export default {
    props: [
        'isTaxInclusive',
        'viewCartRoute',
        'checkoutRoute',
        'checkMinimumOrderRoute',
        'cartText',
        'viewCartText',
        'checkoutText',
        'subtotalText'
    ],

    data: function() {
        return {
            cartItems: [],
            cartInformation: []
        };
    },

    mounted: function() {
        this.getMiniCartDetails();
    },

    watch: {
        '$root.miniCartKey': function() {
            this.getMiniCartDetails();
        }
    },

    methods: {
        getMiniCartDetails: function() {
            this.$http
                .get(`${this.$root.baseUrl}/mini-cart`)
                .then(response => {
                    if (response.data.status) {
                        this.cartItems = response.data.mini_cart.cart_items;
                        this.cartInformation =
                            response.data.mini_cart.cart_details;
                    }
                })
                .catch(exception => {
                    console.log(this.__('error.something_went_wrong'));
                });
        },

        removeProduct: function(productId) {
            this.$http
                .delete(`${this.$root.baseUrl}/cart/remove/${productId}`)
                .then(response => {
                    this.cartItems = this.cartItems.filter(
                        item => item.id != productId
                    );
                    this.$root.miniCartKey++;

                    window.showAlert(
                        `alert-${response.data.status}`,
                        response.data.label,
                        response.data.message
                    );
                })
                .catch(exception => {
                    console.log(this.__('error.something_went_wrong'));
                });
        },

        checkMinimumOrder: function(e) {
            e.preventDefault();

            this.$http.post(this.checkMinimumOrderRoute).then(({ data }) => {
                if (!data.status) {
                    window.showAlert(`alert-warning`, 'Warning', data.message);
                } else {
                    window.location.href = this.checkoutRoute;
                }
            });
        }
    }
};
</script>
