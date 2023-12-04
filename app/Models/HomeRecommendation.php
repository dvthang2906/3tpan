<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeRecommendation extends Model
{
    use HasFactory;

    public function Recommendation()
    {
        // nhập số dòng muốn hiển thị
        $count = 5;

        if (session('login_status') == 'logined') {
            if (session('user_id')) {
                $user_id = session('user_id');


                $level = DB::table('login_infomation')
                    ->select('level')
                    ->where('id', $user_id)
                    ->get();

                $vocabulary = DB::table('vocabulary')
                    ->where('lever', $level[0]->level)
                    ->inRandomOrder()
                    ->limit($count)
                    ->get();

                return $vocabulary;
            }
        }
    }
}
