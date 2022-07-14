@extends('layouts.simple.candidate_master')
@section('title', 'Documents')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

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
	<h2>Documents<span> </span></h2>
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
                  <h5>Document Center / Documents</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                    <div class="text-center" style="margin-left: auto; margin-right: auto;">
                        <img class="rounded mx-auto d-block" src="../assets/images/docs-empty-state.svg" alt="sample_img" style="width: 274px;margin-top: 28px;margin-bottom: 20px;">
                    </div>
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>


@endsection

@section('script')

<script>

$('.list-group-items').on('click', function() {
  $(this).toggleClass('active')
});

</script>
@endsection
