<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ route('pusher') }}"> Puser realtime</a></li>
                        <li><a class="nav-link" href="{{ route('offers') }}"> Payment</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="dropdown dropdown-notification nav-item  dropdown-notifications">
                                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                    <i class="fa fa-bell"> </i>
                                    <span
                                        class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow   notif-count"
                                        data-count="{{ auth()->user()->notifications()->notseen()->count() }}">{{ auth()->user()->notifications()->notseen()->count() }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right " style="min-width:300px;">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0 text-center">
                                            <span class="grey darken-2 text-center"> الإشعارات</span>
                                        </h6>
                                    </li>
                                    <li class="scrollable-container ps-container ps-active-y media-list ">
                                        @foreach (auth()->user()->notifications()->notseen() as $notification)

                                        <a href="{{ url($notification->url . '/' . $notification->id) }}">
                                            <div class="media" style="direction: rtl;">
                                                <img src="{{ $notification->user->getAvatar() }}" alt="" srcset="" class="rounded-circle ml-3" style="width:55px;">
                                                <div class="media-body">
                                                    <h6 class="media-heading text-right ">{{ $notification->title }}</h6>
                                                    <p class="notification-text font-small-3 text-muted text-right">{{ $notification->content }}</p>
                                                    <small style="direction: ltr;">
                                                        <p class=" text-muted text-right"
                                                                style="direction: ltr;"> {{  $notification->created_at->diffForHumans() }}
                                                        </p>
                                                        <br>

                                                    </small>
                                                </div>
                                            </div>
                                        </a>

                                        @endforeach

                                    </li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                                                        href=""> جميع الاشعارات </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9e9d971f942dae861e4c', {
      cluster: 'ap2'
    });

    var user_id = {{ auth()->id() }}

    //   var channel = pusher.subscribe('channel-comments-notification');
    //   channel.bind('comments-notification', function(data) {
    //       if(user_id == data.user_id)
    //             alert(JSON.stringify(data));
    //   });
    </script>


      <script src="{{ asset('js/commentPusher.js') }}"></script>

      @stack('scripts')

</body>
</html>
