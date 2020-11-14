<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientGroup extends Model
{
    use SoftDeletes;

    public function getLogoAttribute()
    {
        return optional($this->logo()->first())->url;
    }

    public function logo()
    {
        return $this->images()->whereType('logo');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    
    public function images()
    {
        return $this->morphMany(Image::class, 'entity');
    }
}
