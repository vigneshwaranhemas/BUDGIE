@extends('layouts.simple.candidate_master')

@section('title', 'Goals')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
@endsection

@section('style')
<style>
    .dataTables_wrapper button.goals_btn{
        border-radius: unset !important;
        padding: revert !important;
    }
    .dataTables_wrapper button.goal_btn_status {
        font-weight: revert;
        font-size: revert;
        color: #fff;
        background-color: #7e37d8;
        border: none;
        padding: revert;
        border-radius: revert;
    }
    .card.goals-card-div{
        border-radius: unset !important;
    }
    .card.goals-card-div-1{
        border-radius: unset !important;
        margin-bottom: unset !important;
    }
    .nav-primary .nav-link.active{
        background-color: #80cf00;
        color: #fff;
    }
    .nav-primary .nav-link.nav-link-pms-1{
        background-color: #80cf00;
        color: #fff;        
    }
    .nav-primary .nav-link.nav-link-pms-2{
        background-color: #ff0000;
        color: #fff;        
    }
    #add_goal_btn{
        display:none;
    }
    /* .select2-container .select2-container--default .select2-container--open 
    {
       position: absolute;
        top: 955.861px;
        left: 446.476px;
    } */
</style>
@endsection

@section('breadcrumb-title')
    <h2>Performance Management<span> System</span></h2>
@endsection

