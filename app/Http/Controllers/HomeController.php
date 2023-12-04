<?php

namespace App\Http\Controllers;

use App\Models\alphabet;
use App\Models\HomeRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(HomeRecommendation $homeRecommendation)
    {
        $result = [];

        $recommendWord = $homeRecommendation->Recommendation();
        // dd($recommendWord);

        return view('home.home', compact('result', 'recommendWord'));
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

    public function testLivewire()
    {
        return view('home.testLivewire');
    }
    // about
    public function about()
    {
        return view('home.about');
    }
}
