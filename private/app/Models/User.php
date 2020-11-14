<?php

namespace App\Models;

use Session, Auth;
use App\Models\Client;
use App\Models\ClientProperty;
use App\Models\UserManagement\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    protected $revisionCreationsEnabled = true;
    protected $dontKeepRevisionOf = ['password', 'last_login', 'remember_token'];

    protected static function boot()
    {
        parent::boot();
        
        if (! Auth::guest()) {
            static::addGlobalScope('client-group', function(Builder $builder) {
                $builder->where('users.client_group_id', clientGroupId());
            });
        }

        static::addGlobalScope('active', function(Builder $builder) {
            $builder->where('users.active', 1);
        });
    }

    public function findForPassport($username)
    {
       return self::where(filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username', $username)->first();
    }

    public function getAccessLevelAttribute()
    {
        if ($this->client_property_id && $this->client_id) {
            return 'client';
        } elseif ($this->client_property_id) {
            return 'property';
        } else {
            return 'global';
        }
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }
    
    public function clientGroup()
    {
        return $this->belongsTo(ClientGroup::class);
    }

    public function clientProperty()
    {
        return $this->belongsTo(ClientProperty::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
