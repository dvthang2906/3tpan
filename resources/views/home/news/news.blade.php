@php
    $status = false;
@endphp
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>
    <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">
</head>

<body>
    <div class="outer-container">
        <div class="news-container" id="news-container">
            @foreach ($data as $data)
                <div class="news-item">
                    <div>
                        <img src="{{ asset('images/OrXxCXNl4J7d9WlrCmyLJL9QAB1292023.jpg') }}" alt="news image">
                        <br>
                        <span style="font-size: 12px;">{{ $status == false ? '' : '✔既読' }}</span>
                    </div>
                    <div class="news-text">
                        <h2>{{ $data->title }}</h2>
                        <div class="news-footer">
                            <span>{{ $data->created_at }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="content-container">
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>
            <p>ngay ban hiem</p>
            <p>tieu de</p>
            <p>noi dung</p>

        </div>
    </div>
    <div>fotte</div>
    <div>fotte</div>
    <div>fotte</div>

    <script src="{{ asset('js/news.js') }}"></script>
</body>

</html>
