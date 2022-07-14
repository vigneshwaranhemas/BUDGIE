@extends('layouts.simple.candidate_master')
@section('title', 'Pre OnBoarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>Pre OnBoarding </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Pre OnBoarding</li>

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
                              <th>Employee Id</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile Number</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @if (count($info['user_info']) > 0)
                            <?php $i=0;?>
                             @foreach ($info['user_info'] as $item)
                                   @if ($item->email==="")
                                     <?php
                                        $email="--";
                                       ?>
                                   @else
                                   <?php
                                        $email=$item->email;
                                      ?>
                                   @endif
                                  @if ($item->contact_no=="")
                                      <?php
                                      $mobile="--";
                                      ?>
                                  @else
                                       <?php
                                       $mobile=$item->contact_no;
                                       ?>
                                  @endif
                           <tr>
                              <td>{{$i+1}}</td>
                              <td>{{$item->empID}}</td>
                              <td>{{$item->username}}</td>
                              <td>{{$email}}</td>
                              <td>{{$mobile}}</td>
                              <td>
                                <button onclick=viewBuddyModel("{{$item->empID}}")  aria-expanded="false"  class="btn btn-default waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                           </tr>
                           <?php $i++;?>
                           @endforeach
                     @else

                     @endif
                           {{-- </tr>
                           <tr>
                                <td>2</td>
                                <td>CD3</td>
                                <td>Shradha</td>
                                <td>Shradha@example.com</td>
                                <td>9898989898</td>
                              <td>
                                <button  aria-expanded="false" class="btn btn-default waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                           </tr>
                           <tr>
                                <td>1</td>
                                <td>CD2</td>
                                <td>Bineta</td>
                                <td>Bineta@example.com</td>
                                <td>9898989898</td>
                              <td>
                                <button  aria-expanded="false" class="btn btn-default  waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                           </tr> --}}
                        </tbody>
                     </table>
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">

                  </div>
               </div>
            </div>
         </div>

    </div>
</div>



<div class="modal fade" id="projectTimerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none">
    <div class="modal-dialog" role="document">
       <div class="modal-content">

          <div class="modal-body">
            <table class="table admin-table table-hover">
                <thead>
                    <tr>
                        <th  colspan="3">Pre OnBoarding</th>
                    </tr>
                </thead>
                <tbody id="candidate_onboardinfo">
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
          </div>
       </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/Hrss/hrpreonboarding.js"></script>
@endsection
@section('script')

@endsection
