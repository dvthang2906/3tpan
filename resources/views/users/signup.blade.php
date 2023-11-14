@extends('clients.client')

@section('content')
    <form action="{{ route('post-Signup') }}" method="POST">

        <div class="mb-3">
            <label for="" style="color: red">Họ và tên</label>
            <input type="text" class="form-control" name="fullname" placeholder="họ và tên" value="{{ old('fullname') }}"
                required>
            @error('fullname')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" style="color: red">ニックネームID</label>
            <input type="text" class="form-control" name="UserName" placeholder="ニックネーム" value="{{ old('UserName') }}"
                required>
            @error('UserName')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for=""style="color: red">password</label>
            <input type="password" class="form-control" name="password" placeholder="password " value="{{ old('password') }}"
                required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for=""style="color: red">email</label>
            <input type="text" class="form-control" name="email" placeholder="email " value="{{ old('email') }}"
                required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('login') }}" class="btn btn-warning">quay lại</a>
        @csrf
    </form>
@endsection
