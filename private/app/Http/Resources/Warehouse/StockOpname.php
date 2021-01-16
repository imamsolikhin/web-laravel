<?php

namespace App\Http\Resources\Product;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mst_return';

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
        'Name', 'ActiveStatus', 'CreatedBy', 'CreatedDate', 'UpdatedBy', 'UpdatedDate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
