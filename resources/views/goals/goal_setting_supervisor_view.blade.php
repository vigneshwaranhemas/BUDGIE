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
        display: block;
    }
	#goal_sheet_submit{
        position: relative;
        display: none;
    }
	#goal_sheet_submit_no_tb{
        position: relative;
        display: none;
    }
	/* .btn.sup_update_table{
		padding: 6px;
	} */
	.select2-container--default{
		width: 320px !important;
	}
	.select2-container--open .select2-dropdown {
		top: 65px !important;
	}
	.select2-container .select2-selection--single{
		border-radius: 5px !important;
	}
	.selection .select2-selection{
		border-radius: 5px !important;
	}
	#goal_sheet_edit{
		display: none;
	}
	table.dataTable select{
		border-radius: unset !important;
	}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Performance Management <span>System</span></h2>
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
				<div class="card card-absolute">
					<div class="card-header bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">
						<button type="submit" id="sup_setting_excel_generation_id" class="btn btn-secondary m-b-20 float-right"><i class="ti-save"></i>Export Excel</button>
						<div class="table-responsive m-b-15 ">
							<div class="row">
								<div class="col-lg-12 m-b-35">

                                    <input type="hidden" id="tb_status">
									{{-- <a id="goal_sheet_edit" class="btn btn-warning text-white float-right m-l-10">Edit</a> --}}
									<!-- <a id="goal_sheet_submit_no_tb"  onclick="supSubmitDirect();" class="btn btn-success text-white float-right" title="Submit For Approval">Submit</a> -->
									<!-- <button type="button" class="btn btn-warning "  >Edit</button> -->
									<h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
									<h5>REPORTING MANAGER CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
									<h5>REPORTING MANAGER RECOMMENDATION : <span id="supervisor_pip_exit_show"></span></h5>
								</div>
							</div>
							<form id="supGoalsForm">
								<table class="table table-border-vertical table-border-horizontal" id="goals_record_tb">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Key Business Drivers (KBD)</th>
											<th scope="col">Key Result Areas (KRA)</th>
											<th scope="col">Measurement Criteria (UOM)</th>
											<th scope="col">Self Assessment</th>
											<th scope="col">Rating By Employee</th>
											<th scope="col">Rep.Manager Remarks </th>
											<th scope="col">Rep.Manager Rating </th>
											{{-- <th scope="col">Reviewer Remarks </th>
											<th scope="col">HR Remarks </th>
											<th scope="col">BH Remarks </th> --}}
											<!-- <th scope="col">Business Head</th> -->
										</tr>
									</thead>
									<tbody id="goals_record">
									</tbody>
								</table>
								<input type="hidden" name="goals_setting_id" id="goals_setting_id">

								<!-- <div class="m-t-20 m-b-30 float-right"> -->
									<div class="row m-t-20 m-b-30" id="save_div">
										<div class="col-lg-3">
											<label>Rep.Manager Consolidated Rating</label><br>
											<select class="form-control" style="width:200px;margin-top:2px !important;" id="supervisor_consolidated_rate" name="employee_consolidated_rate">
												<option value="" selected>...Select...</option>
												<option value="SEE">SEE - Significantly Exceeds Expectations</option>
												<option value="EE">EE - Exceeded Expectations</option>
												<option value="ME">ME - Met Expectations</option>
												<option value="PME">PME - Partially Met Expectations</option>
												<option value="ND">ND - Needs Development</option>
											</select>
											<div class="text-danger supervisor_consolidated_rate_error" id=""></div>
										</div>
										<div class="col-lg-9" style="margin-left:-55px">
											<label>Reporting Manager Recommendation</label><br>
											<select class="form-control" style="width:200px;margin-top:2px !important;" id="supervisor_pip_exit" name="supervisor_pip_exit">
												<option value="">...Select...</option>
												<option value="No movement" selected>No movement</option>
												<option value="Place employee in PIP">Place employee in PIP</option>
												<option value="Vertical Movement (Promotion)">Vertical Movement (Promotion)</option>
												<option value="Horizontal Movement (Role Change)">Horizontal Movement (Role Change)</option>
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
											<a onclick="supFormSave();" id="sup_save_table" class="btn btn-primary text-white m-t-5">Save As Draft</a>
											<a onclick="supFormSave();" id="sup_update_table" class="btn btn-primary text-white m-t-5 sup_update_table">Save As Draft</a>
										</div>
										<div class="col-lg-2">
											<a id="goal_sheet_submit" style="padding-left: 9px; padding-right: 9px;width: 96px; margin-left: -30px; margin-top: 6px;" onclick="supFormSubmit();" class="btn btn-success text-white" title="Submit For Approval">Submit</a>
										</div>
										<div class="col-lg-8">
											<div class="text-danger m-t-15" style="margin-left: -120px;" id="all_feild_required"></div>
										</div>
									</div>
								<!-- </div> -->
							</form>
							<div id="employee_summary_get_div" style="display:none">
								<form  id="supervisorSummaryForm">
									<div class="row m-t-10 m-b-10">
										<div class="col-lg-12">
											<h5><b>Summary</b></h5>
										</div>
										<div class="col-lg-2">
											<h6>Employee Summary :</h6>
										</div>
										<div class="col-lg-10">
											<p id="goal_employee_summary_div_show"></p>
										</div>
										<div class="col-lg-12 m-t-5">
											<h6>Summary :</h6>
										</div>
										<div class="col-lg-4">
											<textarea name="supervisor_summary" id="supervisor_summary" class="form-control m-t-5" style="height: 100px;"></textarea>
											<input type="hidden" name="id" id="goal_supervisor_sum_id" class="form-control">
											<button class="btn btn-primary float-right m-t-10" type="submit">Save</button>
										</div>
										<div class="col-lg-8">
										</div>
									</div>
								</form>
							</div>
							<div id="employee_summary_get_show" style="display:none">
								<div class="row m-t-10 m-b-10">
									<div class="col-lg-12">
										<h5><b>Summary</b></h5>
									</div>
									<div class="col-lg-2">
										<h6>Employee Summary :</h6>
									</div>
									<div class="col-lg-10">
										<p id="goal_employee_summary_show"></p>
									</div>
									<div class="col-lg-2">
										<h6>Supervisor Summary :</h6>
									</div>
									<div class="col-lg-10">
										<p id="goal_supervisor_summary_show"></p>
									</div>
								</div>
							</div>
						</div>
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
			goal_employee_summary_check();
		});

		function goal_employee_summary_check(){
			var params = new window.URLSearchParams(window.location.search);
			// var id=@json($sheet_code);
			var id=@json($sheet_code);

			/**********Sheet Head**************/
			$.ajax({
				url:"{{ url('goal_employee_summary_check') }}",
				type:"GET",
				data:{id:id},
				dataType : "JSON",
				success:function(response)
				{
					// alert(response)
					if(response == "2"){
						var params = new window.URLSearchParams(window.location.search);
						var id=@json($sheet_code);

						$.ajax({
							url:"fetch_goals_employee_summary",
							type:"GET",
							data:{id: id},
							dataType : "JSON",
							success:function(data)
							{
								// console.log(data)
								$('#goal_employee_summary_div_show').html(data);
							},
							error: function(response) {

								console.log(response);
								// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

							}

						});

						$('#employee_summary_get_div').css('display', 'block');

					}else if(response == "3"){

						var params = new window.URLSearchParams(window.location.search);
						var id=@json($sheet_code);

						$.ajax({
							url:"fetch_goals_employee_summary",
							type:"GET",
							data:{id: id},
							dataType : "JSON",
							success:function(data)
							{
								// console.log(data)
								$('#goal_employee_summary_show').html(data);
							},
							error: function(response) {

								console.log(response);
								// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

							}

						});

						$.ajax({
							url:"fetch_goals_supervisor_summary",
							type:"GET",
							data:{id: id},
							dataType : "JSON",
							success:function(data)
							{
								$('#goal_supervisor_summary_show').html(data);
							},
							error: function(response) {
								console.log(response);
							}

						});

						$('#employee_summary_get_show').css('display', 'block');
					}
				},
				error: function(error) {
					console.log(error);
				}

			});
		}

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
            });
        });

		$( document ).ready(function() {
			// goal_record();
			get_goal_setting_reviewer_tl();
			textarea_hide();

			$("#save_div").hide();
			$('#movementProcessDiv').hide();

			// $('#goals_record_tb').DataTable( {
			// 	"searching": false,
			// 	"paging": false,
			// 	"info": false,
			// 	"fixedColumns":   {
			// 			left: 6
			// 		}
			// 	// dom: 'Bfrtip',
			// 	// buttons: [
			// 	// 	'copyHtml5',
			// 	// 	'excelHtml5',
			// 	// 	'csvHtml5',
			// 	// 	'pdfHtml5'
			// 	// ]
			// } );

			$('#goals_record_tb').DataTable( {
				"searching": false,
				"paging": false,
				"info":     false,
				"fixedColumns":   {
						left: 6
				},
				// "autoWidth": false,
				// "columnDefs": [
				// 	{ "width": "10px", "targets": 0 },
				// 	{ "width": "40px", "targets": 1 },
				// 	{ "width": "200px", "targets": 2 },
				// 	{ "width": "200px", "targets": 3 },
				// 	{ "width": "200px", "targets": 4 },
				// 	{ "width": "30px", "targets": 5 },
				// 	{ "width": "200px", "targets": 6 },
				// 	{ "width": "30px", "targets": 7 }
				// ],
				// "aoColumns": [
				// 	{ "sWidth": "70%" },
				// 	{ "sWidth": "70%" },
				// 	{ "sWidth": "5%" },
				// ],


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
		// var id=params.get('id')
        var id=@json($sheet_code);

		$('#goals_setting_id').val(id);
		$("#goal_supervisor_sum_id").val(id);

		$("#supervisorSummaryForm").submit(function(e) {
			e.preventDefault();

			// $('button[type="submit"]').attr('disabled' , true);

			$.ajax({
				url:"goals_supervisor_summary",
				type:"POST",
				data:$('#supervisorSummaryForm').serialize(),
				dataType : "JSON",
				success:function(data)
				{
					Toastify({
						text: "Send Sucessfully..!",
						duration: 3000,
						close:true,
						backgroundColor: "#4fbe87",
					}).showToast();
					$('#employee_summary_get_div').css('display', 'none');
					goal_employee_summary_check();
					// location.reload();
					// window.location = "{{ url('goals')}}";
					// $("#goal_data").load("{{url('get_goal_list')}}");
				},
				error: function(response) {
					// alert(response.responseJSON.errors.business_name_option);
					// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

				}

			});

		});

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

		/********** Employee Sumbit **************/
		$.ajax({
			url:"{{ url('goals_sup_submit_status') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				if(response == "1"){
					// alert("1")
					$("#goal_sheet_submit").css("display","none");
					$("#goal_sheet_submit_no_tb").css("display","block");
					$("#goal_sheet_edit").css("display","block");
				}else if(response == "2"){
					// alert("2")
					$("#goal_sheet_edit").css("display","none");
					$("#goal_sheet_submit").css("display","none");
				}else{
					// alert("0")
					$("#goal_sheet_submit").css("display","none");
					$("#goal_sheet_edit").css("display","block");
				}
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
				// console.log();
				var test_string=response[0].supervisor_consolidated_rate
					$('#supervisor_consolidate_rate_show').append('');
					$('#supervisor_consolidate_rate_show').text(test_string);

					// $('#supervisor_consolidate_rate_show').html();
			},
			error: function(error) {
				console.log(error);

			}

		});

		//Rep.manager recom head
		$.ajax({
			url:"{{ url('goals_sup_pip_exit_select_op') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				// alert(response)
				$('#supervisor_pip_exit_show').append('');
				$('#supervisor_pip_exit_show').append(response);

			},
			error: function(error) {
				console.log(error);

			}

		});

		function textarea_hide(){
			$('.select_one').hide();
			$('.textarea_one').hide();
		}

		function tb_data(){

			$.ajax({
				url:"{{ url('fetch_goals_sup_details') }}",
				type:"GET",
				data:{id:id},
				dataType : "JSON",
				success:function(response)
				{
                    //  console.log(response)
					$('#goals_record_tb').DataTable().clear().destroy();
					$('#goals_record').empty();
					$('#goals_record').append(response.html);
                    $("#tb_status").val(response.t_value);
					$('#goals_record_tb').DataTable( {
						"searching": false,
						"paging": false,
						"info":     false,
						// "aoColumns": [
						// 	{ "sWidth": "25%" },
						// 	{ "sWidth": "70%" },
						// 	{ "sWidth": "5%" },
						// ],
						// "fixedColumns":   {
						// 		left: 6
						// },
						"autoWidth": false,
						"columnDefs": [
							{ "autoWidth": false, "width": "10px", "targets": 0 },
							{ "autoWidth": false, "width": "40px", "targets": 1 },
							{ "autoWidth": false, "width": "200px", "targets": 2 },
							{ "autoWidth": false, "width": "200px", "targets": 3 },
							{ "autoWidth": false, "width": "200px", "targets": 4 },
							{ "autoWidth": false, "width": "30px", "targets": 5 },
							{ "autoWidth": false, "width": "200px", "targets": 6 },
							{ "autoWidth": false, "width": "30px", "targets": 7 }
						]
						// dom: 'Bfrtip',
						// buttons: [
						// 	'copyHtml5',
						// 	'excelHtml5',
						// 	'csvHtml5',
						// 	'pdfHtml5'
						// ]
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
				$("#sup_update_table").hide();
				$("#goal_sheet_submit_no_tb").css("display","none");
				$("#goal_sheet_edit").css("display","none");
				$("#goal_sheet_submit").css("display","block");
				$("#save_div").show();
				var i=1;
				var defined_class1="sup_remark";
				var defined_class3="sup_rating_div_"+i;
				var defined_class2="sup_rating";
                var tb_value=$("#tb_status").val();
				$("#goals_record_tb tbody tr td."+defined_class1+"").each(
					function(index){
                        //    if(tb_value==1){
                        //            $('.p_tag_one').remove();
                        //            $('.textarea_one').show();
                        //    }
                        //    else{
                        //     $('.textarea_one').show();

                        //    }
                                        if($('.p_tag_one_'+i+'').text()!=""){
                                            $('.p_tag_one_'+i+'').remove();
                                            $('.textarea_one').show();
                                            }

                                            else{

                                            $('.textarea_one').show();

                                            }
                        //   console.log(index)
 						// console.log($(this).text())
						// if ($(this).text() != ""){

						// 	var text_data=$(this).text();
                        //     $(this).text("")
						// 	// $(".sup_remark_p_"+i+"").remove();
						// 	var tx = '<textarea id="sup_remark'+i+'" name="sup_remark_'+i+'[]" style="width:250px;" class="form-control">'+text_data+'</textarea>';
						// 		tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
						// 	$(this).append(tx);

						// 	// alert("one")
						// }
						// else{
						// 	var tx = '<textarea id="sup_remark'+i+'" name="sup_remark_'+i+'[]" style="width:200px;" class="form-control"></textarea>';
						// 		tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
						// 	$(this).append(tx);
						// 	// alert("two")
						// }
						i++;
					}
				);

				//supervisor rating
				var j = 1;

				$("#goals_record_tb tbody tr td."+defined_class2+"").each(
					function(index){
                        // if(tb_value==1){
                        //            $('.p_tag_two').remove();
                        //            $('.select_one').show();
                        //    }
                        //    else{
                        //     $('.select_one').show();

                        //    }

                        if($('.p_tag_two_'+j+'').text()!=""){
                                            $('.p_tag_two_'+j+'').remove();
                                            $('.select_one').show();
                                            }

                                            else{

                                            $('.select_one').show();

                                            }

						// console.log("data")
						// if ($(this).text() != ""){

						// 	var text_data=$(this).text();
                        //     $(this).text("");
						// 	// $(".sup_rating_p_"+j+"").remove();
						// 	$(this).append('<select class="form-control js-example-basic-single key_bus_drivers" name="sup_rating[]" id="sup_rating'+j+'">\
						// 					<option value="">Choose</option>\
						// 					<option value="EE" '+(text_data=="EE" ? "selected" : "")+'>EE</option>\
						// 					<option value="AE" '+(text_data=="AE" ? "selected" : "")+'>AE</option>\
						// 					<option value="ME" '+(text_data=="ME" ? "selected" : "")+'>ME</option>\
						// 					<option value="PE  '+(text_data=="PE" ? "selected" : "")+'>PE</option>\
						// 					<option value="ND" '+(text_data=="ND" ? "selected" : "")+'>ND</option>\
						// 					</select>\
						// 					<div class="text-danger sup_rating_'+j+'_error"></div>')
						// }
						// else{
						// 	var op = '<select class="js-example-basic-single" name="sup_rating[]" style="width:150px;"  id="sup_rating'+j+'">';
						// 		op += '<option value="" selected>...Select...</option>';
						// 		op += '<option value="EE">EE</option>';
						// 		op += '<option value="AE">AE</option>';
						// 		op += '<option value="ME">ME</option>';
						// 		op += '<option value="PE">PE</option>';
						// 		op += '<option value="ND">ND</option>';
						// 		op += '</select>';
						// 		op += '<div class="text-danger sup_rating_'+j+'_error"></div>';
						// 	// $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"></textarea>')
						// 	$(this).append(op);
						// 	// alert("two")
						// }
						// i++;
						j++;
					}
				);

				//supervisor consolidate rate
				$.ajax({
					url:"{{ url('goals_sup_consolidate_rate_head') }}",
					type:"GET",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						// alert("one");
						if(response != ""){
							$('#supervisor_consolidated_rate').val(response).change();
						}

					},
					error: function(error) {
						console.log(error);
					}

				});

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

				//movement process
				//Pip value
				$.ajax({
					url:"{{ url('fecth_goals_sup_movement_process') }}",
					type:"GET",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						if(response != ""){
							// alert("response")

							$('#supervisor_pip_exit').val(response).change();
						}else{
							// alert("1")

						}

					},
					error: function(error) {
						console.log(error);

					}

				});

			})
		})

		function supFormSave(){

			// var error='';

			$('#sup_save_table').attr('disabled' , true);
            $('#sup_save_table').html('Processing');

			// if($("#candicate_checkbox").is(':checked')){
				// alert("1")

			// 	//movement
			// 	var supervisor_movement = $("#supervisor_movement").val();
			// 	var $errmsg5 = $("#supervisor_movement_error");
			// 	$errmsg5.hide();

			// 	if(supervisor_movement == ""){
			// 		$errmsg5.html('Movement is required').show();
			// 		error+="error";
			// 	}

			// 	//with effect value
			// 	var pip = $("#with_effect_date").val();
			// 	var $errmsg6 = $("#with_effect_date_error");
			// 	$errmsg6.hide();

			// 	if(pip == ""){
			// 		$errmsg6.html('With effect value is required').show();
			// 		error+="error";
			// 	}

			// 	//Team name
			// 	var pip = $("#team_member_list").val();
			// 	var $errmsg4 = $("#team_member_list_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Team name is required').show();
			// 		error+="error";
			// 	}

			// 	//Superviosr name
			// 	var pip = $("#supervisor_name_list").val();
			// 	var $errmsg4 = $("#supervisor_name_list_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Supervisor name is required').show();
			// 		error+="error";
			// 	}

			// 	//reamrks
			// 	var pip = $("#movement_remark").val();
			// 	var $errmsg4 = $("#movement_remark_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Movement remark is required').show();
			// 		error+="error";
			// 	}

			// 	//Designation
			// 	var mov_designation  = $('input[name="mov_designation"]:checked').val();
			// 	var $errmsg4 = $("#mov_designation_error");
			// 	$errmsg4.hide();

			// 	if(mov_designation == "" || mov_designation == undefined){
			// 		$errmsg4.html('Designation is required').show();
			// 		error+="error";
			// 	}

			// 	//Promotiom
			// 	var mov_promotion  = $('input[name="mov_promotion"]:checked').val();
			// 	var $errmsg4 = $("#mov_promotion_error");
			// 	$errmsg4.hide();

			// 	if(mov_promotion == "" || mov_promotion == undefined){
			// 		$errmsg4.html('Promotion is required').show();
			// 		error+="error";
			// 	}

			// }
			// else{
			// 	// alert("2")
            //     $('#supervisor_movement').val("").change();
            //     $('#with_effect_date').val("");
            //     $('#team_member_list').val("").change();
            //     $('#supervisor_name_list').val("").change();
            //     $('#movement_remark').val("");
			// 	var mov_designation  = $('input[name="mov_designation"]:checked').val();
			// 	var mov_promotion  = $('input[name="mov_promotion"]:checked').val();
			// 	if(mov_designation != undefined){
			// 		$("input:radio[name=mov_designation]:checked")[0].checked = false;
			// 	}
			// 	if(mov_promotion != undefined){
			// 		$("input:radio[name=mov_promotion]:checked")[0].checked = false;
			// 	}

			// }

			// var rate = $("#supervisor_consolidated_rate").val();
			// var $errmsg3 = $(".supervisor_consolidated_rate_error");
			// $errmsg3.hide();

			// if(rate == ""){
			// 	$errmsg3.html('Consolidated rate is required').show();
			// 	error+="error";
			// }

			// var pip = $("#supervisor_pip_exit").val();
			// var $errmsg4 = $(".supervisor_pip_exit_error");
			// $errmsg4.hide();

			// if(pip == ""){
			// 	$errmsg4.html('Pip or not is required').show();
			// 	error+="error";
			// }

			// if($("#candicate_checkbox").is(':checked')){
			// 	// alert("1")

			// 	//movement
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//with effect value
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//Team name
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//Superviosr name
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//reamrks
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//Designation
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// 	//Promotiom
			// 	var pip = $("#supervisor_pip_exit").val();
			// 	var $errmsg4 = $(".supervisor_pip_exit_error");
			// 	$errmsg4.hide();

			// 	if(pip == ""){
			// 		$errmsg4.html('Pip or not is required').show();
			// 		error+="error";
			// 	}

			// }
			// else{
			// 	// alert("2")

			// }

			// var i=1;

            //     var defined_class1="sup_remark";
			// 	var defined_class3="sup_rating_div_"+i;
			// 	var defined_class2="sup_rating";

			// 	$("#goals_record_tb tbody tr td."+defined_class1+"").each(
			// 		function(index){
            //             var err_div_name = "#sup_remark_"+i+"_error";
            //             var $errmsg0 = $(err_div_name);
            //             $errmsg0.hide();
			// 			if ($("#sup_remark"+i+"").val() == "" || $("#sup_remark"+i+"").val() == undefined){
            //                 $errmsg0.html('Supervisor remarks is required').show();
            //                 error+="error";
			// 			}
			// 			i++;
			// 		}
			// 	);

			// 	//supervisor ratin
			// 	var j = 1;
			// 	$("#goals_record_tb tbody tr td."+defined_class2+"").each(
			// 		function(index){
            //             var err_div_name1 = ".sup_rating_"+j+"_error";
            //             var $errmsg1 = $(err_div_name1);
            //             $errmsg1.hide();
            //             var selected_opt=$("#sup_rating"+j+"").find(":selected").val();
			// 			if (selected_opt == "" || selected_opt== undefined){
            //                 $errmsg1.html('Supervisor Rating is required').show();
            //                 error+="error";
			// 			}
			// 			j++;
			// 		}
			// 	);


















			// $('#goals_record_tb > tbody  > tr').each(function(index) {

			// 	var col0=$(this).find("td:eq(0)").text();
			// 	// var col6=$(this).find("td:eq(2) textarea").val();
			// 	var col6=$(this).find("td:eq(3)").text();
			// 	var col7=$(this).find("td:eq(6) option:selected").val();


            //     console.log(col6)

			// 	// Supervisor Remarks
            //     var err_div_name = "#sup_remark_"+index+"_error";
            //     var $errmsg0 = $(err_div_name);

			// 	if(col6 == "" || col6 == undefined){
			// 		// console.log("one")
			// 		$errmsg0.html('Supervisor remarks is required').show();
			// 		error+="error";
			// 	}
            //     else{
            //         $errmsg0.hide();
            //     }


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
			// 	// alert("succes")
				data_insert();
			// }

			function data_insert(){
                // alert("2")
            //    alert($("#sup_remark1").val())
				$.ajax({
					url:"{{ url('update_goals_sup') }}",
					type:"POST",
					data:$('#supGoalsForm').serialize(),
					dataType : "JSON",
					success:function(data)
					{
                        //  console.log(data)
						Toastify({
							text: "Added Sucessfully..!",
							duration: 3000,
							close:true,
							backgroundColor: "#4fbe87",
						}).showToast();

						$('#sup_save_table').attr('disabled' , false);
            			$('#sup_save_table').html('Save As Draft');

                        window.location.reload();

						// $("#save_div").hide();
						// $("#sup_save_table").css("display","none");
						// $("#goal_sheet_submit").css("display","block");
						// $("#sup_update_table").show();

						// $('button[type="submit"]').attr('disabled' , false);

						// window.location = "{{ url('goals')}}";

						// $('button[type="submit"]').attr('disabled' , false);

						// window.location = "{{ url('goals')}}";
					},
					error: function(response) {
						// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

					}

				});
			}
		}

		function supFormSubmit(){

			var error='';

			$('#goal_sheet_submit').attr('disabled' , true);
			$('#goal_sheet_submit').html('Processing');

			if($("#candicate_checkbox").is(':checked')){
				// alert("1")

				//movement
				var supervisor_movement = $("#supervisor_movement").val();
				var $errmsg5 = $("#supervisor_movement_error");
				$errmsg5.hide();

				if(supervisor_movement == ""){
					$errmsg5.html('Movement is required').show();
					error+="error";
				}

				//with effect value
				var pip = $("#with_effect_date").val();
				var $errmsg6 = $("#with_effect_date_error");
				$errmsg6.hide();

				if(pip == ""){
					$errmsg6.html('With effect value is required').show();
					error+="error";
				}

				//Team name
				var pip = $("#team_member_list").val();
				var $errmsg4 = $("#team_member_list_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Team name is required').show();
					error+="error";
				}

				//Superviosr name
				var pip = $("#supervisor_name_list").val();
				var $errmsg4 = $("#supervisor_name_list_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Supervisor name is required').show();
					error+="error";
				}

				//reamrks
				var pip = $("#movement_remark").val();
				var $errmsg4 = $("#movement_remark_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Movement remark is required').show();
					error+="error";
				}

				//Designation
				var mov_designation  = $('input[name="mov_designation"]:checked').val();
				var $errmsg4 = $("#mov_designation_error");
				$errmsg4.hide();

				if(mov_designation == "" || mov_designation == undefined){
					$errmsg4.html('Designation is required').show();
					error+="error";
				}

				//Promotiom
				var mov_promotion  = $('input[name="mov_promotion"]:checked').val();
				var $errmsg4 = $("#mov_promotion_error");
				$errmsg4.hide();

				if(mov_promotion == "" || mov_promotion == undefined){
					$errmsg4.html('Promotion is required').show();
					error+="error";
				}

			}
			else{
				// alert("2")
                $('#supervisor_movement').val("").change();
                $('#with_effect_date').val("");
                $('#team_member_list').val("").change();
                $('#supervisor_name_list').val("").change();
                $('#movement_remark').val("");
				var mov_designation  = $('input[name="mov_designation"]:checked').val();
				var mov_promotion  = $('input[name="mov_promotion"]:checked').val();
				if(mov_designation != undefined){
					$("input:radio[name=mov_designation]:checked")[0].checked = false;
				}
				if(mov_promotion != undefined){
					$("input:radio[name=mov_promotion]:checked")[0].checked = false;
				}

			}

			var rate = $("#supervisor_consolidated_rate").val();
			var $errmsg3 = $(".supervisor_consolidated_rate_error");
			$errmsg3.hide();

			if(rate == ""){
				$errmsg3.html('Consolidated rate is required').show();
				error+="error";
			}

			var pip = $("#supervisor_pip_exit").val();
			var $errmsg4 = $(".supervisor_pip_exit_error");
			$errmsg4.hide();

			if(pip == ""){
				$errmsg4.html('Pip or not is required').show();
				error+="error";
			}

			if($("#candicate_checkbox").is(':checked')){
				// alert("1")

				//movement
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//with effect value
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//Team name
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//Superviosr name
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//reamrks
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//Designation
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Pip or not is required').show();
					error+="error";
				}

				//Promotiom
				var pip = $("#supervisor_pip_exit").val();
				var $errmsg4 = $(".supervisor_pip_exit_error");
				$errmsg4.hide();

				if(pip == ""){
					$errmsg4.html('Rep.Manger recommendation is required').show();
					error+="error";
				}

			}
			else{
				// alert("2")

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
                        $errmsg0.html('Rep.Manager remarks is required').show();
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
                        $errmsg1.html('Rating is required').show();
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
					url:"{{ url('update_goals_sup_submit') }}",
					type:"POST",
					data:$('#supGoalsForm').serialize(),
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

						// $('button[type="submit"]').attr('disabled' , false);

						// window.location = "{{ url('goals')}}";

						// $('button[type="submit"]').attr('disabled' , false);

						$('#goal_sheet_submit').attr('disabled' , false);
						$('#goal_sheet_submit').html('Submit');

						window.location = "{{ url('goals')}}";
					},
					error: function(response) {
						// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

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

					// tb_data();
					// $("#save_div").hide();
					// $("#goal_sheet_edit").css("display","block");

					// $('button[type="submit"]').attr('disabled' , false);

					// window.location = "{{ url('goals')}}";

					// $('button[type="submit"]').attr('disabled' , false);

					window.location = "{{ url('goals')}}";
				},
				error: function(response) {
					// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

				}

			});
		}

		//Edit pop-up model and data show
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

		$('#candicate_checkbox').change(function () {
			if($(this).is(':checked')){
				$('#movementProcessDiv').show();
			}
			else{
				$('#movementProcessDiv').hide();
			}
		});

	</script>

@endsection

