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
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        .red-placeholder::placeholder {
            color: red;
        }

        /* CSS của おすすめ単語 */
        .centered-item {
            text-align: center;
            /* Các quy tắc CSS khác ở đây nếu cần */
        }

        .today_list li .item-word {
            color: black;
        }

        /* Phong cách chung cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 110%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            /* Màu nền mờ với độ trong suốt */
            animation: fadeIn 0.5s;
            /* Hiệu ứng xuất hiện */
        }

        /* Hiệu ứng fade in cho modal */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Phong cách cho nội dung modal */
        .modal-content {
            display: flex;
            /* Aligns children vertically */
            justify-content: start;
            /* Starts children at the beginning of the content box */
            padding: 20px;
            /* Padding inside the modal content box */
            position: relative;
            background-color: #fefefe;
            margin: 15% auto;
            border-radius: 5px;
            border: 1px solid #888;
            width: 50%;
            /* Width of the modal-content */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            animation: slideIn 0.5s;

        }

        /* Hiệu ứng slide in cho nội dung modal */
        @keyframes slideIn {
            from {
                margin-top: -50%;
            }

            to {
                margin-top: 15%;
            }
        }

        /* Phong cách cho nút đóng */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }


        /* Phong cách cho thông tin chi tiết */
        .modal-content p {
            font-size: 18px;
            /* Tăng kích thước font chữ */
            color: #333;
            line-height: 1.8;
        }


        .modal-content span {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .userlogoImages {
            /* display: flex;
            justify-content: flex-end; */
            margin-right: 30px;
        }

        .modal-content>div:not(.userlogoImages) p {
            margin-top: 0;
            margin-bottom: 0.5em;
            /* Adjust as needed */
        }


        .userlogoImages img {
            width: auto;
            height: 150px;
            margin-right: 0;
            /* Reduced margin between the image and the text */
            margin-top: 10px;
        }

        .modal-content>div:not(.userlogoImages) {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 0;
            /* Reduced padding to bring text closer to the image */
        }

        .close {
            position: absolute;
            right: 5px;
            /* Giữ nguyên hoặc điều chỉnh nếu cần */
            top: -10px;
            /* Điều chỉnh giá trị này để nút di chuyển lên trên */
            z-index: 2;
            font-size: 28px;
            /* Giảm nếu muốn nút nhỏ hơn */
        }

        .modal-content b {
            font-weight: bold;
            color: red;
        }

        .modal-content p {
            margin-top: 0;
            margin-bottom: 0.5em;
            /* Adjust space between paragraphs */
            font-size: 18px;
        }
    </style>
</head>

<body>

    <header class="flex">
        <a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}" alt="logo"></a>
        <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
            <div class="hder hidden lg:flex lg:gap-x-12">
                <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
                <a href="{{ route('about') }}" class="hd_text" title="3T-Panについて">About</a>
                <a href="#" class="hd_text" title="3T-Panについて">3Tpan Premium</a>
                <a href="{{ route('contact') }}" class="hd_text" title="お問い合わせ">Contact</a>
                <!-- Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <b class="close" id="close">&times;</b>
                        <div class="userlogoImages">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="20%">
                        </div>
                        <div class="flex flex-col space-y-2">
                            <p class="flex justify-between items-center">
                                <span>ユーザーID: <input type="text" id="userName" class="text-sm py-1 px-2"
                                        style="border-bottom: 1px solid #000"></span>
                                <button id="updateUserID"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
                            </p>
                            <p class="flex justify-between items-center">
                                <span>氏名: <input id="userFullName" type="text" class="text-sm py-1 px-2"
                                        style="border-bottom: 1px solid #000"></span>
                                <button id="updateUserName"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
                            </p>
                            <p><span>レベル: </span><span id="level"></span></p>
                            <p class="flex justify-between items-center">
                                <span>メールアドレス: <input id="email" type="text" class="text-sm py-1 px-2"
                                        style="border-bottom: 1px solid #000"></span>
                                <button id="updateEmail"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    @if (Session::has('username'))
                        ユーザー:
                        &nbsp;&nbsp;
                        <a href="#" style="color: red" id="userLink" data-userName="{{ session('username') }}"
                            data-id="{{ session('user_id') }}">{{ session('username') }}</a>
                    @endif
                </div>
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
                <li class="nav-item"><a href="{{ route('news') }}"><span>読む</span></a></li>
                <li class="nav-item"><a href="{{ route('listen') }}"><span>聴く</span></a></li>
                <li class="nav-item"><a href="{{ route('write-kanji') }}"><span>書く</span></a></li>
            </ul>
        </nav>
    </div>

    <div class="balloon2">
        <p>今日のおすすめ</p>
    </div>
    <div class="today_new">
        <ul class="today_list" style="margin: 10px;">
            @if (isset($recommendWord))
                @foreach ($recommendWord as $word)
                    <li class="centered-item">{{ $word->tango }}</li>
                    <li class="item-word" style="color: black;">{{ $word->hiragana }}</li>
                    {{-- <li class="item-word" style="color: black;">{{ $word->mean }}</li> --}}
                    <hr>
                @endforeach
            @endif
        </ul>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ $loginUserName }}</div>
    @endif
    <form action="{{ route('post-jisho-search') }}" method="POST">
        <div class="search">
            <div class="search-box">
                <input type="text" name="value"
                    value="{{ $tangoValue = isset($tangoValue) ? $tangoValue : '' }}" placeholder="検索キーワード">
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
        <iframe id="" width="350px" height="350px" src="https://comp.ecc.ac.jp/" title="ECCコンピュータ専門学校"
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
        //Update User ID
        var userID = document.getElementById('userLink').getAttribute('data-id');
        document.getElementById('updateUserID').addEventListener('click', function() {
            var NewUserName = document.getElementById('userName').value;
            updateUserData('user', userID, NewUserName);
        });

        //Update User Name
        document.getElementById('updateUserName').addEventListener('click', function() {
            var userFullName = document.getElementById('userFullName').value;
            updateUserData('fullnameUser', userID, userFullName);
        });

        //Update Email
        document.getElementById('updateEmail').addEventListener('click', function() {
            var email = document.getElementById('email').value;
            updateUserData('email', userID, email);
        });

        function updateUserData(field, userID, NewValue) {
            if (NewValue.trim() === "") {
                switch (field) {
                    case 'user':
                        alert('ユーザーIDを入力してください!!!!');
                        break;
                    case 'fullnameUser':
                        alert('氏名を入力してください!!!!');
                        break;
                    case 'email':
                        alert('メールアドレスを入力してください!!!!');
                        break;
                }
                return;
            }
            var data = {
                field: field,
                userID: userID,
                NewValue: NewValue
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/updateUsers", true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content')); // Cập nhật CSRF token
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Cập nhật thành công');
                    // Thêm code xử lý response tại đây
                }
            };
            xhr.send(JSON.stringify(data));
        }


        // Lắng nghe sự kiện click trên nút "COMMENT"
        var commentButton = document.getElementById("comment-button");
        var commentText = document.getElementById("comment-text");
        var commentContainer = document.getElementById("commentContainer");
        // Chuyển đổi biến PHP sang JSON và gán nó vào biến JavaScript
        var loginStatus = JSON.parse('<?php echo json_encode($loginStatus); ?>');

        commentButton.addEventListener("click", function() {
            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            // console.log('loginStatus: ', loginStatus);
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


        // lấy API thông tin người dùng
        document.getElementById('userLink').addEventListener('click', function(e) {
            e.preventDefault();

            // Khi người dùng nhấn vào nút, mở modal
            document.getElementById("myModal").style.display = "block";

            var userName = this.getAttribute('data-userName');

            fetch('/user-information', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        userName: userName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Điền thông tin vào modal
                    console.log(data);
                    document.getElementById('userName').value = data.user;
                    document.getElementById('userFullName').value = data.fullnameUser;
                    if (data.level != null) {
                        document.getElementById('level').innerText = data.level;
                    } else {
                        document.getElementById('level').innerText = "bạn chưa có level";
                    }
                    document.getElementById('email').value = data.email;
                    // Hiển thị modal
                    document.getElementById('userModal').style.display = 'block';
                });
        });


        // Khi người dùng nhấn vào <span> (x), đóng modal
        document.getElementsByClassName("close")[0].onclick = function() {
            document.getElementById("myModal").style.display = "none";
        }

        // Khi người dùng nhấn ra ngoài modal, đóng nó
        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                document.getElementById("myModal").style.display = "none";
            }
        }
    </script>

</body>

</html>
