<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">

    <style>
        #excel_upload_form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Định dạng cho các nhãn và ô nhập liệu */
        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Định dạng cho nút submit */
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Định dạng cho nút lấy sheets */
        #get_sheets {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Định dạng cho select có nhiều options */
        select[multiple] {
            height: auto;
        }

        .notification {
            width: 50%;
            /* Thu nhỏ và căn giữa */
            margin: 0 auto;
            /* Căn giữa */
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            background-color: #4CAF50;
            margin-bottom: 20px;
            position: relative;
            text-align: center;
            /* Căn chữ giữa */
        }

        .progress-bar {
            height: 5px;
            background-color: #fff;
            width: 0%;
            transition: width 1s linear;
            /* Điều chỉnh để transition mượt mà hơn */
        }
    </style>
</head>

<body>
    <h1 class="ad">
        <b>ROLE: </b><span style="color: red"><a
                href="{{ route('admin') }}">{{ Session::has('StatusRole') ? 'Admin' : '' }}</a></span>
    </h1>
    <nav class="data" style="padding: 20px;">
        <a href="{{ route('kanji') }}">Kanji</a>
        <a href="{{ route('show-news') }}">News</a>
        <a href="{{ route('shows.test') }}">Test</a>
        <a href="{{ route('show.vocabulary') }}">Vocabulary</a>
    </nav>

    @if (session('status'))
        <div class="notification success">
            {{ session('status') }}
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif
    <form id="excel_upload_form" action="{{ route('post.data.test') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>
            <input type="file" id="fileupload" name="fileupload" accept=".xlsx,.xls">
            <br>
            <input type="button" id="get_sheets" value="シート取得">
        </p>

        <select name="sheet_name" id="sheet_name">
            <option value=""></option>
        </select>
        <br>
        <label for="table_name">テーブル名：</label>
        <select name="table_name" id="table_name">
            <option value="">Choose a table</option>
            <option value="test_answer">test_answer</option>
            <option value="test_mondai">test_mondai</option>
            <option value="test_question">test_question</option>
        </select>
        <br>
        <button type="submit">Upload</button>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let totalTime = 5;
            let intervalTime = 100; // 100ms cho mỗi cập nhật
            let elapsed = 0;

            const progressBar = document.getElementById('progress-bar');
            const interval = setInterval(() => {
                elapsed += intervalTime;
                let progress = (elapsed / (totalTime * 1000)) * 100;
                progressBar.style.width = progress + '%';

                if (elapsed >= totalTime * 1000) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.querySelector('.notification').style.display = 'none';
                    }, 500); // Thêm một chút thời gian trước khi ẩn thông báo
                }
            }, intervalTime);
        });


        // ファイルアップロード時の処理
        document.getElementById('get_sheets').addEventListener('click', function() {

            var formData = new FormData();
            formData.append('fileupload', document.getElementById('fileupload').files[0]);

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('upload.excel') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    var sheetSelect = document.getElementById('sheet_name');
                    sheetSelect.innerHTML = ''; // Xóa các options hiện tại

                    // Thêm các options mới từ response
                    data.forEach(sheetName => {
                        var option = document.createElement('option');
                        option.value = sheetName;
                        option.text = sheetName;
                        sheetSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</body>

</html>
