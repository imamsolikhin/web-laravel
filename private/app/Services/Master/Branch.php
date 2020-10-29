<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class Branch
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/branch?limit=15&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Branch]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/branch/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Branch]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

    public function post($data)
    {
        $url =env('RLM_IKB_NOC') . '/branch';
        $client = new Client(['http_errors' => false]);
        $data=[
            'Code' => $data['Code'],
            'Name' => $data['Name'],
            'DefaultBillToCode' => $data['DefaultBillToCode'],
            'DefaultShipToCode' => $data['DefaultShipToCode'],
            'Remark' => $data['Remark'],
            'Address' => $data['Address'],
            'CityCode' => $data['CityCode'],
            'ZipCode' => $data['ZipCode'],
            'Phone1' => $data['Phone1'],
            'Phone2' => $data['Phone2'],
            'Fax' => $data['Fax'],
            'EmailAddress' => $data['EmailAddress'],
            'ContactPerson' => $data['ContactPerson'],
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

        if ($response->getStatusCode() != 201) {
            Log::error("[RLM IKB  NOC API - Add Branch]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function put($code, $data)
    {
        $url =env('RLM_IKB_NOC') . '/branch/'.$code;

        $client = new Client(['http_errors' => false]);
        $data=[
            'Name' => $data['Name'],
            'DefaultBillToCode' => $data['DefaultBillToCode'],
            'DefaultShipToCode' => $data['DefaultShipToCode'],
            'Remark' => $data['Remark'],
            'Address' => $data['Address'],
            'CityCode' => $data['CityCode'],
            'ZipCode' => $data['ZipCode'],
            'Phone1' => $data['Phone1'],
            'Phone2' => $data['Phone2'],
            'Fax' => $data['Fax'],
            'EmailAddress' => $data['EmailAddress'],
            'ContactPerson' => $data['ContactPerson'],
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
            Log::error("[RLM IKB  NOC API - Update Branch]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function delete($code)
    {
        $url =env('RLM_IKB_NOC') . '/branch/'.$code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('delete', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[RLM IKB  NOC API - Deleted Branch]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }
}