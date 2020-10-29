<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class JobPosition
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/job-position?limit=10000&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Item Job Position]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

    public function post($data)
    {
        $url =env('RLM_IKB_NOC') . '/job-position';
        $client = new Client(['http_errors' => false]);
        $data=[
            'Code' => $data['Code'],
            'name' => $data['Name']
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
            Log::error("[RLM IKB  NOC API - Add Job Position]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }


	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/job-position/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Item Job Position]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

    public function put($code, $data)
    {
        $url =env('RLM_IKB_NOC') . '/job-position/'.$code;

        $client = new Client(['http_errors' => false]);
        $data=[
            'name' => $data['Name'],
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
            Log::error("[RLM IKB  NOC API - Update Job Position]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function delete($code)
    {
        $url =env('RLM_IKB_NOC') . '/job-position/'.$code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('delete', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[RLM IKB  NOC API - Deleted Job Position]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }
}