<?php
namespace App\Repositories;
use App\band;
use App\blood_group;
use App\business_unit;
use App\client;
use App\department;
use App\designation;
use App\division;
use App\function_master;
use App\grade;
use App\location;
use App\roll;
use App\state;
use App\zone;
use Illuminate\Support\Facades\DB;
use App\menu;
use App\sub_menu;
use App\role_permission;
use App\Holidays;
use App\Role;
use App\Models\Candidate_seating_and_email_request;
use App\welcome_aboard;
use App\company_policy_category;


class AdminRepository implements IAdminRepository
{

     /*insert data to db*/
    public function add_role_process( $form_data ){

      $response=Role::insert($form_data);
      return $response;
      }

      /*table view for role*/
    public function get_role_data(){

        $role_data = Role::get();
        return $role_data;
    }
     public function update_role_unit_details( $input_details ){

        $update_roletbl = DB::table('roles');
        $update_roletbl = $update_roletbl->where( 'id', '=', $input_details['id'] );
        $update_roletbl->update( [
            'name' => $input_details['name'],
            'status' => $input_details['status'],
        ] );

    }
    public function get_role_details_pop( $input_details ){

        $roletbl = DB::table('roles')
        ->select('*')
        ->where('id', '=', $input_details['id'])
        ->orderBy('created_at', 'desc')
        ->get();

        return $roletbl;
    }

	/*menu list*/
    public function get_role_list_base(){

        $permission_menu_data = Role::get();
        return $permission_menu_data;
    }

    public function update_profile_details( $input_details ){

        $update_roletbl = DB::table('images')->where( 'emp_id', '=', $input_details['emp_id'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'path' => $input_details['path'],
        ] );

    }

    public function get_menu_list_res($role_id){
        $role_id = $role_id['role_id'];
        // DB::enableQueryLog();
        $menu=DB::table('menus')->get();
        $menu_items=array();
        foreach($menu as $value){
            $submenu=DB::table('sub_menus')->where('menu_id',$value->menu_id)->get();
            $sub_menu_items=array();
            if(isset($submenu['0'])){    
                foreach($submenu as $val){
                $role_data=role_permission::where('role',$role_id)->where('menu',$val->menu_id)->where('sub_menu',$val->sub_menu_name)->get();
                $data=array();
                       // echo '<pre>';print_r($role_data);die();
                    $roles_id="";

                if(isset($role_data['0'])){

                    foreach($role_data as $roles){
                        $roles_id=$roles->id;

                        if($roles->view==1){
                        $view='checked';
                        }else{
                            $view='';
                        }
                        if($roles->update==2){
                            $update='checked';
                        }else{
                            $update='';
                        }
                        if($roles->add==3){
                            $add='checked';
                        }else{
                            $add='';
                        }
                        if($roles->delete==4){
                            $delete='checked';
                        }else{
                            $delete='';
                        }
                        if(isset($roles->subid)){
                            $sub_id=$roles->subid;
                        }
                    }

                }
                else{
                    $view=" ";
                    $update=" ";
                    $add=" ";
                    $delete=" ";
                    $sub_id="";
                   }

                   // echo json_encode($val);die();

                    $sub = "<tr><td><input type='hidden' value=".$value->menu_id."></td><td><input type='hidden' value=".$val->submenu_id.">".$val->sub_menu_name."</td>
                    <td><input type='hidden' value=".$roles_id."><div class='media-body  '><label class='switch modify_switch '><input name='checking' ".$view." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$update." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$add." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$delete." type='checkbox'><span class='switch-state '></span></label></div></td>
                    </tr>";
                    // echo json_decode($sub);die();
                    array_push($sub_menu_items,$sub);
                }

            $subitems=implode(' ', $sub_menu_items);
            $menu="<tr class='test_data2 header'><td><b>".$value->menu_name."</td>".$subitems."</tr>";
        }else{
            $role_data=role_permission::where('role',$role_id)->where('menu',$value->menu_id)->where('sub_menu',NULL)->get();
                $data=array();
                       // echo '<pre>';print_r($role_data);die();
                   $roles_id="";
                if(isset($role_data['0'])){



                    foreach($role_data as $roles){
                        $roles_id=$roles->id;
                        if($roles->view==1){
                        $view='checked';
                        }else{
                            $view='';
                        }
                        if($roles->update==2){
                            $update='checked';
                        }else{
                            $update='';
                        }
                        if($roles->add==3){
                            $add='checked';
                        }else{
                            $add='';
                        }
                        if($roles->delete==4){
                            $delete='checked';
                        }else{
                            $delete='';
                        }
                        if(isset($roles->subid)){
                            $sub_id=$roles->subid;
                        }
                    }

                }
                else{
                    $view=" ";
                    $update=" ";
                    $add=" ";
                    $delete=" ";
                    $sub_id="";
                   }
                $menu="<tr class='test_data2'><td><input type='hidden' value=".$value->menu_id."><b>".$value->menu_name."</td>
                        <td><input type='hidden' value=".$sub_id."></td>
                    <td><input type='hidden' value=".$roles_id."><div class='media-body'><label class='switch modify_switch '><input name='checking' ".$view." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$update." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$add." type='checkbox'><span class='switch-state '></span></label></div></td>
                    <td><div class='media-body  '><label class='switch modify_switch'><input name='checking' ".$delete." type='checkbox'><span class='switch-state '></span></label></div></td></tr>";
        }
            // $menu="<tr class='test_data2'><td><b>".$value->menu_name."</td>".$subitems."</tr>";
            array_push($menu_items,$menu);
        }
        // die;
        return implode(' ',$menu_items);
    }

