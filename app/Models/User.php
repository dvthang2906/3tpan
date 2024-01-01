<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // Chỉ định tên bảng cơ sở dữ liệu
    protected $table = 'login_infomation';
    // Sử dụng tên cột tùy chỉnh cho timestamp
    const CREATED_AT = 'created_time';

    // Tắt tính năng cập nhật tự động cho cột updated_at
    const UPDATED_AT = null;

    // /**
    //  * Override phương thức username để sử dụng cột 'user'.
    //  *
    //  * @return string
    //  */
    // public function username()
    // {
    //     return 'user';
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user',
        'fullnameUser',
        'password',
        'email',
        'images',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdministrator()
    {
        return $this->admin == 1; // Giả sử 1 là giá trị cho admin
    }
}
