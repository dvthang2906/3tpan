@extends('clients.client')

@section('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .body-table-vocabulary {
            margin-top: 10px;
            margin: 50px;
            padding: 10px;
        }

        .flex-container {
            display: flex;
            align-items: flex-end;
            /* Căn chỉnh các thành phần theo trục dọc */
        }
    </style>
@section('title')
    <title>jisho</title>
@endsection

@section('content')
    <div class="body-table-vocabulary">
        <form action="{{ route('home.search.jisho') }}" method="GET" class="mb-4">
            @csrf
            <div class="mb-3 flex-container">
                <label for="level" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">LEVEL: &nbsp;</label>
                <select name="level" id="level-test"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Choose a level</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="N{{ $i }}" {{ old('level') == 'N' . $i ? 'selected' : '' }}>
                            N{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <input type="text" name="searchTerm" placeholder="検索キーワード" value="{{ request('searchTerm') }}"
                class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">検索</button>

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
                    @if ($data ?? [])
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
                            </tr>
                        @endforeach
                    @endif
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
@endsection

@section('js')
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
@endsection
