<?php

namespace App\Http\Controllers\Clinic;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Resources\Clinic\Visitor;
use App\Http\Resources\Clinic\Patient;
use App\Http\Resources\Clinic\Followup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ClosingController extends Controller {

    public static function index() {
        $data["advertise_list"] = getResourceName("Master", "Advertise")::where('ActiveStatus',1)->get();
        $data["interaction_list"] = getResourceName("Master", "Interaction")::where('ActiveStatus',1)->get();
        $data["gender_list"] = getResourceName("Master", "Gender")::where('ActiveStatus',1)->get();
        $data["confirmation_list"] = getResourceName("Master", "Confirmation")::where('ActiveStatus',1)->get();
        return view('clinic.closing',$data);
    }

    public static function data($id) {
        $patient = Patient::withoutGlobalScopes(['active'])->findOrFail($id);
        $patient->ClosingDate = date('d-m-Y H:i',strtotime($patient->ClosingDate));
        $patient->ImgClosing = asset($patient->ImgClosing);

        return makeResponse(200, 'success', null, $patient);
    }

    public static function update($id, $request) {

        $data = Patient::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'Data '. $id .' not found!');

        $validator = getControllerName("Clinic", "Closing")::validation($request, 'update');
        if ($validator->fails()) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'Closing '. $data->FullName .' can not be closing!');

        $patient = getControllerName("Clinic", "Closing")::execute($request,$data);
        if($request->FileClosing){
          $file = $request->file('FileClosing');
          $name_file = $patient->Code."-".$patient->FullName.".".$file->getClientOriginalExtension();
          $path_upload = 'upload/'.date('Y/m/d',strtotime($patient->ClosingDate));
          $file->move($path_upload,$name_file);
          $data->ImgClosing = $path_upload."/".$name_file;
          $patient = getControllerName("Clinic", "Closing")::execute($request,$patient);
        }

        if($patient->ClosingStatus){
          $data = Visitor::find(str_replace('%20', ' ', $patient->Code));
          if($data){
            $visitor = new Visitor($data);
            $visitor->ClosingStatus = 1;
            $visitor->ClosingDate = $patient->ClosingDate;
            $visitor->save();
          }

          $data = Followup::find(str_replace('%20', ' ', $patient->Code));
          $followup = new Followup();
          if($data){
            $followup = new Followup($data);
            $followup->ClosingStatus = 1;
            $followup->ClosingDate = $patient->ClosingDate;
            $followup->save();
          }
        }

        return redirect()->route('clinic.index','Closing')->with('notif_success', 'Closing '. $data->FullName .' has been closing successfully!');
    }

    public static function list($request) {
        if($request->from_date != '' && $request->from_date  != ''){
          $result = Patient::withoutGlobalScopes()
                    ->whereBetween('schedule', array($request->from_date, $request->to_date)) ;
        }else{
        	$result = Patient::withoutGlobalScopes()->where("ReservationStatus","=","Closing");
        }

        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('active', function($patient) {
              $img = '<div class="symbol-label"><img alt="img" src="'.asset($patient->ImgClosing).'" height="100"/>'.'</div>';
              $status =  $patient->Status ? '<span class="label font-weight-bold label-lg  label-light-info label-inline">Kunjungan</span>' : '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Closing</span>';
              $newold = $patient->FollowupStatus ? '<span class="label font-weight-bold label-lg  label-light-primary label-inline">Baru</span>' : '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Lama</span>';
              return $img.'<br/><center>'.$newold."&nbsp".$status.'</center>';
          })
          ->addColumn('ReservationDate', function($patient) {
              return date('d-m-Y H:i',strtotime($patient->Schedule));
          })
          ->addColumn('action', function($patient) {
              $data_id ="'".$patient->Code."'";
              $edit = '<a href="#edithost" onclick="show_data(' .$data_id. ')" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
        							    <span class="svg-icon svg-icon-xl svg-icon-primary">
        							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        							                <rect x="0" y="0" width="24" height="24"/>
        							                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
        							                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opainteraksi="0.3"/>
        							            </g>
        							        </svg>
        							    </span>
        							</a>';
              return $edit;
          })
          ->rawColumns(['ImgReservation','active', 'action'])
          ->make(true);
    }

     public static function validation($request, $type = null) {
         $rules = [
             'CreatedBy' => 'nullable||max:250',
             'CreatedDate' => 'nullable|date_format:Y-m-d H:i:s',
             'UpdatedBy' => 'nullable|max:250',
             'UpdatedDate' => 'nullable|date_format:Y-m-d H:i:s',
         ];

         if (is_null($type)) {
             $rules = array_merge($rules, ['Code' => 'nullable|max:50|unique:sls_clinic_visitor,Code']);
         }

         return Validator::make($request->all(), $rules);
     }

     public static function execute($request, $data = null) {
        if (is_null($data)) {
            $data = new Patient;
        }
        if ($request->Code) {
            $data->Code = $request->Code;
        }
        if ($request->except('ClosingStatus')) {
            $data->ClosingStatus = to_bool($request->ClosingStatus);
        }
        if ($request->ClosingDate){
          $data->ClosingDate = Carbon::createFromFormat('d-m-Y H:i', $request->ClosingDate)->format('Y-m-d H:i');
        }
        $data->save();

        return $data;
    }

}
