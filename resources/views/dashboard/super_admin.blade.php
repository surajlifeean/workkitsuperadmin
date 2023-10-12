@extends('layouts.admin')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
{{-- @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
@endsection --}}

@section('content')
<div class="row">
    <div class="col-xxl-6">

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 250px">
                    <div class="card-body">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-users"></i>
                        </div>
                        <p class="mt-4 mb-2 text-sm text-muted">{{ __('Total Users') }} : {{$total_users}}</p>
                        <h6 class="mb-3">{{ __('Paid Users') }}</h6>
                        <h3 class="mb-0">{{$paid_users}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 250px">
                    <div class="card-body">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-shopping-cart"></i>
                        </div>
                        <p class="mt-4 mb-2 text-sm text-muted">{{ __('Total Orders') }}:{{ $total_orders}}</p>
                        <h6 class="mb-3">{{ __('Total Order Amount') }}</h6>
                        <h3 class="mb-0">{{ (!empty(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$') . $total_order_amount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 250px">
                    <div class="card-body">
                        <div class="theme-avtar bg-warning">
                            <i class="ti ti-trophy"></i>
                        </div>
                        <p class="mt-4 mb-2 text-sm text-muted">{{ __('Total Plan') }}: {{$total_plans}}</p>
                        <h6 class="mb-3">{{ __('Most Purchase Plan') }}</h6>
                        <h3 class="mb-0">{{ $mostPurchasedPlan->plan }}</h3>
                        <h6 class="mt-1 mb-0">{{ $mostPurchasedPlan->is_offer_price == 0 ? (!empty(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$') . $mostPurchasedPlan->price : (!empty(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$') . $mostPurchasedPlan->offered_price }}</h6>
                    </div>
                </div>
            </div>

        </div>
   </div>
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Recent Order') }}</h5>
            </div>
            <div class="card-body">
                <div id="chart-sales" height="200" class="p-3"></canvas>
            </div>

        </div>
    </div>

</div>
@endsection

@push('script-page')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
         (function () {
        var chartBarOptions = {
            series: [
                {
                    name: '{{__("Order")}}',
                    data:  {!! json_encode($chartData['data']) !!},

                },
            ],

            chart: {
                height: 300,
                type: 'area',
                // type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            xaxis: {
                categories: {!! json_encode($chartData['label']) !!},
                title: {
                    text: ''
                }
            },
            colors: ['#6fd944', '#6fd944'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: false,
            },
            // markers: {
            //     size: 4,
            //     colors: ['#ffa21d', '#FF3A6E'],
            //     opacity: 0.9,
            //     strokeWidth: 2,
            //     hover: {
            //         size: 7,
            //     }
            // },
            yaxis: {
                title: {
                    text: ''
                },

            }

        };
        var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
        arChart.render();
        })();
    </script>
@endpush
