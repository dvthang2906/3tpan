<?php

namespace App\Http\Controllers;

use App\Models\alphabet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $result = [];
        return view('home.home', compact('result'));
    }
    public function login()
    {

        $result = [];
        $title = '3Tpan';
        return view('login.login', compact('title', 'result'));
    }
    public function contact()
    {

        $result = [];
        return view('home.contact');
    }
    // public function test(){

    //     $result = [];
    //     return view('home.test');
    // }
}
