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
            [ 'name' => 'Demo Mall I', 'property' => 'Mall' ],
            [ 'name' => 'Demo Mall II', 'property' => 'Mall' ]
        ];
        $data->userName = 'global admin demo';
        $data->userEmail = 'globaladmin@demo.com';
        $data->userUsername = 'globaladmindemo';
        $data->userPassword = '123123';
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
        $user->name = 'Imam Solikhin';
        $user->email = 'admin@admin.com';
        $user->username = 'admin';
        $user->password = bcrypt('admin123');
        $user->save();
        $user->attachRole(1);
    }
}
