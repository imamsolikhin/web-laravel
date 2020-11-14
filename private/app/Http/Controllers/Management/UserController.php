<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientProperty;
use DataTables, Validator, Session;
use App\Models\UserManagement\Role;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\UserLoginHistory;

class UserController extends Controller
{
    public function index()
    {
        $page_title = 'Management User';
        $page_description = 'Home/Authorization/User';

        $roles = Role::orderBy('display_name', 'asc')->get();
        $clientProperties = ClientProperty::orderBy('name', 'asc')->get();
        $clients = Client::withoutGlobalScope('client-property')->orderBy('name', 'asc')->get();

    	return view('management.user.index', compact('page_title', 'page_description', 'roles', 'clientProperties', 'clients'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'username'  => 'required|min:2|max:30|unique:users,username',
            'password'  => 'required|min:6|max:20|confirmed',
            'email'     => 'required|email|unique:users,email',
            'role'      => 'required|integer|exists:roles,id,client_group_id,' . clientGroupId(),
            'access'    => 'required|in:1,2,3',
        ];

        $clientPropertyId   = null;
        $clientId           = null;

        if ($request->input('access') == 2) {
            $rules = array_merge($rules, [
                'client_property_id' => 'required|' . lookupExists('client_properties'),
            ]);

            $clientPropertyId   = $request->input('client_property_id');
            $clientId           = null;

        } elseif ($request->input('access') == 3) {
            $rules = array_merge($rules, [
                'client_id' => 'required|' . lookupExists('clients'),
            ]);

            $client             = Client::withoutGlobalScope('client-property')->findOrFail($request->input('client_id'));
            $clientPropertyId   = $client->client_property_id;
            $clientId           = $request->input('client_id');
        }

        $this->validate($request, $rules);

        $user                     = new User;
        $user->client_group_id    = clientGroupId();
        $user->client_property_id = $clientPropertyId;
        $user->client_id          = $clientId;
        $user->name               = $request->input('name');
        $user->email              = $request->input('email');
        $user->username           = $request->input('username');
        $user->password           = bcrypt($request->input('password'));
        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()->route('management.user.index')->with('notif_success', 'New user has been added successfully!');
    }

    public function edit($id, Request $request)
    {
        $page_title = 'Management User';
        $page_description = 'Home/Authorization/Edit User';

        $user = User::withoutGlobalScopes(['active'])->findOrFail($id);
        $roles = Role::orderBy('display_name', 'asc')->get();

        $clientProperties = ClientProperty::orderBy('name', 'asc')->get();
        $clients = Client::withoutGlobalScope('client-property')->orderBy('name', 'asc')->get();

        return view('management.user.edit', compact('page_title', 'page_description', 'user', 'roles', 'clientProperties', 'clients'));
    }

    public function update($id, Request $request)
    {

        $user = User::withoutGlobalScopes(['active'])->findOrFail($id);

        $rules = [
            'name'      => 'required',
            'username'  => 'required|min:2|max:30|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|integer|exists:roles,id,client_group_id,' . clientGroupId(),
            'access'    => 'required|in:1,2,3',
        ];

        $clientPropertyId   = null;
        $clientId           = null;

        if ($request->input('access') == 2) {
            $rules = array_merge($rules, [
                'client_property_id' => 'required|' . lookupExists('client_properties'),
            ]);

            $clientPropertyId   = $request->input('client_property_id');
            $clientId           = null;
        }
        else if ($request->input('access') == 3) {
            $rules = array_merge($rules, [
                'client_id' => 'required|' . lookupExists('clients'),
            ]);

            $client             = Client::withoutGlobalScope('client-property')->findOrFail($request->input('client_id'));
            $clientPropertyId   = $client->client_property_id;
            $clientId           = $request->input('client_id');
        }

        $this->validate($request, $rules);

        $user->client_property_id = $clientPropertyId;
        $user->client_id          = $clientId;
        $user->name               = $request->input('name');
        $user->username           = $request->input('username');
        $user->email              = $request->input('email');
        $user->active             = $request->input('active') ?: 0;
        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()->route('management.user.index')->with('notif_success', 'New user has been updated successfully!');
    }

    public function changeOtherPassword($id)
    {
        $page_title = 'Management User';
        $page_description = 'Home/Authorization/Change Password';

        return view('management.user.change-password', compact('page_title', 'page_description', 'id'));
    }

    public function getData()
    {
    	$users = User::withoutGlobalScopes()
                     ->select(['users.*', 'roles.display_name as role_display_name'])
                     ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                     ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id');

        return DataTables::of($users)
                ->addColumn('active', function($user) {
                    return $user->active ? '<i class="fa fa-check text-success"></i>'
                                             : '<i class="la la-close icon-lg text-danger"></i>';
                })
                ->editColumn('access', function($user) {
                    if ((!$user->client_property_id) && (!$user->client_id)) {
                        return 'All Clients';
                    }
                    else if (($user->client_property_id) && (!$user->client_id)) {
                        return 'Property (' . $user->clientProperty->name . ')';
                    }
                    else if (($user->client_property_id) && ($user->client_id)) {
                        return 'Client (' . $user->client()->withoutGlobalScopes(['client-property','active'])->first()->name . ')';
                    }
                })
                ->addColumn('action', function($user) {
                    $edit ='<a href="' . route('management.user.edit', $user->id) . '" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit text-primary"></i>
                            </a>';
                    $changePassword = '<a href="' . route('management.user.other.change-password', $user->id) . '"data-toggle="tooltip" data-placement="top" title="Change Password">
                            <i class="fa fa-key text-primary"></i>
                        </a>';
                    $delete = '<a data-href="' . route('management.user.destroy', $user->id) . '"data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                    return $edit .' '. $changePassword .' '. $delete;
                })
                ->rawColumns(['active', 'action'])
                ->make(true);
    }

    public function showLoginHistory()
    {
        $page_title = 'User Login History';
        $page_description = 'Home/User Management/User Login History';

        return view('management.user.login-history', compact('page_title', 'page_description'));
    }
    
    public function getLoginHistoryData()
    {
        $userLoginHistory = UserLoginHistory::with('user')->select('user_login_histories.*');

        return Datatables::of($userLoginHistory)
            ->editColumn('created_at', function($userLoginHistory) {
                return $userLoginHistory->created_at->format('d M Y H:i:s');
            })
            ->make(true);
    }
}
