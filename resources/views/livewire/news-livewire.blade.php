<div class="outer-container">
    <div class="news-container" id="news-container">
        @foreach ($data as $item)
            <div class="news-item">
                <div>
                    <img src="{{ asset('images/' . $item->images) }}" alt="news image">
                    <br>
                    <span style="font-size: 12px;"
                        id="status-{{ $item->id }}">{{ isset($readStatuses[$item->id]) && $readStatuses[$item->id] ? '✔既読' : '' }}</span>
                </div>
                <div class="news-text">
                    <button wire:click="updateNewID({{ $item->id }})">
                        <h2>{{ $item->title }}</h2>
                    </button>
                    <div class="news-footer">
                        <span>{{ $item->created_at }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="content-container">
        @foreach ($DataContent as $dataCt)
            <div style="padding-bottom: 20px;">
                <button id="toggleButton">
                    <img id="activeDot" width="10" height="10" src="{{ asset('images/ic_dot.png') }}"
                        alt="icon" title="active furigana" style="display: none;">
                    <img id="inactiveDot" width="10" height="10" src="{{ asset('images/ic_dot_gray.png') }}"
                        alt="icon" title="no active furigana">
                </button>
                <label class="st-label-furi cl-tt"><b>Furiganaを表示</b></label>
            </div>


            <hr>
            <div style="margin:0; text-align:center">
                <h3 style="margin: 0; padding: 0; display: none;" id="titleFuriganaOn">
                    {!! nl2br(\App\Helpers\FuriganaHelper::addFurigana($dataCt->title)) !!}
                </h3>
                <h3 style="margin: 0px; padding: 0; line-height-top:1em;" id="titleFuriganaOff">
                    {!! nl2br(e($dataCt->title)) !!}
                </h3>
                <p style="margin: 0 ;margin-right: 80px; padding: 0; text-align: right;">{{ $dataCt->updated_at }}</p>
            </div>
            <hr style="margin-top: 0">


            <div style="text-align: center">
                <img src="{{ asset('images/' . $dataCt->images) }}" alt="images" width="80%">
            </div>
            <div style="text-align: center;">
                <audio controls class="full-width-audio" src="{{ asset('audio/' . $dataCt->audio) }}"></audio>
            </div>

            {{-- Paragraphs with Furigana --}}
            <div id="contentFuriganaOn" style="display: none;">
                <p style="text-indent: 20px;" class="japanese-text">
                    {!! nl2br(\App\Helpers\FuriganaHelper::addFurigana($dataCt->content)) !!}
                </p>
            </div>

            {{-- Paragraphs without Furigana --}}
            <div id="contentFuriganaOff">
                <p style="text-indent: 20px;" class="japanese-text">
                    {!! nl2br(e($dataCt->content)) !!}
                </p>
            </div>
        @endforeach
    </div>


</div>
