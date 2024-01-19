<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vocabulary</title>
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <h1 class="ad">
        <b>ROLE: </b><span style="color: red">{{ Session::has('StatusRole') ? 'Admin' : '' }}</span>
    </h1>
    <nav class="data" style="padding: 20px;">
        <a href="{{ route('kanji') }}">Kanji</a>
        <a href="{{ route('show-news') }}">News</a>
        <a href="{{ route('shows.test') }}">Test</a>
        <a href="{{ route('show.vocabulary') }}">Vocabulary</a>
    </nav>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Vocabulary</h1>

        <form action="{{ route('search.level.vocabulary') }}" method="GET" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="level"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">LEVEL:</label>
                <select name="level" id="level-test"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Choose a level</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="N{{ $i }}" {{ old('level') == 'N' . $i ? 'selected' : '' }}>
                            N{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <input type="text" name="searchTerm" placeholder="Tìm kiếm..." value="{{ request('searchTerm') }}"
                class="border p-2 rounded">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">検索</button>

            {{-- <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">語彙追加</button> --}}
        </form>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg"
            style="display: flex; justify-content: center; width:100%">
            <table class="w-full text-sm text-left text-gray-500" style="width: 30%;width:100%">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">STT</th>
                        <th scope="col" class="py-3 px-6">Level</th>
                        <th scope="col" class="py-3 px-6">Tango</th>
                        <th scope="col" class="py-3 px-6">Romaji</th>
                        <th scope="col" class="py-3 px-6">Hiragana</th>
                        <th scope="col" class="py-3 px-6">Type</th>
                        <th scope="col" class="py-3 px-6">Meaning</th>
                    </tr>
                </thead>
                <tbody style="width:100%">
                    @foreach ($data as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->stt }}</th>
                            <td class="py-4 px-6" id="update-button-level-{{ $item->stt }}" contenteditable="true">
                                {{ $item->lever }}</td>
                            <td class="py-4 px-6" id="update-button-tango-{{ $item->stt }}" contenteditable="true">
                                {{ $item->tango }}</td>
                            <td class="py-4 px-6" id="update-button-romaji-{{ $item->stt }}" contenteditable="true">
                                {{ $item->romaji }}</td>
                            <td class="py-4 px-6" id="update-button-hiragana-{{ $item->stt }}"
                                contenteditable="true">
                                {{ $item->hiragana }}</td>
                            <td class="py-4 px-6" id="update-button-type-{{ $item->stt }}" contenteditable="true">
                                {{ $item->type }}</td>
                            <td class="py-4 px-6" id="update-button-mean-{{ $item->stt }}" contenteditable="true">
                                {{ $item->mean }}</td>
                            <td class="py-3 px-6">
                                {{-- <a href="/path-to-update/{{ $item->id }}" --}}
                                <form class="updateVocabulary">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-900"
                                        onclick="updateDataVocabulary({{ $item->stt }})">Update</button>
                                </form>
                            </td>
                            <td class="py-3 px-6">
                                <form class="deleteVocabulary">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id-stt-Vocabulary" value="{{ $item->stt }}">
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        id="deleteVocabulary-btn-"{{ $item->stt }}
                                        onclick="return confirm('Are you sure you want to delete this?')">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    {{-- error 通知 --}}
                    <tr>
                        <td>
                            @if (session('msg'))
                                <div>{{ session('msg') }}</div>
                            @endif
                            @php
                                session()->forget('msg');
                            @endphp
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $data->appends(request()->query())->links('pagination::tailwind-pagination') }}
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        function updateDataVocabulary(stt) {

            var newLevel = $('#update-button-level-' + stt).text();
            var newTango = $('#update-button-tango-' + stt).text();
            var newRomaji = $('#update-button-romaji-' + stt).text();
            var newHiragana = $('#update-button-hiragana-' + stt).text();
            var newType = $('#update-button-type-' + stt).text();
            var newMean = $('#update-button-mean-' + stt).text();

            var data = {
                lever: newLevel,
                tango: newTango,
                romaji: newRomaji,
                hiragana: newHiragana,
                type: newType,
                mean: newMean,
            };


            var payload = {
                stt: stt,
                data: data
            };

            // console.log(payload);



            // Sử dụng AJAX để gửi file đến server
            $.ajax({
                url: '{{ route('update.vocabulary') }}',
                type: 'POST',
                data: JSON.stringify(payload), // Chuyển đối tượng thành chuỗi JSON
                contentType: 'application/json', // Đặt kiểu nội dung là JSON
                success: function(response) {
                    alert(response.message);
                    console.log(response.data);
                },
                error: function() {
                    alert('Error');
                }
            });

        }

        document.querySelectorAll('.updateVocabulary').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Xử lý form tại đây

            });
        });

        document.querySelectorAll('.deleteVocabulary').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Xử lý form tại đây
                let stt = form.querySelector('input[name="id-stt-Vocabulary"]').value;
                data = {
                    stt: stt,
                }
                deleteByStt(data);
            });
        });


        function deleteByStt(data) {
            $.ajax({
                url: '{{ route('delete.vocabulary') }}',
                type: 'DELETE',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log("Success response:", response);
                    alert(response.message);
                    window.location.reload()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Lỗi AJAX:", textStatus, errorThrown);
                    alert('Đã xảy ra lỗi: ' + errorThrown);
                }
            });
        }
    </script>
</body>

</html>
