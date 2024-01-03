<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class getDataUsers extends Model
{
    use HasFactory;
    public function getDataUsers()
    {
        $dataUsers = DB::table('login_infomation')
            ->select()
            ->get();

        return $dataUsers;
    }
}
