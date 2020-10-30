<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller {

    public function index($table) {
        return getControllerName('Master',$table)::index($table);
    }

    public function datatableAjax($table, Request $request)
    {
        return getControllerName('Master',$table)::getData($table, $request);
    }

    public function store($table, Request $request)
    {
        return getControllerName('Master',$table)::store($table, $request);
    }

    public function show($table, $id)
    {
       return getControllerName('Master',$table)::show($table, $id);
    }

    public function update($table, $id, Request $request)
    {
       return getControllerName('Master',$table)::store($table, $id, $request);
    }

    public function destroy($table, $id)
    {
       return getControllerName('Master',$table)::destroy($table, $id);
    }
}
