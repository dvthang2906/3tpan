<?php

namespace App\Models\news;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class news extends Model
{
    use HasFactory;

    public function getDataNews()
    {
        $data = DB::table('news')
            ->select()
            ->get();

        return $data;
    }
}
