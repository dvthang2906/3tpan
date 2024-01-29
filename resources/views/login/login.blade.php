@php
    if (empty($login_status)) {
        $login_status = 'ログイン';
    }
@endphp
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>


    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
</head>

<body>
    @if (session('msgSingup'))
        <div class="notification success">
            {{ session('msgSingup') }}
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif
    @if (session('msg-singup'))
        <div class="notification success">
            {{ session('msg-singup') }}
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif
    @if (session('status'))
        <div class="notification success">
            {{ session('status') }}
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif
    @if ($errors->any())
        <div class="notification success">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    @endif


    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                class="tab">Sign
                In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <form action="{{ route('post-login') }}" method="POST" class="sign-in-htm">
                    @csrf
                    @if (session('msgSingup'))
                        <div class="alert alert-success">{{ session('msgSingup') }}</div>
                    @endif


                    @if (session('msg'))
                        <p style="color: red; margin-top:px;">{{ session('msg') }}</p>
                    @endif
                    <div class="group">
                        <label for="user" class="label">Username<span>*</span></label>
                        <input id="user" type="text" name="userName" class="input" style="color: black;"
                            value="{{ old('userName') }}" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password<span>*</span></label>
                        <input id="pass" style="color: black;" type="password" name="password" class="input"
                            data-type="password" value="{{ old('password') }}" required>
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
                        <a href="{{ route('forgot-password') }}">Forgot Password?</a>
                    </div>

                </form>

                <form class="sign-up-htm" action="{{ route('post-Signup') }}" method="POST">
                    @if (session('msg-singup'))
                        <p style="color: red; margin-top:px;">{{ session('msg') }}</p>
                    @endif
                    <div class="group">
                        <label for="user" class="label">Fullname<span>*</span></label>
                        <input id="user" type="text" style="color: black;" name="fullname" class="input"
                            value="{{ old('fullname') }}" required>
                        @error('fullname')
                            <div class="error" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="user" class="label">Username<span>*</span></label>
                        <input id="user" style="color: black;" type="text" name="userName" class="input"
                            value="{{ old('userName') }}" required>
                        @error('userName')
                            <div class="error" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="pass" class="label">Password<span>*</span></label>
                        <input id="pass" style="color: black;"type="password" name="password" class="input"
                            data-type="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="error" style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password<span>*</span></label>
                        <input id="pass"style="color: black;" type="password" name="password1" class="input"
                            data-type="password" value="{{ old('password1') }}" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address<span>*</span></label>
                        <input id="pass" style="color: black;"type="text" name="email"
                            value="{{ old('email') }}" class="input" required>
                        @error('email')
                            <div class="error" style="color: red">{{ $message }}</div>
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

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let totalTime = 5;
            let intervalTime = 100; // 100ms cho mỗi cập nhật
            let elapsed = 0;

            const progressBar = document.getElementById('progress-bar');
            const interval = setInterval(() => {
                elapsed += intervalTime;
                let progress = (elapsed / (totalTime * 1000)) * 100;
                progressBar.style.width = progress + '%';

                if (elapsed >= totalTime * 1000) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.querySelector('.notification').style.display = 'none';
                    }, 500); // Thêm một chút thời gian trước khi ẩn thông báo
                }
            }, intervalTime);
        });
    </script>

</body>

</html>
