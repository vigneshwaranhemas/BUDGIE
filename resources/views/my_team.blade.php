@extends('layouts.simple.candidate_master')
@section('title', 'User Cards')

@section('css')
@endsection

@section('style')
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
<div class="container-fluid">
   <div class="row" id="my_teams">
   </div>
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
</script>

@endsection