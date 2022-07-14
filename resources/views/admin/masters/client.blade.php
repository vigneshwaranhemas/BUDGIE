@extends('layouts.simple.candidate_master')
@section('title', 'Client')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .dropdown-basic .dropdown .dropbtn {
        padding: 6px 14px;
    }
    .dataTables_wrapper button
    {
        border-radius: 1px;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Client<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Client</button>
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="client_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Client</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->

<!-- Status pop-up model start-->
<div class="modal fade" id="status_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Client Status</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                <h6>Are you sure you want to Change the status of this Record?</h6>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal" id="cancelSubmit">Close</button>
                  <button class="btn btn-secondary" type="button" id="confirmSubmit">Save</button>
              </div>

      </div>
    </div>
  </div>
<!-- Status pop-up model start -->

<!-- Delete pop-up model start-->
<div class="modal fade" id="delete_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Client Delete</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                <h6>Are you sure you want to Delete this Record?</h6>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal" id="deletecancelSubmit">Close</button>
                  <button class="btn btn-secondary" type="button" id="deleteconfirmSubmit">Delete</button>
              </div>

      </div>
    </div>
  </div>
<!-- Delete pop-up model start -->

<!-- Edit pop-up model start-->
<div class="modal fade" id="client_edit_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Client Details</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <label for="client_name">Client Name </label>
                        <input type="text" id="client_name" class="form-control" placeholder="Client Name" name="client_name" />
                        <span class="text-danger color-hider-edit" id="client_name_error_edit" style="display:none;color: red;"></span>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="mobile_number">Mobile Number </label>
                        <input type="text" id="mobile_number" class="form-control" onkeypress="return isNumber(event)" maxlength="10" placeholder="Mobile Number" name="mobile_number" />
                        <span class="text-danger color-hider-edit" id="mobile_number_error_edit" style="display:none;color: red;"></span>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="email">Email </label>
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" required=""/>
                        <span class="text-danger color-hider-edit" id="email_error_edit" style="display:none;color: red;"></span>
                      </div>
                      <input type="hidden" name="ed_id" id="ed_id">
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="button" id="editUpdate">Save</button>
              </div>

      </div>
    </div>
  </div>
<!-- Edit pop-up model start -->

  <!-- Pop-up div starts-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <form method="POST" action="javascript:void(0)" id="form_add_client" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                          <label for="client_name">Client Name</label>
                          <input class="form-control" name="client_name" id="client_name_input" type="text" placeholder="Client Name" required="">
                            <span class="text-danger color-hider" id="client_name_error" style="display:none;color: red;"></span>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="mobile_number">Mobile Number</label>
                        <input class="form-control" name="mobile_number" id="mobile_number_input" type="text" placeholder="Mobile Number" onkeypress="return isNumber(event)" maxlength="10" required="">
                        <span class="text-danger color-hider" id="mobile_number_error" style="display:none;color: red;"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" id="email_name_input" type="email" placeholder="Email" required="">
                        <span class="text-danger color-hider" id="email_error" style="display:none;color: red;"></span>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="button" id="btnSubmit">Save</button>
              </div>
            </form>
      </div>
    </div>
  </div>
<!-- Pop-up div Ends-->



@endsection

@section('script')

<script src="../assets/pro_js/client.js"></script>

<script>
var add_client_process_link = "{{url('add_client_process')}}";
var get_client_link_database = "{{url('get_client_database')}}";
var get_client_details_link = "{{url('get_client_details')}}";
var update_client_details_link = "{{url('update_client_details')}}";
var process_client_status_link = "{{url('process_client_status')}}";
var process_client_delete_link = "{{url('process_client_delete')}}";

function isNumber(evt) {
              evt = (evt) ? evt : window.event;
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
              }
              return true;
        }

</script>
@endsection

