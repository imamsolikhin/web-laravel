<?php

namespace App\Services\Master;

use GuzzleHttp\Client;
use App\Services\Signature;
use Illuminate\Support\Facades\Log;

class CustomerNoc
{
	public function getAll()
	{
		$url =env('RLM_IKB_NOC') . '/customer-noc?limit=15&page=1';
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
            Log::error("[RLM IKB  NOC API - Get All Customer Noc]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

	public function show($code)
	{
		$url =env('RLM_IKB_NOC') . '/customer-noc/'.$code;
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
            Log::error("[RLM IKB  NOC API - Show Customer Noc]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }

        return $contents;
	}

    public function post($data)
    {
        $url =env('RLM_IKB_NOC') . '/customer-noc';
        $client = new Client(['http_errors' => false]);
        $data=[
            'Code' => $data['Code'],
            'IPLocalAP' => $data['IPLocalAP'],
            'IPLocalCPE' => $data['IPLocalCPE'],
            'IPPublic' => $data['IPPublic'],
            'NIBTSCode' => $data['NIBTSCode'],
            'NIVLANID' => $data['NIVLANID'],
            'AvlAP' => $data['AvlAP'],
            'AvlCPE' => $data['AvlCPE'],
            'AvlRouter' => $data['AvlRouter'],
            'Border1Code' => $data['Border1Code'],
            'Border2Code' => $data['Border2Code'],
            'Border3Code' => $data['Border3Code'],
            'DistributionCode' => $data['DistributionCode'],
            'ConsentratorCode' => $data['ConsentratorCode'],
            'BTSCode' => $data['BTSCode'],
            'Shaper1Code' => $data['Shaper1Code'],
            'Shaper2Code' => $data['Shaper2Code'],
            'Shaper3Code' => $data['Shaper3Code'],
            'VLANID' => $data['VLANID'],
            'VMANID' => $data['VMANID'],
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
            Log::error("[RLM IKB  NOC API - Add Customer Noc]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function put($code, $data)
    {
        $url =env('RLM_IKB_NOC') . '/customer-noc/'.$code;

        $client = new Client(['http_errors' => false]);
        $data=[
            'IPLocalAP' => $data['IPLocalAP'],
            'IPLocalCPE' => $data['IPLocalCPE'],
            'IPPublic' => $data['IPPublic'],
            'NIBTSCode' => $data['NIBTSCode'],
            'NIVLANID' => $data['NIVLANID'],
            'AvlAP' => $data['AvlAP'],
            'AvlCPE' => $data['AvlCPE'],
            'AvlRouter' => $data['AvlRouter'],
            'Border1Code' => $data['Border1Code'],
            'Border2Code' => $data['Border2Code'],
            'Border3Code' => $data['Border3Code'],
            'DistributionCode' => $data['DistributionCode'],
            'ConsentratorCode' => $data['ConsentratorCode'],
            'BTSCode' => $data['BTSCode'],
            'Shaper1Code' => $data['Shaper1Code'],
            'Shaper2Code' => $data['Shaper2Code'],
            'Shaper3Code' => $data['Shaper3Code'],
            'VLANID' => $data['VLANID'],
            'VMANID' => $data['VMANID'],
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
            Log::error("[RLM IKB  NOC API - Update Customer Noc]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }

    public function delete($code)
    {
        $url =env('RLM_IKB_NOC') . '/customer-noc/'.$code;
        $client = new Client(['http_errors' => false]);
        $signature = (new Signature($url))->create();
        $response = $client->request('delete', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Signature' => $signature
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Log::error("[RLM IKB  NOC API - Show Customer Noc]\r\nStatus Code\r\n{$response->getStatusCode()}\r\n\r\nResponse\r\n{$response->getBody()}");
        }
    }
}