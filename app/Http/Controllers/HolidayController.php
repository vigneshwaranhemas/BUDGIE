<?php

namespace App\Http\Controllers;

use App\Repositories\IHolidayRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\HolidayState; 
use App\Holidays; 
use Session;

class HolidayController extends Controller
{
    public function __construct(IHolidayRepository $holiday)
    {
        $this->middleware('is_admin');
        $this->holiday = $holiday;
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
    public function holidays()
    {
        $stateList = $this->holiday->fetch_state_list();  

        $data = [
            "stateList" => $stateList,
        ];

        return view('holidays.holidays')->with($data);
    }
    public function add_new_holidays_insert(Request $request)
    {         
        if($request->all_state){
            if($request->occassion_file != "undefined"){
                $result = $request->validate([
                    'occassion' => 'required', 
                    'description' => 'required', 
                    'occassion_file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                ]);
            }else{
                $result = $request->validate([
                    'occassion' => 'required', 
                    'description' => 'required', 
                ]);
            }
        }else{
            if($request->occassion_file != "undefined"){
                $result = $request->validate([
                    'occassion' => 'required', 
                    'occassion_file' => 'mimes:png,jpg,jpeg,csv,txt,pdf|max:2048',
                    'description' => 'required', 
                    'state' => 'required', 
                ]);
            }else{
                $result = $request->validate([
                    'occassion' => 'required', 
                    'description' => 'required', 
                    'state' => 'required', 
                ]);
            }
        }   
                
        //File upload
        $file = $request->file('occassion_file');
        if($file){
            $name = $request->file('occassion_file')->getClientOriginalName();
            $public_path_upload = $request->occassion_file->move(public_path('holidays_file'), $name);                     
        }else {
            $name = "";
        }

        $created_by =Auth::user()->empID;

        //All state upload
        if($request->all_state){
            $all_state = "yes";
        }else{
            $all_state = "no";
        }

        //Data upload to server
        $data = array(
            'occassion' => $request->occassion,
            'date' => $request->occassion_date,
            'description' => $request->description,
            'all_state' => $all_state,
            'occassion_file' => $name,
            'created_by' => $created_by
        );

        $last_inserted_id = $this->holiday->add_holidays_insert($data);        
        
        //Holiday code
        if(!empty($last_inserted_id)){
            $holiday_code="H";				
            $holiday_unique_code = $holiday_code."".$last_inserted_id; //T00.13 =T0013
            $result = $this->holiday->insertHolidayCode($holiday_unique_code, $last_inserted_id);           
        }     

        //All state upload
        if($request->all_state){

            $all_state_lists = DB::table("towns_details")->select('state_name')
                ->groupByRaw('state_name')
                ->get();
                
            foreach ($all_state_lists as $all_state) {                
                // dd($all_state);
                $result = HolidayState::firstOrCreate(['state_name' => $all_state->state_name, 'holiday_code' => $holiday_unique_code]);
            }              
        }
        
        //State upload
        if($request->state){
            foreach ($request->state as $state) {
                // dd($state);
                $result = HolidayState::firstOrCreate(['state_name' => $state, 'holiday_code' => $holiday_unique_code]);
            }              
        }

        return response($result);

    }
    public function fetch_holidays_list(Request $request)
    {
        if(!empty($request->input('state'))){
            $state = $request->input('state');
            $holidaysFilter = $this->holiday->fetch_holidays_state_filter($state);  
        }else{
            $holidaysFilter = $this->holiday->fetch_holidays_list();  
        }
        
        $holidays_list = array();

        foreach ($holidaysFilter as $key => $value) {
            
            $holidays_list[] = [

                'id' => $value->id,
                'title' => $value->occassion,
                'start' => $value->date,                 
                'view' => $value->id                  
                // 'start' => "2022-04-03 00:00:00",                 
                // 'end' => "2022-04-03 00:00:00",                 
                                  
            ];

        }

        return response($holidays_list);
               
    }
    public function fetch_holidays_list_id(Request $request)
    {

        $id = $request['id'];
        $holidays_list = $this->holiday->fetch_holidays_list_id($id);          
        return response($holidays_list);               
    }
    public function fetch_holidays_state_id(Request $request)
    {
        $id = $request['id'];
        $holidays_state_list = $this->holiday->fetch_holidays_state_id($id);     
        return json_encode($holidays_state_list);               
    }
    public function fetch_holidays_state_list_id_show(Request $request)
    {
        $id = $request['id'];
        $holidays_state_list_show = $this->holiday->fetch_holidays_state_id_show($id);     
        return json_encode($holidays_state_list_show);               
    }
    public function fetch_holidays_list_date(Request $request)
    {
        $dt = $request['date'];
        $monthName = substr($dt, 0, 3);
        $yr = substr($dt, -4); 

        if($monthName == "Jan"){
            $month = "01";
        }elseif($monthName == "Feb"){
            $month = "02";
        }elseif($monthName == "Mar"){
            $month = "03";
        }elseif($monthName == "Apr"){
            $month = "04";
        }elseif($monthName == "May"){
            $month = "05";
        }elseif($monthName == "Jun"){
            $month = "06";
        }elseif($monthName == "Jul"){
            $month = "07";
        }elseif($monthName == "Aug"){
            $month = "08";
        }elseif($monthName == "Sep"){
            $month = "09";
        }elseif($monthName == "Oct"){
            $month = "10";
        }elseif($monthName == "Nov"){
            $month = "11";
        }elseif($monthName == "Dec"){
            $month = "12";
        }
        
        $filter_date = $yr."-".$month;
        $filter_date = $this->holiday->fetch_holidays_list_date($filter_date);          
        return response($filter_date);               
    }
    public function holidays_update(Request $request)
    {      
        if($request->all_state){
            $result = $request->validate([
                'occassion' => 'required', 
                'description' => 'required', 
            ]);
        }else{
            $result = $request->validate([
                'occassion' => 'required', 
                'description' => 'required', 
                'state' => 'required', 
            ]);
        }       

        //All state upload
        if($request->all_state){
            $all_state = "yes";
        }else{
            $all_state = "no";
        }

        //File upload
        $file = $request->file('occassion_file');

        if($file){
            //Got new file
            $name = $request->file('occassion_file')->getClientOriginalName();
            $public_path_upload = $request->occassion_file->move(public_path('holidays_file'), $name);                     

            $data = array(
                'occassion' => $request->occassion,
                'description' => $request->description,
                'all_state' => $all_state,
                'occassion_file' => $name,
                'id' => $request->id,
            );
            
            $result = $this->holiday->holidays_update_file($data);        


        }else {

            //No file update
            $data = array(
                'occassion' => $request->occassion,
                'description' => $request->description,
                'all_state' => $all_state,
                'id' => $request->id,
            );

            $result = $this->holiday->holidays_update($data);        


        }                

        //All state upload
        
        $holiday_code = Holidays::where('id', $request->id)->value('holiday_unique_code');

        if($request->state){

            $response = HolidayState::where('holiday_code', $holiday_code)->delete();

            foreach ($request->state as $state) {
                // dd($state);
                $result = HolidayState::firstOrCreate(['state_name' => $state, 'holiday_code' => $holiday_code]);
            }              
        }

        if($all_state == "yes"){

            $response = HolidayState::where('holiday_code', $holiday_code)->delete();

            $all_state_lists = DB::table("towns_details")->select('state_name')
                ->groupByRaw('state_name')
                ->get();
                            
            foreach ($all_state_lists as $all_state) {                
                $result = HolidayState::firstOrCreate(['state_name' => $all_state->state_name, 'holiday_code' => $holiday_code]);
            }              
        }                

        return response($result);
        
    }
    public function holidays_delete(Request $request)
    {
        $id = $request['id'];
        $holidays_delete = $this->holiday->holidays_delete($id);  
        return response($holidays_delete);
        
    }
    
}
