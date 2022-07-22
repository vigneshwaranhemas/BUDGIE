<?php

namespace App\Http\Controllers;
use App\Repositories\IPeopleRepository;
use App\Repositories\ICommonRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PeopleController extends Controller
{
    public $people;  

    // public function __construct()
    public function __construct(IPeopleRepository $people,ICommonRepositories $cmmrpy)
    {
        $this->middleware('is_admin');
        $this->people = $people;
        $this->cmmrpy = $cmmrpy;
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
    public function people()
    {        
        $customusers = $this->people->fetch_customuser_list();  

        $departments = DB::table('departments')->get();
        $designations = DB::table('designations')->get();
        $locations = DB::table('locations')->get();

       // echo json_encode($customusers[0]);die();
        $data = [
            "customusers" => $customusers,
            "departments" => $departments,
            "designations" => $designations,
            "locations" => $locations,
        ];
        return view('people.index')->with($data);
    }
    public function fetch_people_list_filter(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
            'people_filter_location' => $request->people_filter_location,
            'employee' => $request->employee,
        );
        $customusers = $this->people->fetch_people_list_filter_with_filter($data); 
        // $employee = $request->input('employee');
        // $customusers = $this->people->fetch_people_list_filter($employee); 
        return json_encode($customusers);
    }
    public function fetch_people_list_filter_starred(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
            'people_filter_location' => $request->people_filter_location,
            'employee' => $request->employee,
        );
        $customusers = $this->people->fetch_people_list_filter_starred_with_filter($data); 
        // $employee = $request->input('employee');
        // $customusers = $this->people->fetch_people_list_filter($employee); 
        return json_encode($customusers);
    }
    public function fetch_people_starred_first_empid(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
            'people_filter_location' => $request->people_filter_location,
        );
        $emp_id = $this->people->fetch_people_starred_first_empid_with_filter($data);

        // $emp_id = $this->people->fetch_people_starred_first_empid(); 
        return json_encode($emp_id);
    }
    public function fetch_people_everyone_first_empid(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
            'people_filter_location' => $request->people_filter_location,
        );
        $emp_id = $this->people->fetch_people_everyone_first_empid_with_filter($data); 
        return json_encode($emp_id);
    }
    public function fetch_people_star_add(Request $request)
    {
        $emp_id = $request->input('emp_id');
        
        $people_star = $this->people->fetch_people_star_add($emp_id); 

        return response()->json( ['output' => $people_star] );
        // return response($people_star_added);
    }
    public function fetch_people_list_filter_star(Request $request)
    {
        $employee = $request->input('employee');
        $customusers = $this->people->fetch_people_list_filter_star($employee); 
        return json_encode($customusers);
    }
    public function fetch_people_list_filter_img(Request $request)
    {
        $employee = $request->input('employee');
        $customusers = $this->people->fetch_people_list_filter_img($employee); 
        return json_encode($customusers);
    }
    public function fetch_starred_customusers_list(Request $request)
    {
        // if(!empty($request->all())){
            // dd("yes");
            $data = array(
                'people_filter_dept' => $request->people_filter_dept,
                'people_filter_design' => $request->people_filter_design,
                'people_filter_location' => $request->people_filter_location,
            );
            $starred_customusers = $this->people->fetch_starred_customusers_list_with_filter($data);

        // }else{
        //     // dd("no");
        //     $starred_customusers = $this->people->fetch_starred_customusers_list();
        // }
        return json_encode($starred_customusers);
    }
    public function fetch_everyone_customusers_list(Request $request)
    {
        $data = array(
            'people_filter_dept' => $request->people_filter_dept,
            'people_filter_design' => $request->people_filter_design,
            'people_filter_location' => $request->people_filter_location,
        );
        $starred_customusers = $this->people->fetch_everyone_customusers_list_with_filter($data);

        return json_encode($starred_customusers);
    }
}
