<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class test extends Model
{
    use HasFactory;

    public function test_mondai($category)
    {
        $test_mondai = DB::table('test_mondai')
            ->select()
            ->where('LEVER', 'N4')
            ->where('CATEGORY', $category)
            ->get();

        return $test_mondai;
    }
}
