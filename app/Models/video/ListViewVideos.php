<?php

namespace App\Models\video;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ListViewVideos extends Model
{
    use HasFactory;

    public function VideoList()
    {
        $Videolist = DB::table('videos')
            ->select()
            ->get();
        return $Videolist;
    }
}
