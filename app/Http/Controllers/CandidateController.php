<?php

namespace App\Http\Controllers;
use App\Repositories\IPreOnboardingrepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Epf_Forms;
use PDF;
use Carbon\Carbon;
use Auth;
use Session;
use File;
use App\welcome_aboard;
use App\Models\CustomUser;

class CandidateController extends Controller
{
    public $preon;
    public function __construct(IPreOnboardingrepositories $preon)
    {
            $this->preon = $preon;
            $this->middleware('is_admin');
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

    public function profile(){
        return view('candidate.profile');
    }

    public function candidate_dashboard()
    {
        //Birthday card
        $current_date = date("d-m-Y");
        $date = Carbon::createFromFormat('d-m-Y', $current_date);
        $result = $date->format('F');
        $monthName = substr($result, 0, 3);
        $dt = $date->format('d');
        $tdy = $dt."-".$monthName;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%'.$tdy.'%')->get();

        //Work anniversary
        $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%'.$tdy.'%')->get();

        //Upcoming holidays
        $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();

        //Upcoming events
        $logined_empid = Auth::user()->empID;
        $upcoming_events = DB::table('event_attendees')
                     ->distinct()
                     ->select('events.*')
                     ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                     ->where('events.start_date_time', '>=', $date)
                     ->where('event_attendees.candidate_name', $logined_empid)
                     ->limit(2)
                     ->get();

        // $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('candidate.dashboard')->with($data);
    }

    public function CandidateInduction()
    {
        return view('candidate.Candidate_Inducation');
    }
    public function Candidate_Assigned_Buddy()
    {
        $sess_info=Session::get("session_info");
        $empID=Auth::user()->empID;
        $buddy_info=$this->preon->fetch_buddy_info($empID);
        // echo json_encode($buddy_info);die();
        return view('candidate.Buddy_info')->with('info',$buddy_info);
    }


    public function preOnboarding()
    {
           $sess_info=Session::get("session_info");
           $empId=$sess_info["empID"];
           $data=array('emp_id'=>$empId);
           $table="candidate_preonboarding";
           $table1="candidatepreonboardingfields";
           $fields=$this->preon->getonBoardingFields($table1);
           $user_info=$this->preon->Check_onBoard($table,$data);
            if($user_info)
            {
                $data['user_info']=$user_info;
            }
            else{
                $data['user_info']="";
            }
           $data['fields']=$fields;
           return view('candidate.preOnboarding')->with('userdata',$data);

    }

    public function buddy()
    {
        $sess_info=Session::get("session_info");
        $table1="candidate_details";
        $candiate_buddy_data=array("empID"=>Auth::user()->empID);
        $id=array("empId"=>Auth::user()->empID);
        $table="buddyfeedbackfields";
        $fields=$this->preon->getonBoardingFields($table);
        $feedback_info=$this->preon->get_buddy_info($id);
        $user_info=$this->preon->get_candidate_and_buddy_info($candiate_buddy_data);
        $data['fields']=$fields;
        $data['feedback_info']=$feedback_info;
        $data['user_info']=$user_info;
        return view('candidate.buddy_feedback')->with('buddy_fields',$data);
    }

    public function welcome_aboard()
    {
        
        return view('candidate.welcome_aboard');
    }
    public function view_welcome_aboard()
    {
        $result=welcome_aboard::where('created_by',Auth::user()->empID)->first(); 
        return view('candidate.view_welcome_aboard')->with('aboard_info',$result);
    }
    // Welcome Aboard Process Start
    public function add_welcome_aboard_process(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'today_date' => 'required',
            'work_in' => 'required',
            'work_designation' => 'required',
            'work_years' => 'required',
            'joining_at' => 'required',
            'joining_as' => 'required',
            ]);

        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        // echo '<pre>';print_r($emp_ID);
        // die;

