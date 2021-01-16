<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserLoginHistory extends Model
{
     protected $table = 'user_login_histories';

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
