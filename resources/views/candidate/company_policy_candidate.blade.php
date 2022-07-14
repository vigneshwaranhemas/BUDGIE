@extends('layouts.simple.candidate_master')
@section('title', 'Company Policy')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
@endsection

@section('style')
<style>

    .card-header
    {
        background-color: rgba(0,0,0,0.03) !important;
        padding: 28px !important;
    }
    .card .card-header .card-header-right
    {
        top: 19px !important;
    }
    .card .card-body
    {
        padding: 28px !important;
    }
    .list-group-items
    {
        border: 1px solid rgba(0,0,0,0.125);
        cursor: pointer;
    }
    .top-left
    {
        margin-left: 45px;
        margin-top: 9px;
    }
    .last-update
    {
        margin-left: 45px;
    }
    .last-right
    {
        margin-top: 9px;
    }

    /* arrow css */
    .arrow {
        position: absolute;
        top: 28px;
        left: 26px;
    }

    .arrow::before,
    .arrow::after {
    position: relative;
    content: '';
    display: block;
    width: 10px;
    height: 1px;
    background: black;
    transition: 0.3s ease-in-out;
    }

    .arrow::before {
    transform: rotate(45deg);
    }

    .arrow::after {
    left: 6px;
    top: -1px;
    transform: rotate(-45deg);
    }

    .list-group-items.active .arrow::before {
    transform: rotate(-45deg);
    }

    .list-group-items.active .arrow::after {
    transform: rotate(45deg);
    }

</style>
@endsection

@section('breadcrumb-title')
	<h2>Company Policy<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
               <div class="card-header">
                  <h5>Document Center / Company Policy</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="list-group" id="small" role="tablist">

                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="tab-content" id="nav-tabContent">

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
</div>


@endsection

@section('script')
<script src="../assets/pro_js/company_policy_candidate.js"></script>

<script>

var get_policy_category_candidate_details_link = "{{url('get_policy_category_candidate_details')}}";
var get_policy_information_candidate_details_link = "{{url('get_policy_information_candidate_details')}}";

$('.list-group-items').on('click', function() {
  $(this).toggleClass('active')
});

</script>
@endsection
