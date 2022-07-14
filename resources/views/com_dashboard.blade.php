@extends('layouts.simple.candidate_master')
@section('title', 'Dashboard')

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">

    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/scss/bootstrap/_modal.scss')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/whether-icon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/ionic-icon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{route('/')}}/assets/css/sweetalert2.css"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('style')

@endsection
<?php
        $session_val = Session::get('session_info');
        $pms_eligible_status = $session_val['pms_eligible_status'];
?>
@section('breadcrumb-title')
	<h2>Default<span>Dashboard </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 xl-100">
         <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
              <div class="card gradient-warning o-hidden">
                <div class="b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle text-white i"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                      <div class="text-white i" data-feather="message-circle"></div>
                    </div><i class="icon-bg" data-feather="message-circle"></i>
                    <div class="media-body"><a class="m-0 text-white" href="{{ url('id_card_varification') }}" ><h5 style="color:black;">ID Card Info</h5></a>
                        {{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token"> --}}
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle icon-bg"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                     <!--  <h4 class="mb-0 counter text-white">893</h4> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
              <div class="card gradient-info o-hidden">
                <div class="b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus text-white i"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                      <div class="text-white i" data-feather="user-plus"></div>
                    </div>
                    <div class="media-body"><a class="m-0 text-white" href="{{ url('candidate_profile') }}"><h5 style="color:black;">Profile</h5></a>
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus icon-bg"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-warning o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-3"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Stock<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-info o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-4"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Value<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div> -->
         </div>
      </div>

      <div class="col-xl-7 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Today's Birthdays</h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
               <i class="icofont icofont-birthday-cake font-primary"  style="font-size: 18px;"></i>
               </div>
            </div>
            <div class="card-body pt-0">
               <ul class="crm-activity" id="tdy_birthday_card_list">
               </ul>
            </div>
         </div>
      </div>



      

      <div class="col-xl-5 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Upcoming Holidays</h5>
               <!-- <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul> -->
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><a href="{{ route('holidays') }}"><i class="icofont icofont-calendar font-primary"></i></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="activity-table table-responsive">
                  <table class="table table-bordernone">
                     <tbody>
                        @foreach($upcoming_holidays as $upcoming_holiday)
                           <tr>
                              <td>
                              <div class="activity-image"><img class="img-fluid" src="{{asset('assets/images/dashboard/clipboard.png')}}" alt=""></div>
                              </td>
                              <td>
                              <div class="activity-details">
                                 <h4 class="default-text">{{ date('d', strtotime($upcoming_holiday->date)) }} <span class="f-14">{{ date('M', strtotime($upcoming_holiday->date)) }}</span></h4>
                                 <h6>{{$upcoming_holiday->occassion }}</h6>
                              </div>
                              </td>
                              <td>
                              <button class="btn btn-shadow-primary" onclick="view_holidays({{ $upcoming_holiday->id }})">View</button>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-7 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Today's Work Anniversary</h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
               <i class="icofont icofont-flora-flower font-primary"  style="font-size: 18px;"></i>
               </div>
            </div>
            <div class="card-body pt-0">
               <ul class="crm-activity" id="tdys_work_annu_list">

               </ul>
            </div>
         </div>
      </div>
      <div class="col-xl-5 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Upcoming Events</h5>
               <!-- <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul> -->
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><a href="{{ route('events') }}"><i class="icofont icofont-calendar font-primary"></i></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="activity-table table-responsive">
                  <table class="table table-bordernone">
                     <tbody>
                        @foreach($upcoming_events as $upcoming_event)
                           <tr>
                              <td>
                              <div class="activity-image"><img class="img-fluid" src="{{asset('assets/images/dashboard/greeting.png')}}" alt=""></div>
                              </td>
                              <td>
                              <div class="activity-details">
                                 <h4 class="default-text">{{ date('d', strtotime($upcoming_event->start_date_time)) }} <span class="f-14">{{ date('M', strtotime($upcoming_event->start_date_time)) }}</span></h4>
                                 <h6>{{$upcoming_event->event_name }}</h6>
                              </div>
                              </td>
                              <td>
                              <button class="btn btn-shadow-primary" onclick="view_events({{ $upcoming_event->id }})">View</button>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
       <div class="col-xl-4 xl-30 box-col-12">
         <div class="card gradient-secondary o-hidden monthly-overview">
            <div class="card-header no-border bg-transparent">
               <h5>Monthly Overview</h5>
               <h6 class="mb-0">January</h6>
               <span class="pull-right right-badge"><span class="badge badge-pill">70 / 100</span></span>
            </div>
            <div class="card-body p-0">
               <div class="text-bg"><span>0.7</span></div>
               <div class="area-range-apex">
                  <div id="area-range"></div>
               </div>
               <span class="overview-dots full-lg-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-30 box-col-6">
         <div class="card">
            <div class="card-header no-border">
               <h5></h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><i class="icofont icofont-gear fa fa-spin font-warning"></i></li>
                     <li><i class="view-html fa fa-code font-warning"></i></li>
                     <li><i class="icofont icofont-maximize full-card font-warning"></i></li>
                     <li><i class="icofont icofont-minus minimize-card font-warning"></i></li>
                     <li><i class="icofont icofont-refresh reload-card font-warning"></i></li>
                     <li><i class="icofont icofont-error close-card font-warning"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pb-0 pt-0">
               <div class="music-layer">
                  <button class="btn btn-pill">View More</button>
               </div>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head2" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head2">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="music-layer"&gt;
&lt;button class="btn btn-pill"&gt;
View More&lt;/button&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-30 box-col-6">
         <div class="card gradient-primary o-hidden monthly-overview yearly">
            <div class="card-header no-border bg-transparent">
               <h5>Yearly Overview</h5>
               <h6 class="mb-0">Monday</h6>
               <span class="pull-right right-badge"><span class="badge badge-pill">50 / 100</span></span>
            </div>
            <div class="card-body p-0">
               <div class="text-bg"><span>0.5</span></div>
               <div class="area-range-apex">
                  <div id="area-range-1"></div>
               </div>
               <span class="overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"> </span></span></span>
            </div>
         </div>
      </div>

   </div>
</div>

<!-- Modal Fade -->
<div class="modal fade" id="holidaysDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Holiday Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
            <div class="form-body">
               <div class="row">
                  <div class="col-md-12 ">
                     <div class="form-group">
                        <h6 class="f-w-700">Occassion:</h6>
                        <p id="occassion_show"></p>
                     </div>
                     <div class="form-group">
                        <h6 class="f-w-700">Description:</h6>
                        <p id="description_show"></p>
                     </div>
                     <div id="occassion_file_show_list"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Event Details Show -->
<div class="modal fade bd-example-modal-lg" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h4 class="modal-title" id="myLargeModalLabel">Event Details</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
            <div class="form-body">
               <div class="row">
                  <div class="col-md-12 ">
                     <div class="form-group">
                        <h6 class="f-w-700">Event Details</h6>
                        <p id="event_name_show"></p>
                        <p class="font-normal"> &mdash; <i>at</i> <span  id="where_show"></span></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                           <h6 class="f-w-700">Description</h6>
                           <p id="event_description_show"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <h6 class="f-w-700">Attendees</h6>
                        <p id="candicate_list_show"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <h6 class="f-w-700">Category</h6>
                        <p id="category_name_show"></p>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <h6 class="f-w-700">Event type</h6>
                        <p id="event_type_show"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <h6 class="f-w-700">Starts On</h6>
                        <div class="row">
                           <div class="col-lg-5">
                              <p id="start_date_show"></p>
                           </div>
                           <div class="col-lg-7">
                              <p id="start_time_show"></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <h6 class="f-w-700">Ends On</h6>
                        <div class="row">
                           <div class="col-lg-5">
                              <p id="end_date_show"></p>
                           </div>
                           <div class="col-lg-7">
                              <p id="end_time_show"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @yield('content')

</div>

@endsection

@section('script')
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('pro_js/side_bar.js')}}"></script>
<script>

      var get_session_sidebar_link = "{{url('get_session_sidebar')}}";

      fetch_tdys_brd_list();
      fetch_tdys_work_annu_list();

      //Today's birthday card
      function fetch_tdys_brd_list(){
         //Get holidays details
         $.ajax({
            url:"fetch_tdys_brd_list",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#tdy_birthday_card_list").append('');
                  $("#tdy_birthday_card_list").append(response);

            }

         });
      }

      //Today's work anniversary
      function fetch_tdys_work_annu_list(){
         //Get holidays details
         $.ajax({
            url:"fetch_tdys_work_annu_list",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#tdys_work_annu_list").append('');
                  $("#tdys_work_annu_list").append(response);

            }

         });
      }

      function view_holidays(id){
         //Get holidays details
         $.ajax({
            url:"fetch_holidays_list_id",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#occassion_show").text('');
                  $("#description_show").text('');
                  $("#occassion_file_show_list").text('');
                  $("#occassion_show").append(response[0].occassion);
                  $("#description_show").append(response[0].description);

                  var file = response[0].occassion_file;
                  var ext = file.split('.')[1];
                  // alert(ext);
                  if(ext=="jpg" || ext=="PNG" || ext=="png" || ext=="jpeg" || ext=="gif") {
                     // alert("one");
                     // var link = object[i].Value;

                     var image = '<img onclick=sample_popup_viewer("'+file+'") class="img-sm image-layer-item image-size"   src="../holidays_file/'+file+'" style="cursor:pointer;width: 400px;height: 200px;">';
                     // row.append($('<td>').html(image));
                     $("#occassion_file_show_list").append(image);

                  }else if (ext=="pdf"|| ext=="doc" || ext=="docx" || ext=="xlsx" || ext=="csv"){

                     var file = '<a href="/file_upload/'+file+'"  style="color:white;"  download><div class="badge bg-danger">'+file+'</div></a>';
                     $("#occassion_file_show_list").append(file);

                  }else if(ext=="mp4") {

                     var video = '';
                     video += '<video width="320" height="240" controls>';
                     video += '<source src="../../holidays_file/'+file+'" type="video/ogg">';
                     video += '</video>';

                     $("#occassion_file_show_list").append(video);

                  } else{

                     $("#occassion_file_show_list").append(" ");

                  }
            }

         });

         $('#holidaysDetailModal').modal('show');
      }

      function view_events(id){

         //Get Attendees list
         $.ajax({
            url:"fetch_event_attendees_show",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#candicate_list_show").html(response);

            }

         });

         //Get category list
         $.ajax({
            url:"fetch_event_edit",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  var rData = [];
                  rData = response;
                  $.each(rData, function (index, value) {

                     $("#event_name_show").html(value.event_name);
                     $("#where_show").html(value.where);
                     $("#event_description_show").html(value.description);
                     $("#category_name_show").html(value.category_name);
                     $("#event_type_show").html(value.event_type);

                     // var candicate_list = JSON.parse(value.candicate_list);
                     // console.log(candicate_list.length);

                     var start_date_time = value.start_date_time;
                     var split = start_date_time.split(" ");

                     const timeString = split[1];
                     // Prepend any date. Use your birthday.
                     const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                     .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                     );

                     // console.log();
                     $("#start_date_show").html(split[0]);
                     $("#start_time_show").html(timeString12hr);

                     var end_date_time = value.end_date_time;
                     var split = end_date_time.split(" ");

                     const timeString_end = split[1];
                     // Prepend any date. Use your birthday.
                     const timeString12hr_end = new Date('1970-01-01T' + timeString_end + 'Z')
                     .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                     );

                     // console.log();
                     $("#end_date_show").html(split[0]);
                     $("#end_time_show").html(timeString12hr_end);

                  });

            }


         });

         $('#eventDetailModal').modal('show');

      }

