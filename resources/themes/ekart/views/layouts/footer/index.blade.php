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
            <aside class="col-md-3 widget widget_footer widget_contact-us">
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
            {!! DbView::make(core()->getCurrentChannel())->field('footer_content')->render() !!}
            {{-- <aside class="widget widget_footer">
                <h4 class="widget-title">Quick links</h4>
                <ul class="ps-list--link">
                    <li><a href="/page/blank">Policy</a></li>
                    <li><a href="/page/blank">Term &amp; Condition</a></li>
                    <li><a href="/page/blank">Shipping</a></li>
                    <li><a href="/page/blank">Return</a></li>
                    <li><a href="/page/faqs">FAQs</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                    <li><a href="/page/about-us">About Us</a></li>
                    <li><a href="/page/blank">Affilate</a></li>
                    <li><a href="/page/blank">Career</a></li>
                    <li><a href="/page/contact-us">Contact</a></li>
                </ul>
            </aside> --}}
            {{-- <aside class="widget widget_footer">
                <h4 class="widget-title">Bussiness</h4>
                <ul class="ps-list--link">
                    <li><a href="/page/about-us">Our Press</a></li>
                    <li><a href="/account/checkout">Checkout</a></li>
                    <li><a href="/account/user-information">My account</a></li>
                    <li><a href="/shop">Shop</a></li>
                </ul>
            </aside> --}}
        </div>
        {{-- <div class="ps-footer__links">
            <p><strong>Consumer Electric:</strong><a href="/shop">Air Conditioners</a><a href="/shop">Audios
                    &amp; Theaters</a><a href="/shop">Car Electronics</a><a href="/shop">Office
                    Electronics</a><a href="/shop">TV Televisions</a><a href="/shop">Washing Machines</a></p>
            <p><strong>Clothing &amp; Apparel:</strong><a href="/shop">Printers</a><a
                    href="/shop">Projectors</a><a href="/shop">Scanners</a><a href="/shop">Store &amp;
                    Business</a><a href="/shop">4K Ultra HD TVs</a><a href="/shop">LED TVs</a><a
                    href="/shop">OLED TVs</a></p>
            <p><strong>Home, Garden &amp; Kitchen:</strong><a href="/shop">Cookware</a><a
                    href="/shop">Decoration</a><a href="/shop">Furniture</a><a href="/shop">Garden Tools</a><a
                    href="/shop">Garden Equipments</a><a href="/shop">Powers And Hand Tools</a><a
                    href="/shop">Utensil &amp; Gadget</a></p>
            <p><strong>Health &amp; Beauty:</strong><a href="/shop">Hair Care</a><a
                    href="/shop">Decoration</a><a href="/shop">Makeup</a><a href="/shop">Body Shower</a><a
                    href="/shop">Skin Care</a><a href="/shop">Cologine</a><a href="/shop">Perfume</a></p>
            <p><strong>Jewelry &amp; Watches:</strong><a href="/shop">Necklace</a><a href="/shop">Pendant</a><a
                    href="/shop">Diamond Ring</a><a href="/shop">Sliver Earing</a><a href="/shop">Leather
                    Watcher</a><a href="/shop">Gucci</a></p>
            <p><strong>Computer &amp; Technologies:</strong><a href="/shop">Desktop PC</a><a
                    href="/shop">Laptop</a><a href="/shop">Smartphones</a><a href="/shop">Tablet</a><a
                    href="/shop">Game Controller</a><a href="/shop">Audio &amp; Video</a><a
                    href="/shop">Wireless Speaker</a></p>
        </div> --}}
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