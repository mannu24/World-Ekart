<template>
    <a class="header__extra" :href="src">
        <i class="icon-heart"></i>
        <!-- <span v-if="wishlistCount > 0"><i v-text="wishlistCount"></i></span> -->
        <span><i v-text="wishlistCount"></i></span>
        <span v-text="__('header.wishlist')" v-if="isText == 'true'"></span>
    </a>
</template>

<script type="text/javascript">
export default {
    props: ['isCustomer', 'isText', 'src'],

    data: function() {
        return {
            wishlistCount: 0
        };
    },

    watch: {
        '$root.headerItemsCount': function() {
            this.updateHeaderItemsCount();
        }
    },

    created: function() {
        this.updateHeaderItemsCount();
    },

    methods: {
        updateHeaderItemsCount: function() {
            if (this.isCustomer == 'true') {
                this.$http
                    .get(`${this.$root.baseUrl}/items-count`)
                    .then(response => {
                        this.wishlistCount =
                            response.data.wishlistedProductsCount;
                    })
                    .catch(exception => {
                        console.log(this.__('error.something_went_wrong'));
                    });
            }
        }
    }
};
</script>
