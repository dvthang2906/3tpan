<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\video\ListViewVideos;
use Illuminate\Http\Request;

class ListenController extends Controller
{
    //

    public function index(ListViewVideos $listViewVideos)
    {
        $Videolist = $listViewVideos->VideoList();

        return view('home.listen.indexListen', compact('Videolist'));
    }

    public function listen(Request $request)
    {
        $idVideo = $request->route('id');


        return view('home.listen.listen', compact('idVideo'));
    }
}
