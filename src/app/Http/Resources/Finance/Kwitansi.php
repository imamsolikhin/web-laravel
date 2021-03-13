<?php

namespace App\Http\Resources\Product;

use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mst_kwitansi';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
