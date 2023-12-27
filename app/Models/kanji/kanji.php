<?php

namespace App\Models\kanji;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kanji extends Model
{
    use HasFactory;
    public function getDataKanji()
    {
        $data = DB::table('kanji')
            ->select()
            ->get();

        return $data;
    }
}
