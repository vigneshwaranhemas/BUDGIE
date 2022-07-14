<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app (Laravel 8)">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>BUDGIE - @yield('title')</title>
    @include('layouts.simple.css')
    @yield('style')

  </head>
  <body class="@if(url()->current() == route('button-builder'))  button-builder @endif">
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="typewriter">
        <h1>BUDGIE Loading...</h1>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <!-- Page Header Start-->
      @include('layouts.simple.header')
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.simple.common_sidebar')
        <!-- Page Sidebar Ends-->
        <!-- Right sidebar Start-->
        @include('layouts.simple.chat_sidebar')
        <!-- Right sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                 <div class="row">
                    <div class="col-lg-6 main-header">
                        @yield('breadcrumb-title')
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                       <ol class="breadcrumb">
                          <!-- <li class="breadcrumb-item"><a href=".."><i class="pe-7s-home"></i></a></li> -->
                          @yield('breadcrumb-items')
                       </ol>
                    </div>
                 </div>
              </div>
            </div>
            @yield('content')
            {{--<div class="welcome-popup modal fade" id="loadModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body">
                       <div class="modal-header"></div>
                       <div class="contain p-30">
                          <div class="text-center">
                             <h3>Welcome to BUDGIE</h3>
                             <h4 style="color:red;">Please Complete Your PMS Details </h4>
                             <a class="btn btn-primary btn-lg txt-white"  href="{{ url('pms_conformation') }}" aria-label="Close">Get Started</a>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </div>--}}
        </div>
        <!-- footer start-->
        @include('layouts.simple.footer')
      </div>
    </div>
    @include('layouts.simple.script')
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        pms_page_url();
    });
    function pms_page_url(){
                    $.ajax({
                    type: "POST",
                    url: "pms_status_popup",
                    data: {},
                    dataType: "json",
                    success: function (data) {
                        // console.log(data)
                        if (data.pms_status == 1) {
                            url= "goals";
                            $("#pms_status").attr("href", url);
                        }else{
                            url= "pms_conformation";
                            $("#pms_status").attr("href", url);
                        }
                    }
                });
            }
</script>