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
        display: none;
    }
    #goal_sheet_submit{
        position: relative;
        display: none;
    }
     table.dataTable select{
        border-radius: unset !important;
    }
    #sup_setting_excel_generation_id
    {
        display: none;
    }
    #rev_setting_excel_generation_id
    {
        display: none;
    }
    #hr_setting_excel_generation_id
    {
        display: none;
    }
    #org_setting_excel_generation_id
    {
        display: none;
    }
</style>
@endsection

@section('breadcrumb-title')
    <h2>Performance Management<span> System </span></h2>
@endsection

@section('breadcrumb-items')
    <!-- <a class="btn btn-sm text-white" style="background-color: #FFD700;" title="Significantly Exceeds Expectations">SEE</a>                                            
    <a class="btn btn-sm text-white m-l-10" style="background-color: #008000;" title="Exceeded Expectations">EE</a>                                            
    <a class="btn btn-sm btn-success m-l-10 text-white" title="Met Expectations">ME</a>
    <a class="btn btn-sm m-l-10 text-white" style="background-color: #FFA500" title="Partially Met Expectations">PME</a>                                            
    <a class="btn btn-sm m-l-10 text-white" style="background-color: #FF0000;" title="Needs Development">ND</a>   -->

    <a class="btn btn-sm text-white m-l-10" style="background-color: #008000;" title="Exceptional Contributor">EC</a>
	<a class="btn btn-sm btn-success m-l-10 text-white" title="Significant Contributor">SE</a>
	<a class="btn btn-sm m-l-10 text-white" style="background-color: #FFA500" title="Contributor">C</a>
	<a class="btn btn-sm m-l-10 text-white" style="background-color: #FF0000;" title="Partial Contributor">PC</a>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">         
                <div class="ribbon-vertical-right-wrapper card">
                    <div class="card-body">
                        <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 70px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> PMS</span>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <p id="empID" class="f-w-900" style="font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-id-card"> </i> Rep.Manager ID :</h6>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <p id="sup_emp_code" class="f-w-900" style="font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-id-card"> </i>  Reviewer ID :</h6>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <p id="reviewer_emp_code" class="f-w-900" style="font-size: 16px;"></p>
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
                                        <p id="username" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-ui-user"> </i> Rep.Manager Name :</h6>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <p id="sup_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-ui-user"> </i> Reveiwer Name :</h6>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <p id="reviewer_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-ui-user"> </i> HRBP :</h6>
                                    </div>
                                    <div class="col-md-6 m-t-10">
                                        <p class="f-w-900" style="text-transform: uppercase;font-size: 16px;">Rajesh M S</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h6 class="mb-0"><i class="icofont icofont-building"> </i> Emp Dept:</h6>
                                    </div>
                                    <div class="col-md-5">
                                        <p id="department" class="f-w-900" style="font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-building"> </i>Rep.Manager Dept :</h6>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <p id="sup_department" class="f-w-900" style="font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-building"> </i> Reviewer Dept :</h6>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <p id="rev_department" class="f-w-900" style="font-size: 16px;"></p>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <h6 class="mb-0"><i class="icofont icofont-building"> </i> HRBP Dept :</h6>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <p class="f-w-900" style="font-size: 16px;">HR</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
                <div class="card  card-absolute">                   
                    <div class="card-header  bg-primary">
                        <h5 class="text-white" id="goals_sheet_head"></h5>
                    </div>
                    <div class="card-body">
                        <div class="row float-right">
                            <button type="submit" id="sup_setting_excel_generation_id" class="btn btn-secondary m-b-20"><i class="ti-save"></i>Export Excel</button>
                        </div>
                        <div class="row float-right">
                            <button type="submit" id="rev_setting_excel_generation_id" class="btn btn-secondary m-b-20"><i class="ti-save"></i>Export Excel</button>
                        </div>
                        <div class="row float-right">
                            <button type="submit" id="hr_setting_excel_generation_id" class="btn btn-secondary m-b-20"><i class="ti-save"></i>Export Excel</button>
                        </div>
                        <div class="row float-right">
                            <button type="submit" id="org_setting_excel_generation_id" class="btn btn-secondary m-b-20"><i class="ti-save"></i>Export Excel</button>
                        </div>
                        <div class="table-responsive m-b-15 ">
                            <div class="row">
                                <div class="col-lg-12 m-b-35">
                                    <!-- <a id="goal_sheet_edit" class="btn btn-warning text-white float-right" >Edit</a>   -->
                                    <!-- Submit buttons -->  
                                    <div class="row m-t-50">
                                        <div class="col-lg-6">                                                                                                                       
                                            <h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
                                            <h5>REPORTING MANAGER CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>

                                            <h5>REPORTING MANAGER RECOMMENDATION :<span id="supervisor_pip_exit_show"></span></h5>
                                            <div>
                                                <h5>HR REMARKS: <span id="hr_remarks_text"></span></h5>
                                            </div>
                                            <div>
                                                <h5>REVIEWER REMARKS: <span id="reviewer_remarks_val"></span></h5>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div >
                                                <h5>INCREMENT RECOMMENDED: <span id="increment_recommended_val"></span></h5>
                                            </div>
                                            <div>
                                                <h5>INCREMENT PERCENTAGE: <span id="increment_percentage_val"></span></h5>
                                            </div>
                                            <div>
                                                <h5>PERFORMACE IMPORVEMENT: <span id="performance_imporvement_val"></span></h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <form id="goalsForm">
                            <table class="table table-border-vertical table-border-horizontal" id="goals_record_tb">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Key Business Drivers (KBD)</th>
                                        <th scope="col">Key Result Areas (KRA)</th>
                                        <th scope="col">Measurement Criteria (UOM)</th>
                                        <th scope="col">Self Assessment</th>
                                        <th scope="col">Rating By Employee</th>
                                        <th scope="col">Rep.Manager Reamrks </th>
                                        <th scope="col">Rep.Manager Rating </th>
                                        <!-- <th scope="col">Reviewer Remarks </th> -->
                                        <!-- <th scope="col">HR Remarks </th> -->
                                        <!-- <th scope="col">BH Remarks </th> -->
                                        <!-- <th scope="col">Business Head</th> -->
                                    </tr>
                                </thead>
                                <tbody id="goals_record">                                   
                                </tbody>
                            </table>
                            <input type="hidden" name="goals_setting_id" id="goals_setting_id">
                            <!-- <div class="m-t-20 m-b-30 float-right"> -->
                                <div class="m-t-20 m-b-30 row float-right" id="save_div">

                                </div>
                            </div>
                    <div class="m-t-20 m-b-30" id="save_div_rev_mark" style="display: none;" >
                            <div class="col-lg-12 row">
                                <div class="col-lg-3">
                                    <label>Reviewer Remarks</label><br>
                                    <textarea id="reviewer_remarks" name="reviewer_remarks" class="form-control"></textarea>
                                    <div class="text-danger reviewer_remarks_error" id="reviewer_remarks_error"></div>
                                </div>
                                
                                <!-- <div class="col-lg-3">
                                    <label>Increment recommended?</label><br>
                                    <select class="form-control" id="increment_recommended" name="increment_recommended">
                                        <option value="" selected>...Select...</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div class="text-danger increment_recommended_error" id="increment_recommended_error"></div>
                                </div>
                                <div type="hidden" id="increment_hike"></div>
                                <div class="col-lg-3" id="increment_percentage_view">
                                    <label>Percentage % (Please apply 0 to 50%)</label><br>
                                    <input type="text" id="increment_percentage" name="increment_percentage" class="form-control">
                                    <div class="text-danger increment_percentage_error" id="increment_percentage_error"></div>
                                </div>
                                <div class="col-lg-3" id="hike_per_month_view" style="display: none;">
                                    <label>Hike Per Month</label><br>
                                    <input type="text" id="hike_per_month" name="hike_per_month" class="form-control" onkeypress="return isNumber(event)">
                                    <div class="text-danger hike_per_month_error" id="hike_per_month_error"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Performance Imporvement</label><br>
                                    <select class="form-control" id="performance_imporvement" name="performance_imporvement">
                                        <option value="" selected>...Select...</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="Yes, PIP for 3 months">Yes, PIP for 3 months</option>
                                        <option value="Yes, PIP for 1 month">Yes, PIP for 1 month</option>
                                        <option value="Yes, PIP and disengagement">Yes, PIP and disengagement</option>
                                    </select>
                                    <div class="text-danger performance_imporvement_error" id="performance_imporvement_error"></div>
                                </div> -->
                            </div>
                        </div>
                    
                    <!-- reviewer save and submit -->
                        <div id="goal_sheet_rev_submit" class="m-b-30" style="display: none;" >
                            <div class="row">
                                <div class="col-lg-3">
                                    <a onclick="revFormSave();" id="goal_sheet_rev_save" class="btn btn-primary text-white m-t-30">Save As Draft</a>
                                </div>
                                <div class="col-lg-2" style="margin-top: 30px; margin-left: -130px;">
                                    <a id="goal_sheet_submit_for_reviewers"  onclick="revFormSubmit()"  class="btn btn-success text-white">Submit</a>
                                </div>
                                <div class="col-lg-8">
                                    <div class="text-danger m-t-35" style="margin-left: -120px;" id="all_feild_required"></div>   
                                </div>
                            </div>                           
                        </div>
                        <!-- reviewer submit button start -->
                        <div class="m-t-20 m-b-30 float-right" id="save_div_hr_mark">
                            
                        </div>
                        <!-- hr save and submit -->
                            
                            <div class="row" style="display: none;" id="save_div_hr">
                                <div class ="col-lg-12 row">        
                                    <div class="col-lg-3">                          
                                        <label>HR Remarks</label><br>
                                        <textarea id="hr_remarks" name="hr_remarks" class="form-control" style="width: 100%;"></textarea>
                                        <div class="text-danger hr_remarks_error" id="hr_remarks_error"></div>
                                    </div>
                                        <div class="col-lg-3">
                                        <label>Increment recommended?</label><br>
                                        <select class="form-control" id="increment_recommended" name="increment_recommended">
                                            <option value="" selected>...Select...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="text-danger increment_recommended_error" id="increment_recommended_error"></div>
                                    </div>
                                    <div type="hidden" id="increment_hike"></div>
                                    <div class="col-lg-3" id="increment_percentage_view">
                                        <label>Percentage % (Please apply 0 to 50%)</label><br>
                                        <input type="text" id="increment_percentage" name="increment_percentage" class="form-control">
                                        <div class="text-danger increment_percentage_error" id="increment_percentage_error"></div>
                                    </div>
                                    <div class="col-lg-3" id="hike_per_month_view" style="display: none;">
                                        <label>Hike Per Month</label><br>
                                        <input type="text" id="hike_per_month" name="hike_per_month" class="form-control" onkeypress="return isNumber(event)">
                                        <div class="text-danger hike_per_month_error" id="hike_per_month_error"></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Performance Imporvement</label><br>
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
                              <div class ="row m-t-25" style="margin-left: 26px;">
                                <div class="col-md-6">
                                  <div class="form-outline">
                                    <a onclick="hrFormSave();" style="width:162px" id="goal_sheet_hr_save" class="btn btn-primary text-white float-right">Save As Draft</a><br>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <a  onclick="hrFormSubmit()" id="goal_sheet_hr_submit" class="btn btn-success text-white float-right">Submit</a>  
                                </div>
                              </div>
                            </div>
                            <div class="row m-t-20 m-b-30" id="save_div_1" style="display:none;">
                                <div class="col-lg-3 m-b-20">
                                    <label>Rep.Manager Consolidated Rating</label><br>
                                    <select class="form-control" style="width:200px;margin-top:30px !important;" id="supervisor_consolidated_rate" name="employee_consolidated_rate">
                                        <option value="" selected>...Select...</option>
                                        <option value="SEE">SEE - Significantly Exceeds Expectations</option>
                                        <option value="EE">EE - Exceeded Expectations</option>
                                        <option value="ME">ME - Met Expectations</option>
                                        <option value="PME">PME - Partially Met Expectations</option>
                                        <option value="ND">ND - Needs Development</option>
                                    </select>
                                    <div class="text-danger supervisor_consolidated_rate_error" id=""></div>
                                </div>
                                <div class="col-lg-9 m-b-20" style="margin-left:-100px;">
                                    <label>Reporting Manager Recommendation</label><br>
                                    <select class="form-control" style="width:200px;margin-top:30px !important;" id="supervisor_pip_exit" name="supervisor_pip_exit">
                                        <option value="">...Select...</option>
                                        <option value="No movement" selected>No movement</option>
                                        <option value="Place employee in PIP">Place employee in PIP</option>    
                                        <option value="Vertical movement (Promotion)">Vertical movement (Promotion)</option>
                                        <option value="Horizontal movement (Role Change)">Horizontal movement (Role Change)</option>
                                    </select>
                                    <div class="text-danger supervisor_pip_exit_error" id=""></div>
                                </div>                                      
                                <div class="col-lg-3">
                                    <a onclick="supFormSave();" id="goal_sheet_save" class="btn btn-primary text-white m-t-30" >Save as Draft</a>
                                </div>
                                <div class="col-lg-2">
                                    <a id="goal_sheet_submit" style="padding-left: 9px; padding-right: 9px;width: 96px; margin-left: -175px; margin-top: 6px;" onclick="supFormSubmit()" class="btn btn-success text-white m-t-30" style="display: none;" >Submit</a>
                                </div>
                                <div class="col-lg-8">

                                    <div class="text-danger m-t-15" id="all_feild_required"></div>   
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
    <!-- <script src="../assets/js/button-tooltip-custom.js"></script> -->

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {
            get_goal_setting_reviewer_tl();
            hike_hide_and_show_in_reviewer_tab();
            $('#increment_percentage_view').hide();
            get_hr_reviewer_text();
        });
        function isNumber(evt) {
              evt = (evt) ? evt : window.event;
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
              }
              return true;
        }
        /*$("#increment_recommended").on('change', function(){

            var increment_recommended_value = $("#increment_recommended").val();
            if(increment_recommended_value == "yes"){
                $('#increment_percentage_view').show();
            }else{
                $('#increment_percentage_view').hide();
            }
            if(increment_recommended_value == "no"){
                $("#increment_percentage").val("");
            }
        });*/

        $("#increment_recommended").on('change', function()
        {
            var increment_recommended_value = $("#increment_recommended").val();
            // alert(increment_recommended_value)
            if(increment_recommended_value == "no"){
                $("#increment_percentage").val("");
                $("#hike_per_month").val("");
            }
            var increment_hike = $('#increment_hike').val();
            if(increment_hike == "HEPL"){
                if(increment_recommended_value == "yes"){
                    $('#increment_percentage_view').show();
                    $('#hike_per_month_view').hide();
                }else{
                    $('#increment_percentage_view').hide();
                    $('#hike_per_month_view').hide();
                }
            }else if(increment_hike == "NAPS")
            {
                if(increment_recommended_value == "yes")
                {
                    $('#increment_percentage_view').hide();
                    $('#hike_per_month_view').show();
                }else{
                    $('#increment_percentage_view').hide();
                    $('#hike_per_month_view').hide();
                }
            }

        });

        function hike_hide_and_show_in_reviewer_tab()
        {
            var params = new window.URLSearchParams(window.location.search);
            // var id=params.get('id');
            var id=@json($sheet_code);
            console.log(id);

            $.ajax({
                url:"{{ url('hike_hide_and_show_in_reviewer') }}",
                type:"GET",
                data:{id:id},
                dataType : "JSON",
                success:function(response)
                {
                    // console.log(response[0].payroll_status);
                    $("#increment_hike").val(response[0].payroll_status);
                   
                },
                error: function(error) {
                    console.log(error);
                }
            });
        };


