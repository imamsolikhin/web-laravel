<?php

namespace App\Http\Resources\Warehouse;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ivt_delivery_order';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
     protected $primaryKey = 'id';
     public $incrementing = false;
     protected $keyType = 'string';

}
