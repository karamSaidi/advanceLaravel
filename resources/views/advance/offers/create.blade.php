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


            <form action="{{ route('offer.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control-file" name="photo" id="photo" placeholder="Photo" >
                    @error('photo')
                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Product Title</label>
                    <input type="text"
                        class="form-control" name="title" id="title"  placeholder="Product Title">
                    @error('title')
                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea class="form-control" name="details" id="details" rows="5"></textarea>
                    @error('details')
                        <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="text"
                        class="form-control" name="price" id="price"  placeholder="Product Price">
                    @error('price')
                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>

            </form>


        </div><!-- end card-body -->
    </div><!-- end card div -->


</div><!-- end container -->

@endsection
