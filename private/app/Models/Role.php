<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
     protected $table = 'roles';
     protected $primaryKey = 'id';

     public $incrementing = false;
     protected $keyType = 'string';

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
