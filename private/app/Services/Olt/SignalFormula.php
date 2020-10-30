<?php

namespace App\Services\Olt;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class SignalFormula {

    public function getAll() {
        $url = env('IKB_OLT_NOC') . '/signal-formula?limit=10000&page=1';
        $signature = (new Signature($url))->create();
        $client = new Client(['http_errors' => false]);
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        $contents = json_decode($response->getBody()->getContents());

        if ($response->getStatusCode() != 200) {
            Log::error("[OLT IKB  NOC API - Get All Host]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
    }

    public function show($code) {
        $url = env('IKB_OLT_NOC') . '/signal-formula/' . $code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        $contents = json_decode($response->getBody()->getContents());

        if ($response->getStatusCode() != 200) {
            Log::error("[OLT IKB  NOC API - Show Host]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
    }

    public function post($data) {
        $url = env('IKB_OLT_NOC') . '/signal-formula';
        $client = new Client(['http_errors' => false]);
        $data = [
            'Code' => $data['Code'],
            'Formula' => $data['Formula'],
            'TxPower' => $data['TxPower'],
            'Distance' => $data['Distance'],
            'LossDb' => $data['LossDb'],
            'LossFix' => $data['LossFix'],
            'ActiveStatus' => 1
        ];

        $response = $client->request('POST', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Signature' => (new Signature(json_encode($data)))->create()
            ],
            'json' => $data
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[OLT IKB  NOC API - Add Host]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function put($code, $data) {
        $url = env('IKB_OLT_NOC') . '/signal-formula/' . $code;

        $client = new Client(['http_errors' => false]);
        $data = [
            'Code' => $data['Code'],
            'Formula' => $data['Formula'],
            'TxPower' => $data['TxPower'],
            'Distance' => $data['Distance'],
            'LossDb' => $data['LossDb'],
            'LossFix' => $data['LossFix'],
            'ActiveStatus' => isset($data['ActiveStatus']) ? $data['ActiveStatus'] : null
        ];

        $response = $client->request('PUT', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Signature' => (new Signature(json_encode($data)))->create()
            ],
            'json' => $data
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[OLT IKB  NOC API - Update Host]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function delete($code) {
        $url = env('IKB_OLT_NOC') . '/signal-formula/' . $code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('delete', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[OLT IKB  NOC API - Deleted Host]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

}
