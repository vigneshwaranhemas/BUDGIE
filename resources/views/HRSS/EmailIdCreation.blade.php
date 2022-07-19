@extends('layouts.simple.candidate_master')
@section('title', 'EmailId Creation')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">


@endsection

@section('style')

<style>
    .tdtextwidth{
        width: 163px;
    }
    .bg-warning
    {
        background-color: #7e37d8 !important;
    }
    </style>
@endsection

@section('breadcrumb-title')
	<h2><span>EmailId Creation</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">EmailId Creation</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                   <div class="text-right">
                        <button type="button" style="margin-bottom:13px;" class="btn btn-pill btn-primary"  id="EmailCreationBtn">Submit</button>
                    </div>

                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>S.No</th>
                              <th>#</th>
                              <th>Employee ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>HR Suggested Email</th>
                              <th>Asset Type</th>
                           </tr>
                        </thead>
                        <tbody id="emailIdCreation">
                        </tbody>
                     </table>
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                     {{-- <button type="button" id="AdminUpdateBtn"><button> --}}
                  </div>
               </div>
            </div>
         </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var email_url="Candidate_Email_Creation";
    var status_update_url="Candidate_Email_Status_update";
</script>
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>
<script src="../pro_js/HRSS/CandidateEmailCreation.js"></script>

@endsection

  
