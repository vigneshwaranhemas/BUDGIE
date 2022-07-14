@extends('layouts.simple.candidate_master')
@section('title', 'Mega Menu')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/permission.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
   <h2>Roles <span>& Permission</span></h2>

@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">HRMS</li>
   <li class="breadcrumb-item">Settings</li>
   <li class="breadcrumb-item active">Roles & Permission</li>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <a  href="{{url('roles_s')}}"><button id="addRole" class="btn btn-danger waves-effect waves-light" type="button" data-toggle="modal">Manage Role</button></a>
    <br>
    <br>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="white-box">
              <div class="row">
                  <div class="col-md-12  menu_list" id="test">
                    <table  id='premission_tbody"+index+"'>
                    </table>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<!-- Common JS -->
<script src="../pro_js/admin/permission.js"></script>

<script type="text/javascript">
   $( document ).ready(function() {
          $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      });
    var get_permision_role_link = "{{url('role_list')}}";
    var get_menu_link = "{{url('menu_listing')}}";
    var get_sub_menu_save_link = "{{url('sub_menu_save_tab')}}";
</script>
@section('script')
@endsection

