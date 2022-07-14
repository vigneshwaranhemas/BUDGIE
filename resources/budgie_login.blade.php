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

  body {
  background: #ddd3de;
}
.wrapper {
  position: absolute;
  top: 65%;
  left: 80%;
  transform: translate(-50%, -50%);
}

.grass {
  position: absolute;
  top: 71%;
  left: -11%;
  width: 122%;
  height: 100px;
  background-image: url("https://lukw4l.de/utils/media/assets/robin/grass.png");
  background-repeat: repeat;
  background-size: 200px 100px;
  transform: translate(0, 95px);
}

.note {
  position: absolute;
  left: -180px;
  top: -100px;
  opacity: 0;
}

.note#moveNote1 {
  animation: 2s moveNote1 ease-out infinite;
  animation-delay: 500ms;
}
.note#moveNote2 {
  animation: 2s moveNote2 ease-out infinite;
}

.note .circle {
  position: absolute;
  height: 10px;
  width: 10px;
  background: black;
  border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
}
.note .circle#circle1 {
}
.note .circle#circle2 {
  left: 20px;
}

.note .flank {
  position: absolute;
  height: 20px;
  width: 2px;
  background: black;
}
.note .flank#flank1 {
  left: 8px;
  top: -14px;
}
.note .flank#flank2 {
  left: 28px;
  top: -14px;
}

.note .bar {
  position: absolute;
  width: 22px;
  height: 7px;
  top: -20px;
  left: 8px;
  background: black;
}

@keyframes moveNote1 {
  0% {
    opacity: 0;
    transform: translate3d(0px, 0px, 0px);
  }
  10% {
    opacity: 0;
  }
  20% {
    transform: translate3d(-10px, -10px, -10px);
    opacity: 1;
  }
  100% {
    transform: translate3d(-50px, -50px, -50px) rotate(-30deg);
    opacity: 0;
  }
}
@keyframes moveNote2 {
  0% {
    opacity: 0;
    transform: translate3d(0px, 0px, 0px);
  }
  10% {
    opacity: 0;
  }
  20% {
    transform: translate3d(-10px, -20px, -10px);
    opacity: 1;
  }
  100% {
    transform: translate3d(-50px, -100px, -50px) rotate(30deg);
    opacity: 0;
  }
}

.robin .wing {
  width: 130px;
  height: 130px;
  background: #40332a;
  position: absolute;
  border-radius: 14% 86% 0% 100% / 12% 100% 0% 88%;
  top: -30px;
  left: -22px;
  transform: rotate(-10deg);
  animation: 2s moveWing infinite;
}
.robin .belly1 {
  width: 200px;
  height: 200px;
  background: #eeecef;
  position: absolute;
  border-radius: 38% 62% 52% 48% / 51% 74% 26% 49%;
  top: -88px;
  left: -128px;
  clip-path: polygon(0 28%, 100% 67%, 100% 100%, 0% 100%);
}
.robin .belly2 {
  width: 150px;
  height: 150px;
  background: #bbbdbc;
  position: absolute;
  border-radius: 38% 62% 38% 62% / 51% 74% 26% 49%;
  top: -50px;
  left: -80px;
  clip-path: polygon(0 29%, 100% 54%, 100% 100%, 0% 100%);
}

.robin .backHead {
  width: 220px;
  height: 220px;
  background: #807267;
  position: absolute;
  border-radius: 30% 70% 25% 75% / 26% 96% 4% 74%;
  top: -110px;
  left: -140px;
  transform: rotate(20deg);
  clip-path: polygon(0 0, 100% 0, 100% 73%, 0 72%);
}

.robin .face1 {
  width: 100px;
  height: 120px;
  background: rgb(237, 132, 67);
  background: linear-gradient(
    160deg,
    rgba(237, 132, 67, 1) 0%,
    rgba(237, 132, 67, 1) 68%,
    rgba(246, 167, 111, 1) 90%,
    rgba(246, 167, 111, 1) 100%
  );
  position: absolute;
  border-radius: 50% 50% 49% 51% / 63% 66% 34% 37%;
  top: -70px;
  left: -130px;
  transform: rotate(-5deg);
}

.robin .face2 {
  width: 50px;
  height: 120px;
  background: #ee8140;
  position: absolute;
  border-radius: 50% 50% 49% 51% / 63% 66% 34% 37%;
  top: -100px;
  left: -126px;
  transform: rotate(0deg);
}

.robin .face3 {
  width: 45px;
  height: 55px;
  background: #ee8140;
  position: absolute;
  border-radius: 26% 74% 0% 100% / 0% 58% 42% 100%;
  top: -104px;
  left: -110px;
  transform: rotate(-20deg);
  clip-path: polygon(30% 0, 100% 0, 100% 100%, 0% 100%);
}

.robin .face4 {
  width: 85px;
  height: 50px;
  background: #ee8140;
  position: absolute;
  border-radius: 26% 74% 0% 100% / 100% 85% 15% 0%;
  top: -50px;
  left: -100px;
  transform: rotate(0deg);
}

.robin .eye1 {
  width: 22px;
  height: 20px;
  background: #f7fadd;
  position: absolute;
  border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
  top: -91px;
  left: -90px;
  transform: rotate(0deg);
}

.robin .eye2 {
  width: 20px;
  height: 20px;
  background: #151e04;
  position: absolute;
  border-radius: 50% 50% 50% 50% / 50% 50% 50% 50%;
  top: -90px;
  left: -90px;
  transform: rotate(0deg);
}

