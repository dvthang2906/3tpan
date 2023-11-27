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
                <li class="nav-item"><a href="#"><span>話す</span></a></li>
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
            if (['N1', 'N2', 'N3', 'N4', 'N5'].includes(levelText)) {
                hoverHistory = []; // Xóa mảng cũ
            }

            // Xác định nhóm các giá trị có thể thay thế lẫn nhau
            const replaceableGroups = [
                ['Kanji', 'Vocabulary', 'Grammar'],
                ['Vocabulary', 'Grammar'],
                ['コード番号01', 'コード番号02', 'コード番号03'] // Điều chỉnh tùy theo số lượng "Đề" bạn có
            ];

            // Tìm nhóm có chứa giá trị hiện tại
            let groupIndex = replaceableGroups.findIndex(group => group.includes(levelText));

            // Thay thế hoặc thêm giá trị mới
            if (groupIndex !== -1) {
                const replaceableGroup = replaceableGroups[groupIndex];
                let foundIndex = hoverHistory.findIndex(item => replaceableGroup.includes(item));

                // Xóa tất cả các "Đề" trước khi thêm mới nếu là "コード番号"
                if (replaceableGroup.some(item => item.startsWith('コード番号'))) {
                    hoverHistory = hoverHistory.filter(item => !replaceableGroup.includes(item));
                }


                // Thay thế hoặc thêm mới
                if (foundIndex !== -1) {
                    hoverHistory[foundIndex] = levelText; // Thay thế giá trị cũ
                } else {
                    hoverHistory.push(levelText); // Thêm mới nếu không tìm thấy
                }
            } else {
                hoverHistory.push(levelText); // Thêm các giá trị khác nếu không thuộc nhóm thay thế
            }
        });
    });


    // Xử lý sự kiện click
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            if (this.innerText.includes('コード番号')) {
                console.log(hoverHistory);
                // Kiểm tra để đảm bảo hoverHistory có đủ phần tử
                if (hoverHistory.length === 3) {
                    let level = 'level=' + encodeURIComponent(hoverHistory[0]);
                    let category = 'category=' + encodeURIComponent(hoverHistory[1]);
                    let code = 'code=' + encodeURIComponent(hoverHistory[2]);

                    // Tạo chuỗi truy vấn
                    let queryString = level + '&' + category + '&' + code;

                    // Cập nhật URL
                    window.history.pushState({}, '', '?' + queryString);
                }
            }
        });
    });


    // thực hiện khi bấm nút check bài test
    // Ví dụ: Gọi khi nút bấm được nhấn
    document.getElementById("CheckButton").addEventListener("click", function() {
        var selectedValues = getSelectedKanjiValues();
        console.log(selectedValues); // Hiển thị giá trị đã chọn trong console

        //gửi dữ liệu đến controller
        sendDataToServer(selectedValues);
    });

    // lấy tất cả đáp án đã chọn
    function getSelectedKanjiValues() {
        var selectedValues = {};
        var checkboxes = document.querySelectorAll('.kanji-box .answer input[type="radio"]:checked');

        checkboxes.forEach(function(checkbox) {
            var [key, value] = checkbox.value.split(':');
            selectedValues[key] = value;
        });

        return selectedValues;
    }


    let user_result = document.getElementById('user_result');

    function sendDataToServer(dataToSend) {
        fetch('/home/test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content') // CSRF token cho Laravel
                },
                body: JSON.stringify(dataToSend)
            })
            .then(response => response.json())
            .then(data => {
                // console.log('Success:', data);
                console.log('Giá trị của falsemondai:', data.countFalse); // Truy cập giá trị của $result
                let message = data.message;
                // làm tiếp status ở đây
                if (data.status == true) {
                    alert('SAI : ' + data.countFalse)
                    let falseMondaiName = document.getElementById(data.falseMondai);
                    falseMondaiName.style.color = 'red';

                    // Lưu trạng thái style
                    localStorage.setItem('falseMondaiColor', 'red');

                    // // Khi tải lại trang, kiểm tra và áp dụng style nếu cần
                    // if (localStorage.getItem('falseMondaiColor')) {
                    //     falseMondaiName.style.color = localStorage.getItem('falseMondaiColor');
                    // }
                }

                if (message == '') {
                    user_result.innerText = data.result;
                } else {
                    user_result.innerText = data.result;
                    alert(message.message);
                }

            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
{{-- cần thiết để có thể chạy được  --}}
@livewireScripts

</html>
