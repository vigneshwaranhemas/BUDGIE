<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Holidays; 
use App\HolidayState; 
use Auth;
class HolidayRepository implements IHolidayRepository
{

    public function add_holidays_insert( $data ){
        $response = Holidays::insertGetId($data);
        return $response;
    }
    public function insertHolidayCode($holiday_unique_code, $last_inserted_id)
    {
       $response = Holidays::where('id', $last_inserted_id)
                             ->update([
                                 'holiday_unique_code' => $holiday_unique_code
                             ]);
       return $response;
    }
    public function fetch_holidays_list()
    {      
      if(Auth::user()->role_id === 'RO1'){

         $response = DB::table("holidays")->select('*')
         ->get();

      }else{

         $logined_empID = Auth::user()->empID;
         $logined_state = DB::table("candidate_contact_information")->where('emp_id', $logined_empID)->value('p_State');
         
         if(!empty($logined_state)){
            $response = DB::table('holiday_states as hs')
                     ->distinct()         
                     ->select('h.*')         
                     ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                     ->where('hs.state_name', $logined_state)
                     ->get();
            
         }else{
            $response = null;
         }         

      }

      // $response = DB::table("holidays")->select('*')
      // ->get();
      
       return $response;
    }
    
    public function fetch_holidays_state_filter($state)
    {      
      if(Auth::user()->role_id === 'RO1'){

         $response = DB::table('holiday_states as hs')
                     ->distinct()         
                     ->select('h.*')         
                     ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                     ->where('hs.state_name', $state)
                     // ->where('state', $state)
                     ->get();

      }else{

         $logined_empID = Auth::user()->empID;
         $logined_state = DB::table("candidate_contact_information")->where('emp_id', $logined_empID)->value('p_State');
         
         if(!empty($logined_state)){
            
            $response = DB::table('holiday_states as hs')
                     ->distinct()         
                     ->select('h.*')         
                     ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                     ->where('hs.state_name', $state)
                     // ->where('state', $state)
                     ->get();
            
         }else{
            $response = null;
         }         

      }

      // $response = DB::table("holidays")->select('*')
      // ->get();
      
       return $response;
    }
   //  public function fetch_holidays_state_filter($state)
   //  {      
   //     $response = DB::table("holidays")->select('*')
   //                  ->where('state', $state)
   //                  ->get();
   //     return $response;
   //  }
    public function fetch_holidays_list_id($id)
    {      
       $response = DB::table('holidays')
                    ->select('*')
                    ->where('id', $id)
                    ->get();
       return $response;
    }
    public function fetch_holidays_state_id($id)
    {      
      $state_names = DB::table("towns_details")->select('state_name')
      ->groupByRaw('state_name')
      ->get();

      $holiday_code = Holidays::where('id', $id)->value('holiday_unique_code');
      
      $output = '<option value="">Select State...</option>'; 

      foreach($state_names as $record){

         $response = HolidayState::where('holiday_code', $holiday_code)
                                    ->where('state_name', $record->state_name)
                                    ->value('state_name');
         
         if(!empty($response)){
            if($response == $record->state_name){  
               $output .= '<option value="'.$record->state_name.'" selected>'.$record->state_name.'</option>';
            }
         }else{
            $output .= '<option value="'.$record->state_name.'">'.$record->state_name.'</option>';
         }
         
      }

      return $output;
    }
    public function fetch_holidays_state_id_show($id)
    {      

      $holiday_unique_code = Holidays::where('id', $id)->value('holiday_unique_code');

      $output = '<ul class="pl-4 mb-4 list-circle">';

      $state_names = HolidayState::where('holiday_code', $holiday_unique_code)->get();
      
      foreach($state_names as $record){
          
         $output .= '<li>'.$record->state_name.'</li>';         
         
      }

      $output .= "</ul>";

      return $output;
    }
    public function holidays_update($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],                            
                            'all_state' => $data['all_state'],                            
                         ));
       return $response;
    }
    public function holidays_update_file($data)
    {
       $response = Holidays::where('id', $data['id'])
                         ->update(array(
                            'occassion' => $data['occassion'],
                            'description' => $data['description'],                            
                            'occassion_file' => $data['occassion_file'],                            
                            'all_state' => $data['all_state'],                            
                         ));
       return $response;
    }
    public function holidays_delete($id)
    {
        $response = Holidays::where('id', $id)
                            ->delete();
        return $response;

    }
    public function fetch_holidays_list_date($filter_date)
    {                

      if(Auth::user()->role_id === 'RO1'){

         $response = Holidays::where('date', 'LIKE', '%'.$filter_date.'%')
         ->get();

      }else{

         $logined_empID = Auth::user()->empID;
         $logined_state = DB::table("candidate_contact_information")->where('emp_id', $logined_empID)->value('p_State');
         
         if(!empty($logined_state)){
            $response = DB::table('holiday_states as hs')
                     ->distinct()         
                     ->select('h.*')         
                     ->join('holidays as h', 'h.holiday_unique_code', '=', 'hs.holiday_code')
                     ->where('hs.state_name', $logined_state)
                     ->where('h.date', 'LIKE', '%'.$filter_date.'%')
                     ->get();
            
         }     

      }

      // $response = DB::table("holidays")->select('*')
      // ->get();
      
      return $response;      
      
    }
    public function fetch_state_list()
    {      
      $response = DB::table("towns_details")->select('state_name')
                        ->groupByRaw('state_name')
                        ->get();
      return $response;
    }
   
}
