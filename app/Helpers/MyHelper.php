<?php

namespace App\Helpers;

class MyHelper
{
    public static function highlightKanji($text)
    {
        $kanjiPattern = '/[\x{4E00}-\x{9FAF}]+/u';
        return preg_replace_callback($kanjiPattern, function ($matches) {
            // Sử dụng 'text-decoration' để thêm gạch chân
            return "<span style='text-decoration: underline; margin: 0px 3px;'>" . $matches[0] . "</span>";
        }, $text);
    }
}
