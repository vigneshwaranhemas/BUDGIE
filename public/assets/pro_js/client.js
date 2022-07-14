$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(document).ready(function(){
    get_client_list();
});


//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    e.preventDefault();

   $.ajax({
       url:add_client_process_link,
       method:"POST",
       data: $("#form_add_client").serialize(),
       dataType:"json",

       success:function(data) {
        $(".color-hider").hide();
           if(data.error)
           {
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
            }

           if(data.response =='success'){
                $('#btnSubmit').prop("disabled",true);
                $('#client_name_input').val('');
                $('#mobile_number_input').val('');
                $('#email_name_input').val('');
                $('#exampleModal').click();
                $('#btnSubmit').prop("disabled",false);
                // $('.color-hider').hide();


               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    //    window.location.href = "view_recruiter";
                    // location.reload();
                    get_client_list();
                   }, 2000);

           }
           else{
            //    Toastify({
            //        text: "Request Failed..! Try Again",
            //        duration: 3000,
            //        close:true,
            //        backgroundColor: "#f3616d",
            //    }).showToast();

            //    setTimeout(
            //        function() {
            //         //    location.reload();
            //        }, 2000);


           }

       },
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

function get_client_list(){

table_cot = $('#client_data').DataTable({

    dom: 'lBfrtip',
    "buttons": [
        {
            "extend": 'copy',
            "text": '<i class="bi bi-clipboard" ></i>  Copy',
            "titleAttr": 'Copy',
            "exportOptions": {
                'columns': [0,1,2]
            },
            "action": newexportaction
        },
        {
            "extend": 'excel',
            "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
            "titleAttr": 'Excel',
            "exportOptions": {
                'columns': [0,1,2]
            },
            "action": newexportaction
        },
        {
            "extend": 'csv',
            "text": '<i class="bi bi-file-text" ></i>  CSV',
            "titleAttr": 'CSV',
            "exportOptions": {
                'columns': [0,1,2]
            },
            "action": newexportaction
        },
        {
            "extend": 'pdf',
            "text": '<i class="bi bi-file-break" ></i>  PDF',
            "titleAttr": 'PDF',
            "exportOptions": {
                'columns': [0,1,2]
            },
            "action": newexportaction
        },
        {
            "extend": 'print',
            "text": '<i class="bi bi-printer"></i>  Print',
            "titleAttr": 'Print',
            "exportOptions": {
                'columns': [0,1,2]
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
        url: get_client_link_database,
        type: 'POST',
        dataType: "json",
        data: function (d) {

        }
    },
    createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(0)').attr('data-label', 'Sno');
        $( row ).find('td:eq(1)').attr('data-label', 'Client Name');
        $( row ).find('td:eq(2)').attr('data-label', 'Mobile Number');
        $( row ).find('td:eq(3)').attr('data-label', 'Email');
        $( row ).find('td:eq(4)').attr('data-label', 'Status');
        $( row ).find('td:eq(5)').attr('data-label', 'action');
    },
    columns: [
        {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
        {   data: 'client_name', name: 'client_name'    },
        {   data: 'mobile_number', name: 'mobile_number'    },
        {   data: 'email', name: 'email'    },
        {   data: 'status', name: 'status'    },
        {   data: 'action', name: 'action'    },


    ],
});
}

//Edit pop-up model and data show
function client_edit_process(id){

    $('#client_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_client_details_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {

            if(data.length !=0){
                $('#client_name').val(data[0].client_name);
                $('#mobile_number').val(data[0].mobile_number);
                $('#email').val(data[0].email);
                $('#ed_id').val(id);
            }
        }
    });
}

//Edit function
$(()=>{

$("#editUpdate").on('click', function() {

    var ed_client_name = $('#client_name').val();
    var ed_mobile_number = $('#mobile_number').val();
    var ed_email = $('#email').val();
    var ed_id = $('#ed_id').val();

    $.ajax({
        url: update_client_details_link,
        method: "POST",
        data:{
            "id":ed_id,
            "client_name":ed_client_name,
            "mobile_number":ed_mobile_number,
            "email":ed_email,
        },
        dataType: "json",
        success: function(data) {

            $(".color-hider-edit").hide();
           if(data.error)
           {
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error_edit').text(value)
                $("#"+key+'_error_edit').show();
                });
            }

            if(data.response =='Updated'){
                $("#editUpdate").attr("disabled", true);
                $('#client_edit_pop_modal_div').click();
                $("#editUpdate").attr("disabled", false);
                Toastify({
                    text: "Updated Successfully",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                setTimeout(
                    function() {
                        // location.reload();
                        get_client_list();
                    }, 2000);
            }

        },
        // error: function(response) {

        //     $('#edit_client_name_error').text(response.responseJSON.errors.client_name);
        //     $('#edit_mobile_number_error').text(response.responseJSON.errors.mobile_number);
        //     $('#edit_email_error').text(response.responseJSON.errors.email);

        //     }
    });
});

})

function client_status_process(id, status_data){
    // $('#confirmbox').click();
    $('#status_pop_modal_div').modal('show');
    $('#confirmSubmit').unbind('click');
    $("#confirmSubmit").on('click', function() {
        $('#close_status_pop').click();

        $.ajax({
            url: process_client_status_link,
            method: "POST",
            data:{"id":id,"status":status_data,},
            dataType: "json",
            success: function(data) {

                if(data.response =='success'){
                    $('#status_pop_modal_div').click();
                    Toastify({
                        text: "Status Changed Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    setTimeout(
                        function() {
                            // location.reload();
                            get_client_list();
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
                            get_client_list();
                        }, 2000);


                }
            }

        });
    });
    $("#cancelSubmit").on('click', function() {

        $('#modal_close').click();
        location.reload();

        return false;
    });
}

function client_delete_process(id){
    // $('#confirmbox').click();
    $('#delete_pop_modal_div').modal('show');
    $('#deleteconfirmSubmit').unbind('click');
    $("#deleteconfirmSubmit").on('click', function() {
        $('#close_delete_pop').click();

        $.ajax({
            url: process_client_delete_link,
            method: "POST",
            data:{"id":id,},
            dataType: "json",
            success: function(data) {

                if(data.response =='success'){
                    $('#delete_pop_modal_div').click();
                    Toastify({
                        text: "Delete Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    setTimeout(
                        function() {
                            // location.reload();
                            get_client_list();
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
                            get_client_list();
                        }, 2000);
                }
            }

        });
    });
    $("#deletecancelSubmit").on('click', function() {

        $('#modal_close').click();
        location.reload();

        return false;
    });
}
