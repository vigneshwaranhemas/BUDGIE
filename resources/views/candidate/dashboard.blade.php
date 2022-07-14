@extends('layouts.simple.candidate_master')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('style')
@endsection

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
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-primary o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Sale<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-secondary o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-2"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Visits<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
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
            </div>
         </div>
      </div>
      <div class="col-xl-8 xl-100 box-col-12">
         <div class="card year-overview">
            <div class="card-header no-border d-flex">
               <h5>Year Overview</h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="header-right pull-right text-right">
                  <h5 class="mb-2">70 / 100</h5>
                  <h6 class="f-w-700 mb-0 default-text">Total 71,52,225 $</h6>
               </div>
            </div>
            <div class="card-body row">
               <div class="col-6 p-0 ct-10 default-chartist-container"></div>
               <div class="col-6 p-0 ct-11 default-chartist-container"></div>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-100 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Sales By Countries</h5>
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
                     <li><i class="icofont icofont-gear fa fa-spin font-primary"></i></li>
                     <li><i class="view-html fa fa-code font-primary"></i></li>
                     <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                     <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                     <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                     <li><i class="icofont icofont-error close-card font-primary"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body p-0">
               <div class="radial-default">
                  <div id="circlechart"></div>
               </div>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head1">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="card-body p-0"&gt;
&lt;div class="radial-default"&gt;
&lt;div id="circlechart"&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-50 box-col-12">
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
      <div class="col-xl-4 xl-50 box-col-6">
         <div class="card">
            <div class="card-header no-border">
               <h5>Best Sellers Product</h5>
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
      <div class="col-xl-4 xl-100 box-col-6">
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
      <div class="col-xl-6 xl-100 box-col-12">
         <div class="card weather-bg">
            <div class="card-header no-border bg-transparent">
               <h5>Weather Overview</h5>
            </div>
            <div class="card-body weather-bottom-bg p-0">
               <div class="cloud"><img src="../assets/images/cloud.png" alt=""></div>
               <div class="cloud-rain"></div>
               <div class="media weather-details">
                  <span class="weather-title"><i class="fa fa-circle-o d-block text-right"></i><span>16</span></span>
                  <div class="media-body">
                     <h5>London</h5>
                     <span class="d-block">01, Dec 2021</span>
                     <h6 class="mb-0">Wind : 50km/h  </h6>
                  </div>
               </div>
               <img class="img-fluid" src="../assets/images/dashboard/weather-image.png" alt="">
            </div>
         </div>
      </div>
      <div class="col-xl-6 xl-100 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Today's Activity</h5>
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
                     <li><i class="icofont icofont-gear fa fa-spin font-primary"></i></li>
                     <li><i class="view-html fa fa-code font-primary"></i></li>
                     <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                     <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                     <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                     <li><i class="icofont icofont-error close-card font-primary"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="activity-table table-responsive">
                  <table class="table table-bordernone">
                     <tbody>
                        <tr>
                           <td>
                              <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/clipboard.png" alt=""></div>
                           </td>
                           <td>
                              <div class="activity-details">
                                 <h4 class="default-text">15 <span class="f-14">November</span></h4>
                                 <h6>New Task Added</h6>
                              </div>
                           </td>
                           <td>
                              <div class="activity-time"><span class="font-primary f-w-700">1 Day Ago</span><span class="d-block light-text">Your Work Deadline 18<sup>th</sup></span></div>
                           </td>
                           <td>
                              <button class="btn btn-shadow-primary">View</button>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="activity-image activity-secondary"><img class="img-fluid" src="../assets/images/dashboard/greeting.png" alt=""></div>
                           </td>
                           <td>
                              <div class="activity-details">
                                 <h4 class="default-text">01 <span class="f-14">January</span></h4>
                                 <h6>New Task Added</h6>
                              </div>
                           </td>
                           <td>
                              <div class="activity-time"><span class="font-secondary f-w-700">10 Minute Ago</span><span class="d-block light-text">Update Your Work Today</span></div>
                           </td>
                           <td>
                              <button class="btn btn-shadow-secondary">View</button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head3" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head3">&lt;!-- Cod Box Copy begin --&gt;
