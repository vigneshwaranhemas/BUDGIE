{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': ( Auth::user()->role_type === 'HR Ops'? 'layouts.simple.hr_master': '' ) ) ) ) ) ) )
@section('title', 'Goals')
<link rel="stylesheet" type="text/css" href="../assets/css/scrollable.css">
@section('style')
<style>

</style>
@endsection

@section('breadcrumb-title')
	<h2>Assessment<span>Report</span></h2>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
	<div class="row">
        <div class="col-sm-12 col-xl-6 box-col-12 xl-100">
			<div class="card">
				<div class="card-body chart-block p-0">
					<div class="row p-30">
                        <div class="col-lg-2">
							<b><label for="yr">Select Department</label></b>
							<select class="form-control" id="pms_pie_dept_filter" name="year">
								<option value="">...Select Department...</option>
								@foreach($dept_lists as $dept_list)
								<option value="{{ $dept_list->department }}">{{ $dept_list->department }}</option>
								@endforeach
							</select>
						</div>
                        <div class="col-lg-4" style="margin-top: 31px;">
							<button type="button" id="reset" onclick="rating_filter_clear();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Self Assessment Status</h5>
				</div>
				<div class="card-body chart-block p-0">
					<div class="chart-overflow" id="pie-chart3"></div>
				</div>
			</div>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Reporting Manager Status</h5>
				</div>
				<div class="card-body chart-block p-0">
					<div class="chart-overflow" id="pie-chart4"></div>
				</div>
			</div>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Reviewer Status</h5>
				</div>
				<div class="card-body chart-block p-0">
					<div class="chart-overflow" id="pie-chart5"></div>
				</div>
			</div>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>HR Status</h5>
				</div>
				<div class="card-body chart-block p-0">
					<div class="chart-overflow" id="pie-chart6"></div>
				</div>
			</div>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Bussiness Head Status</h5>
				</div>
				<div class="card-body chart-block p-0">
					<div class="chart-overflow" id="pie-chart7"></div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<!-- Plugins JS start-->
<script src="../assets/js/chart/google/google-chart-loader.js"></script>
<script src="../assets/pro_js/assessment_report.js"></script>
@endsection
