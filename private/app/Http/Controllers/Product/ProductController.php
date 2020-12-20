<?php
namespace App\Http\Controllers\Product;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($table)
    {
      return getControllerName("Product", $table)::index();
    }

    public function list($table, Request $request)
    {
      return getControllerName("Product", $table)::list($request);
    }

    public function data($table, $id)
    {
      return getControllerName("Product", $table)::data($id);
    }

    public function save($table, Request $request)
    {
      return getControllerName("Product", $table)::save($request);
    }

    public function update($table, $id, Request $request)
    {
      return getControllerName("Product", $table)::update($id, $request);
    }

    public function delete($table,$id)
    {
      return getControllerName("Product", $table)::delete($id);
    }

}
