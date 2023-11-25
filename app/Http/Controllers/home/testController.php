<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test(Request $request, test $test)
    {
        if ($request->session()->has('user_id')) {
            // $test_mondai = $test->test_mondai();

            return view('home.test');
        }


        return "bạn cần đăng nhập; <a href=\"" . route('login') . "\">Đăng nhập</a>";
    }
}
