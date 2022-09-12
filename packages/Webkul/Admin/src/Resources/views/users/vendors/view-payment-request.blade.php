@extends('admin::layouts.content')

@section('page_title') Payment Requests @stop

@section('content')
<form method="POST" action="{{ route('admin.payment-request.create') }}">
    @csrf
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Payment Requests</h1>
            </div>
        </div>
        <div class="page-content">
            <datagrid-plus src="{{ route('admin.payment-request.view') }}"></datagrid-plus>
        </div>
    </div>
</form>
@stop