@section('breadcrumb-items')
<button style="font-size: 14px; font-weight: 700; padding-left: 9px; padding-right: 9px;" class="btn btn-warning-gradien m-t-10 float-right pms_overview_btn" id="pms_instruction" style="margin-top: -30px;" type="button" data-original-title="PMS Instruction" title="PMS Overview">PMS Overview</button>
<a href="goals_help_desk"><button class="btn btn-info-gradien m-t-10 float-right m-l-10" style="margin-top: -30px; padding-left: 9px; padding-right: 9px;" type="button" data-original-title="PMS Instruction" title="PMS Tutorial">PMS Tutorial</button></a>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body"> 
                <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                        <li class="nav-item"><a class="nav-link nav-link-pms-1" id="pills-warninghome-tab" data-toggle="pill" href="#pills-warninghome" role="tab" aria-controls="pills-warninghome" aria-selected="true"><i class="icofont icofont-ui-home"></i>PMS 2021-2022</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-pms-2" id="pills-warningprofile-tab" data-toggle="pill" href="#pills-warningprofile" role="tab" aria-controls="pills-warningprofile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>PMS 2022-2023</a></li>
                    </ul>                
                    <div class="tab-content" id="pills-warningtabContent">
                        <div class="tab-pane fade show active" id="pills-warninghome" role="tabpanel" aria-labelledby="pills-warninghome-tab">
                            <div class="card goals-card-div">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material nav-primary" id="info-tab" role="tablist" style="margin-top: -25px; margin-bottom: -30px;">
                                    <li class="nav-item"><a class="nav-link active" id="MySelf-info-tab" data-toggle="tab" href="#info-profile" role="tab" aria-controls="info-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i><b>MySelf</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                    @if(Auth::user()->role_type != 'HR Ops')
                                    <li class="nav-item"><a class="nav-link " id="info-home-tab" data-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-home"></i><b>AS Rep.Manager</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="reviewer-info-tab" data-toggle="tab" href="#info-reviewer" role="tab" aria-controls="info-overall" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i><b>AS Reviewer</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-toggle="tab" href="#info-overall" role="tab" aria-controls="info-overall" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i><b>AS HR</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                     @if(Auth::user()->role_type != 'HR Ops')
                                    <li class="nav-item"><a class="nav-link" id="listing-info-tab" data-toggle="tab" href="#info-listing" role="tab" aria-controls="info-listing" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i><b>ORG Level Review</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link" id="report-tab" data-toggle="tab" href="#analytics-report" role="tab" aria-controls="info-profile" aria-selected="false"><i class="icofont icofont-chart"><b></i>Analytics Report</b></a>
                                    <div class="material-border"></div>
                                    </li>
                                </ul>
                                <div class="tab-content" id="info-tabContent">
                                    <!--myself -->
                                    <div class="tab-pane fade show active" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                                        <div class="card-body">
                                            <a href="add_goal_setting" id="add_goal_btn" style="display:none"><button class="btn mb-2 float-right btn-primary-gradien" type="button" data-original-title="Add Sheet" title="Add Self Assessment Sheet">Add Self Assessment</button></a>
                                            <div class="table-responsive">
                                                <table class="table" id="goal_data">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- as supervisor -->
                                    <div class="tab-pane fade" id="info-home" role="tabpanel" aria-labelledby="info-home-tab" style="margin-top: -30px;">       
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select R.Manager</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="supervisor_list" name="supervisor_list">
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Payroll Status</label>
                                                    <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_sup" name="payroll_status_sup">
                                                        <option value="">Select Payroll Status...</option>
                                                        <option value="HEPL">HEPL</option>
                                                        <option value="NAPS">NAPS</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-8 m-t-35">
                                                    <button type="button" id="supervisor_filter" class="btn btn-success"><i class="ti-save"></i> Apply</button>       <button type="button" id="reset" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                                     <button type="submit" id="rp_excel_generation_id_hr" class="btn btn-info"><i class="ti-save"></i>Export</button>                                           
                                                </div>
                                            </div>
                                            <div class="row float-right">
                                                <div class="col-lg-12 m-t-5 ">
                                                    <button type="submit" id="checkbox_save" style="display: none;" name="checkbox_save" class="btn btn-secondary m-t-5 m-b-10">Save</button>

                                                    <button type="submit" id="checkbox_submit"  style="display: none;" name="checkbox_submit" class="btn btn-primary m-t-5 m-b-10">Submit</button>
                                                </div>
                                            </div>

                                            <div class="table-responsive m-t-40">
                                                <table class="table" id="supervisor_goal_data">
                                                    <thead>
                                                        <tr>
                                                        <!-- <th scope="col">No</th> -->
                                                        <th><input class="checkbox_class_all" type="checkbox" name="select_all" value="1" id="example-select-all" style="margin-right: 23px;"></th>
                                                        <th scope="col">Employee Name</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Employee Consolidated Rate</th>
                                                        <th scope="col">Rep.Manager Status</th>
                                                        <th scope="col">Business Head Status</th>
                                                        <th scope="col">Rep.Manager Status</th>
                                                        <th scope="col">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- as reviewer -->
                                    <div class="tab-pane fade" id="info-reviewer" role="tabpanel" aria-labelledby="reviewer-info-tab">                        
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-2 m-t-5">
                                                        <label for="Leader">Select Rep.Manager</label>
                                                        <select class="js-example-basic-single float-right" style="width:300px;" id="supervisor_list_1" name="supervisor_list_1">
                                                            <option value="">...Select...</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 m-t-5">
                                                        <label for="Leader">Select Employee</label>
                                                        <select class="js-example-basic-single float-right" style="width:300px;" id="team_member_filter" name="team_member_filter">
                                                            <option value="">...Select...</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 m-t-5">
                                                        <label for="Leader">Select Payroll Status</label>
                                                        <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_rev" name="payroll_status_rev">
                                                            <option value="">Select Payroll Status...</option>
                                                            <option value="HEPL">HEPL</option>
                                                            <option value="NAPS">NAPS</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 m-t-35">
                                                        <button type="submit" id="reviewer_apply" class="btn btn-success"><i class="ti-save"></i> Apply</button>                              
                                                        <button type="submit" id="rev_reset" class="btn btn-dark"><i class="ti-save"></i> Clear</button>      <button type="submit" id="reviewer_excel_generation_id_hr" class="btn btn-info"><i class="ti-save"></i>Export</button>                                  
                                                    </div>
                                                </div>
                                                <div class="table-responsive m-t-40">
                                                    <table class="table" id="reviewer_tbl">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Reviewer Status</th>
                                                            <th scope="col">Business Head Status</th>
                                                            <th scope="col">Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- as hr -->
                                    <div class="tab-pane fade" id="info-overall" role="tabpanel" aria-labelledby="reviewer-info-tab">                        
                                        <div class="card-body">
                                            
                                            <div class="row">
                                                <div class="container">
                                                    <button class="btn btn-primary" onclick="show_advanced_filter();"><i class="bi bi-funnel-fill"></i> Advanced Filter</button>
                                                    <button type="submit" id="excel_generation_id_hr2" class="btn btn-info "><i class="ti-save"></i>Export</button>
                                                </div>
                                            </div>

                                            <div class="row filter_tool"  id="show_filter_div" style="display:none;">
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Payroll Status</label>
                                                    <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_hr" name="payroll_status_hr">
                                                        <option value="">Select Payroll Status...</option>
                                                        <option value="HEPL">HEPL</option>
                                                        <option value="NAPS">NAPS</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Department</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="department_hr_2" name="department_hr_2">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                 <div class="col-lg-2 m-t-5">
                                                    <label for="Supervisor">Select Reviewer</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="reviewer_filter" name="reviewer_filter">
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Rep.Manager</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter_hr" name="team_leader_filter_hr">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Employee</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="team_member_filter_hr" name="team_member_filter_hr">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Gender</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="gender_hr_2" name="gender_hr_2">
                                                        <option value="">...Select...</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Band</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="grade_hr_2" name="grade_hr_2">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 m-t-35">
                                                    <button type="submit" id="hr_apply" class="btn btn-success"><i class="ti-save"></i> Apply</button>                                            
                                                    <button type="submit" id="hr_reset" onclick="hr_filter_reset();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>                                            
                                                </div>
                                            </div>
                                            <!-- advance filter end -->
                                            <div class="row float-right">
                                                <div class="col-lg-12 m-t-5 ">
                                                    <button type="submit" id="checkbox_save_hr" style="display: none;" name="checkbox_save" class="btn btn-secondary m-t-5 m-b-10">Save</button>
                                                    <button type="submit" id="checkbox_submit_hr"  style="display: none;" name="checkbox_submit" class="btn btn-primary m-t-5 m-b-10">Submit</button>
                                                </div>
                                            </div>
                                            <div class="table-responsive m-t-40">
                                                <table class="table" id="get_hr_goal">
                                                    <thead>
                                                        <tr>
                                                            <th><input class="checkbox_class_all" type="checkbox" name="select_all" value="1" id="hr-example-select-all" style="margin-right: 23px;"></th>
                                                            {{-- <th scope="col">No</th> --}}
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Title</th>                                                            
                                                            <th scope="col">Employee Consolidated Rate</th>
                                                            <th scope="col">R.Manager Consolidated Rate</th>
                                                            <th scope="col">Reviewer Remarks</th>
                                                            <th scope="col">Action To Be Performed</th>
                                                            <!-- <th scope="col">HR Status</th> -->
                                                            <th scope="col">PIP Month</th>
                                                            <th scope="col">Increment Percentage</th>
                                                            <th scope="col">Hike Per Month</th>
                                                            <th scope="col">New Designation</th>
                                                            <th scope="col">New Rep.Manager</th>
                                                            <!-- <th scope="col">HR Remarks</th> -->
                                                            <th scope="col">Business Head Status</th>
                                                            <th scope="col">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>      
                                    <!--ORG Level review -->
                                    <div class="tab-pane fade" id="info-listing" role="tabpanel" aria-labelledby="listing-info-tab">                        
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="container">
                                                    <button class="btn btn-primary" onclick="show_advanced_filter_org();"><i class="bi bi-funnel-fill"></i> Advanced Filter</button>
                                                    <button type="submit" id="org_excel_generation_id" class="btn btn-info"><i class="ti-save"></i>Export</button>
                                                </div>
                                            </div>
                                            <div class="row filter_tool"  id="show_filter_div_org" style="display:none;">
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Payroll Status</label>
                                                    <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_hr_1" name="payroll_status_hr">
                                                        <option value="">Select Payroll Status...</option>
                                                        <option value="HEPL">HEPL</option>
                                                        <option value="NAPS">NAPS</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Department</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="department_hr_1" name="department_hr_1">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                 <div class="col-lg-2 m-t-5">
                                                    <label for="Supervisor">Select Reviewer</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="reviewer_filter_1" name="reviewer_filter_1">
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select R.Manger</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter_hr_1" name="team_leader_filter_hr_1">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Employee</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="team_member_filter_hr_1" name="team_member_filter_hr_1">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Gender</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="gender_hr_1" name="gender_hr_1">
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 m-t-5">
                                                    <label for="Leader">Select Grade</label>
                                                    <select class="js-example-basic-single float-right" style="width:300px;" id="grade_hr_1" name="grade_hr_1">
                                                        <option value="">...Select...</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 m-t-35 float-left">
                                                    <button type="submit" id="list_apply" class="btn btn-success m-b-30"><i class="ti-save"></i> Apply</button>
                                                    <button type="submit" id="myself_reset" class="btn btn-dark m-b-30"><i class="ti-save"></i> Clear</button>
                                                    <!-- <button type="submit" id="org_excel_generation_id" class="btn btn-info m-b-30"><i class="ti-save"></i>Export</button> -->
                                                </div>        
                                                </div>
                                            </div>
                                            <button id="send_mail" style="display:none;" name="send_mail" class="btn btn-primary m-t-5 m-b-10 float-right">Send Mail</button>                                               
                                            <div class="table-responsive">
                                                <table id="listing_table" class="table table-border-vertical table-border-horizontal">
                                                    <thead>
                                                        <tr>
                                                            <th><input class="mail_class" type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Employee ID</th>
                                                            <th scope="col">Goal Name</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Gender</th>
                                                            <th scope="col">Grade</th>
                                                            <th scope="col">Department</th>
                                                            <th scope="col">Employee Consolidated Rate</th>
                                                            <th scope="col">R.Manager Consolidated rate</th>
                                                            <th scope="col" style="min-width: 300px">Reviewer Remarks</th>
                                                            <th scope="col">Supervisor Summary</th>
                                                            <th scope="col">Supervisor Movement Process</th>
                                                            <th scope="col">Reporting Manager Recommendation</th>
                                                            <th scope="col">Increment Recommended</th>
                                                            <th scope="col">Increment Percentage</th>
                                                            <th scope="col">Hike Per Month</th>
                                                            <th scope="col"  style="min-width: 300px">Performance Imporvement</th>
                                                            <th scope="col"  style="min-width: 300px">HR Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    <!-- Analytics  -->
                                    <div class="tab-pane fade" id="analytics-report" role="tabpanel" aria-labelledby="info-profile-tab">                                 
                                        <h5 class="m-t-40"><b>Reporting Manager Consolidated Rating</b></h5>
                                        <div class="row m-t-20">
                                            <div class="col-lg-2">
                                                <label for="yr">Select Year</label>
                                                <select class="js-example-basic-single col-sm-12" style="width:250px" id="pms_pie_year_filter" name="year">                             
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="yr">Select Manager</label>
                                                <select class="js-example-basic-single col-sm-12" style="width:250px"  id="pms_pie_man_filter" name="year">
                                                    <option value="">...Select Manager...</option>
                                                    @foreach($managers as $manager)
                                                    <option value="{{ $manager->empID }}">{{ $manager->username }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            <div class="col-lg-2">
                                                <label for="yr">Select Rep.Manager</label>
                                                <select class="js-example-basic-single col-sm-12"  id="pms_pie_tl_filter" name="year">                              
                                                    <option value="">Select Rep.Manager</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="yr">Select Grade</label>
                                                <select class="js-example-basic-single col-sm-12" id="pms_pie_grade_filter_rep" name="year" style="width:150px;">
                                                    <option value="">...Select Grade...</option>
                                                    @foreach($grade_lists as $grade_list)
                                                    <option value="{{ $grade_list->grade }}">{{ $grade_list->grade }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" id="reset" onclick="rating_filter_clear();" class="btn m-t-30 btn-dark"><i class="ti-save"></i> Clear</button>                                            
                                            </div> 
                                        </div>                  
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="chart-overflow" id="pie-chart2"></div>
                                            </div>
                                            <div class="col-lg-6 wrapper" style="margin-left:-50px;margin-top:50px">
                                                <canvas id="canvas"></canvas>
                                            </div>
                                        </div> 
                                        <div class="row">
                                                <div class="col-sm-12 col-xl-6 box-col-12 xl-100">
                                                    <div class="card">
                                                        <div class="card-body chart-block p-0">
                                                            <div class="row p-30">
                                                                <div class="col-lg-2">
                                                                    <label for="yr">Select Year</label>
                                                                    <select class="js-example-basic-single col-sm-12" style="width:250px" id="pms_pie_year_filter_ar" name="year">
                                                                    </select>
                                                                </div>
                                                                <!-- <div class="col-lg-2">
                                                                    <label for="yr">Select Department</label>
                                                                    <select class="js-example-basic-single col-sm-12" id="pms_pie_dept_filter" name="year">
                                                                        <option value="">...Select Department...</option>
                                                                        @foreach($dept_lists as $dept_list)
                                                                        <option value="{{ $dept_list->department }}">{{ $dept_list->department }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div> -->
                                                                <div class="col-lg-2">
                                                                    <label for="yr">Select Manager</label>
                                                                    <select class="js-example-basic-single col-sm-12" style="width:250px"  id="pms_pie_man_filter_ar" name="year" style="width:150px;">
                                                                        <option value="">...Select Manager...</option>
                                                                        @foreach($managers as $manager)
                                                                        <option value="{{ $manager->empID }}">{{ $manager->username }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>          
                                                                <div class="col-lg-2">
                                                                    <label for="yr">Select Rep.Manager</label>
                                                                    <select class="js-example-basic-single col-sm-12"  id="pms_pie_tl_filter_ar" name="year" style="width:150px;">                              
                                                                        <option value="">Select Rep.Manager</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="yr">Select Grade</label>
                                                                    <select class="js-example-basic-single col-sm-12" id="pms_pie_grade_filter" name="year" style="width:150px;">
                                                                        <option value="">...Select Grade...</option>
                                                                        @foreach($grade_lists as $grade_list)
                                                                        <option value="{{ $grade_list->grade }}">{{ $grade_list->grade }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 31px;">
                                                                    <button type="button" id="reset" onclick="rating_filter_clear_ar();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header" style="padding-top: 20px;padding-bottom: 20px;">
                                                            <h5>Self Assessment Status</h5>
                                                        </div>
                                                        <div class="card-body chart-block p-0">
                                                            <div class="chart-overflow" id="pie-chart3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header" style="padding-top: 20px;padding-bottom: 20px;">
                                                            <h5>Reporting Manager Status</h5>
                                                        </div>
                                                        <div class="card-body chart-block p-0">
                                                            <div class="chart-overflow" id="pie-chart4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header" style="padding-top: 20px;padding-bottom: 20px;">
                                                            <h5>Reviewer Status</h5>
                                                        </div>
                                                        <div class="card-body chart-block p-0">
                                                            <div class="chart-overflow" id="pie-chart5"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header" style="padding-top: 20px;padding-bottom: 20px;">
                                                            <h5>HR Status</h5>
                                                        </div>
                                                        <div class="card-body chart-block p-0">
                                                            <div class="chart-overflow" id="pie-chart6"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header" style="padding-top: 20px;padding-bottom: 20px;">
                                                            <h5>Bussiness Head Status</h5>
                                                        </div>
                                                        <div class="card-body chart-block p-0">
                                                            <div class="chart-overflow" id="pie-chart7"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>                                          
                                    </div>
                                    </div>
                                    <!-- end -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-warningprofile" role="tabpanel" aria-labelledby="pills-warningprofile-tab">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MOdal Fade -->
        <div class="modal fade" id="goalsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form  id="formGoalDelete">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Goal Delete</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure you want to Delete this Record?</h6>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="goals_id_delete" class="form-control">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        
        <!--PMS Instruction -->        
        <div class="modal fade bd-example-modal-lg" id="pmsInstructionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Hello {{ Auth::user()->username }}</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <!-- <h5></h5> -->
                        <p style="text-align: justify;font-size:16px">We are delighted to launch the <b>PAPERLESS SELF ASSESSMENT MODULE</b> for Performance Management System 2021-22, through our new HRMS- BUDGIE.</p>
                        <p style="text-align: justify;font-size:16px">The Self-Assessment Module facilitates eligible employees to summarise <b>individual performance</b> (Self-Assessment) based on <b>management expectations</b> (Goals & Objectives) for the period of evaluation (April 1, 2021, to March 31, 2022).</p>
                        <h5 style="text-align: justify;font-size:16px;color:red;"><strong>ELIGIBILITY :</strong></h5>
                        <p style="text-align: justify;font-size:16px;color:red;"> <strong> Employees who have joined HEPL on January 1, 2022, and later are not eligible.</strong></p>
                        <p style="text-align: justify;font-size:16px;color:red;"><strong>A Separate performance module is applicable for NAPS trainees . </strong> </p>                        
                        <p style="text-align: justify;font-size:16px"><b>Why PMS:</b> </p>
                        <p style="text-align: justify;font-size:16px">A well-defined Performance Management System creates an ongoing dialogue between the employee and reporting manager to define, manage and continually outperform one’s goals and objectives. It also helps to develop a climate of trust, support, and encouragement and builds transparency in the performance evaluation process.</p>
                        <p style="text-align: justify;font-size:16px">The following is the schedule of PMS 2021-22: </p>                        
                        <ul class="pl-4 mb-4 list-circle">
                            <li><p style="text-align: justify;font-size:16px">Self Assessment - By Wednesday, 15th June</p></li>
                            <li><p style="text-align: justify;font-size:16px">Reporting Manager Assessment - By Saturday, 18th June</h5></li>
                            <li><p style="text-align: justify;font-size:16px">Reviewer Assessment - By Monday, 20th June</h5></li>
                            <li><p style="text-align: justify;font-size:16px">PMS Panel Review - By Tuesday, 22nd June</h5></li>
                        </ul>    
                        <p style="text-align: justify;font-size:16px">We welcome the eligible employees to participate in the PMS program as defined above and contribute to the robustness of the evaluation exercises.</p>
                        <p style="text-align: justify;font-size:16px">Please go through the Tutorials on the Module prior to initiating your actions. Throughout this paperless process flow, if you encounter any difficulty or have any unanswered query, please feel free to reach out to your HR Advisor (<span style="color:blue;">dhivya.r@hemas.in</span>) or ping on Teams and we will be more than happy to support. </p>
                        <p style="text-align: justify;font-size:16px">As we interact with the module, we may come across any difficulties or errors. Please reach out to (<span style="color:blue;">ganagavathy.k@hemas.in</span>) with the screenshots and She will be ready with the solutions for us to complete PMS efficiently.</p>
                        <h6><b>Thank you,</b></h6>
                        <h6><b>Human Resources Team - HEPL</b></h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script src="../assets/js/typeahead/handlebars.js"></script>
<script src="../assets/js/typeahead/typeahead.bundle.js"></script>
<script src="../assets/js/typeahead/typeahead.custom.js"></script>
<script src="../assets/js/typeahead-search/handlebars.js"></script>
<script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="../assets/js/chart/chartist/chartist.js"></script>
<script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/dashboard/default.js"></script>
<script src="../assets/js/notify/index.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<!-- Select2 -->
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>

<script src="../assets/pro_js/hr_goals_list.js"></script>
<!-- Plugins JS start-->
<script src="../assets/pro_js/assessment_report.js"></script>
<!-- chart -->
<script src="../assets/js/chart/google/google-chart-loader.js"></script>
<script src="../assets/pro_js/pms_report.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="../assets/pro_js/pms_report_chartjs.js"></script>

<script type="text/javascript">

    function show_advanced_filter(){
    
    if ($('#show_filter_div').css('display') == 'none') {
        $("#show_filter_div").css({ "display" :"flex" });
    }
    else{
        $("#show_filter_div").css({ "display" :"none" });

    }
}
function show_advanced_filter_org(){
    
    if ($('#show_filter_div_org').css('display') == 'none') {
        $("#show_filter_div_org").css({ "display" :"flex" });
    }
    else{
        $("#show_filter_div_org").css({ "display" :"none" });

    }
}

</script>
@endsection

