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

class FollowupController extends Controller {

    public static function index() {
        $data["advertise_list"] = getResourceName("Master", "Advertise")::where('active',1)->get();
        $data["interaction_list"] = getResourceName("Master", "Interaction")::where('active',1)->get();
        $data["gender_list"] = getResourceName("Master", "Gender")::where('active',1)->get();
        $data["confirmation_list"] = getResourceName("Master", "Confirmation")::where('active',1)->get();
        return view('clinic.followup',$data);
    }

    public static function data($id) {
        $visitor = Followup::withoutGlobalScopes(['active'])->findOrFail($id);
        $visitor->Schedule = date('d-m-Y H:i',strtotime($visitor->Schedule));

        return makeResponse(200, 'success', null, $visitor);
    }

    public static function save($request) {
        $validator = getControllerName("Clinic", "Followup")::validation($request);
        if ($validator->fails()) return redirect()->route('clinic.index','Followup')->with('notif_danger', 'New Followup '. $request->FullName .' can not be save!');

        $data = Followup::find(str_replace('%20', ' ', $request->code));
        $visitor = getControllerName("Clinic", "Followup")::execute($request,$data);

        Patient::destroy($visitor->code);
        if(!$visitor->Status){
          $patient = new Patient($visitor->getOriginal());
          $patient->code = $visitor->code;
          $patient->FollowupStatus = 1;
          $patient->ReservationStatus = "Schedule";
          $patient->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
          $patient->save();
        }
        return redirect()->route('clinic.index','Followup')->with('notif_success', 'New Followup '. $request->FullName .' has been added successfully!');
    }

    public static function update($id, $request) {

        $validator = getControllerName("Clinic", "Followup")::validation($request, 'update');
        if ($validator->fails()) return redirect()->route('clinic.index','Followup')->with('notif_danger', 'Followup '. $data->FullName .' can not be update!');

        $data = Followup::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Followup')->with('notif_danger', 'Data '. $id .' not found!');

        $visitor = getControllerName("Clinic", "Followup")::execute($request,$data);

        Patient::destroy($visitor->code);
        if(!$visitor->Status){
          $patient = new Patient($visitor->getOriginal());
          $patient->code = generadeCode("Clinic","Patient","TGA", "RSV", $numb=5);
          $patient->FollowupStatus = 1;
          $patient->ReservationStatus = "Schedule";
          $patient->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
          $patient->save();
        }

        return redirect()->route('clinic.index','Followup')->with('notif_success', 'Followup '. $data->FullName .' has been update successfully!');
    }

    public static function delete($id) {
        $data = Followup::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Followup')->with('notif_danger', 'Data '. $id .' not found!');

        $visitor = Visitor::where('Code', '=', $data->code)->update(['LockStatus'=>0]);
        $visitor = $data->delete();

        return redirect()->back()->with('notif_success', 'Followup '. $data->FullName .' has been deleted!');
    }

    public static function list($request) {
        if($request->from_date != '' && $request->from_date  != ''){
          $result = Followup::withoutGlobalScopes()
                    ->whereBetween('schedule', array($request->from_date, $request->to_date));
        }else{
        	$result = Followup::withoutGlobalScopes()->orderBy('FollowupDate', 'desc');
        }

        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('Pasien', function($visitor) {
              return $visitor->GenderCode." ".$visitor->FullName;
          })
          ->addColumn('ReservationDate', function($visitor) {
              return date('d-m-Y H:i',strtotime($visitor->Schedule));
          })
          ->addColumn('active', function($visitor) {
              return $visitor->Status ? '<span class="label font-weight-bold label-lg  label-light-info label-inline">Kunjungan</span>' : '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Reservasi</span>';
          })
          ->addColumn('action', function($visitor) {
              $data_id ="'".$visitor->code."'";
              $edit = '<a href="#edithost" onclick="show_data(' .$data_id. ')" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
            							    <span class="svg-icon svg-icon-md svg-icon-primary">
            							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            							                <rect x="0" y="0" width="24" height="24"/>
            							                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
            							                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opafollowup="0.3"/>
            							            </g>
            							        </svg>
            							    </span>
            							</a>';
              $delete = '<a data-href="' . route('clinic.delete',['Followup', $visitor->code]) . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
          							    <span class="svg-icon svg-icon-md svg-icon-danger">
          							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          							                <rect x="0" y="0" width="24" height="24"/>
          							                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
          							                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opafollowup="0.3"/>
          							            </g>
          							        </svg>
          							    </span>
          							</a>';
                if($visitor->ClosingStatus){
                  return '<span class="label font-weight-bold label-lg  label-light-danger label-inline"><i class="fas fa-lock pr-2 text-warning "></i> Data Closed</span>';
                }else{
                  if($visitor->LockStatus){
                    return '<span class="label font-weight-bold label-lg  label-light-danger label-inline"><i class="fas fa-lock pr-2 text-warning "></i> Data Lock</span>';
                  }else{
                    return $edit . ' ' . $delete;
                  }
                }
          })
          ->rawColumns(['active', 'action'])
          ->make(true);
    }

