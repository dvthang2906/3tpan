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
    protected $fillable = [
        'email', 'token',
    ];

    // Bạn có thể loại bỏ thuộc tính $hidden nếu không cần thiết
}
