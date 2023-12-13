<?php

namespace App\Helpers;

use App\Models\news\getFullTangoModel;
use Illuminate\Support\Facades\Log;

class FuriganaHelper
{

    function addFurigana($text)
    {
        $SetTango = new getFullTangoModel();
        $kanjiRegex = '/[\x{4E00}-\x{9FBF}]+/u';
        preg_match_all($kanjiRegex, $text, $matches);
        $numberOfMatches = count($matches[0]);
        $wordsWithFurigana = [];

        for ($i = 0; $i < $numberOfMatches; $i++) {
            $tangoCollection = $SetTango->getFullTango($matches[0][$i]);
            if ($tangoCollection->isNotEmpty()) {
                $tango = $tangoCollection->first();
                $wordsWithFurigana[$tango->kanji] = $tango->hiragana;
            }
        }
        // Log::info($matches[0]);

        // Sắp xếp từ dài xuống ngắn
        uksort($wordsWithFurigana, function ($a, $b) {
            return mb_strlen($b) - mb_strlen($a);
        });

        $text = preg_replace_callback($kanjiRegex, function ($matches) use ($wordsWithFurigana) {
            $kanji = $matches[0];
            // Kiểm tra xem từ Kanji có tồn tại trong mảng $wordsWithFurigana hay không
            if (isset($wordsWithFurigana[$kanji])) {
                return "<ruby>{$kanji}<rt>{$wordsWithFurigana[$kanji]}</rt></ruby>";
            }
            // Nếu không tồn tại, trả về từ gốc
            return $kanji;
        }, $text);

        return $text;
    }
}
