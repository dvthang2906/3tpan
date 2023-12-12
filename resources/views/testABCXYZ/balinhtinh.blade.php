<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST-BA-LINH-TINH</title>
</head>

<body>
    <h1>TEST</h1>
    <form action="{{ url('/translate') }}" method="GET">
        <label for="text">Nhập văn bản:</label>
        <input type="text" id="text" name="text">
        <button type="submit">Dịch</button>
    </form>

</body>

</html>
