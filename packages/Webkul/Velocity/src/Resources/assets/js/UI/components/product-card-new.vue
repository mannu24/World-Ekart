<template>
    <div class="ps-product ps-product-new mt-4">
        <div class="ps-product__thumbnail">
            <a :href="`${baseUrl}/${product.slug}`" :title="product.name">
                <img loading="lazy" :alt="product.name" :src="product.image || product.product_image" :data-src="product.image || product.product_image"
                :onerror="`this.src='${this.$root.baseUrl}/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'`" />
            </a>
            <span class="ps-product__badge new" v-if="product.new">{{ product.new }}</span>
            <ul class="ps-product__actions justify-content-around">
                <li>
                    <vnode-injector :nodes="getDynamicHTML(product.ulHtml)"></vnode-injector>
                </li>
                <li v-if="!isMobile()">
                    <product-quick-view-btn :quick-view-details="product"></product-quick-view-btn>
                </li>
            </ul>
        </div>
        <div class="ps-product__container">
            <!-- <a :title="product.name" :href="`${baseUrl}/${product.slug}`" class="ps-product__vendor">{{ product.brand }}</a> -->
            <div class="ps-product__vendor">{{ product.vendor }}</div>
            <div class="ps-product__content">
                <a :href="`${baseUrl}/${product.slug}`" class="ps-product__title">{{product.name}}</a>
                <div class="ps-product__rating" v-if="product.totalReviews && product.totalReviews > 0">
                    <star-ratings :ratings="product.avgRating"></star-ratings>
                    <span><a :href="`${$root.baseUrl}/reviews/${product.slug}`">
                        {{ __('products.reviews-count', {'totalReviews': product.totalReviews}) }}
                    </a></span>
                </div>
                <div class="ps-product__rating" v-else>
                    <span v-text="product.firstReviewText"></span>
                </div>
                <p class="ps-product__price" v-html="product.priceHTML"></p>
                <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>
            </div>
            <!-- <div class="ps-product__content hover">
                <a :href="`${baseUrl}/${product.slug}`" class="ps-product__title">{{product.name}}</a>
                <p class="ps-product__price" v-html="product.price"></p>
                <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>
            </div> -->
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: [
            'list',
            'product',
            'col',
        ],
        data: function () {
            return {
                'addToCart': 0,
                'addToCartHtml': '',
            }
        },

        methods: {
            'isMobile': function () {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>