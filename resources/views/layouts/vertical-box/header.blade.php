<div class="page-main-header">
  <div class="main-header-right">
     <div class="main-header-left text-center">
        <div class="logo-wrapper"><a href="{{route('/')}}"><img src="{{route('/')}}/assets/images/logo/logo.png" alt=""></a></div>
     </div>
     <div class="mobile-sidebar d-none">
        <div class="media-body text-right switch-sm">
           <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
        </div>
     </div>
     <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar">               </i></div>
     <div class="nav-right col pull-right right-menu">
        <ul class="nav-menus">
           <li>
              <form class="form-inline search-form" action="#" method="get">
                 <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                       <div class="u-posRelative">
                          <input class="Typeahead-input form-control-plaintext" id="demo-input" type="text" name="q" placeholder="Search Your Product...">
                          <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                          <span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                       </div>
                       <div class="Typeahead-menu"></div>
                    </div>
                 </div>
              </form>
           </li>
           <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
           <li class="onhover-dropdown">
              <img class="img-fluid img-shadow-warning" src="{{route('/')}}/assets/images/dashboard/bookmark.png" alt="">
              <div class="onhover-show-div bookmark-flip">
                 <div class="flip-card">
                    <div class="flip-card-inner">
                       <div class="front">
                          <ul class="droplet-dropdown bookmark-dropdown">
                             <li class="gradient-primary text-center">
                                <h5 class="f-w-700">Bookmark</h5>
                                <span>Bookmark Icon With Grid</span>
                             </li>
                             <li>
                                <div class="row">
                                   <div class="col-4 text-center"><i data-feather="file-text"></i></div>
                                   <div class="col-4 text-center"><i data-feather="activity"></i></div>
                                   <div class="col-4 text-center"><i data-feather="users"></i></div>
                                   <div class="col-4 text-center"><i data-feather="clipboard"></i></div>
                                   <div class="col-4 text-center"><i data-feather="anchor"></i></div>
                                   <div class="col-4 text-center"><i data-feather="settings"></i></div>
                                </div>
                             </li>
                             <li class="text-center">
                                <button class="flip-btn" id="flip-btn">Add New Bookmark</button>
                             </li>
                          </ul>
                       </div>
                       <div class="back">
                          <ul>
                             <li>
                                <div class="droplet-dropdown bookmark-dropdown flip-back-content">
                                   <input type="text" placeholder="search...">
                                </div>
                             </li>
                             <li>
                                <button class="d-block flip-back" id="flip-back">Back</button>
                             </li>
                          </ul>
                       </div>
                    </div>
                 </div>
              </div>
           </li>
           <li class="onhover-dropdown">
              <img class="img-fluid img-shadow-secondary" src="{{route('/')}}/assets/images/dashboard/like.png" alt="">
              <ul class="onhover-show-div droplet-dropdown">
                 <li class="gradient-primary text-center">
                    <h5 class="f-w-700">Grid Dashboard</h5>
                    <span>Easy Grid inside dropdown</span>
                 </li>
                 <li>
                    <div class="row">
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="file-text"></i><span class="d-block">Content</span></div>
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="activity"></i><span class="d-block">Activity</span></div>
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="users"></i><span class="d-block">Contacts</span></div>
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="clipboard"></i><span class="d-block">Reports</span></div>
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="anchor"></i><span class="d-block">Automation</span></div>
                       <div class="col-sm-4 col-6 droplet-main"><i data-feather="settings"></i><span class="d-block">Settings</span></div>
                    </div>
                 </li>
                 <li class="text-center">
                    <button class="btn btn-primary btn-air-primary">Follows Up</button>
                 </li>
              </ul>
           </li>
           <li class="onhover-dropdown">
              <img class="img-fluid img-shadow-warning" src="{{route('/')}}/assets/images/dashboard/notification.png" alt="">
              <ul class="onhover-show-div notification-dropdown">
                 <li class="gradient-primary">
                    <h5 class="f-w-700">Notifications</h5>
                    <span>You have 6 unread messages</span>
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
           <li><a class="right_side_toggle" href="#"><img class="img-fluid img-shadow-success" src="{{route('/')}}/assets/images/dashboard/chat.png" alt=""></a></li>
           <li class="onhover-dropdown">
              <span class="media user-header"><img class="img-fluid" src="{{route('/')}}/assets/images/dashboard/user.png" alt=""></span>
              <ul class="onhover-show-div profile-dropdown">
                 <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">Elana Saint</h5>
                    <span>Web Designer</span>
                 </li>
                 <li><i data-feather="user"> </i>Profile</li>
                 <li><i data-feather="message-square"> </i>Inbox</li>
                 <li><i data-feather="file-text"> </i>Taskboard</li>
                 <li><i data-feather="settings"> </i>Settings            </li>
              </ul>
           </li>
        </ul>
        <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
     </div>
     <script id="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">                        
        <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">{{@name}}</div>
        </div>
        </div>
     </script>
     <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>