<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">
    <title>Data CTL</title>
</head>

<body>
    <h1 class="ad">
        <b>ROLE: </b>
        <span style="color: red">
            <a href="{{ route('admin') }}">
                {{ Session::has('StatusRole') ? 'Admin' : '' }}
            </a>
        </span>
    </h1>
    <nav class="data" style="padding: 20px;">
        <a href="{{ route('kanji') }}">Kanji</a>
        <a href="{{ route('show-news') }}">News</a>
        <a href="{{ route('shows.test') }}">Test</a>
        <a href="{{ route('show.vocabulary') }}">Vocabulary</a>
    </nav>

</body>

</html>
