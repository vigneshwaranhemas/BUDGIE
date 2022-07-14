@extends('layouts.simple.candidate_master')
@section('title', 'Medical Insurance Form')


@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

<!-- summernote csss -->
<link rel="stylesheet" type="text/css" href="../assets/css/summernote.css">

@endsection

@section('style')
<style>
  
    
 

    /* input field css start*/
    .input {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 200px;
    }

    input::-webkit-input-placeholder {
    color: #aaa;
    }

    input:focus::-webkit-input-placeholder {
    color: dodgerblue;
    }

    .input:focus + .underline {
    transform: scale(1);
    }
    /* input field css end*/

  

    .editor
    {
        margin-left: -49px;
        margin-top: -58px;
    }

    .interesting_facts
    {
        width: 70%;
    }
    .text-warning
    {
        color: #ff0000!important;
    }

    .card-body p {
     margin-bottom: 0% !important; 
    font-size: 15px !important;
}
.p {
    line-height: 0.1 !important;
    letter-spacing: 0.3px !important;
    font-weight:500;
}
table, th, td {
  border: 1px solid #d4dce6;
  border-collapse: collapse;
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Medical Insurance Form<span> </span></h2>
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
        <form method="POST" action="javascript:void(0);" id="add_medical_form">
@csrf
            <div class="card">
                <div class="card-body">
                    <p style="text-align:center; font-size:18px !important; font-weight:bold !important;";>GROUP MEDICLAIM INSURANCE POLICY PROPOSAL FORM</p>
                    <p style="text-align: center;">(To be completed by each Employee/Members in respect of himself/herself and his/her </p>
                    <p style="text-align: center;">Eligible family members proposed to be covered) </p>
                    <p style="text-align:center; font-size:16px !important; font-weight:bold !important; text-decoration:underline;";>Coverage</p>

                    <p style="text-align: center;font-weight:bold !important; ">Dependants = Employee + Spouse + 2 Dependent Children only </p>
{{-- <br>
                   <p  style="text-align:left;">Medical Insurance Premium for the dependants is covered by the Principal Employer.</p>
                    <p  style="text-align:left;">The dependant details are supposed to be shared with HR at the time of joining..</p>
                    <p  style="text-align:left;">In case of new dependant additions, it should be shared within 2 weeks from the date of life </p>
                    <p  style="text-align:left;">changing events; i.e. date of marriage for spousal dependants and date of birth in case of child dependants. </p> --}}
                   <p> Medical Insurance Premium for the dependants is covered by the Principal Employer.
                    The dependant details are supposed to be shared with HR at the time of joining.
                    In case of new dependant additions, it should be shared within 2 weeks from the date of life changing events; i.e. date of marriage for spousal dependants and date of birth in case of child dependants.
                    
                    <br>
                    
                    <p  style="text-align:left;font-weight:bold !important;" >1. Details of Employees/Members including family members proposed for Insurance: </p>
<table class="table">
   <thead>
    <tr>
        <th>Name of Insured </th>
        <th>Relationship to the Employee</th>
        <th>Date of birth</th>
        <th>Age</th>
        <th>Gender</th>
    </tr>
</thead>
 <tbody>
     <tr>
     <td><input type="text" class="form-control" name="insur_name[]" id="insur_name" required></td>
     <td>Self<input type="hidden" class="form-control" name="relation[]"  value="Self"></td>
     <td><input type="date" class="form-control" name="dob[]" id="dob" required></td>
     <td><input type="text" class="form-control" name="age[]" id="age" required></td>
     <td><select class="form-control" name="gender[]" id="" required>
      <option>Select</option>
      <option value="Male">Male</option>
           <option value="Female">Female</option>

     </select>
      </td>
     </tr>
     <tr>
        <td><input type="text" class="form-control" name="insur_name[]" id="spouse_name"></td>
        <td>Spouse<input type="hidden" class="form-control" name="relation[]"  value="Spouse"></td>
        <td><input type="date" class="form-control" name="dob[]" id="sp_dob"></td>
        <td><input type="text" class="form-control" name="age[]" id="sp_age"></td>
        <td><select class="form-control" name="gender[]" id="" >
          <option>Select</option>
          <option value="Male">Male</option>
           <option value="Female">Female</option>
    
         </select></td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" name="insur_name[]" id="sd_name"></td>
            <td><select class="form-control" name="relation[]" id="son" >
              <option>Select</option>
              <option  value="Son">Son</option>
               <option value="Daughter">Daughter</option>
             </select></td>
            <td><input type="date" class="form-control" name="dob[]" id="sp_dob"></td>
            <td><input type="text" class="form-control" name="age[]" id="sp_age"></td>
            <td><input type="text" class="form-control" name="gender[]" id="sp_gender"></td>
            </tr>
            <tr>
                <td><input type="text" class="form-control" name="insur_name[]" id="sd1_name"></td>
                <td><select class="form-control"name="relation[]" id="son1" >
                  <option>Select</option>
                  <option  value="Son">Son</option>
                  <option value="Daughter">Daughter</option>
                 </select></td>
                <td><input type="date" class="form-control" name="dob[]" id="sp_dob"></td>
                <td><input type="text" class="form-control" name="age[]" id="sp_age"></td>
                <td><input type="text" class="form-control" name="gender[]" id="sp_gender1"></td>
                </tr>
 </tbody>
</table>
<p style="text-align:center; font-size:16px !important; font-weight:bold !important; text-decoration:underline;";>Coverage</p>

<p style="text-align: center;font-weight:bold !important; "> Parents only </p>
In case the employee wants to cover his/her parents under the company provided medical Insurance, the premium associated for parental coverage should be borne by the employee. This will not be covered by the employer The premium amount will be deducted from the payroll of the employee in three equal installments.
<p>*Note: Please check with the HR team in case you have any queries on parental insurance coverage.</p>         
<div class="text-center">
    <table class="table">
        <thead>
         <tr>
             <th>Name of Insured </th>
             <th>Relationship to the Employee</th>
             <th>Date of birth</th>
             <th>Age</th>
             <th>Gender</th>
         </tr>
     </thead>
      <tbody>
          <tr>
          <td><input type="text" class="form-control" name="insur_name[]" id="father_name" required></td>
          <td>Father<input type="hidden" class="form-control" name="relation[]"  value="Father"></td>
          <td><input type="date" class="form-control" name="dob[]" id="dob" required></td>
          <td><input type="text" class="form-control" name="age[]" id="age" required></td>
          <td><input type="text" class="form-control" name="gender[]" id="gender" value="Male" required></td>
          </tr>
          <tr>
             <td><input type="text" class="form-control" name="insur_name[]" id="spouse_name" required></td>
             <td>Mother<input type="hidden" class="form-control" name="relation[]"  value="Mother"></td>
             <td><input type="date" class="form-control" name="dob[]" id="" required></td>
             <td><input type="text" class="form-control" name="age[]" id="" required ></td>
             <td><input type="text" class="form-control" name="gender[]" id="" value="Female" required></td>
             </tr>
           
      </tbody>
     </table>
     	
Details of any knowledge of any positive existence or presence or any ailment existence or presence or any ailment sickness or injury which may require medical attention in immediate future and/or details of any ailment, sickness or injury which had been treated during the proceeding 12 months.
<br>
<br>
                        <button class="btn btn-primary" type="submit" id="btnSubmit">Save & Generate Pdf</button>
                </div>


                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->


@endsection

@section('script')

<!-- summernote js -->
<script src="../assets/js/editor/summernote/summernote.js"></script>
<script src="../assets/js/editor/summernote/summernote.custom.js"></script>
<!-- summernote js -->

<script src="../assets/pro_js/medical.js"></script>

<script>
var save_medical_form_link = "{{url('save_medical_form')}}";
//var update_epf_form_hr_link = "{{('update_epf_form_hr')}}"

</script>
@endsection
