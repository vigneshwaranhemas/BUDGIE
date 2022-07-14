<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Event;
use Auth;

class EventRepositories implements IEventRepositories {
    
   public function add_event_insert($data)
   {
      $response = Event::insertGetId($data);        
      return $response;
   }
   // public function fetch_category_details_all()
   // {      
   //    $response = DB::table("candidate_details")->select('*')
   //                      ->get();
   //    return $response;
   // }
   public function insertEventCode($event_unique_code, $last_inserted_id)
   {
      $response = Event::where('id', $last_inserted_id)
                            ->update([
                                'event_unique_code' => $event_unique_code
                            ]);
      return $response;
   }
   public function fetch_event_filter()
   {      
      if(Auth::user()->role_id === 'RO1'){

         $response = DB::table("events")->select('*')
         ->get();

      }else{

         $logined_empID = Auth::user()->empID;
         $response = DB::table('event_attendees')
                  ->distinct()         
                  ->select('events.*')         
                  ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                  ->where('event_attendees.candidate_name', $logined_empID)
                  ->get();

      }
      
      return $response;
   }
   public function fetch_event_with_filter($data)
   {      
      if(Auth::user()->role_id === 'RO1'){

         if($data['emp_fil'] == "All" && $data['category_filter'] == "All" && $data['event_type_filter'] == "All"){
            $response = DB::table("events")->select('*')->get();
         }elseif($data['emp_fil'] != "All" && $data['category_filter'] != "All" && $data['event_type_filter'] == "All"){
            
            $response = DB::table('event_attendees as ea')
                ->distinct()         
                ->select('e.*')     
                ->join('events as e', 'e.event_unique_code', '=', 'ea.event_id')
                ->where('ea.candidate_name', $data['emp_fil'])
                ->where('e.category_name', $data['category_filter'])
                ->get();
         
         }elseif($data['emp_fil'] == "All" && $data['category_filter'] != "All" && $data['event_type_filter'] != "All"){
            
            $response = DB::table("events")->select('*')->where('category_name', $data['category_filter'])->where('event_type', $data['event_type_filter'])->get();
         
         }elseif($data['emp_fil'] != "All" && $data['category_filter'] == "All" && $data['event_type_filter'] != "All"){
            
            $response = DB::table('event_attendees as ea')
                ->distinct()         
                ->select('e.*')     
                ->join('events as e', 'e.event_unique_code', '=', 'ea.event_id')
                ->where('ea.candidate_name', $data['emp_fil'])
                ->where('e.event_type', $data['event_type_filter'])
                ->get();                
         
         }elseif($data['emp_fil'] != "All" && $data['category_filter'] != "All" && $data['event_type_filter'] != "All"){
            
            $response = DB::table('event_attendees as ea')
                ->distinct()         
                ->select('e.*')     
                ->join('events as e', 'e.event_unique_code', '=', 'ea.event_id')
                ->where('ea.candidate_name', $data['emp_fil'])
                ->where('e.event_type', $data['event_type_filter'])
                ->where('e.category_name', $data['category_filter'])
                ->get();   

         }else{
            
            if($data['emp_fil'] != "All" && $data['category_filter'] == "All" && $data['event_type_filter'] == "All"){

               $response = DB::table('event_attendees as ea')
               ->distinct()         
               ->select('e.*')     
               ->join('events as e', 'e.event_unique_code', '=', 'ea.event_id')
               ->where('ea.candidate_name', $data['emp_fil'])
               ->get();   

            }elseif($data['emp_fil'] == "All" && $data['category_filter'] == "All" && $data['event_type_filter'] != "All"){
               $response = DB::table("events")->select('*')->where('event_type', $data['event_type_filter'])->get();
              
            }elseif($data['emp_fil'] == "All" && $data['category_filter'] != "All" && $data['event_type_filter'] == "All"){
               $response = DB::table("events")->select('*')->where('category_name', $data['category_filter'])->get();
              
            }
         }          
         

      }else{

         $logined_empID = Auth::user()->empID;
         $response = DB::table('event_attendees')
                  ->distinct()         
                  ->select('events.*')         
                  ->join('events', 'event_attendees.event_id', '=', 'events.event_unique_code')
                  ->where('event_attendees.candidate_name', $logined_empID)
                  ->get();

      }
      
      return $response;
   }
   public function fetch_event_edit($id)
   {
      $response = Event::where('id', $id)
                        ->get();
      return $response;

   }   
   public function event_delete($id)
   {
      $response = Event::where('id', $id)
                        ->delete();
      return $response;

   }
   public function event_attendees_get($id)
   {
      $response = DB::table("event_attendees")->where('event_id', $id)->get();
      return $response;

   }
   public function event_attendees_delete($id)
   {
      $response = DB::table("event_attendees")->where('event_id', $id)->delete();
      return $response;

   }
   public function event_update($data)
   {
      $response = Event::where('id', $data['event_update_id'])
                        ->update(array(
                           'event_name' => $data['event_name'],
                           'label_color' => $data['label_color'],
                           'where' => $data['where'],
                           'description' => $data['description'],
                           'start_date_time' => $data['start_date_time'],
                           'end_date_time' => $data['end_date_time'],
                           'date' => $data['date'],
                           'repeat' => $data['repeat'],
                           'repeat_every' => $data['repeat_every'],
                           'repeat_cycles' => $data['repeat_cycles'],
                           'repeat_type' => $data['repeat_type'],
                           'category_name' => $data['category_name'],
                           'event_type' => $data['event_type'],
                           'attendees_filter_op' => $data['attendees_filter_op'],
                           'attendees_filter' => $data['attendees_filter'],
                           'all_filter_attendees' => $data['all_filter_attendees'],
                           'candicate_list' => $data['candicate_list'],
                        ));
      return $response;
   }
   public function event_update_file($data)
   {
      $response = Event::where('id', $data['event_update_id'])
                        ->update(array(
                           'event_name' => $data['event_name'],
                           'label_color' => $data['label_color'],
                           'where' => $data['where'],
                           'description' => $data['description'],
                           'start_date_time' => $data['start_date_time'],
                           'end_date_time' => $data['end_date_time'],
                           'date' => $data['date'],
                           'repeat' => $data['repeat'],
                           'repeat_every' => $data['repeat_every'],
                           'repeat_cycles' => $data['repeat_cycles'],
                           'repeat_type' => $data['repeat_type'],
                           'category_name' => $data['category_name'],
                           'event_type' => $data['event_type'],
                           'attendees_filter_op' => $data['attendees_filter_op'],
                           'attendees_filter' => $data['attendees_filter'],
                           'all_filter_attendees' => $data['all_filter_attendees'],
                           'candicate_list' => $data['candicate_list'],
                           'event_file' => $data['event_file'],
                        ));
      return $response;
   }
   public function attendees_filter($data)
   {
      $response = DB::table("customusers")->select('*')
                     ->where(''.$data['attendees_filter_op'].'', $data['attendees_filter'])
                     ->get();
      return $response;
   }     
   
}


?>
