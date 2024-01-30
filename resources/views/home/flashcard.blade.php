@extends('clients.client')

@section('title')
    <title>FLASH CARD</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/flashCard.css') }}">
    <style>
        path {
            stroke-dasharray: 0;
            stroke-dashoffset: 0;
            transition: stroke-dasharray 0.5s ease-in-out, stroke-dashoffset 0.5s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <div class="word_card">
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
@endsection


@section('js')
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
@endsection
