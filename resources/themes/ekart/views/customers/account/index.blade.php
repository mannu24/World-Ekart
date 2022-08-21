@extends('shop::layouts.master')

@section('content-wrapper')
    <div class="ps-page--my-account">
        <div class="ps-breadcrumb border-bottom">
            <div class="container">
                @yield('account-breadcrumb')
            </div>
        </div>
        <section class="ps-my-account ps-page--account pb-50">
            <div class="container">
                <div class="row align-items-start">
                    @include('shop::customers.account.partials.sidemenu')
                    @yield('page-detail-wrapper')
                </div>
            </div>
        </section>
    </div>
    {{-- <div class="account-content row no-margin velocity-divide-page">
        @if (auth()->guard('customer')->user())
            <div class="sidebar left">
                @include('shop::customers.account.partials.sidemenu')
            </div>
        @endif

        <div class="account-layout right mt10">
            @yield('page-detail-wrapper')
        </div>
    </div> --}}
@endsection

{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            window.updateHeight = () => {
                setTimeout(() => {
                    let sidebarHeight = $('.customer-sidebar').css('height');
                    let contentHeight = $('.account-layout').css('height');

                    sidebarHeight = parseInt(sidebarHeight.substring(0, sidebarHeight.length - 2));
                    contentHeight = parseInt(contentHeight.substring(0, contentHeight.length - 2));

                    let height = sidebarHeight > contentHeight ? sidebarHeight + 30 : contentHeight;
                    height = height + "px";

                    $('.account-content').css('height', '100%');
                }, 0);
            }

            window.updateHeight();

            $('input, select').change(() => {
                window.updateHeight();
            });

            $('button').click(() => {
                window.updateHeight();
            });

            $('.accordian-header').click(window.updateHeight);
        });
    </script>
@endpush --}}

@push('css')
    <style>
        .account-head .account-action {
            top: -20px;
            float: right;
        }
        table {
            width: 100%;
        }
        table.sale-summary {
            width: unset;
        }
        .pagination .page-item {
            padding: 10px;
            font-size: 16px;
        }
    </style>
@endpush
