<?php

namespace App\Http\Controllers;

use App\Repositories\IHolidayRepository;
use App\Repositories\ICommonRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Session;


class BirthdayController extends Controller
{
    public function __construct(IHolidayRepository $holiday,ICommonRepositories $cmmrpy)
    {
        $this->middleware('is_admin');
        $this->holiday = $holiday;
        $this->cmmrpy = $cmmrpy;
        $this->middleware(function($request,$next){
              $session_val=Session::get('session_info');
              if($session_val=="" || $session_val === null){
                $login_access_logout=$this->cmmrpy->login_access_update_logout();
                  return redirect('login');
              }
              else{
               return $next($request);                
              }
        });
    } 

    public function birthdays()
    {  
        $customusers = DB::table('customusers')
                     ->get();
        $data = [
            "customusers" => $customusers,        
        ];        
        return view('birthday.birthday')->with($data);
    }
    public function fetch_birthdays_list(Request $request)
    {        

        $current_month = date("m");
        $current_year = date("Y");

        if($request->employee != ""){
            // dd($request->employee);
            $birthdaysFilter = DB::table('customusers')->select('*')->where('empID', $request->employee)->get();        

        }else{
            // dd("null");
            $birthdaysFilter = DB::table('customusers')->select('*')->get();        

        }

        // $birthdaysFilter = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'-%%')->get();        
        // dd(count($birthdaysFilter));
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);

    }
    public function fetch_birthdays_list_date(Request $request)
    {
        $dt = $request['date'];
        $current_month = date("m", strtotime($dt));
        $current_year = date("Y", strtotime($dt));

        // $birthdaysFilter = DB::table('divya_sample')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'-%%')->get();

        $birthdaysFilter = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$current_month.'%')->get();        
                 
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);    
    }
    public function fetch_birthdays_filter_user(Request $request)
    {
        $emp_id = $request['value'];

        $dt = $request['date'];
        $current_month = date("m", strtotime($dt));
        $current_year = date("Y", strtotime($dt));

        $birthdaysFilter = DB::table('customusers')->select('*')->where('empID', $emp_id)->get();        
                 
        $birthdays_list = array();

        foreach ($birthdaysFilter as $key => $value) {
            
            $dob = $value->dob;            
            $dt = date("d", strtotime($dob));
            $month = date("m", strtotime($dob));
            $birthdays_date = $current_year."-".$month."-".$dt;

            $birthdays_list[] = [

                'id' => $value->id,
                'title' => $value->username,
                'empID' => $value->empID,
                'start' => $birthdays_date,                 
                'view' => $value->id              
                                  
            ];

        }

        return response($birthdays_list);    
    }
    public function fetch_birthdays_list_empID(Request $request)
    {
        $empID = $request['empID'];
        $holidays_list = DB::table('customusers')
                    ->where('empID', $empID)
                    ->get();

        // $holidays_list = DB::table('customusers as c')
        //         ->distinct()         
        //         ->select('customusers.*, images.*')         
        //         ->join('images as img', 'images.emp_id', '=', 'customusers.empID')
        //         ->where('customusers.empID', $empID)
        //         ->orwhere('images.emp_id', $empID)
        //         ->get();

        return response($holidays_list);               
    }

    public function fetch_birthdays_list_img(Request $request)
    {
        $employee = $request->input('employee');

        $profile_images = DB::table('images')->where('emp_id', $employee)->value('path');
        $gender = DB::table('customusers')->where('empID', $employee)->value('gender');
     
        if(!empty($profile_images)){
           $response = '<img class="img-50 user-image rounded-circle" src="../uploads/'.$profile_images.'" alt="#">';
        }else{
     
           if($gender == "Male"){
              $response = '<img style="width:50px;height:50px" class="rounded-circle" src="../assets/images/user/1.jpg" alt="">';
           }else{
              $response = '<img style="width:50px;height:50px" class="rounded-circle" src="../assets/images/user/4.jpg" alt="">';
           }
     
        }
    
        return json_encode($response);

    }   

}
