<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>

<body>
    <h1>Test</h1>
    <div>
        <form action="{{ route('get.data.Test') }}" method="GET">
            @csrf
            <label for="level">LEVEL: </label>
            <select name="level" id="level-test">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="N{{ $i }}">N{{ $i }}</option>
                @endfor
            </select>

            <button type="submit">submit</button>
        </form>
    </div>
</body>

</html>
