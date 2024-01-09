<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-News</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <h1>News</h1>
    {{-- Kiểm tra xem có dữ liệu không --}}
    @if ($details)
        <div class="content-display">
            <div class="details" style="border: 1px black solid; margin:5px; padding:5px;">
                <h2 id="{{ $details->getfillable()[0] }}-{{ $details->id }}" contenteditable="true"
                    onclick="showUpdateButton('{{ $details->getfillable()[0] }}')">
                    {{ $details->title }}
                    <br>
                </h2>
                <button id="update-button-{{ $details->getfillable()[0] }}" style="display:none;"
                    onclick="updateData({{ $details->id }}, '{{ $details->getfillable()[0] }}')">Update</button>

                <div>
                    <p id="{{ $details->getfillable()[1] }}-{{ $details->id }}" contenteditable="true"
                        onclick="showUpdateButton('{{ $details->getfillable()[1] }}')">
                        {!! nl2br(e($details->content)) !!}
                    </p>
                    <button id="update-button-{{ $details->getfillable()[1] }}" style="display:none;"
                        onclick="updateData({{ $details->id }}, '{{ $details->getfillable()[1] }}')">Update</button>
                </div>

                @if ($details->images)
                    <div class="images" id="{{ $details->getfillable()[2] }}-{{ $details->id }}"
                        contenteditable="true" onclick="showUpdateButton('{{ $details->getfillable()[2] }}')">
                        <img id="imagePreview" src="{{ asset('images/' . $details->images) }}" alt="Image">
                    </div>
                    <div id="update-button-{{ $details->getfillable()[2] }}" style="display:none;">
                        <input type="file" name="image" id="imageInput">
                        <br>
                        <button
                            onclick="uploadFile({{ $details->id }}, '{{ $details->getfillable()[2] }}')">Update</button>
                    </div>
                @endif

                @if ($details->audio)
                    <div class="audio">
                        <audio controls>
                            <source src="{{ asset('audio/' . $details->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                <small>Created at: {{ \Carbon\Carbon::parse($details->created_at)->format('Y-m-d H:i:s') }}</small>
                <small>Last updated: {{ \Carbon\Carbon::parse($details->updated_at)->format('Y-m-d H:i:s') }}</small>
            </div>
        </div>
    @else
        <p>No data found.</p>
    @endif

    <script>
        function showUpdateButton(object) {
            $('#update-button-' + object).show();
        }

        function uploadFile(id, object) {
            var fileInput = document.getElementById('imageInput');
            var file = fileInput.files[0];
            // console.log(file);
            var formData = new FormData();
            formData.append('file', file);

            // Sử dụng AJAX để gửi file đến server
            $.ajax({
                url: '{{ route('news.update.images') }}', // Đường dẫn tới server xử lý tải lên
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Lưu tên file vào một biến hoặc phần tử HTML
                    // document.getElementById('filename').value = response.filename;
                    var updatedData = $('#' + object + '-' + id).val();
                    $.ajax({
                        url: '{{ route('edit-News') }}',
                        method: 'POST',
                        data: {
                            id: id,
                            object: object,
                            dataNews: updatedData,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#update-button-' + id).hide(); // Ẩn nút sau khi cập nhật thành công
                            alert(object + ' updated successfully');
                            $('#update-button-' + object).hide();
                        },
                        error: function(error) {
                            // Xử lý lỗi
                            alert('Error updating title');
                        }
                    });
                },
                error: function() {
                    alert('Đã xảy ra lỗi trong quá trình tải lên.');
                }
            });
        }

        function updateData(id, object) {
            var updatedData = $('#imageInput').text();

            $.ajax({
                url: '{{ route('edit-News') }}',
                method: 'POST',
                data: {
                    id: id,
                    object: object,
                    dataNews: updatedData,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#update-button-' + id).hide(); // Ẩn nút sau khi cập nhật thành công
                    alert(object + ' updated successfully');
                    $('#update-button-' + object).hide();
                },
                error: function(error) {
                    // Xử lý lỗi
                    alert('Error updating title');
                }
            });
        }


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
                        document.getElementById('imagePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
</body>

</html>
