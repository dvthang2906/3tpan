<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ResetPassword extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'login_infomation'; // Đặt tên bảng cụ thể

    // Các thuộc tính cần thiết
    // protected $fillable = [
    //     'email',
    //     'token',

    // ];

    protected $fillable = [
        'user',
        'fullnameUser',
        'password',
        'email',
        'images',
        'admin',
        'token',
    ];


    public function isAdmin()
    {
        return $this->admin == 1; // Giả sử 1 là giá trị cho admin
    }
}
