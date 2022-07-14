@extends('layouts.simple.candidate_master')
@section('title', 'Payslip')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>

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
    .list-group-items
    {
        border: 1px solid rgba(0,0,0,0.125);
        cursor: pointer;
    }
    .top-left
    {
        margin-left: 45px;
        margin-top: 9px;
    }
    .last-update
    {
        margin-left: 45px;
    }
    .last-right
    {
        margin-top: 9px;
    }

    /* arrow css */
    .arrow {
        position: absolute;
        top: 28px;
        left: 26px;
    }

    .arrow::before,
    .arrow::after {
    position: relative;
    content: '';
    display: block;
    width: 10px;
    height: 1px;
    background: black;
    transition: 0.3s ease-in-out;
    }

    .arrow::before {
    transform: rotate(45deg);
    }

    .arrow::after {
    left: 6px;
    top: -1px;
    transform: rotate(-45deg);
    }

    .list-group-items.active .arrow::before {
    transform: rotate(-45deg);
    }

    .list-group-items.active .arrow::after {
    transform: rotate(45deg);
    }

</style>
@endsection

@section('breadcrumb-title')
	<h2>Payslip<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="card">
               <div class="card-header">
                  <h5>Document Center / Payslip</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="list-home">2021</a>

                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">2020</a>

                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">2019</a>

                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">2018</a></div>
                     </div>
                     <div class="col-sm-8">
                        <div class="tab-content" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_first" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> March 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_first" aria-labelledby="collapseicon_first" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_second" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Feb 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_second" aria-labelledby="collapseicon_second" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_third" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Jan 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_third" aria-labelledby="collapseicon_third" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>



                           </div>


                           <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_first" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> March 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_first" aria-labelledby="collapseicon_first" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_second" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Feb 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_second" aria-labelledby="collapseicon_second" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_third" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Jan 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_third" aria-labelledby="collapseicon_third" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            </div>

                           <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_first" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> March 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_first" aria-labelledby="collapseicon_first" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_second" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Feb 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_second" aria-labelledby="collapseicon_second" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_third" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Jan 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_third" aria-labelledby="collapseicon_third" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>
                           </div>

                           <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_first" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> March 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_first" aria-labelledby="collapseicon_first" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_second" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Feb 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_second" aria-labelledby="collapseicon_second" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-table">
                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_third" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <span class="arrow"></span>
                                            <h5 class="top-left"> Jan 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="last-right"> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_third" aria-labelledby="collapseicon_third" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href="{{url('assets/payslip/900002/March-2022/march-2022.pdf')}}" download><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
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
</div>


@endsection

@section('script')

<script>

$('.list-group-items').on('click', function() {
  $(this).toggleClass('active')
});

</script>
@endsection