.robin .leftLeg {
  width: 5px;
  height: 100px;
  background: #807464;
  position: absolute;
  border-radius: 100% 0% 50% 50% / 100% 0% 100% 0%;
  top: 60px;
  left: -80px;
  transform: rotate(30deg);
}
.robin .rightLeg {
  width: 5px;
  height: 100px;
  background: #807464;
  position: absolute;
  border-radius: 100% 0% 50% 50% / 100% 0% 100% 0%;
  top: 60px;
  left: 0px;
  transform: rotate(10deg);
}

.robin .tail1 {
  width: 130px;
  height: 130px;
  background: #9ea09f;
  position: absolute;
  top: 10px;
  left: 35px;
  transform: rotate(-30deg);
  clip-path: polygon(99% 97%, 49% 1%, 2% 26%);
  animation: 2s moveTail1 infinite;
}

.robin .tail2 {
  width: 130px;
  height: 130px;
  background: #7b7b79;
  position: absolute;
  top: 5px;
  left: 30px;
  transform: rotate(-30deg);
  clip-path: polygon(99% 97%, 49% 1%, 2% 26%);
  animation: 2s moveTail2 infinite;
}

.robin .leftLeg .foot1 {
}

.robin .mouth {
  width: 60px;
  height: 60px;
  background: #807265;
  position: absolute;
  top: -100px;
  left: -170px;
  clip-path: polygon(
    100% 50%,
    96% 49%,
    94% 46%,
    91% 42%,
    90% 38%,
    89% 33%,
    87% 30%,
    84% 30%,
    81% 30%,
    11% 37%,
    6% 39%,
    5% 43%,
    6% 45%,
    7% 47%
  );
  animation: 2s openMouth1 infinite;
  transform-origin: right center;
}

.robin .mouth#mouth2 {
  height: 35px;
  top: -88px;
  background: #403531;
  transform: scaley(-1) rotate(-3deg);
  animation: 2s openMouth2 infinite;
}

@keyframes openMouth1 {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(5deg);
  }
  15% {
    transform: rotate(4deg);
  }
  20% {
    transform: rotate(5deg);
  }
  25% {
    transform: rotate(2deg);
  }
  40% {
    transform: rotate(5deg);
  }
}
@keyframes openMouth2 {
  0% {
    transform: scaley(-1) rotate(-3deg);
  }
  15% {
    transform: scaley(-1) rotate(8deg);
  }
  20% {
    transform: scaley(-1) rotate(10deg);
  }
  25% {
    transform: scaley(-1) rotate(7deg);
  }
  40% {
    transform: scaley(-1) rotate(12deg);
  }
}

@keyframes moveWing {
  0% {
    transform: rotate(-10deg);
  }
  20% {
    transform: rotate(-15deg);
  }
}

@keyframes moveTail1 {
  0% {
    transform: rotate(-30deg);
  }
  20% {
    transform: rotate(-32deg) translate(15px, 5px);
  }
}
@keyframes moveTail2 {
  0% {
    transform: rotate(-30deg);
  }
  20% {
    transform: rotate(-32deg) translate(10px, 0px);
  }
}

.robin {
  animation: 2s shake infinite;
}

@keyframes shake {
  10%,
  30%,
  50% {
    transform: translate3d(-1px, 0, 0);
  }

  20%,
  40% {
    transform: translate3d(1px, 0, 0);
  }
}

.round {
  filter: url(#round);
}

@media only screen and (max-width: 600px) {
  .wrapper {
    display: none;
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
                <div class="sample" style="height: 70%; margin-bottom: 90px;">
                  <div class="col-xl-8 xl-100 box-col-12" style="margin-bottom: -195px;">
                                <div class="text-center" style="margin-top: -101px;"><a href=""><img src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a></div>

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
                            <!-- <div class="img">
                              <div class="img__text m--up">
                                <h2 style="margin-left: -25px">Welcome To HEPL</h2>
                              </div>
                              <div class="img__text m--in">
                              </div>
                            </div> -->
                          </div>
                        </div>
                        <!-- 🦉🦚🦜🦢🦩🐦🐧🦅🦆 -->
                            <!-- NOT FINIDHED YET :) -->
                            <div class="wrapper">
                              <div class="robin">
                                <div class="round">
                                  <div class="tail1"></div>
                                  <div class="tail2"></div>
                                </div>
                                <div class="leftLeg">
                                  <div class="foot1"></div>
                                </div>
                                <div class="backHead"></div>
                                <div class="belly1"></div>
                                <div class="rightLeg"></div>
                                <div class="belly2"></div>
                                <div class="face1"></div>
                                <div class="face2"></div>
                                <div class="face3"></div>
                                <div class="face4"></div>
                                <div class="wing"></div>
                                <div class="eye1"></div>
                                <div class="eye2"></div>
                                <div class="mouth" id="mouth2"></div>
                                <div class="mouth" id="mouth1"></div>
                              </div>
                              <div class="note" id="moveNote1">
                                <div class="circle" id="circle1"></div>
                                <div class="circle" id="circle2"></div>
                                <div class="flank" id="flank1"></div>
                                <div class="flank" id="flank2"></div>
                                <div class="bar"></div>
                              </div>
                              <div class="note" id="moveNote2">
                                <div class="circle" id="circle1"></div>
                                <div class="circle" id="circle2"></div>
                                <div class="flank" id="flank1"></div>
                                <div class="flank" id="flank2"></div>
                                <div class="bar"></div>
                              </div>
                            </div>
                            <div class="grass">
                            </div>

                            <svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
                              <defs>
                                <filter id="round">
                                  <feGaussianBlur in="SourceGraphic" stdDeviation="3" result="blur" />
                                  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -9" result="goo" />
                                  <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                                </filter>
                              </defs>
                            </svg>
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
