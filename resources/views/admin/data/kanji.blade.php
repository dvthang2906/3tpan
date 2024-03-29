<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin-Kanji</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/adminKanji.css') }}">
    <style>
        /* CSS from Buttom*/
        .button {
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #04AA6D;
        }

        .button1:hover {
            background-color: #04AA6D;
            color: white;
        }


        .modal-content,
        .modal-sidebar {
            margin: 0;
            padding: 0;
            border: none;
            background: transparent;
            box-shadow: none;
            /* Các thuộc tính khác */
        }

        .modal-overlay {
            display: none;
            /* Ẩn lớp phủ mặc định */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Màu đen với độ trong suốt */
            z-index: 1;
            /* Đảm bảo lớp phủ nằm dưới modal */
        }

        /* Style cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2;
            left: 50%;
            /* Đặt modal vào giữa màn hình theo chiều ngang */
            top: 50%;
            /* Đặt modal vào giữa màn hình theo chiều dọc */
            transform: translate(-50%, -50%);
            /* Dùng transform để căn giữa chính xác */
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Style cho container sử dụng Flexbox */
        .modal-flex-container {
            display: flex;
            justify-content: center;
            align-items: stretch;
            height: 100%;
        }

        /* Style cho nội dung modal */
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            max-width: 600px;
            flex: 1;
            /* Cho phép linh hoạt với kích thước */
        }

        /* Style cho div thứ hai */
        .modal-sidebar {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            max-width: 300px;
            flex: 0 0 auto;
            /* Giữ kích thước cố định */
        }

        /* Style cho nút đóng */
        .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            cursor: pointer;
        }

        .close:hover {
            background-color: #ddd;
        }

        iframe path {
            stroke-dasharray: 1000;
            /* A large enough value */
            stroke-dashoffset: 1000;
            /* Same as stroke-dasharray initially */
            animation: drawStroke 2s forwards;
            /* Adjust time as needed */
        }

        @keyframes drawStroke {
            to {
                stroke-dashoffset: 0;
                /* Reduces to 0 during the animation */
            }
        }

        /* Set different animation delays for each path */
        iframe #kvg\:0f9a8-s1 {
            animation-delay: 0s;
        }

        iframe #kvg\:0f9a8-s2 {
            animation-delay: 2s;
        }

        iframe #kvg\:0f9a8-s3 {
            animation-delay: 4s;
        }

        iframe #kvg\:0f9a8-s4 {
            animation-delay: 6s;
        }

        iframe #kvg\:0f9a8-s5 {
            animation-delay: 8s;
        }

        iframe svg {
            width: 327px;
            /* Ví dụ, gấp đôi kích thước ban đầu */
            height: 327px;
        }

        /* Định dạng cho container của các ký tự Kanji */
        .kanji {
            display: flex;
            justify-content: center;
            align-items: center;
            align-items: center;
            margin-top: 30px;
            font-family: Arial, Helvetica, sans-serif;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 2em;
        }

        /* Định dạng cho mỗi ký tự Kanji */
        .kanji span {
            background-color: wheat;
            /* color: #fff; */
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }


        /* Hover effect khi di chuột vào ký tự Kanji */
        .kanji span:hover {
            background-color: #4D9BC1;
        }

        /* Định dạng cho nội dung trong mỗi ký tự Kanji */
        .kanji span a {
            text-decoration: none;
        }

        /* Định dạng cho container của biểu mẫu tìm kiếm Kanji */
        #kanji-search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        /* Định dạng cho ô nhập liệu tìm kiếm */
        .search-kanji {
            /* width: ; */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        #btn-search-kanji {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #btn-search-kanji:hover {
            background-color: #2980b9;
            /* Màu nền khi di chuột vào nút */
        }
    </style>
</head>

