@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id]) }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id]) }}</li>
    </ul>
@endsection
@push('css')
    <style type="text/css">
        .account-content .account-layout .account-head {
            margin-bottom: 0px;
        }
        .sale-summary .dash-icon {
            margin-right: 30px;
            float: right;
        }
    </style>
@endpush

@section('page-detail-wrapper')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption class="d-flex justify-content-between mb-3">
                        {{ __('shop::app.customer.account.order.view.page-tile', ['order_id' => $order->increment_id]) }}
                        @if ($order->canCancel())
                            <form id="cancelOrderForm" action="{{ route('customer.orders.cancel', $order->id) }}" method="post">
                                @csrf
                            </form>
                            <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="cancelOrder('{{ __('shop::app.customer.account.order.view.cancel-confirm-msg') }}')" style="float: right">
                                {{ __('shop::app.customer.account.order.view.cancel-btn-title') }}
                            </a>
                        @endif
                    </figcaption>
                    <div class="ps-block__content">
                        <tabs>
                            <tab name="{{ __('shop::app.customer.account.order.view.info') }}" :selected="true">
                                <div class="sale-section">
                                    <div class="section-content">
                                        <div class="align-items-sm-baseline col-12 justify-content-start row">
                                            <label class="mr-20">
                                                {{ __('shop::app.customer.account.order.view.placed-on') }}
                                            </label>
                                            <strong>
                                                {{ core()->formatDate($order->created_at, 'd M Y') }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="sale-section">
                                    <div class="section-title">
                                        <h4 class="mt-10">{{ __('shop::app.customer.account.order.view.products-ordered') }}</h4>
                                    </div>
                                    <div class="section-content">
                                        <div class="table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        {{-- <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th> --}}
                                                        <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.item-status') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.tax-percent') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                                        <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                                    </tr>
                                                </thead>
                    
                                                <tbody>
                                                    @foreach ($order->items as $item)
                                                        <tr>
                                                            {{-- <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">
                                                                {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                                            </td> --}}
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">
                                                                {{ $item->name }}
                    
                                                                @if (isset($item->additional['attributes']))
                                                                    <div class="item-options">
                    
                                                                        @foreach ($item->additional['attributes'] as $attribute)
                                                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                                        @endforeach
                    
                                                                    </div>
                                                                @endif
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">
                                                                {{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.item-status') }}">
                                                                <span class="qty-row">
                                                                    {{ __('shop::app.customer.account.order.view.item-ordered', ['qty_ordered' => $item->qty_ordered]) }}
                                                                </span>
                    
                                                                <span class="qty-row">
                                                                    {{ $item->qty_invoiced ? __('shop::app.customer.account.order.view.item-invoice', ['qty_invoiced' => $item->qty_invoiced]) : '' }}
                                                                </span>
                    
                                                                <span class="qty-row">
                                                                    {{ $item->qty_shipped ? __('shop::app.customer.account.order.view.item-shipped', ['qty_shipped' => $item->qty_shipped]) : '' }}
                                                                </span>
                    
                                                                <span class="qty-row">
                                                                    {{ $item->qty_refunded ? __('shop::app.customer.account.order.view.item-refunded', ['qty_refunded' => $item->qty_refunded]) : '' }}
                                                                </span>
                    
                                                                <span class="qty-row">
                                                                    {{ $item->qty_canceled ? __('shop::app.customer.account.order.view.item-canceled', ['qty_canceled' => $item->qty_canceled]) : '' }}
                                                                </span>
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">
                                                                {{ core()->formatPrice($item->total, $order->order_currency_code) }}
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.tax-percent') }}">
                                                                {{ number_format($item->tax_percent, 2) }}%
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">
                                                                {{ core()->formatPrice($item->tax_amount, $order->order_currency_code) }}
                                                            </td>
                    
                                                            <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">
                                                                {{ core()->formatPrice($item->total + $item->tax_amount - $item->discount_amount, $order->order_currency_code) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                    
                                            </table>
                                        </div>
                                        <div class="totals d-flex justify-content-end">
                                            <table class="sale-summary">
                                                <tbody>
                                                    <tr class="h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.subtotal') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                                                        <td class="pb-2">{{ core()->formatPrice($order->sub_total, $order->order_currency_code) }}</td>
                                                    </tr>
                    
                                                    @if ($order->haveStockableItems())
                                                        <tr class="h4">
                                                            <td class="pb-2">{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td class="pb-2">{{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}</td>
                                                        </tr>
                                                    @endif
                    
                                                    @if ($order->base_discount_amount > 0)
                                                        <tr class="h4">
                                                            <td class="pb-2">{{ __('shop::app.customer.account.order.view.discount') }}
                                                                @if ($order->coupon_code)
                                                                    ({{ $order->coupon_code }})
                                                                @endif
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td class="pb-2">{{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}</td>
                                                        </tr>
                                                    @endif
                    
                                                    <tr class="border-bottom h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.tax') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                                                        <td class="pb-2">{{ core()->formatPrice($order->tax_amount, $order->order_currency_code) }}</td>
                                                    </tr>
                    
                                                    <tr class="h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.grand-total') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                                                        <td class="pb-2">{{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}</td>
                                                    </tr>
                    
                                                    <tr class="h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.total-paid') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                                                        <td class="pb-2">{{ core()->formatPrice($order->grand_total_invoiced, $order->order_currency_code) }}</td>
                                                    </tr>
                    
                                                    <tr class="h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.total-refunded') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                                                        <td class="pb-2"><strong>{{ core()->formatPrice($order->grand_total_refunded, $order->order_currency_code) }}</strong></td>
                                                    </tr>
                    
                                                    <tr class="h4">
                                                        <td class="pb-2">{{ __('shop::app.customer.account.order.view.total-due') }}
                                                            <span class="dash-icon">-</span>
                                                        </td>
                    
                                                        @if($order->status !== 'canceled')
                                                            <td class="pb-2">{{ core()->formatPrice($order->total_due, $order->order_currency_code) }}</td>
                                                        @else
                                                            <td class="pb-2">{{ core()->formatPrice(0.00, $order->order_currency_code) }}</td>
                                                        @endif
                                                    </tr>
                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </tab>
                    
                            @if ($order->invoices->count())
                                <tab name="{{ __('shop::app.customer.account.order.view.invoices') }}">
                                    @foreach ($order->invoices as $invoice)
                                        <div class="sale-section">
                                            <div class="section-title">
                                                <strong>{{ __('shop::app.customer.account.order.view.individual-invoice', ['invoice_id' => $invoice->increment_id ?? $invoice->id]) }}</strong>
                                                <a href="{{ route('customer.orders.print', $invoice->id) }}" class="float-right ps-btn btn-small mb-3">
                                                    {{ __('shop::app.customer.account.order.view.print') }}
                                                </a>
                                            </div>
                    
                                            <div class="section-content">
                                                <div class="table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                {{-- <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th> --}}
                                                                <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                                            </tr>
                                                        </thead>
                    
                                                        <tbody>
                    
                                                            @foreach ($invoice->items as $item)
                                                                <tr>
                                                                    {{-- <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">
                                                                        {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                                                    </td> --}}
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">
                                                                        {{ $item->name }}
                                                                    </td>
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">
                                                                        {{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                                                    </td>
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">
                                                                        {{ $item->qty }}
                                                                    </td>
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">
                                                                        {{ core()->formatPrice($item->total, $order->order_currency_code) }}
                                                                    </td>
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">
                                                                        {{ core()->formatPrice($item->tax_amount, $order->order_currency_code) }}
                                                                    </td>
                    
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">
                                                                        {{ core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                    
                                                <div class="totals d-flex justify-content-end">
                                                    <table class="sale-summary">
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.subtotal') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($invoice->sub_total, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($invoice->shipping_amount, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        @if ($invoice->base_discount_amount > 0)
                                                            <tr class="h4">
                                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}
                                                                    <span class="dash-icon">-</span>
                                                                </td>
                                                                <td>{{ core()->formatPrice($invoice->discount_amount, $order->order_currency_code) }}</td>
                                                            </tr>
                                                        @endif
                    
                                                        <tr class="border-bottom h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.tax') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($invoice->tax_amount, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.grand-total') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($invoice->grand_total, $order->order_currency_code) }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                    
                                    @endforeach
                    
                                </tab>
                            @endif
                    
                            @if ($order->shipments->count())
                                <tab name="{{ __('shop::app.customer.account.order.view.shipments') }}">
                    
                                    @foreach ($order->shipments as $shipment)
                    
                                        <div class="sale-section">
                                            <div class="section-content">
                                                <div class="mb-1 col-12 row justify-content-between">
                                                    <h4>Courier Title: <strong>{{  $shipment->carrier_title }}</strong></h4>
                                                    <h4>Tracking Number: <strong>{{  $shipment->track_number }}</strong></h4>
                                                </div>
                                                <div class="mb-3 col-12 row justify-content-between">
                                                    <p>To View Tracking Details, Copy the Tracking Number Above and paste it <a href="{{ $title->link }}" class="text-primary" target="_blank">here</a></p>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="sale-section">
                                            <div class="section-title">
                                                <strong>{{ __('shop::app.customer.account.order.view.individual-shipment', ['shipment_id' => $shipment->id]) }}</strong>
                                            </div>
                    
                                            <div class="section-content">
                                                <div class="table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                {{-- <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th> --}}
                                                                <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                                            </tr>
                                                        </thead>
                    
                                                        <tbody>
                    
                                                            @foreach ($shipment->items as $item)
                    
                                                                <tr>
                                                                    {{-- <td data-value="{{  __('shop::app.customer.account.order.view.SKU') }}">{{ $item->sku }}</td> --}}
                                                                    <td data-value="{{  __('shop::app.customer.account.order.view.product-name') }}">{{ $item->name }}</td>
                                                                    <td data-value="{{  __('shop::app.customer.account.order.view.qty') }}">{{ $item->qty }}</td>
                                                                </tr>
                    
                                                            @endforeach
                    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                    
                                    @endforeach
                    
                                </tab>
                            @endif
                    
                            @if ($order->refunds->count())
                                <tab name="{{ __('shop::app.customer.account.order.view.refunds') }}">
                                    @foreach ($order->refunds as $refund)
                                        <div class="sale-section">
                                            <div class="section-title">
                                                <strong>{{ __('shop::app.customer.account.order.view.individual-refund', ['refund_id' => $refund->id]) }}</strong>
                                            </div>
                                            <div class="section-content">
                                                <div class="table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                                                <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                                            </tr>
                                                        </thead>
                    
                                                        <tbody>
                    
                                                            @foreach ($refund->items as $item)
                                                                <tr>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">{{ $item->child ? $item->child->sku : $item->sku }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">{{ $item->name }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">{{ core()->formatPrice($item->price, $order->order_currency_code) }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">{{ $item->qty }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">{{ core()->formatPrice($item->total, $order->order_currency_code) }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">{{ core()->formatPrice($item->tax_amount, $order->order_currency_code) }}</td>
                                                                    <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">{{ core()->formatPrice($item->total + $item->tax_amount, $order->order_currency_code) }}</td>
                                                                </tr>
                                                            @endforeach
                    
                                                            @if (! $refund->items->count())
                                                                <tr>
                                                                    <td class="empty" colspan="7">{{ __('shop::app.common.no-result-found') }}</td>
                                                                <tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="totals d-flex justify-content-end">
                                                    <table class="sale-summary">
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.subtotal') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($refund->sub_total, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        @if ($refund->shipping_amount > 0)
                                                            <tr class="h4">
                                                                <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}
                                                                    <span class="dash-icon">-</span>
                                                                </td>
                                                                <td>{{ core()->formatPrice($refund->shipping_amount, $order->order_currency_code) }}</td>
                                                            </tr>
                                                        @endif
                    
                                                        @if ($refund->discount_amount > 0)
                                                            <tr class="h4">
                                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}
                                                                    <span class="dash-icon">-</span>
                                                                </td>
                                                                <td>{{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}</td>
                                                            </tr>
                                                        @endif
                    
                                                        @if ($refund->tax_amount > 0)
                                                            <tr class="h4">
                                                                <td>{{ __('shop::app.customer.account.order.view.tax') }}
                                                                    <span class="dash-icon">-</span>
                                                                </td>
                                                                <td>{{ core()->formatPrice($refund->tax_amount, $order->order_currency_code) }}</td>
                                                            </tr>
                                                        @endif
                    
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.adjustment-refund') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($refund->adjustment_refund, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        <tr class="h4 border-bottom">
                                                            <td>{{ __('shop::app.customer.account.order.view.adjustment-fee') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($refund->adjustment_fee, $order->order_currency_code) }}</td>
                                                        </tr>
                    
                                                        <tr class="h4">
                                                            <td>{{ __('shop::app.customer.account.order.view.grand-total') }}
                                                                <span class="dash-icon">-</span>
                                                            </td>
                                                            <td>{{ core()->formatPrice($refund->grand_total, $order->order_currency_code) }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                    
                                    @endforeach
                    
                                </tab>
                            @endif
                        </tabs>
                        <div class="sale-section">
                            <div class="section-content" style="border-bottom: 0">
                                <div class="order-box-container">
                                    <div class="box">
                                        <div class="box-title">
                                            {{ __('shop::app.customer.account.order.view.billing-address') }}
                                        </div>
                    
                                        <div class="box-content">
                                            @include ('admin::sales.address', ['address' => $order->billing_address])
                    
                                            {!! view_render_event('bagisto.shop.customers.account.orders.view.billing-address.after', ['order' => $order]) !!}
                                        </div>
                                    </div>
                    
                                    @if ($order->shipping_address)
                                        <div class="box">
                                            <div class="box-title">
                                                {{ __('shop::app.customer.account.order.view.shipping-address') }}
                                            </div>
                    
                                            <div class="box-content">
                                                @include ('admin::sales.address', ['address' => $order->shipping_address])
                    
                                                {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-address.after', ['order' => $order]) !!}
                                            </div>
                                        </div>
                                        <div class="box">
                                            <div class="box-title">
                                                {{ __('shop::app.customer.account.order.view.shipping-method') }}
                                            </div>
                    
                                            <div class="box-content">
                                                {{ $order->shipping_title }}
                    
                                                {!! view_render_event('bagisto.shop.customers.account.orders.view.shipping-method.after', ['order' => $order]) !!}
                                            </div>
                                            <div class="box-title">
                                                {{ __('shop::app.customer.account.order.view.payment-method') }}
                                            </div>
                                            <div class="box-content">
                                                {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                        
                                                @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp
                        
                                                @if (! empty($additionalDetails))
                                                    <div class="instructions">
                                                        <label>{{ $additionalDetails['title'] }}</label>
                                                        <p>{{ $additionalDetails['value'] }}</p>
                                                    </div>
                                                @endif
                        
                                                {!! view_render_event('bagisto.shop.customers.account.orders.view.payment-method.after', ['order' => $order]) !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="box">
                                            <div class="box-title">
                                                {{ __('shop::app.customer.account.order.view.payment-method') }}
                                            </div>
                                            <div class="box-content">
                                                {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                        
                                                @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp
                        
                                                @if (! empty($additionalDetails))
                                                    <div class="instructions">
                                                        <label>{{ $additionalDetails['title'] }}</label>
                                                        <p>{{ $additionalDetails['value'] }}</p>
                                                    </div>
                                                @endif
                        
                                                {!! view_render_event('bagisto.shop.customers.account.orders.view.payment-method.after', ['order' => $order]) !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
    {!! view_render_event('bagisto.shop.customers.account.orders.view.after', ['order' => $order]) !!}
@endsection

@push('scripts')
    <script>
        function cancelOrder(message) {
            if (! confirm(message)) {
                return;
            }

            $('#cancelOrderForm').submit();
        }
    </script>
@endpush