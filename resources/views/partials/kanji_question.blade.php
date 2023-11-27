{{-- partials.kanji_question --}}
@foreach ($questions as $key_question => $question)
    @if ($question->Q_ID == $mondai->Q_ID)
        @php
            $count++;
            $totalCount++;
        @endphp
        <div class="kanji-box">
            <span class="kanji">{{ $count }}: {{ $question->KANJI }}</span>
            <div class="ans">
                @foreach ($test_answer as $answer)
                    @if ($question->K_ID == $answer->K_ID)
                        <div class="answer">
                            <input type="radio" name="{{ $answer->K_ID }}"
                                value="{{ $answer->K_ID }}:{{ $answer->ANS1 }}"><span>{{ $answer->ANS1 }}</span>
                        </div>
                        <div class="answer">
                            <input type="radio" name="{{ $answer->K_ID }}"
                                value="{{ $answer->K_ID }}:{{ $answer->ANS2 }}"><span>{{ $answer->ANS2 }}</span>
                        </div>
                        <div class="answer">
                            <input type="radio" name="{{ $answer->K_ID }}"
                                value="{{ $answer->K_ID }}:{{ $answer->ANS3 }}"><span>{{ $answer->ANS3 }}</span>
                        </div>
                        <div class="answer">
                            <input type="radio" name="{{ $answer->K_ID }}"
                                value="{{ $answer->K_ID }}:{{ $answer->ANS4 }}"><span>{{ $answer->ANS4 }}</span>
                        </div>

                        {{-- Các phần tử câu trả lời khác --}}
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endforeach
@php
    $count = 0;
@endphp
