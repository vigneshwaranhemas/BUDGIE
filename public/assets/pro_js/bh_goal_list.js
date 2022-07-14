$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    bh_all_member_filter();
    add_goal_btn();
});


$(()=>{
    $("#profile-info-tab").on('click',()=>{
      Get_all_team_member_data();
    })
});

//supervisor wise filter supervisor tab button click
function bh_supervisor_filter(){
    bh_all_member_filter();
 }



function Get_all_team_member_data(){
    $.ajax({
        url:get_all_member_info_url,
        type:"GET",
        // data:{id:one},
        beforeSend:function(data){
            console.log("Loading!...")
        },
        success:function(response){
          $('#business_head_table').DataTable().clear().destroy();
          var respo=JSON.parse(response);
          var res=respo.result;
          var department=respo.department;
          var grade=respo.band;
          for(var i=0;i<res.length;i++){
              var enc_code = window.btoa(res[i].goal_unique_code);                
              var tr="<tr>";
              var td="<td>"+(i+1)+"</td>";
              var td1="<td>"+res[i].created_by_name+"</td>";
              var td2="<td>"+res[i].goal_name+"</td>";
              var td3="<td>"+res[i].employee_consolidated_rate+"</td>";
              var td4="<td>"+res[i].supervisor_consolidated_rate+"</td>";
              var td5="<td>"+res[i].sup_movement_process+"</td>";
              var td6="<td>"+res[i].reviewer_remarks+"</td>";
              var td7="<td>"+res[i].increment_recommended+"</td>";
              var td8="<td>"+res[i].increment_percentage+"</td>";
              var td9="<td>"+res[i].performance_imporvement+"</td>";
              var td10="<td>"+res[i].hr_remarks+"</td>";
              if(res[i].goal_status=="Pending")
              {
                  var color_class="btn btn-danger";
              }
              else if(res[i].goal_status=="Revert"){
                  var color_class="btn btn-primary";

              }
              else if(res[i].goal_status=="Approved"){
                  var color_class="btn btn-success";

              }
              var td11="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+res[i].goal_status+"</button></td>"
            if(res[i].bh_status==1){
                var td12="<td><div class='dropup'><button type='button' class='btn btn-success btn-xs goal_btn_status' id='dropdownMenuButton'>Submitted</button></div></td>";
            }
            if(res[i].bh_tb_status==1 && res[i].bh_status!=1){
                var td12="<td><div class='dropup'><button type='button' class='btn btn-primary btn-xs goal_btn_status' id='dropdownMenuButton'>Saved</button></div></td>";
            }
            if(res[i].bh_tb_status!=1 && res[i].bh_status!=1){
                var td12="<td><div class='dropup'><button type='button' class='btn btn-danger btn-xs goal_btn_status' id='dropdownMenuButton'>Pending</button></div></td>";
            }
            var td13="<td><div class='dropup'> <a href='goal_setting_bh_reviewer_view?id="+enc_code+"' data-goalcode="+res[i].goal_unique_code+"><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></div></td></tr>";
            $('#business_head_table').append(
                tr+td+td1+td2+td3+td4+td5+td6+td7+td8+td9+td10+td11+td12+td13
                );

          }

            var dep_html = '<option value="">Select</option>';
            for (let i = 0; i < department.length; i++) {
                dep_html += "<option value='" + department[i].department + "'>" + department[i].department + "</option>";
            }
            $('#department_bh').html(dep_html);

            var grade_html = '<option value="">Select</option>';
            for (let i = 0; i < grade.length; i++) {
                grade_html += "<option value='" + grade[i].grade + "'>" + grade[i].grade + "</option>";
            }
            $('#grade_bh').html(grade_html);
            $('#business_head_table').DataTable( {
            "searching": true,
            "paging": true,
            "info":     true,
            "fixedColumns":   {
                    left: 6
                }
        } );



        }
    })
 }




function add_goal_btn(){
    $.ajax({
        url:"add_goal_btn",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "Yes"){
                $('#add_goal_btn').css('display', 'none');
            }else{
                $('#add_goal_btn').css('display', 'block');
            }
        },
        error: function(error) {
            console.log(error);

        }

    });
}


