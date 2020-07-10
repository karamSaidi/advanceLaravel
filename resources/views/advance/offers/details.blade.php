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
    <div class="row">

        @isset($offer)

        <div class="col-sm-6 col-md-6">
            <a href="{{ route('offers.orders', $offer->id) }}" class="btn btn-success">Show this offer orders</a>

            <div class="card ">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $offer->title }}</h4>
                    <p class="card-text">{{ Str::limit($offer->details, 27, '...') }}</p>
                    <p class="card-text">{{ $offer->price }}</p>
                    <img class="card-img-top" src="{{ $offer->photo_url }}" style="height:350px;" alt="" class="img-fluid">
                </div>
                <div class="mb-2 text-center">
                    <a href="{{ route('offers') }}" id="btn-pay"  class="btn btn-success">Pay This</a>
                </div>
            </div><!-- end card div -->
        </div><!-- end col -->

        <div class="col-sm-6 col-md-6 text-center" id="payment_form">

        </div>


        @endisset
    </div> <!-- end row -->


</div>



@push('scripts')
    <script>
        $('#btn-pay').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('offers.cheackOut') }}",
                data: {
                    "price" : "{{ $offer->price }}",
                    "offer_id" : "{{ $offer->id }}"
                    },
                success: function (response) {
                   if(response.status){
                       $('#payment_form').empty().html(response.content);
                   }
                }
            });
        });
    </script>
@endpush



@endsection


