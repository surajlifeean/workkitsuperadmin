@extends('layouts.admin')

@section('page-title')
{{ __('Transaction Deatails') }}
@endsection


@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('companies.index') }}">{{ __('Companies') }}</a></li>
@endsection



@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-12">
                <div class=" card" style="height: 95%;">
                    <div class="card-header">
                        <h4>{{ __('Transaction Deatails')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-4"><b>{!! __('Customer Details') !!}</b></h5>
                                <p><b>{!! __('Customer Name') !!}</b>: {{ $transaction['customer_details']['name'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Email') !!}</b>: {{ $transaction['customer_details']['email'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Phone') !!}</b>: {{ $transaction['customer_details']['phone'] ?? __('N/A') }}</p>
                                <p><b>{!! __('City') !!}</b>: {{ $transaction['customer_details']['address']['city'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Country') !!}</b>: {{ $transaction['customer_details']['address']['country'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Postal Code') !!}</b>: {{ $transaction['customer_details']['address']['postal_code'] ?? __('N/A') }}</p>
                                <p><b>{!! __('State') !!}</b>: {{ $transaction['customer_details']['address']['state'] ?? __('N/A') }}</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-4"><b>{!! __('Payment Details') !!}</b></h5>
                                <p><b>{{ __('Plan')}}</b>: {{ $plan_request->plan }}</p>
                                <p><b>{{ __('Plan Price')}}</b>: {{ $plan_request->is_offer_price == 1 ? $plan_request->offered_price : $plan_request->price }}</p>
                                <p><b>{!! __('Duration') !!}</b>: {{
                                    $plan_request->duration > 1 && $plan_request->duration < 12 ?
                                                ($plan_request->duration == 1 ? $plan_request->duration . ' month' :  $plan_request->duration . ' months'):
                                                ($plan_request->duration >= 12 ?
                                                    number_format($plan_request->duration / 12, 1) . ' year' :
                                                    $plan_request->duration . ' months')
                                 }}</p>
                                <p><b>{!! __('Offer Price') !!}</b>: {{ $plan_request->is_offer_price == 1 ? 'Yes' : 'No' }}</p>
                                <p><b>{!! __('Currency') !!}</b>: {{ strtoupper($transaction['currency']) ?? __('N/A') }}</p>
                                <p><b>{!! __('Payment Link') !!}</b>: {{ $transaction['payment_link'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Payment Status') !!}</b>: {{ $transaction['payment_status'] ?? __('N/A') }}</p>

                            </div>
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-5"></h5>
                                <p><b>{!! __('Status') !!}</b>: {{ $transaction['status'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Amount Subtotal') !!}</b>: {{ $transaction['amount_subtotal'] / 100 ?? __('N/A') }}</p>
                                <p><b>{!! __('Amount Total') !!}</b>: {{ $transaction['amount_total'] / 100 ?? __('N/A') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Activate Plan') }}</h4>
                    </div>
                    <div class="card-body">
                    {{ Form::model($plan_request, ['route' => ['plan_request.update', $plan_request->id], 'method' => 'PUT']) }}


                    {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
        @endsection