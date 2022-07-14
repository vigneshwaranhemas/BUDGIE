@extends('layouts.app.master')
@section('title', 'Login')

@section('css')
<!-- tost css -->
@endsection
<link rel="stylesheet" href="{{asset('assets/toastify/toastify.css')}}">

@section('style')
<style>

  .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}

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
<div class="container-fluid p-0">
  <div class="authentication-main">
    <div class="row">
      <div class="col-md-12">
        <div class="auth-innerright">
          <div class="authentication-box">
            <div class="card-body p-0">
              <div class="cont text-center">
                <div>
                  <div class="col-xl-8 xl-100 box-col-12">
                                <div class="text-center"><a href=""><img src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a></div>

                    <div class="card year-overview">
                      <div class="row">
                        <div class="col-xl-1 col-lg-1 col-1">
                          <div class="card-header no-border d-flex">
                            <ul class="creative-dots">
                              <li class="bg-primary big-dot"></li>
                              <li class="bg-secondary semi-big-dot"></li>
                              <li class="bg-warning medium-dot"></li>
                              <li class="bg-info semi-medium-dot"></li>
                              <li class="bg-secondary semi-small-dot"></li>
                              <li class="bg-primary small-dot"></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-xl-11 col-lg-11 col-11 responsive_top">
                          <form class="theme-form mt-5 mb-5" id="loginForm" method="post" action="javascript:void(0)">
                            <h4>BUDGIE LOGIN </h4><br>
                            {{ csrf_field() }}
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-5">
                              <label class="col-form-label pt-0">Employee ID</label>
                              </div>
                              <div class="col-sm-7">
                                <input class="form-control" autocapitalize="none" autocomplete="username" name="employee_id" id="employee_id" type="text" required="">
                              </div>
                            </div>
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-5"> <label class="col-form-label">Password</label></div>
                                <div class="col-sm-7">
                                  <input class="form-control" autocomplete="current-password" name="login_password" id="login_password"  type="password" required="">
                                    <span toggle="#login_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-4"></div>
                              <div class="col-sm-4">
                                <button class="btn btn-primary btn-block" id="btnLogin" type="submit">LOGIN</button>
                              </div>
                            </div>
                            <hr></hr>
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-8">
                              <u><h6><a href="{{url('forgetPassword')}}"> Forgot Password...!</a></h6></u>
                              </div>
                            </div>
                          </form>
                          <div class="sub-cont text-center" style="left: 465px;">
                            <div class="img">
                              <div class="img__text m--up">
                                <h2 style="margin-left: -25px">Welcome To HEPL</h2>
                              </div>
                              <div class="img__text m--in">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>
<!-- login page end-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- toast js -->
<script src="{{asset('assets/toastify/toastify.js')}}"></script>

<script src="{{asset('pro_js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('pro_js/login.js')}}"></script>
<script type="text/javascript">

    $( document ).ready(function() {
        document.body.style.zoom = "90%";
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

    var login_check_process_link = "{{url('login_check_process')}}";

    /*eye hide and show in password*/
    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

</script>

 @endsection

@section('script')

@endsection
