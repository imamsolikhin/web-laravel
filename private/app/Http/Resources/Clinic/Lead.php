<?php

namespace App\Http\Resources\Clinic;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model {

      /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'sls_clinic_patient';

      /**
       * The primary key associated with the table.
       *
       * @var string
       */
      protected $primaryKey = 'Code';

      /**
       * Indicates if the primary key is auto-incrementing.
       *
       * @var bool
       */
      public $incrementing = false;

      /**
       * The name of the "created at" column.
       *
       * @const string
       */
      const CREATED_AT = 'CreatedDate';

      /**
       * The name of the "updated at" column.
       *
       * @const string
       */
      const UPDATED_AT = 'UpdatedDate';

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
       protected $fillable = [
         'CompanyCode',
         'BranchCode',
         'ShipWorkCode',
         'AdvertiseCode',
         'InteractionCode',
         'GenderCode',
         'FullName',
         'Age',
         'Phone',
         'Consultation',
         'Address',
         'CityCode',
         'CofirmationCode',
         'Schedule',
         'Status',
         'LockStatus',
         'ClosingStatusCode',
         'ClosingBy',
         'ClosingDate',
         'ImgPatient',
         'ImgReservation',
         'ImgConference',
         'ImgClosing',
         'SalesCode',
         'ActiveStatus',
         'CreatedBy',
         'CreatedDate',
         'UpdatedBy',
         'UpdatedDate',
         'FollowupStatus',
         'FollowupDate',
       ];

      /**
       * The attributes excluded from the model's JSON form.
       *
       * @var array
       */
      protected $hidden = [];

  }
