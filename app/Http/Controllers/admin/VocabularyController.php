<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    //
    public function showVocabulary(Request $request, Vocabulary $vocabulary)
    {
        $data = $vocabulary->getListVocabulary();
        // dd($data->links());

        // if ($request->has('searchTerm')) {
        //     $searchTerm = $request->searchTerm;
        //     $query->where('tango', 'like', '%' . $searchTerm . '%');
        //     // Bạn có thể thêm nhiều điều kiện tìm kiếm khác nếu muốn
        // }

        return view('admin.data.showVocabulary', compact('data'));
    }

    public function createVocabulary()
    {
    }

    public function updateVocabulary()
    {
    }

    public function deleteVocabulary()
    {
    }
}
