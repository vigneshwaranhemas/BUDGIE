@extends('layouts.simple.candidate_master')
@section('title', 'Document Center')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .card-body p{
        margin-bottom: 3% !important;
        font-size: 15px !important;
    }
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
    }
    .card-body h5{
        margin-bottom: 3% !important;
    }

    /* input field css start*/
    .input {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 200px;
    color: #008CBA;
    }

    input::-webkit-input-placeholder {
    color: #aaa;
    }

    input:focus::-webkit-input-placeholder {
    color: dodgerblue;
    }

    .input:focus + .underline {
    transform: scale(1);
    }
    /* input field css end*/

    .table td
    {
        border-top: none !important;
    }

    .editor
    {
        margin-left: -49px;
        margin-top: -58px;
    }

    .interesting_facts
    {
        width: 70%;
    }
    .text-warning
    {
        color: #ff0000!important;
    }
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


</style>
@endsection

@section('breadcrumb-title')
	<h2>Document Center<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <h2>Documents</h2>
    <div class="row">
        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Documents</h5>
                    <div class="card-header-right">
                        <i class="fa fa-file"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('payslip') }}"><button class="btn btn-primary" type="button">View All</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Payslips</h5>
                    <div class="card-header-right">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('payslip') }}"><button class="btn btn-primary" type="button">View All</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Form 16</h5>
                    <div class="card-header-right">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('payslip') }}"><button class="btn btn-primary" type="button">View All</button></a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Company Policies</h5>
                    <div class="card-header-right">
                        <i class="fa fa-clipboard"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('company_policy_candidate') }}"><button class="btn btn-primary" type="button">View All</button></a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Forms</h5>
                    <div class="card-header-right">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('payslip') }}"><button class="btn btn-primary" type="button">View All</button></a>

                    </div>

                </div>
            </div>
        </div>


    </div>
    <h2>Request</h2>
    <div class="row">
        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Letters</h5>
                    <div class="card-header-right">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <p> Pending: 0</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p> Closed: 0</p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="{{ url('welcome_aboard') }}"><button class="btn btn-primary" type="button">View All</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('script')

<script src="../assets/pro_js/view_welcome_aboard.js"></script>

<script>
var add_welcome_aboard_process_link = "{{url('add_welcome_aboard_process')}}";
var get_welcome_aboard_details_link = "{{url('get_welcome_aboard_details')}}";
</script>
@endsection
