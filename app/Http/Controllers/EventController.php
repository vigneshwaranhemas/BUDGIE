<?php

namespace App\Http\Controllers;

use App\Repositories\IEventRepositories;
use Illuminate\Http\Request;
use App\Event;
use App\EventAttendee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Session;


class EventController extends Controller
{

    public $event;

    public function __construct(IEventRepositories $event)
    {
        $this->middleware('is_admin');
        $this->event = $event;  
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

    public function events()
    {                     
        $customuser_details = DB::table('customusers')->get();
        $event_categories_data = DB::table('event_categories')->get();
        $event_types = DB::table('event_types')->get();
        $event_types_data = DB::table('event_types')->get();
        $departments = DB::table('departments')->get();
        $designations = DB::table('designations')->get();
        $locations = DB::table('locations')->get();

        $data = [
            "customuser_details" => $customuser_details,
            "event_categories_data" => $event_categories_data,
            "event_types" => $event_types,
            "event_types_data" => $event_types_data,
            "departments" => $departments,
            "designations" => $designations,
            "locations" => $locations,
        ];
        return view('event-calendar.index')->with($data);

        // return view('event-calendar.index', ['customuser_details'=> $customuser_details, 'event_categories_data'=> $event_categories_data, 'event_types_data'=> $event_types_data]);    
    }
    public function test(Request $request)
    {
        // dd($request->file('file'));

        // $request->validate([
        //   'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $image = new Image;

        // if ($request->file('file')) {
        //     $imagePath = $request->file('file');
        //     $imageName = $imagePath->getClientOriginalName();

        //     $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        // }

        // $image->name = $imageName;
        // $image->path = '/storage/'.$path;
        // $image->save();

        // return response()->json('Image uploaded successfully');
    }

    public function add_new_event_insert(Request $request)
    {                
        if($request->start_date == $request->end_date && $request->start_time == $request->end_time){

            if($request->attendees_all_filter || $request->candicate_list){
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    // 'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required|different:start_time', 
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }else{
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required|different:start_time',
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }  

        }elseif($request->start_date == $request->end_date && $request->start_time != $request->end_time){

            if($request->attendees_all_filter || $request->candicate_list){
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    // 'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required|different:start_time', 
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }else{
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required|different:start_time',
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }    
        }elseif($request->start_date != $request->end_date && $request->start_time == $request->end_time){
            
            if($request->attendees_all_filter || $request->candicate_list){
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    // 'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required', 
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }else{
                $result = $request->validate([
                    'event_name' => 'required', 
                    'where' => 'required', 
                    'category_name' => 'required', 
                    'event_type' => 'required', 
                    'description' => 'required', 
                    // 'attendees_filter_op' => 'required', 
                    'candicate_list_options' => 'required', 
                    'start_date' => 'required|after_or_equal:today', 
                    'start_time' => 'required', 
                    'end_date' => 'required|after_or_equal:today', 
                    'end_time' => 'required',
                    'file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }    
        }
           
        
        //File upload
        $file = $request->file('file');
        if($file){
            $file_name = $request->file('file')->getClientOriginalName();
            $public_path_upload = $request->file->move(public_path('event_file'), $file_name);                     
        }else {
            $file_name = "";
        }

        //Attendees
        if($request->input('attendees_filter_op') == "Gender"){
            $attendees_filter = $request->input('gender_filter_option');
        }elseif($request->input('attendees_filter_op') == "Department"){
            $attendees_filter = $request->input('dept_filter_option');
        }elseif($request->input('attendees_filter_op') == "Designation"){
            $attendees_filter = $request->input('designation_filter_option');
        }elseif($request->input('attendees_filter_op') == "Work Location"){
            $attendees_filter = $request->input('wfh_filter_option');
        }else{
            $attendees_filter = "";
        }
        
        if ($request->repeat) {
            $repeat = $request->repeat;
        } else {
            $repeat = 'no';
        }

        //all candicates      
        if($request->candicate_list){    

            $all_candicate_list = "yes";

        }elseif($request->candicate_list_options){
                                   
            $all_candicate_list = "no";

        }else{
            $all_candicate_list = "no";
        }

        //all filter option candicates  
        if($request->attendees_all_filter){        

            $attendees_all_filter = "yes";

        }else{
            $attendees_all_filter = "no";
        }

        $start_date_time = $request->start_date. ' ' .$request->start_time.':00';
        $end_date_time = $request->end_date. ' ' .$request->end_time.':00';
        // $end_date_time = Carbon::createFromFormat("d-m-Y", $request->end_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat("h:i A", $request->end_time)->format('H:i:s');

        $data = array(
            'event_name' => $request->event_name,
            'label_color' => $request->label_color,
            'where' => $request->where,
            'description' => $request->description,
            'start_date_time' => $start_date_time,
            'end_date_time' => $end_date_time,
            'date' => $request->start_date,
            'repeat' => $repeat,
            'repeat_every' => $request->repeat_count,
            'repeat_cycles' => $request->repeat_cycles,
            'repeat_type' => $request->repeat_type,
            'category_name' => $request->category_name,
            'event_type' => $request->event_type,
            'event_unique_code' => "",
            'attendees_filter_op' => $request->attendees_filter_op,
            'attendees_filter' => $attendees_filter,
            'candicate_list' => $all_candicate_list,
            'event_file' => $file_name,
            'all_filter_attendees' => $attendees_all_filter,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $last_inserted_id = $this->event->add_event_insert($data);

        if(!empty($last_inserted_id)){
            $event_code="E00";				
            $event_unique_code = $event_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->event->insertEventCode($event_unique_code, $last_inserted_id);           
        }        

        if ($request->candicate_list) {
            $attendees = DB::table("customusers")->select('*')->get(); // get all the user list
            foreach ($attendees as $attendee) {
                EventAttendee::firstOrCreate(['candidate_name' => $attendee->empID, 'event_id' => $event_unique_code]);
            }
        }

        if($request->attendees_filter_op == "Gender"){
            $op = "gender";
        }elseif($request->attendees_filter_op == "Department"){
            $op = "department";
        }elseif($request->attendees_filter_op == "Designation"){
            $op = "designation";
        }elseif($request->attendees_filter_op == "Work Location"){
            $op = "worklocation";
        }

        if ($request->attendees_all_filter) {
            $attendees = DB::table("customusers")->select('*')->where($op, $attendees_filter)->get(); // get all the user list
            foreach ($attendees as $attendee) {
                EventAttendee::firstOrCreate(['candidate_name' => $attendee->empID, 'event_id' => $event_unique_code]);
            }

        }

        // Select employees
        if ($request->candicate_list_options) {
            foreach ($request->candicate_list_options as $candicateName) {
                // dd($candicateName);
                EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => $event_unique_code]);
            }            
            // $attendees = DB::table("candidate_details")->whereIn('id', $request->candicate_list_options)->get(); // get all the user list
        }

        // if (!$request->has('repeat') || $request->repeat == 'no') {
        //     $event->event_id = $this->googleCalendarEvent($event);
        //     $event->save();
        // }

        return response($result);
        
    }

    public function fetch_all_event(Request $request)
    {

        if (request()->has('emp_fil') && request()->has('category_filter') && request()->has('event_type_filter')) {
            $data = array(
                'emp_fil' => $request->emp_fil,
                'category_filter' => $request->category_filter,
                'event_type_filter' => $request->event_type_filter,
            );
            $eventFilter = $this->event->fetch_event_with_filter($data);              
        }else{
            $eventFilter = $this->event->fetch_event_filter();  
        }


        $event_list = array();

        foreach ($eventFilter as $key => $value) {

            $event_list[] = [

                'id' => $value->id,
                'title' => $value->event_name,
                'view' => $value->id,
                'color' => $value->label_color,
                'category_name' => $value->category_name,
                'start' => $value->start_date_time,
                'end' => $value->end_date_time,      
                                  
            ];

        }

        return $event_list;
               
    }

    public function fetch_event_edit(Request $request)
    {
        $id = $request['id'];
        $fetch_event_edit_list = $this->event->fetch_event_edit($id);  
        return response($fetch_event_edit_list);
        
    }

    public function event_delete(Request $request)
    {
        $id = $request['id'];
        
        $code = DB::table('events')
        ->where('id', $id)
        ->value('event_unique_code');

        $fetch = $this->event->event_attendees_get($code); 

        if($fetch) {
            $this->event->event_attendees_delete($code);  
        }

        $event_deleted = $this->event->event_delete($id);  
        return response($event_deleted);
        
    }    

    public function fetch_event_attendees_list(Request $request)
    {
        $id = $request['id'];   

        $code = DB::table('events')
        ->where('id', $id)
        ->value('event_unique_code');

        $attendees_filter_op = DB::table('events')
        ->where('id', $id)
        ->value('attendees_filter_op');

        $attendees_filter = DB::table('events')
        ->where('id', $id)
        ->value('attendees_filter');

        if($attendees_filter_op == "Gender"){
            $op = "gender";
        }elseif($attendees_filter_op == "Department"){
            $op = "department";            
        }elseif($attendees_filter_op == "Designation"){
            $op = "designation";            
        }elseif($attendees_filter_op == "Work Location"){
            $op = "worklocation";            
        }

        $fetched = DB::table("customusers")->select('*')->where($op, $attendees_filter)->get(); // get all the user list
        
        $output = '<option value="">Select '.$attendees_filter.' List</option>';                       

        foreach ($fetched as $record) {  

           $fetch_selected = DB::table('event_attendees')
            ->where('candidate_name', $record->empID)
            ->where('event_id', $code)
            ->get();

            if(count($fetch_selected) != 0){

                // $name = DB::table('customusers')
                // ->where('empID', $record->candidate_name)
                // ->value('username');

                $output .= '<option value="'.$record->empID.'" selected>'.$record->username.'</option>';                                                                                                      
                
            }
            else{
                $output .= '<option value="'.$record->empID.'">'.$record->username.'</option>';                                                                                                      
            }	       
                        
        }    
		echo json_encode($output);
    }

    public function fetch_event_attendees_show(Request $request)
    {
        $id = $request['id'];   
        
        $code = DB::table('events')
        ->where('id', $id)
        ->value('event_unique_code');

        $fetched = DB::table('event_attendees')
        ->where('event_id', $code)
        ->get();

        $output = '<p><div class="avatar">';                       

        foreach ($fetched as $record) { 

            $name = DB::table('customusers')
                ->where('empID', $record->candidate_name)
                ->value('username');
                
            $profile_images = DB::table('images')->where('emp_id', $record->candidate_name)->value('path');
            $gender = DB::table('customusers')->where('empID', $record->candidate_name)->value('gender');
                    
            if($profile_images){
                $output .= '<img class="img-30 user-image rounded-circle" src="../uploads/'.$profile_images.'" alt="user"><span>'.$name.'</span>';
            }else{
        
                if($gender == "Male"){
                    $output .= '<img class="img-30 rounded-circle" src="../assets/images/user/1.jpg" data-toggle="tooltip"
                    data-original-title="'.$name.'" data-placement="right  alt="user"><span>'.$name.'</span>';
                }else{
                    $output .= '<img class="img-30 rounded-circle" src="../assets/images/user/4.jpg" data-toggle="tooltip"
                    data-original-title="'.$name.'" data-placement="right  alt="user"><span>'.$name.'</span>';
                }
        
            }
                       
        }    

        $output .= '</div></p>';

		echo json_encode($output);
    }

    public function attendees_filter(Request $request)
    {   
        $data = array(
            'attendees_filter' => $request->attendees_filter,
            'attendees_filter_op' => $request->attendees_filter_op,
        );   
        $fetched = $this->event->attendees_filter($data);
        $output = '<option value=""  disabled="disabled">Select '.$request->attendees_filter.' List</option>';                       
        // dd($output);

        foreach ($fetched as $record) { 
            
           $output .= "<option value=".$record->empID.">".$record->username."</option>";

        }    

		echo json_encode($output);
    }

    public function event_update(Request $request)
    {      
        // dd($request->all());

        $id = $request->event_update_id;

        $code = DB::table('events')
        ->where('id', $id)
        ->value('event_unique_code');

        //Attendees
        if($request->input('attendees_filter_op') == "Gender"){
            $attendees_filter = $request->input('gender_filter_option');
            $op = "gender";
        }elseif($request->input('attendees_filter_op') == "Department"){
            $attendees_filter = $request->input('dept_filter_option');
            $op = "department";            
        }elseif($request->input('attendees_filter_op') == "Designation"){
            $attendees_filter = $request->input('designation_filter_option');
            $op = "designation";            
        }elseif($request->input('attendees_filter_op') == "Work Location"){
            $attendees_filter = $request->input('wfh_filter_option');
            $op = "worklocation";            
        }else{
            $attendees_filter = "";
        }

        //Repeat
        if ($request->repeat) {
            $repeat = $request->repeat;
            $repeat_cycles = $request->repeat_cycles;
        } else {
            $repeat = 'no';
            $repeat_cycles = "";
        }

        //All candidate
        if($request->candicate_list){ 
            
            $attendees = DB::table("customusers")->select('*')->get(); // get all the user list

            $response = EventAttendee::where('event_id', $code)->delete();

            foreach ($attendees as $attendee) {

                $response = EventAttendee::firstOrCreate(['candidate_name' => $attendee->empID, 'event_id' => $code]);
            
            }

            $all_candicate_list = "yes";

        }elseif($request->candicate_list_options_edit){
            
            // dd($request->candicate_list_options_edit);
            $response = EventAttendee::where('event_id', $code)->delete();

            foreach($request->candicate_list_options_edit as $candicateName) {
                // dd($candicateName);
                $response = EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => $code]);
            }    

            // dd($response);
            // $json = json_encode($request->candicate_list_options);            
            $all_candicate_list = "no";

        }else{

            $all_candicate_list = "no";

        }

        //All Filter option
        if ($request->attendees_all_filter) {
            $attendees = DB::table("customusers")->select('*')->where($op, $attendees_filter)->get(); // get all the user list
            $response = EventAttendee::where('event_id', $code)->delete();
            foreach ($attendees as $attendee) {
                EventAttendee::firstOrCreate(['candidate_name' => $attendee->empID, 'event_id' => $code]);
            }
            $attendees_all_filter = "yes";

        }else{
            $attendees_all_filter = "no";
        }


        $start_date_time = $request->start_date. ' ' .$request->start_time;
        $end_date_time = $request->end_date. ' ' .$request->end_time;
        // $end_date_time = Carbon::createFromFormat("d-m-Y", $request->end_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat("h:i A", $request->end_time)->format('H:i:s');

        //File upload
        $file = $request->file('file');

        if($file){
            //Got new file
            $file_name = $request->file('file')->getClientOriginalName();
            $public_path_upload = $request->file->move(public_path('event_file'), $file_name);                     
            
            $data = array(
                'event_update_id' => $id,
                'event_name' => $request->event_name,
                'label_color' => $request->label_color,
                'where' => $request->where,
                'description' => $request->description,
                'start_date_time' => $start_date_time,
                'end_date_time' => $end_date_time,
                'date' => $request->start_date,
                'repeat' => $repeat,
                'repeat_every' => $request->repeat_count,
                'repeat_cycles' => $request->repeat_cycles,
                'repeat_type' => $request->repeat_type,
                'category_name' => $request->category_name,
                'event_type' => $request->event_type,
                'candicate_list' => $all_candicate_list,
                'attendees_filter_op' => $request->attendees_filter_op,
                'attendees_filter' => $attendees_filter,
                'all_filter_attendees' => $attendees_all_filter,
                'event_file' => $file_name,

            );

            $result = $this->event->event_update_file($data);      


        }else {

            //No file update
            
            $data = array(
                'event_update_id' => $id,
                'event_name' => $request->event_name,
                'label_color' => $request->label_color,
                'where' => $request->where,
                'description' => $request->description,
                'start_date_time' => $start_date_time,
                'end_date_time' => $end_date_time,
                'date' => $request->start_date,
                'repeat' => $repeat,
                'repeat_every' => $request->repeat_count,
                'repeat_cycles' => $request->repeat_cycles,
                'repeat_type' => $request->repeat_type,
                'category_name' => $request->category_name,
                'event_type' => $request->event_type,
                'candicate_list' => $all_candicate_list,
                'attendees_filter_op' => $request->attendees_filter_op,
                'attendees_filter' => $attendees_filter,
                'all_filter_attendees' => $attendees_all_filter,

            );

            $result = $this->event->event_update($data);     


        }           
        
        //Store event attendees
        // $eventIds [] = $last_inserted_id;

        // $offerData = [
        //     'name' => 'BOGO',
        //     'body' => 'You received an offer.',
        //     'thanks' => 'Thank you',
        //     'offerText' => 'Check out the offer',
        //     'offerUrl' => url('/'),
        //     'offer_id' => 007
        // ];

        // if ($request->candicate_list) {
        //     $attendees = DB::table("candidate_details")->select('*')->get(); // get all the user list
        //     foreach ($attendees as $attendee) {
        //         EventAttendee::firstOrCreate(['candidate_name' => $attendee->candidate_name, 'event_id' => "3"]);
        //     }

        //     // Notification::send($attendees, new OffersNotification($offerData));
        // }

        //Select employees
        // if ($request->candicate_list_options) {
        //     foreach ($request->candicate_list_options as $candicateName) {
        //         // dd($candicateName);
        //         EventAttendee::firstOrCreate(['candidate_name' => $candicateName, 'event_id' => "3"]);
        //     }            
        //     // $attendees = DB::table("candidate_details")->whereIn('id', $request->candicate_list_options)->get(); // get all the user list
        //     // Notification::send($attendees, new EventInvite($event));
        // }

        // if (!$request->has('repeat') || $request->repeat == 'no') {
        //     $event->event_id = $this->googleCalendarEvent($event);
        //     $event->save();
        // }


        return response($result);
        
    }
    
}
