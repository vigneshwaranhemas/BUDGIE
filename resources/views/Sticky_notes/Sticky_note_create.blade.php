<div class="modal fade" id="exampleModalmdo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Add New Note</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
             <form>
                <div class="form-group">
                   <label class="col-form-label" for="recipient-name">Note:</label>
                   <textarea class="form-control"></textarea>
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
             <button class="btn btn-primary" type="button">Send message</button>
          </div>
       </div>
    </div>
 </div>
