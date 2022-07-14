<?php

namespace App\Repositories;

interface IHrPreonboardingrepositories{
   public function getonboardinginfo($userid,$status);
   public function get_candidate_info($id);
   public function get_onboarding_candidate_info();
   public function Update_mail_status($update_data);
   public function DayWiseCandidateInfo($data);
   public function get_email_info();
   public function Insert_Candidate_empId($data);
   public function Verify_emp_info($data);
   public function EmailIdCreation($data);
   public function get_itinfra_email_info();
   public function candidate_info_for_EmailCreation($id);
   public function get_hrRequested_info($status);
   public function getUserDocuments($id);
   public function update_candidate_doc_status($id,$status);
   public function update_candidate_onboard_status($id,$status);
   public function get_welcome_aboard_details_hr($id);
   public function welcome_aboard_image_upload_hr($id);
   public function get_welcome_aboard_image_show_hr($id);
   public function get_epf_list_data();
   public function get_medical_list_data();

}


?>
