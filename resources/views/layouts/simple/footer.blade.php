
<?php $session_val = Session::get('session_info');
      $session_status=$session_val['passcode_status'];?>
<style>
    #footer-sticky-notes {
  border-radius: 8px 8px 0 0;
}
#footer-sticky-notes {
  right: 37px;
  background: rgba(0, 0, 0, 0.80);
    background-color: rgba(0, 0, 0, 0.8);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-attachment: scroll;
    background-image: none;
    background-size: auto;
    background-origin: padding-box;
    background-clip: border-box;
  bottom: 0;
  position: fixed;
  width: 300px;
  z-index: 3;
  display: none;
}

.foot {
    border-top: 1px solid #999999;
    position:fixed;
    width: 600px;
    z-index: 10000;
    text-align:center;
    height: 500px;
    font-size:18px;
    color: #000;
    background: red;
    display: flex;
    justify-content: center; /* align horizontal */
    border-top-left-radius:20px;
    border-top-right-radius:20px;
    right: 0;
    left: 0;
    margin-right: auto;
    margin-left: auto;
    bottom: -575px;
}

.slide-up
{
    bottom: 0px !important;
}

.slide-down
{
    bottom: -475px !important;
}
#sticky-note-header {
  padding: 10px;
  color: #ffffff;
  border-bottom: 1px solid #ccc;
}

    .default-according
    {
        width: 283px;
        padding: 1rem 1rem 0rem 3rem;
        margin-top: -27px;
        margin-bottom: -12px;
    }
    .default-according .card .card-header i
    {
        position: inherit !important;
    }
    #sticky-note-toggle {
  position: fixed;
  bottom: 10px;
  right: 40px;
  padding: 10px 15px;
  background: #00fff2;
  border: 1px solid #c3c3c3;
  border-radius: 5px 5px 0 0;
  color: #000000;
  opacity: 0.8;
  z-index: 3;
}
a{
    text-decoration: none;
}

