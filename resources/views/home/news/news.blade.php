<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">
</head>

<body>

    @livewire('news-livewire')

    <div>fotte</div>
    <div>fotte</div>
    <div>fotte</div>
    @livewireScripts
    <script src="{{ asset('js/news.js') }}"></script>

</body>

</html>
