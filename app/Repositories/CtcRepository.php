<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
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
