<?php

namespace App\Http\Resources\Clinic;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model {

      /**
      * The table associated with the model.
      *
      * @var string
      */
      protected $table = 'sls_clinic_followup';
      protected $guarded = [];

      protected $primaryKey = 'id';
      public $incrementing = false;
      protected $keyType = 'string';

}