function team_member_goal_record(){

    table_cot = $('#business_head_table').DataTable({
        searching:true,
        paging:true,
        info:true,
        fixedColumns:{
          left:6
        },
        lengthChange: true,
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        drawCallback: function() {

        },
      
        ajax: {
            url: "get_bh_goal_list",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter    = $('#reviewer_filter').val();
                d.team_leader_filter = $('#team_leader_filter').val();
                d.team_member_filter = $('#team_member_filter').val();
                d.payroll_status     = $("#payroll_status_filter2").val();
                d.department         = $("#department_bh").val();
                d.gender             = $("#gender_bh").val();
                d.grade              = $("#grade_bh").val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            // $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Business Name');
            // $( row ).find('td:eq(2)').attr('data-label', 'action');
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'    },
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'    },
            {   data: 'supervisor_consolidated_rate', name: 'supervisor_consolidated_rate'    },
            {   data: 'sup_movement_process', name: 'sup_movement_process'    },
            {   data: 'reviewer_remarks', name: 'reviewer_remarks'    },
            {   data: 'increment_recommended', name: 'increment_recommended'    },
            {   data: 'increment_percentage', name: 'increment_percentage'    },
            {   data: 'performance_imporvement', name: 'performance_imporvement'    },
            {   data:'hr_remarks',name:'hr_remarks'},
            {   data: 'sheet_status',name:'sheet_status'},
            {   data: 'status', name: 'status'    },
            {   data: 'action', name: 'action'  },

            // {   data: 'Info', name: 'Info'  },
             // var td3="<td>"+res[i].employee_consolidated_rate+"</td>";
              // var td4="<td>"+res[i].supervisor_consolidated_rate+"</td>";
              // var td5="<td>"+res[i].sup_movement_process+"</td>";
              // var td6="<td>"+res[i].reviewer_remarks+"</td>";
              // var td7="<td>"+res[i].increment_recommended+"</td>";
              // var td8="<td>"+res[i].increment_percentage+"</td>";
              // var td9="<td>"+res[i].performance_imporvement+"</td>";
              // var td10="<td>"+res[i].hr_remarks+"</td>";

        ],
    });
}

function clearFunction() {
    $('#team_member_filter').val('');
    team_member_goal_record();
}

$('#team_member_filter').change(function() {
    // team_member_goal_record();
});

$('#reviewer_filter').change(function() {
    var reviewer_filter = $('#reviewer_filter').val();
    if(reviewer_filter != ''){
        $.ajax({
            url:"fetch_reviewer_filter",
            type:"GET",
            data:{reviewer_filter:reviewer_filter},
            dataType : "JSON",
            success:function(response)
            {
                $('#team_leader_filter').html(response);
            },
            error: function(error) {
                console.log(error);

            }

        });
    }

});

$('#team_leader_filter').change(function() {
    var team_leader_filter = $('#team_leader_filter').val();
    if(team_leader_filter != ''){
        $.ajax({
            url:"fetch_team_leader_filter",
            type:"GET",
            data:{team_leader_filter:team_leader_filter},
            dataType : "JSON",
            success:function(response)
            {
                $('#team_member_filter').html(response);
            },
            error: function(error) {
                console.log(error);

            }

        });
    }

});

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
    var id = $(this).data('id');
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
        },
        error: function(response) {
         
        }

    });

});

function bh_filter_apply(){
    team_member_goal_record();
}


$(()=>{
    $("#testing_one").on('click',(e)=>{
        e.preventDefault();
        $("#reviewer_filter").val('').trigger('change');
        $("#team_leader_filter").val('').trigger('change');
        $("#team_member_filter").val('').trigger('change');
        Get_all_team_member_data();
    })
})

function reviewer_filter_reset(){
    $("#supervisor_filter").val('').trigger('change');
    $("#team_leader_filter1").val('').trigger('change');
    $("#payroll_status_filter1").val('').trigger('change');
    get_reviewer_data_bh();
}
function bh_supervisor_filter_reset(){
    $("#supervisor_filter1").val('').trigger('change');
    bh_all_member_filter();

}

$(()=>{
    $("#info-home-tab").on('click',(e)=>{
       bh_all_member_filter();
      // team_member_goal_record();
    })
})

//get overall user data under reviewer created by vignesh
$(()=>{
    $('#info-reviewer-tab').on('click',(e)=>{
        get_reviewer_data_bh();
    })
})

