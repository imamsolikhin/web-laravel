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
        'id'=>'DEV-GLOBAL-001',
        'name'=>'Imam Solikhin',
        'username'=>'de4ragil',
        'email'=> 'de4imamsolikhin@gmail.com',
        'password'=>'$2y$10$j2k/ohKZUiJ8.VLrSgijdujJiTzY27PJIqUrWEMtYikyFfmVopfiC',
        'role_id'=>"2",
        'active'=>1
      ]);
      \App\Models\User::create([
        'id'=>'ADM-GLOBAL-002',
        'name'=>'admin',
        'username'=>'admin',
        'email'=> 'admin@gmail.com',
        'password'=>'$2y$10$j2k/ohKZUiJ8.VLrSgijdujJiTzY27PJIqUrWEMtYikyFfmVopfiC',
        'role_id'=>"2",
        'active'=>1
      ]);
      \App\Models\Role::create([
        'name'=>'Developer',
        'display_name'=>'Super Admin',
        'description'=>'Super Admin By Developer',
        'status'=>1
      ]);
      \App\Http\Resources\Master\Company::create([
        'id'=>'DEV',
        'name'=>'Developh',
        'created_by'=>'devjr',
        'updated_by'=>'devjr',
        'status'=>1
      ]);
      \App\Http\Resources\Master\ShiftWork::create([
        'id'=>'DEV-SHIFT-1',
        'company_id'=>'DEV',
        'name'=>'SHIFT 1',
        'created_by'=>'devjr',
        'updated_by'=>'devjr',
        'status'=>1
      ]);
      \App\Http\Resources\Master\ShiftWork::create([
        'id'=>'DEV-SHIFT-2',
        'company_id'=>'DEV',
        'name'=>'SHIFT 2',
        'created_by'=>'devjr',
        'updated_by'=>'devjr',
        'status'=>1
      ]);
    }
}
