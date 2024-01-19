@section('title')
    Contact Form
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <style>
        /* Ẩn mũi tên mặc định của trình duyệt cho phần tử select */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Đảm bảo rằng SVG mũi tên hiển thị đúng cách */
        .custom-arrow svg {
            pointer-events: none;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endsection
@extends('clients.client')
@section('content')
    <div class="center">
        <div class="isolate bg-white px-6">
            <div class="text-center">
                <h2 class="tracking-tight text-gray-900 sm:text-4xl">お問い合わせ</h2>
                <p class="text-gray-600">以下の情報を入力して、送信ボタンを押してください</p>
            </div>
            <form action="{{ route('contact') }}" method="POST" class="max-w-xl" style="margin: auto; margin-top:20px">
                <div class=" grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">性</label>
                        <div class="mt-2.5">
                            <input type="text" name="first-name" id="first-name" value="{{ old('first-name') }}"
                                autocomplete="given-name"
                                class=" w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">名</label>
                        <div class="mt-2.5">
                            <input type="text" name="last-name" id="last-name" value="{{ old('last-name') }}"
                                autocomplete="family-name"
                                class="w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class=" sm:col-span-2">
                        <label for="email" class=" text-sm font-semibold leading-6 text-gray-900">メールアドバイス</label>
                        <div class="mt-2.5">
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">電話番号</label>
                        <div class="relative mt-2.5">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <label for="country" class="sr-only">Country</label>
                                <select id="country" name="country"
                                    class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-4 pr-9 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                    <option>JP</option>
                                    <option>UK</option>
                                    <option>VN</option>
                                </select>
                                <svg class="custom-arrow pointer-events-none absolute right-3 top-0 h-full w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="tel" name="phone-number" id="phone-number" autocomplete="tel"
                                class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                        <div class="mt-2.5">
                            <textarea name="message" id="message" rows="4"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-10">
                    <button type="submit" id="contactSubmit"
                        class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        送信</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection
