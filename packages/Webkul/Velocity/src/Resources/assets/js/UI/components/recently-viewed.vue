<template>
    <aside class="widget widget_same-brand">
        <h3 v-text="title"></h3>
        <div class="widget__content">
            <div class="ps-product" :key="index" v-for="(product, index) in recentlyViewed">
                <div class="ps-product__thumbnail">
                    <a :href="`${baseUrl}/${product.urlKey}`">
                        <img :src="product.image" :alt="product.name">
                    </a>
                </div>
                <div class="ps-product__container">
                    <div class="ps-product__content">
                        <a class="ps-product__title" :href="`${baseUrl}/${product.urlKey}`" v-text="product.name"></a>
                        <star-ratings v-if="product.rating > 0" :ratings="product.rating"></star-ratings>
                        <p class="ps-product__price" v-html="product.priceHTML"></p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
    export default {
        props: [
            'title',
            'noDataText',
            'quantity',
            'addClass',
            'addClassWrapper'
        ],

        data: function () {
            return {
                recentlyViewed: (() => {
                    let storedRecentlyViewed = window.localStorage.recentlyViewed;
                    if (storedRecentlyViewed) {
                        var slugs = JSON.parse(storedRecentlyViewed);
                        var updatedSlugs = {};

                        slugs = slugs.reverse();

                        slugs.forEach(slug => {
                            updatedSlugs[slug] = {};
                        });

                        return updatedSlugs;
                    }
                })(),
            }
        },

        created: function () {
            for (const slug in this.recentlyViewed) {
                if (slug) {
                    this.$http(`${this.baseUrl}/product-details/${slug}`)
                    .then(response => {
                        if (response.data.status) {
                            this.$set(this.recentlyViewed, response.data.details.urlKey, response.data.details);
                        } else {
                            delete this.recentlyViewed[response.data.slug];
                            this.$set(this, 'recentlyViewed', this.recentlyViewed);

                            this.$forceUpdate();
                        }
                    })
                    .catch(error => {})
                }
            }
        },
    }
</script>