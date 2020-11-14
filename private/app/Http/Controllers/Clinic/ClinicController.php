<?php
namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index($table)
    {
      return getControllerName("Clinic", $table)::index();
    }

    public function list($table, Request $request)
    {
      return getControllerName("Clinic", $table)::list($request);
    }

    public function data($table, $id)
    {
      return getControllerName("Clinic", $table)::data($id);
    }

    public function save($table, Request $request)
    {
      return getControllerName("Clinic", $table)::save($request);
    }

    public function update($table, $id, Request $request)
    {
      return getControllerName("Clinic", $table)::update($id, $request);
    }

    public function delete($table,$id)
    {
      return getControllerName("Clinic", $table)::delete($id);
    }

}
