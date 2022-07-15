<?php

namespace App\Http\Controllers;

use App\Repositories\IGoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Goals;
use Auth;
use Session;
use Mail;
use App\Models\CustomUser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Crypt;

class GoalsController extends Controller
{
    public function __construct(IGoalRepository $goal)
    {
        $this->middleware('is_admin');
        $this->goal = $goal;
        $this->middleware(function($request,$next){
              $session_val=Session::get('session_info');
              if($session_val=="" || $session_val === null){
                  return redirect('login');
              }
              else{
               return $next($request);
              }
        });
    }
    public function goal_setting_bh_reviewer_view()
    {
        // $base_string = base64_encode("G01"); //for base64 encoding
        $id = base64_decode($_GET['id']);
        $data=$this->goal->Fetch_goals_user_info($id);
        $new_data['data']=$data;
        $new_data['sup_emp_code']=CustomUser::where('empID',$data->sup_emp_code)->select('department')->first();
        $new_data['reviewer_emp_code']=CustomUser::where('empID',$data->reviewer_emp_code)->select('department')->first();
        // echo json_encode($new_data['reviewer_emp_code']);die();
        return view('goals.goal_setting_bh_reviewer_view')->with('user_info',$new_data);
    }
    public function goals()
    {
        $result = $this->goal->checkCustomUserList();
        $team_member_list = $this->goal->fetchSupervisorList();
        $supervisor_list = $this->goal->fetchSupervisorList();
        $reviewer_list = $this->goal->fetchReviewerList();
        $logined_empID = Auth::user()->empID;
        $role_type = Auth::user()->role_type;


        $dept_lists = DB::table("customusers")->select('department')
                        ->groupByRaw('department')
                        ->get();


        $managers = DB::table("customusers")->where('sup_emp_code', "900531")
                        ->get();

        $grade_lists = DB::table("customusers")->select('grade')
                        ->groupBy('grade')
                        ->get();

        $data = [
                    "dept_lists" => $dept_lists,
                    "reviewer_list"=>$reviewer_list,
                    "managers"=>$managers,
                    "grade_lists"=>$grade_lists
                ];

        if($logined_empID == "900531"){ //business head
            return view('goals.bh_goal_index')->with($data);
        }elseif($logined_empID == "900380" || $role_type == "HR Ops"){ //HR head
            return view('goals.hr_goal_index')->with($data);
        }elseif($result == "Reviewer"){
            $data = [ "supervisor_list" => $supervisor_list, ];
            return view('goals.reviewer_goal_index')->with($data);
        }elseif($result == "Supervisor"){
            return view('goals.sup_goal_index')->with("team_member_list", $team_member_list);
        }else{
            return view('goals.index');
        }

    }
    public function calendar()
    {
        return view('birthday.sample');
    }
    public function add_goal_setting()
    {
        return view('goals.add_goal_setting');
    }
    public function goal_setting()
    {
        //  echo json_encode(Crypt::decrypt($_GET['id']));die();
        $code = Crypt::decrypt($_GET['id']);
        return view('goals.goal_setting')->with("sheet_code", $code);
    }
    public function goal_setting_supervisor_edit()
    {
        return view('goals.goal_setting_supervisor_edit');
    }
    public function goal_setting_edit()
    {
        $code = Crypt::decrypt($_GET['id']);
        return view('goals.edit_goal')->with("sheet_code", $code);
    }
    public function add_goal_setting_naps()
    {
        return view('goals.add_goal_setting_naps');
    }
    public function goal_setting_edit_naps()
    {
        $code = Crypt::decrypt($_GET['id']);
        return view('goals.edit_goal_naps')->with("sheet_code", $code);
    }
    public function goal_setting_naps()
    {
        $code = Crypt::decrypt($_GET['id']);
        return view('goals.goal_setting_naps')->with("sheet_code", $code);
    }
    public function goal_setting_reviewer_edit()
    {
        return view('goals.goal_setting_reviewer_edit');
    }
    public function goal_setting_bh_edit()
    {
        return view('goals.goal_setting_bh_edit');
    }
    public function goal_setting_supervisor_view()
    {
        $customusers = $this->goal->fetchCustomUserList();
        $code = Crypt::decrypt($_GET['id']);
        $data = [
            "customusers" => $customusers,
            "sheet_code" => $code,
        ];
        return view('goals.goal_setting_supervisor_view')->with($data);
    }
    public function goal_setting_reviewer_view()
    {
        $code = Crypt::decrypt($_GET['id']);
        $data=$this->goal->Fetch_goals_user_info($code);
        $rec = [
            "user_info" => $data,
            "sheet_code" => $code,
        ];

        return view('goals.goal_setting_reviewer_view')->with($rec);
    }
    public function goal_setting_hr_view()
    {
        $code = Crypt::decrypt($_GET['id']);
        return view('goals.goal_setting_hr_view')->with("sheet_code", $code);
    }
    public function edit_goal()
    {
        return view('goals.edit_goal');
    }
    public function goals_sheet_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->fetchGoalIdHead($id);
        return json_encode($head);
    }
    public function goals_consolidate_rate_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_consolidate_rate_head($id);
        return json_encode($head);
    }
    public function goals_sup_submit_status(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_sup_submit_status($id);
        return json_encode($head);
    }
    public function goals_sup_consolidate_rate_head(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_sup_consolidate_rate_head($id);
        // echo "111<pre>";print_r($head);die;
        return json_encode($head);
    }
    public function goals_sup_pip_exit_select_op(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->goals_sup_pip_exit_select_op($id);
        return json_encode($head);
    }
    public function fecth_goals_sup_movement_process(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->fecth_goals_sup_movement_process($id);
        return json_encode($head);
    }
    public function update_goals_sup_submit_direct(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->update_goals_sup_submit_direct($id);

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($head){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Reporting Manager Comments Submitted');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return json_encode($head);
    }
    public function goals_sup_th_check(Request $request)
    {
        $id = $request->id;
        $result = $this->goal->checkSupervisorIDOrNot($id);
        if(!empty($result)){
            $head = "Yes";
        }else{
            $head = "No";
        }
        return json_encode($head);
    }
    public function get_supervisor(){

        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $result = $this->goal->get_supervisor_data($emp_ID);
        // echo "11<pre>";print_r($result);die;
        return json_encode($result);
    }
    public function fetch_reviewer_res(Request $request){

        $emp_ID =  $request->input('reviewer_filter');
        // echo "11<pre>";print_r($request->input('reviewer_filter'));die;
        $result = $this->goal->fetch_reviewer_res_data($emp_ID);
        return json_encode($result);
    }
    public function get_reviewer_list(Request $request){

        if ($request !="") {
            $input_details = array(
                'supervisor_list_1'=>$request->input('supervisor_list_1'),
                'team_member_filter'=>$request->input('team_member_filter'),
                'payroll_status_rev'=>$request->input('payroll_status_rev'),
            );
        }
        // echo "11<pre>";print_r($input_details);die;
        $result = $this->goal->fetch_reviewer_tab_data($input_details);


        return DataTables::of($result)
        ->addIndexColumn()
        ->addColumn('rev_status', function($row) {

            // echo "<pre>";print_r($row->supervisor_status);die;
            if($row->reviewer_status != 1 && $row->reviewer_tb_status != 1){
                $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
            }elseif($row->reviewer_status != 1 && $row->reviewer_tb_status == 1){
                $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
            }elseif($row->reviewer_status == 1){
                $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
            }
            return $btn;
        })
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                $enc_code = Crypt::encrypt($row->goal_unique_code);

                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){

                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;


                }elseif($row->goal_status == "Approved"){

                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$enc_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$enc_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }

                }
            return $btn;
        })

        ->rawColumns(['rev_status', 'action','status'])
        ->make(true);

    }

    public function fetch_goals_setting_id_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $sub_row_count = count($row_values->$cell3);

            for($k=0 ; $k < $sub_row_count ; $k++){

                $html .= '<tr class="border-bottom-primary">';

                    /*cell 1*/
                    if($k == 0){
                        $html .= '<th style="text-align:center" rowspan='.$sub_row_count.' scope="row">'.$cell1.'</th>';
                    }

                    /*cell 2*/
                    if($k == 0){

                        if($row_values->$cell2[0] != null){
                            $html .= '<td style="text-align:center" rowspan='.$sub_row_count.'>';
                                $html .= $row_values->$cell2[0];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }

                    }

                    /*cell 3*/
                    if($row_values->$cell3[$k] != null){
                        $html .= '<td>';
                        $html .= $row_values->$cell3[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 4*/
                    if($row_values->$cell4[$k] != null){
                        $html .= '<td>';
                            $html .= $row_values->$cell4[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 5*/
                    if($row_values->$cell5[$k] != null){
                        $html .= '<td>';
                            $html .= $row_values->$cell5[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 6*/
                    if($row_values->$cell6[$k] != null){
                        $html .= '<td>';
                            $html .= $row_values->$cell6[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                $html .= '</tr>';

            }

        }

        return json_encode($html);
    }
    public function fetch_goals_sup_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);
        $html = '';

        $all_count=0;
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;
            $sub_row_count = count($row_values->$cell3);

            for($k=0 ; $k < $sub_row_count ; $k++){

                $all_count++;

                $html .= '<tr  class="border-bottom-primary">';

                    /*cell 1*/
                    if($k == 0){
                        $html .= '<th style="text-align:center" rowspan='.$sub_row_count.' scope="row">'.$cell1.'</th>';
                    }

                    /*cell 2*/
                    if($k == 0){

                        if($row_values->$cell2[0] != null){
                            $html .= '<td style="text-align:center" rowspan='.$sub_row_count.'>';
                                $html .= $row_values->$cell2[0];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }

                    }

                    /*cell 3*/
                    if($row_values->$cell3[$k] != null){
                        $html .= '<td>';
                        $html .= $row_values->$cell3[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 4*/
                    if($row_values->$cell4[$k] != null){
                        $html .= '<td style="text-align: justify;">';
                        $html .= $row_values->$cell4[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 5*/
                    if($row_values->$cell5[$k] != null){
                        $html .= '<td style="text-align: justify;">';
                        $html .= $row_values->$cell5[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 6*/
                    if($row_values->$cell6[$k] != null){
                        $html .= '<td style="text-align: justify;">';
                        $html .= $row_values->$cell6[$k];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*cell 7*/
                    if($row_values->$cell7 != null){
                        if($row_values->$cell7[$k] != null){
                                $t_value=1;
                                    $html .= '<td  class="sup_remark">';
                                    $html .='<p style="text-align: justify;" class="sup_remark_p_'.$all_count.' p_tag_one_'.$all_count.'">'.$row_values->$cell7[$k].'</p>';
                                    $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.$cell1.'[]" style="width:250px; display:none; " class="form-control textarea_one">'.$row_values->$cell7[$k].'</textarea>';
                                    $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                                    $html .= '</td>';
                            // }

                        }else{
                            $t_value=2;
                            $html .= '<td class="sup_remark">';
                            $html .='<p style="text-align: justify;" class="sup_remark_p_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                            $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                            $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                        }
                    }else{
                        $t_value=2;
                        $html .= '<td class="sup_remark">';
                        $html .='<p style="text-align: justify;" class="sup_remark_p_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                        $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                        $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                    }

                    /*cell 8*/
                    if($row_values->$cell8 != null){

                        //   echo json_encode($row_values->$cell8);die();
                        if($row_values->$cell8[$k] != null){
                            // echo json_encode("twio");
                            // $t_value=1;
                                $html .= '<td  class="sup_rating">';
                                // $html .='<div class="sup_rating_div_'.($k+1).'"><p class="sup_rating_p_'.($k+1).'">'.$row_values->$cell8[$k].'</p><div>';
                                // $html .=$row_values->$cell8[$k];
                                $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'">'.$row_values->$cell8[$k].'</p>';
                                $html .='<select style="display:none; width: 135px;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                            <option value="">...Select...</option>\
                                            <option value="SEE" '.($row_values->$cell8[$k]=="SEE" ? "selected" : "").'>SEE - Significantly Exceeds Expectations</option>\
                                            <option value="EE" '.($row_values->$cell8[$k]=="EE" ? "selected" : "").'>EE - Exceeded Expectations</option>\
                                            <option value="ME" '.($row_values->$cell8[$k]=="ME" ? "selected" : "").'>ME - Met Expectations</option>\
                                            <option value="PME"  '.($row_values->$cell8[$k]=="PE" ? "selected" : "").'>PME - Partially Met Expectations</option>\
                                            <option value="ND" '.($row_values->$cell8[$k]=="ND" ? "selected" : "").'>ND - Needs Development</option>\
                                        </select>';
                                $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                                $html .= '</td>';
                        }
                        else{
                            //  echo json_encode("one");die();
                            $html .= '<td class="sup_rating">';
                            $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                            $html .='<select  style="display:none; width: 135px;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                        <option value="">...Select...</option>\
                                        <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                        <option value="EE">EE - Exceeded Expectations</option>\
                                        <option value="ME">ME - Met Expectations</option>\
                                        <option value="PME">PME - Partially Met Expectations</option>\
                                        <option value="ND">ND - Needs Development</option>\
                                    </select>';
                            $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                        }

                    } else{
                        //  echo json_encode("one");die();
                        $html .= '<td class="sup_rating">';
                        $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                        $html .='<select  style="display:none; width: 135px;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                    <option value="">...Select...</option>\
                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                    <option value="EE">EE - Exceeded Expectations</option>\
                                    <option value="ME">ME - Met Expectations</option>\
                                    <option value="PME">PME - Partially Met Expectations</option>\
                                    <option value="ND">ND - Needs Development</option>\
                                </select>';
                        $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                    }

                $html .= '</tr>';
            }
        }

        $new_data['html']=$html;
        $new_data['t_value']=$t_value;

        return json_encode($new_data);
    }
    public function fetch_goals_reviewer_sup_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $reviewer=$this->goal->fetch_reviewer_id_or_not($id);
        $get_sheet_status=Goals::where('goal_unique_code',$id)
                                 ->select('supervisor_status',
                                        'supervisor_tb_status',
                                        'reviewer_status',
                                        'reviewer_tb_status')->first();
        $datas = json_decode($json);

        $html = '';

        $all_count=0;

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;
            $sub_row_count = count($row_values->$cell3);
            // echo '<pre>';print_r($sub_rowcell7_count);die();

            for($k=0 ; $k < $sub_row_count ; $k++){

                $all_count++;

                $html .= '<tr  class="border-bottom-primary">';
                /*cell 1*/
                // $html .= '<th scope="row">'.$cell1.'</th>';
                if($k == 0){
                    $html .= '<th style="text-align:center" rowspan='.$sub_row_count.' scope="row">'.$cell1.'</th>';
                }

                /*cell 2*/
                if($k == 0){

                    if($row_values->$cell2[0] != null){
                        $html .= '<td style="text-align:center" rowspan='.$sub_row_count.'>';
                            $html .= $row_values->$cell2[0];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                }

                /*cell 3*/
                if($row_values->$cell3[$k] != null){
                    $html .= '<td>';
                    $html .= $row_values->$cell3[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*cell 4*/
                if($row_values->$cell4[$k] != null){
                    $html .= '<td style="text-align: justify;">';
                    $html .= $row_values->$cell4[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*cell 5*/
                if($row_values->$cell5[$k] != null){
                    $html .= '<td style="text-align: justify;">';
                    $html .= $row_values->$cell5[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*cell 6*/
                if($row_values->$cell6[$k] != null){
                    $html .= '<td style="text-align: justify;">';
                    $html .= $row_values->$cell6[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*cell 7*/
                if($row_values->$cell7 != null){
                    // dd("1");

                    if($row_values->$cell7[$k] != null){
                        $t_value=1;
                        // dd("11");
                        $html .= '<td  class="sup_remark">';
                        $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'">'.$row_values->$cell7[$k].'</p>';
                        $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.$cell1.'[]" style="width:250px; display:none; " class="form-control textarea_one">'.$row_values->$cell7[$k].'</textarea>';
                        $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                    }
                    else{
                        // dd("12");
                        $t_value=2;
                        $html .= '<td class="sup_remark">';
                        $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                        $html .='<textarea  id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                        $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                        $html .= '</td>';

                    }

                }else{
                    // dd("2");

                    $t_value=2;
                    $html .= '<td class="sup_remark">';
                    $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                    $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                    $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                    $html .= '</td>';
                }

                /*cell 8*/
                if($row_values->$cell8 != null){
                    if($row_values->$cell8[$k] != null){
                        // $t_value=1;
                            $html .= '<td  class="sup_rating">';
                            // $html .='<div class="sup_rating_div_'.($k+1).'"><p class="sup_rating_p_'.($k+1).'">'.$row_values->$cell8[$k].'</p><div>';
                            // $html .=$row_values->$cell8[$k];
                            $html .='<p class="sup_rating_p_rev_'.$all_count.' p_tag_two_'.$all_count.'">'.$row_values->$cell8[$k].'</p>';
                            $html .='<select style="display:none;width:135px" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                        <option value="">...Select...</option>\
                                        <option value="SEE" '.($row_values->$cell8[$k]=="SEE" ? "selected" : "").'>SEE - Significantly Exceeds Expectations</option>\
                                        <option value="EE" '.($row_values->$cell8[$k]=="EE" ? "selected" : "").'>EE - Exceeded Expectations</option>\
                                        <option value="ME" '.($row_values->$cell8[$k]=="ME" ? "selected" : "").'>ME - Met Expectations</option>\
                                        <option value="PME"  '.($row_values->$cell8[$k]=="PME" ? "selected" : "").'>PME - Partially Met Expectations</option>\
                                        <option value="ND" '.($row_values->$cell8[$k]=="ND" ? "selected" : "").'>ND - Needs Development</option>\
                                    </select>';
                            $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                    }
                    else{

                        $html .= '<td class="sup_rating">';
                        $html .='<p class="sup_rating_p_rev_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                        $html .='<select  style="display:none;width:135px" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                    <option value="">...Select...</option>\
                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                    <option value="EE">EE - Exceeded Expectations</option>\
                                    <option value="ME">ME - Met Expectations</option>\
                                    <option value="PME">PME - Partially Met Expectations</option>\
                                    <option value="ND">ND - Needs Development</option>\
                                </select>';
                        $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                }

                }else{

                    $html .= '<td class="sup_rating">';
                    $html .='<p class="sup_rating_p_rev_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                    $html .='<select  style="display:none;width:135px" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                <option value="">...Select...</option>\
                                <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                <option value="EE">EE - Exceeded Expectations</option>\
                                <option value="ME">ME - Met Expectations</option>\
                                <option value="PME">PME - Partially Met Expectations</option>\
                                <option value="ND">ND - Needs Development</option>\
                            </select>';
                    $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                    $html .= '</td>';
                }

                $html .= '</tr>';
            }

        }

        $new_data['html']=$html;
        $new_data['result']=$reviewer;
        $new_data['sheet_status']=$get_sheet_status;
        $new_data['t_value']=$t_value;

        return json_encode($new_data);
    }
    public function fetch_goals_reviewer_details(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $reviewer = $this->goal->checkReviewerIDOrNot($id);
        // echo json_encode($reviewer);die();
        $get_sheet_status=Goals::where('goal_unique_code',$id)
                                 ->select('goal_status',
                                        'supervisor_consolidated_rate',
                                        'bh_status','employee_consolidated_rate',
                                        'supervisor_consolidated_rate',
                                        'bh_tb_status','goal_status','increment_recommended',
                                        'increment_percentage','performance_imporvement',
                                        'reviewer_remarks','supervisor_pip_exit','reviewer_remarks')->first();
        $datas = json_decode($json);
        $all_count=0;
        $html = '';
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            // echo json_encode($row_values);die();
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            // $cell10 = "hr_remarks_".$cell1;
            $cell11 = "bh_sign_off_".$cell1;
            $sub_row_count = count($row_values->$cell3);
            for($k=0 ; $k < $sub_row_count ; $k++){
                $all_count++;
                $html .= '<tr  class="border-bottom-primary">';
                /*Cell 1*/
                // $html .= '<th scope="row">'.$cell1.'</th>';
                if($k == 0){
                    $html .= '<th style="text-align:center" rowspan='.$sub_row_count.' scope="row">'.$cell1.'</th>';
                }

                if($k == 0){
                    if($row_values->$cell2[0] != null){
                        $html .= '<td style="text-align:center" rowspan='.$sub_row_count.'>';
                            $html .= $row_values->$cell2[0];
                        $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                }

                if($row_values->$cell3[$k] != null){
                    $html .= '<td>';
                    $html .= $row_values->$cell3[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                if($row_values->$cell4[$k] != null){
                    $html .= '<td style="text-align:justify;">';
                    $html .= $row_values->$cell4[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5[$k] != null){
                    $html .= '<td style="width:450px; text-align:justify;">';
                    $html .= $row_values->$cell5[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }
                if($row_values->$cell6[$k] != null){
                    $html .= '<td style="text-align:justify;">';
                    $html .= $row_values->$cell6[$k];
                    $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                // cell 7
                if($row_values->$cell7 != null){
                    if($row_values->$cell7[$k] != null){
                            $html .= '<td  class="supervisor_remarks">';
                            $html .='<p class="sup_remarks_'.$all_count.' p_tag_three_'.$all_count.'">'.$row_values->$cell7[$k].'</p>';
                            $html .='<textarea id="sup_remarks_'.($all_count).'" name="sup_remarks_'.$cell1.'[]" style="width:250px; display:none; " class="form-control textarea_three">'.$row_values->$cell7[$k].'</textarea>';
                            $html .='<div class="text-danger sup_remarks_'.($all_count).'_error" id="sup_remarks_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                    // }

                }else{
                    $html .= '<td class="supervisor_remarks">';
                    $html .='<p class="sup_remarks_'.$all_count.' p_tag_three_'.$all_count.'"></p>';
                    $html .='<textarea id="sup_remarks_'.($all_count).'" name="sup_remarks_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_three"></textarea>';
                    $html .='<div class="text-danger sup_remarks_'.($all_count).'_error" id="sup_remarks_'.($all_count).'_error"></div>';
                    $html .= '</td>';
                }
                }else{
                    $html .= '<td class="supervisor_remarks">';
                        $html .='<p class="sup_remarks_'.$all_count.' p_tag_three_'.$all_count.'"></p>';
                        $html .='<textarea id="sup_remarks_'.($all_count).'" name="sup_remarks_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_three"></textarea>';
                        $html .='<div class="text-danger sup_remarks_'.($all_count).'_error" id="sup_remarks_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                }

                /*cell 8*/
                if($row_values->$cell8 != null){

                    //   echo json_encode($row_values->$cell8);die();
                    if($row_values->$cell8[$k] != null){
                            $html .= '<td  class="supervisor_rating">';
                            // $html .='<div class="sup_rating_div_'.($k+1).'"><p class="sup_rating_p_'.($k+1).'">'.$row_values->$cell8[$k].'</p><div>';
                            // $html .=$row_values->$cell8[$k];
                            $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'">'.$row_values->$cell8[$k].'</p>';
                            $html .='<select style="display:none; width: 95px;" class="form-control key_bus_drivers select_one" name="sup_final_output_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                        <option value="">...Select...</option>\
                                        <option value="SEE" '.($row_values->$cell8[$k]=="SEE" ? "selected" : "").'>SEE - Significantly Exceeds Expectations</option>\
                                        <option value="EE" '.($row_values->$cell8[$k]=="EE" ? "selected" : "").'>EE - Exceeded Expectations</option>\
                                        <option value="ME" '.($row_values->$cell8[$k]=="ME" ? "selected" : "").'>ME - Met Expectations</option>\
                                        <option value="PME"  '.($row_values->$cell8[$k]=="PE" ? "selected" : "").'>PE - Partially Met Expectations</option>\
                                        <option value="ND" '.($row_values->$cell8[$k]=="ND" ? "selected" : "").'>ND - Needs Development</option>\
                                    </select>';
                            $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                    }
                    else{
                        $html .= '<td class="supervisor_rating">';
                        $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                        $html .='<select  style="display:none; width: 95px;" class="form-control key_bus_drivers select_one" name="sup_final_output_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                    <option value="">...Select...</option>\
                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                    <option value="EE">EE - Exceeded Expectations</option>\
                                    <option value="ME">ME - Met Expectations</option>\
                                    <option value="PME">PE - Partially Met Expectations</option>\
                                    <option value="ND">ND - Needs Development</option>\
                                </select>';
                        $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                    }

                } else{
                    //  echo json_encode("one");die();
                    $html .= '<td class="supervisor_rating">';
                    $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                    $html .='<select  style="display:none; width: 95px;" class="form-control key_bus_drivers select_one" name="sup_final_output_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                <option value="">...Select...</option>\
                                <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                <option value="EE">EE - Exceeded Expectations</option>\
                                <option value="ME">ME - Met Expectations</option>\
                                <option value="PME">PE - Partially Met Expectations</option>\
                                <option value="ND">ND - Needs Development</option>\
                            </select>';
                    $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                    $html .= '</td>';
                }

                /*cell 9*/
                if($row_values->$cell9 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td class="reviewer_remarks">';
                        foreach($row_values->$cell9 as $cell9_value){
                            if($cell9_value != null){

                                $html .= '<p>'.$cell9_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td class="reviewer_remarks">';
                    $html .= '</td>';
                }

                /*cell 11*/

                if($row_values->$cell11 != null){
                        if($row_values->$cell11[$k] != null){
                                $html .= '<td  class="business_head">';
                                $html .='<p class="bh_sign_off_'.$all_count.' p_tag_one_'.$all_count.'">'.$row_values->$cell11[$k].'</p>';
                                $html .='<textarea id="bh_sign_off_'.($all_count).'" name="bh_sign_off_'.$cell1.'[]" style="width:250px; display:none; " class="form-control textarea_one">'.$row_values->$cell11[$k].'</textarea>';
                                $html .='<div class="text-danger bh_sign_off_'.($all_count).'_error" id="bh_sign_off_'.($all_count).'_error"></div>';
                                $html .= '</td>';
                        // }

                    }else{
                        $html .= '<td class="business_head">';
                        $html .='<p class="bh_sign_off_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                        $html .='<textarea id="bh_sign_off_'.($all_count).'" name="bh_sign_off_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                        $html .='<div class="text-danger bh_sign_off_'.($all_count).'_error" id="bh_sign_off_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                    }
                }else{
                    $html .= '<td class="business_head">';
                        $html .='<p class="bh_sign_off_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                        $html .='<textarea id="bh_sign_off_'.($all_count).'" name="bh_sign_off_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                        $html .='<div class="text-danger bh_sign_off_'.($all_count).'_error" id="bh_sign_off_'.($all_count).'_error"></div>';
                        $html .= '</td>';
                }

                $html .= '</tr>';
            }
        }

        $new_data['html']=$html;
        $new_data['reviewer']=$reviewer;
        $new_data['get_sheet_status']=$get_sheet_status;
        return response()->json($new_data);
    }
    public function fetch_goals_supervisor_edit(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            // dd($cell2);

            $html .= '<tr  class="border-bottom-primary">';

            /*Cell 1*/
            $html .= '<th scope="row">'.$cell1.'</th>';

            /*Cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';

                    foreach($row_values->$cell2 as $cell2_value){
                        // dd($cell3_value);
                        if($cell2_value != null){

                            $html .= '<p>'.$cell2_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                    $html .= '</td>';
            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 3*/
            if($row_values->$cell3 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell3 as $cell3_value){
                        // dd($cell3_value);
                        if($cell3_value != null){

                            $html .= '<p>'.$cell3_value.'</p>';

                        }else{
                            $html .= '<p></p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 4*/
            if($row_values->$cell4 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell4 as $cell4_value){
                        // dd($cell3_value);
                        if($cell4_value != null){

                            $html .= '<p>'.$cell4_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 5*/
            if($row_values->$cell5 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell5 as $cell5_value){
                        // dd($cell3_value);
                        if($cell5_value != null){

                            $html .= '<p>'.$cell5_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

            /*Cell 6*/
            if($row_values->$cell6 != null){
                //    dd(count($row_values->$cell3));
                $html .= '<td>';
                    // $html .= '<p>HR Shared Services : </p>';

                    foreach($row_values->$cell6 as $cell6_value){
                        // dd($cell3_value);
                        if($cell6_value != null){

                            $html .= '<p>'.$cell6_value.'</p>';

                        }
                    }

                $html .= '</td>';

            }else{
                $html .= '<td>';
                // $html .= '<p></p>';
                $html .= '</td>';
            }

             /*Cell 7*/
             $html .= '<td>';
             if($row_values->$cell7 != null){
                 $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
             }else{
                 $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
             }
             $html .= '</td>';

            /*Cell 8*/
            $html .= '<td>';
                $html .= '<option value="" selected>...Select...</option>';
                if($row_values->$cell8 != null){
                    $html .= '<input type="text" name="sup_rating_'.$cell1.'[]" value="'.$row_values->$cell8[0].'" class="form-control">';
                    $html .= '<option value="EE">EE - Exceeded Expectations</option>';
                    $html .= '<option value="AE - Achieved Expectations">AE - Achieved Expectations</option>';
                    $html .= '<option value="ME - Met Expectations">ME - Met Expectations</option>';
                    $html .= '<option value="PE - Partially Met Expectations">PE - Partially Met Expectations</option>';
                    $html .= '<option value="ND - Needs Development">ND - Needs Development</option>';
                }else{
                    $html .= '<input type="text" name="sup_rating_'.$cell1.'[]" class="form-control">';
                }
            $html .= '</td>';



            $html .= '</tr>';

        }

        // echo "<pre>";print_r($html);die;

        return json_encode($html);
    }
    public function fetch_goals_reviewer_edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $supvisor = $this->goal->checkSupervisorIDOrNot($id);
        if(!empty($supvisor)){
            //supervisor reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                $cell10 = "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell3 as $cell3_value){
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control"></textarea>';
                }
                $html .= '</td>';

                /*Cell 8*/
                 $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control">'.$row_values->$cell8[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="sup_review_'.$cell1.'[]" class="form-control"></textarea>';
                }
                $html .= '</td>';



                $html .= '</tr>';

            }

        }else{
            //employee reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                $html .= '<p>'.$row_values->$cell7[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 8*/
                $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<p>'.$row_values->$cell8[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 9*/
                $html .= '<td>';
                if($row_values->$cell9 != null){
                     $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                 }else{
                     $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                 }
                $html .= '</td>';


                $html .= '</td>';

                $html .= '</tr>';

            }

        }

        return json_encode($html);
    }
    public function fetch_goals_hr_edit(Request $request)
    {
        $id = $request->id;
        $supvisor = $this->goal->checkSupervisorIDOrNot($id);

        //employee reviewer edit concept

        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell9 = "reviewer_remarks_".$cell1;
            $cell10 = "hr_remarks_".$cell1;

            $html .= '<tr  class="border-bottom-primary">';

                /*Cell 1*/
                $html .= '<th scope="row">'.$cell1.'</th>';

                /*Cell 2*/
                if($row_values->$cell2 != null){
                    $html .= '<td>';

                        foreach($row_values->$cell2 as $cell2_value){
                            // dd($cell3_value);
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 4*/
                if($row_values->$cell4 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 5*/
                if($row_values->$cell5 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 6*/
                if($row_values->$cell6 != null){
                    //    dd(count($row_values->$cell3));
                    $html .= '<td>';
                        // $html .= '<p>HR Shared Services : </p>';

                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                /*Cell 7*/
                $html .= '<td>';
                if($row_values->$cell7 != null){
                $html .= '<p>'.$row_values->$cell7[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 8*/
                $html .= '<td>';
                if($row_values->$cell8 != null){
                    $html .= '<p>'.$row_values->$cell8[0].'</p>';
                }
                $html .= '</td>';

                /*Cell 9*/
                $html .= '<td>';
                if($row_values->$cell9 != null){
                    $html .= '<p>'.$row_values->$cell9[0].'</p>';
                }
                $html .= '</td>';


                /*Cell 10*/
                $html .= '<td>';
                if($row_values->$cell10 != null){
                        $html .= '<textarea type="text" name="hr_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell10[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="hr_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                $html .= '</td>';

                $html .= '</td>';

            $html .= '</tr>';

        }


        // dd($html);

        return json_encode($html);
    }
    public function fetch_goals_bh_edit(Request $request)
    {
        $id = $request->id;
        $reviewer = $this->goal->checkReviewerIDOrNot($id);
        // echo json_encode($reviewer);die();


        if($reviewer==1){


            //supervisor reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                // $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;


                // echo json_encode($cell7);die();

                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                    /*Cell 2*/
                    if($row_values->$cell2 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell2 as $cell2_value){
                                if($cell2_value != null){

                                    $html .= '<p>'.$cell2_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                            $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 3*/
                    if($row_values->$cell3 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell3 as $cell3_value){
                                // dd($cell3_value);
                                if($cell3_value != null){

                                    $html .= '<p>'.$cell3_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 4*/
                    if($row_values->$cell4 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell4 as $cell4_value){
                                // dd($cell3_value);
                                if($cell4_value != null){

                                    $html .= '<p>'.$cell4_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 5*/
                    if($row_values->$cell5 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell5 as $cell5_value){
                                // dd($cell3_value);
                                if($cell5_value != null){

                                    $html .= '<p>'.$cell5_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }

                    /*Cell 6*/
                    if($row_values->$cell6 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell6 as $cell6_value){
                                // dd($cell3_value);
                                if($cell6_value != null){

                                    $html .= '<p>'.$cell6_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }
                    // die();

                    /*Cell 7*/
                    $html .= '<td>';
                       if($row_values->$cell7 != null){
                            // echo json_encode("one");die();
                        $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell7[0].'</textarea>';
                        }else{
                            $html .= '<textarea type="text" name="sup_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                        }
                       $html .= '</td>';

                       /*Cell 8*/
                       $html .= '<td>';
                       if($row_values->$cell8 != null){
                        $html .= '<textarea type="text" name="sup_final_output_'.$cell1.'[]" class="form-control">'.$row_values->$cell8[0].'</textarea>';
                        }else{
                            $html .= '<textarea type="text" name="sup_final_output_'.$cell1.'[]" class="form-control"></textarea>';
                        }
                       $html .= '</td>';

                       /*Cell 9*/
                       $html .= '<td>';
                       if($row_values->$cell9 != null){
                        $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                       $html .= '</td>';

                        /* cell10 */
                    //    $html .= '<td>';
                    //    if($row_values->$cell10 != null){
                    //     $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control">'.$row_values->$cell10[0].'</textarea>';
                    // }else{
                    //     $html .= '<textarea type="text" name="reviewer_remarks_'.$cell1.'[]" class="form-control"></textarea>';
                    // }
                    //    $html .= '</td>';
                          $html .= '<td>';
                       if($row_values->$cell11 != null){
                           $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                       }else{
                           $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                       }
                        $html .= '</td>';

                       $html .= '</tr>';
                       /*Cell 11*/




                }
        }
        if($reviewer==2){
        // echo json_encode('one');die();

            //teamleader reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;
                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                   /*Cell 2*/
                   if($row_values->$cell2 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell2 as $cell2_value){
                            if($cell2_value != null){

                                $html .= '<p>'.$cell2_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                        $html .= '</td>';
                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                /*Cell 3*/
                if($row_values->$cell3 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell3 as $cell3_value){
                            // dd($cell3_value);
                            if($cell3_value != null){

                                $html .= '<p>'.$cell3_value.'</p>';

                            }else{
                                $html .= '<p></p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }



                /*Cell 4*/
                if($row_values->$cell4 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell4 as $cell4_value){
                            // dd($cell3_value);
                            if($cell4_value != null){

                                $html .= '<p>'.$cell4_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    $html .= '</td>';
                }

                 /*Cell 5*/
                if($row_values->$cell5 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell5 as $cell5_value){
                            // dd($cell3_value);
                            if($cell5_value != null){

                                $html .= '<p>'.$cell5_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }
                  /*Cell 6*/
                  if($row_values->$cell6 != null){
                    $html .= '<td>';
                        foreach($row_values->$cell6 as $cell6_value){
                            // dd($cell3_value);
                            if($cell6_value != null){

                                $html .= '<p>'.$cell6_value.'</p>';

                            }
                        }

                    $html .= '</td>';

                }else{
                    $html .= '<td>';
                    // $html .= '<p></p>';
                    $html .= '</td>';
                }

                   /*Cell 7*/
                   $html .= '<td>';
                   if($row_values->$cell7 != null){
                   $html .= '<p>'.$row_values->$cell7[0].'</p>';
                   }
                   $html .= '</td>';

                   /*Cell 8*/
                   $html .= '<td>';
                   if($row_values->$cell8 != null){
                       $html .= '<p>'.$row_values->$cell8[0].'</p>';
                   }
                   $html .= '</td>';

                   /*Cell 9*/
                   $html .= '<td>';
                   if($row_values->$cell9 != null){
                    $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell9[0].'</textarea>';
                }else{
                    $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                }
                   $html .= '</td>';

                   //  cell 10
                //    $html .= '<td>';
                //    if($row_values->$cell10 != null){
                //    $html .= '<p>'.$row_values->$cell10[0].'</p>';
                //    }
                //    $html .= '</td>';

                   /*Cell 15*/
                   $html .= '<td>';
                   if($row_values->$cell11 != null){
                       $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                   }else{
                       $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                   }
                    $html .= '</td>';

                $html .= '</tr>';

            }

        }
        if($reviewer==0){

                //    echo json_encode("one");die();
            //employee reviewer edit concept

            $json = $this->goal->fetchGoalIdDetails($id);
            $datas = json_decode($json);
            // dd($datas);

            $html = '';

            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $cell9 = "reviewer_remarks_".$cell1;
                // $cell10 =  "hr_remarks_".$cell1;
                $cell11 = "bh_sign_off_".$cell1;

                $html .= '<tr  class="border-bottom-primary">';

                    /*Cell 1*/
                    $html .= '<th scope="row">'.$cell1.'</th>';

                    /*Cell 2*/
                    if($row_values->$cell2 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell2 as $cell2_value){
                                if($cell2_value != null){

                                    $html .= '<p>'.$cell2_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                            $html .= '</td>';
                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                    /*Cell 3*/
                    if($row_values->$cell3 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell3 as $cell3_value){
                                // dd($cell3_value);
                                if($cell3_value != null){

                                    $html .= '<p>'.$cell3_value.'</p>';

                                }else{
                                    $html .= '<p></p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }



                    /*Cell 4*/
                    if($row_values->$cell4 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell4 as $cell4_value){
                                // dd($cell3_value);
                                if($cell4_value != null){

                                    $html .= '<p>'.$cell4_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '</td>';
                    }

                     /*Cell 5*/
                    if($row_values->$cell5 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell5 as $cell5_value){
                                // dd($cell3_value);
                                if($cell5_value != null){

                                    $html .= '<p>'.$cell5_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        // $html .= '<p></p>';
                        $html .= '</td>';
                    }
                      /*Cell 6*/
                      if($row_values->$cell6 != null){
                        $html .= '<td>';
                            foreach($row_values->$cell6 as $cell6_value){
                                // dd($cell3_value);
                                if($cell6_value != null){

                                    $html .= '<p>'.$cell6_value.'</p>';

                                }
                            }

                        $html .= '</td>';

                    }else{
                        $html .= '<td>';
                        $html .= '<p></p>';
                        $html .= '</td>';
                    }

                    /*Cell 7*/
                    $html .= '<td>';
                    if($row_values->$cell7 != null){
                    $html .= '<p>'.$row_values->$cell7[0].'</p>';
                    }
                    $html .= '</td>';

                    /*Cell 8*/
                    $html .= '<td>';
                    if($row_values->$cell8 != null){
                        $html .= '<p>'.$row_values->$cell8[0].'</p>';
                    }
                    $html .= '</td>';

                    /*Cell 9*/
                    $html .= '<td>';
                    if($row_values->$cell9 != null){
                        $html .= '<p>'.$row_values->$cell9[0].'</p>';
                    }
                    $html .= '</td>';

                    // //  cell 10
                    // $html .= '<td>';
                    // if($row_values->$cell10 != null){
                    // $html .= '<p>'.$row_values->$cell10[0].'</p>';
                    // }
                    // $html .= '</td>';

                    /*Cell 15*/
                    $html .= '<td>';
                    if($row_values->$cell11 != null){
                        $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control">'.$row_values->$cell11[0].'</textarea>';
                    }else{
                        $html .= '<textarea type="text" name="bh_sign_off_'.$cell1.'[]" class="form-control"></textarea>';
                    }
                    $html .= '</td>';

                $html .= '</tr>';

            }

        }


        return json_encode($html);
    }
    public function fetch_goals_setting_id_edit(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json);
        $html = '';
        $random = mt_rand(10000, 99999);

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $sub_row_count = count($row_values->$cell3);

            $html .= '<tr>';

            /*Cell 1*/
            $html .= '<td scope="row">'.$cell1.'</td>';

            /*cell 2*/
            if($row_values->$cell2 != null){
                $html .= '<td>';
                    $html .= '<select class="form-control key_bus_drivers m-t-5" name="key_bus_drivers_'.$cell1.'[]">';

                        $html .= '<option value="">...Select...</option>';

                        if($row_values->$cell2[0] == "Revenue"){
                            $html .= '<option value="Revenue" selected>Revenue</option>';
                        }else{
                            $html .= '<option value="Revenue">Revenue</option>';
                        }

                        if($row_values->$cell2[0] == "Customer"){
                            $html .= '<option value="Customer" selected>Customer</option>';
                        }else{
                            $html .= '<option value="Customer">Customer</option>';
                        }

                        if($row_values->$cell2[0] == "Process"){
                            $html .= '<option value="Process" selected>Process</option>';
                        }else{
                            $html .= '<option value="Process">Process</option>';
                        }

                        if($row_values->$cell2[0] == "People"){
                            $html .= '<option value="People" selected>People</option>';
                        }else{
                            $html .= '<option value="People">People</option>';
                        }

                        if($row_values->$cell2[0] == "Projects"){
                            $html .= '<option value="Projects" selected>Projects</option>';
                        }else{
                            $html .= '<option value="Projects">Projects</option>';
                        }

                    $html .= '</select>';
                    $html .= '<div class="text-danger key_bus_drivers_'.$cell1.'_error" id=""></div>';
                $html .= '</td>';
            }else{
                $html .= '<td>';
                    $html .= '<select class="form-control js-example-basic-single key_bus_drivers m-t-5" name="key_bus_drivers_'.$cell1.'[]">';
                        $html .= '<option value="">...Select...</option>';
                        $html .= '<option value="Revenue">Revenue</option>';
                        $html .= '<option value="Customer">Customer</option>';
                        $html .= '<option value="Process">Process</option>';
                        $html .= '<option value="People">People</option>';
                        $html .= '<option value="Projects">Projects</option>';
                    $html .= '</select>';
                    $html .= '<div class="text-danger key_bus_drivers_'.$cell1.'_error" id=""></div>';
                $html .= '</td>';
            }

            /*cell 3*/
            $html .= '<td>';
            // $html .= '<p>HR Shared Services : </p>';

            for($i=0; $i < $sub_row_count; $i++){

                $random_sub_row = mt_rand(10000, 99999);

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell3[$i] != null){

                    $html .= '<textarea name="key_res_areas_'.$cell1.'[]" id="key_res_areas_'.$code.'" class="form-control key_res_areas_'.$cell1.' '.$code.' m-t-5">'.$row_values->$cell3[$i].'</textarea>';
                    $html .= '<div class="text-danger text-danger key_res_areas_'.$code.'_error" id=""></div>';

                }else{
                    $html .= '<textarea name="key_res_areas_'.$cell1.'[]" id="key_res_areas_'.$code.'" class="form-control key_res_areas_'.$cell1.' '.$code.' m-t-5"></textarea>';
                    $html .= '<div class="text-danger key_res_areas_'.$code.'_error" id=""></div>';

                }

            }

            $html .= '</td>';

            /*cell 4*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell4[$i] != null){

                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[] " id="measurement_criteria_'.$cell1.'" class="form-control measurement_criteria_'.$cell1.' '.$code.' m-t-5">'.$row_values->$cell4[$i].'</textarea>';
                    // $html .= '<div class="text-danger key_res_areas_'.$cell1.'_error" id=""></div>';

                }else{
                    $html .= '<textarea name="measurement_criteria_'.$cell1.'[]" id="measurement_criteria_'.$cell1.'" class="form-control measurement_criteria_'.$cell1.' '.$code.' m-t-5"></textarea>';
                    // $html .= '<div class="text-danger key_res_areas_'.$cell1.'_error" id=""></div>';

                }

            }
            $html .= '</td>';

            /*cell 5*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell5[$i] != null){

                    $html .= '<textarea name="self_assessment_remark_'.$cell1.'[] " id="self_assessment_remark_'.$code.'" class="form-control self_assessment_remark_'.$cell1.' '.$code.' m-t-5">'.$row_values->$cell5[$i].'</textarea>';
                    $html .= '<div class="text-danger self_assessment_remark_'.$code.'_error" id=""></div>';

                }else{
                    $html .= '<textarea name="self_assessment_remark_'.$cell1.'[]" id="self_assessment_remark_'.$code.'" class="form-control self_assessment_remark_'.$cell1.' '.$code.' m-t-5"></textarea>';
                    $html .= '<div class="text-danger self_assessment_remark_'.$code.'_error" id=""></div>';

                }

            }
            $html .= '</td>';

            /*cell 6*/
            $html .= '<td>';

            for($i=0; $i < $sub_row_count; $i++){

                $code = $cell1.'_'.$i.$i.$i.$i.$i;

                if($row_values->$cell6[$i] != null){
                    $html .= '<select style="width:180px" class="form-control m-t-20 '.$code.' rating_by_employee_'.$cell1.'" id="rating_by_employee_'.$code.'" name="rating_by_employee_'.$cell1.'[]">';

                        $html .= '<option value="">...Select...</option>';

                        if($row_values->$cell6[$i] == "EE"){
                            $html .= '<option value="EE" selected>EE - Exceeded Expectations</option>';
                        }else{
                            $html .= '<option value="EE">EE - Exceeded Expectations</option>';
                        }

                        if($row_values->$cell6[$i] == "ME"){
                            $html .= '<option value="ME" selected>ME - Met Expectations</option>';
                        }else{
                            $html .= '<option value="ME">ME - Met Expectations</option>';
                        }

                        if($row_values->$cell6[$i] == "PME"){
                            $html .= '<option value="PME" selected>PME - Partially Met Expectations</option>';
                        }else{
                            $html .= '<option value="PME">PME - Partially Met Expectations</option>';
                        }

                        if($row_values->$cell6[$i] == "ND"){
                            $html .= '<option value="ND" selected>ND - Needs Development</option>';
                        }else{
                            $html .= '<option value="ND">ND - Needs Development</option>';
                        }

                    $html .= '</select>';
                    $html .= '<div class="text-danger rating_by_employee_'.$code.'_error" id=""></div>';

                }else{
                    $html .= '<select style="width:180px" class="form-control m-t-5 '.$code.' rating_by_employee_'.$cell1.'" id="rating_by_employee_'.$code.'" name="rating_by_employee_'.$cell1.'[]">';
                        $html .= '<option value="">...Select...</option>';
                        $html .= '<option value="EE">EE - Exceeded Expectations</option>';
                        $html .= '<option value="ME">ME - Met Expectations</option>';
                        $html .= '<option value="PE">PME - Partially Met Expectations</option>';
                        $html .= '<option value="ND">ND - Needs Development</option>';
                    $html .= '</select>';
                    $html .= '<div class="text-danger rating_by_employee_'.$code.'_error" id=""></div>';

                }

            }
            $html .= '</td>';

            /*Cell 8*/
            $html .= '<td>';
            for($i=0; $i < $sub_row_count; $i++){
                $code = $cell1.'_'.$i.$i.$i.$i.$i;
                $html .='<div class="dropup m-t-25">';
                    $html .='<button type="button" class="btn btn-xs btn-danger '.$code.'" onclick="removeRow(this,'.$code.');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                $html .='</div>';
            }
            $html .='</td>';

            $html .='<td>';
                $html .='<div class="dropup m-t-5">';
                    $html .='<button type="button" class="btn btn-xs btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                    $html .='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                        $html .='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,'.$cell1.');"></i></button></a>';
                        // html .='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                        $html .='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"  id="btnDelete" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                    $html .='</div>';
                $html .='</div>';
                // html .='<div class="dropup m-t-5">';
                //     html .='<button type="button" class="btn btn-xs btn-info" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                // html .='</div>';
                // html .='<div class="dropup m-t-5">';
                //     html .='<button type="button" class="btn btn-xs btn-danger" id="btnDelete" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                // html .='</div>';

                // html .=' <button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button>';
                // html .=' <button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                // html .=' <button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button>';
            $html .='</td>';

            $html .= '</tr>';

        }

        // dd($html);

        return json_encode($html);
    }
    public function add_goals_data(Request $request)
    {

        // dd(count($request->all()));die();
        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                // "rate_$i" => $request->input('rate_'.$i.''),
                // "actuals_$i" => $request->input('actuals_'.$i.''),
                // "self_remarks_$i" => $request->input('self_remarks_'.$i.''),
                // "self_assessment_rate_$i" => $request->input('self_assessment_rate_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        $logined_empID = Auth::user()->empID;
        $logined_username = Auth::user()->username;
        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $goal_data_count = Goals::where('created_by', $logined_empID)->get()->count();
        $total_count = $goal_data_count+1;
        $previous_year = $current_year - 1;
        $goal_name = 'PMS-'.$previous_year.'-'.$current_year;
        $rating_option_list_arr =  array("");

        if($request->employee_consolidated_rate != null || $request->employee_consolidated_rate != ""){
            $emp_self_rate = $request->employee_consolidated_rate;

            //Data upload to server
            $data = array(
                'goal_name' => $goal_name,
                'goal_process' => $goal_process,
                'goal_status' => "Pending",
                'supervisor_status' => "0",
                'employee_tb_status' => "1",
                'reviewer_status' => "0",
                'hr_status' => "0",
                'bh_status' => "0",
                'goal_unique_code' => "",
                'created_by' => $logined_empID,
                'created_by_name' => $logined_username,
                'employee_consolidated_rate' => $request->emp_self_rate,
            );

        }else{
             //Data upload to server
            $data = array(
                'goal_name' => $goal_name,
                'goal_process' => $goal_process,
                'goal_status' => "Pending",
                'supervisor_status' => "0",
                'employee_tb_status' => "1",
                'reviewer_status' => "0",
                'hr_status' => "0",
                'bh_status' => "0",
                'goal_unique_code' => "",
                'created_by' => $logined_empID,
                'created_by_name' => $logined_username,
            );
        }

        $last_inserted_id = $this->goal->add_goals_insert($data);

        //Goals Unique code
        if(!empty($last_inserted_id)){
            $goal_code="G";
            $goal_unique_code = $goal_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->goal->insertGoalsCode($goal_unique_code, $last_inserted_id);
        }
        if($result){
            return json_encode($goal_unique_code);
        }
        // return response($result);

        // $result_1 = json_decode($result); //convert to json

        // for ($i=0; $i < count($result_1); $i++) {

        //    dd(json_decode($refetch_goals_sup_detailssult_1[$i]));

        // }

    }

    public function add_goals_data_hr_sup(Request $request)
    {
          // echo json_encode($request->all());die();


        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();

        $html = '';


        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values=json_decode($data);
            // echo json_encode($row_values);die();

        $sup_name = "sup_remark_".$cell1;
          $sup_name_rem_val = $request->$sup_name;
          $sup_remark_value = $sup_name_rem_val;
          $sup_rem = "sup_remarks_".$cell1;
          $row_values->$sup_rem = $sup_remark_value;
          $sup_rat_name = "sup_rating_".$cell1;
          $sup_name_rate_val = $request->$sup_rat_name;
          $sup_rating_value = $sup_name_rate_val;
          $sup_final_op = "sup_final_output_".$cell1;
          $row_values->$sup_final_op = $sup_rating_value;
          $json_format = json_encode($row_values);
          array_push($json, $json_format);

        }
        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_hr($data);

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Reporting Manager Comments Submitted');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response($result);
    }
    public function add_goal_btn_login(){
        $result = $this->goal->add_goal_btn_login();
        // dd($result)        ;
        return json_encode($result);
    }
    public function add_goals_data_hr_save(Request $request){
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;

            $row_values=json_decode($data);
            /*$sup_name = "sup_remark_".$cell1;
            $sup_name_rem_val = $request->$sup_name;
            $sup_remark_value = $sup_name_rem_val;*/

          $sup_name = "sup_remark_".$cell1;
          $sup_name_rem_val = $request->$sup_name;
          $sup_remark_value = $sup_name_rem_val;
          $sup_rem = "sup_remarks_".$cell1;
          $row_values->$sup_rem = $sup_remark_value;
          $sup_rat_name = "sup_rating_".$cell1;
          $sup_name_rate_val = $request->$sup_rat_name;
          $sup_rating_value = $sup_name_rate_val;
          $sup_final_op = "sup_final_output_".$cell1;
          $row_values->$sup_final_op = $sup_rating_value;
          $json_format = json_encode($row_values);
          array_push($json, $json_format);

        }
        // echo json_encode($json);die();
        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );
        // dd($data);
        // echo '11<pre>';print_r($data);die();
        $result = $this->goal->update_goals_sup_save_hr($data);

        return response($result);
    }

    public function add_goals_data_submit(Request $request)
    {
        // dd(count($request->all()));die();
        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        $logined_empID = Auth::user()->empID;
        $logined_username = Auth::user()->username;
        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $goal_data_count = Goals::where('created_by', $logined_empID)->get()->count();
        $total_count = $goal_data_count+1;
        $previous_year = $current_year - 1;
        $goal_name = 'PMS-'.$previous_year.'-'.$current_year;
        $rating_option_list_arr =  array("");

        //Data upload to server
        $data = array(
            'goal_name' => $goal_name,
            'goal_process' => $goal_process,
            'goal_status' => "Pending",
            'supervisor_status' => "0",
            'employee_tb_status' => "1",
            'employee_status' => "1",
            'reviewer_status' => "0",
            'hr_status' => "0",
            'bh_status' => "0",
            'goal_unique_code' => "",
            'created_by' => $logined_empID,
            'created_by_name' => $logined_username,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $last_inserted_id = $this->goal->add_goals_insert($data);

        //Goals Unique code
        if(!empty($last_inserted_id)){
            $goal_code="G";
            $goal_unique_code = $goal_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->goal->insertGoalsCode($goal_unique_code, $last_inserted_id);
        }
        // if($result){
        //     // return json_encode($goal_unique_code);
        // }
        $logined_email = Auth::user()->email;
        $logined_sup_email = $this->goal->getSupEmail();
        $logined_sup_name = Auth::user()->sup_name;
        $logined_username = Auth::user()->username;
        $logined_empID = Auth::user()->empID;

        if($result){
            $data = array(
                'name'=> $logined_username,
                'to_email'=> $logined_email,
                'sup_to_email'=> $logined_email,
            );
            Mail::send('mail.goal-emp-mail', $data, function($message) use ($data) {
                // $message->to($todays_birthday->email)->subject
                //     ('Birthday Mail');
                $message->to($data['to_email'])->subject
                    ('Self Assessment Status - Registered');
                $message->cc($data['sup_to_email']);
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
            $sup_data = array(
                'name'=> $logined_username,
                'sup_name'=> $logined_sup_name,
                'emp_id'=> $logined_empID,
                'to_email'=> $logined_sup_email,
            );
            Mail::send('mail.goal-sup-mail', $sup_data, function($message) use ($sup_data) {
                $message->to($sup_data['to_email'])->subject
                    ('Self Assessment Status - Registered');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response($result);

    }
    public function get_hr_goal_list_tb(Request $request){
         if ($request !="") {
                $input_details = array(
                'supervisor_list'=>$request->input('supervisor_list'),
                'payroll_status_sup'=>$request->input('payroll_status_sup'),
                );
            }
            // echo "<pre>";print_r($input_details);die;

        $get_goal_list_result = $this->goal->get_hr_goal_list_tb($input_details);

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('rep_mana_status', function($row) {
            // echo "<pre>";print_r($row->supervisor_status);die;
            if($row->supervisor_status != 1 && $row->supervisor_tb_status != 1){
                $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
            }elseif($row->supervisor_status != 1 && $row->supervisor_tb_status == 1){
                $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
            }elseif($row->supervisor_status == 1){
                $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
            }
            return $btn;

        })
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('rep_manager_consolidated_rate', function($row) {
            // echo "<pre>";print_r($row->employee_consolidated_rate);die;
            if($row->supervisor_consolidated_rate != '')
            {
                $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                <option value=''>Select Team Member...</option>
                <option value='EC' ".($row->supervisor_consolidated_rate =='EC' ? 'selected' : '').">Exceptional Contributor - EC</option>
                <option value='SC' ".($row->supervisor_consolidated_rate =='SC' ? 'selected' : '').">Significant Contributor - SC</option>
                <option value='C' ".($row->supervisor_consolidated_rate =='C' ? 'selected' : '').">Contributor - C</option>
                <option value='PC' ".($row->supervisor_consolidated_rate =='PC' ? 'selected' : '').">Partial Contributor - PC</option>
                </select>
                <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
            }else{
                $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                <option value=''>Select Team Member...</option>
                <option value='EC'>Exceptional Contributor - EC</option>
                <option value='SC'>Significant Contributor - SC</option>
                <option value='C'>Contributor - C</option>
                <option value='PC'>Partial Contributor - PC</option>
                </select>
                <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
            }
            return $btn;
        })
        ->addColumn('action', function($row) {
                $enc_code = Crypt::encrypt($row->goal_unique_code);

                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                 $btn = '<div class="dropup">
                    <a href="goal_setting_hr_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                }elseif($row->goal_status == "Approved"){
                    // echo "<pre>";print_r("2s");die;
                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        /*$btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                </div>
                            </div>' ;*/
                            $btn = '<div class="dropup">

                                <a href="goal_setting_hr_view?id='.$enc_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>

                                </div>' ;
                    }else{
                        /*echo "<pre>";print_r("3s");die;
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting_hr_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                                </div>
                            </div>' ;*/
                        $btn = '<div class="dropup">
                                <a href="goal_setting_hr_view?id='.$enc_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                                </div>' ;
                    }

                }
            return $btn;
        })

        ->rawColumns(['rep_mana_status' ,'action', 'rep_manager_consolidated_rate', 'status'])
        ->make(true);
    }
    public function get_goal_list(){

        $get_goal_list_result = $this->goal->get_goal_list();
        $logined_payroll_status = Auth::user()->payroll_status;

        if($logined_payroll_status == "NAPS"){

            return DataTables::of($get_goal_list_result)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                        // echo "<pre>";print_r($row);die;

                        $enc_code = Crypt::encrypt($row->goal_unique_code);

                        if($row->goal_status == "Pending"){

                            if($row->employee_status == "0" || $row->employee_status == null){
                                $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting_naps?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                        <a href="goal_setting_edit_naps?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                                    </div>
                                </div>' ;
                            }else{
                                $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting_naps?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                </div>' ;
                            }

                        }elseif($row->goal_status == "Revert"){

                            $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting_naps?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                </div>
                            </div>' ;

                        }elseif($row->goal_status == "Approved"){
                            $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting_naps?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            </div>
                            </div>' ;

                            // $id = $row->goal_unique_code;
                            // $result = $this->goal->check_goals_employee_summary($id);

                            // if($result == "Yes"){
                            //     $btn = '<div class="dropup">
                            //             <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            //             <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                            //                 <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            //                 <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                            //             </div>
                            //         </div>' ;
                            // }else{
                            //     $btn = '<div class="dropup">
                            //             <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            //             <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                            //                 <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            //                 <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                            //             </div>
                            //         </div>' ;
                            // }

                        }

                    // <a class="dropdown-item ditem-gs deleteRecord"  data-id="'.$row->goal_unique_code.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }else{

            return DataTables::of($get_goal_list_result)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                        // echo "<pre>";print_r($row);die;
                        // dd(base64_encode($row->goal_unique_code));

                        $enc_code = Crypt::encrypt($row->goal_unique_code);

                        if($row->goal_status == "Pending"){

                            if($row->employee_status == "0" || $row->employee_status == null){
                                $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                        <a href="goal_setting_edit?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                                    </div>
                                </div>' ;
                            }else{

                                $btn = '<div class="dropup">
                                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                        <a href="goal_setting?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                </div>' ;
                            }

                        }elseif($row->goal_status == "Revert"){

                            $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                </div>
                            </div>' ;

                        }elseif($row->goal_status == "Approved"){
                            $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            </div>
                            </div>' ;

                            // $id = $row->goal_unique_code;
                            // $result = $this->goal->check_goals_employee_summary($id);

                            // if($result == "Yes"){
                            //     $btn = '<div class="dropup">
                            //             <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            //             <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                            //                 <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            //                 <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                            //             </div>
                            //         </div>' ;
                            // }else{
                            //     $btn = '<div class="dropup">
                            //             <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            //             <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                            //                 <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            //                 <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                            //             </div>
                            //         </div>' ;
                            // }

                        }

                    // <a class="dropdown-item ditem-gs deleteRecord"  data-id="'.$row->goal_unique_code.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);

        }

    }

    public function get_team_member_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_member_filter'=>$request->input('team_member_filter'),
            'payroll_status_filter'=>$request->input('payroll_status_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_team_member_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('rep_mana_status', function($row) {

                // if($row->supervisor_status != 1 && $row->supervisor_tb_status != 1){
                //     $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                // }elseif($row->supervisor_status != 1 && $row->supervisor_tb_status == 1){
                //     $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                // }elseif($row->supervisor_status == 1){
                //     $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                // }

                if($row->supervisor_status == 0){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->supervisor_status == 1){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->supervisor_status == 2){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }

                return $btn;
            })
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('rep_manager_consolidated_rate', function($row) {
                // echo "<pre>";print_r($row->employee_consolidated_rate);die;
                if($row->supervisor_consolidated_rate != '')
                {
                    $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='EC' ".($row->supervisor_consolidated_rate =='EC' ? 'selected' : '').">Exceptional Contributor - EC</option>
                    <option value='SC' ".($row->supervisor_consolidated_rate =='SC' ? 'selected' : '').">Significant Contributor - SC</option>
                    <option value='C' ".($row->supervisor_consolidated_rate =='C' ? 'selected' : '').">Contributor - C</option>
                    <option value='PC' ".($row->supervisor_consolidated_rate =='PC' ? 'selected' : '').">Partial Contributor - PC</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }else{
                    $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='EC'>Exceptional Contributor - EC</option>
                    <option value='SC'>Significant Contributor - SC</option>
                    <option value='C'>Contributor - C</option>
                    <option value='PC'>Partial Contributor - PC</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }
                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    // $id = $row->goal_unique_code;
                    // $result = $this->goal->check_goals_employee_summary($id);

                    // if($result == "Yes"){
                    //     $btn = '<div class="dropup">
                    //                 <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    //                 <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //                     <a href="goal_setting_supervisor_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    //                     <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show_fn" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                    //                 </div>
                    //             </div>' ;
                    // }else{
                    //     $btn = '<div class="dropup">
                    //                 <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    //                 <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //                     <a href="goal_setting_supervisor_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    //                 </div>
                    //             </div>' ;
                    // }
                    // <a href="goal_setting_supervisor_edit?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    $enc_code = Crypt::encrypt($row->goal_unique_code);

                    $btn = '<div class="dropup">
                    <a href="goal_setting_supervisor_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;
                return $btn;
            })

            ->rawColumns(['rep_mana_status', 'status', 'rep_manager_consolidated_rate', 'action'])
            ->make(true);
        }

    }
    public function update_goals_sup_reviewer_tm_hr(Request $request){
            $id = $request->goals_setting_id;
            // echo "<pre>";print_r($request->all());die;
            //Data upload to server
            $data = array(
                'reviewer_remarks' => $request->reviewer_remarks,
                // 'increment_recommended' => $request->increment_recommended,
                // 'increment_percentage' => $request->increment_percentage,
                // 'performance_imporvement' => $request->performance_imporvement,
                // 'hike_per_month' => $request->hike_per_month,
                'goal_unique_code' => $id
            );
            // dd($data);
            $result = $this->goal->update_goals_sup_reviewer_tm_hr($data);

            //Sending mail to reviewer
            $logined_hr_email = "rajesh.ms@hemas.in";
            $logined_username = $this->goal->getEmpName($id);
            $logined_empID = $this->goal->getEmpID($id);
            $check = $this->goal->checkDirectBh($logined_empID);

            if(!empty($check)){

                $logined_hr_email = "rajesh.ms@hemas.in";

                if($result){

                    $rev_data = array(
                        'name'=> $logined_username,
                        'emp_id'=> $logined_empID,
                        'to_email'=> $logined_hr_email,
                    );

                    Mail::send('mail.goal-rev-hr-mail', $rev_data, function($message) use ($rev_data) {
                        $message->to($rev_data['to_email'])->subject
                            ('Reviewer Comments Submitted');
                        $message->from("hr@hemas.in", 'HEPL - HR Team');
                    });

                }

            }else{

                $logined_hr_email = "dhivya.r@hemas.in";

                if($result){

                    $rev_data = array(
                        'name'=> $logined_username,
                        'emp_id'=> $logined_empID,
                        'to_email'=> $logined_hr_email,
                    );

                    Mail::send('mail.goal-rev-hr-mail', $rev_data, function($message) use ($rev_data) {
                        $message->to($rev_data['to_email'])->subject
                            ('Reviewer Comments Submitted');
                        $message->from("hr@hemas.in", 'HEPL - HR Team');
                    });

                }

            }
            return response($result);

        }
    public function reviewer_remarks_rate_text(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->reviewer_remarks_rate_text_db($id);
        // echo "<pre>";print_r($head);die;
        return json_encode($head);
    }
    public function hr_remarks_rate_text(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->hr_remarks_rate_text_db($id);
        return json_encode($head);
    }
    public function get_reviewer_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter'=>$request->input('team_leader_filter'),
            'payroll_status_filter'=>$request->input('payroll_status_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_reviewer_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('rep_mana_status', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                // if($row->supervisor_status != 1 && $row->supervisor_tb_status != 1){
                //     $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                // }elseif($row->supervisor_status != 1 && $row->supervisor_tb_status == 1){
                //     $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                // }elseif($row->supervisor_status == 1){
                //     $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                // }

                if($row->supervisor_status == 0){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->supervisor_status == 1){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->supervisor_status == 2){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }

                return $btn;

            })
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('rep_manager_consolidated_rate', function($row) {
                // echo "<pre>";print_r($row->employee_consolidated_rate);die;
                if($row->supervisor_consolidated_rate != '')
                {
                    $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='EC' ".($row->supervisor_consolidated_rate =='EC' ? 'selected' : '').">Exceptional Contributor - EC</option>
                    <option value='SC' ".($row->supervisor_consolidated_rate =='SC' ? 'selected' : '').">Significant Contributor - SC</option>
                    <option value='C' ".($row->supervisor_consolidated_rate =='C' ? 'selected' : '').">Contributor - C</option>
                    <option value='PC' ".($row->supervisor_consolidated_rate =='PC' ? 'selected' : '').">Partial Contributor - PC</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }else{
                    $btn = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 255px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='EC'>Exceptional Contributor - EC</option>
                    <option value='SC'>Significant Contributor - SC</option>
                    <option value='C'>Contributor - C</option>
                    <option value='PC'>Partial Contributor - PC</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }
                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    // $btn = '<div class="dropup">
                    // <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    // <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                    //     <a href="goal_setting_reviewer_view?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                    // </div>
                    // </div>' ;

                    $enc_code = Crypt::encrypt($row->goal_unique_code);

                    $btn = '<div class="dropup">
                    <a href="goal_setting_reviewer_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['rep_mana_status', 'status', 'rep_manager_consolidated_rate', 'action'])
            ->make(true);
        }

    }
   public function get_bh_goal_list(Request $request){



        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter'=>$request->input('team_leader_filter'),
                'team_member_filter'=>$request->input('team_member_filter'),
                'payroll_status'=>$request->input('payroll_status'),
                'department'=>$request->input('department'),
                'gender'=>$request->input('gender'),
                'grade'=>$request->input('grade')
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_bh_goal_list($input_details);
            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }else{
                    $btn = '';
                }
                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })
            ->addColumn('sheet_status', function($row) {
                if($row->bh_status=="1"){
                    $btn = '<div class="dropup"><button type="button" class="btn btn-success btn-xs goal_btn_status"      id="dropdownMenuButton">Submitted</button></div>' ;
                }elseif($row->bh_tb_status == "1" && $row->bh_status!="1"){
                    $btn = '<div class="dropup"><button type="button" class="btn btn-primary btn-xs goal_btn_status"      id="dropdownMenuButton">Saved</button></div>' ;

                }elseif($row->bh_tb_status != "1" && $row->bh_status!="1"){
                    $btn = '<div class="dropup"><button type="button" class="btn btn-danger btn-xs goal_btn_status"      id="dropdownMenuButton">Pending</button></div>' ;
                }else{
                    $btn = '';
                }
                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })

            ->addColumn('action', function($row) {
                    $enc_code = Crypt::encrypt($row->goal_unique_code);
                    $btn1 = '<div class="dropup">
                    <a href="goal_setting_bh_reviewer_view?id='.$enc_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                return $btn1;
            })

            ->rawColumns(['status', 'action','sheet_status'])
            ->make(true);
        }

    }
    public function get_hr_goal_list_record(Request $request){

        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter'=>$request->input('team_leader_filter'),
                'team_member_filter'=>$request->input('team_member_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_bh_goal_list($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {

                    $enc_code = Crypt::encrypt($row->goal_unique_code);

                    // echo "<pre>";print_r($row);die;
                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting_hr_view?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_hr_edit?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }

    }
    public function goals_delete(Request $request){
        $id = $request->id;
        $result = $this->goal->fetchGoalIdDelete($id);
        return response($result);
    }
    public function goals_employee_summary(Request $request){
        $id = $request->id;
        $employee_summary = $request->employee_summary;
        $result = $this->goal->addGoalEmployeeSummary($id, $employee_summary);
        return response($result);
    }
    public function update_goals_data(Request $request)
    {
        // dd($request->all());die();
        $count = count($request->all())-1;
        $row_count = $count/10;
        // $row_count = $count/6;
        $code = $request->edit_id;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "sub_indicators_$i" => $request->input('sub_indicators_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "weightage_$i" => $request->input('weightage_'.$i.''),
                "reference_$i" => $request->input('reference_'.$i.''),
            ]);

        }

        $goal_process = json_encode($json); //convert to json
        // $json_stripslashes = stripslashes(json_encode($json)); //convert to json
        // dd($goal_process);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $code,
        );

        $result = $this->goal->add_goals_update($data);

        return response($result);
    }
    public function add_goal_btn(){
        $result = $this->goal->add_goal_btn();
        // dd($result)        ;
        return json_encode($result);
    }
    public function goals_status(Request $request){
        //Data upload to server
        $data = array(
            'goal_status' => $request->goals_status,
            'goal_unique_code' => $request->id,
        );
        $result = $this->goal->goals_status_update($data);
        return response($result);

    }
    public function fetch_supervisor_filter(Request $request){
        $supervisor_filter = $request->supervisor_filter;
        $result = $this->goal->fetch_supervisor_filter($supervisor_filter);
        return json_encode($result);
    }
    public function fetch_reviewer_filter(Request $request){
        $reviewer_filter = $request->reviewer_filter;
        $result = $this->goal->fetch_reviewer_filter($reviewer_filter);
        return json_encode($result);
    }
    public function fetch_team_leader_filter(Request $request){
        $team_leader_filter = $request->team_leader_filter;
        $result = $this->goal->fetch_team_leader_filter($team_leader_filter);
        return json_encode($result);
    }
     public function fetch_team_leader_wise_filter(Request $request){
        $team_leader_filter = $request->team_leader_filter;
        $result = $this->goal->fetch_reviewer_wise_filter($team_leader_filter);
        return json_encode($result);
    }

    public function fetch_goals_employee_summary(Request $request){
        $id = $request->id;
        // echo "<pre>as";print_r($id);die;
        $result = $this->goal->fetch_goals_employee_summary($id);
        return json_encode($result);
    }
    public function fetch_goals_supervisor_summary(Request $request){
        $id = $request->id;
        // echo "<pre>as";print_r($id);die;
        $result = $this->goal->fetch_goals_supervisor_summary($id);
        return json_encode($result);
    }

    public function goals_supervisor_summary(Request $request){
        $id = $request->id;
        $sup_summary = $request->supervisor_summary;
        $result = $this->goal->goals_supervisor_summary($id, $sup_summary);
        return response($result);
    }
    public function update_goals_sup(Request $request){
        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();
        $html = '';
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            //   echo json_encode();die();

            //Supervisor remark add
            $sup_name = "sup_remark_".$cell1;
            $sup_name_rem_val = $request->$sup_name;
            $sup_remark_value = $sup_name_rem_val;
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            //Supervisor rating add
            $sup_rat_name = "sup_rating_".$cell1;
            $sup_name_rate_val = $request->$sup_rat_name;
            $sup_rating_value = $sup_name_rate_val;
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);
        // dd($json);

        // if(!empty($request->supervisor_movement)){

        //     // $movement_json = array();

        //     //Supervisor remark add
        //     $supervisor_movement = $request->supervisor_movement;
        //     $with_effect_date = $request->with_effect_date;
        //     $team_member_list = $request->team_member_list;
        //     $supervisor_name_list = $request->supervisor_name_list;
        //     $movement_remark = $request->movement_remark;
        //     $mov_designation = $request->mov_designation;
        //     $mov_promotion = $request->mov_promotion;

        //     $movement_json = json_encode([
        //         "supervisor_movement" => $request->input('supervisor_movement'),
        //         "with_effect_date" => $request->input('with_effect_date'),
        //         "team_member_list" => $request->input('team_member_list'),
        //         "supervisor_name_list" => $request->input('supervisor_name_list'),
        //         "movement_remark" => $request->input('movement_remark'),
        //         "mov_designation" => $request->input('mov_designation'),
        //         "mov_promotion" => $request->input('mov_promotion'),
        //     ]);
        //     // dd($movement_json);

        // }else{
        //     $movement_json = null;
        // }

        // $movement_json_data = array(
        //     'movement_json' => $movement_json,
        //     'goal_unique_code' => $id,
        // );

        // $result = $this->goal->update_goals_sup_movement($movement_json_data);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );
        // dd($data);

        $result = $this->goal->update_goals_sup($data);

        return response($result);
    }
    public function get_goal_setting_rev_dept_name(request $request){
        $id = $request->id;
        $response = $this->goal->get_goal_setting_rev_dept_name($id);
        return response($response);
    }
    public function get_goal_setting_sup_dept_name(request $request){
        $id = $request->id;
        $response = $this->goal->get_goal_setting_sup_dept_name($id);
        return response($response);
    }

    public function update_goals_sup_submit(Request $request){
        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Supervisor remark add
            $sup_name = "sup_remark_".$cell1;
            $sup_name_rem_val = $request->$sup_name;
            $sup_remark_value = $sup_name_rem_val;
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            //Supervisor rating add
            $sup_rat_name = "sup_rating_".$cell1;
            $sup_name_rate_val = $request->$sup_rat_name;
            $sup_rating_value = $sup_name_rate_val;
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        // dd($json);

        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_submit($data);

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response($result);
    }
    // public function update_goals_sup_submit(Request $request){
    //     // dd($request->all());
    //     $id = $request->goals_setting_id;
    //     $json_value = $this->goal->fetchGoalIdDetails($id);
    //     $datas = json_decode($json_value);

    //     $json = array();

    //     $html = '';

    //     foreach($datas as $key=>$data){
    //         $cell1 = $key+1;
    //         $row_values = json_decode($data);

    //         //Supervisor remark add
    //         $sup_remark_value = array($request->sup_remark[$key]);
    //         $sup_rem = "sup_remarks_".$cell1;
    //         $row_values->$sup_rem = $sup_remark_value;

    //         //Supervisor rating add
    //         $sup_rating_value = array($request->sup_rating[$key]);
    //         $sup_final_op = "sup_final_output_".$cell1;
    //         $row_values->$sup_final_op = $sup_rating_value;

    //         $json_format = json_encode($row_values);
    //         array_push($json, $json_format);

    //     }
    //     // dd($json);

    //     $goal_process = json_encode($json);

    //     //Data upload to server
    //     $data = array(
    //         'goal_process' => $goal_process,
    //         'goal_unique_code' => $id,
    //         'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
    //     );
    //     // dd($data);
    //     $result = $this->goal->update_goals_sup_submit($data);

    //     return response($result);
    // }
    /*hr goal list*/
    public function get_hr_goal_list(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter'=>$request->input('team_leader_filter'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_hr_goal_list_tb($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $enc_code = Crypt::encrypt($row->goal_unique_code);

                    $btn = '<div class="dropup">
                    <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                    <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                        <a href="goal_setting_reviewer_view?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                        <a href="goal_setting_reviewer_edit?id='.$enc_code.'" class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs goals_btn" type="button"><i class="fa fa-pencil"></i></button></a>
                    </div>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
        }
    }

    public function get_team_member_list(Request $request){
        $id = $request->supervisor_list_1;
        $result = $this->goal->fetch_team_member_list($id);

        // echo "<pre>";print_r($result);die;
        return json_encode($result);
    }

    public function get_hr_supervisor(){
        $hr_supervisor ="900531";
        $result = $this->goal->get_supervisor_hr($hr_supervisor);
        return json_encode($result);
    }
    public function get_manager_lsit_drop(Request $request){
        $id = $request->reviewer_filter;
        $result = $this->goal->get_manager_lsit($id);
        return json_encode($result);
    }
    public function get_team_member_drop(Request $request){
        $id = $request->team_leader_filter_hr;
        $result = $this->goal->get_team_member_drop_list($id);
        return json_encode($result);
    }
    public function hr_list_tab_record(Request $request){
         if ($request !="") {
            $input_details = array(
                'reviewer_filter_1'=>$request->input('reviewer_filter_1'),
                'team_leader_filter_hr_1'=>$request->input('team_leader_filter_hr_1'),
                'team_member_filter_hr_1'=>$request->input('team_member_filter_hr_1'),
                'gender_hr_1'=>$request->input('gender_hr_1'),
                'grade_hr_1'=>$request->input('grade_hr_1'),
                'department_hr_1'=>$request->input('department_hr_1'),
                'payroll_status_hr_1'=>$request->input('payroll_status_hr_1'),
            );
        }

        if ($request->ajax()) {
        $result = $this->goal->gethr_list_tab_record($input_details);
        // echo "<pre>";print_r($result['textbox']);die;
        return DataTables::of($result)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }
                return $btn;
            })
            /*action button for CTC */
            /*->addColumn('action', function($row) {
                   $btn='<a onclick="employee_ctc_pdf_generate('."'".$row->created_by."'".');" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Profile" type="button" style="width: 15%;height: 35px;"></a>';

                    return $btn;
            ->rawColumns(['status','action'])
                })*/
            ->rawColumns(['status'])
            ->make(true);

        }
    }
/*after cick in hr submit button*/
      public function get_hr_goal_list_tbl(Request $request){

        if ($request !="") {
            $input_details = array(
                'reviewer_filter'=>$request->input('reviewer_filter'),
                'team_leader_filter_hr'=>$request->input('team_leader_filter_hr'),
                'team_member_filter_hr'=>$request->input('team_member_filter_hr'),
                'gender_hr_2'=>$request->input('gender_hr_2'),
                'grade_hr_2'=>$request->input('grade_hr_2'),
                'department_hr_2'=>$request->input('department_hr_2'),
                'payroll_status_hr'=>$request->input('payroll_status_hr'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_hr_goal_list_for_tbl($input_details);

              // echo json_encode($get_goal_list_result);die();


            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('hr_status_btn', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                if($row->supervisor_status != 1 && $row->supervisor_tb_status != 1){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->supervisor_status != 1 && $row->supervisor_tb_status == 1){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->supervisor_status == 1){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }
                return $btn;

            })
            ->addColumn('rep_mana_status', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                if($row->supervisor_status != 1 && $row->supervisor_tb_status != 1){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->supervisor_status != 1 && $row->supervisor_tb_status == 1){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->supervisor_status == 1){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }
                return $btn;

            })
            ->addColumn('status', function($row) {
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }else{
                    $btn = '';
                }
                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })
            ->addColumn('new_sup_name', function($row) {                
                $sup = DB::table("customusers")->where('empID', $row->new_sup)->value('username');
                return $sup;
            })
            ->addColumn('pip_month_value', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                if($row->pip_month != 0){
                    $val = $row->pip_month ;
                }else{
                    $val = "";
                }
                return $val;

            })
            ->addColumn('hr_rating_op', function($row) {
                $random = mt_rand(10000, 99999);

                $payroll_status = DB::table("customusers")->where('empID', $row->created_by)->value('payroll_status');

                if($row->action_to_be_performed != '')
                {                    
                    $btn = "<select class='form-control hr_rating_cls' data-details=".$payroll_status." id='rep_manager_consolidated_rate_".$random."' name='rep_manager_consolidated_rate' style='width: 216px;'>";
                    $btn .= "<option value=''>Select action...</option>";
                    $btn .= "<option value='No movement' ".($row->action_to_be_performed =='No movement' ? 'selected' : '').">No movement</option>";
                    $btn .= "<option value='Place employee in PIP' ".($row->action_to_be_performed =='Place employee in PIP' ? 'selected' : '').">Place employee in PIP</option>";
                    $btn .= "<option value='Increment Percentage' ".($row->action_to_be_performed =='Increment Percentage' ? 'selected' : '').">Increment Percentage</option>";
                    $btn .= "<option value='Progression' ".($row->action_to_be_performed =='Progression' ? 'selected' : '').">Progression</option>";
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='hr_rate_error_".$random."'></label>";        
                    
                    $design_lists = DB::table("customusers")->groupByRaw('designation')->get();

                    $btn .= "<select class='form-control designation_cls m-t-2' id='designation_".$random."' name='designation' style='display:none;width: 216px;'>";
                    $btn .= "<option value=''>Select designation...</option>";
                    foreach($design_lists as $list){
                        if($list->designation != ""){
                            $btn .= "<option value='".$list->designation."'>".$list->designation."</option>";
                            
                        }
                    }
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='designation_error_".$random."'></label>"; 

                    $emp_lists = DB::table("customusers")->get();

                    $btn .= "<select class='form-control new_sup_cls m-t-5' id='new_sup_".$random."' name='new_sup' style='display:none;width: 216px;'>";
                    $btn .= "<option value=''>Select rep.manager...</option>";
                    foreach($emp_lists as $list){                        
                        $btn .= "<option value='".$list->empID."'>".$list->username."</option>";                        
                    }
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='new_sup_error_".$random."'></label>"; 
                    
                    $btn .= "<input type='number' class='form-control pip_month_cls m-t-5' style='display:none;width:216px;' placeholder='Enter pip month' id='pip_month_".$random."' name='quantity' min='1' max='4'>";
                    $btn .= "<label style='color: red;' class='pip_month_error_".$random."'></label>";                    
                    $btn .= '<input type="text" class="form-control increment_percentage_cls m-t-5"  style="display:none;width:216px;" placeholder="Enter increment percentage" id="increment_percentage_'.$random.'" name="increment_percentage" class="form-control">';
                    $btn .= "<label style='color: red;' class='increment_percentage_error_".$random."'></label>";                    
                    $btn .= '<input type="text"  class="form-control hike_per_month_cls m-t-5" style="display:none;width:216px;" id="hike_per_month_'.$random.'" onkeypress="return isNumber(event)" placeholder="Enter hike per month" name="hike_per_month" class="form-control">';
                    $btn .= "<label style='color: red;' class='hike_per_month_error_".$random."'></label>"; 

                }else{
                    
                    $btn = "<select class='form-control hr_rating_cls' data-details=".$payroll_status." id='rep_manager_consolidated_rate_".$random."' name='rep_manager_consolidated_rate' style='width: 216px;'>";
                    $btn .= "<option value=''>Select action...</option>";
                    $btn .= "<option value='No movement'>No movement</option>";
                    $btn .= "<option value='Place employee in PIP'>Place employee in PIP</option>";
                    $btn .= "<option value='Increment Percentage'>Increment Percentage</option>";
                    $btn .= "<option value='Progression'>Progression</option>";
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='hr_rate_error_".$random."'></label>";

                    $design_lists = DB::table("customusers")->groupByRaw('designation')->get();

                    $btn .= "<select class='form-control designation_cls m-t-2' id='designation_".$random."' name='designation' style='display:none;width: 216px;'>";
                    $btn .= "<option value=''>Select designation...</option>";
                    foreach($design_lists as $list){
                        if($list->designation != ""){
                            $btn .= "<option value='".$list->designation."'>".$list->designation."</option>";
                            
                        }
                    }
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='designation_error_".$random."'></label>"; 

                    $emp_lists = DB::table("customusers")->get();

                    $btn .= "<select class='form-control new_sup_cls m-t-5' id='new_sup_".$random."' name='new_sup' style='display:none;width: 216px;'>";
                    $btn .= "<option value=''>Select rep.manager...</option>";
                    foreach($emp_lists as $list){                        
                        $btn .= "<option value='".$list->empID."'>".$list->username."</option>";                        
                    }
                    $btn .= "</select>";
                    $btn .= "<label style='color: red;' class='new_sup_error_".$random."'></label>";                     
                    $btn .= "<input type='number' class='form-control pip_month_cls m-t-5' style='display:none;width:216px;' id='pip_month_".$random."' placeholder='Enter pip month' name='quantity' min='1' max='4'>";
                    $btn .= "<label style='color: red;' class='pip_month_error_".$random."'></label>";                    
                    $btn .= '<input type="text" class="form-control increment_percentage_cls m-t-5" style="display:none;width:216px;" placeholder="Enter increment percentage" id="increment_percentage_'.$random.'" name="increment_percentage" class="form-control">';
                    $btn .= "<label style='color: red;' class='increment_percentage_error_".$random."'></label>";                    
                    $btn .= '<input type="text" class="form-control hike_per_month_cls m-t-5"  onkeypress="return isNumber(event)" placeholder="Enter hike per month" style="display:none;width:216px;" id="hike_per_month_'.$random.'" name="hike_per_month" class="form-control">';
                    $btn .= "<label style='color: red;' class='hike_per_month_error_".$random."'></label>"; 

                }
                return $btn;

            })
            ->addColumn('action', function($row) {

                $enc_code = Crypt::encrypt($row->goal_unique_code);

                $btn1 = '<div class="dropup">
                <a href="goal_setting_hr_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                </div>' ;

                return $btn1;
            })

            ->rawColumns(['hr_status_btn', 'status', 'new_sup_name', 'pip_month_value', 'hr_rating_op', 'action'])
            ->make(true);
        }

    }
    public function check_goal_sheet_role_type_hr(Request $request)
    {
        $id = $request->id;
        $result = $this->goal->checkHrReviewerIDOrNot($id);

        return json_encode($result);
    }
    public function check_role_type_hr(Request $request)
    {
        $id = $request->id;
        $result = $this->goal->checkHrReviewerIDOrNot_hr($id);

        return json_encode($result);
    }



//vignesh code for supervisor wise check data



//for get filter supervisor data
 public function select_supervisor_data_bh(Request $request)
 {
    $data=array('supervisor_id' =>$request->supervisor_id,
                'payroll_status'=>$request->payroll_status);
    $response=$this->goal->get_filtered_supervisor_data($data);

     echo json_encode($response);

 }

//get user_goals info under reviewer by vignesh

 public function select_reviewer_data_bh()
 {
    $logined_empID = Auth::user()->empID;
    $users_under_reviewer=CustomUser::where('sup_emp_code',$logined_empID)
                                      ->select('customusers.username','customusers.empID')->get();
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.reviewer_emp_code',$logined_empID)
    ->where('customusers.sup_emp_code','!=',$logined_empID)
    ->where('goals.supervisor_status','1')
    ->select('goals.*')->get();
    $result=json_decode($result);
    $data['result']=$result;
    $data['user_info_unser_reviewer']=$users_under_reviewer;
    echo json_encode($data);

 }
 //get user_goals reviewer filter
 public function select_reviewer_filter_bh(Request $request)
 {
        $data=$request->data;
        // echo json_encode($data[0]['sup_id']);
        $id=$data[0]['id'];
        if($id==1){
               $user_info=CustomUser::where('sup_emp_code',$data['0']['sup_id'])->get();
               $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
               ->where('customusers.sup_emp_code',$data['0']['sup_id'])
               ->where('customusers.empID',$data['0']['emp_id'])
               ->where('goals.supervisor_status','1')
               ->select('goals.*')->get();
               $result=json_decode($result);
               $final['status']='1';
               $final['result']=$result;
               $final['user_info']=$user_info;
        }
        if($id==2){
               $user_info=CustomUser::where('sup_emp_code',$data['0']['sup_id'])->get();
               $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
               ->where('customusers.sup_emp_code',$data['0']['sup_id'])
               ->where('goals.supervisor_status','1')
               ->select('goals.*')->get();
               $result=json_decode($result);
               $final['status']='2';
               $final['result']=$result;
               $final['user_info']=$user_info;
        }

        echo json_encode($final);
 }
 //get all user details

 public function select_all_member_info()
 {
    $logined_empID = Auth::user()->empID;
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.sup_emp_code','!=',$logined_empID)
    ->where('customusers.reviewer_emp_code','!=',$logined_empID)
    ->where('goals.supervisor_status','1')
    ->where('goals.reviewer_status','1')
    ->where('goals.hr_status','1')
    ->where('goals.employee_status','1')
    ->select('goals.*')->get();

  $department = DB::select("SELECT department FROM customusers GROUP by department");
  $band= DB::select("SELECT grade FROM customusers GROUP by grade");
    // $result=json_decode($result);
  $data['result']=$result;
  $data['department']=$department;
  $data['band']=$band;
  echo json_encode($data);
 }

function get_all_memer_filter_url(Request $request){
    if ($request !="") {
        $input_details = array(
            'reviewer_filter'=>$request->input('reviewer_filter'),
            'team_leader_filter'=>$request->input('team_leader_filter'),
            'team_member_filter'=>$request->input('team_member_filter'),
        );
    }
}


public function get_all_supervisors_info_bh()
{

    $logined_empID = Auth::user()->empID;
    $result=CustomUser::join('goals','customusers.empID','=','goals.created_by')
    ->where('customusers.sup_emp_code',$logined_empID)
    ->select('goals.*')->get();
    $result=json_decode($result);
    echo json_encode($result);
}


    public function get_grade()
    {
        $result = DB::select("SELECT grade FROM customusers GROUP by grade");
        return json_encode($result);
    }
    public function get_department()
    {
        $result = DB::select("SELECT department FROM customusers GROUP by department");
        return json_encode($result);
    }

    public function get_reviewer_goal_list_for_reviewer(Request $request){

        if ($request !="") {
            $input_details = array(
            'team_leader_filter_for_reviewer'=>$request->input('team_leader_filter_for_reviewer'),
            'team_member_filter'=>$request->input('team_member_filter'),
            'payroll_status_filter_for_reviewer'=>$request->input('payroll_status_filter_for_reviewer'),
            );
        }
        // echo '<pre>';print_r($input_details);die();

        if ($request->ajax()) {

            $get_goal_list_result = $this->goal->get_reviewer_goal_list_for_reviewer($input_details);

            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()

            ->addColumn('reviewer_status', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                if($row->reviewer_status != 1 && $row->reviewer_tb_status != 1){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->reviewer_status != 1 && $row->reviewer_tb_status == 1){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->reviewer_status == 1){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }
                return $btn;
            })

            ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
            ->addColumn('action', function($row) {
                    // echo "<pre>";print_r($row);die;
                    $enc_code = Crypt::encrypt($row->goal_unique_code);
                    $btn = '<div class="dropup">
                    <a href="goal_setting_reviewer_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                    </div>' ;

                return $btn;
            })

            ->rawColumns(['reviewer_status','status', 'action'])
            ->make(true);
        }

    }

    public function goal_employee_summary_check(request $request){
        $id = $request->id;
        $response = $this->goal->goal_employee_summary_check($id);
        return response($response);
    }
    public function get_goal_setting_reviewer_details_tl(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
        );
        $get_reviewer_details_tl_result = $this->goal->get_goal_setting_reviewer_details_tl( $input_details );
        // echo 'test<pre>';print_r($get_reviewer_details_tl_result[0]->reviewer_emp_code);die();
        $customeruser_details_tl = DB::table('customusers as cu')
                           ->where('cu.empID', $get_reviewer_details_tl_result[0]->sup_emp_code)
                           ->get();
        $reviewer_details_tl = DB::table('customusers as cu')
                           ->where('cu.empID', $get_reviewer_details_tl_result[0]->reviewer_emp_code)
                           ->get();
        // echo '<pre>';print_r($reviewer_details_tl);die();
        $new_data['all']=$get_reviewer_details_tl_result;
        $new_data['only_dept']=$customeruser_details_tl;
        $new_data['only_dept_reve']=$reviewer_details_tl;
        return response()->json( $new_data );
    }
    public function get_goal_setting_hr_details_tl(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_reviewer_hr_tl_result = $this->goal->get_goal_setting_hr_details_tl( $input_details );
        // echo 'test<pre>';print_r($get_reviewer_hr_tl_result);die();

        return response()->json( $get_reviewer_hr_tl_result );
    }
    public function update_emp_goals_data(Request $request){
        // dd(($request->all()));die();

        $id = $request->goals_setting_id;

        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;
        // dd($row_count);die();

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }
        // dd($json);
        $goal_process = json_encode($json); //convert to json

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $result = $this->goal->update_emp_goals_data($data);

        return response($result);
    }

    public function update_emp_goals_data_submit(Request $request){
        // dd(($request->all()));die();

        $id = $request->goals_setting_id;

        $count = count($request->all())-1;
        $row_count = $count/5;
        // $row_count = count($request->all())/10;

        for ($i=1; $i <= $row_count; $i++) {

            $json[] = json_encode([
                "key_bus_drivers_$i" => $request->input('key_bus_drivers_'.$i.''),
                "key_res_areas_$i" => $request->input('key_res_areas_'.$i.''),
                "measurement_criteria_$i" => $request->input('measurement_criteria_'.$i.''),
                "self_assessment_remark_$i" => $request->input('self_assessment_remark_'.$i.''),
                // "weightage_$i" => $request->input('weightage_'.$i.''),
                "rating_by_employee_$i" => $request->input('rating_by_employee_'.$i.''),
                "sup_remarks_$i" => "",
                "sup_final_output_$i" => "",
                "reviewer_remarks_$i" => "",
                "hr_remarks_$i" => "",
                "bh_sign_off_$i" => "",
            ]);

        }
        // dd($json);

        $goal_process = json_encode($json); //convert to json

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'employee_consolidated_rate' => $request->employee_consolidated_rate,
        );

        $result = $this->goal->update_emp_goals_data_submit($data);

        $logined_email = Auth::user()->email;
        $logined_sup_email = $this->goal->getSupEmail();
        $logined_sup_name = Auth::user()->sup_name;
        $logined_username = Auth::user()->username;
        $logined_empID = Auth::user()->empID;

        if($result){
            $data = array(
                'name'=> $logined_username,
                'to_email'=> $logined_email,
            );
            Mail::send('mail.goal-emp-mail', $data, function($message) use ($data) {
                // $message->to($todays_birthday->email)->subject
                //     ('Birthday Mail');
                $message->to($data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                // $message->cc($data['sup_to_email']);
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
            $sup_data = array(
                'name'=> $logined_username,
                'sup_name'=> $logined_sup_name,
                'emp_id'=> $logined_empID,
                'to_email'=> $logined_sup_email,
            );
            Mail::send('mail.goal-sup-mail', $sup_data, function($message) use ($sup_data) {
                $message->to($sup_data['to_email'])->subject
                    ('Self Assessment  Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return json_encode($result);
    }

     public function get_goal_myself_listing(){

        $get_goal_list_result = $this->goal->get_goal_myself_list();

        return DataTables::of($get_goal_list_result)
        ->addIndexColumn()
        ->addColumn('status', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }

                return $btn;
            })
        ->addColumn('action', function($row) {
                // echo "<pre>";print_r($row);die;
                if($row->goal_status == "Pending" || $row->goal_status == "Revert"){
                    $btn = '<div class="dropup">
                            <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                            <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                            </div>
                        </div>' ;

                }elseif($row->goal_status == "Approved"){

                    $id = $row->goal_unique_code;
                    $result = $this->goal->check_goals_employee_summary($id);

                    if($result == "Yes"){
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary_show" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-file-text-o"></i></button></a>
                                </div>
                            </div>' ;
                    }else{
                        $btn = '<div class="dropup">
                                <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                    <a href="goal_setting?id='.$row->goal_unique_code.'" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs goals_btn" type="button"><i class="fa fa-eye"></i></button></a>
                                    <a class="dropdown-item ditem-gs" ><button class="btn btn-dark btn-xs goals_btn" id="employee_summary" data-id="'.$row->goal_unique_code.'"type="button"><i class="fa fa-edit"></i></button></a>
                                </div>
                            </div>' ;
                    }

                }

            return $btn;
        })

        ->rawColumns(['action','status'])
        ->make(true);
          }

        public function update_goals_sup_reviewer_tm(Request $request){
            $id = $request->goals_setting_id;
            $json_value = $this->goal->fetchGoalIdDetails($id);
            // echo "<pre>";print_r($json_value);die;
            $datas = json_decode($json_value);
            $json = array();
            $html = '';

            foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            //Reviewer remarks add
            $reviewer_remarks_value = array($request->reviewer_remarks_[$key]);
            $sup_final_op = "reviewer_remarks_".$cell1;
            $row_values->$sup_final_op = $reviewer_remarks_value;

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);
            }

            $goal_process = json_encode($json);

            //Data upload to server
            $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id
            );
            // dd($data);
            $result = $this->goal->update_goals_sup_reviewer_tm($data);
            return response($result);

        }
    public function update_goals_sup_reviewer_tm_save(Request $request){
        $id = $request->goals_setting_id;

        //Data upload to server
        $data = array(
            'reviewer_remarks' => $request->reviewer_remarks,
            // 'increment_recommended' => $request->increment_recommended,
            // 'increment_percentage' => $request->increment_percentage,
            // 'performance_imporvement' => $request->performance_imporvement,
            // 'hike_per_month' => $request->hike_per_month,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->update_goals_sup_reviewer_tm_save($data);

        return response($result);
    }
    public function update_goals_hr_reviewer_tm(Request $request){

        // echo "<pre>";print_r($json_value);die;

        $id = $request->goals_setting_id;
        /*$json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);*/



        //Data upload to server
        $data = array(
            // 'goal_process' => $goal_process,
            'hr_remarks' => $request->hr_remarks,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->update_goals_hr_reviewer_tm($data);

        return response($result);
    }
     public function save_hr_reviewer(Request $request){

        // echo "<pre>";print_r($json_value);die;

        $id = $request->goals_setting_id;
       /* $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

            $hr_remarks_value = array($request->hr_remarks_[$key]);
            $sup_final_hr = "hr_remarks_".$cell1;
            $row_values->$sup_final_hr = $hr_remarks_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);*/



        //Data upload to server
        $data = array(
            // 'goal_process' => $goal_process,
            'hr_remarks' => $request->hr_remarks,
            'goal_unique_code' => $id
        );
        // dd($data);
        $result = $this->goal->save_goals_hr_reviewer_tm($data);

        return response($result);
    }

    public function update_goals_sup_submit_overall(Request $request){
        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();

        $html = '';

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);

         //    //Supervisor remark add
         //    $sup_remark_value = array($request->sup_remark[$key]);
         //    $sup_rem = "sup_remarks_".$cell1;
         //    $row_values->$sup_rem = $sup_remark_value;

         //    //Supervisor rating add
         //    $sup_rating_value = array($request->sup_rating[$key]);
         //    $sup_final_op = "sup_final_output_".$cell1;
         //    $row_values->$sup_final_op = $sup_rating_value;

         //Supervisor remark add
         $sup_name = "sup_remark_".$cell1;
         $sup_name_rem_val = $request->$sup_name;
         $sup_remark_value = $sup_name_rem_val;
         $sup_rem = "sup_remarks_".$cell1;
         $row_values->$sup_rem = $sup_remark_value;

         //Supervisor rating add
         $sup_rat_name = "sup_rating_".$cell1;
         $sup_name_rate_val = $request->$sup_rat_name;
         $sup_rating_value = $sup_name_rate_val;
         $sup_final_op = "sup_final_output_".$cell1;
         $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }

        $goal_process = json_encode($json);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );
         // dd($data);
         $result = $this->goal->update_goals_sup_submit_overall($data);

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

         return response($result);
     }

    // public function goals_sup_submit_status_for_rev(Request $request)
    // {
    //     $id = $request->id;
    //     $head = $this->goal->goals_sup_submit_status_for_rev($id);
    //     return json_encode($head);
    // }


    public function get_goal_login_user_details_sup(request $request)
    {
        $response = $this->goal->get_goal_login_user_details_sup();
        return response($response);
    }
    public function get_goal_login_user_details_rev(request $request)
    {
        $response = $this->goal->get_goal_login_user_details_rev();
        return response($response);
    }

 public function Change_bh_status_only(request $request)
 {
      if($request->user_type==1){
             $data=array('supervisor_status'=>1,
                        'reviewer_status'=>1,
                        'bh_status'=>1);
        }
        elseif($request->user_type==2){
            $data=array(
            'reviewer_status'=>1,
            'bh_status'=>1);
        }
        else{
            $data=array(
                'bh_status'=>1);
        }

        $result=Goals::where('goal_unique_code',$request->id)->update($data);
        if($result){
            $response=array('success'=>1,"message"=>"Data Updated Successfully");
        }
        else{
           $response=array('success'=>1,"message"=>"Problem in Updating Data");
        }
        echo json_encode($response);
 }

    public function pms_employeee_mail(request $request)
    {

        $i=0;
        foreach($request->gid as $data){
            $result=Goals::join('customusers','customusers.empID','=','goals.created_by')
                    ->where('goals.goal_unique_code',$data['checkbox'])->select('email','created_by_name')->first();
            $test[]=$result;


            $Mail['email']=$result->email;
            $Mail['name']=$result->created_by_name;
            $Mail['subject']="Thank you for submitting the details.";

            Mail::send('emails.pms_emp_mail', $Mail, function ($message) use ($Mail) {
            $message->from("hr@hemas.in", 'HEPL - HR Team');
            $message->to($Mail['email'])->subject($Mail['subject']);
            });
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'mail_con' => 1 );
            $result=$this->goal->mail_con_org_hr($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }

 public function update_goals_reviewer_teamleader(Request $request){
    $id = $request->goals_setting_id;
    //Data upload to server
    $data = array(
        // 'goal_process' => $goal_process,
        'goal_unique_code' => $id,
        'reviewer_remarks' => $request->reviewer_remarks,
        // 'increment_recommended' => $request->increment_recommended,
        // 'increment_percentage' => $request->increment_percentage,
        // 'hike_per_month' => $request->hike_per_month,
        // 'performance_imporvement' => $request->performance_imporvement
        );
    // dd($data);
    $result = $this->goal->update_goals_reviewer_teamleader($data);
    return response($result);

}

public function update_goals_sup_submit_overall_for_reviewer(Request $request){
    // dd($request->all());
    $id = $request->goals_setting_id;

    //Data upload to server
    $data = array(
        // 'goal_process' => $goal_process,
        'goal_unique_code' => $id,
        'reviewer_remarks' => $request->reviewer_remarks,
        // 'increment_recommended' => $request->increment_recommended,
        // 'increment_percentage' => $request->increment_percentage,
        // 'hike_per_month' => $request->hike_per_month,
        // 'performance_imporvement' => $request->performance_imporvement
    );
    //  dd($data);
     $result = $this->goal->update_goals_sup_submit_overall_for_reviewer($data);

     //Sending mail to reviewer
     $logined_username = $this->goal->getEmpName($id);
     $logined_empID = $this->goal->getEmpID($id);
     $check = $this->goal->checkDirectBh($logined_empID);

            if(!empty($check)){
                $logined_hr_email = "rajesh.ms@hemas.in";
                if($result){
                    $rev_data = array(
                        'name'=> $logined_username,
                        'emp_id'=> $logined_empID,
                        'to_email'=> $logined_hr_email,
                    );
                    Mail::send('mail.goal-rev-hr-mail', $rev_data, function($message) use ($rev_data) {
                        $message->to($rev_data['to_email'])->subject
                            ('Reviewer Comments Submitted');
                        $message->from("hr@hemas.in", 'HEPL - HR Team');
                    });
                }
            }else{
                $logined_hr_email = "dhivya.r@hemas.in";
                if($result){
                    $rev_data = array(
                        'name'=> $logined_username,
                        'emp_id'=> $logined_empID,
                        'to_email'=> $logined_hr_email,
                    );
                    Mail::send('mail.goal-rev-hr-mail', $rev_data, function($message) use ($rev_data) {
                        $message->to($rev_data['to_email'])->subject
                            ('Reviewer Comments Submitted');
                        $message->from("hr@hemas.in", 'HEPL - HR Team');
                    });
                }
            }

    return response($result);
 }

 public function update_goals_team_member_submit_direct(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->update_goals_team_member_submit_direct($id);
        return json_encode($head);
    }

    public function fetch_goals_hr_details_hr(Request $request)
    {
        $id = $request->id;
        $json = $this->goal->fetchGoalIdDetailsHR($id);
        $reviewer=$this->goal->fetch_reviewer_id_or_not_hr($id);
        $get_sheet_status=Goals::where('goal_unique_code',$id)
                                 ->select('supervisor_status',
                                        'supervisor_tb_status',
                                        'reviewer_status',
                                        'reviewer_tb_status',
                                        'hr_status',
                                        'hr_tb_status')->first();
        $datas = json_decode($json);

        $html = '';
        $all_count=0;

        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            $cell2 = "key_bus_drivers_".$cell1;
            $cell3 = "key_res_areas_".$cell1;
            $cell4 = "measurement_criteria_".$cell1;
            $cell5 = "self_assessment_remark_".$cell1;
            $cell6 = "rating_by_employee_".$cell1;
            $cell7 = "sup_remarks_".$cell1;
            $cell8 = "sup_final_output_".$cell1;
            $sub_row_count = count($row_values->$cell3);


            for($k=0 ; $k < $sub_row_count ; $k++){
                $all_count++;

                $html .= '<tr class="border-bottom-primary">';

                        /*cell 1*/
                        if($k == 0){
                            $html .= '<th style="text-align:center" rowspan='.$sub_row_count.' scope="row">'.$cell1.'</th>';
                        }

                        /*cell 2*/
                        if($k == 0){
                            if($row_values->$cell2[0] != null){
                                $html .= '<td style="text-align:center" rowspan='.$sub_row_count.'>';
                                    $html .= $row_values->$cell2[0];
                                $html .= '</td>';
                            }else{
                                $html .= '<td>';
                                $html .= '</td>';
                            }
                        }

                        /*cell 3*/
                        if($row_values->$cell3[$k] != null){
                            $html .= '<td>';
                            $html .= $row_values->$cell3[$k];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }

                        /*cell 4*/
                        if($row_values->$cell4[$k] != null){
                            $html .= '<td style="text-align: justify;">';
                                $html .= $row_values->$cell4[$k];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }

                        /*cell 5*/
                        if($row_values->$cell5[$k] != null){
                            $html .= '<td style="text-align: justify;">';
                                $html .= $row_values->$cell5[$k];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }

                        /*cell 6*/
                        if($row_values->$cell6[$k] != null){
                            $html .= '<td style="text-align: justify;">';
                                $html .= $row_values->$cell6[$k];
                            $html .= '</td>';
                        }else{
                            $html .= '<td>';
                            $html .= '</td>';
                        }


                        /*cell7*/
                        if($row_values->$cell7 != null){
                            if($row_values->$cell7[$k] != null){
                                // $t_value=1;
                                    $html .= '<td class="sup_remark">';
                                    $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'">'.$row_values->$cell7[$k].'</p>';
                                    $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.$cell1.'[]" style="width:250px; display:none; " class="form-control textarea_one">'.$row_values->$cell7[$k].'</textarea>';

                                    $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';

                                    $html .= '</td>';
                            }
                            else{
                            // $t_value=2;
                            $html .= '<td class="sup_remark">';
                            $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                            $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                            $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                        }
                        }else{
                            // $t_value=2;
                        $html .= '<td class="sup_remark">';
                            $html .='<p style="text-align: justify;" class="sup_remark_p_rev_'.$all_count.' p_tag_one_'.$all_count.'"></p>';
                            $html .='<textarea id="sup_remark'.($all_count).'" name="sup_remark_'.($cell1).'[]" style="width:250px; display:none;" class="form-control textarea_one"></textarea>';
                            $html .='<div class="text-danger sup_remark_'.($all_count).'_error" id="sup_remark_'.($all_count).'_error"></div>';
                            $html .= '</td>';
                        }

                        // dd($html);

                        /*cell 8*/
                            if($row_values->$cell8 != null){
                                if($row_values->$cell8[$k] != null){
                                    // $t_value=1;
                                        $html .= '<td  class="sup_rating">';
                                        $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'">'.$row_values->$cell8[$k].'</p>';
                                        $html .='<select style="width:135px;display:none;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                                    <option value="">...Select...</option>\
                                                    <option value="SEE" '.($row_values->$cell8[$k]=="SEE" ? "selected" : "").'>SEE - Significantly Exceeds Expectations</option>\
                                                    <option value="EE" '.($row_values->$cell8[$k]=="EE" ? "selected" : "").'>EE - Exceeded Expectations</option>\
                                                    <option value="ME" '.($row_values->$cell8[$k]=="ME" ? "selected" : "").'>ME - Met Expectations</option>\
                                                    <option value="PME"  '.($row_values->$cell8[$k]=="PME" ? "selected" : "").'>PME - Partially Met Expectations</option>\
                                                    <option value="ND" '.($row_values->$cell8[$k]=="ND" ? "selected" : "").'>ND - Needs Development</option>\
                                                </select>';
                                            $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                                            $html .= '</td>';
                                    }
                                    else{
                                    // $t_value=2;
                                        $html .= '<td class="sup_rating">';
                                        $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                                        $html .='<select  style="width:135px;display:none;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                                    <option value="">...Select...</option>\
                                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                                    <option value="EE">EE - Exceeded Expectations</option>\
                                                    <option value="ME">ME - Met Expectations</option>\
                                                    <option value="PME">PME - Partially Met Expectations</option>\
                                                    <option value="ND">ND - Needs Development</option>\
                                                </select>';
                                        $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                                        $html .= '</td>';
                        }

                                }else{
                                    // $t_value=2;
                                        $html .= '<td class="sup_rating">';
                                        $html .='<p class="sup_rating_p_'.$all_count.' p_tag_two_'.$all_count.'"></p>';
                                        $html .='<select  style="width:135px;display:none;" class="form-control key_bus_drivers select_one" name="sup_rating_'.($cell1).'[]" id="sup_rating'.$all_count.'">\
                                                    <option value="">...Select...</option>\
                                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                                    <option value="EE">EE - Exceeded Expectations</option>\
                                                    <option value="ME">ME - Met Expectations</option>\
                                                    <option value="PME">PME - Partially Met Expectations</option>\
                                                    <option value="ND">ND - Needs Development</option>\
                                                </select>';
                                        $html .='<div class="text-danger sup_rating_'.($all_count).'_error"></div>';
                                        $html .= '</td>';
                        }
                    $html .= '</tr>';
            }

        }

        $new_data['html']=$html;
        $new_data['result']=$reviewer;
        $new_data['sheet_status']=$get_sheet_status;
        // $new_data['t_value']=$t_value;


        return json_encode($new_data);
    }
    public function get_goals_reviewer_remarks(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->get_goals_reviewer_remarks($id);
        return json_encode($head);
    }

    public function goals_help_desk()
    {
        return view('goals.goals_help_desk');
    }
    public function login_user_eligible(request $request)
    {
        $response = $this->goal->login_user_eligible();
        return response($response);
    }
    public function login_user_sheet_added(request $request)
    {
        $response = $this->goal->login_user_sheet_added();
        return json_encode($response);
    }

    public function update_goals_sup_by_rev(Request $request){
        // dd($request->all());
        $id = $request->goals_setting_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);
        $json = array();
        $html = '';
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            //   echo json_encode();die();

            //Supervisor remark add
            $sup_name = "sup_remark_".$cell1;
            $sup_name_rem_val = $request->$sup_name;
            $sup_remark_value = $sup_name_rem_val;
            $sup_rem = "sup_remarks_".$cell1;
            $row_values->$sup_rem = $sup_remark_value;

            //Supervisor rating add
            $sup_rat_name = "sup_rating_".$cell1;
            $sup_name_rate_val = $request->$sup_rat_name;
            $sup_rating_value = $sup_name_rate_val;
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;

            $json_format = json_encode($row_values);
            array_push($json, $json_format);

        }
        $goal_process = json_encode($json);
        // dd($json);

        // if(!empty($request->supervisor_movement)){

        //     // $movement_json = array();

        //     //Supervisor remark add
        //     $supervisor_movement = $request->supervisor_movement;
        //     $with_effect_date = $request->with_effect_date;
        //     $team_member_list = $request->team_member_list;
        //     $supervisor_name_list = $request->supervisor_name_list;
        //     $movement_remark = $request->movement_remark;
        //     $mov_designation = $request->mov_designation;
        //     $mov_promotion = $request->mov_promotion;

        //     $movement_json = json_encode([
        //         "supervisor_movement" => $request->input('supervisor_movement'),
        //         "with_effect_date" => $request->input('with_effect_date'),
        //         "team_member_list" => $request->input('team_member_list'),
        //         "supervisor_name_list" => $request->input('supervisor_name_list'),
        //         "movement_remark" => $request->input('movement_remark'),
        //         "mov_designation" => $request->input('mov_designation'),
        //         "mov_promotion" => $request->input('mov_promotion'),
        //     ]);
        //     // dd($movement_json);

        // }else{
        //     $movement_json = null;
        // }

        // $movement_json_data = array(
        //     'movement_json' => $movement_json,
        //     'goal_unique_code' => $id,
        // );

        // $result = $this->goal->update_goals_sup_movement($movement_json_data);

        //Data upload to server
        $data = array(
            'goal_process' => $goal_process,
            'goal_unique_code' => $id,
            'supervisor_consolidated_rate' => $request->employee_consolidated_rate,
            'supervisor_pip_exit' => $request->supervisor_pip_exit,
        );

        $result = $this->goal->update_goals_sup_by_rev($data);

        return response($result);
    }

    public function get_goals_reviewer_sup_pip_exit_data(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->get_goals_reviewer_sup_pip_exit_data($id);
        return json_encode($head);
    }

    public function get_all_datas_goals_for_reviewer(Request $request)
    {
        $id = $request->id;
        $head = $this->goal->get_all_datas_goals_for_reviewer($id);
        return json_encode($head);
    }
    public function reporting_man_list_only_tm(Request $request)
    {
        $supervisor_list_have_tm = $this->goal->fetchSupervisorListHaveTm();
        return json_encode($supervisor_list_have_tm);
    }

    public function hike_hide_and_show_in_reviewer(Request $request)
    {
        $id = $request->id;
        // echo '<pre>';print_r($id);die();

        $response = DB::table('goals as g')
                        ->distinct()
                        ->select('cs.payroll_status')
                        ->join('customusers as cs', 'g.created_by', '=', 'cs.empID')
                        ->where('g.goal_unique_code', $id)
                        ->get();
        // echo '<pre>';print_r($response);die();
        return $response;

    }
    public function hike_hide_and_show_in_reviewer_hr(Request $request)
    {
        $id = $request->id;
        // echo '<pre>';print_r($id);die();
        $response = DB::table('goals as g')
                        ->distinct()
                        ->select('cs.payroll_status')
                        ->join('customusers as cs', 'g.created_by', '=', 'cs.empID')
                        ->where('g.goal_unique_code', $id)
                        ->get();
        // echo '<pre>';print_r($response);die();
        return $response;

    }

    public function gen_excel(request $request)
    {
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1','SupervisorNo');
        $sheet->setCellValue('K1','Supervisor Name');
        $sheet->setCellValue('L1','ReviewerNO');
        $sheet->setCellValue('M1','Reviewer Name');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.goal_process')->first();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $rowcount++;
        }
        $sheet->setCellValue('J'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('K'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('L'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->reviewer_name);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }

    public function sup_goal_report_reviewer(request $request)
    {
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Employee Consolidated Rate');
        $sheet->setCellValue('M1', 'Rep.Manager Consolidated Rating');
        $sheet->setCellValue('N1', 'Reporting Manager Recommendation');
        $sheet->setCellValue('O1','Reporting Manager ID');
        $sheet->setCellValue('P1','Reporting Manager Name');
        $sheet->setCellValue('Q1','Reviewer ID');
        $sheet->setCellValue('R1','Reviewer Name');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
       if(!empty($row_values->$cell7)){

            if(!empty($row_values->$cell7[$k])){
                $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
            }else{
                $sheet->setCellValue('J'.$rowcount, "");
            }

        }else{
            $sheet->setCellValue('J'.$rowcount, "");
        }

        if(!empty($row_values->$cell8)){

            if(!empty($row_values->$cell8[$k])){
            $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
            }else{
                $sheet->setCellValue('K'.$rowcount, "");
            }

        }else{
            $sheet->setCellValue('K'.$rowcount, "");
        }
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->employee_consolidated_rate);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('N'.$usercount, $get_emp_info->supervisor_pip_exit);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('P'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('R'.$usercount, $get_emp_info->reviewer_name);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }

    public function rev_goal_report_reviewer(request $request)
    {
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Employee Consolidated Rate');
        $sheet->setCellValue('M1', 'Reviewer Consolidated Rate');
        $sheet->setCellValue('N1', 'Reviewer Remarks');
        $sheet->setCellValue('O1', 'Increment recommended?');
        $sheet->setCellValue('P1', 'Percentage % / Hike Per Month');
        $sheet->setCellValue('Q1', 'Performance Imporvement');
        $sheet->setCellValue('R1','SupervisorNo');
        $sheet->setCellValue('S1','Supervisor Name');
        $sheet->setCellValue('T1','ReviewerNO');
        $sheet->setCellValue('U1','Reviewer Name');
        $sheet->setCellValue('V1','Payroll Status');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        // echo '<pre>';print_r($get_emp_info);die();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->employee_consolidated_rate);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('N'.$usercount, $get_emp_info->reviewer_remarks);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->increment_recommended);
        if($get_emp_info->payroll_status =="HEPL")
        {
            $sheet->setCellValue('P'.$usercount, $get_emp_info->increment_percentage);
        }elseif($get_emp_info->payroll_status =="NAPS")
        {
            $sheet->setCellValue('P'.$usercount, $get_emp_info->hike_per_month);
        }
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->performance_imporvement);
        $sheet->setCellValue('R'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('S'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('T'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('U'.$usercount, $get_emp_info->reviewer_name);
        $sheet->setCellValue('V'.$usercount, $get_emp_info->payroll_status);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }

    public function hr_goal_report_reviewer(request $request){
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Reviewer Remarks');
        $sheet->setCellValue('M1', 'Increment recommended?');
        $sheet->setCellValue('N1', 'Percentage % / Hike Per Month');
        $sheet->setCellValue('O1', 'Performance Imporvement');
        $sheet->setCellValue('P1','SupervisorNo');
        $sheet->setCellValue('Q1','Supervisor Name');
        $sheet->setCellValue('R1','ReviewerNO');
        $sheet->setCellValue('S1','Reviewer Name');
        $sheet->setCellValue('T1','Payroll Status');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        // echo '<pre>';print_r($get_emp_info);die();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->reviewer_remarks);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->increment_recommended);
        if($get_emp_info->payroll_status =="HEPL")
        {
            $sheet->setCellValue('N'.$usercount, $get_emp_info->increment_percentage);
        }elseif($get_emp_info->payroll_status =="NAPS")
        {
            $sheet->setCellValue('N'.$usercount, $get_emp_info->hike_per_month);
        }
        $sheet->setCellValue('O'.$usercount, $get_emp_info->performance_imporvement);
        $sheet->setCellValue('P'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('R'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('S'.$usercount, $get_emp_info->reviewer_name);
        $sheet->setCellValue('T'.$usercount, $get_emp_info->payroll_status);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }
    public function rev_goal_report_reviewer_hr(request $request)
    {
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Employee Consolidated Rate');
        $sheet->setCellValue('M1', 'Reviewer Consolidated Rate');
        $sheet->setCellValue('N1', 'Reviewer Remarks');
        $sheet->setCellValue('O1', 'Increment recommended?');
        $sheet->setCellValue('P1', 'Percentage % / Hike Per Month');
        $sheet->setCellValue('Q1', 'Performance Imporvement');
        $sheet->setCellValue('R1','SupervisorNo');
        $sheet->setCellValue('S1','Supervisor Name');
        $sheet->setCellValue('T1','ReviewerNO');
        $sheet->setCellValue('U1','Reviewer Name');
        $sheet->setCellValue('V1','Payroll Status');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        // echo '<pre>';print_r($get_emp_info);die();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->employee_consolidated_rate);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('N'.$usercount, $get_emp_info->reviewer_remarks);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->increment_recommended);
        if($get_emp_info->payroll_status =="HEPL")
        {
            $sheet->setCellValue('P'.$usercount, $get_emp_info->increment_percentage);
        }elseif($get_emp_info->payroll_status =="NAPS")
        {
            $sheet->setCellValue('P'.$usercount, $get_emp_info->hike_per_month);
        }
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->performance_imporvement);
        $sheet->setCellValue('R'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('S'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('T'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('U'.$usercount, $get_emp_info->reviewer_name);
        $sheet->setCellValue('V'.$usercount, $get_emp_info->payroll_status);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }
    public function sup_goal_report_reviewer_hr(request $request){

            // echo "<pre>";print_r($request->all());die;

        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Rep.Manager Consolidated Rating');
        $sheet->setCellValue('M1', 'Reporting Manager Recommendation');
        $sheet->setCellValue('N1','SupervisorNo');
        $sheet->setCellValue('O1','Supervisor Name');
        $sheet->setCellValue('P1','ReviewerNO');
        $sheet->setCellValue('Q1','Reviewer Name');
        $rowcount=2;
        $usercount=2;
        $first_count=1;


        foreach($request->id as $js_data){
            $usercount=$rowcount;
            $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
            ->where('goal_unique_code',$js_data['goal_id'])
            ->select('customusers.*','goals.*')->first();
            $datas = json_decode($get_emp_info->goal_process);
            $sheet->setCellValue('A'.$rowcount, $first_count);
            $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
            $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
            foreach($datas as $key=>$info){
                $cell1 = $key+1;
                $row_values = json_decode($info);

                $cell1 = $key+1;
                $cell2 = "key_bus_drivers_".$cell1;
                $cell3 = "key_res_areas_".$cell1;
                $cell4 = "measurement_criteria_".$cell1;
                $cell5 = "self_assessment_remark_".$cell1;
                $cell6 = "rating_by_employee_".$cell1;
                $cell7 = "sup_remarks_".$cell1;
                $cell8 = "sup_final_output_".$cell1;
                $sub_row_count = count(($row_values->$cell3));
                // echo json_encode($sub_row_count);die();


                // echo "<pre>";print_r($cell7);die;

                $sheet->setCellValue('D'.$rowcount, $cell1);
                $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
            for($k=0 ; $k < $sub_row_count ; $k++){
                $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
                $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
                $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
                $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
                if(!empty($row_values->$cell7)){
                    $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
                }else{
                    $sheet->setCellValue('J'.$rowcount, "");
                }

                if(!empty($row_values->$cell7)){
                    $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
                }else{
                    $sheet->setCellValue('K'.$rowcount, "");
                }
                $rowcount++;
            }
            $sheet->setCellValue('L'.$usercount, $get_emp_info->supervisor_consolidated_rate);
            $sheet->setCellValue('M'.$usercount, $get_emp_info->supervisor_pip_exit);
            $sheet->setCellValue('N'.$usercount, $get_emp_info->sup_emp_code);
            $sheet->setCellValue('O'.$usercount, $get_emp_info->sup_name);
            $sheet->setCellValue('P'.$usercount, $get_emp_info->reviewer_emp_code);
            $sheet->setCellValue('Q'.$usercount, $get_emp_info->reviewer_name);

            }
            $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }
    public function Hr_report_reviewer_excel(request $request){

            // echo json_encode($request->all());die();



        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Reporting Manager Recommendation');
        $sheet->setCellValue('M1','SupervisorNo');
        $sheet->setCellValue('N1','Supervisor Name');
        $sheet->setCellValue('O1','ReviewerNO');
        $sheet->setCellValue('P1','Reviewer Name');
        $sheet->setCellValue('Q1','Employee Consolidated Rate');
        $sheet->setCellValue('R1','Rep.Manager Consolidated Rating');
        $sheet->setCellValue('S1','Increment Recommended');
        $sheet->setCellValue('T1','Percentage % / Hike Per Month');
        $sheet->setCellValue('U1','Performance Imporvement');
        $sheet->setCellValue('V1','HR Remarks');
        $rowcount=2;
        $usercount=2;
        $first_count=1;

        // echo "<pre>";print_r($request->id);die;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        if(!empty($row_values->$cell7)){
            $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        }else{
            $sheet->setCellValue('J'.$rowcount, "");
        }

        if(!empty($row_values->$cell7)){
            $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        }else{
            $sheet->setCellValue('K'.$rowcount, "");
        }
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->supervisor_pip_exit);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('N'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('P'.$usercount, $get_emp_info->reviewer_name);
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->employee_consolidated_rate);
        $sheet->setCellValue('R'.$usercount, $get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('S'.$usercount, $get_emp_info->increment_recommended);
        if($get_emp_info->payroll_status =="HEPL"){
            $sheet->setCellValue('T'.$usercount, $get_emp_info->increment_percentage);
        }elseif($get_emp_info->payroll_status =="NAPS"){
            $sheet->setCellValue('T'.$usercount, $get_emp_info->hike_per_month);
        }
        $sheet->setCellValue('U'.$usercount, $get_emp_info->performance_imporvement);
        $sheet->setCellValue('V'.$usercount, $get_emp_info->hr_remarks);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }
    public function org_report_reviewer_excel(request $request){

            // echo json_encode($request->all());die();



        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Rep.Manager Consolidated Rating');
        $sheet->setCellValue('M1', 'Reporting Manager Recommendation');
        $sheet->setCellValue('N1','SupervisorNo');
        $sheet->setCellValue('O1','Supervisor Name');
        $sheet->setCellValue('P1','ReviewerNO');
        $sheet->setCellValue('Q1','Reviewer Name');
        $rowcount=2;
        $usercount=2;
        $first_count=1;


        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        if(!empty($row_values->$cell7)){
            $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        }else{
            $sheet->setCellValue('J'.$rowcount, "");
        }
        if(!empty($row_values->$cell7)){
            $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        }else{
            $sheet->setCellValue('K'.$rowcount, "");
        }
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->supervisor_pip_exit);
        $sheet->setCellValue('N'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('P'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('Q'.$usercount, $get_emp_info->reviewer_name);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }
     public function update_bh_goals(Request $request)
    {
        //    echo json_encode($request->all());die();
        $id = $request->goals_setting_id;
        $reviewer_id=$request->reviewer_hidden_id;
        $json_value = $this->goal->fetchGoalIdDetails($id);
        $datas = json_decode($json_value);

        $json = array();
        $html = '';

        $final_data = array(
            'goal_status'             =>$request->Bh_sheet_approval,
            'bh_tb_status'            =>'1',
            'reviewer_remarks'        =>$request->reviewer_remarks,
            'increment_recommended'   =>$request->increment_recommended,
            'increment_percentage'    =>$request->increment_percentage,
            'performance_imporvement' =>$request->performance_imporvement,
            'supervisor_pip_exit'     =>$request->supervisor_pip_exit,
            'hike_per_month'          =>$request->increment_month_wise
        );
        if($request->reviewer_hidden_id ==1){
            $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
              foreach($datas as $key=>$data){
                  $cell1 = $key+1;
                  $row_values = json_decode($data);
                  //Business Head add
                  $bh_sign_off_value = "bh_sign_off_".$cell1;
                  $bh_remarks_rem_val = $request->$bh_sign_off_value;
                  $row_values->$bh_sign_off_value = $bh_remarks_rem_val;


                  //supervisor remarks
                  $sup_remarks='sup_remarks_'.$cell1;
                  $sup_name_rem_val = $request->$bh_sign_off_value;
                  $row_values->$sup_remarks = $sup_name_rem_val;

                  //reviewer remarks
                  $reviewer_remarks='reviewer_remarks_'.$cell1;
                  $rev_name_rem_val = $request->$bh_sign_off_value;
                  $row_values->$reviewer_remarks = $bh_remarks_rem_val;

                  //Supervisor rating add
                  $sup_rat_name = "sup_final_output_".$cell1;
                  $sup_name_rate_val = $request->$sup_rat_name;
                  $sup_rating_value = $sup_name_rate_val;
                  $sup_final_op = "sup_final_output_".$cell1;
                  $row_values->$sup_final_op = $sup_rating_value;
                  $json_format = json_encode($row_values);
                  array_push($json, $json_format);

              }
          }
          if($request->reviewer_hidden_id ==2){
            $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;

              foreach($datas as $key=>$data){
                  $cell1 = $key+1;
                  $row_values = json_decode($data);
                  //Business Head add
                  $bh_sign_off_value = "bh_sign_off_".$cell1;
                  $bh_remarks_rem_val = $request->$bh_sign_off_value;
                  $row_values->$bh_sign_off_value = $bh_remarks_rem_val;


                  //supervisor remarks
                  $sup_remarks='sup_remarks_'.$cell1;
                  $sup_name_rem_val = $request->$sup_remarks;
                  $row_values->$sup_remarks = $sup_name_rem_val;


                  //Supervisor rating add
                  $sup_rat_name = "sup_final_output_".$cell1;
                  $sup_name_rate_val = $request->$sup_rat_name;
                  $sup_rating_value = $sup_name_rate_val;
                  $sup_final_op = "sup_final_output_".$cell1;
                  $row_values->$sup_final_op = $sup_rating_value;
                  $json_format = json_encode($row_values);
                  array_push($json, $json_format);

              }
          }
          if($request->reviewer_hidden_id ==0)
          {
            $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
            foreach($datas as $key=>$data){
                $cell1 = $key+1;
                $row_values = json_decode($data);
                //Business Head add
                $bh_sign_off_value = "bh_sign_off_".$cell1;
                $bh_remarks_rem_val = $request->$bh_sign_off_value;
                $row_values->$bh_sign_off_value = $bh_remarks_rem_val;
                //supervisor remarks
                $sup_remarks='sup_remarks_'.$cell1;
                $sup_name_rem_val = $request->$sup_remarks;
                $row_values->$sup_remarks = $sup_name_rem_val;
                //Supervisor rating add
                $sup_rat_name = "sup_final_output_".$cell1;
                $sup_name_rate_val = $request->$sup_rat_name;
                $sup_rating_value = $sup_name_rate_val;
                $sup_final_op = "sup_final_output_".$cell1;
                $row_values->$sup_final_op = $sup_rating_value;
                $json_format = json_encode($row_values);
                array_push($json, $json_format);
            }
          }
        $goal_process = json_encode($json);
        $final_data['goal_process']=$goal_process;
        $result=Goals::where('goal_unique_code',$id)->update($final_data);
        if($result){
            $response=array('success'=>1,"message"=>"Data Updated Successfully");
        }
        else{
            $response=array('success'=>1,"message"=>"Problem in Updating Data");
        }

        //  return response($response);
        echo json_encode($response);die();
    }
    public function Change_Bh_status(request $request)
    {
    $id = $request->goals_setting_id;
    $reviewer_id=$request->reviewer_hidden_id;
    $json_value = $this->goal->fetchGoalIdDetails($id);
    $datas = json_decode($json_value);
    $json = array();
    $html = '';
    $final_data = array(
        'goal_status'             =>$request->Bh_sheet_approval,
        'bh_tb_status'            =>'1',
        'reviewer_remarks'        => $request->reviewer_remarks,
        'increment_recommended'   => $request->increment_recommended,
        'increment_percentage'    => $request->increment_percentage,
        'performance_imporvement' => $request->performance_imporvement,
        'supervisor_pip_exit'     =>$request->supervisor_pip_exit,
        'hike_per_month'          =>$request->increment_month_wise
    );
    if($request->reviewer_hidden_id ==1){
        //sup
        $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
        $final_data['supervisor_status']='1';
        $final_data['reviewer_status']='1';
        $final_data['bh_status']='1';
        $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
          foreach($datas as $key=>$data){
              $cell1 = $key+1;
              $row_values = json_decode($data);
              //Business Head add
              $bh_sign_off_value = "bh_sign_off_".$cell1;
              $bh_remarks_rem_val = $request->$bh_sign_off_value;
              $row_values->$bh_sign_off_value = $bh_remarks_rem_val;


              //supervisor remarks
              $sup_remarks='sup_remarks_'.$cell1;
              $sup_name_rem_val = $request->$bh_sign_off_value;
              $row_values->$sup_remarks = $sup_name_rem_val;

              //reviewer remarks
              $reviewer_remarks='reviewer_remarks_'.$cell1;
              $rev_name_rem_val = $request->$bh_sign_off_value;
              $row_values->$reviewer_remarks = $bh_remarks_rem_val;

              //Supervisor rating add
              $sup_rat_name = "sup_final_output_".$cell1;
              $sup_name_rate_val = $request->$sup_rat_name;
              $sup_rating_value = $sup_name_rate_val;
              $sup_final_op = "sup_final_output_".$cell1;
              $row_values->$sup_final_op = $sup_rating_value;
              $json_format = json_encode($row_values);
              array_push($json, $json_format);

          }
      }
      if($request->reviewer_hidden_id ==2){
        if($request->Bh_sheet_approval=='Reverted'){
                   $final_data['supervisor_status']='0';
                   $final_data['supervisor_tb_status']='0';
                   $final_data['reviewer_status']='0';
                   $final_data['reviewer_tb_status']='0';
                   $final_data['bh_tb_status']='0';
              }
              else{
                 $final_data['reviewer_status']='1';
                 $final_data['bh_status']='1';
              }
        $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
        $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
          foreach($datas as $key=>$data){
              $cell1 = $key+1;
              $row_values = json_decode($data);
              //Business Head add
              $bh_sign_off_value = "bh_sign_off_".$cell1;
              $bh_remarks_rem_val = $request->$bh_sign_off_value;
              $row_values->$bh_sign_off_value = $bh_remarks_rem_val;


              //supervisor remarks
              $sup_remarks='sup_remarks_'.$cell1;
              $sup_name_rem_val = $request->$sup_remarks;
              $row_values->$sup_remarks = $sup_name_rem_val;


              //Supervisor rating add
              $sup_rat_name = "sup_final_output_".$cell1;
              $sup_name_rate_val = $request->$sup_rat_name;
              $sup_rating_value = $sup_name_rate_val;
              $sup_final_op = "sup_final_output_".$cell1;
              $row_values->$sup_final_op = $sup_rating_value;
              $json_format = json_encode($row_values);
              array_push($json, $json_format);

          }
      }
      if($request->reviewer_hidden_id ==0)
      {
        if($request->Bh_sheet_approval=='Reverted'){
                   $final_data['supervisor_status']='0';
                   $final_data['supervisor_tb_status']='0';
                   $final_data['reviewer_status']='0';
                   $final_data['reviewer_tb_status']='0';
                   $final_data['bh_tb_status']='0';
                   $final_data['hr_status']='0';
                   $final_data['hr_tb_status']='0';

              }
              else{
              $final_data['bh_status']='1';
              }
        $final_data['supervisor_consolidated_rate']=$request->supervisor_consolidated_rate;
        foreach($datas as $key=>$data){
            $cell1 = $key+1;
            $row_values = json_decode($data);
            //Business Head add
            $bh_sign_off_value = "bh_sign_off_".$cell1;
            $bh_remarks_rem_val = $request->$bh_sign_off_value;
            $row_values->$bh_sign_off_value = $bh_remarks_rem_val;
            //supervisor remarks
            $sup_remarks='sup_remarks_'.$cell1;
            $sup_name_rem_val = $request->$sup_remarks;
            $row_values->$sup_remarks = $sup_name_rem_val;
            //Supervisor rating add
            $sup_rat_name = "sup_final_output_".$cell1;
            $sup_name_rate_val = $request->$sup_rat_name;
            $sup_rating_value = $sup_name_rate_val;
            $sup_final_op = "sup_final_output_".$cell1;
            $row_values->$sup_final_op = $sup_rating_value;
            $json_format = json_encode($row_values);
            array_push($json, $json_format);
        }
      }

        $goal_process = json_encode($json);
        $final_data['goal_process']=$goal_process;


        $result=Goals::where('goal_unique_code',$id)->update($final_data);
        // echo json_encode($result);die();

        if($result){
            $response=array('success'=>1,"message"=>"Data Updated Successfully");
           // Sending mail to reviewer
            // $logined_hr_email = "rajesh.ms@hemas.in";
            // $logined_username = $this->goal->getEmpName($id);
            // $logined_empID = $this->goal->getEmpID($id);

            // if($response){
            //     $rev_data = array(
            //         'name'=> $logined_username,
            //         'emp_id'=> $logined_empID,
            //         'to_email'=> $logined_hr_email,
            //     );
            //     Mail::send('mail.goal-bh-hr-mail', $rev_data, function($message) use ($rev_data) {
            //         $message->to($rev_data['to_email'])->subject
            //             ('BH Self Assessment Submitted');
            //         $message->from("hr@hemas.in", 'HEPL - HR Team');
            //     });
            // }
        }
        else{
        $response=array('success'=>1,"message"=>"Problem in Updating Data");
        }



    echo json_encode($response);
 }
     public function get_reviewer_filter_info(request $request)
    {
        $supervisor=$request->supervisor;
        $reviewer=$request->employee;
        $payroll_status=$request->payroll_status;
        $response = $this->goal->get_filtered_reviewer_data($supervisor,
                                 $reviewer,$payroll_status);
        echo json_encode($response);

    }
      public function Business_Head_Report(request $request)
    {
         $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1','SupervisorNo');
        $sheet->setCellValue('K1','Supervisor Name');
        $sheet->setCellValue('L1','ReviewerNO');
        $sheet->setCellValue('M1','Reviewer Name');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.goal_process')->first();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $rowcount++;
        }
        $sheet->setCellValue('J'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('K'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('L'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('M'.$usercount, $get_emp_info->reviewer_name);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }

 public function Business_Head_emp_excel(request $request)
    {
        $final_data="";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','S.NO');
        $sheet->setCellValue('B1','EmpNo');
        $sheet->setCellValue('C1','UserName');
        $sheet->setCellValue('D1', 'NO');
        $sheet->setCellValue('E1', 'KBD');
        $sheet->setCellValue('F1', 'KRA');
        $sheet->setCellValue('G1', 'Measurement Criteria (Quantified Measures)');
        $sheet->setCellValue('H1', 'Self Assessment (Qualitative Remarks) by Employee');
        $sheet->setCellValue('I1', 'Self Rating');
        $sheet->setCellValue('J1', 'Rep.Manager Remarks');
        $sheet->setCellValue('K1', 'Rep.Manager Rating');
        $sheet->setCellValue('L1', 'Employee Consolidated Rating');
        $sheet->setCellValue('M1', 'R.Manager Consolidated Rating');
        $sheet->setCellValue('N1', 'R.Manager Movement Process');
        $sheet->setCellValue('O1', 'Reviewer Remarks');
        $sheet->setCellValue('P1', 'Increment recommended?');
        $sheet->setCellValue('Q1', 'Percentage % / Hike Per Month');
        $sheet->setCellValue('R1', 'Performance Imporvement');
        $sheet->setCellValue('S1', 'HR Remarks');
        $sheet->setCellValue('T1', 'Business Head Remarks');
        $sheet->setCellValue('U1','SupervisorNo');
        $sheet->setCellValue('V1','Supervisor Name');
        $sheet->setCellValue('W1','ReviewerNO');
        $sheet->setCellValue('X1','Reviewer Name');
        $sheet->setCellValue('Y1','Payroll Status');
        $rowcount=2;
        $usercount=2;
        $first_count=1;
        foreach($request->id as $js_data){
        $usercount=$rowcount;
        $get_emp_info=CustomUser::join('goals','customusers.empID','=','goals.created_by')
        ->where('goal_unique_code',$js_data['goal_id'])
        ->select('customusers.*','goals.*')->first();
        // echo '<pre>';print_r($get_emp_info);die();
        $datas = json_decode($get_emp_info->goal_process);

        $sheet->setCellValue('A'.$rowcount, $first_count);
        $sheet->setCellValue('B'.$rowcount, $get_emp_info->empID);
        $sheet->setCellValue('C'.$rowcount, $get_emp_info->username);
        foreach($datas as $key=>$info){
        $cell1 = $key+1;
        $row_values = json_decode($info);

        $cell1 = $key+1;
        $cell2 = "key_bus_drivers_".$cell1;
        $cell3 = "key_res_areas_".$cell1;
        $cell4 = "measurement_criteria_".$cell1;
        $cell5 = "self_assessment_remark_".$cell1;
        $cell6 = "rating_by_employee_".$cell1;
        $cell7 = "sup_remarks_".$cell1;
        $cell8 = "sup_final_output_".$cell1;
        $cell9 = "bh_sign_off_".$cell1;
        $sub_row_count = count(($row_values->$cell3));
        // echo json_encode($sub_row_count);die();

        $sheet->setCellValue('D'.$rowcount, $cell1);
        $sheet->setCellValue('E'.$rowcount, $row_values->$cell2[0]);
        for($k=0 ; $k < $sub_row_count ; $k++){
        $sheet->setCellValue('F'.$rowcount,$row_values->$cell3[$k]);
        $sheet->setCellValue('G'.$rowcount,$row_values->$cell4[$k]);
        $sheet->setCellValue('H'.$rowcount, $row_values->$cell5[$k]);
        $sheet->setCellValue('I'.$rowcount, $row_values->$cell6[$k]);
        $sheet->setCellValue('J'.$rowcount, $row_values->$cell7[$k]);
        $sheet->setCellValue('K'.$rowcount, $row_values->$cell8[$k]);
        if(!empty($row_values->$cell9)){

            if(!empty($row_values->$cell9[$k])){
                $sheet->setCellValue('T'.$rowcount, $row_values->$cell9[$k]);
            }else{
               $sheet->setCellValue('T'.$rowcount, "");
            }

        }else{
            $sheet->setCellValue('T'.$rowcount, "");
        }
        $rowcount++;
        }
        $sheet->setCellValue('L'.$usercount, $get_emp_info->employee_consolidated_rate);
        $sheet->setCellValue('M'.$usercount,$get_emp_info->supervisor_consolidated_rate);
        $sheet->setCellValue('N'.$usercount,$get_emp_info->sup_movement_process);
        $sheet->setCellValue('O'.$usercount, $get_emp_info->reviewer_remarks);
        $sheet->setCellValue('P'.$usercount, $get_emp_info->increment_recommended);
         if($get_emp_info->payroll_status =="HEPL")
        {
            $sheet->setCellValue('Q'.$usercount, $get_emp_info->increment_percentage);
        }elseif($get_emp_info->payroll_status =="NAPS")
        {
            $sheet->setCellValue(''.$usercount, $get_emp_info->hike_per_month);
        }
        $sheet->setCellValue('R'.$usercount, $get_emp_info->performance_imporvement);
        $sheet->setCellValue('S'.$usercount, $get_emp_info->hr_remarks);
        $sheet->setCellValue('U'.$usercount, $get_emp_info->sup_emp_code);
        $sheet->setCellValue('V'.$usercount, $get_emp_info->sup_name);
        $sheet->setCellValue('W'.$usercount, $get_emp_info->reviewer_emp_code);
        $sheet->setCellValue('X'.$usercount, $get_emp_info->reviewer_name);
        $sheet->setCellValue('Y'.$usercount, $get_emp_info->payroll_status);

        }
        $first_count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response = array(
        'name' => "PmsReport", //no extention needed
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData) //mime type of used format
        );
        return response()->json($response);

    }

    //Chart
    public function pms_report()
    {
        $names = DB::table("goals")->select('goal_name')
                        ->groupByRaw('goal_name')
                        ->get();

        $dept_lists = DB::table("customusers")->select('department')
                        ->groupByRaw('department')
                        ->get();

        $data = [
                    "names" => $names,
                    "dept_lists" => $dept_lists,
                ];

        return view('goals.pms_report')->with($data);
    }
    public function bh_rating_chart(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $man = $request->input('man');
        $grade = $request->input('grade');
        $tl = $request->input('tl');

        $data = array(
            "year" => $year,
            "man" => $man,
            "grade" => $grade,
            "tl" => $tl,
        );

        //Overall Suu consolidated rate count
        $dataBH['ec'] = $this->goal->fetch_bh_ec_count($data);
        $dataBH['se'] = $this->goal->fetch_bh_se_count($data);
        $dataBH['c'] = $this->goal->fetch_bh_c_count($data);
        $dataBH['pc'] = $this->goal->fetch_bh_pc_count($data);

        $bh_pie_chart = "[";
        $bh_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $bh_pie_chart .= "['EC (". $dataBH['ec'] .")' , " . $dataBH['ec'] . "],";
        $bh_pie_chart .= "['SE (". $dataBH['se'] .")', " . $dataBH['se'] . "],";
        $bh_pie_chart .= "['C  (". $dataBH['c'] .")', " . $dataBH['c'] . "],";
        $bh_pie_chart .= "['PC (". $dataBH['pc'] .")', " . $dataBH['pc'] . "]";
        $bh_pie_chart .= "]";
        // dd($bh_pie_chart);
        echo json_encode($bh_pie_chart);

    }
    public function bh_rating_chart_js(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $man = $request->input('man');
        $grade = $request->input('grade');
        $tl = $request->input('tl');

        $data = array(
            "year" => $year,
            "man" => $man,
            "grade" => $grade,
            "tl" => $tl,
        );

        //Overall Suu consolidated rate count
        $dataBH['ec'] = $this->goal->fetch_bh_ec_count($data);
        $dataBH['se'] = $this->goal->fetch_bh_se_count($data);
        $dataBH['c'] = $this->goal->fetch_bh_c_count($data);
        $dataBH['pc'] = $this->goal->fetch_bh_pc_count($data);

        $bh_pie_chart = "[";
        $bh_pie_chart .= "0,";
        $bh_pie_chart .= $dataBH['pc'] . ",";
        $bh_pie_chart .= $dataBH['c'] . ",";
        $bh_pie_chart .= $dataBH['se'] . ",";
        $bh_pie_chart .= $dataBH['ec'];
        $bh_pie_chart .= "]";

        $lb = "EC = ".$dataBH['ec'].", ";
        $lb .= "SE = ".$dataBH['se'].", ";
        $lb .= "C = ".$dataBH['c'].", ";
        $lb .= "PC = ".$dataBH['pc'];

        $data = [
            "bh_pie_chart" => $bh_pie_chart,
            "label" => $lb,
        ];

        return response($data);

    }
    public function bh_line_dept_rating_chart(Request $request)
    {
        // Filter
        $year = $request->input("year");
        $dept = $request->input("pms_dept");

        if($dept == ""){
            //No filter

            $dept_lists = DB::table("customusers")->select('department')
                        ->groupByRaw('department')
                        ->get();

            $barchart = "[['Department', 'SEE','EE', 'ME', 'PME' , 'ND'],";
            $count = count($dept_lists);
            $i = 0;
            $j = 0;
            foreach($dept_lists as $key => $dept_list){

                if(!empty($dept_list->department)){

                    //SEE Count
                    $see_count = DB::table('customusers as cs');
                    $see_count = $see_count->distinct();
                    $see_count = $see_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    // $see_count = $see_count->where('cs.department', "IT");
                    $see_count = $see_count->where('cs.department', $dept_list->department);
                    $see_count = $see_count->where('g.supervisor_consolidated_rate', 'SEE');
                    if($year != ''){
                        $see_count = $see_count->where('g.goal_name', $year);
                    }
                    $see_count = $see_count->count();

                    //EE Count
                    $ee_count = DB::table('customusers as cs');
                    $ee_count = $ee_count->distinct();
                    $ee_count = $ee_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $ee_count = $ee_count->where('cs.department', $dept_list->department);
                    $ee_count = $ee_count->where('g.supervisor_consolidated_rate', 'EE');
                    if($year != ''){
                        $ee_count = $ee_count->where('g.goal_name', $year);
                    }
                    $ee_count = $ee_count->count();

                    //ME Count
                    $me_count = DB::table('customusers as cs');
                    $me_count = $me_count->distinct();
                    $me_count = $me_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $me_count = $me_count->where('cs.department', $dept_list->department);
                    $me_count = $me_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $me_count = $me_count->where('g.goal_name', $year);
                    }
                    $me_count = $me_count->count();

                    //PME Count
                    $pme_count = DB::table('customusers as cs');
                    $pme_count = $pme_count->distinct();
                    $pme_count = $pme_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $pme_count = $pme_count->where('cs.department', $dept_list->department);
                    $pme_count = $pme_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $pme_count = $pme_count->where('g.goal_name', $year);
                    }
                    $pme_count = $pme_count->count();

                    //ND Count
                    $nd_count = DB::table('customusers as cs');
                    $nd_count = $nd_count->distinct();
                    $nd_count = $nd_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $nd_count = $nd_count->where('cs.department', $dept_list->department);
                    $nd_count = $nd_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $nd_count = $nd_count->where('g.goal_name', $year);
                    }
                    $nd_count = $nd_count->count();

                    if($see_count == 0 && $ee_count == 0 && $me_count == 0 && $pme_count == 0 && $nd_count == 0){

                    }else{

                        if($count-1 == $i){

                            $barchart .= "['" .$dept_list->department. "', " .$see_count. ", " .$ee_count. ", " .$me_count. ", " .$pme_count. ", " .$nd_count. "]";

                        }else{

                            $barchart .= "['" .$dept_list->department. "', " .$see_count. ", " .$ee_count. ", " .$me_count. ", " .$pme_count. ", " .$nd_count. "],";
                        }

                        $j++;

                    }

                }

                $i++;

            }

            $barchart .= "]";
        }else{

            $dept_lists = $dept;
            $barchart = "[['Department', 'SEE','EE', 'ME', 'PME' , 'ND'],";
            $count = count($dept_lists);
            $i = 0;
            $j = 0;

            foreach($dept_lists as $key => $dept_list){

                if(!empty($dept_list)){

                    //SEE Count
                    $see_count = DB::table('customusers as cs');
                    $see_count = $see_count->distinct();
                    $see_count = $see_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    // $see_count = $see_count->where('cs.department', "IT");
                    $see_count = $see_count->where('cs.department', $dept_list);
                    $see_count = $see_count->where('g.supervisor_consolidated_rate', 'SEE');
                    if($year != ''){
                        $see_count = $see_count->where('g.goal_name', $year);
                    }
                    $see_count = $see_count->count();

                    //EE Count
                    $ee_count = DB::table('customusers as cs');
                    $ee_count = $ee_count->distinct();
                    $ee_count = $ee_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $ee_count = $ee_count->where('cs.department', $dept_list);
                    $ee_count = $ee_count->where('g.supervisor_consolidated_rate', 'EE');
                    if($year != ''){
                        $see_ee_countcount = $ee_count->where('g.goal_name', $year);
                    }
                    $ee_count = $ee_count->count();

                    //ME Count
                    $me_count = DB::table('customusers as cs');
                    $me_count = $me_count->distinct();
                    $me_count = $me_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $me_count = $me_count->where('cs.department', $dept_list);
                    $me_count = $me_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $me_count = $me_count->where('g.goal_name', $year);
                    }
                    $me_count = $me_count->count();

                    //PME Count
                    $pme_count = DB::table('customusers as cs');
                    $pme_count = $pme_count->distinct();
                    $pme_count = $pme_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $pme_count = $pme_count->where('cs.department', $dept_list);
                    $pme_count = $pme_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $pme_count = $pme_count->where('g.goal_name', $year);
                    }
                    $pme_count = $pme_count->count();

                    //ND Count
                    $nd_count = DB::table('customusers as cs');
                    $nd_count = $nd_count->distinct();
                    $nd_count = $nd_count->join('goals as g', 'g.created_by', '=', 'cs.empID');
                    $nd_count = $nd_count->where('cs.department', $dept_list);
                    $nd_count = $nd_count->where('g.supervisor_consolidated_rate', 'ME');
                    if($year != ''){
                        $nd_count = $nd_count->where('g.goal_name', $year);
                    }
                    $nd_count = $nd_count->count();

                    if($see_count == 0 && $ee_count == 0 && $me_count == 0 && $pme_count == 0 && $nd_count == 0){

                    }else{

                        if($count-1 == $i){
                            $barchart .= "['" .$dept_list. "', " .$see_count. ", " .$ee_count. ", " .$me_count. ", " .$pme_count. ", " .$nd_count. "]";
                        }else{
                            $barchart .= "['" .$dept_list. "', " .$see_count. ", " .$ee_count. ", " .$me_count. ", " .$pme_count. ", " .$nd_count. "],";
                        }
                        $j++;

                    }

                }

                $i++;

            }

            $barchart .= "]";
        }


        echo json_encode($barchart);

    }
    public function pms_report_year_filter_op(Request $request)
    {
        $names = DB::table("goals")->select('goal_name')
                    ->groupByRaw('goal_name')
                    ->get();

        $current_year = date("Y");
        $year = substr( $current_year, -2);
        $previous_year = $current_year - 1;
        $crt_yr_goal_name = 'PMS-'.$previous_year.'-'.$current_year;
        $op = '<option value="">Select Year</option>';

        foreach($names as $key => $name){

            if($crt_yr_goal_name == $name->goal_name){
                $op .= '<option value="'.$name->goal_name.'" selected>'.$name->goal_name.'</option>';

            }else{
                $op .= '<option value="'.$name->goal_name.'">'.$name->goal_name.'</option>';
            }

        }

        return json_encode($op);

    }
    public function pms_pie_dept_filter_op(Request $request)
    {
        $dept = $request->input("dept");
        $names = DB::table("customusers")->where('department', $dept)->where('sup_emp_code', "900531")->get();
        $op = '<option value="">Select Reviewer</option>';
        foreach($names as $key => $name){
            $op .= '<option value="'.$name->empID.'">'.$name->username.'</option>';
        }
        return json_encode($op);
    }

 public function pms_pie_rev_filter_op(Request $request)

    {

        $reviewer = $request->input("reviewer");

        $sup_lists = DB::table("customusers")->where('sup_emp_code', $reviewer)->get();



        foreach($sup_lists as $sup_lists){



            $sup_list_tm = DB::table('customusers')->where('sup_emp_code', $sup_lists->empID)->value("sup_emp_code");



            if(!empty($sup_list_tm)){

                $datas[] = ($sup_lists->empID);

            }

        }



        if(!empty($datas)){

            $op = '<option value="">Select Rep.Manager</option>';

            foreach($datas as $data){

                $name = DB::table('customusers')->where('empID', $data)->value("username");

                $op .= '<option value="'.$data.'">'.$name.'</option>';

            }

        }



        return json_encode($op);

    }

    public function assessment_report()
    {
        $dept_lists = DB::table("customusers")->select('department')
                        ->groupByRaw('department')
                        ->get();

        $data = [ "dept_lists" => $dept_lists, ];

        return view('goals.assessment_report')->with($data);
    }

    public function self_assessment_pie_chart_rating(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $dept = $request->input('dept');
        $man = $request->input('man');
        $tl = $request->input('tl');
        $grade = $request->input('grade');

        $data = array(
            "year" => $year,
            "dept" => $dept,
            "man" => $man,
            "tl" => $tl,
            "grade" => $grade,
        );
        // echo'<pre>';print_r($data);die();

        $data['completed'] = $this->goal->fetch_self_assessment_completed_count($data);
        $data2 = $this->goal->fetch_self_assessment_inprogress_count($data);
        $empID = json_decode(json_encode($data2['customusers']), true);
        $array = json_decode(json_encode($data2['goals']), true);

        if(count($array) === 0){
            $created_by[] = "";
         }else{
            foreach ($array as $value)
            $created_by[] = $value['created_by'];
         }

        foreach ($empID as $empID_g)
            $empID_goals[] = $empID_g['empID'];

        $result = array_diff($empID_goals, $created_by);
        $data['inprogress'] = count($result);

        $sa_pie_chart = "[";
        $sa_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $sa_pie_chart .= "['Completed (". $data['completed'] .")' , " . $data['completed'] . "],";
        $sa_pie_chart .= "['Inprogress (". $data['inprogress'] .")', " . $data['inprogress']. "],";
        $sa_pie_chart .= "]";

        echo json_encode($sa_pie_chart);
    }

    public function get_supervisor_status_pie_chart(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $dept = $request->input('dept');
        $man = $request->input('man');
        $tl = $request->input('tl');
        $grade = $request->input('grade');

        $data = array(
            "year" => $year,
            "dept" => $dept,
            "man" => $man,
            "tl" => $tl,
            "grade" => $grade,
        );

        $data['completed'] = $this->goal->fetch_supervisor_status_completed_count($data);
        $data2 = $this->goal->fetch_supervisor_status_inprogress_count($data);
        $empID = json_decode(json_encode($data2['customusers']), true);
        $array = json_decode(json_encode($data2['goals']), true);

        if(count($array) === 0){
            $created_by[] = "";
         }else{
            foreach ($array as $value)
            $created_by[] = $value['created_by'];
         }

        foreach ($empID as $empID_g)
            $empID_goals[] = $empID_g['empID'];

        $result = array_diff($empID_goals, $created_by);
        $data['inprogress'] = count($result);

        $ss_pie_chart = "[";
        $ss_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $ss_pie_chart .= "['Completed (". $data['completed'] .")' , " . $data['completed'] . "],";
        $ss_pie_chart .= "['Inprogress (". $data['inprogress'] .")', " . $data['inprogress'] . "],";
        $ss_pie_chart .= "]";

        echo json_encode($ss_pie_chart);
    }

    public function get_reviewer_status_pie_chart(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $dept = $request->input('dept');
        $man = $request->input('man');
        $tl = $request->input('tl');
        $grade = $request->input('grade');

        $data = array(
            "year" => $year,
            "dept" => $dept,
            "man" => $man,
            "tl" => $tl,
            "grade" => $grade,
        );

        $data['completed'] = $this->goal->fetch_reviewer_status_completed_count($data);
        $data2 = $this->goal->fetch_reviewer_status_inprogress_count($data);
        $empID = json_decode(json_encode($data2['customusers']), true);
        $array = json_decode(json_encode($data2['goals']), true);

        if(count($array) === 0){
            $created_by[] = "";
         }else{
            foreach ($array as $value)
            $created_by[] = $value['created_by'];
         }

        foreach ($empID as $empID_g)
            $empID_goals[] = $empID_g['empID'];

        $result = array_diff($empID_goals, $created_by);
        $data['inprogress'] = count($result);

        $rs_pie_chart = "[";
        $rs_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $rs_pie_chart .= "['Completed (". $data['completed'] .")' , " . $data['completed'] . "],";
        $rs_pie_chart .= "['Inprogress (". $data['inprogress'] .")', " . $data['inprogress'] . "],";
        $rs_pie_chart .= "]";

        echo json_encode($rs_pie_chart);
    }

    public function get_hr_status_pie_chart(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $dept = $request->input('dept');
        $man = $request->input('man');
        $tl = $request->input('tl');
        $grade = $request->input('grade');

        $data = array(
            "year" => $year,
            "dept" => $dept,
            "man" => $man,
            "tl" => $tl,
            "grade" => $grade,
        );

        $data['completed'] = $this->goal->fetch_hr_status_completed_count($data);
        $data2 = $this->goal->fetch_hr_status_inprogress_count($data);
        $empID = json_decode(json_encode($data2['customusers']), true);
        $array = json_decode(json_encode($data2['goals']), true);
        //  echo'<pre>';print_r($array2);die();
         if(count($array) === 0){
            $created_by[] = "";
         }else{
            foreach ($array as $value)
            $created_by[] = $value['created_by'];
         }
        //  echo'<pre>';print_r($created_by);die();
        foreach ($empID as $empID_g)
            $empID_goals[] = $empID_g['empID'];

        $result = array_diff($empID_goals, $created_by);
        $data['inprogress'] = count($result);

        $hr_pie_chart = "[";
        $hr_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $hr_pie_chart .= "['Completed (". $data['completed'] .")' , " . $data['completed'] . "],";
        $hr_pie_chart .= "['Inprogress (". $data['inprogress'] .")', " . $data['inprogress'] . "],";
        $hr_pie_chart .= "]";

        echo json_encode($hr_pie_chart);
    }

    public function get_bh_status_pie_chart(Request $request)
    {
        // Filter
        $year = $request->input('pms_year_filter');
        $dept = $request->input('dept');
        $man = $request->input('man');
        $tl = $request->input('tl');
        $grade = $request->input('grade');

        $data = array(
            "year" => $year,
            "dept" => $dept,
            "man" => $man,
            "tl" => $tl,
            "grade" => $grade,
        );

        $data['completed'] = $this->goal->fetch_bh_status_completed_count($data);
        $data2 = $this->goal->fetch_bh_status_inprogress_count($data);
        $empID = json_decode(json_encode($data2['customusers']), true);
        $array = json_decode(json_encode($data2['goals']), true);

        if(count($array) === 0){
            $created_by[] = "";
         }else{
            foreach ($array as $value)
            $created_by[] = $value['created_by'];
         }

        foreach ($empID as $empID_g)
            $empID_goals[] = $empID_g['empID'];

        $result = array_diff($empID_goals, $created_by);
        $data['inprogress'] = count($result);

        $bh_pie_chart = "[";
        $bh_pie_chart .= "['By Rating', 'Reporting Manager Consolidated Rate'],";
        $bh_pie_chart .= "['Completed (". $data['completed'] .")' , " . $data['completed'] . "],";
        $bh_pie_chart .= "['Inprogress (". $data['inprogress'] .")', " . $data['inprogress'] . "],";
        $bh_pie_chart .= "]";

        echo json_encode($bh_pie_chart);
    }

    public function pms_checkbox_data_save(request $request)
    {
        foreach($request->gid as $data){
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->pms_checkbox_data_save_update($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }

    public function pms_checkbox_data_submit(request $request)
    {
        // echo '<pre>';print_r($request->all());die();
        foreach($request->gid as $data){
            $id = $data['checkbox'];
            $data = array( 'goal_unique_code' => $data['checkbox'],
                            'supervisor_consolidated_rate' => $data['option'] );
            $result=$this->goal->pms_checkbox_data_submit_update($data);
        }

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response()->json(['response'=>'1']);
    }

    public function pms_checkbox_data_save_for_reviewer_login(request $request)
    {
        foreach($request->gid as $data){
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->pms_checkbox_data_save_update_for_reviewer_login($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }

    public function pms_checkbox_data_submit_for_reviewer_login(request $request)
    {
        foreach($request->gid as $data){
        $id = $data['checkbox'];
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->pms_checkbox_data_submit_update_for_reviewer_login($data);
        }

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response()->json(['response'=>'1']);
    }

    public function pms_checkbox_data_save_for_hr_login(request $request)
    {
        foreach($request->gid as $data){
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->pms_checkbox_data_save_update_for_hr_login($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }

    public function pms_checkbox_data_submit_for_hr_login(request $request)
    {
        foreach($request->gid as $data){
        $id = $data['checkbox'];
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->pms_checkbox_data_submit_update_for_hr_login($data);
        }

        //Sending mail to reviewer
        $logined_rev_name = $this->goal->getRevName($id);
        $logined_rev_email = $this->goal->getRevEmail($id);
        $logined_username = $this->goal->getEmpName($id);
        $logined_empID = $this->goal->getEmpID($id);

        if($result){
            $rev_data = array(
                'name'=> $logined_username,
                'emp_id'=> $logined_empID,
                'rev_name'=> $logined_rev_name,
                'to_email'=> $logined_rev_email,
            );
            Mail::send('mail.goal-rev-mail', $rev_data, function($message) use ($rev_data) {
                $message->to($rev_data['to_email'])->subject
                    ('Self Assessment Submitted Successfully');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });
        }

        return response()->json(['response'=>'1']);
    }
    public function bh_sup_pms_checkbox_data_save(request $request)
    {
        foreach($request->gid as $data){
        $data = array( 'goal_unique_code' => $data['checkbox'],
                        'supervisor_consolidated_rate' => $data['option'] );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->bh_sup_pms_checkbox_data_save($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }
    public function hr_pms_checkbox_data_save(request $request)
    {
        foreach($request->gid as $data){
        $data = array( 
            'goal_unique_code' => $data['checkbox'],
            'action_to_be_performed' => $data['option'],
            'pip_month' => $data['pip_mon'],
            'increment_percentage' => $data['incr'],
            'hike_per_month' => $data['percentage'],
            'new_designation' => $data['designation'],
            'new_sup' => $data['sup'],
        );
        // echo '<pre>';print_r($data);die();
        $result=$this->goal->hr_pms_checkbox_data_save_update($data);
        }
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
            return response()->json(['response'=>'1']);
    }
    public function bh_sup_pms_checkbox_data_submit(request $request)
    {
        foreach($request->gid as $data){
            $data = array( 'goal_unique_code' => $data['checkbox'],
                            'supervisor_consolidated_rate' => $data['option'] );
            // echo '<pre>';print_r($data);die();
            $result=$this->goal->bh_sup_pms_checkbox_data_submit($data);
            //  Sending mail to reviewer
            $id = $data['goal_unique_code'];
            $logined_hr_email = "rajesh.ms@hemas.in";
            $logined_username = $this->goal->getEmpName($id);
            $logined_empID = $this->goal->getEmpID($id);
            if($response){
                $rev_data = array(
                    'name'=> $logined_username,
                    'emp_id'=> $logined_empID,
                    'to_email'=> $logined_hr_email,
                );
                Mail::send('mail.goal-bh-hr-mail', $rev_data, function($message) use ($rev_data) {
                    $message->to($rev_data['to_email'])->subject
                        ('BH Self Assessment Submitted');
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                });
            }
        }
            return response()->json(['response'=>'1']);
    }
    public function hr_pms_checkbox_data_submit(request $request)
    {
        foreach($request->gid as $data){        
            $data = array( 
                'goal_unique_code' => $data['checkbox'],
                'action_to_be_performed' => $data['option'],
                'pip_month' => $data['pip_mon'],
                'increment_percentage' => $data['incr'],
                'hike_per_month' => $data['percentage'],
                'new_designation' => $data['designation'],
                'new_sup' => $data['sup'],
            );
            // echo '<pre>';print_r($data);die();
            $result=$this->goal->hr_pms_checkbox_data_submit($data);
        }
            return response()->json(['response'=>'1']);
    }

    public function get_all_sup_info_bh(Request $request){

        if ($request !="") {
            $data = array(
                'supervisor_id'=>$request->input('supervisor_id'),
                'payroll_status'=>$request->input('payroll_status'),
            );
        }

        if ($request->ajax()) {

            $get_goal_list_result=$this->goal->get_filtered_supervisor_data($data);
            
            return DataTables::of($get_goal_list_result)
            ->addIndexColumn()
            ->addColumn('bh_sup_status_btn', function($row) {
                // echo "<pre>";print_r($row->supervisor_status);die;
                if($row->bh_status != 1 && $row->bh_status != 2){
                    $btn_sup = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">Pending</button>' ;
                }elseif($row->bh_status == 1){
                    $btn_sup = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">Saved</button>' ;
                }elseif($row->bh_status == 2){
                    $btn_sup = '<button class="btn btn-success btn-xs goal_btn_status" type="button">Submitted</button>' ;
                }else{
                    $btn_sup = '';
                }
                return $btn_sup;

            })
            ->addColumn('status', function($row) {
                if($row->goal_status == "Pending"){
                    $btn = '<button class="btn btn-danger btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;
                }elseif($row->goal_status == "Revert"){
                    $btn = '<button class="btn btn-primary btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }elseif($row->goal_status == "Approved"){
                    $btn = '<button class="btn btn-success btn-xs goal_btn_status" type="button">'.$row->goal_status.'</button>' ;

                }else{
                    $btn = '';
                }

                //  echo "<pre>";print_r($btn);die;
                return $btn;
            })
            ->addColumn('bh_rating_op', function($row) {
                // echo "<pre>";print_r($row->employee_consolidated_rate);die;
                if($row->supervisor_consolidated_rate != '')
                {
                    $btn_list = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 216px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='Exceptional Contributor' ".($row->supervisor_consolidated_rate =='Exceptional Contributor' ? 'selected' : '').">Exceptional Contributor</option>
                    <option value='Significant Contributor' ".($row->supervisor_consolidated_rate =='Significant Contributor' ? 'selected' : '').">Significant Contributor</option>
                    <option value='Contributor' ".($row->supervisor_consolidated_rate =='Contributor' ? 'selected' : '').">Contributor</option>
                    <option value='Partial Contributor' ".($row->supervisor_consolidated_rate =='Partial Contributor' ? 'selected' : '').">Partial Contributor</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }else{
                    $btn_list = "<select class='form-control' id='rep_manager_consolidated_rate' name='rep_manager_consolidated_rate' style='width: 216px;'>
                    <option value=''>Select Team Member...</option>
                    <option value='Exceptional Contributor'>Exceptional Contributor</option>
                    <option value='Significant Contributor'>Significant Contributor</option>
                    <option value='Contributor'>Contributor</option>
                    <option value='Partial Contributor'>Partial Contributor</option>
                    </select>
                    <label style='color: red;' class='rep_manager_consolidated_rate_error'></label>";
                }
                return $btn_list;
            })
            ->addColumn('action', function($row) {

                // $enc_code = Crypt::encrypt($row->goal_unique_code);
                $enc_code = base64_encode($row->goal_unique_code);
                // dd($enc_code);
                $btn1 = '<div class="dropup">
                <a href="goal_setting_bh_reviewer_view?id='.$enc_code.'" data-goalcode="'.$row->goal_unique_code.'"><button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" id="dropdownMenuButton"><i class="fa fa-eye"></i></button></a>
                </div>' ;

                return $btn1;
            })
            ->rawColumns(['bh_sup_status_btn', 'status', 'bh_rating_op', 'action'])
            ->make(true);
        }

    }

}
