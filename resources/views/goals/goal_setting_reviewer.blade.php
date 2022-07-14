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
	<h2>View<span>Goals </span></h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
@endsection

@section('content')
	<!-- Container-fluid starts-->
    <div class="container-fluid">
		<div class="row">

			<div class="col-sm-12">

				<input type="hidden" id="goals_setting_id">

				<div class="card  card-absolute">
					
					<div class="card-header  bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">

						<div class="table-responsive m-b-15 ">
							<table class="table  table-border-vertical table-border-horizontal" id="goal-tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers</th>
										<th scope="col">Key Result Areas </th>
										<th scope="col">Sub Indicators</th>
										<th scope="col">Measurement Criteria (UOM)</th>
										<th scope="col">Self Weightage</th>
										<th scope="col">Reference </th>
										<th scope="col">Supervisor Weightage </th>
									</tr>
								</thead>
								<tbody id="goals_record">
									
								</tbody>
							</table>
							<div class="m-t-40 m-b-30">
								<label>Goal Status</label><br>
								<select class="js-example-basic-single" style="width:250px;margin-top:30px !important;" id="goals_status" name="goals_status">
									<option value="" selected disabled>...Select...</option>
									<option value="Approved">Approved</option>
									<option value="Revert">Revert</option>
								</select>
								<button onclick="goals_status();" class="btn btn-primary m-t-0 m-l-5"><i class="ti-save"></i> Save</button>                                            

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
		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id')
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

		$.ajax({                   
			url:"{{ url('fetch_goals_setting_id_details') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				$('#goals_record').append('');
				$('#goals_record').append(response);
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});
		
		$('#goals_status').change(function() {
			var goals_status = $('#goals_status').val();
			var params = new window.URLSearchParams(window.location.search);
			var id=params.get('id')

			$.ajax({                   
				url:"{{ url('goals_status') }}",
				type:"POST",
				data:{
					goals_status:goals_status,
					id:id
				},
				dataType : "JSON",
				success:function(response)
				{
					window.location = "{{ url('goals')}}";                				
				},
				error: function(error) {
					console.log(error);

				}                                              
					
			});
		});

		function goals_status(){
			alert("hi")
		}
	</script>

@endsection

