@extends('layouts.simple.candidate_master')
@section('title', 'People')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">

@endsection

@section('style')
<style>
    .chat-box .chat-menu.chat-menu-style{
        margin-left: 20px;
        border-right: 1px solid #f8f5fd !important;
        max-width: 440px;
    }
    .card-style{
        margin-left: 70px !important;
        margin-top: 30px !important;
    }
    .chat-box .chat-menu{
        border-left: none;
    }
    .clearfix{
        padding: 10px;
    }
    .list li:hover {
        background-color: #ece2f9;
    }
    .chat-box .people-list ul li.active{
        background-color: #7e37d8;
    }
    .chat-box .people-list ul li.active .about .name{
        color: #ffffff;
    }
    .chat-box .people-list .search i.people_filter_i{
        right: 0px;
        top: 8px;
        font-size: 22px;
    }
    .chat-box .people-list .search i.people_filter_i_close{
        right: 0px;
        top: 8px;
        font-size: 22px;
        margin-right: 30px;
    }
    .people_search_div{
        margin-left: 0px;
    }
    .card .card-header.people_filter_card_header{
        padding: 29px;
        color: #7e37d8;
    }
    .div_filter{
        display: none;
    }
    .close.div_close:hover{
        color: #7e37d8;
        border: 0px solid #7e37d8;
    }
    /* .close.div_close:hover{
        color: #7e37d8;
        border: 0px solid #7e37d8;
    } */
    .chat-star-empty_state{
        margin-top: 150px;
    }
    .chat-right-aside-star{
        display: none;
    }
    .chat-right-aside-employees-empty{
        display: none;
    }
    .chat-right-aside{
        display: none;
    }
    .chat-box .chat-right-aside .chat .chat-header.chat-boder-bottom{
        margin-right: 20px;
    }
    #star_class_name{
        margin-left: 10px;
    }
    .chat-box .about.people_name_show{
        margin-top: -5px;
    }
    /* .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons.chat-menu-icons-star{
        margin-top: 0px;
    } */
    .select2-dropdown{
        z-index: 10;
    }    
    .people_filter_i_close, .people_filter_i, .div_filter_close {
        cursor: pointer;
    }
    #people_list_filter_starred{
        max-width: 320px !important;
    }    
    #people_list_filter_everyone{
        max-width: 320px !important;
    }
    .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons{
        margin-top: unset !important;
    }
    /* Responsive */
    /* @media only screen and (max-width: 425px){
        .chat-menu.responsive-chat-menu {
            right: none;
            border-top: none;
            opacity: none;
            -webkit-transform: none;
            transform: none;
            visibility: none !important;
            top: none;
            position: none;
            z-index: none;
            background-color: none;
            -webkit-transition: none;
            transition: none;
        }
    } */

    @media only screen and (max-width: 1199px){
        .chat-menu {
            opacity: 2 !important;
            visibility: unset !important;
            top: 30px;
            position: relative;
            border-radius: 20px;

        }
    }

    @media only screen and (max-width: 640px) {
        .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons.chat-menu-icons-star{
            margin-top: -32px;
        }
    }
    @media only screen and (max-width: 375px) {
        .chat-box .chat-menu.chat-menu-style {
            margin-left: 20px;
            border-right: 1px solid #f8f5fd !important;
            max-width: 382px;
        }
        .chat-box .people-list .search i.people_filter_i{
            font-size: 16px;
            right: -15px;
            top: 10px;
        }        .chat-box .people-list .search i.people_filter_i_close{
            font-size: 16px;
            right: -25px;
            top: 10px;
        }
        .people_search_div{
            margin-left: -10px;
        }
    }
    @media only screen and (max-width: 1660px){
        .call-chat-body .chat-box .people-list ul {
            max-height: 420px;
            overflow: auto;
        }
    }
    @media only screen and (max-width: 767px){
        .chat-box .chat-menu .people-list ul.list {
            max-height: 221px;            
            border-bottom: 1px solid #efefef;
            padding-bottom: 30px;
        }
    }
</style>
@endsection

