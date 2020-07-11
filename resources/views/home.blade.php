@extends('layouts.app')

@section('content')
<div class="container">

    <div class="text-center">
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    </div>

    <div class="row mb-3">
        <div class="col-4 mb-3">
            <a href="{{ route('pusher') }}" class="btn btn-primary btn-block">
                <strong>{{ auth()->user()->notifications()->notseen()->count() }}</strong>
                New Notifications
                <span>Pusher notification realtime</span>
            </a>
        </div>

        <div class="col-4 mb-3">
            <a href="{{ route('offers') }}" class="btn btn-primary btn-block">
                <strong>Payment</strong>
                <span>payment </span>
            </a>
        </div>

        <div class="col-4 mb-3">
            <a href="{{ route('mail.background') }}" class="btn btn-primary btn-block">
                <strong>sending mail in background</strong>
                <span></span>
            </a>
        </div>

        <div class="col-4 mb-3">
            <a href="{{ route('winner-form') }}" class="btn btn-primary btn-block">
                <strong>10000 Winner choose</strong>
                <span>run in with queue</span>
            </a>
        </div>

    </div>



</div>

@endsection
