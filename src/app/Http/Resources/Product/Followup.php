<?php

namespace App\Http\Resources\Product;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sls_product_followup';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
