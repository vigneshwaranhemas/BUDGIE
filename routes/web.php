<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'CommonController@pagenotfound']);
Route::get('/login', 'LoginController@login')->name('login');



/*login*/
Route::get('logout','LoginController@logout');
Route::post('login_check_process', 'LoginController@login_check_process' );
Route::get("UserEmailSend","LoginController@UserEmailSend");
Route::get('dashboard','AdminController@permission');
Route::get('com_dashboard','AdminController@com_dashboard');


//Dashboard
Route::get('fetch_tdys_brd_list', 'AdminController@fetch_tdys_brd_list')->name('fetch_tdys_brd_list');
Route::get('fetch_tdys_work_annu_list', 'AdminController@fetch_tdys_work_annu_list')->name('fetch_tdys_work_annu_list');
Route::get('fetch_login_profile_image', 'AdminController@fetch_login_profile_image')->name('fetch_login_profile_image');


Route::prefix('perk-ui')->group(function () {
    Route::view('animate', 'perk-ui.animate')->name('animate');
    Route::view('scroll-reval', 'perk-ui.scroll-reval')->name('scroll-reval');
    Route::view('aos', 'perk-ui.aos')->name('aos');
    Route::view('tilt', 'perk-ui.tilt')->name('tilt');
    Route::view('wow', 'perk-ui.wow')->name('wow');
    Route::view('hide-on-scroll', 'perk-ui.hide-on-scroll')->name('hide-on-scroll');
    Route::view('vertical', 'perk-ui.vertical')->name('vertical');
    Route::view('mega-menu', 'perk-ui.mega-menu')->name('mega-menu');
    Route::view('fix-header', 'perk-ui.fix-header')->name('fix-header');
    Route::view('fix-header&amp;sidebar', 'perk-ui.fix-header&amp;sidebar')->name('fix-header&amp;sidebar');
    Route::view('basic-card', 'perk-ui.basic-card')->name('basic-card');
    Route::view('theme-card', 'perk-ui.theme-card')->name('theme-card');
    Route::view('tabbed-card', 'perk-ui.tabbed-card')->name('tabbed-card');
    Route::view('dragable-card', 'perk-ui.dragable-card')->name('dragable-card');
    Route::view('button-builder', 'perk-ui.button-builder')->name('button-builder');
    Route::view('form-builder-1', 'perk-ui.form-builder-1')->name('form-builder-1');
});

//HR Controller
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('candidate_dashboard');
Route::get('/hrsspreOnboarding','HrController@preOnboarding');
Route::get("hrssdayzero","HrController@DayZero");
Route::get("hrssOnBoarding","HrController@hrssOnBoarding");
Route::get('seating_readiness',"HrController@SeatingArrangement");
Route::get('EmailIdCreation','HrController@EmailIdCreation');
Route::get('hrssCandidate','HrController@Candidate');
Route::get('userdocuments','HrController@userdocuments');
Route::post('view_preonboarding','HrController@Show_preOnBoarding');
Route::post('Email_and_Seat_request','HrController@EmailAndSeatingRequest');
Route::get('Candidate_Email_Creation','HrController@Candidate_Email_Creation');
Route::post('Candidate_Email_Status_update','HrController@Candidate_Email_Status_update');
Route::post('DocumentStatusUpdate','HrController@UpdateDocumentStatus');
Route::post('Candidate_Status_Update','HrController@CandidateOnboardStatusUpdate');

//Buddy Controller

Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('candidate_dashboard');
Route::get('buddy', 'BuddyController@buddy_info')->name('buddy_info');
Route::post('show_buddy_feedback','BuddyController@View_Buddy_feedback');

//Candidate Controller
Route::get('/candidate_dashboard', 'CandidateController@candidate_dashboard')->name('candidate_dashboard');
Route::get('/preOnboarding','CandidateController@preOnboarding');
Route::get('Buddy_feedback', 'CandidateController@buddy')->name('buddy_feedback');
Route::post('/PreOnBoarding_save','CandidateController@insertPreOnboarding');
Route::get('candidate_profile','CandidateController@profile');
Route::post("SaveBuddyFeedback",'candidateController@InsertBuddyFeedback');
Route::get('Candidate_Induction','CandidateController@CandidateInduction');
Route::get('Candidate_Assigned_Buddy','CandidateController@Candidate_Assigned_Buddy');

//Calendaer Event

Route::get('events','EventController@events')->name('events');
// Route::get('events-category','AdminController@create');
Route::post('add_new_event_insert', 'EventController@add_new_event_insert');
Route::get('fetch_all_event', 'EventController@fetch_all_event');
Route::get('fetch_event_edit', 'EventController@fetch_event_edit');
Route::get('fetch_select_option_event_category', 'EventCategoryController@fetch_select_option_event_category');
Route::get('fetch_selected_event_type', 'EventTypeController@fetch_selected_event_type');
Route::get('fetch_event_attendees_list', 'EventController@fetch_event_attendees_list');
Route::get('fetch_event_attendees_show', 'EventController@fetch_event_attendees_show');
Route::post('event_delete', 'EventController@event_delete');
Route::post('event_update', 'EventController@event_update');
Route::post('attendees_filter', 'EventController@attendees_filter');

Route::post('event_category_insert', 'EventCategoryController@event_category_insert');
Route::post('event_category_delete', 'EventCategoryController@event_category_delete');
Route::get('fetch_event_category_all', 'EventCategoryController@fetch_event_category_all');

Route::post('event_type_insert', 'EventTypeController@event_type_insert');
Route::post('event_type_delete', 'EventTypeController@event_type_delete');
Route::get('fetch_event_type_all', 'EventTypeController@fetch_event_type_all');

Route::get('/Hr_SeatingRequest','AdminController@Hr_SeatingRequest');
Route::post("/Admin_Seating_Request","AdminController@Admin_Seating_Allotment");
Route::post('/Admin_Request_update',"AdminController@Seating_Status_update");