        $wa_id = 'WA'.((DB::table( 'welcome_aboards' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');

        $did_my = $req->input('did_my');
        $did_my_json = json_encode($did_my);

        $did_from = $req->input('did_from');
        $did_from_json = json_encode($did_from);

        $did_in = $req->input('did_in');
        $did_in_json = json_encode($did_in);

        $work_experience_at = $req->input('work_experience_at');
        $work_experience_at_json = json_encode($work_experience_at);

        $work_experience_as = $req->input('work_experience_as');
        $work_experience_as_json = json_encode($work_experience_as);

        $work_experience_years = $req->input('work_experience_years');
        $work_experience_years_json = json_encode($work_experience_years);

        $form_data = array(
            'wa_id' => $wa_id,
            'name' => $req->input('name'),
            'designation' => $req->input('designation'),
            'department' => $req->input('department'),
            'today_date' => $req->input('today_date'),
            'education_my' => $did_my_json,
            'education_from' => $did_from_json,
            'education_in' => $did_in_json,
            'achievements_education' => $req->input('achievements_education'),
            'work_in' => $req->input('work_in'),
            'work_designation' => $req->input('work_designation'),
            'work_years' => $req->input('work_years'),
            'work_experience_at' => $work_experience_at_json,
            'work_experience_as' => $work_experience_as_json,
            'work_experience_years' => $work_experience_years_json,
            'joining_at' => $req->input('joining_at'),
            'joining_as' => $req->input('joining_as'),
            'achievements_work' => $req->input('achievements_work'),
            'my_favorite_pastime' => $req->input('my_favorite_pastime'),
            'my_favorite_hobbies' => $req->input('my_favorite_hobbies'),
            'my_favorite_places' => $req->input('my_favorite_places'),
            'my_favorite_foods' => $req->input('my_favorite_foods'),
            'my_favorite_sports' => $req->input('my_favorite_sports'),
            'my_favorite_movies' => $req->input('my_favorite_movies'),
            'my_favorite' => $req->input('my_favorite'),
            'my_extracurricular_specialities' => $req->input('my_extracurricular_specialities'),
            'my_career_aspirations' => $req->input('my_career_aspirations'),
            'languages' => $req->input('languages'),
            'interesting_facts' => $req->input('interesting_facts'),
            'my_motto' => $req->input('my_motto'),
            'books' => $req->input('books'),
            'created_on' => $today_date,
            'created_by' => $emp_ID

        );
        // echo '<pre>';print_r($form_data);
        // die;
        $add_welcome_aboard_process_result = $this->preon->add_welcome_aboard_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    public function get_welcome_aboard_details(Request $req){

        $sess_info = Session::get("session_info");
        $empID = $sess_info['empID'];

        $get_welcome_aboard_details_result = $this->preon->get_welcome_aboard_details($empID);

        $get_welcome_aboard_details_result['get_education_my'] =  json_decode($get_welcome_aboard_details_result->education_my,TRUE);
        $get_welcome_aboard_details_result['get_education_from'] = json_decode($get_welcome_aboard_details_result->education_from,TRUE);
        $get_welcome_aboard_details_result['get_education_in'] = json_decode($get_welcome_aboard_details_result->education_in,TRUE);

        $get_welcome_aboard_details_result['get_work_experience_at'] =  json_decode($get_welcome_aboard_details_result->work_experience_at,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_as'] = json_decode($get_welcome_aboard_details_result->work_experience_as,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_years'] = json_decode($get_welcome_aboard_details_result->work_experience_years,TRUE);

    //   echo '<pre>';print_r($get_welcome_aboard_details_result);die();

        return response()->json( $get_welcome_aboard_details_result );
    }

    public function welcome_aboard_generate_pdf()
    {
        $sess_info = Session::get("session_info");
        $empID = $sess_info['empID'];

        $get_welcome_aboard_details_result = $this->preon->get_welcome_aboard_details($empID);

        // echo '<pre>';print_r($get_welcome_aboard_details_result->name);die();

        $get_welcome_aboard_details_result['get_education_my'] =  json_decode($get_welcome_aboard_details_result->education_my,TRUE);
        $get_welcome_aboard_details_result['get_education_from'] = json_decode($get_welcome_aboard_details_result->education_from,TRUE);
        $get_welcome_aboard_details_result['get_education_in'] = json_decode($get_welcome_aboard_details_result->education_in,TRUE);

        $get_welcome_aboard_details_result['get_work_experience_at'] =  json_decode($get_welcome_aboard_details_result->work_experience_at,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_as'] = json_decode($get_welcome_aboard_details_result->work_experience_as,TRUE);
        $get_welcome_aboard_details_result['get_work_experience_years'] = json_decode($get_welcome_aboard_details_result->work_experience_years,TRUE);

        // $info = "";

        $info = [
            'name' => $get_welcome_aboard_details_result->name,
            'designation' => $get_welcome_aboard_details_result->designation,
            'department' => $get_welcome_aboard_details_result->department,
            'today_date' => $get_welcome_aboard_details_result->today_date,
            'get_education_my' => $get_welcome_aboard_details_result['get_education_my'],
            'get_education_from' => $get_welcome_aboard_details_result['get_education_from'],
            'get_education_in' => $get_welcome_aboard_details_result['get_education_in'],
            'achievements_education' => $get_welcome_aboard_details_result->achievements_education,
            'work_in' => $get_welcome_aboard_details_result['work_in'],
            'work_designation' => $get_welcome_aboard_details_result['work_designation'],
            'work_years' => $get_welcome_aboard_details_result['work_years'],
            'work_experience_at' => $get_welcome_aboard_details_result['get_work_experience_at'],
            'work_experience_as' => $get_welcome_aboard_details_result['get_work_experience_as'],
            'work_experience_years' => $get_welcome_aboard_details_result['get_work_experience_years'],
            'joining_at' => $get_welcome_aboard_details_result['joining_at'],
            'joining_as' => $get_welcome_aboard_details_result['joining_as'],
            'achievements_work' => $get_welcome_aboard_details_result['achievements_work'],
            'my_favorite_pastime' => $get_welcome_aboard_details_result['my_favorite_pastime'],
            'my_favorite_hobbies' => $get_welcome_aboard_details_result['my_favorite_hobbies'],
            'my_favorite_places' => $get_welcome_aboard_details_result['my_favorite_places'],
            'my_favorite_foods' => $get_welcome_aboard_details_result['my_favorite_foods'],
            'my_favorite_sports' => $get_welcome_aboard_details_result['my_favorite_sports'],
            'my_favorite_movies' => $get_welcome_aboard_details_result['my_favorite_movies'],
            'my_favorite' => $get_welcome_aboard_details_result['my_favorite'],
            'my_extracurricular_specialities' => $get_welcome_aboard_details_result['my_extracurricular_specialities'],
            'my_career_aspirations' => $get_welcome_aboard_details_result['my_career_aspirations'],
            'languages' => $get_welcome_aboard_details_result['languages'],
            'interesting_facts' => $get_welcome_aboard_details_result['interesting_facts'],
            'my_motto' => $get_welcome_aboard_details_result['my_motto'],
            'books' => $get_welcome_aboard_details_result['books'],

        ];

        // echo '<pre>';print_r($data['get_education_my']["0"]);die();

        // return view('admin.welcome_aboard_pdf')->with('info',$data);
        // $pdf = PDF::loadView('admin.welcome_aboard_pdf', $data);
        $pdf = PDF::loadView('candidate.welcome_aboard_pdf', compact('info'));

        return $pdf->stream('welcome_aboard.pdf');
    }
// pre onBoarding Insert
public function insertPreOnboarding(Request $request)
{
       $sess_info=Session::get("session_info");
       $empId=Auth::user()->empID;
       $data=array('emp_id'=>$empId);
       $table="candidate_preonboarding";
       $table1='customusers';
       $data1=array('empID'=>Auth::user()->empID);
       $candidate_info=Customuser::where('empID',Auth::user()->empID)->select('HR_Recruiter')->first();
       $usercheck=$this->preon->Check_onBoard($table,$data);
       $recruiter_id=$candidate_info->HR_Recruiter;
       if(count($usercheck) > 0)
       {
        foreach($_POST['onboard'] as $onboard)
        {
                  if($onboard['date']=="")
                  {
                       $date=NULL;
                  }
                  else{
                      $date=$onboard['date'];
                  }

            $main_data[]=array(
                               'type'=>$onboard['verified'],
                                'date'=>$date);
        }
        // $test="1";
            $response=$this->preon->update_onboard($main_data,$empId,$usercheck);
       }
       else{
        foreach($_POST['onboard'] as $onboard)
        {
                  if($onboard['date']=="")
                  {
                       $date=NULL;
                  }
                  else{
                      $date=$onboard['date'];
                  }

            $main_data[]=array('preonboarding_process'=>$onboard['Process'],
                               'type'=>$onboard['verified'],
                                'date'=>$date,
                                'emp_id'=>$empId,
                                'recruiter_id'=>$recruiter_id);
        }
        // $test="2";
             $response=$this->preon->insert_onboard($main_data);
       }


       if($response)
       {
            $result=array('type'=>1,"message"=>"Data Updated Successfully");
       }
       else{
        $result=array('type'=>2,"message"=>"Problem in Updating Data");

       }

       echo json_encode($result);
}


public function InsertBuddyFeedback(Request $request)
{
      $first_result=array();
      $final_result=[];
      $data=$request->ar;
      $data2=$request->buddy_data;
      $i=0;
      foreach($data as $vendor)
       {
           $first=$vendor["testing_data"];
                 $j=0;
                 foreach($first as $second){
                       $first_result["comments".$j.""]=$second["comment"];
                       $first_result["empId"]=$second["empID"];
                       $first_result["fieldid"]=$second["fieldid"];
                        if($j==2){
                               if($first_result["comments0"]=="" && $first_result["comments1"]=="" && $first_result["comments2"]=="")
                               {
                                   $final_response=array("success"=>0,"message"=>"Please give Any of the Comments");
                                   echo json_encode($final_response);
                                   return false;
                               }
                               else{
                                   $final_result[]=$first_result;
                                   $first_result=[];
                               }
                        }
                       $j++;
                 }
              }
               foreach($data2 as $data1){
                   $result[]=array("empId"=>$data1["empId"],
                               "fieldid"=>$data1["fieldid"],
                               "response"=>$data1["response"],
                               "comments0"=>$data1["comments0"],
                               "comments1"=>$data1["comments1"],
                               "comments2"=>$data1["comments2"],
                               "remarks"=>$data1["remarks"]);
             }
       $response=$this->preon->insert_buddy_feedback($result,$final_result);
       if($response){
            $final_response=array('status'=>1,"message"=>"Data Added Successfully");
       }
       else{
            $final_response=array('status'=>0,"message"=>"Problem in Adding Data");
       }

       echo json_encode($final_response);


}

public function document_center()
{
    return view('candidate.document_center');
}

public function payslip()
{
    return view('candidate.payslip');
}

public function documents_candidate()
{
    return view('candidate.documents_candidate');
}

public function company_policy_candidate()
{
    return view('candidate.company_policy_candidate');
}

public function get_policy_category_candidate_details(){
        // $input_details = array(
        //     'id'=>$req->input('id'),
        // );

        $get_policy_category_candidate_details_result = $this->preon->get_policy_category_candidate_details();

        return response()->json( $get_policy_category_candidate_details_result );
    }

public function get_policy_information_candidate_details(Request $req){
        $input_details = array(
            'cp_id'=>$req->input('cp_id'),
        );
        // echo '<pre>';print_r($input_details);die();

        $get_policy_information_candidate_details_result = $this->preon->get_policy_information_candidate_details( $input_details );

        return response()->json( $get_policy_information_candidate_details_result );
    }

    public function epf()
    {

        $sess_info=Session::get("session_info");
         $cdID=$sess_info['empID'];
         $check_epf_form_result = $this->preon->check_epf_form($cdID);
         if($check_epf_form_result == 0){
            return view('candidate.epf');
         }
         else{
            return view('candidate.view_epf');
         }

    }
    public function save_epf_form(Request $request){
        $sess_info=Session::get("session_info");
         $cdID=$sess_info['empID'];
        $fname = $request->input('f_name');
        $sname = $request->input('s_name');
        if($fname == null){
            $fname ="no_val";
        }
        if($sname == null){
            $sname ="no_val";
        }
        $uan_number = $request->input('uan');
        $prev_pf_no = $request->input('ppf');
        $date_prev_exit = $request->input('pr_exit_date');
        $scheme_cert_no = $request->input('scn');
        $ppo = $request->input('ppo');

        if($uan_number == null){
            $uan_number ="no_val";
        }
        if($prev_pf_no == null){
            $prev_pf_no ="no_val";
        }
        if($date_prev_exit == null){
            $date_prev_exit ="no_val";
        }
        if($scheme_cert_no == null){
            $scheme_cert_no ="no_val";
        }
        if($ppo == null){
            $ppo ="no_val";
        }
        $passport_no = $request->input('passport_no');
        $val_passport_from = $request->input('from_date');
        $val_passport_to = $request->input('to_date');
        if($passport_no == null){
            $passport_no ="no_val";
        }
        if($val_passport_from == null){
            $val_passport_from ="no_val";
        }
        if($val_passport_to == null){
            $val_passport_to ="no_val";
        }
        $pan_no = $request->input('pan');
        if($pan_no == null){
            $pan_no ="no_val";
        }
        $coun_origin = $request->input('sco');
        if($coun_origin == null){
            $coun_origin ="no_val";
        }
        $data = array(
            'cdID' =>$cdID,
            'member_name'=>$request->input('emp_name'),
            'father_name'=>$fname,
            'spouse_name'=>$sname,
            'dob'=>$request->input('dob'),
            'gender'=>$request->input('gender'),
            'marry_status'=>$request->input('mar_status'),
            'email_id'=>$request->input('email_id'),
            'mob'=>$request->input('mob_no'),
            'epfs_status'=>$request->input('epf'),
            'eps_status'=>$request->input('eps'),
            'uan_number'=>$uan_number,
            'prev_pf_no'=>$prev_pf_no,
            'date_prev_exit'=>$date_prev_exit,
            'scheme_cert_no'=>$scheme_cert_no,
            'ppo'=>$ppo,
            'int_work_status'=>$request->input('inter_worker'),
            'coun_origin'=>$coun_origin,
            'passport_no'=>$passport_no,
            'val_passport_from'=>$val_passport_from,
            'val_passport_to'=>$val_passport_to,
            'bank_account'=>$request->input('bank_account'),
            'aadhar_no'=>$request->input('aadhar'),
            'pan_no'=>$pan_no,
        );
       // print_r($cdID);
        $response=$this->preon->insert_epf_form($data);
    if($response){
        $response = 'success';
    }
    else{
        $response = 'error';
    }
        return response()->json( ['response' => $response] );
     }

     public function view_epf(Request $request){
        $sess_info=Session::get("session_info");
         $cdID=$sess_info['empID'];
    $input = array(
        'cdID'=> $cdID,
    );
         $get_epf_details = $this->preon->get_candidate_epf_details($cdID);
        // print_r($get_epf_details);
        echo json_encode($get_epf_details);


     }
     public function view_epf_form()
     {
         return view('candidate.view_epf');
     }

     public function medical_form()
     {
        // // $sess_info=Session::get("session_info");
        // $cdID=$sess_info['empID'];
        // $check_medical_details_result = $this->preon->check_medical_details($cdID);
        // if($check_medical_details_result ==0){
        //  return view('candidate.medical_insurance');
        // }
        // else{

        //  $file_name = $cdID . '.medical.' . 'pdf';
        //  //$path = Storage::get('\public\medical_insurance\.'.$file_name.'');
        //  $path = '../medical_insurance/'.$cdID.'/'.$file_name;
        //   echo app_path();
        // }
        return view('candidate.medical_insurance');

     }


     public function save_medical_form(Request $request){
        $sess_info=Session::get("session_info");
        $cdID=$sess_info['empID'];

         $insurance_name = $request->input( 'insur_name' );
         $insurance_name_json = json_encode($insurance_name);

         $relation_name = $request->input( 'relation' );
         $relation_name_json = json_encode($relation_name);

         $dob = $request->input( 'dob' );
         $dob_json = json_encode($dob);

         $age = $request->input( 'age' );
         $age_json = json_encode($age);

         $gender = $request->input( 'gender' );
         $gender_json = json_encode($gender);

         $file_name = $cdID . '.medical.' . 'pdf';
         $data = array(
            'cdID' => $cdID,
            'insur_name' => $insurance_name_json,
            'relation' => $relation_name_json,
            'dob' => $dob_json,
            'age' => $age_json,
            'gender' => $gender_json,
            'file_name' => $file_name,
        );

        $path = public_path().'/medical_insurance/'.$cdID;

        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $check_medical_details_result = $this->preon->check_medical_details($cdID);

        if($check_medical_details_result ==0){

            $response=$this->preon->insert_medical_form($data);

        }else{
            if (\File::exists($path)) \File::deleteDirectory($path);
            $response=$this->preon->update_medical_form($data);

        }

        $pdf_data =array();
        for ($i=0; $i < count($insurance_name); $i++) {
            if(isset($insurance_name[$i])){
            $pdf_data[$i]['insurance_name'] = $insurance_name[$i];
            $pdf_data[$i]['relation_name'] = $relation_name[$i];
            $pdf_data[$i]['dob'] = $dob[$i];
            $pdf_data[$i]['age'] = $age[$i];
            $pdf_data[$i]['gender'] = $gender[$i];
            }
        }
        $data = array (
            'json' => $pdf_data
        );
        $pdf = PDF::loadView('candidate/medical_insurance_pdf', $data);

        $path = public_path().'/medical_insurance/'.$cdID;

        if (\File::exists($path)) \File::deleteDirectory($path);

        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $fileName = $cdID . '.medical.' . 'pdf';

        $pdf->save($path . '/' . $fileName);



        if($response){
            $response = "success";
        }
        else{
            $response = "error";
        }
        return response()->json( [
            'response' => $response,
            'redirect_url' =>'../medical_insurance/'.$cdID.'/'.$fileName,
        ] );

     }

    public function leave_balance()
    {
        return view('candidate.leave_balance');
    }

    public function get_leave_masters_details()
    {
        $get_leave_masters_details_result = $this->preon->get_leave_masters_details();

        return response()->json( $get_leave_masters_details_result );
    }

    public function leave_apply()
    {
        return view('candidate.leave_apply');
    }


}
