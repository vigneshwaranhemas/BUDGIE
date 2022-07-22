<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\IAdminRepository;
use App\Repositories\IProfileRepositories;
use App\Repositories\ICommonRepositories;
use App\Models\User;
use Session;
use Mail;
use DB;
use Hash;
use Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showForgetPasswordForm(){
         return view('forgetPassword');
      }
      public function login(){
        return view('login');
    }
      public function __construct(IAdminRepository $admrpy,IProfileRepositories $profrpy,ICommonRepositories $cmmrpy){
        $this->admrpy = $admrpy;
        $this->profrpy = $profrpy;
        $this->cmmrpy = $cmmrpy;
    }

    public function login_check_process(Request $req){

        $credentials = [
            'empID' => $req['employee_id'],
            'password' => $req['login_password'],
            'active'=>'1',
        ];
        
        // $login_access=$this->cmmrpy->login_access_status();
        // echo "<pre>";print_r($login_access);die;
        if(auth()->attempt($credentials, true)){
                 $info = [
                'empID' => auth()->user()->empID,
                'cdID' => auth()->user()->cdID,
                'pre_onboarding' =>auth()->user()->pre_onboarding,
                'username' => auth()->user()->username,
                'role_type' => auth()->user()->role_type,
                'role_id' => auth()->user()->role_id,
                'active' => auth()->user()->active,
                'email' => auth()->user()->email,
                'passcode_status'=>auth()->user()->passcode_status,
                'worklocation'=>auth()->user()->worklocation,
                'pms_status'=>auth()->user()->pms_status,
                'pms_eligible_status'=>auth()->user()->pms_eligible_status,
            ];
                
                if(Auth::user()->login_access==0){
                      Session::put("session_info",$info);
                        if($info['passcode_status']==1){
                        $login_access_Data=$this->cmmrpy->login_access_update();
                         return response()->json( ['url'=>url('com_dashboard' ), 'logstatus' => 'success'] );
                        }
                        else if($info['passcode_status']==0){
                        $login_access_Data=$this->cmmrpy->login_access_update();
                         return response()->json( ['url'=>url('change_password' ), 'logstatus' => 'success'] );
                        }   
                }elseif(Auth::user()->login_access==1){
                  return response()->json( ['url'=>url( '../' ), 'logstatus' => 'already_login'] );
                }  
        }
        else{
            return response()->json( ['url'=>url( '../' ), 'logstatus' => 'failed'] );
        }
    }
    public function UserEmailSend()
    {
         $candidate_info=$this->hpreon->get_onboarding_candidate_info();
         $i=0;
         foreach($candidate_info as $candidate)
         {
                $data['candidate_name']=$candidate->candidate_name;
                $data['candidate_mail']=$candidate->candidate_email;
                $subject="Inducation Agenda Mail";
                Mail::send('emails.InductionAgendaMail', $data, function ($message) use ($data,$subject,$i) {
                    $message->from(env('MAIL_FROM_ADDRESS'), 'HEPL - HR Team');

                    $message->to($data['candidate_mail'])->subject($subject);
                    });
                $update_data[]=array("empID"=>$candidate->cdID,"Induction_mail"=>1);
                $i++;
            }
          $response=$this->hpreon->Update_mail_status($update_data);
          if($response){
               echo '<script>toastr.success("Email Send Successfully")</script>';
          }
          else{
            echo '<script>toastr.success("Something Went Wrong Please Try Again Later!....")</script>';
          }
    }

    function getemail_process(Request $request ){

        // echo "s<pre>";print_r($request->input('data'));die;
        $emp_id = $request->input('data');

         $user = DB::table( 'customusers' )->where('empID', '=', $emp_id)->first();

         return response()->json( $user );
    }


    public function submitForgetPasswordForm(Request $request){

         $validator=Validator::make($request->all(),[
              'employee_id' => 'required',
              'emp_email' => 'required'
          ], [
                'employee_id.required' => 'EmployeeID is required',
                'emp_email.required' => 'Employee Email is required',
          ]);
       if($validator->passes()){

        $passcode_token=  base64_encode($request->input('employee_id'));
        $emp_id = $request->input('employee_id');
        $user = DB::table( 'customusers' )->where('empID', '=', $emp_id)->first();

        // echo "22<pre>";print_r($user);die;
           $Mail['candidate_name']=$user->username;
           $Mail['passcode_token']=$passcode_token;
           $Mail['email']= $request->input('emp_email');
           $Mail['subject']="Change Password link ";

           Mail::send('emails.forget_password', $Mail, function ($message) use ($Mail) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    $message->to($Mail['email'])->subject($Mail['subject']);
                    });

          $response = 'Updated';
        return response()->json( ['response' => $response,'url'=>url('/' )] );
    }else{
        return response()->json(['error'=>$validator->errors()->toArray()]);
    }


    }
     public function email_pass($test){
        //  $test="one";
        return view('test_email')->with('test',$test);
    }


    public function con_pass_process(Request $request){

         $validator=Validator::make($request->all(),[
              'new_pass' => 'required',
              'con_pass' => 'required|same:new_pass',
          ], [
                'new_pass.required' => 'Password is required',
                'con_pass.required' => 'Confirm Password is required',
          ]);
       if($validator->passes()){

           $emp_id=  base64_decode($request->input('token'));
           $passcode =  Hash::make($request->input('new_pass'));

            // echo "<pre>";print_r($emp_id);die;

          $data =array(
                    'passcode'=> $passcode,
                    'emp_id'=>$emp_id );

        $update_role_unit_details_result = $this->cmmrpy->update_password( $data );

          $response = 'Updated';
        return response()->json( ['url'=>url('/' ),'response' => $response] );
        }else{
        return response()->json(['error'=>$validator->errors()->toArray()]);
    }

    }
     public function logout(Request $request){
        $login_access_logout=$this->cmmrpy->login_access_update_logout();
        $request->session()->invalidate();
        return redirect('login' );
    }
}
