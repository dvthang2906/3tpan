<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\UpdateDataUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $users->updateDataUser($field, $userID, $newValue);
    }
}
