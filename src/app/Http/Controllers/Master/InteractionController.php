<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class InteractionController extends Controller {

    private static $module;
    private static $module_alias;
    private static $auth;
    private static $path;
    private static $data;
    private static $delete;
    private static $controller;
    private static $resource;
    private static $table;

    public static function init()
    {
        static::$module = 'Interaction';
        static::$module_alias = 'Interaction';
        static::$auth = 'interaction';
        static::$path = route('master.index','interaction');
        static::$data = route('master.list','interaction');
        static::$delete = route('master.delete',['interaction','']);
        static::$controller = getControllerName("Master", "Interaction");
        static::$resource = getResourceName("Master", "Interaction");
        static::$table = new static::$resource();
    }

    public static function validation($request, $type = null) {
         $rules = [
             'name' => 'required|max:250',
         ];
          if (is_null($type)) {
              $rules = array_merge($rules, ['id' => 'required|max:250|unique:'.static::$table->getTable().',id']);
          }
         return Validator::make($request->all(), $rules);
    }

    public static function index() {
      self::init();
      $data['module'] = static::$module;
      $data['auth'] = static::$auth;
      $data['path'] = static::$path;
      $data['data'] = static::$data;
      return view('master.interaction',$data);
    }

    public static function data($id) {
        self::init();
        $module = static::$resource::withoutGlobalScopes(['active'])->findOrFail($id);
        return makeResponse(200, 'success', null, $module);
    }

    public static function save($request) {
        self::init();
        $request->id = sess_company('id').'-'.$request->id;
        $validator = static::$controller::validation($request);
        if ($validator->fails()) return redirect()->route('master.index',static::$auth)->with('notif_danger', 'New '.static::$module_alias.' '. $request->name .' can not be save!');

        $module = static::$controller::execute($request);
        return redirect()->route('master.index',static::$auth)->with('notif_success', 'New '.static::$module_alias.' '. $request->name .' has been added successfully!');
    }

    public static function update($id, $request) {
        self::init();
        $validator = static::$controller::validation($request,'update');
        if ($validator->fails()) return redirect()->route('master.index',static::$auth)->with('notif_danger', 'Update '.static::$module_alias.' '. $request->name .' can not be udate!');

        $data = static::$resource::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('master.index',static::$auth)->with('notif_danger', 'Data '. $id .' not found!');

        $module = static::$controller::execute($request,$data);
        return redirect()->route('master.index',static::$auth)->with('notif_success', static::$module_alias.' '. $data->name .' has been update successfully!');
    }

    public static function delete($id) {
        self::init();
        $data = static::$resource::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('master.index',static::$auth)->with('notif_danger', 'Data '. $id .' not found!');

        $module = $data->delete();
        return redirect()->back()->with('notif_success', static::$module_alias.' '. $data->name .' has been deleted!');
    }

    public static function list($request) {
        self::init();
        $result = static::$resource::withoutGlobalScopes();
        return DataTables::of($result)
          ->addIndexColumn()
          ->addColumn('active', function($module) {
              return $module->status ? '<i class="fa fa-check text-success"></i>' : '<i class="la la-close icon-lg text-danger"></i>';
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
              $delete = '<a data-href="' . static::$delete.'/'.$module->id . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
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
              return $edit . ' ' . $delete;
          })
          ->rawColumns(['active', 'action'])
          ->make(true);
    }

     public static function execute($request, $data = null) {
        if (is_null($data)) {
            $data = static::$table;
            $data->author = sess_user('name');
            $data->created_by = sess_user('id');
            $data->created_at = currDate();
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
            $data->id = generadeCode("Master","Company",sess_company('id'),null, $numb=5);
        }
        if ($request->name){
          $data->name = $request->name;
        }
        if ($request->except('status')) {
            $data->status = to_bool($request->status);
        }
        $data->save();

        return $data;
    }

}
