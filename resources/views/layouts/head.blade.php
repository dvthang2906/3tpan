{{-- @inject('loginController', 'App\Http\Controllers\login\loginController') --}}

<nav>
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
</nav>
