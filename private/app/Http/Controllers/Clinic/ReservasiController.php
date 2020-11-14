<?php

namespace App\Http\Controllers\Clinic;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Resources\Clinic\Patient;
use App\Http\Resources\Clinic\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReservasiController extends Controller {

    public static function index() {
        $data["advertise_list"] = getResourceName("Master", "Advertise")::where('ActiveStatus',1)->get();
        $data["interaction_list"] = getResourceName("Master", "Interaction")::where('ActiveStatus',1)->get();
        $data["gender_list"] = getResourceName("Master", "Gender")::where('ActiveStatus',1)->get();
        $data["confirmation_list"] = getResourceName("Master", "Confirmation")::where('ActiveStatus',1)->get();
        return view('clinic.reservasi',$data);
    }

    public static function data($id) {
        $patient = Patient::withoutGlobalScopes(['active'])->findOrFail($id);
        $patient->Schedule = date('d-m-Y H:i',strtotime($patient->Schedule));

        return makeResponse(200, 'success', null, $patient);
    }

    public static function update($id, $request) {

        $validator = getControllerName("Clinic", "Reservasi")::validation($request, 'update');
        if ($validator->fails()) return redirect()->route('clinic.index','Reservasi')->with('notif_danger', 'Reservasi '. $data->FullName .' can not be update!');

        $data = Patient::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Reservasi')->with('notif_danger', 'Data '. $id .' not found!');

        $patient = getControllerName("Clinic", "Reservasi")::execute($request,$data);

        $visitor = Visitor::where('Code', '=', $patient->Code)->update(['LockStatus'=>1]);

        return redirect()->route('clinic.index','Reservasi')->with('notif_success', 'Reservasi '. $data->FullName .' has been update successfully!');
    }

    public static function delete($id) {
        $data = Patient::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('clinic.index','Reservasi')->with('notif_danger', 'Data '. $id .' not found!');

        $visitor = Visitor::where('Code', '=', $data->Code)->update(['LockStatus'=>0]);
        $patient = $data->delete();

        return redirect()->back()->with('notif_success', 'Reservasi '. $data->FullName .' has been deleted!');
    }

    public static function list($request) {
        if($request->from_date != '' && $request->from_date  != ''){
          $result = Patient::withoutGlobalScopes()
                    ->whereBetween('schedule', array($request->from_date, $request->to_date)) ;
        }else{
        	$result = Patient::withoutGlobalScopes();
        }

        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('active', function($patient) {
              $status =  $patient->ReservationStatus == "Closing" ? '<span class="label font-weight-bold label-lg  label-light-danger label-inline">'.$patient->ReservationStatus.'</span>' : '<span class="label font-weight-bold label-lg  label-light-warning label-inline">'.$patient->ReservationStatus.'</span>';
              $newold = $patient->FollowupStatus ? '<span class="label font-weight-bold label-lg  label-light-primary label-inline">Baru</span>' : '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Lama</span>';
              return '<center>'.$newold."&nbsp".$status.'</center>';
          })
          ->addColumn('ReservasiDate', function($patient) {
              return date('d-m-Y H:i',strtotime($patient->Schedule));
          })
          ->addColumn('action', function($patient) {
              $data_id ="'".$patient->Code."'";
              $edit = '<a href="#edithost" onclick="show_data(' .$data_id. ')" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
        							    <span class="svg-icon svg-icon-md svg-icon-primary">
        							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        							                <rect x="0" y="0" width="24" height="24"/>
        							                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
        							                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opainteraksi="0.3"/>
        							            </g>
        							        </svg>
        							    </span>
        							</a>';
              $delete = '<a data-href="' . route('clinic.delete',['Reservasi', $patient->Code]) . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
          							    <span class="svg-icon svg-icon-md svg-icon-danger">
          							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          							                <rect x="0" y="0" width="24" height="24"/>
          							                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
          							                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opainteraksi="0.3"/>
          							            </g>
          							        </svg>
          							    </span>
          							</a>';
              if($patient->ClosingStatus){
                return '<span class="label font-weight-bold label-lg  label-light-danger label-inline"><i class="fas fa-lock pr-2 text-warning "></i> Data Closed</span>';
              }else{
                return $edit . ' ' . $delete;
              }
          })
          ->rawColumns(['ImgReservasi','active', 'action'])
          ->make(true);
    }

     public static function validation($request, $type = null) {
         $rules = [
             'FullName' => 'required|max:250',
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
            $data = new Reservasi;
        }
        if ($request->Code) {
            $data->Code = $request->Code;
        }
        if ($request->CompanyCode){
          $data->CompanyCode = $request->CompanyCode;
        }
        if ($request->BranchCode){
          $data->BranchCode = $request->BranchCode;
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
        if ($request->CofirmationCode){
          $data->CofirmationCode = $request->CofirmationCode;
        }
        if ($request->Schedule){
          $data->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
        }
        if ($request->Status){
          $data->Status = $request->Status;
        }
        if ($request->LockStatus){
          $data->LockStatus = $request->LockStatus;
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
        if ($request->ImgReservasi){
          $data->ImgReservasi = $request->ImgReservasi;
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
        if ($request->ReservationStatus) {
            $data->ReservationStatus = $request->ReservationStatus;
            if($request->ReservationStatus == "Closing"){
              $data->LockStatus = 1;
            }else{
              $data->LockStatus = 0;
            }
        }
        if ($request->ReservationDate) {
            $data->ReservationDate = Carbon::createFromFormat('d-m-Y H:i', $request->ReservationDate)->format('Y-m-d H:i');
        }
        if ($request->CreatedBy) {
            $data->CreatedBy = $request->CreatedBy;
        }
        if ($request->CreatedDate) {
            $data->CreatedDate = $request->CreatedDate;
        }
        if ($request->UpdatedBy) {
            $data->UpdatedBy = $request->UpdatedBy;
        }
        if ($request->UpdatedDate) {
            $data->UpdatedDate = $request->UpdatedDate;
        }
        if ($request->except('Status')) {
            $data->Status = to_bool($request->Status);
        }

        $data->ActiveStatus = 1;
        $data->save();

        return $data;
    }

}
