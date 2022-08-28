@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')

@php
    $reviews = $reviewHelper->getReviews($product)->paginate(10);

    if (! isset($total)) {
        $total = $reviewHelper->getTotalReviews($product);
        $avgRatings = $reviewHelper->getAverageRating($product);
        $avgStarRating = round($avgRatings);
    }

    $percentageRatings = $reviewHelper->getPercentageRating($product);
@endphp

<div class="row d-flex align-items-start">
    <div class="col-md-12 col-sm-12 col-12 @if(!isset($index)) col-xl-5 col-lg-5 @endif">
        <div class="ps-block--average-rating pl-4 d-flex @if(!isset($index)) flex-column @else flex-row justify-content-between @endif">
            <div class="ps-block__header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="d-inline">{{ $avgRatings }}</h3>
                    @if(!isset($index))
                        <div>
                            @if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
                                <a class="ps-btn ps-btn--outline btn-small" href="{{ route('shop.reviews.create', ['slug' => $product->url_key ]) }}">{{ __('velocity::app.products.write-your-review') }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <star-ratings push-class="mr-2" :ratings="{{ $avgStarRating }}"></star-ratings>
                <span class="text-nowrap">
                    {{ __('shop::app.reviews.ratingreviews', [
                        'rating' => $avgRatings, 'review' => $total,
                    ]) }}
                </span>
            </div>
            <div class="w-100 @if(isset($index)) ml-100 @endif">
                @for ($i = 5; $i >= 1; $i--)
                    <div class="ps-block__star"><span>{{ $i }} {{ __('shop::app.reviews.star') }}</span>
                        <div class="ps-progress" data-value="{{ $percentageRatings[$i] }}">
                            <span style="width:{{ $percentageRatings[$i].'%' }};"></span>
                        </div>
                        <span>{{ $percentageRatings[$i].'%' }}</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    @if (count($reviews)>0)
        <div class="col-md-12 col-sm-12 col-12 @if(!isset($index)) col-xl-7 col-lg-7  @endif">
            <h3 class="col-12 px-0 mb-20 d-inline-block">
                {{ __('velocity::app.products.reviews-title') }}
            </h3>
            @foreach ($reviews as $review)
                <div class="row review-block">
                    <h4 class="col-lg-12 fs18">{{ $review->title }}</h4>

                    <star-ratings
                        :ratings="{{ $review->rating }}"
                        push-class="mr10 fs16 col-lg-12"
                    ></star-ratings>

                    <div class="review-description col-lg-12">
                        <span>{{ $review->comment }}</span>
                    </div>

                    <div class="image col-lg-12">
                        @if (count($review->images) > 0)
                            @foreach ($review->images as $image)
                                <img class="image" src="{{ $image->url }}" style="height: 50px; width: 50px; margin: 5px;">
                            @endforeach
                        @endif
                    </div>

                    <div class="col-lg-12 mt5">
                        @if ("{{ $review->name }}")
                            <span>{{ __('velocity::app.products.review-by') }} -</span>

                            <label>
                                {{ $review->name }},
                            </label>
                        @endif

                        <span>{{ core()->formatDate($review->created_at, 'F d, Y') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>                                                        
    @endif
</div>
