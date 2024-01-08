<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class searchKanji extends Model
{
    use HasFactory;
    public function searchByKanji($criteria, $type)
    {
        // Logic tìm kiếm ở đây
        $result = DB::table('kanji')
            ->select()
            ->where($type, 'like', '%' . $criteria . '%')
            ->get();
        return $result;
    }
}
