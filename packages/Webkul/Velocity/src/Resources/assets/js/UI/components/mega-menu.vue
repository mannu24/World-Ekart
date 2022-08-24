<template>
    <div>
        <ul class="menu">
            <li v-for="(item,index) in $root.sharedRootCategories" :key="index" :class="item.children.length > 0 ? 'menu-item-has-children has-mega-menu' : ''">
                <a :href="`/${item.slug}`">{{ item.name }}</a>
                <div class="mega-menu" v-if="item.children.length > 0">
                    <div class="mega-menu__column" v-for="(child,index1) in item.children" :key="index1">
                        <a :href="`/${item.slug}/${child.slug}`"><h4>{{ child.name }}</h4></a>
                        <ul class="mega-menu__list" v-if="child.children.length > 0">
                            <li v-for="(sub,index2) in child.children" :key="index2"><a :href="`/${item.slug}/${child.slug}/${sub.slug}`">{{ sub.name }}</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    // updated() {
    //     console.log(this.$root.sharedRootCategories);
    // }
};
</script>
