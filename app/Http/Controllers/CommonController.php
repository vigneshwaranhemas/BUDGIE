<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IAdminRepository;
use App\Repositories\IProfileRepositories;
use App\Repositories\ICommonRepositories;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Image;
use Session;
use Validator;
use Mail;
use App\Models\UserActivityModel;
use PDF;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class CommonController extends Controller
{
    // protected $fpdf;
    public function id_card_varification(){
           return view('id_card_verification');
    }public function pms_conformation(){
           return view('pms_conformation');
    }public function hr_id_card_verification(){
           return view('hr_id_card_verification');
    }public function change_password(){
            return view('change_password');
    }public function pagenotfound(){
            return view('404');
    }public function chat_process(){
            return view('chat_pg');
    }public function my_team(){
            return view('my_team');
    }
    public function __construct(IAdminRepository $admrpy,IProfileRepositories $profrpy,ICommonRepositories $cmmrpy){
        // $this->fpdf = new Fpdf;
        $this->admrpy = $admrpy;
        $this->profrpy = $profrpy;
        $this->cmmrpy = $cmmrpy;
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


    /*get iD card info*/
    public function idcard_info(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_ID = $session_val['empID'];
        if ($cdID !="") {
        $input_details = array( "cdID" => $cdID,"empID" =>"");
        } else if( $emp_ID !=""){
        $input_details = array( "empID" => $emp_ID,"cdID" =>"" );
        }
        $get_idcard_info_result = $this->profrpy->get_idcard_info( $input_details );

        return response()->json( $get_idcard_info_result );

    }

    /*ID_Card info save and update */
    public function idcard_info_save(Request $request){

        $validator=Validator::make($request->all(),[
                'file' =>'required|image|mimes:png',
                'f_name' => 'required',
                'l_name' => 'required',
                'emp_num_1' => 'required|numeric',
                'emrg_con_num' => 'required|numeric',
                'name_rel_ship'=>'required', 
                'rel_emp' => 'required',
                'doj' => 'required',
                'official_email' => 'required',
                'p_email' => 'required',
                'blood_grp' => 'required',
                'emp_dob' => 'required',
                ], [
                'f_name.required' => 'First Name is required',
                'l_name.required' => 'Last Name  is required',
                'emp_num_1.required' => 'Employee Mobile Number required',
                'emrg_con_num.required' => 'Emergency Contact Number required',
                'name_rel_ship.required' => 'Name of Relationship is required',
                'rel_emp.required' => 'Emergency Contact of Relationship required',
                'doj.required' => 'Date of joing required',
                'official_email.required' => 'Official Email required',
                'p_email.required' => 'Personal Email required',
                'blood_grp.required' => 'Blood Group is required',
                'emp_dob.required' => 'Date of birth is required',
                'file.required'=>'Image File is required',
                ]);
        if($validator->passes()){

            $session_val = Session::get('session_info');
            $emp_ID = $session_val['empID'];
            $cdID = $session_val['cdID'];

            $user = DB::table( 'customusers' )->where('cdID', '=', $cdID)->first();

        if ($user === null) {
                    $file = $request->file('file');
                    $destinationPath = public_path('ID_card_photo/');
                    $profileImage =  $emp_ID . "." . $file->getClientOriginalExtension();
                    $img_id= $emp_ID;
                    $file->move($destinationPath, $profileImage);
                    $path = $img_id;
                $data =array(
                    'emp_id'=>$emp_ID,
                    'img_path'=>$path,
                    'cdID'=>$cdID,
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'emp_code'=>$request->input('emp_code'),
                    'official_email'=>$request->input('official_email'),
                    'p_email'=>$request->input('p_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    // 'action'=>"0",
                    );

                $insert = DB::table( 'customusers' )->insert( $data );

                    // $Mail['candidate_name']=$store_result["message"]["induction_info"]->username;
                    // $Mail['username']=$request->empID;
                    // $Mail['password']="Welcome@123";
                // $store_result=$this->cmmrpy->Candidate_info_mail($data);
                    $Mail['email']=$session_val['email'];
                    // $Mail['email']='vigneshb@hemas.in';
                    $Mail['hr_email']='hr@hemas.in';
                    $Mail['subject']="Thank you for submitting the details.";
                    $Mail['candidate_name']=$user->username;
                    $Mail['hr_subject']="ID Card Informatin approvel Awaited.";

                    Mail::send('emails.id_card_submit_can', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });

            /*email start*/
                Mail::send('emails.can_tohr_mail', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['hr_email'])->subject($Mail['hr_subject']);
                    });


                return response()->json(['response'=>'insert']);

            }else{

                    $file = $request->file('file');
                    $destinationPath = public_path('ID_card_photo/');
                    $profileImage =  $emp_ID . "." . $file->getClientOriginalExtension();
                    $img_id= $emp_ID;
                    $file->move($destinationPath, $profileImage);
                    $path = $img_id;
                $data =array(
                    // 'emp_id'=>$emp_ID,
                    'cdID'=>$cdID,
                    'img_path'=>$path,
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'empID'=>$emp_ID,
                    'official_email'=>$request->input('official_email'),
                    'p_email'=>$request->input('p_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    'hr_action'=>"1",
                    'hr_id_remark'=>"",

                    );
            $update_role_unit_details_result = $this->profrpy->update_idcard_info( $data );


            $emp_ID = $session_val['empID'];
            $cdID = $session_val['cdID'];
            if ($cdID !="") {
            $user = DB::table( 'customusers' )->where('cdID', '=', $cdID)->first();
            }else if($emp_ID !=""){
            $user = DB::table( 'customusers' )->where('empID', '=', $emp_ID)->first();
            }

            /*email for can*/
                    $Mail['email']=$session_val['email'];
                    // $Mail['email']='vigneshb@hemas.in';
                    $Mail['hr_email']='hr@hemas.in';
                    $Mail['subject']="Thank you for submitting the details.";
                    $Mail['candidate_name']=$user->username;
                    $Mail['hr_subject']="ID Card Informatin approvel Awaited.";

                    Mail::send('emails.id_card_submit_can', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });

            /*email for hr*/
                Mail::send('emails.can_tohr_mail', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['hr_email'])->subject($Mail['hr_subject']);
                    });

                return response()->json(['response'=>'Update']);
            }
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }
        }

         /*HR ID_Card info Update */
    public function hr_idcard_verfi(Request $request){

        /*$validator=Validator::make($request->all(),[
                // 'pro_img_up' => 'required|mimes:jpg',
                'f_name' => 'required',
                'l_name' => 'required',
                'emp_num_1' => 'required|numeric',
                'emrg_con_num' => 'required|numeric',
                'blood_grp' => 'required',
                'emrg_con_num' => 'required',
                'emp_dob' => 'required',
                ], [
                // 'pro_img_up.required' => 'Profile image Allow Only JPG Formate',
                'f_name.required' => 'First Name is required',
                'l_name.required' => 'Last Name  is required',
                'emp_num_1.required' => 'Employee Mobile Number required',
                'emrg_con_num.required' => 'Emergency contact number is required',
                'blood_grp.required' => 'Blood Group is required',
                'emp_dob.required' => 'Date of birth is required',
                ]);

        if($validator->passes()){*/

              $file = $request->file('file');
        if($file!=""){
            $destinationPath = public_path('ID_card_photo/');
           $profileImage = $request->input('emp_code') . "." . $file->getClientOriginalExtension();
           // echo "<pre>";print_r($profileImage);die;
           $img_id=$request->input('emp_code');
           $file->move($destinationPath, $profileImage);
           $path = $img_id;
           $empty =" ";

                $data =array(
                    'img_path'=>$path,
                    // 'cdID'=>$cdID,
                    'can_id'=>$request->input('can_id'),
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'empID'=>$request->input('emp_code'),
                    'official_email'=>$request->input('official_email'),
                    'p_email'=>$request->input('p_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    );
                // echo "1<pre>";print_r($data);die;
            }else{
                $img_id=$request->input('img_path_hide');
                $path = $img_id;
                $empty =" ";
                $data =array(
                    'img_path'=>$path,
                    // 'cdID'=>$cdID,
                    'can_id'=>$request->input('can_id'),
                    'f_name'=>$request->input('f_name'),
                    'm_name'=>$request->input('m_name'),
                    'l_name'=>$request->input('l_name'),
                    'working_loc'=>$request->input('working_loc'),
                    'emp_num_1'=>$request->input('emp_num_1'),
                    'emp_num_2'=>$request->input('emp_num_2'),
                    'rel_emp'=>$request->input('rel_emp'),
                    'name_rel_ship'=>$request->input('name_rel_ship'),
                    'emrg_con_num'=>$request->input('emrg_con_num'),
                    'doj'=>$request->input('doj'),
                    'blood_grp'=>$request->input('blood_grp'),
                    'empID'=>$request->input('emp_code'),
                    'official_email'=>$request->input('official_email'),
                    'p_email'=>$request->input('p_email'),
                    'emp_dob'=>$request->input('emp_dob'),
                    );
                // echo "2<pre>";print_r($data);die;
            }
             // echo "<pre>";print_r($data);die;
            $update_role_unit_details_result = $this->cmmrpy->update_hr_idcard_info( $data );
            $can_id = $request->input('can_id');
            if ($can_id !="") {
            $user = DB::table( 'customusers' )->where('id', '=', $can_id)->first();
            }
                // echo "<pre>";print_r($user->username);die;

            $Mail['candidate_name']=$user->username;
            /*email start*/
                $Mail['email']= $user->email;
                $Mail['subject']="ID Card Verification is Approved";
                Mail::send('emails.hr_idcard_approvel', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });
                /*email end*/

            // ID Card pdf generator start
            $info = [
                "emp_code" => $request->input('emp_code'),
                'f_name'=>$request->input('f_name'),
                'emp_num_1'=>$request->input('emp_num_1'),
                'doj'=>$request->input('doj'),
                'blood_grp'=>$request->input('blood_grp'),
                'official_email'=>$request->input('official_email'),
            ];
            // echo '<pre>';print_r($info);die();            
            $pdf = new Fpdi();
        
            // set the source file
            $path = public_path("ID_Card_1.pdf");
            $pageCount = $pdf->setSourceFile($path);
        
            $pdf->setSourceFile($path);

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {                  
                // import page
                if($pageNo == 1)
                {
                    // add a page 
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',14);
                    $tplId = $pdf->importPage($pageNo);
                    // use the imported page and place it at point 10,10 with a width of 100 mm
                    $pdf->useTemplate($tplId, null, null, null, 210, true);
                    $image = public_path('sample_id_card.png');
                    // For image size(image_path, left, bottom, width, height)
                    $pdf->Image($image, 5, 48, 130, 120);

                    // $pdf->SetXY(200, 180);
                    // $pdf->Write(0.8,"PREETHI A");      

                    // Set font 
                    $pdf->SetFont('Arial','B',20);
                    $pdf->SetXY(10,170);
                    $pdf->Cell(0,11,''.$info['f_name'].'',0,0,'C');
                    
                    $pdf->SetFont('Arial','B',15);
                    $pdf->SetXY(10,178);
                    $pdf->Cell(0,11,''.$info['emp_code'].'',0,0,'C');
                }elseif($pageNo == 2)
                {
                    // add a page 
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',14);
                    $tplId = $pdf->importPage($pageNo);
                    $pdf->useTemplate($tplId, null, null, null, 210, true);

                    // Set font 
                    $pdf->SetFont('Arial','B',30);
                    $pdf->SetXY(10,20);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0,11,''.$info['emp_num_1'].'',0,0,'C');

                    // Set font 
                    $pdf->SetFont('Arial','B',20);
                    $pdf->SetXY(28,32);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0,11,''.$info['doj'].'',0,0,'C');

                    // Set font                 
                    $pdf->SetFont('Arial','B',20);
                    $pdf->SetXY(30,44);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0,11,''.$info['blood_grp'].'',0,0,'C');

                    // Set font 
                    $pdf->SetFont('Arial','B',16);
                    $pdf->SetXY(40,55);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0,11,''.$info['official_email'].'',0,0,'C');
                }
            
        }

            // Preview PDF (F for save)
            $pdf->Output('F','ID_card_pdf/'.$info['emp_code'].'.pdf');

            // ID Card pdf generator End

            return response()->json(['response'=>'Update']);
        /*}else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }*/
        }

    public function Contact_info_hr(Request $request){

        $input_details = array( "empID" => $request->empID, );
        $candidate_info_result_hr = $this->cmmrpy->get_candidate_info_hr2( $input_details );

        return response()->json( $candidate_info_result_hr );

    }
    public function account_info_hr(Request $request){

        $input_details = array( "empID" => $request->empID, );
        $candidate_info_result_hr = $this->cmmrpy->account_hr_info( $input_details );

        return response()->json( $candidate_info_result_hr );

    }
    public function education_information_hr(Request $request){

        $input_details = array( "empID" => $request->empID, );
        $candidate_info_result_hr = $this->cmmrpy->education_hr_info( $input_details );

        return response()->json( $candidate_info_result_hr );

    }
    public function hr_get_id_card_vari(Request $request){
        $input_details = array( "id" => $request->id,"empID" => $request->empID, );
        $candidate_info_result_hr = $this->cmmrpy->get_candidate_info_hr( $input_details );

        // echo "<pre>";print_r($candidate_info_result_hr);die;
        return response()->json( $candidate_info_result_hr );

    }
    public function hr_profile_banner(Request $request){
        $input_details = array( "id" => $request->id,"empID" => $request->empID, );
        $banner_result_hr = $this->cmmrpy->get_profile_banner_hr( $input_details );

        // echo "<pre>";print_r($banner_result_hr);die;
        return response()->json( $banner_result_hr );

    }
    public function experience_info_hr_info(Request $request){

        $input_details = array( "id" => $request->id ,"empID" => $request->empID ,);
        $candidate_info_result_hr = $this->cmmrpy->get_candidate_exp_hr( $input_details );

        return response()->json( $candidate_info_result_hr );

    }
    public function family_information_hr(Request $request){

        $input_details = array( "id" => $request->id ,"emp_id" => $request->emp_id ,);
        $candidate_info_result_hr = $this->cmmrpy->family_info_to_hr( $input_details );

        return response()->json( $candidate_info_result_hr );

    }

     /*hr id card remarks information*/
    public function hr_id_remark(Request $request){

        $validator=Validator::make($request->all(),[
                'id_remark' => 'required',
                ], [
                'id_remark.required' => 'Remark is required',
                ]);

        if($validator->passes()){

                $data =array(
                    'id_remark'=>$request->input('id_remark'),
                    'can_id_hr'=>$request->input('can_id_hr'),
                    );
            $update_role_unit_details_result = $this->cmmrpy->update_hr_idcard_remark( $data );

                /*ignore email*/
            $can_id = $request->input('can_id_hr');
            if ($can_id !="") {
            $user = DB::table( 'customusers' )->where('id', '=', $can_id)->first();
            }
                // echo "<pre>";print_r($user->username);die;

            $Mail['candidate_name']=$user->username;
            /*email start*/
                $Mail['email']= $user->email;
                $Mail['subject']="ID Card Verification is Failed";
                Mail::send('emails.hr_idcard_revert', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });
                /*email end*/


                return response()->json(['response'=>'Update']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }
        }
