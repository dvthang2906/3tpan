<header class="flex"><a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}"
            alt="logo"></a>
    <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
        <div class="hder hidden lg:flex lg:gap-x-12">
            <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
            <a href="{{ route('about') }}" class="hd_text" title="3T-Panについて">About</a>
            <a href="#" class="hd_text" title="3T-Panについて">3Tpan Premium</a>
            <a href="{{ route('contact') }}" class="hd_text" title="お問い合わせ">Contact</a>
            <div class="user_logo">
                @if (Session::has('username'))
                    <div class="user_logo_con">
                        <span class="text-gray-700"></span>
                        <img src="{{ asset('storage/' . (session('images') ?? 'images/logo.jpg')) }}" alt="User Image"
                            class="rounded-full w-10 h-10 object-cover">
                        <a href="uname" class="text-red-600 hd_text" id="userLink"
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
