<?php

namespace App\Http\Controllers\contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class contactController extends Controller
{
    //
    public function index()
    {
        return view('contact.contact');
    }

    public function postContact(Contact $contact, Request $request)
    {
        $Contact = $request->all();

        $firstName = $Contact['first-name'];
        $lastName = $Contact['last-name'];
        $email = $Contact['email'];
        $country = $Contact['country'];
        $phoneNumber = $Contact['phone-number'];
        $message = $Contact['message'];
        $currentTime = now()->format('Y-m-d H:i:s');
        $token = $Contact['_token'];

        $data = [
            $firstName,
            $lastName,
            $email,
            $country,
            $phoneNumber,
            $message,
            $currentTime,
            $currentTime,
            $token,
        ];



        $contact->insertContact($data);

        // dd($data);


        return view('contact.contact');
    }
}
