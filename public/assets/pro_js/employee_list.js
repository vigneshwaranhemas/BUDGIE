$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    employee_record();
    get_role_type();
});
$("#status").on('change', function() {
    employee_record();
});

function employee_record(){

    table_cot = $('#employee_data').DataTable({

        dom: 'lBfrtip',
        lengthChange: true,
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
        scrollCollapse: true,
        drawCallback: function() {


        },
        // aoColumnDefs: [
        //     { 'visible': false, 'targets': [3] }
        // ],
        ajax: {
            url: get_employee_list,
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.status = $('#status').val();
                // d.af_from_date = $('#af_from_date').val();
                // d.af_to_date = $('#af_to_date').val();
                // d.af_position_title = $('#af_position_title').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            // $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Business Name');
            // $( row ).find('td:eq(2)').attr('data-label', 'action');
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'action', name: 'action'  },
            {   data: 'empID', name: 'empID'    },
            {   data: 'username', name: 'username'    },
            {   data: 'role_type', name: 'role_type'    },
            {   data: 'gender', name: 'gender'    },
            {   data: 'doj', name: 'doj'    },
            {   data: 'dob', name: 'dob'    },
            {   data: 'department', name: 'department'    },
            {   data: 'designation', name: 'designation'    },
            {   data: 'worklocation', name: 'worklocation'    },
            {   data: 'grade', name: 'grade'    },
            {   data: 'email', name: 'email'    },
            {   data: 'p_email', name: 'p_email'    },
            {   data: 'contact_no', name: 'contact_no'    },
            {   data: 'emp_num_2', name: 'emp_num_2'    },
            {   data: 'blood_grp', name: 'blood_grp'    },
            {   data: 'sup_name', name: 'sup_name'    },
            {   data: 'reviewer_name', name: 'reviewer_name'    },
            {   data: 'emrg_con_num', name: 'emrg_con_num'    },

            // {   data: 'Info', name: 'Info'  },

        ],
    });
}

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

function get_employee_list(){
table_cot = $('#employee_data').DataTable({

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
    lengthMenu: [[15, 50, 100, 250, 500, -1], [15, 50, 100, 250, 500, "All"]],
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
        url: get_employee_list,
        type: 'POST',
        dataType: "json",
        data: function (d) {
            // d.af_from_date = $('#af_from_date').val();
            // d.af_to_date = $('#af_to_date').val();
            // d.af_position_title = $('#af_position_title').val();
        }
    },
    createdRow: function( row, data, dataIndex ) {
        // $( row ).find('td:eq(0)').attr('data-label', 'Sno');
        // $( row ).find('td:eq(1)').attr('data-label', 'Business Name');
        // $( row ).find('td:eq(2)').attr('data-label', 'action');
    },
    columns: [
        {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
        {   data: 'empID', name: 'empID'    },
        {   data: 'username', name: 'username'    },
        {   data: 'username', name: 'username'    },


    ],
});
}
function get_role_type() {
    $.ajax({
        url: get_role_type_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
            // console.log(data[index].name)
                html += "<option value=" + data[index].name + ">" + data[index].name + "</option>";
            }
            $('#employe_role').html(html);

        }

    });
}
//Edit pop-up model and data show
function employee_edit_process(id){

    $('#role_edit_div').modal('show');

    $.ajax({
        url: get_employee_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if(data.length !=0){
                $('#employe_role').val(data[0].role_type);
                $('#ed_id').val(id);
            }
        }
    });
}
//Edit function
$(()=>{

$("#editUpdate").on('click', function() {

    $("#editUpdate").attr("disabled", true);
    $('#editUpdate').html('Processing..!');

    var employe_role = $('#employe_role').val();
    var ed_id = $('#ed_id').val();

    $.ajax({
        url: employee_list_pop_link,
        method: "POST",
        data:{
            "id":ed_id,
            "employe_role":employe_role,
        },
        dataType: "json",
        success: function(data) {

            $('#close_edit_pop').click();
            $("#editUpdate").attr("disabled", false);
            $('#editUpdate').html('Update');

            if(data.response =='Updated'){
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

           /* setTimeout(
                function() {
                    get_business_list();
                }, 2000);*/
        }
    });
});

})



