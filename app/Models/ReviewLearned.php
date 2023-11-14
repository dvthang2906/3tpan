<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReviewLearned extends Model
{
    use HasFactory;

    public function ReviewLearned($user_id)
    {
        $ReviewLearned_List = DB::table('user_vocabulary')
            ->join('vocabulary', 'user_vocabulary.vocabulary_id', '=', 'vocabulary.stt')
            ->where('user_vocabulary.user_id', $user_id)
            ->where('user_vocabulary.learned', true) // Nếu bạn chỉ muốn lấy các từ chưa được học
            ->orderByDesc('user_vocabulary.updated_at') // Giả sử bạn có trường `created_at`
            ->get([
                'vocabulary.stt',
                'vocabulary.lever', // Đảm bảo tên trường này chính xác
                'vocabulary.tango',
                'vocabulary.romaji',
                'vocabulary.hiragana',
                'vocabulary.type',
                'vocabulary.mean',
                'user_vocabulary.learned',
                'user_vocabulary.created_at' // Nếu bạn muốn hiển thị thời gian khi từ vựng được thêm vào
            ]);

        return $ReviewLearned_List;
    }


    public function ReviewLearnedFlashcard($user_id)
    {
        $flashcards = DB::table('user_vocabulary')
            ->join('vocabulary', 'user_vocabulary.vocabulary_id', '=', 'vocabulary.stt')
            ->where('user_vocabulary.user_id', $user_id)
            ->where('user_vocabulary.learned', true) // Nếu bạn chỉ muốn lấy các từ chưa được học
            ->orderByDesc('user_vocabulary.updated_at') // Giả sử bạn có trường `created_at`
            ->limit(10)
            ->get([
                'vocabulary.stt',
                'vocabulary.lever', // Đảm bảo tên trường này chính xác
                'vocabulary.tango',
                'vocabulary.romaji',
                'vocabulary.hiragana',
                'vocabulary.type',
                'vocabulary.mean',
                'user_vocabulary.learned',
                'user_vocabulary.created_at' // Nếu bạn muốn hiển thị thời gian khi từ vựng được thêm vào
            ]);

        return $flashcards;
    }
}
