@extends('layouts.app.master')
 @section('title', 'Login')

@section('css')
<!-- tost css -->
@endsection
<link rel="stylesheet" href="../assets/toastify/toastify.css">

@section('style')
<style>
  .authentication-main .auth-innerright .card-body .theme-form{
    /* width: 500px !important; */
    width: 336px !important;
  }

  @media only screen and (max-width: 991px){
    .authentication-main .auth-innerright .card-body .theme-form{
      width: 100% !important;
      padding: 20px;
      /* margin-left: -20px; */
    }
  }

  @media only screen and (max-width: 425px){
    .responsive_top{
      margin-top: -130px;
    }
  }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<!-- login page start-->
<div class="container-fluid">
  <div class="authentication-main">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="auth-innerright auth-minibox">
          <div class="reset-password-box">
            <div class="text-center"><a href=""><img src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a></div>
            <center>
              <div class="card mt-4 mb-0">
              <div class="card-body p-0">
                <h4>Reset Your Password</h4>
               <form class="theme-form mt-5 mb-5" id="forgot_pass" method="post" action="javascript:void(0)">
                  {{ csrf_field() }}
                  <div class="form-group form-row mt-3 mb-0">
                    <div class="col-sm-3"><label>Employee ID</label></div>
                    <div class="col-sm-9">
                      <input class="form-control" name="employee_id" id="employee_id" type="text" onfocusout="getEmpemail()">
                      <span class="text-danger color-hider" id="employee_id_error" style="display:none;color: red;"></span>
                    </div>
                  </div>
                  <div class="form-group form-row mt-3 mb-0">
                    <div class="col-sm-3"> <label class="col-form-label pt-0">Email</label></div>
                    <div class="col-sm-9">
                    <input class="form-control"  name="emp_email" id="emp_email"  type="email" readonly>
                    <span class="text-danger color-hider" id="emp_email_error" style="display:none;color: red;"></span>
                    </div>
                  </div>
                  <span id="err_message"></span>
                  <br>
                  <div class="form-group">
                        <button class="btn btn-primary" id="forgot_pass_but" type="submit">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            </center>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- login page end-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- toast js -->
<script src="../assets/toastify/toastify.js"></script>

<script src="../pro_js/jquery/jquery.min.js"></script>
<script src="../pro_js/login.js"></script>
<script type="text/javascript">

    $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

    var forgot_pass_process_link = "{{url('forgot_pass_process')}}";
    var getemail_process_link = "{{url('getemail_process')}}";

</script>

 @endsection

@section('script')

@endsection
