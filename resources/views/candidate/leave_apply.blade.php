@extends('layouts.simple.candidate_master')
@section('title', 'Leave Balance')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
.card .card-header
{
    border-bottom: 0px solid #f2f4ff;
}
.leave-balance-header
{
    display: flex;
    flex-direction: row;
    justify-content: right;
    align-items: center;
}

</style>
@endsection

@section('breadcrumb-title')
	<h2>Leave Balance<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-3 col-xs-12">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Leave</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Restricted Holiday</a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Leave Cancel</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Comp Off Grant</a></div>
                     </div>
                     <div class="col-sm-9 col-xs-12">
                        <div class="tab-content" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                            <div class="col-sm-12 col-xl-6 xl-100">
                                <div class="card">
                                   <div class="card-body">
                                      <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                         <li class="nav-item">
                                             <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Apply</a>
                                        </li>
                                         <li class="nav-item">
                                             <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pending</a>
                                        </li>
                                         <li class="nav-item">
                                             <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">History</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content" id="pills-tabContent">
                                         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                             <div class="alert alert-info dark" role="alert" style="margin-top: 12px;">
                                                <p>Leave is earned by an employee and granted by the employer to take time off work. The employee is free to avail this leave in accordance with the company policy.</p>
                                             </div>
                                             <h5>Applying for Leave</h5>

                                             <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="add_policy_information" class="ajax-form">
                                                {{ csrf_field() }}
                                              <div class="modal-body">
                                                  <div class="form-row">
                                                      <div class="col-md-4 mb-3">
                                                          <label for="policy_category">Leave Type</label>
                                                          <select class="form-control" id="policy_category" name="policy_category" required="">
                                                              <option value="">Select</option>
                                                              <option value="loss_of_pay">Loss Of Pay</option>
                                                              <option value="on_duty">On Duty</option>
                                                              <option value="probationary_leave">Probationary Leave</option>
                                                              <option value="work_from_home">Work From Home</option>
                                                              <option value="privilege_leave">Privilege Leave</option>
                                                              <option value="sick_leave">Sick Leave</option>
                                                              <option value="casual_leave">Casual Leave</option>
                                                          </select>
                                                          <div class="text-danger" id="policy_category_information_error"></div>
                                                      </div>
                                                      <div class="col-md-2 mb-3"></div>
                                                      <div class="col-md-6 mb-3" style="margin-top: 31px;">
                                                        <label for="policy_category">Balance: </label> <span id="balance"></span>
                                                      </div>
                                                      <div class="col-md-12 mb-3">
                                                        <label for="policy_title">Policy Title</label>
                                                        <input class="form-control" name="policy_title" id="policy_title_input" type="text" placeholder="Policy Title" required="">
                                                        <div class="text-danger" id="policy_title_error"></div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="policy_description">Policy Description</label>
                                                        <textarea class="form-control" name="policy_description" id="policy_description_input" rows="4" cols="50" required=""></textarea>
                                                        <div class="text-danger" id="policy_description_error"></div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="policy_category">File Upload</label>
                                                        <input class="form-control" name="file" id="file" type="file" accept=".pdf,.doc" required="">
                                                        <span>File upload accepts only pdf and docs...</span>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                                  <button class="btn btn-secondary" type="submit" id="info_submit">Save</button>
                                              </div>
                                            </form>

                                         </div>
                                         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                         </div>
                                         <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>

                           </div>
                           <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
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

<script src="../assets/pro_js/leave_apply.js"></script>

<script>
var get_leave_masters_details_link = "{{url('get_leave_masters_details')}}";
</script>
@endsection
