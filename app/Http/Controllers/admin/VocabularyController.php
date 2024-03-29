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
        $searchTerm = '';
        $data = $vocabulary->getListVocabulary($searchTerm);

        return view('admin.data.showVocabulary', compact('data'));
    }

    public function findByLevel(Request $request, Vocabulary $vocabulary)
    {
        $level = $request->level;
        $searchTerm = $request->searchTerm;
        session()->flashInput($request->input());

        // dd($request->all());

        if ($searchTerm == null) {
            $searchTerm = '';
        }

        if ($level == null) {
            $data = $vocabulary->getListVocabulary($searchTerm);
            // dd($data);
        } else {

            $data = $vocabulary->findByLevel($level, $searchTerm);
        }


        if ($data->isEmpty()) {
            session()->flash('msg', '該当データが無し');

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
        Log::info($request->stt);
        $stt = $request->stt;

        if ($vocabulary->deleteVocabulary($stt)) {
            return response()->json(['message' => 'deleted successfully']);
        }

        return response()->json(['message' => 'deleted failed']);
    }
}
