<?php

namespace App\Http\Controllers\Clinic;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class DashboardController extends Controller {

    public static function index(){
        return view('dashboard');
    }

}
