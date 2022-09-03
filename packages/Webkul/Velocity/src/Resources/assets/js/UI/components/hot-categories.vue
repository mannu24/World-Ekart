<template>
    <div class="ps-product-list">
        <div class="ps-container">
            <card-list-header :heading="heading"></card-list-header>
            <div class="row">
            </div>
            <div class="row mt-4">
                <div class="col-md-12 no-padding carousel-products">
                    <carousel-component :slides-per-page="5" :slides-count="categories.length">
                        <slide :slot="`slide-${index}`" v-for="(category, index) in categories.slice(0,5)" :key="index">
                            <hot-category :cat="category"></hot-category>
                        </slide>
                    </carousel-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['heading', 'categories']
};
</script>
