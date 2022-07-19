@extends('layouts.simple.admin_master')
@section('title', 'Add Employee')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
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
.form-control
{
   border-radius: 50.25rem !important;
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Add<span>Employee</span></h2>
@endsection

@section('breadcrumb-items')
	<li class="breadcrumb-item active">Add Employee</li>
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
               <form  id="AddEmployeeForm" novalidate="">
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="m_name">First Name</label>
                        <input class="form-control alpha" id="firstname" name="firstname" type="text" value="" placeholder="First Name" >   
                        <span class="text-danger color-hider" id="firstname_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="m_name">Middle Name</label>   
                        <input class="form-control alpha" id="middlename" name="middlename" type="text" value="" placeholder="Middle Name" >                     
                        <span class="text-danger color-hider" id="middlename_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="m_name">Last Name</label>
                        <input class="form-control alpha" id="lastname" name="lastname" type="text" value="" placeholder="Last Name" >             
                        <span class="text-danger color-hider" id="lastname_error"  style="display:none;color: red;"></span>                     
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="m_name">Business</label>
                         <select class="form-control" placeholder="Business" id="Business" name="Business" required=""> 
                            <option value="">Select Business</option>
                            <option value="CKPL">CKPL</option>
                            <option value="HEPL">HEPL</option>
                        </select>
                    <span class="text-danger color-hider" id="Business_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="m_name">Vertical</label>
                     <select class="form-control" placeholder="Vertical" id="Vertical" name="Vertical" required=""> 
                            <option value="">Select Vertical</option>
                            @foreach($user_info['department'] as $dept)
                               @if(!empty($dept->department))
                                     <option value="{{$dept->department}}">{{$dept->department}}</option>
                               @endif
                           @endforeach 
                            </select>
                        <span class="text-danger color-hider" id="Vertical_error"  style="display:none;color: red;"></span>                     
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="m_name">Department</label>   
                        <select class="form-control" placeholder="Department" id="Department" name="Department" required=""> <option value="">Select Department</option>
                        @foreach($user_info['department'] as $dept)
                               @if(!empty($dept->department))
                                     <option value="{{$dept->department}}">{{$dept->department}}</option>
                               @endif
                           @endforeach 
                            </select>
                        <span class="text-danger color-hider" id="Department_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Designation</label>
                         <input class="form-control alpha"  id="designation" name="Designation" type="text" value="" placeholder="Designation" >
                         <span class="text-danger color-hider" id="Designation_error"  style="display:none;color: red;"></span>
                     </div>                   
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_1">RFH</label>
                        <input class="form-control"  id="RFH" name="RFH" type="text" value="" placeholder="RFH    " >
                        <span class="text-danger color-hider" id="RFH_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_2">Mobile</label>
                        <input class="form-control" maxlength="10" id="mobile" onkeypress="return isNumber(event)" name="mobile" value="" type="text" placeholder="Mobile Number" required="">
                        <span class="text-danger color-hider" id="mobile_error"  style="display:none;color: red;"></span>
                    </div>
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="emp_num_2">Secondary Contact Number</label>
                        <input class="form-control" maxlength="10" id="sec_mobile" onkeypress="return isNumber(event)" name="sec_mobile" value="" type="text" placeholder="Mobile Number" required="">
                        <span class="text-danger color-hider" id="sec_mobile_error"  style="display:none;color: red;"></span>
                    </div>
                     <div class="col-md-4 mb-3">
                     <label for="rel_emp">Personal Email</label>
                        <input class="form-control" id="personal_email" name="personal_email" type="text" placeholder="Personal Email"  value="">
                        <span class="text-danger color-hider" id="personal_email_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emrg_con_num">Role of Intake</label>
                                 <select name="roleofintake"  id="role_of_intake" placeholder="Role of Intake" class="form-control" required="" >
                                        <option value="">Select Roll of Intake</option>
                                        <option value="HEPL" data-select2-id="69">HEPL</option>
                                        <option value="Offsite" data-select2-id="70">Offsite</option>
                                        <option value="DTP-Kalanjiyam" data-select2-id="71">DTP-Kalanjiyam</option>
                                        <option value="DTP-Whitescape" data-select2-id="72">DTP-Whitescape</option>
                                        <option value="DTP-ThinknGrow" data-select2-id="73">DTP-ThinknGrow</option>
                                        <option value="DTP-DreamMinds" data-select2-id="74">DTP-DreamMinds</option>
                                        <option value="HEPL - NAPS - Onsite" data-select2-id="75">HEPL - NAPS - Onsite</option>
                                        <option value="HEPL - NAPS - WFH" data-select2-id="76">HEPL - NAPS - WFH</option>
                                        <option value="HEPL - CKPL - Onrole" data-select2-id="77">HEPL - CKPL - Onrole</option>
                                        <option value="HEPL - WFH - Onrole" data-select2-id="78">HEPL - WFH - Onrole</option>
                                        <option value="HEPL- NAPS- Offsite" data-select2-id="79">HEPL- NAPS- Offsite</option>
                                </select>
                        <span class="text-danger color-hider" id="roleofintake_error"  style="display:none;color: red;"></span>
                     </div>
                     
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="rel_emp">Attendance Format</label>
                             <select name="attendance_format" id="attendance_format" placeholder="Attendance Format" class="form-control" required="" >
                                <option value="">Select Attendance Format</option>
                                <option value="Mon-Sat 5.5 days / week" data-select2-id="59">Mon-Sat 5.5 days / week</option>
                                <option value="Mon-Sat 6 days / week" data-select2-id="60">Mon-Sat 6 days / week</option>
                                <option value="Any 6 days / week" data-select2-id="61">Any 6 days / week</option>
                            </select>
                        <span class="text-danger color-hider" id="attendance_format_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Week off</label>
                              <select name="week_off" id="week_off" placeholder="week_off" class="form-control" required="">
                                    <option value="">Select Weekoffs</option>
                                    <option value="Sunday, Saturday" data-select2-id="85">Sunday, Saturday</option>
                                    <option value="Sunday" data-select2-id="86">Sunday</option>
                                    <option value="Any" data-select2-id="87">Any</option>
                              </select>
                        <span class="text-danger color-hider" id="week_off_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Role Type</label>
                              <select name="candidate_role_type" id="candidate_role_type" placeholder="Role Type" class="form-control" required="">
                                    <option value="">Select Role Type</option>
                                     @foreach($user_info['role_type'] as $role)
                                       <option value="{{$role->role_id}}">{{$role->name}}</option>
                                     @endforeach
                              </select>
                        <span class="text-danger color-hider" id="candidate_role_type_error"  style="display:none;color: red;"></span>
                     </div>
                     
                  </div>  
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="rel_emp">Experience</label>
                              <select name="candidate_experience" id="candidate_experience" placeholder="Experience" class="form-control" required="">
                                    <option value="">Select Experience</option>
                                    <option value="Fresher">Fresher</option>
                                    <option value="Experienced">Experienced</option>
                              </select>
                        <span class="text-danger color-hider" id="candidate_experience_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Grade</label>
                        <select id="grade" name="grade"  placeholder="Grade" class="form-control" required="">
                                    <option value="">Select Grade</option>
                                    <option value="2A" data-select2-id="93">2A</option>
                                    <option value="2B" data-select2-id="94">2B</option>
                                    <option value="3A" data-select2-id="95">3A</option>
                                    <option value="3B" data-select2-id="96">3B</option>
                                    <option value="4A" data-select2-id="97">4A</option>
                                    <option value="4B" data-select2-id="98">4B</option>
                                    <option value="5A" data-select2-id="99">5A</option>
                                    <option value="5B" data-select2-id="100">5B</option>
                                    <option value="5C" data-select2-id="101">5C</option>
                                    <option value="5D" data-select2-id="102">5D</option>
                                    <option value="5T" data-select2-id="103">5T</option>
                                    <option value="6A" data-select2-id="104">6A</option>
                                    <option value="6B" data-select2-id="105">6B</option>
                                    <option value="6C" data-select2-id="106">6C</option>
                                    <option value="6D" data-select2-id="107">6D</option>
                                    <option value="6T" data-select2-id="108">6T</option>
                                    <option value="7A" data-select2-id="109">7A</option>
                                    <option value="7B" data-select2-id="110">7B</option>
                                    <option value="7C" data-select2-id="111">7C</option>
                                    <option value="7T" data-select2-id="112">7T</option>
                         </select>
                        <span class="text-danger color-hider" id="grade_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="blood_grp">Recruiter *</label>
                        <select id="hr_recruiter" name="hr_recruiter" class="form-control" placeholder="HR Recruiter" required="">
                                <option value="">Select HR Recruiter</option>
                                 @foreach($user_info['recruiter'] as $recruiter)
                                    <option value="{{$recruiter->empID}}">{{$recruiter->username}}</option>
                                 @endforeach
                        </select>
                        <span class="text-danger color-hider" id="hr_recruiter_error"  style="display:none;color: red;"></span>      
                     </div>
                    
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="emp_code">On boarder</label>
                        <select id="hr_onboarder" name="hr_onboarder" placeholder="HR On boarder" class="form-control" required="">
                            <option value="" >Select Onboarder</option>
                                 @foreach($user_info['on_boarder'] as $on_boarder)
                                    <option value="{{$on_boarder->empID}}">{{$on_boarder->username}}</option>
                                 @endforeach
                        </select>   
                        <span class="text-danger color-hider" id="hr_onboarder_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_code">Buddy</label>
                        <select id="Buddy" name="Buddy" placeholder="Buddy" class="form-control" required="">
                            <option value="">Select Buddy</option>
                                 @foreach($user_info['Buddy'] as $Buddy)
                                    <option value="{{$Buddy->empID}}">{{$Buddy->username}}</option>
                                 @endforeach
                        </select>   
                        <span class="text-danger color-hider" id="Buddy_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_code">Additional Reporting Manager</label>
                        <select name="additional_manager[]"  id="additional_manager"   class="js-example-placeholder-multiple form-control" multiple="multiple" placeholder="Supervisor Name">
                        <option value="">Select Additional Remporting Manager</option>
                         @foreach($user_info['employee'] as $employee)
                         <option value="{{$employee->empID}}">{{$employee->username}}</option>
                         @endforeach
                       </select>                       
                        <span class="text-danger color-hider" id="additional_manager_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="emp_code">Primary Reporting Manager(Default)</label>
                        <select name="supervisor_name" id="supervisor_name" class="form-control" placeholder="Supervisor Name">
                        <option value="">Select Primary Remporting Manager</option>
                         @foreach($user_info['employee'] as $employee)
                         <option value="{{$employee->empID}}">{{$employee->username}}</option>
                         @endforeach
                       </select>                       
                        <span class="text-danger color-hider" id="supervisor_name_error"  style="display:none;color: red;"></span>
                     </div>
                  <div class="col-md-4 mb-3">
                        <label for="official_email">Reviewer</label>
                        <select name="reviewer_name" id="reviewer_name" class="form-control" placeholder="Reviewer Name">
                        <option value="">Select Reviewer</option>
                         @foreach($user_info['employee'] as $employee)
                         <option value="{{$employee->empID}}">{{$employee->username}}</option>
                         @endforeach
                       </select>
                        <span class="text-danger color-hider" id="reviewer_name_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="p_email">Work location</label>
                            <select class="form-control" placeholder="work_location" id="work_location" name="work_location" required="">
                              <option value="">Select Work Location</option>
                               <option value="Onsite">Onsite</option>
                               <option value="WFH">WFH</option>
                            </select>
                        <span class="text-danger color-hider" id="work_location_error"  style="display:none;color: red;"></span>
                     </div>
               
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="p_email">CTC Proposed</label>
                        <input class="form-control" id="ctc_proposed" onkeypress="return isNumber(event)" name="ctc_proposed" type="text" placeholder="CTC Proposed">
                        <span class="text-danger color-hider" id="ctc_proposed_error"  style="display:none;color: red;"></span>
                     </div>
                  <div class="col-md-4 mb-3">
                        <label for="official_email">DOJ</label>
                        <input class="form-control" id="DOJ" name="doj" type="date" placeholder="DOJ">
                        <span class="text-danger color-hider" id="doj_error"  style="display:none;color: red;"></span>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="p_email">Gender</label>
                            <select class="form-control" placeholder="gender" id="gender" name="gender" required="">
                               <option value="">Select Gender</option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                            </select>
                     </div>              
                  </div>
                  <div class="form-row">
                  <div class="col-md-4 mb-3">
                        <label for="p_email">Marital Status</label>
                        <select class="form-control"id="marital_status" name="marital_status" placeholder="Marital Status" >
                                                 <option value="">Select Marital Status-</option>
                                                 <option value="Single">Single</option>
                                                 <option value="Married">Married</option>
                                                 <option value="Widowed">Widowed</option>
                                                 <option value="Separated">Separated</option>
                                                 <option value="Divorced">Divorced</option>
                                             </select>
                     </div>   
                  <div class="col-md-4 mb-3">
                        <label for="official_email">Blood Group</label>
                        <select class="form-control" placeholder="Blood Group" id="blood_grp" name="blood_grp" required=""> 
                           <option value="">Select Blood Group</option>
                           <option value="A+">A+</option>
                           <option value="A-">A-</option>
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="O+">O+</option>
                           <option value="O-">O-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                        </select>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="p_email">DOB</label>
                        <input class="form-control" id="dob" name="dob" type="date" placeholder="DOB">
                     </div>
                  </div>
                  
                  <center>
                     <button class="btn btn-success" id="AddEmployeeBtn" type="button">Submit</button>
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
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>
<script src="../assets/pro_js/Add_employee.js"></script>
<script>
   var emp_info=@json($user_info['employee']);
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
