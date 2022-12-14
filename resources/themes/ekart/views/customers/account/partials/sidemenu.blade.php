@php
    $customer = auth()->guard('customer')->user();
@endphp
@auth('customer')
    <div class="col-lg-3">
        <div class="ps-section__left">
            <aside class="ps-widget--account-dashboard">
                <div class="ps-widget__header">
                    <figure>
                        <figcaption>Hello</figcaption>
                        <p>{{ $customer->name }}</p>
                    </figure>
                </div>
                @foreach ($menu->items as $menuItem)
                    <div class="ps-widget__content">
                        <ul class="ps-list--user-links">
                            @php
                                $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

                                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                            @endphp

                            @if (! $showCompare)
                                @php
                                    unset($menuItem['children']['compare']);
                                @endphp
                            @endif

                            @if (! $showWishlist)
                                @php
                                    unset($menuItem['children']['wishlist']);
                                @endphp
                            @endif
                            @foreach ($menuItem['children'] as $index => $subMenuItem)
                                @if ($index == 'rma')
                                    @if(core()->getConfigData('rma.settings.general.enable_rma'))
                                        <li class="{{ $menu->getActive($subMenuItem) }}">
                                            <a href="{{ $subMenuItem['url'] }}" class="d-flex justify-content-between">
                                                {{ trans($subMenuItem['name']) }}
                                                <i class="icon angle-right-icon"></i>
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li class="{{ $menu->getActive($subMenuItem) }}">
                                        <a href="{{ $subMenuItem['url'] }}" class="d-flex justify-content-between">
                                            {{ trans($subMenuItem['name']) }}
                                            <i class="icon angle-right-icon"></i>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </aside>
        </div>
    </div>
    {{-- <div class="customer-sidebar row no-margin no-padding">
        <div class="account-details col-12">
            <div class="customer-name col-12 text-uppercase">
                {{ substr(auth('customer')->user()->first_name, 0, 1) }}
            </div>
            <div class="col-12 customer-name-text text-capitalize text-break">{{ auth('customer')->user()->first_name . ' ' . auth('customer')->user()->last_name}}</div>
            <div class="customer-email col-12 text-break">{{ auth('customer')->user()->email }}</div>
        </div>

        @foreach ($menu->items as $menuItem)
            <ul type="none" class="navigation">
                @php
                    $subMenuCollection = [];

                    $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

                    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;

                    try {
                        $subMenuCollection['profile'] = $menuItem['children']['profile'];
                        $subMenuCollection['orders'] = $menuItem['children']['orders'];
                        $subMenuCollection['downloadables'] = $menuItem['children']['downloadables'];

                        if ($showWishlist) {
                            $subMenuCollection['wishlist'] = $menuItem['children']['wishlist'];
                        }

                        if ($showCompare) {
                            $subMenuCollection['compare'] = $menuItem['children']['compare'];
                        }

                        $subMenuCollection['reviews'] = $menuItem['children']['reviews'];
                        $subMenuCollection['address'] = $menuItem['children']['address'];

                        unset(
                            $menuItem['children']['profile'],
                            $menuItem['children']['orders'],
                            $menuItem['children']['downloadables'],
                            $menuItem['children']['wishlist'],
                            $menuItem['children']['compare'],
                            $menuItem['children']['reviews'],
                            $menuItem['children']['address']
                        );

                        foreach ($menuItem['children'] as $key => $remainingChildren) {
                            $subMenuCollection[$key] = $remainingChildren;
                        }
                    } catch (\Exception $exception) {
                        $subMenuCollection = $menuItem['children'];
                    }
                @endphp
                @foreach ($subMenuCollection as $index => $subMenuItem)
                    <li class="{{ $menu->getActive($subMenuItem) }}" title="{{ trans($subMenuItem['name']) }}">
                        <a class="unset fw6 full-width" href="{{ $subMenuItem['url'] }}">
                            <i class="icon {{ $index }} text-down-3"></i>
                            <span>{{ trans($subMenuItem['name']) }}<span>
                            <i class="rango-arrow-right float-right text-down-3"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div> --}}
@endauth

@push('css')
    <style type="text/css">
        .main-content-wrapper {
            margin-bottom: 0px;
            min-height: 100vh;
        }
    </style>
@endpush