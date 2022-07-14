$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_roles_list();
});


//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");

   e.preventDefault();

   $.ajax({
       url:add_roles_process_link,
       method:"POST",
       data: $("#form_add_roles").serialize(),
       dataType:"json",

       success:function(data) {
        //    alert('sdf')
           // console.log(data);
           $('#btnSubmit').prop("disabled",false);
               $('#btnSubmit').html('Submit');


           if(data.response =='success'){
            $('#btnSubmit').prop("disabled",true);
            $('#btnSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');


               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    //    window.location.href = "view_recruiter";
                    location.reload();
                   }, 2000);

           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                       location.reload();
                   }, 2000);

           }

       },
       error: function(response) {

        $('#roll_name_error').text(response.responseJSON.errors.role_name);

        }
   });
    })
})

// for export all data
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}

function get_roles_list(){

        table_cot = $('#roles_data').DataTable({

            dom: 'lBfrtip',
            "buttons": [
                {
                    "extend": 'copy',
                    "text": '<i class="bi bi-clipboard" ></i>  Copy',
                    "titleAttr": 'Copy',
                    "exportOptions": {
                        'columns': ':visible'
                    },
                    "action": newexportaction
                },
                {
                    "extend": 'excel',
                    "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                    "titleAttr": 'Excel',
                    "exportOptions": {
                        'columns': ':visible'
                    },
                    "action": newexportaction
                },
                {
                    "extend": 'csv',
                    "text": '<i class="bi bi-file-text" ></i>  CSV',
                    "titleAttr": 'CSV',
                    "exportOptions": {
                        'columns': ':visible'
                    },
                    "action": newexportaction
                },
                {
                    "extend": 'pdf',
                    "text": '<i class="bi bi-file-break" ></i>  PDF',
                    "titleAttr": 'PDF',
                    "exportOptions": {
                        'columns': ':visible'
                    },
                    "action": newexportaction
                },
                {
                    "extend": 'print',
                    "text": '<i class="bi bi-printer"></i>  Print',
                    "titleAttr": 'Print',
                    "exportOptions": {
                        'columns': ':visible'
                    },
                    "action": newexportaction
                },
                {
                    "extend": 'colvis',
                    "text": '<i class="bi bi-eye" ></i>  Colvis',
                    "titleAttr": 'Colvis',
                    // "action": newexportaction
                },

            ],
            lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
            processing: true,
            serverSide: true,
            serverMethod: 'post',
            bDestroy: true,
            scrollX: true,
            scrollY: 800,
            scrollCollapse: true,
            drawCallback: function() {


            },
            // aoColumnDefs: [
            //     { 'visible': false, 'targets': [3] }
            // ],
            ajax: {
                url: get_role_data_link,
                type: 'POST',
                dataType: "json",
                data: function (d) {
                    // d.af_from_date = $('#af_from_date').val();
                    // d.af_to_date = $('#af_to_date').val();
                    // d.af_position_title = $('#af_position_title').val();
                }
            },
            createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(0)').attr('data-label', 'Sno');
                $( row ).find('td:eq(1)').attr('data-label', 'Name');
                $( row ).find('td:eq(2)').attr('data-label', 'Status');
                $( row ).find('td:eq(3)').attr('data-label', 'action');
            },
            columns: [
                {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
                {   data: 'name', name: 'name'    },
                {   data: 'status', name: 'status'    },
                {   data: 'action', name: 'action'    },


            ],
    });
}
//Edit pop-up model and data show
function role_edit_process(id){

    $('#role_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_role_details_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {
            if(data.length !=0){
                $('#role_name_edit').val(data[0].name);
                $('#role_status_edit').val(data[0].status);
                $('#ed_id').val(id);
            }
        }
    });
}

//Edit function
$(()=>{

$("#editUpdate").on('click', function() {
    // alert("abc");
    var ed_role_name = $('#role_name_edit').val();
    var ed_role_status = $('#role_status_edit').val();
    var ed_id = $('#ed_id').val();

    $.ajax({
        url: update_role_unit_details_link,
        method: "POST",
        data:{
            "id":ed_id,
            "role_name_edit":ed_role_name,
            "role_status_edit":ed_role_status,
        },
        dataType: "json",
        success: function(data) {

            $('#close_edit_pop').click();
            $("#editUpdate").attr("disabled", true);
            $('#editUpdate').html('Processing..!');
            $('#editUpdate').html('Update');

            if(data.response =='Updated'){
                $("#editUpdate").attr("disabled", false);
                Toastify({
                    text: "Updated Successfully",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                setTimeout(
                    function() {
                        location.reload();
                    }, 2000);
            }
            else {
                Toastify({
                    text: "Request Failed..! Try Again",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#f3616d",
                }).showToast();

            }

            setTimeout(
                function() {
                    get_business_list();
                }, 2000);

        },
        error: function(response) {

            $('#edit_roll_name_error').text(response.responseJSON.errors.role_name);

            }
    });
});

})
