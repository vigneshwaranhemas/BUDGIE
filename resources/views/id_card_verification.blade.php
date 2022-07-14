@extends('layouts.simple.candidate_master')
@section('title', 'ID Card Validation Form')

@section('css')
@endsection

@section('style')
<style type="text/css">
   .img-70
{
   width: 170px !important;
   height: 169px !important;
}
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: red;    }
    49%{    color: red; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>ID Card <span>Information</span></h2>
@endsection

@section('breadcrumb-items')
	<!-- <li class="breadcrumb-item">Forms</li>
    <li class="breadcrumb-item">Form Controls</li>	 -->
	<li class="breadcrumb-item active">ID Card Information/</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
       <div class="text-center">
         <h5>
           <a style="text-transform:uppercase" class="blinking" id="hr_id_remark"></a>
         </h5>
      </div>
          <div class="card">
            <div class="card-body">
               <div class="text-center">
                   <div class="avatar">
                     <div class="col-auto"><img class="img-70 rounded-circle" alt="" id="pro_img"></div>
                  </div>
               </div>
               <form class="" enctype="multipart/form-data" id= "idcard_info" novalidate="">
                <div class="text-center">
                    <div class="col-sm-4 form-group" >
                      <input type="file" accept=".png" name="file" class="form-control readone_1" onchange="previewFile(this);" id="pro_img_up"  style="display: none;">
                      <span class="text-danger color-hider" id="pro_img_up_error"  style="display:none;color: red;"></span>
                      <span class="text-danger color-hider" id="file_error"  style="display:none;color: red;"></span>
                       <input type="hidden" name="img_path_hide" id="img_path_hide">
                   </div>
                </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="f_name">First Name *</label>
                        <input class="form-control alpha" style="text-transform:uppercase" id="f_name" type="text" name="f_name" placeholder="First name" required="">
                        <span class="text-danger color-hider" id="f_name_error"  style="display:none;color: red;"></span>
                        <div class="valid-feedback">Looks good!</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="m_name">Middle Name</label>
                        <input class="form-control alpha" id="m_name" type="text" name="m_name" placeholder="Middle name" >
                        <div class="valid-feedback">Looks good!</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Last Name *</label>
                         <input class="form-control alpha" style="text-transform:uppercase" id="l_name" name="l_name" type="text" placeholder="Last name" >
                         <span class="text-danger color-hider" id="l_name_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="working_loc">Work Location</label>
                        <!-- <input class="form-control" id="working_loc" name="working_loc" type="text" placeholder="Working Location" > -->
                         <select class="form-control" name="working_loc" id="working_loc">
                              <option value="">Select</option>
                             <option value="Onsite">Onsite</option>
                             <option value="Offsite">Offsite</option>
                             <option value="WFH">Work From Home</option>
                             <option value="N/A">N/A</option>
                          </select>
                        <div class="invalid-feedback">Please provide a valid Location.</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_1">Mobile Number 1 *</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emp_num_1" name="emp_num_1" type="text" placeholder="Mobile Number 1" required="">
                        <span class="text-danger color-hider" id="emp_num_1_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_2">Mobile Number 2</label>
                        <input class="form-control" maxlength="10" id="emp_num_2" onkeypress="return isNumber(event)" name="emp_num_2" type="text" placeholder="Mobile Number 2" required="">
                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Emergency Contact of Relationship *</label>
                        <!-- <input class="form-control" id="rel_emp" name="rel_emp" type="text" placeholder="Relationship of Employee" required=""> -->
                           <select class="form-control" name="rel_emp" id="rel_emp">
                              <option value="">Select</option>
                             <option value="Mother">Mother</option>
                             <option value="Father">Father</option>
                             <option value="Spouse">Spouse</option>
                             <option value="Husband">Husband</option>
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
                             <option value="other">Other</option>
                           </select>
                           <span class="text-danger color-hider" id="rel_emp_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="name_rel_ship">Name of Relationship *</label>
                        <input class="form-control alpha" style="text-transform:uppercase" id="name_rel_ship" name="name_rel_ship" type="text" placeholder="Name of Relationship" required="">
                        <span class="text-danger color-hider" id="name_rel_ship_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emrg_con_num">Emergency contact number *</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emrg_con_num" name="emrg_con_num" type="text" placeholder="Emergency contact number" required="">
                        <span class="text-danger color-hider" id="emrg_con_num_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Date Of Joining *</label>
                        <input class="form-control" id="doj" name="doj" type="date" placeholder="Date Of Join" >
                        <span class="text-danger color-hider" id="doj_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="blood_grp">Blood Group *</label>
                        <select class="form-control" placeholder="Blood Group" id="blood_grp" name="blood_grp" required=""> <option value="">Select Blood Group</option>
                           <option value="A+">A+</option><option value="A-">A-</option>
                           <option value="B+">B+</option><option value="B-">B-</option>
                           <option value="O+">O+</option><option value="O-">O-</option>
                           <option value="AB+">AB+</option><option value="AB-">AB-</option>
                        </select>
                        <span class="text-danger color-hider" id="blood_grp_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_code">Employee code</label>
                        <input class="form-control" id="emp_code" name="emp_code" type="text" placeholder="Employee code" readonly>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="official_email">Official Email ID *</label>
                        <input class="form-control" id="official_email" name="official_email" type="email" placeholder="Official Email Id"  >
                        <span class="text-danger color-hider" id="official_email_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="p_email">Personal Email ID *</label>
                        <input class="form-control" id="p_email" name="p_email" type="email" placeholder=" Email Id" >
                        <span class="text-danger color-hider" id="p_email_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_dob">Date Of Birth *</label>
                        <input class="form-control" id="emp_dob" name="emp_dob" type="date" placeholder="Blood Group" required="">
                        <span class="text-danger color-hider" id="emp_dob_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <center>
                     <button class="btn btn-success" id="btndis" type="Submit">Submit For Approval</button>
                     <!-- <button class="btn btn-secondary" id="req_hr_change" >Request to Hr Permission</button> -->
                     <h2 style="text-transform:uppercase" class="blinking"><a  id="req_hr_change"></a></h2>
                  </center>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="../assets/js/form-validation-custom.js"></script>
<script src="../assets/pro_js/idcard_verification.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var idcard_info_view_link = "{{url('idcard_info')}}";
    var idcard_info_link = "{{url('idcard_info_save')}}";

</script>
<script type="text/javascript">
   /*only Numbers*/
   function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
              return false;
          }
          return true;
      }

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
</script>
@endsection
