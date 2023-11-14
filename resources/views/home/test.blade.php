<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <title>Test Page</title>
</head>

<body>
    <div class="nav_head">
        <div class="nomal">
            <a href="#" class="bt_nav"><span>辞書</span></a>
            <a href="#" class="bt_nav"><span>フラッシュカード</span></a>
            <a href="#" class="bt_nav"><span>お問い合わせ</span></a>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="#"><span>話す</span></a></li>
                <li class="nav-item"><a href="#"><span>読む</span></a></li>
                <li class="nav-item"><a href="#"><span>聴く</span></a></li>
                <li class="nav-item"><a href="#"><span>書く</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="contents">
        <ul class="nav_t">
            <li><a href="#">N1</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Từ vựng</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Ngữ pháp</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N2</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Từ vựng</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Ngữ pháp</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N3</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Từ vựng</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Ngữ pháp</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N4</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Từ vựng</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Ngữ pháp</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N5</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Từ vựng</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Ngữ pháp</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">Đề 01</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 02</a></li>
                            <li><a href="#" style="margin-left: 5px">Đề 03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="test_id">
        Hiển thị bài test ở đây
    </div>
    <input type="checkbox" id="actionMenuButton" class="muti-ck" />
    <div class="actions-menu">
        <button class="btn btn--share">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff" d="M21,11L14,4V8C7,9 4,14 3,19C5.5,15.5 9,13.9 14,13.9V18L21,11Z" />
            </svg>
        </button>
        <button class="btn btn--star">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff"
                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
            </svg>
        </button>
        <button class="btn btn--comment">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff"
                    d="M19,3A2,2 0 0,1 21,5V19C21,20.11 20.1,21 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H19M16.7,9.35C16.92,9.14 16.92,8.79 16.7,8.58L15.42,7.3C15.21,7.08 14.86,7.08 14.65,7.3L13.65,8.3L15.7,10.35L16.7,9.35M7,14.94V17H9.06L15.12,10.94L13.06,8.88L7,14.94Z" />
            </svg>
        </button>
        <label for="actionMenuButton" class="btn btn--large btn--menu" />
    </div>
</body>

</html>
