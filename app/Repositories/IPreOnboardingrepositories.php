<?php

namespace App\Repositories;


interface IPreOnboardingrepositories{

       public function Check_onBoard($table,$test);
       public function getonBoardingFields($table);
       public function insert_onboard($data);
       public function update_onboard($data,$id,$field);
       public function insert_buddy_feedback($data,$data1);
       public function get_buddy_info($id);
       public function get_canidate_info($table,$id);
       public function fetch_buddy_info($data);

       // Welcome aboard process start
       public function add_welcome_aboard_process( $form_data );
       public function get_welcome_aboard_details($data);
       public function get_candidate_and_buddy_info($data);
       public function get_policy_category_candidate_details();
       public function get_policy_information_candidate_details($data);

       // Welcome aboard process End

       public function insert_epf_form($data);
       public function check_epf_form($cdID);
       public function insert_medical_form($data);
       public function check_medical_details($cdID);
       public function update_medical_form($data);
       public function get_leave_masters_details();

}

?>

