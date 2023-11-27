<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

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

    public function test_question()
    {
        $test_question = DB::table('test_question')
            ->select()
            ->get();

        return $test_question;
    }

    public function test_answer()
    {
        $test_answer = DB::table('test_answer')
            ->select()
            ->get();

        return $test_answer;
    }

    public function check_test($key, $value)
    {
        $count = 0;

        $sample_results = DB::table('test_answer')
            ->select('CORRECT')
            ->where('K_ID', $key)
            ->get();

        //so sanh ket qua
        if ($sample_results[0]->CORRECT == $value) {
            $count++;
        }
        // else {

        //      $sample_results[0]->K_ID;
        // }

        return $count;
    }
}