    /*role permission save list in table */
    public function get_submenu_save_res($form_data){
        $response = role_permission::insert($form_data);
      return $response;
    }

     /*role permission update list in table */
    public function get_submenu_update_res($data){

        // echo "<pre>";print_r($data);die;
        foreach ($data as $key => $form_data) {
        // echo "<pre>";print_r($form_data);die();
        $result=role_permission::where('id', '=' ,$form_data['colid'])->update([
                            "empID"=>$form_data['empID'],
                            "cdID"=>$form_data['cdID'],
                            "role"=>$form_data['role'],
                            "menu"=>$form_data['menu'],
                           "sub_menu"=>$form_data['sub_menu'],
                           "subid"=>$form_data['subid'],
                           "view"=>$form_data['view'],
                           "update"=>$form_data['update'],
                           "add"=>$form_data['add'],
                           "delete"=>$form_data['delete']
                       ]);
                    }
                }


    // Business Unit process start
    public function add_business_unit_process( $form_data ){

      $response = business_unit::insert($form_data);
      return $response;
    }

    public function get_business_unit_database_data(){

        $business_data = business_unit::get();

        // $business_data = DB::table('business_unit')
        // ->where('status', '=', "active")
        // ->get();

        return $business_data;
    }

    public function get_business_unit_details( $input_details ){

        $businesstbl = DB::table('business_unit as bu')
        ->select('bu.*')
        ->where('bu.id', '=', $input_details['id'])
        ->orderBy('bu.created_at', 'desc')
        ->get();

        return $businesstbl;
    }

    public function update_business_unit_details( $input_details ){

        $update_businesstbl = DB::table('business_unit');
        $update_businesstbl = $update_businesstbl->where( 'id', '=', $input_details['id'] );

        $update_businesstbl->update( [
            'business_name' => $input_details['business_name']
        ] );

    }

    public function process_business_unit_status( $input_details ){

        $update_businesstbl = DB::table('business_unit');
        $update_businesstbl = $update_businesstbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_businesstbl->update( [
            'status' => $status
        ] );
    }

