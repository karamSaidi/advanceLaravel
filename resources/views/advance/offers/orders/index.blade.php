@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if(isset($orders) && $orders->count() > 0)

    <div class="row">
        @foreach ($orders as $order)
        <div class="col-sm-2 col-md-4">

            <div class="card ">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $order->transaction_id }}</h4>
                    <p class="card-text">{{ $order->offer->price }}</p>
                </div>
                <div class="mb-2 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#order_info_{{ $order->id }}">
                      Show Order Transaction infromation
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="order_info_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Transaction information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body text-left">
                                    <table class="table table-striped table-inverse table-responsive">
                                        <tbody>
                                            @foreach($order->transaction_info as $key => $value)
                                            <tr>
                                                <th>{{ $key }}</th>
                                                <td>

                                                    @if ( is_array($value) )
                                                    <table class="table table-striped table-inverse table-responsive">
                                                        <tbody>
                                                        @foreach ($value as $k => $v)
                                                            <th>{{ $k }}</th>
                                                            <td>{{ $v }}</td>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    @else
                                                    {{ $value }}
                                                    @endif
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
            </div><!-- end card div -->
        </div><!-- end col -->

        @endforeach
    </div> <!-- end row -->

    @endif




</div>


@endsection


