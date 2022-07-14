<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\EventType;
use App\Event;

class EventTyperepositories implements IEventTyperepositories {
   //  public function Check_onBoard($table,$test)
   //  {
   //      $response=DB::table($table)->where($test)->get();
   //      return $response;
   //  }
   //  public function getonBoardingFields($table)
   //  {
   //     $response=DB::table($table)->get();
   //     //   echo '<pre>';print_r($response);

   //     return $response;
   //  }
   public function insert_event_type($data)
   {
      $response = EventType::insert($data);        
      return $response;
   }
   public function fetch_event_type_all()
   {
      $response = EventType::all();
      return $response;
   }
   public function event_type_delete($id)
   {
      $response = EventType::where('id', $id)->delete();
      return $response;
   }
   public function fetch_select_op_event_type()
   {
      $response = EventType::get();
      return $response;
   }
   public function fetch_selected_event_type($id)
   {
      $response = Event::where('id', $id)->value('event_type');
      return $response;
   }
}


?>
