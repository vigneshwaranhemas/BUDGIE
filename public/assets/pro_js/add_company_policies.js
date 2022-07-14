$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_policy_category();
    get_company_policy_information_data();
});


//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();

   $.ajax({
       url:add_policy_category_process_link,
       method:"POST",
       data: $("#add_policy_category").serialize(),
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
            $('#policy_category_input').val('');
            $('#exampleModal').click();
            $('#btnSubmit').prop("disabled",false);

               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    // get_division_list();
                    location.reload();
                   }, 2000);
           }
       }
   });
    })
})

function get_policy_category(){

    // $('#division_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_policy_category_details_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            // console.log(data)

            if(data.length !=0){
                // $('#policy_category').val(data[0].policy_category);
                // $('#ed_id').val(id);
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].cp_id + ">" + data[index].policy_category + "</option>";
                }
                $('#policy_category').html(html);
                $('#edit_policy_category').html(html);

            }
        }
    });
}


$(()=>{
    $("#add_policy_information").submit(function(e) {
        e.preventDefault();
        var d = $('#file')[0].files[0]
        var formData = new FormData($('#add_policy_information')[0]);

        // alert("one")
        formData.append('image',d);
        formData.append('catagory_name',$("#policy_category option:selected").text());
        // for (var p of formData) {
        //     console.log(p);
        //   }
        $.ajax({
            url: "Insert_policy_information",
            type: 'POST',
            data: formData,
            success: function (data) {

               $('#closebutton').click();
               $('#info_submit').prop("disabled",false);
               $('#info_submit').html('Submit');

               $('#policy_category').val('');
               $('#policy_title_input').val('');
               $('#policy_description_input').val('');
               $('#file').val('');

               var res=JSON.parse(data);
               if(res.success==1){
                $('#exampleModal2').click();
                Toastify({
                    text: res.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                setTimeout(
                    function() {
                     get_company_policy_information_data();
                    //  location.reload();
                    }, 2000);
            }
            else{
                Toastify({
                    text: res.message,
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
            cache: false,
            contentType: false,
            processData: false
        });
    });
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

function get_company_policy_information_data(){

table_cot = $('#company_policy_information_data').DataTable({

    dom: 'lBfrtip',
    "buttons": [
        {
            "extend": 'copy',
            "text": '<i class="bi bi-clipboard" ></i>  Copy',
            "titleAttr": 'Copy',
            "exportOptions": {
                'columns': [0,1,2,3,4,5]
            },
            "action": newexportaction
        },
        {
            "extend": 'excel',
            "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
            "titleAttr": 'Excel',
            "exportOptions": {
                'columns': [0,1,2,3,4,5]
            },
            "action": newexportaction
        },
        {
            "extend": 'csv',
            "text": '<i class="bi bi-file-text" ></i>  CSV',
            "titleAttr": 'CSV',
            "exportOptions": {
                'columns': [0,1,2,3,4,5]
            },
            "action": newexportaction
        },
        {
            "extend": 'pdf',
            "text": '<i class="bi bi-file-break" ></i>  PDF',
            "titleAttr": 'PDF',
            "exportOptions": {
                'columns': [0,1,2,3,4,5]
            },
            "action": newexportaction
        },
        {
            "extend": 'print',
            "text": '<i class="bi bi-printer"></i>  Print',
            "titleAttr": 'Print',
            "exportOptions": {
                'columns': [0,1,2,3,4,5]
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
        url: get_company_policy_infomation_link_database,
        type: 'POST',
        dataType: "json",
        data: function (d) {

        }
    },
    createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(0)').attr('data-label', 'Sno');
        $( row ).find('td:eq(1)').attr('data-label', 'Policy Category');
        $( row ).find('td:eq(2)').attr('data-label', 'Policy Title');
        $( row ).find('td:eq(3)').attr('data-label', 'Policy Description');
        $( row ).find('td:eq(4)').attr('data-label', 'File');
        $( row ).find('td:eq(5)').attr('data-label', 'Status');
        $( row ).find('td:eq(6)').attr('data-label', 'Action');
    },
    columns: [
        {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
        {   data: 'policy_category', name: 'policy_category'    },
        {   data: 'policy_title', name: 'policy_title'    },
        {   data: 'policy_description', name: 'policy_description'    },
        {   data: 'file', name: 'file'    },
        {   data: 'status', name: 'status'    },
        {   data: 'action', name: 'action'    },


    ],
});
}


//Edit pop-up model and data show
function policy_information_edit_process(id){

    $('#policy_information_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_policy_information_details_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {
            console.log(data[0].file_upload)
        $('#fileuploaded').empty();

        var file="";
        var  nameArr = data[0].file_upload.split(/[ ,]+/);
        for (var i = nameArr.length - 1; i >= 0; i--) {
        var ext = nameArr[i].split('.')[1];
        // alert(ext);
            if(ext=="pdf") {
                // alert("one");
                var tr='<tr>';
                 file = '<td><a href="../company_policy_information/'+nameArr[i]+'" target="_blank"><div class="badge bg-primary">'+nameArr[i]+'</div></a></td></tr>';
            }else if (ext=="doc"){
                var tr='<tr>';
                // alert("two");
                 file ='<td><a href="../company_policy_information/'+nameArr[i]+'" download><div class="badge bg-primary">'+nameArr[i]+'</div></a></td></tr>';
            }else{
                var tr='<tr>';
                // alert("two");
                sample ='<td> </td></tr>';
            }
                    $('#fileuploaded').append(tr+file);

        }

            if(data.length !=0){

                $('#edit_policy_category').val(data[0].cp_id);
                $('#edit_policy_title').val(data[0].policy_title);
                $('#edit_policy_description').val(data[0].policy_description);
                $('#ed_id').val(id);
            }
        }
    });
}

// Edit data insert
$(()=>{
    $("#edit_policy_information").submit(function(e) {
        e.preventDefault();
        var d = $('#file_one')[0].files[0]
        var formData = new FormData($('#edit_policy_information')[0]);

        // alert("one")
        formData.append('image',d);
        formData.append('catagory_name',$("#edit_policy_category option:selected").text());
        // for (var p of formData) {
        //     console.log(p);
        //   }
        $.ajax({
            url: edit_policy_information_details_link,
            type: 'POST',
            data: formData,
            success: function (data) {

                $('#close_edit_pop').click();
                $("#editUpdate").attr("disabled", true);
                $('#editUpdate').html('Processing..!');
                $('#editUpdate').html('Update');
                $('#policy_information_edit_pop_modal_div').click();

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
                            // location.reload();
                            get_company_policy_information_data();
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
                        get_company_policy_information_data();
                    }, 2000);

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
})

function policy_information_status_process(id, status_data){
    // $('#confirmbox').click();
    $('#status_pop_modal_div').modal('show');
    $('#confirmSubmit').unbind('click');
    $("#confirmSubmit").on('click', function() {
        $('#close_status_pop').click();

        $.ajax({
            url: process_policy_information_status_link,
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
                            get_company_policy_information_data();
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
                            get_company_policy_information_data();
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

function policy_information_delete_process(id){
    // $('#confirmbox').click();
    $('#delete_pop_modal_div').modal('show');
    $('#deleteconfirmSubmit').unbind('click');
    $("#deleteconfirmSubmit").on('click', function() {
        $('#close_delete_pop').click();

        $.ajax({
            url: process_policy_information_delete_link,
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
                            get_company_policy_information_data();
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
                            get_company_policy_information_data();
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
