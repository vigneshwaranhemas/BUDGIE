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
    #goal_sheet_edit_rev{
        position: relative;
        display: none;
    }
	#goal_sheet_submit{
        position: relative;
        display: none;
    }
    #goal_sheet_submit_no_tb{
        position: relative;
        display: none;
    }
    #goal_sheet_submit_for_reviewer{
        position: relative;
        display: none;
    }
    #goal_sheet_submit_no_tb_for_reviewer{
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
</style>
@endsection

@section('breadcrumb-title')
	<h2>Performance Management<span>System </span></h2>
@endsection

@section('breadcrumb-items')
{{-- <a class="btn btn-sm text-white" style="background-color: #FFD700;" title="Significantly Exceeds Expectations">SEE</a>
<a class="btn btn-sm text-white m-l-10" style="background-color: #008000;" title="Exceeded Expectations">EE</a>
<a class="btn btn-sm btn-success m-l-10 text-white" title="Met Expectations">ME</a>
<a class="btn btn-sm m-l-10 text-white" style="background-color: #FFA500" title="Partially Met Expectations">PME</a>
<a class="btn btn-sm m-l-10 text-white" style="background-color: #FF0000;" title="Needs Development">ND</a> --}}

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
										<h6 class="mb-0"><i class="icofont icofont-user-alt-7"> </i> Emp Name :</h6>
									</div>
									<div class="col-md-6">
										<p id="username" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
									</div>
									<div class="col-md-6 m-t-10">
										<h6 class="mb-0"><i class="icofont icofont-user-alt-7"> </i> Rep.Manager Name :</h6>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="sup_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
									</div>
                                    <div class="col-md-6 m-t-10">
										<h6 class="mb-0"><i class="icofont icofont-user-alt-7"> </i> Reveiwer Name :</h6>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="reviewer_name" class="f-w-900" style="text-transform: uppercase;font-size: 16px;"></p>
									</div>
									<div class="col-md-6 m-t-10">
										<h6 class="mb-0"><i class="icofont icofont-user-alt-7"> </i> HRBP :</h6>
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
										<h6 class="mb-0"><i class="icofont icofont-building"> </i> Rep.Manager Dept :</h6>
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
						<div class="table-responsive m-b-15 ">
							<div class="row">
								<div class="col-lg-12 m-b-35">
                                    <input type="hidden" id="tb_status">
									<div class="row float-right" style="margin-right: auto;">
										{{-- <a id="goal_sheet_edit" class="btn btn-warning text-white float-right  m-l-10">Edit</a> --}}
										<a id="goal_sheet_edit_rev" class="btn btn-warning text-white float-right  m-l-10">Edit</a>
									</div>
                                    <!-- reporting manager submit button start -->
									<!-- <a id="goal_sheet_submit_no_tb"  onclick="supSubmitDirect();" class="btn btn-success text-white float-right" title="Submit For Approval">Submit</a> -->
                                    <!-- reporting manager submit button end -->

									<div class="row m-t-50">
                                        <div class="col-lg-6">
                                            <h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
                                            <h5>REPORTING MANAGER CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
                                            <div id="reviewer_remarks_head"></div>
											<!-- <div id="supervisor_pip_exit_value"></div> -->
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="increment_recommended_head" style="display: none;"></div>
											<div id="hike_per_month_head" style="display: none;"></div>
                                            <div id="increment_percentage_head" style="display: none;"></div>
                                            <div id="performance_imporvement_head" style="display: none;"></div>
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
										<th scope="col">Rating </th>
										<th scope="col">Rep.Manager Remarks </th>
										<th scope="col">Rep.Manager Rating </th>
										<!-- <th scope="col">Reviewer Remarks </th>
										<th scope="col">HR Remarks </th>
										<th scope="col">BH Remarks </th>
										<th scope="col">Business Head</th> -->
									</tr>
								</thead>
								<tbody id="goals_record">
								</tbody>
							</table>
                            <input type="hidden" name="goals_setting_id" id="goals_setting_id">

							<div class="row m-t-20 m-b-30" id="save_div">
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
								<div class="col-lg-9 m-b-20" style="margin-left:-40px;">
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

								{{-- these coloumns are hide temperorly --}}

								{{-- <div class="col-lg-1 m-b-20">
									<label>Movement</label><br>
									<input class="m-t-10" id="candicate_checkbox" style="font-size:1000px;" name="candicate_checkbox" type="checkbox">
								</div>
								<div class="col-lg-6 m-b-20"></div>
								<div class="row m-l-5" id="movementProcessDiv">
									<div class="col-lg-12 m-b-10">
										<h5>Movement Process :</h5>
									</div>
									<div class="col-lg-3 m-b-20">
										<label>Movement</label><br>
										<select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_movement" name="supervisor_movement">
											<option value="" selected>...Select...</option>
											<option value="Vertical Movement (Promotion)">Vertical Movement (Promotion)</option>
											<option value="Horizontal Movement (Role Change)">Horizontal Movement (Role Change)</option>
										</select>
										<div class="text-danger" id="supervisor_movement_error"></div>
									</div>
									<div class="col-lg-3 m-b-20">
										<label>With Effect Date</label><br>
										<input type="date" name="with_effect_date" id="with_effect_date" class="form-control">
										<div class="text-danger" id="with_effect_date_error"></div>
									</div>
									<div class="col-lg-3 m-b-20">
										<label>Team Name</label><br>
										<select class="js-example-basic-multiple col-sm-12 form-control" placeholder="Select Team Member" id="team_member_list" name="team_member_list[]" style="width:100%" multiple="multiple">
											@foreach($customusers as $customuser)
												<option value="{{ $customuser->empID }}">{{ $customuser->username }}</option>
											@endforeach
										</select>
										<div class="text-danger" id="team_member_list_error"></div>
									</div>
									<div class="col-lg-3 m-b-20">
										<label>Supervisor Name</label><br>
										<select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_name_list" name="supervisor_name_list">
											<option value="" selected>...Select...</option>
											@foreach($customusers as $customuser)
												<option value="{{ $customuser->empID }}">{{ $customuser->username }}</option>
											@endforeach
										</select>
										<div class="text-danger" id="supervisor_name_list_error"></div>
									</div>
									<div class="col-lg-12">
										<label>Remark* :</label> <br>
										<textarea class="form-control m-t-5 m-b-10 col-lg-12" id="movement_remark"  style="height:50px;" name="movement_remark"></textarea>
										<div class="text-danger" id="movement_remark_error"></div>
									</div>
									<div class="col-lg-12">
										<label>Is Recommended for Change in Designation:</label>
										<input class="m-t-10" id="candicate_checkbox" style="font-size:200px;" name="candicate_checkbox" type="radio"> Yes
										<input class="m-t-10" id="candicate_checkbox" style="font-size:200px;" name="candicate_checkbox" type="radio"> No
										<div class="text-danger" id=""></div>
									</div>
									<div class="col-lg-12">
										<label>Is Recommended for Progression (Promotion):</label>
										<input class="m-t-10" id="candicate_checkbox" style="font-size:200px;" name="candicate_checkbox1" type="radio"> Yes
										<input class="m-t-10" id="candicate_checkbox" style="font-size:200px;" name="candicate_checkbox1" type="radio"> No
										<div class="text-danger" id=""></div>
									</div>
								</div> --}}
								<div class="col-lg-2">
									<a onclick="supFormSubmit();" id="goal_sheet_save" class="btn btn-primary text-white m-t-30">Save as Draft</a>
								</div>
								<div class="col-lg-2">
									<a id="goal_sheet_submit"  onclick="supFormSubmit_with_status();"  style="padding-left: 9px; padding-right: 9px;width: 96px; margin-right: 64%; margin-top: 30px;" class="btn btn-success text-white float-right" title="Submit For Approval">Submit</a>
								</div>
								<div class="col-lg-8">
									<div class="text-danger m-t-35" style="margin-left: -120px;" id="all_feild_required"></div>
								</div>
							</div>

							<!-- <div class="m-t-20 m-b-30 float-right"> -->
								<!-- <div class="m-t-20 m-b-30 row float-right" id="save_div">
									<div class="col-lg-2">
										<label>Consolidated Rating</label><br>
										<select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_consolidated_rate" name="employee_consolidated_rate">
											<option value="" selected>...Select...</option>
											<option value="SEE">SEE - Significantly Exceeds Expectations</option>
                                            <option value="EE">EE - Exceeded Expectations</option>
                                            <option value="ME">ME - Met Expectations</option>
                                            <option value="PME">PME - Partially Met Expectations</option>
                                            <option value="ND">ND - Needs Development</option>
										</select>
										<div class="text-danger supervisor_consolidated_rate_error" id=""></div>
									</div>
									<div class="col-lg-3 m-b-20">
										<label>Reporting Manager Recommendation</label><br>
										<select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_pip_exit" name="supervisor_pip_exit">
											<option value="">...Select...</option>
											<option value="Place employee in PIP" selected>Place employee in PIP</option>
											<option value="Vertical Movement (Promotion)">Vertical Movement (Promotion)</option>
											<option value="Horizontal Movement (Role Change)">Horizontal Movement (Role Change)</option>
										</select>
										<div class="text-danger supervisor_pip_exit_error" id=""></div>
									</div>

									<div class="col-lg-12">
										<a onclick="supFormSubmit();" class="btn btn-primary text-white m-t-30">Save as Draft</a>
									</div>
                                </div> -->




							<!-- </div> -->

						</div>

						<!-- reviewer submit button start -->
                        <div class="m-t-20 m-b-30" id="save_div_rev_mark">
                            <div class="col-lg-12 row">
                                <div class="col-lg-3">
                                    <label>Reviewer Remarks</label><br>
                                    <textarea id="reviewer_remarks" name="reviewer_remarks" class="form-control"></textarea>
                                    <div class="text-danger reviewer_remarks_error" id="reviewer_remarks_error"></div>
                                </div>
                                <!-- <input type="hidden" id="increment_hike"> -->
                                <!-- <div class="col-lg-3">
                                    <label>Increment recommended?</label><br>
                                    <select class="form-control" id="increment_recommended" name="increment_recommended">
                                        <option value="" selected>...Select...</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div class="text-danger increment_recommended_error" id="increment_recommended_error"></div>
                                </div>
                                <div class="col-lg-3" id="increment_percentage_view" style="display: none;">
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

                        <div class="m-b-30 row" id="save_div_rev">
                            <div class="col-lg-3">
                                <a onclick="revFormSubmit()" id="rev_save" class="btn btn-primary text-white m-t-30" title="Save as Draft">Save As Draft</a>
                            </div>
                            <div class="col-lg-2" style="margin-top: 30px;margin-left: -120px;">
                                <a id="goal_sheet_submit_for_reviewers"  onclick="supFormSubmit_with_status_for_reviewer();" class="btn btn-success text-white" title="Submit For Approval">Submit</a>
                            </div>
							<div class="col-lg-8">
								<div class="text-danger m-t-15" style="margin-left: -120px;" id="all_feild_required"></div>
							</div>
                        </div>

                        {{-- <a id="goal_sheet_submit_no_tb_for_reviewer"  onclick="supSubmitDirect_for_reviewer();" class="btn btn-success text-white m-t-20 m-b-30 float-right" title="Submit For Approval">Submit</a> --}}
                        <!-- reviewer submit button end -->
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

        $(document).ready(function(){
            get_goal_setting_reviewer_tl();
			textarea_hide();
			hike_hide_and_show_in_reviewer_tab();
            get_all_datas_goals_for_reviewer();
        });

		function isNumber(evt) {
              evt = (evt) ? evt : window.event;
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
              }
              return true;
        }

		function textarea_hide(){
			$('.select_one').hide();
			$('.textarea_one').hide();
		}

		$("#increment_recommended").on('change', function()
        {
            var increment_recommended_value = $("#increment_recommended").val();
            // alert(increment_recommended_value);

            if(increment_recommended_value == "no")
            {
                $("#increment_percentage").val("");
                $("#hike_per_month").val("");
            }

            var increment_hike = $('#increment_hike').val();
            // alert(increment_hike);
            if(increment_hike == "HEPL")
            {
                if(increment_recommended_value == "yes")
                {
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

		$( document ).ready(function() {
			// goal_record();
			$("#save_div").hide();
			$("#save_div_rev").hide();
			$("#save_div_rev_mark").hide();

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
				// 	'copyHtml5',
				// 	'excelHtml5',
				// 	'csvHtml5',
				// 	'pdfHtml5'
				// ]
			} );
            tb_data();
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
				// console.log(response[0].supervisor_consolidated_rate)
                $('#supervisor_consolidate_rate_show').append('');
				$('#supervisor_consolidate_rate_show').append(response[0].supervisor_consolidated_rate);

                if(response != ""){
					$('#supervisor_consolidated_rate').val(response[0].supervisor_consolidated_rate).change();
				}
			},
			error: function(error) {
				console.log(error);

			}

		});

        /********** Reviewer Remarks Get Data **************/
		$.ajax({
			url:"{{ url('get_goals_reviewer_remarks') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
                // console.log(response);
                html = "";
                html += "<h5>REVIEWER REMARKS : <span>"+response+"</span></h5>";

                if(response != "")
                {
                    $('#reviewer_remarks_head').append(html);
                }

                if(response != ""){
							$('#reviewer_remarks').val(response);
						}
			},
			error: function(error) {
				console.log(error);

			}

		});

		/********** Get all datas in Goals sheet for Reviewer **************/
		function get_all_datas_goals_for_reviewer(){
		$.ajax({
			url:"{{ url('get_all_datas_goals_for_reviewer') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
                // console.log(response[0].increment_recommended);
                // INCREMENT RECOMMENDED
                // if(response != ""){
				// 	$('#increment_recommended').val(response[0].increment_recommended);
				// }

                // // INCREMENT PERCENTAGE
                // if(response != ""){
                //     $('#increment_percentage').val(response[0].increment_percentage);
                //     $('#hike_per_month').val(response[0].hike_per_month);
                // }

                // var increment_hike = $('#increment_hike').val();
                // // console.log(increment_hike);
                // if(increment_hike == "HEPL")
                // {
                //     if(response[0].increment_recommended == "yes")
                //     {
                //         $('#increment_percentage_view').show();
                //         $('#hike_per_month_view').hide();
                //     }else{
                //         $('#increment_percentage_view').hide();
                //         $('#hike_per_month_view').hide();
                //     }
                // }else if(increment_hike == "NAPS")
                // {
                //     if(response[0].increment_recommended == "yes")
                //     {
                //         $('#increment_percentage_view').hide();
                //         $('#hike_per_month_view').show();
                //     }else{
                //         $('#increment_percentage_view').hide();
                //         $('#hike_per_month_view').hide();
                //     }
                // }

                // // PERFORMANCE IMPORVEMENT
                // if(response != ""){
                //     $('#performance_imporvement').val(response[0].performance_imporvement);
                // }

                // INCREMENT RECOMMENDED HEAD
                // html = "";
                // html += "<h5>INCREMENT RECOMMENDED : <span>"+response[0].increment_recommended+"</span></h5>";

                // if(response != "")
                // {
                //     $('#increment_recommended_head').append(html);
				// 	$('#increment_recommended_head').css("display","block");
                // }

                // // INCREMENT PERCENTAGE HEAD AND HIKE PER MONTH HEAD
                // html1 = "";
                // html1 += "<h5>INCREMENT PERCENTAGE : <span>"+response[0].increment_percentage+"</span></h5>";

                // html_hike = "";
                // html_hike += "<h5>HIKE PER MONTH : <span>"+response[0].hike_per_month+"</span></h5>";

                // if(increment_hike == "HEPL")
                // {
                //     if(response != "")
                //     {
                //         $('#increment_percentage_head').append(html1);
                //         $('#increment_percentage_head').css("display","block");
                //         $('#hike_per_month_head').css("display","none");
                //     }
                // }else if(increment_hike == "NAPS")
                // {
                //     if(response != "")
                //     {
                //         $('#hike_per_month_head').append(html_hike);
                //         $('#hike_per_month_head').css("display","block");
                //         $('#increment_percentage_head').css("display","none");
                //     }
                // }

                // // PERFORMANCE IMPORVEMENT HEAD
                // html2 = "";
                // html2 += "<h5>PERFORMANCE IMPORVEMENT : <span>"+response[0].performance_imporvement+"</span></h5>";

                // if(response != "")
                // {
                //     $('#performance_imporvement_head').append(html2);
				// 	$('#performance_imporvement_head').css("display","block");
                // }

			},
			error: function(error) {
				console.log(error);

			}

		});
    };


		/********** Supervisor pip exit Get Data **************/
		$.ajax({
			url:"{{ url('get_goals_reviewer_sup_pip_exit_data') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				// console.log(response);

				html = "";
				html += "<h5>REPORTING MANAGER RECOMMENDATION : <span>"+response+"</span></h5>";

				if(response != "")
				{
					$('#supervisor_pip_exit_value').append(html);
				}
			},
			error: function(error) {
				console.log(error);

			}

		});

        function tb_data()
        {
		$.ajax({
			url:"{{ url('fetch_goals_reviewer_sup_details') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
                // alert(response)
                // console.log(response.result)

				$('#goals_record_tb').DataTable().clear().destroy();
                $('#goals_record').empty();
                $('#goals_record').append(response.html);
                $("#tb_status").val(response.t_value);

                if(response.result == 1){
					// alert("1");
					$("#goal_sheet_edit").css("display","block");
                    $("#goal_sheet_edit_rev").css("display","none");
					$('#increment_recommended_head').css("display","none");
                    $('#increment_percentage_head').css("display","none");
                    $('#performance_imporvement_head').css("display","none");
                    $('#sup_setting_excel_generation_id').css("display","block");
                    $('#rev_setting_excel_generation_id').css("display","none");

				}else if(response.result == "2"){
					// alert("2")
					$("#goal_sheet_edit").css("display","none");
                    $("#goal_sheet_edit_rev").css("display","block");
                    $('#sup_setting_excel_generation_id').css("display","none");
                    $('#rev_setting_excel_generation_id').css("display","block");
				}

                if(response.sheet_status.supervisor_tb_status == "1")
                {
                    $("#goal_sheet_submit_no_tb").css("display","block");
                }
                if(response.sheet_status.supervisor_tb_status == "1" && response.sheet_status.supervisor_status == "1"){
                    // alert("one")
                    $("#goal_sheet_edit").css("display","none");
                    $("#goal_sheet_submit_no_tb").css("display","none");
                }
                if(response.sheet_status.reviewer_tb_status == "1")
                {
                    $("#goal_sheet_submit_no_tb_for_reviewer").css("display","block");
                }
                if(response.sheet_status.reviewer_tb_status == "1" && response.sheet_status.reviewer_status == "1"){
                    // alert("one")
                    $("#goal_sheet_edit_rev").css("display","none");
                    $("#goal_sheet_submit_no_tb_for_reviewer").css("display","none");
                }

				$('#goals_record_tb').DataTable( {
                "searching": false,
                "paging": false,
                "info": false,
                "fixedColumns": {
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
                } );

				textarea_hide();

			},
			error: function(error) {
				console.log(error);

			}

		});
    }


		$(()=>{
			$("#goal_sheet_edit").on('click',()=>{

				var params = new window.URLSearchParams(window.location.search);
				// var id=params.get('id');
				var id=@json($sheet_code);

				$.ajax({
					url:"{{ url('check_goal_sheet_role_type_hr') }}",
					type:"POST",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						// alert(response)
						if(response == 1){
							//As supervisorfe

							$("#goal_sheet_edit").css("display","none");
							$("#goal_sheet_submit").css("display","block");
							$("#save_div").show();
							$("#save_div_rev").hide();
							$("#save_div_rev_mark").hide();
                            $("#goal_sheet_submit_no_tb").css("display","none");

							var i=1;
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
									// console.log("data")
									// if ($(this).text() != ""){
									// 	// alert("one")
                                    //     var text_data=$(this).text();
							        //     $(".sup_remark_p_rev_"+i+"").remove();
                                    //     var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
									// 		tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
									// 	$(this).append(tx)
									// }
									// else{
									// 	var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark[]" style="width:200px;" class="form-control"></textarea>';
									// 		tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
									// 	$(this).append(tx)
									// 	// alert("two")
									// }
									i++;
								}
							);
                            //supervisor rating
				            var j = 1;
							$("#goals_record_tb tbody tr td."+defined_class2+"").each(
								function(index){
                                    if($('.p_tag_two_'+j+'').text()!=""){
                                       $('.p_tag_two_'+j+'').remove();
                                       $('.select_one').show();
                                      }
                               else{
                                     $('.select_one').show();
                              }

									// console.log("data")
									// if ($(this).text() != ""){
									// 	// alert("one")
                                    //     var text_data=$(this).text();
							        //     $(".sup_rating_p_rev_"+j+"").remove();
							        //     $(this).append('<select class="form-control js-example-basic-single key_bus_drivers" name="sup_rating[]">\
									// 		<option value="">Choose</option>\
									// 		<option value="EE" '+(text_data=="EE" ? "selected" : "")+'>EE</option>\
									// 		<option value="AE" '+(text_data=="AE" ? "selected" : "")+'>AE</option>\
									// 		<option value="ME" '+(text_data=="ME" ? "selected" : "")+'>ME</option>\
									// 		<option value="PE" '+(text_data=="PE" ? "selected" : "")+'>PE</option>\
									// 		<option value="ND" '+(text_data=="ND" ? "selected" : "")+'>ND</option>\
									// 		</select>\
									// 		<div class="text-danger sup_rating_'+index+'_error"></div>')
									// }
									// else{
									// 	var op = '<select class="js-example-basic-single" name="sup_rating[]" style="width:150px;" id="employee_consolidated_rate" name="employee_consolidated_rate">';
									// 		op += '<option value="" selected>...Select...</option>';
									// 		op += '<option value="EE">EE</option>';
									// 		op += '<option value="AE">AE</option>';
									// 		op += '<option value="ME">ME</option>';
									// 		op += '<option value="PE">PE</option>';
									// 		op += '<option value="ND">ND</option>';
									// 		op += '</select>';
									// 		op += '<div class="text-danger sup_rating_'+index+'_error"></div>';
									// 	$(this).append(op);
									// 	// alert("two")
									// }
									// i++;
                                    j++;
								}
							);


							//Pip value
							$.ajax({
								url:"{{ url('goals_sup_pip_exit_select_op') }}",
								type:"GET",
								data:{id:id},
								dataType : "JSON",
								success:function(response)
								{
									// alert(response)
									if(response != ""){
										$('#supervisor_pip_exit').val(response).change();
									}

								},
								error: function(error) {
									console.log(error);

								}

							});
						}

					},
					error: function(error) {
						console.log(error);

					}

				});
			})
		})

		function supFormSubmit(){

			// var error='';

			$('#goal_sheet_save').attr('disabled' , true);
			$('#goal_sheet_save').html('Processing');

			// var rate = $("#supervisor_consolidated_rate").val();
			// var $errmsg3 = $(".supervisor_consolidated_rate_error");
			// $errmsg3.hide();

			// if(rate == ""){
			// 	$errmsg3.html('Consolidated rate is required').show();
			// 	error+="error";
			// }

			// var i=1;

			// $('#goals_record_tb > tbody  > tr').each(function(index) {
			// 	var col0=$(this).find("td:eq(0)").text();
			// 	var col6=$(this).find("td:eq(5) textarea").val();
			// 	var col7=$(this).find("td:eq(6) option:selected").val();

			// 	// Supervisor Remarks
			// 	var err_div_name = "#sup_remark_"+index+"_error";
			// 	var $errmsg0 = $(err_div_name);
			// 	$errmsg0.hide();

			// 	if(col6 == "" || col6 == undefined){
			// 		// console.log($errmsg0)
			// 		$errmsg0.html('Supervisor remarks is required').show();
			// 		error+="error";
			// 	}

			// 	// Supervisor Rate
			// 	var err_div_name1 = ".sup_rating_"+index+"_error";
			// 	var $errmsg1 = $(err_div_name1);
			// 	$errmsg1.hide();

			// 	if(col7 == "" || col7 == undefined){
			// 		// console.log($errmsg0)
			// 		$errmsg1.html('Supervisor rating is required').show();
			// 		error+="error";
			// 	}

			// 	i++;

			// });

			//Sending data to database
			// if(error==""){
				// alert("succes")
				data_insert();
			// }

			function data_insert(){

				$.ajax({

					url:"{{ url('update_goals_sup_by_rev') }}",
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

						$('#goal_sheet_save').attr('disabled' , false);
						$('#goal_sheet_save').html('Save As Draft');

						// window.location = "{{ url('goals')}}";
                        window.location.reload();
					},
					error: function(response) {

					}
				});
			}
         }

        //Edit pop-up model and data show
		function get_goal_setting_reviewer_tl(){

			var params = new window.URLSearchParams(window.location.search);
			// var id=params.get('id')
			var id=@json($sheet_code);

        $.ajax({
            url: "get_goal_setting_reviewer_details_tl",
            method: "POST",
            data:{"id":id,},
            dataType: "json",
            success: function(data) {
                // console.log(data.only_dept[0].department)

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


    function revFormSubmit(){

                // var error='';

				$('#rev_save').attr('disabled' , true);
				$('#rev_save').html('Processing');

                // var reviewer_remarks_val = $("#reviewer_remarks").val();
                // // alert(rate)
                // var $errmsg3 = $(".reviewer_remarks_error");
                // $errmsg3.hide();

                // if(reviewer_remarks_val == ""){
                //     $errmsg3.html('Reviewer Remarks is required').show();
                //     error+="error";
                // }

				// var increment_recommended_val = $("#increment_recommended").val();
                // // alert(increment_recommended_val)
                // var $errmsg3 = $(".increment_recommended_error");
                // $errmsg3.hide();

                // if(increment_recommended_val == ""){
                //     $errmsg3.html('Increment Recommended is required').show();
                //     error+="error";
                // }

                // var performance_imporvement_val = $("#performance_imporvement").val();
                // // alert(performance_imporvement_val)
                // var $errmsg3 = $(".performance_imporvement_error");
                // $errmsg3.hide();

                // if(performance_imporvement_val == ""){
                //     $errmsg3.html('Performance Imporvement is required').show();
                //     error+="error";
                // }
                // var i=1;

                // $('#goals_record_tb > tbody  > tr').each(function(index) {
                //     var col0=$(this).find("td:eq(0)").text();
                //     var col8=$(this).find("td:eq(7) textarea").val();

                //     // Supervisor Rate
                //     var err_div_name1 = ".reviewer_remarks_"+index+"_error";
                //     var $errmsg1 = $(err_div_name1);
                //     $errmsg1.hide();

                //     if(col8 == "" || col8 == undefined){
                //         // console.log($errmsg0)
                //         $errmsg1.html('Reviewer Remarks is required').show();
                //         error+="error";
                //     }

                //     i++;
                // });
                //Sending data to database
                // if(error==""){
                    data_insert_reviewer();
                // }
                function data_insert_reviewer(){

                    $.ajax({

                        url:"{{ url('update_goals_reviewer_teamleader') }}",
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

							$('#rev_save').attr('disabled' , false);
							$('#rev_save').html('Save As Draft');
                            // window.location = "{{ url('goals')}}";
                            window.location.reload();
                        },
                        error: function(response) {

                        }

                    });
                }
            }

            function supFormSubmit_with_status(){

                var error='';

				$('#goal_sheet_submit').attr('disabled' , true);
				// $('#goal_sheet_submit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');
				$('#goal_sheet_submit').html('Processing');

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


				//supervisor rating
				var j = 1;
				$("#goals_record_tb tbody tr td."+defined_class2+"").each(
				function(index){
				var err_div_name1 = ".sup_rating_"+j+"_error";
				var $errmsg1 = $(err_div_name1);
				$errmsg1.hide();
				var selected_opt=$("#sup_rating"+j+"").find(":selected").val();
				if (selected_opt == "" || selected_opt== undefined){
				$errmsg1.html('Rating is required').show();
				error+="error";
				}
				j++;

				}

				);


                // $('#goals_record_tb > tbody  > tr').each(function(index) {
                //     var col0=$(this).find("td:eq(0)").text();
                //     var col6=$(this).find("td:eq(5) textarea").val();
                //     var col7=$(this).find("td:eq(6) option:selected").val();

                //     // Supervisor Remarks
                //     var err_div_name = "#sup_remark_"+i+"_error";
                //     var $errmsg0 = $(err_div_name);
                //     $errmsg0.hide();

                //     if(col6 == "" || col6 == undefined){
                //         // console.log($errmsg0)
                //         $errmsg0.html('Supervisor remarks is required').show();
                //         error+="error";
                //     }

                //     // Supervisor Rate
                //     var err_div_name1 = ".sup_rating_"+i+"_error";
                //     var $errmsg1 = $(err_div_name1);
                //     $errmsg1.hide();

                //     if(col7 == "" || col7 == undefined){
                //         // console.log($errmsg0)
                //         $errmsg1.html('Supervisor rating is required').show();
                //         error+="error";
                //     }

                //     i++;
                // });

                //Sending data to database
                if(error==""){
                    // alert("hi")
					var $errmsg4 = $("#all_feild_required");
					$errmsg4.hide();
					$('#goal_sheet_submit').attr('disabled' , true);
					$('#goal_sheet_submit').html('Processing');
                    data_insert_submit();
                }else{
					var $errmsg4 = $("#all_feild_required");
					$errmsg4.hide();
					$errmsg4.html('All the field is required').show();
					error+="error";
					$('#goal_sheet_submit').attr('disabled' , false);
					$('#goal_sheet_submit').html('Submit');
				}

                function data_insert_submit(){

                    $.ajax({
                        url:"{{ url('update_goals_sup_submit_overall') }}",
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
                            tb_data();
                            $("#save_div").hide();
                            $("#goal_sheet_edit").css("display","block");

							$('#goal_sheet_submit').attr('disabled' , false);
							$('#goal_sheet_submit').html('Submit');

                            window.location = "{{ url('goals')}}";
                            // window.location.reload();
                        },
                        error: function(response) {

                        }

                    });
                }
            }

        //Supervisor Direct Submit
		function supSubmitDirect(){

            var id = $('#goals_setting_id').val();

            $.ajax({
                url:"{{ url('update_goals_sup_submit_direct') }}",
                type:"POST",
                data:{id:id},
                dataType : "JSON",
                success:function(data)
                {
                    Toastify({
                        text: "Added Sucessfully..!",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    window.location = "{{ url('goals')}}";
                    // window.location.reload();
                },
                error: function(response) {

                }

            });
        }

            // start reviewer tab edit process
            $(()=>{
			$("#goal_sheet_edit_rev").on('click',()=>{

				var params = new window.URLSearchParams(window.location.search);
				// var id=params.get('id');
				var id=@json($sheet_code);

				$.ajax({
					url:"{{ url('check_goal_sheet_role_type_hr') }}",
					type:"POST",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						if(response == 2){
							//As reviewer

							$("#goal_sheet_edit_rev").css("display","none");
							$("#goal_sheet_submit_for_reviewer").css("display","block");
							$("#save_div_rev").show();
							$("#save_div_rev_mark").show();
							$("#save_div").hide();
                            $("#goal_sheet_submit_no_tb_for_reviewer").css("display","none");

							// var i=1;
							// 	var defined_class1="reviewer_remarks";

							// $("#goals_record_tb tbody tr td."+defined_class1+"").each(
							// 	function(index){

							// 		// console.log("data")
							// 		if ($(this).text() != ""){
							// 			// alert("one")
                            //             var text_data=$(this).text();
							//             $(".reviewer_remarks_p_rev_"+i+"").remove();
                            //             var tx = '<textarea id="business_head_edit'+i+'" name="reviewer_remarks[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
							// 				tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
							// 			$(this).append(tx)
							// 		}
							// 		else{
							// 			var tx = '<textarea id="business_head_edit'+i+'" name="reviewer_remarks[]" style="width:200px;" class="form-control"></textarea>';
							// 				tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
							// 			$(this).append(tx)
							// 			// alert("two")
							// 		}
							// 		i++;
							// 	}
							// );
						}
					},
					error: function(error) {
						console.log(error);

					}
				});
			})
		})

        function supFormSubmit_with_status_for_reviewer(){

			var error='';

			$('#goal_sheet_submit_for_reviewers').attr('disabled' , true);
			$('#goal_sheet_submit_for_reviewers').html('Processing');

			var reviewer_remarks_val = $("#reviewer_remarks").val();
			// alert(rate)
			var $errmsg3 = $(".reviewer_remarks_error");
			$errmsg3.hide();

			if(reviewer_remarks_val == ""){
				$errmsg3.html('Reviewer Remarks is required').show();
				error+="error";
			}

			// var increment_recommended_val = $("#increment_recommended").val();
			// 	// alert(increment_recommended_val)
			// var $errmsg3 = $(".increment_recommended_error");
			// $errmsg3.hide();

			// if(increment_recommended_val == ""){
			// 	$errmsg3.html('Increment Recommended is required').show();
			// 	error+="error";
			// }

            // var increment_hike = $('#increment_hike').val();

			// var increment_percentage_val = $("#increment_percentage").val();
            //     // alert(increment_percentage_val)
            // var $errmsg3 = $(".increment_percentage_error");
            // $errmsg3.hide();

            // if(increment_hike == "HEPL")
            // {
            //     if(increment_recommended_val == "yes"){
            //         if(increment_percentage_val == ""){
            //             $errmsg3.html('Increment Percentage is required').show();
            //             error+="error";
            //         }
            //     }
            // }

            // var hike_per_month_val = $("#hike_per_month").val();
            //     // alert(increment_percentage_val)
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

			// var performance_imporvement_val = $("#performance_imporvement").val();
			// // alert(performance_imporvement_val)
			// var $errmsg3 = $(".performance_imporvement_error");
			// $errmsg3.hide();

			// if(performance_imporvement_val == ""){
			// 	$errmsg3.html('Performance Imporvement is required').show();
			// 	error+="error";
			// }

			// var i=1;

			// $('#goals_record_tb > tbody  > tr').each(function(index) {
			//     var col0=$(this).find("td:eq(0)").text();
			//     var col7=$(this).find("td:eq(7) textarea").val();

			//     // Supervisor Rate
			//     var err_div_name1 = ".reviewer_remarks_"+index+"_error";
			//     var $errmsg1 = $(err_div_name1);
			//     $errmsg1.hide();

			//     if(col7 == "" || col7 == undefined){
			//         // console.log($errmsg0)
			//         $errmsg1.html('Reviewer remarks is required').show();
			//         error+="error";
			//     }

			//     i++;
			// });

			//Sending data to database
			if(error==""){
				var $errmsg4 = $("#all_feild_required");
				$errmsg4.hide();
				$('#goal_sheet_submit_for_reviewers').attr('disabled' , true);
				$('#goal_sheet_submit_for_reviewers').html('Processing');
				data_insert_submit_overall_for_reviewer();
			}else{
				var $errmsg4 = $("#all_feild_required");
				$errmsg4.hide();
				$errmsg4.html('All the field is required').show();
				error+="error";
				$('#goal_sheet_submit_for_reviewers').attr('disabled' , false);
				$('#goal_sheet_submit_for_reviewers').html('Submit');
			}

            function data_insert_submit_overall_for_reviewer(){

                $.ajax({
                    url:"{{ url('update_goals_sup_submit_overall_for_reviewer') }}",
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

                        tb_data();
                        $("#save_div").hide();
                        $("#goal_sheet_edit_for_reviewer").css("display","block");

						$('#goal_sheet_submit_for_reviewers').attr('disabled' , false);
						$('#goal_sheet_submit_for_reviewers').html('Submit');

                        window.location = "{{ url('goals')}}";
                        // window.location.reload();
                    },
                    error: function(response) {


                    }

                });
            }
        }

        //Team Member Direct Submit
		function supSubmitDirect_for_reviewer(){

            var id = $('#goals_setting_id').val();

            $.ajax({
                url:"{{ url('update_goals_team_member_submit_direct') }}",
                type:"POST",
                data:{id:id},
                dataType : "JSON",
                success:function(data)
                {
                    Toastify({
                        text: "Added Sucessfully..!",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    window.location = "{{ url('goals')}}";
                    // window.location.reload();
                },
                error: function(response) {

                }
            });
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

		function hike_hide_and_show_in_reviewer_tab()
        {
            var params = new window.URLSearchParams(window.location.search);
            // var id=params.get('id');
			var id=@json($sheet_code);

            // alert(id);

            $.ajax({
                url:"{{ url('hike_hide_and_show_in_reviewer') }}",
                type:"GET",
                data:{id:id},
                dataType : "JSON",
                success:function(response)
                {
                    // console.log(response[0].payroll_status);
                    $("#increment_hike").val(response[0].payroll_status);
                    // if(response[0].payroll_status == "HEPL")
                    // {
                    //     $('#increment_percentage_view').show();
                    //     $('#hike_per_month_view').hide();

                    // }else if(response[0].payroll_status == "NAPS")
                    // {
                    //     $('#increment_percentage_view').hide();
                    //     $('#hike_per_month_view').show();
                    // }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        };

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
                    // var id=params.get('id')
					var id=@json($sheet_code);

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

	</script>

@endsection

