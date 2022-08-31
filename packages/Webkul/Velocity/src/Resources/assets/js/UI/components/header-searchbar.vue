<template>
    <form method="GET" role="search" id="search-form" class="ps-form--quick-search" :action="route">
        <div class="ps-form__categories" v-if="!isMobile()">
            <select class="form-control" name="category" aria-label="Category" @change="focusInput($event)">
                <option value="" v-text="__('header.all-categories')"></option>
                <template v-for="(category, index) in $root.sharedRootCategories">
                    <option :key="index" selected="selected" :value="category.id" v-if="category.id == searchedQuery.category" v-text="category.name"></option>
                    <option :key="index" :value="category.id" v-text="category.name" v-else></option>
                </template>
            </select>
            <div class="select-icon-container d-inline-block float-right">
                <span class="select-icon rango-arrow-down"></span>
            </div>
        </div>
        <div class="ps-form__input">
            <input required name="term" type="search" class="form-control" :placeholder="__('header.search-text')" aria-label="Search" v-model="inputVal" />
        </div>
        <button>Search</button>
    </form>
</template>

<script type="text/javascript">
export default {
    data: function() {
        return {
            inputVal: '',
            searchedQuery: []
        };
    },
    props: ['route'] ,
    created: function() {
        let searchedItem = window.location.search.replace('?', '');
        searchedItem = searchedItem.split('&');

        let updatedSearchedCollection = {};

        searchedItem.forEach(item => {
            let splitedItem = item.split('=');
            updatedSearchedCollection[splitedItem[0]] = decodeURI(
                splitedItem[1]
            );
        });

        if (updatedSearchedCollection['image-search'] == 1) {
            updatedSearchedCollection.term = '';
        }

        this.searchedQuery = updatedSearchedCollection;

        if (this.searchedQuery.term) {
            this.inputVal = decodeURIComponent(
                this.searchedQuery.term.split('+').join(' ')
            );
        }
    },

    methods: {
        focusInput: function(event) {
            $(event.target.parentElement.parentElement)
                .find('input')
                .focus();
        },

        submitForm: function() {
            if (this.inputVal !== '') {
                $('input[name=term]').val(this.inputVal);
                $('#search-form').submit();
            }
        },

        'isMobile': function () {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true;
            } else {
                return false;
            }
        }

    }
};
</script>
