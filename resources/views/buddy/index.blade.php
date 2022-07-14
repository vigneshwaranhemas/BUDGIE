@extends('layouts.simple.candidate_master')

@section('css')
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/rating.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
@endsection

@section('style')
<style>
    .modal
    {
        padding-right: 59% !important;
    }
    .table thead th
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
        width: 1px;
    }
    .table tr
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
    }
    .table td
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
    }
    .word-warpped
    {
        word-break: break-word;
        max-width: 160px;
        min-width: 160px;
        /* max-width: 160px; */
        min-width: 356px;
    }
    .remark
    {
        min-width: 286px;

    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Buddy</h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
 <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="row">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                <div class="dt-ext table-responsive">
                    <table class="display" id="Buddy_info_table">
                    <thead>
                        <tr>
                        <th>EmployeeId</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>FeedBack</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($candidate_info)>0)
                        @foreach ($candidate_info as $item)
                        <tr>
                            <td>{{$item->empID }}</td>
                            <td>{{$item->username }}</td>
                            <td>{{$item->email }}</td>
                            <td>{{$item->contact_no }}</td>
                            <td>
                                <button onclick=showAdd("{{$item->empID}}") aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                     @endforeach
            @else
                   <tr><td>No Data Available</td></tr>;
            @endif

                    </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<div class="modal fade" id="edit-column-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 261%;">
            <div class="modal-body">
                <table class="table table-custom dtable-striped table-bordered" style="width: -webkit-fill-available;">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">No</th>
                            <th scope="col" rowspan="2">Question / Query</th>
                            <th scope="col" colspan="6" class="text-center">Response</th>
                        </tr>
                        <tr>
                            <th scope="col">STRONGLY DISAGREE</th>
                            <th scope="col">DISAGREE</th>
                            <th scope="col">NEITEHR AGREE NOR DISAGREE</th>
                            <th scope="col">AGREE</th>
                            <th scope="col">STRONGLY AGREE</th>
                            <th scope="col">Remarks</th>
                        </tr>
                        </thead>

                    <tbody id="buddy_feedback_tableId">
                        <tr>
                        <th scope="row">1</th>
                        <td><p class="word-warpped">My Buddy interacted with me pleasantly during the welcome session which helped me be comfortable and  bond well</p> </td>

                        <td>
                            <div class="text-center">
                                <p style="color:green" class="fa fa-check"></p>
                            </div>
                        </td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="remark">none</td>


                        </tr>

                    </tbody>
                </table>


                <div class="modal-body" id="textarea_div">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid Ends-->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../pro_js/buddy/buddy.js"></script>
@section('script')
    <!-- latest jquery-->
@endsection

