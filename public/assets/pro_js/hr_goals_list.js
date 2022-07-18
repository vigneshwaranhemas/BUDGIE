$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).ready(function() {
    goal_record();
    get_supervisor();
    supervisor_goal_record();   
    add_goal_btn();
    // alert("*")
});

/*clear function*/
$("#reset").on('click', function() {
        $("#supervisor_list").val("").trigger('change'); 
        $("#payroll_status_sup").val("").trigger('change'); 
        supervisor_goal_record();      
});$("#rev_reset").on('click', function() {
        $("#supervisor_list_1").val("").trigger('change');       
        $("#team_member_filter").val("").trigger('change');
        $("#payroll_status_rev").val("").trigger('change');
        reviewer_goal_record();       
});$("#hr_reset").on('click', function() {
        $("#reviewer_filter").val("").trigger('change');       
        $("#team_leader_filter_hr").val("").trigger('change');       
        $("#team_member_filter_hr").val("").trigger('change'); 
         $("#gender_hr_2").val("").trigger('change');       
        $("#grade_hr_2").val("").trigger('change');       
        $("#department_hr_2").val("").trigger('change');  
        hr_dttable_record();     
});$("#myself_reset").on('click', function() {
        $("#reviewer_filter_1").val("").trigger('change');       
        $("#team_leader_filter_hr_1").val("").trigger('change');       
        $("#team_member_filter_hr_1").val("").trigger('change');       
        $("#gender_hr_1").val("").trigger('change');       
        $("#grade_hr_1").val("").trigger('change');       
        $("#payroll_status_hr_1").val("").trigger('change');       
        $("#department_hr_1").val("").trigger('change');  
        hr_listing_tab_record();     
});
/*all search click */
$('#supervisor_list_1').on('change',function() {
    get_team_member_list();
    });
$('#reviewer_filter').on('change',function() {
    get_manager_lsit_drop();
    });
$('#team_leader_filter_hr').on('change',function() {
    get_team_member_drop();
    });
$('#supervisor_filter').on('click',function() {
    supervisor_goal_record();
    });
$('#reviewer_apply').on('click',function() {
    reviewer_goal_record();
    });
$('#profile-info-tab').on('click',function() {
    get_hr_supervisor();
    hr_dttable_record();
    get_grade();
    get_department();
    $('#save_div_rev').hide();
    $('#save_div_hr').show();
    $("#analytics-report").hide();
    });
$('#hr_apply').on('click',function() {
    hr_dttable_record();
    });
$('#reviewer-info-tab').on('click',function() {
    // alert("ssss")
    reviewer_goal_record();
    $('#save_div_rev').show();
    $('#save_div_hr').hide();
    $("#analytics-report").hide();
    });
$('#listing-info-tab').on('click',function() {
    hr_listing_tab_record();
    get_hr_supervisor();
     get_grade();
     get_department();
     $("#analytics-report").hide();
    });
$('#reviewer_filter_1').on('change',function() {
    get_manager_lsit_drop_1();
    });
$('#team_leader_filter_hr_1').on('change',function() {
    get_team_member_drop_1();
    });
$('#list_apply').on('click',function() {
    hr_listing_tab_record();
    });
$('#MySelf-info-tab').on('click',function() {
    // alert("sa")
    $('#save_div_rev').hide();
    $('#save_div_hr').hide();
    $("#analytics-report").hide();
   goal_record();
    });
$('#report-tab').on('click',function() {
    bh_pie_rating_chartjs();
    $('#analytics-report').show();
    });

$('#info-home-tab').on('click',function(){
    $("#analytics-report").hide();
})

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

$('#listing_table').on('change', 'tbody input.mail_class', function () {
    $("#send_mail").show();
    // alert("one")
});

