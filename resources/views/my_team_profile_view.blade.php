@extends('layouts.simple.candidate_master')
@section('title', 'User Profile')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/photoswipe.css"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
 -->
  <!-- Datepicker -->
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<link rel="stylesheet" href="../assets/css/cropper.css"/>
<link rel="stylesheet" href="../assets/css/croppie.css"/>
<script src="../assets/js/cropper.js"></script>
<link href="../assets/css/select2.css" rel="stylesheet">
<link href="../assets/css/followup.css" rel="stylesheet">
<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>

@endsection

@section('style')
<style type="text/css">
img.test {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px;
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
.card .card-body
{
   padding: 10px !important;
}

.cr-boundary{
   width: 1089px !important;
}

.cr-vp-circle
{
   border-radius: inherit !important;
   width: 581px !important;
}
.select2
{
       width: 100% !important;
}
.pointer {cursor: pointer;}
.top-head {
    background-color: rgba(0,0,0,0.03) !important;
    padding: 28px !important;
}
.card .card-header .card-header-right {
    top: 19px !important;
}
.select2-container--open{
   z-index: 10000;
   width: 100% !important;
}
/*taginput*/
.label-info {
   font-weight: 400;
    line-height: 1.5;
   padding: 2px 6px !important;
    margin-top: 0 !important;
    background-color: #7e37d8 !important;
    border-color: #6524b8 !important;
    color: #fff;
    margin-right: 8px !important;
    border-radius: 4px !importanat;
    font-size: 14px !importanat;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left; 
}
.textboxes
{
   border-radius: 0px !important;
}


</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb-title')
  <h2>User<span>Profile</span></h2>
@endsection

@section('breadcrumb-items')
  <li class="breadcrumb-item">Apps</li>
    <li class="breadcrumb-item">Profile</li>
  <li class="breadcrumb-item active">My Profile</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="user-profile">
      <div class="row">
         <!-- user profile first-style start-->
         <div class="col-sm-12">
            <div class="card hovercard text-center">
               <div class="img-container">
                  <div class="my-gallery" id="aniimated-thumbnials" itemscope="">
                     <figure itemprop="associatedMedia" itemscope>
                        <a class="avatar" itemprop="contentUrl" data-size="1600x950"><img width="1300" height="330" class="img-fluid rounded" itemprop="thumbnail" alt="" id="banner_img"></a>
                     </figure>
                  </div>
               </div>
               <div class="user-image">
                  <div class="avatar slide">
                     <img id="profile_img" src="" >
                  </div>
               </div>
          
            <div class="text-center">
               <div class="info">
                  <div class="row">
                     <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-envelope"></i> Offical Email</h6>
                                 <div id="email"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-calendar"></i>   DOB</h6>
                                 <div id="dob"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                        <div class="user-designation">
                           <div class="title"><a target="_blank" id="pro_name" href=""></a></div>
                           <div class="desc mt-2" id="designation"></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-phone"></i>   Contact Us</h6>
                                 <span><a id="contact_no"></a></span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-location-arrow"></i>   Work Location</h6>
                                 <span><a id="worklocation"></a></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         </div>
         <!-- user profile first-style end-->
         <!-- user profile second-style start-->
         <div class="card col-xl-2 shadow-lg p-3 mb-5 bg-white rounded">
               <svg x="0" y="0" viewBox="0 0 360 220">
                  <g>
                     <path fill="#7e37d8" d="M0.732,193.75c0,0,29.706,28.572,43.736-4.512c12.976-30.599,37.005-27.589,44.983-7.061                                          c8.09,20.815,22.83,41.034,48.324,27.781c21.875-11.372,46.499,4.066,49.155,5.591c6.242,3.586,28.729,7.626,38.246-14.243                                          s27.202-37.185,46.917-8.488c19.715,28.693,38.687,13.116,46.502,4.832c7.817-8.282,27.386-15.906,41.405,6.294V0H0.48                                          L0.732,193.75z"></path>
                  </g>
                  <text transform="matrix(1 0 0 1 69.7256 116.2686)" fill="#fff" font-size="30"></text>
               </svg>
               <div class="col-sm-3 tabs-responsive-side">
                  <div class="nav flex-column nav-pills nav-material nav-left text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Basic Details</a>
                     <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Contact</a>
                     <a class="nav-link" id="v-pills-Working-Information-tab" data-toggle="pill" href="#v-pills-Working-Information" role="tab" aria-controls="v-pills-Working-Information" aria-selected="false">Working Information</a>
                     <a class="nav-link" id="v-pills-Information-tab" data-toggle="pill" href="#v-pills-Information" role="tab" aria-controls="v-pills-Information" aria-selected="false">HR Information</a>
                     <a class="nav-link" id="v-pills-Account-information-tab" data-toggle="pill" href="#v-pills-Account-information" role="tab" aria-controls="v-pills-Account-information" aria-selected="false">Account Information</a>
                     <a class="nav-link" id="v-pills-Education-tab" data-toggle="pill" href="#v-pills-Education" role="tab" aria-controls="v-pills-Education" aria-selected="false">Education</a>
                     <a class="nav-link" id="v-pills-Experience-tab" data-toggle="pill" href="#v-pills-Experience" role="tab" aria-controls="v-pills-Experience" aria-selected="false">Experience</a>
                     <a class="nav-link" id="v-pills-Documents-tab" data-toggle="pill" href="#v-pills-Documents" role="tab" aria-controls="v-pills-Documents" aria-selected="false">Other Documents</a>
                     <a class="nav-link" id="v-pills-Family-tab" data-toggle="pill" href="#v-pills-Family" role="tab" aria-controls="v-pills-Family" aria-selected="false">Family</a>
                     <a class="nav-link" id="v-pills-followup-tab" data-toggle="pill" href="#v-pills-followup" role="tab" aria-controls="v-pills-followup" aria-selected="false">Follow Up</a>

                  </div>
                  <br>
               </div>

         </div>
         <div class="card col-xl-9 shadow-lg p-3 mb-5 bg-white rounded">
            <div class="col-sm-12">
               <!-- profile -->
               <div class="tab-content" id="v-pills-tabContent" role="tabpanel">
                  <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1" style="color:white;">Basic Details</span>
                     </nav>
                     <br>
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12">
                              <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                 <div class="card-header no-border d-flex">
                                   <ul class="creative-dots">
                                      <li class="bg-primary big-dot"></li>
                                      <li class="bg-secondary semi-big-dot"></li>
                                      <li class="bg-warning medium-dot"></li>
                                      <li class="bg-info semi-medium-dot"></li>
                                      <li class="bg-secondary semi-small-dot"></li>
                                      <li class="bg-primary small-dot"></li>
                                   </ul>
                                </div>
                                 <div class="card-body rounded">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div> <strong>Name : </strong>  <a id="can_name"></a></div><hr>
                                          <div> <strong>Gender : </strong> <a id="gender"></a></div><hr>
                                          <div> <strong>Preferred Date of Birth : </strong> <a id="sec_bb_day"></a></div><hr>
                                          <div> <strong>Place of Birth : </strong> <a id="birth_place_txt"></a></div><hr>
                                          <div> <strong>Secondary Skill : </strong> <a id="skill_secondary_tx"></a></div><hr>
                                          <div> <strong>Primary Skill : </strong> <a id="skill_txt"></a></div><hr>
                                          <div> <strong>Height : </strong> <a id="height_can_txt"></a></div><hr>
                                          <div> <strong>Identification Mark : </strong> <a id="identification_can_txt"></a></div><hr>
                                          <div> <strong>Aadhar Number : </strong> <a id="aadhar_number_txt"></a></div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div> <strong>Blood Group : </strong> <a id="blood_grp"></a>
                                          </div><hr>
                                          <div> <strong>Certified Date of Birth : </strong> <a id="dob_tx"></a>
                                          </div><hr>
                                          <div> <strong>Age : </strong> <a id="age_can_txt"></a>
                                          </div><hr>
                                          <div> <strong>Religion : </strong> <a id="religion_can_txt"></a>
                                          </div><hr>
                                          <div> <strong>Marital Status : </strong> <a id="marital_status_tx"></a></div><hr>
                                          <div> <strong>Language Know's : </strong> <a id="language_text"></a></div><hr>
                                          <div> <strong>Weight : </strong> <a id="weight_can_txt"></a> Kg's</div><hr>
                                          <div> <strong>Habits : </strong> <a id="habits_status_txt"></a> </div><hr>
                                          <div> <strong>PAN Number : </strong> <a id="pan_number_txt"></a> </div><hr>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- contact -->
               <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1" style="color:white;">Contact</span>
                     </nav>
                     <br>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-xl-12">
                           <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                              <div class="card-header no-border d-flex">
                                   <ul class="creative-dots">
                                      <li class="bg-primary big-dot"></li>
                                      <li class="bg-secondary semi-big-dot"></li>
                                      <li class="bg-warning medium-dot"></li>
                                      <li class="bg-info semi-medium-dot"></li>
                                      <li class="bg-secondary semi-small-dot"></li>
                                      <li class="bg-primary small-dot"></li>
                                   </ul>
                                </div>
                              <div class="card-body rounded">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div><strong>Phone Number :</strong> <p id="p_num_view"></p></div><hr>
                                       <div><strong>Permanent Address :</strong> <p id="p_addres_view"></p></div><hr>
                                       <div><strong>Personal Email :</strong> <p id="p_email_view"></p></div><hr>
                                    </div>
                                    <div class="col-md-6">

                                       <div><strong>Secondary Number :</strong> <p id="s_num_view"></p></div><hr>
                                       <div><strong>Current Address :</strong> <p id="c_addres_view"></p></div><hr>
                                       <!-- <div><strong>State :</strong> <a id="State_view"></a></div><hr> -->
                                       </div><hr>
                                    </div>
                                 </div>
                                 <!--  <div class="col-md-3"><strong>Phone Number </div><div class="col-md-3"> </strong> 987654321</div> -->
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- Working-Information -->
               <div class="tab-pane fade" id="v-pills-Working-Information" role="tabpanel" aria-labelledby="v-pills-Working-Information">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Working Information</span>
                  </nav>
                  <br>
                  <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12">
                              <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                 <div class="card-header no-border d-flex">
                                   <ul class="creative-dots">
                                      <li class="bg-primary big-dot"></li>
                                      <li class="bg-secondary semi-big-dot"></li>
                                      <li class="bg-warning medium-dot"></li>
                                      <li class="bg-info semi-medium-dot"></li>
                                      <li class="bg-secondary semi-small-dot"></li>
                                      <li class="bg-primary small-dot"></li>
                                   </ul>
                                </div>
                                 <div class="card-body rounded">
                                    <div class="row">
                                       <div class="col-md-6">
                                         <div><strong>Department : </strong> <a id="department"></a></div><hr>
                                         
                                          <div><strong>Work Location : </strong> <a id="worklocation_tx"></a></div><hr>
                                           <div> <strong>Roll of Intake : </strong> <a id="payroll_status"></a></div><hr>
                                           <div><strong>Grade : </strong> <a id="grade"> </a></div><hr>
                                          <div><strong>Experience in Hema's : </strong> <a id="diff_date_tx"></a></div><hr>
                                       </div>
                                       <div class="col-md-6">
                                           <div><strong>Designation : </strong> <a id="designation_tx"></a></div><hr>
                                           <div><strong>Date Of Joining : </strong> <a id="doj"></a></div><hr>
                                          <div><strong>CTC : </strong> <a id="ctc_txt"></a> </div><hr>
                                          <div><strong>RFH : </strong> -</div><hr>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- HR Information -->
               <div class="tab-pane fade" id="v-pills-Information" role="tabpanel" aria-labelledby="v-pills-Information-tab">
                   <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">HR Information</span>
                  </nav>
                  <br>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-xl-12">
                           <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                              <div class="card-header no-border d-flex">
                                   <ul class="creative-dots">
                                      <li class="bg-primary big-dot"></li>
                                      <li class="bg-secondary semi-big-dot"></li>
                                      <li class="bg-warning medium-dot"></li>
                                      <li class="bg-info semi-medium-dot"></li>
                                      <li class="bg-secondary semi-small-dot"></li>
                                      <li class="bg-primary small-dot"></li>
                                   </ul>
                                </div>
                              <div class="card-body rounded">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div><strong> Recruiter : </strong> <a id="HR_Recruiter"></a> </div> <hr>
                                        <div><strong> Onboarder : </strong> <a id="HR_on_boarder"></a> </div><hr>
                                    </div>
                                    <div class="col-md-6">
                                       <div><strong>Reporting Manager : </strong> <a id="sup_name"></a></div> <hr>
                                       <div><strong>Reviewer : </strong> <a id="reviewer_name"></a></div><hr>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- Account information -->
               <div class="tab-pane fade" id="v-pills-Account-information" role="tabpanel" aria-labelledby="v-pills-Account-information-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Account Information</span>
                  </nav>
                  <br>
                  <!-- Individual column searching (text inputs) Starts-->
                   <div class="col-sm-12 col-xl-12">
                           <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                              <div class="card-header no-border d-flex">
                                   <ul class="creative-dots">
                                      <li class="bg-primary big-dot"></li>
                                      <li class="bg-secondary semi-big-dot"></li>
                                      <li class="bg-warning medium-dot"></li>
                                      <li class="bg-info semi-medium-dot"></li>
                                      <li class="bg-secondary semi-small-dot"></li>
                                      <li class="bg-primary small-dot"></li>
                                   </ul>
                                </div>
                        <div class="card-body rounded">
                           <div class="row">
                              <div class="col-md-6">
                                  <div><strong>Account Holder name : </strong><a id="acc_name"></a> </div> <hr>
                                  <div><strong>Bank Name : </strong> <a id="bank_name"></a> </div><hr>
                                  <div><strong>Branch Name : </strong> <a id="branch_name"></a> </div><hr>
                                  <div><strong>UAN Number/PF Number : </strong> <a id="uan_num"></a> </div><hr>
                              </div>
                              <div class="col-md-6">
                                 <div><strong>Account Number : </strong> <a id="acc_number"></a></div> <hr>
                                 <div><strong>IFSC Code : </strong> <a id="ifsc_code"></a></div><hr>
                                 <div><strong>UPI ID : </strong> <a id="upi_id"></a></div><hr>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Education -->
               <div class="tab-pane fade" id="v-pills-Education" role="tabpanel" aria-labelledby="v-pills-Education-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Education Information</span>
                  </nav>
                  <br>
                    <div class="card-body">
                        <div class="employee-office-table">
                            <div class="table-responsive">
                            <table class="table custom-table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>Course</th>
                                        <th>University</th>
                                        <th>Begin On</th>
                                        <th>End On</th>
                                        <th>Percentage</th>
                                        <th>Certificate</th>
                                    </tr>
                                </thead>
                                <tbody id="education_td_hr">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
               </div>
               <!-- Experience -->
               <div class="tab-pane fade" id="v-pills-Experience" role="tabpanel" aria-labelledby="v-pills-Experience-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Experience</span>
                  </nav>
                  <br>
                  <div class="ctm-border-radius shadow-sm card">
                     <div id="Experience_tbl">
                     </div>
                  </div>
               </div>
               <!-- Other Documents -->
               <div class="tab-pane fade" id="v-pills-Documents" role="tabpanel" aria-labelledby="v-pills-Documents-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Other Documents</span>
                  </nav>
                  <br>
                     <!-- <div id="testing">
                     </div> -->
                  <div class='card-body'> 
                     <div class='row people-grid-row'> 
                        <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Passport Photo</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="passport_photo_data" href="" class="btn btn-primary" target =_blank>Preview</a>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Resume</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="Resume_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                        <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Payslips</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="preview_data" href="" class="btn btn-primary"  target =_blank>Preview</a></h5>
                                <!-- <div class="avatar slide_pay">
                                    <button id="payslip_remove" class="btn btn-danger icofont icofont-delete-alt-5" style="display:none;"><i class="icofont icofont-animal-bird-alt"></i></button>
                                 </div> -->
                                </div>  
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Relieving Letter</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="Relieving_letter_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Vaccination</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="Vaccination_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Bank Passbook</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="bank_passbook_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Blood Groop Proof</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="blood_grp_proof_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Date of Birth Proof</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="dob_proof_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>PAN</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="pan_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Aadhaar Card</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="aadhaar_card_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                       <div class='col-md-3 col-lg-3 col-xl-4'> 
                           <div class='card'> 
                             <div class='card-header top-head'> 
                              <h5>Signature</h5>
                                <div class="card-header-right">
                                <i class="fa fa-clipboard"></i>
                                </div> 
                             </div> 
                                <div class="card-body">
                                <div class="col-md-12 text-center">
                                <h5><a id="signature_data" href="" class="btn btn-primary" target =_blank>Preview</a></h5>
                                </div> 
                              </div> 
                          </div> 
                       </div>
                    </div> 
                  </div>
               </div>
               <!-- Family -->
               <div class="tab-pane fade" id="v-pills-Family" role="tabpanel" aria-labelledby="v-pills-Family-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Family</span>
                  </nav>
                  <br>
                  <div class="card-body">
                        <div class="employee-office-table">
                            <div class="table-responsive">
                            <table class="table custom-table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Names</th>
                                        <th>Gender</th>
                                        <th>Relationship</th>
                                        <th>Marital Status</th>
                                        <th>Blood Group</th>
                                    </tr>
                                </thead>
                                <tbody id="family_td">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
               </div>
               <!-- Followup -->
               <div class="tab-pane fade" id="v-pills-followup" role="tabpanel" aria-labelledby="v-pills-followup-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Followup</span>
                  </nav>
                  <br>
                  <!-- The Timeline -->
                  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
                  <div id="timeline_data">
                  </div>
                  <!--  -->
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
 

<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
 <script src="../assets/js/counter/jquery.counterup.min.js"></script>
 <script src="../assets/js/counter/counter-custom.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe-ui-default.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.js"></script>
 <script src="../assets/js/croppie.js"></script>
 <!-- custom js -->
 <script src="../pro_js/my_team_profile_view.js"></script>
<!-- Datepicker -->
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src='../assets/js/select2/select2.full.min.js'></script>
<script src='../assets/js/select2/select2-custom.js'></script>
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>
 <script type="text/javascript">
   /*state list*/
  var my_team_profile = "{{url('my_team_profile')}}";
  var Contact_info_view_myteam_link = "{{url('Contact_info_view_myteam')}}";
  var my_team_account_info_link = "{{url('my_team_account_info')}}";
  var my_team_experience_info_link = "{{url('my_team_experience_info_profile')}}";
  var documents_info_link = "{{url('documents_info_pro')}}";
  var my_team_family_information_get_link = "{{url('my_team_family_information')}}";
  var my_team_followup_information_link = "{{url('my_team_followup_information')}}";
  var my_team_education_information_get_link = "{{url('my_team_education_info_view')}}";



 </script>
@endsection
