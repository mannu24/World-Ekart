@extends('admin::layouts.content')

@section('page_title')
{{ __('admin::app.catalog.products.add-title') }}
@stop

@push('css')
<style>
.table td .label {
    margin-right: 10px;
}

.table td .label:last-child {
    margin-right: 0;
}

.table td .label .icon {
    vertical-align: middle;
    cursor: pointer;
}
</style>
@endpush
@php
    $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
    $channel = core()->getRequestedChannelCode();
    
    $channelLocales = core()->getAllLocalesByRequestedChannel()['locales'];

    $item = $families->first() ;

    $general = $item->attribute_groups->where('name','General')->first() ;
    $generalAtt = $general->custom_attributes()->whereNotIn( 'attributes.code', [] )->get() ;

    $price = $item->attribute_groups->where('name','Price')->first() ;
    $priceAtt = $price->custom_attributes()->whereNotIn( 'attributes.code', [] )->get() ;

    $shipping = $item->attribute_groups->where('name','Shipping')->first() ;
    $shipAtt = $shipping->custom_attributes()->whereNotIn( 'attributes.code', [] )->get() ;
@endphp

@section('content')
<div class="content">
    <form method="POST" action="" enctype="multipart/form-data" @submit.prevent="onSubmit">

        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="window.location = '{{ route('admin.catalog.products.index') }}'"></i>

                    {{ __('admin::app.catalog.products.add-title') }}
                </h1>
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
            <input type="hidden" name="channel" value="{{$channel}}">
            <input type="hidden" name="locale" value="{{$locale}}">

            <general-accordian></general-accordian>

            <accordian title="Description" :active="false">
                <div slot="body">
                    <div class="control-group have-wysiwyg" :class="[errors.has('description') ? 'has-error' : '']">
                        <label for="description" class="required">Description</label>
                        <textarea v-validate="'required'" class="control enable-wysiwyg" id="description" name="description" data-vv-as="&quot;Description&quot;">{{ old('description') ?? '' }}</textarea>
                        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                    </div>
                    <div class="control-group have-wysiwyg" :class="[errors.has('short_description') ? 'has-error' : '']">
                        <label for="short_description" class="required">Short Description</label>
                        <textarea v-validate="'required'" class="control enable-wysiwyg" id="short_description" name="short_description" data-vv-as="&quot;Short Description&quot;">{{ old('short_description') ?? '' }}</textarea>
                        <span class="control-error" v-if="errors.has('short_description')">@{{ errors.first('short_description') }}</span>
                    </div>
                </div>
            </accordian>

            <accordian title="SEO Information" :active="false">
                <div slot="body">
                    <div class="control-group textarea" :class="[errors.has('meta_title') ? 'has-error' : '']">
                        <label for="meta_title">Meta Title</label>
                        <textarea v-validate="''" class="control" id="meta_title" name="meta_title" data-vv-as="&quot;Meta Title&quot;">{{ old('meta_title') ?? '' }}</textarea>
                        <span class="control-error" v-if="errors.has('meta_title')">@{{ errors.first('meta_title') }}</span>
                    </div>
                    <div class="control-group textarea" :class="[errors.has('meta_keywords') ? 'has-error' : '']">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea v-validate="''" class="control" id="meta_keywords" name="meta_keywords" data-vv-as="&quot;Meta Keywords&quot;">{{ old('meta_keywords') ?? '' }}</textarea>
                        <span class="control-error" v-if="errors.has('meta_keywords')">@{{ errors.first('meta_keywords') }}</span>
                    </div>
                    <div class="control-group textarea" :class="[errors.has('meta_description') ? 'has-error' : '']">
                        <label for="meta_description">Meta Description</label>
                        <textarea v-validate="''" class="control" id="meta_description" name="meta_description" data-vv-as="&quot;Meta Description&quot;">{{ old('meta_description') ?? '' }}</textarea>
                        <span class="control-error" v-if="errors.has('meta_description')">@{{ errors.first('meta_description') }}</span>
                    </div>
                </div>
            </accordian>
            
            @if (count($priceAtt))
                <accordian title="Price" :active="false">
                    <div slot="body">
                        @foreach ($priceAtt as $attribute)
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
                                if($attribute->type == 'price') $typeView = 'admin::catalog.products.field-types.price1' ;
                                else if($attribute->type == 'date') $typeView = 'admin::catalog.products.field-types.date1' ;
                                else $typeView = 'admin::catalog.products.field-types.' . $attribute->type ;
                            ?>
                            @if (view()->exists($typeView))
                                <div class="control-group {{ $attribute->type }} {{ $attribute->enable_wysiwyg ? 'have-wysiwyg' : '' }}"
                                    @if ($attribute->type == 'multiselect') :class="[errors.has('{{ $attribute->code }}[]') ? 'has-error' : '']"
                                    @else :class="[errors.has('{{ $attribute->code }}') ? 'has-error' : '']" @endif>
            
                                    <label for="{{ $attribute->code }}" {{ $attribute->is_required ? 'class=required' : '' }}>

                                        {{ $attribute->admin_name }}
            
                                        {{-- @if ($attribute->type == 'price')
                                            <span class="currency-code">({{ core()->getBaseCurrency()->symbol }})</span>
                                        @endif --}}

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
    
                    </div>
                </accordian>
            @endif
            
            @if (count($shipAtt))
                <shipping-accordian></shipping-accordian>
            @endif

            <inventory-accordian></inventory-accordian>                                

            <accordian title="{{ __('admin::app.catalog.products.images') }}" :active="false">
                <div slot="body">
                    <div class="control-group {{ $errors->has('images.files.*') ? 'has-error' : '' }}">
                        <label>{{ __('admin::app.catalog.categories.image') }}</label>
            
                        <product-image></product-image>
            
                        <span
                            class="control-error"
                            v-text="'{{ $errors->first('images.files.*') }}'">
                        </span>
            
                        <span class="control-info mt-10">{{ __('admin::app.catalog.products.image-size') }}</span>
                    </div>
                </div>
            </accordian>

            <accordian title="{{ __('admin::app.catalog.products.videos') }}" :active="false">
                <div slot="body">
                    <div class="control-group {{ $errors->has('videos.files.*') ? 'has-error' : '' }}">
                        <label>{{ __('admin::app.catalog.products.video') }}</label>
            
                        <product-video></product-video>
            
                        <span
                            class="control-error"
                            v-text="'{{ $errors->first('videos.files.*') }}'">
                        </span>
                    </div>
                </div>
            </accordian>

            <accordian title="{{ __('admin::app.catalog.products.categories') }}" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label for="">Select Product Categories</label>
                        <select name="categories[]" multiple required class="control form-control select2" style="width:100%;">
                            @foreach($categories as $category) 
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @if ($category->children->count() > 0)
                                    @foreach($category->children as $sub_category) 
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @if ($sub_category->children->count() > 0)
                                            @foreach($sub_category->children as $sub_sub_category) 
                                                <option value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{-- <tree-view behavior="normal" value-field="id" name-field="categories" input-type="checkbox" items='@json($categories)' value="" fallback-locale="{{ config('app.fallback_locale') }}"></tree-view> --}}
                </div>
            </accordian>
            
            <variation-accordian></variation-accordian>
            
            <modal id="addVariant" :is-open="modalIds.addVariant">
                <h3 slot="header">{{ __('admin::app.catalog.products.add-variant-title') }}</h3>
            
                <div slot="body">
                    <variant-form></variant-form>
                </div>
            </modal>
          
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
    @include('admin::layouts.tinymce')
    <script>
        $(document).ready(function() {
            tinyMCEHelper.initTinyMCE({
                selector: 'textarea.enable-wysiwyg, textarea.enable-wysiwyg',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',
                image_advtab: true,
            });
            $('.select2').select2() ;
            $('.select2-p').select2({ 
                tags:true, maximumSelectionLength: 3,
            }) ;
        })
        let g_att = [], super_attributes = [], variants = [] ;

    </script>

    <script type="text/x-template" id="general-accordian-template">
        <accordian title="{{ __('admin::app.catalog.products.general') }}" :active="false">
            <div slot="body">
                <div class="control-group" :class="[errors.has('type') ? 'has-error' : '']">
                    <label for="type" class="required">{{ __('admin::app.catalog.products.product-type') }}</label>
                    <select class="control" @change="type_change($event)" v-validate="'required'" id="type" name="type"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.product-type') }}&quot;">
                        <option value="simple">Simple</option>
                        <option value="configurable" selected>Configurable</option>
                    </select>
                    <span class="control-error" v-if="errors.has('type')">@{{ errors.first('type') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('attribute_family_id') ? 'has-error' : '']">
                    <label for="attribute_family_id"
                        class="required">{{ __('admin::app.catalog.products.familiy') }}</label>

                    <select class="control" @change="family_change($event)" v-validate="'required'" id="attribute_family_id" name="attribute_family_id"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.familiy') }}&quot;">
                        @foreach ($families as $family)
                            <option value="{{ $family->id }}" {{ old('attribute_family_id') == $family->id ? 'selected' : '' }}>
                                {{ $family->name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="control-error" v-if="errors.has('attribute_family_id')">@{{ errors.first('attribute_family_id') }}</span>
                </div>

                <div class="control-group col-md-12" :class="[errors.has('country') ? 'has-error' : '']">
                    <label for="country" class="required">Country</label>

                    <select class="control select2" multiple v-validate="'required'" id="country" name="country[]" style="width:525px">
                        @foreach ($countries as $item)
                            @if(old('country'))
                            <option value="{{ $item->code }}" {{ (old('country') == $item->code) ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                            @else
                            <option value="{{ $item->code }}" {{ ($item->code == 'IN') ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="control-error" v-if="errors.has('country')">@{{ errors.first('country') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('delivery_charge') ? 'has-error' : '']">
                    <label for="delivery_charge" class="required">Delivery Charge</label>

                    <input type="text" v-validate="{ required: true}"
                        class="control" id="delivery_charge" name="delivery_charge" value="{{ request()->input('delivery_charge') ?: old('delivery_charge') }}"
                        data-vv-as="&quot;Delivery Charge&quot;" />
                    <span class="control-error" v-if="errors.has('delivery_charge')">@{{ errors.first('delivery_charge') }}</span>
                </div>

                

                @foreach ($generalAtt as $attribute)

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
                        if($attribute->type == 'text') $typeView = 'admin::catalog.products.field-types.text1' ;
                        else if($attribute->type == 'select') $typeView = 'admin::catalog.products.field-types.select1' ;
                        else if($attribute->type == 'boolean') $typeView = 'admin::catalog.products.field-types.boolean1' ;
                        else $typeView = 'admin::catalog.products.field-types.' . $attribute->type ;
                    ?>
                    @if ($attribute->code != 'url_key' && $attribute->is_user_defined != 1 && $attribute->code != 'product_number')
                        @if (view()->exists($typeView))
                            <div class="control-group {{ $attribute->type }} {{ $attribute->enable_wysiwyg ? 'have-wysiwyg' : '' }}"
                                @if ($attribute->type == 'multiselect') :class="[errors.has('{{ $attribute->code }}[]') ? 'has-error' : '']"
                                @else :class="[errors.has('{{ $attribute->code }}') ? 'has-error' : '']" @endif>

                                <label for="{{ $attribute->code }}" {{ $attribute->is_required ? 'class=required' : '' }}>

                                    {{ $attribute->admin_name }}

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
                    @endif
                @endforeach

                <div class="control-group boolean" :class="[errors.has('is_mens_fashion') ? 'has-error' : '']">
                    <label for="is_mens_fashion" class="">Mens Fashion</label>
                    <label class="switch">
                        <input type="checkbox" class="control" id="is_mens_fashion" name="is_mens_fashion" >
                        <span class="slider round"></span>
                    </label>
                    <span class="control-error" v-if="errors.has('is_mens_fashion')">@{{ errors.first('is_mens_fashion') }}</span>
                </div>

                <div class="control-group boolean" :class="[errors.has('is_womens_fashion') ? 'has-error' : '']">
                    <label for="is_womens_fashion" class="">Womens Fashion</label>
                    <label class="switch">
                        <input type="checkbox" class="control" id="is_womens_fashion" name="is_womens_fashion" >
                        <span class="slider round"></span>
                    </label>
                    <span class="control-error" v-if="errors.has('is_womens_fashion')">@{{ errors.first('is_womens_fashion') }}</span>
                </div>

                <div class="control-group boolean" :class="[errors.has('is_electronics') ? 'has-error' : '']">
                    <label for="is_electronics" class="">Electronics</label>
                    <label class="switch">
                        <input type="checkbox" class="control" id="is_electronics" name="is_electronics" >
                        <span class="slider round"></span>
                    </label>
                    <span class="control-error" v-if="errors.has('is_electronics')">@{{ errors.first('is_electronics') }}</span>
                </div>

                <div class="control-group boolean" :class="[errors.has('is_accessories') ? 'has-error' : '']">
                    <label for="is_accessories" class="">Accessories</label>
                    <label class="switch">
                        <input type="checkbox" class="control" id="is_accessories" name="is_accessories" >
                        <span class="slider round"></span>
                    </label>
                    <span class="control-error" v-if="errors.has('is_accessories')">@{{ errors.first('is_accessories') }}</span>
                </div>
            </div>
        </accordian>
    </script>

    <script>
        Vue.component('general-accordian', {
            template: '#general-accordian-template',

            data: function() {
                return {
                    product_type : '', 
                    family: '1',
                }
            },

            mounted: function() {
                eventBus.$emit('familyChange', this.family);
            },

            methods: {
                type_change: function(e) {
                    this.product_type = e.target.value ;
                    eventBus.$emit('changeIt', this.product_type);
                },
                family_change: function(e) {
                    this.family = e.target.value ;
                    eventBus.$emit('familyChange', this.family);
                },
            }
        });

    </script>

    <script type="text/x-template" id="inventory-accordian-template">
        <accordian title="{{ __('admin::app.catalog.products.inventories') }}" v-if="product_type=='simple'" :active="false">
            <div slot="body">


                @foreach ($inventorySources as $inventorySource)
                    <?php

                        $qty = 0;

                        $qty = old('inventories[' . $inventorySource->id . ']') ?: $qty;

                    ?>
                    <div class="control-group" :class="[errors.has('inventories[{{ $inventorySource->id }}]') ? 'has-error' : '']">
                        <label>{{ $inventorySource->name }}</label>

                        <input type="text" v-validate="'numeric|min:0'" name="inventories[{{ $inventorySource->id }}]" class="control" value="{{ $qty }}" data-vv-as="&quot;{{ $inventorySource->name }}&quot;"/>
                        
                        <span class="control-error" v-if="errors.has('inventories[{{ $inventorySource->id }}]')">@{{ errors.first('inventories[{!! $inventorySource->id !!}]') }}</span>
                    </div>
                
                @endforeach


            </div>
        </accordian>
    </script>

    <script>
        Vue.component('inventory-accordian', {
            template: '#inventory-accordian-template',

            data: function() {
                return {
                    product_type : '', 
                    family: '1',
                }
            },

            created: function() {
                eventBus.$on('changeIt', (data) => {
                    this.product_type = data
                })
            },

            methods: {
                type_change: function(e) {
                    this.product_type = e.target.value ;
                    eventBus.$emit('changeIt', this.product_type);
                },
                family_change: function(e) {
                    this.family = e.target.value ;
                    eventBus.$emit('familyChange', this.family);
                },
            }
        });

    </script>

    <script type="text/x-template" id="variation-accordian-template">
        <accordian title="{{ __('admin::app.catalog.products.variations') }}" v-if="product_type!='simple'" :active="false">
            <div slot="body">
                <div class="control-group">
                    <label for="">Select Attributes</label>
                    <select v-select2 v-model="var_att" @change="var_att_c" multiple required class="control form-control select2-p" style="width:100%;">
                        <option v-for='(a, index) in attributes' :value="a" v-text="a.name"></option>
                    </select>
                </div>
                <button type="button" class="btn btn-lg btn-primary" @click="showModal('addVariant',true)">Create Variants</button>
                <div class="mt-20 mb-10" />
                <variant-list></variant-list>
            </div>
        </accordian>
    </script>

    <script>
        Vue.directive('select2', {
            inserted(el) {
                $(el).on('select2:select', () => {
                    const event = new Event('change', { bubbles: true, cancelable: true });
                    el.dispatchEvent(event);
                });

                $(el).on('select2:unselect', () => {
                    const event = new Event('change', {bubbles: true, cancelable: true})
                    el.dispatchEvent(event)
                })
            },
        });
        Vue.component('variation-accordian', {
            template: '#variation-accordian-template',

            data: function() {
                return {
                    product_type : '', 
                    var_att: [],
                    attributes: @json($att),
                }
            },

            created: function() {
                eventBus.$on('changeIt', (data) => {
                    this.product_type = data
                })
                $('.select2-p').select2({ tags:true, maximumSelectionLength: 3 }) ;
            },

            updated() {
                $('.select2-p').select2({ tags:true, maximumSelectionLength: 3 }) ;
            },

            methods: {
                type_change: function(e) {
                    this.product_type = e.target.value ;
                    eventBus.$emit('changeIt', this.product_type);
                },

                var_att_c: function() {
                    g_att = this.var_att ;
                },

                showModal(id,v) {
                    this.$root.$set(this.$root.modalIds, id, v);
                },
            }
        });

    </script>

    <script type="text/x-template" id="shipping-accordian-template">
        <accordian title="Shippings" :active="false">
            <div slot="body">
                @foreach ($shipAtt as $attribute)
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
                        if($attribute->type == 'price') $typeView = 'admin::catalog.products.field-types.price1' ;
                        else if($attribute->type == 'date') $typeView = 'admin::catalog.products.field-types.date1' ;
                        else if($attribute->type == 'text') $typeView = 'admin::catalog.products.field-types.text1' ;
                        else $typeView = 'admin::catalog.products.field-types.' . $attribute->type ;
                    ?>
                    @if (view()->exists($typeView))
                        <div class="control-group {{ $attribute->type }} {{ $attribute->enable_wysiwyg ? 'have-wysiwyg' : '' }}"
                            @if ($attribute->type == 'multiselect') :class="[errors.has('{{ $attribute->code }}[]') ? 'has-error' : '']"
                            @else :class="[errors.has('{{ $attribute->code }}') ? 'has-error' : '']" @endif>
    
                            <label for="{{ $attribute->code }}" {{ $attribute->is_required ? 'class=required' : '' }}>

                                {{ $attribute->admin_name }}

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
            </div>
        </accordian>
    </script>

    <script>
        Vue.component('shipping-accordian', {
            template: '#shipping-accordian-template',

            data: function() {
                return {
                    product_type : '', 
                }
            },

            created: function() {
                // eventBus.$on('changeIt', (data) => {
                //     this.product_type = data
                // })
            },

            methods: {
            }
        });

    </script>

    <script type="text/x-template" id="product-image-template">
        <div>
            <div class="image-wrapper">
                <draggable v-model="items" group="people" @end="onDragEnd">
                    <product-image-item
                        v-for='(image, index) in items'
                        :key='image.id'
                        :image="image"
                        @onRemoveImage="removeImage($event)"
                        @onImageSelected="imageSelected($event)">
                    </product-image-item>
                </draggable>
            </div>

            <label class="btn btn-lg btn-primary" style="display: table; width: auto" @click="createFileType">
                {{ __('admin::app.catalog.products.add-image-btn-title') }}
            </label>
        </div>
    </script>

    <script>
        Vue.component('product-image', {
            template: '#product-image-template',

            data: function() {
                return {
                    images: [],

                    imageCount: 0,

                    items: [],
                }
            },

            computed: {
                finalInputName: function() {
                    return 'images[' + this.image.id + ']';
                }
            },

            created: function() {
                let self = this;

                this.images.forEach(function(image) {
                    self.items.push(image)

                    self.imageCount++;
                });
            },

            methods: {
                createFileType: function() {
                    let self = this;

                    this.imageCount++;

                    this.items.push({'id': 'image_' + this.imageCount});
                },

                removeImage: function(image) {
                    let index = this.items.indexOf(image)

                    Vue.delete(this.items, index);
                },

                imageSelected: function(event) {
                    let self = this;

                    Array.from(event.files).forEach(function(image, index) {
                        if (index) {
                            self.imageCount++;

                            self.items.push({'id': 'image_' + self.imageCount, file: image});
                        }
                    });
                },

                onDragEnd: function() {
                    this.items = this.items.map((item, index) => {
                        item.position = index;

                        return item;
                    });
                },
            }
        });

        Vue.component('product-image-item', {
            template: '#product-image-item-template',

            props: {
                image: {
                    type: Object,
                    required: false,
                    default: null
                },
            },

            data: function() {
                return {
                    imageData: '',

                    new_image: 0
                }
            },

            mounted () {
                if (this.image.id && this.image.url) {
                    this.imageData = this.image.url;
                } else if (this.image.id && this.image.file) {
                    this.readFile(this.image.file);
                }
            },

            computed: {
                finalInputName: function() {
                    return this.inputName + '[' + this.image.id + ']';
                }
            },

            methods: {
                addImageView: function() {
                    let imageInput = this.$refs.imageInput;

                    if (imageInput.files && imageInput.files[0]) {
                        if (imageInput.files[0].type.includes('image/')) {
                            this.readFile(imageInput.files[0])

                            if (imageInput.files.length > 1) {
                                this.$emit('onImageSelected', imageInput)
                            }
                        } else {
                            imageInput.value = "";

                            alert('Only images (.jpeg, .jpg, .png, ..) are allowed.');
                        }
                    }
                },

                readFile: function(image) {
                    let reader = new FileReader();

                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }

                    reader.readAsDataURL(image);

                    this.new_image = 1;
                },

                removeImage: function() {
                    this.$emit('onRemoveImage', this.image)
                }
            }
        });
    </script>

    <script type="text/x-template" id="product-image-item-template">
        <label class="image-item" v-bind:class="{ 'has-image': imageData.length > 0 }">
            <input
                type="hidden"
                :name="'images[files][' + image.id + ']'"
                v-if="! new_image"/>

            <input
                type="hidden"
                :name="'images[positions][' + image.id + ']'"/>

            <input
                :id="_uid"
                ref="imageInput"
                type="file"
                name="images[files][]"
                accept="image/*"
                multiple="multiple"
                v-validate="'mimes:image/*'"
                @change="addImageView($event)"/>

            <img
                class="preview"
                :src="imageData"
                v-if="imageData.length > 0">

            <label class="remove-image" @click="removeImage()">
                {{ __('admin::app.catalog.products.remove-image-btn-title') }}
            </label>
        </label>
    </script>

    <script>
        Vue.component('product-image-item', {
            template: '#product-image-item-template',

            props: {
                image: {
                    type: Object,
                    required: false,
                    default: null
                },
            },

            data: function() {
                return {
                    imageData: '',

                    new_image: 0
                }
            },

            mounted () {
                if (this.image.id && this.image.url) {
                    this.imageData = this.image.url;
                } else if (this.image.id && this.image.file) {
                    this.readFile(this.image.file);
                }
            },

            computed: {
                finalInputName: function() {
                    return this.inputName + '[' + this.image.id + ']';
                }
            },

            methods: {
                addImageView: function() {
                    let imageInput = this.$refs.imageInput;

                    if (imageInput.files && imageInput.files[0]) {
                        if (imageInput.files[0].type.includes('image/')) {
                            this.readFile(imageInput.files[0])

                            if (imageInput.files.length > 1) {
                                this.$emit('onImageSelected', imageInput)
                            }
                        } else {
                            imageInput.value = "";

                            alert('Only images (.jpeg, .jpg, .png, ..) are allowed.');
                        }
                    }
                },

                readFile: function(image) {
                    let reader = new FileReader();

                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }

                    reader.readAsDataURL(image);

                    this.new_image = 1;
                },

                removeImage: function() {
                    this.$emit('onRemoveImage', this.image)
                }
            }
        });
    </script>

    <script type="text/x-template" id="product-video-template">
        <div>
            <div class="image-wrapper">
                <draggable v-model="items" group="people" @end="onDragEnd">
                    <product-video-item
                        v-for='(video, index) in items'
                        :key='video.id'
                        :video="video"
                        @onRemoveVideo="removeVideo($event)"
                        @onVideoSelected="videoSelected($event)">
                    </product-video-item>
                </draggable>
            </div>

            <label class="btn btn-lg btn-primary" style="display: table; width: auto" @click="createFileType">
                {{ __('admin::app.catalog.products.add-video-btn-title') }}
            </label>
        </div>
    </script>

    <script type="text/x-template" id="product-video-item-template">
        <label class="image-item" v-bind:class="{ 'has-image': videoData.length > 0 }">
            <input
                type="hidden"
                :name="'videos[files][' + video.id + ']'"
                v-if="! new_video"/>

            <input
                type="hidden"
                :name="'videos[positions][' + video.id + ']'"/>

            <input
                :id="_uid"
                ref="videoInput"
                type="file"
                name="videos[files][]"
                accept="video/*"
                multiple="multiple"
                v-validate="'mimes:video/*'"
                @change="addVideoView($event)"/>

            <video class="preview" v-if="videoData.length > 0" width="200" height="160" controls>
                <source :src="videoData"  type="video/mp4">

                {{ __('admin::app.catalog.products.not-support-video') }}
            </video>

            <label class="remove-image" @click="removeVideo()">
                {{ __('admin::app.catalog.products.remove-video-btn-title') }}
            </label>
        </label>
    </script>

    <script>
        Vue.component('product-video', {
            template: '#product-video-template',

            data: function() {
                return {
                    videos: [],

                    videoCount: 0,

                    items: [],
                }
            },

            computed: {
                finalInputName: function() {
                    return 'videos[' + this.video.id + ']';
                }
            },

            created: function() {
                let self = this;

                this.videos.forEach(function(video) {
                    self.items.push(video);

                    self.videoCount++;
                });
            },

            methods: {
                createFileType: function() {
                    let self = this;

                    this.videoCount++;

                    this.items.push({'id': 'video_' + this.videoCount});
                },

                removeVideo: function(video) {
                    let index = this.items.indexOf(video);

                    Vue.delete(this.items, index);
                },

                videoSelected: function(event) {
                    let self = this;

                    Array.from(event.files).forEach(function(video, index) {
                        if (index) {
                            self.videoCount++;

                            self.items.push({'id': 'video_' + self.videoCount, file: video});
                        }
                    });
                },

                onDragEnd: function() {
                    this.items = this.items.map((item, index) => {
                        item.position = index;

                        return item;
                    });
                },
            }
        });

        Vue.component('product-video-item', {
            template: '#product-video-item-template',

            props: {
                video: {
                    type: Object,
                    required: false,
                    default: null,
                },
            },

            data: function() {
                return {
                    videoData: '',

                    new_video: 0,
                };
            },

            mounted () {
                if (this.video.id && this.video.url) {
                    this.videoData = this.video.url;
                } else if (this.video.id && this.video.file) {
                    this.readFile(this.video.file);
                }
            },

            computed: {
                finalInputName: function() {
                    return this.inputName + '[' + this.video.id + ']';
                }
            },

            methods: {
                addVideoView: function() {
                    let videoInput = this.$refs.videoInput;

                    if (videoInput.files && videoInput.files[0]) {
                        if (videoInput.files[0].type.includes('video/')) {
                            this.readFile(videoInput.files[0]);

                            if (videoInput.files.length > 1) {
                                this.$emit('onVideoSelected', videoInput);
                            }
                        } else {
                            videoInput.value = "";

                            alert('Only videos (.mp4, .mov, .ogg ..) are allowed.');
                        }
                    }
                },

                readFile: function(video) {
                    let reader = new FileReader();

                    reader.onload = (e) => {
                        this.videoData = e.target.result;
                    }

                    reader.readAsDataURL(video);

                    this.new_video = 1;
                },

                removeVideo: function() {
                    this.$emit('onRemoveVideo', this.video);
                },
            }
        });
    </script>

    <script type="text/x-template" id="variant-form-template">
        <div class="page-content">
            <form method="POST" data-vv-scope="add-variant-form" @submit.prevent="addVariant('add-variant-form')">
                <div class="form-container">
                    <div v-for='(attribute, index) in local_att' :class="['control-group', errors.has('add-variant-form.' + attribute.code) ? 'has-error' : '']">
                        <label class="required" v-if="typeof attribute === 'object'" :for="attribute.code" v-text="attribute.name"></label>
                        <label class="required" v-else :for="attribute" v-text="attribute"></label>
                        <select v-validate="'required'" multiple v-select2 v-if="typeof attribute === 'object'" v-model="variant[attribute.code]" class="control select2-a" :id="attribute.code" :name="attribute.code" :data-vv-as="'&quot;' + attribute.name + '&quot;'">
                            <option v-for='(option, index) in attribute.options' :value="option.admin_name" v-text="option.admin_name"></option>
                        </select>
                        <select v-validate="'required'" multiple v-select2 v-else v-model="variant[attribute]" class="control select2-a" :id="attribute" :name="attribute" :data-vv-as="'&quot;' + attribute + '&quot;'">
                        </select>
                        <span class="control-error" v-text="errors.first('add-variant-form.' + attribute.code)" v-if="errors.has('add-variant-form.' + attribute.code)"></span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.catalog.products.add-variant-title') }}
                    </button>
                </div>
            </form>
        </div>
    </script>

    <script type="text/x-template" id="variant-list-template">
        <div class="table" style="margin-top: 20px; overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th class="is-default">{{ __('admin::app.catalog.products.is-default') }}</th>
                        <th class="sku">{{ __('admin::app.catalog.products.sku') }}</th>
                        <th>{{ __('admin::app.catalog.products.name') }}</th>
                        <th class="qty">{{ __('admin::app.catalog.products.qty') }}</th>
                        <th class="price">{{ __('admin::app.catalog.products.price') }}</th>
                        <th class="special_price">Special Price</th>
                        <th class="weight">{{ __('admin::app.catalog.products.weight') }}</th>
                        <th class="actions"></th>
                    </tr>
                </thead>

                <tbody>
                    <variant-item
                        v-for='(variant, index) in variants'
                        :key="index"
                        :index="index"
                        :variant="variant" @onRemoveVariant="removeVariant($event)">
                    </variant-item>
                </tbody>
            </table>
        </div>
    </script>

    <script type="text/x-template" id="variant-item-template">
        <tr>
            <td>
                <div class="control-group">
                    <span class="radio">
                        <input
                            id="default_variant_id"
                            type="radio"
                            name="default_variant_id"
                            :value="variant.id"
                            v-on:change="checkDefaultVariant(variant.id)"
                            :checked="variant.id == default_variant_id">
                        <label class="radio-view" :for="[variantInputName + '[default_variant_id]']"></label>
                    </span>
                </div>
            </td>

            <td>
                <div class="control-group" :class="[errors.has(variantInputName + '[sku]') ? 'has-error' : '']">
                    <input
                        class="control"
                        type="text"
                        :name="[variantInputName + '[sku]']"
                        v-model="variant.sku"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.sku') }}&quot;"
                        v-slugify/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[sku]')"
                        v-if="errors.has(variantInputName + '[sku]')">
                    </span>
                </div>
            </td>

            <td>
                <div
                    :class="['control-group', errors.has(variantInputName + '[name]') ? 'has-error' : '']">
                    <input
                        class="control"
                        type="text"
                        :name="[variantInputName + '[name]']"
                        v-model="variant.name"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.name') }}&quot;"/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[name]')"
                        v-if="errors.has(variantInputName + '[name]')">
                    </span>
                </div>

                <div class="item-options" style="margin-top: 10px">
                    <div v-for='(attribute, index) in variant.new_arr'>
                        <span><b style="text-transform:capitalize">@{{ attribute.key }} : </b>@{{ optionName(attribute.key) }}</span>

                        <input
                            type="hidden"
                            :name="[variantInputName + '[' + attribute.key + ']']"
                            :value="optionName(attribute.key)"
                        />
                    </div>
                </div>
            </td>
            
            <td>
                <div :class="['control-group', errors.has(variantInputName + '[qty]') ? 'has-error' : '']">
                    <input
                        class="control"
                        type="number"
                        :name="[variantInputName + '[qty]']"
                        v-model="variant.qty"
                        v-validate="'required'"
                        data-vv-as="&quot;Quantity&quot;"
                        step="any"/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[qty]')"
                        v-if="errors.has(variantInputName + '[qty]')">
                    </span>
                </div>
            </td>

            <td>
                <div :class="['control-group', errors.has(variantInputName + '[price]') ? 'has-error' : '']">
                    <input
                        class="control"
                        type="number"
                        :name="[variantInputName + '[price]']"
                        v-model="variant.price"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.price') }}&quot;"
                        step="any"/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[price]')"
                        v-if="errors.has(variantInputName + '[price]')">
                    </span>
                </div>
            </td>

            <td>
                <div :class="['control-group', errors.has(variantInputName + '[special_price]') ? 'has-error' : '']">
                    <input
                        class="control"
                        type="number"
                        :name="[variantInputName + '[special_price]']"
                        v-model="variant.special_price"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.special_price') }}&quot;"
                        step="any"/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[special_price]')"
                        v-if="errors.has(variantInputName + '[special_price]')">
                    </span>
                </div>
            </td>

            <td>
                <div :class="['control-group', errors.has(variantInputName + '[weight]') ? 'has-error' : '']">
                    <input
                        type="number"
                        :name="[variantInputName + '[weight]']" class="control"
                        v-model="variant.weight"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.catalog.products.weight') }}&quot;"
                        step="any"/>

                    <span
                        class="control-error"
                        v-text="errors.first(variantInputName + '[weight]')"
                        v-if="errors.has(variantInputName + '[weight]')">
                    </span>
                </div>
            </td>

            <td class="actions">
                {{-- <a :href="['{{ route('admin.catalog.products.index') }}/edit/' + variant.id]">
                    <i class="icon pencil-lg-icon"></i>
                </a> --}}

                <i class="icon remove-icon" @click="removeVariant()"></i>
            </td>
        </tr>
    </script>

    <script>
        $(document).ready(function () {
            Vue.config.ignoredElements = [
                'variant-form',
                'variant-list',
                'variant-item'
            ];
        });

        Vue.component('variant-form', {
            data: function () {
                return {
                    variant: {},
                    family: '1',
                    families: '',
                    local_att: [],
                    
                }
            },

            template: '#variant-form-template',

            created: function () {
                this.local_att = g_att
                $('.select2-a').select2({ tags:true }) ;
            },

            updated() {
                $('.select2-a').select2({ tags:true }) ;
            },

            methods: {
                addVariant: function (formScope) {
                    this.$validator.validateAll(formScope).then((result) => {
                        if (result) {

                            let self = this;

                            let filteredVariants = variants.filter(function (variant) {
                                let matchCount = 0;
                                for (let key in self.variant) {
                                    if (JSON.stringify(variant[key]) == JSON.stringify(self.variant[key])) {
                                        matchCount++;
                                    }
                                }

                                return matchCount;
                            })

                            if (filteredVariants.length) {
                                this.$parent.closeModal();

                                window.flashMessages = [{
                                    'type': 'alert-error',
                                    'message': "{{ __('admin::app.catalog.products.variant-already-exist-message') }}"
                                }];

                                this.$root.addFlashMessages()
                            } else {
                                let optionIds = [], new_Arr = [] ;
                                for (let key in self.variant) {
                                    optionIds.push(self.variant[key]);
                                    new_Arr.push({
                                        key: key,
                                        opts: self.variant[key],
                                    });
                                }

                                var result = optionIds.reduce((a, b) => a.reduce((r, v) => r.concat(b.map(w => [].concat(v, w))), []));

                                result.forEach((arr) => { 
                                    variants.push(Object.assign({
                                        sku: $('#sku').val() + '-variant-' + arr.map(v => v.replace(/\s+/g, '_').toLowerCase()).join('-'),
                                        name: $('#name').val(),
                                        price: $('#price').val() || 0,
                                        special_price: $('#special_price').val() || 0,
                                        weight: $('#weight').val(),
                                        arr:arr,
                                        new_arr:new_Arr,
                                    }, this.variant));
                                });

                                this.resetModel();

                                this.$parent.closeModal();
                            }
                        }
                    });
                },

                resetModel: function () {
                    let self = this;
                    super_attributes.forEach(function (attribute) {
                        self.variant[attribute.code] = '';
                    })
                },

                showModal(id,v) {
                    this.create_list() ;
                    this.$root.$set(this.$root.modalIds, id, v);
                },

                create_list: function() {
                    console.log('hii');
                }

            }
        });

        Vue.component('variant-list', {
            template: '#variant-list-template',

            inject: ['$validator'],

            data: function () {
                return {
                    variants: variants,

                    old_variants: '',

                    superAttributes: g_att
                }
            },

            created: function () {
                let index = 0;
                for (let key in this.old_variants) {
                    let variant = this.old_variants[key];

                    if (key.indexOf('variant_') !== -1) {
                        let inventories = [];

                        for (let inventorySourceId in variant['inventories']) {
                            inventories.push({
                                'qty': variant['inventories'][inventorySourceId],
                                'inventory_source_id': inventorySourceId
                            })
                        }

                        variant['inventories'] = inventories;

                        variants.push(variant);
                    } else {
                        for (let code in variant) {
                            if (code != 'inventories') {
                                variants[index][code] = variant[code];
                            } else {
                                variants[index][code] = [];

                                for (let inventorySourceId in variant[code]) {
                                    variants[index][code].push({
                                        'qty': variant[code][inventorySourceId],
                                        'inventory_source_id': inventorySourceId
                                    })
                                }
                            }
                        }
                    }

                    index++;
                }
            },

            methods: {
                removeVariant: function (variant) {
                    let index = this.variants.indexOf(variant)

                    this.variants.splice(index, 1)
                },
            }
        });

        Vue.component('variant-item', {
            template: '#variant-item-template',

            props: ['index', 'variant'],

            inject: ['$validator'],

            data: function () {
                return {
                    default_variant_id: 0,
                    inventorySources: @json($inventorySources),
                    inventories: {},
                    totalQty: 0,
                    superAttributes: g_att,
                    items: [],
                    imageCount: 0,
                    images: {},
                    imageData: [],
                    new_image: [],
                    local_att: g_att,
                }
            },

            created: function () {
                let self = this;
                console.log(this.inventorySources);
                this.inventorySources.forEach(function (inventorySource) {
                    self.inventories[inventorySource.id] = self.sourceInventoryQty(inventorySource.id)
                    self.totalQty += parseInt(self.inventories[inventorySource.id]);
                })
            },

            computed: {
                variantInputName: function () {
                    if (this.variant.id)
                        return "variants[" + this.variant.id + "]";

                    return "variants[variant_" + this.index + "]";
                }
            },

            methods: {
                removeVariant: function () {
                    this.$emit('onRemoveVariant', this.variant);
                },

                checkDefaultVariant: function (variantId) {
                    this.default_variant_id = variantId;
                },

                optionName: function (optionId) {
                    let optionName = '';
                    let self = this ;
                    this.variant.new_arr.forEach(function (attribute) {
                        if (attribute.key == optionId) {
                            optionName =  self.variant.arr.filter(value => attribute.opts.includes(value));;
                        }
                    })
                    return optionName[0];
                },

                sourceInventoryQty: function (inventorySourceId) {
                    if (!Array.isArray(this.variant.inventories))
                        return 0;

                    let inventories = this.variant.inventories.filter(function (inventory) {
                        return inventorySourceId === parseInt(inventory.inventory_source_id);
                    })

                    if (inventories.length)
                        return inventories[0]['qty'];

                    return 0;
                },

                updateTotalQty: function () {
                    this.totalQty = 0;

                    for (let key in this.inventories) {
                        this.totalQty += parseInt(this.inventories[key]);
                    }
                },
            }
        });
    </script>

@endpush