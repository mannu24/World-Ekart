<template>
    <div :class="`ps-rating fs${size ? size : '16'} ${ pushClass ? pushClass : '' }`">
        <input v-if="editable" type="number" :value="showFilled" name="rating" class="d-none"/>
        <i :class="`fa fa-star ${editable ? 'cursor-pointer' : ''}`" 
            v-for="(rating, index) in parseInt(showFilled != 'undefined' ? showFilled : 3)" 
            :key="`${index}${Math.random()}`" 
            @click="updateRating(index + 1)"></i>
        <template v-if="!hideBlank">
            <i :class="`fa-star-o fa ${editable ? 'cursor-pointer' : ''}`" 
                v-for="(blankStar, index) in 5 -(showFilled != 'undefined' ? showFilled : 3)"
                :key="`${index}${Math.random()}`" @click="updateRating(showFilled + index + 1)"></i>
        </template>
    </div>
</template>

<style lang="scss">
.ps-rating .fa {
    font-size: 16px;
}
.ps-rating.fs24 .fa {
    font-size: 24px;
}
@media only screen and (max-width: 420px) {
    .ps-rating .fa {
        font-size: 18px;
    }
}

/**
 * Font size 12px till 322px screen width.
 */
@media only screen and (max-width: 322px) {
    .ps-rating .fa {
        font-size: 12px;
    }
}
</style>

<script type="text/javascript">
export default {
    props: ['size', 'ratings', 'editable', 'hideBlank', 'pushClass'],

    data: function () {
        return {
            showFilled: Math.round(this.ratings),
        };
    },

    methods: {
        updateRating: function (index) {
            index = Math.abs(index);
            this.editable ? (this.showFilled = index) : '';
        },
    },
};
</script>
