<?php
namespace App\Http\Controllers\Reports;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller {
    public function view($table, $export, Request $request){
      return getControllerName("Reports", $table)::export($table, $export, true, $request);
    }
    public function download($table, $export, Request $request){
      return getControllerName("Reports", $table)::export($table, $export, false, $request);
    }

}
