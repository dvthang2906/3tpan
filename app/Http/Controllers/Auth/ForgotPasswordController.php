<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\MyCustomResetPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ForgotPasswordController extends Controller
{
    //
    public function sendResetLinkEmail(Request $request)
    {


        $validator = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        session()->put('resetPassword-Email', $request->email);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Xử lý nếu không tìm thấy email
            return 2;
        }

        // Tạo token và lưu vào bảng password_resets
        $token = $request->_token;
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token, // Lưu ý: Bạn cũng có thể lưu token không mã hóa tùy thuộc vào cách bạn xử lý nó sau này
            'created_at' => Carbon::now()
        ]);

        // Gửi email với token
        $user->notify(new MyCustomResetPassword($token));

        return redirect()->route('login')->withErrors($validator)->with('status', 'token đã được gửi đến gmail của bạn');
    }
}
