<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\succsessLevel;
use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test(Request $request)
    {
        if ($request->session()->has('user_id')) {
            // $test_mondai = $test->test_mondai();

            return view('home.test');
        }


        return "bạn cần đăng nhập; <a href=\"" . route('login') . "\">Đăng nhập</a>";
    }


    public function postTest(Request $request, test $test, succsessLevel $succsessLevel)
    {
        $data = $request->all();
        $processedData = [];
        $result = 0;
        $count = 0;
        $countFalse = 0;
        $totalCount = session('totalCount');
        $user_id = session('user_id');
        $level = 'N4';
        $message = '';
        $status = false;
        $falseMondai = '';

        // Xử lý từng cặp key-value
        foreach ($data as $key => $value) {
            $processedData[] = ["Key" => $key, "Value" => $value];

            $count += $test->check_test($key, $value);
            if ($test->check_test($key, $value) == 0) {
                $status = true;
                $falseMondai = $value;
                $countFalse++;
            }
        }

        $result = floor((100 / $totalCount) * $count);
        if ($result >= 60) {
            $message = $succsessLevel->checkLevel($level, $user_id);
        } else {
            $message = '';
        }

        // Xóa session trước khi trả về response
        // session()->forget('totalCount');

        return response()->json(
            [
                'result' => $result,
                'message' => $message,
                'status' => $status,
                'falseMondai' => $falseMondai,
                'countFalse' => $countFalse,
            ]
        );
    }
}
