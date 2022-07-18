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
                      <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5 pointer" data-toggle="modal" data-original-title="test"  data-target="#exampleModal"></i></div>
                     <figure itemprop="associatedMedia" itemscope>
                        <!-- <a href="../assets/images/other-images/profile-style-img3.png" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid rounded" src="../assets/images/other-images/profile-style-img3.png" itemprop="thumbnail" alt="gallery"></a> -->
                        <a class="avatar" itemprop="contentUrl" data-size="1600x950"><img width="1300" height="330" class="img-fluid rounded" itemprop="thumbnail" alt="" id="banner_img"></a>
                        <!-- <div class="avatar" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid rounded" itemprop="thumbnail" alt="" id="banner_img" src=""></div> -->
                     </figure>
                  </div>
               </div>
               <div class="user-image">
                  <div class="avatar slide" title="Delete">
                     <img id="profile_img" src="" >
                     <button id="del" class="icofont icofont-delete-alt-5" style="display:none;"><i class="icofont icofont-basket" ></i></button>
                  </div>
                  <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-original-title="test" data-target="#profile_image"></i></div>
               </div>
            <!-- Pop-up banner starts-->
            <div class="modal fade banner_ji" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                     <div class="card">
                        <div class="container">
                           <div class="panel panel-default">
                             <div class="panel-heading"> Crop Banner Image</div>
                             <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-4 text-center">
                                    <div id="upload-demo" itemprop="contentUrl" data-size="1600x950"></div>
                                 </div>
                              </div>
                              <div>
                                 <strong>Select Image:</strong>
                                    <input type="file" class="img-fluid rounded" itemprop="thumbnail" id="upload" accept=".jpeg,.jpg,.png,.GIF,.JPEG,.JPG,.PNG" name="upload">
                                    <button class="btn btn-success upload-result">Upload Image</button>
                              </div>
                                    <span class="text-danger color-hider" id="upload_error" style="display:none;color: red;"></span>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                             </div>
                           </div>
                        </div>

                     </div>

                  </div>
               </div>
            </div>
            <!-- Pop-up div Ends-->
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

                  </div>
                  <br>
               </div>

         </div>
         <div class="card col-xl-9 shadow-lg p-3 mb-5 bg-white rounded">
            <div class="col-sm-12">
               <!-- profile -->
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1" style="color:white;">Basic Details</span>
                       <button id="profile_but" class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#skillModal">+ Update Info </button>
                       <!-- <button id="profile_but" class="btn btn-success" type="button"  data-original-title="test" >+ Update Info </button> -->
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
                              <!-- Pop-up div starts-->
                                 <div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
                                     <div class="modal-dialog  modal-lg" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="skillModalLabel">Add Basic Details</h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           </div>
                                             <form method="POST" action="javascript:void(0)" id="add_profile_info" class="ajax-form" enctype="multipart/form-data">
                                               <div class="modal-body">
                                                   <div class="form-row">
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="First Name">First Name *</label>
                                                            <input class="form-control alpha" name="username" id="username" type="text" placeholder="First Name" >
                                                         <span class="text-danger color-hider" id="username_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Middle Name">Middle Name</label>
                                                            <input class="form-control alpha" name="middle_name" id="middle_name" type="text" placeholder="Middle Name" >
                                                         <span class="text-danger color-hider" id="middle_name_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Last Name">Last Name *</label>
                                                            <input class="form-control alpha" name="last_name" id="last_name" type="text" placeholder="Last Name" >
                                                         <span class="text-danger color-hider" id="last_name_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Blood Group">Blood Group *</label>
                                                            <select class="form-control" id="blood_gr" name="blood_gr" >
                                                                  <option value="">-Select Blood Group-</option>
                                                                  <option value="A+">A+</option><option value="A-">A-</option>
                                                                  <option value="B+">B+</option><option value="B-">B-</option>
                                                                  <option value="O+">O+</option><option value="O-">O-</option>
                                                                  <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                                                  </select>
                                                         <span class="text-danger color-hider" id="blood_gr_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Gender">Gender *</label>
                                                           <select class="form-control" name="gender_emp" id="gender_emp">
                                                               <option value="">-Select Gender-</option>
                                                               <option value="Male">Male</option>
                                                               <option value="Female">Female</option>
                                                               <option value="Other">other</option>
                                                            </select>
                                                         <span class="text-danger color-hider" id="gender_emp_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="DOB">Certified Date of Birth *</label>
                                                           <input class="form-control" type="date" name="dob_emp" id="dob_emp">
                                                         <span class="text-danger color-hider" id="dob_emp_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="DOB">Preferred Date of Birth </label>
                                                           <input class="form-control" type="date" name="sec_dob_emp" id="sec_dob_emp">
                                                         <span class="text-danger color-hider" id="dob_emp_error"  style="display:none;color: red;"></span>
                                                      </div>

                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Marital Status">Marital Status *</label>
                                                           <select class="form-control" name="marital_status" id="marital_status">
                                                                <option value="">-Select Marital Status-</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                                <option value="Separated">Separated</option>
                                                                <option value="Divorced">Divorced</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                         <span class="text-danger color-hider" id="marital_status_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="Marital Status">Age *</label>
                                                          <!-- <input class="form-control" type="text" name="age_can" id="age_can" onkeypress="return isNumber(event)" maxlength="3"> -->
                                                          <input class="form-control" type="text" name="age_can" id="age_can" >
                                                         <span class="text-danger color-hider" id="age_can_error"  style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="religion can">Place of Birth</label>
                                                          <input class="form-control alpha" type="text" name="place_birth_can" id="place_birth_can" >
                                                         <span class="text-danger color-hider" id="place_birth_can_error" style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="religion can">Religion *</label>
                                                          <!-- <input class="form-control" type="text" name="religion_can" id="religion_can" > -->
                                                          <select class="form-control dropdown" id="religion_can" name="religion_can">
                                                             <option value="" selected="selected" disabled="disabled">-- Select Religion --</option>
                                                             <option value="prefer not to say">Prefer not to Say</option>
                                                             <option value="African Traditional &amp; Diasporic">African Traditional &amp; Diasporic</option>
                                                             <option value="Agnostic">Agnostic</option>
                                                             <option value="Atheist">Atheist</option>
                                                             <option value="Baha'i">Baha'i</option>
                                                             <option value="Buddhism">Buddhism</option>
                                                             <option value="Cao Dai">Cao Dai</option>
                                                             <option value="Chinese traditional religion">Chinese traditional religion</option>
                                                             <option value="Christianity">Christianity</option>
                                                             <option value="Hinduism">Hinduism</option>
                                                             <option value="Islam">Islam</option>
                                                             <option value="Jainism">Jainism</option>
                                                             <option value="Juche">Juche</option>
                                                             <option value="Judaism">Judaism</option>
                                                             <option value="Neo-Paganism">Neo-Paganism</option>
                                                             <option value="Nonreligious">Nonreligious</option>
                                                             <option value="Rastafarianism">Rastafarianism</option>
                                                             <option value="Secular">Secular</option>
                                                             <option value="Shinto">Shinto</option>
                                                             <option value="Sikhism">Sikhism</option>
                                                             <option value="Spiritism">Spiritism</option>
                                                             <option value="Tenrikyo">Tenrikyo</option>
                                                             <option value="Unitarian-Universalism">Unitarian-Universalism</option>
                                                             <option value="Zoroastrianism">Zoroastrianism</option>
                                                             <option value="primal-indigenous">primal-indigenous</option>
                                                             <option value="Other">Other</option>
                                                           </select>
                                                         <span class="text-danger color-hider" id="religion_can_error" style="display:none;color: red;"></span>
                                                      </div>
                                                       <div class="col-sm-4 mb-3">
                                                        <label for="Habits">Habits</label>
                                                          <select class="form-control" name="habits_status" id="habits_status">
                                                             <option value="">-Select Habits-</option>
                                                             <option value="prefer not to say">Prefer not to Say</option>
                                                             <option value="Smokers">Smokers</option>
                                                             <option value="Non-smokers">Non-smokers</option>
                                                         </select>
                                                         <span class="text-danger color-hider" id="specially_status_error" style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="aadhar_number">Aadhar Card Number *</label>
                                                          <input class="form-control" type="text" name="aadhar_number" maxlength="12" onkeypress="return isNumber(event)" id="aadhar_number" >
                                                         <span class="text-danger color-hider" id="aadhar_number_error" style="display:none;color: red;"></span>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                        <label for="religion can">PAN Number *</label>
                                                          <input class="form-control" type="text" name="pan_number" id="pan_number" >
                                                         <span class="text-danger color-hider" id="pan_number_error" style="display:none;color: red;"></span>
                                                      </div>
                                                      <hr style="width:100%;text-align:left;margin-left:0">
                                                       <div class="examples col-sm-4 mb-3 ">
                                                         <div class="container">
                                                            <div class="form-group">
                                                               <label for="">Primary Skill *</label>
                                                               <div class="bs-example">
                                                                  <input type="text" name="skill[]"  id="skill" value=""  data-role="tagsinput">
                                                                  <span class="text-danger color-hider" id="skill_error"  style="display:none;color: red;"></span>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="examples col-sm-4 mb-3 ">
                                                         <div class="container">
                                                            <div class="form-group">
                                                               <label for="">Secondary Skill</label>
                                                               <div class="bs-example">
                                                                  <input type="text" name="skill_secondary[]"  id="skill_secondary" value=""  data-role="tagsinput">
                                                                  <span class="text-danger color-hider" id="skill_secondary_error"  style="display:none;color: red;"></span>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-4 mb-3">
                                                         <div class="col-form-label">Language Know's *</div>
                                                         <div class="form-group">
                                                            <select  name="language[]" id="language" class="js-example-basic-multiple form-control" id="" multiple="multiple">
                                                                 <option value="">..Choose a Language..</option>
                                                                 <option value="Afrikaans">Afrikaans</option>
                                                                 <option value="Albanian">Albanian</option>
                                                                 <option value="Arabic">Arabic</option>
                                                                 <option value="Armenian">Armenian</option>
                                                                 <option value="Basque">Basque</option>
                                                                 <option value="Bengali">Bengali</option>
                                                                 <option value="Bulgarian">Bulgarian</option>
                                                                 <option value="Catalan">Catalan</option>
                                                                 <option value="Cambodian">Cambodian</option>
                                                                 <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                                                 <option value="Croatian">Croatian</option>
                                                                 <option value="Czech">Czech</option>
                                                                 <option value="Danish">Danish</option>
                                                                 <option value="Dutch">Dutch</option>
                                                                 <option value="English">English</option>
                                                                 <option value="Estonian">Estonian</option>
                                                                 <option value="Fiji">Fiji</option>
                                                                 <option value="Finnish">Finnish</option>
                                                                 <option value="French">French</option>
                                                                 <option value="Georgian">Georgian</option>
                                                                 <option value="German">German</option>
                                                                 <option value="Greek">Greek</option>
                                                                 <option value="Gujarati">Gujarati</option>
                                                                 <option value="Hebrew">Hebrew</option>
                                                                 <option value="Hindi">Hindi</option>
                                                                 <option value="Hungarian">Hungarian</option>
                                                                 <option value="Icelandic">Icelandic</option>
                                                                 <option value="Indonesian">Indonesian</option>
                                                                 <option value="Irish">Irish</option>
                                                                 <option value="Italian">Italian</option>
                                                                 <option value="Japanese">Japanese</option>
                                                                 <option value="Javanese">Javanese</option>
                                                                 <option value="Korean">Korean</option>
                                                                 <option value="Latin">Latin</option>
                                                                 <option value="Latvian">Latvian</option>
                                                                 <option value="Lithuanian">Lithuanian</option>
                                                                 <option value="Macedonian">Macedonian</option>
                                                                 <option value="Malay">Malay</option>
                                                                 <option value="Malayalam">Malayalam</option>
                                                                 <option value="Maltese">Maltese</option>
                                                                 <option value="Maori">Maori</option>
                                                                 <option value="Marathi">Marathi</option>
                                                                 <option value="Mongolian">Mongolian</option>
                                                                 <option value="Nepali">Nepali</option>
                                                                 <option value="Norwegian">Norwegian</option>
                                                                 <option value="Persian">Persian</option>
                                                                 <option value="Polish">Polish</option>
                                                                 <option value="Portuguese">Portuguese</option>
                                                                 <option value="Punjabi">Punjabi</option>
                                                                 <option value="Quechua">Quechua</option>
                                                                 <option value="Romanian">Romanian</option>
                                                                 <option value="Russian">Russian</option>
                                                                 <option value="Samoan">Samoan</option>
                                                                 <option value="Serbian">Serbian</option>
                                                                 <option value="Slovak">Slovak</option>
                                                                 <option value="Slovenian">Slovenian</option>
                                                                 <option value="Spanish">Spanish</option>
                                                                 <option value="Swahili">Swahili</option>
                                                                 <option value="Swedish ">Swedish </option>
                                                                 <option value="Tamil">Tamil</option>
                                                                 <option value="Tatar">Tatar</option>
                                                                 <option value="Telugu">Telugu</option>
                                                                 <option value="Thai">Thai</option>
                                                                 <option value="Tibetan">Tibetan</option>
                                                                 <option value="Tonga">Tonga</option>
                                                                 <option value="Turkish">Turkish</option>
                                                                 <option value="Ukrainian">Ukrainian</option>
                                                                 <option value="Urdu">Urdu</option>
                                                                 <option value="Uzbek">Uzbek</option>
                                                                 <option value="Vietnamese">Vietnamese</option>
                                                                 <option value="Welsh">Welsh</option>
                                                                 <option value="Xhosa">Xhosa</option>
                                                            </select>
                                                            <span class="text-danger color-hider" id="language_error"  style="display:none;color: red;"></span>
                                                         </div>
                                                      </div>
                                                      <hr style="margin-top: -21px;width:100%;text-align:left;margin-left:0">
                                                      <div class="examples col-sm-4 mb-3 ">
                                                         <div class="container">
                                                            <div class="form-group">
                                                               <label for="">Height</label>
                                                               <div class="bs-example">
                                                                  <input type="text" name="height_can"  id="height_can" maxlength="4"  class="form-control">
                                                                  <span class="text-danger color-hider" id="height_can_error"  style="display:none;color: red;"></span>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="examples col-sm-4 mb-3 ">
                                                         <div class="container">
                                                            <div class="form-group">
                                                               <label for="">Weight</label>
                                                               <div class="bs-example">
                                                                  <input type="text" onkeypress="return isNumber(event)" name="weight_can"  id="weight_can" value="" class="form-control ">
                                                                  <span class="text-danger color-hider" id="height_can_error"  style="display:none;color: red;"></span>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="examples col-sm-4 mb-3 ">
                                                         <div class="container">
                                                            <div class="form-group">
                                                               <label for="">Identification mark</label>
                                                               <input type="text" name="identification_can"  id="identification_can" class="form-control ">
                                                               <span class="text-danger color-hider" id="identification_can_error"  style="display:none;color: red;"></span>
                                                            </div>
                                                         </div>
                                                      </div>

                                                   </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                                   <button class="btn btn-secondary" type="submit" id="skill_Submit">Update</button>
                                               </div>
                                             </form>
                                       </div>
                                     </div>
                                 </div>
                  <!-- Pop-up div Ends-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- contact -->
               <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1" style="color:white;">Contact</span>
                       <button class="btn btn-success" type="button" onclick="Contact_information()" data-toggle="modal" data-original-title="test" data-target="#ContactModal">+ Add Contact</button>
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
                       <!-- Pop-up div starts-->
                  <div class="modal fade" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <!-- <div class="modal-content" style="margin-left: -28%;width: 166%;"> -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_contact_info" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-6 mb-3">
                                            <label for="phone_number">Phone Number *</label>
                                            <input class="form-control" maxlength="10" name="phone_number" id="phone_number" type="text" placeholder="Phone Number" >
                                            <span class="text-danger color-hider" id="phone_number_error"  style="display:none;color: red;"></span>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="s_number">Secondary Number</label>
                                            <input class="form-control" maxlength="10" name="s_number" id="s_number" type="text" placeholder="Secondary Number" >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="p_email">Personal Email *</label>
                                            <input class="form-control" name="p_email" id="p_email" type="email" placeholder="Email">
                                           <span class="text-danger color-hider" id="p_email_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          
                                        </div>
                                       <div class="col-md-6 mb-3">
                                          <label for="p_email">Permanent Address *</label>
                                        <textarea class="custom-select"  type="text" id="p_addres" name="p_addres" size="35" ></textarea>
                                          <span class="text-danger color-hider" id="p_addres_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          <label for="p_email">Present Address *</label>
                                          <textarea class="custom-select"  type="text" id="c_addres" name="c_addres" size="35" ></textarea>
                                          <span class="text-danger color-hider" id="c_addres_error"  style="display:none;color: red;"></span>
                                       </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="p_State">Permanent State *</label>
                                            <select name="p_State" id="p_State" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="p_State_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-md-6 mb-3">
                                         <label for="c_State"> Present State *</label>
                                         <select name="c_State" id="c_State" class="custom-select">
                                               <option value="">--Select--</option>
                                          </select>
                                       <span class="text-danger color-hider" id="c_State_error"  style="display:none;color: red;"></span>
                                       </div>
                                         <div class="col-md-6 mb-3">
                                            <label for="p_district">Permanent District *</label>
                                            <select name="p_district" id="p_district" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="p_district_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="c_district">Present District *</label>
                                            <select name="c_district" id="c_district" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="c_district_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                         <label for="p_town">Permanent Town *</label>
                                         <select name="p_town" id="p_town" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                         <span class="text-danger color-hider" id="p_town_error"  style="display:none;color: red;"></span>
                                       </div>
                                      
                                        <div class="col-md-6 mb-3">
                                          <label for="c_town">Present Town *</label>
                                          <select name="c_town" id="c_town" class="custom-select">
                                          <option value="">--Select--</option>
                                          </select>
                                       <span class="text-danger color-hider" id="c_town_error"  style="display:none;color: red;"></span>
                                       </div>
                                        <div class="col-md-6 mb-3">
                                          <label for="p_pin">Permanent Pin/Zip code *</label>
                                          <input name="p_pin" id="p_pin" placeholder="Pin/Zip code" onkeypress="return isNumber(event)" class="form-control" maxlength="6">
                                          </input>
                                       <span class="text-danger color-hider" id="p_pin_error"  style="display:none;color: red;"></span>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <label for="c_pin">Present Pin/Zip code *</label>
                                          <input name="c_pin" placeholder="Pin/Zip code" onkeypress="return isNumber(event)" id="c_pin" class="form-control" maxlength="6">
                                          </input>
                                       <span class="text-danger color-hider" id="c_pin_error"  style="display:none;color: red;"></span>
                                       </div>
                                       <div>
                                          <input id="sameadd" name="sameadd" type="checkbox" value="Sameadd" onchange="CopyAdd();"/>  Click to Clone the Address
                                          <p id="text" style="display:none;color: green;">Address is Cloned...</p>
                                       </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" id="cont_Save" type="btnSubmit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  <!-- Pop-up div Ends-->
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
                    <span class="navbar-brand mb-0 h1" style="color:white;">Account Information</span>
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
                  <div class="card-body">
                     <form class="theme-form row" method="POST" action="javascript:void(0)" id="add_account_info" enctype="multipart/form-data">
                        <div class="form-group col-6">
                           <label for="Account number">Account Holder Name *</label>
                           <input class="form-control textboxes" type="text" name="acc_name" id="acc_name" placeholder="AC Holder name">
                             <span class="text-danger color-hider" id="acc_name_error"  style="display:none;color: red;"></span>
                        </div>
                       <div class="form-group col-6">
                        <label for="Select Bank">Select Bank  *</label>
                           <select class="custom-select textboxes" id="bank_name"  name="bank_name">
                              <option value="">--Select Bank--</option>
                              <option value="SBI">SBI</option>
                              <option value="AXIS">AXIS</option>
                              <option value="UCO">UCO</option>
                              <option value="CBI">CBI</option>
                              <option value="UBI">UBI</option>
                              <option value="ICICI">ICICI</option>
                              <option value="KVB">KVB</option>
                              <option value="HDFC">HDFC</option>

                              <!-- <option>PUVATHA BANK</option> -->
                           </select>
                           <span class="text-danger color-hider" id="bank_name_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Account number">Account Number  *</label>
                           <input class="form-control textboxes" type="text"  maxlength="16"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"  name="acc_number" id="acc_number" onkeypress="return isNumber(event)" placeholder="Account number">
                           <span class="text-danger color-hider" id="acc_number_error" style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Confirm Account number">Confirm Account Number  *</label>
                           <input class="form-control textboxes" type="text" maxlength="16"  onCopy="return false" onDrag="return false" onkeypress="return isNumber(event)" onDrop="return false" onPaste="return false"  name="con_acc_number" id="con_acc_number" placeholder="Confirm Account number">
                           <span class="text-danger color-hider" id="con_acc_number_error" style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Due By">IFSC code *</label>
                           <input class="form-control textboxes" name="ifsc_code" maxlength="12" id="ifsc_code" type="text" placeholder="IFSC code">
                           <span class="text-danger color-hider" id="ifsc_code_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Due By">Enter Mobile Number *</label>
                           <input class="form-control textboxes" minlength="10" maxlength="10" name="acc_mobile" id="acc_mobile" type="text" placeholder="Enter mobile number">
                           <span class="text-danger color-hider" id="acc_mobile_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Due By">Branch Name  *</label>
                           <input class="form-control textboxes" name="branch_name" id="branch_name" type="text" placeholder="Branch Name">
                           <span class="text-danger color-hider" id="branch_name_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Due By">UPI Id</label>
                           <input class="form-control textboxes" name="upi_id" id="upi_id" type="text" placeholder="UPI ID">
                           <span class="text-danger color-hider" id="upi_id_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <label for="Due By">UAN Number/PF Number</label>
                           <input class="form-control textboxes" onkeypress="return isNumber(event)" name="uan_num" id="uan_num" type="text" placeholder="UAN Number">
                           <span class="text-danger color-hider" id="uan_num_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                        </div>
                        <div class="form-group col-2">
                            <label for="Due By"></label>
                           <!-- <input type="hidden" name="type_id" id="type_id"> -->
                           <button class="btn btn-info" data-original-title="btn btn-info-gradien" type="submit" >Save</button>
                        </div>
                     </form>
                  </div>
                  </div>
                  </div>
               </div>
               <!-- Education -->
               <div class="tab-pane fade" id="v-pills-Education" role="tabpanel" aria-labelledby="v-pills-Education-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Education Information</span>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#documentModal">+ Add Education</button>
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
                                <tbody id="education_td">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- Pop-up div starts-->

                    <div  class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_education_unit" class="ajax-form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-sm-4 mb-3">
                                            <label for="Qualification">Qualification</label>
                                            <select class="form-control" name="qualification" id="qualification" placeholder="Qualification">
                                               
                                             </select>
                                            <span class="text-danger color-hider" id="qualification_error"  style="display:none;color: red;"></span>
                                        </div> 
                                        <div class="col-sm-4 mb-3" id="course_hide">
                                            <label for="Course">Course</label>
                                            <select class="form-control js-example-basic-single" name="Course" id="Course" type="text" placeholder="Course">
                                             </select>
                                            <span class="text-danger color-hider" id="Course_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="University">Institute</label>
                                            <input class="form-control" name="institute" id="institute" type="text" placeholder="Institute">
                                            <span class="text-danger color-hider" id="institute_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="Begin_On">Begin On</label>
                                            <input class="form-control" name="begin_on" id="begin_on" type="month" placeholder="" >
                                            <span class="text-danger color-hider" id="begin_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                          <label for="Due By">End On</label>
                                            <input class="form-control" name="end_on" id="end_on" type="month" placeholder="" >
                                            <span class="text-danger color-hider" id="end_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-sm-4 mb-3">
                                           <label for="percentage">Percentage</label>
                                            <input class="form-control" name="percentage" id="percentage" type="text" placeholder="Percentage" >
                                            <span class="text-danger color-hider" id="percentage_error"  style="display:none;color: red;"></span>
                                        </div>
                                       <div class="col-sm-4 mb-3">
                                           <label for="edu_certificate">Education Certificate</label>
                                            <input class="form-control" name="edu_certificate" id="edu_certificate" type="file" accept=".doc,.docx,.xls,.xlsx,.pdf" placeholder="" >
                                            <small>Accept Only doc,docx,xls,xlsx,pdf.</small>
                                            <span class="text-danger color-hider" id="edu_certificate_error"  style="display:none;color: red;"></span>
                                        </div>
                                       
                                        <div class="col-md-6 mb-3">
                                          
                                       </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" id="edu_submit" type="submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Experience -->
               <div class="tab-pane fade" id="v-pills-Experience" role="tabpanel" aria-labelledby="v-pills-Experience-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Experience</span>
                     <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#expModal">+ Add Experience</button>
                  </nav>
                  <br>
                  <div class="ctm-border-radius shadow-sm card">
                     <div id="Experience_tbl">
                     </div>
                  </div>
                   <!-- Pop-up div starts-->
                  <div class="modal fade" id="expModal" tabindex="-1" role="dialog" aria-labelledby="expModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="Experience">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expModalLabel">Add Experience</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_experience_unit" class="ajax-form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="job_title">Job Title</label>
                                            <input class="form-control" name="job_title" id="job_title" type="text" placeholder="Job Tiltle">
                                            <span class="text-danger color-hider" id="job_title_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="cmp_name">Company Name</label>
                                            <input class="form-control" name="cmp_name" id="cmp_name" type="text" placeholder="Company Name">
                                            <span class="text-danger color-hider" id="cmp_name_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-md-12 mb-3">
                                            <label for="exp_begin_On">Begin On</label>
                                            <input class="form-control" name="exp_begin_on" id="exp_begin_on" type="date" placeholder="">
                                            <span class="text-danger color-hider" id="exp_begin_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <input type="checkbox" id="currently_working" name="currently_working" value="1">
                                        <label for="vehicle1"> Present</label><br>
                                        <div class="col-md-12 mb-3">
                                            <label for="Due By">End On</label>
                                            <input class="form-control" name="exp_end_on" id="exp_end_on" type="date" placeholder="">
                                            <span class="text-danger color-hider" id="exp_end_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="exp_upload_file">Experience Certificate</label>
                                            <input class="form-control" name="exp_file" id="exp_file" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" aria-describedby="fileHelp">
                                             <!-- <small id="fileHelp" class="form-text text-muted">Please upload a valid file.</small> -->
                                             <span class="text-danger color-hider" id="exp_file_error"  style="display:none;color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" id="exp_submit" type="submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Other Documents -->
               <div class="tab-pane fade" id="v-pills-Documents" role="tabpanel" aria-labelledby="v-pills-Documents-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Other Documents</span>
                    <!-- <h4><i data-target="#add_document" >+ Add Document</i></h4> -->
                     <button id="document_button" class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#docModal" >+ Add Document</button>
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
                     <!-- Pop-up div starts-->
                  <div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="docModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="docModalLabel">Add Mandatory Documents</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_documents_unit" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-sm-4 mb-3">
                                            <label>Recent Passport Size Photograph</label>
                                            <input class="form-control" name="passport_photo" id="passport_photo" type="file" placeholder=""  aria-describedby="fileHelp" >
                                             <span class="text-danger color-hider" id="passport_photo_error"  style="display:none;color: red;"></span>
                                        </div>
                                       <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Updated Resume</label>
                                        
                                            <input class="form-control" name="Resume" id="Resume" accept=".doc,.docx,.xls,.xlsx,.pdf" type="file" placeholder=""  aria-describedby="fileHelp" >
                                             <span class="text-danger color-hider" id="Resume_error"  style="display:none;color: red;"></span>
                                        </div>
                                       <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Payslips/Bank Statement</label>
                                        
                                            <input class="form-control" name="Payslips" id="Payslips" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp" >
                                             <!-- <small id="fileHelp" class="form-text text-muted">Please upload a valid file.</small> -->
                                             <span class="text-danger color-hider" id="Payslips_error"  style="display:none;color: red;"></span>
                                        </div>
                                        
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">PAN Card</label>
                                        
                                            <input class="form-control" name="pan" id="pan" accept=".doc,.docx,.pdf" type="file" placeholder=""  aria-describedby="fileHelp" >
                                             <span class="text-danger color-hider" id="pan_error"  style="display:none;color: red;"></span>
                                        </div>
                                       
                                        
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Vaccination Certificate</label>
                                       
                                            <input class="form-control" name="Vaccination" id="Vaccination" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp" >
                                             <span class="text-danger color-hider" id="Vaccination_error"  style="display:none;color: red;"></span>
                                        </div>
                                        
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Signature</label>
                                        
                                            <input class="form-control" name="signature" id="signature" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="signature_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">DOB proof</label>
                                        
                                            <input class="form-control" name="dob_proof" id="dob_proof" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="dob_proof_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Blood Group Proof</label>
                                        
                                            <input class="form-control" name="blood_grp_proof" id="blood_grp_proof" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="blood_grp_proof_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Aadhaar Card</label>
                                            <input class="form-control" name="aadhaar_card" id="aadhaar_card" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="aadhaar_card_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Front Page Of Your Bank Passbook (Or) Cancelled Cheque Leaf</label>
                                            <input class="form-control" name="bank_passbook" id="bank_passbook" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="bank_passbook_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label for="documents_name">Relieving Letter/Resignation Acceptance Mail from Previous employer</label>
                                            <input class="form-control" name="Relieving_letter" id="Relieving_letter" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp">
                                             <span class="text-danger color-hider" id="Relieving_letter_error"  style="display:none;color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit" id="doc_Submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Family -->
               <div class="tab-pane fade" id="v-pills-Family" role="tabpanel" aria-labelledby="v-pills-Family-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1" style="color:white;">Family</span>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#FamilyModal">+ Add Family Info</button>
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
                     <!-- Pop-up div starts-->
                  <div class="modal fade" id="FamilyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Family Information</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_family_unit" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="fm_name">Name</label>
                                            <input class="form-control" name="fm_name" id="fm_name" type="text" placeholder="Name">
                                            <span class="text-danger color-hider" id="fm_name_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fm_gender">Gender</label>
                                            <select class="form-control" name="fm_gender" id="fm_gender">
                                                <option value="">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fm_gender_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_relationship">Relationship</label>
                                            <!-- <input class="form-control" name="fn_relationship" id="fn_relationship" type="text" placeholder="Relationship"> -->
                                             <select class="form-control" name="fn_relationship" id="fn_relationship">
                                                <option value="">Select</option>
                                               <option value="Mother">Mother</option>
                                               <option value="Father">Father</option>
                                               <option value="Daughter">Daughter</option>
                                               <option value="son">Son</option>
                                               <option value="sister">Sister</option>
                                               <option value="brother">Brother</option>
                                               <option value="aunty">Aunty</option>
                                               <option value="uncle">Uncle</option>
                                               <option value="cousin_female">Cousin(Female)</option>
                                               <option value="cousin_male">Cousin(Male)</option>
                                               <option value="grandmother">Grandmother</option>
                                               <option value="grandfather">Grandfather</option>
                                               <option value="granddaughter">Granddaughter</option>
                                               <option value="grandson">Grandson</option>
                                             </select>
                                             <span class="text-danger color-hider" id="fn_relationship_error"  style="display:none;color: red;"></span>

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_marital">Marital Status</label>
                                            <!-- <input class="form-control" name="fn_marital" id="fn_marital" type="text" placeholder="Marital Status"> -->
                                            <select class="form-control" name="fn_marital" id="fn_marital">
                                                 <option value="">-Select Marital Status-</option>
                                                 <option value="Single">Single</option>
                                                 <option value="Married">Married</option>
                                                 <option value="Widowed">Widowed</option>
                                                 <option value="Separated">Separated</option>
                                                 <option value="Divorced">Divorced</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fn_marital_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_blood_gr">Blood Group</label>
                                            <!-- <input class="form-control" name="fn_blood_gr" id="fn_blood_gr" type="text" placeholder="Blood Group"> -->
                                           <select class="form-control" id="fn_blood_gr" name="fn_blood_gr" >
                                             <option value="">-Select Blood Group-</option>
                                             <option value="A+">A+</option><option value="A-">A-</option>
                                             <option value="B+">B+</option><option value="B-">B-</option>
                                             <option value="O+">O+</option><option value="O-">O-</option>
                                             <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fn_blood_gr_error"  style="display:none;color: red;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" id="fam_submit" type="submit" >Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Pop-up div image upload-->
               <div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="profile_imageLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="profile_imageLabel">Add Profile Image</h5>
                             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                         </div>
                           <form method="POST"  id="imageUploadForm" enctype="multipart/form-data">
                                        @csrf
                           <div class="container mt-3">
                              <div class="card">
                                 <div class="card-body">
                                    <input type="file" name="image" accept=".jpeg,.jpg,.png,.GIF,.JPEG,.JPG,.PNG" class="image">
                                 </div>
                              </div>
                           </div>
                              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="img-container">
                                             <div class="row">
                                                <div class="col-md-8">
                                                   <img id="image" class="test" src="https://avatars0.githubusercontent.com/u/3456749">
                                                </div>
                                             <div class="col-md-4">
                                                <div class="preview"></div>
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          </div>
                        </div>
                         </form>
                     </div>
                   </div>
                 </div>
               <!-- Pop-up div Ends-->
               <!-- /.banner popup image -->
                  <div class="modal fade sample-preview_ban" tabindex="-1" role="dialog"
                  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-header" style="border-bottom: 0;">
                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <img id="sample_view_ban" style="width: 65%; margin-left: 20%;">
                        </div>
                     </div>
                  </div>
                  <!-- /.End banner pop up image -->

                  <!-- /.profile popup image -->
                  <div class="modal fade sample-preview_pro" tabindex="-1" role="dialog"
                  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-header" style="border-bottom: 0;">
                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <img id="sample_view_pro" style="width: 35%; margin-left: 30%;">
                        </div>
                     </div>
                  </div>
                  <!-- /.End banner pop up image -->
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
 <script src="../assets/pro_js/profile.js"></script>
