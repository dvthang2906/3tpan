<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .flashcard-container-all {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #eaeaea;
            padding: 20px;
            box-sizing: border-box;
        }

        .flashcard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .flashcard {
            width: 300px;
            height: 200px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            background-color: white;
            cursor: pointer;
            perspective: 1000px;
            position: relative;
        }

        .flashcard-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flashcard.flip .flashcard-inner {
            transform: rotateY(180deg);
        }

        .flashcard-front,
        .flashcard-content {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            backface-visibility: hidden;
            padding: 20px;
            border-radius: 12px;
            box-sizing: border-box;
            /* Đảm bảo padding không làm thay đổi kích thước */

        }

        .flashcard-content {
            transform: rotateY(180deg);
            background-color: #fafafa;
            color: #333;
            text-align: left;
            /* Căn văn bản sang trái */
            align-items: flex-start;
            /* Căn các thành phần con trong flex container sang trái */
        }

        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 20px;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #0056b3;
        }


        /* css của thanh hiển thị % */
        #progressContainer {
            width: 100%;
            background-color: #ddd;
        }

        #progressBar {
            width: 0%;
            height: 30px;
            background-color: #4CAF50;
            text-align: center;
            line-height: 30px;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link href="{{ asset('build/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/flashCard.css') }}">
    <title>FLASH CARD</title>
</head>