</script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  

$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
/*$(()=>{
    var sess_data=@json(Session::get('session_info'));
    $.ajax({
        url:"{{url('check_user_status')}}",
        type:"POST",
        data:{empID:sess_data['empID']},
        success:function(data){
            var res =JSON.parse(data);
            if(res.hr_action==0 || res.hr_action==3){
                     $("#loadModal1").modal('show');
            }
            else{
                $("#loadModal1").modal('hide');

            }
        }
    })
})*/
$(document).ready(function(){
    add_goal_btn_login();
});

function add_goal_btn_login(){
    
          $.ajax({                   
              url:"add_goal_btn_login",
              type:"GET",
              dataType : "JSON",
              success:function(response)
              {
                  if(response == "NAPS"){
                  //   alert("1")
                    psm_status_check();
                     //  $('#loadModal1').modal('show');
                  }else{
                    // alert("2")
                      $('#loadModal1').modal('hide');
                  }
              },
              error: function(error) {
                  console.log(error);

              }                                              
                  
          });

        }

/*show and hide a first popup*/
function psm_status_check(){
    var sess_data=@json(Session::get('session_info'));
   //  alert(sess_data)
    $.ajax({
        url:"{{url('check_user_pms')}}",
        type:"POST",
        data:{empID:sess_data['empID']},
        success:function(data){
         // console.log(data)
            if(data == 1){
               // alert("1")
               $("#loadModal1").modal('show');
            }
            else{
                $("#loadModal1").modal('hide');
               // alert("0")
            }
        }
    })
}


