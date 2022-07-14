@extends('layouts.simple.candidate_master')
@section('title', 'Chat App')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Chat<span>App</span></h2>
@endsection

@section('breadcrumb-items')
	<!-- <li class="breadcrumb-item">Apps</li>
    <li class="breadcrumb-item">User</li> -->
	<li class="breadcrumb-item active">Chat App</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col call-chat-sidebar col-sm-12">
         <div class="card">
            <div class="card-body chat-body">
               <div class="chat-box">
                  <!-- Chat left side Start-->
                  <div class="chat-left-aside">
                     <!-- <div class="media">
                        <img class="rounded-circle user-image" src="../assets/images/user/12.png" alt="">
                        <div class="about">
                           <div class="name f-w-600">Mark Jecno</div>
                           <div class="status">Status...</div>
                        </div>
                     </div> -->
                     <div class="people-list" id="people-list">
                        <div class="search">
                           <form class="theme-form">
                              <div class="form-group">
                                 <input class="form-control" type="text" placeholder="search"><i class="fa fa-search"></i>
                              </div>
                           </form>
                        </div>
                        <ul class="list">
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                              <div class="status-circle away"></div>
                              <div class="about">
                                 <div class="name">Vincent Porter</div>
                                 <div class="status">Hello Name</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/2.png" alt="">
                              <div class="status-circle online"></div>
                              <div class="about">
                                 <div class="name">Aiden Chavez</div>
                                 <div class="status">Out is my favorite.</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                              <div class="status-circle online"></div>
                              <div class="about">
                                 <div class="name">Prasanth Anand</div>
                                 <div class="status">Change for anyone.</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">
                              <div class="status-circle offline"></div>
                              <div class="about">
                                 <div class="name">Venkata Satyamu</div>
                                 <div class="status">First bun like a sun.</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/5.jpg" alt="">
                              <div class="status-circle online"></div>
                              <div class="about">
                                 <div class="name">Ginger Johnston</div>
                                 <div class="status">it's my life. Mind it.</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                              <div class="status-circle offline"></div>
                              <div class="about">
                                 <div class="name">Kori Thomas</div>
                                 <div class="status">Change for anyone.</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                              <div class="status-circle online"></div>
                              <div class="about">
                                 <div class="name">Vincent Porter</div>
                                 <div class="status">Hello Name</div>
                              </div>
                           </li>
                           <li class="clearfix">
                              <img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                              <div class="status-circle online"></div>
                              <div class="about">
                                 <div class="name">Kori Thomas</div>
                                 <div class="status">Change for anyone.</div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <!-- Chat left side Ends-->
               </div>
            </div>
         </div>
      </div>
      <div class="col call-chat-body">
         <div class="card">
            <div class="card-body p-0">
               <div class="row chat-box">
                  <!-- Chat right side start-->
                  <div class="col pr-0 chat-right-aside">
                     <!-- chat start-->
                     <div class="chat">
                        <!-- chat-header start-->
                        <div class="chat-header clearfix">
                           <img class="rounded-circle" src="../assets/images/user/8.jpg" alt="">
                           <div class="about">
                              <div class="name">Kori Thomas  <span class="font-primary f-12">Typing...</span></div>
                              <div class="status digits">Last Seen 3:55 PM</div>
                           </div>
                           <ul class="list-inline float-left float-sm-right chat-menu-icons">
                              <li class="list-inline-item"><a href="#"><i class="icon-search"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="icon-clip"></i></a></li>
                              <!-- <li class="list-inline-item"><a href="#"><i class="icon-headphone-alt"></i></a></li> -->
                              <!-- <li class="list-inline-item"><a href="#"><i class="icon-video-camera"></i></a></li> -->
                              <!-- <li class="list-inline-item toogle-bar"><a href="#"><i class="icon-menu"></i></a></li> -->
                           </ul>
                        </div>
                        <!-- chat-header end-->
                        <div class="chat-history chat-msg-box custom-scrollbar">
                           <ul>
                              <li>
                                 <div class="message my-message">
                                    <img class="rounded-circle float-left chat-user-img img-30" src="../assets/images/user/3.png" alt="">
                                    <div class="message-data text-right"><span class="message-data-time">10:12 am</span></div>
                                    Are we meeting today? Project has been already finished and I have results to show you.
                                 </div>
                              </li>
                              <li class="clearfix">
                                 <div class="message other-message pull-right">
                                    <img class="rounded-circle float-right chat-user-img img-30" src="../assets/images/user/12.png" alt="">
                                    <div class="message-data"><span class="message-data-time">10:14 am</span></div>
                                    Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so?
                                 </div>
                              </li>
                              <li class="clearfix">
                                 <div class="message other-message pull-right">
                                    <img class="rounded-circle float-right chat-user-img img-30" src="../assets/images/user/12.png" alt="">
                                    <div class="message-data"><span class="message-data-time">10:14 am</span></div>
                                    Well I am not sure. The rest of the team
                                 </div>
                              </li>
                              <li>
                                 <div class="message my-message mb-0">
                                    <img class="rounded-circle float-left chat-user-img img-30" src="../assets/images/user/3.png" alt="">
                                    <div class="message-data text-right"><span class="message-data-time">10:20 am</span></div>
                                    Actually everything was fine. I'm very excited to show this to our team.
                                 </div>
                              </li>
                           </ul>
                        </div>
                        <!-- end chat-history-->
                        <div class="chat-message clearfix">
                           <div class="row">
                              <div class="col-xl-12 d-flex">
                                 <div class="smiley-box bg-primary">
                                    <div class="picker"><img src="../assets/images/smiley.png" alt=""></div>
                                 </div>
                                 <div class="input-group text-box">
                                    <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......">
                                    <div class="input-group-append">
                                       <button class="btn btn-primary" type="button">SEND</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end chat-message-->
                        <!-- chat end-->
                        <!-- Chat right side ends-->
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
<script src="../assets/js/fullscreen.js"></script>
@endsection