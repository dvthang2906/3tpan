<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users\UpdateDataUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UpdateUserDataController extends Controller
{
    //
    public function updateUserID(Request $request)
    {
        // Log::info($request->field);
        $field = $request->field;
        $userID = $request->userID;
        $newValue = $request->NewValue;

        $users = new UpdateDataUsers();
        $user = Auth::user();
        session()->put('username', $user->user);
        session()->put('user_id', $user->id);
        session()->put('fullname', $user->fullnameUser);
        session()->put('images', $user->images);

        $users->updateDataUser($field, $userID, $newValue);
    }

    public function updateImages(Request $request)
    {
        $userID = session('user_id');
        $imagePath = $this->saveImage($request->image);

        // Cập nhật thông tin ảnh vào cơ sở dữ liệu
        $loginInfo = User::find($userID); // Tìm bản ghi dựa trên userID
        if ($loginInfo) {
            $loginInfo->images = $imagePath; // Cập nhật trường 'images'
            $loginInfo->save(); // Lưu thay đổi
            return response()->json(['message' => '画像をアップデートしました。!!']);
        } else {
            return response()->json(['message' => 'まだログインしていません。'], 404);
        }
    }

    private function saveImage($image)
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
