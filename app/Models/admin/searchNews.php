<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class searchNews extends Model
{
    use HasFactory;
    public function findByNews($startDate, $endDate)
    {
        $data = DB::table('news')
            ->select()
            ->whereDate('created_at', '>=', $startDate)
            ->whewhereDatee('created_at', '<=', $endDate)
            ->get();

        return $data;
    }

    public function findByNewsStartDate($startDate)
    {
        $data = DB::table('news')
            ->select()
            ->whereDate('created_at', '=', $startDate)
            ->get();

        return $data;
    }

    public function findByNewsEndDate($endDate)
    {
        $data = DB::table('news')
            ->select()
            ->whereDate('created_at', '=', $endDate)
            ->get();

        return $data;
    }
}
