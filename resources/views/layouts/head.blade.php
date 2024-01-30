<header class="flex"><a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}"
            alt="logo"></a>
    <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
        <div class="hder hidden lg:flex lg:gap-x-12">
            <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
            <a href="{{ route('about') }}" class="hd_text" title="3T-Panについて">About</a>
            @if (session('payment_status') == true)
            @else
                <a href="{{ route('payment') }}" class="hd_text" title="3T-Panプレミアム">Upgrade to Premium</a>
            @endif

            <a href="{{ route('contact') }}" class="hd_text" title="おといあわせ">Contact</a>
            <div class="user_logo">
                @if (Session::has('username'))
                    <div class="user_logo_con">
                        <span class="text-gray-700"></span>
                        <img src="{{ asset('storage/' . (session('images') ?? 'images/logo.jpg')) }}" alt="User Image"
                            class="rounded-full w-10 h-10 object-cover">
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
        </div>
    </nav>
</header>

<div class="nav_head">
    <div class="nomal">
        <a href="{{ route('home.show.vocabulary') }}" class="bt_nav" title="辞書"><span>辞書</span></a>
        <a href="{{ route('flashcards') }}" class="bt_nav" title="フラッシュカード"><span>フラッシュカード</span></a>
        <a href="{{ route('test') }}" class="bt_nav" title="テストしてみよう！"><span>テスト</span></a>
    </div>

    @if (session('payment_status') == true)
        <nav class="navbar">
            <ul class="nav">
                {{-- <li title="はなす" class="nav-item"><a href="{{ route('pronunciation') }}"><span>話す</span></a></li> --}}
                <li title="はなす" class="nav-item"><a href="#"><span>話す</span></a></li>
                <li title="よむ" class="nav-item"><a href="{{ route('news') }}"><span>読む</span></a></li>
                <li title="きく" class="nav-item"><a href="{{ route('listen') }}"><span>聴く</span></a></li>
                <li title="かく" class="nav-item"><a href="{{ route('write-kanji') }}"><span>書く</span></a></li>
            </ul>
        </nav>
    @else
        <nav class="navbar">
            <ul class="nav">
                <li title="よむ" class="nav-item"><a><span style="color:gray;">話す</span></a></li>
                <li title="よむ" class="nav-item"><a><span style="color:gray;">読む</span></a></li>
                <li title="きく" class="nav-item"><a><span style="color:gray;">聴く</span></a></li>
                <li title="かく" class="nav-item"><a><span style="color:gray;">書く</span></a></li>
            </ul>
        </nav>
    @endif
</div>
