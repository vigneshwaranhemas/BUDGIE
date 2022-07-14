<!DOCTYPE html>
<html>
<head>
    <title>Epf Form</title>
<style>
     @media screen,
    print {
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  font-size: 14px !important;
}
.card-body p {
     margin-bottom: 0% !important; 
    font-size: 14px !important;
   
}
p{

  line-height: 0.5 !important;
    letter-spacing: 0.3px !important;}
 
   
    }
    th,
        td {
            /* text-align: left;
            vertical-align: top; */

            padding-right: 5px;
            padding-left: 5px;
            /* padding: 4px 4px 4px 4px; */
        }
    
    </style>
</head>
<body>
     <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
      
            <div class="card">
                <div class="card-body">

                    <p style="text-align: right; font-weight:bold;">New Form No:- 11 - Declaration Form </p>
                    <p style="text-align: right; font-weight:bold">(To be retained by the employer for future reference )</p>
                       <br>
                    <p style="text-align:center; font-size:18px !important; font-weight:bold !important;";>EMPLOYEES' PROVIDENT FUND ORGANISATION</p>
                    <p style="text-align: center;">Employee's Provident Fund Scheme,1952(paragraph 34 & 57) &</p>
                    <p style="text-align: center;">Employee's Pension Scheme,1995(paragraph 24) </p>
                    <table>

    <tr>
        <td>1</td>
        <td>Name of the member</td>
        <td>{{$member_name}}</td>
    </tr>
    <tr>
        <td>2</td>
       <?php if($father_name != "no_val") {?>
        <td>Father Name</td>
        <td>{{$father_name}}</td>
      <?php } 
      else {?>
        <td>Spouse Name</td>
        <td>{{$spouse_name}}</td>
      <?php } ?>
    </tr>

    <tr>
        <td>3</td>
        <td>Date of birth</td>
        <td>{{$dob}}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Gender</td>
        <td>{{$gender}}</td>
        
    </tr>
    <tr>
        <td>5</td>
        <td>Marital status</td>
        <td>{{$marry_status}}</td>

    </tr>
    <tr>
        <td>6</td>
        <td>Email id</td>
        <td>{{$email_id}}</td>
       
        </td>
    </tr>
    <tr>
        <td>7</td>
        <td>Mobile Number</td>
        <td>{{$mob}}</td>

         
        </td>
    </tr>
    <tr>
        <td>8</td>
        <td>Whether earlier a member of Employees' Provident Fund Scheme,1952</td>
        <td>{{$epfs_status}}</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Whether earlier a member of Employees' Pension Scheme,1995</td>
        <td>{{$eps_status}}</td>
    </tr>
    <tr>
        <td rowspan="5">10</td>
        <td>Previous employment details: [if Yes to 8 AND/OR 9 above]<br>
            a).	Universal Account Number:
            </td>
            @if($uan_number == "no_val")
           <?php $uan_number = ""; ?>
            @endif
            <td>{{$uan_number}}</td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b). Previous PF Account Number
            </td>
            @if($prev_pf_no == "no_val")
            <?php  $prev_pf_no = ""; ?>
            @endif
            <td>{{$prev_pf_no}}</td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c). Date of Exit from Previous Employment
            </td>
            @if($date_prev_exit == "no_val")
            <?php $date_prev_exit = ""; ?>
            @endif
            <td>{{$date_prev_exit}}</td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> d). Scheme Certificate Number (if issues)
            </td>
            @if($scheme_cert_no == "no_val")
            <?php $scheme_cert_no = ""; ?>
            @endif
            <td>{{$scheme_cert_no}}</td>
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> e).Pension Payment Number(PPO) (if issues)
            </td>
            @if($ppo == "no_val")
            <?php $ppo  = ""; ?>
            @endif
            <td>{{$ppo}}</td>
        
    </tr>
    <tr>
        <td rowspan="4">11</td> 
        <td>a.)International Worker
            </td>
            <td>{{$int_work_status}}</td>        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b).If yes, State country of origin(India/Name of other country)
            </td>
            @if($coun_origin == "no_val")
            <?php $coun_origin = ""; ?>
            @endif
            <td>{{$coun_origin}}</td>           
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Passport no
            </td>
            @if($passport_no == "no_val")
            <?php $passport_no = ""; ?>
            @endif
            <td>{{$passport_no}}</td>          
        
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Vality of passport
            </td>
            <td>From  @if($val_passport_from == "no_val")
                <?php $val_passport_from = ""; ?>
                @endif
                {{$val_passport_from}}
              To @if($val_passport_to == "no_val")
              <?php $val_passport_to = ""; ?>
              @endif
              {{$val_passport_to}}</td>
        
    </tr>
    <tr>
        <td rowspan="3">12</td> 
        <td>KYC Details: (attach self attested copies off following KYCs)<br>
            a.)Bank Account No.& IFS Code
            </td>
            <td>{{$bank_account}}</td>             
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> b).AADHAR Number
            </td>
            <td>{{$aadhar_no}}</td>             
    </tr>
    <tr>
        {{-- <td rowspan="5">10</td>  --}}
        <td> c).Permanent Account Number (PAN) (if available)
            </td>
            <?php if ($pan_no == "no_val") {
            $pan_no = "";
           } ?>
            <td>{{$pan_no}}</td> 
        
    </tr>

   
