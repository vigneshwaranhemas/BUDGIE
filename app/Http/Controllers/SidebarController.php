<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

use Session;

class SidebarController extends Controller
{
    public function get_session_sidebar(Request $req){

         $session_val = Session::get('session_info');
         $emp_ID = $session_val['empID'];
         $cdID = $session_val['cdID'];
         $role_id = $session_val['role_id'];
         $pms_status = $session_val['pms_status'];
         // echo "<pre>";print_r($pms_status);die;

         if ($emp_ID !="") {
            $menu_list = DB::table('role_permissions as rp')->select('*')
                            ->leftjoin('menus as m','m.menu_id', '=', 'rp.menu')
                            ->where('rp.role', '=', $role_id)->where('rp.view', '=', '1')->groupBy('rp.menu')->get();

            $menu_list2 = DB::table('customusers')
                            ->select('pms_status')
                            ->where('empID', '=', $emp_ID)
                            ->get();
         // echo "<pre>";print_r($menu_list2[0]->pms_status);die;
                            $html ='';
                            for ($i=0; $i < count($menu_list) ; $i++) {
                                 if ($menu_list[$i]->child == 0) {
                                    if ($menu_list[$i]->menu_name == "Performance") {
                                        if ($menu_list2[0]->pms_status == 1) {
                                            $html .='<li>';
                                            $html .='<a class="bar-icons" href="'.$menu_list[$i]->menu_path.'">';
                                            $html .='<img src="'.$menu_list[$i]->icon_class.'" height="40px"></img><span>'.$menu_list[$i]->menu_name.'</span></a>';
                                            $html .='</li>';
                                        }else{
                                            $html .='<li>';
                                            $html .='<a class="bar-icons" href="pms_conformation">';
                                            $html .='<img src="'.$menu_list[$i]->icon_class.'" height="40px"></img><span>'.$menu_list[$i]->menu_name.'</span></a>';
                                            $html .='</li>';
                                        }   
                                    }else{
                                        $html .='<li>';
                                        $html .='<a class="bar-icons" href="'.$menu_list[$i]->menu_path.'">';
                                        $html .='<img src="'.$menu_list[$i]->icon_class.'" height="40px"></img><span>'.$menu_list[$i]->menu_name.'</span></a>';
                                        $html .='</li>';

                                    }
                                        
                                }else{
                                        $html .='<li onclick="test(this)">';
                                        $html .='<a class="bar-icons" href="'.$menu_list[$i]->menu_path.'"><img height="40px" src="'.$menu_list[$i]->icon_class.'" ></img><span>'.$menu_list[$i]->menu_name.'</span></a>';

                                            $html .='<ul class="iconbar-mainmenu custom-scrollbar">';

                                         $sub_menu_list = DB::table('role_permissions as rp')
                                                            ->select('rp.*','sm.*')
                                                            ->leftjoin('sub_menus as sm','sm.submenu_id', '=', 'rp.subid')
                                                            ->where('rp.role', '=', $role_id)
                                                            ->where('rp.menu', '=', $menu_list[$i]->menu)
                                                            ->where('rp.view', '=', '1')
                                                            ->get();
                                            // echo "<pre>";print_r($sub_menu_list);die;
                                            for ($j=0; $j < count($sub_menu_list) ; $j++) {
                                                $html .='<li><a href="'.$sub_menu_list[$j]->submenu_path.'"">'.$sub_menu_list[$j]->sub_menu_name.'</a></li>';
                                            }

                                            $html .='</ul> ';
                                        $html .='</li>';
                                }

                            }

                    return response()->json( ['sidebar_list' => $html] );

         }

    }

}

/*full menu bar krish */

