<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

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

    public function noauth(){
        return view('auth.noauth');
    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {

        // dd(session('log'));
        // $menus = Menu::where('status', '=', 1)->get();
        // $listmenu = Menu::pluck('title','id')->all();
        // dd($listmenu);
        // dd($this->buildMenu($menus));
        // $data['menus'] = $listmenu;
        // return view('dashboard',$data);
        // dd(public_path());
        // $input = __DIR__ . '/../Reports/example.jasper';
        // $output = __DIR__ . '/../Reports/example';
        // // $jasper = new PHPJasper;
        // // $jasper->compile($input)->execute();
        //
        // // dd(__DIR__. '/../../report/_hello_world');
        // $jasper = new PHPJasper;
        // $jasper->process(
        //   $input, //input
        //   $output, //output
        //   array('pdf'), //formats 'pdf', 'rtf', 'xml'
        // )->execute();
        // dd($jasper);

// $file = $output . '.pdf';
//         $path = $file;
//
//         // caso o arquivo não tenha sido gerado retorno um erro 404
//         if (!file_exists($file)) {
//             abort(404);
//         }
// //caso tenha sido gerado pego o conteudo
//         $file = file_get_contents($file);
// //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
//         unlink($path);
// // retornamos o conteudo para o navegador que íra abrir o PDF
        // return response($file, 200)
        //     ->header('Content-Type', 'application/pdf')
        //     ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
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