//Goals Controller
Route::get('goals', 'GoalsController@goals')->name('goals');
Route::get('goal_setting', 'GoalsController@goal_setting')->name('goal_setting');
Route::get('goal_setting_supervisor_view', 'GoalsController@goal_setting_supervisor_view')->name('goal_setting_supervisor_view');
Route::get('goal_setting_hr_view', 'GoalsController@goal_setting_hr_view')->name('goal_setting_hr_view');
Route::get('goal_setting_reviewer_view', 'GoalsController@goal_setting_reviewer_view')->name('goal_setting_reviewer_view');
Route::get('goal_setting_supervisor_edit', 'GoalsController@goal_setting_supervisor_edit')->name('goal_setting_supervisor_edit');
Route::get('fetch_goals_reviewer_edit', 'GoalsController@fetch_goals_reviewer_edit')->name('fetch_goals_reviewer_edit');
Route::get('fetch_goals_hr_edit', 'GoalsController@fetch_goals_hr_edit')->name('fetch_goals_hr_edit');
Route::get('fetch_goals_bh_edit', 'GoalsController@fetch_goals_bh_edit')->name('fetch_goals_bh_edit');
Route::get('goal_setting_reviewer_edit', 'GoalsController@goal_setting_reviewer_edit')->name('goal_setting_reviewer_edit');
Route::get('goal_setting_bh_edit', 'GoalsController@goal_setting_bh_edit')->name('goal_setting_bh_edit');
Route::get('edit_goal', 'GoalsController@edit_goal')->name('edit_goal');
Route::get('fetch_goals_setting_id_details', 'GoalsController@fetch_goals_setting_id_details')->name('fetch_goals_setting_id_details');
Route::get('fetch_goals_sup_details', 'GoalsController@fetch_goals_sup_details')->name('fetch_goals_sup_details');
Route::get('fetch_goals_reviewer_sup_details', 'GoalsController@fetch_goals_reviewer_sup_details')->name('fetch_goals_reviewer_sup_details');
Route::get('fetch_goals_reviewer_details', 'GoalsController@fetch_goals_reviewer_details')->name('fetch_goals_reviewer_details');
Route::get('fetch_goals_supervisor_edit', 'GoalsController@fetch_goals_supervisor_edit')->name('fetch_goals_supervisor_edit');
Route::get('fetch_goals_setting_id_edit', 'GoalsController@fetch_goals_setting_id_edit')->name('fetch_goals_setting_id_edit');
Route::get('goals_sheet_head', 'GoalsController@goals_sheet_head')->name('goals_sheet_head');
Route::get('goals_consolidate_rate_head', 'GoalsController@goals_consolidate_rate_head')->name('goals_consolidate_rate_head');
Route::get('add_goal_setting', 'GoalsController@add_goal_setting')->name('add_goal_setting');
Route::get('add_goal_setting_naps', 'GoalsController@add_goal_setting_naps')->name('add_goal_setting_naps');
Route::post('add_goals_data', 'GoalsController@add_goals_data');
Route::post('add_goals_data_submit', 'GoalsController@add_goals_data_submit');
Route::post('update_goals_data', 'GoalsController@update_goals_data');
Route::post('goals_delete', 'GoalsController@goals_delete');
Route::post('goals_employee_summary', 'GoalsController@goals_employee_summary');
Route::get('get_goal_list', 'GoalsController@get_goal_list' );
Route::get('get_team_member_goal_list', 'GoalsController@get_team_member_goal_list' );
Route::get('get_reviewer_goal_list', 'GoalsController@get_reviewer_goal_list' );
Route::get('get_reviewer_goal_list_for_reviewer', 'GoalsController@get_reviewer_goal_list_for_reviewer' );
Route::get('calendar', 'GoalsController@calendar' );
Route::get('add_goal_btn', 'GoalsController@add_goal_btn' );
Route::post('goals_status', 'GoalsController@goals_status' );
Route::get('fetch_supervisor_filter', 'GoalsController@fetch_supervisor_filter' );
Route::get('fetch_reviewer_filter', 'GoalsController@fetch_reviewer_filter' );
Route::get('fetch_team_leader_filter', 'GoalsController@fetch_team_leader_filter' );
Route::get('get_bh_goal_list', 'GoalsController@get_bh_goal_list' );
Route::get('check_goals_employee_summary', 'GoalsController@check_goals_employee_summary' );
Route::get('get_hr_goal_list_record', 'GoalsController@get_hr_goal_list_record' );
Route::post('goals_supervisor_summary', 'GoalsController@goals_supervisor_summary' );
Route::get('fetch_goals_employee_summary', 'GoalsController@fetch_goals_employee_summary' );
Route::get('fetch_goals_supervisor_summary', 'GoalsController@fetch_goals_supervisor_summary' );
Route::get('goal_setting_hr_edit', 'GoalsController@goal_setting_hr_edit')->name('goal_setting_hr_edit');
Route::post('get_hr_goal_list_tb', 'GoalsController@get_hr_goal_list_tb')->name('get_hr_goal_list_tb');
Route::get('goals_sup_consolidate_rate_head', 'GoalsController@goals_sup_consolidate_rate_head')->name('goals_sup_consolidate_rate_head');
Route::post('check_goal_sheet_role_type_hr', 'GoalsController@check_goal_sheet_role_type_hr')->name('check_goal_sheet_role_type_hr');
Route::get('goals_sup_submit_status', 'GoalsController@goals_sup_submit_status')->name('goals_sup_submit_status');
Route::post('update_goals_sup', 'GoalsController@update_goals_sup');
Route::post('update_goals_sup_submit', 'GoalsController@update_goals_sup_submit');
Route::post('update_emp_goals_data', 'GoalsController@update_emp_goals_data');
Route::post('update_emp_goals_data_submit', 'GoalsController@update_emp_goals_data_submit');
Route::get('goal_setting_edit', 'GoalsController@goal_setting_edit' );
Route::post('update_goals_sup_reviewer_tm', 'GoalsController@update_goals_sup_reviewer_tm');
Route::post('update_goals_sup_submit_direct', 'GoalsController@update_goals_sup_submit_direct');
Route::get('goals_sup_pip_exit_select_op', 'GoalsController@goals_sup_pip_exit_select_op')->name('goals_sup_pip_exit_select_op');
Route::get('fecth_goals_sup_movement_process', 'GoalsController@fecth_goals_sup_movement_process')->name('fecth_goals_sup_movement_process');
Route::get('get_goal_login_user_details_sup', 'GoalsController@get_goal_login_user_details_sup')->name('get_goal_login_user_details_sup');
Route::get('get_goal_login_user_details_rev', 'GoalsController@get_goal_login_user_details_rev')->name('get_goal_login_user_details_rev');
Route::get('goal_employee_summary_check', 'GoalsController@goal_employee_summary_check');
Route::post('update_goals_sup_submit_overall', 'GoalsController@update_goals_sup_submit_overall');
Route::post('update_goals_reviewer_teamleader', 'GoalsController@update_goals_reviewer_teamleader');
Route::post('update_goals_sup_submit_overall_for_reviewer', 'GoalsController@update_goals_sup_submit_overall_for_reviewer');
Route::post('update_goals_team_member_submit_direct', 'GoalsController@update_goals_team_member_submit_direct');
Route::get('get_goals_reviewer_remarks', 'GoalsController@get_goals_reviewer_remarks')->name('get_goals_reviewer_remarks');
Route::get('goals_help_desk', 'GoalsController@goals_help_desk')->name('goals_help_desk');
Route::post('update_goals_sup_by_rev', 'GoalsController@update_goals_sup_by_rev');
Route::get('get_goals_reviewer_sup_pip_exit_data', 'GoalsController@get_goals_reviewer_sup_pip_exit_data')->name('get_goals_reviewer_sup_pip_exit_data');
Route::get('get_all_datas_goals_for_reviewer', 'GoalsController@get_all_datas_goals_for_reviewer')->name('get_all_datas_goals_for_reviewer');
Route::get('add_goal_btn_login', 'GoalsController@add_goal_btn_login')->name('add_goal_btn_login');
Route::post('pms_conformation_sub_naps', 'CommonController@pms_conformation_sub_naps');
Route::get('goal_setting_naps', 'GoalsController@goal_setting_naps')->name('goal_setting_naps');
Route::get('goal_setting_edit_naps', 'GoalsController@goal_setting_edit_naps' );
Route::get('reporting_man_list_only_tm', 'GoalsController@reporting_man_list_only_tm' );

