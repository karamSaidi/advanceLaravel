@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

@if (Session::has('error'))
    <div class="alert alert-danger justify-content-center d-flex">
        {{ Session::get('error') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success justify-content-center d-flex">
        {{ Session::get('success') }}
    </div>
@endif

                    @if(isset(auth()->user()->posts) && auth()->user()->posts->count() > 0)
                    <h2 class="h1">Your Post</h2>
                        @foreach (auth()->user()->posts as $post)
                        <div class="card border-primary post_{{ $post->id }}">
                          <div class="card-body">
                            <h4 class="card-title">{{ $post->title }} <small class="float-right">by {{ $post->user->name }}</small></h4>
                            <p class="card-text">{{ $post->content }}</p>
                          </div>
                          <div class="card-footer">

                              <hr>
                              @if(isset($post->comments) && $post->comments->count() > 0)
                             <h2 class="h1">Comments</h2>
                                @foreach ($post->comments as $comment)
                                <div class="card">
                                    <div class="card-body">
                                        <h4>
                                            <img src="{{ asset('image/' . $comment->user->avatar) }}" alt="" srcset="" class="rounded-circle" style="width:55px;">
                                             {{ $comment->user->name }}
                                        </h4>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                          </div>
                        </div>

                        @endforeach
                    @endif

                    <br> <br>

                    @if(isset($posts) && $posts->count() > 0)
                    <h2 class="h1">Other user posts</h2>
                        @foreach ($posts as $post)
                        <div class="card border-primary  post_{{ $post->id }}">
                          <div class="card-body">
                            <h4 class="card-title">{{ $post->title }} <small class="float-right">by {{ $post->user->name }}</small></h4>
                            <p class="card-text">{{ $post->content }}</p>
                          </div>
                          <div class="card-footer">
                            <form action="{{ route('add.comment', $post->id) }}" method="post" class="comment_form">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" id="comment" rows="1"></textarea>
                                    @error('comment')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add your comments</button>
                            </form>
                            <hr>
                            @if(isset($post->comments) && $post->comments->count() > 0)
                           <h2 class="h1">Comments</h2>
                              @foreach ($post->comments as $comment)
                              <div class="card">
                                  <div class="card-body">
                                      <h3>
                                        <img src="{{ asset('image/' . $comment->user->avatar) }}" alt="" srcset="" class="rounded-circle" style="width:55px;">
                                          {{ $comment->user->name }}
                                        </h3>
                                      <p>{{ $comment->comment }}</p>
                                  </div>
                              </div>
                              @endforeach
                          @endif
                        </div>
                        </div>

                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
