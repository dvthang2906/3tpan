<div>
    {{-- <button wire:click="updateCategory('vocabulary')">Vocabulary</button>
    <button wire:click="updateCategory('kanji')">Kanji</button>
    <button wire:click="updateCategory('grammar')">Grammar</button> --}}
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="contents">
        <ul class="nav_t">
            <li><a href="#">N1</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N2</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N3</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">01</a></li>
                            <li><a href="#" style="margin-left: 5px">02</a></li>
                            <li><a href="#" style="margin-left: 5px">03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">01</a></li>
                            <li><a href="#" style="margin-left: 5px">02</a></li>
                            <li><a href="#" style="margin-left: 5px">03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a>N4</a>
                <ul>
                    <li><a style="margin-left: 5px">Kanji</a>
                        <ul>
                            <li><a style="margin-left: 5px" wire:click="updateCategory('kanji')">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                    <li><a style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a style="margin-left: 5px" wire:click="updateCategory('vocabulary')">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                    <li><a style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a style="margin-left: 5px" wire:click="updateCategory('grammar')">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N5</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
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
                <div class="question">
                    <p>問{{ $key + 1 }}：{{ $mondai->QUIZ }}</p>
                    <div class="kanji-box"><span class="kanji">今日</span>
                        <div class="ans">
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <input type="text" class="answer_tf"><span></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>


    </div>
