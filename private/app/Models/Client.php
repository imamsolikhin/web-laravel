<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $dates = ['expired_on'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('client-group', function(Builder $builder) {
            $builder->where('clients.client_group_id', clientGroupId());
        });

        static::addGlobalScope('client-property', function(Builder $builder) {
            $builder->where('clients.client_property_id', clientPropertyId());
        });

        static::addGlobalScope('active', function(Builder $builder) {
            $builder->where('clients.active', true);
        });
    }

    public function clientGroup()
    {
        return $this->belongsTo(ClientGroup::class);
    }

    public function getLogoAttribute()
    {
        return optional($this->logos()->first())->url;
    }

    public function logos()
    {
        return  $this->images()->whereType('logo');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'entity');
    }
}