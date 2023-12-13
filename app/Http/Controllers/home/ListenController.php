<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListenController extends Controller
{
    //
    public function index()
    {
        return view('home.listen.listen');
    }
}
