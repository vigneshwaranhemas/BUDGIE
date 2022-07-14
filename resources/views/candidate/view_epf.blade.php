@extends('layouts.simple.candidate_master')
@section('title', 'Employee PF Form 11')


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
    line-height: 1 !important;
    letter-spacing: 0.3px !important;
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Employee PF Form 11<span> </span></h2>
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
          <form method="POST" action="javascript:void(0);" id="add_epf_form">
            <div class="card">
                <div class="card-body">

                    <p style="text-align: right; font-weight:bold;">New Form No:- 11 - Declaration Form </p>
                    <p style="text-align: right; font-weight:bold">(To be retained by the employer for future reference )</p>
                       <br>
                    <p style="text-align:center; font-size:18px !important; font-weight:bold !important;";>EMPLOYEES' PROVIDENT FUND ORGANISATION</p>
                    <p style="text-align: center;">Employee's Provident Fund Scheme,1952(paragraph 34 & 57) &</p>
                    <p style="text-align: center;">Employee's Pension Scheme,1995(paragraph 24) </p>
                    <?php  $sess_info=Session::get("session_info");
                    echo $cdID=$sess_info['cdID'];?>
                    <table class="table table-bordered table-striped">
<thead>
<tr>
    <th></th>
    <th></th>
    <th></th>
</tr>

</thead>
<tbody>
  
    <tr>
        <td>1</td>
        <td>Name of the member</td>
        <td><input type="text" class="form-control" name="emp_name" id="emp_name" readonly></td>
    </tr>
    <tr>
        <td>2</td>
        <td><div id="fsname"></div></td>
          </td>
        <td><input type="text" name = "f_name" id = "f_name" class="form-control test_name" disabled></td>
    </tr>

    <tr>
        <td>3</td>
        <td>Date of birth</td>
        <td><input type="date" class="form-control" name="dob" id="dob" disabled></td>
    </tr>
    <tr>
        <td>4</td>
        <td>Gender</td>
        
          <td><input type="text" class="form-control" name="gender" id="gender" disabled></td>
        
    </tr>
    <tr>
        <td>5</td>
        <td>Marital status</td>
        <td><input type="text" class="form-control" name="m_status" id="m_status" disabled></td>

    </tr>
    <tr>
        <td>6</td>
        <td>Email id</td>
        <td><input type="text" name="email_id" id="email_id" class="form-control" disabled>
       
        </td>
    </tr>
    <tr>
        <td>7</td>
        <td>Mobile Number</td>
        <td><input type="number"  name="mob_no" id="mob_no" class="form-control" disabled >

         
        </td>
    </tr>
    <tr>
        <td>8</td>
        <td>Whether earlier a member of Employees' Provident Fund Scheme,1952</td>
        <td><input type="text"  name="eps" id="epf" class="form-control" disabled >
    </tr>
    <tr>
        <td>9</td>
        <td>Whether earlier a member of Employees' Pension Scheme,1995</td>
        <td><input type="text"  name="eps" id="eps" class="form-control" disabled >
    </tr>
    <tr>
        <td rowspan="5">10</td>
        <td>Previous employment details: [if Yes to 8 AND/OR 9 above]<br>
            a).	Universal Account Number:
            </td>
            <td><input type="text" class="form-control pmd" name="uan" id="uan" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b). Previous PF Account Number
            </td>
            <td><input type="text" class="form-control pmd" name="ppf" id="ppf" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c). Date of Exit from Previous Employment
            </td>
            <td><input type="date" class="form-control pmd" name="pr_exit_date" id="pr_exit_date" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> d). Scheme Certificate Number (if issues)
            </td>
            <td><input type="text" class="form-control" name="scn" id="scn" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> e).Pension Payment Number(PPO) (if issues)
            </td>
            <td><input type="text" class="form-control" name="ppo" id="ppo" disabled></td>
        
    </tr>
    <tr>
        <td rowspan="4">11</td> 
        <td>a.)International Worker
            </td>
            <td><input type="text" class="form-control" name="inter_worker" id="inter_worker" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b).If yes, State country of origin(India/Name of other country)
            </td>
            <td><input type="text" class="form-control sco" name="sco" id="sco" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Passport no
            </td>
          <td><input type="text" class="form-control sco" name="passport_no" id="passport_no"disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Vality of passport
            </td>
            <td>From<input type="date" id ="from_date" class="form-control sco" disabled>
              To<input type="date" id ="to_date" class="form-control sco" disabled></td>
        
    </tr>
    <tr>
        <td rowspan="3">12</td> 
        <td>KYC Details: (attach self attested copies off following KYCs)<br>
            a.)Bank Account No.& IFS Code
            </td>
            <td><input type="text" class="form-control" name="bank_account" id="bank_account" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b).AADHAR Number
            </td>
            <td><input type="text" class="form-control" name="aadhar" id="aadhar" disabled></td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Permanent Account Number (PAN) (if available)
            </td>
            <td><input type="text" class="form-control" name="pan" id="pan" disabled></td>
        
    </tr>
