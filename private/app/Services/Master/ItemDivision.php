<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class ItemDivision
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/item-division?limit=10000&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Item Division]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/item-division/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Item Division]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}
}