<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">
    @endsection


</head>

<body>


    @include('layouts.head')

    {{-- @section('content')
    @livewire('news-livewire')
    @endsection --}}

    @livewire('news-livewire')
    <h1>testststs</h1>
    <h1>aaaaaaaaaaaaa</h1>
    <h1>bbbbbbbbbbbb</h1>

    <div>fotte</div>
    <div>fotte</div>
    <div>fotte</div>
    @livewireScripts
    <script src="{{ asset('js/news.js') }}"></script>

</body>

</html>
