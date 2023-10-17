@extends('layouts.admin')

@section('page-title')
{{ __('Company Deatails') }}
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
                        <h4>{{ __('Company Name:')}} {{ $company->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <p>{{ __('Company Email:') }} {{ $company->email }}</p>
                                <p>{{ __('Company Created:') }} {{ $company->created_at }}</p>
                            </div>
                            <div class="col-lg-6">
                                <div class="card" style="background-color:  transparent; box-shadow: unset;">

                                    <div class="card-body">
                                        <p style="margin-top: -1.1rem;">{{ __('Active plan')}}</p>
                                        <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp; max-width: 300px;">
                                            <div class="card-body ">
                                                <span class="price-badge bg-primary">{{ $companyInfo[0]->plan }}</span>

                                                <span class="mb-4 f-w-600 p-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ number_format($companyInfo[0]->price) }}
                                                    <small class="text-sm">
                                                        / {{
                                                             $companyInfo[0]->duration > 1 && $companyInfo[0]->duration < 12 ?
                                                                 ($companyInfo[0]->duration == 1 ? $companyInfo[0]->duration . ' month' :  $companyInfo[0]->duration . ' months'):
                                                                 ($companyInfo[0]->duration >= 12 ?
                                                                     number_format($companyInfo[0]->duration / 12, 1) . ' year' :
                                                                     $companyInfo[0]->duration . ' months')
                                                          }}
                                                    </small>

                                                </span>

                                                <p class="mb-0">
                                                    {{ $companyInfo[0]->description }}
                                                </p>

                                                <ul class="my-4 list-unstyled">
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        {{ $companyInfo[0]->total_users == -1 ? __('Unlimited') : $companyInfo[0]->total_users }} {{ __('Users') }}
                                                    </li>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        {{ $companyInfo[0]->total_users == -1 ? __('Unlimited') : $companyInfo[0]->total_users - 1 }}
                                                        {{ __('Employees') }}
                                                    </li>
                                                    {{-- <li>
                                                          <span class="theme-avtar">
                                                              <i class="text-primary ti ti-circle-plus"></i></span>
                                                          {{ $plan->storage_limit == -1 ? __('Lifetime') : $plan->storage_limit }}
                                                    {{ __('MB Storage') }}
                                                    </li> --}}
                                                    {{-- <li>
                                                          <span class="theme-avtar">
                                                              <i class="text-primary ti ti-circle-plus"></i></span>
                                                          {{ $plan->enable_chatgpt == 'on' ? __('Enable Chat GPT') : __('Disable Chat GPT') }}
                                                    </li> --}}
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                
            </div> -->
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('All Plan Requests') }}</h4>
            </div>
            <div class=" card-body table-border-style">
                <div class="table-responsive">


                    <div class="p-3 table-responsive">
                        <table class="table" id="pc-dt-simple">

                            <thead>
                                <tr>
                                    <th>{{ __('Plan Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Total Users') }}</th>
                                    <th>{{ __('Total Employees') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($companyInfo as $plan_request)
                                <tr>

                                    <td>{{ $plan_request->plan }}</td>
                                    <td>
                                        {{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ number_format($companyInfo[0]->price) }}
                                    </td>
                                    <td>{{ $plan_request->total_users == -1 ? 'Unlimited' :  $plan_request->total_users }}</td>
                                    <td>{{ $plan_request->total_users == -1 ? 'Unlimited' : $plan_request->total_users - 1 }}</td>
                                    <td>
                                        {{-- {{ $plan_request->duration }} --}}
                                        {{

                                            $plan_request->duration > 1 && $plan_request->duration < 12 ?
                                                ($plan_request->duration == 1 ? $plan_request->duration . ' month' :  $plan_request->duration . ' months'):
                                                ($plan_request->duration >= 12 ?
                                                    number_format($plan_request->duration / 12, 1) . ' year' :
                                                    $plan_request->duration . ' months')
                                        }}
                                    </td>
                                    <td>{{ $plan_request->start_date }}</td>
                                    <td>{{ $plan_request->end_date }}</td>
                                    <td>
                                        {{ ucfirst($plan_request->status) }}
                                    </td>
                                    <td>
                                        @isset($plan_request->transaction_id)
                                        <a href="{{  route('transactions.show', $plan_request->transaction_id) }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @endisset
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection