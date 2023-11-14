<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TangoComment extends Model
{
    use HasFactory;

    public function getComment($tango)
    {

        DB::enableQueryLog();
        $comment = DB::table('tango_comment')
            ->select('user', 'comment', 'created_time')
            ->where('tango', $tango)
            ->get();

        // $sql = DB::getQueryLog();
        // dd($sql);
        return $comment;
    }
}
