@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add new Product</h4>

            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif


            <form action="{{ route('winner.save') }}" method="post" id="winner-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="photo">Select Offer to Win</label>
                    <select name="offer_id" class="form-control">
                        @if(isset($offers) && $offers->count() > 0)
                            @foreach ($offers as $offer)
                            <option value="{{ $offer->id }}">{{ $offer->title }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('offer_id')
                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="check-all" id="check-all" value="checkedValue" >
                    Check all users {{ isset($users)? $users->count() : 0 }}
                  </label>
                    @error('offer_id')
                        <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <hr/>
                <div class="form-group mx-4 my-2 p-2" style="height:250px; overflow: scroll ">
                    @if(isset($users) && $users->count() > 0)
                        @foreach($users as $user)
                        <div class="form-check" >
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" value="{{ $user->id }}" name="user_ids[]" id="user_{{ $user->id }}" value="checkedValue" >
                            {{ $user->name }}
                            </label>
                        </div>
                    @endforeach
                    @endif
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>

            </form>


        </div><!-- end card-body -->
    </div><!-- end card div -->


</div><!-- end container -->

@endsection

@push('scripts')

<script>
    $('#check-all').change(function (e) {
        e.preventDefault();
        $('input:checkbox').prop('checked', this.checked);
    });

    $("#winner-form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        $.ajax({
            type: method,
            url: url,
            data:  data,
            // dataType: "dataType",
            success: function (response) {

            }
        });
    });
</script>

@endpush
