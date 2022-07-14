<?php

namespace App\Repositories;

interface ICommonRepositories {
	public function get_candidate_info_hr( $input_details );
	public function get_candidate_exp_hr( $input_details );
	public function family_info_to_hr( $input_details );
    public function check_user_status($id);
    public function user_status_pms($id);
    public function get_organization_info();
    public function get_organization_info_one();
    public function supervisor_wise_info($id);
    public function Store_StickyNotes($data);
    public function Fetch_Notes($data);
    public function Fetch_Notes_id_wise($data);
    public function Update_Notes_id_wise($data,$id);
    public function Delete_Notes_id_wise($coloumn,$id);
    public function my_team_tl_info($id);
    public function pms_oneor_not($id);
    public function pms_oneor_not_naps($id);
    public function delete_pro_img($id);

    // public function Fetch_goals_user_info($id);







}