    public function process_business_unit_delete( $input_details ){

        $update_businesstbl = DB::table('business_unit');
        $update_businesstbl = $update_businesstbl->where( 'id', '=', $input_details['id'] );

        $update_businesstbl->delete();
    }
    // Business Unit process End

    // Division Unit process start
    public function add_division_unit_process( $form_data ){

        $response = division::insert($form_data);
        return $response;
      }

    public function get_division_unit_database_data(){

        $division_data = division::get();

        return $division_data;
    }

    public function get_division_unit_details( $input_details ){

        $divisiontbl = DB::table('divisions as dv')
        ->select('dv.*')
        ->where('dv.id', '=', $input_details['id'])
        ->orderBy('dv.created_at', 'desc')
        ->get();

        return $divisiontbl;
    }

    public function update_division_details( $input_details ){

        $update_divisiontbl = DB::table('divisions');
        $update_divisiontbl = $update_divisiontbl->where( 'id', '=', $input_details['id'] );

        $update_divisiontbl->update( [
            'division_name' => $input_details['division_name']
        ] );

    }

    public function process_division_status( $input_details ){

        $update_divisiontbl = DB::table('divisions');
        $update_divisiontbl = $update_divisiontbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_divisiontbl->update( [
            'status' => $status
        ] );
    }

    public function process_division_unit_delete( $input_details ){

        $update_divisiontbl = DB::table('divisions');
        $update_divisiontbl = $update_divisiontbl->where( 'id', '=', $input_details['id'] );

        $update_divisiontbl->delete();
    }
    // Business Unit process End

    // Function Unit process start
    public function add_function_process( $form_data ){

        $response = function_master::insert($form_data);
        return $response;
    }

    public function get_function_database_data(){

        $function_data = function_master::get();

        return $function_data;
    }

    public function get_function_details( $input_details ){

        $functiontbl = DB::table('function_masters as fm')
        ->select('fm.*')
        ->where('fm.id', '=', $input_details['id'])
        ->orderBy('fm.created_at', 'desc')
        ->get();

        return $functiontbl;
    }

    public function update_function_details( $input_details ){

        $update_functiontbl = DB::table('function_masters');
        $update_functiontbl = $update_functiontbl->where( 'id', '=', $input_details['id'] );

        $update_functiontbl->update( [
            'function_name' => $input_details['function_name']
        ] );

    }

    public function process_function_status( $input_details ){

        $update_functiontbl = DB::table('function_masters');
        $update_functiontbl = $update_functiontbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_functiontbl->update( [
            'status' => $status
        ] );
    }

    public function process_function_delete( $input_details ){

        $update_functiontbl = DB::table('function_masters');
        $update_functiontbl = $update_functiontbl->where( 'id', '=', $input_details['id'] );

        $update_functiontbl->delete();
    }
    // Function Unit process End

    // Grade Unit process start
    public function add_grade_process( $form_data ){

        $response = grade::insert($form_data);
        return $response;
    }

    public function get_grade_database_data(){

        $grade_data = grade::get();

        return $grade_data;
    }

    public function get_grade_details( $input_details ){

        $gradetbl = DB::table('grades as gr')
        ->select('gr.*')
        ->where('gr.id', '=', $input_details['id'])
        ->orderBy('gr.created_at', 'desc')
        ->get();

        return $gradetbl;
    }

    public function update_grade_details( $input_details ){

        $update_gradetbl = DB::table('grades');
        $update_gradetbl = $update_gradetbl->where( 'id', '=', $input_details['id'] );

        $update_gradetbl->update( [
            'grade_name' => $input_details['grade_name']
        ] );

    }

    public function process_grade_status( $input_details ){

        $update_gradetbl = DB::table('grades');
        $update_gradetbl = $update_gradetbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_gradetbl->update( [
            'status' => $status
        ] );
    }

