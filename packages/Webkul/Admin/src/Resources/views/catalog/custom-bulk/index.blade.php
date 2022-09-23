@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.products.title') }}
@stop

@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.products.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>

                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.dataflow-profile.index') }}" class="btn btn-lg btn-primary">
                    Bulk Upload
                </a>

                <a href="{{ route('admin.catalog.products.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.catalog.products.add-product-btn-title') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.products.list.before') !!}

        <div class="page-content">
            <div class="row">
                <form action="{{ route('save-custom-upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="col-md-12">
                    <label for="">Select File</label>
                    <input type="file" class="form-control" name="csv-file">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">Submit</button>
                </div>
                </form>

            </div>
        </div>


    </div>


@stop

@push('scripts')

@endpush
