<?php
namespace App\Http\Controllers\Warehouse;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index($table)
    {
      return getControllerName("Warehouse", $table)::index();
    }

    public function list($table, Request $request)
    {
      return getControllerName("Warehouse", $table)::list($request);
    }

    public function data($table, $id)
    {
      return getControllerName("Warehouse", $table)::data($id);
    }

    public function save($table, Request $request)
    {
      return getControllerName("Warehouse", $table)::save($request);
    }

    public function update($table, $id, Request $request)
    {
      return getControllerName("Warehouse", $table)::update($id, $request);
    }

    public function delete($table,$id)
    {
      return getControllerName("Warehouse", $table)::delete($id);
    }

}