<body>
    <header class="flex">
        <a href="{{ route('home') }}"><img class="logo" src="{{ asset('images/logo3.png') }}" alt="logo"></a>
        <nav class=" mx-auto flex  items-center justify-between " aria-label="Global">
            <div class="hder hidden lg:flex lg:gap-x-12">
                <a href="{{ route('home') }}" class="hd_text" title="ホームページ">Home</a>
                <a href="#" class="hd_text" title="3T-Panについて">About</a>
                <a href="{{ route('contact') }}" class="hd_text" title="お問い合わせ">Contact</a>
                <a href="{{ route('login') }}" class="log_text">LOG IN<span aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>
    </header>
    <ul class="menu">
        <li class="menu__mega">
            <a href="#" class="init-bottom">ライブラリ</a>
            <ul class="menu__second-level">
                <li><a href="#"><span id="test">食べ物</span></a></li>
                <li><a href="#">動物</a></li>
                <li><a href="#">銀行</a></li>
                <li><a href="#">日常生活</a></li>
                <!-- 他メニュー省略 -->
            </ul>
        </li>
        <li class="menu__single">
            <a href="#" class="init-bottom">とうろく</a>
            <ul class="menu__second-level">
                <li><a href="#">フォルダー</a></li>
                <li><a href="#">テーマ</a></li>
                <li><a href="#">クラス</a></li>
            </ul>
        </li>
    </ul>
    <h3 class="lib_title">食べ物</h3>
    <nav class="mx-all mx-auto flex  items-center justify-between " aria-label="Global">
        <div class="hder hidden lg:flex lg:gap-x-12">
            <a href="#" class="hd_text" title="ホームページ">マイカード</a>
            <a href="#" class="hd_text" title="3T-Panについて">勉強しよう！</a>
            <a href="#" class="hd_text" title="お問い合わせ">テストしてみよう</a>
            <a href="#" class="hd_text" title="お問い合わせ">楽しもう</a>
        </div>
    </nav>
    <div class="word_card">
        <div class="txt_word">
            <div class="hder hidden lg:flex lg:gap-x-12">
                <a href="#" class="hd_text1" title="ホームページ">ヒント</a>
                <a href="#" class="hd_text1" title="3T-Panについて">じどうさいせい</a>
                <a href="#" class="hd_text1" title="お問い合わせ">スキップ</a>
            </div>
        </div>
        <div id="progressContainer">
            <div id="progressBar"></div>
        </div>
        <p id="progressText"></p>
        <div class="word">
            @if (isset($getFlashcards))
                <div class="flashcard-container-all">
                    @foreach ($getFlashcards as $index => $getFLC)
                        <div class="flashcard-container" style="{{ $index === 0 ? '' : 'display: none;' }}"
                            data-stt="{{ $getFLC->stt }}" data-index="{{ $index }}">
                            <div class="flashcard">
                                {{--
                                <span class="currentFlashcard"
                                    style="position: absolute; top: 10px;left: 10px;font-size: 20px;"></span> --}}
                                @if ($getFlashcards[$index] != null)
                                    <div class="flashcard-inner">
                                        <div class="flashcard-front">
                                            {{ $getFLC->tango }}
                                        </div>
                                        <div class="flashcard-content">
                                            {{ $getFLC->type }}<br>
                                            {{ $getFLC->tango }}<br>
                                            {{ $getFLC->hiragana }}<br>
                                            {{ $getFLC->mean }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="buttons">
                        <button id="Review_learned_Btn"><a href="{{ route('reviewLearned') }}"
                                style="text-decoration: none"><span style="color: white;">Ôn luyện
                                    lại</span></a></button>
                        <button class="prevBtn bt_nav">Prev</button>
                        <button class="nextBtn bt_nav">Next</button>
                        <button id="Update_learned_Btn" class="bt_nav">OK!NEXT</button>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let totalLearnedCount = {{ $totalLearnedCount }}
            let total = {{ $countVocabulary }}
            let currentFlashcard = parseInt(localStorage.getItem('currentFlashcard'));
            if (isNaN(currentFlashcard)) {
                currentFlashcard = 0;
            }
            let totalFlashcards = document.querySelectorAll('.flashcard-container').length;

            function updateFlashcardDisplay() {
                const flashcardElements = document.querySelectorAll('.currentFlashcard');
                flashcardElements.forEach(element => {
                    element.textContent = (currentFlashcard + 1).toString();
                });
            }

            function showFlashcard(index) {
                const flashcards = document.querySelectorAll('.flashcard-container');
                flashcards.forEach(flashcard => flashcard.style.display = 'none');
                const flashcardToShow = flashcards[index];
                if (flashcardToShow) {
                    flashcardToShow.style.display = 'block';
                }
            }

            updateFlashcardDisplay();
            showFlashcard(currentFlashcard);

            document.querySelector('.nextBtn').addEventListener('click', () => {
                currentFlashcard = (currentFlashcard + 1) % totalFlashcards;
                localStorage.setItem('currentFlashcard', currentFlashcard);
                showFlashcard(currentFlashcard);
                updateFlashcardDisplay();
            });

            document.querySelector('.prevBtn').addEventListener('click', () => {
                currentFlashcard = (currentFlashcard - 1 + totalFlashcards) % totalFlashcards;
                localStorage.setItem('currentFlashcard', currentFlashcard);
                showFlashcard(currentFlashcard);
                updateFlashcardDisplay();
            });

            document.querySelectorAll('.flashcard').forEach(flashcard => {
                flashcard.addEventListener('click', () => {
                    flashcard.classList.toggle('flip');
                });
            });

            const updateBtn = document.getElementById('Update_learned_Btn');
            if (updateBtn) {
                updateBtn.addEventListener('click', (event) => {
                    event.stopPropagation();

                    totalLearnedCount++;
                    updateProgress(totalLearnedCount, total);

                    const currentContainer = document.querySelector(
                        '.flashcard-container:not([style*="display: none"])');
                    if (currentContainer) {
                        const dataStt = currentContainer.getAttribute('data-stt');
                        if (dataStt) {
                            axios.post('/home/update-learned-status', {
                                    _token: document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    stt: dataStt,
                                })
                                .then(response => {
                                    console.log(response.data.message);
                                    currentContainer.remove();

                                    // Cập nhật totalFlashcards sau khi xoá một phần tử
                                    totalFlashcards--;

                                    if (totalFlashcards === 0) {
                                        alert("Bạn đã học hết các flashcards. Nhấn OK để tiếp tục.");
                                        window.location.reload();
                                    }

                                    // Cập nhật currentFlashcard và hiển thị flashcard tiếp theo
                                    currentFlashcard = currentFlashcard % totalFlashcards;
                                    localStorage.setItem('currentFlashcard', currentFlashcard);
                                    updateFlashcardDisplay();
                                    showFlashcard(currentFlashcard);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        } else {
                            console.error('Không tìm thấy flashcard-container đang hiển thị.');
                        }
                    }
                });
            } else {
                console.error('Nút "OK!NEXT" không tồn tại trong DOM.');
            }


            // thanh hiển thị %
            function updateProgress(completed, total) {
                var percent = (completed / total) * 100;
                document.getElementById('progressBar').style.width = percent + '%';
                document.getElementById('progressText').innerText =
                    `Đã học ${completed} trên ${total} từ vựng (${Math.round(percent)}%)`;
            }

            // Ví dụ cập nhật tiến trình
            updateProgress(totalLearnedCount, total); // Bạn đã học 200 từ vựng trên tổng số 600
        });
    </script>


</body>
