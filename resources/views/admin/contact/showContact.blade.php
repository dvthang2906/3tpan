<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTACT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <h1 class="m-5">CONTACT</h1>

    <div class="overflow-x-auto relative m-3">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6 w-28">Status</th>
                    <th scope="col" class="py-3 px-6 w-28">First Name</th>
                    <th scope="col" class="py-3 px-6 w-28">Last Name</th>
                    <th scope="col" class="py-3 px-6 w-40">Email</th>
                    <th scope="col" class="py-3 px-6 w-20">Country</th>
                    <th scope="col" class="py-3 px-6 w-32">Phone Number</th>
                    <th scope="col" class="py-3 px-6 text-center">Message</th>
                    <th scope="col" class="py-3 px-6 w-32">Created At</th>
                    <th scope="col" class="py-3 px-6 w-32">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @if ($item->status == '処理中')
                            <td class="py-4 px-6 text-green-500 check-status" id="check-status"
                                data-id="{{ $item->id }}">
                                {{ $item->status }}</td>
                        @else
                            <td class="py-4 px-6 text-black-500 check-status" id="check-status">
                                {{ $item->status }}</td>
                        @endif
                        <td class="py-4 px-6">{{ $item->first_name }}</td>
                        <td class="py-4 px-6">{{ $item->last_name }}</td>
                        <td class="py-4 px-6">{{ $item->email }}</td>
                        <td class="py-4 px-6">{{ $item->country }}</td>
                        <td class="py-4 px-6">{{ $item->phone_number }}</td>
                        <td class="py-4 px-6">{{ $item->message }}</td>
                        <td class="py-4 px-6">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                        <td class="py-4 px-6">{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var statusElement = document.querySelectorAll('[data-id]');

            statusElement.forEach(function(element) {
                element.addEventListener('click', function() {
                    var itemId = this.getAttribute('data-id');
                    var textStatus = this.textContent.trim();

                    console.log('id: ' + itemId);
                    console.log('status: ' + textStatus);

                    if (textStatus == '処理中') {
                        this.textContent = '処理済';
                        this.style.color = 'black';



                    } else if (textStatus == '処理済') {
                        this.textContent = '処理中';
                        this.style.color = 'green';
                    }
                });
            });
        });
    </script>

</body>

</html>
