@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Plan Request') }}
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Plan Request') }}</li>
@endsection



@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        {{-- <table class="table" id="pc-dt-simple">
                        <thead class="d-none"></thead>

                        <tbody>
                            @if ($plan_requests->count() > 0)
                                @foreach ($plan_requests as $prequest)
                                    <tr>
                                        <td>
                                            <div class="font-style font-weight-bold">{{ $prequest->user->name }}</div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold">{{ $prequest->plan->name }}</div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $prequest->plan->max_employee }}</div>
                                            <div>{{ __('Employee') }}</div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold">
                                                {{ $prequest->duration == 'monthly' ? __('One Month') : __('One Year') }}
                                            </div>
                                        </td>
                                        <td>{{ \App\Models\Utility::getDateFormated($prequest->created_at, true) }}
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('response.request', [$prequest->id, 1]) }}"
                                                    class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Approve') }}">
                                                    <i class="ti ti-checks"></i>
                                                </a>
                                                <a href="{{ route('response.request', [$prequest->id, 0]) }}"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Cancel') }}">
                                                    <i class="ti ti-shield-x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="col" colspan="7">
                                        <h6 class="text-center">{{ __('No Manually Plan Request Found.') }}</h6>
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table> --}}

                    <div class="p-3 table-responsive">
                        <table class="table" id="pc-dt-simple">
    
                            <thead>
                                <tr>
                                    <th>{{ __('Company Id')}}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Plan Name') }}</th>
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
                                @foreach ($plan_requests as $plan_request)
                                <tr>
                                    <td>{{ $plan_request->company_id }}</td>
                                    <td>{{ $plan_request->company_name }}</td>
                                    <td>{{ $plan_request->plan }}</td>
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
                                       <a href="{{ route('transactions.show', $plan_request) }}">
                                             <i class="ti ti-pencil"></i>
                                        </a>
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
