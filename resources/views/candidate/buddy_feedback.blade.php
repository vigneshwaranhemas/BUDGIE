
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
	<h2>Buddy<span>Feedback </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Buddy Feedback</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
               <div class="card-body">
                  <div class="row buddy_list">
                     <div class="col-md-3">
                        <p>Employee Number</p>
                        <p>Employee Name</p>
                        <p>Department</p>
                        <p>Designation</p>
                        <p>Date of Joining</p>
                        <p>Work Location</p>
                        <p>Buddy Assigned </p>
                    </div>
                    <div class="col-md-3" style="margin-left: -53px;">
                            <p>: {{$buddy_fields['user_info']->empID}} </p>
                            <p>: {{$buddy_fields['user_info']->username}}</p>
                            <p>: {{$buddy_fields['user_info']->department}} </p>
                            <p>: {{$buddy_fields['user_info']->designation}}</p>
                            <p>: {{$buddy_fields['user_info']->doj}}</p>
                            <p>: {{$buddy_fields['user_info']->worklocation}}</p>
                            <p>: {{$buddy_fields['user_info']->buddy_name}}</p>
                    </div>

                  </div>
                  <div class="modal-body" style="margin-left: -14px;">
                    <table class="table table-custom dtable-striped table-bordered" style="width: max-content;" id="buddy_feedbacktable">
                        <thead>
                          <tr>
                            <th scope="col" rowspan="2">S.No</th>
                            <th scope="col" rowspan="2">Question / Query</th>
                            <th scope="col" colspan="5" class="text-center">Response</th>
                          </tr>
                          <tr>
                            <th scope="col">STRONGLY DISAGREE</th>
                            <th scope="col">DISAGREE</th>
                            <th scope="col">NEITEHR AGREE NOR DISAGREE</th>
                            <th scope="col">AGREE</th>
                            <th scope="col">STRONGLY AGREE</th>
                            <th scope="col">Remarks</th>
                          </tr>
                        </thead>
                        <tbody>

                            <?php $i=0;?>
                            @foreach ($buddy_fields["fields"] as $fields)
                            @if ($i<=5)
                            <tr class="countable_rows">
                            <td>{{$i+1}}</td>
                            <td>{{$fields->Buddy_feedback_fields}}
                                <input type="hidden" id="field{{$fields->id}}" value="{{$fields->id}}">
                            </td>

                             @if (count($buddy_fields["feedback_info"]) > 0)
                                <td class="text-center"><input type="checkbox" {{$buddy_fields['feedback_info'][$i]->response == 1 ? 'checked' : ''}} value="1"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}}  checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox" {{$buddy_fields['feedback_info'][$i]->response == 2 ? 'checked' : ''}} value="2"   onclick=checkbox_validator(this,"buddy{{$i}}")  class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox" {{$buddy_fields['feedback_info'][$i]->response == 3 ? 'checked' : ''}} value="3"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox" {{$buddy_fields['feedback_info'][$i]->response == 4 ? 'checked' : ''}} value="4"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox" {{$buddy_fields['feedback_info'][$i]->response == 5 ? 'checked' : ''}} value="5"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td>
                                    <textarea style="width: 178px; height:52px;">{{$buddy_fields['feedback_info'][$i]->remarks}}</textarea>
                                </td>
                                </tr>
                             @else
                                <td class="text-center"><input type="checkbox"  value="1"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}}  checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox"  value="2"  onclick=checkbox_validator(this,"buddy{{$i}}")  class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox"  value="3"  onclick=checkbox_validator(this,"buddy{{$i}}")  class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox"  value="4"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td class="text-center"><input type="checkbox"  value="5"   onclick=checkbox_validator(this,"buddy{{$i}}") class="buddy{{$i}} checkboxchecker" name="buddy{{$i}}"></td>
                                <td><textarea style="width: 178px; height:52px;"></textarea></td>

                               </tr>
                             @endif

                            @endif

                             <?php  $i++;?>

                            @endforeach


                        </tbody>
                      </table>



                </div>
                <div class="modal-body">

                    <?php $i=0;?>
                    @foreach ($buddy_fields["fields"] as $fields)
                    @if ($i>5)
                    <div class="row">
                        @if (count($buddy_fields["feedback_info"]) > 0)
                            <div class="col-sm-12" id="target{{$fields->id}}">
                                <p> {{$i+1}}).  {{$fields->Buddy_feedback_fields}}</p>
                                <input type="hidden" id="field{{$fields->id}}"  value="{{$fields->id}}"></td>
                             <div class="form-group row">
                                <div class="col-sm-4">
                                    <textarea>{{$buddy_fields['feedback_info'][$i]->comments0}}</textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea>{{$buddy_fields['feedback_info'][$i]->comments1}}</textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea>{{$buddy_fields['feedback_info'][$i]->comments2}}</textarea>
                                </div>
                             </div>
                            </div>
                           @else
                            <div class="col-sm-12" id="target{{$fields->id}}">
                                <p> {{$i+1}}).  {{$fields->Buddy_feedback_fields}}</p>
                                <div class="form-group row">
                                <input type="hidden" id="field{{$fields->id}}"  value="{{$fields->id}}"></td>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div>
                                </div>
                            </div>
                    @endif
                </div>

                    @endif
                     <?php
                     $i++;?>

                    @endforeach

                </div>

                <div class="text-center moves">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                    <input type="hidden" value={{$sess_info["empID"]}}  id="sess_emp_id">
                        <button type="button" id="BuddyFeedbackBtn" style="display:none;" class="btn btn-info">Submit</button>
                </div>



               </div>


          </div>

        </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../pro_js/preonboarding/preonboarding.js"></script>
<script>

var fields_info=@json($buddy_fields["fields"]);


$(()=>{
      var data=@json($buddy_fields["feedback_info"]);
      if(data.length>0)
      {
           $("#BuddyFeedbackBtn").hide();
      }
      else{
          $('#BuddyFeedbackBtn').show();
      }
})

function checkbox_validator(one,two){
    $('.'+two).not(one).prop('checked', false);
}


</script>

