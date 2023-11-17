{{-- @inject('loginController', 'App\Http\Controllers\login\loginController') --}}

{{-- <nav>
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
    </div>
    <div class="navlist">
        <div class="myList">
            <ul class="list">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="{{ route('logout') }}" id="signIn">
                        @php
                            $login = !isset($login_status) ? 'ログイン' : 'ログアウト';
                        @endphp {{ $login }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}
<nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
    <div class="hder hidden lg:flex lg:gap-x-12">
        <a href="#" class="hd_text" title="ホームページ">Home</a>
        <a href="#" class="hd_text" title="3T-Panについて">About</a>
        <a href="{{route('contact')}}" class="hd_text" title="お問い合わせ">Contact</a>
        @if (Session::has('username'))
            ユーザー:
            &nbsp;&nbsp;
            {{ session('username') }}
        @endif
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
