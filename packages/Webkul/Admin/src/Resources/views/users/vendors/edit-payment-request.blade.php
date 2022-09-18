@extends('admin::layouts.content')

@section('page_title')
    Update Vendor Payment Request
@stop

@section('content')
    <div class="content dashboard">
        <form method="POST" action="{{ route('admin.payment-request.update') }}" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.payment-request.view') }}'"></i>
                        Update Vendor Payment Request
                    </h1>
                </div>
            </div>

            <div class="page-content">
                <div class="dashboard-stats mb-30">
                    <div class="dashboard-card">
                        <div class="title">Total Sale</div>
                        <div class="data">
                            {{ core()->formatBasePrice($statistics['total_sales']) }}
                        </div>
                    </div>
    
                    <div class="dashboard-card">
                        <div class="title">This Month Sale</div>
                        <div class="data">
                            {{ core()->formatBasePrice($statistics['this_month_sales']) }}
                        </div>
                    </div>
    
                    <div class="dashboard-card">
                        <div class="title">Total Payout Received</div>
                        <div class="data">
                            {{ core()->formatBasePrice($statistics['payout_received']) }}
                        </div>
                    </div>
    
                    <div class="dashboard-card">
                        <div class="title">Total Balance</div>
                        <div class="data">
                            {{ core()->formatBasePrice($statistics['balance_left']) }}
                        </div>
                    </div>
    
                </div>
                <div class="form-container">
                    @csrf()
                    <accordian title="Vendor Bank Details" :active="false">
                        <div slot="body">
                            <div class="control-group">
                                <label>Bank Name</label>
                                <input class="control" type="text" readonly value="{{ $vendor->bank_name }}" />
                            </div>
                            <div class="control-group">
                                <label>Account Holder Name</label>
                                <input class="control" type="text" readonly value="{{ $vendor->acc_name }}" />
                            </div>
                            <div class="control-group">
                                <label>Account Number</label>
                                <input class="control" type="text" readonly value="{{ $vendor->acc_no }}" />
                            </div>
                            <div class="control-group">
                                <label>IFSC Code</label>
                                <input class="control" type="text" readonly value="{{ $vendor->ifsc_code }}" />
                            </div>
                            <div class="control-group">
                                <label>UPI ID</label>
                                <input class="control" type="text" readonly value="{{ $vendor->upi_id }}" />
                            </div>
                        </div>
                    </accordian>
                    <accordian title="Payment Section" :active="true">
                        <div slot="body">
                            <div class="control-group">
                                <label>Amount Requested</label>
                                <input class="control" name="amount_requested" value="{{ $request->amount_requested }}" />
                            </div>
                            <div class="control-group" :class="[errors.has('amount_paid') ? 'has-error' : '']">
                                <label class="required">Amount Paid</label>
                                <input type="tel" onkeypress="validate()" maxlength="10" v-validate="'required'" class="control" value="{{ old('amount_paid') }}" name="amount_paid" />
                                <span class="control-error" v-if="errors.has('amount_paid')">@{{ errors.first('amount_paid') }}</span>
                            </div>
                            <div class="control-group" :class="[errors.has('transaction_no') ? 'has-error' : '']">
                                <label class="required">Transaction Number</label>
                                <input type="text" v-validate="'required'" class="control" value="{{ old('transaction_no') }}" name="transaction_no" />
                                <span class="control-error" v-if="errors.has('transaction_no')">@{{ errors.first('transaction_no') }}</span>
                            </div>
                            <div class="control-group" :class="[errors.has('payment_via') ? 'has-error' : '']">
                                <label class="required">Payment Mode</label>
                                <input type="text" v-validate="'required'" class="control" value="{{ old('payment_via') }}" name="payment_via" />
                                <span class="control-error" v-if="errors.has('payment_via')">@{{ errors.first('payment_via') }}</span>
                            </div>
                            <div class="control-group">
                                <input type="hidden" name="id" value="{{ $request->id }}" >
                                <button type="submit" class="btn btn-lg btn-primary">Approve</button>
                            </div>
                        </div>
                    </accordian>

                    <accordian title="Vendor Payment History" :active="true">
                        <div slot="body">
                            <datagrid-plus src="{{ route('admin.payment-request.view',['id' => $request->id]) }}"></datagrid-plus>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop