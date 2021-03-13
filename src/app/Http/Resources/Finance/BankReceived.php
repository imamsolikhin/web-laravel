<?php

namespace App\Http\Resources\Finance;

use Illuminate\Database\Eloquent\Model;

class BankReceived extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fin_bank_received';
    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

}
