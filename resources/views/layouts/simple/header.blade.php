<?php
$session_val = Session::get('session_info');
        $passcode_status = $session_val['passcode_status'];
?>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-main-header">
  <div class="main-header-right">
    <div class="main-header-left text-center">
         @if ($passcode_status==0)
           <div class="logo-wrapper"><a href="{{ url('change_password') }}"><img src="../assets/images/logo/logo.png" alt=""></a></div>
         @else
           <div class="logo-wrapper"><a href="{{ url('com_dashboard') }}"><img src="../assets/images/logo/logo.png" alt=""></a></div>
         @endif
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
      </div>
    </div>
    <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar">               </i></div>
    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">
        <li>
        </li>
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown"><img class="img-fluid img-shadow-warning" src="../assets/images/dashboard/notification.png" alt="">
          <ul class="onhover-show-div notification-dropdown">
            <li class="gradient-primary">
              <h5 class="f-w-700">Notifications</h5><span>You have 6 unread messages</span>
            </li>
            <li>
              <div class="media">
                <div class="notification-icons bg-success mr-3"><i class="mt-0" data-feather="thumbs-up"></i></div>
                <div class="media-body">
                  <h6>Someone Likes Your Posts</h6>
                  <p class="mb-0"> 2 Hours Ago</p>
                </div>
              </div>
            </li>
            <li class="pt-0">
              <div class="media">
                <div class="notification-icons bg-info mr-3"><i class="mt-0" data-feather="message-circle"></i></div>
                <div class="media-body">
                  <h6>3 New Comments</h6>
                  <p class="mb-0"> 1 Hours Ago</p>
                </div>
              </div>
            </li>
            <li class="bg-light txt-dark"><a href="#">All </a> notification</li>
          </ul>
        </li>
        <li><a class="right_side_toggle" href="#"><img class="img-fluid img-shadow-success" src="../assets/images/dashboard/chat.png" alt=""></a></li>
        <li class="onhover-dropdown"> <span class="media user-header" id="login_profile_image"></span>
          <ul class="onhover-show-div profile-dropdown">
            <li class="gradient-primary">
              <h5 class="f-w-600 mb-0">{{ Auth::user()->username }}</h5><span>{{ Auth::user()->designation }}</span>
            </li>
            <!-- <li class="sub_header"><i data-feather="user"> <a href="{{ url('candidate_profile') }}"></i>Profile</a></li> -->
            <li class="sub_header"><i data-feather=""> <a href="{{ url('candidate_profile') }}"></i>Profile</a></li>
            <li class="sub_header"><i data-feather=""><a href="{{ url('change_password') }}"> </i>Change password</a></li>
            <li class="logout"><a href="{{ url('logout') }}" ><i data-feather="bi bi-door-closed-fill"> </i><span>Logout</span></a></li>
          </ul>
        </li>
      </ul>
      <div class="d-lg-none mobile-toggle pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></div>
      <!-- <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div> -->
    </div>
    <script id="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">{{ @name }}</div>
      </div>
      </div>
    </script>
    <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
