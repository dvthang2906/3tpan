@php
    $count = 0;
    $totalCount = 0;
@endphp
<div>
    <div class="contents">
        <ul class="nav_t">

            @for ($i = 1; $i <= 5; $i++)
                <li>
                    <a id="level">N{{ $i }}</a>
                    <ul>
                        @foreach (['kanji' => 'Kanji', 'vocabulary' => 'Vocabulary', 'grammar' => 'Grammar'] as $key => $value)
                            <li>
                                <a style="margin-left: 5px">{{ $value }}</a>
                                <ul>
                                    <li><a style="margin-left: 5px"
                                            wire:click="updateCategory('{{ $key }}', 'N{{ $i }}')">コード番号01</a>
                                    </li>
                                    {{-- Example for additional items:
                                <li><a style="margin-left: 5px">コード番号02</a></li>
                                --}}
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endfor


        </ul>
    </div>
    <div class="mogi">
        <header>
            <h1>日本語<span>AAA</span>模擬テスト</h1>
        </header>
        <h2>問題：___ は どう よみますか。４つから １つを えらびなさい。</h2>
        {{-- Nội dung câu hỏi và câu trả lời --}}
        <section class="kj_test scrollable" style="margin: 5px">

            @foreach ($test_mondai as $key => $mondai)
                @if ($mondai->CATEGORY == 'kanji')
                    <p>問{{ $key + 1 }}：{{ $mondai->QUIZ }}</p>
                    @foreach ($test_question as $key_question => $question)
                        @if ($question->Q_ID == $mondai->Q_ID)
                            @php
                                $count++;
                                $totalCount++;
                            @endphp
                            <div class="kanji-box"><span class="kanji">{{ $count }}:
                                    {{ $question->KANJI }}</span>
                                <div class="ans">
                                    @foreach ($test_answer as $answer)
                                        @if ($question->K_ID == $answer->K_ID)
                                            <div class="answer">
                                                <input type="radio" name="{{ $answer->K_ID }}"
                                                    value="{{ $answer->K_ID }}:{{ $answer->ANS1 }}">
                                                <span
                                                    id="answer-{{ $answer->K_ID }}-{{ $answer->ANS1 }}">{{ $answer->ANS1 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="{{ $answer->K_ID }}"
                                                    value="{{ $answer->K_ID }}:{{ $answer->ANS2 }}">
                                                <span
                                                    id="answer-{{ $answer->K_ID }}-{{ $answer->ANS2 }}">{{ $answer->ANS2 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="{{ $answer->K_ID }}"
                                                    value="{{ $answer->K_ID }}:{{ $answer->ANS3 }}">
                                                <span
                                                    id="answer-{{ $answer->K_ID }}-{{ $answer->ANS3 }}">{{ $answer->ANS3 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="{{ $answer->K_ID }}"
                                                    value="{{ $answer->K_ID }}:{{ $answer->ANS4 }}">
                                                <span
                                                    id="answer-{{ $answer->K_ID }}-{{ $answer->ANS4 }}">{{ $answer->ANS4 }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @php
                        $count = 0;
                    @endphp
                @else
                    <div class="question">
                        <p>問{{ $key + 1 }}：{{ $mondai->QUIZ }}</p>
                        @foreach ($test_answer as $answer)
                            @if ($mondai->Q_ID == $answer->K_ID)
                                @php
                                    $totalCount++;
                                @endphp
                                <div class="kanji-box">
                                    <div class="ans">
                                        <div class="answer">
                                            <input type="radio" name="{{ $answer->K_ID }}"
                                                value="{{ $answer->K_ID }}:{{ $answer->ANS1 }}">
                                            <span
                                                id="answer-{{ $answer->K_ID }}-{{ $answer->ANS1 }}">{{ $answer->ANS1 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="{{ $answer->K_ID }}"
                                                value="{{ $answer->K_ID }}:{{ $answer->ANS2 }}">
                                            <span
                                                id="answer-{{ $answer->K_ID }}-{{ $answer->ANS2 }}">{{ $answer->ANS2 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="{{ $answer->K_ID }}"
                                                value="{{ $answer->K_ID }}:{{ $answer->ANS3 }}">
                                            <span
                                                id="answer-{{ $answer->K_ID }}-{{ $answer->ANS3 }}">{{ $answer->ANS3 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="{{ $answer->K_ID }}"
                                                value="{{ $answer->K_ID }}:{{ $answer->ANS4 }}">
                                            <span
                                                id="answer-{{ $answer->K_ID }}-{{ $answer->ANS4 }}">{{ $answer->ANS4 }}</span>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
            @php
                session()->put('totalCount', $totalCount);
            @endphp

        </section>


    </div>

    <div class="check-result">
        <a class="bt_nav" id="CheckButton"><span>CHECK</span></a>
    </div>
    <!-- Bảng thông báo Modal -->
    <div id="myModal" class="modal">
        <!-- Nội dung bảng thông báo -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>試験結果</h2>
            <div id="score"></div>
        </div>
    </div>
