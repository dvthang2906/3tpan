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
                                <a style="margin-left: 42px">{{ $value }}</a>
                                <ul>
                                    <li><a style="margin-left: 80px; margin-top:5px"
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
            <h1>日本語<span>
                    {{-- @hasSection('category') --}}
                    {{ session('category') }}
                    {{-- @endif --}}
                    -{{ session('level') }}
                </span>模擬テスト</h1>
        </header>
        {{-- Nội dung câu hỏi và câu trả lời --}}
        <section class="kj_test scrollable" style="margin: 5px">
            @if (is_array($test_mondai) && count($test_mondai) > 0 && isset($test_mondai[0]->CATEGORY))
                @switch($test_mondai[0]->CATEGORY)
                    @case('kanji')
                        <h2>問題: ____の漢字のよみかたを4つの中から1つを えらびなさい</h2>
                    @break

                    @default
                        <h2>問題: （ ）に入るものを４つの中から１つを えらびなさい</h2>
                @endswitch
            @endif

            @foreach ($test_mondai as $key => $mondai)
                @if ($mondai->CATEGORY == 'kanji')
                    <p>問{{ $key + 1 }}:{!! \App\Helpers\MyHelper::highlightKanji($mondai->QUIZ) !!}
                    </p>
                    @foreach ($test_question as $key_question => $question)
                        @if ($question->Q_ID == $mondai->Q_ID)
                            @php
                                $count++;
                                $totalCount++;
                            @endphp
                            <div class="kanji-box"><span class="kanji">{!! \App\Helpers\MyHelper::convertNumberToSymbol($count) !!}:
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
                        <p>問{{ $key + 1 }}:{{ $mondai->QUIZ }}</p>
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
    <div id="resultModal" class="resultModal">
        <!-- Nội dung bảng thông báo -->
        <div class="modal-result-content">
            <span class="close-result">&times;</span>
            <h2>試験結果</h2>
            <div id="score"></div>
        </div>
    </div>
