<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserDeletionService extends Model
{
    use HasFactory;

    public function deleteById($userId)
    {
        $deleted = DB::table('login_infomation')
            ->where('id', '=', $userId)
            ->delete();

        return $deleted > 0;
    }
}