//get userdata with reviewer drop down filter
function get_reviewer_data_bh(){
    $.ajax({
        url:get_reviewer_tab_url,
        type:"GET",
        beforeSend:function(data){
            console.log("Loading!...")
        },
        success:function(response){
           $('#reviewer_table').DataTable().clear().destroy();
           $("#reviewer_table_data_id").empty();
           var res=JSON.parse(response);
           var user_data=res.result;
           var user_info=res.user_info_unser_reviewer;
           for(var j=0;j<user_info.length;j++){
               var option ="<option value="+user_info[j].empID+">"+user_info[j].username+"</option>";
               $("#supervisor_filter").append(option);
           }
           for(var i=0;i<user_data.length;i++){
            
              var enc_code = window.btoa(user_data[i].goal_unique_code);            

              var tr="<tr>";
              var td="<td>"+(i+1)+"</td>";
              var td1="<td>"+user_data[i].created_by_name+"</td>";
              var td2="<td>"+user_data[i].goal_name+"</td>";
              if(user_data[i].goal_status=="Pending")
              {
                  var color_class="btn btn-danger";
              }
              else if(user_data[i].goal_status=="Revert"){
                  var color_class="btn btn-primary";

              }
              else if(user_data[i].goal_status=="Approved"){
                  var color_class="btn btn-success";

              }
              var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+user_data[i].goal_status+"</button></td>"


              if(user_data[i].bh_status==1){
                var td4="<td><div class='dropup'><button type='button' class='btn btn-success btn-xs goal_btn_status' id='dropdownMenuButton'>Submitted</button></div></td>";

            }
            if(user_data[i].bh_tb_status==1 && user_data[i].bh_status!=1){
                var td4="<td><div class='dropup'><button type='button' class='btn btn-primary btn-xs goal_btn_status' id='dropdownMenuButton'>Saved</button></div></td>";

            }
            if(user_data[i].bh_tb_status!=1 && user_data[i].bh_status!=1){
                var td4="<td><div class='dropup'><button type='button' class='btn btn-danger btn-xs goal_btn_status' id='dropdownMenuButton'>Pending</button></div></td>";

            }
            var td5="<td><div class='dropup'> <a href='goal_setting_bh_reviewer_view?id="+enc_code+"' data-goalcode="+user_data[i].goal_unique_code+"><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></div></td></tr>";
            $('#reviewer_table').append(tr+td+td1+td2+td4+td3+td5);
          }

          $('#reviewer_table').DataTable( {
            "searching": true,
            "paging": true,
            "info": true,
            "fixedColumns":   {
                    left: 6
                }
        } );
        }
    })
}


 $(()=>{
       $("#supervisor_filter").on('change',()=>{
        var team_leader_filter=$("#supervisor_filter").val();
        $.ajax({
            url:"fetch_team_leader_filter",
            type:"GET",
            data:{team_leader_filter:team_leader_filter},
            dataType : "JSON",
            success:function(response)
            {
                $('#team_leader_filter1').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
       })
 })




function  get_filtered_reviewer_data(){
     $.ajax({
         url:"get_reviewer_filter_info",
         type:"POST",
          data:{supervisor:$("#supervisor_filter").val(),
                employee:$("#team_leader_filter1").val(),
                payroll_status:$("#payroll_status_filter1 :selected").val()},
         beforeSend:function(data){
             console.log("Loading!....")
         },
         success:function(response){
             var result=JSON.parse(response);
             $('#reviewer_table').DataTable().clear().destroy();
             for(var i=0;i<result.length;i++){
                var enc_code = window.btoa(result[i].goal_unique_code);

                var tr="<tr>";
                var td="<td>"+(i+1)+"</td>";
                var td1="<td>"+result[i].created_by_name+"</td>";
                var td2="<td>"+result[i].goal_name+"</td>";
                if(result[i].goal_status=="Pending")
                {
                    var color_class="btn btn-danger";
                }
                else if(result[i].goal_status=="Revert"){
                    var color_class="btn btn-primary";
                }
                else if(result[i].goal_status=="Approved"){
                    var color_class="btn btn-success";
                }
                var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+result[i].goal_status+"</button></td>"

                if(result[i].bh_tb_status==1 && result[i].bh_status==1){
                    var td4="<td><div class='dropup'><button type='button' class='btn btn-success btn-xs goal_btn_status' id='dropdownMenuButton'>Submitted</button></div></td>";
                }
                if(result[i].bh_tb_status==1 && result[i].bh_status!=1){
                    var td4="<td><div class='dropup'><button type='button' class='btn btn-primary btn-xs goal_btn_status' id='dropdownMenuButton'>Saved</button></div></td>";
                }
                if(result[i].bh_tb_status!=1 && result[i].bh_status!=1){
                    var td4="<td><div class='dropup'><button type='button' class='btn btn-danger btn-xs goal_btn_status' id='dropdownMenuButton'>Pending</button></div></td>";

                }
                var td5="<td><div class='dropup'> <a href='goal_setting_bh_reviewer_view?id="+enc_code+"'><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></div></td></tr>";
                $('#reviewer_table').append(tr+td+td1+td2+td4+td3+td5);
            }
            $('#reviewer_table').DataTable( {
                "searching": true,
                "paging": true,
                "info":true,
                "fixedColumns":   {
                        left: 6
                    }
            } );
          }
     })
}

function bh_all_member_filter(){

    table_cot = $('#supervisor_head_table').DataTable({
        
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
            url: "get_all_sup_info_bh",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                d.supervisor_id = $('#supervisor_filter1').val();
                d.payroll_status = $('#payroll_status_filter :selected').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.bh_status == 2) {
                $( row ).find('td:eq(0)').html('-');
    
                if(data.supervisor_consolidated_rate == "Exceptional Contributor"){
                    $( row ).find('td:eq(3)').html('Exceptional Contributor');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "Significant Contributor"){
                    $( row ).find('td:eq(3)').html('Significant Contributor');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "Contributor"){
                    $( row ).find('td:eq(3)').html('Contributor');
                    $("#rep_manager_consolidated_rate").hide();
                }
                if(data.supervisor_consolidated_rate == "Partial Contributor"){
                    $( row ).find('td:eq(3)').html('Partial Contributor');
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
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'bh_rating_op', name: 'bh_rating_op'  },
            {   data: 'bh_sup_status_btn', name: 'bh_sup_status_btn'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },           
        ],
    });
}

//Checkbox code started
$(()=>{
    $('#supervisor_head_table').on('change', 'tbody input.checkbox_class', function () {
        var checkbox_count=[];
        $('#supervisor_head_table tbody>tr').each(function () {
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
});

/*select all*/
// Handle click on "Select all" control
$('#example-select-all').click(function(e){
    var col1 = $(e.target).closest('table');
    $('td input:checkbox', col1).prop('checked',this.checked);
    var checkbox_count=[];
    $('#supervisor_head_table tbody>tr').each(function () {
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
    $('#supervisor_head_table tbody>tr').each(function () {
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(3) option:selected').val();
        // alert(col2)
        if(col1.prop('checked')){
            if(col2 == '')
            {
              currrow.find('td:eq(3) label').text('Rep.Manager Consolidated Rate is required').show();
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
        url:"bh_sup_pms_checkbox_data_save",
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
                }
            }
        })
    }
});

$('#checkbox_submit').on('click', function(){
    $(".rep_manager_consolidated_rate_error").hide();
    var selected=[];
    var error = '';
    $('#supervisor_head_table tbody>tr').each(function () {
        var currrow=$(this).closest('tr');
        var col1=currrow.find('td:eq(0) input[type=checkbox]');
        var col2=currrow.find('td:eq(3) option:selected').val();
        // alert(col2)

        if(col1.prop('checked')){
            if(col2 == '')
            {
                currrow.find('td:eq(3) label').text('Rep.Manager Consolidated Rate is required').show();
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
        url:"bh_sup_pms_checkbox_data_submit",
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


//business head excel generation by vignesh

function Bh_Generate_Excel(one) {
    var goal_id=[];
     if(one==1){
        var report_url="Generate_Bh_excel";
        var table_id="supervisor_head_table";
        var count=5;
     }
     if(one==2){
        var report_url="rev_goal_report_reviewer";
        var table_id="reviewer_table";
        var count=5;
     }
     if(one==3){
        var report_url="Business_Head_emp_excel";
        var table_id="business_head_table";
        var count=13;
     }

      $('#'+table_id+' tbody>tr').each(function () {
        var id=$(this).find('td:eq('+count+') a').attr("data-goalcode");
        goal_id.push({
        goal_id:id
        });
        });
      $.ajax({
        url:report_url,
        type:"POST",
        data:{id:goal_id,user_type:one},
        beforeSend:(data)=>{
            console.log("Loading!....")
        },
        success:(response)=>{
            var a = document.createElement("a");
            a.href = response.file;
            a.download = response.name;
            document.body.appendChild(a);
            a.click();
            a.remove();
        }
      })
    
}

 function show_advanced_filter(){
    
    if ($('#show_filter_div').css('display') == 'none') {
        $("#show_filter_div").css({ "display" :"flex" });
    }
    else{
        $("#show_filter_div").css({ "display" :"none" });

    }
}
