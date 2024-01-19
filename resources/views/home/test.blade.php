
@extends('clients.client')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
@endsection

@section('title')
    TEST PAGE
@endsection

@section('content')
    {{-- GỌI LIVEWIRE ĐỂ LẤY DỮ LIỆU Ở DƯỚI --}}
    @livewire('test-livewire')
    <!-- Thêm các phần khác như Vocabulary, Đọc Hiểu, Viết ở đây -->
    {{-- <input type="checkbox" id="actionMenuButton" class="muti-ck" />
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
    </div> --}}
        {{-- cần thiết để có thể chạy được  --}}
        @livewireScripts
@endsection




@section('js')

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
@endsection
