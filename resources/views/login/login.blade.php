@php
    if (empty($login_status)) {
        $login_status = 'ログイン';
    }
@endphp

@extends('clients.client')
@section('css')
    <link rel="stylesheet" href="{{ 'css/login.css' }}">
@endsection

@section('content')
    @if (session('msgSingup'))
        <div class="alert alert-success">{{ session('msgSingup') }}</div>
    @endif

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign
                In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign
                Up</label>
            <div class="login-form">
                <form action="{{ route('post-login') }}" method="POST" class="sign-in-htm">
                    @if (session('msgSingup'))
                        <div class="alert alert-success">{{ session('msgSingup') }}</div>
                    @endif

                    @if (session('msg'))
                        <p style="color: red; margin-top:px;">{{ session('msg') }}</p>
                    @endif
                    <div class="group">
                        <label for="user" class="label">Username<span>*</span></label>
                        <input id="user" type="text" name="userName" class="input" value="{{ old('userName') }}"
                            required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password<span>*</span></label>
                        <input id="pass" type="password" name="password" class="input" data-type="password"
                            value="{{ old('password') }}" required>
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign In">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                    @csrf
                </form>


                <form class="sign-up-htm" action="{{ route('post-Signup') }}" method="POST">
                    @if (session('msg'))
                        <p style="color: red; margin-top:px;">{{ session('msg') }}</p>
                    @endif
                    <div class="group">
                        <label for="user" class="label">Fullname<span>*</span></label>
                        <input id="user" type="text" name="fullname" class="input" value="{{ old('fullname') }}"
                            required>
                        @error('fullname')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="user" class="label">Username<span>*</span></label>
                        <input id="user" type="text" name="UserName" class="input" value="{{ old('UserName') }}"
                            required>
                        @error('UserName')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="pass" class="label">Password<span>*</span></label>
                        <input id="pass" type="password" name="password" class="input" data-type="password"
                            value="{{ old('password') }}" required>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password<span>*</span></label>
                        <input id="pass" type="password" name="password1" class="input" data-type="password"
                            value="{{ old('password1') }}" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address<span>*</span></label>
                        <input id="pass" type="text" name="email" value="{{ old('email') }}" class="input"
                            required>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up">

                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