//vignesh code for check user status

    public function check_user_status(Request $request){
        $empID=$request->empID;
        $result = $this->cmmrpy->check_user_status($empID);
        echo json_encode($result);
    }
    public function check_user_pms(Request $request){
        $empID=$request->empID;
        $result = $this->cmmrpy->user_status_pms($empID);
        // echo "<pre>";print_r($result);die;
        if ($result['customusers'] == 1 && $result['goals'] == 0 ) {
        // echo "11<pre>";print_r($result);die;
            $response = 1;
        }else if($result['customusers'] == 1 && $result['goals'] == 1 || $result['customusers'] == 0 && $result['goals'] == 0){
            $response = 2;
        }

        echo json_encode($response);
    }

    public function change_password_process(Request $req){
        // get all data
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $input_details = array(
            'empID'=>$emp_ID,
            'confirm_password'=>bcrypt($req->input('confirm_password')),
            'passcode_status'=>"1",
        );
        $change_password_process_result = $this->cmmrpy->change_password_process( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );

    }

public function organization_charts()
{
        $result = $this->cmmrpy->get_organization_info();
        $filePath= $_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$result['reviewer']->img_path.'.jpg';
        if(file_exists($filePath)){
             $image='../ID_card_photo/'.$result['reviewer']->img_path.'.jpg';
        }
        else{
            $image='../ID_card_photo/dummy.png';
        }
       //reviewer wise
       $emp_data[]=array('id'=>$result['reviewer']->empID,
                         'pid'=>0,
                         'name'=>$result['reviewer']->username,
                         'txt'=>$result['reviewer']->designation,
                         'img'=>$image);

      //superwisor wise
      foreach($result['supervisors'] as $supervisors){
                        if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$supervisors['img_path'].'.jpg')) {
                            $sup_image='../ID_card_photo/'.$supervisors['img_path'].'.jpg';
                         }
                         else{
                            $sup_image='../ID_card_photo/dummy.png';
                         }

                $emp_data[]=array('id'=>$supervisors['empID'],
                'pid'=>$supervisors['sup_emp_code'],
                'name'=>$supervisors['username'],
                'txt'=>$supervisors['designation'],
                'img'=>$sup_image);
      }

    //teamleader wise
      foreach($result['team_leaders'] as $team_leaders){

        foreach($team_leaders as $leaders){
            if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$leaders['img_path'].'.jpg')) {
                $team_image='../ID_card_photo/'.$leaders['img_path'].'.jpg';
             }
             else{
                $team_image='../ID_card_photo/dummy.png';
             }
            $emp_data[]=array('id'=>$leaders['empID'],
            'pid'=>$leaders['sup_emp_code'],
            'name'=>$leaders['username'],
            'txt'=>$leaders['designation'],
            'img'=>$team_image);
        }
}


    return view('HRSS.organization_charts1')->with('emp_data',$emp_data)->with('supervisors',$result['supervisors']);

}
public function supervisor_wise_TreeData(Request $request)
{
    $id=$request->id;
    // $id=$_GET['id'];
    $result = $this->cmmrpy->supervisor_wise_info($id);
    foreach($result['employees'] as $emp)
    {
           foreach($emp as $employees){
                if(count($emp)>0){
                    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$employees['img_path'].'.jpg')) {
                        $sup_image='../ID_card_photo/'.$employees['img_path'].'.jpg';
                    }
                    else{
                        $sup_image='../ID_card_photo/dummy.png';
                    }
                  $emp_data[]=array('id'=>$employees['empID'],
                  'pid'=>$employees['sup_emp_code'],
                  'name'=>$employees['username'],
                  'txt'=>$employees['designation'],
                  'img'=>$sup_image);
                // $emp_data[]=$employees;
                }
                else{

                }
            }

    }

       $filePath= $_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$result['supervisor_info']->img_path.'.jpg';
        if(file_exists($filePath)){
             $image='../ID_card_photo/'.$result['supervisor_info']->img_path.'.jpg';
        }
        else{
            $image='../ID_card_photo/dummy.png';
        }
       //supervisor wise
       $emp_data[]=array('id'=>$result['supervisor_info']->empID,
                         'pid'=>0,
                         'name'=>$result['supervisor_info']->username,
                         'txt'=>$result['supervisor_info']->designation,
                         'img'=>$image);

        //superwisor wise
        foreach($result['team_leaders'] as $supervisors){
                        if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$supervisors['img_path'].'.jpg')) {
                            $sup_image='../ID_card_photo/'.$supervisors['img_path'].'.jpg';
                        }
                        else{
                            $sup_image='../ID_card_photo/dummy.png';
                        }

                $emp_data[]=array('id'=>$supervisors['empID'],
                'pid'=>$supervisors['sup_emp_code'],
                'name'=>$supervisors['username'],
                'txt'=>$supervisors['designation'],
                'img'=>$sup_image);
        }

       //superwisor wise
       foreach($result['supervisors'] as $supervisors){
                    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$supervisors['img_path'].'.jpg')) {
                        $sup_image='../ID_card_photo/'.$supervisors['img_path'].'.jpg';
                    }
                    else{
                        $sup_image='../ID_card_photo/dummy.png';
                    }
                    $emp_data[]=array('id'=>$supervisors['empID'],
                    'pid'=>$supervisors['sup_emp_code'],
                    'name'=>$supervisors['username'],
                    'txt'=>$supervisors['designation'],
                    'img'=>$sup_image);
            }



        // return view('HRSS.organization_charts')->with('emp_data',$emp_data)->with('supervisors',$result['supervisors']);




    echo json_encode($emp_data);
}
public function organisation_one(Request $request)
{
    $result = $this->cmmrpy->get_organization_info();
    $filePath= $_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$result['reviewer']->img_path.'.jpg';
    if(file_exists($filePath)){
         $image='../ID_card_photo/'.$result['reviewer']->img_path.'.jpg';
    }
    else{
        $image='../media/dummy.png';
    }
   //reviewer wise
   $emp_data[]=array('nodeId'=>$result['reviewer']->empID,
                     'parentNodeId'=>null,
                     'name'=>$result['reviewer']->username,
                     'template'=>$result['reviewer']->designation,
                     'nodeImage'=>$image);

      //superwisor wise
                foreach($result['supervisors'] as $supervisors){
                    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$supervisors['img_path'].'.jpg')) {
                        $sup_image='../ID_card_photo/'.$supervisors['img_path'].'.jpg';
                    }
                    else{
                        $sup_image='../media/dummy.png';
                    }

                    $emp_data[]=array('nodeId'=>$supervisors['empID'],
                    'parentNodeId'=>$supervisors['sup_emp_code'],
                    'name'=>$supervisors['username'],
                    'template'=>$supervisors['designation'],
                    'nodeImage'=>$sup_image);
                    }
                      //teamleader wise
      foreach($result['team_leaders'] as $team_leaders){
        foreach($team_leaders as $leaders){
            if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$leaders['img_path'].'.jpg')) {
                $team_image='../ID_card_photo/'.$leaders['img_path'].'.jpg';
             }
             else{
                $team_image='../media/dummy.png';
             }
            $emp_data[]=array('nodeId'=>$leaders['empID'],
            'parentNodeId'=>$leaders['sup_emp_code'],
            'name'=>$leaders['username'],
            'template'=>$leaders['designation'],
            'nodeImage'=>$team_image);
        }
}
foreach($result['employees'] as $emp)
{
       foreach($emp as $employees){
            if(count($emp)>0){
                if (file_exists($_SERVER["DOCUMENT_ROOT"].'/ID_card_photo/'.$employees['img_path'].'.jpg')) {
                    $sup_image='../ID_card_photo/'.$employees['img_path'].'.jpg';
                }
                else{
                    $sup_image='../media/dummy.png';
                }
              $emp_data[]=array('nodeId'=>$employees['empID'],
              'parentNodeId'=>$employees['sup_emp_code'],
              'name'=>$employees['username'],
              'template'=>$employees['designation'],
              'nodeImage'=>$sup_image);
            // $emp_data[]=$employees;
            }
            else{

            }
        }

}

     return view('HRSS.organization_charts1')->with('emp_data',$emp_data);
}



