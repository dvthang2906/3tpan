<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\succsessLevel;
use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    protected $level;

    public function test(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return view('home.test');
        }

        return "bạn cần đăng nhập; <a href=\"" . route('login') . "\">Đăng nhập</a>";
    }

    public function postLevel(Request $request)
    {
        $level = $request->input('level');
        $this->level = $level;

        return response()->json(['level' => $level]);
    }

    public function postTest(Request $request, test $test, succsessLevel $succsessLevel)
    {
        $user_id = session('user_id');
        $totalCount = session('totalCount', 0);


        // Gọi hàm processTestData để xử lý dữ liệu và lấy các thông tin cần thiết
        list($count, $countFalse, $falseMondai, $incorrectAnswerIds) = $this->processTestData($request->all(), $test);

        // Tính toán kết quả
        $result = $this->calculateResult($count, $totalCount);

        // Tạo thông điệp dựa trên kết quả
        $message = $this->generateMessage($result, $succsessLevel, $this->level, $user_id);

        // Trả về phản hồi JSON
        return response()->json([
            'result' => $result,
            'message' => $message,
            'status' => $countFalse > 0,
            'falseMondai' => $falseMondai,
            'countFalse' => $countFalse,
            'incorrectAnswerIds' => $incorrectAnswerIds // Mảng ID của các câu trả lời sai
        ]);
    }



    private function processTestData($data, $test)
    {
        $count = 0;
        $countFalse = 0;
        $falseMondai = '';
        $incorrectAnswerIds = []; // Mảng để lưu trữ các ID câu trả lời sai

        foreach ($data as $key => $value) {
            // Giả sử $key là ID của câu hỏi và $value là giá trị của câu trả lời
            // Bạn cần điều chỉnh logic này cho phù hợp với cấu trúc dữ liệu của bạn

            if ($test->check_test($key, $value) == 0) {
                // Câu trả lời sai
                $falseMondai = $value; // Lưu trữ câu trả lời sai
                $countFalse++; // Tăng số lượng câu trả lời sai
                $incorrectAnswerIds[] = "answer-{$key}-{$value}"; // Tạo và thêm ID vào mảng
            } else {
                // Câu trả lời đúng
                $count++; // Tăng số lượng câu trả lời đúng
            }
        }

        return [$count, $countFalse, $falseMondai, $incorrectAnswerIds];
    }



    private function calculateResult($count, $totalCount)
    {
        return $totalCount > 0 ? floor((100 / $totalCount) * $count) : 0;
    }

    private function generateMessage($result, $succsessLevel, $level, $user_id)
    {
        return $result >= 20 ? $succsessLevel->checkLevel($level, $user_id) : '';
    }
}
