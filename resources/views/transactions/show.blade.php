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
                        <h4>{{ __('Transaction Deatails')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="card" style="background-color:  transparent; box-shadow: unset;">

                                    <div class="card_body">
                                        
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

   
</div>
@endsection