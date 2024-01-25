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


@extends('clients.client')
@section('title')
    <title>3tpan</title>
@endsection
@section('css')
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

        .notification {
            width: 30%;
            margin: 0 auto;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            background-color: #4CAF50;
            position: fixed;
            /* Đặt vị trí cố định */
            top: 10px;
            /* Khoảng cách từ đỉnh */
            left: 50%;
            /* Đẩy sang trái 50% độ rộng của viewport */
            transform: translateX(-50%);
            /* Đẩy lại sang trái 50% độ rộng của chính nó */
            text-align: center;
            z-index: 1000;
            /* Đảm bảo nó nằm trên các thành phần khác */
        }

        .progress-bar {
            height: 5px;
            background-color: #fff;
            width: 0%;
            transition: width 1s linear;
        }
    </style>
@endsection

@section('content')

    @if (session('paymentMessage'))
        <div class="notification success">
            {{ session('paymentMessage') }}
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif

    <div class="balloon2">
        <p title="きょうのおすすめ">今日のお勧め</p>
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
                <input type="text" name="value" value="{{ $tangoValue = isset($tangoValue) ? $tangoValue : '' }}"
                    placeholder="検索キーワード">
            </div>
            <div class="bt_search">
                {{-- <button id="recordButton" class="bt_s" title="ボイスで検索"><span>🎤Ghi âm</span></button> --}}
                {{-- <button type="submit" class="bt_s" title="検索履歴"><span>⌚</span></button> --}}
                <button type="submit" class="bt_s" title="けんさく"><span>🔍</span></button>
            </div>
        </div>
        @csrf
    </form>
    <h3 title="けんさくけっか" class="h3">検索結果</h3>

    <div class="search_result" style="max-height: 200px; overflow-y: auto;">
        {{-- <div id="result">1: </div> --}}
        <p style="margin: 5px">
            @if (isset($result[0]))
                <span title="たんご" style="font-weight: bold">単語：</span>
                @foreach ($result[0]['japanese'] as $m)
                    @if (isset($m['word']) && !is_null($m['word']))
                        <a style="color: #9966CC; border-bottom: 1px solid;" onclick="showPopup()">{{ $m['word'] }}</a>
                        &nbsp;
                    @endif
                @endforeach
            @endif
        </p>
        <p style="margin: 5px">
            @if (isset($result[0]))
                <span title="よみかた" style="font-weight: bold">読み方：</span>
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
                <span title="いみ" style="font-weight: bold">意味：</span>
                {{ $imiString }}
            @endif
        </p>
        <p>
            @if (isset($result[0]))
                <span title="れい" style="margin: 5px;font-weight: bold">例：</span>

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
    <h3 title="こめんとらん" class="h3">コメント欄</h3>
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
@endsection

@section('js')
    <script>
        window.onload = function() {
            @if (isset($message))
                var message = confirm("{{ $message }}");
                console.log(message);

                if (message) {
                    window.location.href = 'http://127.0.0.1:8000/login';
                } else {
                    window.location.href = 'http://127.0.0.1:8000/home';
                }
            @endif
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let totalTime = 5;
            let intervalTime = 100; // 100ms cho mỗi cập nhật
            let elapsed = 0;

            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                const interval = setInterval(() => {
                    elapsed += intervalTime;
                    let progress = (elapsed / (totalTime * 1000)) * 100;
                    progressBar.style.width = progress + '%';

                    if (elapsed >= totalTime * 1000) {
                        clearInterval(interval);
                        setTimeout(() => {
                            document.querySelector('.notification').style.display = 'none';
                        }, 500); // Thêm một chút thời gian trước khi ẩn thông báo
                    }
                }, intervalTime);
            }
        });
    </script>
    <script>
        // Lắng nghe sự kiện click trên nút "COMMENT"
        var commentButton = document.getElementById("comment-button");
        var commentText = document.getElementById("comment-text");
        var commentContainer = document.getElementById("commentContainer");
        // Chuyển đổi biến PHP sang JSON và gán nó vào biến JavaScript
        var loginStatus = JSON.parse('<?php echo json_encode($loginStatus); ?>');

        if (commentButton) {
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
        }

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
@endsection