var ctoday = <?php echo time() * 1000 ?>;
setInterval(function() {ctoday += 1000;},1000);
function startTime() {
    var today = new Date(ctoday);
    var montharray = new Array("Jan","Feb","Mar","Abr","May","Jun","Jul","Ogu","Sep","Oct","Nov","Des");
    var h = today.getHours();
    var ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12;
    h = h ? h : 12;
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    checkTime(today.getDate())+" "+montharray[today.getMonth()]+" "+today.getFullYear() + " ("+ h + ":" + m + ":" + s +" "+ampm+")";
    // checkTime(today.getDate())+" "+montharray[today.getMonth()]+" "+today.getFullYear() + " (" + ampm +" " + h + ":" + m + ":" + s +")";
    setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}

$(()=>{
    startTime();
})

function show_login_popup(one){
   if(one==1){
        var url="Wrf_user_sigin";
   }
   else{
       var url="Wrf_user_signout";
   }
   $.ajax({
       url:url,
       type:"POST",
       data:{one:one},
       beforeSend:function(data){
           console.log("Loading!...")
       },
       success:function(response){
           var res=JSON.parse(response);
           if(res.success==1){
            Toastify({
                    text: res.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                    setTimeout(
                        function() {
                           location.reload()
                        }, 1000);
           }
           else{
            Toastify({
                        text:res.message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload()
                            }, 1000);
           }
       }
   })
}

</script>
