<?php

namespace App\Repositories;

interface IAdminRepository {

	public function get_role_list_base( );
	public function get_menu_list_res($role_id );
	public function get_submenu_save_res($input_details );

    // Business Unit
    public function add_business_unit_process( $form_data );
    public function get_business_unit_database_data();
    public function get_business_unit_details( $input_details );
    public function update_business_unit_details( $input_details );
    public function process_business_unit_status( $input_details );
    public function process_business_unit_delete( $input_details );

    // Division
    public function add_division_unit_process( $form_data );
    public function get_division_unit_database_data();
    public function get_division_unit_details( $input_details );
    public function update_division_details( $input_details );
    public function process_division_status( $input_details );
    public function process_division_unit_delete( $input_details );

    // Function
    public function add_function_process( $form_data );
    public function get_function_database_data();
    public function get_function_details( $input_details );
    public function update_function_details( $input_details );
    public function process_function_status( $input_details );
    public function process_function_delete( $input_details );

    // Grade
    public function add_grade_process( $form_data );
    public function get_grade_database_data();
    public function get_grade_details( $input_details );
    public function update_grade_details( $input_details );
    public function process_grade_status( $input_details );
    public function process_grade_delete( $input_details );

    // Location
    public function add_location_process( $form_data );
    public function get_location_database_data();
    public function get_location_details( $input_details );
    public function update_location_details( $input_details );
    public function process_location_status( $input_details );
    public function process_location_delete( $input_details );

    // Location
    public function add_blood_process( $form_data );
    public function get_blood_database_data();
    public function get_blood_details( $input_details );
    public function update_blood_details( $input_details );
    public function process_blood_status( $input_details );
    public function process_blood_delete( $input_details );

    // Roll
    public function add_roll_process( $form_data );
    public function get_roll_database_data();
    public function get_roll_details( $input_details );
    public function update_roll_details( $input_details );
    public function process_roll_status( $input_details );
    public function process_roll_delete( $input_details );

    // Department
    public function add_department_process( $form_data );
    public function get_department_database_data();
    public function get_department_details( $input_details );
    public function update_department_details( $input_details );
    public function process_department_status( $input_details );
    public function process_department_delete( $input_details );

    // Designation
    public function add_designation_process( $form_data );
    public function get_designation_database_data();
    public function get_designation_details( $input_details );
    public function update_designation_details( $input_details );
    public function process_designation_status( $input_details );
    public function process_designation_delete( $input_details );

    // State
    public function add_state_process( $form_data );
    public function get_state_database_data();
    public function get_state_details( $input_details );
    public function update_state_details( $input_details );
    public function process_state_status( $input_details );
    public function process_state_delete( $input_details );

    // Zone
    public function add_zone_process( $form_data );
    public function get_zone_database_data();
    public function get_zone_details( $input_details );
    public function update_zone_details( $input_details );
    public function process_zone_status( $input_details );
    public function process_zone_delete( $input_details );

    // Zone
    public function add_band_process( $form_data );
    public function get_band_database_data();
    public function get_band_details( $input_details );
    public function update_band_details( $input_details );
    public function process_band_status( $input_details );
    public function process_band_delete( $input_details );

    // Client
    public function add_client_process( $form_data );
    public function get_client_database_data();
    public function get_client_details( $input_details );
    public function update_client_details( $input_details );
    public function process_client_status( $input_details );
    public function process_client_delete( $input_details );

    //roles
    public function get_role_data();
    public function get_role_details_pop( $input_details );
    public function update_role_unit_details( $input_details );

    // // permission
    // public function get_permission_count_base( );
    // /*menu list permission*/
    // public function get_permision_menu_base( );
    //vignesh  admin work for request seating arrangement

       public function get_seating_requested($status);
       public function update_seating_status($id,$data);
       public function update_candidate_seating_status($data,$update_data);

   //Employee list
    public function get_employee_list( $input_details);

    // Company policies
    public function add_policy_category_process( $form_data );
    public function get_policy_category_details();
    public function Store_Policy_information($data);
    public function get_company_policy_infomation_database_data();
    public function get_policy_information_details( $input_details );
    public function edit_policy_information_details( $input_details );
    public function process_policy_information_status( $input_details );
    public function process_policy_information_delete( $input_details );


}
