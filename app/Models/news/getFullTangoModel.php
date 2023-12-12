<?php

namespace App\Models\news;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class getFullTangoModel extends Model
{
    use HasFactory;

    public function getFullTango($word)
    {
        $FullTango = DB::table('news_hiragana')
            ->select('kanji', 'hiragana')
            ->where('kanji', '=', $word)
            ->get();

        return $FullTango;
    }
}
