@extends('layouts.simple.candidate_master')

@section('title', 'Add Goal Setting')

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
        display: none;
    }
    #datatable_form_update{
        display: none;
    }
    #goal_sheet_submit_update{
        display: none;
    }
    /* textarea.form-control.key_res_areas_style
    {
        width: 100% !important;
    } */
</style>
@endsection

@section('breadcrumb-title')
	<h2>Performance Management <span>System</span></h2>
@endsection

@section('breadcrumb-items')
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
            <div class="ribbon-vertical-right-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 70px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> PMS</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i> Apprentice ID :</p>
                                </div>
                                <div class="col-md-6">
                                    <p id="empID" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->empID }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i> Rep.Manager ID :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="sup_emp_code" class="f-w-700"  style="font-size: 16px;"><b>{{ Auth::user()->sup_emp_code }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;" ><i class="icofont icofont-id-card"> </i>  Reviewer ID :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="reviewer_emp_code" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->reviewer_emp_code }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i>  HRBP ID :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p style="font-size: 16px;" class="f-w-700"><b>900380</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row" style="margin-left: -102px;">
                                <div class="col-md-6">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Apprentice Name :</p>
                                </div>
                                <div class="col-md-6">
                                    <p id="username" class="f-w-700" style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->username }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Rep.Manager Name :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="sup_name" class="f-w-700" style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->sup_name }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Reviewer Name :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="reviewer_name" class="f-w-700" style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->reviewer_name }}</b></p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> HRBP :</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p class="f-w-700" style="text-transform: uppercase;font-size: 16px;"><b>Rajesh M S</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-7">
                                    <h6 class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Apprentice Dept:</h6>
                                </div>
                                <div class="col-md-5">
                                    <p id="department" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->department }}</b></p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Rep.Manager Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="sup_dept" class="f-w-700" style="font-size: 16px;"></p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Reviewer Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="rev_dept" class="f-w-700" style="font-size: 16px;"></p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> HRBP Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p class="f-w-700" style="font-size: 16px;"><b>HR</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="text-danger" id="add_pms_table_error" style="display:none"></div>
                    <div class="table-responsive" id="add_pms_table"  style="display:none">                        
                        <form id="goalsForm">
                            <!-- <button type="submit" id="goal_sheet_submit" class="btn btn-success  float-right m-b-30"><i class="ti-save"></i> Submit</button>                                            
                            <button id="goal_sheet_submit_update" class="btn btn-success  float-right m-b-30"><i class="ti-save"></i> Submit</button>                                             -->
                            
                            <table class="table" id="goal-tb">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" style="width:180px">Key Business Drivers (KBD)</th>
                                        <th scope="col" style="width:280px">Key Outcome Areas (KOA)</th>
                                        <th scope="col" style="width:280px">Measurement Criteria (Quantified Measures)</th>
                                        <th scope="col" style="width:280px">Self Assessment (Qualitative Remarks) by Apprentice</th>
                                        <th scope="col" style="width:180px">Self Rating</th>
                                        <!-- <th scope="col">Actuals </th> -->
                                        <th scope="col"></th>
                                        <th scope="col">
                                            <i class="fa fa-plus txt-primary"
                                                style="font-size: x-large;" data-original-title="Add KBD" id="addNewKBD" title="Add KBD"  onclick="additionalKBD();"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="goals_record">                              
                                </tbody>
                            </table>
                            <input type="hidden" name="goals_setting_id" id="goals_setting_id">								
                            <div class="m-t-40 m-b-30 float-right row">
                                <!-- <div class="">									 -->
                                    <div class="col-lg-5">
                                        <label>Consolidated Self Rating</label><br>
                                        <select class="form-control" style="width:200px;margin-top: 5px !important;" id="employee_consolidated_rate" name="employee_consolidated_rate">
                                            <option value="" selected>...Select...</option>
                                            <option value="EE">EE - Exceeded Expectations</option>
                                            <option value="ME">ME - Met Expectations</option>
                                            <option value="PME">PME - Partially Met Expectations</option>
                                            <option value="ND">ND - Needs Development</option>
                                        </select>
                                        <div class="text-danger employee_consolidated_rate_error m-t-20" id=""></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" title="Save As Draft" id="datatable_form_save"  class="btn float-right btn-primary m-t-30"><i class="ti-save"></i> Save As Draft</button>                                            
                                        <button type="submit" id="datatable_form_update" title="Save As Draft"  class="btn float-right btn-primary m-t-30"><i class="ti-save"></i> Update</button>                                                                                
                                        <!-- <a id="datatable_form_save" type="submit" class="btn btn-primary text-white m-t-30" title="Save As Draft">Save As Draft</a>                                            
                                        <a id="datatable_form_update" type="submit" class="btn btn-primary text-white m-t-30" title="Save As Draft">Update</a>                                             -->
                                    </div>
                                    <div class="col-lg-3">
                                        <!-- <a id="goal_sheet_submit" type="submit" class="btn btn-success text-white float-right m-t-30" title="Submit For Approval">Submit</a>                                            
                                        <a id="goal_sheet_submit_update" type="submit" class="btn btn-success text-white float-right m-t-30" title="Submit For Approval">Submit</a>                                            
                                         -->
                                        <button type="submit" title="Submit For Approval" id="goal_sheet_submit"  class="btn float-right btn-success m-t-30"><i class="ti-save"></i> Submit</button>                                            
                                        <button id="goal_sheet_submit_update" title="Submit For Approval"  class="btn float-right btn-success m-t-30"><i class="ti-save"></i> Submit</button>                                            
                                    </div>                                    
                                <!-- </div> -->
                            </div>    
                            <div class="text-danger tb_error" id=""></div> 
                        </form>
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
<!-- Plugins JS start-->
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>

