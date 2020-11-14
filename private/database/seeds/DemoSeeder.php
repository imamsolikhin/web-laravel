<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Jobs\RegisterNewClient;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new \StdClass;
        $data->clientGroupCode = '01';
        $data->clientGroupName = 'Demo Group';
        $data->clients = [
            [ 'name' => 'Demo Clini c', 'property' => 'Clinic' ],
            [ 'name' => 'Demo Product', 'property' => 'Product' ]
        ];
        $data->userName = 'Demo clinic';
        $data->userEmail = 'clinic@demo.com';
        $data->userUsername = 'clinic';
        $data->userPassword = 'clinic';
        $data->servicePlanId = 6;
        $data->planPeriod = 'quarterly';
        dispatch(new RegisterNewClient($data));

        $demoClientId = 1;
        $demoClientPropertyId = 1;
        $demoClientGroupId = 1;

        $user = new User;
        $user->client_group_id = $demoClientGroupId;
        $user->client_property_id = $demoClientPropertyId;
        $user->client_id = $demoClientId;
        $user->name = 'Product';
        $user->email = 'product@demo.com';
        $user->username = 'product';
        $user->password = bcrypt('product');
        $user->save();
        $user->attachRole(1);
    }
}
