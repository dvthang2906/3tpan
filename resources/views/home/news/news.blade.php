@extends('clients.client')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">
@endsection


@section('content')
    @livewire('news-livewire')
    <div>fotte</div>
    <div>fotte</div>
    <div>fotte</div>
@endsection

@livewireScripts
@section('js')
    <script src="{{ asset('js/news.js') }}"></script>
@endsection
