<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\getNews;
use App\Models\admin\searchNews;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AdminNewsController extends Controller
{
    //
    public function show(getNews $getNews)
    {
        $news = $getNews->getDataNews();
        // dd($news);

        return view('admin.data.newsList', compact('news'));
    }

    public function searchNews(Request $request, searchNews $searchNews, getNews $getNews)
    {
        $startDate = $request->input(('start-date'));
        $endDate = $request->input('end-date');



        if (empty($startDate) && empty($endDate)) {
            $news = $getNews->getDataNews();
        } else if (empty($startDate)) {
            $news = $searchNews->findByNewsEndDate($endDate);
        } else if (isEmpty($endDate)) {
            $news = $searchNews->findByNewsStartDate($startDate);
        } else {
            $news = $searchNews->findByNews($startDate, $endDate);
        }

        return view('admin.data.newsList', compact('news', 'startDate', 'endDate'));
    }

    public function edit(Request $request)
    {
        $NewsData = getNews::find($request->id);
        $NewsData->title = $request->title;
        $NewsData->save();

        return response()->json(['message' => 'Title updated successfully']);
    }
}