</tbody>
   
</table>

<p style="text-align:center; font-weight:bold; text-decoration: underline;">UNDERTAKING </p>
<p  style="text-align:justify;">  1) Certified that the particulars are true to the best cf my knowledge.</p>
<p  style="text-align:justify;"> 2) I authorize EPFO tO use My Aadhar for verification/authentication/eKYC purpose for service delivery.</p>
<p  style="text-align:justify;"> 3)	Kindly transfer II e funds and service details., if applicable, from the previous PF account as declared above to the present P.F. Account.
    <p  style="text-align:justify;"> (The transfer would be possibIe only if the identified KYC detail approved by previous employer has heen verified by present employer using his Digital Signature Certificate)</p>
<p  style="text-align:justify;"> 4)	In case of changes in above details, the sanne will be intimate to employer at the earliest.</p>
<br>
{{-- <p style="text-align:center; font-weight:bold; text-decoration: underline;">Declaration by Present Employer </p>
<p  style="text-align:justify;">A.	The	member   Mr/Ms/Mrs<input class="input" type="text" name="did_in[]" id="did_in">	has  joined  on<input class="input" type="text" name="did_in[]" id="did_in"> and has been allotted PF Number</p>
<p  style="text-align:justify;">B.	In case the person was earlier not a member of EPF Scheme, 1952 and EPS, 1995:</p>
<p  style="text-align:justify;">•	<span style="font-weight:bold;">(Post aIlotment of UAN)</span> The UAN allotted for the member is<input class="input" type="text" name="did_in[]" id="did_in"></p>
    <p  style="text-align:justify; font-weight:bold;">•	Please Tick the Appropriate Option:</p>
    <p  style="text-align:justify;">The KYC details of the above member in the UAN database</p>
    <p  style="text-align:justify;"><input type="checkbox">  Have not been uploaded</p>
    <p  style="text-align:justify;"><input type="checkbox"> Have been uploaded but not approved</p>
    <p  style="text-align:justify;"><input type="checkbox">Have been uploaded and approved  with DSC</p>
    <p  style="text-align:justify;">C.	In case the person earlier a member of EPF Scheme, 1952 and EPS, 1995:</p>
    <p  style="text-align:justify;">•	The above PF Account number/UAN of the member as mentioned in (A) above has been tagged with his/her LIAN/Previous member ID as declared by member.</p>
    <p  style="text-align:justify; font-weight:bold;">•	Please Tick the Appropriate Option:</p>
    <p  style="text-align:justify;"><input type="checkbox"> The KYC details of the above member in the UAN database have been approved with Digital Signature Certificate and<br> transfer request has been generated on portal</p>
    <p  style="text-align:justify;"><input type="checkbox">  As the DSC of establishment are not registered with EPFO, the member has been informed to file physical claim (Form no:13) for transfer of funds from his previous establishment.</p> --}}



                    <div class="text-center">
                        {{-- <button class="btn btn-primary" type="submit" id="btnSubmit">Save</button> --}}
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

<script src="../assets/pro_js/view_epf.js"></script>

<script>
var get_epf_form_link = "{{url('view_epf')}}";

</script>
@endsection
