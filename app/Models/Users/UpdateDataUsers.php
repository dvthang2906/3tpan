<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateDataUsers extends Model
{
    use HasFactory;
    public function updateDataUser($field, $userID, $newValue)
    {
        DB::table('login_infomation')
            ->where('id', '=', $userID)
            ->update([$field => $newValue]);
    }
}