//Birthday controller
Route::get('birthdays', 'BirthdayController@birthdays')->name('birthdays');
Route::get('fetch_birthdays_list', 'BirthdayController@fetch_birthdays_list')->name('fetch_birthdays_list');
Route::get('fetch_birthdays_list_date', 'BirthdayController@fetch_birthdays_list_date')->name('fetch_birthdays_list_date');
Route::get('fetch_birthdays_filter_user', 'BirthdayController@fetch_birthdays_filter_user')->name('fetch_birthdays_filter_user');
Route::get('fetch_birthdays_list_empID', 'BirthdayController@fetch_birthdays_list_empID');
Route::get('fetch_birthdays_list_img', 'BirthdayController@fetch_birthdays_list_img')->name('fetch_birthdays_list_img');

Route::get('birthday_email','AdminController@birthday_email');
Route::get('work_anniversay_email','AdminController@work_anniversay_email');
Route::get('holidays_email','AdminController@holidays_email');
Route::get('events_email','AdminController@events_email');

//Holidays Controller
Route::get('holidays', 'HolidayController@holidays')->name('holidays');
Route::get('fetch_holidays_list', 'HolidayController@fetch_holidays_list')->name('fetch_holidays_list');
Route::get('fetch_holidays_list_id', 'HolidayController@fetch_holidays_list_id');
Route::get('fetch_holidays_state_id', 'HolidayController@fetch_holidays_state_id');
Route::get('fetch_holidays_state_list_id_show', 'HolidayController@fetch_holidays_state_list_id_show');
Route::get('fetch_holidays_list_date', 'HolidayController@fetch_holidays_list_date');
Route::post( 'add_new_holidays_insert', 'HolidayController@add_new_holidays_insert' );
Route::post( 'holidays_update', 'HolidayController@holidays_update' );
Route::post( 'holidays_delete', 'HolidayController@holidays_delete' );

//ItINfra Controller`

Route::get('/ItInfra_Dashboard','ItInfraController@index');
Route::get('/EmailCreation','ItInfraController@EmailIdCreation');
Route::post('ITInfra_Email_Creation','ItInfraController@ITInfra_Email_Creation');
Route::get('/hr_dashboard', 'HrController@hr_dashboard')->name('hr_dashboard');


//Buddy Controller
Route::get('/buddy_dashboard', 'BuddyController@buddy_dashboard')->name('buddy_dashboard')->middleware('is_admin');

//Candidate Controller


// dashboard load admin
//Route::get('/admin', 'AdminController@admin_dashboard')->name('admin');
Route::get('/permission', 'AdminController@permission')->name('permission');
Route::post( 'role_list', 'AdminController@role_list' );
Route::post( 'menu_listing', 'AdminController@menu_listing' );
Route::post( 'sub_menu_save_tab', 'AdminController@sub_menu_save_tab' );

//Super Admin
Route::get('site_admin_dashboard', 'SiteAdminController@site_admin_dashboard')->name('admin_dashboard');