.btn-circle {
  border-radius: 15px;
}
.btn-circle {
  width: 30px;
  height: 30px;
  padding: 6px 0;
  border-radius: 15px;
  text-align: center;
  font-size: 12px;
  line-height: 1.428571429;
}
.btn-default, .btn-default.disabled {
  background: #e4e7ea;
  border: 1px solid #e4e7ea;
}
.pull-right {
  float: right !important;
}
col-xs-9 {
    width: 75%;
}
.icolors > li.red {
  background: #fb3a3a;
}
.icolors > li.green {
  background: #00c292;
}
.icolors > li.blue {
  background: #02bec9;
}
.icolors > li.yellow {
  background: #fec107;
}
.icolors > li.purple {
  background: #7e37d8;
}
.icolors > li {
  padding: 0;
  margin: 2px;
  float: left;
  display: inline-block;
  height: 30px;
  width: 30px;
  background: #2b2b2b;
  text-align: center;
}
.my-header {
  background-color: #69c2fd;
  border-radius: 6px 6px 0 0;
}
</style>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 footer-copyright">
                <a href="javascript:;" id="sticky-note-toggle"><i class="fa fa-sticky-note-o"></i></a>
               <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p>
            </div>
            <div class="col-md-6">
              <p class="pull-right mb-0" style="margin-right: 83px;">Design & Developed by HEMAS <i class="fa fa-heart"></i></p>
            </div>
          </div>
        </div>

        <div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
            <div class="col-xs-12" id="sticky-note-header">
                <div class="col-xs-10" style="line-height: 30px">
                stickyNotes <a href="javascript:;" onclick="showCreateNoteModal()" class="btn btn-success btn-outline btn-xs m-l-10"><i class="fa fa-plus"></i> AddNote </a>
                <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
                </div>

            </div>

            <div id="sticky-note-list" style="display: none; overflow:auto;" >

                    {{-- @if ($session_status==1)
                        @foreach($stickyNotes as $note)
                        <div class="col-md-12 sticky-note" id="stickyBox_{{$note->id}}" style="margin-top: 12px;" >
                        <div class="well
                        @if($note->color == 'red')
                            bg-danger
                        @endif
                        @if($note->color == 'green')
                            bg-success
                        @endif
                        @if($note->color == 'yellow')
                            bg-warning
                        @endif
                        @if($note->color == 'blue')
                            bg-info
                        @endif
                        @if($note->color == 'purple')
                            bg-primary
                        @endif
                        b-none">
                            <p style="padding-top: 24px; margin-left: 24px;">{!! nl2br($note->Notes)  !!}</p>
                            <hr>
                            <div class="row font-12">
                                <div class="col-xs-9" style="margin-left: 39px;margin-bottom: 17px;">
                                    Updated: {{ $Time->diffForHumans($note->updated_at,true) ." ".'ago'}}
                                </div>
                                <div class="col-xs-3" style="margin-left: 38px;">
                                    <a href="javascript:;"  onclick="showEditNoteModal({{$note->id}})"><i class="fa fa-pencil text-white"></i></a>
                                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky({{$note->id}})" ><i class="fa fa-trash text-white"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif --}}

            </div>
        </div>



      </footer>



{{-- <script type="text/javascript">
    $(document).ready(function() {
        getNoteData();
});

</script> --}}



<div class="modal fade" id="exampleModalmdo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header my-header">
             <h5 class="modal-title">Add New Note</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <form id="sticky_notes_form">
                <div class="form-group">
                   <label class="col-form-label" for="recipient-name">Note:</label>
                   <textarea class="form-control" id="notetext"></textarea>
                   <input type="hidden" id="stickyID" value="">
                   <input type="hidden" id="stickyColor" value="">
                </div>
                <div class="input-group">
                <ul class="icolors">
                    <li id="red" onclick="selectColor('red')"  class="red selector"><i id="redcheck" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="green" onclick="selectColor('green')" class="green  selectColor"><i id="greencheck" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="blue"  onclick="selectColor('blue')"  class="blue selectColor"><i id="bluecheck" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="yellow" onclick="selectColor('yellow')"  class="yellow selectColor"><i id="yellowcheck" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="purple"  onclick="selectColor('purple')"  class="purple selectColor"><i id="purplecheck" class="reverter" style="margin-top: 8px;"></i></li>
                  </ul>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-primary" type="button" id="Save_notes">Save</button>
          </div>
       </div>
    </div>
 </div>
 <div class="modal fade" id="exampleModalmdo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header my-header">
             <h5 class="modal-title">Add New Note</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <form id="sticky_notes_form1">
                <div class="form-group">
                   <label class="col-form-label" for="recipient-name">Note:</label>
                   <textarea class="form-control" id="notetext1"></textarea>
                   <input type="hidden" id="stickyID1" value="">
                   <input type="hidden" id="stickyColor1" value="">
                </div>
                <div class="input-group">
                <ul class="icolors">
                    <li id="red1" onclick="selectColor1('red')"  class="red selector"><i id="redcheck1" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="green1" onclick="selectColor1('green')" class="green  selectColor"><i id="greencheck1" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="blue1"  onclick="selectColor1('blue')"  class="blue selectColor"><i id="bluecheck1" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="yellow1" onclick="selectColor1('yellow')"  class="yellow selectColor"><i id="yellowcheck1" class="reverter" style="margin-top: 8px;"></i></li>
                    <li id="purple1"  onclick="selectColor1('purple')"  class="purple selectColor"><i id="purplecheck1" class="reverter" style="margin-top: 8px;"></i></li>
                  </ul>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-primary" type="button" id="Update_notes">Save</button>
          </div>
       </div>
    </div>
 </div>



 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header my-header">
             <h5 class="modal-title">Conformation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <form id="sticky_notes_form1">
                <div class="form-group">
                   <label class="col-form-label" for="recipient-name">Note:</label>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>




{{-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> --}}
{{-- <script src="{{asset('pro_js/side_bar.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
 <script src='{{asset('assets/js/moment.js')}}'></script> --}}




 {{-- <script>
    var get_session_sidebar_link = "{{url('get_session_sidebar')}}";
    $('#sticky-note-toggle').click(function () {
        getNoteData();
       $('#footer-sticky-notes').toggle();
       $('#sticky-note-toggle').hide();

   })

   var stickyNoteOpen = $('#open-sticky-bar');
   var stickyNoteClose = $('#close-sticky-bar');
   var stickyNotes = $('#footer-sticky-notes');
   var viewportHeight = Math.max(718, 718 || 0);
   var stickyNoteHeaderHeight = stickyNotes.height();

   $('#sticky-note-list').css('max-height', viewportHeight-150);

   stickyNoteOpen.click(function () {
       $('#sticky-note-list').toggle(function () {
           $(this).animate({
               height: (viewportHeight-150)
               // overflow: auto
           })
       });
       stickyNoteClose.toggle();
       stickyNoteOpen.toggle();
   })

   stickyNoteClose.click(function () {
       $('#sticky-note-list').toggle(function () {
           $(this).animate({
               height: 0
           })
       });
       stickyNoteOpen.toggle();
       stickyNoteClose.toggle();
   })



   $('body').on('click', '.right-side-toggle', function () {
       $(".right-sidebar").slideDown(50).removeClass("shw-rside");
   })


   function showCreateNoteModal(){
       $("#exampleModalmdo").modal('show');
       return false;
   }
   function selectColor(id){
       $('.reverter').removeClass('fa fa-check');
       $('#'+id+'check').addClass('fa fa-check');
       $('#stickyColor').val(id);

   }
   function selectColor1(id){
       $('.reverter').removeClass('fa fa-check');
       $('#'+id+'check1').addClass('fa fa-check');
       $('#stickyColor1').val(id);

   }



  $(()=>{
      $("#Save_notes").on('click',(e)=>{
       $("#Save_notes").prop('disabled',true);
       e.preventDefault();
       var noteText = $('#notetext').val();
       var stickyColor = $('#stickyColor').val();
       $.ajax({
           url:"{{url('Store_Sticky_Notes')}}",
           type:"POST",
           data:{text:noteText,color:stickyColor},
           beforeSend:function(data){
              console.log("Loading!....")
           },
           success:function(response){
               var res=JSON.parse(response);
               if(res.success==1){
                           Toastify({
                               text: res.message,
                               duration: 3000,
                               close:true,
                               backgroundColor: "#4fbe87",
                               }).showToast();
                               getNoteData();
                               $('.reverter').removeClass('fa fa-check');
                               $("#stickyColor").val("");
                               $('#sticky_notes_form')[0].reset();
                               $("#Save_notes").prop('disabled',false);
                               $("#exampleModalmdo").modal('hide');
                       }
                       else{
                           Toastify({
                               text: res.message,
                               duration: 3000,
                               close:true,
                               backgroundColor: "#f3616d",
                               }).showToast();

                       }
           }
       })

      })
  })
  function getNoteData(){
           $.ajax({
               type: 'GET',
               url: "{{url('Get_Notes_info')}}",
               data:  {},
               // container: ".noteBox",
               beforeSend:function(data){
                   console.log("Loading!...")
               },
               success:function(response){
                   $('#sticky-note-list').html(response);

               }
           });
}
function showEditNoteModal(id){
   $.ajax({
               type: 'POST',
               url: "{{url('Get_Notes_info_id_wise')}}",
               data:  {id:id},
               // container: ".noteBox",
               beforeSend:function(data){
                   console.log("Loading!...")
               },
               success:function(response){
                   var res=JSON.parse(response);
                   $("#notetext1").val(res.Notes)
                   $('.reverter').removeClass('fa fa-check');
                   $('#'+res.color+'check1').addClass('fa fa-check');
                   $('#stickyColor1').val(res.color);
                   $('#stickyID1').val(res.id)
                   $('#exampleModalmdo1').modal('show');



               }
           });
}


$(()=>{
      $("#Update_notes").on('click',(e)=>{
       $("#Update_notes").prop('disabled',true);
       e.preventDefault();
       var noteText = $('#notetext1').val();
       var stickyColor = $('#stickyColor1').val();
       var id=$("#stickyID1").val()
       $.ajax({
           url:"{{url('Edit_Sticky_Notes')}}",
           type:"POST",
           data:{text:noteText,color:stickyColor,id:id},
           beforeSend:function(data){
              console.log("Loading!....")
           },
           success:function(response){
               var res=JSON.parse(response);
               if(res.success==1){
                           Toastify({
                               text: res.message,
                               duration: 3000,
                               close:true,
                               backgroundColor: "#4fbe87",
                               }).showToast();
                               getNoteData();
                               $('.reverter').removeClass('fa fa-check');
                               $("#stickyColor1").val("");
                               $('#sticky_notes_form1')[0].reset();
                               $("#Update_notes").prop('disabled',false);
                               $("#exampleModalmdo1").modal('hide');
                       }
                       else{
                           Toastify({
                               text: res.message,
                               duration: 3000,
                               close:true,
                               backgroundColor: "#f3616d",
                               }).showToast();

                       }
           }
       })

      })
  })



  function deleteSticky(id)
  {
              swal({
                   title: "Are you sure?",
                   text: "Once deleted, you will not be able to recover this deleted Sticky Note!",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
               .then((willDelete) => {
                   if (willDelete) {
                         $.ajax({
                             url:"{{url('Delete_Sticky_note')}}",
                             type:"POST",
                             data:{id:id},
                             beforeSend:function(data){
                                 console.log("Loading!...")
                             },
                             success:function(response){
                               //   console.log(response);
                                 getNoteData();

                             }
                         })

                   } else {
                       swal("Your Sticky Note is safe!");
                   }
               })

  }

  </script> --}}
