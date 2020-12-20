<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
     protected $table = 'roles';

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
