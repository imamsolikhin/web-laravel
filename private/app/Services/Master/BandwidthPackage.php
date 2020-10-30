<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class BandwidthPackage
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/bandwidth-package?limit=1000&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Bandwidth Package]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/bandwidth-package/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Bandwidth Package]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function post($data)
	{
		$url =env('RLM_IKB_NOC') . '/bandwidth-package';
        $client = new Client(['http_errors' => false]);
		$data=[
			'Code' => $data['Code'],
			'Name' => $data['Name'],
			'ClientTypeCode' => $data['ClientTypeCode'],
			'IIX' => $data['IIX'],
			'Intl' => $data['Intl'],
			'SDIX' => $data['SDIX'],
			'ActiveStatus' => $data['ActiveStatus'],
			'Remark' => $data['Remark']
		];

        $response = $client->request('POST', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Signature' => (new Signature(json_encode($data)))->create()
            ],
            'json' => $data
        ]);

        if ($response->getStatusCode() != 201) {
            Log::error("[RLM IKB  NOC API - Add Bandwidth Package]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
	}

	public function put($code, $data)
	{
		$url =env('RLM_IKB_NOC') . '/bandwidth-package/'.$code;

        $client = new Client(['http_errors' => false]);
		$data=[
			'Name' => $data['Name'],
			'ClientTypeCode' => $data['ClientTypeCode'],
			'IIX' => $data['IIX'],
			'Intl' => $data['Intl'],
			'SDIX' => $data['SDIX'],
			'Remark' => $data['Remark'],
            'ActiveStatus' => isset($data['ActiveStatus']) ? $data['ActiveStatus'] : null,
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
            Log::error("[RLM IKB  NOC API - Update Bandwidth Package]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
	}

    public function delete($code)
    {
        $url =env('RLM_IKB_NOC') . '/bandwidth-package/'.$code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('delete', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[RLM IKB  NOC API - Show Bandwidth Package]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }
}