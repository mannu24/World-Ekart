@extends('admin::layouts.content')
@section('page_title') Courier Tracking Links @stop
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Courier Tracking Links</h1>
            </div>
        </div>

        <div class="page-content">
            <accordian :title="'Add New Courier Title'" :active="true">
                <div slot="body">
                    <form method="POST" action="{{ route('admin.sales.tracking.add') }}"> @csrf
                        <div class="control-group {{ $errors->first('name') ? 'has-error' :'' }}">
                            <label class="required">Courier Title Name</label>
                            <input type="text" class="control" name="name" required />
                            <span class="control-error">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="control-group {{ $errors->first('link') ? 'has-error' :'' }}">
                            <label class="required">Courier Tracking Link</label>
                            <input type="url" class="control" name="link" required />
                            <span class="control-error">{{ $errors->first('link') }}</span>
                        </div>
                        <div class="control-group">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </accordian>  
            <datagrid-plus src="{{ route('admin.sales.tracking') }}"></datagrid-plus>
        </div>
    </div>

@stop