&nbsp;&lt;div class="card-body pt-0"&gt;| &lt;div class="activity-table table-responsive"&gt;
&lt;table class="table table-bordernone"&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td&gt;
&lt;div class="activity-image"&gt;&lt;img class="img-fluid" src="../assets/images/dashboard/clipboard.png" alt=""&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;div class="activity-details"&gt;
&lt;h4 class="default-text"&gt;15 &lt;span class="f-14"&gt;November&lt;/span&gt;&lt;/h4&gt;
&lt;h6&gt;New Task Added&lt;/h6&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;div class="activity-time"&gt;&lt;span class="font-primary f-w-700"&gt;1 Day Ago&lt;/span&gt;&lt;span class="d-block light-text"&gt;Your Work Deadline 18&lt;sup&gt;th&lt;/sup&gt;&lt;/span&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;button class="btn btn-shadow-primary"&gt;View&lt;/button&gt;| &lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;
&lt;div class="activity-image activity-secondary"&gt;&lt;img class="img-fluid" src="../assets/images/dashboard/greeting.png" alt=""&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;div class="activity-details"&gt;
&lt;h4 class="default-text"&gt;01 &lt;span class="f-14"&gt;January&lt;/span&gt;&lt;/h4&gt;
&lt;h6&gt;New Task Added&lt;/h6&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;div class="activity-time"&gt;&lt;span class="font-secondary f-w-700"&gt;10 Minute Ago&lt;/span&gt;&lt;span class="d-block light-text"&gt;Update Your Work Today&lt;/span&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;button class="btn btn-shadow-secondary"&gt;View &lt;/button&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;    </code></pre>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-7 xl-100 box-col-12">
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
               <ul class="crm-activity">
                  @foreach($todays_birthdays as $todays_birthday)
                  <li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                     <div class="align-self-center media-body" style="margin-left: 16px;">
                        <h5 class="mt-0">{{$todays_birthday->username }}</h5>
                        <p>Happy Birthday {{$todays_birthday->username }}, Have a great year ahead! <img style="width:34px" src="{{ asset('assets/images/cupcake.svg') }}" alt="Cupcake" class="img-fluid"></p>
                     </div>
                  </li>
                  @endforeach 
               </ul>
            </div>
         </div>
      </div>
      <div class="col-xl-5 xl-100 box-col-12">
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
                              <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/clipboard.png" alt=""></div>
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
      
      <div class="col-xl-7 xl-100 box-col-12">
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
               <ul class="crm-activity">
                  @foreach($tdy_work_anniversary as $tdy_work_avry)
                  <li class="media"><div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                     <div class="align-self-center media-body" style="margin-left: 16px;">
                        <h5 class="mt-0">{{$tdy_work_avry->username }}</h5>
                        <p>Happy Work Anniversary {{$tdy_work_avry->username }}, Have a great year ahead! <img style="width:34px" src="{{ asset('assets/images/flowers.svg') }}" alt="Cupcake" class="img-fluid"></p>
                     </div>
                  </li>
                  @endforeach 
               </ul>
            </div>
         </div>
      </div>
      <div class="col-xl-5 xl-100 box-col-12">
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
                              <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/greeting.png" alt=""></div>
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
      
   </div>
</div>

<!-- Modal Fade -->
<div class="modal fade" id="holidaysDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
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
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Event Details Show -->
<div class="modal fade bd-example-modal-lg" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
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
                           <p id="description_show"></p>
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
         <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
<script src="../assets/js/typeahead/handlebars.js"></script>
<script src="../assets/js/typeahead/typeahead.bundle.js"></script>
<script src="../assets/js/typeahead/typeahead.custom.js"></script>
<script src="../assets/js/typeahead-search/handlebars.js"></script>
<script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="../assets/js/chart/chartist/chartist.js"></script>
<script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/dashboard/default.js"></script>
<script src="../assets/js/notify/index.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="../pro_js/side_bar.js"></script>
<script>
     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";

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
               $("#occassion_show").append(response[0].occassion);
               $("#description_show").append(response[0].description);                

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
                  $("#description_show").html(value.description);
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

