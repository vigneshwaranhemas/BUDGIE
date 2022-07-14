<?php
$sess_info=Session::get("session_info");

?>
@extends('layouts.simple.candidate_master')
@section('title', 'Buddy Feedback')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/prism.css')}}">
    <!-- Plugins css start-->
@endsection

@section('style')
<style>
.table th
{
    width:1px;
}
.table th
{
    border: 1px solid #dee2e6;
}
.table td
{
    border: 1px solid #dee2e6;
}
.buddy_list
{
    padding-bottom: 50px;
}
</style>
@endsection
@section('breadcrumb-title')
	<h2>Induction<span>Schedule</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Induction Schedule</li>
@endsection

@section('content')

                            <div class="modal-body">
                                    <table class="table table-custom dtable-striped table-bordered" border="1px solid black" style=" border-collapse:collapse;" id="buddy_feedbacktable">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="4" class="text-center" style="background-color:#00CED1;">Response</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Program</th>
                                                <th scope="col">Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="countable_rows">
                                                <td>10:00 AM</td>
                                                <td>10:30 AM</td>
                                                <td>On-boarding (Document Verification, Filling of Joining particulars etc) </td>
                                                <td rowspan="8">HR Advisor</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>10:45 AM</td>
                                                <td>11:30 AM</td>
                                                <td>HEPL Induction</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>11:30 AM</td>
                                                <td>11:45 AM </td>
                                                <td>Tea Break</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>11:45 AM</td>
                                                <td>1:15 PM</td>
                                                <td>HEPL Induction continued</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>1:15 PM </td>
                                                <td>1:30PM</td>
                                                <td>Reporting Manager & Team Introductories </td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>1:30 PM</td>
                                                <td>2:15 PM</td>
                                                <td>Lunch Break</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>2:30 PM</td>
                                                <td>4:30 PM</td>
                                                <td>CK Swagatham  - Introduction about our Group & Sister Companies   </td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>4:30 PM</td>
                                                <td>4:45 PM</td>
                                                <td>Tea Break</td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>4:45 PM</td>
                                                <td>5:15 PM  </td>
                                                <td>Closing & Assignment to Host</td>
                                                <td>Buddy</td>
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
