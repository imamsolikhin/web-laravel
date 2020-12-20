<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\User::create([
        'name'=>'admin',
        'username'=>'admin',
        'email'=> 'admin@gmail.com',
        'password'=>'$2y$10$j2k/ohKZUiJ8.VLrSgijdujJiTzY27PJIqUrWEMtYikyFfmVopfiC',
        'active'=>1
      ]);
      \App\Models\User::create([
        'name'=>'Imam Solikhin',
        'username'=>'de4ragil',
        'email'=> 'de4imamsolikhin@gmail.com',
        'password'=>'$2y$10$j2k/ohKZUiJ8.VLrSgijdujJiTzY27PJIqUrWEMtYikyFfmVopfiC',
        'active'=>1
      ]);
      \App\Http\Resources\Master\Company::create([
        'id'=>'DEV',
        'name'=>'Developh',
        'created_by'=>'devjr',
        'updated_by'=>'devjr',
        'status'=>1
      ]);
    }
}
