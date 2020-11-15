<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        // $menus = Menu::where('status', '=', 1)->get();
        // $listmenu = Menu::pluck('title','id')->all();
        // dd($listmenu);
        // dd($this->buildMenu($menus));
        // $data['menus'] = $listmenu;
        // return view('dashboard',$data);
        return view('dashboard');
    }

    // public function buildMenu($menu, $parentid = 0)
    // {
    //   $result = null;
    //   foreach ($menu as $item)
    //     if ($item->parent_id == $parentid) {
    //       $result .= "<li class='dd-item nested-list-item' data-order='{$item->id}' data-id='{$item->id}'>".
    //       $this->buildMenu($menu, $item->id) . "</li>";
    //     }
    //   return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    // }
}
