@extends('admin::layouts.content')

@section('page_title')
    Shopfiy CSV Upload
@stop

@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>Shopfiy CSV Upload</h1>
            </div>
        </div>

        <div class="page-content">
            <accordian title="File Upload" :active="true">
                <div slot="body" class="row">
                    <form action="{{ route('save-custom-upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="col-md-12 control-group">
                        <label for="">Select File to Upload</label>
                        <input type="file" class="control" name="csv-file">
                    </div>
                    <div class="col-md-12 control-group">
                        <button class="btn btn-primary btn-lg">Submit</button>
                    </div>
                    </form>
    
                </div>
            </accordian>
            <div class="mt-30">
                <datagrid-plus src="{{ route('products-custom-upload') }}"></datagrid-plus>
            </div>

        </div>


    </div>


@stop

@push('scripts')

@endpush
