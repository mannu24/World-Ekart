{{-- <div class="footer">
    <div class="footer-content">

        @include('shop::layouts.footer.newsletter-subscription')
        @include('shop::layouts.footer.footer-links')

        @if ($categories)
            @include('shop::layouts.footer.top-brands')
        @endif

        @if (core()->getConfigData('general.content.footer.footer_toggle'))
            @include('shop::layouts.footer.copy-right')
        @endif
    </div>
</div>
 --}}
    {{-- {{ dd(get_defined_vars()['__data']) }} --}}
@php $site_data = core()->getCurrentChannel()->translate(core()->getRequestedLocaleCode()) ;  @endphp 
<footer class="ps-footer">
    <div class="container">
        <div class="ps-footer__widgets">
            <aside class="col-md-4 widget widget_footer widget_contact-us">
                <div class="logo">
                    <a href="{{ route('shop.home.index') }}" aria-label="Logo">
                        @if ($logo = core()->getCurrentChannel()->logo_url)
                            <img src="{{ $logo }}" class="logo full-img mb-3" width="200" height="50" />
                        @else
                            <img src="{{ asset('themes/ekart/assets/images/logo.png') }}" class="logo full-img" width="200" height="50" />
                        @endif
                    </a>
                </div>
                @php $seo = json_decode($site_data->home_seo) ; @endphp
                @if ($seo)
                    {{ $seo->meta_description }}
                @else
                    @if ($velocityMetaData)
                        {!! $velocityMetaData->footer_left_content !!}
                    @else
                        {!! __('velocity::app.admin.meta-data.footer-left-raw-content') !!}
                    @endif
                @endif
            </aside>
            <aside class="widget widget_footer text-center text-md-left">
                <h4 class="widget-title">Site Policies</h4>
                <ul class="ps-list--link">
                    <li><a href="/page/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/page/terms-conditions">Term &amp; Condition</a></li>
                    <li><a href="/page/return-policy">Return Policy</a></li>
                    <li><a href="/page/refund-policy">Refund Policy</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer text-center text-md-left">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                <li><a href="http://localhost:8000/page/about-us">About Us</a></li>
                <li><a href="http://localhost:8000/contact-us">Contact Us</a></li>
                <li><a href="http://localhost:8000/page/become-a-seller">Become A Seller</a></li>
                <li><a href="http://localhost:8000/track-order">Track Your Order</a></li>
                </ul>
            </aside>
            <aside class="col-md-3 widget widget_footer widget_contact-us text-center text-md-left">
                <h4 class="widget-title">Contact us</h4>
                <div class="widget_content">
                    <p>Call us 24/7</p>
                    @if ($site_data->phone_number)
                        <h3>{{ $site_data->phone_number }}</h3>
                    @endif
                    @if ($site_data->email_address)
                        <h3 class="h4"><a href="mailto:{{ $site_data->email_address }}"><i class="far fa-envelope-open mr-2"></i> {{ $site_data->email_address }}</a></h3>
                    @endif
                    @if ($site_data->address)
                        <p>{{ $site_data->address }}<br /></p>
                    @endif
                    <ul class="ps-list--social">
                        @if ($site_data->facebook_link)
                            <li><a class="facebook" href="{{ $site_data->facebook_link }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if ($site_data->instagram_link)
                            <li><a class="instagram" href="{{ $site_data->instagram_link }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        @endif
                    </ul>
                </div>
            </aside>
        </div>
        <div class="ps-footer__copyright">
            <p>&copy; 2022 {{ $site_data->site_name }}. All Rights Reserved</p>
            <p>
                <span>We Using Safe Payment For:</span>
                <img src="{{ asset('themes/martfury/assets/images/payment-method/1.jpg') }}" alt="{{ $site_data->site_name }}" role="button" />
                <img src="{{ asset('themes/martfury/assets/images/payment-method/2.jpg') }}" alt="{{ $site_data->site_name }}" role="button" />
                <img src="{{ asset('themes/martfury/assets/images/payment-method/3.jpg') }}" alt="{{ $site_data->site_name }}" role="button" />
                <img src="{{ asset('themes/martfury/assets/images/payment-method/4.jpg') }}" alt="{{ $site_data->site_name }}" role="button" />
                <img src="{{ asset('themes/martfury/assets/images/payment-method/5.jpg') }}" alt="{{ $site_data->site_name }}" role="button" />
            </p>
        </div>
    </div>
</footer>