<script>

    $(document).ready(function() {
        setTimeout(
            function() {
                var html = '<tr>';
                        html +='<td scope="row">1</td>';
                        html +='<td>';
                            html +='<select class="form-control js-example-basic-single key_bus_drivers key_bus_drivers_1" id="key_bus_drivers_1" name="key_bus_drivers_1[]">';
                                html +='<option value="">...Select...</option>';
                                html +='<option value="Revenue">Revenue</option>';
                                html +='<option value="Customer">Customer</option>';
                                html +='<option value="Process">Process</option>';
                                html +='<option value="People">People</option>';
                                html +='<option value="Projects">Projects</option>';
                            html +='</select>';
                            html += '<div class="text-danger key_bus_drivers_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea name="key_res_areas_1[]" id="key_res_areas_1" class="form-control key_res_areas_1"></textarea>';
                            html += '<div class="text-danger key_res_areas_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea name="measurement_criteria_1[]" id="" class="form-control"></textarea>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea type="text" name="self_assessment_remark_1[]" id="self_assessment_remark_1" class="form-control self_assessment_remark_1"></textarea>';
                            html += '<div class="text-danger self_assessment_remark_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<select id="rating_by_employee_1" class="form-control js-example-basic-single key_bus_drivers rating_by_employee_1" name="rating_by_employee_1[]">';
                                html +='<option value="">...Select...</option>';
                                html +='<option value="EE">EE - Exceeded Expectations</option>';
                                html +='<option value="ME">ME - Met Expectations</option>';
                                html +='<option value="PME">PME - Partially Met Expectations</option>';
                                html +='<option value="ND">ND - Needs Development</option>';
                            html +='</select>';
                            html += '<div class="text-danger rating_by_employee_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<div style="margin-top: 70px;"></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<div class="dropup">';
                                html +='<button type="button" class="btn btn-xs btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                                html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KOA" title="Add KOA"><i class="fa fa-plus" onclick="additionalKRA(this,1);"></i></button></a>';
                                    // html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"  id="btnDelete" data-original-title="Delete KOA" title="Delete KOA"><i class="fa fa-trash-o"></i></button></a>';
                                html +='</div>';
                            html +='</div>';

                            // html +='<div class="dropup m-t-5">';
                            //     html +='<button type="button" class="btn btn-xs btn-info" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                            // html +='</div>';
                            // html +='<div class="dropup m-t-5">';
                            //     html +='<button type="button" class="btn btn-xs btn-danger" id="btnDelete" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                            // html +='</div>';

                            // html +=' <button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button>';
                            // html +=' <button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                            // html +=' <button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button>';
                        html +='</td>';
                    html +='</tr>';
                $('#goal-tb tr:last').after(html);

            },
        2000 );

        login_user_details();
        login_user_eligible();        
        
    });

    function login_user_eligible(){
        $.ajax({
            url: "login_user_eligible",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data == 1){    
                    //Tb show      
                    
                    //Check arlready entered
                    $.ajax({
                        url: "login_user_sheet_added",
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            // console.log(data)
                            if(data == "Pending" || data == "Revert"){    
                                //Tb hide      
                                $("#add_pms_table").hide();
                                $("#add_pms_table_error").hide();
                                $("#add_pms_table_error").html("Sorry, you're already applied!").show(); 
                                
                            }else{
                                //show
                                $("#add_pms_table_error").hide();
                                $("#add_pms_table").show();
                            }
                        }
                    });
                    
                }else{
                    //hide
                    $("#add_pms_table").show();
                    $("#add_pms_table_error").hide();
                    // $("#add_pms_table_error").html("Sorry, you're not eligible to apply!").show();                    
                }
            }
        });
    }   
    
    // $('.key_bus_drivers_1').click(function() {
    //     alert("hi")
    //     // $('#myTable tr:not(:first-child)').each(function(){
    //     //     var checklistText =$(this).find('.checklist').text();
    //     //     var commentsText = $(this).find('#comments').val();
    //     //     var selectedText ;
    //     //     selectedText = $(this).find('.health option:selected').text();
    //     //     alert(checklistText+' : '+selectedText);
    //     // });
    // });

    $(document).on('change','.key_bus_drivers',function(){        
        var id_name = $(this).prop('id');
        // console.log(this)      
        var error='';
       
        var new_arr=[];

        $('#goal-tb tr').each(function(index) {

            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            
            var found = new_arr.find(e => e.name === col1);

            // var found = new_arr.find(e => e.name === verici);
            // console.log(new_arr)   

            if(found == undefined){
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();

                new_arr.push({
                    name:col1
                });

            }else{
                // alert("2")
                // Key business drivers
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();
                $errmsg0.html('Key business drivers is already entered').show();                
                error+="error";                
                
            }
            
        });        

        
    });

    $(".use-address").click(function() {
        var html = '<input type="text" name="" id="" class="form-control m-t-5">';

        var id = $(this).closest("tr").find("td:eq(2)").html(html);
        // $("#resultas").append(id);
    });

    function additionalKRA(x,cur_rowCount) {
        // alert($(x).closest('td').parent()[0].sectionRowIndex);
        // alert(cur_rowCount)

        var rand_no = Math.floor(Math.random()*90000) + 10000;
        var code = cur_rowCount+'_'+rand_no;

        var html2 = '<textarea class="form-control m-t-5 key_res_areas_'+cur_rowCount+' '+code+'" id="key_res_areas_'+code+'" name="key_res_areas_'+cur_rowCount+'[]"></textarea>';
            html2 += '<div class="text-danger key_res_areas_'+code+'_error" id=""></div>';
        var html3 = '<textarea class="form-control m-t-5 measurement_criteria_'+cur_rowCount+' '+code+'" id="measurement_criteria_'+code+'" name="measurement_criteria_'+cur_rowCount+'[]"></textarea>';
        var html4 = '<textarea class="form-control m-t-5 self_assessment_remark_'+cur_rowCount+' '+code+'"  id="self_assessment_remark_'+code+'" name="self_assessment_remark_'+cur_rowCount+'[]"></textarea>';
            html4 += '<div class="text-danger self_assessment_remark_'+code+'_error" id=""></div>';

        var html5 ='';
            html5 +='<select class="form-control js-example-basic-single m-t-35 rating_by_employee_'+cur_rowCount+' '+code+'"  id="rating_by_employee_'+code+'" name="rating_by_employee_'+cur_rowCount+'[]">';
                        html5 +='<option value="">...Select...</option>';
                        html5 +='<option value="EE">EE - Exceeded Expectations</option>';
                        html5 +='<option value="ME">ME - Met Expectations</option>';
                        html5 +='<option value="PME">PME - Partially Met Expectations</option>';
                        html5 +='<option value="ND">ND - Needs Development</option>';
            html5 +='</select>';
            html5 += '<div class="text-danger rating_by_employee_'+code+'_error" id=""></div>';

        var html11 = '';

        html11 +='<div class="dropup m-t-35">';
            html11 +='<button type="button" class="btn btn-xs btn-danger '+code+'" onclick="removeRow(this,'+code+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KOA" title="Edit KOA"><i class="fa fa-close"></i></button>';
            // html7 +='<button type="button" class="btn btn-xs btn-danger sub_row_'+cur_rowCount+'" onclick="removeRow(this,'+class_sub+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
        html11 +='</div>';

        $(x).closest("tr").find("td:eq(2)").append(html2);
        $(x).closest("tr").find("td:eq(3)").append(html3);
        $(x).closest("tr").find("td:eq(4)").append(html4);
        $(x).closest("tr").find("td:eq(5)").append(html5);
        $(x).closest("tr").find("td:eq(6)").append(html11);

    }

    function removeRow(html_ui, class_name){
        const string = ''+class_name+'';
        var first = string.slice(0, 1);
        var last = string.slice(-5);
        var code = first+'_'+last;
        $('.'+code+'').remove();
    }

    function additionalKBD(){
        var rowCount = $('#goal-tb tr').length;

        if(5 <= rowCount){
            $("#addNewKBD").hide();
        }else{
            $("#addNewKBD").show();
        }

        // var cur_rowCount = rowCount + 1;
        var cur_rowCount = rowCount;

        var html = '<tr>';
                html +='<td scope="row">1</td>';
                html +='<td>';
                    html +='<select class="form-control js-example-basic-single key_bus_drivers key_bus_drivers_'+cur_rowCount+'" id="key_bus_drivers_'+cur_rowCount+'" name="key_bus_drivers_'+cur_rowCount+'[]">';
                        html +='<option value="">...Select...</option>';
                        html +='<option value="Revenue">Revenue</option>';
                        html +='<option value="Customer">Customer</option>';
                        html +='<option value="Process">Process</option>';
                        html +='<option value="People">People</option>';
                        html +='<option value="Projects">Projects</option>';
                    html +='</select>';
                    html += '<div class="text-danger key_bus_drivers_'+cur_rowCount+'_error" id=""></div>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="key_res_areas_'+cur_rowCount+'[]" id="key_res_areas_'+cur_rowCount+'" class="form-control key_res_areas_'+cur_rowCount+'"></textarea>';
                    html += '<div class="text-danger key_res_areas_'+cur_rowCount+'_error" ></div>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="measurement_criteria_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="self_assessment_remark_'+cur_rowCount+'[]" id="self_assessment_remark_'+cur_rowCount+'" class="form-control self_assessment_remark_'+cur_rowCount+'"></textarea>';
                    html += '<div class="text-danger self_assessment_remark_'+cur_rowCount+'_error" id=""></div>';
                html +='</td>';

                // html +='<td>';
                //     html +='<input type="text" name="weightage_'+cur_rowCount+'[]" id="" class="form-control">';
                // html +='</td>';

                html +='<td>';
                    html +='<select class="form-control js-example-basic-single rating_by_employee_'+cur_rowCount+'" id="rating_by_employee_'+cur_rowCount+'" name="rating_by_employee_'+cur_rowCount+'[]">';
                        html +='<option value="">...Select...</option>';
                        html +='<option value="EE">EE - Exceeded Expectations</option>';
                        html +='<option value="ME">ME - Met Expectations</option>';
                        html +='<option value="PME">PME - Partially Met Expectations</option>';
                        html +='<option value="ND">ND - Needs Development</option>';
                    html +='</select>';
                    html += '<div class="text-danger rating_by_employee_'+cur_rowCount+'_error" id=""></div>';
                html +='</td>';

                html +='<td>';
                    html +='<div style="margin-top: 80px;"></div>';
                html +='</td>';

                html +='<td>';
                    html +='<div class="dropup">';
                        html +='<button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                        html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KOA" title="Add KOA"><i class="fa fa-plus" onclick="additionalKRA(this,'+cur_rowCount+');"></i></button></a>';
                                    // html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button" id="btnDelete"  data-original-title="Delete KOA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                        html +='</div>';
                    html +='</div>';
                html +='</td>';

            html +='</tr>';

        $('#goal-tb tr:last').after(html);
        updatesno();
    }


    //Edit pop-up model and data show
    function login_user_details(){

        $.ajax({
            url: "get_goal_login_user_details_sup",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data.length !=0){          
                    var sup = "<b>";                              
                     sup += data[0].department;                              
                     sup += "</b>";  

                    $('#sup_dept').html(sup);                    
                }
            }
        });

        $.ajax({
            url: "get_goal_login_user_details_rev",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data.length !=0){  
                    var rev = "<b>";                              
                        rev += data[0].department;                              
                        rev += "</b>";  

                    $('#rev_dept').html(rev);                    
                }
            }
        });

    }

    function updatesno(){

        $.each($("#goal-tb tr:not(:first)"), function (i, el) {
            var sn = i + 1;
            var sno = "<p>"+sn+"</p>";
            $(this).find("td:first").html(sno);
        })

    }

    $("#goal-tb").on('click','#btnDelete',function(){
        // alert("sdf")
        var rowCount = $('#goal-tb tr').length;
        var cnt = rowCount -2;

        if(5 <= cnt){
            $("#addNewKBD").hide();
        }else{
            $("#addNewKBD").show();
        }
        
        $(this).closest('tr').remove();
        updatesno();
    });

    //New entry    
    $("#datatable_form_save").on('click',(e)=>{
        e.preventDefault();

        var new_arr_cel1=[];
        var error='';
        $(".tb_error").hide();        
        $('#datatable_form_save').attr('disabled' , true);

        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        // if(rate == ""){
        //     $errmsg3.html('Self Consolidated Rating is required').show();                
        //     error+="error";
        // }

        $('#goal-tb tr').each(function(index) {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // // Key business drivers
            // var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            // var $errmsg0 = $(err_div_name);
            // $errmsg0.hide();
            
            // if(col1 == ""){
            //     $errmsg0.html('Key business drivers is required').show();                
            //     error+="error";
            // }

            row_index = (index);
            var found = new_arr_cel1.find(e => e.name === col1);

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }else if(found == undefined){
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();

                new_arr_cel1.push({
                    name:col1
                });
            
            }else{
                // alert("2")
                // Key business drivers
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.css("display", "block");

                // $(this).closet
                // $errmsg0.html('Key business drivers is already entered').show();                
                error+="error";                
                console.log($errmsg0);
                
            }
            
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key outcome areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                // console.log(err_div_name1)
                
                // if(sub_value1 == ""){
                //     $errmsg1.html('Self assessment is required').show();                
                //     error+="error";
                // }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                // if(sub_value2 == ""){
                //     $errmsg2.html('Self rating is required').show();                
                //     error+="error";
                // }
                    
            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            $('#datatable_form_save').attr('disabled' , true);
            $('#datatable_form_save').html('Processing');
            new_data_insert();
        }else{
            $('#datatable_form_save').attr('disabled' , false);
            $('#datatable_form_save').html('Save As Draft');
        }        

        function new_data_insert(){

            //Check arlready entered
            $.ajax({
                url: "login_user_sheet_added",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data)
                    if(data == "Pending" || data == "Revert"){    
                        //Tb hide                              
                        $("#add_pms_table").hide();
                        $("#add_pms_table_error").hide();
                        $("#add_pms_table_error").html("Sorry, you're already applied!").show(); 
                        
                    }else{
                        //show
                        $("#add_pms_table").show();
                        $("#add_pms_table_error").hide();
                        $.ajax({            
                            url:"{{ url('add_goals_data') }}",
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
                                
                                $('#datatable_form_save').attr('disabled' , false);
                                $('#datatable_form_save').html('Save As Draft');

                                // $("#goals_setting_id").val(data);
                                // $("#datatable_form_save").css('display', 'none');
                                // $("#datatable_form_update").css('display', 'block');
                                // $("#goal_sheet_submit").css('display', 'none');
                                // $("#goal_sheet_submit_update").css('display', 'block');

                                location = "goals";                

                            }
                        });
                    }
                }
            });                       
                    
        }
        return false;        
    });    

    //New Submit entry
    $("#goal_sheet_submit").on('click',(e)=>{      
        e.preventDefault();

        var new_arr_cel1=[];
  
        // console.log(new_arr)      
        // console.log(error)      
        var error='';

        $('#goal_sheet_submit').attr('disabled' , true);
        $('#goal_sheet_submit').html("Processing");

        // $('button[type="submit"]').attr('disabled' , true);
        // var error='';

        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Self Consolidated Rating is required').show();                
            error+="error";
        }
       
        var row_index = [];

        $('#goal-tb tr').each(function(index) {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(index)
            row_index = (index);

            var found = new_arr_cel1.find(e => e.name === col1);
            // console.log(found);
            // console.log(new_arr_cel1)                  
            
            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }else if(found == undefined){
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();

                new_arr_cel1.push({
                    name:col1
                });
            
            }else{
                // alert("2")
                // Key business drivers
                var err_div_name = ".key_bus_drivers_"+col0+"_error";            
                var $errmsg0 = $(err_div_name);
                $errmsg0.css("display", "block");

                // $(this).closet
                // $errmsg0.html('Key business drivers is already entered').show();                
                error+="error";                
                console.log($errmsg0);
                
            }
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key outcome areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)
                
                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();                
                    error+="error";
                }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                if(sub_value2 == ""){
                    $errmsg2.html('Self rating is required').show();                
                    error+="error";
                }
                    
            });            

        });

        if(3 <= row_index){
            // alert("ss")

            var found_row_val = new_arr_cel1.find(e => e.name === "Customer");
        
            if(found_row_val == undefined){                      
            
                // alert("cust1, pro, peo")
                var err_div_name2 = ".tb_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                $errmsg2.html('Customer, Process & People KBD is required').show();                
                error+="error";
                
            }else{
            
                var found_row_val2 = new_arr_cel1.find(e => e.name === "Process");

                if(found_row_val2 == undefined){
                
                    var err_div_name2 = ".tb_error";
                    var $errmsg2 = $(err_div_name2);
                    $errmsg2.hide();
                    $errmsg2.html('Customer, Process & People KBD is required').show();                
                    error+="error";                

                }else{

                    var found_row_val3 = new_arr_cel1.find(e => e.name === "People");
                    if(found_row_val3 == undefined){
                        var err_div_name2 = ".tb_error";
                        var $errmsg2 = $(err_div_name2);
                        $errmsg2.hide();
                        $errmsg2.html('Customer, Process & People KBD is required').show();                
                        error+="error";

                    }else{
                        var err_div_name2 = ".tb_error";
                        var $errmsg2 = $(err_div_name2);
                        $errmsg2.hide();
                    }

                }
                // console.log(found_row_val)
            }
            
           
        }else{

            var err_div_name2 = ".tb_error";
            var $errmsg2 = $(err_div_name2);
            $errmsg2.hide();            
            $errmsg2.html('Min 3 KBD is required').show();                
            error+="error";
            // alert("s")

        }

        // console.log(new_arr_cel1)
        
        // console.log(new_arr_cel1)

        // console.log(row_index)

        //Sending data to database
        if(error==""){
            // alert("succes")
            $('#goal_sheet_submit').attr('disabled' , true);
            $('#goal_sheet_submit').html("Processing");
            new_sub_goal_data_insert();
        }else{
            $('#goal_sheet_submit').attr('disabled' , false);
            $('#goal_sheet_submit').html("Submit");
        }

        function new_sub_goal_data_insert(){

             //Check arlready entered
             $.ajax({
                url: "login_user_sheet_added",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data)
                    if(data == "Pending" || data == "Revert"){    
                        //Tb hide                              
                        $("#add_pms_table").hide();
                        $("#add_pms_table_error").hide();
                        $("#add_pms_table_error").html("Sorry, you're already applied!").show(); 
                        
                    }else{
                        //show
                        $("#add_pms_table").show();
                        $("#add_pms_table_error").hide();
                        $.ajax({            
                            url:"{{ url('add_goals_data_submit') }}",
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
                                
                                $('#goal_sheet_submit').attr('disabled' , false);
                                $('#goal_sheet_submit').html("Submit");

                                location = "goals";                

                            }
                        });
                    }
                }
            });           
                    
        }        

        return false;        
    });
    
    //update entry
    $("#datatable_form_update").on('click',()=>{   
        
        $('#datatable_form_update').attr('disabled' , true);
        
        var error='';

        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Self Consolidated Rating is required').show();
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();

            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();
                error+="error";
            }

            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();

                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();
                    error+="error";
                }

            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)

                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();
                    error+="error";
                }

            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();

                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();
                    error+="error";
                }

            });

        });

        console.log(error)

        //Sending data to database
        if(error==""){
            // alert("succes")
            update_data_insert();
        }else{
            // alert("er")
        }
        
        function update_data_insert(){
            $.ajax({            
                url:"{{ url('update_emp_goals_data') }}",
                type:"POST",
                data:$('#goalsForm').serialize(),
                dataType : "JSON",
                success:function(data)
                {

                    Toastify({
                        text: "Updated Sucessfully..!",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();    
                    
                    $('#datatable_form_update').attr('disabled' , false);

					$("#datatable_form_save").css('display', 'none');
					$("#datatable_form_update").css('display', 'block');

                    // location = "goal_setting_edit?id="+data+"";                

                }
            });
                    
        }        

        return false;        
    });

    //update Submit entry
    $("#goal_sheet_submit_update").on('click',()=>{
        $('button[type="submit"]').attr('disabled' , true);

        var error='';
        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Self Consolidated Rating is required').show();                
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)
                
                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();                
                    error+="error";
                }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();                
                    error+="error";
                }
                    
            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            update_submit_data_insert();
        }

        function update_submit_data_insert(){
            var employee_consolidated_rate = $("#employee_consolidated_rate").val();

            $.ajax({            
                url:"{{ url('update_emp_goals_data_submit') }}",
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
                    
                    $('button[type="submit"]').attr('disabled' , false);                    

                    location = "goals";                

                }
            });
                    
        }        
        return false;        
    });

</script>
@endsection

