@extends('layouts.simple.candidate_master')
@section('title', 'Business')
<!-- vigneshwaran -->
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/prism.css"> -->
    <!-- Plugins css start-->
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css"> -->

@endsection

@section('style')
<style>
  .img-70
{
   width: 170px !important;
   height: 169px !important;
}
.form-row
{
    margin-right: 58px !important;
    margin-left: 52px !important;
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Employee List<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
          <div class="row">
               @if(Auth::user()->role_id=='RO9')
                <div class="col-lg-10" style="margin-top: 18px; margin-bottom: 22px;">
                  <a href="{{url('AddEmployee')}}"><button class="btn btn-primary" id="AddEmployeeBtn">Add Employee <i class="fa fa-plus" aria-hidden="true"></i></button></a>
                </div>
               @endif 
              <div class="col-lg-2 float-right">
                  <span>ID Card Status</span>
                  <select  name="status" id="status" class="form-control">
                      <option value="">--Select--</option>
                      <option value="2">Accept</option>
                      <option value="3">Revert</option>
                  </select>
              </div>
          </div>
            <div class="dt-ext table-responsive">
              <table class="display" id="employee_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Action</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Role Type</th>
                    <th>Gender</th>
                    <th>DOJ</th>
                    <th>DOB</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Work Location</th>
                    <th>Grade</th>
                    <th>Official Email </th>
                    <th>Personal Email </th>
                    <th>Contact No</th>
                    <th>Contact No 2</th>
                    <th>Blood Group</th>
                    <th>Supervisor Name</th>
                    <th>Reviewer Name</th>
                    <th>Emergency Contact Number</th>
                    <!-- <th>Info</th> -->
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              <!-- Edit pop-up model start -->
                <div class="modal fade text-left" id="role_edit_div" tabindex="-1" role="dialog" aria-labelledby="show_edit_pop_title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> Edit Role</h4>
                                <button type="button" id="close_edit_pop" class="close"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-2 col-12">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="employe_role">Role Type </label>
                                            <select name="created_by" id="employe_role" name="employe_role" class="form-control">
                                                <option value="">Select</option>

                                              </select>
                                        </div>

                                        <input type="hidden" name="ed_id" id="ed_id">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-danger cancelbtn" id="editCancel" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success deletebtn"
                                    id="editUpdate">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- end edit -->
               <!-- Pop-up div starts for hr id card verfication-->
                <div class="modal fade bd-example-modal-xl" id="idModal" tabindex="-1" role="dialog" aria-labelledby="idModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="idModalLabel">ID Card Information</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                            <form class="" enctype="multipart/form-data" id= "hr_idcard_info" novalidate="">
                        <div class="text-center">
                            <input type="hidden" name="can_id" id="can_id">
                         <div class="avatar" style="margin-top: 16px;">
                           <div class="col-auto"><img class="img-70 rounded-circle" alt="" id="pro_img"></div>
                        </div>
                     </div>
                     <div class="text-center">
                        <div class="col-sm-4 form-group" >
                          <input type="file" accept=".png" name="file" class="form-control readone_1" onchange="previewFile(this);" id="pro_img_up">
                          <span class="text-danger color-hider" id="pro_img_up_error"  style="display:none;color: red;"></span>
                           <input type="hidden" name="img_path_hide" id="img_path_hide">
                       </div>
                  </div>
                  <div class="text-center">
                      <div class="form-row">
                         <div class="col-md-4 mb-3">
                            <label for="f_name">First name</label>
                            <input class="form-control alpha readone" style="text-transform:uppercase" id="f_name" type="text" name="f_name" placeholder="First name" required="">
                            <span class="text-danger color-hider" id="f_name_error"  style="display:none;color: red;"></span>
                            <div class="valid-feedback">Looks good!</div>
                         </div>
                         <div class="col-md-4 mb-3">
                            <label for="m_name">Middle Name</label>
                            <input class="form-control alpha readone" id="m_name" type="text" name="m_name" placeholder="Middle name" >
                            <div class="valid-feedback">Looks good!</div>
                         </div>
                         <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Last Name</label>
                             <input class="form-control alpha readone" style="text-transform:uppercase" id="l_name" name="l_name" type="text" placeholder="Middle name" >
                             <span class="text-danger color-hider " id="l_name_error"  style="display:none;color: red;"></span>
                         </div>
                      </div>
                  </div>
                    <div class="text-center">
                      <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="working_loc">Work Location</label>
                        <input class="form-control readone" id="working_loc" name="working_loc" type="text" placeholder="Working Location" >
                        <div class="invalid-feedback">Please provide a valid Location.</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_1">Mobile Number 1 *</label>
                        <input class="form-control readone" maxlength="10" onkeypress="return isNumber(event)" id="emp_num_1" name="emp_num_1" type="text" placeholder="Mobile Number 1" required="">
                        <span class="text-danger color-hider" id="emp_num_1_loc_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_2">Mobile Number 2</label>
                        <input class="form-control readone" maxlength="10" id="emp_num_2" onkeypress="return isNumber(event)" name="emp_num_2" type="text" placeholder="Mobile Number 2" required="">
                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>
                    </div>
                    <div class="text-center">
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
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="name_rel_ship">Name of Relationship</label>
                        <input class="form-control alpha readone" id="name_rel_ship" name="name_rel_ship" type="text" placeholder="Name of Relationship" required="">
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emrg_con_num">Emergency contact number *</label>
                        <input class="form-control readone" maxlength="10" onkeypress="return isNumber(event)" id="emrg_con_num" name="emrg_con_num" type="text" placeholder="Emergency contact number" required="">
                        <span class="text-danger color-hider" id="emrg_con_num_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  </div>
                  <div class="text-center">
                          <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Date Of Joining *</label>
                        <input class="form-control readone" id="doj" name="doj" type="date" placeholder="Date Of Join" >
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="blood_grp">Blood Group *</label>
                        <select class="form-control readone_1" placeholder="Blood Group" id="blood_grp" name="blood_grp" required=""> <option value="">Select Blood Group</option>
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
                        <input class="form-control readone" id="emp_code" name="emp_code" type="text" placeholder="Employee code" readonly>
                     </div>
                  </div>
                  </div>
                    <div class="text-center">
                      <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="official_email">Official Email ID *</label>
                        <input class="form-control readone" id="official_email" name="official_email" type="email" placeholder="Official Email Id"  >
                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="p_email">Personal Email ID</label>
                        <input class="form-control readone" id="p_email" name="p_email" type="email" placeholder=" Email Id" >
                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_dob">Date Of Birth *</label>
                        <input class="form-control readone" id="emp_dob" name="emp_dob" type="date" placeholder="Blood Group">
                        <span class="text-danger color-hider" id="emp_dob_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                  </div>
                    </div>
                  <div class="text-center" style="margin-bottom: 26px;">
                  <center>
                     <button class="btn btn-success" id="hr_acc_but" type="btnSubmit">Accept</button>
                     <!-- <button class="btn btn-danger">  </button> -->
                     <button type="button" id="rev_but" class="btn btn-danger" data-toggle="modal" data-target="#ignoreModal" data-whatever="@mdo">Revert</button>

                  </center>
               </form>
                      </div>
                    </div>
                  </div>
                <!-- Pop-up div Ends-->

                <!-- Pop-up revert starts-->
                  <div class="modal fade" id="ignoreModal" tabindex="-1" role="dialog" aria-labelledby="ignoreModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ignoreModalLabel">Add Remarks</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="hr_remarks_form" class="ajax-form">
                                <input type="hidden" name="can_id_hr" id="can_id_hr">
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
                                    <button class="btn btn-secondary" id="hr_rev_but" type="submit" id="btnSubmit">Save</button>
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
  </div>
  <!-- Container-fluid Ends-->

@endsection

@section('script')

<script src="../assets/pro_js/employee_list.js"></script>
<script src="../pro_js/hr_id_card_verification.js"></script>

<script>
    var get_employee_list = "{{url('get_employee_list')}}";
    var hr_card_varification_link = "{{url('hr_get_id_card_vari')}}";
    /*popup admin*/
    var get_role_type_link = "{{url('get_role_type')}}";
    var get_employee_link = "{{url('get_employee_pop')}}";
    var employee_list_pop_link = "{{url('update_employee_list_pop')}}";
    var hr_id_card_varification_link = "{{url('hr_id_card_ver')}}";
     var hr_idcard_verfi_link = "{{url('hr_idcard_verfi')}}";
    var hr_id_remark_link = "{{url('hr_id_remark')}}";



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

