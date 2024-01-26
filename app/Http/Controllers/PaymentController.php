<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    //

    public function index()
    {
        if (!Auth::check()) {
            return view('home.home')->with('message', 'ログインしてください。！');
        } else {
            return view('Payment.payment');
        }
    }


    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = new User();

        $name = $request->input('cardholder-name');

        try {
            if (Session::has('user_id')) {
                $userId = session('user_id');
                $token = $request->stripeToken;

                // Tạo source với tên chủ thẻ
                $source = \Stripe\Source::create([
                    'type' => 'card',
                    'token' => $token,
                    'owner' => [
                        'name' => $name,
                    ],
                ]);

                $charge = Charge::create([
                    'amount' => 1000, // $10, amount in cents
                    'currency' => 'usd',
                    'source' => $source->id,
                    'description' => 'Test payment',
                ]);

                Log::info($charge);
                $user->paymentStatusUpdate($userId);
                session()->put('payment_status', true);

                return redirect('/home')->with('paymentMessage', 'お支払い完了しました。!');
            }
        } catch (\Exception $ex) {
            return redirect()->route('home')->with('paymentMessage', $ex->getMessage());
        }
    }
}
