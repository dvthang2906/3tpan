<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News-List</title>
    <style>
        th,
        td {
            border: 1px #888 solid;
            margin: 10px;
            padding: 10px;
        }

        .add-News {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="msg" id="msg">
        @if (Session::has('msg'))
            {{ Session::get('msg') }}
        @endif
        @if (Session::has('success'))
            {{ Session::get('success') }}
        @endif
    </div>
    <form action="{{ route('search-News') }}" method="POST">
        @csrf
        <label for="start-date">Ngày bắt đầu:</label>
        <input type="date" id="start-date" name="start-date" value="{{ $startDate ?? '' }}">
        <label for="end-date">Ngày kết thúc:</label>
        <input type="date" id="end-date" name="end-date" value="{{ $endDate ?? '' }}">
        <input type="submit" value="検索">
    </form>

    <a href="{{ route('add-News') }}" class="add-News">新しいNewsを作成</a>

    @if (count($news) > 0)
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>created_at</th>
                    <th>CTL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->id }}</td>
                        <td>{{ $new->title }}</td>
                        <td>{{ $new->created_at }}</td>
                        <td>
                            <!-- View Button -->
                            <form action="{{ route('news.details.view', ['id' => $new->id]) }}" method="GET"
                                style="display: inline-block;">
                                @csrf
                                <button type="submit">View</button>
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('news.delete') }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $new->id }}">
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
