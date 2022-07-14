@extends('layouts.simple.candidate_master')
@section('title', 'Business')

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
	<h2>Business<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Business</button>
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="business_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Business</th>
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
              <h5 class="modal-title" id="exampleModalLabel">Business Unit Status</h5>
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
              <h5 class="modal-title" id="exampleModalLabel">Business Unit Delete</h5>
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
<div class="modal fade" id="business_edit_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Business Unit Details</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <label for="business_name">Business Name </label>
                        <input type="text" id="business_name" class="form-control" placeholder="Business Name" name="business_name" />
                        <span class="text-danger color-hider-edit" id="business_name_error_edit" style="display:none;color: red;"></span>
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
              <h5 class="modal-title" id="exampleModalLabel">Add Business</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <form method="POST" action="javascript:void(0)" id="add_business_unit" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                          <label for="business_name">Business Name</label>
                          <input class="form-control" name="business_name" id="business_name_input" type="text" placeholder="Business Name" required="">
                          <span class="text-danger color-hider" id="business_name_error" style="display:none;color: red;"></span>
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

<script src="../assets/pro_js/add_business_unit.js"></script>

<script>
    var add_business_unit_process_link = "{{url('add_business_unit_process')}}";
    var get_business_unit_link_database = "{{url('get_business_unit_database')}}";
    var get_business_unit_details_link = "{{url('get_business_unit_details')}}";
    var update_business_unit_details_link = "{{url('update_business_unit_details')}}";
    var process_business_unit_status_link = "{{url('process_business_unit_status')}}";
    var process_business_unit_delete_link = "{{url('process_business_unit_delete')}}";
</script>
@endsection

