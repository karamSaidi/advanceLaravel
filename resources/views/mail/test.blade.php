<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send mail in background</title>
</head>
<body>
    <h1>This is an test email to send 1000 mail for users</h1>

    <p>Hello <strong>{{ $data['user'] }}</strong> </p>
    <p>this is a last post in our test mail</p>
    <ul>
        @foreach ($data['posts'] as $post)
        <li>
            {{-- <a href="{{ route('pusher') }}">{{ $post['title'] }}</a> --}}
            {{ $post['title'] }}
        </li>
        @endforeach
    </ul>



</body>
</html>
