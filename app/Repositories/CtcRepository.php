<?php
namespace App\Repositories;

use App\band;
use App\blood_group;
use App\candidate_education_information;
use App\candidate_education_details;
use App\department;
use App\designation;
use App\division;
use App\function_master;
use App\grade;
use App\location;
use App\roll;
use App\state;
use App\zone;
use Illuminate\Support\Facades\DB;
use App\menu;
use App\sub_menu;
use App\role_permission;
use App\Role;
use App\welcome_aboard;
use App\Models\CustomUser;


class CtcRepository implements ICtcRepository
{
public function get_customuser_details($input_details){
	// echo "<pre>";print_r($input_details);die;
	// DB::enableQueryLog();
        $mdlrecruitmenttbl = DB::table('customusers as cs')
        ->select('cs.ctc_per_annual','g.increment_percentage')
        ->leftjoin('goals as g', 'g.created_by', '=', 'cs.empID')
        ->where('empID', '=', $input_details['emp_id'])
        ->get();
	// dd(DB::getQueryLog());
        return $mdlrecruitmenttbl;
    }



}













?>
