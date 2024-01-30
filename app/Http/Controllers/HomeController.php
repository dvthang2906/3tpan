<?php

namespace App\Http\Controllers;

use App\Models\admin\Vocabulary;
use App\Models\alphabet;
use App\Models\HomeRecommendation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(HomeRecommendation $homeRecommendation)
    {
        $result = [];

        $recommendWord = $homeRecommendation->Recommendation();
        $user = Auth::user();
        session()->put('levelStatus', $user->level);
        // dd(session('levelStatus'));

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


    public function showVocabulary(Request $request, Vocabulary $vocabulary)
    {
        $searchTerm = '';
        $data = $vocabulary->getListVocabulary($searchTerm);


        return view('home.jisho', compact('data'));
    }

    public function jisho(Request $request, Vocabulary $vocabulary)
    {
        $level = $request->level;
        $searchTerm = $request->searchTerm;
        session()->flashInput($request->input());


        if ($searchTerm == null) {
            $searchTerm = '';
        }

        if ($level == null) {
            $data = $vocabulary->getListVocabulary($searchTerm);
        } else {

            $data = $vocabulary->findByLevel($level, $searchTerm);
        }


        if ($data->isEmpty()) {
            session()->flash('msg', '該当データが無し');

            return view('home.jisho', compact('data'));
        }

        return view('home.jisho', compact('data'));
    }
}
