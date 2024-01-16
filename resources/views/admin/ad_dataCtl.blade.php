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
        <b>ROLE: </b><span style="color: red">{{ Session::has('StatusRole') ? 'Admin' : '' }}</span>
    </h1>
    <div class="data" style="padding: 20px;">
        <a href="{{ route('kanji') }}">kanji</a>
        <a href="{{ route('show-news') }}">news</a>
        <a href="{{ route('shows.test') }}">test</a>
        <a href="#">vocabulary</a>
    </div>

</body>
</html>
