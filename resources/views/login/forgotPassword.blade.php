@extends('clients.client')

@section('title')
    <title>ResetPassword</title>
@endsection

@section('content')
    <div class="mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 lg:w-3/5 xl:w-2/5"> <!-- Tăng kích thước tại các breakpoint lớn hơn -->
                <div class="bg-white shadow-md rounded px-10 pt-8 pb-10 mb-4"> <!-- Tăng padding -->
                    <div class="mb-4">{{ __('下記に登録したメールアドレスを入力してください!') }}</div>

                    <div class="mb-6">
                        @if (session('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded relative"
                                role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('post-forgot-password') }}">
                            @csrf

                            <div class="mb-6 flex flex-wrap">
                                <label for="email"
                                    class="block text-gray-700 text-sm font-bold mb-3 md:w-1/3 md:text-right md:mb-0 pr-4">
                                    <!-- Tăng margin-bottom -->
                                    {{ __('Email Address') }}
                                </label>

                                <div class="md:w-2/3">
                                    <input id="email" type="email"
                                        class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <!-- Tăng padding -->
                                    @error('email')
                                        <span class="text-red-500 text-xs italic" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="md:w-2/3 md:offset-1/3">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">
                                        <!-- Tăng padding -->
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
