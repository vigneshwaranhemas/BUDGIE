@extends('layouts.simple.candidate_master')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
@endsection

@section('style')
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
										<p id="empID" class="f-w-700"style="font-size: 16px;"><b>{{ Auth::user()->empID }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i> Rep.Manager ID :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="sup_emp_code" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->sup_emp_code }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i>  Reviewer ID :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="reviewer_emp_code" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->reviewer_emp_code }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-id-card"> </i>  HRBP ID :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="f-w-700" style="font-size: 16px;"><b>900380</b></p>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row" style="margin-left: -102px;">
									<div class="col-md-6">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Apprentice Name :</p>
									</div>
									<div class="col-md-6">
										<p id="username" class="f-w-700"  style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->username }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Rep.Manager Name :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="sup_name" class="f-w-700"  style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->sup_name }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" class="f-w-700" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> Reviewer Name :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="reviewer_name" class="f-w-700"  style="text-transform: uppercase;font-size: 16px;"><b>{{ Auth::user()->reviewer_name }}</b></p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-user-alt-7"> </i> HRBP :</p>
									</div>
									<div class="col-md-6 m-t-10">
										<p class="f-w-700"  style="text-transform: uppercase;font-size: 16px;"><b>Rajesh M S</b></p>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-7">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Apprentice Dept:</p>
									</div>
									<div class="col-md-5">
										<p id="department" class="f-w-700" style="font-size: 16px;"><b>{{ Auth::user()->department }}</b></p>
									</div>
									<div class="col-md-7 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Rep.Manager Dept :</p>
									</div>
									<div class="col-md-5 m-t-10">
										<p id="sup_dept" class="f-w-700" style="font-size: 16px;"></p>
									</div>
									<div class="col-md-7 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> Reviewer Dept :</p>
									</div>
									<div class="col-md-5 m-t-10">
										<p id="rev_dept" class="f-w-700" style="font-size: 16px;"></p>
									</div>
									<div class="col-md-7 m-t-10">
										<p class="mb-0 f-w-600" style="font-size: 16px;"><i class="icofont icofont-building"> </i> HRBP Dept :</p>
									</div>
									<div class="col-md-5 m-t-10">
										<p class="f-w-700" style="font-size: 16px;"><b>HR</b></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" id="goals_setting_id">
				<div class="card  card-absolute">				
					<div class="card-header  bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<div class="row">
								<div class="col-lg-12 m-b-35">
									<h5>CONSOLIDATED SELF RATING : <span id="employee_consolidate_rate_show"></span></h5>
								</div>
							</div>
							<table class="table table-border-vertical table-border-horizontal" id="goals_record_tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers (KBD)</th>
										<th scope="col">Key Outcome Areas (KOA) </th>
										<th scope="col">Measurement Criteria (Quantified Measures)</th>
										<th scope="col">Self Assessment (Qualitative Remarks) by Apprentice</th>
										<th scope="col">Self Rating</th>
									</tr>
								</thead>
								<tbody id="goals_record">									
								</tbody>
							</table>
						</div>
						<div id="employee_summary_get_div" style="display:none">
                			<form  id="employeeSummaryForm">
								<div class="row">
									<div class="col-lg-12">
										<h5><b>Summary</b></h5>
									</div>
									<div class="col-lg-4">
										<textarea name="employee_summary" id="employee_summary" class="form-control m-t-5" style="height: 100px;"></textarea>
										<input type="hidden" name="id" id="goal_sheet_id" class="form-control">
										<button class="btn btn-primary float-right m-t-10" type="submit">Save</button>
									</div>
									<div class="col-lg-8">
									</div>
								</div>
							</form>
						</div>
						<div id="employee_summary_get_show" style="display:none">
							<div class="row m-t-20 m-b-10">
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
			get_tb_record();
			$('#goals_record_tb').DataTable( {
				// "searching": false,
				// "paging": false,
				// "info":     false,
				// "fixedColumns":   {
				// 		left: 6
				// 	},
				bDestroy: true,
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5'
				]
			} );
			login_user_details();
			goal_employee_summary_check();
			goal_employee_summary_show();
		});

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
							// $('#sup_dept').html(data[0].department);                    
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
						// $('#rev_dept').html(data[0].department);                    
					}
				}
			});

		}

		function goal_employee_summary_check(){
			var params = new window.URLSearchParams(window.location.search);
			// var id=params.get('id');
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
					if(response == "1"){
						$('#goal_sheet_id').val(id);
						$('#employee_summary_get_div').css('display', 'block');
					}else if(response == "2"){
						var params = new window.URLSearchParams(window.location.search);
						// var id=params.get('id');
						var id=@json($sheet_code);

						//sup remark
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
						//sup remark
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

		
		$("#employeeSummaryForm").submit(function(e) {
			e.preventDefault();

			// $('button[type="submit"]').attr('disabled' , true);

			$.ajax({                   
				url:"goals_employee_summary",
				type:"POST",
				data:$('#employeeSummaryForm').serialize(),
				dataType : "JSON",
				success:function(data)
				{
					Toastify({
						text: "Send Sucessfully..!",
						duration: 3000,
						close:true,
						backgroundColor: "#4fbe87",
					}).showToast();    
					
					// $('button[type="submit"]').attr('disabled' , false);
					$('#employeeSummaryModal').modal('hide');
					// goal_record();
					window.location.reload();
					// window.location = "{{ url('goals')}}";                
					// $("#goal_data").load("{{url('get_goal_list')}}");               
				},
				error: function(response) {
					// alert(response.responseJSON.errors.business_name_option);
					// $('#business_name_option_error').text(response.responseJSON.errors.business_name);
				}                                              
					
			});

		});

		function goal_employee_summary_show(){
			var params = new window.URLSearchParams(window.location.search);
			// var id=params.get('id');
			var id=@json($sheet_code);

			/**********Sheet Head**************/			
			$.ajax({                   
				url:"{{ url('goals_sheet_head') }}",
				type:"GET",
				data:{id:id},
				dataType : "JSON",
				success:function(response)
				{
					$('#goals_sheet_head').append('');
					// $('#goals_sheet_head').append(response);
				},
				error: function(error) {
					console.log(error);

				}                                              
					
			});
		}

		var params = new window.URLSearchParams(window.location.search);
		// var id=params.get('id')
        var id=@json($sheet_code);

		$('#goals_setting_id').val(id);
		// function goals_record(){
			
			var id = $('#goals_setting_id').val();

			/**********Sheet Head**************/			
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

			/**********Consolidary rate Head**************/			
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

			function get_tb_record(){
				$.ajax({                   
					url:"{{ url('fetch_goals_setting_id_details') }}",
					type:"GET",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						// $('#goals_record_tb tbody').empty();

						// $("#goals_record_tb  tbody").remove();

						$('#goals_record_tb').DataTable().clear().destroy();
						// $('#goals_record_tb').empty();
						// $('#goals_record').empty();

						
						// $("#goals_record_tb > tbody").html("");

						$('#goals_record').append(response);
						// table_rec.ajax.reload();
						// $('#goals_record_tb').DataTable().ajax.reload();

						$('#goals_record_tb').DataTable( {
							// "searching": false,
							// "paging": false,
							// "info":     false,
							// "fixedColumns":   {
							// 		left: 6
							// 	},
							bDestroy: true,
							dom: 'Bfrtip',
							buttons: [
								'copyHtml5',
								'excelHtml5',
								'csvHtml5',
								'pdfHtml5'
							]
						} );

						
					},
					error: function(error) {
						console.log(error);

					}                                              
						
				});
			}
			
		// }

		/**********Data Table**************/

		// for export all data
		function newexportaction(e, dt, button, config) {
			var self = this;
			var oldStart = dt.settings()[0]._iDisplayStart;
			dt.one('preXhr', function (e, s, data) {
				// Just this once, load all data from the server...
				data.start = 0;
				data.length = 2147483647;
				dt.one('preDraw', function (e, settings) {
					// Call the original action function
					if (button[0].className.indexOf('buttons-copy') >= 0) {
						$.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
					} else if (button[0].className.indexOf('buttons-excel') >= 0) {
						$.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
							$.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
							$.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
					} else if (button[0].className.indexOf('buttons-csv') >= 0) {
						$.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
							$.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
							$.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
					} else if (button[0].className.indexOf('buttons-pdf') >= 0) {
						$.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
							$.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
							$.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
					} else if (button[0].className.indexOf('buttons-print') >= 0) {
						$.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
					}
					dt.one('preXhr', function (e, s, data) {
						// DataTables thinks the first item displayed is index 0, but we're not drawing that.
						// Set the property to what it was before exporting.
						settings._iDisplayStart = oldStart;
						data.start = oldStart;
					});
					// Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
					setTimeout(dt.ajax.reload, 0);
					// Prevent rendering of the full data to the DOM
					return false;
				});
			});
			// Requery the server with the new one-time export settings
			dt.ajax.reload();
		}

	</script>

@endsection

