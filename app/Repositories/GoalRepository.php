<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Goals;
use Carbon\Carbon;
use Auth;
use App\Models\CustomUser;
class GoalRepository implements IGoalRepository
{

   public function add_goals_insert( $data ){
      $response = Goals::insertGetId($data);
      return $response;
   }
   public function insertGoalsCode($goal_unique_code, $last_inserted_id){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('id', $last_inserted_id)
                  ->where('created_by', $logined_empID)
                  ->update([
                        'goal_unique_code' => $goal_unique_code
                  ]);
      return $response;
   }
   public function get_hr_goal_list_tb($input_details){
      // echo "<pre>";print_r($logined_empID);die;
       // DB::enableQueryLog();
         $logined_empID = Auth::user()->empID;
         $mdlrecreqtbl = DB::table('customusers as cs');
         $mdlrecreqtbl = $mdlrecreqtbl->distinct();
         $mdlrecreqtbl = $mdlrecreqtbl->select('g.*');
         $mdlrecreqtbl = $mdlrecreqtbl->join('goals as g', 'g.created_by', '=', 'cs.empID');
         /**/
         if ($input_details['supervisor_list'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.empID', $input_details['supervisor_list']);
            }
         if ($input_details['payroll_status_sup'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.payroll_status', $input_details['payroll_status_sup']);
            }
         $mdlrecreqtbl = $mdlrecreqtbl->where('cs.sup_emp_code', $logined_empID);
         // $mdlrecreqtbl = $mdlrecreqtbl->where('cs.reviewer_emp_code', "900531");
         $mdlrecreqtbl = $mdlrecreqtbl->get();
      // dd(DB::getQueryLog());

      return $mdlrecreqtbl;
   }
    public function get_goal_list(){

        $logined_empID = Auth::user()->empID;
      // DB::enableQueryLog();
        $response = Goals::select('*')

                ->where('created_by', $logined_empID)

                ->get();
      // dd(DB::getQueryLog());
        return $response;

    }
    public function get_goal_myself_list(){

        $logined_empID = Auth::user()->empID;

        $response = Goals::select('*')

                ->where('created_by', $logined_empID)

                ->get();

        return $response;

    }

    public function get_team_member_goal_list($input_details){

      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers as cs');
      $response = $response->distinct();
      $response = $response->select('g.*');
      $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');

      if($input_details['team_member_filter'] != ''){
          $response = $response->where('g.employee_status', "1");
          $response = $response->where('cs.empID', $input_details['team_member_filter']);
      }
      if($input_details['payroll_status_filter'] != ''){
          $response = $response->where('g.employee_status', "1");
          $response = $response->where('cs.payroll_status', $input_details['payroll_status_filter']);
          $response = $response->where('cs.sup_emp_code', $logined_empID);
      }
      if($input_details['team_member_filter'] == ''  && $input_details['payroll_status_filter'] == ''){
          $response = $response->where('g.employee_status', "1");
          $response = $response->where('cs.sup_emp_code', $logined_empID);
      }
       $response = $response->get();

      return $response;
 }
 public function get_reviewer_goal_list($input_details){
   $logined_empID = Auth::user()->empID;

   $response = DB::table('customusers as cs');
   $response = $response->distinct();
   $response = $response->select('g.*');
   $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');
   if($input_details['team_leader_filter'] != ''){
       $response = $response->where('cs.empID', $input_details['team_leader_filter']);
   }
   if($input_details['payroll_status_filter'] != ''){
       $response = $response->where('cs.payroll_status', $input_details['payroll_status_filter']);
       $response = $response->where('cs.sup_emp_code',$logined_empID);
   }
   if($input_details['team_leader_filter'] == ''  && $input_details['payroll_status_filter'] == ''){
       $response = $response->where('cs.sup_emp_code', $logined_empID);
   }
    $response = $response->get();

   return $response;
}
   public function get_team_member_drop_list( $id ){
      // DB::enableQueryLog();
      $bandtbl = DB::table('customusers')
      ->select('*')
      ->where('sup_emp_code', '=', $id)
      ->get();
      // dd(DB::getQueryLog());
      return $bandtbl;
   }
  public function get_bh_goal_list($input_details){

      $logined_empID = Auth::user()->empID;

      $response = DB::table('customusers as cs');
      $response = $response->distinct();
      $response = $response->select('g.*');
      $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $response = $response->where('g.supervisor_status', "1");
      $response = $response->where('g.reviewer_status', "1");
      $response = $response->where('g.hr_status', "1");
      $response = $response->where('g.employee_status', "1");
      if ($input_details['reviewer_filter'] != '') {
      $response = $response->where('cs.reviewer_emp_code', $input_details['reviewer_filter']);
      }
      if ($input_details['team_leader_filter'] != '') {
         $response = $response->where('cs.sup_emp_code', $input_details['team_leader_filter']);
      }
      if ($input_details['team_member_filter'] != '') {
        $response = $response->where('cs.empID', $input_details['team_member_filter']);
        }
      if ($input_details['payroll_status'] != '') {
        $response = $response->where('cs.payroll_status', $input_details['payroll_status']);
      }
      if ($input_details['department'] != '') {
        $response = $response->where('cs.department', $input_details['department']);
      }
      if ($input_details['gender'] != '') {
        $response = $response->where('cs.gender', $input_details['gender']);
      }
      if ($input_details['grade'] != '') {
        $response = $response->where('cs.grade', $input_details['grade']);
      }
      if($input_details['team_leader_filter'] == ''  && $input_details['team_member_filter']== '' && $input_details['reviewer_filter']==''  && $input_details['payroll_status']==''  && $input_details['department']==''
         && $input_details['gender']==''  && $input_details['grade']==''){
        $response = $response->where('cs.reviewer_emp_code','!=',$logined_empID);
        $response = $response->where('cs.reviewer_emp_code','!=',$logined_empID);
      }
            $response = $response->get();


      return $response;
   }
   public function fetchGoalIdDetails( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_process');
    //    echo "1<pre>";print_r($response);die;
      return $response;
   }
   public function fetchGoalIdDetailsHR( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_process');
    //    echo "1<pre>";print_r($response);die;
      return $response;
   }
   public function Fetch_goals_user_info($id)
   {
        $user_info=Goals::join('customusers','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$id)
        ->select('customusers.*')->first();
        return $user_info;

   }
   public function checkSupervisorIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      // echo "1<pre>";print_r($id);die;
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      return $response;
   }
   public function checkReviewerIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;
      $supervisor = DB::table('customusers')->where('reviewer_emp_code', $logined_empID)->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      $teamleader=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
      $result=0;
      if($supervisor){
           $result=1;
      }
      if($teamleader){
          $result=2;
      }
    //   echo json_encode($empID);die();
      return $result;
   }
   public function fetchGoalIdHead( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('goal_name');
      return $response;
   }
   public function goals_consolidate_rate_head( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('employee_consolidated_rate');
      return $response;
   }
   public function goals_sup_submit_status( $id ){
      $tb1 = Goals::where('goal_unique_code', $id)->where('supervisor_tb_status', "1")->value('supervisor_tb_status');
      $tb2 = Goals::where('goal_unique_code', $id)->where('supervisor_tb_status', "1")->where('supervisor_status', "1")->value('supervisor_status');
      if(!empty($tb1)){
         if($tb2 == 1){
            $response = "2"; //overall submited
         }else{
            $response = "1"; //save only not submit

         }

      }else{
         $response = "0"; //new entry
      }
      return $response;
   }
   public function goals_sup_consolidate_rate_head( $id ){
      $response = Goals::where('goal_unique_code', $id)->get();
      return $response;
   }
   public function goals_sup_pip_exit_select_op( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('supervisor_pip_exit');
      return $response;
   }
   public function fecth_goals_sup_movement_process( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('sup_movement_process');
      return $response;
   }
   public function fetchGoalIdDelete( $id ){
      $response = Goals::where('goal_unique_code', $id)->delete();
      return $response;
   }
   public function add_goals_update($data){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                  ->where('created_by', $logined_empID)
                  ->update([
                        'goal_process' => $data['goal_process']
                  ]);
      return $response;
   }
   public function goal_employee_summary_check($id){
      $employee_summary = Goals::where('goal_unique_code', $id)->where('goal_status', "Approved")->where('bh_status', "1")->where('hr_status', "1")->value('goal_name');
      // dd($employee_summary);
      if(!empty($employee_summary)){
         $summary = Goals::where('goal_unique_code', $id)->where('goal_status', "Approved")->where('bh_status', "1")->where('hr_status', "1")->value('employee_summary');
         if(!empty($summary)){

            $sup_summary = Goals::where('goal_unique_code', $id)->where('goal_status', "Approved")->where('bh_status', "1")->where('hr_status', "1")->value('supervisor_summary');

            if(!empty($sup_summary)){

               $response = "3";

            }else{
               $response = "2";

            }

         }else{
            $response = "1";

         }
      }else{
         $response = "0";
      }
      return $response;
   }
   public function goals_supervisor_summary($id, $sup_summary){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('goal_unique_code', $id)
                  ->update([
                        'supervisor_summary' => $sup_summary
                  ]);
      return $response;
   }
   public function update_goals_sup($data){
    $response = Goals::where('goal_unique_code', $data['goal_unique_code'])

                      ->update([

                            'goal_process' => $data['goal_process'],

                            'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],

                            'supervisor_pip_exit' => $data['supervisor_pip_exit'],

                            'supervisor_tb_status' => "1",

                      ]);

    return $response;

 }
   public function update_goals_sup_save($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_status' => "1",
                        ]);
      return $response;
   }
   public function update_goals_sup_submit($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_tb_status' => "1",
                              'supervisor_status' => "1",
                              'supervisor_pip_exit' => $data['supervisor_pip_exit'],
                        ]);
      return $response;
   }

   public function update_emp_goals_data($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'employee_consolidated_rate' => $data['employee_consolidated_rate'],
                              'employee_tb_status' => "1",
                        ]);
      return $response;
   }
   public function update_emp_goals_data_submit($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'employee_consolidated_rate' => $data['employee_consolidated_rate'],
                              'employee_tb_status' => "1",
                              'employee_status' => "1",
                        ]);

      return $response;
   }
   public function goals_status_update($data){
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                  ->update([
                        'goal_status' => $data['goal_status']
                  ]);
      return $response;
   }
   public function add_goal_btn(){
      $logined_empID = Auth::user()->empID;
      $logined_pms_status = Auth::user()->pms_status;
      $response1 = Goals::where('created_by', $logined_empID)->where('goal_status', 'Pending')->value('goal_name');
      $response2 = Goals::where('created_by', $logined_empID)->where('goal_status', 'Revert')->value('goal_name');

      // dd($response2);

      if($logined_pms_status == 1){

         $response = "No"; //show

         if(!empty($response1) || !empty($response2)){
            // dd("y")
            $response = "Yes";
         }else{
            // dd("n");
            $response = "No";
         }


      }else{
         $response = "Yes"; //not show
      }

      return $response;

   }
   public function add_goal_btn_login(){
      $logined_payroll_status = Auth::user()->payroll_status;
      if($logined_payroll_status == "NAPS"){
         $response = "NAPS";
      }else{
         $response = "HEPL";
      }
      return $response;

   }
   public function checkCustomUserList(){
      $logined_empID = Auth::user()->empID;
      $logined_username = Auth::user()->username;
      $reviewer = DB::table('customusers')->where('reviewer_emp_code', $logined_empID)->value('empID');
      $supervisor = DB::table('customusers')->where('sup_emp_code', $logined_empID)->value('empID');

      if(!empty($reviewer)){
         $response = "Reviewer";
      }elseif(!empty($supervisor)){
         $response = "Supervisor";
      }else{
         $response = "no";
      }
      return $response;
   }
   public function fetchSupervisorList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->get();
      return $response;
   }
   public function fetchSupervisorListHaveTm(){
      $logined_empID = Auth::user()->empID;
      $sup_lists = DB::table('customusers')->where('sup_emp_code', $logined_empID)->get();

      foreach($sup_lists as $sup_lists){

         $sup_list_tm = DB::table('customusers')->where('sup_emp_code', $sup_lists->empID)->value("sup_emp_code");

         if(!empty($sup_list_tm)){
            $datas[] = ($sup_lists->empID);
         }
      }

      if(!empty($datas)){
         $op ='<option value="">...Select...</option>';
         foreach($datas as $data){
            $name = DB::table('customusers')->where('empID', $data)->value("username");
            $op .= '<option value="'.$data.'">'.$name.'</option>';
         }
      }
      return $op;
   }
   public function fetchReviewerList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('reviewer_emp_code', "900531")->get();

      return $response;
   }
  /* public function fetchHrList(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('reviewer_emp_code', "900380")->get();
      return $response;
   }*/
   public function fetch_supervisor_filter($supervisor_filter){
      if($supervisor_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $supervisor_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function fetch_reviewer_filter($reviewer_filter){
      if($reviewer_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $reviewer_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function fetch_team_leader_filter($team_leader_filter){
      if($team_leader_filter != ''){
         $customusers = DB::table('customusers')->where('sup_emp_code', $team_leader_filter)->get();
         $output = '';
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      }
      return $output;
   }
   public function addGoalEmployeeSummary($id, $employee_summary){
        $logined_empID = Auth::user()->empID;
        $response = Goals::where('goal_unique_code', $id)
                  ->where('created_by', $logined_empID)
                  ->update([
                        'employee_summary' => $employee_summary
                  ]);
      return $response;
   }
   public function check_goals_employee_summary($id){
      $result = Goals::where('goal_unique_code', $id)->value('employee_summary');
      if(!empty($result)){
         $response = "Yes";
      }else{
         $response = "No";
      }
      return $response;
   }
   public function fetch_goals_employee_summary($id){
      $response = Goals::where('goal_unique_code', $id)->value('employee_summary');
      return $response;
   }
   public function fetch_goals_supervisor_summary($id){
      $response = Goals::where('goal_unique_code', $id)->value('supervisor_summary');
      return $response;
   }
   public function get_supervisor_data( $id ){
       $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
        return $bandtbl;
   }
   public function fetch_team_member_list( $id ){
       // echo "<pre>w";print_r($id);die;
      // DB::enableQueryLog();
       $bandtbl = DB::table('customusers')
           ->select('*')
           ->where('sup_emp_code', $id)
           ->get();
      // dd(DB::getQueryLog());
           return $bandtbl;

   }
   public function fetch_reviewer_res_data( $id ){
      // DB::enableQueryLog();
       $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
      // dd(DB::getQueryLog());
        return $bandtbl;
   }
   public function fetch_reviewer_tab_data( $input_details ){
      // echo "<pre>";print_r($input_details);die;
      // DB::enableQueryLog();
        $logined_empID = Auth::user()->empID;
        $mdlrecreqtbl = DB::table('customusers as cs');
        $mdlrecreqtbl = $mdlrecreqtbl->select('g.*');
        $mdlrecreqtbl = $mdlrecreqtbl->join('goals as g', 'g.created_by', '=', 'cs.empID');

        if ($input_details['supervisor_list_1'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['supervisor_list_1']);
            }
         if ($input_details['payroll_status_rev'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.payroll_status', $input_details['payroll_status_rev']);
            }
         if ($input_details['team_member_filter'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.empID', $input_details['team_member_filter']);
            }
               $mdlrecreqtbl =  $mdlrecreqtbl->where('g.supervisor_status',  1);
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.pms_eligible_status',  1);
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.active',  1);
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.reviewer_emp_code', $logined_empID);
               $mdlrecreqtbl =  $mdlrecreqtbl->get();
          // dd(DB::getQueryLog());

      return $mdlrecreqtbl;
   }

   public function get_supervisor_hr( $id ){
    // DB::enableQueryLog();
    $bandtbl = DB::table('customusers')
    ->select('*')
    ->where('reviewer_emp_code', '=', $id)
    ->where('sup_emp_code', '=', $id)
    ->get();
    // dd(DB::getQueryLog());
    return $bandtbl;
    }

   public function get_hr_goal_list_for_tbl($input_details){


        $logined_empID = Auth::user()->empID;
      // echo "<pre>";print_r($logined_empID);die;

         // DB::enableQueryLog();
        $mdlrecreqtbl = DB::table('customusers as cs');
        $mdlrecreqtbl = $mdlrecreqtbl->select('g.*','cs.grade','cs.gender','cs.department');
        $mdlrecreqtbl = $mdlrecreqtbl->leftJoin('goals as g', 'g.created_by', '=', 'cs.empID');
         /**/
         if ($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter_hr']=="") {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['reviewer_filter']);
            }
         if ($input_details['reviewer_filter'] != '' && $input_details['team_leader_filter_hr']!="") {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['team_leader_filter_hr']);
            }
            /**/
         if ($input_details['team_leader_filter_hr'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['team_leader_filter_hr']);
            }
         if ($input_details['team_member_filter_hr'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.empID', $input_details['team_member_filter_hr']);
            }
         if ($input_details['gender_hr_2'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.gender', $input_details['gender_hr_2']);
            }
         if ($input_details['grade_hr_2'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.grade', $input_details['grade_hr_2']);
            }
         if ($input_details['department_hr_2'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.department', $input_details['department_hr_2']);
            }
         if ($input_details['payroll_status_hr'] != '') {
               $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.payroll_status', $input_details['payroll_status_hr']);
            }
            /*empty*/
           /* if ($input_details['reviewer_filter'] =="" && $input_details['gender_hr_2'] =="" && $input_details['grade_hr_2'] =="" && $input_details['department_hr_2']=="" && $logined_empID !="HRO1") {
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', "900531");
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.reviewer_emp_code', "900531");
            }*/
            if ($input_details['reviewer_filter'] =="" && $input_details['gender_hr_2'] =="" && $input_details['grade_hr_2'] =="" && $input_details['department_hr_2']=="" ) {
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', "900531");
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.reviewer_emp_code', "900531");
            }
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('supervisor_status',1);
                   $mdlrecreqtbl =  $mdlrecreqtbl->where('reviewer_status',1);
                   $mdlrecreqtbl =  $mdlrecreqtbl->whereNotNull('g.id');
                   $mdlrecreqtbl =  $mdlrecreqtbl->get();

        // dd(DB::getQueryLog());

        return $mdlrecreqtbl;
}

    public function get_manager_lsit( $id ){
        // DB::enableQueryLog();
        $bandtbl = DB::table('customusers')
        ->select('*')
        ->where('sup_emp_code', '=', $id)
        ->get();
        // dd(DB::getQueryLog());
        return $bandtbl;
   }

   public function gethr_list_tab_record($input_details){

         // echo "<pre>";print_r($input_details);die;
      $logined_empID = Auth::user()->empID;
      // DB::enableQueryLog();
      $mdlrecreqtbl = DB::table('customusers as cs');
      $mdlrecreqtbl = $mdlrecreqtbl->select('g.*','cs.grade','cs.gender','cs.department');
      $mdlrecreqtbl = $mdlrecreqtbl->leftJoin('goals as g', 'g.created_by', '=', 'cs.empID');

               /**/
            if ($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1']=="") {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['reviewer_filter_1']);
               }
            if ($input_details['reviewer_filter_1'] != '' && $input_details['team_leader_filter_hr_1']!="") {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1']);
               }
            if ($input_details['team_leader_filter_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.sup_emp_code', $input_details['team_leader_filter_hr_1']);
               }
            if ($input_details['team_member_filter_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.empID', $input_details['team_member_filter_hr_1']);
               }
            if ($input_details['gender_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.gender', $input_details['gender_hr_1']);
               }
            if ($input_details['grade_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.grade', $input_details['grade_hr_1']);
               }
            if ($input_details['department_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.department', $input_details['department_hr_1']);
               }
            if ($input_details['payroll_status_hr_1'] != '') {
                  $mdlrecreqtbl =  $mdlrecreqtbl->where('cs.payroll_status', $input_details['payroll_status_hr_1']);
               }

                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.goal_status' , "Approved");
                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.employee_status',  1);
                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.supervisor_status',  1);
                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.reviewer_status',  1);
                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.bh_status',  1);
                      $mdlrecreqtbl =  $mdlrecreqtbl->where('g.hr_status',  1);
                      $mdlrecreqtbl =  $mdlrecreqtbl->whereNotNull('g.id');
                      $mdlrecreqtbl =  $mdlrecreqtbl->get();

        // dd(DB::getQueryLog());

        return $mdlrecreqtbl;
   }
/*after cick in hr submit button*/

   public function get_reviewer_goal_list_for_reviewer($input_details){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers as cs');
      $response = $response->distinct();
      $response = $response->select('g.*');
      $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');
      if ($input_details['team_leader_filter_for_reviewer'] != '') {
         $response = $response->where('g.supervisor_status', "1");
         $response = $response->where('cs.sup_emp_code', $input_details['team_leader_filter_for_reviewer']);
      }
      if ($input_details['team_member_filter'] != '') {
         $response = $response->where('g.supervisor_status', "1");
         $response = $response->where('cs.empID', $input_details['team_member_filter']);
      }
      if ($input_details['payroll_status_filter_for_reviewer'] != '') {
         $response = $response->where('g.supervisor_status', "1");
         $response = $response->where('cs.payroll_status', $input_details['payroll_status_filter_for_reviewer']);
         $response = $response->where('cs.reviewer_emp_code',$logined_empID);
      }
      if($input_details['team_leader_filter_for_reviewer'] == ''  && $input_details['team_member_filter'] == '' && $input_details['payroll_status_filter_for_reviewer'] == ''){
         $response = $response->where('g.supervisor_status', "1");
         $response = $response->where('cs.reviewer_emp_code', $logined_empID);
      }

      $response = $response->get();
      return $response;

   }

   public function checkHrReviewerIDOrNot( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;
      $supervisor = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      $teamleader=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
      $result=0; //others
      if($supervisor){
           $result=1;
      }
      if($teamleader){
          $result=2;
      }
    //   echo json_encode($empID);die();
      return $result;
   }
   public function checkHrReviewerIDOrNot_hr( $id ){
      $empID = Goals::where('goal_unique_code', $id)->value('created_by');
      $logined_empID = Auth::user()->empID;
      $supervisor = DB::table('customusers')->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
      $teamleader=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
      $result=0; //others
      if($supervisor){
           $result=1;
      }
      if($teamleader){
          $result=2;
      }
    //   echo json_encode($empID);die();
      return $result;
   }

   public function get_goal_setting_reviewer_details_tl( $input_details ){

      $id = $input_details['id'];
      // echo '<pre>';print_r($id);die();

      // DB::enableQueryLog();

      $reviewer_details_tl = DB::table('goals as gl')
                           // ->distinct()
                           // ->select('gl.*')
                           ->join('customusers as cu', 'gl.created_by', '=', 'cu.empID')
                           ->where('gl.goal_unique_code', $input_details['id'])
                           ->get();
      // dd(DB::getQueryLog());

      return $reviewer_details_tl;
   }
   public function get_goal_setting_hr_details_tl( $input_details ){

      $id = $input_details['id'];

      $reviewer_details_tl = DB::table('goals as gl')
                           ->join('customusers as cu', 'gl.created_by', '=', 'cu.empID')
                           ->where('gl.goal_unique_code', $input_details['id'])
                           ->get();

      return $reviewer_details_tl;
   }

   public function update_goals_sup_reviewer_tm($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'reviewer_tb_status' => "1",
                        ]);
      return $response;
   }
   public function reviewer_remarks_rate_text_db( $id ){
      $response = DB::table('goals')
                    ->select('*')
                    ->where('goal_unique_code', $id)
                    ->get();
      return $response;
   }
   public function update_goals_sup_reviewer_tm_hr($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                           'reviewer_remarks' => $data['reviewer_remarks'],
                           // 'increment_recommended' => $data['increment_recommended'],
                           // 'increment_percentage' => $data['increment_percentage'],
                           // 'performance_imporvement' => $data['performance_imporvement'],
                           // 'hike_per_month' => $data['hike_per_month'],
                           'reviewer_status' => "1",
                        ]);
      return $response;
   }
   public function hr_remarks_rate_text_db( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('hr_remarks');
      return $response;
   }
    public function update_goals_sup_reviewer_tm_save($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                           'reviewer_remarks' => $data['reviewer_remarks'],
                           // 'increment_recommended' => $data['increment_recommended'],
                           // 'increment_percentage' => $data['increment_percentage'],
                           // 'performance_imporvement' => $data['performance_imporvement'],
                           // 'hike_per_month' => $data['hike_per_month'],
                           'reviewer_tb_status' => '1',
                        ]);
      return $response;
   }
   public function update_goals_hr_reviewer_tm($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              // 'goal_process' => $data['goal_process'],
                              'hr_remarks' => $data['hr_remarks'],
                              'hr_status' => '1',
                        ]);
      return $response;
   }
   public function save_goals_hr_reviewer_tm($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              // 'goal_process' => $data['goal_process'],
                              'hr_remarks' => $data['hr_remarks'],
                              'hr_tb_status' => '1',
                        ]);
      return $response;
   }
   public function update_goals_sup_submit_direct($id){
      $response = Goals::where('goal_unique_code', $id)
                ->update([
                     'supervisor_status' => "1",
                     'supervisor_tb_status' => "1",
                ]);
      return $response;
   }
   public function fetchCustomUserList(){
      $response = DB::table('customusers')->get();
      return $response;
   }
   public function get_goal_login_user_details_sup(){
      $logined_empID = Auth::user()->sup_emp_code;
      $response = DB::table('customusers')
                     ->where('empID', $logined_empID)
                     ->get();
      return $response;
   }
   public function get_goal_login_user_details_rev(){
      $logined_empID = Auth::user()->reviewer_emp_code;
      $response = DB::table('customusers')
                     ->where('empID', $logined_empID)
                     ->get();
      return $response;
   }

 public function update_goals_sup_submit_overall($data){
    $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                      ->update([
                            'goal_process' => $data['goal_process'],
                            'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                            'supervisor_pip_exit' => $data['supervisor_pip_exit'],
                            'supervisor_tb_status' => "1",
                            'supervisor_status' => "1",
                      ]);
    return $response;
 }

    public function fetch_reviewer_id_or_not( $id ){
        $empID = Goals::where('goal_unique_code', $id)->value('created_by');
        $logined_empID = Auth::user()->empID;

        $teamleader = DB::table('customusers')->where('reviewer_emp_code','!=', $logined_empID)->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
        $employee=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
        $result=0;
        if($teamleader){
            $result=1;
        }
        if($employee){
            $result=2;
        }
    //   echo json_encode($empID);die();
        return $result;
    }public function fetch_reviewer_id_or_not_hr( $id ){
        $empID = Goals::where('goal_unique_code', $id)->value('created_by');
        $logined_empID = Auth::user()->empID;

        $teamleader = DB::table('customusers')->where('reviewer_emp_code','!=', $logined_empID)->where('sup_emp_code', $logined_empID)->where('empID', $empID)->value('empID');
        $employee=CustomUser::where('sup_emp_code','!=',$logined_empID)->where('reviewer_emp_code',$logined_empID)->where('empID',$empID)->value('empID');
        $result=0;
        if($teamleader){
            $result=1;
        }
        if($employee){
            $result=2;
        }
    //   echo json_encode($empID);die();
        return $result;
    }

    public function update_goals_reviewer_teamleader($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              // 'goal_process' => $data['goal_process'],
                              'reviewer_remarks' => $data['reviewer_remarks'],
                              // 'increment_recommended' => $data['increment_recommended'],
                              // 'increment_percentage' => $data['increment_percentage'],
                              // 'hike_per_month' => $data['hike_per_month'],
                              // 'performance_imporvement' => $data['performance_imporvement'],
                              'reviewer_tb_status' => "1",
                        ]);

      return $response;

   }
   public function mail_con_org_hr($data){
     // DB::enableQueryLog();
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                  ->update([ 'mail_con' => "1" ]);
      // dd(DB::getQueryLog());
        return $response;
     }

   public function update_goals_sup_submit_overall_for_reviewer($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              // 'goal_process' => $data['goal_process'],
                              'reviewer_remarks' => $data['reviewer_remarks'],
                              // 'increment_recommended' => $data['increment_recommended'],
                              // 'increment_percentage' => $data['increment_percentage'],
                              // 'hike_per_month' => $data['hike_per_month'],
                              // 'performance_imporvement' => $data['performance_imporvement'],
                              'reviewer_tb_status' => "1",
                              'reviewer_status' => "1",
                        ]);
      return $response;
   }

     public function update_goals_team_member_submit_direct($id){
        $response = Goals::where('goal_unique_code', $id)
                  ->update([
                       'reviewer_tb_status' => "1",
                       'reviewer_status' => "1",
                  ]);
        return $response;
     }
     public function getSupEmail(){
        $logined_sup_emp_code = Auth::user()->sup_emp_code;
        $response = DB::table('customusers')->where('empID', $logined_sup_emp_code)->value('email');
        return $response;

     }
     public function get_goals_reviewer_remarks( $id ){
        $response = Goals::where('goal_unique_code', $id)->value('reviewer_remarks');
        // echo '23<pre>';print_r($response);die();
        return $response;
     }
     public function login_user_eligible(){
      $logined_empID = Auth::user()->empID;
      $response = DB::table('customusers')->where('empID', $logined_empID)->value('pms_eligible_status');
      return $response;

   }
   public function login_user_sheet_added(){
      $logined_empID = Auth::user()->empID;
      $response = Goals::where('created_by', $logined_empID)->where("goal_status", "Pending")->orwhere("goal_status", "Revert")->value('goal_status');
      return $response;

   }

   public function update_goals_sup_by_rev($data){

      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                     ->update([
                        'goal_process' => $data['goal_process'],
                        'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                        'supervisor_pip_exit' => $data['supervisor_pip_exit'],
                        'supervisor_tb_status' => "1",
                     ]);

      return $response;

   }
   public function getRevName($id){

      $response = DB::table('customusers as cs')
                     ->distinct()
                     ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                     ->where('g.goal_unique_code', $id)
                     ->value('cs.reviewer_name');
      return $response;

   }
   public function getRevEmail($id){

      $reviewer_emp_code = DB::table('customusers as cs')
                  ->distinct()
                  ->join('goals as g', 'g.created_by', '=', 'cs.empID')
                  ->where('g.goal_unique_code', $id)
                  ->value('cs.reviewer_emp_code');

      $response = DB::table('customusers')->where('empID', $reviewer_emp_code)->value('email');

      return $response;

   }
   public function getEmpName($id){

      $response = DB::table('goals')->where('goal_unique_code', $id)->value('created_by_name');
      return $response;

   }
   public function getEmpID($id){

      $response = DB::table('goals')->where('goal_unique_code', $id)->value('created_by');
      return $response;

   }
   public function update_goals_sup_save_hr($data){
      // dd($data);
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'supervisor_pip_exit' =>  $data['supervisor_pip_exit'],
                              'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_tb_status' => "1",
                        ]);
      return $response;
   }
   public function update_goals_sup_hr($data){
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                        ->update([
                              'goal_process' => $data['goal_process'],
                              'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_status' => "1",
                              'supervisor_pip_exit' => $data['supervisor_pip_exit'],
                        ]);
      return $response;
   }
   public function get_goals_reviewer_sup_pip_exit_data( $id ){
      $response = Goals::where('goal_unique_code', $id)->value('supervisor_pip_exit');
      // echo '23<pre>';print_r($response);die();
      return $response;
   }

   public function get_all_datas_goals_for_reviewer( $id ){
      $response = Goals::where('goal_unique_code', $id)->get();
      // echo '23<pre>';print_r($response);die();
      return $response;
   }
   public function checkDirectBh($logined_empID)
   {
      $response = DB::table('customusers')->where('empID', $logined_empID)->value('reviewer_emp_code');
      return $response;
   }
   public function get_filtered_supervisor_data($data){
        $logined_empID = Auth::user()->empID;
        $response = DB::table('customusers as cs');
        $response = $response->distinct();
        $response = $response->select('g.*');
        $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');
        $response = $response->where('cs.sup_emp_code',$logined_empID);
        if($data['supervisor_id'] != '') {
            $response= $response->where('g.created_by',$data['supervisor_id']);
        }
        if ($data['payroll_status'] != '') {
        $response = $response->where('cs.payroll_status', $data['payroll_status']);
        }
        $response = $response->get();
        return $response;
        }
         public function get_filtered_reviewer_data($sup,$emp,$payroll){
    $logined_empID = Auth::user()->empID;
    $response = DB::table('customusers as cs');
    $response = $response->distinct();
    $response = $response->select('g.*');
    $response = $response->join('goals as g', 'g.created_by', '=', 'cs.empID');
    if ($sup != '') {
    $response = $response->where('g.supervisor_status', "1");
    $response = $response->where('cs.sup_emp_code', $sup);
    }
    if ($emp != '') {
    $response = $response->where('g.supervisor_status', "1");
    $response = $response->where('cs.empID', $emp);
    }
    if ($payroll != '') {
    $response = $response->where('g.supervisor_status', "1");
    $response = $response->where('cs.payroll_status', $payroll);
    $response = $response->where('cs.reviewer_emp_code',$logined_empID);
    }
    if($sup == ''  && $emp == '' && $payroll==""){
    $response = $response->where('g.supervisor_status', "1");
    $response = $response->where('cs.reviewer_emp_code', $logined_empID);
    $response = $response->where('cs.sup_emp_code','!=', $logined_empID);


    }
    $response = $response->get();
    return $response;
    }

   public function fetch_reviewer_wise_filter($team_leader_filter){
         $output = '';
         $customusers = DB::table('customusers')->where('sup_emp_code', $team_leader_filter)->get();
         $output .= '<option value="">...Select...</option>';
         foreach($customusers as $record){
            $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';
         }
      return $output;
   }

   //CHART
   public function fetch_bh_ec_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      // DB::enableQueryLog();
      $see_count = DB::table('customusers as cs');
      $see_count = $see_count->distinct();
      $see_count = $see_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $see_count = $see_count->where('g.supervisor_consolidated_rate', 'EC');
      if($data['year'] != ''){
         $see_count = $see_count->where('g.goal_name', $data['year']);
      }else{
         $see_count = $see_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['man'] != ''){

         if($data['tl'] != ''){
            $see_count = $see_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $see_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                   ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }

      }
      if($data['grade'] != ''){
         $see_count = $see_count->where('cs.grade', $data['grade']);
      }

      $see_count = $see_count->count();
      return $see_count;
   }
   public function fetch_bh_se_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      $ee_count = DB::table('customusers as cs');
      $ee_count = $ee_count->distinct();
      $ee_count = $ee_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $ee_count = $ee_count->where('g.supervisor_consolidated_rate', 'SE');
      if($data['year'] != ''){
         $ee_count = $ee_count->where('g.goal_name', $data['year']);
      }else{
         $ee_count = $ee_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['man'] != ''){

         if($data['tl'] != ''){
            $ee_count = $ee_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $ee_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }

      }
      if($data['grade'] != ''){
         $ee_count = $ee_count->where('cs.grade', $data['grade']);
      }
      $ee_count = $ee_count->count();

      return $ee_count;
   }
   public function fetch_bh_c_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      $me_count = DB::table('customusers as cs');
      $me_count = $me_count->distinct();
      $me_count = $me_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $me_count = $me_count->where('g.supervisor_consolidated_rate', 'C');
      if($data['year'] != ''){
         $me_count = $me_count->where('g.goal_name', $data['year']);
      }else{
         $me_count = $me_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['grade'] != ''){
         $me_count = $me_count->where('cs.grade', $data['grade']);
      }
      if($data['man'] != ''){

         if($data['tl'] != ''){
            $me_count = $me_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $me_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }

      }
      $me_count = $me_count->count();
      return $me_count;
   }
   public function fetch_bh_pc_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      $pme_count = DB::table('customusers as cs');
      $pme_count = $pme_count->distinct();
      $pme_count = $pme_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $pme_count = $pme_count->where('g.supervisor_consolidated_rate', 'PC');
      if($data['year'] != ''){
         $pme_count = $pme_count->where('g.goal_name', $data['year']);
      }else{
         $pme_count = $pme_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['grade'] != ''){
         $pme_count = $pme_count->where('cs.grade', $data['grade']);
      }
      if($data['man'] != ''){

         if($data['tl'] != ''){
            $pme_count = $pme_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $pme_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                   ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      $pme_count = $pme_count->count();
      return $pme_count;
   }


   //CHART
   public function fetch_self_assessment_completed_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

   //  DB::enableQueryLog();
      $submited_count = DB::table('customusers as cs');
      $submited_count = $submited_count->distinct();
      $submited_count = $submited_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $submited_count = $submited_count->where('cs.pms_eligible_status', '1');
      $submited_count = $submited_count->where('g.employee_status', '1');
      if($data['year'] != ''){
         $submited_count = $submited_count->where('g.goal_name', $data['year']);
      }else{
         $submited_count = $submited_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['dept'] != ''){
        $submited_count = $submited_count->where('cs.department', $data['dept']);
     }
     if($data['man'] != ''){
         if($data['tl'] != ''){
            $submited_count = $submited_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $submited_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      if($data['grade'] != ''){
         $submited_count = $submited_count->where('cs.grade', $data['grade']);
      }

      $submited_count = $submited_count->count();
      // dd(DB::getQueryLog());
      return $submited_count;
   }

   public function fetch_self_assessment_inprogress_count($data){
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      if($data['dept'] != ''){
          $inprogress_count['customusers'] = DB::table('customusers as c')
          ->select('c.empID')
          ->where('c.pms_eligible_status' ,'=' , '1')
          ->where('c.department', $data['dept'])
          ->where('active' ,'=' , '1')
          ->get();
         }
         elseif($data['man'] != ''){

            if($data['tl'] != ''){
               $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('c.sup_emp_code', $data['tl'])
               ->where('active' ,'=' , '1')
               ->get();
               // dd($inprogress_count);

            }else{
               $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('c.sup_emp_code', $data['man'])
               ->orwhere('c.reviewer_emp_code', $data['man'])
               ->where('active' ,'=' , '1')
               ->get();
               // dd($inprogress_count);
            }
         }
         elseif($data['grade'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->where('c.grade', $data['grade'])
            ->get();
         }
         else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->get();
         }

         if($data['year'] != ''){
            $inprogress_count['goals'] = DB::table('goals as g')
            ->select('g.created_by')
            ->where('employee_status'  ,'=' , '1')
            ->where('g.goal_name', $data['year'])
            ->get();
         }else{
            $inprogress_count['goals'] = DB::table('goals as g')
            ->select('g.created_by')
            ->where('employee_status'  ,'=' , '1')
            ->where('g.goal_name', $crt_yr_goal_name)
            ->get();
         }


         return $inprogress_count;
      }

   public function fetch_supervisor_status_completed_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;
    // DB::enableQueryLog();
      $submited_count = DB::table('customusers as cs');
      $submited_count = $submited_count->distinct();
      $submited_count = $submited_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $submited_count = $submited_count->where('cs.pms_eligible_status', '1');
      $submited_count = $submited_count->where('g.supervisor_status', '1');
      if($data['year'] != ''){
         $submited_count = $submited_count->where('g.goal_name', $data['year']);
      }else{
         $submited_count = $submited_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['dept'] != ''){
        $submited_count = $submited_count->where('cs.department', $data['dept']);
     }
     if($data['man'] != ''){
         if($data['tl'] != ''){
            $submited_count = $submited_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $submited_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      if($data['grade'] != ''){
         $submited_count = $submited_count->where('cs.grade', $data['grade']);
      }

      $submited_count = $submited_count->count();
    //   dd(DB::getQueryLog());
      return $submited_count;
   }

   public function fetch_supervisor_status_inprogress_count($data)
   {
    //   $inprogress_count = DB::table('customusers as cs');
    //   $inprogress_count = $inprogress_count->distinct();
    //   $inprogress_count = $inprogress_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
    //   $inprogress_count = $inprogress_count->where('cs.pms_eligible_status', '1');
    //   $inprogress_count = $inprogress_count->where('g.supervisor_status', '0');
    //   if($data['dept'] != ''){
    //     $inprogress_count = $inprogress_count->where('cs.department', $data['dept']);
    //  }
    //   $inprogress_count = $inprogress_count->count();
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      if($data['dept'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
         ->select('c.empID')
         ->where('c.pms_eligible_status' ,'=' , '1')
         ->where('c.department', $data['dept'])
         ->where('active' ,'=' , '1')
         ->get();
      }
      elseif($data['man'] != ''){

            if($data['tl'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['tl'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);

            }else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['man'])
            ->orwhere('c.reviewer_emp_code', $data['man'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);
            }
      }
      elseif($data['grade'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->where('c.grade', $data['grade'])
            ->get();
      }
      else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->get();
      }

      if($data['year'] != ''){
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('supervisor_status'  ,'=' , '1')
         ->where('g.goal_name', $data['year'])
         ->get();
      }else{
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('supervisor_status'  ,'=' , '1')
         ->where('g.goal_name', $crt_yr_goal_name)
         ->get();
      }

    return $inprogress_count;
   }

   public function fetch_reviewer_status_completed_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;
    // DB::enableQueryLog();
      $submited_count = DB::table('customusers as cs');
      $submited_count = $submited_count->distinct();
      $submited_count = $submited_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $submited_count = $submited_count->where('cs.pms_eligible_status', '1');
      $submited_count = $submited_count->where('g.reviewer_status', '1');
      if($data['year'] != ''){
         $submited_count = $submited_count->where('g.goal_name', $data['year']);
      }else{
         $submited_count = $submited_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['dept'] != ''){
        $submited_count = $submited_count->where('cs.department', $data['dept']);
     }
     if($data['man'] != ''){
         if($data['tl'] != ''){
            $submited_count = $submited_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $submited_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      if($data['grade'] != ''){
         $submited_count = $submited_count->where('cs.grade', $data['grade']);
      }

      $submited_count = $submited_count->count();
    //   dd(DB::getQueryLog());
      return $submited_count;
   }

   public function fetch_reviewer_status_inprogress_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      if($data['dept'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
         ->select('c.empID')
         ->where('c.pms_eligible_status' ,'=' , '1')
         ->where('c.department', $data['dept'])
         ->where('active' ,'=' , '1')
         ->get();
      }
      elseif($data['man'] != ''){

            if($data['tl'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['tl'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);

            }else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['man'])
            ->orwhere('c.reviewer_emp_code', $data['man'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);
            }
      }
      elseif($data['grade'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->where('c.grade', $data['grade'])
            ->get();
      }
      else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->get();
      }

      if($data['year'] != ''){
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('reviewer_status'  ,'=' , '1')
         ->where('g.goal_name', $data['year'])
         ->get();
      }else{
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('reviewer_status'  ,'=' , '1')
         ->where('g.goal_name', $crt_yr_goal_name)
         ->get();
      }

    return $inprogress_count;
   }

   public function fetch_hr_status_completed_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;
    // DB::enableQueryLog();
      $submited_count = DB::table('customusers as cs');
      $submited_count = $submited_count->distinct();
      $submited_count = $submited_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $submited_count = $submited_count->where('cs.pms_eligible_status', '1');
      $submited_count = $submited_count->where('g.hr_status', '1');
      if($data['year'] != ''){
         $submited_count = $submited_count->where('g.goal_name', $data['year']);
      }else{
         $submited_count = $submited_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['dept'] != ''){
        $submited_count = $submited_count->where('cs.department', $data['dept']);
      }
      if($data['man'] != ''){
         if($data['tl'] != ''){
            $submited_count = $submited_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $submited_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      if($data['grade'] != ''){
         $submited_count = $submited_count->where('cs.grade', $data['grade']);
      }

      $submited_count = $submited_count->count();
    //   dd(DB::getQueryLog());
      return $submited_count;
   }

   public function fetch_hr_status_inprogress_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

         if($data['dept'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.department', $data['dept'])
            ->where('active' ,'=' , '1')
            ->get();
         }
         elseif($data['man'] != ''){

               if($data['tl'] != ''){
               $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('c.sup_emp_code', $data['tl'])
               ->where('active' ,'=' , '1')
               ->get();
               // dd($inprogress_count);

               }else{
               $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('c.sup_emp_code', $data['man'])
               ->orwhere('c.reviewer_emp_code', $data['man'])
               ->where('active' ,'=' , '1')
               ->get();
               // dd($inprogress_count);
               }
         }
         elseif($data['grade'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('active' ,'=' , '1')
               ->where('c.grade', $data['grade'])
               ->get();
         }
         else{
               $inprogress_count['customusers'] = DB::table('customusers as c')
               ->select('c.empID')
               ->where('c.pms_eligible_status' ,'=' , '1')
               ->where('active' ,'=' , '1')
               ->get();
         }

         if($data['year'] != ''){
            $inprogress_count['goals'] = DB::table('goals as g')
            ->select('g.created_by')
            ->where('hr_status'  ,'=' , '1')
            ->where('g.goal_name', $data['year'])
            ->get();
         }else{
            $inprogress_count['goals'] = DB::table('goals as g')
            ->select('g.created_by')
            ->where('hr_status'  ,'=' , '1')
            ->where('g.goal_name', $crt_yr_goal_name)
            ->get();
         }

      return $inprogress_count;
   }

   public function fetch_bh_status_completed_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;
    // DB::enableQueryLog();
      $submited_count = DB::table('customusers as cs');
      $submited_count = $submited_count->distinct();
      $submited_count = $submited_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
      $submited_count = $submited_count->where('cs.pms_eligible_status', '1');
      $submited_count = $submited_count->where('g.bh_status', '1');
      if($data['year'] != ''){
         $submited_count = $submited_count->where('g.goal_name', $data['year']);
      }else{
         $submited_count = $submited_count->where('g.goal_name', $crt_yr_goal_name);
      }
      if($data['dept'] != ''){
        $submited_count = $submited_count->where('cs.department', $data['dept']);
      }
      if($data['man'] != ''){
         if($data['tl'] != ''){
            $submited_count = $submited_count->where('cs.sup_emp_code', $data['tl']);
         }else{
            $submited_count->where(function ($query)  use ($data) {
               $query->where('cs.sup_emp_code', $data['man'])
                  ->orwhere('cs.reviewer_emp_code', $data['man']);
            });
         }
      }
      if($data['grade'] != ''){
         $submited_count = $submited_count->where('cs.grade', $data['grade']);
      }

      $submited_count = $submited_count->count();
    //   dd(DB::getQueryLog());
      return $submited_count;
   }

   public function fetch_bh_status_inprogress_count($data)
   {
      $current_year = date("Y");
      $previous_year = $current_year - 1;
      $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;

      if($data['dept'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
         ->select('c.empID')
         ->where('c.pms_eligible_status' ,'=' , '1')
         ->where('c.department', $data['dept'])
         ->where('active' ,'=' , '1')
         ->get();
      }
      elseif($data['man'] != ''){

            if($data['tl'] != ''){
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['tl'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);

            }else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('c.sup_emp_code', $data['man'])
            ->orwhere('c.reviewer_emp_code', $data['man'])
            ->where('active' ,'=' , '1')
            ->get();
            // dd($inprogress_count);
            }
      }
      elseif($data['grade'] != ''){
         $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->where('c.grade', $data['grade'])
            ->get();
      }
      else{
            $inprogress_count['customusers'] = DB::table('customusers as c')
            ->select('c.empID')
            ->where('c.pms_eligible_status' ,'=' , '1')
            ->where('active' ,'=' , '1')
            ->get();
      }

    if($data['year'] != ''){
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('bh_status'  ,'=' , '1')
         ->where('g.goal_name', $data['year'])
         ->get();
      }else{
         $inprogress_count['goals'] = DB::table('goals as g')
         ->select('g.created_by')
         ->where('bh_status'  ,'=' , '1')
         ->where('g.goal_name', $crt_yr_goal_name)
         ->get();
      }

      return $inprogress_count;
   }

   public function pms_checkbox_data_save_update($data){
    // DB::enableQueryLog();
       $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                 ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                            'supervisor_status' => 1
                            ]);
     // dd(DB::getQueryLog());
       return $response;
    }

    public function pms_checkbox_data_submit_update($data){
    // DB::enableQueryLog();
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                    ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                            'supervisor_status' => 2
                            ]);
        // dd(DB::getQueryLog());
        return $response;
    }

    public function pms_checkbox_data_save_update_for_reviewer_login($data){
    // DB::enableQueryLog();
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                    ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                            'supervisor_status' => 1
                            ]);
        // dd(DB::getQueryLog());
        return $response;
    }

    public function pms_checkbox_data_submit_update_for_reviewer_login($data){
    // DB::enableQueryLog();
        $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                    ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                            'supervisor_status' => 2
                            ]);
        // dd(DB::getQueryLog());
        return $response;
    }

    public function pms_checkbox_data_save_update_for_hr_login($data){
      // DB::enableQueryLog();
          $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                      ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_status' => 1
                              ]);
          // dd(DB::getQueryLog());
          return $response;
      }
  
      public function pms_checkbox_data_submit_update_for_hr_login($data){
      // DB::enableQueryLog();
          $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
                      ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                              'supervisor_status' => 2
                              ]);
          // dd(DB::getQueryLog());
          return $response;
      }
      public function bh_sup_pms_checkbox_data_save($data){
      // DB::enableQueryLog();
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
               ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                           'bh_status' => 1
                           ]);
      // dd(DB::getQueryLog());
      return $response;
   }
   public function hr_pms_checkbox_data_save_update($data){
      // DB::enableQueryLog();
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
               ->update([  'action_to_be_performed' => $data['action_to_be_performed'],
                  'pip_month' => $data['pip_month'],
                  'increment_percentage' => $data['increment_percentage'],
                  'hike_per_month' => $data['hike_per_month'],
                  'new_designation' => $data['new_designation'],
                  'new_sup' => $data['new_sup'],
                  'hr_status' => 1
               ]);
      // dd(DB::getQueryLog());
      return $response;
   }

   public function hr_pms_checkbox_data_submit($data){
      // DB::enableQueryLog();
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
               ->update([ 
                  'action_to_be_performed' => $data['action_to_be_performed'],
                  'pip_month' => $data['pip_month'],
                  'increment_percentage' => $data['increment_percentage'],
                  'hike_per_month' => $data['hike_per_month'],
                  'new_designation' => $data['new_designation'],
                  'new_sup' => $data['new_sup'],
                  'hr_status' => 2,
               ]);
      // dd(DB::getQueryLog());
      return $response;
   }
   public function bh_sup_pms_checkbox_data_submit($data){
      // DB::enableQueryLog();
      $response = Goals::where('goal_unique_code', $data['goal_unique_code'])
               ->update([ 'supervisor_consolidated_rate' => $data['supervisor_consolidated_rate'],
                           'bh_status' => 2,
                           'supervisor_status' => 2,
                           'reviewer_status' => 1,
                        ]);
      // dd(DB::getQueryLog());
      return $response;
   }



}
