<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use Config, DB, Exception;
use App\Models\ClientGroup;
use App\Models\ClientProperty;
use App\Models\UserManagement\Role;
use App\Models\UserManagement\Permission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\RegistersClients;

class RegisterNewClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RegistersClients;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $data;
    private $passwordEncrypted;

    public function __construct($data, $passwordEncrypted = false)
    {
        $this->data = $data;
        $this->passwordEncrypted = $passwordEncrypted;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        try {

            if (User::where('username', $this->data->userUsername)->orWhere('email', $this->data->userEmail)->first()) {
                throw new Exception('Username or Email Already Exists!');
            }

            $clientGroup = new ClientGroup;
            $clientGroup->code = $this->data->clientGroupCode;
            $clientGroup->name = $this->data->clientGroupName;
            $clientGroup->save();

            Config::set('client.group_id', $clientGroup->id);

            $clients = collect($this->data->clients);
            $this->createNewClientProperty($clients, $clientGroup);

            $admin = new Role;
            $admin->client_group_id = $clientGroup->id;
            $admin->name = 'admin';
            $admin->display_name = 'Administrator';
            $admin->save();
            $admin->attachPermissions(Permission::all());

            $supervisor = new Role;
            $supervisor->client_group_id = $clientGroup->id;
            $supervisor->name = 'supervisor';
            $supervisor->display_name = 'Supervisor';
            $supervisor->save();
            $supervisor->attachPermissions(Permission::all());

            $cs = new Role;
            $cs->client_group_id = $clientGroup->id;
            $cs->name = 'cs';
            $cs->display_name = 'Customer Service';
            $cs->save();
            $cs->attachPermissions(Permission::all());

            $user = new User;
            $user->client_group_id = $clientGroup->id;
            $user->name = $this->data->userName;
            $user->username = $this->data->userUsername;
            $user->email = $this->data->userEmail;
            $user->password = ($this->passwordEncrypted) ? $this->data->userPassword : bcrypt($this->data->userPassword);
            $user->billing_recipient = 1;
            $user->save();

            $user->attachRole($admin);

            $clientNo = 1;
            $this->createClients($clients, $clientGroup, $clientNo);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }

        return true;
    }
}
