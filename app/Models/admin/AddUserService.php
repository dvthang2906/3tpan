<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddUserService extends Model
{
    use HasFactory;
    protected $table = 'login_infomation';

    public function AddUser($data)
    {
        DB::insert(
            'INSERT INTO login_infomation (level, admin, user, fullnameUser, password, email, images, remember_token, created_time, last_updated)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            $data
        );
    }
}
