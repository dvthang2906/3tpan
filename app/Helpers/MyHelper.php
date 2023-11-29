<?php

namespace App\Helpers;

class MyHelper
{
    public static function highlightKanji($text)
    {
        $kanjiCount = 0; // Khởi tạo biến đếm

        $convertNumberToSymbol = function ($number) {
            $base = 0x2460; // Cơ sở cho ký hiệu ①, ②, ③,...
            return '&#' . (string)($base + $number - 1) . ';';
        };

        $kanjiPattern = '/[\x{4E00}-\x{9FAF}]+/u';
        return preg_replace_callback($kanjiPattern, function ($matches) use (&$kanjiCount, $convertNumberToSymbol) {
            // Tăng biến đếm và chuyển đổi nó thành ký hiệu
            $symbol = $convertNumberToSymbol(++$kanjiCount);
            return "<span>$symbol</span><span style='text-decoration: underline; margin: 0px 3px;'>"  . $matches[0] . "</span>";
        }, $text);
    }


    public static function convertNumberToSymbol($number)
    {
        $base = 0x2460; // Cơ sở cho ký hiệu ①, ②, ③,...
        return '&#' . (string)($base + $number - 1) . ';';
    }
}
