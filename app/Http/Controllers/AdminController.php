<?php

namespace App\Http\Controllers;

use App\Repositories\IAdminRepository;
use App\Repositories\ICommonRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Auth;
use Session;
use Mail;
use App\Holidays;
use App\state;
use Validator;
use App\Models\UserActivityModel;


class AdminController extends Controller
{
    public function __construct(IAdminRepository $admrpy,ICommonRepositories $cmmrpy)
    {
        // die();
        $this->middleware('is_admin');
        $this->admrpy = $admrpy;
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


    public function birthday_email() {

        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $current = $current_year."-".$current_month."-".$current_date;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$tdy.'%')->get();

        foreach($todays_birthdays as $todays_birthday){

            $data = array(
                'name'=> $todays_birthday->username,
                'to_email'=> $todays_birthday->email,
            );
            Mail::send('mail.birthday-mail', $data, function($message) use ($data) {
                // $message->to($todays_birthday->email)->subject
                //     ('Birthday Mail');
                $message->to($data['to_email'])->subject
                    ('We Wish You A Very Happy Birthday');
                $message->from("hr@hemas.in", 'HEPL - HR Team');
            });

        }

    }
    public function work_anniversay_email() {

        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $current = $current_year."-".$current_month."-".$current_date;

        //Work anniversary
        // $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%%-'.$tdy.'%')->get();

        $tdy_work_anniversary = DB::table('customusers')
                                ->select('*')
                                ->where('doj', 'LIKE', '%%-'.$tdy.'%')
                                ->whereNotIn('doj', [$current])
                                ->get();

        foreach($tdy_work_anniversary as $tdy_work_annu){
            // dd($todays_birthday->empID); 900036 900002

            $doj_year = date("Y", strtotime($tdy_work_annu->doj));
            $total = $current_year - $doj_year;

            if($total != 0){

                $data = array(
                    'name'=> $tdy_work_annu->username,
                    'to_email'=> $tdy_work_annu->email,
            );
                Mail::send('mail.work-anniversary-mail', $data, function($message) use ($data) {
                    // $message->to($tdy_work_annu->email)->subject
                    //     ('Birthday Mail');
                    $message->to($data['to_email'])->subject
                        ('Wish You A Happy Work Anniversary');
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                });

            }

        }

    }

    public function holidays_email() {

        $current_date = date("d");
        $next_date = $current_date + 1;
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $next = $current_year."-".$current_month."-".$next_date;
        // $tomorrow = Carbon::tomorrow('Europe/London');
        $tomorrow = Carbon::tomorrow('Asia/Kolkata');

        $tmw_holidays = DB::table('holiday_states as hs')
                ->distinct()
                ->select('h.*','hs.*')
                ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                ->where('h.date','=', $tomorrow)
                ->get();

        // dd($tmw_holidays);
        $can_info= array();
        $arr_empID= [];

        foreach($tmw_holidays as $data){

           if($data->state_name==""){

           }
           else{

                $can_data_id = DB::table('candidate_contact_information as ca')
                // ->distinct()
                ->select('ca.emp_id')
                // ->join('candidate_contact_information as ca', 'ca.p_State', '=', 'hs.state_name')
                // ->where('ca.p_State','=', "Bihar")
                ->where('ca.p_State','=', $data->state_name)
                ->get();

                foreach($can_data_id as $id){
                    // dd($id->emp_id);
                    if($id->emp_id){
                        // arrary_push($kk, $id->emp_id);

                        $arr_empID[] = $id->emp_id;
                    }
                }

           }

        }

        $h_empID = array_unique($arr_empID);

        foreach($h_empID as $tmw_holiday_emp_id){

            $tmw_holiday_emp_email = DB::table('customusers')
                        ->where('empID', $tmw_holiday_emp_id)
                        // ->where('empID', "900004")
                        ->value('email');

            $state = DB::table('candidate_contact_information')
                        // ->where('emp_id', "900004")
                        ->where('emp_id', $tmw_holiday_emp_id)
                        ->value('p_State');

            $holiday_code = DB::table('holiday_states as hs')
                            ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                            ->where('h.date','=', $tomorrow)
                            ->where('hs.state_name','=', $state)
                            ->value('h.holiday_unique_code');

            $occassion = DB::table('holidays')
                        ->where('holiday_unique_code', $holiday_code)
                        ->value('occassion');

            $description = DB::table('holidays')
                        ->where('holiday_unique_code', $holiday_code)
                        ->value('description');

            $occassion_file = DB::table('holidays')
                        ->where('holiday_unique_code', $holiday_code)
                        ->value('occassion_file');

            $Mail = array(
                'occassion'=> $occassion,
                'description'=> $description,
                'occassion_file'=> $occassion_file,
                'to_mail'=>$tmw_holiday_emp_email
            );

            Mail::send('mail.holiday-mail', $Mail, function ($message) use ($Mail) {
                $message->from("hr@hemas.in", 'HEPL - HR Team');
                $message->to($Mail['to_mail'])->subject('Test mail');
                // $message->to($Mail['to_mail'])->subject('Tomorrow Holidays');
            });


        }

    }

    public function events_email() {

        $current_date = date("d");
        $next_date = $current_date + 1;
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $next = $current_year."-".$current_month."-".$next_date;
        // $tomorrow = Carbon::tomorrow('Europe/London');
        $tomorrow = Carbon::tomorrow('Asia/Kolkata');

        $tmw_events = DB::table('event_attendees as ea')
                    ->distinct()
                    ->select('e.*', 'ea.*')
                    ->join('events as e', 'e.event_unique_code', '=', 'ea.event_id')
                    ->where('e.date','=', $next)
                    ->get();

        foreach($tmw_events as $tmw_event){

            $tmw_event_emp_email = DB::table('customusers')
                        ->where('empID', $tmw_event->candidate_name)
                        // ->where('empID', "900004")
                        ->value('email');

            $Mail = array(
                'event_name'=> $tmw_event->event_name,
                'where'=> $tmw_event->where,
                'event_file'=> $tmw_event->event_file,
                'start_date_time'=> $tmw_event->start_date_time,
                'end_date_time'=> $tmw_event->end_date_time,
                'event_type'=> $tmw_event->event_type,
                'category_name'=> $tmw_event->category_name,
                'to_mail'=>$tmw_event_emp_email
            );

            Mail::send('mail.event-mail', $Mail, function ($message) use ($Mail) {
                $message->from("hr@hemas.in", 'HEPL - HR Team');
                $message->to($Mail['to_mail'])->subject('Test mail');
            });


        }

    }

