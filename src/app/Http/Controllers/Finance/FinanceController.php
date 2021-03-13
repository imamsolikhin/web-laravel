<?php
namespace App\Http\Controllers\Finance;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index($table)
    {
      return getControllerName("Finance", $table)::index();
    }

    public function list($table, Request $request)
    {
      return getControllerName("Finance", $table)::list($request);
    }

    public function data($table, $id)
    {
      return getControllerName("Finance", $table)::data($id);
    }

    public function save($table, Request $request)
    {
      return getControllerName("Finance", $table)::save($request);
    }

    public function update($table, $id, Request $request)
    {
      return getControllerName("Finance", $table)::update($id, $request);
    }

    public function delete($table,$id)
    {
      return getControllerName("Finance", $table)::delete($id);
    }

}
