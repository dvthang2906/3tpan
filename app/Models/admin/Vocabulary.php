<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            ->orderBy('stt', 'desc')
            ->paginate(20);

        return $data;
    }
}