<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Contact extends Model
{
    use HasFactory;

    public function insertContact($data)
    {
        DB::insert(
            'INSERT INTO contact (first_name, last_name, email, country, phone_number, message, created_at, updated_at, remember_token)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            $data
        );
    }
}
