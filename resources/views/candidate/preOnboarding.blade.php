@extends('layouts.simple.candidate_master')
@section('title', 'HRSS Pre OnBoarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/prism.css')}}">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Candidate<span>Pre OnBoarding </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Pre OnBoarding</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                   <div class="row">
                    <div class="col-md-6 text-left">
                    <h5>Pre OnBoarding</h5>
                    </div>
                    <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" id="SaveBtn">Save changes</button>
                    </div>
                   </div>
               </div>
               <div class="card-block row">
                  <div class="col-sm-12 col-lg-12 col-xl-12">
                     <div class="table-responsive">
                        <table class="table" id="users-table">
                           <thead class="thead-light">
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">PRE ONBOARDING</th>
                                 <th scope="col">VERIFIED</th>
                                 <th scope="col">DATE</th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php $i=0; ?>
                            @foreach ( $userdata['fields'] as $fields )
                            <tr>
                                @if (count($userdata['user_info']) == 0)
                                      <?php
                                        $checked="";
                                        $date="" ;
                                        $disabled="disabled";

                                        ?>
                                @else
                                            @if ($userdata['user_info'][$i]->date!="")
                                            <?php $date=$userdata['user_info'][$i]->date;
                                                // $disabled="";
                                            ?>

                                                @else
                                                <?php   $date="" ;
                                                    // $disabled="disabled";
                                                ?>
                                                @endif

                                        @if ($userdata['user_info'][$i]->type==1)
                                        <?php
                                         $checked="checked";
                                         $disabled="";


                                        ?>
                                        @else
                                        <?php
                                            $checked="";
                                            $disabled="disabled";
                                            ?>
                                        @endif
                                @endif
                                 <td scope="row">{{$i+1}}</td>
                                 <td>{{$fields->preonboarding_process}}</td>
                                 <td>
                                     <label class="switch">
                                    <input type="checkbox" id="check{{"$i"}}"   class="checkbox_check" {{$checked}} ><span class="switch-state  "></span>
                                    </label></td>
                                 <td>
                                    <input type="date" class="datepicker-here form-control digits1" name="date3" {{$disabled}}  value="{{$date}}" id="date{{"$i"}}" style="width:50%;" >
                                 </td>
                              </tr>
                              <?php $i++;?>
                                @endforeach

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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/preonboarding/preonboarding.js"></script>
@section('script')
@endsection
