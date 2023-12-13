<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listen</title>
    <style>
        ::cue {
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            font-size: 1em;
        }
    </style>

</head>

<body>
    <video controls width="720">
        <source src="{{ asset('video/Hàng xóm của tôi là Totoro.mp4') }}" type="video/mp4">
        <track label="VIETNAMESE" kind="subtitles" srclang="vn"
            src="{{ asset('video/1988.My.Neighbor.Totoro.BluRay.720p.DTS.3Audio.x264-CHD [co hieu ung, bai hat tieng Anh].vtt') }}"
            default>
        Your browser does not support the video tag or the file format of this video.
    </video>
    {{-- <section class="flex w-full flex-col">
        <div class="relative z-10 pt-[56.25%]">
            <div class="w-full h-full">
                <div class="absolute custom-border-video top-0 left-0" style="width: 100%; height: 100%;">
                    <video src="{{ asset('video/Hàng xóm của tôi là Totoro.mp4') }}" preload="auto" playsinline=""
                        webkit-playsinline="" x5-playsinline="" style="width: 100%; height: 100%;" autoplay="">
                    </video>
                </div>
            </div>
            <div class="video-react-bezel text-white video-react-bezel-animation" role="status" aria-label="playing"
                style="">
                <div class="video-react-bezel-icon flex items-center justify-center video-react-bezel-icon-pause"><svg
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512"
                        class="w-4 h-4 " height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z">
                        </path>
                    </svg></div>
            </div>
            <div class="absolute w-full h-full transition-all rounded-xl top-0 left-0 opacity-100 hidden"
                style="background: rgba(0, 0, 0, 0.6); opacity: 0;">
                <div class="w-full h-full">
                    <div class="w-full h-full justify-center items-center gap-12 flex">
                        <div class="relative z-10"><svg stroke="currentColor" fill="white" stroke-width="0"
                                viewBox="0 0 24 24" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 12C22 6.47715 17.5228 2 12 2 8.9841 2 6.28002 3.33509 4.44656 5.44648L2 3V9H8L5.86492 6.86543C7.33243 5.11383 9.53614 4 12 4 16.4183 4 20 7.58172 20 12 20 16.4183 16.4183 20 12 20 7.58172 20 4 16.4183 4 12H2C2 17.5228 6.47715 22 12 22 17.5228 22 22 17.5228 22 12ZM14.5 10V8.5H9.5V12.75H12.625C12.9702 12.75 13.25 13.0298 13.25 13.375 13.25 13.7202 12.9702 14 12.625 14H9.5V15.5H12.625C13.7986 15.5 14.75 14.5486 14.75 13.375 14.75 12.2014 13.7986 11.25 12.625 11.25H11V10H14.5Z">
                                </path>
                            </svg></div>
                        <div class="relative z-10"><svg stroke="currentColor" fill="white" stroke-width="0"
                                viewBox="0 0 512 512" height="40" width="40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M96 448h106.7V64H96v384zM309.3 64v384H416V64H309.3z"></path>
                            </svg></div>
                        <div class="relative z-10"><svg stroke="currentColor" fill="white" stroke-width="0"
                                viewBox="0 0 24 24" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 12C2 6.47715 6.47715 2 12 2 15.0159 2 17.72 3.33509 19.5534 5.44648L22 3V9H16L18.1351 6.86543C16.6676 5.11383 14.4639 4 12 4 7.58172 4 4 7.58172 4 12 4 16.4183 7.58172 20 12 20 16.4183 20 20 16.4183 20 12H22C22 17.5228 17.5228 22 12 22 6.47715 22 2 17.5228 2 12ZM14.5 10V8.5H9.5V12.75H12.625C12.9702 12.75 13.25 13.0298 13.25 13.375 13.25 13.7202 12.9702 14 12.625 14H9.5V15.5H12.625C13.7986 15.5 14.75 14.5486 14.75 13.375 14.75 12.2014 13.7986 11.25 12.625 11.25H11V10H14.5Z">
                                </path>
                            </svg></div>
                    </div>
                </div>
                <div class="absolute right-4 top-2">
                    <div class="flex gap-3">
                        <form
                            action="javascript:throw new Error('A React form was unexpectedly submitted. If you called form.submit() manually, consider using form.requestSubmit() instead. If you\'re trying to use event.stopPropagation() in a submit event handler, consider also calling event.preventDefault().')">
                            <div class="flex items-center justify-center w-full h-full"><button type="submit"><svg
                                        stroke="currentColor" fill="white" stroke-width="0" viewBox="0 0 512 512"
                                        height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M349.6 64c-36.4 0-70.7 16.7-93.6 43.9C233.1 80.7 198.8 64 162.4 64 97.9 64 48 114.2 48 179.1c0 79.5 70.7 143.3 177.8 241.7L256 448l30.2-27.2C393.3 322.4 464 258.6 464 179.1 464 114.2 414.1 64 349.6 64zm-80.8 329.3l-4.2 3.9-8.6 7.8-8.6-7.8-4.2-3.9c-50.4-46.3-94-86.3-122.7-122-28-34.7-40.4-63.1-40.4-92.2 0-22.9 8.4-43.9 23.7-59.3 15.2-15.4 36-23.8 58.6-23.8 26.1 0 52 12.2 69.1 32.5l24.5 29.1 24.5-29.1c17.1-20.4 43-32.5 69.1-32.5 22.6 0 43.4 8.4 58.7 23.8 15.3 15.4 23.7 36.5 23.7 59.3 0 29-12.5 57.5-40.4 92.2-28.8 35.7-72.3 75.7-122.8 122z">
                                        </path>
                                    </svg></button></div>
                        </form><button><svg stroke="white" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                                    d="M262.29 192.31a64 64 0 1057.4 57.4 64.13 64.13 0 00-57.4-57.4zM416.39 256a154.34 154.34 0 01-1.53 20.79l45.21 35.46a10.81 10.81 0 012.45 13.75l-42.77 74a10.81 10.81 0 01-13.14 4.59l-44.9-18.08a16.11 16.11 0 00-15.17 1.75A164.48 164.48 0 01325 400.8a15.94 15.94 0 00-8.82 12.14l-6.73 47.89a11.08 11.08 0 01-10.68 9.17h-85.54a11.11 11.11 0 01-10.69-8.87l-6.72-47.82a16.07 16.07 0 00-9-12.22 155.3 155.3 0 01-21.46-12.57 16 16 0 00-15.11-1.71l-44.89 18.07a10.81 10.81 0 01-13.14-4.58l-42.77-74a10.8 10.8 0 012.45-13.75l38.21-30a16.05 16.05 0 006-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 00-6.07-13.94l-38.19-30A10.81 10.81 0 0149.48 186l42.77-74a10.81 10.81 0 0113.14-4.59l44.9 18.08a16.11 16.11 0 0015.17-1.75A164.48 164.48 0 01187 111.2a15.94 15.94 0 008.82-12.14l6.73-47.89A11.08 11.08 0 01213.23 42h85.54a11.11 11.11 0 0110.69 8.87l6.72 47.82a16.07 16.07 0 009 12.22 155.3 155.3 0 0121.46 12.57 16 16 0 0015.11 1.71l44.89-18.07a10.81 10.81 0 0113.14 4.58l42.77 74a10.8 10.8 0 01-2.45 13.75l-38.21 30a16.05 16.05 0 00-6.05 14.08c.33 4.14.55 8.3.55 12.47z">
                                </path>
                            </svg></button>
                    </div>
                </div>
                <div class="z-30 absolute right-6 bottom-9">
                    <div class="flex gap-3 items-center">
                        <div>
                            <div title="Trình phát thu nhỏ"
                                class="hidden lg:flex w-6 h-6 lg:w-12 text-white lg:h-12 justify-center items-center cursor-pointer">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                                    class="w-5 h-5 lg:w-6 lg:h-6" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                                    </path>
                                    <path
                                        d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z">
                                    </path>
                                </svg>
                            </div>
                            <div title="Trình phát thu nhỏ"
                                class="w-6 h-6 lg:w-12 text-white lg:h-12 flex lg:hidden justify-center items-center cursor-pointer">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                                    class="w-5 h-5 lg:w-6 lg:h-6" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                                    </path>
                                    <path
                                        d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="w-6 h-6 cursor-pointer lg:w-12 lg:h-12 hidden lg:flex justify-center items-center"
                            title="Toàn màn hình">
                            <div><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="w-7 h-7 hidden lg:block text-xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z">
                                    </path>
                                </svg><svg stroke="currentColor" fill="white" stroke-width="0" viewBox="0 0 24 24"
                                    class="lg:hidden" height="24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z">
                                    </path>
                                </svg></div>
                        </div>
                        <div class="w-6 h-6 cursor-pointer lg:w-12 lg:h-12 flex lg:hidden justify-center items-center"
                            title="Toàn màn hình">
                            <div><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="w-7 h-7 hidden lg:block text-xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z">
                                    </path>
                                </svg><svg stroke="currentColor" fill="white" stroke-width="0" viewBox="0 0 24 24"
                                    class="lg:hidden" height="24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z">
                                    </path>
                                </svg></div>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-6 left-0 w-full">
                    <div class="px-6 w-full m-auto">
                        <div class="ui-video-seek-slider">
                            <div class="track" data-testid="main-track">
                                <div class="main" style="left: 0%; width: 100%;">
                                    <div class="inner-seek-block buffered" data-test-id="test-buffered"
                                        style="transform: scaleX(0.177331);"></div>
                                    <div class="inner-seek-block seek-hover" data-test-id="test-seek-hover"
                                        style="transform: scaleX(0);"></div>
                                    <div class="inner-seek-block connect" style="transform: scaleX(0.176854);"></div>
                                </div>
                            </div>
                            <div class="hover-time" data-testid="hover-time" style="transform: translateX(0px);">
                                NaN:NaN:NaN</div>
                            <div class="thumb active" data-testid="testThumb" style="left: calc(17.6854% - 6px);">
                                <div class="handler"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="z-20 absolute left-6 bottom-9">
                    <div class="text-white text-xs cursor-pointer hover:text-white"><span>15:23</span> / 3:27:03</div>
                </div>
            </div>
            <div class="absolute transition-all bottom-0 hidden lg:block rounded-b-xl pt-[37px] h-[288px] z-10 w-full"
                style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAEgCAYAAAB1khmuAAAAAXNSR0IArs4c6QAAATNJREFUOE9tyPdHJ3AAh/Fve++9995d1957iySSRBJJIokkkRznJM45kkQS6Y/M0y8PH71/ePG8I5HvF8Ut0aTEkBJLShwp8WRAAp8kkpJESjIpKaSkkgFpfJJOSgYpmaRkkZJNBuTwSS4peaTkk1JASiEZUMQnxaSUkFJKShkp5WRABZ9UklJFSjUpNaTUkgF1fFJPSgMpjaQ0kQHNfNJCSispbaS0k9JBBnTySRcp3aT8IKWHlJ9kQC+f9JHST8oAKYOkDJEBw3wyQsooKWOkjJMyQQZM8skUKdOkzJAyS8ocGTDPJwukLJKyRMoyKSvkF6uwBuuwAZuwBduwA7uwB/twAIdwBMdwAqdwBudwAZdwBddwA7fwC37DH7iDe/gL/+A/PMAjPMEzvMArvME7fHwCb3Y5NUwXcu0AAAAASUVORK5CYII=&quot;); opacity: 0;">
            </div>
            <div class="absolute bottom-0 h-12 w-full z-30 opacity-100 transition-all block" style="opacity: 0;">
                <div class="text-white w-full h-2 absolute z-10 bottom-[51px]">
                    <div class="ui-video-seek-slider">
                        <div class="track" data-testid="main-track">
                            <div class="main" style="left: 0%; width: 100%;">
                                <div class="inner-seek-block buffered" data-test-id="test-buffered"
                                    style="transform: scaleX(0.177331);"></div>
                                <div class="inner-seek-block seek-hover" data-test-id="test-seek-hover"
                                    style="transform: scaleX(0);"></div>
                                <div class="inner-seek-block connect" style="transform: scaleX(0.176854);"></div>
                            </div>
                        </div>
                        <div class="hover-time" data-testid="hover-time" style="transform: translateX(0px);">0:00:00
                        </div>
                        <div class="thumb active" data-testid="testThumb" style="left: calc(17.6854% - 6px);">
                            <div class="handler"></div>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 h-[51px] w-full pt-[3px] z-10 text-white px-3">
                    <div class="flex w-full justify-between h-full items-center">
                        <div class="h-full gap-3 flex items-center">
                            <div title="Dừng (k)" class="cursor-pointer"><svg stroke="currentColor"
                                    fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="w-8 h-8 text-xl"
                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z">
                                    </path>
                                </svg></div>
                            <div class="flex items-center transition h-full relative">
                                <div title="Tắt tiếng (m)" class="cursor-pointer"><svg stroke="currentColor"
                                        fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                        class="w-6 h-6 text-xl" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0014 7.97v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z">
                                        </path>
                                    </svg></div>
                                <div class="h-full volume-transition flex items-center justify-center w-0"
                                    aria-label="Âm lượng" title="Âm lượng">
                                    <div class="rc-slider rc-slider-horizontal">
                                        <div class="rc-slider-rail"></div>
                                        <div class="rc-slider-track" style="left: 0%; width: 100%;"></div>
                                        <div class="rc-slider-step"></div>
                                        <div class="rc-slider-handle" tabindex="0" role="slider"
                                            aria-valuemin="0" aria-valuemax="1" aria-valuenow="1"
                                            aria-disabled="false" aria-orientation="horizontal"
                                            style="left: 100%; transform: translateX(-50%); width: 0px; height: 0px; margin-top: -4px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="text-white text-xs cursor-pointer hover:text-white"><span>15:23</span> /
                                    3:27:03</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="relative">
                                <div title="Cài đặt"
                                    class="w-12 h-12 flex justify-center items-center cursor-pointer">
                                    <div class="w-12 h-12 flex justify-center items-center cursor-pointer"><svg
                                            stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 24 24" height="28" width="28"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path
                                                d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM4 12h4v2H4v-2zm10 6H4v-2h10v2zm6 0h-4v-2h4v2zm0-4H10v-2h10v2z">
                                            </path>
                                        </svg></div>
                                </div>
                                <div class="px-3 bg-setting rounded-md transition-all hidden opacity-0 w-0 h-0">
                                    <div class="px-1 py-2">
                                        <div
                                            class="text-black hidden pb-4 hover:text-red-500 lg:text-white cursor-pointer lg:flex items-center gap-3 font-bold text-[15px]">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="none" d="M0 0h24v24H0V0z" opacity=".87"></path>
                                                <path
                                                    d="M17.51 3.87L15.73 2.1 5.84 12l9.9 9.9 1.77-1.77L9.38 12l8.13-8.13z">
                                                </path>
                                            </svg>Bật phụ đề
                                        </div>
                                        <div
                                            class="text-black lg:hidden pb-4 lg:text-white cursor-pointer flex items-center gap-3 font-bold text-[15px]">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="none" d="M0 0h24v24H0V0z" opacity=".87"></path>
                                                <path
                                                    d="M17.51 3.87L15.73 2.1 5.84 12l9.9 9.9 1.77-1.77L9.38 12l8.13-8.13z">
                                                </path>
                                            </svg>Bật phụ đề
                                        </div>
                                        <div>
                                            <div
                                                class="flex items-center w-full hover:text-red-500 cursor-pointer pb-3 gap-2">
                                                <div></div>
                                                <div class="pl-4">Tắt</div>
                                            </div>
                                            <div
                                                class="flex items-center w-full hover:text-red-500 cursor-pointer pb-3 gap-2">
                                                <div><svg stroke="currentColor" fill="none" stroke-width="2"
                                                        viewBox="0 0 24 24" stroke-linecap="round"
                                                        stroke-linejoin="round" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg></div>
                                                <div class="pl-0">Tiếng việt</div>
                                            </div>
                                            <div
                                                class="flex items-center w-full hover:text-red-500 cursor-pointer pb-3 gap-2">
                                                <div><svg stroke="currentColor" fill="none" stroke-width="2"
                                                        viewBox="0 0 24 24" stroke-linecap="round"
                                                        stroke-linejoin="round" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg></div>
                                                <div class="pl-0">Tiếng nhật</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div title="Cài đặt"
                                    class="w-12 h-12 flex justify-center items-center cursor-pointer"><svg
                                        stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 512 512" class="transition-transform transform rotate-0"
                                        height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M256 176a80 80 0 1080 80 80.24 80.24 0 00-80-80zm172.72 80a165.53 165.53 0 01-1.64 22.34l48.69 38.12a11.59 11.59 0 012.63 14.78l-46.06 79.52a11.64 11.64 0 01-14.14 4.93l-57.25-23a176.56 176.56 0 01-38.82 22.67l-8.56 60.78a11.93 11.93 0 01-11.51 9.86h-92.12a12 12 0 01-11.51-9.53l-8.56-60.78A169.3 169.3 0 01151.05 393L93.8 416a11.64 11.64 0 01-14.14-4.92L33.6 331.57a11.59 11.59 0 012.63-14.78l48.69-38.12A174.58 174.58 0 0183.28 256a165.53 165.53 0 011.64-22.34l-48.69-38.12a11.59 11.59 0 01-2.63-14.78l46.06-79.52a11.64 11.64 0 0114.14-4.93l57.25 23a176.56 176.56 0 0138.82-22.67l8.56-60.78A11.93 11.93 0 01209.94 26h92.12a12 12 0 0111.51 9.53l8.56 60.78A169.3 169.3 0 01361 119l57.2-23a11.64 11.64 0 0114.14 4.92l46.06 79.52a11.59 11.59 0 01-2.63 14.78l-48.69 38.12a174.58 174.58 0 011.64 22.66z">
                                        </path>
                                    </svg></div>
                                <div
                                    class="px-3 bg-setting rounded-md transition-height transition-all hidden w-0 h-0">
                                    <div class="py-2 w-full flex gap-3 flex-col">
                                        <div
                                            class="flex w-full h-full justify-between items-center cursor-pointer hover:text-red-500">
                                            <div class="flex items-center font-bold gap-2"><svg stroke="currentColor"
                                                    fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                                    height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path
                                                        d="M19.5 5.5v13h-15v-13h15zM19 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-8 7H9.5v-.5h-2v3h2V13H11v1c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1v-4c0-.55.45-1 1-1h3c.55 0 1 .45 1 1v1zm7 0h-1.5v-.5h-2v3h2V13H18v1c0 .55-.45 1-1 1h-3c-.55 0-1-.45-1-1v-4c0-.55.45-1 1-1h3c.55 0 1 .45 1 1v1z">
                                                    </path>
                                                </svg>Bật phụ đề</div>
                                            <div class="flex gap-2 items-center">
                                                <div>Vi,Ja</div><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 24 24" height="16"
                                                    width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="flex w-full h-full justify-between items-center cursor-pointer hover:text-red-500">
                                            <div class="flex items-center font-bold gap-2"><svg stroke="currentColor"
                                                    fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                                    height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2.5-3.5l7-4.5-7-4.5v9z">
                                                    </path>
                                                </svg>Tốc độ phát</div>
                                            <div class="flex gap-2 items-center">
                                                <div>Bình thường</div><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 24 24" height="16"
                                                    width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="flex w-full h-full justify-between items-center cursor-pointer hover:text-red-500">
                                            <div class="flex items-center font-bold gap-2"><svg stroke="currentColor"
                                                    fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                                    rotate="90" height="20" width="20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                                    <path
                                                        d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46A7.93 7.93 0 0020 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74A7.93 7.93 0 004 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z">
                                                    </path>
                                                </svg>Lặp lại video</div>
                                            <div class="flex gap-2 items-center">
                                                <div>Tắt</div><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 24 24" height="16"
                                                    width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="flex w-full h-full justify-between items-center cursor-pointer hover:text-red-500">
                                            <div class="flex items-center font-bold gap-2"><svg stroke="currentColor"
                                                    fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                                    aria-hidden="true" height="16" width="16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.75 4a.75.75 0 00-.75.75v10.5c0 .414.336.75.75.75h.5a.75.75 0 00.75-.75V4.75a.75.75 0 00-.75-.75h-.5zM17.75 4a.75.75 0 00-.75.75v10.5c0 .414.336.75.75.75h.5a.75.75 0 00.75-.75V4.75a.75.75 0 00-.75-.75h-.5zM3.288 4.819A1.5 1.5 0 001 6.095v7.81a1.5 1.5 0 002.288 1.277l6.323-3.906a1.5 1.5 0 000-2.552L3.288 4.819z">
                                                    </path>
                                                </svg>Tự động phát</div>
                                            <div class="flex gap-2 items-center">
                                                <div>Tắt</div><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 24 24" height="16"
                                                    width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div title="Trình phát thu nhỏ"
                                    class="hidden lg:flex w-6 h-6 lg:w-12 text-white lg:h-12 justify-center items-center cursor-pointer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" class="w-5 h-5 lg:w-6 lg:h-6" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                                        </path>
                                        <path
                                            d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z">
                                        </path>
                                    </svg>
                                </div>
                                <div title="Trình phát thu nhỏ"
                                    class="w-6 h-6 lg:w-12 text-white lg:h-12 flex lg:hidden justify-center items-center cursor-pointer">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 16 16" class="w-5 h-5 lg:w-6 lg:h-6" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z">
                                        </path>
                                        <path
                                            d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div title="Chế độ rạp chiếu phim (t)"
                                class="w-12 h-12 flex justify-center items-center cursor-pointer">
                                <div class="w-6 border-white border-2 h-4"></div>
                            </div>
                            <div class="w-6 h-6 cursor-pointer lg:w-12 lg:h-12 hidden lg:flex justify-center items-center"
                                title="Toàn màn hình">
                                <div><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 24 24" class="w-7 h-7 hidden lg:block text-xl" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z">
                                        </path>
                                    </svg><svg stroke="currentColor" fill="white" stroke-width="0"
                                        viewBox="0 0 24 24" class="lg:hidden" height="24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z">
                                        </path>
                                    </svg></div>
                            </div>
                            <div class="w-6 h-6 cursor-pointer lg:w-12 lg:h-12 flex lg:hidden justify-center items-center"
                                title="Toàn màn hình">
                                <div><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 24 24" class="w-7 h-7 hidden lg:block text-xl" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z">
                                        </path>
                                    </svg><svg stroke="currentColor" fill="white" stroke-width="0"
                                        viewBox="0 0 24 24" class="lg:hidden" height="24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z">
                                        </path>
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <script>
        // JavaScript to switch subtitles
        const videoElement = document.querySelector('video');
        const subtitleMenuButtons = document.querySelectorAll('.subtitle-button'); // Your custom subtitle buttons

        subtitleMenuButtons.forEach(button => {
            button.addEventListener('click', () => {
                let language = button.getAttribute('data-lang'); // 'en', 'ja', etc.
                videoElement.textTracks.forEach(track => {
                    track.mode = 'disabled'; // Disable all tracks
                    if (track.language === language) {
                        track.mode = 'showing'; // Enable the track that matches the language
                    }
                });
            });
        });
    </script>
</body>

</html>