//Admin Controller
Route::get('admin_dashboard', 'AdminController@admin_dashboard')->name('admin_dashboard');
Route::get('business', 'AdminController@business')->name('business');
Route::get('division', 'AdminController@division')->name('division');
Route::get('function', 'AdminController@function')->name('function');
Route::get('grade', 'AdminController@grade')->name('grade');
Route::get('band', 'AdminController@band')->name('band');
Route::get('location', 'AdminController@location')->name('location');
Route::get('blood', 'AdminController@blood')->name('blood');
Route::get('roll', 'AdminController@roll')->name('roll');
Route::get('department', 'AdminController@department')->name('department');
Route::get('designation_or_position', 'AdminController@designation_or_position')->name('designation_or_position');
Route::get('client', 'AdminController@client')->name('client');
Route::get('state', 'AdminController@state')->name('state');
Route::get('zone', 'AdminController@zone')->name('zone');
Route::get('personnel', 'AdminController@personnel')->name('personnel');
Route::get('user', 'AdminController@user')->name('user');
Route::get('roles', 'AdminController@roles')->name('roles');
Route::get('employee_list', 'AdminController@employee_list')->name('employee_list');

// Business Unit
Route::post('add_business_unit_process', 'AdminController@add_business_unit');
Route::post( 'get_business_unit_database', 'AdminController@get_business_unit_database' );
Route::post( 'get_business_unit_details', 'AdminController@get_business_unit_details' );
Route::post( 'update_business_unit_details', 'AdminController@update_business_unit_details' );
Route::post( 'process_business_unit_status', 'AdminController@process_business_unit_status' );
Route::post( 'process_business_unit_delete', 'AdminController@process_business_unit_delete' );

// Division
Route::post('add_division_unit_process', 'AdminController@add_division_unit_process');
Route::post( 'get_division_unit_database', 'AdminController@get_division_unit_database' );
Route::post( 'get_division_unit_details', 'AdminController@get_division_unit_details' );
Route::post( 'update_division_details', 'AdminController@update_division_details' );
Route::post( 'process_division_status', 'AdminController@process_division_status' );
Route::post( 'process_division_unit_delete', 'AdminController@process_division_unit_delete' );

// Function
Route::post('add_function_process', 'AdminController@add_function_process');
Route::post( 'get_function_database', 'AdminController@get_function_database' );
Route::post( 'get_function_details', 'AdminController@get_function_details' );
Route::post( 'update_function_details', 'AdminController@update_function_details' );
Route::post( 'process_function_status', 'AdminController@process_function_status' );
Route::post( 'process_function_delete', 'AdminController@process_function_delete' );

// Grade
Route::post('add_grade_process', 'AdminController@add_grade_process');
Route::post( 'get_grade_database', 'AdminController@get_grade_database' );
Route::post( 'get_grade_details', 'AdminController@get_grade_details' );
Route::post( 'update_grade_details', 'AdminController@update_grade_details' );
Route::post( 'process_grade_status', 'AdminController@process_grade_status' );
Route::post( 'process_grade_delete', 'AdminController@process_grade_delete' );

// Location
Route::post('add_location_process', 'AdminController@add_location_process');
Route::post( 'get_location_database', 'AdminController@get_location_database' );
Route::post( 'get_location_details', 'AdminController@get_location_details' );
Route::post( 'update_location_details', 'AdminController@update_location_details' );
Route::post( 'process_location_status', 'AdminController@process_location_status' );
Route::post( 'process_location_delete', 'AdminController@process_location_delete' );

// Blood Group
Route::post('add_blood_process', 'AdminController@add_blood_process');
Route::post( 'get_blood_database', 'AdminController@get_blood_database' );
Route::post( 'get_blood_details', 'AdminController@get_blood_details' );
Route::post( 'update_blood_details', 'AdminController@update_blood_details' );
Route::post( 'process_blood_status', 'AdminController@process_blood_status' );
Route::post( 'process_blood_delete', 'AdminController@process_blood_delete' );

// Roll
Route::post('add_roll_process', 'AdminController@add_roll_process');
Route::post( 'get_roll_database', 'AdminController@get_roll_database' );
Route::post( 'get_roll_details', 'AdminController@get_roll_details' );
Route::post( 'update_roll_details', 'AdminController@update_roll_details' );
Route::post( 'process_roll_status', 'AdminController@process_roll_status' );
Route::post( 'process_roll_delete', 'AdminController@process_roll_delete' );

// Department
Route::post('add_department_process', 'AdminController@add_department_process');
Route::post( 'get_department_database', 'AdminController@get_department_database' );
Route::post( 'get_department_details', 'AdminController@get_department_details' );
Route::post( 'update_department_details', 'AdminController@update_department_details' );
Route::post( 'process_department_status', 'AdminController@process_department_status' );
Route::post( 'process_department_delete', 'AdminController@process_department_delete' );

// Designation
Route::post('add_designation_process', 'AdminController@add_designation_process');
Route::post( 'get_designation_database', 'AdminController@get_designation_database' );
Route::post( 'get_designation_details', 'AdminController@get_designation_details' );
Route::post( 'update_designation_details', 'AdminController@update_designation_details' );
Route::post( 'process_designation_status', 'AdminController@process_designation_status' );
Route::post( 'process_designation_delete', 'AdminController@process_designation_delete' );

// Designation
Route::post('add_state_process', 'AdminController@add_state_process');
Route::post( 'get_state_database', 'AdminController@get_state_database' );
Route::post( 'get_state_details', 'AdminController@get_state_details' );
Route::post( 'update_state_details', 'AdminController@update_state_details' );
Route::post( 'process_state_status', 'AdminController@process_state_status' );
Route::post( 'process_state_delete', 'AdminController@process_state_delete' );

