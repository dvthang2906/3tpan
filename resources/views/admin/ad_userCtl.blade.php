<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/admin.css' }}">
    <title>User CTL</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* General Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-dialog {
            margin-top: 10px;
            /* No top margin */
            margin-left: auto;
            /* Horizontally center the modal */
            margin-right: auto;
            /* Horizontally center the modal */
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 10px;
            border: 1px solid #888;
            /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            animation-name: animatetop;
            animation-duration: 0.4s;
            width: 80%;
        }

        /* Add Animation */
        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }


        .modal-header {
            position: relative;
            /* Necessary for absolute positioning of child elements */
            padding: 1rem;
            /* Padding around the header content */
            background-color: #5cb85c;
            /* Green background, can change to match your theme */
            color: white;
            /* Text color */
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Vertically center the title */
            justify-content: center;
            /* Center the title horizontally */
            border-bottom: 1px solid #dee2e6;
            /* Bottom border to separate from the body */
            margin: 10px;
            height: 50%;
        }

        .modal-title {
            font-size: 1.25rem;
            /* Large text size */
            font-weight: 600;
            /* Semi-bold font weight */
            margin: 0;
            /* Remove any default margin */
            position: absolute;
            /* Absolute positioning */
            top: 50%;
            /* Position from the top half of the header */
            left: 50%;
            /* Position from the left half of the header */
            transform: translate(-50%, -50%);
            /* Center the title */
            z-index: 1;
            /* Ensure it's above the close button for click events */
        }


        /* Modal Body */
        .modal-body {
            padding: 2px 16px;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        /* If using Bootstrap and want to override the default modal-header padding */
        .modal-header {
            padding: 1rem;
            /* Bootstrap typically uses 1rem, adjust as needed */
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select.form-control {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        /* Button Styles */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div id="modalBackdrop" class="hidden"></div>
    <!-- Modal HTML Structure -->
    <div id="addUserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content bg-white p-4 rounded-lg shadow">
                <div class="modal-header border-b mb-4">
                    <h4 class="modal-title text-lg font-semibold">Add New User</h4>
                </div>
                <form action="{{ route('admin-post-add-users') }}" method="POST" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Level -->
                        <div class="form-group">
                            <label for="level" class="block text-sm font-medium text-gray-700">Level:</label>
                            <select
                                class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="level" name="level">
                                <option value=""></option>
                                <option value="N5">N5</option>
                                <option value="N4">N4</option>
                                <option value="N3">N3</option>
                                <option value="N2">N2</option>
                                <option value="N1">N1</option>
                            </select>
                        </div>

                        <!-- Admin -->
                        <div class="form-group">
                            <label for="admin" class="block text-sm font-medium text-gray-700">Role:</label>
                            <select
                                class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="admin" name="admin" required>
                                <option value="0">User Account</option>
                                <option value="1">Admin</option>
                                <option value="2">Super User</option>
                                <option value="3">Editor</option>
                                <option value="4">Manager</option>
                            </select>
                        </div>

                        <!-- User -->
                        <div class="form-group">
                            <label for="user">User:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>

                        <!-- Fullname User -->
                        <div class="form-group">
                            <label for="fullnameUser">Full Name:</label>
                            <input type="text" class="form-control" id="fullnameUser" name="fullnameUser" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- Images -->
                        <div class="form-group">
                            <label for="imageInput">Images:</label>
                            <div style="width: 200px; height: 150px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; overflow: hidden;"
                                id="images">
                                <!-- Image will be displayed here -->
                            </div>
                            <input type="file" class="form-control" id="imageInput" name="images"
                                onchange="displayImage(this)">
                        </div>

                        <div class="modal-footer pt-4 border-t">
                            <button type="submit"
                                class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                            <button type="button" onclick="closeModal()"
                                class="btn btn-default bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <div>
        <h1 class="ad">
            <b>ROLE: </b><span style="color: red">{{ $StatusRole ? $StatusRole : '' }}</span>
        </h1>
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
                        @switch($data->admin)
                            @case('1')
                                admin
                            @break

                            @case('2')
                                Super User
                            @break

                            @case('3')
                                Editor
                            @break

                            @case('4')
                                Manager
                            @break

                            @default
                                User Account
                        @endswitch
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
        <button class="bt_nav" onclick="openModal()" title="ユーザー追加">
            <span>ADDITION</span>
        </button>
    </div>

    <script>
        function openModal() {
            // Get the modal element
            var modal = document.getElementById('addUserModal');

            // Display the modal by changing its style
            modal.style.display = 'block';

            // Optional: Implement logic to close the modal when the user clicks outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        function closeModal() {
            // Select the modal using its ID and change its display style to 'none'
            document.getElementById('addUserModal').style.display = 'none';
        }

        // update IMAGE
        var isValidImage = true;
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var file = event.target.files[0];
            isValidImage = true;

            if (file) {
                // Kiểm tra xem file có phải là ảnh không
                if (!file.type.startsWith('image/')) {
                    alert('画像ファイルを選択してください。');
                    isValidImage = false;
                    event.target.value = "";
                    return;
                } else {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        function displayImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.style.maxWidth = '200px';
                    imgElement.style.maxHeight = '150px';

                    var imageContainer = document.getElementById('images');
                    imageContainer.innerHTML = '';
                    imageContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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
