<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserProfile extends Model
{
    protected $table = 'sys_user_profile';
    protected $primaryKey = 'Id';

}
