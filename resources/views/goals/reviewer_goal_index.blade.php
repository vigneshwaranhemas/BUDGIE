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
    #add_goal_btn{
        display:none;
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
        background-color: #FF0000 ;
        color: #fff;
    }
    .card .card-body
    {
        padding: 28px;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Performance Management<span>System</span></h2>
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
                                    <ul class="nav nav-tabs nav-material nav-primary" id="info-tab" role="tablist" style="margin-bottom: -15px;margin-top: -25px;">
                                        <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-home"></i><b>MySelf </b></a>
                                        <div class="material-border"></div>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" id="info-reviewer-tab" data-toggle="tab" href="#info-reviewer" role="tab" aria-controls="info-reviewer" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i><b>AS Reporting Manager </b></a>
                                        <div class="material-border"></div>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-toggle="tab" href="#info-profile" role="tab" aria-controls="info-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i><b>AS Reviewer </b></a>
                                        <div class="material-border"></div>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="info-tabContent">
                                        <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                            <div class="goals-card-div-1 m-t-30">
                                                <a href="add_goal_setting" id="add_goal_btn_hepl" class="add_goal_btn_hepl" style="display:none"><button class="btn btn-primary-gradien mb-2 float-right"style="margin-top: -30px;" type="button" data-original-title="Add Sheet" title="Add Self Assessment Sheet">Add Self Assessment</button></a>
                                                <a href="add_goal_setting_naps" id="add_goal_btn_naps" class="add_goal_btn_naps" style="display:none"><button class="btn btn-primary-gradien mb-2 float-right"style="margin-top: -30px;" type="button" data-original-title="Add Sheet" title="Add Self Assessment Sheet">Add Self Assessment</button></a>
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

                                        <div class="tab-pane fade" id="info-reviewer" role="tabpanel" aria-labelledby="info-reviewer-tab">
                                            <div class="goals-card-div-1 m-t-30">
                                                <div class="row">
                                                    <div class="col-lg-2 m-t-5">
                                                        <label for="Leader">Select Rep.Manager</label>
                                                        <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter" name="team_leader_filter">
                                                            <option value="">...Select...</option>
                                                            @foreach($supervisor_list as $supervisor)
                                                                <option value="{{ $supervisor->empID }}">{{ $supervisor->username }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 m-t-5">
                                                        <label for="Leader">Select Payroll Status</label>
                                                        <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_filter" name="payroll_status_filter">
                                                            <option value="">Select Payroll Status...</option>
                                                            <option value="HEPL">HEPL</option>
                                                            <option value="NAPS">NAPS</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-8 m-t-35">
                                                        <button type="button" id="reviewer_filter_apply" onclick="supervisor_filter_apply();" class="btn btn-success"><i class="ti-save"></i> Apply</button>
                                                        <button type="button" id="reset" onclick="supervisor_filter_reset();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                                        <button type="submit" id="rp_excel_generation_id" class="btn btn-info"><i class="ti-save"></i>Export</button>
                                                    </div>
                                                </div>
                                                <div class="row float-right">
                                                    <div class="col-lg-12 m-t-5 ">
                                                        <button type="submit" id="checkbox_save" style="display: none;" name="checkbox_save" class="btn btn-secondary m-t-5 m-b-10">Save</button>

                                                        <button type="submit" id="checkbox_submit"  style="display: none;" name="checkbox_submit" class="btn btn-primary m-t-5 m-b-10">Submit</button>
                                                    </div>
                                                </div>

                                                <div class="table-responsive m-t-40">
                                                    <table class="table" id="team_member_goal_data">
                                                        <thead>
                                                            <tr>
                                                            {{-- <th scope="col">No</th> --}}
                                                            <th><input class="checkbox_class_all" type="checkbox" name="select_all" value="1" id="example-select-all" style="margin-right: 23px;"></th>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Employee Consolidated Rate</th>
                                                            <th scope="col">Rep.Manager Status</th>
                                                            <th scope="col">Business Head Status</th>
                                                            <!-- <th scope="col">Date</th> -->
                                                            <th scope="col">Rep.Manager Consolidated Rate</th>
                                                            <th scope="col">Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                                                <div class="goals-card-div-1 m-t-30">
                                                    <div class="row">
                                                        <div class="col-lg-2 m-t-5">
                                                            <label for="Leader">Select Rep.Manager</label>
                                                            <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter_for_reviewer" name="team_leader_filter_for_reviewer">

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2 m-t-5">
                                                            <label for="Leader">Select Team Member</label>
                                                            <select class="js-example-basic-single float-right" style="width:300px;" id="team_member_filter" name="team_member_filter">
                                                                <option value="">...Select...</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2 m-t-5">
                                                            <label for="Leader">Select Payroll Status</label>
                                                            <select class="js-example-basic-single float-right" style="width:250px;" id="payroll_status_filter_for_reviewer" name="payroll_status_filter_for_reviewer">
                                                                <option value="">Select Payroll Status...</option>
                                                                <option value="HEPL">HEPL</option>
                                                                <option value="NAPS">NAPS</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-8 m-t-35">
                                                            <button type="button" id="reviewer_filter_apply" onclick="reviewer_filter_apply();" class="btn btn-success"><i class="ti-save"></i> Apply</button>
                                                            <button type="button" id="reset" onclick="reviewer_filter_reset();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                                        </div>
                                                    </div>

                                                    <div class="row float-right">
                                                        <button type="submit" id="reviewer_excel_generation_id" class="btn btn-secondary m-t-20 m-b-20"><i class="ti-save"></i>Export Excel</button>
                                                    </div>

                                                    <div class="table-responsive m-t-40">
                                                        <table class="table" id="team_member_goal_data_for_reviewer">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Employee Name</th>
                                                                <th scope="col">Title</th>
                                                                <th scope="col">Reviewer Status</th>
                                                                <th scope="col">Business Head Status</th>
                                                                <!-- <th scope="col">Date</th> -->
                                                                <th scope="col">Action </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-warningprofile" role="tabpanel" aria-labelledby="pills-warningprofile-tab">
                            <div class="" style="height: 400px;">
                            </div>
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

<script src="../assets/pro_js/reviewer_goal_list.js"></script>
@endsection

