<?php

namespace App\Http\Resources\Product;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sls_product_visitor';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
