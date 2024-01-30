@php
    $status = false;
@endphp

@extends('clients.client')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/flashCard.css') }}">
    <style>
        .flashcard-container-all {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: white;
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
@endsection
@section('title')
    <title>Flashcard</title>
@endsection



@section('content')
    @if (isset($totalLearnedCount) && $totalLearnedCount > 0)


        @if (isset($ReviewLearnedFlashcard) && !empty($ReviewLearnedFlashcard))
            <div class="flashcard-container-all">
                @foreach ($ReviewLearnedFlashcard as $index => $getFLC)
                    <div class="flashcard-container" style="{{ $index === 0 ? '' : 'display: none;' }}"
                        data-stt-delete="{{ $getFLC->stt }}" data-index="{{ $index }}">
                        <div class="flashcard">
                            @if ($ReviewLearnedFlashcard[$index] != null)
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
                    <button class="prevBtn">Prev</button>
                    <button class="nextBtn">Next</button>
                    <button id="delete_learned_Btn">覚えた</button>

                </div>
            </div>
        @endif
    @else
        @if (isset($msg))
            <div class="alert alert-success">
                {{ $msg }}
            </div>
        @endif
    @endif
@endsection


@section('js')
    <script>
        let currentFlashcard = 0;
        const totalFlashcards = {{ count($ReviewLearnedFlashcard) }};



        function showFlashcard(index) {
            document.querySelectorAll('.flashcard-container').forEach(function(container) {
                container.style.display = 'none';
            });

            var flashcardToShow = document.querySelector('.flashcard-container[data-index="' + index + '"]');
            if (flashcardToShow) {
                flashcardToShow.style.display = 'block';
            }
        }

        document.querySelector('.nextBtn').addEventListener('click', function() {
            if (currentFlashcard < totalFlashcards - 1) {
                currentFlashcard++;
                showFlashcard(currentFlashcard);
            } else {
                currentFlashcard = -1;
                currentFlashcard++;
                showFlashcard(currentFlashcard);
            }
        });

        document.querySelector('.prevBtn').addEventListener('click', function() {
            if (currentFlashcard > 0) {
                currentFlashcard--;
                showFlashcard(currentFlashcard);
            } else {
                currentFlashcard = totalFlashcards;
                currentFlashcard--;
                showFlashcard(currentFlashcard);
            }
        });

        // Thêm event listener cho việc click để flip card
        document.querySelectorAll('.flashcard').forEach(function(flashcard) {
            flashcard.addEventListener('click', function() {
                this.classList.toggle('flip');
            });
        });





        // thay đổi trạng thái thành true. khi người dugnf bấm nút ok. đã  thuộc
        document.getElementById('delete_learned_Btn').addEventListener('click', function() {
            // Tìm phần tử flashcard-container đang hiển thị
            var currentFlashcardContainer = document.querySelector(
                '.flashcard-container:not([style*="display: none"])');

            // Nếu tồn tại phần tử, lấy giá trị data-stt
            var data_stt = currentFlashcardContainer ? currentFlashcardContainer.getAttribute('data-stt-delete') :
                null;

            if (data_stt) {

                // ... tiếp tục logic để gửi dữ liệu đi
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/home/delete-learned-status', {
                        _token: token,
                        stt: data_stt // Gửi data_stt như là currentFlashcard
                    })
                    .then(function(response) {
                        console.log(response.data.message);

                        // Đánh dấu flashcard hiện tại là đã học
                        if (currentFlashcardContainer) {
                            currentFlashcardContainer.classList.add('learned');
                        }

                        // Tìm flashcard tiếp theo và hiển thị nó
                        var nextFlashcardContainer = currentFlashcardContainer.nextElementSibling;
                        if (nextFlashcardContainer && nextFlashcardContainer.classList.contains(
                                'flashcard-container')) {
                            currentFlashcardContainer.style.display = 'none'; // Ẩn flashcard hiện tại
                            nextFlashcardContainer.style.display = 'block'; // Hiển thị flashcard tiếp theo
                        } else {
                            console.error('Không có flashcard tiếp theo để hiển thị.');
                            // Có thể hiển thị thông báo hoặc làm mới danh sách flashcard ở đây
                            alert("Bạn đã học hết các flashcards. Nhấn OK để tiếp tục.");
                            window.location.reload();

                        }

                        // ... bất kỳ cập nhật UI nào khác nếu cần ...
                    })
                    .catch(function(error) {
                        // Xử lý lỗi
                        console.error(error);
                    });
            } else {
                console.error('Không tìm thấy flashcard-container đang hiển thị.');
            }
        });




        // ÔN LUYỆN
    </script>
@endsection