    public function admin_dashboard()
    {
        //Birthday card
        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        // dd($tdy)
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$tdy.'%')->get();

        //Work anniversary
        $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%'.$tdy.'%')->get();

        //Upcoming holidays
        $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();

        //Upcoming events
        $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('admin.dashboard')->with($data);
    }
    public function admin_goals()
    {
        return view('admin.goals');
    }
    public function admin_add_goal_setting()
    {
        return view('admin.add_goal_setting');
    }
    public function admin_goal_setting()
    {
        return view('admin.goal_setting');
    }
    public function holidays()
    {
        return view('admin.holidays');
    }
    public function events()
    {
        $candicate_details = DB::table('candidate_details')->get();
        $event_categories_data = DB::table('event_categories')->get();
        $event_types_data = DB::table('event_types')->get();
        return view('event-calendar.index', ['candicate_details'=> $candicate_details, 'event_categories_data'=> $event_categories_data, 'event_types_data'=> $event_types_data]);
    }
    public function Hr_SeatingRequest()
    {
         $status=0;
         $seating_info['pending']=$this->admrpy->get_seating_requested($status);
         $status=1;
         $seating_info['completed']=$this->admrpy->get_seating_requested($status);
         return view('admin.SeatingRequest')->with('seating_info',$seating_info);
    }
    public function permission()
    {
        return view('admin.permission');
    }
    public function com_dashboard()
    {
        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $current = $current_year."-".$current_month."-".$current_date;

        $current_date = date("d-m-Y");
        $date = Carbon::createFromFormat('d-m-Y', $current_date);

        //Upcoming holidays
        $logined_empID = Auth::user()->empID;
        $logined_state = DB::table("candidate_contact_information")->where('emp_id', $logined_empID)->value('p_State');

        $upcoming_holidays = DB::table('holiday_states as hs')
                ->distinct()
                ->select('h.*')
                ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                ->where('hs.state_name', $logined_state)
                ->where('h.date','>=', $date)
                ->orderBy('date', 'asc')
                ->limit(2)
                ->get();
        // $upcoming_holidays = DB::table('holidays')->select('*')->where('date', '>=', $date)->limit(2)->get();

        //Upcoming events
        $logined_empid = Auth::user()->empID;
        $upcoming_events = DB::table('event_attendees')
                     ->distinct()
                     ->select('events.*')
                     ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                     ->where('events.start_date_time', '>=', $date)
                     ->where('event_attendees.candidate_name', $logined_empid)
                     ->orderBy('date', 'asc')
                     ->limit(2)
                     ->get();

        // $upcoming_events = DB::table('events')->select('*')->where('start_date_time', '>=', $date)->limit(2)->get();

        $session_val = Session::get('session_info');
        $sess_emp_Id=array('empID'=>$session_val['empID']);
        $diff_date=Carbon::now('Asia/Kolkata');
        $sticky_date = Carbon::createFromFormat('Y-m-d H:i:s', $diff_date);
        $result = $this->cmmrpy->Fetch_Notes($sess_emp_Id);
        $data = [
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
            "stickyNotes"=>$result,
            "Time"=>$sticky_date,
            'User_info'=>$session_val
        ];
        if($session_val['worklocation']=='WFH'){
                $where_data=array('current_date'=>Carbon::today()->toDateString(),'empID'=>$session_val['empID']);
                $attendance_info=UserActivityModel::where($where_data)->get();
                if($attendance_info){
                    $max_id=UserActivityModel::where($where_data)->max('id');
                    $data['attendance_info']=UserActivityModel::where('id',$max_id)->first();

                }
        }
        // echo json_encode($data['attendance_info']);die();
        return view('com_dashboard')->with($data);
    }
    public function fetch_login_profile_image(){

            // dd($todays_birthday->empID); 900036 900002

            $login_id = Auth::user()->empID;
            $profile_images = DB::table('images')->where('emp_id', $login_id)->value('path');

            if(!empty($profile_images)){
                // dd($profile_images);
                $login_profile_image = '<img class="img-fluid rounded-circle db_profile_img" src="../uploads/'.$profile_images.'" alt="user">';

            }else{

                $login_profile_image = '<img class="img-fluid" src="../assets/images/dashboard/user.png" alt="user">';

            }

        return json_encode($login_profile_image);
    }
    public function fetch_tdys_brd_list(){
        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $current = $current_year."-".$current_month."-".$current_date;
        $todays_birthdays = DB::table('customusers')->select('*')->where('dob', 'LIKE', '%%-'.$tdy.'%')->get();

        $html_todays_birthdays = '';

        foreach($todays_birthdays as $todays_birthday){
            // dd($todays_birthday->empID); 900036 900002

            $profile_images = DB::table('images')->where('emp_id', $todays_birthday->empID)->value('path');

            if(!empty($profile_images)){
                // dd($profile_images);
                $html_todays_birthdays .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../uploads/'.$profile_images.'" alt="#"></div>';

            }else{

                if($todays_birthday->gender == "Male"){
                    $html_todays_birthdays .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>';
                }else{
                    $html_todays_birthdays .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/4.jpg" alt="#"></div>';
                }

            }

            $html_todays_birthdays .= '<div class="align-self-center media-body" style="margin-left: 16px;">';
            $html_todays_birthdays .= '<h5 class="mt-0">'.$todays_birthday->username.'</h5>';
            $html_todays_birthdays .= '<p>Happy Birthday "'.$todays_birthday->username.'", Have a great year ahead! <img style="width:34px" src="../assets/images/cupcake.svg" alt="Cupcake" class="img-fluid"></p>';
            $html_todays_birthdays .= '</div>';
            $html_todays_birthdays .= '</li>';
        }
        // dd($html_todays_birthdays);

        return json_encode($html_todays_birthdays);
    }
    public function fetch_tdys_work_annu_list(){

        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        // $tdy = $dt."-".$monthName;
        $tdy = $current_month."-".$current_date;
        $current = $current_year."-".$current_month."-".$current_date;

        //Work anniversary
        // $tdy_work_anniversary = DB::table('customusers')->select('*')->where('doj', 'LIKE', '%%-'.$tdy.'%')->get();

        $tdy_work_anniversary = DB::table('customusers')
                                ->distinct()
                                ->select('*')
                                ->where('doj', 'LIKE', '%%-'.$tdy.'%')
                                ->whereNotIn('doj', [$current])
                                ->get();
        
        $html_tdy_work_annu = '';

        foreach($tdy_work_anniversary as $tdy_work_annu){
            // dd($todays_birthday->empID); 900036 900002

            $doj_year = date("Y", strtotime($tdy_work_annu->doj));
            $total = $current_year - $doj_year;
            if($total != 0){
                $profile_images = DB::table('images')->where('emp_id', $tdy_work_annu->empID)->value('path');

                if(!empty($profile_images)){
                    // dd($profile_images);
                    $html_tdy_work_annu .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../uploads/'.$profile_images.'" alt="#"></div>';

                }else{

                    if($tdy_work_annu->gender == "Male"){
                        $html_tdy_work_annu .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>';
                    }else{
                        $html_tdy_work_annu .= '<li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/4.jpg" alt="#"></div>';
                    }

                }

                $html_tdy_work_annu .= '<div class="align-self-center media-body" style="margin-left: 16px;">';
                $html_tdy_work_annu .= '<h5 class="mt-0">'.$tdy_work_annu->username.'</h5>';
                $html_tdy_work_annu .= '<p>Our congratualations to '.$tdy_work_annu->username.' on completing '.$total.' successful year(s) <img style="width:34px" src="../assets/images/flowers.svg" alt="flowers" class="img-fluid"></p>';
                $html_tdy_work_annu .= '</div>';
                $html_tdy_work_annu .= '</li>';
            }

        }

        return json_encode($html_tdy_work_annu);
    }
    /* role List */
    public function role_list(){
        $get_menu_list_result = $this->admrpy->get_role_list_base( );
        return response()->json( $get_menu_list_result );
    }
    /*menu listing */
    public function menu_listing(Request $req){
        $role_id['role_id'] = $req->role_id;

        $get_menu_result = $this->admrpy->get_menu_list_res($role_id);
         // echo "<pre>";print_r($get_menu_result);die();
        return response()->json( $get_menu_result );
    }
    /*save a menu and sub-menu*/
    public function sub_menu_save_tab(Request $req){

      $data=$req->selected;

        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        $user = DB::table( 'role_permissions' )->where('role', '=', $data[0]['role'])->first();

        // echo json_encode($user);die();

         if ($user === null) {
          foreach ($data as $key => $value) {
             $res_array[]=array("empID"=>$empID,
                                "cdID"=>$cdID,
                                "role"=>$value['role'],
                                "menu"=>$value['menu'],
                                "sub_menu"=>$value['sub_menu'],
                                "subid"=>$value['sub_id'],
                                "view"=>$value['view'],
                                "update"=>$value['update'],
                                "add"=>$value['add'],
                                "delete"=>$value['delete'],);
                        }
                  // echo "1<pre>";print_r($res_array);die();
            $get_menu_result = $this->admrpy->get_submenu_save_res( $res_array);
        }else{
            foreach ($data as $key => $value) {
                $res_array[]=array("empID"=>$empID,
                                "cdID"=>$cdID,
                                "colid"=>$value['colid'],
                                "role"=>$value['role'],
                                "menu"=>$value['menu'],
                               "sub_menu"=>$value['sub_menu'],
                               "subid"=>$value['sub_id'],
                               "view"=>$value['view'],
                               "update"=>$value['update'],
                               "add"=>$value['add'],
                               "delete"=>$value['delete'],);
                        }
                // echo "2<pre>";print_r($res_array);die();
            $get_menu_result = $this->admrpy->get_submenu_update_res( $res_array);
        }

        return response()->json( $data );
    }

    public function business()
    {
        return view('admin.masters.business');
    }
    public function employee_list()
    {
        return view('admin.masters.employee_list');
    }

    public function division()
    {
        return view('admin.masters.division');
    }
    public function function()
    {
        return view('admin.masters.function');
    }
    public function grade()
    {
        return view('admin.masters.grade');
    }
    public function band()
    {
        return view('admin.masters.band');
    }
    public function location()
    {
        return view('admin.masters.location');
    }
    public function blood()
    {
        return view('admin.masters.blood');
    }
    public function roll()
    {
        return view('admin.masters.roll');
    }
    public function department()
    {
        return view('admin.masters.department');
    }
    public function designation_or_position()
    {
        return view('admin.masters.designation_or_position');
    }
    public function client()
    {
        return view('admin.masters.client');
    }
    public function state()
    {
        return view('admin.masters.state');
    }
    public function zone()
    {
        return view('admin.masters.zone');
    }
    public function personnel()
    {
        return view('admin.masters.personnel');
    }
    public function user()
    {
        return view('admin.users');
    }
    public function roles()
    {
        return view('admin.masters.add_roles');
    }
    public function roles_s()
    {
        return view('admin.roll_s');
    }

    // Business Process Start
    public function add_business_unit(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'business_name' => 'required|unique:business_unit',
            ]);

        if($data->passes()){
            $bu_id = 'BU'.((DB::table( 'business_unit' )->max('id')) +1);
            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'bu_id' => $bu_id,
                'business_name' => $req->input('business_name'),
                'status' => "active",
                'created_on' => $today_date,
                'created_by' => $empID
            );

            $add_business_unit_process_result = $this->admrpy->add_business_unit_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_business_unit_database(Request $request)
    {
        if ($request->ajax()) {

            $get_business_unit_database_result = $this->admrpy->get_business_unit_database_data( );


        return DataTables::of($get_business_unit_database_result)
        ->addIndexColumn()


        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

            if($row->status == "active")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="business_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=business_status_process('."'".$row->id."'".',"Inactive");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="business_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';

                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="business_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=business_status_process('."'".$row->id."'".',"active");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="business_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('business');
    }

    public function get_employee_list(Request $request){

        if ($request !="") {
        $input_details = array(
        'status'=>$request->input('status'),
        );
        }
        if ($request->ajax()) {



        $get_employee_list_result = $this->admrpy->get_employee_list( $input_details);



        return DataTables::of($get_employee_list_result)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
        // echo "<pre>";print_r($row);die;
        $btn = '<div class="row"><button class="btn btn-warning" type="button" data-toggle="dropdown" data-toggle="tooltip" data-placement="top" title="Action" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:;" onclick="employee_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Role</a>
        </div> &nbsp;' ;
        $btn .= '<button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Profile" type="button" style="width: 15%;height: 35px;"><a href="can_hr_profile?id='."".$row->id."".'&empID='."".$row->empID."".'" onclick="hr_to_profile('."'".$row->id."'".'); "><i class="pe-7s-id" style="color: #ffffff; margin-left: -5px;"></i></a></button>';
        if ($row->hr_action != 2) {
        $btn .= '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="ID Card Info" type="button" style="width: 15%;height: 35px;margin-top: 5px;"><i class="fa fa-eye" onclick="hr_id_card_ver('."'".$row->id."'".');" style="margin-left: -9px;"></i></button></div>';
        }else{
        $btn .= '<button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="ID Card Info" type="button" style="width: 15%;height: 35px;margin-top: 5px;"><i class="fa fa-eye" onclick="hr_id_card_ver('."'".$row->id."'".');" style="margin-left: -9px;"></i></button></div>';



        }
        return $btn;
        })




        ->rawColumns(['Info','action'])
        ->make(true);
        }
    }

    public function get_business_unit_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_business_unit_details_result = $this->admrpy->get_business_unit_details( $input_details );

        return response()->json( $get_business_unit_details_result );
    }

    public function update_business_unit_details(Request $req){

        $data = Validator::make($req->all(),[
            'business_name' => 'required|unique:business_unit',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'business_name'=>$req->input('business_name'),
            );

            $update_business_unit_details_result = $this->admrpy->update_business_unit_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }


    public function process_business_unit_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),
        );

        $process_business_unit_status_result = $this->admrpy->process_business_unit_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_business_unit_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );
        $process_business_unit_delete_result = $this->admrpy->process_business_unit_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Business Process End

    // Division Process Start
    public function add_division_unit_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'division_name' => 'required|unique:divisions',
            ]);

        if($data->passes()){
            $d_id = 'D'.((DB::table( 'divisions' )->max('id')) +1);
            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'd_id' => $d_id,
                'division_name' => $req->input('division_name'),
                'status' => "active",
                'created_on' => $today_date,
                'created_by' => $empID
            );
            $add_division_unit_process_result = $this->admrpy->add_division_unit_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_division_unit_database(Request $request)
    {
        if ($request->ajax()) {

            $get_division_unit_database_result = $this->admrpy->get_division_unit_database_data( );


        return DataTables::of($get_division_unit_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "active")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="division_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=division_status_process('."'".$row->id."'".',"Inactive");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="division_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';


                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="division_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=division_status_process('."'".$row->id."'".',"active");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="division_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status','action'])
        ->make(true);
        }
        return view('division');
    }

    public function get_division_unit_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_division_unit_details_result = $this->admrpy->get_division_unit_details( $input_details );

        return response()->json( $get_division_unit_details_result );
    }

    public function update_division_details(Request $req){

        $data = Validator::make($req->all(),[
            'division_name' => 'required',
            ]);

        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'division_name'=>$req->input('division_name'),
            );

            $update_division_details_result = $this->admrpy->update_division_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_division_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_division_status_result = $this->admrpy->process_division_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_division_unit_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_division_unit_delete_result = $this->admrpy->process_division_unit_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Division Process End

    // Function Process Start
    public function add_function_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'function_name' => 'required|unique:function_masters',
            ]);

        if($data->passes()){
            $f_id = 'F'.((DB::table( 'function_masters' )->max('id')) +1);
            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'f_id' => $f_id,
                'function_name' => $req->input('function_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID
            );
            $add_function_process_result = $this->admrpy->add_function_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_function_database(Request $request)
    {
        if ($request->ajax()) {

            $get_function_database_result = $this->admrpy->get_function_database_data( );


        return DataTables::of($get_function_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="function_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=function_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="function_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="function_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=function_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="function_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('function');
    }

    public function get_function_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_function_details_result = $this->admrpy->get_function_details( $input_details );

        return response()->json( $get_function_details_result );
    }

    public function update_function_details(Request $req){

        $data = Validator::make($req->all(),[
            'function_name' => 'required|unique:function_masters',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'function_name'=>$req->input('function_name'),
            );

            $update_function_details_result = $this->admrpy->update_function_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_function_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),
        );

        $process_function_status_result = $this->admrpy->process_function_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_function_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_function_delete_result = $this->admrpy->process_function_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Function Process End

    // Grade Process Start
    public function add_grade_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'grade_name' => 'required|unique:grades',
            ]);
        if($data->passes()){
            $g_id = 'G'.((DB::table( 'grades' )->max('id')) +1);
            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'g_id' => $g_id,
                'grade_name' => $req->input('grade_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID
            );
            $add_grade_process_result = $this->admrpy->add_grade_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_grade_database(Request $request)
    {
        if ($request->ajax()) {

            $get_grade_database_result = $this->admrpy->get_grade_database_data( );


        return DataTables::of($get_grade_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="grade_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=grade_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="grade_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="grade_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=grade_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="grade_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('grade');
    }

    public function get_grade_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_grade_details_result = $this->admrpy->get_grade_details( $input_details );

        return response()->json( $get_grade_details_result );
    }

    public function update_grade_details(Request $req){

        $data = Validator::make($req->all(),[
            'grade_name' => 'required|unique:grades',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'grade_name'=>$req->input('grade_name'),
            );

            $update_grade_details_result = $this->admrpy->update_grade_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_grade_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_grade_status_result = $this->admrpy->process_grade_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_grade_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_grade_delete_result = $this->admrpy->process_grade_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Grade Process End

    // Location Process Start
    public function add_location_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'location_name' => 'required|unique:locations',
            ]);
        if($data->passes()){
            $l_id = 'L'.((DB::table( 'locations' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'l_id' => $l_id,
                'location_name' => $req->input('location_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_location_process_result = $this->admrpy->add_location_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_location_database(Request $request)
    {
        if ($request->ajax()) {

            $get_location_database_result = $this->admrpy->get_location_database_data( );


        return DataTables::of($get_location_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="location_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=location_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="location_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="location_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=location_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="location_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('location');
    }

    public function get_location_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_location_details_result = $this->admrpy->get_location_details( $input_details );

        return response()->json( $get_location_details_result );
    }

    public function update_location_details(Request $req){

        $data = Validator::make($req->all(),[
            'location_name' => 'required|unique:locations',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'location_name'=>$req->input('location_name'),
            );

            $update_location_details_result = $this->admrpy->update_location_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_location_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_location_status_result = $this->admrpy->process_location_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_location_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_location_delete_result = $this->admrpy->process_location_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Location Process End

    // Blood Process Start
    public function add_blood_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'blood_group_name' => 'required|unique:blood_groups',
            ]);
        if($data->passes()){

            $bg_id = 'BG'.((DB::table( 'blood_groups' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'bg_id' => $bg_id,
                'blood_group_name' => $req->input('blood_group_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_blood_process_result = $this->admrpy->add_blood_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_blood_database(Request $request)
    {
        if ($request->ajax()) {

            $get_blood_database_result = $this->admrpy->get_blood_database_data( );


        return DataTables::of($get_blood_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="blood_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=blood_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="blood_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="blood_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=blood_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="blood_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('blood');
    }

    public function get_blood_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_blood_details_result = $this->admrpy->get_blood_details( $input_details );

        return response()->json( $get_blood_details_result );
    }

    public function update_blood_details(Request $req){

        $data = Validator::make($req->all(),[
            'blood_group_name' => 'required|unique:blood_groups',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'blood_group_name'=>$req->input('blood_group_name'),
            );

            $update_blood_details_result = $this->admrpy->update_blood_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_blood_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_blood_status_result = $this->admrpy->process_blood_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_blood_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_blood_delete_result = $this->admrpy->process_blood_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Blood Group Process End

    // Roll Process Start
    public function add_roll_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'roll_name' => 'required|unique:rolls',
            ]);
        if($data->passes()){
            $r_id = 'R'.((DB::table( 'rolls' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'r_id' => $r_id,
                'roll_name' => $req->input('roll_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_roll_process_result = $this->admrpy->add_roll_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_roll_database(Request $request)
    {
        if ($request->ajax()) {

            $get_roll_database_result = $this->admrpy->get_roll_database_data( );


        return DataTables::of($get_roll_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="roll_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=roll_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="roll_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="roll_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=roll_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="roll_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('roll');
    }

    public function get_roll_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_roll_details_result = $this->admrpy->get_roll_details( $input_details );

        return response()->json( $get_roll_details_result );
    }

    public function update_roll_details(Request $req){

        $data = Validator::make($req->all(),[
            'roll_name' => 'required|unique:rolls',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'roll_name'=>$req->input('roll_name'),
            );

            $update_roll_details_result = $this->admrpy->update_roll_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_roll_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_roll_status_result = $this->admrpy->process_roll_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_roll_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_roll_delete_result = $this->admrpy->process_roll_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Roll Process End

    // Department Process Start
    public function add_department_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'department_name' => 'required|unique:departments',
            ]);
        if($data->passes()){
            $d_id = 'D'.((DB::table( 'departments' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'd_id' => $d_id,
                'department_name' => $req->input('department_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID
            );
            $add_department_process_result = $this->admrpy->add_department_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_department_database(Request $request)
    {
        if ($request->ajax()) {

            $get_department_database_result = $this->admrpy->get_department_database_data( );


        return DataTables::of($get_department_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="department_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=department_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="department_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="department_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=department_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="department_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('department');
    }

    public function get_department_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_department_details_result = $this->admrpy->get_department_details( $input_details );

        return response()->json( $get_department_details_result );
    }

    public function update_department_details(Request $req){

        $data = Validator::make($req->all(),[
            'department_name' => 'required|unique:departments',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'department_name'=>$req->input('department_name'),
            );
            $update_department_details_result = $this->admrpy->update_department_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_department_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_department_status_result = $this->admrpy->process_department_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_department_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_department_delete_result = $this->admrpy->process_department_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Department Process End

    // Designation Process Start
    public function add_designation_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'designation_name' => 'required|unique:designations',
            ]);
        if($data->passes()){
            $dg_id = 'DG'.((DB::table( 'designations' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'dg_id' => $dg_id,
                'designation_name' => $req->input('designation_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID
            );
            $add_designation_process_result = $this->admrpy->add_designation_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_designation_database(Request $request)
    {
        if ($request->ajax()) {

            $get_designation_database_result = $this->admrpy->get_designation_database_data( );


        return DataTables::of($get_designation_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {


        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="designation_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=designation_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="designation_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="designation_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=designation_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="designation_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('designation_or_position');
    }

    public function get_designation_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_designation_details_result = $this->admrpy->get_designation_details( $input_details );

        return response()->json( $get_designation_details_result );
    }

    public function update_designation_details(Request $req){

        $data = Validator::make($req->all(),[
            'designation_name' => 'required|unique:designations',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'designation_name'=>$req->input('designation_name'),
            );

            $update_designation_details_result = $this->admrpy->update_designation_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_designation_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_designation_status_result = $this->admrpy->process_designation_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_designation_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_designation_delete_result = $this->admrpy->process_designation_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Designation Process End

    // State Process Start
    public function add_state_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'state_name' => 'required|unique:states',
            ]);
        if($data->passes()){
            $s_id = 'S'.((DB::table( 'states' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                's_id' => $s_id,
                'state_name' => $req->input('state_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_state_process_result = $this->admrpy->add_state_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_state_database(Request $request)
    {
        if ($request->ajax()) {

            $get_state_database_result = $this->admrpy->get_state_database_data( );


        return DataTables::of($get_state_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="state_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=state_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="state_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="state_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=state_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="state_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('state');
    }

    public function get_state_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_state_details_result = $this->admrpy->get_state_details( $input_details );

        return response()->json( $get_state_details_result );
    }

    public function update_state_details(Request $req){

        $data = Validator::make($req->all(),[
            'state_name' => 'required|unique:states',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'state_name'=>$req->input('state_name'),
            );

            $update_state_details_result = $this->admrpy->update_state_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_state_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_state_status_result = $this->admrpy->process_state_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_state_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_state_delete_result = $this->admrpy->process_state_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Designation Process End

    // Zone Process Start
    public function add_zone_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'zone_name' => 'required|unique:zones',
            ]);
        if($data->passes()){
            $z_id = 'Z'.((DB::table( 'zones' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'z_id' => $z_id,
                'zone_name' => $req->input('zone_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_zone_process_result = $this->admrpy->add_zone_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_zone_database(Request $request)
    {
        if ($request->ajax()) {

            $get_zone_database_result = $this->admrpy->get_zone_database_data( );


        return DataTables::of($get_zone_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="zone_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=zone_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="zone_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="zone_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=zone_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="zone_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('zone');
    }

    public function get_zone_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_zone_details_result = $this->admrpy->get_zone_details( $input_details );

        return response()->json( $get_zone_details_result );
    }

    public function update_zone_details(Request $req){

        $data = Validator::make($req->all(),[
            'zone_name' => 'required|unique:zones',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'zone_name'=>$req->input('zone_name'),
            );

            $update_zone_details_result = $this->admrpy->update_zone_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_zone_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_zone_status_result = $this->admrpy->process_zone_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_zone_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_zone_delete_result = $this->admrpy->process_zone_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Zone Process End

    // Band Process Start
    public function add_band_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'band_name' => 'required|unique:bands',
            ]);
        if($data->passes()){
            $bn_id = 'BN'.((DB::table( 'bands' )->max('id')) +1);

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'bn_id' => $bn_id,
                'band_name' => $req->input('band_name'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_band_process_result = $this->admrpy->add_band_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_band_database(Request $request)
    {
        if ($request->ajax()) {

            $get_band_database_result = $this->admrpy->get_band_database_data( );


        return DataTables::of($get_band_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="band_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=band_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="band_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="band_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=band_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="band_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('band');
    }

    public function get_band_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_band_details_result = $this->admrpy->get_band_details( $input_details );

        return response()->json( $get_band_details_result );
    }

    public function update_band_details(Request $req){

        $data = Validator::make($req->all(),[
            'band_name' => 'required|unique:bands',
            ]);
        if($data->passes()){
            $input_details = array(
                'id'=>$req->input('id'),
                'band_name'=>$req->input('band_name'),
            );

            $update_band_details_result = $this->admrpy->update_band_details( $input_details );

            $response = 'Updated';
            return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_band_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_band_status_result = $this->admrpy->process_band_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_band_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_band_delete_result = $this->admrpy->process_band_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Band Process End

    // Client Process Start
    public function add_client_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $data = Validator::make($req->all(),[
            'client_name' => 'required|unique:clients',
            'mobile_number' => 'required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
            ],
            ]);
    if($data->passes()){
        $cl_id = 'CL'.((DB::table( 'clients' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'cl_id' => $cl_id,
            'client_name' => $req->input('client_name'),
            'mobile_number' => $req->input('mobile_number'),
            'email' => $req->input('email'),
            'status' => "1",
            'created_on' => $today_date,
            'created_by' => $empID

        );
        $add_client_process_result = $this->admrpy->add_client_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function get_client_database(Request $request)
    {
        if ($request->ajax()) {

            $get_client_database_result = $this->admrpy->get_client_database_data( );


        return DataTables::of($get_client_database_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="client_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=client_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="client_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="client_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=client_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="client_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }

            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('client');
    }

    public function get_client_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_client_details_result = $this->admrpy->get_client_details( $input_details );

        return response()->json( $get_client_details_result );
    }

    public function update_client_details(Request $req){

        $data = Validator::make($req->all(),[
            'client_name' => 'required',
            'mobile_number' => 'required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
            ],
            ]);
    if($data->passes()){
        $input_details = array(
            'id'=>$req->input('id'),
            'client_name'=>$req->input('client_name'),
            'mobile_number'=>$req->input('mobile_number'),
            'email'=>$req->input('email'),
        );

        $update_client_details_result = $this->admrpy->update_client_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
    }

    public function process_client_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_client_status_result = $this->admrpy->process_client_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_client_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_client_delete_result = $this->admrpy->process_client_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }
    // Client Process End

    //image upload
    /*public function storeImage(Request $request)
    {
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];

        $folderPath = public_path('uploads\profile_image');
        // echo "<pre>";print_r($folderPath);
        $this->validate($request, ['picture' => 'mimes:jpeg,png,jpg|max:2048']);
        $picturename = date('mdYHis').uniqid().$request->file('image')->getClientOriginalName();

         $destinationPath =public_path("/uploads");
         $public_path_upload = $request->image->move($destinationPath,$picturename);

        $data =array(
            'name'=>$emp_ID,
            'path'=>$picturename,);
        $insert = DB::table( 'images' )->insert( $data );


    }*/

    public function storeImage(Request $request)
    {
        $session_val = Session::get('session_info');
        $emp_ID = $session_val['empID'];
        $cdID = $session_val['cdID'];

        $folderPath = public_path('uploads/');
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';


        $imageFullPath = $folderPath.$imageName;


        file_put_contents($imageFullPath, $image_base64);
        $user = DB::table( 'images' )->where('emp_id', '=', $emp_ID)->first();

        if ($user === null) {
            $data =array(
            'emp_id'=>$emp_ID,
            'cdID'=>$cdID,
            'path'=>$imageName);
        $insert = DB::table( 'images' )->insert( $data );
        return response()->json(['success'=>'insert']);
        }else{
            $data =array(
            'emp_id'=>$emp_ID,
            'cdID'=>$cdID,
            'path'=>$imageName,);
            $update_role_unit_details_result = $this->admrpy->update_profile_details( $data );
            return response()->json( ['success'=>'update'] );
        }
    }

    /*PreviewImage */
    public function PreviewImage(Request $request){

        $session_val = Session::get('session_info');
        $input_details['cdID'] = $session_val['cdID'];
        $input_details['emp_ID'] = $session_val['empID'];
        $get_profile_info_result = $this->admrpy->get_profile_info( $input_details );
        // echo "33<pre>";print_r($get_profile_info_result['image']);die;

        return response()->json( $get_profile_info_result );

        // return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

     /* insert roles*/
    public function add_roles_process(Request $req)
    {
        $session_val = Session::get('session_info');
        $empID = $session_val['empID'];

        $bu_id = 'RO'.((DB::table( 'roles' )->max('id')) +1);

        $today_date = Carbon::now()->format('Y-m-d');
        $form_data = array(
            'role_id' => $bu_id,
            'name' => $req->input('role_name'),
            'status' => "active",
            'created_on' => $today_date,
            'created_by' => $empID

        );
        // echo '<pre>';print_r($form_data); die;
        $add_roles_unit_process_result = $this->admrpy->add_role_process( $form_data );

        $response = 'success';
        return response()->json( ['response' => $response] );
          echo json_encode($form_data);
    }

    /*role view*/
    public function get_role_data(Request $request)
    {
        if ($request->ajax()) {

            $get_role_data_result = $this->admrpy->get_role_data( );


        return DataTables::of($get_role_data_result)
        ->addIndexColumn()

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result); die();
            if($result == "active")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "Inactive"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

            /*$btn = '<div class="btn-group dropdown m-r-10">
            <button aria-expanded="false" data-toggle="dropdown"
                class="btn btn-default dropdown-toggle waves-effect waves-light"
                type="button"><i class="fa fa-gears "></i></button>
            <ul role="menu" class="dropdown-menu pull-right">
                <li><a href="javascript:;" onclick="role_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
            </ul></div>';*/
            $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="role_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    </div>';
            return $btn;
        })


        ->rawColumns(['status', 'action'])
        ->make(true);
        }
        return view('add_roles');
    }

     public function update_role_unit_details(Request $req){

        $input_details = array(
            'id'=>$req->input('id'),
            'name'=>$req->input('role_name_edit'),
            'status'=>$req->input('role_status_edit'),
        );
        // echo "<pre>";print_r($input_details);die;
        $update_role_unit_details_result = $this->admrpy->update_role_unit_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function get_role_details_pop(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_role_details_result = $this->admrpy->get_role_details_pop( $input_details );

        return response()->json( $get_role_details_result );
    }



    //vignesh code starts here
    //admin Seating Request

    public function Admin_Seating_Allotment(Request $request)
    {
        $id=$request->id;
        $status=$request->status;
        if($status==1){
             $update_data=array('Seating_Request'=>$request->seat_value);
        }
        else{
             $update_data=array('IdCard_status'=>$request->seat_value);
        }
        $response=$this->admrpy->update_seating_status($id,$update_data);
        if($response){
            $result=array('success'=>1,'Message'=>"Status Updated Successfully");
        }
        else{
            $result=array('success'=>1,'Message'=>"Problem in Allot Seating For this Candidate");
        }
        echo json_encode($result);
    }



      //admin seating status update


       public function Seating_Status_update(Request $request)
       {
            $data=$request->empID;
            $update_data=array('status'=>1);
            $result=$this->admrpy->update_candidate_seating_status($data,$update_data);
            if($result)
            {
               $response=array('success'=>1,'message'=>"Status Updated Successfully");
            }
            else{
               $response=array('success'=>2,'message'=>"Problem in Updating Status");
            }
            echo json_encode($response);
         }

    public function get_role_type(Request $request){

        $role_type_res = $this->admrpy->role_type_list();

        return response()->json( $role_type_res );

    }

    public function get_employee_pop(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );
        $employee_list_result = $this->admrpy->employee_list_result( $input_details );

        return response()->json( $employee_list_result );
    }
    public function update_employee_list_pop(Request $req){

        // echo "<pre>";print_r($req->all());die;
        $input_details = array(
            'id'=>$req->input('id'),
            'employe_role'=>$req->input('employe_role'),
            'role_id'=>$req->input('role_id'),
        );

        // echo "<pre>";print_r($input_details);die;
        $update_role_unit_details_result = $this->admrpy->update_employee_type( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    // Company Policy Information Process Start
    public function company_policies()
    {
        return view('admin.masters.company_policies');
    }

     public function add_policy_category_process(Request $req)
     {
        $data = Validator::make($req->all(),[
             'policy_category' => 'required|unique:company_policy_categories',
             ]);
        if($data->passes()){
            $cp_id = 'CP'.((DB::table( 'company_policy_categories' )->max('id')) +1);

            $session_val = Session::get('session_info');
            $empID = $session_val['empID'];

            $today_date = Carbon::now()->format('Y-m-d');
            $form_data = array(
                'cp_id' => $cp_id,
                'policy_category' => $req->input('policy_category'),
                'status' => "1",
                'created_on' => $today_date,
                'created_by' => $empID

            );
            $add_policy_category_process_result = $this->admrpy->add_policy_category_process( $form_data );

            $response = 'success';
            return response()->json( ['response' => $response] );
            echo json_encode($form_data);
        }else{
            return response()->json(['error'=>$data->errors()->toArray()]);
        }
     }

     public function get_policy_category_details(){
        // $input_details = array(
        //     'id'=>$req->input('id'),
        // );

        $get_policy_category_details_result = $this->admrpy->get_policy_category_details();

        return response()->json( $get_policy_category_details_result );
    }
    public function add_policy_information_process(Request $request)
    {
             $file = $request->file('file');
             $filename = time().'_'.$file->getClientOriginalName();
             // File extension
             $extension = $file->getClientOriginalExtension();
             $request->file->move(public_path('company_policy_information'),$filename);
             $session_val = Session::get('session_info');
              $data=array('cp_id'=>$request->policy_category,
                          'policy_category'=>$request->catagory_name,
                          'policy_title'=>$request->policy_title,
                          'policy_description'=>$request->policy_description,
                          'file_upload'=>$filename,
                          'status'=>1,
                          'created_on'=>Carbon::now()->format('Y-m-d'),
                          'created_by'=>$session_val['empID']);

            // echo json_encode($data);

             $Store_Policy_information_result = $this->admrpy->Store_Policy_information($data);
             if($Store_Policy_information_result)
             {
                  $result=array('success'=>1,'message'=>"Company Policy Informations Added Successfully");
             }
             else{
                 $result=array('success'=>2,'message'=>"Problem IN Adding Company Policy Informations");
             }
            echo json_encode($result);

    }

    public function get_company_policy_infomation_database(Request $request)
    {
        if ($request->ajax()) {

            $get_company_policy_infomation_database_result = $this->admrpy->get_company_policy_infomation_database_data( );


        return DataTables::of($get_company_policy_infomation_database_result)
        ->addIndexColumn()

        ->addColumn('file', function($row) {
            $file = $row->file_upload;
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            // echo '<pre>';print_r($ext);die();
            if($ext =="pdf")
                    {
                        $btn = '<a href="../company_policy_information/'.$row->file_upload.'" target="_blank"><button class="btn btn-primary" type="button" style="width: 15%;height: 35px;"><i class="fa fa-download" aria-hidden="true" style="margin-left: -9px;"></i></button></a>';
                    }else if($ext =="doc"){
                        $btn = '<a href="../company_policy_information/'.$row->file_upload.'" download><button class="btn btn-primary" type="button" style="width: 15%;height: 35px;"><i class="fa fa-download" aria-hidden="true" style="margin-left: -9px;"></i></button></a>';
                    }


                return $btn;
            })

        ->addColumn('status', function($row) {
            $btn = '';
            $result =  $row->status;
            // print_r($result);
            // die();
            if($result == "1")
            {
                $btn = '<span class="badge badge-success">Active</span>';
            }elseif($result == "0"){
                $btn = '<span class="badge badge-warning">Inactive</span>';
            }

            return $btn;
        })

        ->addColumn('action', function($row) {

        if($row->status == "1")
                {
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="policy_information_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=policy_information_status_process('."'".$row->id."'".',"0");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="policy_information_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }else{
                    $btn = '<button class="btn btn-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 15%;height: 35px;"><i class="fa fa-gears " style="margin-left: -9px;"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:;" onclick="policy_information_edit_process('."'".$row->id."'".');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick=policy_information_status_process('."'".$row->id."'".',"1");><i class="icon-settings"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" onclick="policy_information_delete_process('."'".$row->id."'".');" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    </div>';
                }


            return $btn;
        })


        ->rawColumns(['file','status','action'])
        ->make(true);
        }
        return view('company_policies');
    }

    public function get_policy_information_details(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $get_policy_information_details_result = $this->admrpy->get_policy_information_details( $input_details );

        return response()->json( $get_policy_information_details_result );
    }

    public function edit_policy_information_details(Request $req){

        $file = $req->file('file_one');
        // echo '1</pre>';print_r($file);die();
        if($file == "")
        {
        // echo '1</pre>';print_r($file);die();

            $input_details = array('id'=>$req->ed_id,
                          'cp_id'=>$req->edit_policy_category,
                          'policy_category'=>$req->catagory_name,
                          'policy_title'=>$req->edit_policy_title,
                          'policy_description'=>$req->edit_policy_description,
                          'file_upload'=>"",
                          );
        }
        else {
            $file = $req->file('file_one');
        $filename = time().'_'.$file->getClientOriginalName();
        // File extension
        $extension = $file->getClientOriginalExtension();
        $req->file_one->move(public_path('company_policy_information'),$filename);

        $input_details = array('id'=>$req->ed_id,
                          'cp_id'=>$req->edit_policy_category,
                          'policy_category'=>$req->catagory_name,
                          'policy_title'=>$req->edit_policy_title,
                          'policy_description'=>$req->edit_policy_description,
                          'file_upload'=>$filename,
                          );
        }
        // echo '</pre>';print_r($input_details);die();

        $edit_policy_information_details_result = $this->admrpy->edit_policy_information_details( $input_details );

        $response = 'Updated';
        return response()->json( ['response' => $response] );
    }

    public function process_policy_information_status(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
            'status'=>$req->input('status'),

        );

        $process_policy_information_status_result = $this->admrpy->process_policy_information_status( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    public function process_policy_information_delete(Request $req){
        $input_details = array(
            'id'=>$req->input('id'),
        );

        $process_policy_information_delete_result = $this->admrpy->process_policy_information_delete( $input_details );

        $response = 'success';
        return response()->json( ['response' => $response] );

    }

    // Company Policy Information Process End

}
