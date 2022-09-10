@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

@extends('shop::layouts.master')

@section('page_title')
    {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}
@stop

@section('seo')
    <meta name="description" content="{{ $category->meta_description }}" />
    <meta name="keywords" content="{{ $category->meta_keywords }}" />

    @if (core()->getConfigData('catalog.rich_snippets.categories.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category) !!}
        </script>
    @endif
@stop

@push('css')
    <style type="text/css">
        .product-price span:first-child, .product-price span:last-child {
            font-size: 18px;
            font-weight: 600;
        }

        @media only screen and (max-width: 992px) {
            .main-content-wrapper .vc-header {
                box-shadow: unset;
            }
        }
    </style>
@endpush

@php
    $isProductsDisplayMode = in_array(
        $category->display_mode, [
            null,
            'products_only',
            'products_and_description'
        ]
    );

    $isDescriptionDisplayMode = in_array(
        $category->display_mode, [
            null,
            'description_only',
            'products_and_description'
        ]
    );
@endphp

@section('content-wrapper')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li>Shop</li>
                <li>{{ $category->name }}</li>
            </ul>
        </div>
    </div>
    <category-component></category-component>
@stop

@push('scripts')
    <script type="text/x-template" id="category-template">
        <div class="container">
            <div class="ps-layout--shop ps-shop--category">
                @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                    @include ('shop::products.list.layered-navigation')
                @endif
                <div class="ps-layout__right">
                    <h3 class="ps-shop__heading">{{ $category->name }}</h3>
                    @if ($isDescriptionDisplayMode)
                        @if ($category->description)
                            <div class="category-description">
                                {!! $category->description !!}
                            </div>
                        @endif
                    @endif
                    @if (!is_null($category->image))
                        <img class="logo" src="{{ $category->image_url }}" alt="" width="20" height="20" />
                    @endif
                    <div class="ps-shopping">
                        @if ($isProductsDisplayMode)
                            <template v-if="products.length >= 0">
                                <div class="ps-shopping__header">
                                    <div class="ps-shopping__actions flex-column flex-md-row">
                                        <p class="w-100"><strong class="mr-2" v-html="products.length"></strong>Products found</p>
                                        @include ('shop::products.list.toolbar')
                                    </div>
                                </div>
                            </template>
                            <div class="ps-shopping__content" @if ($category->display_mode == 'description_only') style="width: 100%" @endif>
                                <shimmer-component v-if="isLoading" shimmer-count="3"></shimmer-component>
                                <template v-else-if="products.length > 0">
                                    @if ($toolbarHelper->getCurrentMode() == 'grid')
                                        <div class="ps-shop-items">
                                            <div class="row">
                                                <product-card :key="index" col=true :product="product" v-for="(product, index) in products">
                                                </product-card>
                                            </div>
                                        </div>
                                    @else
                                        <product-card list=true :key="index" :product="product" v-for="(product, index) in products">
                                        </product-card>
                                    @endif

                                    {!! view_render_event('bagisto.shop.productOrCategory.index.pagination.before', ['category' => $category]) !!}

                                    <div class="bottom-toolbar" v-html="paginationHTML"></div>

                                    {!! view_render_event('bagisto.shop.productOrCategory.index.pagination.after', ['category' => $category]) !!}
                                </template>
                                <div class="product-list empty pl-1" v-else>
                                    <h2>{{ __('shop::app.products.whoops') }}</h2>
                                    <p>{{ __('shop::app.products.empty') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('category-component', {
            template: '#category-template',

            data: function () {
                return {
                    'products': [],
                    'isLoading': true,
                    'paginationHTML': '',
                }
            },

            created: function () {
                this.getCategoryProducts();
            },

            methods: {
                'getCategoryProducts': function () {
                    this.$http.get(`${this.$root.baseUrl}/category-products/{{ $category->id }}${window.location.search}`)
                    .then(response => {
                        this.isLoading = false;
                        this.products = response.data.products;
                        this.paginationHTML = response.data.paginationHTML;
                    })
                    .catch(error => {
                        this.isLoading = false;
                        console.log(this.__('error.something_went_wrong'));
                    })
                }
            }
        })
    </script>
@endpush