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

    public function getNewContent($id)
    {
        $dataNews = DB::table('news')
            ->select('content')
            ->where('id', $id);

        // In ra câu lệnh SQL và các giá trị được bind
        // $sql = $dataNews->toSql();
        // $bindings = $dataNews->getBindings();
        // // dd($sql, $bindings);
        // // Thực thi truy vấn (nếu cần)
        $content = $dataNews->get();
        // dd($dataNews);

        return $content;
    }
}
