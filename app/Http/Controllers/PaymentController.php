<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    //

    public function index()
    {
        return view('Payment.payment');
    }


    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => 1000, // $10, amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test payment',
            ]);

            Log::info($charge);

            return redirect('/home')->with('paymentmessage', 'お支払い完了しました。!');
        } catch (\Exception $ex) {
            return redirect()->route('home')->with('paymentmessage', $ex->getMessage());
        }
    }
}
