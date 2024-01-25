<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTACT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <th scope="col" class="py-3 px-6 w-32">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @if ($item->status == '処理中')
                            <td class="py-4 px-6 check-status" id="check-status" style="color: green;"
                                data-id="{{ $item->id }}">
                                {{ $item->status }}</td>
                        @else
                            <td class="py-4 px-6 check-status" style="color:black;" id="check-status"
                                data-id="{{ $item->id }}">
                                {{ $item->status }}</td>
                        @endif
                        <td class="py-4 px-6">{{ $item->first_name }}</td>
                        <td class="py-4 px-6">{{ $item->last_name }}</td>
                        <td class="py-4 px-6">{{ $item->email }}</td>
                        <td class="py-4 px-6">{{ $item->country }}</td>
                        <td class="py-4 px-6">{{ $item->phone_number }}</td>
                        <td class="py-4 px-6">{{ $item->message }}</td>
                        <td class="py-4 px-6">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                        {{-- <td class="py-4 px-6">{{ date('Y-m-d', strtotime($item->updated_at)) }}</td> --}}
                        <td class="text-center">
                            <button onclick="confirmDelete(this)"
                                class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        document.addEventListener('DOMContentLoaded', function() {

            var statusElement = document.querySelectorAll('[data-id]');

            statusElement.forEach(function(element) {
                element.addEventListener('click', function() {
                    var itemId = this.getAttribute('data-id');
                    var textStatus = this.textContent.trim();


                    if (textStatus == '処理中') {
                        this.textContent = '処理済';
                        this.style.color = 'black';

                        const data = {
                            id: itemId,
                            status: this.textContent,

                        }
                        const options = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                            },
                            body: JSON.stringify(data)
                        }

                        fetch('{{ route('update.status.contact') }}', options)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data.message);
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });

                    }
                    if (textStatus == '処理済') {
                        this.textContent = '処理中';
                        this.style.color = 'green';

                        const data = {
                            id: itemId,
                            status: this.textContent,
                        }
                        const options = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                            },
                            body: JSON.stringify(data)
                        }

                        fetch('{{ route('update.status.contact') }}', options)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data.message);
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });

        function confirmDelete(element) {
            var result = confirm("このコンタクトを削除してもよろしいですか？");
            if (result) {
                // Logic to delete the item
                var id = element.closest('tr').querySelector('[data-id]').getAttribute('data-id');
                console.log("Item deleted. : " + id);

                const data = {
                    id: id,
                }

                options = {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify(data)
                }

                Api_Url = '{{ route('delete.contact') }}';

                fetch(Api_Url, options)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.message);
                        window.location.reload();
                    })
                    .catch((error) => {
                        console.log('ERROR: ' + error);
                    });
            } else {
                // Logic if cancellation
                console.log("Delete action cancelled.");
            }
        }
    </script>

</body>

</html>
