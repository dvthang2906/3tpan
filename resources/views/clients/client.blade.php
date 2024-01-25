<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://ngocthang.net/wp-content/uploads/2020/04/sticker-facebook.gif" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- TUAN --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalUser.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')

    @yield('title')
    <style>
        body {

            font-family: Arial, Helvetica, sans-serif !important;

        }
    </style>
</head>

<body>
    @include('layouts.head')

    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <b class="close" id="close">&times;</b>
            <div class="userlogoImages" style="text-align: center;">
                <img id="imagePreview" src="{{ asset('storage/' . (session('images') ?? 'images/logo.jpg')) }}"
                    alt="Logo" style="width: 180px; height: 100px; object-fit: contain;">

                <!-- Form cập nhật ảnh -->
                <form id="updateForm" action="/uploadImageUser" method="post" enctype="multipart/form-data"
                    style="text-align: center; padding-left:-10px;">
                    @csrf
                    <input type="file" id="imageInput" name="image" required style="font-size: 10px;">
                    <br>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 text-sm rounded">Update</button>
                </form>

            </div>
            <div class="flex flex-col space-y-2">
                <p class="flex justify-between items-center">
                    <span>ユーザーID:<input type="text" id="userName" class="text-sm py-1 px-2"
                            style="border-bottom: 1px solid #000; width: 55%;"></span>
                    {{-- <button id="updateUserID"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button> --}}
                </p>
                <p class="flex justify-between items-center">
                    <span>氏名:<input id="userFullName" type="text" class="text-sm py-1 px-2"
                            style="border-bottom: 1px solid #000"></span>
                    <button id="updateUserName"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
                </p>
                <p><span>レベル: </span><span id="level"></span></p>
                <p class="flex justify-between items-center">
                    <span>メール:<input id="email" type="text" class="text-sm py-1 px-2"
                            style="border-bottom: 1px solid #000; width: 200px"></span>
                    <button id="updateEmail"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
                </p>
            </div>
        </div>
    </div>


    @yield('content')


    <script>
        // lấy API thông tin người dùng
        var user_information = document.getElementById('userLink');
        if (user_information) {
            user_information.addEventListener('click', function(e) {
                e.preventDefault();

                // Khi người dùng nhấn vào nút, mở modal
                document.getElementById("myModal").style.display = "block";

                var userName = this.getAttribute('data-userName');

                fetch('/user-information', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            userName: userName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Điền thông tin vào modal
                        // console.log(data);
                        document.getElementById('userName').value = data.user;
                        document.getElementById('userFullName').value = data.fullnameUser;
                        if (data.level != null) {
                            document.getElementById('level').innerText = data.level;
                        } else {
                            document.getElementById('level').innerText = "bạn chưa có level";
                        }
                        document.getElementById('email').value = data.email;
                        // Hiển thị modal
                        // document.getElementById('userModal').style.display = 'block';
                    });
            });
        }


        // Khi người dùng nhấn vào <span> (x), đóng modal
        document.getElementsByClassName("close")[0].onclick = function() {
            document.getElementById("myModal").style.display = "none";
        }

        // Khi người dùng nhấn ra ngoài modal, đóng nó
        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                document.getElementById("myModal").style.display = "none";
            }
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

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của form

            var formData = new FormData(this); // Lấy dữ liệu từ form

            sendUpdateImages(formData); // Gửi yêu cầu cập nhật
        });


        // Thông báo trạng thái sau khi xử lý ảnh
        function sendUpdateImages(formData) {
            // Lấy CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/uploadImageUser', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Hiển thị thông điệp từ phản hồi
                    alert(data.message);
                })
                .catch(error => {
                    // Xử lý lỗi (nếu có)
                    console.error('There was an error!', error);
                });
        }


        //Update User ID

        if (user_information) {
            var userID = user_information.getAttribute('data-id');


            // document.getElementById('updateUserID').addEventListener('click', function() {
            //     var NewUserName = document.getElementById('userName').value;
            //     updateUserData('user', userID, NewUserName);
            // });

            //Update User Name
            document.getElementById('updateUserName').addEventListener('click', function() {
                var userFullName = document.getElementById('userFullName').value;
                updateUserData('fullnameUser', userID, userFullName);
            });

            //Update Email
            document.getElementById('updateEmail').addEventListener('click', function() {
                var email = document.getElementById('email').value;
                updateUserData('email', userID, email);
            });

        }


        function updateUserData(field, userID, NewValue) {
            if (NewValue.trim() === "") {
                switch (field) {
                    case 'user':
                        alert('ユーザーIDを入力してください!!!!');
                        break;
                    case 'fullnameUser':
                        alert('氏名を入力してください!!!!');
                        break;
                    case 'email':
                        alert('メールアドレスを入力してください!!!!');
                        break;
                }
                return;
            }
            var data = {
                field: field,
                userID: userID,
                NewValue: NewValue
            };

            // Gọi hàm kiểm tra tồn tại
            checkDataExistence(field, NewValue, function(exists) {
                if (exists) {
                    switch (field) {
                        case 'user':
                            alert('ユーザーIDが既に存在しています!!!!!');
                            break;
                        case ('email'):
                            alert('メールアドレスが既に存在しています!!!!!');
                            break;
                    }
                } else {
                    sendUpdateRequest(data);
                }
            });

        }

        function sendUpdateRequest(data) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/updateUsers", true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content')); // Cập nhật CSRF token
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('更新できました。');
                    // Thêm code xử lý response tại đây
                }
            };
            xhr.send(JSON.stringify(data));
        }


        function checkDataExistence(field, value, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "/checkDataExistence?field=" + field + "&value=" + encodeURIComponent(value), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    callback(response.exists);
                }
            };
            xhr.send();
        }
    </script>
    @yield('js')
    @stack('scripts')
</body>

</html>
