<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="{{route('/')}}/assets/images/favicon.png" type="image/x-icon">
      <link rel="shortcut icon" href="{{route('/')}}/assets/images/favicon.png" type="image/x-icon">
      <title>Poco - @yield('title')</title>
      @include('layouts.raised_button.css')
      @yield('style')
   </head>
   <body>
      <!-- Loader starts-->
      <div class="loader-wrapper"><span class="loaderSpan span1"></span><span class="loaderSpan span2"></span><span class="loaderSpan span3"></span><span class="loaderSpan span4"></span><span class="loaderSpan span5"></span><span class="loaderSpan span6"></span><span class="loaderSpan span7"></span><span class="loaderSpan span8"></span><span class="loaderSpan span9"></span></div>
      <!-- Loader ends-->
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         @include('layouts.raised_button.header')
         <!-- Page Header Ends                              -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.raised_button.sidebar')
            <!-- Page Sidebar Ends-->
            <!-- Right sidebar Start-->
            @include('layouts.raised_button.chat_sidebar')
            <!-- Right sidebar Ends-->
            <div class="page-body">
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                            @yield('breadcrumb-title')
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                              @yield('breadcrumb-items')
                            </ol>
                        </div>
                        <div class="col-lg-6">
                           <!-- Bookmark Start-->
                           <div class="bookmark pull-right">
                              <ul>
                                 <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Calendar"><i data-feather="inbox"></i></a></li>
                                 <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Calendar"><i data-feather="message-square"></i></a></li>
                                 <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Mail"><i data-feather="command"></i></a></li>
                                 <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="layers"></i></a></li>
                                 <li>
                                    <a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                       <div class="form-group form-control-search">
                                          <input type="text" placeholder="Search..">
                                       </div>
                                    </form>
                                 </li>
                              </ul>
                           </div>
                           <!-- Bookmark Ends-->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               @yield('content')
               <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.raised_button.footer')
         </div>
      </div>
      @include('layouts.raised_button.script')  
   </body>
</html>