<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin-Kanji</title>
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
    </style>
</head>

<body>
    <h1>Kanji</h1>
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
                <div style="text-align: center;"><button type="submit" class="button button1">更新</button></div>
            </div>

        </div>
    </div>


    @foreach ($dataKanji as $data)
        <a href="#" data-value="{{ $data->kanji_svg }}">{{ $data->kanji }}</a>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    openModal();

                    var text = link.getAttribute('data-value');

                    // Hiển thị thông báo loading
                    const svgContainer = document.getElementById('svg-container');
                    svgContainer.innerHTML = '<p>Loading...</p>';

                    // LẤY DỮ LIỆU TỪ API
                    fetch('http://127.0.0.1:8002/svg-file/' + text)
                        .then(response => response.json())
                        .then(responseData => {
                            // Xóa thông báo loading
                            svgContainer.innerHTML = '';

                            // Xử lý dữ liệu từ database
                            const databaseData = responseData.data;

                            let kanjiValue = document.getElementById('kanji-value');
                            let kunyomi = document.getElementById('kunyomi-value');
                            let onyomi = document.getElementById('onyomi-value');
                            let mean = document.getElementById('mean-value');

                            kanjiValue.innerHTML = databaseData[0].kanji;
                            kunyomi.value = databaseData[0].kunyomi;
                            onyomi.value = databaseData[0].onyomi;
                            mean.value = databaseData[0].mean;

                            // Giải mã nội dung SVG từ Base64 và hiển thị
                            let svgContent = atob(responseData.svg);
                            svgContent = svgContent.replace(/<!--.*?-->\s*/g, '');
                            svgContainer.innerHTML = svgContent;

                            // Cập nhật SVG nếu cần
                            const svgElement = svgContainer.querySelector('svg');
                            if (svgElement) {
                                svgElement.setAttribute('width', '217px');
                                svgElement.setAttribute('height', '217px');
                                updateSVG(svgElement);
                            }

                            // Hiển thị modal
                            const modal = document.getElementById('myModal');
                            modal.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Lỗi khi tải SVG:', error);
                            svgContainer.innerHTML = '<p>Lỗi khi tải dữ liệu.</p>';
                        });

                    // Đóng modal khi click vào nút đóng
                    const closeButton = document.querySelector('.close');
                    closeButton.addEventListener('click', function() {
                        closeModal();
                        const modal = document.getElementById('myModal');
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
