<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\CountFullTango;
use App\Models\Flashcard;
use App\Models\ReviewLearned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ReviewLearnedFlashcard;

class FlashCardController extends Controller
{
    //
    protected $currentFlashcard;
    protected $user_id;
    protected $level;



    public function index(CountFullTango $CountFullTango, Request $request, ReviewLearned $reviewLearned, Flashcard $flashcards)
    {

        $currentFlashcard = session('currentFlashcard');


        if ($request->session()->has('user_id')) {
            $user_id = $this->user_id = session('user_id');
            $this->level = DB::table('login_infomation')->select('level')->where('id', $this->user_id)->get();
            $userLevel = $this->level[0]->level;


            // ... các xử lý khác ...
            $getFlashcards  = $flashcards->getTangoFlashcard($this->user_id, $userLevel);
            $count = count($getFlashcards);

            // dd($getFlashcards);

            //lấy tổng từ vựng
            $ReviewLearned  = $reviewLearned->ReviewLearned($this->user_id);
            $ReviewLearnedFlashcard  = $reviewLearned->ReviewLearnedFlashcard($this->user_id);


            if (!empty($ReviewLearnedFlashcard[0])) {
                $lever = $ReviewLearnedFlashcard[0]->lever;


                $countVocabulary = $CountFullTango->getCountVocabulary($lever);
                $totalLearnedCount = count($ReviewLearned);


                return view('home.flashcard', compact('getFlashcards', 'count', 'countVocabulary', 'totalLearnedCount'));
            }
            return  view('home.flashcard', compact('getFlashcards', 'count'));
        } else {
            session()->flash('status', 'ログインしてください！！！');
            return view('login.login');
        }
    }


    public function updateLearnedStatus(Request $request)
    {

        $stt = $request->input('stt');
        session()->put('stt', $stt);

        $countJson = $request->input('count');
        session()->put('count', $countJson);


        $user_id = session('user_id');

        // Cập nhật trạng thái từ vựng là đã học
        DB::table('user_vocabulary')
            ->where('user_id', $user_id)
            ->where('vocabulary_id', $stt)
            ->update(['learned' => true]);

        // Trả về kết quả
        return response()->json(['message' => 'Từ vựng đã được cập nhật là đã học.']);
    }

    public function deleteLearnedVocabulary(Request $request)
    {
        $stt_delete = $request->input('stt');
        session()->put('stt_delete', $stt_delete);

        $user_id = session('user_id');

        // Log giá trị để kiểm tra
        // Log::info('STT Delete: ' . $stt_delete);
        // Log::info('User ID: ' . $user_id);


        DB::table('user_vocabulary')
            ->where('user_id', $user_id)
            ->where('vocabulary_id', $stt_delete)
            ->delete();

        return response()->json(['message' => 'Từ vựng đã được xóa khỏi danh sách']);
    }


    public function ReviewLearned(CountFullTango $countFullTango, ReviewLearned $reviewLearned, Request $request)
    {
        // session(['status' => false]);

        if ($request->session()->has('user_id')) {
            $user_id = $this->user_id = session('user_id');
            // ... các xử lý khác ...
            $ReviewLearned  = $reviewLearned->ReviewLearned($this->user_id);

            $ReviewLearnedFlashcard  = $reviewLearned->ReviewLearnedFlashcard($this->user_id);


            if (!empty($ReviewLearnedFlashcard[0])) {
                $lever = $ReviewLearnedFlashcard[0]->lever;
                $count = $countFullTango->getCountVocabulary($lever);
                $totalLearnedCount = count($ReviewLearned);

                return view('home.ReviewLearned', compact('ReviewLearned', 'ReviewLearnedFlashcard', 'count', 'totalLearnedCount'));
            } else {
                return view('home.ReviewLearned')->with('msg', 'bạn đã học hết tất cả từ vựng.....Chúc mừng bạn!!!');
            }
        }
    }


    // public function ReviewLearnedFlashcard(Request $request, ReviewLearned $reviewLearned)
    // {


    //     if ($request->session()->has('user_id')) {
    //         $user_id = $this->user_id = session('user_id');
    //         // ... các xử lý khác ...
    //         $ReviewLearnedFlashcard  = $reviewLearned->ReviewLearnedFlashcard($this->user_id);

    //         dd($ReviewLearnedFlashcard);

    //         return view('home.ReviewLearned', compact('ReviewLearnedFlashcard'));
    //     }
    // }


    public function updateStatus(Request $request)
    {
        $status = $request->input('status');
        session()->put('status', $status);

        // Trả về kết quả
        return response()->json(['message' => 'đã đổi status']);
    }
}
