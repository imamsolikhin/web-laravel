<?php

namespace App\Http\Controllers\Product;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Resources\Product\Visitor;
use App\Http\Resources\Product\Customer;
use App\Http\Resources\Product\Followup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class InteraksiController extends Controller {

    public static function index() {
      $data["Ads_list"] = getResourceName("Master", "Ads")::where('active',1)->get();
      $data["interaction_list"] = getResourceName("Master", "Interaction")::where('active',1)->get();
      $data["gender_list"] = getResourceName("Master", "Gender")::where('active',1)->get();
      $data["confirmation_list"] = getResourceName("Master", "Confirmation")::where('active',1)->get();
      return view('product.interaksi',$data);
    }

    public static function data($id) {
        $visitor = Visitor::withoutGlobalScopes(['active'])->findOrFail($id);
        $visitor->Schedule = date('d-m-Y H:i',strtotime($visitor->Schedule));

        return makeResponse(200, 'success', null, $visitor);
    }

    public static function save($request) {

        $validator = getControllerName("Product", "Interaksi")::validation($request);
        if ($validator->fails()) return redirect()->route('product.index','Interaksi')->with('notif_danger', 'New Interaksi '. $request->FullName .' can not be save!');

        $visitor = getControllerName("Product", "Interaksi")::execute($request);

        Customer::destroy($visitor->Code);
        Followup::destroy($visitor->Code);
        if(!$visitor->Status){
          $patient = new Customer($visitor->getOriginal());
          $patient->Code = $visitor->Code;
          $patient->ReservationStatus = "Schedule";
          $patient->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
          $patient->save();
        }else {
          $followup = new Followup($visitor->getOriginal());
          $followup->Code = $visitor->Code;
          $followup->FollowupStatus = 0;
          $followup->save();
        }
        return redirect()->route('product.index','Interaksi')->with('notif_success', 'New Interaksi '. $request->FullName .' has been added successfully!');
    }

    public static function update($id, $request) {

        $validator = getControllerName("Product", "Interaksi")::validation($request,'update');
        if ($validator->fails()) return redirect()->route('product.index','Interaksi')->with('notif_danger', 'New Interaksi '. $request->FullName .' can not be udate!');

        $data = Visitor::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('product.index','Interaksi')->with('notif_danger', 'Data '. $id .' not found!');

        $visitor = getControllerName("Product", "Interaksi")::execute($request,$data);

        Customer::destroy($visitor->Code);
        Followup::destroy($visitor->Code);
        if(!$visitor->Status){
          $patient = new Customer($visitor->getOriginal());
          $patient->Code = $visitor->Code;
          $patient->ReservationStatus = "Schedule";
          $patient->Schedule = Carbon::createFromFormat('d-m-Y H:i', $request->Schedule)->format('Y-m-d H:i');
          $patient->save();
        }else {
          $followup = new Followup($visitor->getOriginal());
          $followup->Code = $visitor->Code;
          $followup->FollowupStatus = 0;
          $followup->save();
        }

        return redirect()->route('product.index','Interaksi')->with('notif_success', 'Interaksi '. $data->FullName .' has been update successfully!');
    }

    public static function delete($id) {
        $data = Visitor::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('product.index','Interaksi')->with('notif_danger', 'Data '. $id .' not found!');

        $visitor = $data->delete();

        return redirect()->back()->with('notif_success', 'Interaksi '. $data->FullName .' has been deleted!');
    }

    public static function validation($request, $type = null) {
         $rules = [
             'FullName' => 'required|max:250',
             'CreatedBy' => 'nullable||max:250',
             'CreatedDate' => 'nullable|date_format:Y-m-d H:i:s',
             'UpdatedBy' => 'nullable|max:250',
             'UpdatedDate' => 'nullable|date_format:Y-m-d H:i:s',
         ];
         return Validator::make($request->all(), $rules);
   }

    public static function list($request) {
        if($request->from_date != '' && $request->from_date  != ''){
          $result = Visitor::withoutGlobalScopes()
                    ->whereBetween('schedule', array($request->from_date, $request->to_date)) ;
        }else{
        	$result = Visitor::withoutGlobalScopes();
        }

        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('customer', function($visitor) {
              return $visitor->GenderCode." ".$visitor->FullName;
          })
          ->addColumn('active', function($visitor) {
              return $visitor->Status ? '<span class="label font-weight-bold label-lg  label-light-info label-inline">Kunjungan</span>' : '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Reservasi</span>';
          })
          ->addColumn('action', function($visitor) {
              $data_id ="'".$visitor->Code."'";
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
              $delete = '<a data-href="' . route('product.delete',['interaksi',$visitor->Code]) . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
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
          ->rawColumns(['customer','active', 'action'])
          ->make(true);
    }

     public static function execute($request, $data = null) {
        if (is_null($data)) {
            $data = new Visitor;
        }
        if ($request->Code) {
            $data->Code = strtoupper($request->Code);
        }else{
            $data->Code = generadeCode("Product","Customer","TGA", "RSV", $numb=5);
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
        if ($request->AdsCode){
          $data->AdsCode = $request->AdsCode;
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
        // if ($request->LockStatus){
          // $data->LockStatus = $request->LockStatus;
          $data->LockStatus = 0;
        // }
        if ($request->ClosingStatus){
          $data->ClosingStatus = $request->ClosingStatus;
        }
        if ($request->ClosingBy){
          $data->ClosingBy = $request->ClosingBy;
        }
        if ($request->ClosingDate){
          $data->ClosingDate = $request->ClosingDate;
        }
        if ($request->ImgCustomer){
          $data->ImgCustomer = $request->ImgCustomer;
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
        $data->active = 1;
        $data->save();

        return $data;
    }

}
