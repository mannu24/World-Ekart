@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.reviews.add-review-page-title') }} - {{ $product->name }}
@endsection

@section('content-wrapper')

    <div class="container">
        <section class="row review-page-container p-5 d-flex align-items-start">
            @include ('shop::products.view.small-view', ['product' => $product])
            <div class="col-lg-6 col-md-12">
                <div class="row customer-rating col-12 remove-padding-margin">
                    <form class="ps-form--review" method="POST" @submit.prevent="onSubmit" action="{{ route('shop.reviews.store', $product->product_id ) }}" enctype="multipart/form-data">
                        @csrf
                        <h4>{{ __('shop::app.reviews.write-review') }}</h4>
                        <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                        <div class="form-group form-group__rating" :class="`${errors.has('rating') ? 'has-error' : ''}`">
                            <label>Your rating of this product</label>
                            <star-ratings ratings="5" size="24" editable="true"></star-ratings>
                            <span :class="`control-error ${errors.has('rating') ? '' : 'hide'}`" v-if="errors.has('rating')" v-text="errors.first('rating')"></span>
                        </div>
                        @if (core()->getConfigData('catalog.products.review.guest_review') && ! auth()->guard('customer')->user())
                            <div class="form-group" :class="`${errors.has('name') ? 'has-error' : ''}`">
                                <input type="text" class="form-control" name="name" placeholder="Customer Name" v-validate="'required'" value="{{ old('name') }}">
                                <span :class="`control-error ${errors.has('name') ? '' : 'hide'}`" v-text="errors.first('name')"></span>
                            </div>
                        @endif
                        <div class="form-group" :class="`${errors.has('title') ? 'has-error' : ''}`">
                            <input v-validate="'required'" value="{{ old('title') }}" class="form-control" type="text" name="title" placeholder="Review {{ __('shop::app.reviews.title') }}">
                            <span :class="`control-error ${errors.has('title') ? '' : 'hide'}`" v-text="errors.first('title')"></span>
                        </div>
                        <div class="form-group" :class="`${errors.has('comment') ? 'has-error' : ''}`">
                            <textarea class="form-control" name="comment" v-validate="'required'" value="{{ old('comment') }}" rows="6" placeholder="Write your review here"></textarea>
                            <span :class="`control-error ${errors.has('comment') ? '' : 'hide'}`" v-text="errors.first('comment')"></span>
                        </div>
                        <div class="{!! $errors->has('images.*') ? 'has-error' : '' !!}">
                            <label>{{ __('admin::app.catalog.categories.image') }}</label>
                            <image-wrapper></image-wrapper>
                            <span class="control-error" v-if="{!! $errors->has('images.*') !!}">
                                @php $count=1 @endphp
                                @foreach ($errors->get('images.*') as $key => $message)
                                @php echo str_replace($key, 'Image'.$count, $message[0]); $count++ @endphp
                                @endforeach
                            </span>
                        </div>
                        <div class="form-group submit">
                            <button class="ps-btn" type="submit">{{ __('velocity::app.products.submit-review') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($showRecentlyViewed)
                @include ('shop::products.list.recently-viewed', [ 'addClass' => 'col-lg-3 col-md-12' ])
            @endif
        </section>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
@endpush