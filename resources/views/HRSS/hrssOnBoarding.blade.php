@extends('layouts.simple.hr_master')
@section('title', 'On Boarding')

@section('css')
<style type="text/css">
    .submiteddata{
      display: none;
    }
 </style>

@endsection

@section('style')
<style>
.action-button
{
    padding: 6px 7px 6px 24px;
    margin-top: 12px;
}
.goal_btn_status{
   width: max-content;
}
</style>

@endsection

@section('breadcrumb-title')
	<h2><span>On Boarding</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">On Boarding</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection
@section('content')
 <div class="loader-box" id="pre_loader" style="display: none;">
    <div class="loader-29" style="z-index: 100;position: fixed;"></div>
 </div>

<div class="container-fluid">
    <div class="row" class="submiteddata">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                <button class="btn btn-primary float-right"  style="display:none; margin-bottom: 16px;" id="GenIdBtn">Create EmployeeID <i class="fa fa-plus" aria-hidden="true"></i></button>
                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>S.no</th>
                              <th>#</th>
                              <th>Employee Id</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile number</th>
                              <th>Induction Mail</th>
                              <th>Buddy Mail</th>
                              <th>Document Status</th>
                              <th>Action</th>
                              <th>Document</th>
                           </tr>
                        </thead>
                        <tbody>
                            @if (count($candidate_info) > 0)
                                                    <?php $i=1;?>
                                                      @foreach ($candidate_info as  $info)
                                                           <tr>
                                                               <td>{{$i}}</td>
                                                               <td>
                                                               @if($info['payroll_status']=="HEPL")
                                                                    @if($info['doc_status']!=0 && $info['Id_status']==0) 
                                                                        <input type="checkbox" class="check_ckechbox">
                                                                    @endif  
                                                                    @if($info['doc_status']!=0 && $info['Id_status']!=0)
                                                                    -
                                                                    @endif
                                                                    @if($info['doc_status']==0 && $info['Id_status']==0)
                                                                     -
                                                                    @endif 
                                                               @else
                                                                   -
                                                                @endif      
                                                               </td>
                                                               <td>{{$info["empID"]}}</td>
                                                               <td>{{$info["username"]}}</td>
                                                               <td>{{$info["email"]}}</td>
                                                               <td>{{$info["contact_no"]}}</td>
                                                                 @if ($info["Induction_mail"]==1)
                                                                  <?php $color="green";?>
                                                                  <?php $class="fa-check";?>
                                                                 @else
                                                                   <?php $class="fa-times";?>
                                                                   <?php $color="red;" ?>
                                                                  @endif

                                                                 @if ($info["Buddy_mail"]==1)
                                                                 <?php $color1="green";?>
                                                                 <?php $class1="fa-check";?>
                                                                @else
                                                                  <?php $class1="fa-times";?>
                                                                  <?php $color1="red;" ?>
                                                                @endif
                                                               <td><p style="color:{{$color}}" class="fa {{$class}}"></p></td>
                                                               <td><p style="color:{{$color1}}" class="fa {{$class1}}"></p></td>
                                                               <td>
                                                                  @if($info['doc_status']==0)
                                                                    <?php $class="btn btn-danger"; ?>
                                                                    <?php $text="Pending"; ?>
                                                                  @endif
                                                                  @if($info['doc_status']==1)
                                                                    <?php $class="btn btn-primary"; ?>
                                                                    <?php $text="Partitally Verified"; ?>
                                                                  @endif
                                                                  @if($info['doc_status']==2)
                                                                    <?php $class="btn btn-success"; ?>
                                                                    <?php $text="Verified"; ?>
                                                                  @endif
                                                                  <button class="{{$class}} goal_btn_status" type='button'>{{$text}}</button>
                                                               </td>
                                                               <td>
                                                                  @if($info['payroll_status']!="HEPL")
                                                                     @if($info['doc_status']!=0 && $info['Id_status']==0) 
                                                                    <a class="btn btn-primary action-button" onclick=model_trigger("{{$info["empID"]}}") href="javascript:void(0)"><i class="fa fa-pencil" style="margin-left: -17px;"></i></a>
                                                                    @endif  
                                                                  @endif
                                                                 <a class="btn btn-success action-button" onclick=edit_modal("{{$info["empID"]}}") href="javascript:void(0)"><i class="icon-save" style="margin-left: -17px;"></i><a>
                                                                 <a class="btn btn-secondary action-button" href="view_welcome_aboard_hr?id={{$info["empID"]}}"><i class="fa fa-eye" aria-hidden="true" style="margin-left: -17px;"></i><a>
                                                               </td>
                                                               <td>
                                                                <a class="btn btn-warning action-button" href="userdocuments?id={{Crypt::encrypt($info["empID"])}}"><i class="icon-save" style="margin-left: -17px;"></i><a>
                                                               </td>
                                                           </tr>
                                                         <?php $i++;?>
                                                      @endforeach
                                                  @else

                                                  @endif
                        </tbody>
                     </table>
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                  </div>
               </div>
            </div>
         </div>





        </div>


</div>

<!-- Modal Fade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Employee Id Creation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
              <label>Enter Employee Id</label>
              <input type="text" class="form-control" id="NewEmpId">
          </div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button"  data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" id="EmpIdCreationBtn" data-dismiss="modal">Save changes</button>
             <input type="hidden" id="emp_hidden_id">
          </div>
       </div>
    </div>
 </div>
@endsection
@section('script')

<div class="modal fade" id="ConformationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Conformation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <label>Are you sure to confirm the candidate is onboarded</label>
          </div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal" id="Candidate_Status_update">Save changes</button>
             <input type="hidden" id="can_hidden_id">

          </div>
       </div>
    </div>
 </div>
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <p>Are you sure you want to onboard?</p>
          </div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Save changes</button>
          </div>
       </div>
    </div>
 </div>

@endsection
@section('script')


@endsection
<script>
    var email_and_seat_request_url="{{url('Email_and_Seat_request')}}";
    var Candidate_status_update="{{url('Candidate_Status_Update')}}";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/HRSS/OnBoarding.js"></script>
