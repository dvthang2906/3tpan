@php
    $loginUserName = '';
    if (Session::has('username')) {
        $loginUserName = session('username');
    }

    $loginStatus = '';
    if (Session::has('login_status')) {
        $loginStatus = Session::get('login_status');
    }

    if (!empty($result)) {
        $result = $result;
    } else {
        $result = [];
    }

    $meaning_2 = '';

    $tangoSample = [];
    $cachDoc = [];
    $yNghia = [];

    foreach ($result as $v) {
        foreach ($v['senses'] as $va) {
            $yNghia[] = implode(', ', $va['english_definitions']);
        }
    }
@endphp



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
    <title>HomePage</title>

    <style>
        .red-placeholder::placeholder {
            color: red;
        }
    </style>
</head>

<body>

    <header class="flex">
        <a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}" alt="logo"></a>
        <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
            <div class="hder hidden lg:flex lg:gap-x-12">
                <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
                <a href="#" class="hd_text" title="3T-Panについて">About</a>
                <a href="#" class="hd_text" title="3T-Panについて">3Tpan Premium</a>
                <a href="{{ route('contact') }}" class="hd_text" title="お問い合わせ">Contact</a>
                @if (Session::has('username'))
                    ユーザー:
                    &nbsp;&nbsp;
                    {{ session('username') }}
                @endif
                <a href="{{ route('logout') }}" class="log_text">
                    @php
                        if (Session::has('login_status')) {
                            $login = 'ログアウト';
                        } else {
                            $login = 'ログイン';
                        }
                    @endphp
                    <span aria-hidden="true">{{ $login }}&rarr;</span>
                </a>
            </div>
        </nav>
    </header>
    <div class="nav_head">
        <div class="nomal">
            <a href="#" class="bt_nav" title="辞書"><span>辞書</span></a>
            <a href="{{ route('flashcards') }}" class="bt_nav" title="フラッシュカード"><span>フラッシュカード</span></a>
            <a href="{{ route('test') }}" class="bt_nav" title="テストしてみよう！"><span>テスト</span></a>
        </div>
        <nav class="navbar">
            <ul class="nav">
                <li class="nav-item"><a href="{{ route('pronunciation') }}"><span>話す</span></a></li>
                <li class="nav-item"><a href="#"><span>読む</span></a></li>
                <li class="nav-item"><a href="#"><span>聴く</span></a></li>
                <li class="nav-item"><a href="#"><span>書く</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="balloon2">
        <p>今日のおすすめ</p>
    </div>
    <div class="today_new">

        <ul class="today_list">
            <li>今日：Hôm nay</li>
            <li>a</li>
        </ul>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ $loginUserName }}</div>
    @endif
    <form action="{{ route('post-jisho-search') }}" method="POST">
        <div class="search">
            <div class="search-box">
                <input type="text" name="value" value="{{ $tangoValue = isset($tangoValue) ? $tangoValue : '' }}"
                    placeholder="検索キーワード">
            </div>
            <div class="bt_search">
                {{-- <button id="recordButton" class="bt_s" title="ボイスで検索"><span>🎤Ghi âm</span></button> --}}
                {{-- <button type="submit" class="bt_s" title="検索履歴"><span>⌚</span></button> --}}
                <button type="submit" class="bt_s" title="検索"><span>🔍</span></button>
            </div>
        </div>
        @csrf
    </form>
    <h3 class="h3">検索結果</h3>

    <div class="search_result" style="max-height: 200px; overflow-y: auto;">
        {{-- <div id="result">1: </div> --}}
        <p style="margin: 5px">
            @if (isset($result[0]))
                単語：
                @foreach ($result[0]['japanese'] as $m)
                    @if (isset($m['word']) && !is_null($m['word']))
                        <a style="color: #9966CC; border-bottom: 1px solid;"
                            onclick="showPopup()">{{ $m['word'] }}</a>
                        &nbsp;
                    @endif
                @endforeach
            @endif
        </p>
        <p style="margin: 5px">
            @if (isset($result[0]))
                読み方：
                @foreach ($result[0]['japanese'] as $m)
                    @if (isset($m['reading']))
                        {{ $m['reading'] }}
                        &nbsp;
                    @endif
                @endforeach
            @endif
        </p>
        <p style="margin: 5px; word-wrap: break-word;">
            @if (isset($imiString))
                <span>意味：</span>
                {{ $imiString }}
            @endif
        </p>
        <p>
            @if (isset($result[0]))
                <h3 style="margin: 0px;">Sample</h3>

                @foreach ($result as $m)
                    @foreach ($m['japanese'] as $value)
                        @if (isset($value['word']))
                            @php
                                if (isset($value['word'])) {
                                    $tangoSample[] = $value['word'];
                                } else {
                                    $tangoSample[] = 'データがない';
                                }

                                if (isset($value['reading'])) {
                                    $cachDoc[] = $value['reading'];
                                } else {
                                    $cachDoc[] = 'データがない';
                                }
                            @endphp
                            @if ($value['word'] != $tangoValue)
                                <span name="tudongnghia" data-id="{{ $value['word'] }}"
                                    style="color: #9966CC; border-bottom: 1px solid;"
                                    onclick="showPopup()">{{ $value['word'] }}</span>
                                &nbsp;
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endif

        </p>
    </div>



    <div class="ads">
        <iframe id="" width="110%" height="110%" src="https://comp.ecc.ac.jp/" title="ECCコンピュータ専門学校"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>
    </div>
    <h3 class="h3">コメント欄</h3>
    <div class="cmt">
        <div id="commentContainer">
            @if (!empty($comment))
                @foreach ($comment as $commentData)
                    <div class="comment">
                        <div class="user" style="color: red;">{{ $commentData->user }}</div>
                        <div class="comment-text">{{ $commentData->comment }}</div>
                        <div class="comment-time">{{ $commentData->created_time }}</div>
                    </div>
                @endforeach
            @endif
        </div>
        @if (!isset($tangoValue) || $tangoValue != '')
            <div class="comment-container">
                <!-- Phần đăng comment -->
                @csrf
                <div class="form-group">
                    <textarea class="cmt_area" id="comment-text" name="comment-text" required placeholder="Viết bình luận"></textarea>
                </div>
                <button class="bt_cmt" id="comment-button" type="submit" name="comment-value"
                    style="margin-bottom: 50px;">COMMENT</button>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Lắng nghe sự kiện click trên nút "COMMENT"
        var commentButton = document.getElementById("comment-button");
        var commentText = document.getElementById("comment-text");
        var commentContainer = document.getElementById("commentContainer");
        // Chuyển đổi biến PHP sang JSON và gán nó vào biến JavaScript
        var loginStatus = JSON.parse('<?php echo json_encode($loginStatus); ?>');

        commentButton.addEventListener("click", function() {
            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            console.log('loginStatus: ', loginStatus);
            if (commentText.value == '') {

                if (commentText.value == '') {
                    commentText.classList.add('red-placeholder');
                    commentText.placeholder = 'Bạn cần nhập nội dung Comment!!!';
                    return;
                } else {
                    // Nếu không rỗng, đảm bảo xóa class để không hiển thị màu đỏ
                    commentText.classList.remove('red-placeholder');
                }
            }
            if (loginStatus == '' || !loginStatus) {
                if (confirm('Bạn cần đăng nhập. Bấm OK để đăng nhập.')) {
                    window.location.href = '{{ route('login') }}';
                } else {
                    // Xử lý khi người dùng không muốn đăng nhập

                }
            } else {
                // Lấy nội dung bình luận từ trường textarea
                var commentTextValue = commentText.value;

                // Lấy giá trị token CSRF từ trang HTML
                var tokenInput = document.querySelector('input[name="_token"]');
                var token = tokenInput.value;

                // Sử dụng Axios để gửi yêu cầu POST
                axios.post('/home/add-comment', {
                        _token: token, // Gửi token CSRF
                        commentText: commentTextValue // Dữ liệu bình luận
                    })
                    .then(function(response) {
                        // Xử lý phản hồi từ Controller ở đây
                        var commentValue = response.data;
                        // Để xóa nội dung, thiết lập giá trị của nó thành chuỗi rỗng
                        commentText.value = '';
                        reloadData(commentValue);
                        // console.log(commentValue);
                    })
                    .catch(function(error) {
                        // Xử lý lỗi (nếu có)
                        console.error(error);
                    });
            }
        });

        function reloadData(data) {
            // Tạo một div mới chứa thông tin comment
            var newComment = document.createElement('div');
            newComment.className = 'comment';

            var user = document.createElement('div');
            user.className = 'user';
            user.style.color = 'red';
            user.textContent = data.user;

            var commentText = document.createElement('div');
            commentText.className = 'comment-text';
            commentText.textContent = data.comment;

            var timeComment = document.createElement('div');
            timeComment.className = 'comment-time';
            timeComment.textContent = data.created_time;

            // Thêm các phần tử vào div comment mới
            newComment.appendChild(user);
            newComment.appendChild(commentText);
            newComment.appendChild(timeComment);

            // Thêm div comment mới vào container
            commentContainer.appendChild(newComment);
        }
    </script>
    {{-- sự kiện click nút a --}}
    <script>
        // Biến kiểm tra trạng thái hiển thị của popup
        var isPopupVisible = false;

        // Hàm hiển thị popup
        function showPopup() {
            if (isPopupVisible) {
                closePopup(); // Đóng popup hiện tại nếu nó đang hiển thị
            }

            var element = event.target; // Lấy phần tử mà bạn đã nhấp vào
            var name_value = element.getAttribute('data-id'); // Lấy giá trị của thuộc tính data-id

            // Truyền biến từ PHP vào JavaScript
            window.tango = @json($tangoSample);
            window.cachDoc = @json($cachDoc);
            window.yNghia = @json($yNghia);

            // Tạo div chứa nội dung popup
            let popup = document.createElement('div');
            popup.id = 'popup';

            // Thiết lập CSS cho popup
            popup.style.position = 'fixed';
            popup.style.top = '60%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.background = '#fff';
            popup.style.padding = '20px';
            popup.style.border = '1px solid #000';

            // Nội dung popup
            if (typeof window.tango !== 'undefined') {
                for (var i = 0; i < window.tango.length; i++) {
                    if (window.tango[i] == name_value) {
                        popup.innerHTML = '<b style="margin-bottom: 5px; color: red;">詳細:</b><br />単語：' + window.tango[i] +
                            '<br />読み方：' +
                            window.cachDoc[i] + '<br />意味：' + window.yNghia[i] + '<br />';
                        break;
                    }
                }
            } else {
                console.log("Biến tango không có giá trị hoặc là undefined.");
            }

            // Thêm nút đóng
            let closeBtn = document.createElement('button');
            closeBtn.innerText = 'X';
            closeBtn.style.color = 'red';
            closeBtn.style.position = 'absolute';
            closeBtn.style.top = '10px';
            closeBtn.style.right = '10px';
            closeBtn.style.border = 'none';
            closeBtn.style.background = 'none';
            closeBtn.style.fontWeight = 'bold';
            closeBtn.onclick = closePopup;
            popup.appendChild(closeBtn);

            // Hiển thị popup
            document.body.appendChild(popup);
            popup.style.display = 'block';

            isPopupVisible = true; // Đánh dấu rằng popup đang hiển thị
        }


        // Đóng popup
        function closePopup() {
            document.getElementById('popup').remove();
            isPopupVisible = false;
        }
    </script>

</body>

</html>
