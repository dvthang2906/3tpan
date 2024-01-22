@extends('clients.client')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
@endsection

@section('title')
    <title>TEST PAGE</title>
@endsection

@section('content')
    {{-- GỌI LIVEWIRE ĐỂ LẤY DỮ LIỆU Ở DƯỚI --}}
    @livewire('test-livewire')

    {{-- cần thiết để có thể chạy được  --}}
    @livewireScripts
@endsection

@section('js')
    <script>
        let hoverHistory = [];

        document.querySelectorAll('.nav_t a').forEach(link => {
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

        document.querySelectorAll('.nav_t a').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                if (this.innerText.includes('コード番号') && hoverHistory.length === 3) {
                    updateURLQuery();
                }
            });
        });

        function updateURLQuery() {
            console.log(hoverHistory);
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
            document.getElementById('resultModal').style.display = 'block';
        }

        // Khi người dùng nhấn vào nút (x) để đóng
        var span = document.getElementsByClassName('close-result')[0];
        span.onclick = function() {
            document.getElementById('resultModal').style.display = 'none';
        }

        // Khi người dùng nhấn ngoài modal, đóng nó lại
        window.onclick = function(event) {
            var modal = document.getElementById('resultModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
