@php
    if (empty($login_status)) {
        $login_status = 'ログイン';
    }
@endphp

@extends('clients.client')

@section('content')
    <form action="{{ route('post-login') }}" method="POST">

        @if (session('msgSingup'))
            <div class="alert alert-success">{{ session('msgSingup') }}</div>
        @endif

        <div class="loginForm">
            <div class="login">
                <h1>Login</h1>

            </div>

            <div class="inputForm">
                @if (session('msg'))
                    <p style="color: red; margin-top:px;">{{ session('msg') }}</p>
                @endif
                <div class="username">

                    <div class="userForm">
                        <i class="fa-solid fa-user" style="color:#222d3f;"></i>
                        <input type="text" name="userName" id="user" placeholder="UserName"
                            value="{{ old('userName') }}" required>
                    </div>

                </div>

                <div class="pass">
                    <div class="passForm">
                        <i class="fa-solid fa-lock" style="color: #222d3f;"></i>
                        <input type="password" name="password" id="pass" placeholder="Password" required>
                    </div>
                </div>


                <div class="forgot">
                    <a href="#" id="forgotText">Forgot password?</a>
                </div>
                <button id="loginBtn">Login</button>

            </div>

            <div class="footer">
                <p>アカウント登録 click <a href="{{ route('Signup') }}" id="signUp">Signup</a></p>
            </div>
        </div>
        @csrf
    </form>
@endsection