     public static function validation($request, $type = null) {
         $rules = [
             'FullName' => 'required|max:250',
             'created_by' => 'nullable||max:250',
             'CreatedDate' => 'nullable|date_format:Y-m-d H:i:s',
             'UpdatedBy' => 'nullable|max:250',
             'UpdatedDate' => 'nullable|date_format:Y-m-d H:i:s',
         ];

         // if (is_null($type)) {
         //     $rules = array_merge($rules, ['Code' => 'nullable|max:50|unique:sls_clinic_visitor,Code']);
         // }

         return Validator::make($request->all(), $rules);
     }

     public static function execute($request, $data = null) {
        if (is_null($data)) {
            $data = new Followup;
        }
        if ($request->code) {
            $data->code = strtoupper($request->code);
        }else{
            $data->code = generadeCode("Clinic","Patient","TGA", "RSV", $numb=5);
        }
        if ($request->companyCode){
          $data->companyCode = $request->companyCode;
        }
        if ($request->ShipWorkCode){
          $data->ShipWorkCode = $request->ShipWorkCode;
        }
        if ($request->AdvertiseCode){
          $data->AdvertiseCode = $request->AdvertiseCode;
        }
        if ($request->InteractionCode){
          $data->InteractionCode = $request->InteractionCode;
        }
        if ($request->GenderCode){
          $data->GenderCode = $request->GenderCode;
        }
        if ($request->FullName){
          $data->FullName = $request->FullName;
        }
        if ($request->Age){
          $data->Age = $request->Age;
        }
        if ($request->Phone){
          $data->Phone = $request->Phone;
        }
        if ($request->Consultation){
          $data->Consultation = $request->Consultation;
        }
        if ($request->Address){
          $data->Address = $request->Address;
        }
        if ($request->CityCode){
          $data->CityCode = $request->CityCode;
        }
        if ($request->ConfirmationCode){
          $data->ConfirmationCode = $request->ConfirmationCode;
        }
        if ($request->Schedule){
          // dd(Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i'));
          $data->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
        }
        if ($request->Status){
          $data->Status = $request->Status;
        }

        if ($request->ClosingStatus){
          $data->ClosingStatus = $request->ClosingStatus;
        }
        if ($request->ClosingBy){
          $data->ClosingBy = $request->ClosingBy;
        }
        if ($request->ClosingDate){
          $data->ClosingDate = $request->ClosingDate;
        }
        if ($request->ImgPatient){
          $data->ImgPatient = $request->ImgPatient;
        }
        if ($request->ImgReservation){
          $data->ImgReservation = $request->ImgReservation;
        }
        if ($request->ImgConference){
          $data->ImgConference = $request->ImgConference;
        }
        if ($request->ImgClosing){
          $data->ImgClosing = $request->ImgClosing;
        }
        if ($request->SalesCode){
          $data->SalesCode = $request->SalesCode;
        }
        
        if ($request->created_by) {
            $data->created_by = $request->created_by;
        }
        if ($request->created_date) {
            $data->created_date = $request->created_date;
        }
        if ($request->updatedby) {
            $data->updatedby = $request->updatedby;
        }
        if ($request->updated_date) {
            $data->updated_date = $request->updated_date;
        }
        if ($request->except('status')) {
            $data->status = to_bool($request->status);
        }

        $data->LockStatus = 0;
        $data->FollowupDate = date('Y-m-d H:i');
        $data->active = 1;
        $data->save();

        return $data;
    }

}