// Zone
Route::post('add_zone_process', 'AdminController@add_zone_process');
Route::post( 'get_zone_database', 'AdminController@get_zone_database' );
Route::post( 'get_zone_details', 'AdminController@get_zone_details' );
Route::post( 'update_zone_details', 'AdminController@update_zone_details' );
Route::post( 'process_zone_status', 'AdminController@process_zone_status' );
Route::post( 'process_zone_delete', 'AdminController@process_zone_delete' );

// Band
Route::post('add_band_process', 'AdminController@add_band_process');
Route::post( 'get_band_database', 'AdminController@get_band_database' );
Route::post( 'get_band_details', 'AdminController@get_band_details' );
Route::post( 'update_band_details', 'AdminController@update_band_details' );
Route::post( 'process_band_status', 'AdminController@process_band_status' );
Route::post( 'process_band_delete', 'AdminController@process_band_delete' );

// Client
Route::post('add_client_process', 'AdminController@add_client_process');
Route::post( 'get_client_database', 'AdminController@get_client_database' );
Route::post( 'get_client_details', 'AdminController@get_client_details' );
Route::post( 'update_client_details', 'AdminController@update_client_details' );
Route::post( 'process_client_status', 'AdminController@process_client_status' );
Route::post( 'process_client_delete', 'AdminController@process_client_delete' );

// Welcome Aboard
Route::get('welcome_aboard', 'CandidateController@welcome_aboard')->name('welcome_aboard');
Route::post('add_welcome_aboard_process', 'CandidateController@add_welcome_aboard_process');

// View Welcome Aboard
Route::get('view_welcome_aboard', 'CandidateController@view_welcome_aboard')->name('view_welcome_aboard');
Route::post( 'get_welcome_aboard_details', 'CandidateController@get_welcome_aboard_details' );
Route::get('welcome_aboard_generate_pdf','CandidateController@welcome_aboard_generate_pdf');

/*image upload profile*/
Route::post('profile_upload_images', 'AdminController@storeImage');
Route::post('profile_display_images', 'AdminController@PreviewImage');
Route::get('roles_s', 'AdminController@roles_s')->name('roles_s');

/*roles*/
Route::post('add_roles_process', 'AdminController@add_roles_process');
Route::post('get_role_data', 'AdminController@get_role_data');
Route::post( 'get_role_details_pop', 'AdminController@get_role_details_pop' );
Route::post( 'update_role_unit_details', 'AdminController@update_role_unit_details' );

/*profile document*/
Route::post('add_skill_set','DocumentsController@add_skill_set');
Route::post('documents_insert','DocumentsController@store')->name('Documents');
Route::post('documents_info_pro', 'DocumentsController@doc_information');
Route::post('profile_account_info_add', 'DocumentsController@profile_account_add');
Route::post('account_info_get', 'DocumentsController@account_info_get_res');
Route::post('education_information_insert', 'DocumentsController@education_information_add');
Route::post('education_information_view', 'DocumentsController@education_info_view');
Route::post('experience_info_view', 'DocumentsController@experience_info_result');
Route::post('add_contact_info', 'DocumentsController@add_contact_info');
Route::post('Contact_info_view', 'DocumentsController@Contact_info_view');
Route::post('add_family_add', 'DocumentsController@add_family_add');
Route::post('family_information_view', 'DocumentsController@family_information_view');
Route::post('experience_information', 'DocumentsController@experience_information');
/*session sidebar*/
Route::post('get_session_sidebar', 'SidebarController@get_session_sidebar');
Route::post('state_get', 'DocumentsController@state_get');
Route::post('get_district', 'DocumentsController@get_district');
Route::post('get_district_cur', 'DocumentsController@get_district_cur');
Route::post('get_town_name', 'DocumentsController@get_town_name');
Route::post('get_town_name_curr', 'DocumentsController@get_town_name_curr');

/*roles*/
Route::post('add_roles_process', 'AdminController@add_roles_process');
Route::post('get_role_data', 'AdminController@get_role_data');
Route::post( 'get_role_details_pop', 'AdminController@get_role_details_pop' );
Route::post( 'update_role_unit_details', 'AdminController@update_role_unit_details' );

// View Welcome Aboard
Route::get('view_welcome_aboard_hr', 'HrController@view_welcome_aboard_hr')->name('view_welcome_aboard_hr');
Route::post( 'get_welcome_aboard_details_hr', 'HrController@get_welcome_aboard_details_hr' );
Route::post('welcome_aboard_generate_image','HrController@welcome_aboard_generate_image');
Route::post('welcome_aboard_image_show','HrController@welcome_aboard_image_show');

/*employe list edit*/
Route::post('get_role_type', 'AdminController@get_role_type');
Route::post( 'get_employee_pop', 'AdminController@get_employee_pop' );
Route::post('update_employee_list_pop', 'AdminController@update_employee_list_pop');

// banner image
Route::post('banner_image_crop', 'DocumentsController@imageCropPost');
Route::post('profile_banner', 'DocumentsController@profile_banner');

/*ID Card*/
// Route::get('id_card_varification', 'CommonController@id_card_varification');
Route::post('idcard_info', 'CommonController@idcard_info');
Route::post('idcard_info_save', 'CommonController@idcard_info_save');

//Employee List
Route::post('get_employee_list', 'AdminController@get_employee_list' );

// Document Centre for Candidate
Route::get('document_center', 'CandidateController@document_center')->name('document_center');
Route::get('payslip', 'CandidateController@payslip')->name('payslip');
Route::get('documents_candidate', 'CandidateController@documents_candidate')->name('documents_candidate');

Route::get('id_card_varification', 'CommonController@id_card_varification');
/*hr id card process*/
Route::get('hr_id_card_verification', 'CommonController@hr_id_card_verification');
Route::post('hr_get_id_card_vari', 'CommonController@hr_get_id_card_vari');
Route::post('hr_idcard_verfi', 'CommonController@hr_idcard_verfi');
Route::post('hr_id_remark', 'CommonController@hr_id_remark');   

