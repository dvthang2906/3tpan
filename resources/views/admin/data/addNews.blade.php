<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add-News</title>
    <style>
        #imagePreview {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Thêm Tin Tức Mới</h2>

        {{-- Form để thêm tin tức mới --}}
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- CSRF token để bảo vệ form --}}

            {{-- Trường nhập tiêu đề --}}
            <div class="form-group">
                <label for="title">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            {{-- Trường nhập nội dung --}}
            <div class="form-group">
                <label for="content">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            {{-- Trường tải lên ảnh --}}
            <div class="form-group">
                <label for="images">Ảnh</label>
                <img id="imagePreview" alt="Image"><br>
                <input type="file" class="form-control-file" id="imageInput" name="images">
            </div>

            {{-- Trường tải lên audio --}}
            <div class="form-group">
                <label for="audio">Audio</label>
                <!-- Thẻ audio để hiển thị preview -->
                <audio id="audioPreview" controls style="display: none;"></audio>
                <input type="file" class="form-control-file" id="audio" name="audio">

            </div>

            {{-- Nút submit --}}
            <button type="submit" class="btn btn-primary">Thêm Tin Tức</button>
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
