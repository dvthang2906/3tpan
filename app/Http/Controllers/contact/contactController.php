<?php

namespace App\Http\Controllers\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contactController extends Controller
{
    //
    public function index()
    {
        return view('contact.contact');
    }

    public function postContact(Request $request)
    {
        $Contact = $request->all();
        dd($Contact);


        return view('contact.contact');
    }
}
