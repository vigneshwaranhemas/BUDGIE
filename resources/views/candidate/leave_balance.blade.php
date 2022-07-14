@extends('layouts.simple.candidate_master')
@section('title', 'Leave Balance')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
.card .card-header
{
    border-bottom: 0px solid #f2f4ff;
}
.leave-balance-header
{
    display: flex;
    flex-direction: row;
    justify-content: right;
    align-items: center;
}

</style>
@endsection

@section('breadcrumb-title')
	<h2>Leave Balance<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">

    <div class="col-md-12 leave-balance-header" style="margin-bottom: 25px;">
        <button class="btn btn-secondary" type="button" style="margin-right: 12px;">Apply</button>
        <button class="btn btn-info" type="button" style="margin-right: 12px;"><i class="fa fa-download" aria-hidden="true"></i></button>
        <select class="col-md-1 form-control" name="years" id="years">
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2020">2019</option>
        </select>
    </div>
    <div class="row">

        <div class="col-sm-8 col-xl-4" id="loss_of_pay" style="display: none">
            <div class="card">
               <div class="card-header">
                  <h5>Loss Of Pay</h5>
                  <div class="card-header-right">
                     <span>Granted: <span id="lop_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="lop_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="on_duty" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>On Duty</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="on_duty_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="on_duty_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="probationary_leave" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>Probationary Leave</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="prob_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="prob_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="work_from_home" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>Work From Home</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="wfh_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="wfh_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="privilege_leave" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>Privilege Leave</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="privilege_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="privilege_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="sick_leave" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>Sick Leave</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="sick_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="sick_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4" id="casual_leave" style="display: none">
            <div class="card ">
               <div class="card-header">
                  <h5>Casual Leave</h5>
                  <div class="card-header-right">
                    <span>Granted: <span id="casual_granted"></span></span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5 id="casual_balance"></h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>


    </div>
</div>


@endsection

@section('script')

<script src="../assets/pro_js/leave_balance.js"></script>

<script>
var get_leave_masters_details_link = "{{url('get_leave_masters_details')}}";
</script>
@endsection
