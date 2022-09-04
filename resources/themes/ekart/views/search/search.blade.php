@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.search.page-title') }}
@endsection

@push('css')
    <style type="text/css">
        .category-container {
            min-height: unset;
        }

        .toolbar-wrapper .col-4:first-child {
            display: none !important;
        }

        .toolbar-wrapper .col-4:last-child {
            right: 0;
            position: absolute;
        }


        @media only screen and (max-width: 992px) {
            .main-content-wrapper .vc-header {
                box-shadow: unset;
            }

             .toolbar-wrapper .col-4:last-child {
                left: 175px;
            }

            .toolbar-wrapper .sorter {
                left: 35px;
                position: relative;
            }

            .quick-view-btn-container,
            .rango-zoom-plus,
            .quick-view-in-list {
                display: none;
            }

        }
    </style>
@endpush

@section('content-wrapper')
    
<div class="ps-page--shop">
    <div class="ps-breadcrumb border-bottom">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
                <li>{{ __('shop::app.search.page-title') }}</li>
            </ul>
        </div>
    </div>
    <div class="container pt-50">
        <search-component></search-component>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/x-template" id="image-search-result-component-template">
        <div class="image-search-result">
            <div class="searched-image">
                <img :src="searchedImageUrl" alt=""/>
            </div>

            <div class="searched-terms">
                <h3 class="fw6 fs20 mb-4">
                    {{ __('shop::app.search.analysed-keywords') }}
                </h3>

                <div class="term-list">
                    <a v-for="term in searched_terms" :href="'{{ route('shop.search.index') }}?term=' + term.slug">
                        @{{ term.name }}
                    </a>
                </div>
            </div>
        </div>
    </script>
    <script type="text/x-template" id="seach-component-template">
        <section class="search-container row category-container ps-shopping justify-content-center">
            @if (request('image-search'))
                <image-search-result-component></image-search-result-component>
            @endif

            {{-- @if ($results && $results->count())
                <div class="ps-shopping__header">
                    <div class="ps-shopping__actions flex-column flex-md-row">
                        <p class="w-100"><strong class="mr-2">{{ $results->total() }}</strong>{{ __('shop::app.search.found-result') }}</p>
                        @include ('shop::products.list.toolbar')
                    </div>
                </div>
            @endif --}}

            @if (! $results)
                <h2 class="col-12">{{ __('shop::app.products.whoops') }}</h2>
                <h3 class="col-12">{{ __('shop::app.search.no-results') }}</h3>
            @else
                @if ($results->isEmpty())
                    <h2 class="col-12">{{ __('shop::app.products.whoops') }}</h2>
                    <span class="col-12">{{ __('shop::app.search.no-results') }}</span>
                @else
                    @if ($results->total() == 1)
                        <h5 class="col-12 mb-20">
                            {{ $results->total() }} {{ __('shop::app.search.found-result') }}
                        </h5>
                    @else
                        <h2 class="col-12 mb-20">
                            {{ $results->total() }} {{ __('shop::app.search.found-results') }}
                        </h2>
                    @endif

                    @foreach ($results as $productFlat)
                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            @include('shop::products.list.card', [
                                'cardClass' => 'category-product-image-container',
                                'product' => $productFlat->product,
                            ])
                        @else
                            @include('shop::products.list.card', [
                                'list' => true,
                                'product' => $productFlat->product,
                            ])
                        @endif
                    @endforeach

                    @include('ui::datagrid.pagination')
                @endif
            @endif
        </section>
    </script>

    <script>
        Vue.component('search-component', {
            template: '#seach-component-template',
        });

        Vue.component('image-search-result-component', {
            template: '#image-search-result-component-template',

            data: function() {
                return {
                    searched_terms: [],
                    searchedImageUrl: localStorage.searchedImageUrl,
                }
            },

            created: function() {
                if (localStorage.searched_terms && localStorage.searched_terms != '') {
                    this.searched_terms = localStorage.searched_terms.split('_');

                    this.searched_terms = this.searched_terms.map(term => {
                        return {
                            name: term,
                            slug: term.split(' ').join('+'),
                        }
                    });
                }
            }
        });
    </script>
@endpush