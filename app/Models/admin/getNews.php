<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class getNews extends Model
{
    use HasFactory;
    // Bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'news';

    // Các cột trong bảng mà bạn có thể gán hàng loạt
    protected $fillable = ['title', 'content', 'images', 'audio'];

    // Nếu bạn không muốn Laravel tự động quản lý các cột timestamps
    public $timestamps = false;

    public function getDataNews()
    {
        $data = DB::table('news')
            ->select()
            ->get();

        return $data;
    }


    public function insertdata($data)
    {
        try {
            DB::table($this->table)
                ->insert($data);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