    public function process_grade_delete( $input_details ){

        $update_gradetbl = DB::table('grades');
        $update_gradetbl = $update_gradetbl->where( 'id', '=', $input_details['id'] );

        $update_gradetbl->delete();
    }
    // Grade Unit process End

    // Location Unit process start
    public function add_location_process( $form_data ){

        $response = location::insert($form_data);
        return $response;
    }

    public function get_location_database_data(){

        $location_data = location::get();

        return $location_data;
    }

    public function get_location_details( $input_details ){

        $locationtbl = DB::table('locations as lo')
        ->select('lo.*')
        ->where('lo.id', '=', $input_details['id'])
        ->orderBy('lo.created_at', 'desc')
        ->get();

        return $locationtbl;
    }

    public function update_location_details( $input_details ){

        $update_locationtbl = DB::table('locations');
        $update_locationtbl = $update_locationtbl->where( 'id', '=', $input_details['id'] );

        $update_locationtbl->update( [
            'location_name' => $input_details['location_name']
        ] );

    }

    public function process_location_status( $input_details ){

        $update_locationtbl = DB::table('locations');
        $update_locationtbl = $update_locationtbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_locationtbl->update( [
            'status' => $status
        ] );
    }

    public function process_location_delete( $input_details ){

        $update_locationtbl = DB::table('locations');
        $update_locationtbl = $update_locationtbl->where( 'id', '=', $input_details['id'] );

        $update_locationtbl->delete();
    }
    // Location process End

    // Blood Group process start
    public function add_blood_process( $form_data ){

        $response = blood_group::insert($form_data);
        return $response;
    }

    public function get_blood_database_data(){

        $blood_data = blood_group::get();

        return $blood_data;
    }

    public function get_blood_details( $input_details ){

        $bloodgrouptbl = DB::table('blood_groups as bg')
        ->select('bg.*')
        ->where('bg.id', '=', $input_details['id'])
        ->orderBy('bg.created_at', 'desc')
        ->get();

        return $bloodgrouptbl;
    }

    public function update_blood_details( $input_details ){

        $update_bloodgrouptbl = DB::table('blood_groups');
        $update_bloodgrouptbl = $update_bloodgrouptbl->where( 'id', '=', $input_details['id'] );

        $update_bloodgrouptbl->update( [
            'blood_group_name' => $input_details['blood_group_name']
        ] );

    }

    public function process_blood_status( $input_details ){

        $update_bloodgrouptbl = DB::table('blood_groups');
        $update_bloodgrouptbl = $update_bloodgrouptbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_bloodgrouptbl->update( [
            'status' => $status
        ] );
    }

    public function process_blood_delete( $input_details ){

        $update_bloodgrouptbl = DB::table('blood_groups');
        $update_bloodgrouptbl = $update_bloodgrouptbl->where( 'id', '=', $input_details['id'] );

        $update_bloodgrouptbl->delete();
    }
    // Blood process End

    // Roll process start
    public function add_roll_process( $form_data ){

        $response = roll::insert($form_data);
        return $response;
    }

    public function get_roll_database_data(){

        $roll_data = roll::get();

        return $roll_data;
    }

    public function get_roll_details( $input_details ){

        $rollstbl = DB::table('rolls as rl')
        ->select('rl.*')
        ->where('rl.id', '=', $input_details['id'])
        ->orderBy('rl.created_at', 'desc')
        ->get();

        return $rollstbl;
    }

    public function update_roll_details( $input_details ){

        $update_rollstbl = DB::table('rolls');
        $update_rollstbl = $update_rollstbl->where( 'id', '=', $input_details['id'] );

        $update_rollstbl->update( [
            'roll_name' => $input_details['roll_name']
        ] );

    }

    public function process_roll_status( $input_details ){

        $update_rollstbl = DB::table('rolls');
        $update_rollstbl = $update_rollstbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_rollstbl->update( [
            'status' => $status
        ] );
    }