/*grade*/
function get_grade(){

    $.ajax({                   
        url:"get_grade",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            var html = '<option value="">Select</option>';
            for (let i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].grade + "'>" + data[i].grade + "</option>";
            }
            // console.log(data)
            $('#grade_hr_1').html(html);
            $('#grade_hr_2').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
/*department*/
function get_department(){

    $.ajax({                   
        url:"get_department",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].department + "'>" + data[i].department + "</option>";
            }
            $('#department_hr_1').html(html);
            $('#department_hr_2').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
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

function get_supervisor(){

    $.ajax({                   
        url:"get_supervisor",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#supervisor_list').html(html);
            $('#supervisor_list_1').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

function get_hr_supervisor(){

    $.ajax({                   
        url:"get_hr_supervisor",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            /*$('#supervisor_list').html(html);*/
            $('#reviewer_filter').html(html);
            $('#reviewer_filter_1').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

function get_team_member_list(){
    var supervisor_list_1 = $('#supervisor_list_1').val();
    // alert(supervisor_list_1)
        $.ajax({                   
            url:"get_team_member_list",
            method: "POST",
            data:{ supervisor_list_1 : supervisor_list_1},
            dataType : "JSON",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
                }
                $('#team_member_filter').html(html);

            },
            error: function(error) {
                console.log(error);
            }                                              
                
        });
}


function get_manager_lsit_drop(){
    var reviewer_filter = $('#reviewer_filter').val();
        // alert(reviewer_filter)
    $.ajax({                   
        url:"get_manager_lsit_drop",
        type:"POST",
        data:{ reviewer_filter : reviewer_filter},
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_leader_filter_hr').html(html);
            $('#team_leader_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_team_member_drop(){
    var team_leader_filter_hr = $('#team_leader_filter_hr').val();
    $.ajax({                   
        url:"get_team_member_drop",
        type:"POST",
        data:{ team_leader_filter_hr : team_leader_filter_hr },
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_member_filter_hr').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_manager_lsit_drop_1(){
    var reviewer_filter = $('#reviewer_filter_1').val();
        // alert(reviewer_filter)
    $.ajax({                   
        url:"get_manager_lsit_drop",
        type:"POST",
        data:{ reviewer_filter : reviewer_filter},
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_leader_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_team_member_drop_1(){
    var team_leader_filter_hr = $('#team_leader_filter_hr_1').val();
    $.ajax({                   
        url:"get_team_member_drop",
        type:"POST",
        data:{ team_leader_filter_hr : team_leader_filter_hr },
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_member_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

/*datatable for hr page*/
function supervisor_goal_record(){    
    table_cot = $('#supervisor_goal_data').DataTable({
        
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
        ajax: {
            url: "get_hr_goal_list_tb",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.supervisor_list = $('#supervisor_list').val();
                d.payroll_status_sup = $('#payroll_status_sup').val();
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
            
            /*if (data.red_flag_status == "1") {
                $(row).addClass('table-danger');
            }
            if (data.status_cont == "Offer Rejected") {
                $(row).addClass('table-warning');
            }*/
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },    
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'    },        
            {   data: 'rep_mana_status', name: 'rep_mana_status'  },
            {   data: 'status', name: 'status'  },
            {   data: 'rep_manager_consolidated_rate', name: 'rep_manager_consolidated_rate'    },
            {   data: 'action', name: 'action'  },            
        ],
    });
}
function reviewer_goal_record(){

    
    table_cot = $('#reviewer_tbl').DataTable({
        
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
        ajax: {
            url: "get_reviewer_list",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.supervisor_list_1 = $('#supervisor_list_1').val();
                d.team_member_filter = $('#team_member_filter').val();
                d.payroll_status_rev = $('#payroll_status_rev').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Position');           
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'rev_status', name: 'rev_status'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },            
        ],
    });
}



function hr_dttable_record(){

    
    table_cot = $('#get_hr_goal').DataTable({
        
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
        ajax: {
            url: "get_hr_goal_list_tbl",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter = $('#reviewer_filter').val();
                d.team_leader_filter_hr = $('#team_leader_filter_hr').val();
                d.team_member_filter_hr = $('#team_member_filter_hr').val();
                d.gender_hr_2 = $('#gender_hr_2').val();
                d.grade_hr_2 = $('#grade_hr_2').val();
                d.department_hr_2 = $('#department_hr_2').val();
                d.payroll_status_hr = $('#payroll_status_hr').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.hr_status == 2) {
                $( row ).find('td:eq(0)').html('-');
                $(".hr_rating_cls").hide();

                if(data.action_to_be_performed == "No movement"){
                    $( row ).find('td:eq(6)').html('No movement');
                }
                if(data.action_to_be_performed == "Place employee in PIP"){
                    $( row ).find('td:eq(6)').html('Place employee in PIP');
                }
                if(data.action_to_be_performed == "Increment Percentage"){
                    $( row ).find('td:eq(6)').html('Increment Percentage');
                }
                if(data.action_to_be_performed == "Progression"){
                    $( row ).find('td:eq(6)').html('Progression');
                }
            }else{
                $( row ).find('td:eq(0)').html('<input class="checkbox_class" type="checkbox" name="id[]" value="'+ data.goal_unique_code +'"  data-goalcode="' + data.goal_unique_code +'">');
            }
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Position');           
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'  },
            {   data: 'supervisor_consolidated_rate', name: 'supervisor_consolidated_rate'  },
            {   data: 'reviewer_remarks', name: 'reviewer_remarks'  },
            {   data: 'hr_rating_op', name: 'hr_rating_op'  },
            // {   data: 'hr_status_btn', name: 'hr_status_btn'  },
            {   data: 'pip_month_value', name: 'pip_month_value'  },
            {   data: 'increment_percentage', name: 'increment_percentage'  },
            {   data: 'hike_per_month', name: 'hike_per_month'  },
            {   data: 'new_designation', name: 'new_designation'  },
            {   data: 'new_sup_name', name: 'new_sup_name'  },
            // {   data: 'hr_remarks', name: 'hr_remarks'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },           
        ],
    });
}

// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
    $.fn.inputFilter = function(callback, errMsg) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
    if (callback(this.value)) {
    // Accepted value
    if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
    $(this).removeClass("input-error");
    this.setCustomValidity("");
    }
    this.oldValue = this.value;
    this.oldSelectionStart = this.selectionStart;
    this.oldSelectionEnd = this.selectionEnd;
    } else if (this.hasOwnProperty("oldValue")) {
    // Rejected value - restore the previous one
    $(this).addClass("input-error");
    this.setCustomValidity(errMsg);
    this.reportValidity();
    this.value = this.oldValue;
    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
    } else {
    // Rejected value - nothing to restore
    this.value = "";
    }
    });
    };
}(jQuery));

//Checkbox code started
$(()=>{
    $('#get_hr_goal').on('change', 'tbody input.checkbox_class', function () {
        var checkbox_count=[];
        $('#get_hr_goal tbody>tr').each(function () {
            var col1=$(this).find("td:eq(0) input[type=checkbox]");
            if(col1.prop('checked')){
                checkbox_count.push(col1.val());
            }
        });
        if(checkbox_count.length >0){
        //   $("#checkbox_save").show();
          $("#checkbox_submit_hr").show();
        }
        else{
        //   $("#checkbox_save").hide();
          $("#checkbox_submit_hr").hide();
        }
    });
})

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

//Checkbox code started
$(()=>{
    $('#get_hr_goal').on('change', 'tbody select.hr_rating_cls', function (index) {
        var row = $(this).closest('tr').index();
        var col1=$("#get_hr_goal tbody tr:eq("+row+") td:eq(0) input:checkbox").is(':checked');             
        var select_option_id = this.id; //id
        var payroll_status = $(this).data("details"); 
        var id_op = "#"+select_option_id;
        var op = $(id_op).val();
        var last_five_degit = select_option_id.slice(select_option_id.length - 5);

        var sel_div_name1 = "#designation_"+last_five_degit; 
        var sel_div_name2 = "#new_sup_"+last_five_degit; 
        var sel_div_name3 = "#pip_month_"+last_five_degit; 
        var sel_div_name4 = "#increment_percentage_"+last_five_degit; 
        var sel_div_name5 = "#hike_per_month_"+last_five_degit; 
        console.log(sel_div_name5)
        $(sel_div_name4).inputFilter(function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 50);
        }, "Must be between 0 and 50");

        //Error
        var sel_div_name1_er = ".designation_error_"+last_five_degit; 
        var sel_div_name2_er = ".new_sup_error_"+last_five_degit; 
        var sel_div_name3_er = ".pip_month_error_"+last_five_degit; 
        var sel_div_name4_er = ".increment_percentage_error_"+last_five_degit; 
        var sel_div_name5_er = ".hike_per_month_error_"+last_five_degit; 

        $("#get_hr_goal tbody tr:eq("+row+") td:eq(6) label"+sel_div_name1_er+"").hide();                     
        $("#get_hr_goal tbody tr:eq("+row+") td:eq(6) label"+sel_div_name2_er+"").hide();                     
        $("#get_hr_goal tbody tr:eq("+row+") td:eq(6) label"+sel_div_name3_er+"").hide();                     
        $("#get_hr_goal tbody tr:eq("+row+") td:eq(6) label"+sel_div_name4_er+"").hide();                     
        $("#get_hr_goal tbody tr:eq("+row+") td:eq(6) label"+sel_div_name5_er+"").hide();                     

        $(sel_div_name1_er).hide();
        $(sel_div_name2_er).hide();
        $(sel_div_name3_er).hide();
        $(sel_div_name4_er).hide();
        $(sel_div_name5_er).hide();

        //check box
        if(col1 == false){
            if(op != ""){                
                $("#get_hr_goal tbody tr:eq("+row+") td:eq(0) input:checkbox").prop('checked', true);
                // $("#checkbox_save").show();
                $("#checkbox_submit_hr").show();
            }                          

        }else{
            if(op == ""){                
                $("#get_hr_goal tbody tr:eq("+row+") td:eq(0) input:checkbox").prop('checked', false);
                $(sel_div_name1).hide();
                $(sel_div_name2).hide();
                $(sel_div_name3).hide();
                $(sel_div_name4).hide();
                $(sel_div_name5).hide();
            }   
        }

        //save & submit btn
        var checkbox_count=[];
        $('#get_hr_goal tbody>tr').each(function () {
            var col1=$(this).find("td:eq(0) input[type=checkbox]");
            if(col1.prop('checked')){
                checkbox_count.push(col1.val());
            }
        });
        if(checkbox_count.length >0){
        //   $("#checkbox_save").show();
          $("#checkbox_submit_hr").show();
        }
        else{
        //   $("#checkbox_save").hide();
          $("#checkbox_submit_hr").hide();
        }

        //filter
        if(op == "Place employee in PIP"){
            $(sel_div_name1).hide();
            $(sel_div_name2).hide();
            $(sel_div_name3).show();
            $(sel_div_name4).hide();
            $(sel_div_name5).hide();

        } 
        if(op == "Increment Percentage"){
            $(sel_div_name1).hide();
            $(sel_div_name2).hide();
            $(sel_div_name3).hide();
            if(payroll_status == "HEPL"){
                $(sel_div_name4).show();
                $(sel_div_name5).hide();
            }else{
                $(sel_div_name4).hide();
                $(sel_div_name5).show();
            }
        } 
        if(op == "Progression"){
            $(sel_div_name1).show();
            $(sel_div_name2).show();
            $(sel_div_name3).hide();
            if(payroll_status == "HEPL"){
                $(sel_div_name4).show();
                $(sel_div_name5).hide();
            }else{
                $(sel_div_name4).hide();
                $(sel_div_name5).show();
            }
        } 
        if(op == "No movement"){
            $(sel_div_name1).hide();
            $(sel_div_name2).hide();
            $(sel_div_name3).hide();
            $(sel_div_name4).hide();
            $(sel_div_name5).hide();
        } 
        if(op == ""){
            $(sel_div_name1).hide();
            $(sel_div_name2).hide();
            $(sel_div_name3).hide();
            $(sel_div_name4).hide();
            $(sel_div_name5).hide();
        } 

    });
});

$('#checkbox_save_hr').on('click', function(){
    
    $(".hr_rate_error").hide();
    var selected=[];
    var error = '';
    $('#get_hr_goal tbody>tr').each(function (index) {
       
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(1) select.hr_rating_cls').val();               

        if(col1.prop('checked')){            
            var col2_details = currrow.find('td:eq(1) select.hr_rating_cls').attr('id');
            var payroll_status = currrow.find('td:eq(1) select.hr_rating_cls').data("details"); 
            var last_five_degit = col2_details.slice(col2_details.length - 5);           

            if(col2 == '')
            {               
                var err_div_name = ".hr_rate_error_"+last_five_degit;            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();
                $errmsg0.html('HR rate is required').show();                
                error+="error";    
                // console.log(err_div_name)                
            }else{
                //HR Rating
                var err_div_name = ".hr_rate_error_"+last_five_degit;            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();

                //filter
                var col2_pip_mon = currrow.find('td:eq(1) input.pip_month_cls').val(); 
                var col2_incr = currrow.find('td:eq(1) input.increment_percentage_cls').val(); 
                var col2_per = currrow.find('td:eq(1) input.hike_per_month_cls').val(); 
                var col2_des = currrow.find('td:eq(1) select.designation_cls').val(); 
                var col2_new_sup = currrow.find('td:eq(1) select.new_sup_cls').val(); 
                if(col2 == "Place employee in PIP"){
                    var err_div_name = ".pip_month_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_pip_mon == ""){                     
                        $errmsg0.html('PIP value is required').show();                
                        error+="error"; 
                    }      

                } 
                if(col2 == "Increment Percentage"){

                    if(payroll_status == "HEPL"){
                        var err_div_name = ".increment_percentage_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_incr == ""){                     
                            $errmsg0.html('Increment percentage is required').show();                
                            error+="error"; 
                        }    

                    }else{
                        var err_div_name = ".hike_per_month_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_per == ""){                     
                            $errmsg0.html('Hike per month is required').show();                
                            error+="error"; 
                        } 
                    }                      
                    
                } 
                if(col2 == "Progression"){
                    //Designation
                    var err_div_name = ".designation_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_des == ""){                     
                        $errmsg0.html('Designation is required').show();                
                        error+="error"; 
                    }  

                    //New sup
                    var err_div_name = ".new_sup_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_new_sup == ""){                     
                        $errmsg0.html('Reporting manager is required').show();                
                        error+="error"; 
                    }  

                    //increment process
                    if(payroll_status == "HEPL"){
                        var err_div_name = ".increment_percentage_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_incr == ""){                     
                            $errmsg0.html('Increment percentage is required').show();                
                            error+="error"; 
                        }    

                    }else{
                        var err_div_name = ".hike_per_month_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_per == ""){                     
                            $errmsg0.html('Hike per month is required').show();                
                            error+="error"; 
                        } 
                    }   
                } 
                if(col2 == "No movement"){
                    
                }                                 

            }

            if (col1.length) {
               var status = col1.prop('checked');
                if(status)
                {

                    if(col2 == "No movement"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:"",
                            incr:"",
                            percentage:"",
                            designation:"",
                            sup:"",
                        })
                    }                    
                    if(col2 == "Place employee in PIP"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:col2_pip_mon,
                            incr:"",
                            percentage:"",
                            designation:"",
                            sup:"",
                        })
                    }
                    if(col2 == "Increment Percentage"){
                        if(payroll_status == "HEPL"){
                            selected.push({
                                checkbox:col1.val(),
                                option:col2,
                                pip_mon:"",
                                incr:col2_incr,
                                percentage:"",
                                designation:"",
                                sup:"",
                            })
                        }else{
                            selected.push({
                                checkbox:col1.val(),
                                option:col2,
                                pip_mon:"",
                                incr:"",
                                percentage:col2_per,
                                designation:"",
                                sup:"",
                            })
                        }
                        
                    }
                    if(col2 == "Progression"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:"",
                            incr:col2_incr,
                            percentage:col2_per,
                            designation:col2_des,
                            sup:col2_new_sup,
                        })
                    }                    
                }
                // $("#checkbox_save").show();
            }
        }
    });

    // console.log(selected)

    if(error == '')
    {
        $.ajax({
        url:"hr_pms_checkbox_data_save",
        type:"POST",
        data:{gid:selected},
        success:function(data){
               console.log(data.response);
                if(data.response==1)
                {
                    Toastify({
                        text: "Data Save Sucessfully..!",
                        duration: 1000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    // setTimeout(
                    //     function() {
                    //         window.location.reload();
                    //     }, 1000);
                    hr_dttable_record();
                   $("#checkbox_submit_hr").hide();


                }
            }
        })
    }
});

