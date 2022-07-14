
@extends('layouts.simple.candidate_master')
@section('title', 'ID Card Validation Form')

@section('css')
@endsection

@section('style')
<style type="text/css">
   /*img{
  max-width:180px;
}*/
.img-70
{
   width: 170px !important;
   height: 169px !important;
}
/*input[type=file]
{
   padding:10px;
}*/
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
          <div class="card">
            <div class="card-body">
               <form class="" enctype="multipart/form-data" id= "hr_idcard_info" novalidate="">
                  <input type="hidden" name="can_id" id="can_id" value="{{ $_GET['id']}}">
                  <div class="text-center">
                  
                         <div class="avatar">
                           <!-- <img width="300" height="330" lass="img-fluid rounded" alt="" id="pro_img"> -->
                            <!-- <img id="previewImg" src="/examples/images/transparent.png" alt="Placeholder"> -->
                           <div class="col-auto"><img accept=".png" class="img-70 rounded-circle" alt="" id="pro_img"></div>
                        </div>
                     </div>
                     <div class="text-center">
                        <div class="col-sm-4 form-group">
                          <input type="file" name="file" class="form-control" onchange="previewFile(this);" id="pro_img_up">
                          <span class="text-danger color-hider" id="pro_img_up_error"  style="display:none;color: red;"></span>
                           <input type="hidden" name="img_path_hide" id="img_path_hide">
                       </div>
                        
                     
                  </div>


                  <div class="form-row">

                     <!-- <div class="col-md-6">
                       
                     </div> -->
                     <div class="col-md-4 mb-3">
                        <label for="f_name">First name</label>
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
                        <label for="validationCustomUsername">Last Name</label>
                        <!-- <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">@</span></div>
                           <input class="form-control" id="validationCustomUsername" type="text" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                           <div class="invalid-feedback">Please choose a username.</div>
                        </div> -->
                         <input class="form-control alpha" style="text-transform:uppercase" id="l_name" name="l_name" type="text" placeholder="Middle name" >
                         <span class="text-danger color-hider" id="l_name_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="working_loc">Work Location</label>
                        <input class="form-control" id="working_loc" name="working_loc" type="text" placeholder="Working Location">
                        <div class="invalid-feedback">Please provide a valid Location.</div>
                     </div>
                      <div class="col-md-4 mb-3">
                        <label for="emp_num_1">Mobile Number 1 *</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emp_num_1" name="emp_num_1" type="text" placeholder="Mobile Number 1" required="">
                        <span class="text-danger color-hider" id="emp_num_1_loc_error"  style="display:none;color: red;"></span>
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
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="name_rel_ship">Name of Relationship</label>
                        <input class="form-control alpha" id="name_rel_ship" name="name_rel_ship" type="text" placeholder="Name of Relationship" required="">
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emrg_con_num">Emergency contact number *</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emrg_con_num" name="emrg_con_num" type="text" placeholder="Emergency contact number" required="">
                        <span class="text-danger color-hider" id="emrg_con_num_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">DOJ</label>
                        <input class="form-control" id="doj" name="doj" type="date" readonly placeholder="Date Of Join" >

                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="blood_grp">Blood Group</label>
                        <!-- <input class="form-control" id="blood_grp" name="blood_grp" type="text" placeholder="Blood Group" required=""> -->
                        <select class="form-control" placeholder="Blood Group" id="blood_grp" name="blood_grp" required=""> <option value="">Select Blood Group</option>
                           <option value="A+">A+</option><option value="A-">A-</option>
                           <option value="B+">B+</option><option value="B-">B-</option>
                           <option value="O+">O+</option><option value="O-">O-</option>
                           <option value="AB+">AB+</option><option value="AB-">AB-</option>
                        </select>
                        <span class="text-danger color-hider" id="blood_grp_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_code">Employee code</label>
                        <input class="form-control" id="emp_code" name="emp_code" type="text" placeholder="Employee code" readonly>
                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-6 mb-3">
                        <label for="official_email">Official Email ID</label>
                        <input class="form-control" id="official_email" name="official_email" type="email" placeholder="Official Email Id" readonly >
                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="emp_dob">DOB</label>
                        <input class="form-control" id="emp_dob" name="emp_dob" type="date" placeholder="Blood Group" required="">
                        <span class="text-danger color-hider" id="emp_dob_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                  </div>
                  <center>
                     <button class="btn btn-success" type="btnSubmit">Accept</button>
                     <!-- <button class="btn btn-danger">  </button> -->
                     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ignore</button>

                  </center>
               </form>
                <!-- Pop-up div starts-->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="hr_remarks_form" class="ajax-form">
                                 <input type="hidden" name="can_id_hr" id="can_id_hr" value="{{ $_GET['id']}}">
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="id_remark">Add Remarks</label>
                                            <input class="form-control" name="id_remark" id="id_remark" type="text" placeholder="Remarks" required="">
                                            <div class="text-warning" id="id_remark_error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit" id="btnSubmit">Save</button>
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
@endsection

@section('script')
<script src="../assets/js/form-validation-custom.js"></script>
<script src="../pro_js/hr_id_card_verification.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var hr_id_card_varification_link = "{{url('hr_get_id_card_vari')}}";
    var hr_idcard_verfi_link = "{{url('hr_idcard_verfi')}}";
    var hr_id_remark_link = "{{url('hr_id_remark')}}";

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

      function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#pro_img").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

</script>
@endsection