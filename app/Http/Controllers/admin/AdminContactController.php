<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    //
    public function showListContacts()
    {
        return view('admin.contact.showContact');
    }
}
