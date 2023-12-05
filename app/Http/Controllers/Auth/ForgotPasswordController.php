<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class ForgotPasswordController extends Controller
{
    //
    public function sendResetLinkEmail(Request $request)
    {
        // $validator = Validator::make($request->all(), ['email' => 'required|email']);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // dd($request->all());

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return 1;
        } else {
            // Xử lý khi gửi email thất bại
            return 2;
        }
    }
}
