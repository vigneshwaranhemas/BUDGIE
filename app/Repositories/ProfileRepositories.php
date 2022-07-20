<?php
namespace App\Repositories;
use App\band;
use App\blood_group;
use App\candidate_education_information;
use App\candidate_education_details;
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
use App\Role;
use App\welcome_aboard;

class ProfileRepositories implements IProfileRepositories
{
    public function get_account_info( $input_details ){
        if ($input_details['cdID'] != "") {
        $bandtbl = DB::table('candidate_account_information')
                    ->select('*')
                    ->where('cdID', '=', $input_details['cdID'])
                    ->get();
            }else if ($input_details['emp_ID'] != "") {

                $bandtbl = DB::table('candidate_account_information')
                    ->select('*')
                    ->where('emp_id', '=', $input_details['emp_ID'])
                    ->get();
            }

        return $bandtbl;
    }

    public function update_skill_set( $input_details ){

        // echo "<pre>";print_r($input_details);die;
        // DB::enableQueryLog();
        if ($input_details['m_name'] =="") {
            $m_name="";
        }else{
            $m_name=$input_details['m_name'];
        }
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $input_details['emp_id'] );
        $update_roletbl->update( [
            'username' => $input_details['username'],
            'm_name' => $m_name,
            'l_name' => $input_details['l_name'],
            'blood_grp' => $input_details['blood_grp'],
            'gender' => $input_details['gender'],
            'dob' => $input_details['dob'],
            'sec_dob_emp' => $input_details['sec_dob_emp'],
            'marital_status' => $input_details['marital_status'],
            'skill' => $input_details['skill'],
            'skill_secondary' => $input_details['skill_secondary'],
            'language' => $input_details['language'],
            'age_can' => $input_details['age_can'],
            'place_birth_can' => $input_details['place_birth_can'],
            'religion_can' => $input_details['religion_can'],
            'height_can' => $input_details['height_can'],
            'weight_can' => $input_details['weight_can'],
            'identification_can' => $input_details['identification_can'],
            'habits_status' => $input_details['habits_status'],
            'pan_number' => $input_details['pan_number'],
            'aadhar_number' => $input_details['aadhar_number'],
        ] );
        // dd(DB::getQueryLog());
    }

    public function update_account_info( $input_details ){
        
        if ($input_details['emp_id'] !="") {
             $update_roletbl = DB::table('candidate_account_information')->where( 'emp_id', '=', $input_details['emp_id'] );
             $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'acc_name' => $input_details['acc_name'],
            'con_acc_number' => $input_details['con_acc_number'],
            'acc_number' => $input_details['acc_number'],
            'bank_name' => $input_details['bank_name'],
            'ifsc_code' => $input_details['ifsc_code'],
            'acc_mobile' => $input_details['acc_mobile'],
            'branch_name' => $input_details['branch_name'],
            'upi_id' => $input_details['upi_id'],
            'uan_num' => $input_details['uan_num'],
            ] );
        }
       
    }
    public function update_banner_image( $input_details ){

        $update_roletbl = DB::table('candidate_banner_image')->where( 'emp_id', '=', $input_details['emp_id'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'banner_image' => $input_details['banner_image'],
            
        ] );
    }
    public function get_banner_view( $input_details ){

        // echo "<pre>";print_r($input_details);die;

        if ($input_details['cdID'] != "") {
             $bandtbl = DB::table('candidate_banner_image')
                        ->select('*')
                        ->where('cdID', '=', $input_details['cdID'])
                        ->first();
        }else if ($input_details['emp_id'] != "") {
            $bandtbl = DB::table('candidate_banner_image')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['emp_id'])
                        ->first();
        }

       
        return $bandtbl;
    }

    public function insert_education_info( $input_details ){

        $response = candidate_education_details::insert($input_details);
        // echo "<pre>";print_r($response);die;
      return $response;
    }
    public function insert_experience_info( $input_details ){

        $response = DB::table('candidate_experience_details')
                    ->insert($input_details);
        // echo "<pre>";print_r($response);die;
      return $response;
    }

    /*education_info*/
    public function education_info( $input_details ){
         if ($input_details['cdID'] !="") {
                $bandtbl = DB::table('candidate_education_details')
                ->select('*')
                ->where('cdID', '=', $input_details['cdID'])
                ->get();
            }else if ($input_details['emp_id'] !=""){
                $bandtbl = DB::table('candidate_education_details')
                ->select('*')
                ->where('emp_id', '=', $input_details['emp_id'])
                ->get();
            }


        return $bandtbl;
    }
    /*experience_info*/
    public function experience_info( $input_details ){
        if ($input_details['cdID'] !="") {
            $bandtbl = DB::table('candidate_experience_details')
            ->select('*')
            ->where('cdID', '=', $input_details['cdID'])
            ->get();
        }else if ($input_details['emp_id'] !=""){
             // echo "<pre>emp_id";print_r($input_details['emp_id']);die;
            $bandtbl = DB::table('candidate_experience_details')
            ->select('*')
            ->where('empID', '=', $input_details['emp_id'])
            ->get();
        }
        return $bandtbl;
    }
    /*Contact info*/
    public function Contact_info( $input_details ){

        if ($input_details['cdID'] !="") {
             // echo "<pre>cdID";print_r($input_details['cdID']);die;
           $bandtbl = DB::table('candidate_contact_information')
                        ->select('*')
                        ->where('cdID', '=', $input_details['cdID'])
                        ->get();
        }else if ($input_details['emp_id'] !=""){
             // echo "<pre>emp_id";print_r($input_details['emp_id']);die;
            $bandtbl = DB::table('candidate_contact_information')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['emp_id'])
                        ->get();
                    }
        return $bandtbl;
    }
    public function update_contact( $input_details ){

        $update_roletbl = DB::table('candidate_contact_information')->where( 'emp_id', '=', $input_details['emp_id'] );
        $update_roletbl->update( [
            'emp_id' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
            'phone_number'=>$input_details['phone_number'],
            's_number'=>$input_details['s_number'],
            'p_addres'=>$input_details['p_addres'],
            'p_town'=>$input_details['p_town'],
            'p_State'=>$input_details['p_State'],
            'p_district'=>$input_details['p_district'],
            'c_addres'=>$input_details['c_addres'],
            'c_town'=>$input_details['c_town'],
            'c_State'=>$input_details['c_State'],
            'c_district'=>$input_details['c_district'],
            'p_email'=>$input_details['p_email'],
            'p_pin'=>$input_details['p_pin'],
            'c_pin'=>$input_details['c_pin'],
            // 'State'=>$input_details['State'],
        ]);
    }
    public function family_info( $input_details ){
        if ($input_details['cdID'] !="") {
                $bandtbl = DB::table('candidate_family_information')
                ->select('*')
                ->where('cdID', '=', $input_details['cdID'])
                ->get();
            }else if ($input_details['emp_id'] !=""){
                $bandtbl = DB::table('candidate_family_information')
                ->select('*')
                ->where('emp_id', '=', $input_details['emp_id'])
                ->get();
            }

        return $bandtbl;
    }
    public function state_listing(){
        // DB::enableQueryLog();
        $bandtbl = DB::table('towns_details')
        ->select('id','state_name')
        ->groupBy('state_name')
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }
    public function get_district_listing($input_details){
        // DB::enableQueryLog();
        $bandtbl = DB::table('towns_details')
        ->select('id','district_name','state_name')
        ->where('state_name', '=' ,$input_details['state_name'])
        ->groupBy('district_name')
        ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
    }
    public function get_town_name_listing($input_details){
        // DB::enableQueryLog();
        $bandtbl = DB::table('towns_details')
        ->select('id','district_name','town_name','state_name')
        ->where('district_name', '=' ,$input_details['district_name'])
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }

    public function get_idcard_info( $input_details ){

        // echo "<pre>";print_r($input_details);die;
        // DB::enableQueryLog();
        $bandtbl = DB::table('customusers');
        if ($input_details['cdID'] != "") {
        $where = $bandtbl->where('cdID', '=', $input_details['cdID']);
        }else if($input_details['empID'] != ""){
         $where = $bandtbl->where('empID', '=', $input_details['empID']);
        }
        return  $where
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }

    public function update_idcard_info( $input_details ){
// echo "<pre>";print_r($input_details);die;
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $input_details['empID'] );
        $update_roletbl->update( [
            // 'empID' => $input_details['emp_id'],
            'cdID' => $input_details['cdID'],
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
            'hr_action'=>$input_details['hr_action'],
            'p_email'=>$input_details['p_email'],
            'hr_id_remark'=>$input_details['hr_id_remark'],
        ] );
    }
    /*Contact  hr info*/
    public function Contact_hr_info( $input_details ){

             // echo "<pre>";print_r($input_details['emp_id']);die;
        if ($input_details['emp_id'] !=""){
            $bandtbl = DB::table('candidate_contact_information')
                        ->select('*')
                        ->where('emp_id', '=', $input_details['emp_id'])
                        ->get();
                    }
        return $bandtbl;
    }
    public function get_qualification(){
        // DB::enableQueryLog();
        $bandtbl = DB::table('education_list')
        ->select('id','Qualification')
        ->groupBy('Qualification')
        ->orderBy('id')
        ->get();
        // dd(DB::getQueryLog());

        return $bandtbl;
    }
    public function get_course_val($input_details){
        $bandtbl = DB::table('education_list')
        ->select('*')
        ->where('Qualification', '=', $input_details['qualification'])
        ->get();
        return $bandtbl;
    }
    /*experience_info*/
    public function getemployee_name_list(){
        // DB::enableQueryLog();
            $bandtbl = DB::table('customusers')
            ->select('username','m_name','l_name','empID')
            ->where('active', '=', 1)
            ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
    }