// People
Route::get('people', 'PeopleController@people')->name('people');
Route::get('fetch_people_list_filter', 'PeopleController@fetch_people_list_filter')->name('fetch_people_list_filter');
Route::get('fetch_people_list_filter_starred', 'PeopleController@fetch_people_list_filter_starred')->name('fetch_people_list_filter_starred');
Route::get('fetch_people_starred_first_empid', 'PeopleController@fetch_people_starred_first_empid')->name('fetch_people_starred_first_empid');
Route::get('fetch_people_everyone_first_empid', 'PeopleController@fetch_people_everyone_first_empid')->name('fetch_people_everyone_first_empid');
Route::get('fetch_starred_customusers_list', 'PeopleController@fetch_starred_customusers_list')->name('fetch_starred_customusers_list');
Route::get('fetch_everyone_customusers_list', 'PeopleController@fetch_everyone_customusers_list')->name('fetch_everyone_customusers_list');
Route::get('fetch_people_list_filter_star', 'PeopleController@fetch_people_list_filter_star')->name('fetch_people_list_filter_star');
Route::get('fetch_people_list_filter_img', 'PeopleController@fetch_people_list_filter_img')->name('fetch_people_list_filter_img');
Route::post('fetch_people_star_add', 'PeopleController@fetch_people_star_add')->name('fetch_people_star_add');

//vignesh routes for check user status

Route::post('check_user_status','CommonController@check_user_status');
Route::get('organisation_one', 'CommonController@organisation_one');
Route::get('organization_charts', 'CommonController@organization_charts');
Route::post('supervisor_wise_organisation','CommonController@supervisor_wise_TreeData');

Route::get('can_hr_profile','HrController@can_hr_profile');

// Company Policies for Admin
Route::get('company_policies', 'AdminController@company_policies')->name('company_policies');
Route::post('add_policy_category_process', 'AdminController@add_policy_category_process');
Route::post('get_policy_category_details', 'AdminController@get_policy_category_details');

Route::post('experience_info_hr', 'CommonController@experience_info_hr_info');
Route::post('family_information_hr', 'CommonController@family_information_hr');
Route::post('Contact_info_hr', 'CommonController@Contact_info_hr');
Route::post('account_info_hr', 'CommonController@account_info_hr');
Route::post('education_information_hr', 'CommonController@education_information_hr');

/*password change*/
Route::get( 'change_password', 'CommonController@change_password' )->name('change_password');
Route::post( 'change_password_process', 'CommonController@change_password_process' );
Route::post('Insert_policy_information','AdminController@add_policy_information_process');
Route::post( 'get_company_policy_infomation_database', 'AdminController@get_company_policy_infomation_database' );
Route::post( 'get_policy_information_details', 'AdminController@get_policy_information_details' );
Route::post( 'edit_policy_information_details', 'AdminController@edit_policy_information_details' );
Route::post( 'process_policy_information_status', 'AdminController@process_policy_information_status' );
Route::post( 'process_policy_information_delete', 'AdminController@process_policy_information_delete' );

/*forgot password*/
Route::get('forgetPassword', 'LoginController@showForgetPasswordForm');
Route::post('forgot_pass_process','LoginController@submitForgetPasswordForm');
Route::get('/email_pass/{token}','LoginController@email_pass');
Route::post('con_pass_process','LoginController@con_pass_process');
Route::post('getemail_process','LoginController@getemail_process');

/*chat*/
Route::get('chat_process','CommonController@chat_process');
/*my_team*/
Route::get('my_team','CommonController@my_team');
Route::get('my_team_tl_info','CommonController@my_team_tl_info');

// Company Policy Candidate
Route::get('company_policy_candidate', 'CandidateController@company_policy_candidate')->name('company_policy_candidate');
Route::post('get_policy_category_candidate_details', 'CandidateController@get_policy_category_candidate_details');
Route::post('get_policy_information_candidate_details', 'CandidateController@get_policy_information_candidate_details');

//vignesh code for sticky code
Route::post('Store_Sticky_Notes','CommonController@Store_Sticky_Notes');
Route::get('Get_Notes_info','CommonController@Fetch_notes_info');
Route::post('Get_Notes_info_id_wise','CommonController@Get_Notes_info_id_wise');
Route::post('Edit_Sticky_Notes','CommonController@Edit_Sticky_Notes');
Route::post('Delete_Sticky_note','CommonController@Destroy_Sticky_note');
Route::post('Wrf_user_sigin','CommonController@User_Activity_signin');
Route::post('Wrf_user_signout','CommonController@User_Activity_signout');


// epf by Durga
Route::get('epf', 'CandidateController@epf')->name('epf');
Route::post('save_epf_form', 'CandidateController@save_epf_form')->name('save_epf_form');
Route::post('view_epf', 'CandidateController@view_epf')->name('view_epf');
Route::get('view_epf_form', 'CandidateController@view_epf_form')->name('view_epf_form');

// medical by Durga
Route::get('medical_form', 'CandidateController@medical_form')->name('medical_form');
Route::post('save_medical_form', 'CandidateController@save_medical_form')->name('save_medical_form');
Route::get('view_medical_form', 'CandidateController@view_medical_form')->name('view_medical_form');

//view epf in hrss by Durga
Route::post('view_epf_form_hr', 'HrController@view_epf_form_hr')->name('view_epf_form_hr');
Route::get('view_can_epf', 'HrController@view_can_epf')->name('view_can_epf');
Route::post('update_epf_form_hr', 'HrController@update_epf_form_hr')->name('update_epf_form_hr');
Route::post('epf_details', 'HrController@epf_details')->name('epf_details');
Route::get('epf_list', 'HrController@epf_list')->name('epf_list');
Route::get('medical_list', 'HrController@medical_list')->name('medical_list');
Route::post('medical_details', 'HrController@medical_details')->name('medical_details');

