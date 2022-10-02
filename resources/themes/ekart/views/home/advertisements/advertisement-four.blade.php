@php
    $isRendered = false;
    $advertisementFour = null;
    $isLazyLoad = ! isset($lazyload) ? true : ( $lazyload ? true : false );
@endphp

@if ($velocityMetaData && $velocityMetaData->advertisement && $velocityMetaData->links)
    @php
        $advertisement = json_decode($velocityMetaData->advertisement, true);
        $links = json_decode($velocityMetaData->links, true);
        $links = $links[4] ;

        if (isset($advertisement[4]) && is_array($advertisement[4])) {
            $advertisementFour = array_values(array_filter($advertisement[4]));
        }
    @endphp

    @if ($advertisementFour)
        @php
            $isRendered = true;
        @endphp

        <div class="container-fluid advertisement-four-container">
            <div class="row">
                <div class="col-lg-4 col-12 advertisement-container-block px-0">
                    @if (isset($advertisementFour[0]))
                        <a @if ($links[1]!='') target="_blank" href="{{ $links[1] }}" @endif aria-label="Advertisement">
                            <img
                                class="{{ $isLazyLoad ? 'lazyload' : '' }} height-410"
                                @if (! $isLazyLoad) src="{{ Storage::url($advertisementFour[0]) }}" @endif
                                data-src="{{ Storage::url($advertisementFour[0]) }}" alt="" />
                        </a>
                    @endif
                </div>

                <div class="col-lg-4 col-12 advertisement-container-block offers-ct-panel">
                    @if (isset($advertisementFour[1]))
                        <a @if ($links[2]!='') target="_blank" href="{{ $links[2] }}" @endif class="row col-12 px-0 mx-0 mt-10 mt-md-0" aria-label="Advertisement">
                            <img
                                class="offers-ct-top {{ $isLazyLoad ? 'lazyload' : '' }} height-180"
                                @if (! $isLazyLoad) src="{{ Storage::url($advertisementFour[1]) }}" @endif
                                data-src="{{ Storage::url($advertisementFour[1]) }}" alt="" />
                        </a>
                    @endif

                    <div style="height: 10px;"></div>

                    @if (isset($advertisementFour[2]))
                        <a @if ($links[3]!='') target="_blank" href="{{ $links[3] }}" @endif class="row col-12 px-0 mx-0 mb-10 mb-md-0" aria-label="Advertisement">
                            <img
                                class="offers-ct-bottom {{ $isLazyLoad ? 'lazyload' : '' }} height-180"
                                @if (! $isLazyLoad) src="{{ Storage::url($advertisementFour[2]) }}" @endif
                                data-src="{{ Storage::url($advertisementFour[2]) }}" alt="" />
                        </a>
                    @endif
                </div>

                <div class="col-lg-4 col-12 advertisement-container-block px-0">
                    @if (isset($advertisementFour[3]))
                        <a @if ($links[4]!='') target="_blank" href="{{ $links[4] }}" @endif aria-label="Advertisement">
                            <img
                                class="{{ $isLazyLoad ? 'lazyload' : '' }} height-410"
                                @if (! $isLazyLoad) src="{{ Storage::url($advertisementFour[3]) }}" @endif
                                data-src="{{ Storage::url($advertisementFour[3]) }}" alt="" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif

@if (! $isRendered)
    <div class="container-fluid advertisement-four-container">
        <div class="row">
            <div class="col-lg-4 col-12 advertisement-container-block px-0">
                <a @if ($links[1]!='') target="_blank" href="{{ $links[1] }}" @endif aria-label="Advertisement">
                    <img
                        class="{{ $isLazyLoad ? 'lazyload' : '' }} height-410"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/big-sale-banner.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/big-sale-banner.webp') }}" alt="" />
                </a>
            </div>

            <div class="col-lg-4 col-12 advertisement-container-block offers-ct-panel">
                <a @if ($links[2]!='') target="_blank" href="{{ $links[2] }}" @endif aria-label="Advertisement">
                    <img
                        class="offers-ct-top {{ $isLazyLoad ? 'lazyload' : '' }} height-180"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/seasons.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/seasons.webp') }}" alt="" />
                </a>

                <div style="height: 10px;"></div>

                <a @if ($links[3]!='') target="_blank" href="{{ $links[3] }}" @endif aria-label="Advertisement">
                    <img
                        class="offers-ct-bottom {{ $isLazyLoad ? 'lazyload' : '' }} height-180"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/deals.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/deals.webp') }}" alt="" />
                </a>
            </div>

            <div class="col-lg-4 col-12 advertisement-container-block px-0">
                <a @if ($links[4]!='') target="_blank" href="{{ $links[4] }}" @endif aria-label="Advertisement">
                    <img
                        class="{{ $isLazyLoad ? 'lazyload' : '' }} height-410"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/kids.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/kids.webp') }}" alt="" />
                </a>
            </div>
        </div>
    </div>
@endif