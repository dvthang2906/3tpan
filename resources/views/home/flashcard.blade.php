<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link href="{{ asset('build/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/flashCard.css') }}">
    <title>FLASH CARD</title>
    <style>
        path {
    stroke-dasharray: 0;
    stroke-dashoffset: 0;
    transition: stroke-dasharray 0.5s ease-in-out, stroke-dashoffset 0.5s ease-in-out;
}
    </style>
</head>

<body>
    @include('clients.client')
    <ul class="menu">
        <li class="menu__mega">
            <a href="#" class="init-bottom">ライブラリ</a>
            <ul class="menu__second-level">
                <li><a href="#"><span id="test">食べ物</span></a></li>
                <li><a href="#">動物</a></li>
                <li><a href="#">銀行</a></li>
                <li><a href="#">日常生活</a></li>
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
    {{-- <h3 class="lib_title">食べ物</h3> --}}
    {{-- <nav class="mx-all mx-auto flex  items-center justify-between " aria-label="Global">
        <div class="hder hidden lg:flex lg:gap-x-12">
            <a href="#" class="hd_text" title="ホームページ">マイカード</a>
            <a href="#" class="hd_text" title="3T-Panについて">勉強しよう！</a>
            <a href="#" class="hd_text" title="お問い合わせ">テストしてみよう</a>
            <a href="#" class="hd_text" title="お問い合わせ">楽しもう</a>
        </div>
    </nav> --}}
    <div class="word_card">
        {{-- <div class="txt_word">
            <div class="hder hidden lg:flex lg:gap-x-12">
                <a href="#" class="hd_text1" title="">ヒント</a>
                <a href="#" class="hd_text1" title="">じどうさいせい</a>
                <a href="#" class="hd_text1" title="">スキップ</a>
            </div>
        </div> --}}
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
                        <button class="bt_try" id="Review_learned_Btn"><a
                                href="{{ route('reviewLearned') }}"><span>復習</span></a></button>
                        <button class="prevBtn"><span>Prev</span></button>
                        <button class="nextBtn"><span>Next</span></button>
                        <button id="Update_learned_Btn" class="btcomplete"><span> 一応覚えた</span></button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let totalLearnedCount = {{ isset($totalLearnedCount) ? $totalLearnedCount : 0 }}
            let total = {{ isset($countVocabulary) ? $countVocabulary : 0 }}
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
                    `${total}語彙のうち ${completed} 語を学びました(${Math.round(percent)}%)`;
            }

            // Ví dụ cập nhật tiến trình
            updateProgress(totalLearnedCount, total);
        });
    </script>


</body>
