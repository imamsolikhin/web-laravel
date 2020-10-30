<?php

namespace App\Models\UserManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserLoginHistory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('client-group', function(Builder $builder) {
            $builder->where('user_login_histories.client_group_id', clientGroupId());
        });
    }

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
