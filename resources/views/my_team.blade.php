@extends('layouts.simple.candidate_master')
@section('title', 'User Cards')

@section('css')
@endsection

@section('style')
<style type="text/css">
      span.italic {
     font-style: italic;
   }
   /*span.small {
  font-variant: small-caps;
}*/
.pointer{
        cursor: pointer;
    }
</style>
@endsection

@section('breadcrumb-title')
   <h2>My<span>Teams</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Apps</li>
   <li class="breadcrumb-item">User</li>
   <li class="breadcrumb-item active">My Teams</li>
@endsection

@section('content')
<!-- <div class="container-fluid">
   <div class="row" id="my_teams">
   </div>
   <div class="card-footer row" id="exp_information">
   </div>
</div> -->
   <div class="col-sm-4 mb-3">
       <select class="form-control js-example-basic-single" name="team_members_list" id="team_members_list">
          <option value="">-Select Team Member-</option>
      </select>
   </div>
   <div class="container-fluid">
      <div class="row" id="my_teams">
         
      </div>
      <!-- <div class="card-footer row" id="exp_information">
      </div> -->
   </div>
@endsection

@section('script')
<script src="../pro_js/my_team.js"></script>
<script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_team_tl_link = "{{url('my_team_tl_info')}}";
    var my_team_experience_info_link = "{{url('my_team_experience_info')}}";
    var my_team_members_list_link_page = "{{url('my_team_members_list_link')}}";
</script>

@endsection