<?php

namespace App\Traits;

use Config;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\ClientProperty;

trait RegistersClients
{
    public function getPropertiesList()
    {
        return [
            '01' => 'Mall',
            '02' => 'Hotel',
            '03' => 'Residence',
            '04' => 'Restaurant',
            '05' => 'Community',
            '06' => 'Departement Store',
            '07' => 'Supermarket',
            '08' => 'Retail',
            '09' => 'Entertainment',
            '10' => 'Others',
            '11' => 'Transportation',
            '12' => 'Telecommunication',
            '13' => 'Bank',
            '14' => 'Oil & Gas',
            '15' => 'Goverment',
            '16' => 'e-commerce',
            '17' => 'Medicine',
            '18' => 'Hospital',
            '19' => 'BUMN / BUMD',
            '20' => 'Tourist Attraction',
            '21' => 'Tour & Travel',
            '22' => 'Insurrance',
            '23' => 'SaaS',
            '24' => 'Manufacture',
        ];
    }

    public function createNewClientProperty($clients, $clientGroup)
    {
        $properties = $clients->unique('property')->pluck('property');

        foreach ($properties as $propertyName) {
            $propertyCode = $clientGroup->code . array_search($propertyName, $this->getPropertiesList());
            $clientProperty = ClientProperty::where('code', $propertyCode)->where('name', $propertyName)->first();
            if ($clientProperty) continue;

            $clientProperty                     = new ClientProperty;
            $clientProperty->client_group_id    = $clientGroup->id;
            $clientProperty->code               = $propertyCode;
            $clientProperty->name               = $propertyName;
            $clientProperty->save();
        }

        return;
    }

    public function createClients($clients, $clientGroup, $clientNo)
    {
        foreach ($clients as $client) {
            $clientName = $client['name'];
            $propertyName = $client['property'];
            $clientProperty = ClientProperty::where('name', $propertyName)->first();

            $client                     = new Client;
            $client->client_group_id    = $clientGroup->id;
            $client->client_property_id = $clientProperty->id;
            $client->code               = $clientProperty->code . prefix($clientNo, 2);
            $client->name               = $clientName;
            $client->save();

            Config::set('client.id', $client->id);


            $clientNo++;
        }

        return;
    }
}