/*list in customuser */
    public function get_result_data($data){
            $bandtbl = DB::table('customusers')
            ->select($data)
            ->groupby($data)
            ->get();
        return $bandtbl;
    }
    /*get_grade_data*/
    public function get_grade_data(){
            $bandtbl = DB::table('grades')
            ->select('grade_name')
            ->get();
        return $bandtbl;
    }
    public function update_reviewer_reporting_mrg( $input_details ){
        // DB::enableQueryLog();
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $input_details['emp_id'] );
        $update_roletbl->update(["sup_emp_code" => $input_details['reporting_manager'],
                               'reviewer_emp_code'=>  $input_details['reviewer'],
                               'sup_name'=> $input_details['Reporting_val'],
                               'reviewer_name'=>  $input_details['reviewer_val'], ]);
        // dd(DB::getQueryLog());
         return $update_roletbl;
    }
    public function update_hr_working_information( $input_details ){
        // DB::enableQueryLog();
        $update_roletbl = DB::table('customusers')->where( 'empID', '=', $input_details['emp_id'] );
        $update_roletbl->update([
                            'department' => $input_details['Department'],
                           'designation'=>  $input_details['Designation'],
                           'worklocation'=> $input_details['work_location'],
                           'doj'=> $input_details['doj_pop'],
                           'payroll_status'=> $input_details['intake'],
                           'ctc_per_annual'=> $input_details['CTC'],
                           'grade'=>  $input_details['grade_val'],
                           'RFH'=> $input_details['rfh'],
                           ]);
        // dd(DB::getQueryLog());
         return $update_roletbl;
    }
   
   public function insert_followup_reviewer( $input_details,$table ){
    // DB::enableQueryLog();
      DB::table($table)->insert($input_details);
      // dd(DB::getQueryLog());
   }
   public function followup_information_data( $input_details){
    // DB::enableQueryLog();
       $bandtbl = DB::table('department_followup_details')
                        ->select('*')
                        ->where('emp_id',$input_details)
                        ->get();
        return $bandtbl;
      // dd(DB::getQueryLog());
   }
   public function hr_followup_information_data( $input_details){
    // DB::enableQueryLog();
       $bandtbl = DB::table('department_followup_details')
                        ->select('*')
                        ->where('emp_id',$input_details['emp_id'])
                        ->get();
        return $bandtbl;
      // dd(DB::getQueryLog());
   }
     

}