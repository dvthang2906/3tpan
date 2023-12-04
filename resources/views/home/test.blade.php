<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Page</title>
    <style>
        .scrollable {
            max-height: 350px;
            /* Hoặc giá trị phù hợp với nhu cầu của bạn */
            overflow-y: auto;
            /* Cho phép thanh cuộn dọc nếu nội dung vượt quá max-height */
        }


        /* CSS của bảng thông báo điểm */
        .modal {
            display: none;
            /* Bắt đầu ẩn và sẽ hiển thị thông qua JavaScript */
            position: fixed;
            /* Định vị cố định trên toàn bộ màn hình */
            z-index: 1000;
            /* Đảm bảo nó nằm trên các phần tử khác */
            left: 0;
            top: 0;
            width: 100%;
            /* Chiếm toàn bộ chiều rộng */
            height: 100%;
            /* Chiếm toàn bộ chiều cao */
            overflow: auto;
            /* Cho phép cuộn nếu nội dung quá dài */
            background-color: rgba(0, 0, 0, 0.8);
            /* Nền mờ đen với độ trong suốt */
            backdrop-filter: blur(5px);
            /* Tạo hiệu ứng mờ cho nền phía sau modal */
        }

        /* Style chi tiết cho nội dung bảng thông báo */
        .modal-content {
            background-color: #ffffff;
            /* Nền trắng cho nội dung */
            margin: 5% auto;
            /* Căn giữa trên trang với lề trên 5% */
            padding: 40px;
            /* Đệm quanh nội dung */
            border-radius: 15px;
            /* Bo tròn góc */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            /* Bóng đổ cho hiệu ứng 3D */
            width: 50%;
            /* Chiếm 50% chiều rộng của màn hình */
            transition: all 0.3s ease-in-out;
            /* Hiệu ứng chuyển đổi mượt mà */
        }

        /* Hiệu ứng hover tăng kích thước nội dung */
        .modal-content:hover {
            transform: scale(1.03);
            /* Phóng to nhẹ */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            /* Bóng đổ lớn hơn */
        }

        /* Nút đóng (x) với chi tiết cẩn thận */
        .close {
            color: #ff5f5f;
            /* Màu đỏ nhạt */
            float: right;
            /* Đặt ở góc phải trên cùng */
            font-size: 40px;
            /* Kích thước lớn */
            font-weight: bold;
            transition: all 0.2s;
            /* Chuyển đổi mượt mà */
        }

        /* Hiệu ứng nút đóng: xoay và thay đổi màu */
        .close:hover,
        .close:focus {
            color: #ff0000;
            /* Màu đỏ đậm */
            text-decoration: none;
            cursor: pointer;
            transform: rotate(90deg);
            /* Xoay 90 độ */
        }

        /* Style cho tiêu đề modal */
        .modal-content h2 {
            margin: 0;
            /* Không có lề trên */
            color: #333333;
            /* Màu đen nhạt */
            font-family: 'Helvetica', sans-serif;
            /* Font chữ */
            font-size: 24px;
            /* Kích thước chữ */
            text-align: center;
            /* Căn giữa tiêu đề */
            margin-bottom: 20px;
            /* Lề dưới cho tiêu đề */
            text-shadow: 1px 1px 2px #4CAF50;
            /* Bóng đổ cho tiêu đề */
        }

        /* Style cho nội dung chính */
        .modal-content div {
            font-size: 18px;
            /* Kích thước chữ */
            color: #555555;
            /* Màu xám nhạt */
            line-height: 1.6;
            /* Khoảng cách dòng */
            text-align: center;
            margin-top: 50px;
        }

        /* Điều chỉnh cho màn hình nhỏ (responsive design) */
        @media screen and (max-width: 768px) {
            .modal-content {
                width: 90%;
                /* Chiếm 90% chiều rộng màn hình */
                padding: 20px;
                /* Đệm xung quanh nội dung */
                margin: 10px;
                /* Không có lề */
                position: fixed;
                /* Định vị cố định */
                top: 50%;
                /* Đặt ở giữa theo chiều dọc */
                left: 50%;
                /* Đặt ở giữa theo chiều ngang */
                transform: translate(-50%, -50%);
                /* Dịch chuyển lên và qua trái để căn giữa chính xác */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
                /* Bóng đổ nhẹ hơn */
            }

            .close {
                font-size: 30px;
                /* Kích thước nút đóng nhỏ hơn cho màn hình nhỏ */
            }
        }
    </style>
</head>

