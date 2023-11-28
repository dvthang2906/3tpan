<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST-BA-LINH-TINH</title>
    <style>
        /* Style cơ bản cho bảng thông báo */
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
        .modal-content p {
            font-size: 18px;
            /* Kích thước chữ */
            color: #555555;
            /* Màu xám nhạt */
            line-height: 1.6;
            /* Khoảng cách dòng */
            text-align: justify;
            /* Căn đều hai bên */
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
    <button onclick="showScore(10);">Hiển Thị Điểm</button>

    <!-- Bảng thông báo Modal -->
    <div id="myModal" class="modal">
        <!-- Nội dung bảng thông báo -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Kết Quả Bài Test</h2>
            <p>Điểm của bạn: <span id="score">...</span></p>
        </div>
    </div>

    <script>
        // Khi người dùng nhấn vào nút 'Kết thúc bài test' hoặc tương tự
        function showScore(finalScore) {
            document.getElementById('score').innerText = finalScore;
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
</body>

</html>
