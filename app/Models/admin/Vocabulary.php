<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Vocabulary extends Model
{
    use HasFactory;
    protected $table = 'vocabulary';

    // Các cột trong bảng mà bạn có thể gán hàng loạt
    protected $fillable = ['lever', 'tango', 'romaji', 'hiragana', 'type', 'mean'];

    // Nếu bạn không muốn Laravel tự động quản lý các cột timestamps
    public $timestamps = false;

    public function getListVocabulary()
    {
        $data = DB::table('vocabulary')
            ->orderBy('stt', 'ASC')
            ->paginate(20);

        return $data;
    }

    public function findByLevel($level)
    {
        $data = DB::table('vocabulary')
            ->where('lever', $level)
            ->orderBy('stt', 'ASC')
            ->paginate(20);

        return $data;
    }

    public function updateVocabulary($stt, $data)
    {
        try {
            // Làm sạch dữ liệu từ mảng $data
            $cleanData = [];
            foreach ($data as $key => $value) {
                // Áp dụng trim() cho từng giá trị trong mảng
                $cleanData[$key] = trim($value);
            }

            $vocabulary = DB::table('vocabulary')->where('stt', $stt);

            if ($vocabulary->exists()) {
                $updateData = Arr::only($cleanData, ['lever', 'tango', 'romaji', 'hiragana', 'type', 'mean']);
                $vocabulary->update($updateData);
            } else {
                throw new \Exception("No Kanji found with ID: $stt");
            }
        } catch (\Exception $e) {
            // Xử lý lỗi tại đây, có thể ghi log lỗi
            throw $e;
        }
    }
}
