@extends('shop::layouts.master')

@section('page_title')
    {{ __('admin::app.error.404.page-title') }}
@stop

@section('body-header')
@endsection

@section('full-content-wrapper')
    <div class="ps-page--404">
        <div class="ps-section__content">
            <figure><img src="{{ bagisto_asset('images/404.jpg') }}" alt="" />
                <h3>Ohh! Page not found</h3>
                <p>It seems we can&#x27;t find what you&#x27;re looking for. Perhaps searching can help or go
                    back to<a href="/"> Homepage</a></p>
            </figure>
        </div>
    </div>
@endsection

@section('footer')
@show
