@extends('layouts.simple.candidate_master')
@section('title', 'EmailId Creation')

@section('css')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('style')
<style>
    .bg-info
      {
          background-color: #7e37d8 !important;    
      }
   </style>
@endsection

@section('breadcrumb-title')
	<h2><span>EmailId Creation  </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">EmailId Creation </li>

@endsection

@section('content')
<div class="col-sm-12 col-xl-12 xl-100">
    <div class="card">

       <div class="card-body">
          <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
             <li class="nav-item">
                <a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Pending</a>
                <div class="material-border"></div>
             </li>
             <li class="nav-item">
                <a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Completed</a>
                <div class="material-border"></div>
             </li>

          </ul>
          <div class="tab-content" id="top-tabContent">
             <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                             <div class="col-md-6 text-left">
                             <h5>EmailID Creation Request</h5>
                             </div>

                             <div class="col-md-6 text-right">
                             <button type="button" class="btn btn-primary" id="EmailStatusUpdateBtn">Save changes</button>
                             </div>
                            </div>
                        </div>
                       <div class="card-body">
                          <div class="dt-ext table-responsive">
                            <table class="display" id="export-button">
                                <thead>
                                   <tr>
                                      <th>S.No</th>
                                      <th>#</th>
                                      <th>Employee Id</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Mobile Number</th>
                                      <th>HR Suggested Email</th>
                                      <th>Asset</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @if (count($email_info['pending'])>0)
                                        <?php $i=1;?>
                                         @foreach ($email_info['pending'] as $info )
                                              <tr>
                                                 <td>{{$i}}</td>
                                                 <td><input type='checkbox'></td>
                                                 <td>{{$info->empID}}</td>
                                                 <td>{{$info->username}}</td>
                                                 <td>{{$info->email}}</td>
                                                 <td>{{$info->contact_no}}</td>
                                                 <td><input type="text" class="form-control" value="{{$info->hr_suggested_mail}}"></td>
                                                 <td>{{$info->asset_type}}</td>
                                              </tr>
                                          <?php $i++; ?>
                                         @endforeach
                                    @endif
                                </tbody>
                             </table>
                          </div>
                       </div>
                    </div>
                 </div>
             </div>
             <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                <div class="col-sm-12">
                    <div class="card">
                       <div class="card-body">
                          <div class="dt-ext table-responsive">
                            <table class="display" id="export-button1">
                                <thead>
                                   <tr>
                                    <th>#</th>
                                    <th>Employee Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Hr Suggested Email</th>
                                    <th>Asset</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @if (count($email_info['completed'])>0)
                                        <?php $i=1;?>
                                         @foreach ($email_info['completed'] as $info )
                                              <tr>
                                                 <td>{{$i}}</td>
                                                 <td>{{$info->empID}}</td>
                                                 <td>{{$info->username}}</td>
                                                 <td>{{$info->email}}</td>
                                                 <td>{{$info->contact_no}}</td>
                                                 <td>{{$info->hr_suggested_mail}}</td>
                                                 <td>{{$info->asset_type}}</td>
                                              </tr>
                                          <?php $i++; ?>
                                         @endforeach
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
       </div>
 </div>
 {{-- div popup model --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Email Creation</h5>
             <button class="close" type="button" data-dismiss="modal" arsia-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">Are you sure to confirm this email id as created</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/ITInfra/EmailCreationRequest.js"></script>
<script>
    var it_url="ITInfra_Email_Creation";
</script>
