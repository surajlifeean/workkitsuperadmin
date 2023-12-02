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
                                <p><b>{!! __('Transaction Id') !!}</b>: <a style="font-size: 9px; cursor: pointer;" id="transactionId" class="cursor-pointer" 
                                    onclick="copyToClipboard()" title="copy">{{ $transaction['id'] ?? __('N/A') }}</a></p>
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

                            </div>
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-5"></h5>
                                <p><b>{!! __('Payment Link') !!}</b>: {{ $transaction['payment_link'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Payment Status') !!}</b>: {{ $transaction['payment_status'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Status') !!}</b>: {{ $transaction['status'] ?? __('N/A') }}</p>
                                <p><b>{!! __('Amount Subtotal') !!}</b>: {{ ( strtoupper($transaction['currency']) == 'XOF' || strtoupper($transaction['currency']) == 'XAF') ? $transaction['amount_subtotal'] : ( $transaction['amount_subtotal'] / 100 ?? __('N/A') ) }}</p>
                                <p><b>{!! __('Amount Total') !!}</b>: {{ ( strtoupper($transaction['currency']) == 'XOF' || strtoupper($transaction['currency']) == 'XAF') ? $transaction['amount_total'] :  ( $transaction['amount_total'] / 100 ?? __('N/A') ) }}</p>
                                
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
                                <div class="flex-wrap row d-flex">
                               
                                     <div class="my-2 col-lg-4 col-md-6 col-12">
                                        {{-- @dump($plan_request->status) --}}
                                         {{ Form::label('status', 'Status') }}
                                         @php
                                             $statusOptions = [
                                                 'active' => 'Activate',
                                                 'rejected' => 'Reject',
                                                 'hold' => 'Hold'
                                             ];
                                         
                                             if ($plan_request->status == 'pending') {
                                                 $statusOptions['pending'] = 'Pending';
                                             }
                                             if ($plan_request->status == 'active') {
                                                $statusOptions['active'] = 'Activated';
                                             }
                                             if ($plan_request->status == 'rejected') {
                                                $statusOptions = [];
                                                $statusOptions['rejected'] = 'Rejected';
                                             }
                                           
                                         @endphp
                                         
                                         {{ Form::select('status', $statusOptions, $plan_request->status, ["class" => "form-control", "name" => "status",
                                         "readonly" => ( $plan_request->status == 'rejected' ) ? "readonly" : null]) }}
                                      </div>

                                     <div class="my-2 col-lg-4 col-md-6 col-12">
                                         {{ Form::label('days', 'Number of Days') }}
                                         {{ Form::number('days', ($plan_request->duration * 30), [
                                            "class" => "form-control",
                                            "name" => "days",
                                            "placeholder" => "Exact no of days",
                                            "readonly" => ($plan_request->status != 'pending') ? "readonly" : null
                                        ]) }}
                                        
                                          <span style="font-weight: 600; font-size: 11px;">Ex: for 1 month package days can be 30 or 28 or 29 etc... ( Default 30 days per month)</span>
                                     </div>

                                     <div class="my-2 col-lg-4 col-md-6 col-12">
                                         {{ Form::label('start_date', 'Start Date and Time') }}
                                         {{ Form::datetimeLocal('start_date', ($plan_request->start_date ? \Carbon\Carbon::parse($plan_request->start_date)->timezone('Europe/Paris')->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')), ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time",  
                                         "readonly" => ($plan_request->start_date || $plan_request->status == 'rejected' ? "readonly" : null )
                                         ]) }}
                                     </div>
                                     <div class="my-2 col-lg-4 col-md-6 col-12">
                                        {{ Form::label('end_date', 'End Date and Time') }}
                                        {{ Form::datetimeLocal('end_date', \Carbon\Carbon::parse($plan_request->end_date)->timezone('Europe/Paris')->format('Y-m-d\TH:i'), ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time" , "readonly" => "readonly"]) }}
                                    </div>
                                    <div class="my-2 col-lg-4 col-md-6 col-12">
                                        {{ Form::label('hold_date', 'Hold Date and Time') }}
                                        {{ Form::datetimeLocal('hold_date', \Carbon\Carbon::parse($plan_request->hold_date)->timezone('Europe/Paris')->format('Y-m-d\TH:i'), ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time" , "readonly" => "readonly"]) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        {{ Form::submit('Update', ["class" => "btn btn-primary", "onclick" => "return confirm('Are you sure you want to continue?')",
                                         "disabled" => ($plan_request->status == 'rejected') ? "disabled" : null
                                        ]) }}
                                    </div>                                    
                                </div>
                            {{ Form::close() }}
                         
                    </div>
                </div>
            </div>
        </div>

        <script>
            function copyToClipboard() {
                var textToCopy = document.getElementById('transactionId').innerText;
        
                var textarea = document.createElement('textarea');
                textarea.value = textToCopy;
                document.body.appendChild(textarea);
        
                textarea.select();
                document.execCommand('copy');
                
                document.body.removeChild(textarea);
        
                // alert('Copied to clipboard: ' + textToCopy);
            }
        </script>
        @endsection