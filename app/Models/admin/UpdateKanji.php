<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateKanji extends Model
{
    use HasFactory;

    public function updateDataKanji($kanjiId, $data)
    {
        try {
            $kanji = DB::table('kanji')->where('id', $kanjiId);

            if ($kanji->exists()) {
                // Chỉ cập nhật các trường tồn tại trong bảng
                $updateData = Arr::only($data, ['kanji', 'kanji_svg', 'kunyomi', 'onyomi', 'mean']);
                $kanji->update($updateData);
            } else {
                throw new \Exception("No Kanji found with ID: $kanjiId");
            }
        } catch (\Exception $e) {
            // Xử lý lỗi tại đây, có thể ghi log lỗi
            throw $e;
        }
    }
}
