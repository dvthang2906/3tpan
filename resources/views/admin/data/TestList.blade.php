<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div>
        @if (Session::has('msg'))
            {{ session('msg') }}
        @endif
    </div>
    <h1>INSERT-Test</h1>
    <form id="excel_upload_form" action="{{ route('post.data.test') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>
            <label for="fileupload">Upload file:</label>
            <input type="file" id="fileupload" name="fileupload" accept=".xlsx,.xls">
            <br>
            <input type="button" id="get_sheets" value="シート取得">
        </p>

        <label for="sheet_name">シート名:</label>
        <select name="sheet_name" id="sheet_name">
            <option value=""></option>
        </select>
        <br>
        <label for="table_name">テーブル名：</label>
        <select name="table_name" id="table_name">
            <option value="test_answer">test_answer</option>
            <option value="test_mondai">test_mondai</option>
            <option value="test_question">test_question</option>
        </select>
        <br>
        <button type="submit">Upload</button>

    </form>
    <script>
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
