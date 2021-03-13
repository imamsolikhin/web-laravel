<?php

namespace App\Http\Resources\Product;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sls_product_customer';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
