@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

{!! view_render_event('bagisto.shop.products.list.toolbar.before') !!}
    <toolbar-component></toolbar-component>
{!! view_render_event('bagisto.shop.products.list.toolbar.after') !!}

@push('scripts')
    <script type="text/x-template" id="toolbar-template">

        <div class="d-flex w-100 justify-content-between justify-content-md-end flex-wrap-reverse">
            @if(!isset($hide))
                <select class="selective-div border-normal styled-select ps-select form-control" onchange="window.location.href = this.value" style="width: 57px;" aria-label="Show">

                    @foreach ($toolbarHelper->getAvailableLimits() as $limit)

                        <option value="{{ $toolbarHelper->getLimitUrl($limit) }}" {{ $toolbarHelper->isLimitCurrent($limit) ? 'selected' : '' }}>
                            {{ $limit }}
                        </option>

                    @endforeach

                </select>
                <select class="selective-div ps-select form-control" onchange="window.location.href = this.value" aria-label="Sort By">
                    @foreach ($toolbarHelper->getAvailableOrders() as $key => $order)
                        <option value="{{ $toolbarHelper->getOrderUrl($key) }}" {{ $toolbarHelper->isOrderCurrent($key) ? 'selected' : '' }}>
                            {{ __('shop::app.products.' . $order) }}
                        </option>
                    @endforeach
                </select>
            @endif
            <div class="ps-shopping__view pl-0">
                <ul class="ps-tab-list">
                    @php $viewOption = $toolbarHelper->getViewOption(); @endphp
                    <li class="{{ $viewOption === 'grid' ? 'active' : '' }}">
                        <a href="{{ $toolbarHelper->getModeUrl('grid') }}">
                            <i class="icon-grid"></i>
                        </a>
                    </li>
                    <li class="{{ $viewOption === 'list' ? 'active' : '' }}">
                        <a href="{{ $toolbarHelper->getModeUrl('list') }}">
                            <i class="icon-list4"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </script>
    <script type="text/javascript">
        (() => {
            Vue.component('toolbar-component', {
                template: '#toolbar-template',
                data: function () {
                    return {
                        'layeredNavigation': false,
                    }
                },

                watch: {
                    layeredNavigation: function (value) {
                        if (value) {
                            document.body.classList.add('open-hamburger');
                        } else {
                            document.body.classList.remove('open-hamburger');
                        }
                    }
                },

                methods: {
                    toggleLayeredNavigation: function ({event, actionType}) {
                        this.layeredNavigation = !this.layeredNavigation;
                    },
                }
            })
        })()
    </script>
@endpush
