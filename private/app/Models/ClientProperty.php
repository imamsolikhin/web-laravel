<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientProperty extends Model
{
    use SoftDeletes;

    protected $table = 'sys_client_properties';
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('client-group', function(Builder $builder) {
            $builder->where('client_group_id', clientGroupId());
        });
    }
}
