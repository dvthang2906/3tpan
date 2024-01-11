<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://ngocthang.net/wp-content/uploads/2020/04/sticker-facebook.gif" type="image/x-icon">

    {{-- TUAN --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
    @yield('css')

    <title>3Tpan</title>
</head>

<body>
    @include('layouts.head')

    @yield('content')

    {{--
    <script src="{{ asset('assets/clients/js/bootstrap.min.js') }}"></script> --}}
    @yield('js')
    @stack('scripts')
</body>

</html>
