<?php

namespace App\Http\Resources\Master;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mst_payment_type';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

   public $incrementing = false;

   // In Laravel 6.0+ make sure to also set $keyType
   protected $keyType = 'string';

}
