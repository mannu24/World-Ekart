@extends('shop::layouts.master')

@section('page_title')
    {{ __('contact_lang::app.shop.title') }}
@endsection

@section('content-wrapper')
@php
    $total_orders = auth()->user()->all_orders ;
    if(count($total_orders)) {
        foreach ($total_orders as $key => $value) {
            foreach($value->all_items as $prod) {
                $p[] = ['name' => $prod->name, 'p_id' => $prod->product_id] ;            
            }   
        } ;    
    }
@endphp

<div class="ps-page--shop">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="http://localhost:8000/">Home</a></li>
                <li>{{ __('contact_lang::app.shop.title') }}</li>
            </ul>
        </div>
    </div>
    <div class="pt-50 pb-30">
        <div class="container">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="body col-12">
                    <h3 class="font-weight-bolder">Contact with us</h3>

                    <p>If you want to know something, just send us a message, we glad to hear from you.</p>

                    <form class="row" action="{{ route('shop.contact.send-message') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group col-12 col-md-6">
                            <label class="cd-label" for="cd-name">Name</label>
                            <input class="form-control" type="text" name="name" id="cd-name" required>
                        </div> 
                        <div class="form-group col-12 col-md-6">
                            <label class="cd-label" for="cd-email">Email</label>
                            <input class="form-control" type="email" name="email" id="cd-email" required>
                        </div> 
                        @if (count($total_orders)>0)
                            <div class="form-group col-12">
                                <label class="cd-label" for="cd-product">Query regarding any Product? Select Product</label>
                                <select class="form-control" name="product_id" id="cd-product">
                                    @foreach ($p as $item)
                                        <option value="{{ $item['p_id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        @endif
                        <div class="form-group col-12">
                            <label class="cd-label" for="cd-textarea">Message</label>
                            <textarea class="message  form-control" name="message_body" rows="5" id="cd-textarea" required></textarea>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="ps-btn"><i class="fa fa-paper-plane"></i> Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection