<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AddUserService;
use App\Models\admin\deleteUsers;
use App\Models\admin\getDataUsers;
use App\Models\admin\searchKanji;
use App\Models\admin\UserDeletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\kanji\kanji;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.admin');
    }

    public function user()
    {
        $data = new getDataUsers();
        $dataUsers = $data->getDataUsers();
        $StatusRole = '';
        if (session()->has('StatusRole') && session('StatusRole') == '1') {
            $StatusRole = "Admin";
        }

        return view('admin.ad_userCtl', compact('dataUsers', 'StatusRole'));
    }

    public function deleteUsers(Request $request, UserDeletionService $userDeletionService)
    {
        $userId = $request->input('value');


        if (is_null($userId) || !is_numeric($userId)) {
            return response()->json(['error' => 'Invalid User ID'], 400);
        }

        try {
            $result = $userDeletionService->deleteById($userId);

            if ($result) {
                return response()->json(['message' => 'User deleted successfully']);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            // Log exception details for debugging
            Log::info("Error deleting user: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the user'], 500);
        }
    }

    // THEM USER TỪ TRANG ADMIN/USER
    public function addUser(AddUserService $addUserService, Request $request)
    {

        $level = $request->level;
        $admin = $request->admin;
        $user = $request->user;
        $fullnameUser = $request->fullnameUser;
        $pass = $request->password;
        $email = $request->email;


        $rule = [
            'user' => 'required|unique:login_infomation,user',
            'fullnameUser' => 'required|unique:login_infomation,fullnameUser',
            'email' => 'required',
        ];

        $message = [
            'user.required' => '入力が必要。',
            'user.unique' => 'ユーザーIDが既に存在しています。',
            'fullnameUser.required' => '入力が必要。',
            'fullnameUser.unique' => 'ユーザー名が既に存在しています。',
            'email.required' => '入力が必要。',
        ];


        $request->validate($rule, $message);


        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $imagePath = $this->saveImage($file);
        } else {
            $imagePath = "images/logo.jpg";
        }

        $rememberToken = $request->_token;

        $dataInsert = [
            $level,
            $admin,
            $user,
            $fullnameUser,
            Hash::make($pass),
            $email,
            $imagePath,
            $rememberToken,
            now()->format('Y-m-d H:i:s'),
            now()->format('Y-m-d H:i:s'),
        ];


        $addUserService->AddUser($dataInsert);

        return redirect()->route('ad_userCtl')->with('msg', 'ユーザーが追加された。');
    }

    public function saveImage($image)
    {
        if ($image) {
            // Tạo một tên file duy nhất cho ảnh
            $filename = time() . '_' . $image->getClientOriginalName();

            // Lưu ảnh vào thư mục public/images/userLogo
            $imagePath = $image->storeAs('images/userLogo', $filename, 'public');
            // Log::info('Đường dẫn ảnh: ' . $imagePath);

            // Trả về đường dẫn lưu trữ của ảnh
            return $imagePath;
        }

        return null; // Trả về null nếu không có ảnh
    }



    //ADMIN CTL DATA

    public function data()
    {
        $StatusRole = '';
        if (session()->has('StatusRole') && session('StatusRole') == '1') {
            $StatusRole = "Admin";
        }

        return view('admin.ad_dataCtl', compact('StatusRole'));
    }

    public function kanji(kanji $kanji)
    {
        $dataKanji = $kanji->getDataKanji();

        return view('admin.data.kanji', compact('dataKanji'));
    }

    public function searchKanji(Request $request, SearchKanji $searchKanji)
    {
        //str_replace(' ', '', $request->input('kanji')); //loại bỏ tất cả khoảng trống trong chuỗi.

        //trim loại bỏ khoảng trắng 2 đầu
        $kanji = trim($request->query('kanji'));
        $kanji = $kanji ?? '';

        $type = $this->detectInputType($kanji);
        // dd($type);

        $dataKanji = $searchKanji->searchByKanji($kanji, $type);
        // dd($dataKanji);

        if ($dataKanji->isEmpty()) {
            session()->flash('thongbao', 'データに妥当しません。');
        }


        return view('admin.data.kanji', compact('dataKanji', 'kanji'));
    }

    private function detectInputType($input)
    {
        if (preg_match("/[\x{30A0}-\x{30FF}]/u", $input)) {
            return 'onyomi';
        } elseif (preg_match("/[\x{3040}-\x{309F}]/u", $input)) {
            return 'kunyomi';
        } elseif (preg_match("/[\x{4E00}-\x{9FBF}]/u", $input)) {
            return 'kanji';
        } elseif (preg_match("/[A-Za-z]/", $input)) {
            return 'mean';
        } else {
            return 'id';
        }
    }
}
