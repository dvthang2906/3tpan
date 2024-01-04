<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AddUserService;
use App\Models\admin\deleteUsers;
use App\Models\admin\getDataUsers;
use App\Models\admin\UserDeletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        return view('admin.ad_userCtl', compact('dataUsers'));
    }

    public function data()
    {
        return view('admin.ad_dataCtl');
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
        // dd($request->all());
        $level = $request->level;
        $admin = $request->admin;
        $user = $request->user;
        $fullnameUser = $request->fullnameUser;
        $pass = $request->password;
        $email = $request->email;

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
}
