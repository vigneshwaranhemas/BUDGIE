<?php

namespace App\Http\Controllers;

use App\Repositories\IEventCategoryrepositories;
use Illuminate\Http\Request;
use App\EventCategory;
use Illuminate\Support\Facades\DB;
use Session;

class EventCategoryController extends Controller
{

    public $event_category;  

    public function __construct(IEventCategoryrepositories $event_category)
    {
        $this->middleware('is_admin');
        $this->event_category = $event_category;
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
    public function event_category_insert(Request $request)
    {
        $result = $request->validate([
            'category_name' => 'required|unique:event_categories', 
        ]);

        $category_name = $request->input('category_name');

        $data = array(
            'category_name' => $category_name,
        );

        $inserted = $this->event_category->insert_event_category($data);

        if($inserted){
            $result = $this->event_category->fetch_event_category_all();
        }
      
        return response($result);
        
    }

    public function fetch_event_category_all()
    {
        $response = $this->event_category->fetch_event_category_all();        
        echo json_encode($response);
        
    }

    public function event_category_delete(Request $request)
    {
        $id = $request['id'];
        
	    $deleted = $this->event_category->event_category_delete($id);		
		
        if($deleted)
        {
            $data = $this->event_category->fetch_event_category_all();

            $result=array(
                'type'=>1,
                "message"=>"success",
                "data"=> $data,
            );
        }

		echo json_encode($result);
        
    }
    
    public function fetch_select_option_event_category(Request $request)
    {
        $id = $request['id'];       
	    $fetched = $this->event_category->fetch_select_option_event_category();	                
        $output = '<option value="">Select Category...</option>';                       

        foreach ($fetched as $record) {  
        
	        $fetch_selected = $this->event_category->fetch_selected_event_category($id);

            if($fetch_selected == $record->category_name){
                
                $output .= '<option value="'.$record->category_name.'" selected>'.$record->category_name.'</option>';                                                                                                      

            }else{
                
                $output .= '<option value="'.$record->category_name.'">'.$record->category_name.'</option>';                                                                                                      

            }
                        
        }    
               
		echo json_encode($output);
    }
}
