<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\news\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(news $news)
    {
        $data = $news->getDataNews();

        return view('home.news.news', compact('data'));
    }
}