    public function process_roll_delete( $input_details ){

        $update_rollstbl = DB::table('rolls');
        $update_rollstbl = $update_rollstbl->where( 'id', '=', $input_details['id'] );

        $update_rollstbl->delete();
    }
    // Roll process End

    // Department process start
    public function add_department_process( $form_data ){

        $response = department::insert($form_data);
        return $response;
    }

    public function get_department_database_data(){

        $department_data = department::get();

        return $department_data;
    }

    public function get_department_details( $input_details ){

        $departmenttbl = DB::table('departments as dt')
        ->select('dt.*')
        ->where('dt.id', '=', $input_details['id'])
        ->orderBy('dt.created_at', 'desc')
        ->get();

        return $departmenttbl;
    }

    public function update_department_details( $input_details ){

        $update_departmentstbl = DB::table('departments');
        $update_departmentstbl = $update_departmentstbl->where( 'id', '=', $input_details['id'] );

        $update_departmentstbl->update( [
            'department_name' => $input_details['department_name']
        ] );

    }

    public function process_department_status( $input_details ){

        $update_departmentstbl = DB::table('departments');
        $update_departmentstbl = $update_departmentstbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_departmentstbl->update( [
            'status' => $status
        ] );
    }

    public function process_department_delete( $input_details ){

        $update_departmentstbl = DB::table('departments');
        $update_departmentstbl = $update_departmentstbl->where( 'id', '=', $input_details['id'] );

        $update_departmentstbl->delete();
    }
    // Roll process End

    // Designation process start
    public function add_designation_process( $form_data ){

        $response = designation::insert($form_data);
        return $response;
    }

    public function get_designation_database_data(){

        $designation_data = designation::get();

        return $designation_data;
    }

    public function get_designation_details( $input_details ){

        $designationtbl = DB::table('designations as dg')
        ->select('dg.*')
        ->where('dg.id', '=', $input_details['id'])
        ->orderBy('dg.created_at', 'desc')
        ->get();

        return $designationtbl;
    }

    public function update_designation_details( $input_details ){

        $update_designationttbl = DB::table('designations');
        $update_designationttbl = $update_designationttbl->where( 'id', '=', $input_details['id'] );

        $update_designationttbl->update( [
            'designation_name' => $input_details['designation_name']
        ] );

    }

    public function process_designation_status( $input_details ){

        $update_designationttbl = DB::table('designations');
        $update_designationttbl = $update_designationttbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_designationttbl->update( [
            'status' => $status
        ] );
    }

    public function process_designation_delete( $input_details ){

        $update_designationttbl = DB::table('designations');
        $update_designationttbl = $update_designationttbl->where( 'id', '=', $input_details['id'] );

        $update_designationttbl->delete();
    }
    // Designation process End

    // State process start
    public function add_state_process( $form_data ){

        $response = state::insert($form_data);
        return $response;
    }

    public function get_state_database_data(){

        $state_data = state::get();

        return $state_data;
    }

    public function get_state_details( $input_details ){

        $statetbl = DB::table('states as st')
        ->select('st.*')
        ->where('st.id', '=', $input_details['id'])
        ->orderBy('st.created_at', 'desc')
        ->get();

        return $statetbl;
    }

    public function update_state_details( $input_details ){

        $update_statestbl = DB::table('states');
        $update_statestbl = $update_statestbl->where( 'id', '=', $input_details['id'] );

        $update_statestbl->update( [
            'state_name' => $input_details['state_name']
        ] );

    }

    public function process_state_status( $input_details ){

        $update_statetbl = DB::table('states');
        $update_statetbl = $update_statetbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_statetbl->update( [
            'status' => $status
        ] );
    }

    public function process_state_delete( $input_details ){

        $update_statetbl = DB::table('states');
        $update_statetbl = $update_statetbl->where( 'id', '=', $input_details['id'] );

        $update_statetbl->delete();
    }
    // State process End

    // Zone process start
    public function add_zone_process( $form_data ){

        $response = zone::insert($form_data);
        return $response;
    }

