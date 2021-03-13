<?php

namespace App\Http\Resources\Clinic;

use Illuminate\Database\Eloquent\Model;

class VisitPatient extends Model {

      /**
      * The table associated with the model.
      *
      * @var string
      */
      protected $table = 'cln_visit_patient';
      protected $guarded = [];

      protected $primaryKey = 'id';
      public $incrementing = false;
      protected $keyType = 'string';

  }
