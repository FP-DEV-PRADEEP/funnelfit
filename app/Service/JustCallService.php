<?php
namespace App\Service;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class JustCallService {

    private $api_key, $secret;
    private \GuzzleHttp\Client $client;

    public function __construct()
    {
        $this->api_key = config('justcall.api_key');
        $this->secret = config('justcall.secret');
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.justcall.io/v1/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "$this->api_key:$this->secret"
            ]
        ]);
    }

    public function sendSMS($to, $message)
    {
        try {
            $response = $this->client->request('POST', 'texts/new', [

                'body' => json_encode([
                    'from' => config('justcall.from'),
                    'to' => $to,
                    'body' => $message,
                ]),
            ]);
            return true;
        } catch(RequestException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            Log::error(json_encode($response));
            return false;
        }
    }
}
