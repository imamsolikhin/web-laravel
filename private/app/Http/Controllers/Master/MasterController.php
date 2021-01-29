<?php
namespace App\Http\Controllers\Master;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index($table)
    {
        //dd(getControllerName("Master", $table));
      return getControllerName("Master", $table)::index();
    }

    public function list($table, Request $request)
    {
      return getControllerName("Master", $table)::list($request);
    }

    public function data($table, $id)
    {
      return getControllerName("Master", $table)::data($id);
    }

    public function save($table, Request $request)
    {
      return getControllerName("Master", $table)::save($request);
    }

    public function update($table, $id, Request $request)
    {
      return getControllerName("Master", $table)::update($id, $request);
    }

    public function delete($table,$id)
    {
      return getControllerName("Master", $table)::delete($id);
    }

}
