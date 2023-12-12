<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TranslationController extends Controller
{
    //
    public function translate(Request $request)
    {
        $client = new Client(['verify' => false]);

        try {
            $response = $client->post("https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&from=ja&to=ja&to=vn", [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => 'adfc7f71005c4459941503abf3a6837f', // Hoặc sử dụng key thứ hai nếu key này không hoạt động
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    ['Text' => $request->input('text')]
                ])
            ]);

            $result = json_decode($response->getBody(), true);
            return response()->json($result);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
