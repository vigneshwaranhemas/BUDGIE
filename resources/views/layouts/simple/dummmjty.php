
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
</style>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4 footer-copyright">
              <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p>
            </div>

            <div class="col-md-4">
                <div class="default-according style-1" id="accordionoc">
                    <div class="card">
                       <div class="card-header bg-primary">
                          <h5 class="mb-0">
                             <button class="btn btn-link  txt-white fooot" data-toggle="" data-target="#" aria-expanded="false" style="padding: unset !important;"><i class="icofont icofont-support"></i> Sticky Notes</button>
                          </h5>
                       </div>

                    </div>
                 </div>
            </div>
            <div class="col-md-4">
              <p class="pull-right mb-0">Design & Develop by HEMAS <i class="fa fa-heart"></i></p>
                {{-- <div class="note">
                    <a href="javascript:;" title="sticky-note" data-toggle="modal" data-original-title="test" data-target="#exampleModal"><i class="pe-7s-note" style="font-size: 22px; border: 1px solid; padding: 0.5rem 0.5rem 0.5rem 0.5rem;"></i></a>
                </div> --}}

            </div>
          </div>
        </div>
      </footer>



      <div class="foot">


        <div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
            <div class="col-xs-12" id="sticky-note-header">
                <div class="col-xs-10" style="line-height: 30px">
                Sticky Notes <a href="javascript:;"  class="btn btn-success btn-outline btn-xs m-l-10 fooot "><i class="fa fa-plus"></i> Add Note</a>
                    </div>
                <div class="col-xs-2">
                    <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                    <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
                </div>

            </div>


        </div>


    </div>

<!-- Pop-up div starts-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Sticky Notes</h5>
              {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> --}}
              <button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test" data-target="#addexampleModal">Add Sticky Notes</button>
          </div>
            <form method="POST" action="javascript:void(0)" id="add_division_unit" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">

                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
              </div>
            </form>
      </div>
    </div>
  </div>
<!-- Pop-up div Ends-->
<div class="modal fade" id="addexampleModal" tabindex="-1" role="dialog" aria-labelledby="addexampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="">Sticky Notes</h5>

          </div>

      </div>
    </div>
  </div>
<!-- Pop-up div starts-->
{{-- <div class="modal fade" id="addexampleModal" tabindex="-1" role="dialog" aria-labelledby="addexampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addexampleModalLabel">Sticky Notes</h5>

          </div>
            <form method="POST" action="javascript:void(0)" id="add_division_unit" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <label for="title">Title</label>
                        <input class="form-control" name="title" id="title_input" type="text" placeholder=Title Name" required=""><br>

                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" id="note_input" type="text" required=""></textarea>

                        <label for="Color">Color</label>
                        <input type="color" name="label_color" value="#7e37d8" id="colorselector" class="form-control" data-original-title="" title="">
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
  </div> --}}
<!-- Pop-up div Ends-->


<script type="text/javascript">
//    sticky notes script
var stickyNoteOpen = $('#open-sticky-bar');
    var stickyNoteClose = $('#close-sticky-bar');
    var stickyNotes = $('#footer-sticky-notes');
    var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    var stickyNoteHeaderHeight = stickyNotes.height();

    $('#sticky-note-list').css('max-height', viewportHeight-150);

    stickyNoteOpen.click(function () {
        $('#sticky-note-list').toggle(function () {
            $(this).animate({
                height: (viewportHeight-150)
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

	$(document).ready(function() {
  $('.fooot').click(function() {
      if($('.foot').hasClass('slide-up')) {
        $('.foot').addClass('slide-down', 1000, 'easeOutBounce');
        $('.foot').removeClass('slide-up');
      } else {
        $('.foot').removeClass('slide-down');
        $('.foot').addClass('slide-up', 1000, 'easeOutBounce');
      }
  });
});

</script>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../pro_js/side_bar.js"></script>
 <!-- date formate  -->
 <script src='../assets/js/moment.js'></script>
      <script>


     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";

    //  $("#collapseicon1").collapse({
    //     toggle: true,
    //     direction: "up"
    //  });
   </script>
