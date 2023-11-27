{{-- partials.other_question --}}
@foreach ($answers as $answer)
    @if ($mondai->Q_ID == $answer->K_ID)
        @php
            $totalCount++;
        @endphp
        <div class="kanji-box">
            <div class="ans">
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
            </div>
        </div>
    @endif
@endforeach
