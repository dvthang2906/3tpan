<?php

namespace App\Http\Controllers;

use App\Models\HomeRecommendation;
use App\Models\TangoComment;
use App\Services\JishoService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class JishoController extends Controller
{

    private $tangoCmt;
    public function __construct()
    {
        $this->tangoCmt = new TangoComment();
    }

    public function jishoSearch()
    {
        // Thực hiện tìm kiếm dựa trên giá trị $value
        $results = [];


        // Trả về view với kết quả tìm kiếm
        return view('home.home', compact('results'));
    }

    public function postJishoSearch(HomeRecommendation $homeRecommendation, Request $request, JishoService $jishoService)
    {

        if (!empty($request->value)) {
            // Lấy giá trị từ form
            $tangoValue = $request->value;


            //単語。おすすめ
            $recommendWord = $homeRecommendation->Recommendation();

            // tìm từ vựng đơn
            $result = $jishoService->search($tangoValue)['data'];

            if (empty($result)) {
                return view('home.home', compact('tangoValue', 'recommendWord'));
            }

            // dd($result);
            if (isset($result[0]['japanese'][0]['word'])) {
                $tango_Value_Comment = $result[0]['japanese'][0]['word'];
            } else {
                // Xử lý trường hợp 'word' không tồn tại
                // Ví dụ: bạn có thể gán một giá trị mặc định hoặc xử lý lỗi tại đây
                $tango_Value_Comment = $tango_Value_Comment = $result[0]['japanese'][0]['reading'];
            }


            session()->put('tangoValue', $tango_Value_Comment);


            $comment = $this->tangoCmt->getComment($tango_Value_Comment);

            $imi = $result[0]['senses'][0]['english_definitions'];
            $imiString = implode(' ', $imi);
        } else {
            if ($request->has('value')) {
                $request->request->remove('value'); // Xóa giá trị
                return redirect()->route('home');
            }
            return view('home.home');
        }

        // Trả về view với kết quả tìm kiếm
        return view('home.home', compact('result', 'tangoValue', 'imiString', 'comment', 'recommendWord'));
    }


    //buttom Comment
    public function postAddComment(Request $request)
    {
        $commentText = $request->input('commentText');
        $tangoValue = session('tangoValue');
        $userName = session()->get('username');
        $formattedTime = now()->format('Y-m-d H:i');



        DB::table('tango_comment')->insert([
            'user' => $userName,
            'tango' => $tangoValue,
            'comment' => $commentText,
            'created_time' => $formattedTime,
        ]);

        // Trả về phản hồi JSON (có thể là JSON hoặc bất kỳ dạng dữ liệu nào bạn cần)
        return response()->json([
            'user' => $userName,
            'tango' => $tangoValue,
            'comment' => $commentText,
            'created_time' => $formattedTime,
        ]);
    }
}
