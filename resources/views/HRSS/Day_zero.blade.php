@extends('layouts.simple.candidate_master')
@section('title', 'Day Zero')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>Day Zero</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Day Zero</li>
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
                              <th>Employee Id</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile Number</th>
                              <th>Induction Mail</th>
                              <th>Buddy Mail</th>

                           </tr>
                        </thead>
                        <tbody>
                                  @if (count($candidate_info) > 0)
                                  <?php $i=1;?>
                                @foreach ($candidate_info as  $info)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$info["empID"]}}</td>
                                    <td>{{$info["username"]}}</td>
                                    <td>{{$info["email"]}}</td>
                                    <td>{{$info["contact_no"]}}</td>
                                    @if ($info["Induction_mail"]==1)
                                    <?php $color="green";?>
                                    <?php $class="fa-check";?>
                                   @else
                                     <?php $class="fa-times";?>
                                     <?php $color="red"; ?>
                                   @endif

                                   @if ($info["Buddy_mail"]==1)
                                   <?php $color1="green";?>
                                   <?php $class1="fa-check";?>
                                  @else
                                    <?php $class1="fa-times";?>
                                    <?php $color1="red";?>
                                  @endif
                                  <td><p style="color:{{$color}}" class="fa {{$class}}"></p></td>
                                  <td><p style="color:{{$color1}}" class="fa {{$class1}}"></p></td>
                                </tr>
                                <?php $i++;?>
                                @endforeach

                                  @else

                                  @endif

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
