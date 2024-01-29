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
            ->whereDate('created_at', '<=', $endDate)
            ->get();

        return $data;
    }

    public function findByNewsStartDate($startDate)
    {
        $data = DB::table('news')
            ->select()
            ->whereDate('created_at', '>=', $startDate)
            ->orderBy('created_at', 'asc')
            ->get();

        return $data;
    }

    public function findByNewsEndDate($endDate)
    {
        $data = DB::table('news')
            ->select()
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        return $data;
    }
}
