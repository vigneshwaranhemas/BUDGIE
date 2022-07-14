<?php

namespace App\Http\Controllers;

use App\Repositories\IEventTypeRepositories;
use Illuminate\Http\Request;
use App\EventType;
use Illuminate\Support\Facades\DB;
use Session;

class EventTypeController extends Controller
{

    public $event_type;

    public function __construct(IEventTypeRepositories $event_type)
    {
        $this->event_type = $event_type;        
        $this->middleware('is_admin');
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
    public function event_type_insert(Request $request)
    {
        $result = $request->validate([
            'event_type' => 'required|unique:event_types', 
        ]);

        $event_type = $request->input('event_type');
        // dd($event_type);
        $data = array(
            'event_type' => $event_type,
        );

        $inserted = $this->event_type->insert_event_type($data);

        if($inserted){
            $result = $this->event_type->fetch_event_type_all();
        }
      
        return response($result);
        
    }

    public function fetch_event_type_all()
    {
        $response = $this->event_type->fetch_event_type_all();        
        echo json_encode($response);
        
    }

    public function event_type_delete(Request $request)
    {
        $id = $request['id'];
        
	    $deleted = $this->event_type->event_type_delete($id);		
		
        if($deleted)
        {
            $data = $this->event_type->fetch_event_type_all();

            $result=array(
                'type'=>1,
                "message"=>"success",
                "data"=> $data,
            );
        }

		echo json_encode($result);
        
    }

    public function fetch_selected_event_type(Request $request)
    {
        $id = $request['id'];       
	    $fetched = $this->event_type->fetch_select_op_event_type();	                
        $output = '<option value="">Please Select Event Type</option>';                       

        foreach ($fetched as $record) {  
        
	        $fetch_selected = $this->event_type->fetch_selected_event_type($id);

            if($fetch_selected == $record->event_type){
                $output .= '<option value="'.$record->event_type.'" selected>'.$record->event_type.'</option>';                                                                                                      

            }else{
                $output .= '<option value="'.$record->event_type.'">'.$record->event_type.'</option>';                                                                                                      

            }
                        
        }    
               
		echo json_encode($output);
    }

}
