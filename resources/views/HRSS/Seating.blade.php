@extends('layouts.simple.candidate_master')
@section('title', 'Candidate Seating And IdCard ')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>Candidate Seating And IdCard  </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Candidate Seating And IdCard </li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
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
                        <div class="card-body">
                           <div class="dt-ext table-responsive">
                             <table class="display" id="export-button">
                                 <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Enployee ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Seating Status</th>
                                        <th>Idcard Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if (count($seating_info['pending'])>0)
                                         <?php $i=1;?>
                                         @foreach ($seating_info['pending'] as $data )
                                         <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$data['empId']}}</td>
                                            <td>{{$data['username']}}</td>
                                            <td>{{$data['email']}}</td>
                                            <td>{{$data['contact_no']}}</td>
                                             @if ($data['Seating_Request']==1)
                                               <td><span class="badge badge-success">Alloted</span></td>
                                             @else
                                               <td><span class="badge badge-warning">Pending</span></td>
                                             @endif
                                             @if ($data['IdCard_status']==1)
                                             <td><span class="badge badge-success">Created</span></td>
                                             @else
                                                <td><span class="badge badge-warning">Pending</span></td>
                                             @endif

                                         </tr>
                                         <?php $i++;?>
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
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>EMmail</th>
                                        <th>Mobile Number</th>
                                        <th>Seating Status</th>
                                        <th>Idcard Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    @if (count($seating_info['completed'])>0)
                                         <?php $i=1;?>
                                         @foreach ($seating_info['completed'] as $data )
                                         <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$data['empId']}}</td>
                                            <td>{{$data['username']}}</td>
                                            <td>{{$data['email']}}</td>
                                            <td>{{$data['contact_no']}}</td>
                                             @if ($data['Seating_Request']==1)
                                               <td><span class="badge badge-success">Alloted</span></td>
                                             @else
                                               <td><span class="badge badge-warning">Pending</span></td>
                                             @endif
                                             @if ($data['IdCard_status']==1)
                                             <td><span class="badge badge-success">Created</span></td>
                                             @else
                                                <td><span class="badge badge-warning">Pending</span></td>
                                             @endif

                                         </tr>
                                         <?php $i++;?>
                                         @endforeach
                                    @endif
                                 </tbody>
                              </table>
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
@section('script')

@endsection
