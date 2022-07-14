$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    team_member_goal_record();
    goal_record();
    add_goal_btn();
});


$(()=>{
    $("#rp_excel_generation_id").on('click',(e)=>{
        e.preventDefault();
        var goal_id=[];
        $('#team_member_goal_data tbody>tr').each(function () {
            var id=$(this).find('td:eq(5) a').attr("data-goalcode");
            goal_id.push({
            goal_id:id
            });
        });
        $.ajax({
            url:"sup_goal_report_reviewer",
            type:"POST",
            data:{id:goal_id},
            beforeSend:function(data){
            console.log("Loading!....")
            },
            success:function(response){
            console.log(response);
            var a = document.createElement("a");
            a.href = response.file;
            a.download = response.name;
            document.body.appendChild(a);
            a.click();
            a.remove();
            }
        })
    })
})

// function add_goal_btn(){
//     $.ajax({
//         url:"add_goal_btn",
//         type:"GET",
//         dataType : "JSON",
//         success:function(response)
//         {
//             // alert(response)
//             if(response == "Yes"){
//                 $('#add_goal_btn').css('display', 'none');
//             }else{
//                 $('#add_goal_btn').css('display', 'block');
//             }
//         },
//         error: function(error) {
//             console.log(error);

//         }

//     });
// }


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

function team_member_goal_record(){

    table_cot = $('#team_member_goal_data').DataTable({

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
        aoColumnDefs: [
            { "bSortable": false, "aTargets": [ 0, ] },
        ],
        // aoColumnDefs: [
        //     { 'visible': false, 'targets': [3] }
        // ],
        ajax: {
            url: "get_team_member_goal_list",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                d.team_member_filter = $('#team_member_filter').val();
                d.payroll_status_filter = $('#payroll_status_filter').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.supervisor_status == 2) {
                $( row ).find('td:eq(0)').html('-');

                if(data.supervisor_consolidated_rate == "EC"){
                    $( row ).find('td:eq(6)').html('EC');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "SC"){
                    $( row ).find('td:eq(6)').html('SC');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "C"){
                    $( row ).find('td:eq(6)').html('C');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "PC"){
                    $( row ).find('td:eq(6)').html('PC');
                    $("#rep_manager_consolidated_rate").hide();
                }
            }else{
                $( row ).find('td:eq(0)').html('<input class="checkbox_class" type="checkbox" name="id[]" value="'+ data.goal_unique_code +'"  data-goalcode="' + data.goal_unique_code +'">');
            }
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Employee Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Goal Name');
            $( row ).find('td:eq(3)').attr('data-label', 'Employee Consolidated Rate');
            $( row ).find('td:eq(4)').attr('data-label', 'Reporting Manager Status');
            $( row ).find('td:eq(5)').attr('data-label', 'Business Status');
            $( row ).find('td:eq(6)').attr('data-label', 'Reporting Manager Consolidated Rate');
            $( row ).find('td:eq(7)').attr('data-label', 'Action');

        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'    },
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'    },
            {   data: 'rep_mana_status', name: 'rep_mana_status'    },
            {   data: 'status', name: 'status'    },
            {   data: 'rep_manager_consolidated_rate', name: 'rep_manager_consolidated_rate'    },
            {   data: 'action', name: 'action'  },

            // {   data: 'Info', name: 'Info'  },

        ],
    });
}

$('#team_member_goal_data').on('click','#employee_summary_show_fn',function(){
    var id = $(this).data('id');
    // alert(id)
    $.ajax({
    	url:"fetch_goals_employee_summary",
    	type:"GET",
    	data:{id: id},
    	dataType : "JSON",
    	success:function(data)
    	{
    		$('#goal_employee_summary_show').html(data);
    		$('#goal_supervisor_sum_id').html(id);
    		$('#employeeSummaryShowModal').modal('show');
    	},
    	error: function(response) {
    		// alert(response.responseJSON.errors.business_name_option);
    		// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

    	}

    });

});

