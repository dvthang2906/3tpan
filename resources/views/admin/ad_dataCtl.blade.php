<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">
    <title>Data CTL</title>
</head>

<body>
    <h1 class="ad">
        <b>ROLE: </b><span style="color: red">{{ $StatusRole ? $StatusRole : '' }}</span>
    </h1>
    {{-- <div class="dt_preview">
        Hiển thị bản xem trước!
    </div>
    <div class="flex">
        <div class="selectdiv">
            <label>
                <select name="lever">
                    <option value="0" selected disabled> レベル </option>
                    <option value="1">N1</option>
                    <option value="2">N2</option>
                    <option value="3">N3</option>
                    <option value="4">N4</option>
                    <option value="5">N5</option>
                </select>
            </label>
        </div>
        <div class="selectdiv">
            <label>
                <select name="category">
                    <option value="0" selected disabled> カテゴリー </option>
                    <option value="1">Vocabulary</option>
                    <option value="2">Grammar</option>
                    <option value="3">Kanji</option>
                    <option value="4">Speaking</option>
                    <option value="5">Writing</option>
                    <option value="6">Reading</option>
                    <option value="7">Listenning</option>
                    <option value="7">Test</option>
                </select>
            </label>
        </div>
    </div>
    <div id="app">
        <input type="file" name="file">
    </div>
    <div class="dt_text">
        <textarea name="data_text" id="" cols="80" rows="20"></textarea>
    </div>
    <div bt_data>
        <button class="bt_save bt_data">Save</button>
        <button class="bt_update bt_data">Update</button>
        <button class="bt_delete bt_data">Delete</button>
    </div> --}}

    <div class="data" style="padding: 20px;">
        <a href="{{ route('kanji') }}">kanji</a>
        <a href="{{ route('show-news') }}">news</a>
        <a href="{{ route('shows.test') }}">Test</a>
        {{-- <a href="#">test_answer</a>
        <a href="#">test_mondai</a>
        <a href="#">test_question</a> --}}
        <a href="#">videos</a>
        <a href="#">vocabulary</a>
    </div>

</body>

</html>
