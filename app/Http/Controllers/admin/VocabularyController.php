<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class VocabularyController extends Controller
{
    //
    public function showVocabulary(Request $request, Vocabulary $vocabulary)
    {
        $data = $vocabulary->getListVocabulary();

        // if ($request->has('searchTerm')) {
        //     $searchTerm = $request->searchTerm;
        //     $query->where('tango', 'like', '%' . $searchTerm . '%');
        //     // Bạn có thể thêm nhiều điều kiện tìm kiếm khác nếu muốn
        // }

        return view('admin.data.showVocabulary', compact('data'));
    }

    public function findByLevel(Request $request, Vocabulary $vocabulary)
    {
        $level = $request->level;
        session()->flashInput($request->input());

        if ($level == null) {
            $data = $vocabulary->getListVocabulary();
        } else {
            $data = $vocabulary->findByLevel($level);
        }


        if ($data->isEmpty()) {
            session()->flash('msg', '妥当データが無い。');

            return view('admin.data.showVocabulary', compact('data'));
        }

        // dd($data);
        return view('admin.data.showVocabulary', compact('data'));
    }

    public function createVocabulary()
    {
    }

    public function updateVocabulary(Request $request, Vocabulary $vocabulary)
    {
        // Log::info();
        $stt = $request->stt;
        $data = $request->data;
        Log::info($data);
        $vocabulary->updateVocabulary($stt, $data);

        return response()->json(['message' => 'updated successfully', 'data' => $vocabulary]);
    }

    public function deleteVocabulary(Request $request, Vocabulary $vocabulary)
    {
        Log::info($request->all());
    }
}
