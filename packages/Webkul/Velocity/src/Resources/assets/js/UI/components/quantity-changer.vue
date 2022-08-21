<template>
    <div :class="`form-group--number quantity control-group ${errors.has(controlName) ? 'has-error' : ''}`">
        <button class="up" @click="increaseQty()">+</button>
        <button class="down" @click="decreaseQty()">-</button>
        <input ref="quantityChanger" :name="controlName" :model="qty" class="form-control" id="quantity-changer" v-validate="validations" :data-vv-as="`&quot;${quantityText}&quot;`" @keyup="setQty($event)"/>
    </div>
</template>

<script>
export default {
    template: '#quantity-changer-template',

    inject: ['$validator'],

    props: {
        controlName: {
            type: String,
            default: 'quantity'
        },

        quantity: {
            type: [Number, String],
            default: 1
        },

        quantityText: {
            type: String,
            default: 'Quantity'
        },

        minQuantity: {
            type: [Number, String],
            default: 1
        },

        validations: {
            type: String,
            default: 'required|numeric|min_value:1'
        }
    },

    data: function() {
        return {
            qty: this.quantity
        };
    },

    mounted: function() {
        this.$refs.quantityChanger.value = this.qty > this.minQuantity
            ? this.qty
            : this.minQuantity;
    },

    watch: {
        qty: function(val) {
            this.$refs.quantityChanger.value = ! isNaN(parseFloat(val)) ? val : 0;

            this.qty = ! isNaN(parseFloat(val)) ? this.qty : 0;

            this.$emit('onQtyUpdated', this.qty);

            this.$validator.validate();
        }
    },

    methods: {
        setQty: function({ target }) {
            this.qty = parseInt(target.value);
        },

        decreaseQty: function() {
            if (this.qty > this.minQuantity) this.qty = parseInt(this.qty) - 1;
        },

        increaseQty: function() {
            this.qty = parseInt(this.qty) + 1;
        }
    }
};
</script>
