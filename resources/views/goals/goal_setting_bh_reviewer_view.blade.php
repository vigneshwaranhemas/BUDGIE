@extends('layouts.simple.candidate_master')
@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
@endsection

@section('style')
<style>
    #goal_sheet_edit{
        position: relative;
        margin-left: 1258px;
        margin-bottom: 24px;
    }
    /* #goal_sheet_add{
        position: relative;
        margin-left: 1258px;
        margin-bottom: 24px;
    } */
    .goals-header
    {
        padding: 0.55rem 1.15rem 0.1rem;
    }
    table.dataTable select{
        border-radius: unset !important;
    }
</style>
@endsection

@section('breadcrumb-title')
    <h2>Performance Management System</h2>
@endsection

@section('breadcrumb-items')
<a class="btn btn-sm text-white" style="background-color: #FFD700;" title="Significantly Exceeds Expectations">SEE</a>
<a class="btn btn-sm text-white m-l-10" style="background-color: #008000;" title="Exceeded Expectations">EE</a>
<a class="btn btn-sm btn-success m-l-10 text-white" title="Met Expectations">ME</a>
<a class="btn btn-sm m-l-10 text-white" style="background-color: #FFA500" title="Partially Met Expectations">PME</a>
<a class="btn btn-sm m-l-10 text-white" style="background-color: #FF0000;" title="Needs Development">ND</a>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="ribbon-vertical-right-wrapper card">
                    <div class="card-body">
                        <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 107px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;">PMS</span></div>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Name :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{$user_info->username }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Emp ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{ $user_info->empID }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Supervisor :</h6>
                                    </div>
                                    <div class="col-md-47 m-t-10">
                                        <p>{{ $user_info->sup_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Supervisor ID :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $user_info->sup_emp_code }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> HRBP :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>Rajesh M S</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> HRBP ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>900380</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Department :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $user_info->department }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Reviewer :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{$user_info->reviewer_name }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Reviewer ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{$user_info->reviewer_emp_code }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div> --}}
                    <div class="ribbon-vertical-right-wrapper card">
                        <div class="card-body">
                         <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 70px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;">PMS</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-0"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p id="empID" class="f-w-900" style="font-size: 16px;">{{ $user_info['data']->empID }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-id-card"> </i> R.Manager ID :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="sup_emp_code" class="f-w-900" style="font-size: 16px;">{{ $user_info['data']->sup_emp_code }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-id-card"> </i>  Reviewer ID :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="reviewer_emp_code" class="f-w-900" style="font-size: 16px;">{{ $user_info['data']->reviewer_emp_code }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-id-card"> </i>  HRBP ID :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p class="f-w-900" style="font-size: 16px;">900380</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row" style="margin-left: -102px;">
                                        <div class="col-md-6">
                                            <h6 class="mb-0"><i class="icofont icofont-ui-user"> </i> Emp Name :</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p id="username" class="f-w-900" style="text-transform: uppercase;font-size: 16px;">{{ $user_info['data']->username }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0 "><i class="icofont icofont-user-alt-7"> </i> Rep.Manager Name :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="sup_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;">{{ $user_info['data']->sup_name }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-user-alt-7"> </i> Reveiwer Name :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="reviewer_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;">{{ $user_info['data']->reviewer_name }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0 "><i class="icofont icofont-user-male"> </i> HRBP :</h6>
                                        </div>
                                        <div class="col-md-5 m-t-10">
                                            <p class="f-w-900" style="text-transform: uppercase;font-size: 16px;">Rajesh M S</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-0"><i class="icofont icofont-building"> </i> Emp Dept:</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p id="department" class="f-w-900" style="font-size: 16px;">{{ $user_info['data']->department }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-building"> </i> R.Manager Dept :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p class="f-w-900" style="font-size: 16px;">{{ $user_info['sup_emp_code']->department }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-building"> </i> Reviewer Dept :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p class="f-w-900" style="font-size: 16px;">{{ $user_info['reviewer_emp_code']->department }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0"><i class="icofont icofont-building"> </i> HRBP Dept :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p class="f-w-900" style="font-size: 16px;">HR</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="card  card-absolute">
                    <div class="card-header bg-primary goals-header">
                        <h5 class="text-white" id="goals_sheet_head"></h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="user_type" >
                    <div class="table-responsive m-b-15 ">
                        <div class="row">
                            <div class="col-lg-12 m-b-35">
                                <a id="goal_sheet_edit" class="btn btn-warning text-white float-right m-l-10" style="display: none">Edit</a>
                                <div class="row m-t-50">
                                    <div class="col-lg-6">
                                        <h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
                                        <h5>REPORTING MANAGER CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
                                        <h5>BUSINESS HEAD STATUS : <span id="Sheet_status"></span></h5>
                                        <h5>REVIEWER REMARKS : <span id="reviewer_remarks_status_id"></span></h5>
                                        <h5 style="display: none;" id="hr_remarks_id">HR REMARKS : <span id="hr_remarks_status_id"></span></h5>

                                    </div>
                                    <div class="col-lg-6">
                                        <h5>REPORTING MANAGER RECOMMENDATION : <span id="reporting_manager_recommendation_id"></span></h5>
                                        <h5>INCREMENT RECOMMENDED : <span id="increment_recomended_id"></span></h5>
                                        <h5 style="display: none;" id="percentage_id_h">PERCENTAGE : <span id="Percentage_id"></span></h5>
                                        <h5 style="display: none;" id="hike_per_month_id_h">HIKE PER MONTH : <span id="hike_per_month"></span></h5>
                                        <h5>PERFORMANCE IMPROVEMENT : <span id="performance_improvement_id"></span></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <form id="Bh_form_insert">
                            <table class="table  table-border-vertical table-border-horizontal" id="goal-tb">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Key Business Drivers(KBD)</th>
                                        <th scope="col">Key Result Areas(KRA)</th>
                                        <th scope="col">Measurement Criteria (Quantified Measures)</th>
                                        <th scope="col" style="width: 450px;">Self Assessment (Qualitative Remarks) by Employee</th>
                                        <th scope="col">Rating by Employee</th>
                                        <th scope="col" class="supervisor_remarks">Rep.Manager Remarks</th>
                                        <th scope="col" class="supervisor_rating">Rep.Manager Rating</th>
                                        <th scope="col" class="reviewer_remarks">Reviewer Remarks </th>
                                        {{-- <th scope="col">HR Remarks</th> --}}
                                        <th scope="col" class="business_head">Business Head assessment and Approval for Release</th>
                                    </tr>
                                </thead>
                                <tbody id="goals_record">

                                </tbody>
                            </table>
                             <input type="hidden" id="goals_setting_id" name="goals_setting_id">
                             <input type="hidden" id="reviewer_hidden_id" name="reviewer_hidden_id">
                             <input type="hidden" id="bh_status_hidden_id" name="bh_status_hidden_id">



                    </div>

                    <div class="m-t-20 m-b-30" id="save_div">
                        <div class="col-lg-12 row">
                            <div class="col-lg-3" id="consolidated_rating_id" style="display: none">
                                <label>Rep.Manager Consolidated Rating <span style="color: red; font-size: x-large;">*</span></label><br>
                                <select class="form-control" style="width:284px;" id="supervisor_consolidated_rate" name="supervisor_consolidated_rate">
                                    <option value="">...Select...</option>\
                                    <option value="SEE">SEE - Significantly Exceeds Expectations</option>\
                                    <option value="EE">EE - Exceeded Expectations</option>\
                                    <option value="ME">ME - Met Expectations</option>\
                                    <option value="PME">PE - Partially Met Expectations</option>\
                                    <option value="ND">ND - Needs Development</option>\
                                </select>
                                <div class="text-danger supervisor_consolidated_rate_error" id=""></div>
                            </div>
                            <div class="col-lg-3 m-b-20" style="display:none" id="manager_recomendation">
                                <label>Reporting Manager Recommendation <span style="color: red; font-size: x-large;">*</span></label><br>
                                <select class="form-control"  id="supervisor_pip_exit" name="supervisor_pip_exit">
                                <option value="">...Select...</option>
                                <option value="Place employee in PIP" selected>Place employee in PIP</option>
                                <option value="Vertical Movement (Promotion)">Vertical Movement (Promotion)</option>
                                <option value="Horizontal Movement (Role Change)">Horizontal Movement (Role Change)</option>
                                </select>
                                <div class="text-danger supervisor_pip_exit_error" id=""></div>
                            </div>
                            <div class="col-lg-3" id="bh_sheet_approval" style="display: none">
                                <label>Status <span style="color: red; font-size: x-large;">*</span></label><br>
                                <select class="form-control" style="width:265px;" id="Bh_sheet_approval" name="Bh_sheet_approval">
                                    <option value="" selected>...Select...</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Reverted">Reverted</option>
                                </select>
                                <div class="text-danger bh_sheet_approval_error" id=""></div>
                            </div>
                        </div>

                    </div>

                    <div class="m-t-20 m-b-30" id="save_div_rev_mark" style="display: none">
                        <div class="col-lg-12 row">
                            <div class="col-lg-3">
                                <label >Reviewer Remarks<span style="color: red; font-size: x-large;display:none;" id="reviewer_remarks_id_span">*</span></label><br>
                                <textarea id="reviewer_remarks" name="reviewer_remarks" class="form-control"></textarea>
                                <div class="text-danger reviewer_remarks_error" id="reviewer_remarks_error"></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Increment recommended? <span style="color: red; font-size: x-large;">*</span></label><br>
                                <select class="form-control" id="increment_recommended" name="increment_recommended">
                                    <option value="" selected>...Select...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <div class="text-danger increment_recommended_error" id="increment_recommended_error"></div>
                            </div>
                            <div class="col-lg-3" id="increment_percentage_view" style="display: none;">
                                <label style="margin-left: -5px;">Percentage %(Please apply 0 to 50%) <span style="color: red; font-size: x-large;">*</span></label><br>
                                <input type="text" id="increment_percentage" name="increment_percentage" class="form-control">
                                <div class="text-danger increment_percentage_error" id="increment_percentage_error"></div>
                            </div>
                            <div class="col-lg-3" id="increment_per_month_view" style="display: none;">
                                <label style="margin-left: -5px;">Hike Per Month<span style="color: red; font-size: x-large;">*</span></label><br>
                                <input type="text" id="increment_month_wise" name="increment_month_wise" class="form-control">
                                <div class="text-danger increment_month_wise_error" id="increment_month_wise_error"></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Performance Imporvement <span style="color: red; font-size: x-large;">*</span></label><br>
                                <select class="form-control" id="performance_imporvement" name="performance_imporvement">
                                    <option value="" selected>...Select...</option>
                                    <option value="Not Applicable">Not Applicable</option>
                                    <option value="Yes, PIP for 3 months">Yes, PIP for 3 months</option>
                                    <option value="Yes, PIP for 1 month">Yes, PIP for 1 month</option>
                                    <option value="Yes, PIP and disengagement">Yes, PIP and disengagement</option>
                                </select>
                                <div class="text-danger performance_imporvement_error" id="performance_imporvement_error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="m-b-30 row">
                        <div class="col-lg-3">
                            <a id="goal_sheet_add" class="btn btn-primary text-white m-t-30"  style="display: none;" onclick="data_insert()">Save as Draft</a>
                        </div>
                        <div class="col-lg-2" style="margin-top: 30px;margin-left: -146px;">
                            <a id="overall_submit" class="btn btn-success text-white"  style="display: none">Submit</a>
                        </div>
                        <div class="col-lg-8 m-t-20">
                            <div class="text-danger m-t-15" style="margin-left: -49px;" id="all_feild_required"></div>                                        
                        </div>
                    </div>

                </form>



                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>
    <script src="../assets/js/chat-menu.js"></script>
    <script src="../assets/js/button-tooltip-custom.js"></script>

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $( document ).ready(function() {
            // goal_record();
            $('#goal-tb').DataTable( {
                "searching": false,

                "paging": false,

                "info":     false,

                "fixedColumns":   {

                        left: 6

                    }
            } );

        });
        var params = new window.URLSearchParams(window.location.search);
        var code=params.get('id')
        var id = window.atob(code);
        // console.log(id)
        $('#goals_setting_id').val(id);
        var id = $('#goals_setting_id').val();

        $.ajax({
            url:"{{ url('goals_sheet_head') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                $('#goals_sheet_head').append('');
                $('#goals_sheet_head').append(response);
            },
            error: function(error) {
                console.log(error);
            }

        });

        $("#increment_recommended").on('change', function()
        {
            var increment_recommended_value = $("#increment_recommended").val();
            var payroll_status=@json($user_info['data']->payroll_status);
            if(increment_recommended_value == "yes")
            {
                if(payroll_status=="HEPL"){
                   $('#increment_percentage_view').show();
                }
                if(payroll_status=='NAPS'){
                    $("#increment_per_month_view").show();
                }   
            }
            else{
                 if(payroll_status=="HEPL"){ 
                      $('#increment_percentage_view').hide();
                }
                if(payroll_status=='NAPS'){
                      $('#increment_per_month_view').hide();
                }   
            }

            if(increment_recommended_value == "no")
            {
                $("#increment_percentage").val("");
                $("#increment_month_wise").val("")
            }
        });

        $.ajax({
            url:"{{ url('fetch_goals_reviewer_details') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                $('#goal-tb').DataTable().clear().destroy();
                $('#goals_record').append('');
                $('#goals_record').append(response.html);
                    $("#reviewer_hidden_id").val(response.reviewer)
                    $("#bh_status_hidden_id").val(response.get_sheet_status.bh_tb_status);
                    if(response.get_sheet_status.bh_tb_status==1){
                        $("#overall_submit").hide();
                        $("#goal_sheet_edit").show();
                        $("#overall_submit_1").show();
                    }
                    else{
                        $("#overall_submit").hide();
                        $("#goal_sheet_edit").show();
                    }
                    if(response.reviewer==1){
                     $(".supervisor_remarks").hide();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                 }
                 else if(response.reviewer==2){
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                 }
                 else{
                    $("#hr_remarks_id").show();
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                     $("#consolidated_rating_id").hide();

                 }
                 $("#supervisor_consolidated_rate").val(response.get_sheet_status.supervisor_consolidated_rate).trigger('change')
                 $("#user_type").val(response.reviewer);
                 $("#employee_consolidate_rate_show").text(response.get_sheet_status.employee_consolidated_rate);
                 $("#supervisor_consolidate_rate_show").text(response.get_sheet_status.supervisor_consolidated_rate);
                 $("#reviewer_remarks").text(response.get_sheet_status.reviewer_remarks);
                 $("#increment_recommended").val(response.get_sheet_status.increment_recommended).trigger('change');
                 $("#increment_percentage").val(response.get_sheet_status.increment_percentage);
                 $("#increment_month_wise").val(response.get_sheet_status.hike_per_month);
                 $("#hike_per_month").text(response.get_sheet_status.hike_per_month);
                 $("#performance_imporvement").val(response.get_sheet_status.performance_imporvement).trigger('change');
                 $("#reporting_manager_recommendation_id").text(response.get_sheet_status.supervisor_pip_exit);
                 $("#increment_recomended_id").text(response.get_sheet_status.increment_recommended).trigger('change');
                 $("#Percentage_id").text(response.get_sheet_status.increment_percentage);
                 $("#performance_improvement_id").text(response.get_sheet_status.performance_imporvement);
                 $("#reviewer_remarks_status_id").text(response.get_sheet_status.reviewer_remarks);
                 $("#hr_remarks_status_id").text(response.get_sheet_status.hr_remarks);
                 if(response.get_sheet_status.supervisor_pip_exit==""){
                  $("#supervisor_pip_exit").val('');
                 }
                 else{
                   $("#supervisor_pip_exit").val(response.get_sheet_status.supervisor_pip_exit).trigger('change');
                 }

                 if(response.get_sheet_status.goal_status==""){
                  $("#Bh_sheet_approval").val('');
                 }
                 else{
                    $("#Bh_sheet_approval").val(response.get_sheet_status.goal_status).trigger('change');
                 }
                 $("#Sheet_status").text(response.get_sheet_status.goal_status)

                 if(response.get_sheet_status.bh_status==1){
                     $("#goal_sheet_edit").hide();
                     $('#overall_submit').hide();
                     $("#overall_submit_1").hide();
                 }
                 var payroll_status=@json($user_info['data']->payroll_status);
                 if(payroll_status=='HEPL'){
                        $("#percentage_id_h").show();
                        $("#hike_per_month_id_h").hide();
                 }
                 else{
                        $("#hike_per_month_id_h").show();
                        $("#percentage_id_h").hide(); 
                 }


                 $('#goal-tb').DataTable( {
                        "searching": false,
                        "paging": false,
                        "info":     false,
                        "fixedColumns":   {
                                left: 6
                            }
                    } );

            },
            error: function(error) {
                console.log(error);

            }

        });


      $(()=>{
          $("#goal_sheet_edit").on('click',()=>{
              var i=1;
              var j=1;
              var user_type=$("#user_type").val();
              $("#goal_sheet_edit").hide();
              $("#consolidated_rating_id").show();
              $("#goal_sheet_add").show();
              $("#overall_submit").show();
              $("#overall_submit_1").hide();
              $("#bh_sheet_approval").show();
              $("#save_div_rev_mark").show();
              $("#manager_recomendation").show();
              if(user_type==2){
                $("#reviewer_remarks_id_span").show();
                var k=1;
                $("#goal-tb tbody tr td.supervisor_remarks").each(function(){
                            if($('.p_tag_three_'+k+'').text()!=""){
                                            $('.p_tag_three_'+k+'').remove();
                                            $('.textarea_three').show();
                                            }
                                            else{
                                            $('.textarea_three').show();
                                            }
                         k++;
                            }
                        );

              }
              if(user_type==0){
                var k=1;
                // $("#reviewer_remarks_id_span").show();
                $("#goal-tb tbody tr td.supervisor_remarks").each(function(){
                            if($('.p_tag_three_'+k+'').text()!=""){
                                            $('.p_tag_three_'+k+'').remove();
                                            $('.textarea_three').show();
                                            }
                                            else{
                                            $('.textarea_three').show();
                                            }
                         k++;
                            }
                        );
              }
              $("#goal-tb tbody tr td.business_head").each(function(){
                        if($('.p_tag_one_'+i+'').text()!=""){
                                            $('.p_tag_one_'+i+'').remove();
                                            $('.textarea_one').show();
                                            }

                                            else{

                                            $('.textarea_one').show();

                                            }
                         i++;
                            }
                 );

                        $("#goal-tb tbody tr td.supervisor_rating").each(function(){
                            if($('.p_tag_two_'+j+'').text()!=""){
                                            $('.p_tag_two_'+j+'').remove();
                                            $('.select_one').show();
                                            }
                                            else{
                                            $('.select_one').show();
                                            }
                         j++;
                            }
                        );

                 })



      })

function data_insert(){
    $('#goal_sheet_add').attr('disabled' , true);
    $('#goal_sheet_add').html('Processing');
    $('.color-hider').hide();
     var i=1;
     var j=1;
     var error="";
     var defined_class="business_head";
        if(error==""){
            $.ajax({
            url:"{{ url('update_bh_goals') }}",
            type:"POST",
            data:$('#Bh_form_insert').serialize(),
            dataType : "JSON",
            success:function(data)
            {
                //  console.log(data)
                if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                $('#goal_sheet_add').attr('disabled' , false);
                $('#goal_sheet_add').html('Save As Draft');
                   location.reload(true);
                //  window.location.href='goals';
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();

                    $('#goal_sheet_add').attr('disabled' , false);
                    $('#goal_sheet_add').html('Save As Draft');

                    location.reload(true);
                    // window.location.href='goals';
                }
                


            }
            });
        }
 }


   $(()=>{
       $("#overall_submit").on('click',(e)=>{

            $('#overall_submit').attr('disabled' , true);
            $('#overall_submit').html('Processing');

           e.preventDefault();
            var i=1;
            var j=1;
            var error="";
            var defined_class="business_head";
            $("#goal-tb tbody tr td."+defined_class+"").each(function(){
                var err_div_name = "#bh_sign_off_"+i+"_error";
                            var $errmsg0 = $(err_div_name);
                            $errmsg0.hide();
                            if ($("#bh_sign_off_"+i+"").val() == "" || $("#bh_sign_off_"+i+"").val() == undefined){
                                $errmsg0.html('Approval for released is required').show();
                                error+="error";
                            }
                         i++;
                });
            $("#goal-tb tbody tr td.supervisor_rating").each(function(){
                        var err_div_name = ".sup_rating_"+j+"_error";
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();
                        if ($("#sup_rating"+j+"").val() == "" || $("#sup_rating"+j+"").val() == undefined){
                            $errmsg0.html('Rating  is required').show();
                            error+="error";
                        }
                        j++;
                        });

                if($("#Bh_sheet_approval").val()==null ||  $("#Bh_sheet_approval").val()==""){
                    $(".bh_sheet_approval_error").html("Goal Sheet Approval Status Is Required");
                    error+="error";
                }
              if($('#supervisor_consolidated_rate').val()==""){
                  $('.supervisor_consolidated_rate_error').html("Reporting Manager Consolidated Rate Is Required!...");
                  error+="error";
              }
            //increment recommendation validation  
            var increment_recommended_val = $("#increment_recommended").val();
            var $errmsg3 = $(".increment_recommended_error");
            $errmsg3.hide();
            if(increment_recommended_val == ""){
                $errmsg3.html('Increment Recommended is required').show();
                error+="error";
            }
            //increment percentage validation
             var payroll_status=@json($user_info['data']->payroll_status);
             if(payroll_status=="HEPL" && increment_recommended_val=="yes"){
                    var increment_percentage_val = $("#increment_percentage").val();
                    var $errmsg3 = $(".increment_percentage_error");
                    $errmsg3.hide();
                        if(increment_percentage_val == ""){
                            $errmsg3.html('Increment Percentage is required').show();
                            error+="error";
                        }
             }
             //increment permonth validation
             if(payroll_status=="NAPS" && increment_recommended_val=="yes"){
                 var increment_per_month = $("#increment_month_wise").val();
                    var $errmsg3 = $(".increment_month_wise_error");
                    $errmsg3.hide();
                        if(increment_per_month == ""){
                            $errmsg3.html('Increment Per Month is required').show();
                            error+="error";
                        }
             }

            var performance_imporvement_val = $("#performance_imporvement").val();
            var $errmsg3 = $(".performance_imporvement_error");
            $errmsg3.hide();
            if(performance_imporvement_val == ""){

                $errmsg3.html('Performance Imporvement is required').show();

                error+="error";

            }
          //performance pip validation
            var increment_recommended_val = $("#supervisor_pip_exit").val();
            var $errmsg3 = $(".supervisor_pip_exit_error");
            $errmsg3.hide();
            if(increment_recommended_val == ""){
                $errmsg3.html('Reporting Manager Recommendation is required').show();
                error+="error";
            }
           if($("#reviewer_hidden_id").val()==2){
            var m=1;
            var increment_recommended_val = $("#reviewer_remarks").val();
            var $errmsg3 = $(".reviewer_remarks_error");
            $errmsg3.hide();
            if(increment_recommended_val == ""){
                $errmsg3.html('Reviewer remarks is required').show();
                error+="error";
            }
            $("#goal-tb tbody tr td.supervisor_remarks").each(function(){
                        var err_div_name = ".sup_remarks_"+m+"_error";
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();
                        if ($("#sup_remarks_"+m+"").val() == "" || $("#sup_remarks_"+m+"").val() == undefined){
                            $errmsg0.html('Rep.Manager remarks is required').show();
                            error+="error";
                        }
                        m++;
                    });
           }
           if($("#reviewer_hidden_id").val()==0)
           {
            var  l=1;
            $("#goal-tb tbody tr td.supervisor_remarks").each(function(){
                        var err_div_name = ".sup_remarks_"+l+"_error";
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();
                        if ($("#sup_remarks_"+l+"").val() == "" || $("#sup_remarks_"+l+"").val() == undefined){
                            $errmsg0.html('Rep.Manager remarks is required').show();
                            error+="error";
                        }
                        l++;
                    });
           }
     if(error==""){
            $('#overall_submit').attr('disabled' , true);
            $('#overall_submit').html('Processing');

            var $errmsg4 = $("#all_feild_required");
                $errmsg4.hide();

            $.ajax({
                url:"Update_bh_status",
                type:"POST",
                data:$('#Bh_form_insert').serialize(),
                beforeSend:function(data){
                    console.log("loading!...")
                },
                success:function(response){
                    var data=JSON.parse(response);
                    console.log(data)
                    if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                $('#overall_submit').attr('disabled' , false);
                $('#overall_submit').html('Submit');
                    window.location.href = "goals";
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                    $('#overall_submit').attr('disabled' , false);
                    $('#overall_submit').html('Submit');
                    window.location.href = "goals";

                }
                }
            })
        }else{
            $('#overall_submit').attr('disabled' , false);
            $('#overall_submit').html('Submit');
            var $errmsg4 = $("#all_feild_required");
            $errmsg4.hide();
            $errmsg4.html('All the field is required').show();
            error+="error";
        }

       })
   })

   $('#overall_submit_1').on('click',()=>{
    $.ajax({
                url:"Update_bh_status_only",
                type:"POST",
                data:{id:$("#goals_setting_id").val(),user_type:$("#user_type").val()},
                beforeSend:function(data){
                    console.log("loading!...")
                },
                success:function(response){
                    var data=JSON.parse(response);
                    // console.log(data)
                    if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                 window.location.reload(true);
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                   window.location.reload(true);
                }
                }
            })
   })





$(()=>{
    $.fn.inputFilter = function(callback, errMsg) {
return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
if (callback(this.value)) {
// Accepted value
if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
$(this).removeClass("input-error");
this.setCustomValidity("");
}
this.oldValue = this.value;
this.oldSelectionStart = this.selectionStart;
this.oldSelectionEnd = this.selectionEnd;
} else if (this.hasOwnProperty("oldValue")) {
// Rejected value - restore the previous one
$(this).addClass("input-error");
this.setCustomValidity(errMsg);
this.reportValidity();
this.value = this.oldValue;
this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
} else {
// Rejected value - nothing to restore
this.value = "";
}
});
};
})


$(()=>{
    $("#increment_percentage").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 50); }, "Must be between 0 and 50");
})



    </script>

@endsection

