<template>
    <li :class="['ant-menu-submenu ant-menu-submenu-inline accordian', isActive ? 'ant-menu-submenu-open ant-menu-submenu-active' : '', !isActive && hasError ? 'error' : '']" :id="id">
        <slot name="header" @click="toggleAccordian()"></slot>
        <slot name="body"></slot>
    </li>
</template>

<script>
export default {
    props: {
        title: String,
        id: String,
        active: Boolean,
        downIconClass: {
            type: String,
            default: "accordian-down-icon"
        },
        upIconClass: {
            type: String,
            default: "accordian-up-icon"
        }
    },

    inject: ["$validator"],

    data: function() {
        return {
            isActive: false,

            imageData: "",

            hasError: false
        };
    },

    mounted: function() {
        this.addHasErrorClass();

        eventBus.$on("onFormError", this.addHasErrorClass);

        this.isActive = this.active;
    },

    methods: {
        toggleAccordian: function() {
            this.isActive = !this.isActive;
        },

        addHasErrorClass: function() {
            let self = this;

            setTimeout(function() {
                $(self.$el)
                    .find(".control-group")
                    .each(function(index, element) {
                        if ($(element).hasClass("has-error")) {
                            self.hasError = true;
                        }
                    });
            }, 0);
        }
    },

    computed: {
        iconClass: function() {
            return {
                [this.downIconClass]: !this.isActive,
                [this.upIconClass]: this.isActive
            };
        }
    }
};
</script>