$('#checkbox_submit_hr').on('click', function(){
    $(".hr_rate_error").hide();
    var selected=[];
    var error = '';
    $('#get_hr_goal tbody>tr').each(function (index) {
       
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(6) select.hr_rating_cls').val();               

        if(col1.prop('checked')){            
            var col2_details = currrow.find('td:eq(6) select.hr_rating_cls').attr('id');
            var payroll_status = currrow.find('td:eq(6) select.hr_rating_cls').data("details"); 
            var last_five_degit = col2_details.slice(col2_details.length - 5);           

            if(col2 == '')
            {               
                var err_div_name = ".hr_rate_error_"+last_five_degit;            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();
                $errmsg0.html('HR rate is required').show();                
                error+="error";    
                // console.log(err_div_name)                
            }else{
                //HR Rating
                var err_div_name = ".hr_rate_error_"+last_five_degit;            
                var $errmsg0 = $(err_div_name);
                $errmsg0.hide();

                //filter
                var col2_pip_mon = currrow.find('td:eq(6) input.pip_month_cls').val(); 
                var col2_incr = currrow.find('td:eq(6) input.increment_percentage_cls').val(); 
                var col2_per = currrow.find('td:eq(6) input.hike_per_month_cls').val(); 
                var col2_des = currrow.find('td:eq(6) select.designation_cls').val(); 
                var col2_new_sup = currrow.find('td:eq(6) select.new_sup_cls').val(); 
                if(col2 == "Place employee in PIP"){
                    var err_div_name = ".pip_month_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_pip_mon == ""){                     
                        $errmsg0.html('PIP value is required').show();                
                        error+="error"; 
                    }      

                } 
                if(col2 == "Increment Percentage"){

                    if(payroll_status == "HEPL"){
                        var err_div_name = ".increment_percentage_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_incr == ""){                     
                            $errmsg0.html('Increment percentage is required').show();                
                            error+="error"; 
                        }    

                    }else{
                        var err_div_name = ".hike_per_month_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_per == ""){                     
                            $errmsg0.html('Hike per month is required').show();                
                            error+="error"; 
                        } 
                    }                      
                    
                } 
                if(col2 == "Progression"){
                    //Designation
                    var err_div_name = ".designation_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_des == ""){                     
                        $errmsg0.html('Designation is required').show();                
                        error+="error"; 
                    }  

                    //New sup
                    var err_div_name = ".new_sup_error_"+last_five_degit;            
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();

                    if(col2_new_sup == ""){                     
                        $errmsg0.html('Reporting manager is required').show();                
                        error+="error"; 
                    }  

                    //increment process
                    if(payroll_status == "HEPL"){
                        var err_div_name = ".increment_percentage_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_incr == ""){                     
                            $errmsg0.html('Increment percentage is required').show();                
                            error+="error"; 
                        }    

                    }else{
                        var err_div_name = ".hike_per_month_error_"+last_five_degit;            
                        var $errmsg0 = $(err_div_name);
                        $errmsg0.hide();

                        if(col2_per == ""){                     
                            $errmsg0.html('Hike per month is required').show();                
                            error+="error"; 
                        } 
                    }   
                } 
                if(col2 == "No movement"){
                    
                }                                 

            }

            if (col1.length) {
               var status = col1.prop('checked');
                if(status)
                {

                    if(col2 == "No movement"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:"",
                            incr:"",
                            percentage:"",
                            designation:"",
                            sup:"",
                        })
                    }                    
                    if(col2 == "Place employee in PIP"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:col2_pip_mon,
                            incr:"",
                            percentage:"",
                            designation:"",
                            sup:"",
                        })
                    }
                    if(col2 == "Increment Percentage"){
                        if(payroll_status == "HEPL"){
                            selected.push({
                                checkbox:col1.val(),
                                option:col2,
                                pip_mon:"",
                                incr:col2_incr,
                                percentage:"",
                                designation:"",
                                sup:"",
                            })
                        }else{
                            selected.push({
                                checkbox:col1.val(),
                                option:col2,
                                pip_mon:"",
                                incr:"",
                                percentage:col2_per,
                                designation:"",
                                sup:"",
                            })
                        }
                        
                    }
                    if(col2 == "Progression"){
                        selected.push({
                            checkbox:col1.val(),
                            option:col2,
                            pip_mon:"",
                            incr:col2_incr,
                            percentage:col2_per,
                            designation:col2_des,
                            sup:col2_new_sup,
                        })
                    }                    
                }
                // $("#checkbox_save").show();
            }
        }
    });

    // console.log(selected)

    if(error == '')
    {
        $.ajax({
        url:"hr_pms_checkbox_data_submit",
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
                // setTimeout(
                //     function() {
                //         window.location.reload();
                //     }, 1000);
                hr_dttable_record();
                $("#checkbox_submit_hr").hide(); 

            }
        }
        })
    }
});

