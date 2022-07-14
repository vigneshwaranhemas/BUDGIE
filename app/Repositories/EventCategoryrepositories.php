<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\EventCategory;
use App\Event;

class EventCategoryrepositories implements IEventCategoryrepositories {
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
   public function insert_event_category($data)
   {
      $response = EventCategory::insert($data);        
      return $response;
   }
   public function fetch_event_category_all()
   {
      $response = EventCategory::all();
      return $response;
   }
   public function event_category_delete($id)
   {
      $response = EventCategory::where('id', $id)->delete();
      return $response;
   }
   public function fetch_select_option_event_category()
   {
      $response = EventCategory::get();
      return $response;
   }
   public function fetch_selected_event_category($id)
   {
      $response = Event::where('id', $id)->value('category_name');
      return $response;
   }
}


?>
