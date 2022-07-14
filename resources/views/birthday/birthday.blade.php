@extends('layouts.simple.candidate_master')
@section('title', 'Birthdays')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.css' rel='stylesheet' /> -->
<link rel="stylesheet" type="text/css" href="../assets/css/calendar.css">
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.css">
@endsection

@section('style')
<style>
/* .fc-widget-header{
   width: 143.2px !important;
}
.fc-resizable{
   max-width: fit-content;
} */
.fc-other-month .fc-day-number {
    color: #9c9897;
}
body
{
    zoom: 100%;
} 
.calendar-wrap .fc-toolbar button {
   text-transform: capitalize !important; 
}
.calendar-wrap .fc-toolbar button{
   position: inherit;
}
.calendar-wrap .fc-unthemed .fc-today{
    background: #f2ebfb;
    /* opacity: 0.1; */
    opacity: 1;
}
</style>
@endsection

@section('breadcrumb-title')
    <h2>Birthdays</h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
   <!-- <div class="col-md-12">  -->
   <select class="js-example-basic-single col-sm-12"  id="birthdays_filter_user" name="birthdays_filter_user">
      <option value="">Select Employee...</option>
      @foreach($customusers as $customuser)
         <option value="{{$customuser->empID }}">{{$customuser->username }}</option>
      @endforeach 
   </select>
   <!-- </div>  -->
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="calendar-wrap">
        <div class="row">           
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div id="cal-basic"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    <div class="modal fade" id="birthdayDetailModalList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary" style="height: 80px;">
            <p id="brd_employee_img"></p>
            <h5 class="modal-title text-center p-l-10 p-t-10" id="employee_name_show"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body">
            <!-- <div class="form-group">                              
               <p id="occassion_file_show"></p>
            </div>                       -->
            <div class="form-body">
               <div class="row">
                  <div class="col-md-12 ">
                     <div class="form-group form-row mt-1 mb-0" style="display:none">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Employee ID:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_id_show"></p>
                        </div>
                     </div>   
                     <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Designation:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_designation_show"></p>
                        </div>
                     </div>                       
                     <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Department:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_dept_show"></p>
                        </div>
                     </div>  
                     <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Email:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="email_show"></p>
                        </div>
                     </div>   
                     <!-- <div class="form-group">
                           <h6 class="f-w-700">Gender:</h6>
                           <p id="occassion_show"></p>
                     </div> -->  
                     <div class="form-group form-row mt-1 mb-0"  style="display:none">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">DOJ:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_doj_show"></p>
                        </div>
                     </div>     
                     <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">DOB:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_dob_show"></p>
                        </div>
                     </div>   
                     <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Work Location:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_wl_show"></p>
                        </div>
                     </div> 
                     <div class="form-group form-row mt-1 mb-0" style="display:none">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Payroll Status:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_ps_show"></p>
                        </div>
                     </div> 
                     <!-- <div class="form-group form-row mt-1 mb-0">
                        <div class="col-sm-5">
                           <h6 class="f-w-700">Grade:</h6>
                        </div>
                        <div class="col-sm-7">
                           <p id="employee_grade_show"></p>
                        </div>
                     </div>                      -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </div>

</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
    <!-- Calendaer -->
    <script src="../assets/js/jquery.ui.min.js"></script>
    <script src="../assets/js/calendar/moment.min.js"></script>
    <script src="../assets/js/calendar/full-calendar.min.js"></script>
    <script src="../assets/js/calendar/birthday.js"></script>    
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    -->

    <!-- Select2 -->
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>   
    <script>
      $(function() {
         // this will get the full URL at the address bar
         // var url =  window.location.href.split(/[?#]/)[0];
         var $this = $(".fc-day-grid-container");

         if ($this.hasClass('fc-scroller')) {

            $this.removeClass('fc-scroller');

         }

      });
   </script>
@endsection