// Leave Balance for Candidate
Route::get('leave_balance', 'CandidateController@leave_balance')->name('leave_balance');
Route::post('get_leave_masters_details', 'CandidateController@get_leave_masters_details');

// Leave Apply for Candidate
Route::get('leave_apply', 'CandidateController@leave_apply')->name('leave_apply');

//goals
Route::get('get_hr_goal_list','GoalsController@get_hr_goal_list');
Route::get('goals_sup_th_check','GoalsController@goals_sup_th_check');
Route::get('get_supervisor','GoalsController@get_supervisor');
Route::post('fetch_reviewer_res','GoalsController@fetch_reviewer_res');
Route::post('get_reviewer_list','GoalsController@get_reviewer_list');
Route::post('get_team_member_list','GoalsController@get_team_member_list');
Route::get('get_hr_supervisor','GoalsController@get_hr_supervisor');
Route::post('get_hr_goal_list_tbl','GoalsController@get_hr_goal_list_tbl');
Route::post('get_manager_lsit_drop','GoalsController@get_manager_lsit_drop');
Route::post('get_team_member_drop','GoalsController@get_team_member_drop');
Route::post('hr_list_tab_record','GoalsController@hr_list_tab_record');
Route::get('get_grade','GoalsController@get_grade');
Route::get('get_department','GoalsController@get_department');
// Route::post('get_goal_myself_listing','GoalsController@get_goal_myself_listing');

Route::post('get_goal_setting_reviewer_details_tl', 'GoalsController@get_goal_setting_reviewer_details_tl');

//vignesh code for supervisor filter business head wise
Route::post('get_supervisor_data_bh','GoalsController@select_supervisor_data_bh');
Route::get('get_reviewer_data_bh','GoalsController@select_reviewer_data_bh');
Route::post('get_reviewer_filter_url','GoalsController@select_reviewer_filter_bh');
Route::get('get_all_member_info','GoalsController@select_all_member_info');
Route::post('get_all_memer_filter_url','GoalsController@get_all_memer_filter_url');
Route::get('get_all_supervisors_info_bh','GoalsController@get_all_supervisors_info_bh');
Route::get('goal_setting_bh_reviewer_view','GoalsController@goal_setting_bh_reviewer_view');
Route::post('update_bh_goals','GoalsController@update_bh_goals');
Route::post('Update_bh_status','GoalsController@Change_Bh_status');
Route::post('add_goals_data_hr_sup', 'GoalsController@add_goals_data_hr_sup');
Route::post('Update_bh_status_only','GoalsController@Change_bh_status_only');
Route::post('add_goals_data_hr_sup', 'GoalsController@add_goals_data_hr_sup');
Route::post('add_goals_data_hr_save', 'GoalsController@add_goals_data_hr_save');
Route::post('pms_employeee_mail','GoalsController@pms_employeee_mail');
Route::post('update_goals_hr_reviewer_tm', 'GoalsController@update_goals_hr_reviewer_tm');
Route::post('save_hr_reviewer', 'GoalsController@save_hr_reviewer');
Route::post('update_goals_sup_reviewer_tm_save', 'GoalsController@update_goals_sup_reviewer_tm_save');
Route::post('get_goal_setting_hr_details_tl', 'GoalsController@get_goal_setting_hr_details_tl');
Route::post('fetch_button_base_dt', 'GoalsController@fetch_button_base_dt');


Route::post('fetch_goals_hr_details_hr', 'GoalsController@fetch_goals_hr_details_hr');
Route::post('check_role_type_hr', 'GoalsController@check_role_type_hr');
Route::get('pms_conformation', 'CommonController@pms_conformation');
Route::post('pms_conformation_sub', 'CommonController@pms_conformation_sub');
Route::post('check_user_pms', 'CommonController@check_user_pms');
Route::post('pms_status_popup', 'CommonController@pms_status_popup');
Route::post('pms_status_popup_naps', 'CommonController@pms_status_popup_naps');
Route::post('remove_display_image', 'CommonController@remove_display_image');
Route::get('login_user_eligible', 'GoalsController@login_user_eligible')->name('login_user_eligible');
Route::get('login_user_sheet_added', 'GoalsController@login_user_sheet_added')->name('login_user_sheet_added');
Route::get('hr_remarks_rate_text', 'GoalsController@hr_remarks_rate_text')->name('hr_remarks_rate_text');
Route::get('reviewer_remarks_rate_text', 'GoalsController@reviewer_remarks_rate_text')->name('reviewer_remarks_rate_text');
Route::post('update_goals_sup_reviewer_tm_hr', 'GoalsController@update_goals_sup_reviewer_tm_hr');

Route::get('hike_hide_and_show_in_reviewer', 'GoalsController@hike_hide_and_show_in_reviewer')->name('hike_hide_and_show_in_reviewer');
Route::get('hike_hide_and_show_in_reviewer_hr', 'GoalsController@hike_hide_and_show_in_reviewer_hr')->name('hike_hide_and_show_in_reviewer_hr');

//EXPORT
Route::post('Employee_Goal_report', 'GoalsController@gen_excel');
Route::post('sup_goal_report_reviewer', 'GoalsController@sup_goal_report_reviewer');
Route::post('rev_goal_report_reviewer', 'GoalsController@rev_goal_report_reviewer');
Route::post('rev_goal_report_reviewer_hr', 'GoalsController@rev_goal_report_reviewer_hr');
Route::post('sup_goal_report_reviewer_hr', 'GoalsController@sup_goal_report_reviewer_hr');
Route::post('Hr_report_reviewer_excel', 'GoalsController@Hr_report_reviewer_excel');
Route::post('org_report_reviewer_excel', 'GoalsController@org_report_reviewer_excel');
Route::post('get_reviewer_filter_info','GoalsController@get_reviewer_filter_info');
Route::get('fetch_team_leader_wise_filter','GoalsController@fetch_team_leader_wise_filter');


