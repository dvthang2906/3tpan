<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    //
    public function showResetForm($token)
    {
        return view('login.password.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Xác nhận token và email
        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        // Cập nhật mật khẩu trong bảng 'login_information'
        $user = DB::table('login_infomation')->where('email', $request->email)->first();

        if ($user) {
            DB::table('login_infomation')
                ->where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            // Xóa bản ghi token sau khi hoàn tất
            DB::table('password_resets')->where('email', $request->email)->delete();

            event(new PasswordReset($user));

            return redirect()->route('login')->with('status', 'Mật khẩu đã được đặt lại thành công.');
        }

        return back()->withErrors(['email' => 'Không tìm thấy người dùng.']);
    }
}
