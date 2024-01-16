<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vocabulary</title>
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Vocabulary</h1>

        <form action="{{ route('search.level.vocabulary') }}" method="GET" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="level"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">LEVEL:</label>
                <select name="level" id="level-test"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="N{{ $i }}">N{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <input type="text" name="searchTerm" placeholder="Tìm kiếm..." value="{{ request('searchTerm') }}"
                class="border p-2 rounded">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">検索</button>
        </form>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
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
                <tbody>
                    @foreach ($data as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->stt }}</th>
                            <td class="py-4 px-6">{{ $item->lever }}</td>
                            <td class="py-4 px-6">{{ $item->tango }}</td>
                            <td class="py-4 px-6">{{ $item->romaji }}</td>
                            <td class="py-4 px-6">{{ $item->hiragana }}</td>
                            <td class="py-4 px-6">{{ $item->type }}</td>
                            <td class="py-4 px-6">{{ $item->mean }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $data->appends(request()->query())->links('pagination::tailwind-pagination') }}
        </div>
    </div>
</body>

</html>
