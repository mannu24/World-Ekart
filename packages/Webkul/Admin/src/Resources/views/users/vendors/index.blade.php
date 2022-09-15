@extends('admin::layouts.content')

@section('page_title') Pending Vendors Requests @stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Pending Vendors Requests</h1>
            </div>

        </div>

        <div class="page-content">
            <datagrid-plus src="{{ route('admin.vendors.index') }}"></datagrid-plus>
        </div>
    </div>
@stop