Route::post('Generate_Bh_excel','GoalsController@Business_Head_Report');
// Route::post('rev_goal_report_reviewer','GoalsController@rev_goal_report_reviewer');
Route::post('Business_Head_emp_excel','GoalsController@Business_Head_emp_excel');

// Goals Chart
Route::get('pms_report','GoalsController@pms_report');
Route::get('bh_rating_chart', 'GoalsController@bh_rating_chart')->name('bh_rating_chart');
Route::get('bh_rating_chart_js', 'GoalsController@bh_rating_chart_js')->name('bh_rating_chart_js');
Route::get('bh_line_dept_rating_chart', 'GoalsController@bh_line_dept_rating_chart')->name('bh_line_dept_rating_chart');
Route::get('pms_report_year_filter_op', 'GoalsController@pms_report_year_filter_op')->name('pms_report_year_filter_op');
Route::get('pms_pie_dept_filter_op', 'GoalsController@pms_pie_dept_filter_op')->name('pms_pie_dept_filter_op');
Route::get('pms_pie_rev_filter_op', 'GoalsController@pms_pie_rev_filter_op')->name('pms_pie_rev_filter_op');

Route::get('assessment_report','GoalsController@assessment_report');
Route::get('self_assessment_pie_chart_rating', 'GoalsController@self_assessment_pie_chart_rating')->name('self_assessment_pie_chart_rating');
Route::get('get_supervisor_status_pie_chart', 'GoalsController@get_supervisor_status_pie_chart')->name('get_supervisor_status_pie_chart');
Route::get('get_reviewer_status_pie_chart', 'GoalsController@get_reviewer_status_pie_chart')->name('get_reviewer_status_pie_chart');
Route::get('get_hr_status_pie_chart', 'GoalsController@get_hr_status_pie_chart')->name('get_hr_status_pie_chart');
Route::get('get_bh_status_pie_chart', 'GoalsController@get_bh_status_pie_chart')->name('get_bh_status_pie_chart');

// checkbox process in Supervisor login
Route::post('pms_checkbox_data_save','GoalsController@pms_checkbox_data_save');
Route::post('pms_checkbox_data_submit','GoalsController@pms_checkbox_data_submit');
// checkbox process in Reviewer login
Route::post('pms_checkbox_data_save_for_reviewer_login','GoalsController@pms_checkbox_data_save_for_reviewer_login');
Route::post('pms_checkbox_data_submit_for_reviewer_login','GoalsController@pms_checkbox_data_submit_for_reviewer_login');
// checkbox process in HR login
Route::post('pms_checkbox_data_save_for_hr_login','GoalsController@pms_checkbox_data_save_for_hr_login');
Route::post('pms_checkbox_data_submit_for_hr_login','GoalsController@pms_checkbox_data_submit_for_hr_login');


Route::get('AddEmployee','HrController@AddEmployee');
Route::post('AddEmployee_info','HrController@StoreEmployee_info');


//vignesh routes for hronboarding process auto employee id creation

Route::post('Auto_employee_IdGeneration','HrController@AutoEmployeeIdGeneration');
// krish
Route::post('hr_profile_banner', 'CommonController@hr_profile_banner');
/*remove a doc */
Route::post('remove_slide_pay_doc', 'CommonController@remove_slide_pay_doc');
Route::post('add_skill_set_hr_sd', 'DocumentsController@add_skill_set_hr_sd');
Route::post('tag_iput_val', 'DocumentsController@tag_iput_val');
Route::post('hr_update_contact_info', 'DocumentsController@hr_update_contact_info');
Route::post('Contact_info_hr_get', 'DocumentsController@Contact_info_hr_get');
Route::post('get_qualification_list', 'DocumentsController@get_qualification_list');
Route::post('get_course', 'DocumentsController@get_course');
Route::post('hr_information_save', 'DocumentsController@hr_information_save');
Route::post('get_emp_list', 'DocumentsController@get_emp_list');
Route::post('get_Department_list', 'DocumentsController@get_Department_list');
Route::post('get_Designation', 'DocumentsController@get_Designation');
Route::post('get_work_location', 'DocumentsController@get_work_location');
Route::post('get_grade', 'DocumentsController@get_grade');
Route::post('hr_working_information', 'DocumentsController@hr_working_information');
// Route::post('hr_profile_banner', 'CommonController@hr_profile_banner');

Route::post('hr_pms_checkbox_data_save','GoalsController@hr_pms_checkbox_data_save');
Route::post('hr_pms_checkbox_data_submit','GoalsController@hr_pms_checkbox_data_submit');
Route::post('bh_sup_pms_checkbox_data_submit','GoalsController@bh_sup_pms_checkbox_data_submit');
Route::post('bh_sup_pms_checkbox_data_save','GoalsController@bh_sup_pms_checkbox_data_save');

Route::get('get_all_sup_info_bh','GoalsController@get_all_sup_info_bh');
Route::post('employee_ctc_pdf_create','CtcController@employee_ctc_pdf_create');
Route::post('followup_information','DocumentsController@followup_information');

Route::post('doc_information_hr', 'DocumentsController@doc_information_hr');
Route::post('my_team_experience_info', 'CommonController@my_team_experience_info');
Route::get('my_team_profile_view','CommonController@my_team_profile_view');
Route::post('my_team_profile','CommonController@my_team_profile');
Route::post('Contact_info_view_myteam','DocumentsController@Contact_info_view_myteam');
Route::post('my_team_account_info', 'CommonController@my_team_account_info');
Route::post('my_team_experience_info_profile', 'CommonController@my_team_experience_info_profile');
Route::post('my_team_education_info_view', 'CommonController@my_team_education_info_view');
Route::post('my_team_family_information', 'CommonController@my_team_family_information');
Route::post('my_team_followup_information','CommonController@my_team_followup_information');



