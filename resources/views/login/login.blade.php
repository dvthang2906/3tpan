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
                    <input id="user" type="text" class="input" value="{{ old('userName') }}" required>
                </div>
                <div class="group">
                    <label for="pass" class="label">Password<span>*</span></label>
                    <input id="pass" type="password" class="input" data-type="password" required>
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
            <form class="sign-up-htm">
                <div class="group">
                    <label for="user" class="label">Username<span>*</span></label>
                    <input id="user" type="text" class="input" required>
                </div>
                <div class="group">
                    <label for="pass" class="label">Password<span>*</span></label>
                    <input id="pass" type="password" class="input" data-type="password" required>
                </div>
                <div class="group">
                    <label for="pass" class="label">Repeat Password<span>*</span></label>
                    <input id="pass" type="password" class="input" data-type="password" required>
                </div>
                <div class="group">
                    <label for="pass" class="label">Email Address<span>*</span></label>
                    <input id="pass" type="text" class="input" required>
                </div>
                <div class="group">
                    {{-- <input type="submit" class="button" value="Sign Up"> --}}
                    <a href="{{ route('Signup') }}" id="signUp">Sign Up</a>
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
