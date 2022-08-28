@extends('admin::layouts.content')

@section('page_title')
    {{$vendor->name}}
@stop

@section('content')
    <div class="content">
            <div class="page-header">

                <div class="page-action">
                    <a  class="btn btn-lg btn-primary" href="{{route('admin.vendors.approve', $vendor->id)}}">
                        Approve
                    </a>

                    <a  class="btn btn-lg btn-danger" style="color:white !important;" href="{{route('admin.vendors.delete.view', $vendor->id)}}">
                        Delete
                    </a>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    <accordian title="{{ __('admin::app.users.users.general') }}" :active="true">
                        <div slot="body" >
                            <div class="row">
                                <h4>Name :- {{$vendor->name}}</h4>
                            </div>
                        </div>
                    </accordian>

                    
                </div>
            </div>
    </div>
@stop