$('#hr-example-select-all').click(function(e){
    var col1 = $(e.target).closest('table');
    console.log(col1)
    $('td input:checkbox', col1).prop('checked',this.checked);
    var checkbox_count=[];
    $('#get_hr_goal tbody>tr').each(function () {
        var col1=$(this).find("td:eq(0) input[type=checkbox]");
        if(col1.prop('checked')){
            checkbox_count.push(col1.val());
        }
    });
    if(checkbox_count.length >0){
        // $("#checkbox_save").show();
        $("#checkbox_submit_hr").show();
    }
    else{
        // $("#checkbox_save").hide();
        $("#checkbox_submit_hr").hide();
    }
});



//PMS Instruction
$('#pms_instruction').on('click',function(){    
    $('#pmsInstructionModal').modal('show');      
});

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

        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'action', name: 'action'  },

            // {   data: 'Info', name: 'Info'  },

        ],
    });
}
   

   $('#send_mail').on('click', function(){
         var i=0;
         var j=0;
         var selected=[];
         $('#listing_table tbody>tr').each(function () {
             var currrow=$(this).closest('tr');
             var col1=currrow.find('td:eq(0) input[type=checkbox]');
             if (col1.length) {
                    var status = col1.prop('checked');
                     if(status)
                     {
                      selected.push({
                            checkbox:col1.val()
                         })  
                     }
                     $("#send_mail").show();
                  }
                  $("#send_mail").hide();
             });

         $.ajax({
            url:"pms_employeee_mail",
            type:"POST",
            data:{gid:selected},
            success:function(data){
                console.log(data.response);
                if(data.response==1)
                {
                 Toastify({
                   text: "Mail Send Sucessfully..!",
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
    });        

/*select all org*/
// Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      var rows = table_cot.rows({ 'search': 'applied' }).nodes();
      if (rows !="") {
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
      $("#send_mail").show();
      }else{
        $("#send_mail").hide();
      }
   });

   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         if(el && el.checked && ('indeterminate' in el)){
            el.indeterminate = true;
            
         }
      }
   });

function hr_listing_tab_record(){

    
    table_cot = $('#listing_table').DataTable({
            
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
        aoColumnDefs: [
            { "bSortable": false, "aTargets": [ 0, ] }, 
        ],
        /*drawCallback: function() {
        },*/
        ajax: {
            url: "hr_list_tab_record",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter_1 = $('#reviewer_filter_1').val();
                d.team_leader_filter_hr_1 = $('#team_leader_filter_hr_1').val();
                d.team_member_filter_hr_1 = $('#team_member_filter_hr_1').val();
                d.gender_hr_1 = $('#gender_hr_1').val();
                d.grade_hr_1 = $('#grade_hr_1').val();
                d.department_hr_1 = $('#department_hr_1').val();
                d.payroll_status_hr_1 = $('#payroll_status_hr_1').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            /*if (data.mail_con ==0) {
                $( row ).find('td:eq(0)').html('<input class="mail_class" type="checkbox" name="id[]" value="'+ data.goal_unique_code +'"  data-goalcode="' + data.goal_unique_code +'">');   
            }else{
                $( row ).find('td:eq(0)').html('-');
            }*/
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Emp ID');           
            $( row ).find('td:eq(3)').attr('data-label', 'Goal Name');           
            $( row ).find('td:eq(4)').attr('data-label', 'Gender');           
            $( row ).find('td:eq(5)').attr('data-label', 'Grade');           
            $( row ).find('td:eq(5)').attr('data-label', 'Department');           
            $( row ).find('td:eq(6)').attr('data-label', 'employee_consolidated_rate');           
            $( row ).find('td:eq(7)').attr('data-label', 'supervisor_consolidated_rate');
            $( row ).find('td:eq(7)').attr('data-label', 'reviewer_remarks');
        },
        columns: [
           
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            // {   data: 'action', name: 'action'  },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'created_by', name: 'created_by'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'status', name: 'status'  },
            {   data: 'gender', name: 'gender'  },
            {   data: 'grade', name: 'grade'  },
            {   data: 'department', name: 'department'  },
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'  },
            {   data: 'supervisor_consolidated_rate', name: 'supervisor_consolidated_rate'  },
            {   data: 'reviewer_remarks', name: 'reviewer_remarks'  },
            {   data: 'supervisor_summary', name: 'supervisor_summary'  },
            {   data: 'supervisor_pip_exit', name: 'supervisor_pip_exit'  },
            {   data: 'increment_recommended', name: 'increment_recommended'  },
            {   data: 'increment_percentage', name: 'increment_percentage'  },
            {   data: 'hike_per_month', name: 'hike_per_month'  },
            {   data: 'performance_imporvement', name: 'performance_imporvement'  },
            {   data: 'hr_remarks', name: 'hr_remarks'  },
        ],
    });
}


$(()=>{
    $("#reviewer_excel_generation_id_hr").on('click',(e)=>{
        e.preventDefault();
        var goal_id=[];
        $('#reviewer_tbl tbody>tr').each(function () {
            var id=$(this).find('td:eq(5) a').attr("data-goalcode");
            goal_id.push({
            goal_id:id
            });
        });
        $.ajax({
            url:"rev_goal_report_reviewer_hr",
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

$(()=>{
    $("#rp_excel_generation_id_hr").on('click',(e)=>{
        e.preventDefault();
        var goal_id=[];
        $('#supervisor_goal_data tbody>tr').each(function () {
            var id=$(this).find('td:eq(5) a').attr("data-goalcode");
            goal_id.push({
            goal_id:id
            });
        });
        console.log(goal_id)
        // alert(goal_id)
        $.ajax({
            url:"sup_goal_report_reviewer_hr",
            type:"POST",
            data:{id:goal_id},
            beforeSend:function(data){
            console.log("Loading!....")
            },
            success:function(response){
            // console.log(response);
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

$(()=>{
    $("#excel_generation_id_hr2").on('click',(e)=>{
        e.preventDefault();
        var goal_id=[];
        $('#get_hr_goal tbody>tr').each(function () {
            var id=$(this).find('td:eq(16) a').attr("data-goalcode");
            goal_id.push({
            goal_id:id
            });
        });
            // console.log(goal_id) 
        $.ajax({
            url:"Hr_report_reviewer_excel",
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
$(()=>{
    $("#org_excel_generation_id").on('click',(e)=>{
        e.preventDefault();
        var goal_id=[];
        $('#listing_table tbody>tr').each(function () {
            var id=$(this).find('td:eq(0) input[type=checkbox]').attr("data-goalcode");
            goal_id.push({
            goal_id:id
            });
        });
            // console.log(goal_id) 
        $.ajax({
            url:"org_report_reviewer_excel",
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

//Checkbox code started
$(()=>{
    $('#supervisor_goal_data').on('change', 'tbody input.checkbox_class', function () {
        var checkbox_count=[];
        $('#supervisor_goal_data tbody>tr').each(function () {
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
        $('#supervisor_goal_data tbody>tr').each(function () {
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
    $('#supervisor_goal_data tbody>tr').each(function () {
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
        url:"pms_checkbox_data_save_for_hr_login",
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
    $('#supervisor_goal_data tbody>tr').each(function () {
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
        url:"pms_checkbox_data_submit_for_hr_login",
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

function employee_ctc_pdf_generate(one) {
    console.log(one)
     $.ajax({
        url:"employee_ctc_pdf_create",
        type:"POST",
        data:{emp_id:one},
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