//vignesh code for sticky note creation

   public function Sticky_note_create()
   {
       return view('Sticky_notes.Sticky_note_create');
   }
   public function Store_Sticky_Notes(request $request )
   {
        $session_val = Session::get('session_info');
        if($request->color == ''){
           $colour = 'blue';
        }
        else{
            $colour=$request->color;
        }

        $data=array('empID'=>$session_val['empID'],
                    'Notes' =>$request->text,
                    'color'=>$colour);

        //  echo json_encode($data);die();

        $result = $this->cmmrpy->Store_StickyNotes($data);
        if($result){
            $response=array('success'=>1,'message'=>"Note Added Successfully");
        }
        else{
            $response=array('success'=>1,'message'=>"Problem in Adding Note");
        }

        echo json_encode($response);
   }
  //get notes info
   public function Fetch_notes_info()
   {
        $session_val = Session::get('session_info');
        $data=array('empID'=>$session_val['empID']);
        $result = $this->cmmrpy->Fetch_Notes($data);
        $current_date=Carbon::now('Asia/Kolkata');;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $current_date);
        if(request()->ajax())
        {
            return view('Sticky_notes.note-ajax')->with('sticky_note',$result)->with('Time',$date);
        }


   }


   //get notes info id wise
   public function Get_Notes_info_id_wise(request $request)
   {
        $data=array('id'=>$request->id);
        $result = $this->cmmrpy->Fetch_Notes_id_wise($data);
        echo json_encode($result);

   }
   public function Edit_Sticky_Notes(request $request)
   {
        $id=$request->id;
        $current_date=Carbon::now('Asia/Kolkata');;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $current_date);
        $data=array('Notes'=>$request->text,'color'=>$request->color,'updated_at'=>$date);
        $result = $this->cmmrpy->Update_Notes_id_wise($data,$id);
        if($result){
            $response=array('success'=>1,'message'=>"Note Updated Successfully");
        }
        else{
            $response=array('success'=>1,'message'=>"Problem in Adding Note");
        }
        echo json_encode($response);

    }
    public function Destroy_Sticky_note(request $request)
    {
        $id=$request->id;
        $coloumn="id";
        $result = $this->cmmrpy->Delete_Notes_id_wise($coloumn,$id);
        if($result){
            $response=array('success'=>1,'message'=>"Note Deleted Successfully");
        }
        else{
            $response=array('success'=>1,'message'=>"Problem in Deleting Note");
        }
        echo json_encode($response);
    }

    public function User_Activity_signin()
    {
        $session_val = Session::get('session_info');
        $diff_date=Carbon::now('Asia/Kolkata');
        $current_date=Carbon::today()->toDateString();
        $current_time=$diff_date->toTimeString();

         $data=array('empID'=>$session_val['empID'],
                     'current_date'=>$current_date,
                     'sign_in'=>$current_time);

         $result=UserActivityModel::insert($data);
         if($result){
             $response=array('success'=>1,'message'=>'Successfully Signing In');
         }
         else{
            $response=array('success'=>2,'message'=>'Problem in Signing In');
         }

        echo json_encode($response);
    }
    public function User_Activity_signout()
    {
        $session_val = Session::get('session_info');
        $diff_date=Carbon::now('Asia/Kolkata');
        $current_date=Carbon::today()->toDateString();
        $current_time=$diff_date->toTimeString();

        //  $data=array('sign_out'=>$current_time,'status'=>0);
         $where_data=array('current_date'=>Carbon::today()->toDateString(),'empID'=>$session_val['empID']);
         $result=UserActivityModel::where($where_data)->update(['sign_out'=>$current_time,'status'=>'1']);
         if($result){
             $response=array('success'=>1,'message'=>'Successfully Signing Out');
         }
         else{
            $response=array('success'=>2,'message'=>'Problem in Signing Out');
         }
        echo json_encode($response);
    }


