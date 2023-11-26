@php
    $count = 0;
@endphp
<div>
    {{-- <button wire:click="updateCategory('vocabulary')">Vocabulary</button>
    <button wire:click="updateCategory('kanji')">Kanji</button>
    <button wire:click="updateCategory('grammar')">Grammar</button> --}}
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="contents">
        <ul class="nav_t">

            @for ($i = 1; $i <= 5; $i++)
                <li><a>N{{ $i }}</a>
                    <ul>
                        <li><a style="margin-left: 5px">Kanji</a>
                            <ul>
                                <li><a style="margin-left: 5px" wire:click="updateCategory('kanji')">コード番号01</a></li>
                                {{-- <li><a style="margin-left: 5px">コード番号02</a></li> --}}
                            </ul>
                        </li>
                        <li><a style="margin-left: 5px">Vocabulary</a>
                            <ul>
                                <li><a style="margin-left: 5px" wire:click="updateCategory('vocabulary')">コード番号01</a></li>
                                {{-- <li><a style="margin-left: 5px">コード番号02</a></li> --}}
                            </ul>
                        </li>
                        <li><a style="margin-left: 5px">Grammar</a>
                            <ul>
                                <li><a style="margin-left: 5px" wire:click="updateCategory('grammar')">コード番号01</a></li>
                                {{-- <li><a style="margin-left: 5px">コード番号02</a></li> --}}
                            </ul>
                        </li>
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
                            @endphp
                            <div class="kanji-box"><span class="kanji">{{ $count }}:
                                    {{ $question->KANJI }}</span>
                                <div class="ans">
                                    @foreach ($test_answer as $answer)
                                        @if ($question->K_ID == $answer->K_ID)
                                            <div class="answer">
                                                <input type="radio" name="q1k1"><span>{{ $answer->ANS1 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="q1k1"><span>{{ $answer->ANS2 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="q1k1"><span>{{ $answer->ANS3 }}</span>
                                            </div>
                                            <div class="answer">
                                                <input type="radio" name="q1k1"><span>{{ $answer->ANS4 }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- <div class="answer">
                                        <input type="radio" name="q1k1"><span></span>
                                    </div>
                                    <div class="answer">
                                        <input type="radio" name="q1k1"><span></span>
                                    </div>
                                    <div class="answer">
                                        <input type="radio" name="q1k1"><span></span>
                                    </div> --}}
                                    {{-- <input type="text" class="answer_tf"><span></span> --}}
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
                                <div class="kanji-box">
                                    <div class="ans">
                                        <div class="answer">
                                            <input type="radio" name="q1k1"><span>{{ $answer->ANS1 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="q1k1"><span>{{ $answer->ANS2 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="q1k1"><span>{{ $answer->ANS3 }}</span>
                                        </div>
                                        <div class="answer">
                                            <input type="radio" name="q1k1"><span>{{ $answer->ANS4 }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </section>


    </div>
