<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ListenView</title>
    <style>
        p {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1><a href="{{ route('home') }}">HOME</a>&nbsp;video List</h1>

    {{-- dữ liệu lấy ra từ database --}}
    <div class="videos-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
        @foreach ($Videolist as $videos)
            <div class="videoList"
                style="border: 1px solid black; padding: 10px; width: 230px; height: 260px; text-align: center; margin: 10px;">
                <a href="{{ route('listen-id', ['id' => $videos->id]) }}">
                    <!-- Thiết lập kích thước cố định cho ảnh -->
                    <img src="{{ asset($videos->images ?? 'images/logo.jpg') }}" alt="images"
                        style="width: 230px; height: 180px;">
                    <p>{{ $videos->title }}</p>
                    <p>{{ $videos->description }}</p>
                    {{-- <p>{{ $videos->url }}</p> --}}
                    {{-- <p>{{ $videos->updated_at }}</p> --}}
                </a>
            </div>
        @endforeach
    </div>
    {{-- dữ liệu lấy ra từ database --}}

</body>

</html>