@section('breadcrumb-title')
    <h2>People</h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}   
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" id="people_filter_dept_value" value="All">
                <input type="hidden" id="people_filter_design_value" value="All">
                <input type="hidden" id="people_filter_location_value" value="All">
            </div>
            <div class="col-lg-3 div_filter">
                <div class="card">
                    <h5 class="card-header people_filter_card_header">Apply Filter 
                        <!-- <button type="button" class="close div_close div_filter_close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     -->
                     <i class="icon-close font-dark div_filter_close"></i>                                               
                    </h5>
                    <div class="card-body">
                        <div class="row">   
                            <form id="peopleFilterForm">
                                <div class="col-lg-12"> 
                                    <select class="js-example-basic-single col-sm-12 mb-5" style="width:215px" id="people_filter_dept" name="people_filter_dept">
                                        <option value="All">Select Department...</option>                                              
                                        @foreach($departments as $department)
                                            <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-3">  
                                    <select class="js-example-basic-single col-sm-12 mb-5" style="width:215px" id="people_filter_design" name="people_filter_design">
                                        <option value="All">Select Designation...</option>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->designation_name }}">{{ $designation->designation_name }}</option>
                                        @endforeach      
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-3">  
                                    <select class="js-example-basic-single col-sm-12 mb-5" style="width:215px" id="people_filter_location" name="people_filter_location">
                                        <option value="All">Select Location...</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
                                        @endforeach      
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-3">  
                                    <button class="btn btn-primary mt-3" type="submit">Apply</button>
                                    <button class="btn btn-danger mt-3" id="people_filter_reset">Reset</button>
                                </div>  
                            </form>                                                                                      
                        </div>
                    </div>
                </div>               
            </div>
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pl-0 chat-menu chat-menu-style responsive-chat-menu">
                                <!-- chat start-->
                                <ul class="nav nav-tabs nav-material nav-primary" id="info-tab" role="tablist">
                                    <li class="nav-item" id="people_tab_li_1"><a class="nav-link active" id="info-home-tab" data-toggle="tab" href="#info-home" role="tab" aria-selected="true">Starred</a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item" id="people_tab_li_2"><a class="nav-link" id="profile-info-tab" data-toggle="tab" href="#info-profile" role="tab" aria-selected="false">Everyone</a>
                                        <div class="material-border"></div>
                                    </li>
                                </ul>
                                <div class="tab-content" id="info-tabContent">
                                    <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                        <div class="people-list">
                                            <div class="search people_search_div">
                                                <select class="js-example-basic-single col-sm-12 form-group people_list_filter" id="people_list_filter_starred" name="people_list_filter">
                                                    <option value="">Enter Emp. Name or ID...</option>
                                                    @foreach($customusers as $customuser)
                                                        <option value="{{ $customuser->empID }}">{{ $customuser->username }} (#{{ $customuser->empID }})</option>
                                                    @endforeach
                                                </select>
                                                <i class="icon-close font-primary people_filter_i_close" id="clearButtonStarred"  title="Clear Search Filter"></i>                                               
                                                <i class="icon-filter font-primary people_filter_i"></i>                                               
                                            </div>
                                            <ul class="list digits mt-3">
                                                <p id="people_starred_list_show"></p>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                                        <div class="people-list">
                                            <div class="search people_search_div">      
                                                <select class="js-example-basic-single col-sm-12 form-group people_list_filter" style="width:320px;" id="people_list_filter_everyone" name="people_list_filter">
                                                    <option value="">Enter Emp. Name or ID...</option>
                                                    @foreach($customusers as $customuser)                                                    
                                                        <option value="{{ $customuser->empID }}">{{ $customuser->username }} (#{{ $customuser->empID }})</option>
                                                    @endforeach
                                                </select>
                                                <!-- <input type="button" id="clearButton" value="X" /> -->

                                                <i class="icon-close font-primary people_filter_i_close" id="clearButton"  title="Clear Search Filter"></i>                                               
                                                <i class="icon-filter font-primary people_filter_i"></i>                                               
                                            </div>
                                            <ul class="list digits mt-3" id="people_list">
                                                <p id="people_everyone_list_show"></p>

                                               {{-- @foreach($customusers as $customuser)
                                                    <li class="clearfix people_list_ul_li" data-id="{{ $customuser->empID }}"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                        <div class="about">
                                                            <div class="name">{{ $customuser->username }} <small><span class="digits">(#{{ $customuser->empID }})</span></small></div>
                                                            <div class="status"><i class="fa fa-share font-success"></i>  {{ $customuser->designation }}</div>
                                                        </div>
                                                    </li>
                                                @endforeach --}}
                                            </ul>
                                        </div>                                
                                    </div>
                                    <div class="tab-pane fade" id="info-contact" role="tabpanel" aria-labelledby="contact-info-tab">
                                        <div class="user-profile">
                                            <div class="image">
                                            <div class="avatar text-center"><img alt="" src="../assets/images/user/1.jpg"></div>
                                            <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i></div>
                                            </div>
                                            <div class="user-content text-center">
                                            <h5 class="text-uppercase">mark jenco</h5>
                                            <div class="social-media">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>                                                
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="follow text-center">
                                                <div class="row">
                                                <div class="col border-right"><span>Following</span>
                                                    <div class="follow-num">236k</div>
                                                </div>
                                                <div class="col"><span>Follower</span>
                                                    <div class="follow-num">3691k</div>
                                                </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-center digits">
                                                <p class="mb-0">Mark.jecno23@gmail.com</p>
                                                <p class="mb-0">+91 365 - 658 - 1236</p>
                                                <p class="mb-0">Fax: 123-4560</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 chat-right-aside"> 
                                <!-- <img style="width:150px;" src="../assets/images/user/1.jpg" alt="">                                             -->
                                <div class="chat chat-boder-bottom">
                                    <!-- chat-header start-->
                                    <div class="chat-header clearfix"><p  id="people_show_img"></p>
                                        <div class="about people_name_show">
                                            <!-- <div class="name">Kori Thomas  <span class="font-primary f-12"><i class="icon-star"></i></span></div> -->
                                            <div class="name" style="font-size:20px;margin-top:10px:margin-left:10px;" id="people_name_show"></div>
                                            <!-- <div class="status digits">PHP Developer</div> -->
                                        </div>
                                        <ul class="list-inline float-left chat-menu-icons chat-menu-icons-star">
                                        <!-- <ul class="list-inline float-left float-sm-right chat-menu-icons"> -->
                                            <li class="list-inline-item" id="people_star_i_show"></li>
                                        </ul>
                                    </div>                                
                                </div> 
                                <div class="row mt-5" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Employee ID:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_empID_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Designation:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_designation_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Department:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_dept_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Contact Details:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_contact_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Email:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_email_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Work Location:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_wl_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Joining Date:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_doj_show"></p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Date Of Birth:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;" id="people_dob_show"></p>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 chat-right-aside-star text-center">
                                <div class="chat chat-star-empty_state">
                                    <?php $i=0; ?>
                                    <!-- chat-header start-->
                                    <div class="chat-header text-center clearfix"><img style="width:250px;" src="../assets/images/landing/starred-empty-state.svg" alt="">
                                        <div class="about">
                                            <!-- <div class="name">Kori Thomas  <span class="font-primary f-12"><i class="icon-star"></i></span></div> -->
                                            <div class="name" style="font-size:20px;margin-top:10px:margin-left:10px;" id="people_name_show"></div>
                                            <!-- <div class="status digits">PHP Developer</div> -->
                                        </div>
                                        <ul class="list-inline float-left float-sm-right chat-menu-icons">
                                            <li class="list-inline-item" id="people_star_i_show"></li>
                                        </ul>
                                    </div>                                
                                </div> 
                                <p>Hey, you haven't starred any peers!</p>
                            </div>
                            <div class="col pr-0 chat-right-aside-employees-empty text-center">
                                <div class="chat chat-star-empty_state">
                                    <?php $i=0; ?>
                                    <!-- chat-header start-->
                                    <div class="chat-header text-center clearfix"><img style="width:250px;" src="../assets/images/other-images/sad.png" alt="">
                                        <div class="about">
                                            <!-- <div class="name">Kori Thomas  <span class="font-primary f-12"><i class="icon-star"></i></span></div> -->
                                            <div class="name" style="font-size:20px;margin-top:10px:margin-left:10px;" id="people_name_show"></div>
                                            <!-- <div class="status digits">PHP Developer</div> -->
                                        </div>
                                        <ul class="list-inline float-left float-sm-right chat-menu-icons">
                                            <li class="list-inline-item" id="people_star_i_show"></li>
                                        </ul>
                                    </div>                                
                                </div> 
                                <p>Hey, you haven't any peers!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Container-fluid Ends-->
@endsection

@section('script')
<!-- Plugins JS start-->
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>
<script src="../assets/js/chat-menu.js"></script>
<script src="../assets/js/people.js"></script>    
@endsection

