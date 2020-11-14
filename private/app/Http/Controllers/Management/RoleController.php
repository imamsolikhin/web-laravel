<?php

namespace App\Http\Controllers\Management;

use DataTables;
use Illuminate\Http\Request;
use App\Models\UserManagement\Role;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $page_title = 'Role Management';
        $page_description = 'Home/Authorization/Role';

        return view('management.role.index', compact('page_title', 'page_description'));
    }

    public function getData()
    {
        $roles = Role::query();

        return Datatables::of($roles)
                    ->addColumn('action', function($role) {
                        $edit = '<a href="' . route('management.role.edit', $role->id) . '" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit text-primary"></i>
                            </a>';
                        $delete = '<a class="btn btn-sm btn-icon text-danger tl-tip" data-href="' . route('management.role.destroy', $role->id) . 'data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash text-danger"></i></a>';

                        return $edit .' '. $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
}
