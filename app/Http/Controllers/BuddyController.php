<?php

namespace App\Http\Controllers;
use App\Repositories\IBuddyrepositories;
use App\Repositories\IPreOnboardingrepositories;
use App\Repositories\ICommonRepositories;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class BuddyController extends Controller
{
    private $brep;

    public function __construct(IBuddyrepositories $brep,IPreOnboardingrepositories $preon,ICommonRepositories $cmmrpy){
         $this->brep=$brep;
         $this->preon = $preon;
         $this->cmmrpy = $cmmrpy;
         $this->middleware('is_admin');
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
    public function buddy_dashboard()
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

        return view('buddy.dashboard')->with($data);

    }

    public function buddy_info()
    {
        $sess_info=Session::get("session_info");
        $id=$sess_info["empID"];
        $candidate_info=$this->brep->get_candidate_info($id);
        return view('buddy.index')->with('candidate_info',$candidate_info);
    }



    public function View_Buddy_feedback(Request $request)
  {
      $table="buddyfeedbackfields";
      $id=$request->id;
      $feedback_info=$this->brep->get_feedback_info($id);
      $fields=$this->preon->getonBoardingFields($table);
      $data["fields"]=$fields;
      $data['feedback_info']=$feedback_info;
      echo json_encode($data);
  }

}
