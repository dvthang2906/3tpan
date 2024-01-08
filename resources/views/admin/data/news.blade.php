<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-News</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>News</h1>
    {{-- Kiểm tra xem có dữ liệu không --}}
    @if ($news->isNotEmpty())
        <div class="content-display">
            @foreach ($news as $item)
                <div class="item" style="border: 1px black solid; margin:5px; padding:5px;">
                    <h2 id="title-{{ $item->id }}" contenteditable="true"
                        onclick="showUpdateButton({{ $item->id }})">
                        {{ $item->title }}
                    </h2>
                    <button id="update-button-{{ $item->id }}" style="display:none;"
                        onclick="updateTitle({{ $item->id }})">Update</button>
                    <p>{!! nl2br(e($item->content)) !!}</p>

                    @if ($item->images)
                        <div class="images">
                            <img src="{{ asset('images/' . $item->images) }}" alt="Image">
                        </div>
                    @endif

                    @if ($item->audio)
                        <div class="audio">
                            <audio controls>
                                <source src="{{ asset('audio/' . $item->audio) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @endif

                    <small>Created at: {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}</small>
                    <small>Last updated: {{ \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d H:i:s') }}</small>
                </div>
            @endforeach
        </div>
    @else
        <p>No data found.</p>
    @endif

    <script>
        function showUpdateButton(id) {
            $('#update-button-' + id).show();
        }

        function updateTitle(id) {
            var updatedTitle = $('#title-' + id).text();
            $.ajax({
                url: '{{ route('edit-News') }}',
                method: 'POST',
                data: {
                    id: id,
                    title: updatedTitle,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#update-button-' + id).hide(); // Ẩn nút sau khi cập nhật thành công
                    alert('Title updated successfully');
                },
                error: function(error) {
                    // Xử lý lỗi
                    alert('Error updating title');
                }
            });
        }
    </script>
</body>

</html>
