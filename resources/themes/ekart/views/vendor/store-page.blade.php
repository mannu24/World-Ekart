@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
@extends('shop::layouts.master')

@section('page_title')
    {{ $vendor->display_name }} - Seller
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
@php 
    $products = $vendor->products ;
@endphp
@section('content-wrapper')
    <div class="ps-vendor-store">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__left">
                    <div class="ps-block--vendor">
                        <div class="ps-block__thumbnail">
                            @if (file_exists(public_path($vendor->profile_image)))
                                <img src="{{ asset($vendor->profile_image) }}" alt="martfury">
                            @else
                                <img src="{{ asset('themes/ekart/assets/images/not-found.jpg') }}" alt="martfury">
                            @endif
                        </div>
                        <div class="ps-block__container">
                            <div class="ps-block__header">
                                <h4>{{ $vendor->display_name }}</h4>
                                {{-- <span class="ps-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </span>
                                <p><strong>85% Positive</strong> (562 rating)</p> --}}
                            </div>
                            <div class="ps-block__divider"></div>
                            <div class="ps-block__content">
                                <p><strong>Description: </strong>{{ $vendor->description }}
                                </p>
                                <span class="ps-block__divider"></span>
                                <p><strong>Address: </strong>
                                    {{
                                        $vendor->address.' '.$vendor->city.', '.($vendor->state ? $vendor->state.', ' : '' ).$vendor->country
                                    }}
                                </p>
                                @if (!is_null($vendor->facebook_link) || !is_null($vendor->twitter_link) || !is_null($vendor->instagram_link) || !is_null($vendor->youtube_link) )
                                    <figure>
                                        <figcaption>Follow us on Social Media</figcaption>
                                        <ul class="ps-list--social-color">
                                            @if ($vendor->facebook_link)
                                                <li><a class="facebook" target="_blank" href="{{ $vendor->facebook_link }}"><i class="fa fa-facebook"></i></a></li>
                                            @endif
                                            @if ($vendor->twitter_link)
                                                <li><a class="twitter" target="_blank" href="{{ $vendor->twitter_link }}"><i class="fa fa-twitter"></i></a></li>
                                            @endif
                                            @if ($vendor->instagram_link)
                                                <li><a class="instagram" target="_blank" href="{{ $vendor->instagram_link }}"><i class="fa fa-instagram"></i></a></li>
                                            @endif
                                            @if ($vendor->youtube_link)
                                                <li><a class="youtube" target="_blank" href="{{ $vendor->youtube_link }}"><i class="fa fa-youtube"></i></a></li>
                                            @endif
                                        </ul>
                                    </figure>
                                @endif
                            </div>
                            <div class="ps-block__footer">
                                @if ($vendor->phone)
                                    <p>Call us directly
                                        <strong><a href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></strong>
                                    </p>
                                @endif
                                <p>If you have any question</p>
                                <a class="ps-btn ps-btn--fullwidth" href="{{ route('shop.contact.index') }}">Contact Seller</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__right">
                    <div class="ps-store-products">
                        <div class="ps-block--shop-features">
                            @include('shop::vendor.best-products',['collection'=>$top_products])
                            {{-- <div class="ps-block__header">
                                <h3>Best Seller Products</h3>
                                <div class="ps-block__navigation"><a class="ps-carousel__prev"><i
                                            class="icon-chevron-left"></i></a><a class="ps-carousel__next"><i
                                            class="icon-chevron-right"></i></a></div>
                            </div>
                            <div class="ps-block__content">
                                <div class="slick-slider ps-carousel outside slick-initialized" dir="ltr">
                                    <div class="slick-list">
                                        <div class="slick-track"
                                            style="width: 2958px; opacity: 1; transform: translate3d(-870px, 0px, 0px);">
                                            <div data-index="-5" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/20"><img
                                                                    src="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"
                                                                    alt="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/20">EPSION Plaster Printer 2</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/20">EPSION
                                                                    Plaster Printer 2</a>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="-4" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/36"><img
                                                                    src="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"
                                                                    alt="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"></a>
                                                            <div class="ps-product__badge">-23%</div>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/36">Simpson Polymer White Racing
                                                                    Helmet</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/36">Simpson
                                                                    Polymer White Racing Helmet</a>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="-3" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/37"><img
                                                                    src="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"
                                                                    alt="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/37">Gibson – Double Skull Exhaust
                                                                    System</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/37">Gibson –
                                                                    Double Skull Exhaust System</a>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="-2" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/11"><img
                                                                    src="http://localhost:1337/uploads/1_33e3c32a03.jpg"
                                                                    alt="http://localhost:1337/uploads/1_33e3c32a03.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/11">Sleeve Linen Blend Caro Pane
                                                                    Shirt</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/11">Sleeve
                                                                    Linen Blend Caro Pane Shirt</a>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="-1" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/18"><img
                                                                    src="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"
                                                                    alt="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/18">Samsung UHD TV 24inch</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/18">Samsung
                                                                    UHD TV 24inch</a>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="0" class="slick-slide slick-active slick-current"
                                                tabindex="-1" aria-hidden="false" style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/7"><img
                                                                    src="http://localhost:1337/uploads/b097fdfb8b9d40fca83de9180de5a7ab.jpg"
                                                                    alt="http://localhost:1337/uploads/b097fdfb8b9d40fca83de9180de5a7ab.jpg"></a>
                                                            <div class="ps-product__badge">-6%</div>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/7">Sound Intone I65 Earphone White
                                                                    Version</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price sale"><span>$</span>100.99<del
                                                                        class="ml-2"><span>$</span>106.96</del></p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/7">Sound
                                                                    Intone I65 Earphone White Version</a>
                                                                <p class="ps-product__price sale"><span>$</span>100.99<del
                                                                        class="ml-2"><span>$</span>106.96</del></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="1" class="slick-slide slick-active" tabindex="-1"
                                                aria-hidden="false" style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/20"><img
                                                                    src="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"
                                                                    alt="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/20">EPSION Plaster Printer 2</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/20">EPSION
                                                                    Plaster Printer 2</a>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="2" class="slick-slide slick-active" tabindex="-1"
                                                aria-hidden="false" style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/36"><img
                                                                    src="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"
                                                                    alt="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"></a>
                                                            <div class="ps-product__badge">-23%</div>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/36">Simpson Polymer White Racing
                                                                    Helmet</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/36">Simpson
                                                                    Polymer White Racing Helmet</a>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="3" class="slick-slide slick-active" tabindex="-1"
                                                aria-hidden="false" style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/37"><img
                                                                    src="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"
                                                                    alt="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/37">Gibson – Double Skull Exhaust
                                                                    System</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/37">Gibson –
                                                                    Double Skull Exhaust System</a>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="4" class="slick-slide slick-active" tabindex="-1"
                                                aria-hidden="false" style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/11"><img
                                                                    src="http://localhost:1337/uploads/1_33e3c32a03.jpg"
                                                                    alt="http://localhost:1337/uploads/1_33e3c32a03.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/11">Sleeve Linen Blend Caro Pane
                                                                    Shirt</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/11">Sleeve
                                                                    Linen Blend Caro Pane Shirt</a>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="5" class="slick-slide" tabindex="-1" aria-hidden="true"
                                                style="outline: none; width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/18"><img
                                                                    src="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"
                                                                    alt="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/18">Samsung UHD TV 24inch</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/18">Samsung
                                                                    UHD TV 24inch</a>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="6" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/7"><img
                                                                    src="http://localhost:1337/uploads/b097fdfb8b9d40fca83de9180de5a7ab.jpg"
                                                                    alt="http://localhost:1337/uploads/b097fdfb8b9d40fca83de9180de5a7ab.jpg"></a>
                                                            <div class="ps-product__badge">-6%</div>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/7">Sound Intone I65 Earphone White
                                                                    Version</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price sale"><span>$</span>100.99<del
                                                                        class="ml-2"><span>$</span>106.96</del></p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/7">Sound
                                                                    Intone I65 Earphone White Version</a>
                                                                <p class="ps-product__price sale"><span>$</span>100.99<del
                                                                        class="ml-2"><span>$</span>106.96</del></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="7" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/20"><img
                                                                    src="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"
                                                                    alt="http://localhost:1337/uploads/9c3e74c3b8e04684ba6c8cd333bdc8ec.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/20">EPSION Plaster Printer 2</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/20">EPSION
                                                                    Plaster Printer 2</a>
                                                                <p class="ps-product__price"><span>$</span>299.28</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="8" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/36"><img
                                                                    src="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"
                                                                    alt="http://localhost:1337/uploads/d3d6a340ec114211b670de5fb72955e8.jpg"></a>
                                                            <div class="ps-product__badge">-23%</div>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/36">Simpson Polymer White Racing
                                                                    Helmet</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/36">Simpson
                                                                    Polymer White Racing Helmet</a>
                                                                <p class="ps-product__price sale"><span>$</span>625.99<del
                                                                        class="ml-2"><span>$</span>770.5</del></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="9" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/37"><img
                                                                    src="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"
                                                                    alt="http://localhost:1337/uploads/1ebf2224f4724391a3a75a5f4dce4599.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/37">Gibson – Double Skull Exhaust
                                                                    System</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/37">Gibson –
                                                                    Double Skull Exhaust System</a>
                                                                <p class="ps-product__price"><span>$</span>1,055.99</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="10" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/11"><img
                                                                    src="http://localhost:1337/uploads/1_33e3c32a03.jpg"
                                                                    alt="http://localhost:1337/uploads/1_33e3c32a03.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/11">Sleeve Linen Blend Caro Pane
                                                                    Shirt</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/11">Sleeve
                                                                    Linen Blend Caro Pane Shirt</a>
                                                                <p class="ps-product__price"><span>$</span>29.39</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-index="11" tabindex="-1" class="slick-slide slick-cloned"
                                                aria-hidden="true" style="width: 174px;">
                                                <div>
                                                    <div class="ps-product">
                                                        <div class="ps-product__thumbnail"><a href="/product/18"><img
                                                                    src="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"
                                                                    alt="http://localhost:1337/uploads/a48664eaed094c769046b4128dd341e4.jpg"></a>
                                                            <ul class="ps-product__actions">
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add To Cart"><i
                                                                            class="icon-bag2"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Quick View"><i
                                                                            class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Add to wishlist"><i
                                                                            class="icon-heart"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip"
                                                                        data-placement="top" title="Compare"><i
                                                                            class="icon-chart-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__container"><a class="ps-product__vendor"
                                                                href="/shop">Young Shop</a>
                                                            <div class="ps-product__content"><a class="ps-product__title"
                                                                    href="/product/18">Samsung UHD TV 24inch</a>
                                                                <div class="ps-product__rating"><span class="ps-rating"><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star-o"></i></span><span>02</span>
                                                                </div>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                            <div class="ps-product__content hover"><a
                                                                    class="ps-product__title" href="/product/18">Samsung
                                                                    UHD TV 24inch</a>
                                                                <p class="ps-product__price"><span>$</span>599</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="ps-shopping">
                            <products-component></products-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/x-template" id="product-component-template">
        <section class="search-container row category-container">
            {{-- @if ($products && $products->count()) --}}
                <div class="ps-shopping__header">
                    <div class="ps-shopping__actions flex-column flex-md-row">
                        <p class="w-100"><strong class="mr-2">{{ $products->count() }}</strong>Products found</p>
                        @include ('shop::products.list.toolbar')
                    </div>
                </div>
            {{-- @endif --}}

            @if (!$products->count())
                <h2 class="col-12">{{ __('shop::app.products.whoops') }}</h2>
                <h3 class="col-12">{{ __('shop::app.search.no-results') }}</h3>
            @else
                @foreach ($products as $productFlat)
                    @if ($toolbarHelper->getCurrentMode() == 'grid')
                        @include('shop::products.list.card', [
                            'cardClass' => 'category-product-image-container',
                            'product' => $productFlat->product_flats->first(),
                        ])
                    @else
                        @include('shop::products.list.card', [
                            'list' => true,
                            'product' => $productFlat->product_flats->first(),
                        ])
                    @endif
                @endforeach
            @endif
        </section>
    </script>

    <script>
        Vue.component('products-component', {
            template: '#product-component-template',
        });
    </script>
@endpush
