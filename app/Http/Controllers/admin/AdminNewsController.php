<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\getNews;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    //
    public function show(getNews $getNews)
    {
        $news = $getNews->getDataNews();
        // dd($news);

        return view('admin.data.newsList', compact('news'));
    }

    public function searchNews(Request $request)
    {
        $time = $request->all();
        dd($time);
    }

    public function edit(Request $request)
    {
        $NewsData = getNews::find($request->id);
        $NewsData->title = $request->title;
        $NewsData->save();

        return response()->json(['message' => 'Title updated successfully']);
    }
}
