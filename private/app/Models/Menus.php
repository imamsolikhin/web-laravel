<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

  public $timestamps = false;

  protected $table = 'sys_menus';

  protected $fillable = array('parent_id','title','url','order');

  public function parent()
  {
    return $this->belongsTo('App\Models\Menus', 'parent_id');
  }

  public function children()
  {
    return $this->hasMany('App\Models\Menus', 'parent_id');
  }
}
