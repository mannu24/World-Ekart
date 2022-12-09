<template>
    <div class="modal-parent scrollable">
        <div class="cd-quick-view">
            <template>
                <div class="ps-product--detail mb-3">
                    <div class="ps-product__header">
                       <div class="ps-product__thumbnail">
                            <ul class="cd-slider" type="none">
                                <carousel-component
                                    slides-per-page="1"
                                    navigation-enabled="hide"
                                    :slides-count="product.galleryImages.length">

                                        <slide
                                            :key="index"
                                            :slot="`slide-${index}`"
                                            title=" "
                                            v-for="(image, index) in product.galleryImages">

                                            <li class="selected" @click="showProductDetails = false">
                                                <img :src="image.medium_image_url" :alt="product.name" />
                                            </li>
                                        </slide>
                                </carousel-component>
                            </ul>
                        </div> 
                        <div class="ps-product__info">
                            <header>
                                <h1>{{product.name}}</h1>
                                <div class="ps-product__meta">
                                    <!-- <p v-if=" product.vendor!='' ">Seller:
                                        <a class="ml-2 text-capitalize" :href="'/shop/' + product.vendor">{{ product.vendor }}</a>
                                    </p> -->
                                    <div class="ps-product__rating" v-if="product.totalReviews && product.totalReviews > 0">
                                        <star-ratings :ratings="product.avgRating"></star-ratings>
                                        <span><a :href="`${$root.baseUrl}/reviews/${product.slug}`">
                                            {{ __('products.reviews-count', {'totalReviews': product.totalReviews}) }}
                                        </a></span>
                                    </div>
                                    <div class="ps-product__rating" v-else>
                                        <span v-text="product.firstReviewText"></span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price" v-html="product.priceHTML"></h4>
                            </header>
                            <div class="ps-product__desc">
                                <span>Description:</span><span v-html="product.shortDescription"></span>
                            </div>
                            <div class="ps-product__shopping extend pb-0">
                                <div class="ps-product__btn-group">
                                    <vnode-injector :nodes="getDynamicHTML(product.addToCartHtml)"></vnode-injector>
                                    <div class="ps-product__actions">
                                        <vnode-injector :nodes="getDynamicHTML(product.ulHtml)"></vnode-injector>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div @click="closeQuickView" class="close-btn"><i class="fas fa-times"></i></div>
            </template>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        data: function () {
            return {
                currentlyActiveImage: 0,
                showProductDetails: true,
                product: this.$root.productDetails,
            }
        },

        mounted: function () {
            $('.cd-quick-view').fadeIn(500);
            $('.compare-icon').click(this.closeQuickView);
            $('.wishlist-icon').click(this.closeQuickView);
            $('.add-to-cart-btn').click(() => setTimeout(this.closeQuickView, 0));
        },

        methods: {
            closeQuickView: function () {
                this.$root.quickView = false;
                this.$root.productDetails = [];
                $('body').toggleClass('overflow-hidden');
            },

            changeImage: function (imageIndex) {
                this.currentlyActiveImage = imageIndex;
            },
        }
    }
</script>