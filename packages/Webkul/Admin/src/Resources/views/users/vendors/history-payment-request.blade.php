@extends('admin::layouts.content')

@section('page_title') Vendor Payment History @stop

@section('content')
<form method="POST" action="{{ route('admin.payment-request.create') }}">
    @csrf
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Vendor Payment History</h1>
            </div>
        </div>
        <div class="page-content">
            <datagrid-plus src="{{ route('admin.payment-request.history') }}"></datagrid-plus>
        </div>
    </div>
</form>
@stop
