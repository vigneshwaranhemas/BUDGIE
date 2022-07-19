<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use App\Repositories\IProfileRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Validator;

use Session;


class DocumentsController extends Controller
{

     public function __construct(IAdminRepository $admrpy,IProfileRepositories $profrpy)
    {
        $this->admrpy = $admrpy;
        $this->profrpy = $profrpy;
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

    public function store(Request $request){
        
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $cdID = $session_val['cdID'];


        $validator=Validator::make($request->all(),[
                    'passport_photo' => 'required',
                    'Resume' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'Payslips' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'Relieving_letter' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'pan' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'bank_passbook' => 'required',
                    'Vaccination' => 'required',
                    'signature' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'dob_proof' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'blood_grp_proof' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    'aadhaar_card' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    // 'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
                    ], [
                    'passport_photo.required' => 'Passport Size Photograph is required',
                    'Resume.required' => 'Resume is required',
                    'Payslips.required' => 'Payslips is required',
                    'Relieving_letter.required' => 'Relieving Letter is required',
                    'pan.required' => 'Pan is required',
                    'bank_passbook.required' => 'Front Page Of Your Bank Passbook (Or) Cancelled Cheque Leafis required',
                    'Vaccination.required' => 'Vaccination Certificate is required',
                    'signature.required' => 'Signature is required',
                    'dob_proof.required' => 'Date of Birth Proof is required',
                    'blood_grp_proof.required' => 'Blood Group Proof is required',
                    'aadhaar_card.required' => 'Aadhaar Card Proof is required',
                    
                    ]);

        if($validator->passes()){
            $passport_photo = $request->file('passport_photo');
            $Resume = $request->file('Resume');
            $Payslips = $request->file('Payslips');
            $Relieving_letter = $request->file('Relieving_letter');
            $pan = $request->file('pan');
            $bank_passbook = $request->file('bank_passbook');
            $Vaccination = $request->file('Vaccination');
            $signature = $request->file('signature');
            $dob_proof = $request->file('dob_proof');
            $blood_grp_proof = $request->file('blood_grp_proof');
            $aadhaar_card = $request->file('aadhaar_card');

               $destinationPath = public_path('Documents/'); 

               $passport_photo_file = "passport_photo_" . $emp_ID . "." . $passport_photo->getClientOriginalExtension();
               $passport_photo->move($destinationPath, $passport_photo_file);

               $Resume_file = 'Resume_'.$emp_ID . "." . $Resume->getClientOriginalExtension();
               $Resume->move($destinationPath, $Resume_file);

               $Payslips_file = "Payslips_".$emp_ID . "." . $Payslips->getClientOriginalExtension();
               $Payslips->move($destinationPath, $Payslips_file);

               $Relieving_letter_file = "Relieving_letter_" .$emp_ID . "." . $Relieving_letter->getClientOriginalExtension();
               $Relieving_letter->move($destinationPath, $Relieving_letter_file);

               $pan_file = "pan_" .$emp_ID . "." . $pan->getClientOriginalExtension();
               $pan->move($destinationPath, $pan_file);

               $bank_passbook_file = "bank_passbook_".$emp_ID . "." . $bank_passbook->getClientOriginalExtension();
               $bank_passbook->move($destinationPath, $bank_passbook_file);

               $Vaccination_file = "Vaccination_".$emp_ID . "." . $Vaccination->getClientOriginalExtension();
               $Vaccination->move($destinationPath, $Vaccination_file);

               $signature_file = "signature_".$emp_ID . "." . $signature->getClientOriginalExtension();
               $signature->move($destinationPath, $signature_file);

               $dob_proof_file = "dob_proof_".$emp_ID . "." . $dob_proof->getClientOriginalExtension();
               $dob_proof->move($destinationPath, $dob_proof_file);

               $blood_grp_proof_file = "blood_grp_proof_".$emp_ID . "." . $blood_grp_proof->getClientOriginalExtension();
               $blood_grp_proof->move($destinationPath, $blood_grp_proof_file);

                $aadhaar_card_file = "aadhaar_card_".$emp_ID . "." . $aadhaar_card->getClientOriginalExtension();
               $aadhaar_card->move($destinationPath, $aadhaar_card_file);


               $passport_photo_path = "$passport_photo_file";
               $Resume_path = "$Resume_file";
               $Payslips_path = "$Payslips_file";
               $Relieving_letter_path = "$Relieving_letter_file";
               $pan_path = "$pan_file";
               $bank_passbook_path = "$bank_passbook_file";
               $Vaccination_path = "$Vaccination_file";
               $signature_path = "$signature_file";
               $dob_proof_path = "$dob_proof_file";
               $blood_grp_proof_path = "$blood_grp_proof_file";
               $aadhaar_card_proof_path = "$aadhaar_card_file";

                    $data =array(
                            'emp_id'=>$emp_ID,
                            'cdID'=>$cdID,
                            'passport_photo' => $passport_photo_file,
                            'Resume' => $Resume_file,
                            'Payslips' => $Payslips_file,
                            'Relieving_letter' => $Relieving_letter_file,
                            'pan' => $pan_file,
                            'bank_passbook' => $bank_passbook_file,
                            'Vaccination' => $Vaccination_file,
                            'signature' => $signature_file,
                            'dob_proof' => $dob_proof_file,
                            'blood_grp_proof' => $blood_grp_proof_file,
                            'aadhaar_card_proof' => $aadhaar_card_file,
                        );
                $insert = DB::table( 'documents' )->insert( $data );
            
                return response()->json(['response'=>'insert']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);

        }
    }
     public function add_skill_set(Request $request){
        
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        $validator=Validator::make($request->all(),[
                     'username' => 'required',
                     'last_name' => 'required',
                     'blood_gr' => 'required',
                     'gender_emp' => 'required',
                     'dob_emp' => 'required',
                     'marital_status' => 'required',
                     'skill' => 'required',
                     'language' => 'required',
                     'age_can' => 'required',
                     'religion_can' => 'required',
                     'aadhar_number' => 'required',
                     'pan_number' => 'required',
                    ], [
                    'username.required' => 'First Name is Required',                    
                    'last_name.required' => 'Last Name is Required',                    
                    'blood_gr.required' => 'Blood Group is Required',                    
                    'gender_emp.required' => 'Gender is Required',                    
                    'dob_emp.required' => 'Date of Birth is Required',                    
                    'marital_status.required' => 'Marital Statusis Required',                    
                    'skill.required' => 'Skill Set is Required',                    
                    'age_can.required' => 'Language is Required',                    
                    'religion_can.required' => 'Religion is Required',                    
                    'aadhar_number.required' => 'Aadhar Number is Required',                    
                    'pan_number.required' => 'PAN Number is Required',                    
                    ]);

        if($validator->passes()){

                if ($request->input('middle_name') =="") {
                    $middle_name = " ";
                }else{
                    $middle_name = $request->input('middle_name');
                }

                    $data =array(
                            'emp_id'=>$emp_ID,
                            'cdID'=>$cdID,
                            'username'=>$request->input('username'), 
                            'm_name'=>$middle_name, 
                            'l_name'=>$request->input('last_name'), 
                            'blood_grp'=>$request->input('blood_gr'), 
                            'gender'=>$request->input('gender_emp'), 
                            'dob'=>$request->input('dob_emp'), 
                            'sec_dob_emp'=>$request->input('sec_dob_emp'), 
                            'marital_status'=>$request->input('marital_status'), 
                            'skill'=>$request->input('skill'),
                            'skill_secondary'=>$request->input('skill_secondary'),
                            'language'=>$request->input('language'),
                            'age_can'=>$request->input('age_can'),
                            'place_birth_can'=>$request->input('place_birth_can'),
                            'religion_can'=>$request->input('religion_can'),
                            'height_can'=>$request->input('height_can'),
                            'weight_can'=>$request->input('weight_can'),
                            'identification_can'=>$request->input('identification_can'),
                            'habits_status'=>$request->input('habits_status'),
                            'aadhar_number'=>$request->input('aadhar_number'),
                            'pan_number'=>$request->input('pan_number'),
                        );

                    $skill_result = $this->profrpy->update_skill_set( $data );
                    return response()->json(['response'=>'Update']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);

        }
    }
    /*banner image */
    public function profile_banner(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_id"=> $emp_id );
        $get_profile_info_result = $this->profrpy->get_banner_view( $input_details );
        // echo "123<pre>";print_r($get_profile_info_result);die;

        return response()->json( $get_profile_info_result );
    }

    /*Preview documents */
    public function doc_information(Request $request){

        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $input_details = array( "emp_ID" => $emp_ID, );
        $get_information_result = $this->admrpy->get_table('documents', $input_details );
        // echo "string";print_r($get_documents_result);die;
        return response()->json( $get_information_result );  
    }
    public function doc_information_hr(Request $request){

        
        // echo "<pre>";print_r($request->all());die;
        // $emp_ID = $session_val['empID'];
        $input_details = array( "emp_ID" => $request->empID, );
        $get_documents_result = $this->admrpy->get_table('documents', $input_details );
        return response()->json( $get_documents_result );  
    }
/*banner image*/
   public function imageCropPost(Request $request){


    /*$validator=Validator::make($request->all(),[
        'banner_image' => 'required',
        ], [
        'banner_image.required' => 'Baneer Image is required',
        ]);
        if($validator->passes()){*/

            $session_val = Session::get('session_info');
            $emp_id = $session_val['empID'];
            $cdID = $session_val['cdID'];

            $user = DB::table( 'candidate_banner_image' )->where('emp_id', '=', $emp_id)->first();
            // echo "<pre>";print_r($user);die;
             if ($user === null) {

                    $data = $request->image;
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name= 'Ban_'.time().'.png';
                    $path = public_path() . "/banner/" . $image_name;
                    file_put_contents($path, $data);

                            $data =array(
                                'emp_id'=>$emp_id,
                                'cdID'=>$cdID,
                                'banner_image'=>$image_name
                                );
                            // echo "<pre>";print_r($data);die;
                            $insert = DB::table( 'candidate_banner_image' )->insert( $data );
                            return response()->json(['response'=>'insert']);
                        }
            else{
                    $data = $request->image;
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name= 'Ban_'.time().'.png';
                    $path = public_path() . "/banner/" . $image_name;
                    file_put_contents($path, $data);

                            $data =array(
                                'emp_id'=>$emp_id,
                                'cdID'=>$cdID,
                                'banner_image'=>$image_name
                                );
                    // echo "<pre>";print_r($data);die;
                             $update_banner_image_result = $this->profrpy->update_banner_image( $data );
                                return response()->json(['response'=>'Update']);
                        }
                /*}else{
                    return response()->json(['error'=>$validator->errors()->toArray()]);
                    }*/
    }

    /*account info */
    public function profile_account_add(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'acc_name' => 'required',
                    'acc_number' => 'required|numeric',
                    'con_acc_number' => 'required|numeric|same:acc_number',
                    'bank_name' => 'required',
                    'ifsc_code' => 'required',
                    'acc_mobile' => 'required|numeric',
                    'branch_name' => 'required',
                    ], [
                    'acc_name.required' => 'Account Name is required',
                    'acc_number.required' => 'Account Number is required',
                    'con_acc_number.required' => 'Account Number is required not match',
                    'bank_name.required' => 'Bank Name is required',
                    'ifsc_code.required' => 'IFSC Code is required',
                    'acc_mobile.required' => 'Mobile Number is required',
                    'branch_name.required' => 'Branch Name is required',
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_account_information' )->where('emp_id', '=', $emp_ID)->first();
                     // echo "<pre>";print_r($user);die;


        if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'acc_name'=>$request->input('acc_name'),
                        'acc_number'=>$request->input('acc_number'),
                        'con_acc_number'=>$request->input('con_acc_number'),
                        'bank_name'=>$request->input('bank_name'),
                        'ifsc_code'=>$request->input('ifsc_code'),
                        'acc_mobile'=>$request->input('acc_mobile'),
                        'branch_name'=>$request->input('branch_name'),
                        'upi_id'=>$request->input('upi_id'),
                        'uan_num'=>$request->input('uan_num'),
                        );

                    $insert = DB::table( 'candidate_account_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'acc_name'=>$request->input('acc_name'),
                        'acc_number'=>$request->input('acc_number'),
                        'con_acc_number'=>$request->input('con_acc_number'),
                        'bank_name'=>$request->input('bank_name'),
                        'ifsc_code'=>$request->input('ifsc_code'),
                        'acc_mobile'=>$request->input('acc_mobile'),
                        'branch_name'=>$request->input('branch_name'),
                        'upi_id'=>$request->input('upi_id'),
                        'uan_num'=>$request->input('uan_num'),
                        );

                $update_role_unit_details_result = $this->profrpy->update_account_info( $data );
                    return response()->json(['response'=>'Update']);
                }
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

