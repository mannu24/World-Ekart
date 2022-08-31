<template>
    <div>
        <ul class="menu" v-if="!mobile">
            <li v-for="(item,index) in $root.sharedRootCategories" :key="index" :class="item.children.length > 0 ? 'menu-item-has-children has-mega-menu' : ''">
                <a :href="`/${item.slug}`">{{ item.name }}</a>
                <div class="mega-menu" v-if="item.children.length > 0">
                    <!-- <div class="mega-menu__column" v-for="(child,index1) in (item.children).slice(0,2)" :key="index1"> -->
                    <div class="mega-menu__column" v-for="(child,index1) in item.children" :key="index1">
                        <a :href="`/${item.slug}/${child.slug}`"><h4>{{ child.name }}</h4></a>
                        <ul class="mega-menu__list" v-if="child.children.length > 0">
                            <li v-for="(sub,index2) in child.children" :key="index2"><a :href="`/${item.slug}/${child.slug}/${sub.slug}`">{{ sub.name }}</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="ant-menu ant-menu-root ant-menu-inline ant-menu-light menu--mobile-2" v-else>
            <li class="ant-menu-submenu ant-menu-submenu-inline" v-for="(item,index) in $root.sharedRootCategories" :key="index">
                <div role="menuitem" class="ant-menu-submenu-title" style="padding-left: 24px;" @click="toggleChild(index)">
                    <span class="ant-menu-title-content"><a :href="`/${item.slug}`">{{ item.name }}</a></span>
                    <i class="ant-menu-submenu-arrow" :class="`menuIcon-${index}`" v-if="item.children.length > 0"></i>
                </div>
                <ul v-if="item.children.length > 0" class="ant-menu ant-menu-sub ant-menu-inline ant-menu-hidden" :class="`menuChild-${index}`">
                    <li v-for="(child,index1) in item.children" :key="index1" class="ant-menu-submenu ant-menu-submenu-inline">
                        <div role="menuitem" class="ant-menu-submenu-title" style="padding-left: 48px;" @click="toggleSubChild(index1)">
                            <a :href="`/${item.slug}/${child.slug}`" class="ant-menu-title-content">{{ child.name }}</a>
                            <i class="ant-menu-submenu-arrow" :class="`subMenuIcon-${index1}`" v-if="child.children.length > 0"></i>
                        </div>
                        <ul class="ant-menu ant-menu-sub ant-menu-inline ant-menu-hidden" v-if="child.children.length > 0" :class="`subMenuChild-${index1}`">
                            <li class="ant-menu-item ant-menu-item-only-child" style="padding-left: 72px;" v-for="(sub,index2) in child.children" :key="index2">
                                <span class="ant-menu-title-content">
                                    <a :href="`/${item.slug}/${child.slug}/${sub.slug}`">{{ sub.name }}</a>
                                </span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['mobile'],
    methods: {
        toggleChild(id) {
            $(".menuChild-"+id).toggleClass('ant-menu-hidden')
            $(".menuIcon-"+id).toggleClass('fa-rotate-180')
        },
        toggleSubChild(id) {
            $(".subMenuChild-"+id).toggleClass('ant-menu-hidden')
            $(".subMenuIcon-"+id).toggleClass('fa-rotate-180')
        }
    },

};
</script>
