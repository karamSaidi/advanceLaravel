@extends('layouts.app')

@section('content')
<div class="container">

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

    </div>



</div>

@endsection
