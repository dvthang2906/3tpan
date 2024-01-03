<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/admin.css' }}">
    <link rel="stylesheet" href="{{ 'css/menu.css' }}">
    <title>User CTL</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div>
        <h1 class="ad">Admin: <span></span></h1>
        <h1 class="ad">Login at:<span></span></h1>
    </div>
    {{-- <table class="my_table">
        <tr>
            <th>User ID</th>
            <th>LogIn ID</th>
            <th>User Name</th>
            <th>Tel</th>
            <th>Email</th>
            <th>Rank</th>
            <th>Option</th>
        </tr>
        @foreach ($dataUsers as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->user }}</td>
                <td>{{ $data->fullnameUser }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->level }}</td>
                <td>
                    <button class="bt_user1">Update</button>
                    <button class="bt_user2">Delete</button>
                </td>
            </tr>
        @endforeach
    </table> --}}

    <table class="min-w-full divide-y divide-gray-300 shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    User ID
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    LogIn ID
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    User Name
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    Rank
                </th>
                <th scope="col"
                    class="px-5 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                    Option
                </th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($dataUsers as $data)
                <tr class="hover:bg-gray-50" id="userRow_{{ $data->id }}">
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900 UserId"
                        data-usersid="{{ $data->id }}">
                        {{ $data->id }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900 UserId">
                        @if ($data->admin == 1)
                            admin
                        @else
                            User Account
                        @endif
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $data->user }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $data->fullnameUser }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $data->email }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $data->level }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                        <button
                            class="deleteUsers text-red-600 hover:text-red-900 mx-1 py-1 px-3 border border-red-600 rounded transition ease-in-out duration-150">
                            Delete Users
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>




    <div class="nomal">
        <a href="#" class="bt_nav" title="ユーザー追加"><span>ADDITION</span></a>
    </div>


    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.deleteUsers').forEach(function(button) {
            button.onclick = function(event) {
                if (event.target.matches('.deleteUsers')) {
                    // Lấy phần tử gần nhất có class 'UserId'
                    const trElement = button.closest('tr');
                    if (!trElement) {
                        console.error('Không tìm thấy phần tử TR gần nhất.');
                        return;
                    }

                    const userIdElement = trElement.querySelector('.UserId');
                    if (!userIdElement) {
                        console.error('Không tìm thấy phần tử có class UserId.');
                        return;
                    }

                    const usersId = userIdElement.getAttribute('data-usersid');

                    if (usersId && confirm("本当に削除しますか？")) {
                        fetch('/admin/deleteUsers', {
                                method: 'POST',
                                body: JSON.stringify({
                                    value: usersId
                                }),
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    alert(data.message);
                                    // Loại bỏ dòng từ DOM
                                    document.getElementById('userRow_' + usersId).remove();
                                }
                            })
                            .catch(error => {
                                console.error('There was an error!', error);
                            });
                    }
                }
            };
        });
    </script>

</body>


</html>
