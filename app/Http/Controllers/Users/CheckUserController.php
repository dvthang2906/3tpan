<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CheckUserController extends Controller
{
    //
    public function checkDataExistence(Request $request)
    {
        // sử dụng query khi muốn gửi đến một API GET
        $field = $request->query('field');
        $value = $request->query('value');

        $exists = false;

        switch ($field) {
            case 'email':
                $exists = User::where('email', $value)->exists();
                break;
            case 'user':
                $exists = User::where('user', $value)->exists();
                break;
        }

        return response()->json(['exists' => $exists]);
    }
}
