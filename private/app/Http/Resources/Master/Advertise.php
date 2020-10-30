<?php

namespace App\Http\Resources\Master;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mst_advertise';

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
        'Name', 'CompanyCode', 'BranchCode', 'ActiveStatus', 'CreatedBy', 'CreatedDate', 'UpdatedBy', 'UpdatedDate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
