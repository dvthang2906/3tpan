<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoiceController extends Controller
{
    public function pronunciation(Request $request)
    {

        if ($request->session()->has('user_id')) {
            return view('home.pronunciation');
        }

        return "bạn cần đăng nhập; <a href=\"" . route('login') . "\">Đăng nhập</a>";
    }
}
