<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

class Flashcard extends Model
{


    use HasFactory;


    public function getTangoFlashcard($user_id)
    {
        DB::enableQueryLog();



        // if(!Schema::hasTable('3tpandb.user_vocabulary')) {
        //     return redirect()->route('flashcards')->with('msg', 'flashcard存在してない。');
        // }

        // Kiểm tra xem người dùng đã học hết các từ trong bảng flashcard hiện tại chưa
        $unlearnedCount = DB::table('user_vocabulary')
            ->where('user_id', $user_id)
            ->where('learned', false) // Kiểm tra xem từ đã được đánh dấu là đã học chưa
            ->count();

        // Nếu không còn từ nào chưa được học, cho phép tạo bảng flashcard mới
        if ($unlearnedCount === 0) {
            // Đặt logic tạo flashcard mới ở đây
            $newFlashcards = DB::table('vocabulary')
                ->inRandomOrder()
                ->limit(10)
                ->get();

            foreach ($newFlashcards as $flashcard) {
                DB::table('user_vocabulary')->insert([
                    'user_id' => $user_id,
                    'vocabulary_id' => $flashcard->stt,
                    'learned' => false // hoặc 0, tùy vào kiểu dữ liệu của cột 'learned'
                    // Thêm các trường khác nếu cần
                ]);
            }
        } else {
            // Hiển thị thông báo cho người dùng rằng họ cần hoàn thành việc học các từ hiện tại trước
            // echo "Bạn cần hoàn thành học các từ trong bảng flashcard hiện tại trước khi tạo mới.";
        }




        // lấy từ vựng trong bảng vocabulary
        $flashcards = DB::table('user_vocabulary')
            ->join('vocabulary', 'user_vocabulary.vocabulary_id', '=', 'vocabulary.stt')
            ->where('user_vocabulary.user_id', $user_id)
            ->where('user_vocabulary.learned', false) // Nếu bạn chỉ muốn lấy các từ chưa được học
            ->orderByDesc('user_vocabulary.created_at') // Giả sử bạn có trường `created_at`
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
