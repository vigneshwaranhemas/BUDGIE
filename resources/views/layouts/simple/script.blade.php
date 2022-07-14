<!-- latest jquery-->
<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>
<script src="{{asset('assets/js/chat-menu.js')}}"></script>
@yield('script')
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
<!-- Profile Image -->

<!-- toast js -->
<script src="../assets/toastify/toastify.js"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
 <script src='{{asset('assets/js/moment.js')}}'></script>
 <script src="{{asset('pro_js/side_bar.js')}}"></script>
<!-- login js-->
<!-- DataTables Plugins JS start-->
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
<script src="{{asset('assets/js/chat-menu.js')}}"></script>

<!-- DataTables Plugins JS Ends-->


<script>
    fetch_login_profile_image();

    //Login Profile Image
    function fetch_login_profile_image(){
         //Get holidays details
         $.ajax({
            url:"fetch_login_profile_image",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#login_profile_image").append('');
                  $("#login_profile_image").append(response);

            }

         });
      }
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
</script>
