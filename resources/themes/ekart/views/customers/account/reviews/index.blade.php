@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.review.index.page-title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.review.index.title') }}</li>
    </ul>
@endsection
@section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption class="d-flex justify-content-between">
                        {{ __('shop::app.customer.account.review.index.page-title') }}
                        @if (count($reviews) > 1)
                            <form id="deleteAllReviewForm" action="{{ route('customer.review.deleteall') }}" method="post">
                                @method('delete') @csrf
                            </form>
                            <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="confirm('{{ __('shop::app.customer.account.review.delete-all.confirmation-message') }}') ? document.getElementById('deleteAllReviewForm').submit() : null;">
                                {{ __('shop::app.customer.account.review.delete-all.title') }}
                            </a>
                        @endif
                    </figcaption>
                    <div class="ps-block__content">
                        @if (! $reviews->isEmpty())
                            @foreach ($reviews as $review)
                                <div class="account-item-card mt-15 mb-15">
                                    <div class="media-info">
                                        @php $image = productimage()->getProductBaseImage($review->product); @endphp
                                        <a href="{{ route('shop.productOrCategory.index', $review->product->url_key) }}" title="{{ $review->product->name }}">
                                            <img class="media" src="{{ $image['small_image_url'] }}" alt=""/>
                                        </a>
                                        <div class="info">
                                            <div class="product-name">
                                                <a href="{{ route('shop.productOrCategory.index', $review->product->url_key) }}" title="{{ $review->product->name }}">
                                                    {{$review->product->name}}
                                                </a>
                                            </div>
                                            <div class="stars mt-10">
                                                @for($i=0 ; $i < $review->rating ; $i++)
                                                    <span class="icon star-icon"></span>
                                                @endfor
                                            </div>
                                            <div class="mt-10" v-pre>
                                                {{ $review->comment }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="operations">
                                        <form id="deleteReviewForm" action="{{ route('customer.review.delete', $review->id) }}" method="post">
                                            @method('delete') @csrf
                                        </form>
                                        <a class="mb-50" href="javascript:void(0);" onclick="confirm('{{ __('shop::app.customer.account.review.delete.confirmation-message') }}') ? document.getElementById('deleteReviewForm').submit() : null;">
                                            <span class="icon trash-icon"></span>
                                        </a>
                                    </div>
                                </div>
                                <hr class="mb-10 mt-10" />
                            @endforeach
                            <div class="bottom-toolbar"> {{ $reviews->links()  }} </div>
                        @else
                            <div class="empty mt-15">
                                {{ __('customer::app.reviews.empty') }}
                            </div>
                        @endif
                    </div>
                </figure>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/x-template" id="load-more-template">
        <div class="col-12 row justify-content-center">
            <button type="button" class="theme-btn light" @click="loadNextPage">Load More</button>
        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('load-more-btn', {
                template: '#load-more-template',

                methods: {
                    'loadNextPage': function () {
                        let splitedParamsObject = {};

                        let searchedString = window.location.search;
                        searchedString = searchedString.replace('?', '');

                        let splitedParams = searchedString.split('&');

                        splitedParams.forEach(value => {
                            let splitedValue = value.split('=');
                            splitedParamsObject[splitedValue[0]] = splitedValue[1];
                        });

                        splitedParamsObject[page]
                    }
                }
            });
        })();
    </script>
@endpush