<body>
    <h1 class="ad">
        <b>ROLE: </b><span style="color: red"><a
                href="{{ route('admin') }}">{{ Session::has('StatusRole') ? 'Admin' : '' }}</a></span>
    </h1>

    <header>
        <nav class="data" style="padding: 20px;">
            <a href="{{ route('kanji') }}">Kanji</a>
            <a href="{{ route('show-news') }}">News</a>
            <a href="{{ route('shows.test') }}">Test</a>
            <a href="{{ route('show.vocabulary') }}">Vocabulary</a>
        </nav>
    </header>
    <div class="modal-overlay"></div>
    <!-- Khung chứa SVG -->
    <div id="myModal" class="modal">
        <div class="modal-flex-container">
            <span class="close">&times;</span>
            <div class="modal-content" id="svg-container">
                <!-- VÙNG HIỂN THỊ CHỮ KANJI -->
            </div>
            <div class="modal-sidebar">
                <p id="kanji-title">
                    <span id="kanji-label">Kanji:</span>
                    <span id="kanji-value">kanji</span>
                    <input type="hidden" id="id-value" value="">
                </p>
                <p id="mean">
                    <span>意味：</span>
                    <input type="text" id="mean-value" value="">
                </p>
                <p id="kunyomi">
                    <span>Kunyomi:</span>
                    <input type="text" id="kunyomi-value">
                </p>
                <p id="onyomi">
                    <span>Onyomi:</span>
                    <input type="text" id="onyomi-value">
                </p>
                <div style="text-align: center;"><button type="submit" class="button button1"
                        id="kanjiUpdateData">更新</button></div>
            </div>

        </div>
    </div>

    <div class="kanji-search-container">
        <form action="{{ route('search-kanji') }}" method="GET" id="kanji-search-form">
            <input type="search" name="kanji" id="search-kanji" value="{{ $kanji ?? '' }}"
                placeholder="Search kanji...">
            <button type="submit">
                検索
            </button>
        </form>
    </div>



    @if (session('thongbao'))
        <div style="border: #888 1px solid; width: max-content; padding: 10px;">
            <span style="color: red;">{{ session('thongbao') }}</span>
        </div>
        <?php session()->forget('thongbao'); ?>
    @else
        <div class="kanji">
            @foreach ($dataKanji as $data)
                <span><a href="#" data-value="{{ $data->kanji_svg }}">{{ $data->kanji }}</a></span>
            @endforeach
        </div>
    @endif


    <script src="https://unpkg.com/wanakana"></script>
    <script>
        // tự động chuyển romaji sang hiragana
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kanji-search-form');
            const input = document.getElementById('search-kanji');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent immediate form submission

                const originalValue = input.value;
                let convertedValue = originalValue;

                // Check if the input contains Katakana
                const katakanaRegex = /[\u30A0-\u30FF]/;
                if (!katakanaRegex.test(originalValue)) {
                    // Convert to Hiragana only if there is no Katakana
                    convertedValue = wanakana.toHiragana(originalValue);
                }

                // Update the input value only if it doesn't contain both Romaji and Hiragana
                if (!containsBothRomajiAndHiragana(convertedValue)) {
                    input.value = convertedValue;
                }

                form.submit(); // Submit form
            });
        });


        function containsBothRomajiAndHiragana(str) {
            const romajiRegex = /[a-zA-Z]/;
            const hiraganaRegex = /[\u3040-\u309F]/;

            return romajiRegex.test(str) && hiraganaRegex.test(str);
        }


        //更新
        document.getElementById('kanjiUpdateData').addEventListener('click', function(e) {
            e.preventDefault();

            //trim() dùng để loại bỏ hết các khoảng trắng ở đầu và cuối của chuỗi kí tự nhập vào
            let kunyomiUpdate = document.getElementById('kunyomi-value').value.trim();
            let onyomiUpdate = document.getElementById('onyomi-value').value.trim();
            let meanUpdate = document.getElementById('mean-value').value.trim();
            let kanjiId = document.getElementById('id-value').value.trim();

            if (!kunyomiUpdate || !onyomiUpdate || !meanUpdate || !kanjiId) {
                // console.error('Error: All fields are required.');
                alert('エラー：すべてのフィールドを入力してください。');
                return;
            }

            let updateData = {
                kunyomi: kunyomiUpdate,
                onyomi: onyomiUpdate,
                mean: meanUpdate,
            };

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/admin/update-kanji', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        id: kanjiId,
                        data: updateData
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok (${response.status})`);
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Success:', data);
                    // Xử lý thành công tại đây
                    alert('漢字が正常に更新されました。');
                })
                .catch((error) => {
                    console.error('Error during fetch operation:', error.message);
                    // Xử lý lỗi tại đây
                });
        });


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.kanji a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    openModal();

                    var text = link.getAttribute('data-value');

                    // Hiển thị thông báo loading
                    const svgContainer = document.getElementById(
                        'svg-container');
                    svgContainer.innerHTML = '<p>Loading...</p>';

                    // LẤY DỮ LIỆU TỪ API
                    fetch('http://127.0.0.1:8002/svg-file/' + text)
                        .then(response => response.json())
                        .then(responseData => {
                            // Xóa thông báo loading
                            svgContainer.innerHTML = '';

                            // Xử lý dữ liệu từ database
                            const databaseData = responseData.data;

                            let kanjiValue = document.getElementById(
                                'kanji-value');
                            let kunyomi = document.getElementById(
                                'kunyomi-value');
                            let onyomi = document.getElementById(
                                'onyomi-value');
                            let mean = document.getElementById(
                                'mean-value');
                            let id = document.getElementById('id-value');

                            kanjiValue.innerHTML = databaseData[0].kanji;
                            kunyomi.value = databaseData[0].kunyomi;
                            onyomi.value = databaseData[0].onyomi;
                            mean.value = databaseData[0].mean;
                            id.value = databaseData[0].id;

                            // Giải mã nội dung SVG từ Base64 và hiển thị
                            let svgContent = atob(responseData.svg);
                            svgContent = svgContent.replace(
                                /<!--.*?-->\s*/g, '');
                            svgContainer.innerHTML = svgContent;

                            // Cập nhật SVG nếu cần
                            const svgElement = svgContainer.querySelector(
                                'svg');
                            if (svgElement) {
                                svgElement.setAttribute('width', '217px');
                                svgElement.setAttribute('height', '217px');
                                updateSVG(svgElement);
                            }

                            // Hiển thị modal
                            const modal = document.getElementById(
                                'myModal');
                            modal.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Lỗi khi tải SVG:', error);
                            svgContainer.innerHTML =
                                '<p>Lỗi khi tải dữ liệu.</p>';
                        });

                    // Đóng modal khi click vào nút đóng
                    const closeButton = document.querySelector('.close');
                    closeButton.addEventListener('click', function() {
                        closeModal();
                        const modal = document.getElementById(
                            'myModal');
                        modal.style.display = 'none';
                    });
                });
            });

            function updateSVG(svgElement) {
                // Kiểm tra xem svgElement có tồn tại không
                if (!svgElement) {
                    console.error('SVG element is not found.');
                    return;
                }

                const paths = svgElement.querySelectorAll('path');
                paths.forEach(function(path) {
                    const length = path.getTotalLength();
                    path.style.strokeDasharray = length;
                    path.style.strokeDashoffset = length;

                    // Xác định animation delay dựa vào ID của path
                    const pathId = path.id;
                    const order = parseInt(pathId.match(/\d+$/)[0],
                        10); // Lấy số cuối cùng trong ID
                    const delay = (order - 1) *
                        2; // Giả sử mỗi nét cần 2 giây để hoàn tất
                    path.style.animation = `drawStroke 2s ${delay}s forwards`;
                });
            }
        });

        function openModal() {
            document.querySelector('.modal-overlay').style.display = 'block';
            document.querySelector('.modal').style.display = 'block';
        }

        function closeModal() {
            document.querySelector('.modal-overlay').style.display = 'none';
            document.querySelector('.modal').style.display = 'none';
        }
    </script>

</body>

</html>
