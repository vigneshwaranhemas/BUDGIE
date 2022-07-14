<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CandidatePreOnBoardingModel;
use App\Models\BuddyFeedbackModel;
use App\Models\CustomUser;
use App\Models\UsersInfoModel;
use App\welcome_aboard;
use App\Models\Epf_Forms;
use App\Models\Medical_insurance;
use Session;

class PreOnboardingrepositories implements IPreOnboardingrepositories {
     public function Check_onBoard($table,$test)
     {
         $response=DB::table($table)->where($test)->get();
         return $response;
     }
     public function getonBoardingFields($table)
     {
        $response=DB::table($table)->get();
        return $response;
     }
     public function insert_onboard($data)
     {
         $response=CandidatePreOnBoardingModel::insert($data);
         return $response;
     }
     public function update_onboard($data,$id,$field)
     {
         $i=0;
         foreach($data as $onboard)
         {
              $id=$field[$i]->id;
            CandidatePreOnBoardingModel::where('id',$id)->update($onboard);

         $i++;
        }
         $response="success";
         return $response;
     }

   public function insert_buddy_feedback($data,$data1)
   {
          $response=BuddyFeedbackModel::insert($data);
          if($response){
          $response=BuddyFeedbackModel::insert($data1);

          }
            //   $response=DB::table("buddy_feedback_models")->insert($data);
          return $response;
   }
   public function get_buddy_info($id)
   {
        $response=BuddyFeedbackModel::where($id)->get();
        return $response;
   }
   public function get_canidate_info($table,$test)
   {
        $response=DB::table($table)->where($test)->first();
        return $response;
   }
   public function fetch_buddy_info($data)
   {
          $result=CustomUser::join('candidate_details','candidate_details.welcome_buddy','=','customusers.empID')
                                  ->where('candidate_details.cdID',$data)
                                  ->select('customusers.empID','customusers.username','customusers.designation',
                                  'customusers.email','customusers.contact_no')
                                  ->first();
          return $result;
   }

     // Welcome aboard process start
    public function add_welcome_aboard_process( $form_data ){

        $response = welcome_aboard::insert($form_data);
        return $response;
      }

    public function get_welcome_aboard_details($data){
        // echo '<pre>';print_r($data);die();

        // $welcome_aboard_data = welcome_aboard::first();
        $welcome_aboard_data = welcome_aboard::where('created_by',$data)
                                                ->first();

        return $welcome_aboard_data;
    }
    // Welcome aboard process End


 //get candidate and buddy info for buddy feedback work  done by vignesh

            public function get_candidate_and_buddy_info($data)
            {
                // $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
                //                     ->join('users','users.empID','=','candidate_details.welcome_buddy')
                //                     ->where('customusers.cdID',$data['cdID'])
                //                     ->select('customusers.empID','customusers.username',
                //                              'customusers.department','customusers.designation',
                //                              'customusers.worklocation','customusers.doj','users.name')->first();
                    $result=CustomUser::join('candidate_details','customusers.cdID','=','candidate_details.cdID')
                                    ->join('customusers as cs','cs.empID','=','candidate_details.welcome_buddy')
                                    ->where('customusers.cdID',$data['cdID'])
                                    ->select('cs.username as buddy_name','customusers.empID',
                                             'customusers.username','customusers.department',
                                             'customusers.designation','customusers.worklocation',
                                             'customusers.doj')->first();
                    return $result;
            }


    public function get_policy_category_candidate_details(){

        $divisiontbl = DB::table('company_policy_categories as dv')
        ->select('dv.*')
        ->orderBy('dv.created_at', 'desc')
        ->get();

        return $divisiontbl;
    }

    public function get_policy_information_candidate_details( $input_details ){

        $policy_information_candidate_tbl = DB::table('company_policy_information as cpi')
        ->select('cpi.*')
        ->where('cpi.cp_id', '=', $input_details['cp_id'])
        ->orderBy('cpi.created_at', 'desc')
        ->get();

        return $policy_information_candidate_tbl;
    }

    public function insert_epf_form($data)
    {
        $response=Epf_Forms::insert($data);
        return $response;

    }
    public function update_epf_form($data)
    {

        $reqtbl = new Epf_Forms();
        $reqtbl = $reqtbl->where( 'cdID','=', $data['cdID'] );
        $reqtbl->update( [
        'a_pf_no'=>$data['a_pf_no'],
        'a_uan_no'=>$data['a_uan_no'],
        'ekyc_status'=>$data['ekyc_status'],
        'sign_status'=>$data['sign_status'],
        'file_name'=>$data['file_name'],

    ] );
        return $reqtbl;
    }
    public function get_candidate_epf_details($cdID)
    {
        # code...
        $querytbl = new Epf_Forms();
        $querytbl = $querytbl->where( 'cdID','=', $cdID );
        return $querytbl = $querytbl->get();
    }

    public function check_epf_form($cdID){
        $querytbl = new Epf_Forms();
        $querytbl = $querytbl->where( 'cdID','=', $cdID );
        return $querytbl = $querytbl->count();

    }
    public function insert_medical_form($data)
    {
        $response=Medical_insurance::insert($data);
        return $response;

    }
    public function check_medical_details($cdID){
        $querytbl = new Medical_insurance();
        $querytbl = $querytbl->where( 'cdID','=', $cdID );
        return $querytbl = $querytbl->count();

    }
    public function update_medical_form($data)
    {
        $reqtbl = new Medical_insurance();
        $reqtbl = $reqtbl->where( 'cdID','=', $data['cdID'] );
        $reqtbl->update( [
            'insur_name'=>$data['insur_name'],
            'relation'=>$data['relation'],
            'dob'=>$data['dob'],
            'age'=>$data['age'],
            'gender'=>$data['gender'],
            'file_name'=>$data['file_name'],

        ] );
        return $reqtbl;


    }

    public function get_leave_masters_details(){

        $sess_info = Session::get("session_info");
        $empID = $sess_info['empID'];

        $leave_master_tbl = DB::table('leave_masters as lm')
        ->select('lm.*')
        ->where('empID', '=', $empID)
        ->orderBy('lm.created_at', 'desc')
        ->get();

        return $leave_master_tbl;
    }




}


?>