//get info based the sheet in the list page
    function get_goal_setting_reviewer_tl(){

            var params = new window.URLSearchParams(window.location.search);
            // var id=params.get('id')
            var id=@json($sheet_code);

            // alert(id)
        $.ajax({
            url: "get_goal_setting_reviewer_details_tl",
            method: "POST",
            data:{"id":id,},
            dataType: "json",
            success: function(data) {
                // console.log(data)

                if(data.length !=0){
                    $('#empID').html(data.all['0'].empID);
                    $('#username').html(data.all['0'].username);
                    $('#sup_emp_code').html(data.all['0'].sup_emp_code);
                    $('#sup_name').html(data.all['0'].sup_name);
                    $('#department').html(data.all['0'].department);
                    $('#reviewer_name').html(data.all['0'].reviewer_name);
                    $('#reviewer_emp_code').html(data.all['0'].reviewer_emp_code);
                    $('#sup_department').html(data.only_dept[0].department);
                    $('#rev_department').html(data.only_dept_reve[0].department);
                }
            }
        });

    }
        $( document ).ready(function() {
            // alert("sadas")
            // goal_record();
            $("#save_div").hide();
            $("#save_div_hr").hide();
            $("#save_div_rev").hide();
            // $("#save_div_hr_mark").hide();

            $('#goals_record_tb').DataTable( {
                "searching": false,
                "paging": false,
                "info": false,
                "fixedColumns":   {
                        left: 6
                    }, 
                "columnDefs": [
                        { "width": "10px", "targets": 0 },
                        { "width": "40px", "targets": 1 },
                        { "width": "200px", "targets": 2 },
                        { "width": "200px", "targets": 3 },
                        { "width": "200px", "targets": 4 },
                        { "width": "30px", "targets": 5 },
                        { "width": "200px", "targets": 6 },
                        { "width": "30px", "targets": 7 }
                    ],
                // dom: 'Bfrtip',
                // buttons: [
                //  'copyHtml5',
                //  'excelHtml5',
                //  'csvHtml5',
                //  'pdfHtml5'
                // ]
            } );
        });

        var params = new window.URLSearchParams(window.location.search);
        // var id=params.get('id');
        var id=@json($sheet_code);

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

        /********** Employee Consolidary Rate Head **************/          
        $.ajax({                   
            url:"{{ url('goals_consolidate_rate_head') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                $('#employee_consolidate_rate_show').append('');
                $('#employee_consolidate_rate_show').append(response);
            },
            error: function(error) {
                console.log(error);

            }                                              
                
        });
        
        /********** Supervisor Consolidary Rate Head **************/                    
        $.ajax({                   
            url:"{{ url('goals_sup_consolidate_rate_head') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response[0].);
                if (response!="") {
                $('#supervisor_consolidate_rate_show').append(response[0].supervisor_consolidated_rate);
                $('#supervisor_consolidated_rate').val(response[0].supervisor_consolidated_rate);

                $('#supervisor_pip_exit_show').append(response[0].supervisor_pip_exit);
                $('#supervisor_pip_exit').val(response[0].supervisor_pip_exit);
                }
                $('#supervisor_consolidate_rate_show').append('');
            },
            error: function(error) {
                console.log(error);

            }                                              
                
        });
        /*********** Reviewer Remarks ***********/
        function get_hr_reviewer_text(){
        $.ajax({                   
            url:"{{ url('reviewer_remarks_rate_text') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response)
                $('#reviewer_remarks_val').append('');
                $('#reviewer_remarks_val').append(response[0].reviewer_remarks);
                $('#increment_recommended').val(response[0].increment_recommended);
                $('#increment_percentage').val(response[0].increment_percentage);
                if (response[0].increment_percentage !="") {
                $('#hike_per_month').val(response[0].increment_percentage);
                }else{
                $('#hike_per_month').val(response[0].hike_per_month);
                }
                // if (response[0].increment_recommended =="yes") {
                //     // alert("as")
                //     $('#increment_percentage_view').show();
                // }else{
                //     $('#increment_percentage_view').hide();
                // }

                var increment_hike = $('#increment_hike').val();
                // console.log(increment_hike);
                if(increment_hike == "HEPL")
                {
                    if(response[0].increment_recommended == "yes")
                    {
                        $('#increment_percentage_view').show();
                        $('#hike_per_month_view').hide();
                    }else{
                        $('#increment_percentage_view').hide();
                        $('#hike_per_month_view').hide();
                    }
                }else if(increment_hike == "NAPS")
                {
                    if(response[0].increment_recommended == "yes")
                    {
                        $('#increment_percentage_view').hide();
                        $('#hike_per_month_view').show();
                    }else{
                        $('#increment_percentage_view').hide();
                        $('#hike_per_month_view').hide();
                    }
                }

                $('#performance_imporvement').val(response[0].performance_imporvement);
                $('#reviewer_remarks').val(response[0].reviewer_remarks);
                $('#increment_recommended_val').html(response[0].increment_recommended);
                if (response[0].increment_percentage !="") {
                $('#increment_percentage_val').html(response[0].increment_percentage);
                }else{
                $('#increment_percentage_val').html(response[0].hike_per_month);
                }
                $('#performance_imporvement_val').html(response[0].performance_imporvement);
            },
            error: function(error) {
                console.log(error);

            }                                              
                
        });
    }

        /*********** HR Remarks ***********/
        $.ajax({                   
            url:"{{ url('hr_remarks_rate_text') }}",
            type:"GET",
            data:{id:id},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response)
                $('#hr_remarks_text').append('');
                $('#hr_remarks_text').html(response);
                $('#hr_remarks').val(response);
            },
            error: function(error) {
                console.log(error);

            }                                              
                
        });

        $.ajax({                   
            url:"{{ url('fetch_goals_hr_details_hr') }}",
            type:"POST",
            data:{id:id,
                "_token": "{{ csrf_token() }}",},
            dataType : "JSON",
            success:function(response)
            {
                 // alert(response.result)
                 // alert(response.sheet_status.reviewer_status)
                 if(response.result==1){
                         if(response.sheet_status.supervisor_status==1){
                            $("#goal_sheet_edit").hide();
                            $('#overall_submit').hide();
                            $("#overall_submit_1").hide();
                            $("#hr_status_div").hide();
                            $("#reviewer_remarks_div").hide();
                            $('#sup_setting_excel_generation_id').css("display","block");
                            $('#rev_setting_excel_generation_id').css("display","none");
                            $('#hr_setting_excel_generation_id').css("display","none");
                            $('#org_setting_excel_generation_id').css("display","none");
                         }
                         else{
                            $("#goal_sheet_edit").show();
                            $('#overall_submit').show();
                            $("#overall_submit_1").show();
                            $("#hr_status_div").hide();
                            $("#reviewer_remarks_div").hide();
                         }
                         if (response.sheet_status.reviewer_status ==1 ) {
                            $("#hr_status_div").hide();
                            $("#reviewer_remarks_div").hide();

                         }
                 }
                 if(response.result==2){
                         if(response.sheet_status.reviewer_status==1){
                            $("#goal_sheet_edit").hide();
                            $('#overall_submit').hide();
                            $("#overall_submit_1").hide();
                            $("#hr_status_div").hide();
                            $('#sup_setting_excel_generation_id').css("display","none");
                            $('#rev_setting_excel_generation_id').css("display","block");
                            $('#hr_setting_excel_generation_id').css("display","none");
                            $('#org_setting_excel_generation_id').css("display","none");
                           /* $("#reviewer_remarks_txt").show();
                            $("#increment_recommended_text").show();
                            $("#increment_percentage_text").show();
                            $("#performance_imporvement_text").show();*/
                         }
                         else{
                            $("#goal_sheet_edit").show();
                            $('#overall_submit').show();
                            $("#overall_submit_1").show();
                            $("#hr_status_div").hide();
                            /*$("#reviewer_remarks_txt").hide();
                            $("#increment_recommended_text").hide();
                            $("#increment_percentage_text").hide();
                            $("#performance_imporvement_text").hide();*/
                         }
                         if (response.sheet_status.reviewer_status ==1 ) {
                            $("#hr_status_div").hide();
                         }
                 }
                 if(response.result==0){
                         if(response.sheet_status.hr_status==1){
                            $("#goal_sheet_edit").hide();
                            $('#overall_submit').hide();
                            $("#overall_submit_1").hide();
                            $("#hr_status_div").show();
                            $('#sup_setting_excel_generation_id').css("display","none");
                            $('#rev_setting_excel_generation_id').css("display","none");
                            $('#hr_setting_excel_generation_id').css("display","block");
                            $('#org_setting_excel_generation_id').css("display","none");
                            /*$("#reviewer_remarks_txt").show();
                            $("#increment_recommended_text").show();
                            $("#increment_percentage_text").show();
                            $("#performance_imporvement_text").show();*/
                         }
                         else{
                            $("#goal_sheet_edit").show();
                            $('#overall_submit').show();
                            /*$("#reviewer_remarks_txt").hide();
                            $("#overall_submit_1").show();
                            $("#hr_status_div").show();*/
                         }
                 }

                $('#goals_record_tb').DataTable().clear().destroy();
                $('#goals_record').empty();
                $('#goals_record').append(response.html);
                $('#goals_record_tb').DataTable( {
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

                var params = new window.URLSearchParams(window.location.search);
                // var id=params.get('id');
                var id=@json($sheet_code);

                $.ajax({                   
                    url:"{{ url('check_role_type_hr') }}",
                    type:"POST",
                    data:{id:id},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // alert(response)
                        if(response == 1){
                            //As supervisor
                                        
                            $("#goal_sheet_edit").css("display","none");
                            $("#goal_sheet_submit").css("display","block");
                            $("#save_div_1").show();
                            $("#save_div_rev").hide();
                            $("#save_div_hr").hide();
                            $("#save_div_reviewer_mark").hide();

                            var i=1;
                            var j=1;
                            var defined_class1="sup_remark";
                            var defined_class2="sup_rating";
                            
                            
                            $("#goals_record_tb tbody tr td."+defined_class1+"").each(

                                    function(index){
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
                            $("#goals_record_tb tbody tr td."+defined_class2+"").each(
                                function(index){
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
                        }
                        if(response == 2){
                            //As reviewer
                                        
                            $("#goal_sheet_edit").css("display","none");
                            $("#goal_sheet_submit").css("display","none");
                            $("#goal_sheet_rev_submit").css("display","block");
                            $("#save_div_rev").show();
                            $("#save_div").hide();
                            $("#save_div_hr").hide();
                            $("#save_div_reviewer_mark").show();

                            $("#reviewer_remarks_txt").show();
                            $("#increment_recommended_text").show();
                            $("#increment_percentage_text").show();
                            $("#performance_imporvement_text").show();
                            $("#save_div_rev_mark").show();

                            var i=1;
                            var j=1;
                            var defined_class1="reviewer_remarks";
                            var defined_class2="hr_remarks";

                            $("#goals_record_tb tbody tr td."+defined_class1+"").each(
                                function(index){

                                    // console.log("data")
                                    if ($(this).text() != ""){
                                        var text_data=$(this).text();
                                        $('.reviewer_remarks_p_rev_'+i+'').remove();
                                        var tx = '<textarea id="business_head_edit'+i+'" style="width:200px;" name="reviewer_remarks_[]" class="form-control">'+text_data+'</textarea>';
                                            tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
                                        $(this).append(tx)
                                    }
                                    else{
                                        var tx = '<textarea id="business_head_edit'+i+'" style="width:200px;" name="reviewer_remarks_[]" class="form-control"></textarea>';
                                            tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
                                        $(this).append(tx)
                                        // alert("two")
                                    }
                                    i++;
                                }
                            );

                            $("#goals_record_tb tbody tr td."+defined_class2+"").each(
                                function(index){

                                    // console.log("data")
                                    if ($(this).text() != ""){
                                        var text_data=$(this).text();
                                        $('.hr_remark_p'+j+'').remove();
                                        var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
                                            tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
                                        $(this).append(tx)
                                    }
                                    else{
                                        var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control"></textarea>';
                                            tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
                                        $(this).append(tx)
                                        // alert("two")
                                    }
                                    i++;
                                }
                            );
                            
                        }
                        if(response == 0){
                            //As hr

                            $("#goal_sheet_edit").css("display","none");
                            $("#goal_sheet_submit").css("display","none");
                            $("#goal_sheet_rev_submit").css("display","none");
                            // $("#hr_sheet_submit").css("display","block");
                            $("#save_div").hide();
                            $("#save_div_rev").hide();
                            $("#save_div_hr").show();
                            $("#hr_remarks_text").hide();
                            // $("#save_div_hr_mark").show();
                            
                            var i=1;
                            
                                var defined_class1="sup_remark";
                                var defined_class2="sup_rating";
                                var defined_class3="hr_remarks";
                        }
                                                
                    },
                    error: function(error) {
                        console.log(error);

                    }                                              
                        
                });

                
            })
        })
/*save supervisor button*/
    function supFormSave(){

            $('#goal_sheet_save').attr('disabled' , true);                          
            $('#goal_sheet_save').html('Processing');
            /*var error='';
            var rate = $("#supervisor_consolidated_rate").val();
            var $errmsg3 = $(".supervisor_consolidated_rate_error");
            $errmsg3.hide();

            if(rate == ""){
                $errmsg3.html('Consolidated rate is required').show();                
                error+="error";
            }

            var i=1;
                var defined_class1="sup_remark";
                var defined_class3="sup_rating_div_"+i;
                var defined_class2="sup_rating";

                $("#goals_record_tb tbody tr td."+defined_class1+"").each(
                    function(index){
                        var err_div_name = "#sup_remark_"+i+"_error";
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();
                        if ($("#sup_remark"+i+"").val() == "" || $("#sup_remark"+i+"").val() == undefined){
                            $errmsg0.html('Supervisor remarks is required').show();
                            error+="error";
                        }
                        i++;
                    }
                );

                //supervisor ratin
                var j = 1;
                $("#goals_record_tb tbody tr td."+defined_class2+"").each(
                    function(index){
                        var err_div_name1 = ".sup_rating_"+j+"_error";
                        var $errmsg1 = $(err_div_name1);
                        $errmsg1.hide();
                        var selected_opt=$("#sup_rating"+j+"").find(":selected").val();
                        if (selected_opt == "" || selected_opt== undefined){
                            $errmsg1.html('Supervisor Rating is required').show();
                            error+="error";
                        }
                        j++;
                    }
                );
*/
            //Sending data to database
            // if(error==""){
                // alert("succes")
                data_insert();
            //}
            
            function data_insert(){
                // console.log($('#goalsForm').serialize());
                $.ajax({
                    
                    url:"{{ url('add_goals_data_hr_save') }}",
                    type:"POST",
                    data:$('#goalsForm').serialize(),
                    dataType : "JSON",
                    success:function(data)
                    {
                        // console.log(data)
                        Toastify({
                            text: "Added Sucessfully..!",
                            duration: 3000,
                            close:true,
                            backgroundColor: "#4fbe87",
                        }).showToast();    
                        
                        // $('button[type="submit"]').attr('disabled' , false);

                        $('#goal_sheet_save').attr('disabled' , false);
                        $('#goal_sheet_save').html('Save As Draft');    
                        
                        window.location.reload();                
                    },
                    error: function(response) {
                        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);
                    }                                              
                });
            }      
        }
/*submit supervisor button*/
    function supFormSubmit(){
            $('#goal_sheet_submit').attr('disabled' , true);
            $('#goal_sheet_submit').html('Processing');     
            var error='';
            var rate = $("#supervisor_consolidated_rate").val();
            var $errmsg3 = $(".supervisor_consolidated_rate_error");
            $errmsg3.hide();
            if(rate == ""){
                $errmsg3.html('Consolidated rate is required').show();                
                error+="error";
            }

            var rate = $("#supervisor_pip_exit").val();
            var $errmsg3 = $(".supervisor_pip_exit_error");
            $errmsg3.hide();
            if(rate == ""){
                $errmsg3.html('Reporting Manager Recommendation is required').show();                
                error+="error";
            }

             var i=1;
             var defined_class1="sup_remark";
             var defined_class3="sup_rating_div_"+i;
             var defined_class2="sup_rating";
             $("#goals_record_tb tbody tr td."+defined_class1+"").each(
                 function(index){
                        var err_div_name = "#sup_remark_"+i+"_error";
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();
                     if ($("#sup_remark"+i+"").val() == "" || $("#sup_remark"+i+"").val() == undefined){
                            $errmsg0.html('Supervisor remarks is required').show();
                            error+="error";
                     }
                     i++;
                 }
             );
             //supervisor ratin
             var j = 1;
             $("#goals_record_tb tbody tr td."+defined_class2+"").each(
                 function(index){
                        var err_div_name1 = ".sup_rating_"+j+"_error";
                        var $errmsg1 = $(err_div_name1);
                        $errmsg1.hide();
                        var selected_opt=$("#sup_rating"+j+"").find(":selected").val();
                     if (selected_opt == "" || selected_opt== undefined){
                            $errmsg1.html('Supervisor Rating is required').show();
                            error+="error";
                     }
                     j++;
                 }
             );

            //Sending data to database
            if(error==""){
                // alert("hi")
                var $errmsg4 = $("#all_feild_required");
                $errmsg4.hide();
                $('#goal_sheet_submit').attr('disabled' , true);
                $('#goal_sheet_submit').html('Processing');
                data_insert();

            }else{

                var $errmsg4 = $("#all_feild_required");
                $errmsg4.hide();
                $errmsg4.html('All the field is required').show();
                error+="error";
                $('#goal_sheet_submit').attr('disabled' , false);
                $('#goal_sheet_submit').html('Submit');        

            }
            
            function data_insert(){

                $.ajax({
                    
                    url:"{{ url('add_goals_data_hr_sup') }}",
                    type:"POST",
                    data:$('#goalsForm').serialize(),
                    dataType : "JSON",
                    success:function(data)
                    {
                        // console.log(data)
                        Toastify({
                            text: "Added Sucessfully..!",
                            duration: 3000,
                            close:true,
                            backgroundColor: "#4fbe87",
                        }).showToast();    
                        
                         $('#goal_sheet_submit').attr('disabled' , false);
                        $('#goal_sheet_submit').html('Submit');   
                        // $('button[type="submit"]').attr('disabled' , false);
                        
                        window.location = "{{ url('goals')}}";                
                    },
                    error: function(response) {
                        $('#business_name_option_error').text(response.responseJSON.errors.business_name);
                    }                                              
                });
            }      
        }

/* reviewer submit button */
    function revFormSubmit(){
        $('#goal_sheet_submit_for_reviewers').attr('disabled' , true);
        $('#goal_sheet_submit_for_reviewers').html('Processing...');

        var error='';
        // alert(error)
                var i=1;

                 var reviewer_remarks_val = $("#reviewer_remarks").val();
                // alert(rate)
                var $errmsg3 = $(".reviewer_remarks_error");
                $errmsg3.hide();

                if(reviewer_remarks_val == ""){
                    $errmsg3.html('Reviewer Remarks is required').show();
                    error+="error";
                    // alert("1")
                }
                // var increment_recommended_val = $("#increment_recommended").val();
                // var $errmsg3 = $(".increment_recommended_error");
                // $errmsg3.hide();

                // if(increment_recommended_val == ""){
                //     $errmsg3.html('Increment Recommended is required').show();
                //     error+="error";
                //     // alert("2")
                // }
                // var performance_imporvement_val = $("#performance_imporvement").val();
                // var $errmsg3 = $(".performance_imporvement_error");
                // $errmsg3.hide();

                // if(performance_imporvement_val == ""){
                //     $errmsg3.html('Performance Imporvement is required').show();
                //     error+="error";
                //     // alert("3")
                // }

                /*var increment_percentage_val = $("#increment_percentage").val();
                        // alert(increment_percentage_val)
                var $errmsg3 = $(".increment_percentage_error");
                $errmsg3.hide();
                    if(increment_recommended_val == "yes"){
                        if(increment_percentage_val == ""){
                            $errmsg3.html('Increment Percentage is required').show();
                            error+="error";
                            alert("4")
                        }
                    }*/
                // var increment_hike = $('#increment_hike').val();

                // // alert(increment_hike)
                // var increment_percentage_val = $("#increment_percentage").val();
                // var $errmsg3 = $(".increment_percentage_error");
                // $errmsg3.hide();

                // if(increment_hike == "HEPL")
                // {
                //     if(increment_recommended_val == "yes"){
                //         if(increment_percentage_val == ""){
                //             $errmsg3.html('Increment Percentage is required').show();
                //             error+="error";
                //             alert("5")
                //         }
                //     }
                // }

                // var hike_per_month_val = $("#hike_per_month").val();
                // var $errmsg3 = $(".hike_per_month_error");
                // $errmsg3.hide();

                // if(increment_hike == "NAPS")
                // {
                //     if(increment_recommended_val == "yes"){
                //         if(hike_per_month_val == ""){
                //             $errmsg3.html('Hike Per Month is required').show();
                //             error+="error";
                //         }
                //     }
                // }
                //Sending data to database
               if(error==""){
                    
                    $('#goal_sheet_submit_for_reviewers').attr('disabled' , true);
                    $('#goal_sheet_submit_for_reviewers').html('Processing');
                    data_insert_reviewer();
                 }
                 else{
                    $('#goal_sheet_submit_for_reviewers').attr('disabled' , false);
                    $('#goal_sheet_submit_for_reviewers').html('Submit');        

                }
            function data_insert_reviewer(){

                $.ajax({

                    url:"{{ url('update_goals_sup_reviewer_tm_hr') }}",
                    type:"POST",
                    data:$('#goalsForm').serialize(),
                    dataType : "JSON",
                    success:function(data)
                    {
                        Toastify({
                            text: "Added Sucessfully..!",
                            duration: 3000,
                            close:true,
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        // $('button[type="submit"]').attr('disabled' , false);

                        $('#goal_sheet_submit_for_reviewers').attr('disabled' , false);
                        $('#goal_sheet_submit_for_reviewers').html('Submit');

                        window.location = "{{ url('goals')}}";
                    },
                    error: function(response) {
                        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

                    }

                });
            }
        }
/* reviewer save button*/
    function revFormSave(){
            $('#goal_sheet_rev_save').attr('disabled' , true);
            $('#goal_sheet_rev_save').html('Processing');

                // var error='';
          //       var i=1;

          //        var reviewer_remarks_val = $("#reviewer_remarks").val();
             //    // alert(rate)
             //    var $errmsg3 = $(".reviewer_remarks_error");
             //    $errmsg3.hide();

             //    if(reviewer_remarks_val == ""){
             //        $errmsg3.html('Reviewer Remarks is required').show();
             //        error+="error";
             //    }
             //    var increment_recommended_val = $("#increment_recommended").val();
          //       var $errmsg3 = $(".increment_recommended_error");
          //       $errmsg3.hide();

          //       if(increment_recommended_val == ""){
          //           $errmsg3.html('Increment Recommended is required').show();
          //           error+="error";
          //       }
          //       var performance_imporvement_val = $("#performance_imporvement").val();
          //       var $errmsg3 = $(".performance_imporvement_error");
          //       $errmsg3.hide();

          //       if(performance_imporvement_val == ""){
          //           $errmsg3.html('Performance Imporvement is required').show();
          //           error+="error";
          //       }

          //       //Sending data to database
          //       if(error==""){
                    data_insert_reviewer();
                // }

            function data_insert_reviewer(){

                $.ajax({

                    url:"{{ url('update_goals_sup_reviewer_tm_save') }}",
                    type:"POST",
                    data:$('#goalsForm').serialize(),
                    dataType : "JSON",
                    success:function(data)
                    {
                        Toastify({
                            text: "Added Sucessfully..!",
                            duration: 3000,
                            close:true,
                            backgroundColor: "#4fbe87",
                        }).showToast();

                        $('#goal_sheet_rev_save').attr('disabled' , false);
                        $('#goal_sheet_rev_save').html('Save As Draft');    

                        // $('button[type="submit"]').attr('disabled' , false);

                        window.location.reload();
                    },
                    error: function(response) {
                        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

                    }

                });
            }
        }

/* hr submit button*/
    function hrFormSubmit() {
        
        $('#goal_sheet_hr_submit').attr('disabled' , true);
        $('#goal_sheet_hr_submit').html('Processing');

          var error = "";
          var i = 1;

          var hr_remarks_val = $("#hr_remarks").val();
            // alert(rate)
            var $errmsg3 = $(".hr_remarks_error");
            $errmsg3.hide();

            if(hr_remarks_val == ""){
                $errmsg3.html('HR Remarks is required').show();
                error+="error";
            }

          
          if (error == "") {
            data_insert_reviewer();
          }
          function data_insert_reviewer() {
            $.ajax({
              url: "{{ url('update_goals_hr_reviewer_tm') }}",
              type: "POST",
              data: $("#goalsForm").serialize(),
              dataType: "JSON",
              success: function (data) {
                Toastify({
                  text: "Added Sucessfully..!",
                  duration: 3000,
                  close: true,
                  backgroundColor: "#4fbe87",
                }).showToast();

                // $('button[type="submit"]').attr('disabled' , false);

                $('#goal_sheet_hr_submit').attr('disabled' , false);

                $('#goal_sheet_hr_submit').html('Submit');        

                window.location = "{{ url('goals')}}";
              },
              error: function (response) {
                // $('#business_name_option_error').text(response.responseJSON.errors.business_name);
              },
            });
          }
        }
/*hr save button*/
    function hrFormSave() {
        // alert("sdfasdasda")
         $('#goal_sheet_hr_save').attr('disabled' , true);
        $('#goal_sheet_hr_save').html('Processing');
          // var error = "";
          // var i = 1;

          // var hr_remarks_val = $("#hr_remarks").val();
    //         // alert(rate)
    //         var $errmsg3 = $(".hr_remarks_error");
    //         $errmsg3.hide();

    //         if(hr_remarks_val == ""){
    //             $errmsg3.html('Hr Remarks is required').show();
    //             error+="error";
    //         }

          // if (error == "") {
            data_insert_reviewer();
          // }
          function data_insert_reviewer() {
            $.ajax({
              url: "{{ url('save_hr_reviewer') }}",
              type: "POST",
              data: $("#goalsForm").serialize(),
              dataType: "JSON",
              success: function (data) {
                Toastify({
                  text: "Added Sucessfully..!",
                  duration: 3000,
                  close: true,
                  backgroundColor: "#4fbe87",
                }).showToast();

                $('#goal_sheet_hr_save').attr('disabled' , false);
                $('#goal_sheet_hr_save').html('Save As Draft');      

                // $('button[type="submit"]').attr('disabled' , false);

                window.location.reload();
              },
              error: function (response) {
                // $('#business_name_option_error').text(response.responseJSON.errors.business_name);
              },
            });
          }
        }


          // Restricts input for each element in the set of matched elements to the given inputFilter.
        (function($) {
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
        }(jQuery));



        $("#increment_percentage").inputFilter(function(value) {
        return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 50); }, "Must be between 0 and 50");


        $(()=>{
                $("#sup_setting_excel_generation_id").on('click',(e)=>{
                    e.preventDefault();
                    var params = new window.URLSearchParams(window.location.search);
                    // var id=params.get('id')
                    var id=@json($sheet_code);

                    var goal_id=[];
                    goal_id.push({
                    goal_id:id
                })
                $.ajax({
                    url:"sup_goal_report_reviewer",
                    type:"POST",
                    data:{id:goal_id},
                    beforeSend:function(data){
                    console.log("Loading!...");
                    },
                    success:function(response){
                        var a = document.createElement("a");
                        a.href = response.file;
                        a.download = response.name;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    }
                })
            })
        })

         $(()=>{
                $("#rev_setting_excel_generation_id").on('click',(e)=>{
                    e.preventDefault();
                    var params = new window.URLSearchParams(window.location.search);
                    var id=@json($sheet_code);
                    // var id=params.get('id')
                    var goal_id=[];
                    goal_id.push({
                    goal_id:id
                })
                $.ajax({
                    url:"rev_goal_report_reviewer",
                    type:"POST",
                    data:{id:goal_id},
                    beforeSend:function(data){
                    console.log("Loading!...");
                    },
                    success:function(response){
                        var a = document.createElement("a");
                        a.href = response.file;
                        a.download = response.name;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    }
                })
            })
        })
        
        $(()=>{
                $("#hr_setting_excel_generation_id").on('click',(e)=>{
                    e.preventDefault();
                    var params = new window.URLSearchParams(window.location.search);
                    // var id=params.get('id')
                    var id=@json($sheet_code);

                    var goal_id=[];
                    goal_id.push({
                    goal_id:id
                })
                $.ajax({
                    url:"Hr_report_reviewer_excel",
                    type:"POST",
                    data:{id:goal_id},
                    beforeSend:function(data){
                    console.log("Loading!...");
                    },
                    success:function(response){
                        var a = document.createElement("a");
                        a.href = response.file;
                        a.download = response.name;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    }
                })
            })
        })
    </script>


@endsection

