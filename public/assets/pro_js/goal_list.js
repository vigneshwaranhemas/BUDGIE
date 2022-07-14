$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    goal_record();
    add_goal_btn_login();
    add_goal_btn();
});

function add_goal_btn_login(){
    
    $.ajax({                   
        url:"add_goal_btn_login",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            if(response == "NAPS"){
                $('#pms_instruction_naps').css('display', 'block');
                $('#pms_instruction').css('display', 'none');
            }else{
                $('#pms_instruction').css('display', 'block');
                $('#pms_instruction_naps').css('display', 'none');
            }
        },
        error: function(error) {
            console.log(error);

        }                                              
            
    });

}

function add_goal_btn(){
    $.ajax({                   
        url:"add_goal_btn",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            if(response == "Yes"){
                $('#add_goal_btn_naps').css('display', 'none');
                $('#add_goal_btn_hepl').css('display', 'none');
            }else{

                $.ajax({                   
                    url:"add_goal_btn_login",
                    type:"GET",
                    dataType : "JSON",
                    success:function(response)
                    {
                        if(response == "NAPS"){
                            $('#add_goal_btn_naps').css('display', 'block');
                            $('#add_goal_btn_hepl').css('display', 'none');
                        }else{
                            $('#add_goal_btn_hepl').css('display', 'none');
                            $('#add_goal_btn_naps').css('display', 'none');
                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }                                              
                        
                });
                
                // $('#add_goal_btn_hepl').css('display', 'block');
                // $('#add_goal_btn_naps').css('display', 'block');
            }
        },
        error: function(error) {
            console.log(error);

        }                                              
            
    });
}

function goal_record(){

    table_cot = $('#goal_data').DataTable({

        // dom: 'lBfrtip',
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
            url: "get_goal_list",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                // d.status = $('#status').val();
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
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'action', name: 'action'  },

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

//Delete Record
$('#goal_data').on('click','.deleteRecord',function(){
    // alert("delete");
    var id = $(this).data('id'); 
    // alert(id) 
    $('#goalsDeleteModal').modal('show');
    $('#goals_id_delete').val(id);

});

$("#formGoalDelete").submit(function(e) {
    e.preventDefault();

    $('button[type="submit"]').attr('disabled' , true);

    $.ajax({                   
        url:"goals_delete",
        type:"POST",
        data:$('#formGoalDelete').serialize(),
        dataType : "JSON",
        success:function(data)
        {
            Toastify({
                text: "Deleted Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();    
            
            $('button[type="submit"]').attr('disabled' , false);
            $('#goalsDeleteModal').modal('hide');
            goal_record();
            // window.location = "{{ url('goals')}}";                
            // $("#goal_data").load("{{url('get_goal_list')}}");               
        },
        error: function(response) {
            // alert(response.responseJSON.errors.business_name_option);
            // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

        }                                              
            
    });

});

//Employee Summary
$('#goal_data').on('click','#employee_summary',function(){
    var id = $(this).data('id');
    $('#goal_sheet_id').val(id); 
    $('#employeeSummaryModal').modal('show');
      
});

//PMS Instruction
$('#pms_instruction').on('click',function(){    
    $('#pmsInstructionModal').modal('show');      
});

//PMS Instruction Naps
$('#pms_instruction_naps').on('click',function(){    
    $('#pmsInstructionNapsModal').modal('show');      
});

$('#goal_data').on('click','#employee_summary_show',function(){
    var id = $(this).data('id');

    $.ajax({                   
        url:"fetch_goals_employee_summary",
        type:"GET",
        data:{id: id}, 
        dataType : "JSON",
        success:function(data)
        {      
            // console.log(data)
            $('#goal_employee_summary_show').html(data); 
        },
        error: function(response) {
            
            console.log(response);
            // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

        }                                              
            
    });

    $.ajax({                   
        url:"fetch_goals_supervisor_summary",
        type:"GET",
        data:{id: id}, 
        dataType : "JSON",
        success:function(data)
        {      
            $('#goal_supervisor_summary_show').html(data); 
        },
        error: function(response) {            
            console.log(response);
        }                                              
            
    });

    $('#employeeSummaryShowModal').modal('show');            
      
});

$("#employeeSummaryForm").submit(function(e) {
    e.preventDefault();

    // $('button[type="submit"]').attr('disabled' , true);

    $.ajax({                   
        url:"goals_employee_summary",
        type:"POST",
        data:$('#employeeSummaryForm').serialize(),
        dataType : "JSON",
        success:function(data)
        {
            Toastify({
                text: "Send Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();    
            
            // $('button[type="submit"]').attr('disabled' , false);
            $('#employeeSummaryModal').modal('hide');
            goal_record();
            // window.location = "{{ url('goals')}}";                
            // $("#goal_data").load("{{url('get_goal_list')}}");               
        },
        error: function(response) {
            // alert(response.responseJSON.errors.business_name_option);
            // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

        }                                              
            
    });

});
