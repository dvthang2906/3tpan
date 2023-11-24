<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class test extends Model
{
    use HasFactory;

    public function test_mondai()
    {
        $test_mondai = DB::table('test_mondai')
            ->select()
            ->where('CATEGORY', 'kanji')
            ->get();

        return $test_mondai;
    }
}
