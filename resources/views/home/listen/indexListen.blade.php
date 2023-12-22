<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ListenView</title>
</head>

<body>
    <h1><a href="{{ route('home') }}">HOME</a>&nbsp;video List</h1>


    @foreach ($Videolist as $videos)
        <div>
            <a href="{{ route('listen-id', ['id' => $videos->id]) }}">{{ $videos->id }}</a>
            <p>{{ $videos->title }}</p>
            <p>{{ $videos->description }}</p>
            {{-- <p>{{ $videos->url }}</p> --}}
            <p>{{ $videos->updated_at }}</p>
        </div>
    @endforeach


</body>

</html>
