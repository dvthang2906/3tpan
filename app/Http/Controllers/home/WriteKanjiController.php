<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\kanji\kanji;
use Illuminate\Http\Request;

class WriteKanjiController extends Controller
{
    //
    public function index(kanji $kanji)
    {
        $dataKanji = $kanji->getDataKanji();


        return view('home.kanji.write_kanji', compact('dataKanji'));
    }
}
