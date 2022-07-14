@extends('layouts.simple.candidate_master')
@section('title', 'Roles')

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
  <h2>Roles<span> </span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Settings</li>
  <li class="breadcrumb-item active">Roles & Permission</li> <br>
  <li class="breadcrumb-item active">Manage Roles</li> 
    
@endsection

@section('content')
<button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Roles</button>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="roles_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Role</th>
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

  <!-- Pop-up div starts-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Roles</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <form method="POST" action="javascript:void(0)" id="form_add_roles" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                          <label for="role_name">Role Name</label>
                          <input class="form-control" name="role_name" id="role_name" type="text" placeholder="Role Name" >
                          <div class="text-warning" id="role_name_error"></div>
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


      <!-- Edit pop-up model start -->
        <div class="modal fade text-left" id="role_edit_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="show_edit_pop_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Edit Role</h4>
                        <button type="button" id="close_edit_pop" class="close"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2 col-12">
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="form-group">
                                    <label for="role_name">Role Type </label>
                                    <input type="text" id="role_name_edit"
                                        class="form-control" placeholder="role Name"
                                        name="role_name" />
                                </div>
                                <div class="form-group">
                                    <label for="role_status_edit">Role Status </label>
                                    <select id="role_status_edit" class="form-control"> 
                                        <option value="active">Active</option>
                                        <option value="Inactive">InActive</option>
                                  </select>
                                </div>
                                <input type="hidden" name="ed_id" id="ed_id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-danger cancelbtn" id="editCancel" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success deletebtn"
                            id="editUpdate">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end edit -->



@endsection

@section('script')

<script src="../assets/pro_js/add_roles.js"></script>

<script>
    var add_roles_process_link = "{{url('add_roles_process')}}";
    var get_role_data_link = "{{url('get_role_data')}}";
    var get_role_details_link = "{{url('get_role_details_pop')}}";
    var update_role_unit_details_link = "{{url('update_role_unit_details')}}";
</script>
@endsection

