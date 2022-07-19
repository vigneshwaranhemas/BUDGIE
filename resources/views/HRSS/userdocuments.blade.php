@extends("layouts.simple.hr_master")
@section('title', 'Document Center')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .card-body p{
        margin-bottom: 3% !important;
        font-size: 15px !important;
    }
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
    }
    .card-body h5{
        margin-bottom: 3% !important;
    }

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
    color: #008CBA;
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

    .table td
    {
        border-top: none !important;
    }

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
    .card-header
    {
        background-color: rgba(0,0,0,0.03) !important;
        padding: 28px !important;
    }
    .card .card-header .card-header-right
    {
        top: 19px !important;
    }
    .card .card-body
    {
        padding: 28px !important;
    }

    .card .card-header .card-header-right{
        right: 15px !important;

    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Document Center<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

<div class="container-fluid">
    <h2>Documents</h2>
    <div class="row">
        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5> Qualification Certificate </h5>
                    <div class="card-header-right">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($candidate_info['education_info'] as $education_info)
                    <div class="col-md-12 text-center">
                        <a href="../education/{{$education_info['edu_certificate']}}" target="_blank"><button class="btn btn-primary" type="button">{{$education_info['degree']}}</button></a>
                    </div><br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>Experience Letter </h5>
                    <div class="card-header-right">
                        <i class="fa fa-clipboard"></i>
                    </div>
                </div>
                <div class="card-body">
                   @foreach($candidate_info['experience_info'] as $experience)
                    <div class="col-md-12 text-center">
                        <a href="../experience/{{$experience['certificate']}}" target="_blank"><button class="btn btn-primary" type="button">{{$experience['job_title']}}</button></a>
                    </div><br>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>Payslips/Bank Statement</h5>
                    <div class="card-header-right">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                         @if(isset($candidate_info['other_doc']->Payslips))
                           <a href="../Documents/{{$candidate_info['other_doc']->Payslips}}"  target="_blank"><button class="btn btn-primary" type="button">Payslips</button></a>
                         @endif
                    </div><br>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>Releiving Letter</h5>
                    <div class="card-header-right">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 text-center">
                    @if(isset($candidate_info['other_doc']->Relieving_letter))
                    <a href="../Documents/{{$candidate_info['other_doc']->Relieving_letter}}"  target="_blank"><button class="btn btn-primary" type="button">Releiving Letter</button></a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
               <div class="card">
                    <div class="card-header">
                        <h5>PAN Card & Aadhaar Card</h5>
                        <div class="card-header-right">
                            <i class="fa fa-file-text"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="col-md-12 text-center">
                        @if(isset($candidate_info['other_doc']->pan))
                            <a  href="../Documents/{{$candidate_info['other_doc']->pan}}"  target="_blank"><button class="btn btn-primary" type="button">PanCard</button></a>
                        @endif
                        </div><br>
                        <div class="col-md-12 text-center">
                        @if(isset($candidate_info['other_doc']->aadhar))   
                            <a  href="../Documents/{{$candidate_info['other_doc']->aadhar}}"  target="_blank"><button class="btn btn-primary" type="button">Aadhar Card</button></a>
                        @endif
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
               <div class="card">
                    <div class="card-header">
                    <div class="card-header-right">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <h5>Front Page Of Your Bank Passbook (Or) Cancelled Cheque Leaf </h5>
                       
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 text-center">
                        @if(isset($candidate_info['other_doc']->bank_passbook))
                            <a  href="../Documents/{{$candidate_info['other_doc']->bank_passbook}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                         @endif
                        </div>
                    </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-12 col-xl-4">
               <div class="card">
                    <div class="card-header">
                        <h5>Recent Passport Size Photograph</h5>
                        <div class="card-header-right">
                            <i class="fa fa-file-text"></i>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="col-md-12 text-center">
                       @if(isset($candidate_info['other_doc']->passport_photo))
                            <a  href="../Documents/{{$candidate_info['other_doc']->passport_photo}}"  target="_blank"><button class="btn btn-primary" type="button">Passport Size Photo</button></a>
                       @endif 
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>Vaccination Certificate</h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['other_doc']->Vaccination))
                                        <a  href="../Documents/{{$candidate_info['other_doc']->Vaccination}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif   
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>Updated Resume</h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['other_doc']->Resume))
                                        <a  href="../Documents/{{$candidate_info['other_doc']->Resume}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif    
                                    </div>
                                    </div>
                            </div>
                        </div>
    </div>

      <div class="row">
                <div class="col-sm-12 col-xl-4">
                    <div class="card">
                            <div class="card-header">
                                <h5>Signature</h5>
                                <div class="card-header-right">
                                    <i class="fa fa-file-text"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 text-center">
                                @if(isset($candidate_info['other_doc']->signature))
                                <a  href="../Documents/{{$candidate_info['other_doc']->signature}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                                @endif  
                            </div>
                            </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>DOB proof</h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['other_doc']->dob_proof))
                                        <a  href="../Documents/{{$candidate_info['other_doc']->dob_proof}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif 
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>Blood Group Proof</h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['other_doc']->blood_grp_proof))
                                        <a  href="../Documents/{{$candidate_info['other_doc']->blood_grp_proof}}"  target="_blank"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif   
                                    </div>
                                    </div>
                            </div>
                        </div>
      </div>
      <div class="row">
                    <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>EPF Form </h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['epf_form']))
                                            <a href="{{ url('epf_form/'.$candidate_info['epf_form']->cdID.'/'.$candidate_info['epf_form']->file_name.'') }}"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>Group Insurance Form </h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['medical_insurance']))
                                            <a href="{{ url('medical_insurance/'.$candidate_info['medical_insurance']->cdID.'/'.$candidate_info['medical_insurance']->file_name.'')}}"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4">
                            <div class="card">
                                    <div class="card-header">
                                        <h5>Welcome Aboard</h5>
                                        <div class="card-header-right">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 text-center">
                                        @if(isset($candidate_info['view_onboard']))
                                            <a href="{{ url('view_welcome_aboard_hr?id='.$candidate_info['view_onboard']->created_by.'')}}"><button class="btn btn-primary" type="button">View</button></a>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                        </div>

      </div>
      <div class="row">
        <div class="form-group test">
            <label for="exampleFormControlSelect7">Status</label>
            @if (count((array)$candidate_info['doc_status'])>0)
                <select class="form-control btn-pill digits" id="userDocStatus">
            <option  {{$candidate_info['doc_status']->doc_status == 0 ? 'selected' :'' }} value="0">Choose</option>
            <option  {{$candidate_info['doc_status']->doc_status == 2 ? 'selected' :'' }} value="2">Verified</option>
            <option  {{$candidate_info['doc_status']->doc_status == 1 ? 'selected' :'' }} value="1">Partitally Verified</option>
            </select><br>
            @else
            <select class="form-control btn-pill digits" id="userDocStatus">
                <option value="0">Choose</option>
                <option  value="2">Verified</option>
                <option  value="1">Partitally Verified</option>
            </select><br>
            @endif
        <button type="button" class="btn btn-primary" id="DocStatusBtn">Submit</button>
        <input type="hidden" name="hidden_empID" id="hidden_empId" value=@if(isset($candidate_info['doc_status'])) {{$candidate_info['doc_status']->empID}}  @endif>
        </div>
   </div>

</div>



@endsection

@section('script')
<script>
    var DocumentStatusurl="DocumentStatusUpdate";
</script>
<script src="../pro_js/HRSS/OnBoarding.js"></script>
@endsection
