<?php

namespace App\Http\Controllers\Management;

use DataTables;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\RoleAuth;
use App\Models\MenuIcon;
use App\Models\MenuTools;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller {

    public function index() {

      if(!getAuthMenu('management.menu.index',VIEW)){
        return redirect()->route('noauth');
      }
        $datas['menu_parent'] = Menu::where('menus.url',null)->get();
        $datas['menu_icon'] = MenuIcon::all();
        return view('management.menu.index',$datas);
    }

    public function show($id) {
        $module = Menu::withoutGlobalScopes(['active'])->findOrFail($id);
        return makeResponse(200, 'success', null, $module);
    }

    public function store(Request $request) {

        $validator = $this->validation($request);
        if ($validator->fails()) return redirect()->route('management.menu.index')->with('notif_danger', 'New Menu '. $request->name .' can not be save!');

        $module = $this->save($request);

        return redirect()->route('management.menu.index')->with('notif_success', 'New Menu '. $request->name .' has been added successfully!');
    }

    public function update($id, Request $request) {

      if(!getAuthMenu('management.menu.index',UPDATE)){
        return redirect()->route('noauth');
      }

        $data = Menu::find(str_replace('%20', ' ', $id));
        if (!$data) return redirect()->route('management.menu.index')->with('notif_danger', 'Data '. $id .' not found!');

        $validator = $this->validation($request, 'update');
        if ($validator->fails()) return redirect()->route('management.menu.index')->with('notif_danger', 'Menu '. $data->name .' can not be update!');

        $module = $this->save($request,$data);

        return redirect()->route('management.menu.index')->with('notif_success', 'Menu '. $data->name .' has been update successfully!');
    }

    public function destroy($id) {

      if(!getAuthMenu('management.menu.index',DELETE)){
        return redirect()->route('noauth');
      }
        $data = Menu::find(str_replace('%20', ' ', $id));
        $data_auth = RoleAuth::where('menu_id',$id);
        if (!$data) return redirect()->route('management.menu.index')->with('notif_danger', 'Data '. $id .' not found!');

        $module_auth = $data_auth->delete();
        $module = $data->delete();

        return redirect()->back()->with('notif_success', 'Menu '. $data->name .' has been deleted!');
    }

    public function getData() {
      	$result = Menu::withoutGlobalScopes()
                       ->select(['menus.*'])
                       ->join('menus as parent_menus','menus.parent_id','parent_menus.id')
                       ->orderby('parent_menus.id','ASC');
        return DataTables::of($result)
                        ->addIndexColumn()
                        ->addColumn('active', function($module) {
                            return $module->status ? '<i class="fa fa-check text-success"></i>' : '<i class="la la-close icon-lg text-danger"></i>';
                        })
                        ->addColumn('action', function($module) {
                            $detail = '<a href="' . route('management.menu.show', $module->id) . '" class="btn btn-icon btn-light btn-hover-success btn-sm" data-toggle="tooltip" data-placement="top" title="Detail">
                    					            <span class="svg-icon svg-icon-md svg-icon-success">
                    					                <!--begin::Svg Icon | path:media/svg/icons/General/Settings-1.svg-->
                    					                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    					                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    					                        <rect x="0" y="0" width="24" height="24"/>
                    					                        <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                    					                        <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opalead="0.3"/>
                    					                    </g>
                    					                </svg>
                    					                <!--end::Svg Icon-->
                    					            </span>
                    					        </a>';
                            $data_id ="'".$module->id."'";
                            $edit = '<a href="#edithost" onclick="show_data(' .$data_id. ')" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                        							    <span class="svg-icon svg-icon-md svg-icon-primary">
                        							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        							                <rect x="0" y="0" width="24" height="24"/>
                        							                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                        							                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opalead="0.3"/>
                        							            </g>
                        							        </svg>
                        							    </span>
                        							</a>';
                                $delete = '<a data-href="' . route('management.menu.destroy', $module->id) . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" "data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#confirm-delete-modal">
                              							    <span class="svg-icon svg-icon-md svg-icon-danger">
                              							        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              							            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              							                <rect x="0" y="0" width="24" height="24"/>
                              							                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                              							                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opalead="0.3"/>
                              							            </g>
                              							        </svg>
                              							    </span>
                              							</a>';
                          return $edit . ' ' . $delete;
                      })
                      ->rawColumns(['active', 'action'])
                      ->make(true);
     }

     public function validation($request, $type = null) {
         $rules = [
             'name' => 'required|max:250',
         ];

         return Validator::make($request->all(), $rules);
     }

     public function save($request, $data = null) {
        if (is_null($data)) {
            $data = new Menu;
        }

        if ($request->id) {
            $data->id = $request->id;
        }
        if ($request->name) {
            $data->name = $request->name;
        }
        if ($request->except('parent_id')) {
            $data->parent_id = $request->parent_id;
        }
        if ($request->url) {
            $data->url = $request->url;
        }
        if ($request->except('icon')) {
            $data->icon = $request->icon;
        }
        if ($request->description) {
            $data->description = $request->description;
        }
        $data->save();

        return $data;
    }

}
