
@if(isset($type) && $type == 'paymentCheckOut')

    @section('paymentForm')

    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $responseData['id'] }}"></script>

    <h2>اختر وسيلة الدفع</h2>
    <form action="{{ route('offers.details', $offer_id) }}" class="paymentWidgets" data-brands="VISA MASTER AMEX BITCOIN WESTERN_UNION GOOGLEPAY"></form>

    @endsection

@endif

@section('testOtherSection')
<h3>test</h3>

@endsection
