@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if(isset($offers) && $offers->count() > 0)

    <div class="row">
        @foreach ($offers as $offer)
        <div class="col-sm-2 col-md-4">

            <div class="card ">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $offer->title }}</h4>
                    <p class="card-text">{{ $offer->price }}</p>
                    <img class="card-img-top" src="{{ $offer->photo_url }}" style="height:350px;" alt="" class="img-fluid">
                </div>
                <div class="mb-2 text-center">
                    <a href="{{ route('offers.details', $offer->id) }}" class="btn btn-success">Details</a>
                </div>
            </div><!-- end card div -->
        </div><!-- end col -->

        @endforeach
    </div> <!-- end row -->

    @endif




</div>

@endsection


