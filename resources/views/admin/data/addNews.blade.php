<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">
    <title>Add-News</title>
    <style>
        #imagePreview {
            display: none;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style the form */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Style form labels */
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        /* Style form inputs and textarea */
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style file input */
        .form-control-file {
            display: none;
            /* Hide the default file input */
        }

        /* Style file input label and icon */
        .file-label {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .file-icon {
            margin-right: 8px;
            font-size: 20px;
            /* Tùy chỉnh kích thước biểu tượng */
        }

        /* Style the image preview */
        #imagePreview {
            max-width: 100%;
            max-height: 200px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        /* Style the audio preview */
        #audioPreview {
            max-width: 100%;
            margin-bottom: 15px;
        }

        /* Style the submit button */
        .btn-primary {
            background-color: #4D9BC1;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #3888A3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>ADD NEWS</h2>

        {{-- Form để thêm tin tức mới --}}
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- CSRF token để bảo vệ form --}}

            {{-- Trường nhập tiêu đề --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            {{-- Trường nhập nội dung --}}
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            {{-- Trường tải lên ảnh --}}
            <!-- Trường tải lên ảnh -->
            <div class="form-group">
                <label for="imageInput" class="file-label">
                    <span class="file-icon">📷</span> Image
                </label>
                <img id="imagePreview" alt="Image"><br>
                <input type="file" class="form-control-file" id="imageInput" name="images" required>
            </div>

            <!-- Trường tải lên audio -->
            <div class="form-group">
                <label for="audio" class="file-label">
                    <span class="file-icon">🔊</span> <!-- Thêm biểu tượng âm thanh -->
                    Audio
                </label>
                <!-- Thẻ audio để hiển thị preview -->
                <audio id="audioPreview" controls style="display: none;"></audio>
                <input type="file" class="form-control-file" id="audio" name="audio" required>
            </div>

            {{-- Nút submit --}}
            <button type="submit" class="btn btn-primary">ADD</button>
        </form>
    </div>

    <script>
        // update IMAGE
        var isValidImage = true;
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var file = event.target.files[0];
            isValidImage = true;

            if (file) {
                // Kiểm tra xem file có phải là ảnh không
                if (!file.type.startsWith('image/')) {
                    alert('画像ファイルを選択してください。');
                    isValidImage = false;
                    event.target.value = "";
                    return;
                } else {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("imagePreview").style.display = "block";
                        document.getElementById('imagePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        //Update audio
        var isValidAudio = true;

        document.getElementById('audio').addEventListener('change', function(event) {
            var file = event.target.files[0];
            isValidAudio = true;

            if (file) {
                // Kiểm tra xem file có phải là tệp âm thanh không
                if (!file.type.startsWith('audio/')) {
                    alert('音声ファイルを選択してください。'); // Thông báo: Hãy chọn một tệp âm thanh
                    isValidAudio = false;
                    event.target.value = ""; // Xóa lựa chọn file
                    return;
                }
                // Tạo URL cho file để sử dụng trong thẻ <audio>
                var audioUrl = URL.createObjectURL(file);
                audioPreview.src = audioUrl;
                audioPreview.style.display = "block"; // Hiển thị preview
            }
        });
    </script>
</body>

</html>
