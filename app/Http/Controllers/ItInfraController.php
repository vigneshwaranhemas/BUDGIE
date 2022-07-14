<?php

namespace App\Http\Controllers;
use App\Repositories\IHrPreonboardingrepositories;
use App\Repositories\IITInfraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Mail;
use Session;

class ItInfraController extends Controller
{
    public function __construct(IHrPreonboardingrepositories $hpreon,IITInfraRepository $itrep)
    {
        $this->hpreon = $hpreon;
        $this->itrep=$itrep;
        $this->middleware('is_admin');
        // $this->middleware('is_itinfra');
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

    public function index()
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

        $data = [
            "todays_birthdays" => $todays_birthdays,
            "tdy_work_anniversary" => $tdy_work_anniversary,
            "upcoming_holidays" => $upcoming_holidays,
            "upcoming_events" => $upcoming_events,
        ];

        return view('ItInfra.dashboard')->with($data);
      }

    public function EmailIdCreation()
    {
        $status=1;
        $email_info['pending']=$this->hpreon->get_hrRequested_info($status);
        $status=2;
        $email_info['completed']=$this->hpreon->get_hrRequested_info($status);
        return view('ItInfra.EmailIdCreation')->with('email_info',$email_info);
    }

    public function ITInfra_Email_Creation(Request $request)
    {

           foreach($request->empID as $data){
                   $candidate_info=$this->itrep->get_candidate_email_info($data);

//-------------------------------------------------------------------------------------------------
//  vignesh code
                   //candidate original email info
//-------------------------------------------------------------------------------------------------

                 $Mail['CC']=$candidate_info['email_info']->cc;
                 $Mail['to']=$candidate_info['email_info']->to;
                 $Mail['supervisor_mail']=$candidate_info['supervisor_info']->email;
                 $Mail['reviewer_mail']=$candidate_info['reviewer_info']->email;
                 $Mail['hr_suggest_email']=$candidate_info['candidate_info']->hr_suggested_mail;
                 $Mail['candidate_email']=$candidate_info['candidate_info']->email;

//--------------------------------------------------------------------------------------------------
//
//         vignesh testing email info
//--------------------------------------------------------------------------------------------------


                //    $Mail['CC']="vigneshsampletester@gmail.com";
                //    $Mail['to']="vigneshb@hemas.in";
                //    $Mail['supervisor_mail']="vigneshb@hemas.in";
                //    $Mail['reviewer_mail']="vigneshb@hemas.in";
                   $Mail['subject']=$candidate_info['email_info']->subject;
                   //hr suggested email
                //    $Mail['hr_suggest_email']=$candidate_info['candidate_info']->hr_suggested_mail;
                   //end

                   //it infra suggested email

                   $Mail['hr_suggest_email']=$data['Email'];


                   //end

                   $Mail['candidate_email']=$candidate_info['candidate_info']->email;
                   $Mail['candidate_name']=$candidate_info['candidate_info']->username;
                   $Mail['supervisor_name']=$candidate_info['candidate_info']->sup_name;
                   $Mail['candidate_position']=$candidate_info['candidate_info']->designation;
                   $Mail['candidate_mobile']=$candidate_info['candidate_info']->contact_no;
                   $Mail['doj']=$candidate_info['candidate_info']->doj;
                   $str_arr=preg_split ("/\,/", $Mail['CC']);
                   $email_updation=$this->itrep->update_itInfra_EmailStatus($data);

                //    dd($Mail);

                   Mail::send('emails.ITInfraNewCandidateJoin', $Mail, function ($message) use ($Mail,$str_arr) {
                    $message->from("hr@hemas.in", 'HEPL - HR Team');
                    foreach($str_arr as $string)
                    {
                        $message->cc($string);
                    }
                    $message->cc($Mail['supervisor_mail']);
                    $message->cc($Mail['reviewer_mail']);
                    $message->to($Mail['to'])->subject($Mail['subject']);
                    });

//---------------------------------------------------------------------------------------------------

           }
        //    echo json_encode($str_arr);
        //   $candidate_info=$this->hpreon->get_candidate_email_info();
        //   $email_updation=$this->hpreon->update_itInfra_EmailStatus($request->empID);
          if($email_updation){
              $response=array('success'=>1,'message'=>"Status Updated Successfully");
          }
          else{
            $response=array('success'=>1,'message'=>"Problem in Updating Status");
          }
        //   return $response;
        echo json_encode($response);
    }


}
