@extends('layouts.simple.candidate_master')
@section('title', 'Candidate List')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>Candidate List</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Candidate List</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>EMPLOYEE ID</th>
                              <th>NAME</th>
                              <th>EMAIL</th>
                              <th>MOBILE NUMBER</th>
                              <th>GENDER</th>
                              <th>MARITAL STATUS</th>
                              <th>ACTION</th>

                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>CD1</td>
                              <td>Kandan</td>
                              <td>kandan@example.com</td>
                              <td>9898989898</td>
                              <td>Male</td>
                              <td>Single</p></td>
                              <td>
                                <div class="btn-group dropdown m-r-10">
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                                   <ul role="menu" class="dropdown-menu pull-right">
                                       <li><a href="../Hrss_profile"><i class="icon-settings"></i> Profile</a></li>
                                       <li><a href="javascript:;" data-group-id="1" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete </a></li>

                                   </ul>
                               </div>

                              </td>

                           </tr>
                           <tr>
                                <td>2</td>
                                <td>CD3</td>
                                <td>Shradha</td>
                                <td>Shradha@example.com</td>
                                <td>9898989898</td>
                                <td>Female</td>
                                <td>Single</td>
                                <td>
                                    <div class="btn-group dropdown m-r-10">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                                       <ul role="menu" class="dropdown-menu pull-right">
                                           <li><a href="../Hrss_profile"><i class="icon-settings"></i> Profile</a></li>
                                           <li><a href="javascript:;" data-group-id="1" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete </a></li>

                                       </ul>
                                   </div>

                                  </td>

                           </tr>
                           <tr>
                                <td>1</td>
                                <td>CD2</td>
                                <td>Bineta</td>
                                <td>Bineta@example.com</td>
                                <td>9898989898</td>
                                <td>Female</td>
                                <td>Single</td>
                                <td>
                                    <div class="btn-group dropdown m-r-10">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                                       <ul role="menu" class="dropdown-menu pull-right">
                                           <li><a href="../Hrss_profile"><i class="icon-settings"></i>Profile</a></li>
                                           <li><a href="javascript:;" data-group-id="1" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Delete </a></li>

                                       </ul>
                                   </div>

                                  </td>

                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>
@endsection
@section('script')

@endsection
