@extends('layouts.app.master')
@section('title', 'Login')

@section('css')
<!-- tost css -->
<link rel="stylesheet" href="../assets/toastify/toastify.css">

@endsection
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
               <form class="theme-form mt-5 mb-5" id="con_pass" method="post" action="javascript:void(0)">
                  {{ csrf_field() }}
                  <div class="form-group form-row mt-3 mb-0">
                    <div class="col-sm-5">
                    <label class="col-form-label pt-0">New Password </label>
                    </div>
                    <div class="col-sm-7">
                      <input class="form-control" name="new_pass" id="new_pass" type="password" >
                       <span class="text-danger color-hider" id="new_pass_error" style="display:none;color: red;"></span>
                    </div>
                  </div>
                  <div class="form-group form-row mt-3 mb-0">
                    <div class="col-sm-5"> <label class="col-form-label">Confirm Password </label></div>
                    <div class="col-sm-7">
                    <input class="form-control"  name="con_pass" id="con_pass"  type="password" >
                     <span class="text-danger color-hider" id="con_pass_error" style="display:none;color: red;"></span>
                  </div>
                  </div>
                  <div class="form-group form-row mt-3 mb-0">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-6">
                      <button class="btn btn-primary btn-block" id="btnLogin" type="submit">Save</button>
                    </div>
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

 @endsection

@section('script')
<!-- login page end-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- toast js -->
<script src="{{asset('assets/toastify/toastify.js')}}"></script>
<script src="{{asset('pro_js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('pro_js/login.js')}}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    var login_check_process_link = "{{url('login_check_process')}}";
    var con_pass_process_link = "{{url('con_pass_process')}}";
    var new_value =@json($test);
</script>
@endsection
