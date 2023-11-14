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
    </style>
</head>

<body>

    <h3>Hiện Tại : <span id="currentFlashcard">1</span>/ <span id="currentFlashcardTotal">{{ $count }}</span>
    </h3>
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
                <button id="Review_learned_Btn"><a href="{{ route('reviewLearned') }}"
                        style="text-decoration: none"><span style="color: white;">Ôn luyện lại</span></a></button>
                <button class="prevBtn">Prev</button>
                <button class="nextBtn">Next</button>
                <button id="Update_learned_Btn">OK!NEXT</button>
            </div>
        </div>
    @endif





    <script>
        let currentFlashcard = parseInt(localStorage.getItem('currentFlashcard') || '0');
        let totalFlashcards = parseInt(localStorage.getItem('currentFlashcardTotal')) || 8;

        function updateFlashcardDisplay() {
            document.getElementById('currentFlashcard').textContent = currentFlashcard + 1;
            document.getElementById('currentFlashcardTotal').textContent = totalFlashcards;
        }

        function showFlashcard(index) {
            const flashcards = document.querySelectorAll('.flashcard-container');
            flashcards.forEach(flashcard => flashcard.style.display = 'none');
            const flashcardToShow = flashcards[index];
            if (flashcardToShow) {
                flashcardToShow.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateFlashcardDisplay();
            showFlashcard(currentFlashcard);
        });

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

        document.getElementById('Update_learned_Btn').addEventListener('click', () => {
            const currentContainer = document.querySelector('.flashcard-container:not([style*="display: none"])');
            const dataStt = currentContainer?.getAttribute('data-stt');

            if (dataStt) {
                axios.post('/home/update-learned-status', {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        stt: dataStt,
                    })
                    .then(response => {
                        console.log(response.data.message);
                        currentContainer.remove();
                        totalFlashcards -= 1;
                        if (currentFlashcard >= totalFlashcards) {
                            currentFlashcard = Math.max(0, totalFlashcards - 1);
                        }
                        localStorage.setItem('currentFlashcardTotal', totalFlashcards);
                        localStorage.setItem('currentFlashcard', currentFlashcard);
                        updateFlashcardDisplay();
                        showFlashcard(currentFlashcard);

                        if (totalFlashcards === 0) {
                            alert("Bạn đã học hết các flashcards. Nhấn OK để tiếp tục.");
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error('Không tìm thấy flashcard-container đang hiển thị.');
            }
        });
    </script>

</body>
