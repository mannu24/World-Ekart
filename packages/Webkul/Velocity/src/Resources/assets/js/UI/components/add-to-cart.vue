<template>
    <form method="POST" @submit.prevent="addToCart" class="d-flex justify-content-center">
        <a :href="wishlistMoveRoute" :disabled="isButtonEnable == 'false' || isButtonEnable == false" :class="`ps-btn ${addClassToBtn} ${detail_mobile}`" v-if="moveToCart">
            <i class="fa fa-shopping-cart pr-2" v-if="showCartIcon"></i>
            {{btnText}}
        </a>
        <button type="submit" :disabled="isButtonEnable == 'false' || isButtonEnable == false" :class="`ps-btn ${addClassToBtn} ${detail_mobile}`" v-else >
            <i class="fa fa-shopping-cart pr-2" v-if="showCartIcon"></i>
            {{btnText}}
        </button>
    </form>
</template>

<script>
    export default {
        props: [
            'form',
            'detail_mobile',
            'btnText',
            'isEnable',
            'csrfToken',
            'productId',
            'reloadPage',
            'moveToCart',
            'wishlistMoveRoute',
            'showCartIcon',
            'addClassToBtn',
            'productFlatId',
        ],

        data: function () {
            return {
                'isButtonEnable': this.isEnable,
                'qtyText': this.__('checkout.qty'),
            }
        },

        methods: {
            'addToCart': function () {
                this.isButtonEnable = false;
                let url = `${this.$root.baseUrl}/cart/add`;

                this.$http.post(url, {
                    'quantity': 1,
                    'product_id': this.productId,
                    '_token': this.csrfToken.split("&#039;").join(""),
                })
                .then(response => {
                    this.isButtonEnable = true;

                    if (response.data.status == 'success') {
                        this.$root.miniCartKey++;

                        window.showAlert(`alert-success`, this.__('shop.general.alert.success'), response.data.message);

                        if (this.reloadPage == "1") {
                            window.location.reload();
                        }
                    } else {

                        if (response.data.redirectionRoute) {
                            window.location.href = response.data.redirectionRoute;
                        }
                    }
                })
                .catch(error => {
                    console.log(this.__('error.something_went_wrong'));
                })
            },
        }
    }
</script>