public function my_team_tl_info(Request $request){
        $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $result = $this->cmmrpy->my_team_tl_info($id);
         if(sizeof($result)){
        $sup = $result['supervisor'];
        $exp_info = $result['exp'];
           foreach($sup  as $supervisors){
            if ($supervisors['path'] !="") {
                            $sup_image='../uploads/'.$supervisors['path'];
            }else{
                $sup_image='../media/dummy.png';
            }
            if ($supervisors['banner_image'] !="") {
                            $banner_image='../banner/'.$supervisors['banner_image'];
            }else{
                $banner_image='../assets/images/user-card/8.jpg';
            }
            if ($supervisors['skill'] !="") {

                $test=json_decode($supervisors['skill']);
                $skill = implode(" , " ,$test);

            }else{
                $skill ="---";
            }

            $exp_info = [];
            $j=0;
            for ($i=0; $i<=30; $i++) {
                array_push($exp_info, $i);
                $j++;
            }
            $Total = array_sum($exp_info);

               /* foreach ($exp_info as $value) {
                    $sum=0;
                    // echo "<pre>";print_r($value['days']);die;/
                    $sum+=$value;       
                }*/

                // $sum+= $exp_info['days'];

                $emp_data[]=array('id'=>$supervisors['empID'],
                'pid'=>$supervisors['sup_emp_code'],
                'name'=>$supervisors['username'],
                'txt'=>$supervisors['designation'],
                'img'=>$sup_image,
                'banner_img'=>$banner_image,
                'skill'=>$skill,
                'exp'=>$Total,
                );
            }
            $response=array('success'=>1,'message'=>$emp_data);
        }else{
            $response=array('success'=>2,'message'=>"<h3>No Employee Under Your Supervising...</h3>");

        }
    echo json_encode($response);
    }
    public function pms_conformation_sub_naps(Request $request){
        $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $val = $request->input('check1');
        $result = $this->cmmrpy->pms_submit($id,$val);
            // echo "1<pre>";print_r($result);die;
        if($result==""){
            $response=array('success'=>1);
        }
        else{
            $response=array('success'=>2);
        }
        echo json_encode($response);
    }
    public function pms_conformation_sub(Request $request){
        $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $val = $request->input('check');
        $result = $this->cmmrpy->pms_submit($id,$val);
            // echo "1<pre>";print_r($result);die;
        if($result==""){
            $response=array('success'=>1);
        }
        else{
            $response=array('success'=>2);
        }
        echo json_encode($response);
    }
     public function pms_status_popup()
   {
       $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $result = $this->cmmrpy->pms_oneor_not($id);
        // echo "<pre>";print_r($result);die;
        
        echo json_encode($result);

    }
    public function pms_status_popup_naps()
   {
       $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $result = $this->cmmrpy->pms_oneor_not_naps($id);
        // echo "<pre>";print_r($result);die;
        
        echo json_encode($result);

    }
public function remove_display_image()
   {
        $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $result = $this->cmmrpy->delete_pro_img($id);
        // echo "c<pre>";print_r($result);die;
        echo json_encode($result);
    }
    public function remove_slide_pay_doc()
   {
        $session_val = Session::get('session_info');
        $id= $session_val['empID'];
        $result = $this->cmmrpy->delete_other_doc_profile($id,'documents','Payslips');
        // echo "<pre>";print_r($result);die;
        echo json_encode($result);
    }

    
}