        /*account info */
    public function account_info_get_res(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_ID = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_ID" => $emp_ID );
        $get_account_info_result = $this->profrpy->get_account_info( $input_details );
        
        return response()->json( $get_account_info_result );
        
    }

/*education_info_view*/
     public function education_info_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                    "emp_id"=> $emp_id );
        $education_result = $this->profrpy->education_info( $input_details );
        
        return response()->json( $education_result );
        
    }
    /*education info */
    public function education_information_add(Request $request){

      // echo "<pre>";print_r($request->qualification);die;
        if ($request->qualification =="SSLC" || $request->qualification =="HSC") {
            $validator=Validator::make($request->all(),[
                    'qualification' => 'required',
                    'institute' => 'required',
                    'begin_on' => 'required',
                    'end_on' => 'required',
                    'edu_certificate' => 'required|mimes:csv,txt,pdf|max:2048',
                    'percentage'=>'required|numeric|between:1,100',
                    ], [
                    'qualification.required' => 'Qualification is required',
                    'institute.required' => 'Institute is required',
                    'begin_on.required' => 'Begin On is required',
                    'end_on.required' => 'End On is required',
                    'edu_certificate.required' => 'File is required',
                    'percentage.required' => 'Percentage is required',
                    ]);
        }else{
            $validator=Validator::make($request->all(),[
                    'qualification' => 'required',
                    'institute' => 'required',
                    'begin_on' => 'required',
                    'end_on' => 'required',
                    'edu_certificate' => 'required|mimes:csv,txt,pdf|max:2048',
                    'percentage'=>'required|numeric|between:1,100',
                    'Course' => 'required',
                    ], [
                    'qualification.required' => 'Qualification is required',
                    'institute.required' => 'Institute is required',
                    'begin_on.required' => 'Begin On is required',
                    'end_on.required' => 'End On is required',
                    'edu_certificate.required' => 'File is required',
                    'percentage.required' => 'Percentage is required',
                    'Course.required' => 'Course is required',
                    ]);
        }
            if($validator->passes()){
                $session_val = Session::get('session_info');
                $emp_ID = $session_val['empID'];
                $cdID = $session_val['cdID'];

                $files = $request->file('edu_certificate');
                $destinationPath = public_path('education/'); 
               $profileImage ="edu_certificate". date('YmdHs') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $profileImage);
               $edu_certificate = "$profileImage";

                $begin_on = explode('-', $request->input('begin_on'));
                $edu_start_month = $begin_on[1];
                $edu_start_year = $begin_on[0];
                $end_on = explode('-', $request->input('end_on'));
                $edu_end_month = $end_on[1];
                $edu_end_year = $end_on[0];
                $created_on = date("Y-m-d");
                if ($request->input('Course') == "") {
                    $course="";
                }else{
                    $course=$request->input('Course');
                }
                $data =array(
                    'emp_id'=>$emp_ID,
                    'cdID'=>$cdID,
                    'degree'=>$request->input('qualification'),
                    'university'=>$request->input('institute'),
                    'percentage'=>$request->input('percentage'),
                    'Course'=>$course,
                    'edu_start_month'=>$edu_start_month,
                    'edu_start_year'=>$edu_start_year,
                    'edu_end_month'=>$edu_end_month,
                    'edu_end_year'=>$edu_end_year,
                    'edu_certificate'=>$edu_certificate,
                    'created_on'=>$created_on,
                    // 'skill'=>$skill,
                    );
                // echo"<pre>";print_r($data);die;
                $insert_education_info_result = $this->profrpy->insert_education_info( $data );
                return response()->json(['response'=>'insert']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);
            }
        }

        /*experience info save */
    public function experience_information(Request $request){
        // echo "string";print_r("sadasda");die;

      
            /*$validator=Validator::make($request->all(),[
                    'job_title' => 'required',
                    'cmp_name' => 'required',
                    'exp_begin_on' => 'required',
                    'exp_end_on' => 'required',
                    'exp_file'=> 'required|mimes:csv,txt,pdf|max:2048',
                    ], [
                    'job_title.required' => 'Job Title is required',
                    'cmp_name.required' => 'Company Name is required',
                    'exp_begin_on.required' => 'Begin On is required',
                    'exp_end_on.required' => 'End On is required',
                    'exp_file.required' => 'File required',
                    ]);*/

        if ($request->currently_working ==1) {
            $validator=Validator::make($request->all(),[
                    'job_title' => 'required',
                    'cmp_name' => 'required',
                    'exp_begin_on' => 'required',
                    'exp_file'=> 'required|mimes:csv,txt,pdf|max:2048',
                    ], [
                    'job_title.required' => 'Job Title is required',
                    'cmp_name.required' => 'Company Name is required',
                    'exp_begin_on.required' => 'Begin On is required',
                    'exp_file.required' => 'File required',
                    ]);
        }else{
            $validator=Validator::make($request->all(),[
                    'job_title' => 'required',
                    'cmp_name' => 'required',
                    'exp_begin_on' => 'required',
                    'exp_end_on' => 'required',
                    'exp_file'=> 'required|mimes:csv,txt,pdf|max:2048',
                    ], [
                    'job_title.required' => 'Job Title is required',
                    'cmp_name.required' => 'Company Name is required',
                    'exp_begin_on.required' => 'Begin On is required',
                    'exp_end_on.required' => 'End On is required',
                    'exp_file.required' => 'File required',
                    ]);
            }
                if($validator->passes()){
                $session_val = Session::get('session_info');
                $emp_ID = $session_val['empID'];
                $cdID = $session_val['cdID'];

                $files = $request->file('exp_file');
                $destinationPath = public_path('experience/'); 
               $profileexp ="exp_file". date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $profileexp);
               $exp_file = "$profileexp";

                    // $begin_on = explode('-', $request->input('exp_begin_on'));
                    // $edu_start_month = $begin_on[1];
                    // $edu_start_year = $begin_on[0];
                    // $end_on = explode('-', $request->input('exp_end_on'));
                    // $edu_end_month = $end_on[1];
                    // $edu_end_year = $end_on[0];
                       
                    if ($request->input('exp_end_on')=="") {
                        $exp_end_on = date("Y-m-d");
                    }else{
                        $exp_end_on = $request->input('exp_end_on');
                    }
                   
                    $data =array(
                        'empID'=>$emp_ID,
                        'cdID'=>$cdID,
                        'job_title'=>$request->input('job_title'),
                        'company_name'=>$request->input('cmp_name'),

                        /*'exp_start_month'=>$edu_start_month,
                        'exp_start_year'=>$edu_start_year,
                        'exp_end_month'=>$edu_end_month,
                        'exp_end_year'=>$edu_end_year,*/

                        'exp_start_month'=>$request->input('exp_begin_on'),
                        'exp_end_month'=>$exp_end_on,

                        'certificate'=>$exp_file,
                        );
                // echo "<pre>";print_r($data);die;
                    $insert_education_info_result = $this->profrpy->insert_experience_info( $data );
                    return response()->json(['response'=>'insert']);
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }
        /*experience_info_result*/
    public function experience_info_result(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_id" =>$emp_id );
        $education_result = $this->profrpy->experience_info( $input_details );
        
        return response()->json( $education_result );
        
    }
    public function Contact_info_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID, 
                                   "emp_id" => $emp_id  );
        $Contact_info_result = $this->profrpy->Contact_info( $input_details );
        // echo "<pre>";print_r($Contact_info_result);die;
        return response()->json( $Contact_info_result );
        
    }
    public function Contact_info_view_myteam(Request $request){
        $cdID ="";
        $input_details = array( "cdID" => $cdID, "emp_id" => $request->emp_id  );
        $Contact_info_result = $this->profrpy->Contact_info( $input_details );
        // echo "<pre>";print_r($Contact_info_result);die;
        return response()->json( $Contact_info_result );
        
    }

    /*contact info */
    public function add_contact_info(Request $request){

      
            $validator=Validator::make($request->all(),[
                    'phone_number' => 'required|numeric',
                    'p_email' => 'required',
                    'p_addres' => 'required',
                    'p_State' => 'required',
                    'p_district' => 'required',
                    'p_town' => 'required',
                    'c_addres' => 'required',
                    'c_State' => 'required',
                    'c_district' => 'required',
                    'c_town' => 'required',
                    'p_pin' => 'required',
                    'c_pin' => 'required',
                    
                    ], [
                    'phone_number.required' => 'Phone Number is required',
                    'p_email.required' => 'Email is required',
                    'p_addres.required' => 'Permanent Address is required',
                    'p_State.required' => 'Permanent State is required',
                    'p_district.required' => 'Permanent District is required',
                    'p_town.required' => 'Permanent Town is required',
                    'c_addres.required' => 'Present Address is required',
                    'c_State.required' => 'Present State is required',
                    'c_district.required' => 'Present District is required',
                    'c_town.required' => 'Present Town is required',
                    'p_pin.required' => 'Permanent Pin/Zip code is required',
                    'c_pin.required' => 'Present Pin/Zip code is required',
                    
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_id = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_contact_information' )->where('emp_id', '=', $emp_id)->first();

                     // echo "<pre>";print_r($user);die;
            if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_id,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        'p_pin'=>$request->input('p_pin'),
                        'c_pin'=>$request->input('c_pin'),
                        // 'State'=>$request->input('State'),
                        );

                    $insert = DB::table( 'candidate_contact_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_id,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        'p_pin'=>$request->input('p_pin'),
                        'c_pin'=>$request->input('c_pin'),
                        // 'State'=>$request->input('State'),
                        );
                $update_role_unit_details_result = $this->profrpy->update_contact( $data );
                    return response()->json(['response'=>'Update']);
                }
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

/*family info */
     public function family_information_view(Request $request){

        $session_val = Session::get('session_info');
        $cdID = $session_val['cdID'];
        $emp_id = $session_val['empID'];
        $input_details = array( "cdID" => $cdID,
                                "emp_id" =>$emp_id );
        $education_result = $this->profrpy->family_info( $input_details );
        
        return response()->json( $education_result );
        
    }

    public function add_family_add(Request $request){      
            $validator=Validator::make($request->all(),[
                    'fm_name' => 'required',
                    'fm_gender' => 'required',
                    'fn_relationship' => 'required',
                    'fn_marital' => 'required',
                    'fn_blood_gr' => 'required',
                    
                    ], [
                    'fm_name.required' => 'Name is required',
                    'fm_gender.required' => 'Gender is required',
                    'fn_relationship.required' => 'Relationship is required',
                    'fn_marital.required' => 'Marital Status is required',
                    'fn_blood_gr.required' => 'Blood Group is required',
                    
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_ID = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                    $data =array(
                        'emp_id'=>$emp_ID,
                        'cdID'=>$cdID,
                        'fm_name'=>$request->input('fm_name'),
                        'fm_gender'=>$request->input('fm_gender'),
                        'fn_relationship'=>$request->input('fn_relationship'),
                        'fn_marital'=>$request->input('fn_marital'),
                        'fn_blood_gr'=>$request->input('fn_blood_gr'),
                        );
                    $insert = DB::table( 'candidate_family_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

/*state Get*/
     public function state_get(Request $request){
        // $input_details['town_name']  =  $request->input('town_name');
        $education_result = $this->profrpy->state_listing();
        return response()->json( $education_result );
        
    }
    /*district Get*/
     public function get_district(Request $request){
        $input_details['state_name']  =  $request->input('p_State');
        $district_result = $this->profrpy->get_district_listing($input_details);
        
        return response()->json( $district_result );
        
    }
    /*district  curr Get*/
     public function get_district_cur(Request $request){
        $input_details['state_name']  =  $request->input('c_State');
        $district_result = $this->profrpy->get_district_listing($input_details);
        // echo "<pre>";print_r($district_result);die;
        return response()->json( $district_result );
        
    }
    /*town Get*/
     public function get_town_name(Request $request){
        $input_details['district_name']  =  $request->input('p_district');
        // echo "<pre>";print_r($input_details);die;
        $district_result = $this->profrpy->get_town_name_listing( $input_details);
        
        return response()->json( $district_result );
        
    }
    /*town curr Get*/
     public function get_town_name_curr(Request $request){
        $input_details['district_name']  =  $request->input('c_district');
        $district_result = $this->profrpy->get_town_name_listing( $input_details);
        
        return response()->json( $district_result );
        
    }
public function add_skill_set_hr_sd(Request $request){
        
        // echo "<pre>";print_r($request->all());die;
       
        $validator=Validator::make($request->all(),[
                     'username' => 'required',
                     'last_name' => 'required',
                     'blood_gr' => 'required',
                     'gender_emp' => 'required',
                     'dob_emp' => 'required',
                     'marital_status' => 'required',
                     'skill' => 'required',
                     'language' => 'required',
                     'age_can' => 'required',
                     'religion_can' => 'required',
                    ], [
                    'username.required' => 'First Name is Required',                    
                    'last_name.required' => 'Last Name is Required',                    
                    'blood_gr.required' => 'Blood Group is Required',                    
                    'gender_emp.required' => 'Gender is Required',                    
                    'dob_emp.required' => 'Date of Birth is Required',                    
                    'marital_status.required' => 'Marital Statusis Required',                    
                    'skill.required' => 'Skill Set is Required',                    
                    'age_can.required' => 'Language is Required',                    
                    'religion_can.required' => 'Religion is Required',                    
                    ]);

        if($validator->passes()){
                    $data =array(
                            'emp_id'=>$request->input('emp_id'),
                            'username'=>$request->input('username'), 
                            'm_name'=>$request->input('middle_name'), 
                            'l_name'=>$request->input('last_name'), 
                            'blood_grp'=>$request->input('blood_gr'), 
                            'gender'=>$request->input('gender_emp'), 
                            'dob'=>$request->input('dob_emp'), 
                            'sec_dob_emp'=>$request->input('sec_dob_emp'), 
                            'marital_status'=>$request->input('marital_status'), 
                            'skill'=>$request->input('skill'),
                            'skill_secondary'=>$request->input('skill_secondary'),
                            'language'=>$request->input('language'),
                            'age_can'=>$request->input('age_can'),
                            'place_birth_can'=>$request->input('place_birth_can'),
                            'religion_can'=>$request->input('religion_can'),
                            'height_can'=>$request->input('height_can'),
                            'weight_can'=>$request->input('weight_can'),
                            'identification_can'=>$request->input('identification_can'),
                            'habits_status'=>$request->input('habits_status'),
                        );

                    $skill_result = $this->profrpy->update_skill_set( $data );
                    return response()->json(['response'=>'Update']);
        }else{
            return response()->json(['error'=>$validator->errors()->toArray()]);

        }
    }



public function tag_iput_val(Request $request){

        $input_details['emp_ID'] = $request->empID;
        // echo "33<pre>";print_r($input_details);die;
        $get_profile_info_result = $this->admrpy->get_profile_info_hr( $input_details );

        return response()->json( $get_profile_info_result );

        // return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

/*contact info */
    public function hr_update_contact_info(Request $request){

      // echo "33<pre>";print_r($request->all);die;
            $validator=Validator::make($request->all(),[
                    'phone_number' => 'required|numeric',
                    'p_email' => 'required',
                    'p_addres' => 'required',
                    'p_State' => 'required',
                    'p_district' => 'required',
                    'p_town' => 'required',
                    'c_addres' => 'required',
                    'c_State' => 'required',
                    'c_district' => 'required',
                    'c_town' => 'required',
                    'p_pin' => 'required',
                    'c_pin' => 'required',
                    
                    ], [
                    'phone_number.required' => 'Phone Number is required',
                    'p_email.required' => 'Email is required',
                    'p_addres.required' => 'Permanent Address is required',
                    'p_State.required' => 'Permanent State is required',
                    'p_district.required' => 'Permanent District is required',
                    'p_town.required' => 'Permanent Town is required',
                    'c_addres.required' => 'Present Address is required',
                    'c_State.required' => 'Present State is required',
                    'c_district.required' => 'Present District is required',
                    'c_town.required' => 'Present Town is required',
                    'p_pin.required' => 'Permanent Pin/Zip code is required',
                    'c_pin.required' => 'Present Pin/Zip code is required',
                    
                    ]);
                    if($validator->passes()){

                     $session_val = Session::get('session_info');
                    $emp_id = $session_val['empID'];
                    $cdID = $session_val['cdID'];

                     $user = DB::table( 'candidate_contact_information' )->where('emp_id', '=', $emp_id)->first();

                     // echo "<pre>";print_r($user);die;
            if ($user === null) {
                    $data =array(
                        'emp_id'=>$emp_id,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        'p_pin'=>$request->input('p_pin'),
                        'c_pin'=>$request->input('c_pin'),
                        // 'State'=>$request->input('State'),
                        );

                    $insert = DB::table( 'candidate_contact_information' )->insert( $data );
                    return response()->json(['response'=>'insert']);
                }else{
                    $data =array(
                        'emp_id'=>$emp_id,
                        'cdID'=>$cdID,
                        'phone_number'=>$request->input('phone_number'),
                        's_number'=>$request->input('s_number'),
                        'p_addres'=>$request->input('p_addres'),
                        'p_town'=>$request->input('p_town'),
                        'p_State'=>$request->input('p_State'),
                        'p_district'=>$request->input('p_district'),
                        'c_addres'=>$request->input('c_addres'),
                        'c_town'=>$request->input('c_town'),
                        'c_State'=>$request->input('c_State'),
                        'c_district'=>$request->input('c_district'),
                        'p_email'=>$request->input('p_email'),
                        'p_pin'=>$request->input('p_pin'),
                        'c_pin'=>$request->input('c_pin'),
                        // 'State'=>$request->input('State'),
                        );
                $update_role_unit_details_result = $this->profrpy->update_contact( $data );
                    return response()->json(['response'=>'Update']);
                }
            }
            else{
                return response()->json(['error'=>$validator->errors()->toArray()]);
                }
        }

    public function Contact_info_hr_get(Request $request){

        $emp_id = $request->empID;
        $input_details = array("emp_id" => $emp_id  );
        $Contact_info_result = $this->profrpy->Contact_hr_info( $input_details );
        return response()->json( $Contact_info_result );
        
    }
    public function get_qualification_list(Request $request){
        $qualification_list_result = $this->profrpy->get_qualification();
        return response()->json( $qualification_list_result ); 
    }
    public function get_course(Request $request){
        $qualification_val = $request->qualificationVal;
        $input_details = array("qualification" => $qualification_val  );
        $course_list_result = $this->profrpy->get_course_val($input_details);
        return response()->json( $course_list_result ); 
    }
public function hr_information_save(Request $request){
    $dep_old_res = DB::table("customusers")
                            ->select('department','designation','sup_name','reviewer_name')
                            ->where('empID', $request->emp_id)
                            ->get();

    if ($request->Reporting_val != $dep_old_res[0]->sup_name && $request->reviewer_val != $dep_old_res[0]->reviewer_name) {
         $input_details = array('Department' => $dep_old_res[0]->department,
                                'Designation'=> $dep_old_res[0]->designation,
                                'emp_id'=> $request->emp_id,
                                'sup_name'=> $request->Reporting_val,
                                'reviewer_name'=> $request->reviewer_val,
                            );
        $sup_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
    }
    if ($request->Reporting_val != $dep_old_res[0]->sup_name && $request->reviewer_val == $dep_old_res[0]->reviewer_name) {
         $input_details = array('Department' => $dep_old_res[0]->department,
                                'Designation'=> $dep_old_res[0]->designation,
                                'emp_id'=> $request->emp_id,
                                'sup_name'=> $request->Reporting_val,
                                'reviewer_name'=> $dep_old_res[0]->reviewer_name,
                            );
        $sup_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
    }
    if ($request->reviewer_val != $dep_old_res[0]->reviewer_name && $request->Reporting_val == $dep_old_res[0]->sup_name) {
         $input_details = array('Department' => $dep_old_res[0]->department,
                                'Designation'=> $dep_old_res[0]->designation,
                                'emp_id'=> $request->emp_id,
                                'sup_name'=> $dep_old_res[0]->sup_name,
                                'reviewer_name'=> $request->reviewer_val,
                            );
         // echo "<pre>";print_r($input_details);       die; 
        $sup_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
    }

    $input_details = array("reporting_manager" => $request->reporting_manager,
                           'reviewer'=> $request->reviewer,
                           'emp_id'=> $request->emp_id,
                           'reviewer_val'=> $request->reviewer_val,
                           'Reporting_val'=> $request->Reporting_val, );
    $course_list_result = $this->profrpy->update_reviewer_reporting_mrg($input_details);
    return response()->json(['response'=>'Update'] ); 
}
public function hr_working_information(Request $request){
        $dep_old_res = DB::table("customusers")
                            ->select('department','designation','sup_name','reviewer_name')
                            ->where('empID', $request->emp_id)
                            ->get();
         // echo "<pre>";print_r($dep_old_res[0]->sup_name);       die; 

    if ($request->Department != $dep_old_res[0]->department && $request->Designation != $dep_old_res[0]->designation) {
        $input_details = array('Department' => $request->Department,
                                'Designation'=> $request->Designation,
                                'emp_id'=> $request->emp_id,
                                'sup_name'=> $dep_old_res[0]->sup_name,
                                'reviewer_name'=> $dep_old_res[0]->reviewer_name,
                            );
        $course_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
     }           
     if ($request->Department != $dep_old_res[0]->department && $request->Designation == $dep_old_res[0]->designation) {
        $input_details = array('Department' => $request->Department,
                                'Designation'=> $dep_old_res[0]->designation,
                                'emp_id'=> $request->emp_id,
                                'sup_name'=> $dep_old_res[0]->sup_name,
                                'reviewer_name'=> $dep_old_res[0]->reviewer_name,
                            );
        $course_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
     }

     if ($request->Designation != $dep_old_res[0]->designation && $request->Department == $dep_old_res[0]->department) {
        $input_details = array(
                            'Designation'=> $request->Designation,
                            'Department' => $dep_old_res[0]->department,
                            'emp_id'=> $request->emp_id,
                            'sup_name'=> $dep_old_res[0]->sup_name,
                            'reviewer_name'=> $dep_old_res[0]->reviewer_name,
                            );
        $course_list_result = $this->profrpy->insert_followup_reviewer($input_details,'department_followup_details');
     }

    $input_details = array('Department' => $request->Department,
                           'Designation'=> $request->Designation,
                           'work_location'=> $request->work_location,
                           'doj_pop'=> $request->doj_pop,
                           'intake'=> $request->intake,
                           'CTC'=> $request->CTC,
                           'grade_val'=> $request->grade_val,
                           'rfh'=> $request->rfh,
                           'emp_id'=> $request->emp_id,
                            );
    $course_list_result = $this->profrpy->update_hr_working_information($input_details);
    return response()->json(['response'=>'Update'] ); 
}
/*get employee list*/
    public function get_emp_list(){
        $emp_name_result = $this->profrpy->getemployee_name_list();
        return response()->json( $emp_name_result );
    }
/*get Department list*/
    public function get_Department_list(){
        $data='department';
        $Department_result = $this->profrpy->get_result_data($data);
        return response()->json( $Department_result );
    }
/*get Department list*/
    public function get_Designation(){
        $data='designation';
        $Designation_result = $this->profrpy->get_result_data($data);
        return response()->json( $Designation_result );
    }
/*get work location list*/
    public function get_work_location(){
        $data='worklocation';
        $worklocation_result = $this->profrpy->get_result_data($data);
        return response()->json( $worklocation_result );
    }
/*get grade list*/
    public function get_grade(){
        $grade_result = $this->profrpy->get_grade_data();
        return response()->json( $grade_result );
    }
    /*get followup list*/
    public function followup_information(){
         $session_val = Session::get('session_info');
         $emp_ID = $session_val['empID'];

        $followup_result = $this->profrpy->followup_information_data($emp_ID);
        return response()->json( $followup_result );
    }

}
