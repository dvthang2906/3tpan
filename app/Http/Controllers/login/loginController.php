<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\HomeRecommendation;
use App\Models\SingupUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class loginController extends Controller
{

    public function index(Request $request, HomeRecommendation $homeRecommendation)
    {


        $userName = $request->userName;

        $pass = Hash::make($request->password);


        $user_login = DB::select('SELECT * FROM login_infomation WHERE user = ?', [$userName]);

        if (count($user_login) === 0) {
            // Không có dữ liệu trả về từ cơ sở dữ liệu
            $request->session()->flash('msg', 'bạn đã nhập sai tài khoản');
            // $request->session()->flash('userName', $userName);
            // dd(session('userName'));
            return redirect()->back()->withInput();
        } else {
            // Có dữ liệu trả về từ cơ sở dữ liệu
            if ($user_login[0]->user == $userName && !Hash::check($user_login[0]->password, $pass)) {
                $request->session()->flash('msg', 'bạn đã nhập sai mật khẩu!');
                return redirect()->back()->withInput();
            } else {
                $user_id = $user_login[0]->id;
                session()->put('username', $userName);
                session()->put('user_id', $user_id);
                session()->put('login_status', 'logined');
                //単語。おすすめ
                $recommendWord = $homeRecommendation->Recommendation();
                // dd($recommendWord);

                return view('home.home', compact('user_login', 'recommendWord'));
            }
        }
    }


    // public function Signup()
    // {

    //     return view('users.signup');
    // }


    public function postSingup(Request $request)
    {

        $fullname = $request->fullname;
        $userName = $request->UserName;
        $pass = $request->password;
        $pass1 = $request->password1;
        $email = $request->email;


        if ($pass !=  $pass1) {
            return redirect()->route('login')->with('msgSingup', 'KIEM TRA PASS KHONG TRUNG NHAU')->withInput();
        }


        // Tạo một token ngẫu nhiên
        $rememberToken = Str::random(60);

        $relus = [
            'fullname' => 'required',
            'UserName' => 'required|unique:login_infomation,user',
            'password' => 'required|min:6',
            'email' => 'required|email'
        ];

        $message = [
            'fullname.required' => '入力が必要',
            // 'fullname.regex' => '半角英数字で入力してください',
            'UserName.required' => '入力が必要',
            'UserName.unique' => '名前はすでに存在します。',
            'password.required' => '入力が必要',
            'password.min' => '最低６文字入力してください。',
            'email.required' => '入力が必要',
            'email.email' => 'メールアドレスを正しく入力してください',
        ];


        $request->validate($relus, $message);

        $dataInsert = [
            $fullname,
            $userName,
            $pass,
            $email,
            now()->format('Y-m-d H:i:s'),
            now()->format('Y-m-d H:i:s'),
            $rememberToken,
        ];



        $singup = new SingupUser();

        $singup->SingupUser($dataInsert);


        return redirect()->route('login')->with('msgSingup', 'ユーザーを登録できました。')->withInput();
    }


    public function forgotPassword()
    {
        return view('login.forgotPassword');
    }



    public function loguot()
    {
        // // Đăng xuất người dùng
        Session::flush(); // Xóa tất cả các biến session

        // Session::forget('username'); // Xóa biến session 'userName'

        // Sau khi đăng xuất, bạn có thể thực hiện các hành động khác, chẳng hạn chuyển hướng đến trang đăng nhập hoặc trang chính
        return redirect('/login');
    }
}
