<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\ICommonRepositories;
use App\Models\CustomUser;
use App\Models\StickyNotesModel;
use App\Goals;
use Auth;

class CommonRepositories implements ICommonRepositories
{
     public function get_profile_banner_hr($input_details)
    {
        if ($input_details['empID'] != "") {
            $bandtbl = DB::table('candidate_banner_image')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['empID'])
                        ->first();
        }
        return $bandtbl;
    }
    public function get_candidate_info_hr( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
      /* $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('id', '=', $input_details['id'])
        ->get();
        return $bandtbl;*/
         // echo "11<pre>";print_r($input_details);die;
             // DB::enableQueryLog();
            $bandtbl['profile'] = DB::table('customusers')
                        ->select('*')
                        ->where('id', '=', $input_details['id'])
                        ->first();

            $bandtbl['image'] = DB::table('images as img')
                        ->select('*')
                        ->join('customusers as cus', 'cus.empID', '=', 'img.emp_id')
                        ->where('cus.empID', '=', $input_details['empID'])
                        ->first();
           // dd(DB::getQueryLog());
            return $bandtbl;
    }
    public function get_myteam_info_view( $input_details ){
      
            $bandtbl['image'] = DB::table('images as img')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['empID'])
                        ->first();
            $bandtbl['profile'] = DB::table('customusers')
                        ->select('*')
                        ->where('empID', '=', $input_details['empID'])
                        ->first();

            $bandtbl['banner_img'] = DB::table('candidate_banner_image')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['empID'])
                        ->first();
           // dd(DB::getQueryLog());
            return $bandtbl;
    }
    public function get_candidate_info_hr2( $input_details ){
        $bandtbl = DB::table('candidate_contact_information')
        ->select('*')
        ->where('emp_id', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function account_hr_info( $input_details ){

        $bandtbl = DB::table('candidate_account_information')
        ->select('*')
        ->where('emp_id', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function education_hr_info( $input_details ){

        $bandtbl = DB::table('candidate_education_details')
        ->select('*')
        ->where('emp_id', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function get_candidate_exp_hr( $input_details ){

        $bandtbl = DB::table('candidate_experience_details')
        ->select('*')
        ->where('empID', '=', $input_details['empID'])
        ->get();
        return $bandtbl;
    }
    public function family_info_to_hr( $input_details ){
       // DB::enableQueryLog();
        $bandtbl = DB::table('candidate_family_information')
        ->select('*')
        ->where('emp_id', '=', $input_details['emp_id'])
        ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
    }

    public function update_hr_idcard_info( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'id', '=', $input_details['can_id'] );

        if ($input_details['img_path'] != "") {

           $update_roletbl->update( [
            'img_path'=>$input_details['img_path'],
            'username'=>$input_details['f_name'],
            'm_name'=>$input_details['m_name'],
            'l_name'=>$input_details['l_name'],
            'worklocation'=>$input_details['working_loc'],
            'contact_no'=>$input_details['emp_num_1'],
            'emp_num_2'=>$input_details['emp_num_2'],
            'rel_emp'=>$input_details['rel_emp'],
            'name_rel_ship'=>$input_details['name_rel_ship'],
            'emrg_con_num'=>$input_details['emrg_con_num'],
            'doj'=>$input_details['doj'],
            'blood_grp'=>$input_details['blood_grp'],
            'empID'=>$input_details['empID'],
            'email'=>$input_details['official_email'],
            'dob'=>$input_details['emp_dob'],
            'p_email'=>$input_details['p_email'],
            'hr_action'=>'2',
            'hr_id_remark'=>'',
        ] );
        }else{
            $update_roletbl->update( [
            'username'=>$input_details['f_name'],
            'm_name'=>$input_details['m_name'],
            'l_name'=>$input_details['l_name'],
            'worklocation'=>$input_details['working_loc'],
            'contact_no'=>$input_details['emp_num_1'],
            'emp_num_2'=>$input_details['emp_num_2'],
            'rel_emp'=>$input_details['rel_emp'],
            'name_rel_ship'=>$input_details['name_rel_ship'],
            'emrg_con_num'=>$input_details['emrg_con_num'],
            'doj'=>$input_details['doj'],
            'blood_grp'=>$input_details['blood_grp'],
            'empID'=>$input_details['empID'],
            'email'=>$input_details['official_email'],
            'dob'=>$input_details['emp_dob'],
            'p_email'=>$input_details['p_email'],
            'hr_action'=>'2',
            'hr_id_remark'=>'',
        ] );
        }

    }

    public function update_hr_idcard_remark( $input_details ){
        // echo "11<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'id', '=', $input_details['can_id_hr'] );
        $update_roletbl->update( [
            'hr_id_remark'=>$input_details['id_remark'],
            'hr_action'=>'3',
        ] );
    }




    public function check_user_status($id){
             $result=CustomUser::select('hr_action','pms_status')->where('empID',$id)->first();
             return $result;
    }
    public function user_status_pms($id){
         $result['customusers']=CustomUser::select('pms_eligible_status')
                            ->where('empID',$id)
                            ->where('pms_eligible_status','=',1)
                            ->first();
          if ($result['customusers'] !="") {
                   $response['customusers'] = 1;
                }else{
                   $response['customusers'] = 0;
                }                  

                $data=Goals::where('created_by',$id)->get();
                $count=$data->count();

                        if ($count != 0) {
                        $result['goals']=Goals::select('employee_status')
                                            ->where('created_by',$id)
                                            ->where('employee_status','=',0)
                                            ->first();
                              if ($result['goals']!="") {
                                       $response['goals'] = 0;
                                    }else{
                                       $response['goals'] = 1;
                                    }  
                        }else{
                            $response['goals'] = 0;
                        }
                       
        return $response;
    }

    public function get_organization_info()
    {
        $organisation['reviewer']=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $organisation['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$organisation['reviewer']->empID)->get();
        foreach($organisation['supervisors'] as $supervisors){
          $team_leaders[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$supervisors['empID'])->get();
        }
        $organisation['team_leaders']=$team_leaders;
        foreach($organisation['team_leaders'] as $teamleaders){
            foreach($teamleaders as $leaders)
            {
                      $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$leaders['empID'])->get();

            }
        }
      $organisation['employees']=$emp;
        return $organisation;
    }
    public function get_organization_info_one()
    {
        $organisation['reviewer']=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $organisation['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$organisation['reviewer']->empID)->get();
        foreach($organisation['supervisors'] as $supervisors){
          $team_leaders[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$supervisors['empID'])->get();
        }
        $organisation['team_leaders']=$team_leaders;
        foreach($organisation['team_leaders'] as $teamleaders){
              foreach($teamleaders as $leaders)
              {
                        $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$leaders['empID'])->get();

              }
          }
        $organisation['employees']=$emp;
        return $organisation;
    }
    public function supervisor_wise_info($id)
    {
        $organisation=CustomUser::select('empID','username','img_path','designation')->where('sup_name','CKR')->first();
        $supervisor['supervisors']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$id)->get();
        $supervisor['supervisor_info']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('empID',$id)->first();
        $supervisor['team_leaders']=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$id)->get();
        foreach($supervisor['team_leaders'] as $teamleaders){
            $emp[]=CustomUser::select('empID','username','img_path','sup_emp_code','designation')->where('sup_emp_code',$teamleaders['empID'])->get();
          }
        $supervisor['employees']=$emp;
        return $supervisor;
    }
    public function change_password_process( $form_credentials ){

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $form_credentials['empID'] );
        $update_mdlusertbl->update( [
            'passcode' => $form_credentials['confirm_password'],
            'passcode_status' => $form_credentials['passcode_status']
        ] );
    }

   /* public function update_reset_pass( $data ){
        // echo "22<pre>";print_r($data);die;

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $data['empID'] );

        $update_mdlusertbl->update( [
            'passcode_token' => $data['passcode_token'],
        ] );
    }*/
    public function update_password( $data ){

        $update_mdlusertbl = new CustomUser();
        $update_mdlusertbl = $update_mdlusertbl->where( 'empID', '=', $data['emp_id'] );

        $update_mdlusertbl->update( [
            'passcode' => $data['passcode'],
        ] );
    }

    public function Store_StickyNotes($data)
    {
        $result=StickyNotesModel::insert($data);
        return $result;
    }
    public function Fetch_Notes($data)
    {
         $result=StickyNotesModel::select('id','empID','Notes','color','updated_at')->where($data)->get();
         if($result){
             return $result;
         }
         else{
             return false;
         }
    }
    public function Fetch_Notes_id_wise($data)
    {
        $result=StickyNotesModel::select('id','empID','Notes','color','updated_at')->where($data)->first();
         if($result){
             return $result;
         }
         else{
             return false;
         }
    }
    public function Update_Notes_id_wise($data,$id)
    {
        $result=StickyNotesModel::where('id',$id)->update($data);
        if($result){
            return $result;
        }
        else{
            return false;
        }

    }
    public function pms_oneor_not($id)
    {
         $result=CustomUser::select('pms_status')->where('empID',$id)->first();
        return $result;
    }
     public function pms_oneor_not_naps($id)
    {
         $result=CustomUser::select('pms_status')
                             ->where('empID',$id)
                             ->where('payroll_status','NAPS')
                             ->first();
        return $result;
    }
    public function Delete_Notes_id_wise($coloumn,$id)
    {
        $result = StickyNotesModel::where($coloumn, $id)->delete();
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    

    public function my_team_tl_info($input_details){
        // DB::enableQueryLog();
        $mdlrecreqtbl = DB::table('customusers as cs');
        $mdlrecreqtbl = $mdlrecreqtbl->select('cs.empID','username','img_path','sup_emp_code','designation','skill','path','banner_image');
        $mdlrecreqtbl = $mdlrecreqtbl->leftjoin('images as im', 'cs.empID', '=', 'im.emp_id');
        $mdlrecreqtbl = $mdlrecreqtbl->leftjoin('candidate_banner_image as cbi', 'cs.empID', '=', 'cbi.emp_id');

            if ($input_details['team_member_name']!="") {    
            $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.empID',$input_details['team_member_name']);
            }

                    $mdlrecreqtbl->where(function($query) use ($input_details){
                           $query->where('sup_emp_code',$input_details['id'])
                                ->orwhere('reviewer_emp_code',$input_details['id']);
                        });
        $mdlrecreqtbl =  $mdlrecreqtbl->get();

        // echo "<pre>";print_r($mdlrecreqtbl);die;
        // dd(DB::getQueryLog()); 


       /* $supervisor['supervisor']=CustomUser::select('customusers.empID','username','img_path','sup_emp_code','designation','skill','path','banner_image')
                                ->leftjoin('images', 'customusers.empID', '=', 'images.emp_id')
                                ->leftjoin('candidate_banner_image', 'customusers.empID', '=', 'candidate_banner_image.emp_id')
                                ->where('sup_emp_code',$id)
                                ->orwhere('reviewer_emp_code',$id)
                                ->get();*/
        return $mdlrecreqtbl;

    }
     public function my_team_experience($id){
        // DB::enableQueryLog();
       $exp['exp']=CustomUser::select(DB::raw("DATEDIFF(exp_start_month, exp_end_month) AS days"))
                                ->leftjoin('candidate_experience_details','customusers.empID' ,'=', 'candidate_experience_details.empID') 
                                ->where('sup_emp_code',$id)
                                ->orwhere('reviewer_emp_code',$id)
                                ->groupBy('candidate_experience_details.empID')
                                ->get();
        // dd(DB::getQueryLog());        
        return $exp;

    }
    public function pms_submit($id,$val){
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $id );
        $update_roletbl->update( [
            'pms_status'=>$val,
        ] );

    }
    public function delete_pro_img($id){
        // DB::enableQueryLog();
        $result = DB::table('images')->where('emp_id', '=', $id)->delete();
        // dd(DB::getQueryLog());
        return $result;
    }
    public function delete_other_doc_profile($id,$table,$clm){
        // DB::enableQueryLog();
        $update_roletbl = DB::table($table)->where( 'emp_id', '=', $id );
        $update_roletbl->update( [
            $clm=>'',
        ] );
        // dd(DB::getQueryLog());
        $update_roletbl = 1;
        return $update_roletbl;
    }
    public function my_teams_list_result_name($id){
        $my_teams_members=CustomUser::select('username','m_name','l_name','empID')
                                ->where('sup_emp_code',$id)
                                ->orwhere('reviewer_emp_code',$id)
                                ->get();
        return $my_teams_members;

    }
    public function login_access_update(){
       $empID = Auth::user()->empID;
        // DB::enableQueryLog();
       $update_roletbl = DB::table('customusers')->where( 'empID', '=', $empID);
        $update_roletbl->update( [
            'login_access'=>'1',
        ] );
        // dd(DB::getQueryLog());
    }
    public function login_access_update_logout(){
       $empID = Auth::user()->empID;
        // DB::enableQueryLog();
       $update_roletbl = DB::table('customusers')->where( 'empID', '=', $empID);
        $update_roletbl->update( [
            'login_access'=>'0',
        ] );
        // dd(DB::getQueryLog());
    }
    public function login_access_status(){
        $empID = Auth::user()->empID;
        $my_teams_members=CustomUser::select('login_access')
                                ->where('empID',$empID)
                                ->get();
        return $my_teams_members;

    }
}
