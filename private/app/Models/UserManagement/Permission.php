<?php

namespace App\Models\UserManagement;

use Laratrust\Models\LaratrustPermission;
use Illuminate\Database\Eloquent\Builder;

class Permission extends LaratrustPermission
{
    protected $casts = [
        'show_on' => 'array',
        'hide_on' => 'array',
    ];
}
