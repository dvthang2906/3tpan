<header class="flex">
    <a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}" alt="logo"></a>
    <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
        <div class="hder hidden lg:flex lg:gap-x-12">
            <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
            <a href="{{ route('about') }}" class="hd_text" title="3T-Panについて">About</a>
            <a href="#" class="hd_text" title="3T-Panについて">3Tpan Premium</a>
            <a href="{{ route('contact') }}" class="hd_text" title="お問い合わせ">Contact</a>
            <div class="hd_text">
                @if (Session::has('username'))
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">ユーザー:</span>
                        <img src="{{ asset('storage/' . (session('images') ?? 'images/logo.jpg')) }}"
                            alt="User Image" class="rounded-full w-10 h-10 object-cover">
                        <a href="#" class="text-red-600 hd_text" id="userLink"
                            data-userName="{{ session('username') }}"
                            data-id="{{ session('user_id') }}">{{ session('fullname') }}</a>
                    </div>
                @endif
            </div>
            <a href="{{ route('logout') }}" class="log_text">
                @php
                    if (Session::has('login_status')) {
                        $login = 'ログアウト';
                    } else {
                        $login = 'ログイン';
                    }
                @endphp
                <span aria-hidden="true">{{ $login }}&rarr;</span>
            </a>
            <!-- Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <b class="close" id="close">&times;</b>
                    <div class="userlogoImages" style="text-align: center;">
                        <img id="imagePreview"
                            src="{{ asset('storage/' . (session('images') ?? 'images/logo.jpg')) }}" alt="Logo"
                            style="width: 180px; height: 100px; object-fit: contain;">

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
                                    style="border-bottom: 1px solid #000"></span>
                            <button id="updateUserID"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2.5 text-sm rounded">更新</button>
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

        </div>
    </nav>
</header>
<div class="nav_head">
    <div class="nomal">
        <a href="#" class="bt_nav" title="辞書"><span>辞書</span></a>
        <a href="{{ route('flashcards') }}" class="bt_nav" title="フラッシュカード"><span>フラッシュカード</span></a>
        <a href="{{ route('test') }}" class="bt_nav" title="テストしてみよう！"><span>テスト</span></a>
    </div>
    <nav class="navbar">
        <ul class="nav">
            <li class="nav-item"><a href="{{ route('pronunciation') }}"><span>話す</span></a></li>
            <li class="nav-item"><a href="{{ route('news') }}"><span>読む</span></a></li>
            <li class="nav-item"><a href="{{ route('listen') }}"><span>聴く</span></a></li>
            <li class="nav-item"><a href="{{ route('write-kanji') }}"><span>書く</span></a></li>
        </ul>
    </nav>
</div>
