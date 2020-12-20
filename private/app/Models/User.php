<?php

namespace App\Models;

use Session, Auth;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    protected $revisionCreationsEnabled = true;
    protected $dontKeepRevisionOf = ['password', 'last_login', 'remember_token'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function(Builder $builder) {
            $builder->where('users.active', 1);
        });
    }

    public function findForPassport($username)
    {
       return self::where(filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username', $username)->first();
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }
}
