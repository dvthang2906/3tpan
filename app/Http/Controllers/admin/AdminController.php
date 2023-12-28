<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.admin');
    }

    public function user()
    {
        return view('admin.ad_userCtl');
    }

    public function data()
    {
        return view('admin.ad_dataCtl');
    }
}
