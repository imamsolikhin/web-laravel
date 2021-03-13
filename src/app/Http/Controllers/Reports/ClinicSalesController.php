<?php

namespace App\Http\Controllers\Reports;

use DataTables;
use Anam\PhantomMagick\Converter;
use PdfReport;
use ExcelReport;
use CSVReport;
use PDF;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;

class ClinicSalesController extends Controller {

    public static function export ($table, $export, $is_reqs, $request) {
      $query = DB::table('interaksi_produk')->select("*")->where("closing_approval",true)->where("delivery_status","success")->orderBy("total_transaksi","DESC")->limit(4);
      $title = 'LAPORAN TUTUPAN KLINIK';
    	$meta = [
    		'Registered on' => 'Start To End',
    		'Sort By' => 'ASC'
    	];
      $columns = [
          'URL Menu' => 'delivery_ref',
          'Nama Menu' => 'created_by',
          'Description' => 'nama_lengkap',
      ];
      $data['data_list'] = $query->get();
      $data['title_report'] = $title;
      $data['from_date'] = date("d-m-Y H:i", time());
      $data['to_date'] = date("d-m-Y H:i", time()+9999999);
      $data['is_btn'] = $is_reqs;
      $data['btn_url'] = route('reports.download',['ClinicSales',$export]);
      return static::generade($export, $data, $title, $meta, $query, $columns);
    }

    public static function convert($data, $is_reqs, $exp, $title) {
      if($is_reqs){
        // return view("reports.clinic.reservation",$data);
        return view("reports.clinic.closing",$data);
        return view("reports.sales.invoice",$data);
      }else{
        return $exp->download($title);
      }
    }

    public static function generade($export, $data, $title, $meta, $query, $columns) {
      $is_reqs = $data->is_btn;
      if($export == "img"){
        $exp = new \Anam\PhantomMagick\Converter();
        $exp->source('http://google.com')
            ->toPng();
        return static::convert($data, $is_reqs, $exp, $title.'.png');
      }else if($export == "xls"){
        $exp = ExcelReport::of($title, $meta, $query, $columns)
              ->simple()
              ->make();
        return static::convert($data, $is_reqs, $exp, $title.'.xlsx');
      }else if ($export == "csv"){
        $exp = CSVReport::of($title, $meta, $query, $columns)
                ->simple();
        return static::convert($data, $is_reqs, $exp, $title.'.csv');
      }else if ($export == "pdf"){
        $exp = PDF::loadHTML(view('reports.sales.invoice', $data)->render())->setPaper('a4', 'portrait')->setWarnings(false);
        return static::convert($data, $is_reqs, $exp, $title.'.pdf');
        // return $exp->inline();
      }else if ($export == "spdf"){
        $exp = PdfReport::of($title, $meta, $query, $columns)
              ->setPaper('a4')
              ->setOrientation('portrait');
        return static::convert($data, $is_reqs, $exp, $title.'.pdf');
        // return $exp->stream();
      }else{
        return view("auth.noauth");
      }
    }
}
