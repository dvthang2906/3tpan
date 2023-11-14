<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class JishoService
{
    protected $client;
    protected $clientAffirmative;
    protected $clientNegative;

    public function __construct()
    {
        // tìm kiếm từ đơn
        $this->client = new Client(
            [
                'base_uri' => 'http://beta.jisho.org/api/v1/search/words',
                'verify' => false, // thêm dòng này
            ],
        );
    }

    // TÌM KIẾM TỪ VỰNG ĐƠN LẺ
    public function search($keyword)
    {

        $response = $this->client->request('GET', '', [
            'query' => ['keyword' => $keyword]
        ]);


        $seach = json_decode($response->getBody(), true);

        return $seach;
    }


    // DEEP AI
    // public function callSentimentAPI($text)
    // {

    //     $this->client = new Client([
    //         'base_uri' => 'https://api.deepai.org',
    //         'headers' => [
    //             'Api-Key' => 'b7b3a2a1-f2f4-470d-9279-bf666cd3eebe'
    //         ],
    //         'verify' => false
    //     ]);

    //     $response = $this->client->request('POST', '/api/sentiment-analysis',[
    //         'form_params' => [
    //             'text' => $text
    //         ]
    //     ]);

    //     $data = json_decode($response->getBody());
    //     return $data->output;

    // }



    // //tìm kiếm kanji
    // public function getKanjiInfo($keyword)
    // {
    //     $url = 'https://jisho.org/api/v1/search/kanji?keyword=' . $keyword;

    //     dd($url);
    //     try {
    //         $response = Http::get($url);

    //         if ($response->successful()) {
    //             $kanjiData = $response->json();
    //             // Xử lý dữ liệu JSON ở đây
    //             return $kanjiData;
    //         } else {
    //             // Xử lý trường hợp lỗi
    //             return response()->json(['error' => 'Lỗi trong quá trình lấy dữ liệu kanji'], 500);
    //         }
    //     } catch (\Exception $e) {
    //         // Xử lý trường hợp lỗi
    //         return response()->json(['error' => 'Có lỗi trong quá trình gửi yêu cầu'], 500);
    //     }
    // }



    // // tìm kiếm ví dụ theo từ vựng

    // // cách chia từ
    // protected function initializeAffirmative()
    // {
    //     $this->clientAffirmative = new Client([
    //         'base_uri' => 'https://jisho.org/api/v1/search/words?keyword=Affirmative',
    //         'verify' => false,
    //     ]);
    // }

    // protected function initializeNegative()
    // {
    //     $this->clientNegative = new Client([
    //         'base_uri' => 'https://jisho.org/api/v1/search/words?keyword=Negative',
    //         'verify' => false,
    //     ]);
    // }
}
