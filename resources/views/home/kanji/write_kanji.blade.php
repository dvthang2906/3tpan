<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Write-Kanji</title>
    <style>
        /* Style cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Style cho nội dung modal */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
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
            width: 218px;
            /* Ví dụ, gấp đôi kích thước ban đầu */
            height: 218px;
        }
    </style>
</head>

<body>
    <h1>Write-Kanji</h1>
    <!-- Khung chứa SVG -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="svg-container"></div>
        </div>
    </div>

    <a href="#">0f9b0</a>
    <a href="#">0f9b1</a>
    <a href="#">0f9b2</a>
    <a href="#">0f9b4</a>
    <a href="#">0f92e</a>
    <a href="#">04e07</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các thẻ <a> và gắn sự kiện click cho mỗi thẻ
            document.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const text = this.textContent || this.innerText;
                    console.log(text);

                    // LẤY DỮ LIỆU TỪ API
                    fetch('http://127.0.0.1:8002/svg-file/' + text)
                        .then(response => response.text())
                        .then(data => {
                            // Loại bỏ các comments XML và DTD không mong muốn
                            data = data.replace(/<!--.*?-->\s*/g, '');

                            const svgContainer = document.getElementById('svg-container');
                            if (svgContainer) {
                                svgContainer.innerHTML = data;
                                updateSVG(svgContainer.querySelector('svg'));
                            }

                            // Hiển thị modal
                            const modal = document.getElementById('myModal');
                            modal.style.display = 'block';

                            // Đóng modal khi click vào nút đóng
                            const closeButton = document.querySelector('.close');
                            closeButton.addEventListener('click', function() {
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
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('a').addEventListener('click', function(e) {
                e.preventDefault();
                const text = this.textContent || this.innerText;
                console.log(text);

                // LẤY DỮ LIỆU TỪ API
                $(document).ready(function() {
                    fetch('http://127.0.0.1:8002/svg-file/' + text)
                        .then(response => response.text())
                        .then(data => {
                            // Loại bỏ các comments XML và DTD không mong muốn
                            data = data.replace(/<!--.*?-->\s*/g, '');

                            const svgContainer = document.getElementById('svg-container');
                            if (svgContainer) {
                                svgContainer.innerHTML = data;
                                updateSVG(svgContainer.querySelector('svg'));
                            }

                            // Hiển thị modal
                            const modal = document.getElementById('myModal');
                            modal.style.display = 'block';

                            // Đóng modal khi click vào nút đóng
                            const closeButton = document.querySelector('.close');
                            closeButton.addEventListener('click', function() {
                                modal.style.display = 'none';
                            });


                        })
                        .catch(error => console.error('Lỗi khi tải SVG:', error));
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
                        const delay = (order - 1) * 2; // Giả sử mỗi nét cần 2 giây để hoàn tất
                        path.style.animation = `drawStroke 2s ${delay}s forwards`;
                    });
                }
            });
        });
    </script> --}}

</body>

</html>
