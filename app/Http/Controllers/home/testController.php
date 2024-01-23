<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\succsessLevel;
use App\Models\test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class testController extends Controller
{
    protected $level;
    //số điểm đỗ.
    protected $succsessScore = 60;

    public function __construct()
    {
    }

    public function test(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return view('home.test');
        }

        session()->flash('status', 'ログインしてください！！！');
        return view('login.login');
    }

    public function postLevel(Request $request)
    {
        $level = $request->input('level');

        $request->session()->put('level', $level);

        return response()->json(['level' => $level]);
    }

    public function postTest(Request $request, test $test, succsessLevel $succsessLevel)
    {
        $user_id = session('user_id');
        $totalCount = session('totalCount', 0);
        // $total = count($request->all()); // tổng tất cả câu người dùng đã làm

        // Cập nhật $this->level trong mỗi yêu cầu
        $this->updateLevelFromSession();

        // Gọi hàm processTestData để xử lý dữ liệu và lấy các thông tin cần thiết
        list($count, $countFalse, $falseMondai, $trueMondai, $incorrectAnswerIds, $incorrectAnswerTrueIds) = $this->processTestData($request->all(), $test, $this->level);

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
            'trueMondai' => $trueMondai,
            'countFalse' => $countFalse,
            // 'total' => $total,
            'totalCount' => $totalCount,
            'incorrectAnswerIds' => $incorrectAnswerIds, // Mảng ID của các câu trả lời sai
            'incorrectAnswerTrueIds' => $incorrectAnswerTrueIds,
        ]);
    }



    private function processTestData($data, $test, $level)
    {
        $count = 0;
        $countFalse = 0;
        $falseMondai = '';
        $trueMondai = '';
        $incorrectAnswerIds = []; // Mảng để lưu trữ các ID câu trả lời sai
        $incorrectAnswerTrueIds = []; // Mảng để lưu trữ các ID câu trả lời đúng

        foreach ($data as $key => $value) {
            if ($test->check_test($key, $value, $level) == 0) {
                // Câu trả lời sai
                $falseMondai = $value; // Lưu trữ câu trả lời sai
                $countFalse++; // Tăng số lượng câu trả lời sai
                $incorrectAnswerIds[] = "answer-{$key}-{$value}"; // Tạo và thêm ID vào mảng
            } else {
                // Câu trả lời đúng
                $trueMondai = $value;
                $incorrectAnswerTrueIds[] = "answer-{$key}-{$value}"; // T
                $count++; // Tăng số lượng câu trả lời đúng
            }
        }

        return [$count, $countFalse, $falseMondai, $trueMondai, $incorrectAnswerIds, $incorrectAnswerTrueIds];
    }



    private function calculateResult($count, $totalCount)
    {
        return $totalCount > 0 ? floor((100 / $totalCount) * $count) : 0;
    }

    private function generateMessage($result, $succsessLevel, $level, $user_id)
    {
        return $result >= $this->succsessScore ? $succsessLevel->checkLevel($level, $user_id) : '';
    }

    private function updateLevelFromSession()
    {
        if (Session::has('level')) {
            $this->level = Session::get('level');
        }
    }
}
