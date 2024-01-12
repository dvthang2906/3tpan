<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST</title>
</head>

<body>
    <h1>INSERT-Test</h1>
    <form action="{{ route('') }}" method="POST" enctype="multipart/form-data">
        <label for="sheet_name">sheet_name</label>
        <input type="text" name="sheet_name" id="sheet_name" required>
        <p>
            <label for="fileupload">Upload file:</label>
            <input type="file" id="fileupload" name="fileupload" accept=".xlsx,.xls">
        </p>
        <button type="submit">submit</button>
    </form>
</body>

</html>