<body>
    @include('layouts.head')

    <div class="nav_head">
        <div class="nomal">
            <a href="#" class="bt_nav" title="辞書"><span>辞書</span></a>
            <a href="{{ route('flashcards') }}" class="bt_nav" title="フラッシュカード"><span>フラッシュカード</span></a>
            <a href="{{ route('test') }}" class="bt_nav" title="テストしてみよう！"><span>テスト</span></a>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="{{ route('voice') }}"><span>話す</span></a></li>
                <li class="nav-item"><a href="#"><span>読む</span></a></li>
                <li class="nav-item"><a href="#"><span>聴く</span></a></li>
                <li class="nav-item"><a href="#"><span>書く</span></a></li>
            </ul>
        </nav>
    </div>
    {{-- GỌI LIVEWIRE ĐỂ LẤY DỮ LIỆU Ở DƯỚI --}}
    @livewire('test-livewire')


    <!-- Thêm các phần khác như Vocabulary, Đọc Hiểu, Viết ở đây -->
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


<script>
    let hoverHistory = [];

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('mouseover', function(event) {
            const levelText = this.innerText;
            updateHoverHistory(levelText);
        });
    });

    function updateHoverHistory(levelText) {
        if (['N1', 'N2', 'N3', 'N4', 'N5'].includes(levelText)) {
            hoverHistory = [];
        }

        const replaceableGroups = [
            ['Kanji', 'Vocabulary', 'Grammar'],
            ['Vocabulary', 'Grammar'],
            ['コード番号01', 'コード番号02', 'コード番号03']
        ];

        let groupIndex = replaceableGroups.findIndex(group => group.includes(levelText));
        if (groupIndex !== -1) {
            const replaceableGroup = replaceableGroups[groupIndex];
            hoverHistory = hoverHistory.filter(item => !replaceableGroup.includes(item));
            hoverHistory.push(levelText);
        } else {
            hoverHistory.push(levelText);
        }
    }

    document.querySelectorAll('li a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            if (this.innerText.includes('コード番号') && hoverHistory.length === 3) {
                updateURLQuery();
            }
        });
    });

    function updateURLQuery() {
        let [level, category, code] = hoverHistory;
        let queryString =
            `level=${encodeURIComponent(level)}&category=${encodeURIComponent(category)}&code=${encodeURIComponent(code)}`;
        window.history.pushState({}, '', '?' + queryString);
        //send level to server
        sendLeveltoServer(level);
    }

    document.getElementById("CheckButton").addEventListener("click", function() {
        sendDataToServer(getSelectedKanjiValues());
    });

    function getSelectedKanjiValues() {
        return Array.from(document.querySelectorAll('.kanji-box .answer input[type="radio"]:checked'))
            .reduce((selectedValues, checkbox) => {
                let [key, value] = checkbox.value.split(':');
                selectedValues[key] = value;
                return selectedValues;
            }, {});
    }

    // fetch level sang controller
    function sendLeveltoServer(level) {
        fetch('/home/postLevel', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    level: level
                })
            }).then(response => response.json())
            .then(data => console.log(data['level']))
            .catch(error => console.error('Error:', error));
    }

    function sendDataToServer(dataToSend) {
        fetch('/home/test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(dataToSend)
            })
            .then(response => response.json())
            .then(data => handleServerResponse(data))
            .catch(error => console.error('Error:', error));
    }

    function handleServerResponse(data) {
        console.log('Phản hồi từ server:', data); // In toàn bộ đối tượng data để kiểm tra

        // Kiểm tra và hiển thị thông báo nếu có câu trả lời sai
        if (data.status === true) {
            // alert('SAI : ' + data.countFalse);
            if (data.result !== undefined) {
                // user_result.innerText = data.result;

                var mess = '不正解: ' + data.countFalse + '問' + '/' + data.totalCount +
                    '問<br>合計： ' + data.result + '点';
                showScore(mess);
            }
        }

        // Kiểm tra và thay đổi màu sắc của các câu trả lời sai
        if (Array.isArray(data.incorrectAnswerIds) && data.incorrectAnswerIds.length > 0) {
            data.incorrectAnswerIds.forEach(answerId => {
                let incorrectAnswerElement = document.getElementById(answerId);
                if (incorrectAnswerElement) {
                    incorrectAnswerElement.style.color = 'red';
                } else {
                    console.error('Không tìm thấy phần tử với ID:', answerId);
                }
            });
        } else {
            console.log('Không có ID câu trả lời sai hoặc danh sách rỗng.');
        }

        // Hiển thị kết quả
        if (data.result !== undefined && data.status === false) {
            // user_result.innerText = data.result;

            var result = 'あなたの結果： ' + data.result + '点';
            console.log('2' + result);
            showScore(result);
        }

        // Hiển thị thông báo bổ sung, nếu có
        if (data.message) {
            // alert(data.message.message);
            let message = data.message.message;
            console.log('3' + message);
            showScore(message);
        }
    }


    // logic hiển thị bảng thông báo điểm và kết quả.
    function showScore(text) {
        document.getElementById('score').innerHTML = text;
        document.getElementById('myModal').style.display = 'block';
    }

    // Khi người dùng nhấn vào nút (x) để đóng
    var span = document.getElementsByClassName('close')[0];
    span.onclick = function() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Khi người dùng nhấn ngoài modal, đóng nó lại
    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

{{-- cần thiết để có thể chạy được  --}}
@livewireScripts

</html>
