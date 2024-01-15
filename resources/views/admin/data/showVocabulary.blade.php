<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vocabulary</title>
    <style>
        /* Tùy chỉnh pagination */
        .pagination-links .page-link {
            padding: .5rem .75rem;
            /* Giảm kích thước padding */
            font-size: .875rem;
            /* Điều chỉnh kích thước font */
            /* Thêm bất kỳ style nào khác bạn muốn tùy chỉnh */
        }
    </style>
</head>

<body>
    <h1>Vocabulary</h1>

    <form action="#" method="GET">
        <input type="text" name="searchTerm" placeholder="Tìm kiếm..." value="{{ request('searchTerm') }}">
        <button type="submit">Tìm Kiếm</button>
    </form>


    <div>
        {{ $data->appends(request()->query())->links() }}
        @foreach ($data as $item)
            <p>{{ $item->tango }} - {{ $item->mean }}</p>
            <!-- Hiển thị thông tin khác của $item nếu cần -->
        @endforeach
    </div>
</body>

</html>