</table>
<form method="POST" action="javascript:void(0);" id="update_epf_form">
<p style="text-align:center; font-weight:bold; text-decoration: underline;">UNDERTAKING </p>
<p  style="text-align:justify;">  1) Certified that the particulars are true to the best cf my knowledge.</p>
<p  style="text-align:justify;"> 2) I authorize EPFO tO use My Aadhar for verification/authentication/eKYC purpose for service delivery.</p>
<p  style="text-align:justify;"> 3)	Kindly transfer II e funds and service details., </p>
<p  style="text-align:justify;">applicable, from the previous PF account as declared above to the present P.F. Account.</p>
    <p  style="text-align:justify;"> (The transfer would be possibIe only if the identified KYC detail </p>
        <p  style="text-align:justify;"> approved by previous employer has heen verified </p>
        <p  style="text-align:justify;">  by present employer using his Digital Signature Certificate)</p>
<p  style="text-align:justify;"> 4)	In case of changes in above details, the sanne will be intimate to employer at the earliest.</p>
<br>
<p style="text-align:center; font-weight:bold; text-decoration: underline;">Declaration by Present Employer </p>
<p  style="text-align:justify;">A.	The	member   Mr/Ms/Mrs  <strong> {{$member_name}}</strong>	has  joined  on <strong> {{$a_pf_no}}</strong> and has been allotted PF Number</p>
<p  style="text-align:justify;">B.	In case the person was earlier not a member of EPF Scheme, 1952 and EPS, 1995:</p>
<p  style="text-align:justify;">•	<span style="font-weight:bold;">(Post aIlotment of UAN)</span> The UAN allotted for the member is   <strong> {{$a_uan_no}}</strong>
   
    <p  style="text-align:justify;">The KYC details of the above member in the UAN database</p>
    <p  style="text-align:justify;">{{$ekyc_status}}</p>

    <p  style="text-align:justify;">C.	In case the person earlier a member of EPF Scheme, 1952 and EPS, 1995:</p>
    <p  style="text-align:justify;">•	The above PF Account number/UAN of the member as mentioned in (A) above has been tagged </p>
        <p  style="text-align:justify;">  with his/her LIAN/Previous member ID as declared by member.</p>
  @if($sign_status == "verified")
    <p  style="text-align:justify;">The KYC details of the above member in the UAN database have been approved with  </p>
        <p  style="text-align:justify;">Digital Signature Certificate  and transfer request has been generated on portal</p>
    @else
    <p  style="text-align:justify;">  As the DSC of establishment are not registered with EPFO, the member has been informed to file </p>
        <p  style="text-align:justify;">  physical claim (Form no:13) for transfer of funds from his previous establishment.</p>
@endif




                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</body>

</html>