    public function get_zone_database_data(){

        $zone_data = zone::get();

        return $zone_data;
    }

    public function get_zone_details( $input_details ){

        $zonetbl = DB::table('zones as zo')
        ->select('zo.*')
        ->where('zo.id', '=', $input_details['id'])
        ->orderBy('zo.created_at', 'desc')
        ->get();

        return $zonetbl;
    }

    public function update_zone_details( $input_details ){

        $update_zonestbl = DB::table('zones');
        $update_zonestbl = $update_zonestbl->where( 'id', '=', $input_details['id'] );

        $update_zonestbl->update( [
            'zone_name' => $input_details['zone_name']
        ] );

    }

    public function process_zone_status( $input_details ){

        $update_zonestbl = DB::table('zones');
        $update_zonestbl = $update_zonestbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_zonestbl->update( [
            'status' => $status
        ] );
    }

    public function process_zone_delete( $input_details ){

        $update_zonestbl = DB::table('zones');
        $update_zonestbl = $update_zonestbl->where( 'id', '=', $input_details['id'] );

        $update_zonestbl->delete();
    }
    // zone process End

    // Band process start
    public function add_band_process( $form_data ){

        $response = band::insert($form_data);
        return $response;
    }

    public function get_band_database_data(){

        $band_data = band::get();

        return $band_data;
    }

    public function get_band_details( $input_details ){

        $bandtbl = DB::table('bands as bn')
        ->select('bn.*')
        ->where('bn.id', '=', $input_details['id'])
        ->orderBy('bn.created_at', 'desc')
        ->get();

        return $bandtbl;
    }

    public function update_band_details( $input_details ){

        $update_bandstbl = DB::table('bands');
        $update_bandstbl = $update_bandstbl->where( 'id', '=', $input_details['id'] );

        $update_bandstbl->update( [
            'band_name' => $input_details['band_name']
        ] );

    }

    public function process_band_status( $input_details ){

        $update_bandstbl = DB::table('bands');
        $update_bandstbl = $update_bandstbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_bandstbl->update( [
            'status' => $status
        ] );
    }

    public function process_band_delete( $input_details ){

        $update_bandstbl = DB::table('bands');
        $update_bandstbl = $update_bandstbl->where( 'id', '=', $input_details['id'] );

        $update_bandstbl->delete();
    }
    // Band process End

    // Client process start
    public function add_client_process( $form_data ){

        $response = client::insert($form_data);
        return $response;
    }

    public function get_client_database_data(){

        $client_data = client::get();

        return $client_data;
    }

    public function get_client_details( $input_details ){

        $bandtbl = DB::table('clients as cl')
        ->select('cl.*')
        ->where('cl.id', '=', $input_details['id'])
        ->orderBy('cl.created_at', 'desc')
        ->get();

        return $bandtbl;
    }
    public function get_profile_info( $input_details ){

        // echo "11<pre>";print_r($input_details);die;
        if ($input_details['cdID'] != "") {

            $bandtbl['profile'] = DB::table('customusers')
                        ->select('*')
                        ->where('cdID', '=', $input_details['cdID'])
                        ->first();

           $bandtbl['image'] = DB::table('images as img')
                        ->select('*')
                        ->where('cus.cdID', '=', $input_details['cdID'])
                        ->join('customusers as cus', 'cus.cdID', '=', 'img.cdID')
                        ->first();

        }else if($input_details['emp_ID'] != ""){
             // DB::enableQueryLog();
            $bandtbl['profile'] = DB::table('customusers')
                        ->select('*')
                        ->where('empID', '=', $input_details['emp_ID'])
                        ->first();

            $bandtbl['image'] = DB::table('images as img')
                        ->select('*')
                        ->where('cus.empID', '=', $input_details['emp_ID'])
                        ->join('customusers as cus', 'cus.empID', '=', 'img.emp_id')
                        ->first();
           // dd(DB::getQueryLog());
        }

        return $bandtbl;
    }

