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
      $data["advertise_list"] = getResourceName("Master", "Ads")::where('status',1)->where('company_id',sess_company('id'))->get();
      $data["interaction_list"] = getResourceName("Master", "Interaction")::where('status',1)->where('company_id',sess_company('id'))->get();
      $data["gender_list"] = getResourceName("Master", "Gender")::where('status',1)->where('company_id',sess_company('id'))->get();
      $data["confirmation_list"] = getResourceName("Master", "Confirmation")::where('status',1)->where('company_id',sess_company('id'))->get();
      return view('clinic.closing',$data);
    }

    public static function data($id) {
        $module = Patient::withoutGlobalScopes(['active'])->findOrFail($id);
        $module->schedule_date = date('d-m-Y H:i',strtotime($module->schedule_date));

        return makeResponse(200, 'success', null, $module);
    }

    public static function save($request) {

        $validator = getControllerName("Clinic", "Closing")::validation($request);
        if ($validator->fails()) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'New Closing '. $request->full_name .' can not be save!');

        $module = getControllerName("Clinic", "Closing")::execute($request);
        return redirect()->route('clinic.index','Closing')->with('notif_success', 'New Closing '. $request->full_name .' has been added successfully!');
    }

    public static function update($id, $request) {

        $validator = getControllerName("Clinic", "Closing")::validation($request,'update');
        if ($validator->fails()) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'New Closing '. $request->full_name .' can not be udate!');

        $data = Patient::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'Data '. $id .' not found!');

        $module = getControllerName("Clinic", "Closing")::execute($request,$data);
        if($request->file_closing){
          $file = $request->file('file_closing');
          $name_file = $module->id.".".$file->getClientOriginalExtension();
          $path_upload = 'upload/'.sess_company("id").'//CLOSING//'.date('Y/m-d',time());
          $file->move($path_upload,$name_file);
          $data->closing_by = sess_user("id");
          $data->closing_date = currDate();
          $data->img_closing = $path_upload."/".$name_file;
          $module = getControllerName("Clinic", "Closing")::execute($request,$module);
        }
        $datas = Visitor::find(str_replace('%20', ' ', $id));
        if ($datas){
          getControllerName("Clinic", "Interaksi")::execute($request,$datas);
        }
        $datas = Followup::find(str_replace('%20', ' ', $id));
        if ($datas){
          getControllerName("Clinic", "Followup")::execute($request,$datas);
        }

        return redirect()->route('clinic.index','Closing')->with('notif_success', 'Closing '. $data->full_name .' has been update successfully!');
    }

    public static function delete($id) {
        $data = Patient::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Closing')->with('notif_danger', 'Data '. $id .' not found!');

        $module = $data->delete();

        $datas = Visitor::find(str_replace('%20', ' ', $id));
        if($datas){
          $datas->lock_status = 0;
          $datas->save();
        }

        $datas = Followup::find(str_replace('%20', ' ', $id));
        if($datas){
          $datas->lock_status = 0;
          $datas->save();
        }

        return redirect()->back()->with('notif_success', 'Closing '. $data->full_name .' has been deleted!');
    }

    public static function validation($request, $type = null) {
         $rules = [
             'full_name' => 'required|max:250',
         ];
         return Validator::make($request->all(), $rules);
   }

    public static function list($request) {
        if($request->from_date != '' && $request->from_date  != ''){
          $result = Patient::withoutGlobalScopes()
                    ->whereBetween('reservation_date', array($request->from_date, $request->to_date)) ;
        }else{
        	$result = Patient::withoutGlobalScopes();
        }

        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('Pasien', function($module) {
              return $module->gender_id." ".$module->full_name;
          })
          ->addColumn('ClosingDate', function($module) {
              return $module->advertise_id." <br> ".date('d-m-Y H:i',strtotime($module->schedule_date));
          })
          ->addColumn('active', function($module) {
              $status =  $module->status ?  '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Reservasi</span>' : '<span class="label font-weight-bold label-lg  label-light-info label-inline">Kunjungan</span>';
              $newold = $module->followup_status ? '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Lama</span>' : '<span class="label font-weight-bold label-lg  label-light-info label-inline">Baru</span>';
              return '<center>'.$newold."&nbsp".$status.'</center><br>'.'<span class="label font-weight-bold label-lg  label-light-primary label-inline">Schedule: '.date('d-m-Y H:i',strtotime($module->schedule_date)).'</span>';
          })
          ->addColumn('active_reservation', function($module) {
              $img = '<div class="symbol-label"><img alt="img" src="'.asset($module->img_reservation).'" height="100" width="200"/>'.'</div>';
              $reservation_status =  $module->reservation_status ?  '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Reservasi</span>' : '<span class="label font-weight-bold label-lg  label-light-info label-inline">Kunjungan</span>';
              $newold = '<span class="label font-weight-bold label-lg  label-light-danger label-inline">'.date('d-m-Y H:i',strtotime($module->reservation_date)).'</span>';
              return $img.'<br/><center>'.$newold."&nbsp".$reservation_status.'</center>';
          })
          ->addColumn('active_closing', function($module) {
              $img = '<div class="symbol-label"><img alt="img" src="'.asset($module->img_closing).'" height="100" width="200"/>'.'</div>';
              $closing_status =  $module->closing_status ?  '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Locked</span>' : '<span class="label font-weight-bold label-lg  label-light-info label-inline">Pending</span>';
              $newold = '<span class="label font-weight-bold label-lg  label-light-danger label-inline">'.date('d-m-Y H:i',strtotime($module->closing_date)).'</span>';
              return $img.'<br/><center>'.$newold."&nbsp".$closing_status.'</center>';
          })
          ->addColumn('action', function($module) {
              $data_id ="'".$module->id."'";
              $edit = '<a href="#edithost" onclick="show_data(' .$data_id. ')" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
          							    <span class="svg-icon svg-icon-md svg-icon-primary">
          							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          							                <rect x="0" y="0" width="24" height="24"/>
          							                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
          							                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
          							            </g>
          							        </svg>
          							    </span>
          							</a>';
              $delete = '<a data-href="' . route('clinic.delete',['closing',$module->id]) . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
          							    <span class="svg-icon svg-icon-md svg-icon-danger">
          							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          							                <rect x="0" y="0" width="24" height="24"/>
          							                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
          							                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
          							            </g>
          							        </svg>
          							    </span>
          							</a>';
              if($module->closing_status){
                return '<span class="label font-weight-bold label-lg  label-light-danger label-inline"><i class="fas fa-lock pr-2 text-warning "></i> Data Closed</span>';
              }else{
                  return $edit . ' ' . $delete;
              }
          })
          ->rawColumns(['active_reservation','active_closing','Pasien','active', 'action'])
          ->make(true);
    }

     public static function execute($request, $data = null) {
        if (is_null($data)) {
            $data = new Patient;
            $data->author = sess_user('name');
            $data->sales_id = sess_user('id');
            $data->created_by = sess_user('id');
            $data->created_at = currDate();
            $data->shift_work_id = sess_shift('id');
        }else{
            $data->updated_by = sess_user('id');
            $data->updated_at = currDate();
        }

        if ($request->company_id){
          $data->company_id = $request->company_id;
        }else{
          $data->company_id = sess_company('id');
        }

        if ($request->id) {
            $data->id = strtoupper($request->id);
        }else{
            $data->id = generadeCode("Clinic","Visitor",sess_company('id'), "RSV".date("ymd", time()), $numb=5);
        }

        if ($request->shift_work_id){
          $data->shift_work_id = $request->shift_work_id;
        }
        if ($request->advertise_id){
          $data->advertise_id = $request->advertise_id;
        }
        if ($request->interaction_id){
          $data->interaction_id = $request->interaction_id;
        }
        if ($request->gender_id){
          $data->gender_id = $request->gender_id;
        }
        if ($request->full_name){
          $data->full_name = $request->full_name;
        }
        if ($request->age){
          $data->age = $request->age;
        }
        if ($request->phone){
          $data->phone = $request->phone;
        }
        if ($request->consultation){
          $data->consultation = $request->consultation;
        }
        if ($request->address){
          $data->address = $request->address;
        }
        if ($request->city_id){
          $data->city_id = $request->city_id;
        }
        if ($request->confirmation_id){
          $data->confirmation_id = $request->confirmation_id;
        }
        if ($request->schedule_date){
          // dd($request->schedule_date);
          $data->schedule_date = Carbon::createFromFormat('d-m-Y H:i', $request->schedule_date)->format('Y-m-d H:i');
        }
        if ($request->reservation_status){
          $data->reservation_status = $request->reservation_status;
        }
        if ($request->reservation_by){
          $data->reservation_by = $request->reservation_by;
        }
        if ($request->reservation_date){
          $data->reservation_date = $request->reservation_date;
        }
        if ($request->closing_by){
          $data->closing_by = $request->closing_by;
        }
        if ($request->closing_date){
          $data->closing_date = $request->closing_date;
        }
        if ($request->img_patient){
          $data->img_patient = $request->img_patient;
        }
        if ($request->img_reservation){
          $data->img_reservation = $request->img_reservation;
        }
        if ($request->img_conference){
          $data->img_conference = $request->img_conference;
        }
        if ($request->img_closing){
          $data->img_closing = $request->img_closing;
        }
        $data->lock_status = 1;
        $data->save();

        return $data;
    }

}
