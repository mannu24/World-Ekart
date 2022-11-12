<template>
    <div>
        <div class="tabs">
            <ul>
                <li v-for="(tab,index) in tabs" :key="index" :class="{ 'active': tab.isActive }" @click="selectTab(tab)">
                    <a :class="{ 'big-tab' : big}">{{ tab.name }}</a>
                </li>
            </ul>
        </div>

        <div class="tabs-content">
            <slot></slot>
        </div>
    </div>
</template>
<style scoped>
    .big-tab {
        color: #888 !important;
        font-size: 20px ;
        font-weight: 600;
        text-shadow: 0 0 .25px currentcolor;
    }
    .active .big-tab {
        color: #000 !important;
    }
</style>

<script>
    export default {
        data: function() {
            return {
                tabs: []
            }
        },
        props: ['big'],

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.name == selectedTab.name);
                });
            }
        }
    }
</script>