<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class succsessLevel extends Model
{
    use HasFactory;

    public function checkLevel($level, $user_id)
    {
        DB::table('login_infomation')
            ->where('id', $user_id)
            ->update(['level' => $level]);

        return [
            'message' => $level . 'に合格しました。<br>おめでとうございます！',
        ];
    }
}
