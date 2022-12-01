<template>
    <div class="ps-product-list">
        <div class="ps-container mt-5">
            <shimmer-component v-if="isLoading"></shimmer-component>
            <template v-else-if="n_p.length > 0">
                <card-list-header :heading="'New Releases'" 
                :view-all="isCategory ? `${this.baseUrl}/${categoryDetails.url_path}` : ''">
                </card-list-header>
                <div class="row" :class="localeDirection">
                    <div class="col-md-12 carousel-products match-height">
                        <carousel-component 
                            :slides-per-page="slidesPerPage"
                            pagination-enabled="hide"
                            :id="isCategory ? `${categoryDetails.name}-carousel` : productId"
                            :locale-direction="localeDirection"
                            :slides-count="n_p.length"
                            v-if="count != 0">

                            <slide :key="index" :slot="`slide-${index}`" v-for="(product, index) in n_p">
                                <product-card-new col=false :product="product"></product-card-new>
                            </slide>
                        </carousel-component>
                    </div>
                </div>
            </template>
        </div>
        <div class="ps-container">
            <shimmer-component v-if="isLoading"></shimmer-component>
            <template v-else-if="m_p.length > 0">
                <card-list-header :heading="'Mens Fashion'" 
                :view-all="isCategory ? `${this.baseUrl}/${categoryDetails.url_path}` : ''">
                </card-list-header>
                <div class="row" :class="localeDirection">
                    <div
                        class="col-md-12 carousel-products match-height"
                        :class="showRecentlyViewed === 'true' ? 'with-recent-viewed col-lg-9' : 'without-recent-viewed col-lg-12'">
                        <carousel-component
                            :slides-per-page="slidesPerPage"
                            pagination-enabled="hide"
                            :id="isCategory ? `${categoryDetails.name}-carousel` : productId"
                            :locale-direction="localeDirection"
                            :slides-count="m_p.length"
                            v-if="count != 0">

                            <slide :key="index" :slot="`slide-${index}`" v-for="(product, index) in m_p">
                                <product-card-new col=false :product="product"></product-card-new>
                            </slide>
                        </carousel-component>
                    </div>
                </div>
            </template>
        </div>
        <div class="ps-container">
            <shimmer-component v-if="isLoading"></shimmer-component>
            <template v-else-if="w_p.length > 0">
                <card-list-header :heading="'Womens Fashion'" 
                :view-all="isCategory ? `${this.baseUrl}/${categoryDetails.url_path}` : ''">
                </card-list-header>
                <div class="row" :class="localeDirection">
                    <div
                        class="col-md-12 carousel-products match-height"
                        :class="showRecentlyViewed === 'true' ? 'with-recent-viewed col-lg-9' : 'without-recent-viewed col-lg-12'">
                        <carousel-component
                            :slides-per-page="slidesPerPage"
                            pagination-enabled="hide"
                            :id="isCategory ? `${categoryDetails.name}-carousel` : productId"
                            :locale-direction="localeDirection"
                            :slides-count="w_p.length"
                            v-if="count != 0">

                            <slide :key="index" :slot="`slide-${index}`" v-for="(product, index) in w_p">
                                <product-card-new col=false :product="product"></product-card-new>
                            </slide>
                        </carousel-component>
                    </div>
                </div>
            </template>
        </div>
        <div class="ps-container">
            <shimmer-component v-if="isLoading"></shimmer-component>
            <template v-else-if="e_p.length > 0">
                <card-list-header :heading="'Trending Electronics'" 
                :view-all="isCategory ? `${this.baseUrl}/${categoryDetails.url_path}` : ''">
                </card-list-header>
                <div class="row" :class="localeDirection">
                    <div
                        class="col-md-12 carousel-products match-height"
                        :class="showRecentlyViewed === 'true' ? 'with-recent-viewed col-lg-9' : 'without-recent-viewed col-lg-12'">
                        <carousel-component
                            :slides-per-page="slidesPerPage"
                            pagination-enabled="hide"
                            :id="isCategory ? `${categoryDetails.name}-carousel` : productId"
                            :locale-direction="localeDirection"
                            :slides-count="e_p.length"
                            v-if="count != 0">

                            <slide :key="index" :slot="`slide-${index}`" v-for="(product, index) in e_p">
                                <product-card-new col=false :product="product"></product-card-new>
                            </slide>
                        </carousel-component>
                    </div>
                </div>
            </template>
        </div>
        <div class="ps-container">
            <shimmer-component v-if="isLoading"></shimmer-component>
            <template v-else-if="a_p.length > 0">
                <card-list-header :heading="'Useful Accessories'" 
                :view-all="isCategory ? `${this.baseUrl}/${categoryDetails.url_path}` : ''">
                </card-list-header>
                <div class="row" :class="localeDirection">
                    <div
                        class="col-md-12 carousel-products match-height"
                        :class="showRecentlyViewed === 'true' ? 'with-recent-viewed col-lg-9' : 'without-recent-viewed col-lg-12'">
                        <carousel-component
                            :slides-per-page="slidesPerPage"
                            pagination-enabled="hide"
                            :id="isCategory ? `${categoryDetails.name}-carousel` : productId"
                            :locale-direction="localeDirection"
                            :slides-count="a_p.length"
                            v-if="count != 0">

                            <slide :key="index" :slot="`slide-${index}`" v-for="(product, index) in a_p">
                                <product-card-new col=false :product="product"></product-card-new>
                            </slide>
                        </carousel-component>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            count: {
                type: String,
                default: '10'
            },
            productId: {
                type: String,
                default: ''
            },
            productTitle: String,
            productRoute: String,
            localeDirection: String,
            showRecentlyViewed: {
                type: String,
                default: 'false'
            },
            recentlyViewedTitle: String,
            noDataText: String,
        },

        data: function () {
            return {
                list: false,
                isLoading: true,
                isCategory: false,
                n_p: [],
                m_p: [],
                w_p: [],
                e_p: [],
                a_p: [],
                slidesPerPage: 5,
                windowWidth: window.innerWidth,
            }
        },

        mounted: function () {
            this.$nextTick(() => {
                window.addEventListener('resize', this.onResize);
            });

            this.getProducts();
            this.setWindowWidth();
            this.setSlidesPerPage(this.windowWidth);
        },

        watch: {
            /* checking the window width */
            windowWidth(newWidth, oldWidth) {
                this.setSlidesPerPage(newWidth);
            }
        },

        methods: {
            /* fetch product collections */
            getProducts: function () {
                this.$http.get(this.productRoute)
                .then(response => {
                    let count = this.count;

                    if (response.data.status && count != 0) {
                        if (response.data.categoryProducts !== undefined) {
                            this.isCategory = true;
                            this.categoryDetails = response.data.categoryDetails;
                            this.productCollections = response.data.categoryProducts;
                        } else {
                            this.n_p = response.data.n_p;
                            this.m_p = response.data.m_p;
                            this.w_p = response.data.w_p;
                            this.e_p = response.data.e_p;
                            this.a_p = response.data.a_p;
                        }
                    } else {
                        this.productCollections = 0;
                    }

                    this.isLoading = false;
                })
                .catch(error => {
                    this.isLoading = false;
                    console.log(this.__('error.something_went_wrong'));
                })
            },

            /* waiting for element */
            waitForElement: function (selector, callback) {
                if (jQuery(selector).length) {
                    callback();
                } else {
                    setTimeout(() => {
                        this.waitForElement(selector, callback);
                    }, 100);
                }
            },

            /* setting window width */
            setWindowWidth: function () {
                let windowClass = this.getWindowClass();

                this.waitForElement(windowClass, () => {
                    this.windowWidth = $(windowClass).width();
                });
            },

            /* get window class */
            getWindowClass: function () {
                return this.showRecentlyViewed === 'true'
                    ? '.with-recent-viewed'
                    : '.without-recent-viewed';
            },

            /* on resize set window width */
            onResize: function () {
                this.windowWidth = $(this.getWindowClass()).width();
            },

            /* setting slides on the basis of window width */
            setSlidesPerPage: function (width) {
                if (width >= 1200) {
                    this.slidesPerPage = 6;
                } else if (width < 1200 && width >= 992) {
                    this.slidesPerPage = 5;
                } else if (width < 992 && width >= 822) {
                    this.slidesPerPage = 4;
                } else if (width < 822 && width >= 626) {
                    this.slidesPerPage = 3;
                } else {
                    this.slidesPerPage = 2;
                }
            }
        },

        /* removing event */
        beforeDestroy: function () {
            window.removeEventListener('resize', this.onResize);
        },
    }
</script>