$("#supervisorSummaryForm").submit(function(e) {
    e.preventDefault();

    // $('button[type="submit"]').attr('disabled' , true);

    $.ajax({
        url:"goals_supervisor_summary",
        type:"POST",
        data:$('#supervisorSummaryForm').serialize(),
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


//PMS Instruction
$('#pms_instruction').on('click',function(){
    $('#pmsInstructionModal').modal('show');
});

function supervisor_filter_reset(){
    $("#team_member_filter").val('').trigger('change');
    $("#payroll_status_filter").val('').trigger('change');
    team_member_goal_record();
}

function supervisor_filter_apply(){
    team_member_goal_record();
}

// $('#team_member_filter').change(function() {
//     team_member_goal_record();
// });

function goal_record(){

    table_cot = $('#goal_data').DataTable({

        "searching": false,
					"paging": false,
					// "info":     false,
					"fixedColumns":   {
							left: 6
						},
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

//Checkbox code started
$(()=>{
    $('#team_member_goal_data').on('change', 'tbody input.checkbox_class', function () {
        var checkbox_count=[];
        $('#team_member_goal_data tbody>tr').each(function () {
                   var col1=$(this).find("td:eq(0) input[type=checkbox]");
                   if(col1.prop('checked')){
                       checkbox_count.push(col1.val());
                   }
        });
        if(checkbox_count.length >0){
          $("#checkbox_save").show();
          $("#checkbox_submit").show();
        }
        else{
          $("#checkbox_save").hide();
          $("#checkbox_submit").hide();
        }
    });
})

/*select all*/
// Handle click on "Select all" control
 $('#example-select-all').click(function(e){
    var col1 = $(e.target).closest('table');
    $('td input:checkbox', col1).prop('checked',this.checked);
    var checkbox_count=[];
        $('#team_member_goal_data tbody>tr').each(function () {
            var col1=$(this).find("td:eq(0) input[type=checkbox]");
            if(col1.prop('checked')){
                checkbox_count.push(col1.val());
            }
        });
        if(checkbox_count.length >0){
            $("#checkbox_save").show();
            $("#checkbox_submit").show();
          }
          else{
            $("#checkbox_save").hide();
            $("#checkbox_submit").hide();
          }
});

$('#checkbox_save').on('click', function(){
    $(".rep_manager_consolidated_rate_error").hide();
    var selected=[];
    var error = '';
    $('#team_member_goal_data tbody>tr').each(function () {
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(6) option:selected').val();
        // alert(col2)
        if(col1.prop('checked')){
            if(col2 == '')
            {
              currrow.find('td:eq(6) label').text('Rep.Manager Consolidated Rate is required').show();
               error+="error";
            }

            if (col1.length) {
               var status = col1.prop('checked');
                if(status)
                {
                 selected.push({
                       checkbox:col1.val(),
                       option:col2
                    })
                }
                $("#checkbox_save").show();
            }
        }
    });

    if(error == '')
    {
        $.ajax({
        url:"pms_checkbox_data_save",
        type:"POST",
        data:{gid:selected},
        success:function(data){
            //    console.log(data.response);
                if(data.response==1)
                {
                    Toastify({
                    text: "Data Save Sucessfully..!",
                    duration: 1000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                setTimeout(
                    function() {
                        window.location.reload();
                    }, 1000);
                // team_member_goal_record();
                }
            }
        })
    }
});

$('#checkbox_submit').on('click', function(){
    $(".rep_manager_consolidated_rate_error").hide();
    var selected=[];
    var error = '';
    $('#team_member_goal_data tbody>tr').each(function () {
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(6) option:selected').val();
        // alert(col2)

        if(col1.prop('checked')){
            if(col2 == '')
            {
                currrow.find('td:eq(6) label').text('Rep.Manager Consolidated Rate is required').show();
                error+="error";
            }
            if (col1.length) {
               var status = col1.prop('checked');
                if(status)
                {
                 selected.push({
                       checkbox:col1.val(),
                       option:col2
                    })
                }
                $("#checkbox_submit").show();
            }
        }

    });
    if(error == '')
    {
        $.ajax({
        url:"pms_checkbox_data_submit",
        type:"POST",
        data:{gid:selected},
        success:function(data){
            //    console.log(data.response);
            if(data.response==1)
            {
                Toastify({
                text: "Data Submitted Sucessfully..!",
                duration: 1000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();
            setTimeout(
                function() {
                    window.location.reload();
                }, 1000);
            }
        }
        })
    }
});


