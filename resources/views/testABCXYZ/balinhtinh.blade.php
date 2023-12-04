<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST-BA-LINH-TINH</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <style>
        #chatIcon {
            /* Các thuộc tính CSS khác */
        }

        #chatBox {
            /* Các thuộc tính CSS khác */
            width: 300px;
            /* hoặc kích thước bạn mong muốn */
            height: 400px;
            /* hoặc kích thước bạn mong muốn */
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <!-- Nút Icon -->
    <div id="chatIcon" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer;">
        <!-- Sử dụng icon từ Font Awesome hoặc thẻ <img> cho icon của bạn -->
        <i class="fa fa-comments" aria-hidden="true"></i> <!-- Ví dụ sử dụng Font Awesome -->
    </div>

    <!-- Khung Chat (ban đầu ẩn) -->
    <div id="chatBox" style="display: none; position: fixed; bottom: 60px; right: 20px;">
        <!-- Nội dung của khung chat -->
        <p>Khung chat của bạn ở đây</p>
        <!-- Thêm nội dung chat vào đây -->
    </div>


    <script>
        //CAll API GPT
        function sendMessageToServer(message) {
            fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Nếu bạn sử dụng Blade Templates
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Phản hồi từ AI:', data.message);
                    // Thêm logic để hiển thị phản hồi trong khung chat
                })
                .catch(error => console.error('Lỗi:', error));
        }


        // NUT CHAT
        document.getElementById('chatIcon').addEventListener('click', function() {
            var chatBox = document.getElementById('chatBox');
            if (chatBox.style.display === 'none') {
                chatBox.style.display = 'block';
            } else {
                chatBox.style.display = 'none';
            }
        });
    </script>

</body>

</html>
