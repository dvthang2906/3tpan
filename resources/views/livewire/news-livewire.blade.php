@php
    $status = false;
@endphp
<div class="outer-container">
    <div class="news-container" id="news-container">
        @foreach ($data as $item)
            <div class="news-item">
                <div>
                    <img src="{{ asset('images/' . $item->images) }}" alt="news image">
                    <br>
                    <span style="font-size: 12px;">{{ $status == false ? '' : '✔既読' }}</span>
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
        <p>
            @foreach ($content as $ct)
                <p>{{ $ct->content }}</p>
            @endforeach
        </p>
    </div>

</div>
