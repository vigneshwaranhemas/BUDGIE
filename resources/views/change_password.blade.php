@extends('layouts.simple.candidate_master')
@section('title', 'ID Card Validation Form')

@section('css')
@endsection

@section('style')
<style type="text/css">
   .img-70
{
   width: 170px !important;
   height: 169px !important;
}
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: red;    }
    49%{    color: red; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
</style>
@endsection

@section('breadcrumb-title')
    <h2>Change<span>Password</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Change Password /</li>
@endsection

@section('content')
<div class="container-fluid">
   <div id="main">
        <div class="page-heading">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" id="changePassForm" method="post"
                                        action="javascript:void(0)">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="New Password">New Password </label>
                                                    <input type="Password" id="new_password" class="form-control"
                                                        placeholder="New Password" name="new_password" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="Confirm Password">Confirm Password</label>
                                                    <input type="Password" id="confirm_password" class="form-control"
                                                        placeholder="Confirm Password" name="confirm_password"
                                                        required />
                                                    <br>
                                                    <span id="err_message"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            </div>
                                            <div class="col-6 d-flex">

                                                <button type="submit" class="btn btn-primary me-1 mb-1"
                                                    id="btnSubmit">Submit</button>
                                                <!-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic multiple Column Form section end -->
        </div>
        </div>
</div>
@endsection

<?php
$session_val = Session::get('session_info');
        $passcode_status = $session_val['passcode_status'];
        // echo json_encode($passcode_status);
?>
@section('script')
<script src="../assets/js/form-validation-custom.js"></script>
<script src="../assets/pro_js/change_password.js"></script>

<script type="text/javascript">

     var change_password_process_link = "{{url('change_password_process')}}";

     $('#confirm_password').on('keyup', function() {
        if ($('#new_password').val() == $('#confirm_password').val()) {
            $('#err_message').html('Matching..!').css('color', 'green');
            $('#btnSubmit').prop("disabled", false);

        } else {
            $('#err_message').html('Not Matching..!').css('color', 'red');
            $('#btnSubmit').attr("disabled", 'disabled');

        }
    });

    $('#new_password').on('keyup', function() {

        if ($('#confirm_password').val() != '') {
            if ($('#new_password').val() == $('#confirm_password').val()) {
                $('#err_message').html('Matching..!').css('color', 'green');
                $('#btnSubmit').prop("disabled", false);

            } else {
                $('#err_message').html('Not Matching..!').css('color', 'red');
                $('#btnSubmit').attr("disabled", 'disabled');

            }
        }
    });

var sess_info=@json($passcode_status);
// console.log(sess_info)

if(sess_info == 0)
{
// Remove sidbar
    var $this = $(".iconsidebar-menu");
    $this.removeClass('iconbar-mainmenu-close').addClass('iconbar-second-close');

    $('.mobile-sidebar').hide();
    $('.sub_header').hide();
}


</script>
@endsection
