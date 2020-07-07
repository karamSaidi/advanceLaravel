@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row row-cols-1 row-cols-md-3">

        <a href="{{ route('pusher') }}" class="btn btn-primary btn-block">
            <strong>{{ auth()->user()->notifications()->notseen()->count() }}</strong>
            New Notifications
            <span>Pusher notification realtime</span>
        </a>

    </div>



</div>

@endsection
