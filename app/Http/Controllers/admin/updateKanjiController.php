<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UpdateKanji;
use Illuminate\Http\Request;

class updateKanjiController extends Controller
{
    //
    public function update(Request $request, UpdateKanji $updateKanji)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'data.kunyomi' => 'required|string',
            'data.onyomi' => 'required|string',
            'data.mean' => 'required|string',
        ]);

        $kanjiId = $validatedData['id'];
        $data = $validatedData['data'];

        try {
            $updateKanji->updateDataKanji($kanjiId, $data);
            return response()->json(['message' => 'Kanji updated successfully']);
        } catch (\Exception $e) {
            // Xử lý lỗi và ghi log tại đây
            return response()->json(['error' => 'Error updating Kanji'], 500);
        }
    }
}