<!-- Datepicker -->
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src='../assets/js/select2/select2.full.min.js'></script>
<script src='../assets/js/select2/select2-custom.js'></script>
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>
 <script type="text/javascript">
  $("#skill_secondary").tagsinput('items');
   /*multiselect*/
   $(document).ready(function() {
        $("select.exist-option-only").select2();
        $("select.dynamic-option-create-multiple").select2({
          tags: true,
          multiple: true,
        });
      })
/*only letters*/
      $(document).ready(function(){
          $(".alpha").keydown(function(event){
              var inputValue = event.which;
              if(!(inputValue >= 65 && inputValue <= 123) &&/*letters,white space,tab*/
               (inputValue != 32 && inputValue != 0) &&
               (inputValue != 48 && inputValue != 8)/*backspace*/
               && (inputValue != 9)/*tab*/) {
                  event.preventDefault();
              }
          });
      });
/*only Numbers*/
   function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
              return false;
          }
          return true;
      }
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

/*0 to 150 age validation*/
// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(callback, errMsg) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
      if (callback(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          $(this).removeClass("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        $(this).addClass("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  };
}(jQuery));

$("#age_can").inputFilter(function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 150); }, "Must be between 0 and 150");


  
   /*state list*/
   var add_skill_set_link = "{{url('add_skill_set')}}";
   var state_get_link = "{{url('state_get')}}";
   var get_district_link = "{{url('get_district')}}";
   var get_district_cur_link = "{{url('get_district_cur')}}";
   var get_town_name_link = "{{url('get_town_name')}}";
   var get_town_name_curr_link = "{{url('get_town_name_curr')}}";
   var upload_images = "{{url('profile_upload_images')}}";
   var display_image = "{{url('profile_display_images')}}";
   var add_documents_unit_process_link = "{{url('documents_insert')}}";
   var documents_info_link = "{{url('documents_info_pro')}}";
   var account_info_link = "{{url('profile_account_info_add')}}";
   var account_info_get_link = "{{url('account_info_get')}}";
   var education_information_link = "{{url('education_information_insert')}}";
   var education_information_get_link = "{{url('education_information_view')}}";
   var experience_info_link = "{{url('experience_info_view')}}";
   var add_contact_info_link = "{{url('add_contact_info')}}";
   var Contact_info_get_link = "{{url('Contact_info_view')}}";
   var add_family_info_link = "{{url('add_family_add')}}";
   var family_information_get_link = "{{url('family_information_view')}}";
   var banner_image_crop_link = "{{url('banner_image_crop')}}";
   var profile_banner_image_link = "{{url('profile_banner')}}";
   var experience_information_link = "{{url('experience_information')}}";
   var remove_display_image_link = "{{url('remove_display_image')}}";
   var remove_slide_pay_doc_link = "{{url('remove_slide_pay_doc')}}";
   var get_qualification_link = "{{url('get_qualification_list')}}";
   var get_course_link = "{{url('get_course')}}";


 </script>
@endsection
