<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test(test $test)
    {
        $test_mondai = $test->test_mondai();

        return view('home.test', compact('test_mondai'));
    }
}
