<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SingupUser extends Model
{
    use HasFactory;

    protected $table = 'login_infomation';

    public function SingupUser($data)
    {
        DB::insert(
            'INSERT INTO login_infomation (user, fullnameUser, password, email, created_time, last_updated, remember_token)
            VALUES (?, ?, ?, ?, ?, ?, ?)',
            $data
        );
    }
}
