@extends('admin::layouts.content')

@section('page_title')
{{ __('admin::app.catalog.products.edit-title') }}
@stop

@push('css')
<style>
@media only screen and (max-width: 728px) {
    .content-container .content .page-header .page-title {
        width: 100%;
    }

    .content-container .content .page-header .page-title .control-group {
        margin-top: 20px !important;
        width: 100% !important;
        margin-left: 0 !important;
    }

    .content-container .content .page-header .page-action {
        margin-top: 10px !important;
        float: left;
    }
}
</style>
@endpush
@php
$sli_count = 1;
@endphp

@section('content')
<div class="content">
    @php
    $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
    $channel = core()->getRequestedChannelCode();
    $channelLocales = core()->getAllLocalesByRequestedChannel()['locales'];
    @endphp

    {!! view_render_event('bagisto.admin.catalog.product.edit.before', ['product' => $product]) !!}

    <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

        <div class="page-header">

            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="window.location = '{{ route('admin.catalog.products.index') }}'"></i>

                    {{ __('admin::app.catalog.products.edit-title') }}
                </h1>

                <div class="control-group">
                    <select class="control" id="channel-switcher" name="channel">
                        @foreach (core()->getAllChannels() as $channelModel)

                        <option value="{{ $channelModel->code }}"
                            {{ ($channelModel->code) == $channel ? 'selected' : '' }}>
                            {{ core()->getChannelName($channelModel) }}
                        </option>

                        @endforeach
                    </select>
                </div>

                <div class="control-group">
                    <select class="control" id="locale-switcher" name="locale">
                        @foreach ($channelLocales as $localeModel)

                        <option value="{{ $localeModel->code }}"
                            {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                            {{ $localeModel->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="page-action">
                <button type="submit" class="btn btn-lg btn-primary">
                    {{ __('admin::app.catalog.products.save-btn-title') }}
                </button>
            </div>
        </div>

        <div class="page-content">
            @csrf()
            <input type="hidden" name="user_id" value="{{auth()->guard('admin')->user()->id}}">

            <input name="_method" type="hidden" value="PUT">

            @foreach ($product->attribute_family->attribute_groups as $index => $attributeGroup)
            <?php $customAttributes = $product->getEditableAttributes($attributeGroup); ?>

            @if (count($customAttributes))

            {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.' . $attributeGroup->name .
            '.before', ['product' => $product]) !!}

            <accordian title="{{ __($attributeGroup->name) }}" :active="{{$index == 0 ? 'true' : 'false'}}">
                <div slot="body">
                    {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.' . $attributeGroup->name .
                    '.controls.before', ['product' => $product]) !!}

                    @foreach ($customAttributes->where('is_user_defined', '!=', 1) as $attribute)
                    @if($c_count==1)
                    <div class="control-group" :class="[errors.has('country') ? 'has-error' : '']">
                        <label for="country" class="required">Country</label>
                        <select class="control select2" v-validate="'required'" multiple id="country" name="country[]">
                            @foreach ($countries as $item)
                            @if(old('country'))
                            <option value="{{ $item->code }}" {{ (old('country') == $item->code) ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                            @else
                            <option value="{{ $item->code }}"
                                >
                                {{ $item->name }}</option>
                            @endif

                            @endforeach
                        </select>

                        <span class="control-error" v-if="errors.has('country')">@{{ errors.first('country') }}</span>
                    </div>
                    <p style="display:none;">{{$c_count = 0}}</p>
                    @endif

                    @if($d_count==1)
                    <div class="control-group" :class="[errors.has('delivery_charge') ? 'has-error' : '']">
                        <label for="delivery_charge" class="required">Delivery Charge</label>

                        <input type="text" class="control" v-validate="'required'" id="delivery_charge"
                            name="delivery_charge" value="{{ $product->delivery_charge }}">

                        <span class="control-error"
                            v-if="errors.has('delivery_charge')">@{{ errors.first('delivery_charge') }}</span>
                    </div>
                    <p style="display:none;">{{$d_count = 0}}</p>
                    @endif


                    <?php
                                        if ($attribute->code == 'guest_checkout' && ! core()->getConfigData('catalog.products.guest-checkout.allow-guest-checkout')) {
                                            continue;
                                        }

                                        $validations = [];

                                        if ($attribute->is_required) {
                                            array_push($validations, 'required');
                                        }

                                        if ($attribute->type == 'price') {
                                            array_push($validations, 'decimal');
                                        }

                                        if ($attribute->type == 'file') {
                                            $retVal = (core()->getConfigData('catalog.products.attribute.file_attribute_upload_size')) ? core()->getConfigData('catalog.products.attribute.file_attribute_upload_size') : '2048' ;
                                            array_push($validations, 'size:' . $retVal);
                                        }

                                        if ($attribute->type == 'image') {
                                            $retVal = (core()->getConfigData('catalog.products.attribute.image_attribute_upload_size')) ? core()->getConfigData('catalog.products.attribute.image_attribute_upload_size') : '2048' ;
                                            array_push($validations, 'size:' . $retVal . '|mimes:bmp,jpeg,jpg,png,webp');
                                        }

                                        array_push($validations, $attribute->validation);

                                        $validations = implode('|', array_filter($validations));
                                    ?>

                    @if (view()->exists($typeView = 'admin::catalog.products.field-types.' . $attribute->type))

                    <div class="control-group {{ $attribute->type }} {{ $attribute->enable_wysiwyg ? 'have-wysiwyg' : '' }}"
                        @if ($attribute->type == 'multiselect') :class="[errors.has('{{ $attribute->code }}[]') ?
                        'has-error' : '']"
                        @else :class="[errors.has('{{ $attribute->code }}') ? 'has-error' : '']" @endif>

                        <label for="{{ $attribute->code }}" {{ $attribute->is_required ? 'class=required' : '' }}>
                            {{ $attribute->admin_name }}

                            @if ($attribute->type == 'price')
                            <span class="currency-code">({{ core()->getBaseCurrency()->symbol }})</span>
                            @endif

                            <?php
                                                $channel_locale = [];

                                                if ($attribute->value_per_channel) {
                                                    array_push($channel_locale, $channel);
                                                }

                                                if ($attribute->value_per_locale) {
                                                    array_push($channel_locale, $locale);
                                                }
                                                ?>

                            @if (count($channel_locale))
                            <span class="locale">[{{ implode(' - ', $channel_locale) }}]</span>
                            @endif
                        </label>

                        @include ($typeView)

                        <span class="control-error" @if ($attribute->type == 'multiselect')
                            v-if="errors.has('{{ $attribute->code }}[]')"
                            @else v-if="errors.has('{{ $attribute->code }}')" @endif>
                            @if ($attribute->type == 'multiselect')
                            @{{ errors.first('{!! $attribute->code !!}[]') }}
                            @else
                            @{{ errors.first('{!! $attribute->code !!}') }}
                            @endif
                        </span>
                    </div>

                    @endif

                    @endforeach

                    @if ($attributeGroup->name == 'Price')

                    @include ('admin::catalog.products.accordians.customer-group-price')

                    @endif

                    @if($sli_count==1)
                        <div class="control-group boolean" :class="[errors.has('is_mens_fashion') ? 'has-error' : '']">
                            <label for="is_mens_fashion" class="">Mens Fashion</label>
                            <label class="switch">
                                <input type="checkbox" class="control" id="is_mens_fashion" name="is_mens_fashion" @if($product->is_mens_fashion == 1) checked @endif>
                                <span class="slider round"></span>
                            </label>
                            <span class="control-error"
                                v-if="errors.has('is_mens_fashion')">@{{ errors.first('is_mens_fashion') }}</span>
                        </div>

                        <div class="control-group boolean" :class="[errors.has('is_womens_fashion') ? 'has-error' : '']">
                            <label for="is_womens_fashion" class="">Womens Fashion</label>
                            <label class="switch">
                                <input type="checkbox" class="control" id="is_womens_fashion" name="is_womens_fashion" @if($product->is_womens_fashion == 1) checked @endif>
                                <span class="slider round"></span>
                            </label>
                            <span class="control-error"
                                v-if="errors.has('is_womens_fashion')">@{{ errors.first('is_womens_fashion') }}</span>
                        </div>

                        <div class="control-group boolean" :class="[errors.has('is_electronics') ? 'has-error' : '']">
                            <label for="is_electronics" class="">Electronics</label>
                            <label class="switch">
                                <input type="checkbox" class="control" id="is_electronics" name="is_electronics" @if($product->is_electronics == 1) checked @endif>
                                <span class="slider round"></span>
                            </label>
                            <span class="control-error"
                                v-if="errors.has('is_electronics')">@{{ errors.first('is_electronics') }}</span>
                        </div>

                        <div class="control-group boolean" :class="[errors.has('is_accessories') ? 'has-error' : '']">
                            <label for="is_accessories" class="">Accessories</label>
                            <label class="switch">
                                <input type="checkbox" class="control" id="is_accessories" name="is_accessories" @if($product->is_accessories == 1) checked @endif>
                                <span class="slider round"></span>
                            </label>
                            <span class="control-error"
                                v-if="errors.has('is_accessories')">@{{ errors.first('is_accessories') }}</span>
                        </div>
                        <p style="display:none;">{{$sli_count = 0}}</p>
                    @endif

                    {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.' . $attributeGroup->name .
                    '.controls.after', ['product' => $product]) !!}
                </div>
            </accordian>

            {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.' . $attributeGroup->name .
            '.after', ['product' => $product]) !!}

            @endif

            @endforeach

            {!! view_render_event(
            'bagisto.admin.catalog.product.edit_form_accordian.additional_views.before',
            ['product' => $product])
            !!}
            @foreach ($product->getTypeInstance()->getAdditionalViews() as $view)
            @if($view != 'admin::catalog.products.accordians.product-links')
            @include ($view)
            @endif
            @endforeach

            {!! view_render_event(
            'bagisto.admin.catalog.product.edit_form_accordian.additional_views.after',
            ['product' => $product])
            !!}
        </div>

    </form>

    {!! view_render_event('bagisto.admin.catalog.product.edit.after', ['product' => $product]) !!}
</div>
@stop

@push('scripts')
@include('admin::layouts.tinymce')

<script>
$(document).ready(function() {
    $('#channel-switcher, #locale-switcher').on('change', function(e) {
        $('#channel-switcher').val()

        if (event.target.id == 'channel-switcher') {
            let locale =
                "{{ app('Webkul\Core\Repositories\ChannelRepository')->findOneByField('code', $channel)->locales->first()->code }}";

            $('#locale-switcher').val(locale);
        }

        var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher')
            .val();

        window.location.href = "{{ route('admin.catalog.products.edit', $product->id)  }}" + query;
    });

    tinyMCEHelper.initTinyMCE({
        selector: 'textarea.enable-wysiwyg, textarea.enable-wysiwyg',
        height: 200,
        width: "100%",
        plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',
        image_advtab: true,
    });
    $('.select2').select2();
});
</script>
@endpush