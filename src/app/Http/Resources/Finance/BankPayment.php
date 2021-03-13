<?php

namespace App\Http\Resources\Finance;

use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fin_bank_payment';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
