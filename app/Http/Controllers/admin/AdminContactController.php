<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    //
    public function showListContacts(Contact $contact)
    {
        $data = $contact->showContact();

        return view('admin.contact.showContact', compact('data'));
    }


    public function updateStatus(Contact $contact, Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $contact->updateStatus($id, $status);

        return response()->json(['message' => 'status update success']);
    }
}
