@extends('layouts.admin')

@section('page-title')
@if (\Auth::user()->type == 'super admin')
{{ __('Messages') }}
@else
{{ __('Manage Users') }}
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
@if (\Auth::user()->type == 'super admin')
<li class="breadcrumb-item">{{ $notifications[0]->company_name }} <small>({{ $notifications[0]->email}})</small></li>
@else
<li class="breadcrumb-item">{{ __('Users') }}</li>
@endif
@endsection


@php
$logo = \App\Models\Utility::get_file('uploads/avatar/');

$profile = \App\Models\Utility::get_file('uploads/avatar/');

$set_seen = \App\Models\Notification::where('company_id', $notifications[0]->company_id)->update(['is_seen'=> 1]);

@endphp

@section('content')
<div class="row">

    <div class="row">

        <div class="col-xl-12" id="chat-container" style="overflow-y: scroll; height: 60vh;">
            @foreach($notifications as $notification)
            @if($notification->is_superadmin == 0)
            <div class="my-2">
                <div class="p-2 card" style="max-width: 80%;width: fit-content;min-width: 300px;">
                    <h4>{{ $notification->title }}</h4>
                    <p style="max-width: 100%; overflow-wrap: break-word">{{ $notification->message }}</p>
                    <p style="font-size: 10px;" class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->timezone('Europe/Paris')->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            @else
            <div class="my-2 ">
                <div class="p-2 ml-auto card" style="margin-left: auto;max-width: 90%;width: fit-content;min-width: 300px; background: #D9FDD3;">
                    <h4>{{ $notification->title }}</h4>
                    <p style="max-width: 100%; overflow-wrap: break-word">{{ $notification->message }}</p>
                    <p style="font-size: 10px;" class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->timezone('Europe/Paris')->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            @endif
            @endforeach
            <div class="my-5"></div>
        </div>
        <form method="post" action="{{ route('notifications.store') }}" class="p-3 col-10 card position-fixed" style="bottom: 0; max-width: 400px;">
            @csrf
            
            <input type="hidden" name="company_id" value="{{ $notifications[0]->company_id }}">

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required class="form-control">

            <label for="message">Message:</label>
            <textarea name="message" id="message" required class="form-control"></textarea>

            <button type="submit" class="mt-2 btn btn-primary">Submit</button>
        </form>

    </div>
</div>
<script>
    window.addEventListener("load", function() {
        var element = document.getElementById("chat-container");
        element.scrollTop = element.scrollHeight;
    });
</script>
@endsection