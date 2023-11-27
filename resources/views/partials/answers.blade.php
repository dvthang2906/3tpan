@foreach ($answers as $answer)
    @if ($answer->K_ID == $questionId)
        <div class="answer">
            <input type="radio" name="{{ $answer->K_ID }}" id="answer_{{ $answer->K_ID }}_1"
                value="{{ $answer->K_ID }}:{{ $answer->ANS1 }}"><span>{{ $answer->ANS1 }}</span>
        </div>
        <div class="answer">
            <input type="radio" name="{{ $answer->K_ID }}" id="answer_{{ $answer->K_ID }}_2"
                value="{{ $answer->K_ID }}:{{ $answer->ANS2 }}"><span>{{ $answer->ANS2 }}</span>
        </div>
        <div class="answer">
            <input type="radio" name="{{ $answer->K_ID }}" id="answer_{{ $answer->K_ID }}_3"
                value="{{ $answer->K_ID }}:{{ $answer->ANS3 }}"><span>{{ $answer->ANS3 }}</span>
        </div>
        <div class="answer">
            <input type="radio" name="{{ $answer->K_ID }}" id="answer_{{ $answer->K_ID }}_4"
                value="{{ $answer->K_ID }}:{{ $answer->ANS4 }}"><span>{{ $answer->ANS4 }}</span>
        </div>
    @endif
@endforeach
