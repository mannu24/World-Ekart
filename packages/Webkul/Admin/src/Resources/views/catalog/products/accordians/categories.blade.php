@if ($categories->count())

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.before', ['product' => $product]) !!}

<accordian title="{{ __('admin::app.catalog.products.categories') }}" :active="false">
    <div slot="body">

        {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.controls.before', ['product' => $product]) !!}

        <!-- <tree-view behavior="normal" value-field="id" name-field="categories" input-type="checkbox" items='@json($categories)' value='@json($product->categories->pluck("id"))' fallback-locale="{{ config('app.fallback_locale') }}"></tree-view> -->
        @php $c_ids = $product->categories->pluck("id")->toArray() ; @endphp
        <select name="categories[]" multiple required class="control form-control select2" style="width:100%;">
            @foreach($categories as $category) 
                <option @selected(in_array($category->id,$c_ids)) value="{{ $category->id }}">{{ $category->name }}</option>
                @if ($category->children->count() > 0)
                    @foreach($category->children as $sub_category) 
                        <option @selected(in_array($sub_category->id,$c_ids)) value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                        @if ($sub_category->children->count() > 0)
                            @foreach($sub_category->children as $sub_sub_category) 
                                <option @selected(in_array($sub_sub_category->id,$c_ids)) value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->name }}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </select>


        {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.controls.after', ['product' => $product]) !!}

    </div>
</accordian>

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.after', ['product' => $product]) !!}

@endif