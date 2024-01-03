<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\deleteUsers;
use App\Models\admin\getDataUsers;
use App\Models\admin\UserDeletionService;
use Illuminate\Http\Request;
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
}
