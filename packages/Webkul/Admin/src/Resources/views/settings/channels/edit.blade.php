@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.channels.edit-title') }}
@stop

@section('content')
    <div class="content">
        @php $locale = core()->getRequestedLocaleCode(); @endphp

        <form method="POST" action="{{ route('admin.channels.update', ['id' => $channel->id, 'locale' => $locale]) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.channels.index') }}'"></i>

                        {{ __('admin::app.settings.channels.edit-title') }}
                    </h1>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" onChange="window.location.href = this.value">
                            @foreach (core()->getAllLocales() as $localeModel)

                                <option value="{{ route('admin.channels.edit', $channel->id) . '?locale=' . $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                    {{ $localeModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.channels.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.settings.channel.edit.before') !!}

                    {{-- general --}}
                    <accordian title="{{ __('admin::app.settings.channels.general') }}" :active="false">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required">{{ __('admin::app.settings.channels.code') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;{{ __('admin::app.settings.channels.code') }}&quot;" value="{{ $channel->code }}" disabled="disabled"/>
                                <input type="hidden" name="code" value="{{ $channel->code }}"/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('{{$locale}}[name]') ? 'has-error' : '']">
                                <label for="name" class="required">
                                    {{ __('admin::app.settings.channels.name') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>
                                <input v-validate="'required'" class="control" id="name" name="{{$locale}}[name]" data-vv-as="&quot;{{ __('admin::app.settings.channels.name') }}&quot;" value="{{ old($locale)['name'] ?? ($channel->translate($locale)['name'] ?? $channel->name) }}"/>
                                <span class="control-error" v-if="errors.has('{{$locale}}[name]')">@{{ errors.first('{!!$locale!!}[page_title]') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="description">
                                    {{ __('admin::app.settings.channels.description') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>
                                <textarea class="control" id="description" name="{{$locale}}[description]">{{ old($locale)['description'] ?? ($channel->translate($locale)['description'] ?? $channel->description) }}</textarea>
                            </div>

                            <div class="control-group" :class="[errors.has('inventory_sources[]') ? 'has-error' : '']">
                                <label for="inventory_sources" class="required">{{ __('admin::app.settings.channels.inventory_sources') }}</label>
                                <?php $selectedOptionIds = old('inventory_sources') ?: $channel->inventory_sources->pluck('id')->toArray() ?>
                                <select v-validate="'required'" class="control" id="inventory_sources" name="inventory_sources[]" data-vv-as="&quot;{{ __('admin::app.settings.channels.inventory_sources') }}&quot;" multiple>
                                    @foreach (app('Webkul\Inventory\Repositories\InventorySourceRepository')->findWhere(['status' => 1]) as $inventorySource)
                                        <option value="{{ $inventorySource->id }}" {{ in_array($inventorySource->id, $selectedOptionIds) ? 'selected' : '' }}>
                                            {{ $inventorySource->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('inventory_sources[]')">@{{ errors.first('inventory_sources[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('root_category_id') ? 'has-error' : '']">
                                <label for="root_category_id" class="required">{{ __('admin::app.settings.channels.root-category') }}</label>
                                <?php $selectedOption = old('root_category_id') ?: $channel->root_category_id ?>
                                <select v-validate="'required'" class="control" id="root_category_id" name="root_category_id" data-vv-as="&quot;{{ __('admin::app.settings.channels.root-category') }}&quot;">
                                    @foreach (app('Webkul\Category\Repositories\CategoryRepository')->getRootCategories() as $category)
                                        <option value="{{ $category->id }}" {{ $selectedOption == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('root_category_id')">@{{ errors.first('root_category_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('hostname') ? 'has-error' : '']">
                                <label for="hostname">{{ __('admin::app.settings.channels.hostname') }}</label>
                                <input type="text" v-validate="''" class="control" id="hostname" name="hostname" value="{{ $channel->hostname }}" placeholder="{{ __('admin::app.settings.channels.hostname-placeholder') }}"/>

                                <span class="control-error" v-if="errors.has('hostname')">@{{ errors.first('hostname') }}</span>
                            </div>

                        </div>
                    </accordian>

                    {{-- currencies and locales --}}
                    <accordian title="{{ __('admin::app.settings.channels.currencies-and-locales') }}" :active="false">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('locales[]') ? 'has-error' : '']">
                                <label for="locales" class="required">{{ __('admin::app.settings.channels.locales') }}</label>
                                <?php $selectedOptionIds = old('locales') ?: $channel->locales->pluck('id')->toArray() ?>
                                <select v-validate="'required'" class="control" id="locales" name="locales[]" data-vv-as="&quot;{{ __('admin::app.settings.channels.locales') }}&quot;" multiple>
                                    @foreach (core()->getAllLocales() as $localeModel)
                                        <option value="{{ $localeModel->id }}" {{ in_array($localeModel->id, $selectedOptionIds) ? 'selected' : '' }}>
                                            {{ $localeModel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('locales[]')">@{{ errors.first('locales[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('default_locale_id') ? 'has-error' : '']">
                                <label for="default_locale_id" class="required">{{ __('admin::app.settings.channels.default-locale') }}</label>
                                <?php $selectedOption = old('default_locale_id') ?: $channel->default_locale_id ?>
                                <select v-validate="'required'" class="control" id="default_locale_id" name="default_locale_id" data-vv-as="&quot;{{ __('admin::app.settings.channels.default-locale') }}&quot;">
                                    @foreach (core()->getAllLocales() as $localeModel)
                                        <option value="{{ $localeModel->id }}" {{ $selectedOption == $localeModel->id ? 'selected' : '' }}>
                                            {{ $localeModel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('default_locale_id')">@{{ errors.first('default_locale_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('currencies[]') ? 'has-error' : '']">
                                <label for="currencies" class="required">{{ __('admin::app.settings.channels.currencies') }}</label>
                                <?php $selectedOptionIds = old('currencies') ?: $channel->currencies->pluck('id')->toArray() ?>
                                <select v-validate="'required'" class="control" id="currencies" name="currencies[]" data-vv-as="&quot;{{ __('admin::app.settings.channels.currencies') }}&quot;" multiple>
                                    @foreach (core()->getAllCurrencies() as $currency)
                                        <option value="{{ $currency->id }}" {{ in_array($currency->id, $selectedOptionIds) ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('currencies[]')">@{{ errors.first('currencies[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('base_currency_id') ? 'has-error' : '']">
                                <label for="base_currency_id" class="required">{{ __('admin::app.settings.channels.base-currency') }}</label>
                                <?php $selectedOption = old('base_currency_id') ?: $channel->base_currency_id ?>
                                <select v-validate="'required'" class="control" id="base_currency_id" name="base_currency_id" data-vv-as="&quot;{{ __('admin::app.settings.channels.base-currency') }}&quot;">
                                    @foreach (core()->getAllCurrencies() as $currency)
                                        <option value="{{ $currency->id }}" {{ $selectedOption == $currency->id ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('base_currency_id')">@{{ errors.first('base_currency_id') }}</span>
                            </div>

                        </div>
                    </accordian>

                    {{-- design --}}
                    <accordian title="{{ __('admin::app.settings.channels.design') }}" :active="false">
                        <div slot="body">
                            <div class="control-group">
                                <label for="theme">{{ __('admin::app.settings.channels.theme') }}</label>

                                <?php $selectedOption = old('theme') ?: $channel->theme ?>

                                <select class="control" id="theme" name="theme">
                                    @foreach (config('themes.themes') as $themeCode => $theme)
                                        <option value="{{ $themeCode }}" {{ $selectedOption == $themeCode ? 'selected' : '' }}>
                                            {{ $theme['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="home_page_content">
                                    {{ __('admin::app.settings.channels.home_page_content') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>
                                <textarea class="control" id="home_page_content" name="{{$locale}}[home_page_content]">{{ old($locale)['home_page_content'] ?? ($channel->translate($locale)['home_page_content'] ?? $channel->home_page_content) }}</textarea>
                            </div>

                            <div class="control-group">
                                <label for="footer_content">
                                    {{ __('admin::app.settings.channels.footer_content') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>
                                <textarea class="control" id="footer_content" name="{{$locale}}[footer_content]">{{ old($locale)['footer_content'] ?? ($channel->translate($locale)['footer_content'] ?? $channel->footer_content) }}</textarea>
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.logo') }}</label>

                                <image-wrapper button-label="{{ __('admin::app.catalog.products.add-image-btn-title') }}" input-name="logo" :multiple="false" :images='"{{ $channel->logo_url }}"'></image-wrapper>
                            
                                <span class="control-info mt-10">{{ __('admin::app.settings.channels.logo-size') }}</span>
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.favicon') }}</label>

                                <image-wrapper button-label="{{ __('admin::app.catalog.products.add-image-btn-title') }}" input-name="favicon" :multiple="false" :images='"{{ $channel->favicon_url }}"'></image-wrapper>
                                
                                <span class="control-info mt-10">{{ __('admin::app.settings.channels.favicon-size') }}</span> 
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.site_name') }}</label>

                                <input type="text" v-validate="''" class="control" name="{{$locale}}[site_name]" value="{{ old($locale)['site_name'] ?? ($channel->translate($locale)['site_name'] ?? $channel->site_name) }}" />
                                
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.email_address') }}</label>

                                <input type="text" v-validate="''" class="control" name="{{$locale}}[email_address]" value="{{ old($locale)['email_address'] ?? ($channel->translate($locale)['email_address'] ?? $channel->email_address) }}" />
                                
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.phone_number') }}</label>

                                <input type="text" v-validate="''" class="control" name="{{$locale}}[phone_number]" value="{{ old($locale)['phone_number'] ?? ($channel->translate($locale)['phone_number'] ?? $channel->phone_number) }}" />
                                
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.address') }}</label>

                                <!-- <input type="text" v-validate="''" class="control" name="{{$locale}}[address]" value="{{ old($locale)['address'] ?? ($channel->translate($locale)['address'] ?? $channel->address) }}" /> -->

                                <textarea class="control" id="address" name="{{$locale}}[address]">{{ old($locale)['address'] ?? ($channel->translate($locale)['address'] ?? $channel->address) }}</textarea>
                                
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.facebook_link') }}</label>

                                <input type="text" v-validate="''" class="control" name="{{$locale}}[facebook_link]" value="{{ old($locale)['facebook_link'] ?? ($channel->translate($locale)['facebook_link'] ?? $channel->facebook_link) }}" />
                                
                            </div>

                            <div class="control-group">
                                <label>{{ __('admin::app.settings.channels.instagram_link') }}</label>

                                <input type="text" v-validate="''" class="control" name="{{$locale}}[instagram_link]" value="{{ old($locale)['instagram_link'] ?? ($channel->translate($locale)['instagram_link'] ?? $channel->instagram_link) }}" />
                                
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'Advertisements'" :active="false">
                        <div slot="body">
                            <div class="control-group">
                                <label>{{ __('velocity::app.admin.meta-data.advertisement-four') }}</label>
        
                                @php
                                    $images = [
                                        4 => [],
                                        3 => [],
                                        2 => [],
                                    ];
        
                                    $index = 0;
        
                                    foreach ($metaData->get('locale')->all() as $key => $value) {
                                        if ($value->locale == $locale) {
                                            $index = $key;
                                        }
                                    }
        
                                    $advertisement = json_decode($metaData->get('advertisement')->all()[$index]->advertisement, true);
                                    $links = json_decode($metaData->get('links')->all()[$index]->links, true);
                                @endphp
        
                                @if(! isset($advertisement[4]) || ! count($advertisement[4]))
                                    @php
                                        $images[4][] = [
                                            'id' => 'image_1',
                                            'url' => asset('/themes/velocity/assets/images/big-sale-banner.webp'),
                                        ];
                                        $images[4][] = [
                                            'id' => 'image_2',
                                            'url' => asset('/themes/velocity/assets/images/seasons.webp'),
                                        ];
                                        $images[4][] = [
                                            'id' => 'image_3',
                                            'url' => asset('/themes/velocity/assets/images/deals.webp'),
                                        ];
                                        $images[4][] = [
                                            'id' => 'image_4',
                                            'url' => asset('/themes/velocity/assets/images/kids.webp'),
                                        ];
                                    @endphp
        
                                    <image-wrapper
                                        :multiple="true"
                                        max="4"
                                        input-name="images[4]"
                                        :images='@json($images[4])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @else
                                    @foreach ($advertisement[4] as $index => $image)
                                        @php
                                            $images[4][] = [
                                                'id' => 'image_' . $index,
                                                'url' => Storage::url($image),
                                            ];
                                        @endphp
                                    @endforeach
        
                                    <image-wrapper
                                        :multiple="true"
                                        max="4"
                                        input-name="images[4]"
                                        :images='@json($images[4])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @endif
                                {{-- <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-four-resolution') }}</span> --}}
                            </div>
                            @foreach ($links[4] as $key => $item)
                                <div class="control-group">
                                    <label>Advertisement Four Image {{ $key }} Link</label>
                                    <input type="url" v-validate="'url'" value="{{ $item }}" class="control" name="links[4][{{ $key }}]">
                                </div>
                            @endforeach
                            <div class="control-group">
                                <label>{{ __('velocity::app.admin.meta-data.advertisement-three') }}</label>
                                @if(! isset($advertisement[3]) || ! count($advertisement[3]))
                                    @php
                                        $images[3][] = [
                                            'id' => 'image_1',
                                            'url' => asset('/themes/velocity/assets/images/headphones.webp'),
                                        ];
                                        $images[3][] = [
                                            'id' => 'image_2',
                                            'url' => asset('/themes/velocity/assets/images/watch.webp'),
                                        ];
                                        $images[3][] = [
                                            'id' => 'image_3',
                                            'url' => asset('/themes/velocity/assets/images/kids-2.webp'),
                                        ];
                                    @endphp
        
                                    <image-wrapper
                                        input-name="images[3]"
                                        max="3"
                                        :images='@json($images[3])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @else
                                    @foreach ($advertisement[3] as $index => $image)
                                        @php
                                            $images[3][] = [
                                                'id' => 'image_' . $index,
                                                'url' => Storage::url($image),
                                            ];
                                        @endphp
                                    @endforeach
        
                                    <image-wrapper
                                        input-name="images[3]"
                                        max="3"
                                        :images='@json($images[3])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @endif
                                {{-- <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-three-resolution') }}</span> --}}
                            </div>
                            @foreach ($links[3] as $key => $item)
                                <div class="control-group">
                                    <label>Advertisement Three Image {{ $key }} Link</label>
                                    <input type="url" v-validate="'url'" value="{{ $item }}" class="control" name="links[3][{{ $key }}]">
                                </div>
                            @endforeach

                            <div class="control-group">
                                <label>{{ __('velocity::app.admin.meta-data.advertisement-two') }}</label>
        
                                @if(! isset($advertisement[2]) || ! count($advertisement[2]))
                                    @php
                                        $images[2][] = [
                                            'id' => 'image_1',
                                            'url' => asset('/themes/velocity/assets/images/toster.webp'),
                                        ];
                                        $images[2][] = [
                                            'id' => 'image_2',
                                            'url' => asset('/themes/velocity/assets/images/trimmer.webp'),
                                        ];
                                    @endphp
        
                                    <image-wrapper
                                        input-name="images[2]"
                                        max="2"
                                        :images='@json($images[2])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @else
                                    @foreach ($advertisement[2] as $index => $image)
                                        @php
                                            $images[2][] = [
                                                'id' => 'image_' . $index,
                                                'url' => Storage::url($image),
                                            ];
                                        @endphp
                                    @endforeach
        
                                    <image-wrapper
                                        input-name="images[2]"
                                        max="2"
                                        :images='@json($images[2])'
                                        :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                                    </image-wrapper>
                                @endif
                                {{-- <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-two-resolution') }}</span> --}}
                            </div>
                            @foreach ($links[2] as $key => $item)
                                <div class="control-group">
                                    <label>Advertisement Two Image {{ $key }} Link</label>
                                    <input type="url" v-validate="'url'" value="{{ $item }}" class="control" name="links[2][{{ $key }}]">
                                </div>
                            @endforeach

                        </div>
                    </accordian>
        

                    @php
                        $home_seo = $channel->translate($locale)['home_seo'] ?? $channel->home_seo;
                        $seo = json_decode($home_seo);
                    @endphp

                    {{-- home page seo --}}
                    <accordian title="{{ __('admin::app.settings.channels.seo') }}" :active="false">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('{{$locale}}[seo_title]') ? 'has-error' : '']">
                                <label for="seo_title" class="required">
                                    {{ __('admin::app.settings.channels.seo-title') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>

                                <input v-validate="'required'" class="control" id="seo_title" name="{{$locale}}[seo_title]" data-vv-as="&quot;{{ __('admin::app.settings.channels.seo-title') }}&quot;" value="{{ $seo->meta_title ?? (old($locale)['seo_title'] ?? '') }}"/>

                                <span class="control-error" v-if="errors.has('{{$locale}}[seo_title]')">@{{ errors.first('{!!$locale!!}[page_title]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('{{$locale}}[seo_description]') ? 'has-error' : '']">
                                <label for="seo_description">
                                    {{ __('admin::app.settings.channels.seo-description') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>

                                <textarea class="control" id="seo_description" name="{{$locale}}[seo_description]" data-vv-as="&quot;{{ __('admin::app.settings.channels.seo-description') }}&quot;">{{ $seo->meta_description ?? (old($locale)['seo_description'] ?? '') }}</textarea>

                                <span class="control-error" v-if="errors.has('{{$locale}}[seo_description]')">@{{ errors.first('{!!$locale!!}[page_title]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('{{$locale}}[seo_keywords]') ? 'has-error' : '']">
                                <label for="seo_keywords" class="required">
                                    {{ __('admin::app.settings.channels.seo-keywords') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>

                                <textarea v-validate="'required'" class="control" id="seo_keywords" name="{{$locale}}[seo_keywords]" data-vv-as="&quot;{{ __('admin::app.settings.channels.seo-keywords') }}&quot;">{{ $seo->meta_keywords ?? (old($locale)['seo_keywords'] ?? '') }}</textarea>

                                <span class="control-error" v-if="errors.has('{{$locale}}[seo_keywords]')">@{{ errors.first('{!!$locale!!}[page_title]') }}</span>
                            </div>
                        </div>
                    </accordian>

                    {{-- maintenance mode --}}
                    <accordian title="{{ __('admin::app.settings.channels.maintenance-mode') }}" :active="false">
                        <div slot="body">
                            <div class="control-group">
                                <label for="maintenance-mode-status">{{ __('admin::app.status') }}</label>
                                <label class="switch">
                                    <input type="hidden" name="is_maintenance_on" value="0" />
                                    <input type="checkbox" id="maintenance-mode-status" name="is_maintenance_on" value="1" {{ $channel->is_maintenance_on ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="control-group">
                                <label for="maintenance-mode-text">
                                    {{ __('admin::app.settings.channels.maintenance-mode-text') }}
                                    <span class="locale">[{{ $locale }}]</span>
                                </label>
                                <input class="control" id="maintenance-mode-text" name="{{$locale}}[maintenance_mode_text]" value="{{ old('maintenance_mode_text') ?? ($channel->translate($locale)['maintenance_mode_text'] ?? $channel->maintenance_mode_text) }}"/>
                            </div>

                            <div class="control-group">
                                <label for="allowed-ips">{{ __('admin::app.settings.channels.allowed-ips') }}</label>
                                <input class="control" id="allowed-ips" name="allowed_ips" value="{{ old('allowed_ips') ?: $channel->allowed_ips }}"/>
                            </div>
                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.settings.channel.edit.after') !!}
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    @include('admin::layouts.tinymce')

    <script>
        $(document).ready(function () {
            tinyMCEHelper.initTinyMCE({
                selector: 'textarea#home_page_content,textarea#footer_content',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | table',
                image_advtab: true,
                valid_elements : '*[*]',
            });
        });
    </script>
@endpush