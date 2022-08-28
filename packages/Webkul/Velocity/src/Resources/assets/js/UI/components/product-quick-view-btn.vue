<template>
    <a href="#" id="quick-view-btn-container" title="Quick View Product" data-toggle="tooltip" data-placement="top" @click="openQuickView({event: $event})"><i class="fa fa-search-plus"></i></a>
</template>

<script type="text/javascript">
    export default {
        props: ['quickViewDetails'],

        methods: {
            openQuickView: function ({event}) {
                event.preventDefault();
                event.stopPropagation();
                this.$root.quickView = true;
                this.$root.productDetails = this.quickViewDetails;
                $('body').toggleClass('overflow-hidden');
            },
        }
    }
</script>