    public function update_client_details( $input_details ){

        $update_clientstbl = DB::table('clients');
        $update_clientstbl = $update_clientstbl->where( 'id', '=', $input_details['id'] );

        $update_clientstbl->update( [
            'client_name' => $input_details['client_name'],
            'mobile_number' => $input_details['mobile_number'],
            'email' => $input_details['email']
        ] );

    }

    public function process_client_status( $input_details ){

        $update_clientstbl = DB::table('clients');
        $update_clientstbl = $update_clientstbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_clientstbl->update( [
            'status' => $status
        ] );
    }

    public function process_client_delete( $input_details ){

        $update_clientstbl = DB::table('clients');
        $update_clientstbl = $update_clientstbl->where( 'id', '=', $input_details['id'] );

        $update_clientstbl->delete();
    }

    // Business Unit process start
    public function add_holidays_insert( $data ){
        $response = Holidays::insert($data);
        return $response;
    }
    public function fetch_holidays_list()
    {
       $response = DB::table("holidays")->select('*')
                         ->get();
       return $response;
    }
    public function fetch_holidays_list_id($id)
    {
       $response = DB::table('holidays')
                    ->select('*')
                    ->where('id', $id)
                    ->get();
       return $response;
    }
    public function holidays_update($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],
                         ));
       return $response;
    }
    public function holidays_delete($id)
    {
        $response = Holidays::where('id', $id)
                            ->delete();
        return $response;

    }
    public function fetch_holidays_list_date($filter_date)
    {
        $response = Holidays::where('date', 'LIKE', '%'.$filter_date.'%')
                            ->get();
        return $response;

    }
    // Client process End


    function get_table($table, $emp_ID) {

// DB::enableQueryLog();
         $bandtbl = DB::table($table)
        ->select('*')
        ->where('emp_id', '=', $emp_ID['emp_ID'])
        ->get();
// dd(DB::getQueryLog());
        return $bandtbl;
    }

    // public function get_role_details_pop( $input_details ){

    //     $roletbl = DB::table('roles')
    //     ->select('*')
    //     ->where('id', '=', $input_details['id'])
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    //     return $roletbl;
    // }

   //vignesh admin work starts here

     public function get_seating_requested($status)
     {
         $result=Candidate_seating_and_email_request::join('customusers','candidate_seating_and_email_requests.empID','=','customusers.empID')
                 ->where('candidate_seating_and_email_requests.status',$status)
                 ->select("candidate_seating_and_email_requests.empId",
                          "customusers.username",
                          "customusers.email",
                          "customusers.contact_no",
                          "candidate_seating_and_email_requests.Seating_Request",
                          "candidate_seating_and_email_requests.IdCard_status")->get();
         return $result;
     }


    public function update_seating_status($id,$data)
    {
        $result=Candidate_seating_and_email_request::where('empId',$id)->update($data);
        return $result;

    }
    public function update_candidate_seating_status($data,$update_data)
    {
        foreach($data as $data1)
        {
          $result=Candidate_seating_and_email_request::where('empId',$data1['Off_empId'])->update($update_data);
        }


        return $result;
    }

    //Employee list
    //Employee list
    public function get_employee_list( $input_details){
        // echo "<pre>";print_r($input_details);die;
        // DB::enableQueryLog();
        if ($input_details['status'] == "") {
            $response = DB::table("customusers")->select('*')
                        ->get();
        }else{
             $response = DB::table("customusers")->select('*')
                        ->where('hr_action', '=', $input_details['status'])
                        ->get();

        }

        // dd(DB::getQueryLog());
        return $response;
    }

    public function role_type_list( ){
        $bandtbl = DB::table('roles')
        ->select('*')
        ->get();
        return $bandtbl;
    }

    public function employee_list_result( $input_details ){

        $roletbl = DB::table('customusers')
        ->select('*')
        ->where('id', '=', $input_details['id'])
        ->orderBy('created_at', 'desc')
        ->get();
        // echo "<pre>";print_r($roletbl);die;
        return $roletbl;
    }

    public function update_employee_type( $input_details ){

        $update_roletbl = DB::table('customusers');
        $update_roletbl = $update_roletbl->where( 'id', '=', $input_details['id'] );
        $update_roletbl->update( [
            'role_type' => $input_details['employe_role'],
            'role_id' => $input_details['role_id'],
        ] );

    }

    // Company policies start
    public function add_policy_category_process( $form_data ){

        $response = company_policy_category::insert($form_data);
        return $response;
      }

      public function get_policy_category_details(){

        $divisiontbl = DB::table('company_policy_categories as dv')
        ->select('dv.*')
        ->orderBy('dv.created_at', 'desc')
        ->get();

        return $divisiontbl;
    }
    public function Store_Policy_information($data)
    {
       $result= DB::table('company_policy_information')->insert(
           $data
        );
        return $result;
    }

    public function get_company_policy_infomation_database_data(){

        $company_policy_infomation_data = DB::table('company_policy_information')->get();

        return $company_policy_infomation_data;
    }

    public function get_policy_information_details( $input_details ){

        $policy_information_tbl = DB::table('company_policy_information as cpi')
        ->select('cpi.*')
        ->where('cpi.id', '=', $input_details['id'])
        ->orderBy('cpi.created_at', 'desc')
        ->get();

        return $policy_information_tbl;
    }

    public function edit_policy_information_details( $input_details ){

        $update_policy_information_tbl = DB::table('company_policy_information');
        $update_policy_information_tbl = $update_policy_information_tbl->where( 'id', '=', $input_details['id'] );

        // echo '12</pre>';print_r($input_details);die();
        // $file_upload = $input_details['file_upload'];
        if($input_details['file_upload'] == "")
        {
            $result = $update_policy_information_tbl->update( [
                'cp_id' => $input_details['cp_id'],
                'policy_category' => $input_details['policy_category'],
                'policy_title' => $input_details['policy_title'],
                'policy_description' => $input_details['policy_description'],
            ] );
            // echo '</pre>';print_r($result);die();
        }else if($input_details['file_upload']!== ""){
        $update_policy_information_tbl->update( [
            'cp_id' => $input_details['cp_id'],
            'policy_category' => $input_details['policy_category'],
            'policy_title' => $input_details['policy_title'],
            'policy_description' => $input_details['policy_description'],
            'file_upload' => $input_details['file_upload'],
        ] );
        }

    }

    public function process_policy_information_status( $input_details ){

        $update_policy_information_tbl = DB::table('company_policy_information');
        $update_policy_information_tbl = $update_policy_information_tbl->where( 'id', '=', $input_details['id'] );
        $status = $input_details['status'];

        $update_policy_information_tbl->update( [
            'status' => $status
        ] );
    }

    public function process_policy_information_delete( $input_details ){

        $update_policy_information_tbl = DB::table('company_policy_information');
        $update_policy_information_tbl = $update_policy_information_tbl->where( 'id', '=', $input_details['id'] );

        $update_policy_information_tbl->delete();
    }
    public function get_profile_info_hr( $input_details ){

            if($input_details['emp_ID'] != ""){
             // DB::enableQueryLog();
            $bandtbl['profile'] = DB::table('customusers')
                        ->select('*')
                        ->where('empID', '=', $input_details['emp_ID'])
                        ->first();

            $bandtbl['image'] = DB::table('images as img')
                        ->select('*')
                        ->where('cus.empID', '=', $input_details['emp_ID'])
                        ->join('customusers as cus', 'cus.empID', '=', 'img.emp_id')
                        ->first();
           // dd(DB::getQueryLog());
        }

        return $bandtbl;
    }

}
