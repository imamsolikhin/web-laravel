<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class Warehouse
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/warehouse?limit=10000&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Warehouse]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/warehouse/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Warehouse]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

    public function post($data)
    {
        $url =env('RLM_IKB_NOC') . '/warehouse';
        $client = new Client(['http_errors' => false]);

        $data=[
            'Code' => $data['Code'],
            'Name' => $data['Name'],
            'WarehouseType' => $data['WarehouseType'],
            'Address' => $data['Address'],
            'CityCode' => $data['CityCode'],
            'CountryCode' => $data['CountryCode'],
            'ZipCode' => $data['ZipCode'],
            'Phone1' => $data['Phone1'],
            'Phone2' => $data['Phone2'],
            'ContactPerson' => $data['ContactPerson']
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
            Log::error("[RLM IKB  NOC API - Add Warehouse]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function put($code, $data)
    {
        $url =env('RLM_IKB_NOC') . '/warehouse/'.$code;

        $client = new Client(['http_errors' => false]);

        $data=[
            'Name' => $data['Name'],
            'WarehouseType' => $data['WarehouseType'],
            'Address' => $data['Address'],
            'CityCode' => $data['CityCode'],
            'CountryCode' => $data['CountryCode'],
            'ZipCode' => $data['ZipCode'],
            'Phone1' => $data['Phone1'],
            'Phone2' => $data['Phone2'],
            'ContactPerson' => $data['ContactPerson']
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
            Log::error("[RLM IKB  NOC API - Update Warehouse]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }
}