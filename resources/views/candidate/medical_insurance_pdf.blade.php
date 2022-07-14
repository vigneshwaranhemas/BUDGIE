<!DOCTYPE html>
<html>

<head>
    <title>Medical Insurance</title>
    <!-- <link rel="stylesheet" type="text/css" href="{{ base_path().'/assets/css/bootstrap.css' }}"> -->



    <style>
    @media screen,
    print {

        table {
            width: 100%;
            /* border-spacing: 5px 0px 5px 0px; */
            font-size:10pt;
            font-family: "Arial Narrow", Arial, sans-serif;

        }
        table, th, td,tr {
  border: 1px solid black;
  border-collapse: collapse;
}
        th,
        td {
            text-align: left;
            vertical-align: top;

            padding: 5px 5px 5px 5px;
            /* padding: 4px 4px 4px 4px; */
        }
    }

    .right_align {
        text-align: right;
    }

    .center_align {
        text-align: center;
    }
    .justify_align{
        text-align: justify;
    }
    li {
        margin-bottom: 5px;
    }

  
    .p_lh {
        line-height: 1.5;
    }
    /* span {
        page-break-after: always;
    }

    span:last-child {
        page-break-after: never;
    } */
    body{
        font-family: "Arial Narrow", Arial, sans-serif;
        font-style: normal;
        font-size:11pt;

    }
    
    </style>
</head>

<body>
    <main>
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
           
            @foreach($json as $pdv)
          
                @if($pdv['relation_name'] != "Father" && $pdv['relation_name'] != "Mother")
                <tr>
                <td>{{$pdv['insurance_name']}}</td>
                 <td>{{$pdv['relation_name']}}</td>
                 <?php 	$dob = date("d-m-Y", strtotime($pdv['dob']));?>
                 <td>{{$dob}}</td>
                 <td>{{$pdv['age']}}</td>
                 <td>{{$pdv['gender']}}</td>
                </tr>
                 @endif
           
            @endforeach
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
                @foreach($json as $pdv)
              
                    @if($pdv['relation_name'] == "Father" || $pdv['relation_name'] == "Mother") --}}
                    <tr>
                     <td>{{$pdv['insurance_name']}}</td>
                     <td>{{$pdv['relation_name']}}</td>
                     <?php 	$dob = date("d-m-Y", strtotime($pdv['dob']));?>
                     <td>{{$dob}}</td>
                     <td>{{$pdv['age']}}</td>
                     <td>{{$pdv['gender']}}</td>
                    </tr>
                     @endif 

                
                @endforeach
                   
              </tbody>
             </table>
                 
        Details of any knowledge of any positive existence or presence or any ailment existence or presence or any ailment sickness or injury which may require medical attention in immediate future and/or details of any ailment, sickness or injury which had been treated during the proceeding 12 months.
        <br>
        <br>
                                {{-- <button class="btn btn-primary" type="submit" id="btnSubmit">Save & Generate Pdf</button> --}}
                        </div>
        
        
                        </div>
                    </div>
                </form>
    </main>
</body>

</html>