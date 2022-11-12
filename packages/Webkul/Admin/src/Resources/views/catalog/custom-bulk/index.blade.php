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
                            <label class="required">Select File to Upload</label>
                            <input type="file" class="control" accept=".csv" name="csv-file">
                        </div>
                        <div class="col-md-12 control-group">
                            <label class="required">Select Margin %</label>
                            <input type="number" class="control" name="margin" max="100" min="0" value="0">
                        </div>
                        <div class="col-md-12 control-group">
                            <label class="required">Delivery Charge</label>
                            <input type="number" class="control" name="delivery_charge"  min="0" value="0">
                        </div>
                        <div class="col-md-12 control-group">
                            <label class="required">Select Product Type</label>
                            <select name="type" class="control">
                                <option value="Simple">Simple Product</option>
                                <option value="Configurable" selected>Product with Variants (Configurable)</option>
                            </select>
                        </div>
                         <div class="col-md-12 control-group">
                            <label>Select Countries</label>
                            <select name="countries[]" multiple class="control select2" required>
                                <option value=""></option>
                                @foreach($countries as $key => $value)
                                    <option value="{{ $value->code }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-md-12 control-group">
                            <label class="required">Select Attribute Family</label>
                            <select name="attribute_families" class="control" required>
                                @foreach($attribute_families as $key => $value)
                                    <option @if($key==0) selected @endif value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
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
<script>
        $(document).ready(function() {
            
            $('.select2').select2() ;
        })
    </script>
@endpush
