<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Write-Kanji</title>
    <style>
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
    </style>
</head>

<body>
    <h1>Write-Kanji</h1>
    <div class="modal-overlay"></div>
    <!-- Khung chứa SVG -->
    <div id="myModal" class="modal">
        <div class="modal-flex-container">
            <span class="close">&times;</span>
            <div class="modal-content" id="svg-container">

            </div>
            <div class="modal-sidebar">
                <p id="kanji-title">
                    <span id="kanji-label">Kanji:</span>
                    <span id="kanji-value">kanji</span>
                </p>
                <p id="mean">
                    <span>意味：</span>
                    <span id="mean-value"></span>
                </p>
                <p id="kunyomi">
                    <span>Kunyomi:</span>
                    <span id="kunyomi-value"></span>
                </p>
                <p id="onyomi">
                    <span>Onyomi:</span>
                    <span id="onyomi-value"></span>
                </p>
            </div>
        </div>
    </div>


    @foreach ($dataKanji as $data)
        <a href="#" data-value="{{ $data->kanji_svg }}">{{ $data->kanji }}</a>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các thẻ <a> và gắn sự kiện click cho mỗi thẻ
            document.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    openModal();

                    var text = link.getAttribute('data-value');

                    // LẤY DỮ LIỆU TỪ API
                    fetch('http://127.0.0.1:8002/svg-file/' + text)
                        .then(response => response.json())
                        .then(responseData => {


                            // Xử lý dữ liệu từ database
                            const databaseData = responseData.data;

                            let kanjiValue = document.getElementById('kanji-value');
                            let kunyomi = document.getElementById('kunyomi-value');
                            let onyomi = document.getElementById('onyomi-value');
                            let mean = document.getElementById('mean-value');

                            kanjiValue.innerHTML = databaseData[0].kanji;
                            kunyomi.innerHTML = databaseData[0].kunyomi;
                            onyomi.innerHTML = databaseData[0].onyomi;
                            mean.innerHTML = databaseData[0].mean;


                            const svgContainer = document.getElementById('svg-container');
                            if (svgContainer) {
                                // Giải mã nội dung SVG từ Base64
                                let svgContent = atob(responseData.svg);

                                // Loại bỏ các comments XML và DTD không mong muốn từ chuỗi SVG
                                svgContent = svgContent.replace(/<!--.*?-->\s*/g, '');

                                svgContainer.innerHTML = svgContent;

                                // Cập nhật SVG nếu cần
                                const svgElement = svgContainer.querySelector('svg');
                                if (svgElement) {
                                    // Thay đổi kích thước của SVG
                                    svgElement.setAttribute('width', '217px');
                                    svgElement.setAttribute('height', '217px');

                                    updateSVG(svgElement);
                                }
                            }

                            // Hiển thị modal
                            const modal = document.getElementById('myModal');
                            modal.style.display = 'block';

                            // Đóng modal khi click vào nút đóng
                            const closeButton = document.querySelector('.close');
                            closeButton.addEventListener('click', function() {
                                closeModal();
                                modal.style.display = 'none';
                            });
                        })
                        .catch(error => console.error('Lỗi khi tải SVG:', error));
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
                    const order = parseInt(pathId.match(/\d+$/)[0], 10); // Lấy số cuối cùng trong ID
                    const delay = (order - 1) * 2; // Giả sử mỗi nét cần 2 giây để hoàn tất
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
