<?php
$sess_info=Session::get("session_info");

// echo json_encode($info->empID);die();


?>
@extends('layouts.simple.candidate_master')
@section('title', 'Buddy Feedback')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/prism.css')}}">
    <!-- Plugins css start-->
@endsection

@section('style')
<style>
.table th
{
    width:1px;
}
.table th
{
    border: 1px solid #dee2e6;
}
.table td
{
    border: 1px solid #dee2e6;
}
.buddy_list
{
    padding-bottom: 50px;
}
</style>
@endsection
@section('breadcrumb-title')
	<h2>Buddy<span>Info</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Buddy  Info</li>
@endsection

@section('content')


<div class="col-sm-12">
    <!-- profile -->
    <div class="tab-content" id="v-pills-tabContent">
       <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

          <div class="container-fluid">
             <div class="row">
                <div class="col-sm-12 col-xl-12">
                   <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                      <div class="card-body rounded">
                         <div class="row">
                            <div class="col-md-6">
                               <div> <strong>EmployeeID : </strong> {{$info->empID}}</div><hr>
                               <div> <strong>Name : </strong>{{$info->username}}</div><hr>
                            </div>
                            <div class="col-md-6">
                               <div> <strong>Email : </strong>{{$info->email}}</div><hr>
                               <div> <strong>Mobile Number : </strong> {{$info->contact_no}}
                               </div><hr>
                               {{-- <div> <strong>Date of Birth :</strong> 11-05-1994
                               </div><hr>
                               <div> <strong>Roll of Intake : </strong>  HEPL
                               </div><hr> --}}
                            </div>
                         </div>

                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

    </div>
 </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
