<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\HomeRecommendation;
use App\Models\SingupUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class loginController extends Controller
{
    //BAN GOC KHI KHONG SU DUNG AUTH

    // public function index(Request $request, HomeRecommendation $homeRecommendation)
    // {


    //     $userName = $request->userName;
    //     $pass = $request->password;


    //     $user_login = DB::select('SELECT * FROM login_infomation WHERE user = ?', [$userName]);
    //     if ($user_login === null) {
    //         redirect()->route('login');
    //     }

    //     if (count($user_login) === 0) {
    //         // Không có dữ liệu trả về từ cơ sở dữ liệu
    //         $request->session()->flash('msg', 'bạn đã nhập sai tài khoản');

    //         return redirect()->back()->withInput();
    //     } else {
    //         // Có dữ liệu trả về từ cơ sở dữ liệu
    //         if ($user_login[0]->user == $userName && Hash::check($pass, $user_login[0]->password)) {
    //             // Mật khẩu đúng
    //             $CheckAdmin = $user_login[0]->admin;

    //             if ($CheckAdmin === 1) {
    //                 // return view('admin.admin');
    //                 return redirect()->route('admin');
    //             } else {
    //                 $user_id = $user_login[0]->id;
    //                 $fullName = $user_login[0]->fullnameUser;
    //                 $imagePath = $user_login[0]->images;
    //                 session()->put('username', $userName);
    //                 session()->put('user_id', $user_id);
    //                 session()->put('fullname', $fullName);
    //                 session()->put('images', $imagePath);
    //                 session()->put('login_status', 'logined');

    //                 $recommendWord = $homeRecommendation->Recommendation();
    //                 return view('home.home', compact('user_login', 'fullName', 'recommendWord', 'imagePath'));
    //             }
    //         } else {
    //             // Mật khẩu sai
    //             $request->session()->flash('msg', 'bạn đã nhập sai mật khẩu!');
    //             return redirect()->back()->withInput(['userName' => $userName]);
    //         }
    //     }
    // }

    // SU DUNG Auth
    public function index(Request $request, HomeRecommendation $homeRecommendation)
    {
        $userName = $request->input('userName');
        $password = $request->input('password');

        $credentials = ['user' => $userName, 'password' => $password];

        if (Auth::attempt($credentials)) {

            // Đăng nhập thành công
            $user = Auth::user();
            if ($user->isAdministrator()) {
                // Là admin
                return redirect()->route('admin');
            } else {
                // Không phải admin
                session()->put('username', $user->user);
                session()->put('user_id', $user->id);
                session()->put('fullname', $user->fullnameUser);
                session()->put('images', $user->images);
                session()->put('login_status', 'logined');

                $recommendWord = $homeRecommendation->Recommendation();
                return view('home.home', compact('recommendWord', 'user'));
            }
        } else {
            // Đăng nhập thất bại
            $request->session()->flash('msg', 'Tên đăng nhập hoặc mật khẩu không đúng!');
            return redirect()->back()->withInput(['userName' => $request->userName]);
        }
    }



    public function postSingup(Request $request)
    {

        $fullname = $request->fullname;
        $userName = $request->userName;
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
            'userName' => 'required|unique:login_infomation,user',
            'password' => 'required|min:6',
            'email' => 'required|email'
        ];

        $message = [
            'fullname.required' => '入力が必要',
            // 'fullname.regex' => '半角英数字で入力してください',
            'userName.required' => '入力が必要',
            'userName.unique' => '名前はすでに存在します。',
            'password.required' => '入力が必要',
            'password.min' => '最低６文字入力してください。',
            'email.required' => '入力が必要',
            'email.email' => 'メールアドレスを正しく入力してください',
        ];


        $request->validate($relus, $message);

        $dataInsert = [
            $fullname,
            $userName,
            hash::make($pass),
            $email,
            now()->format('Y-m-d H:i:s'),
            now()->format('Y-m-d H:i:s'),
            $rememberToken,
        ];

        $singup = new SingupUser();

        $singup->SingupUser($dataInsert);


        return redirect()->route('login')->with('msg-singup', 'ユーザーを登録できました。')->withInput();
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
