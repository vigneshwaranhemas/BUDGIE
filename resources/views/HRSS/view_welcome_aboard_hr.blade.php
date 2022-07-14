@extends('layouts.simple.candidate_master')
@section('title', 'Welcome Aboard')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

<!-- summernote csss -->
<link rel="stylesheet" type="text/css" href="../assets/css/summernote.css">

@endsection

@section('style')
<style>
    .card-body p{
        margin-bottom: 3% !important;
        font-size: 15px !important;
    }
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
    }
    .card-body h5{
        margin-bottom: 3% !important;
    }

    /* input field css start*/
    .input {
    background-color: transparent;
    border: none;
    /* border-bottom: 1px solid #ccc; */
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 100px;
    }

    input::-webkit-input-placeholder {
    color: #aaa;
    }

    input:focus::-webkit-input-placeholder {
    color: dodgerblue;
    }

    .input:focus + .underline {
    transform: scale(1);
    }
    /* input field css end*/

    .table td
    {
        border-top: none !important;
    }

    .editor
    {
        margin-left: -49px;
        margin-top: -58px;
    }

    .interesting_facts
    {
        width: 70%;
    }
    .text-warning
    {
        color: #ff0000!important;
    }
    /* label{
        font-weight: bold;
        color: #008CBA;
    } */

</style>
@endsection

@section('breadcrumb-title')
	<h2>Welcome Aboard<span> </span></h2>
@endsection

@section('breadcrumb-items')
    {{-- <a href="{{ url('welcome_aboard') }}"><button class="btn btn-primary" type="button">Add Welcome Aboard</button></a> --}}
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
          <form method="POST" action="javascript:void(0);" id="add_welcome_aboard">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="javascript:void(0);" id="add_welcome_aboard_image" >
                        <div class="card-body editor">
                            <div class="summernote" id="summernote" name="summernote">
                            </div>
                        </div>
                        <div class="card-body editor">
                            <div class="summernote" id="summernote_copy" name="summernote_copy">
                            </div>
                        </div>
                        <div class="text-center">
                                <button class="btn btn-primary-gradien mb-5" type="submit" id="btnSubmit">Export</button>
                        </div>
                        <div class="image_div" id="image_div">

                        </div>


                        {{-- <a href="{{url('../assets/images/image_generator/image.jpg')}}" target="_blank"><img src="../assets/images/image_generator/image.jpg" alt="image_generator" style="width: -webkit-fill-available; margin-bottom: 60px;"></a> --}}
                        {{-- <div class="text-center">
                            <a href="{{url('../assets/images/image_generator/image.jpg')}}" download>
                                <button class="btn btn-primary-gradien" type="button">Download</button>
                            </a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->


@endsection

@section('script')

<script src="../assets/pro_js/view_welcome_aboard_hr.js"></script>

<!-- summernote js -->
<script src="../assets/js/editor/summernote/summernote.js"></script>
<script src="../assets/js/editor/summernote/summernote.custom.js"></script>

<script>
var get_welcome_aboard_details_hr_link = "{{url('get_welcome_aboard_details_hr')}}";
var welcome_aboard_generate_image_link = "{{url('welcome_aboard_generate_image') }}";
var get_welcome_aboard_image_show_link = "{{url('welcome_aboard_image_show') }}";

$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();
   var summernote_get = $('#summernote_copy').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");
//    alert(summernote_get)
    console.log(summernote_get)
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    $('#btnSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');

   $.ajax({
       url:welcome_aboard_generate_image_link,
       type:"POST",
       data: $("#add_welcome_aboard_image").serialize() + "&summernote_get=" + summernote_get + "&id=" + id,
       dataType:"json",
       success:function(data) {
        //    alert('sdf')
           console.log(data);
           $('#btnSubmit').prop("disabled",true);


           if(data.response =='success'){
            Toastify({
                   text: "Export Sucessfully..!",
                   duration: 1000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);
           }
       },

   });
    })
})

</script>
@endsection
