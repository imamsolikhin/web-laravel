<?php

namespace App\Models\UserManagement;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Builder;

class Role extends LaratrustRole
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('client-group', function(Builder $builder) {
            $builder->where('roles.client_group_id', clientGroupId());
        });
    }
}
