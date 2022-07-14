@extends('layouts.simple.candidate_master')

@section('title', 'User Profile')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/photoswipe.css"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
 -->
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
/*.banner_ji{
   margin-top: 70px;
}*/
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
.select2
{
       width: 90% !important;
}
.select2-container--open{
   z-index: 10000;
   width: 90% !important;
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
                      <div class="icon-wrapper"></div>
                     <figure itemprop="associatedMedia" itemscope="">
                        <!-- <div class="avatar"><img width="1300" height="330" lass="img-fluid rounded" alt="" id="banner_img" src=""></div> -->
                        <a class="avatar" itemprop="contentUrl" data-size="1600x950"><img width="1300" height="330" class="img-fluid rounded" itemprop="thumbnail"  alt="" id="can_banner_img"></a>
                     </figure>
                  </div>
               </div>
               <div class="user-image">
                  <div class="avatar"><img alt="" id="pro_img" src=""></div>
                 
               </div>
               <div class="info">
                  <div class="row">
                     <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-envelope"></i>   Email</h6>
                                 <div id="can_email"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-calendar"></i>   DOB</h6>
                                 <div id="can_dob"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                        <div class="user-designation">
                           <div class="title"><a target="_blank" id="can_name_1" href=""></a></div>
                           <div class="desc mt-2" id="can_designation_1"></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-phone"></i>   Contact Us</h6>
                                 <span><a id="can_cont"></a></span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-location-arrow"></i>   Work Location</h6>
                                 <span><a id="working_loc"></a></span>
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

                  <br>
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
                       <!-- <button id="profile_but" class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#skillModal">+ Update Info </button> -->
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
                                                             <option value="Smokers">Smokers</option>
                                                             <option value="Non-smokers">Non-smokers</option>
                                                         </select>
                                                         <span class="text-danger color-hider" id="specially_status_error" style="display:none;color: red;"></span>
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
                       <!-- <button class="btn btn-success" type="button" onclick="Contact_information_hr()" data-toggle="modal" data-original-title="test" data-target="#ContactModal">+ Add Contact</button> -->

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
                    <span class="navbar-brand mb-0 h1">Working Information</span>
                    <button class="btn btn-success" id="working_info_pop" type="button" data-toggle="modal" data-original-title="test" data-target="#WorkingModal">+ Add Working Information</button>
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
                                          <div><strong>Department : </strong> <a id="can_department"></a></div><hr>
                                          <div><strong>Work Location : </strong> <a id="can_worklocation"></a></div><hr>
                                          <div> <strong>Roll of Intake : </strong> <a id="can_payroll_status"></a></div><hr>
                                          <div><strong>Grade : </strong> <a id="grade"></a></div><hr>
                                          <div><strong>Experience in Hema's : </strong> <a id="diff_date_tx"></a></div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div><strong>Designation : </strong> <a id="can_designation"></a></div><hr>
                                          <div><strong>Date Of Joining : </strong> <a id="doj"></a></div><hr>
                                          <div><strong>CTC : </strong> <a id="ctc_txt"></a> </div><hr>
                                          <div><strong>RFH : </strong> -</div><hr>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- popup working information -->
                                 <div  class="modal fade" id="WorkingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog modal-lg" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Add Working Information</h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           </div>
                                             <form method="POST" action="javascript:void(0)" id="add_working_information" class="ajax-form" enctype="multipart/form-data">
                                               <div class="modal-body">
                                                   <div class="form-row">
                                                      <div class="col-sm-4 mb-3">
                                                           <label for="Department">Department</label>
                                                           <select class="js-example-basic-single" name="Department" id="Department" placeholder="Department">
                                                              <option value="">-Select Department-</option>
                                                            </select>
                                                           <span class="text-danger color-hider" id="Department_error"  style="display:none;color: red;"></span>
                                                       </div> 
                                                       <div class="col-sm-4 mb-3" id="course_hide">
                                                           <label for="Designation"> Designation </label>
                                                           <select class="form-control js-example-basic-single" name="Designation" id="Designation" placeholder="Designation ">
                                                            <option value="">-Select Designation-</option>
                                                            </select>
                                                           <span class="text-danger color-hider" id="Designation_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                       <div class="col-sm-4 mb-3">
                                                           <label for="Work Location">Work Location</label>
                                                           <select class="form-control" name="work_location" id="work_location" placeholder="Work Location ">
                                                            <option value="">-Select Work Location-</option>
                                                            </select>
                                                           <span class="text-danger color-hider" id="work_location_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                       <div class="col-sm-4 mb-3">
                                                           <label for="Begin_On">Date Of Joining</label>
                                                           <input class="form-control" type="date" name="doj_pop" id="doj_pop" placeholder="" >
                                                           <span class="text-danger color-hider" id="doj_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                       <div class="col-sm-4 mb-3">
                                                         <label for="Due By">Roll of Intake</label>
                                                           <input class="form-control" name="intake" id="intake" type="text" placeholder="Roll of Intake" >
                                                           <span class="text-danger color-hider" id="intake_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                        <div class="col-sm-4 mb-3">
                                                          <label for="percentage">CTC</label>
                                                           <input class="form-control" name="CTC" id="CTC" type="text" placeholder="CTC" >
                                                           <span class="text-danger color-hider" id="CTC_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                      <div class="col-sm-4 mb-3">
                                                          <label for="grade">Grade</label>
                                                           <select class="form-control" name="grade_val" id="grade_val" placeholder="grade">
                                                            <option value="">-Select Grade-</option>
                                                            </select>
                                                           <span class="text-danger color-hider" id="grade_val_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                       <div class="col-sm-4 mb-3">
                                                          <label for="percentage">RFH</label>
                                                           <input class="form-control" name="rfh" id="rfh" type="text" placeholder="RFH" >
                                                           <span class="text-danger color-hider" id="rfh_error"  style="display:none;color: red;"></span>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                                   <button class="btn btn-secondary" id="work_info_submit" type="submit">Save</button>
                                               </div>
                                             </form>
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
                    <span class="navbar-brand mb-0 h1">HR Information</span>
                   <button class="btn btn-success" id="hr_info_text" type="button" data-toggle="modal" data-original-title="test" data-target="#expModal">+ Update HR Information</button>
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
                                        <div><strong>Recruiter : </strong> - </div> <hr>
                                        <div><strong>Onboarder : </strong> - </div><hr>
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
                  <!-- Pop-up div starts-->
                     <div class="modal fade" id="expModal" tabindex="-1" role="dialog" aria-labelledby="expModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="Experience">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="expModalLabel">HR Information</h5>
                                   <button class="close"
                                   type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                               </div>
                                 <form method="POST" action="javascript:void(0)" id="Information_unit" class="ajax-form" enctype="multipart/form-data">
                                   <div class="modal-body">
                                       <div class="form-row">
                                          <div class="col-md-12 mb-3">
                                               <label for="Reporting Manager">Reporting Manager</label>
                                               <select name="reporting_manager" id="reporting_manager" class="js-example-basic-single select2">
                                                  <option value="">--Select--</option>
                                                </select>
                                                <!-- <input type="text" name="mag_id" id="mag_id" readonly> -->
                                               <span class="text-danger color-hider" id="reporting_manager_error"  style="display:none;color: red;"></span>
                                           </div>
                                           <div class="col-md-12 mb-3">
                                               <label for="Reviewer">Reviewer</label>
                                               <select name="reviewer" id="reviewer" class="js-example-basic-single">
                                                  <option value="">--Select--</option>
                                                </select>
                                               <span class="text-danger color-hider" id="reviewer_error"  style="display:none;color: red;"></span>
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
                     </div>
                  <!-- Pop-up div Ends-->
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
                    <span class="navbar-brand mb-0 h1">Education Information</span>
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
                    <span class="navbar-brand mb-0 h1">Experience</span>
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
                    <span class="navbar-brand mb-0 h1">Other Documents</span>
                    <!-- <h4><i data-target="#add_document" >+ Add Document</i></h4> -->
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
                    <span class="navbar-brand mb-0 h1">Family</span>
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
 <script src='../assets/js/select2/select2-custom.js'></script>
 <script src='../assets/js/select2/select2.full.min.js'></script>
 <script src="../assets/pro_js/hr_to_profile.js"></script>
 <!-- Datepicker -->
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src='../assets/js/select2/select2.full.min.js'></script>
<script src='../assets/js/select2/select2-custom.js'></script>
<!-- taginput -->
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

 <script type="text/javascript">

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

   var add_skill_set_hr_sd_link = "{{url('add_skill_set_hr_sd')}}";
   var hr_id_card_varification_link = "{{url('hr_get_id_card_vari')}}";
   var hr_idcard_verfi_link = "{{url('hr_idcard_verfi')}}";
   var hr_id_remark_link = "{{url('hr_id_remark')}}";
   var experience_info_hr_link = "{{url('experience_info_hr')}}";
   var family_information_get_link = "{{url('family_information_hr')}}";
   var Contact_info_hr_link = "{{url('Contact_info_hr')}}";
   var account_info_hr_link = "{{url('account_info_hr')}}";
   var education_information_get_link = "{{url('education_information_hr')}}";
   var hr_profile_banner_image = "{{url('hr_profile_banner')}}";
   var documents_info_link = "{{url('doc_information_hr')}}";
   var tag_iput_val_link = "{{url('tag_iput_val')}}";
   var hr_update_contact_info_link = "{{url('hr_update_contact_info')}}";
   var Contact_info_hr_get_link = "{{url('Contact_info_hr_get')}}";
   var hr_information_save_link = "{{url('hr_information_save')}}";
   var get_emp_list_link = "{{url('get_emp_list')}}";
   var get_Department_list_link = "{{url('get_Department_list')}}";
   var get_Designation_link = "{{url('get_Designation')}}";
   var get_work_location_link = "{{url('get_work_location')}}";
   var get_grade_link = "{{url('get_grade')}}";
   var hr_working_information_link = "{{url('hr_working_information')}}";
 </script>
@endsection
