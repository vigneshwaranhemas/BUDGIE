$(()=>{
    $.ajax({
        url:email_url,
        type:"GET",
        beforeSend:(e)=>{
            console.log("loading!...")
        },
        success:function(data){
            $("#emailIdCreation").empty();
            $('#export-button').DataTable().destroy();
             if(data==1){
             }
             else{
              $("#emailIdCreation").append(data);
             }
            $('#export-button').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        }

    })
})

$(()=>{
    $('#EmailCreationBtn').on('click',(e)=>{
        var check_count=0;
        var token=$("#token").val();
        e.preventDefault();
        var selected=[];
        $('#export-button tbody>tr').each(function () {
            var currrow=$(this).closest('tr');
            if(currrow.find('td:eq(1) input[type=checkbox]').is(':checked')){
                  var col1=currrow.find('td:eq(1) input[type=hidden]').val();
                  var col2=currrow.find('td:eq(5) input[type=hidden]').val();
                  var col3=currrow.find('td:eq(6) input[type=text]').val();
                  var col4=currrow.find('td:eq(7) option:selected').val();
                   selected.push({
                     empID:col1,
                     status:1,
                     hr_suggested_mail:col3,
                     asset_type:col4,
                   });
                   check_count++;
            }
        });

        if(check_count>0){
                   $.ajax({
                    url:status_update_url,
                    type:"POST",
                    data:{info:selected,_token:token},
                    beforeSend:(e)=>{
                    console.log("Loading!.....");
                    },
                    success:(response)=>{
                        var res=JSON.parse(response);
                        if(res.success==1){
                            Toastify({
                                text: res.message,
                                duration: 3000,
                                close:true,
                                backgroundColor: "#4fbe87",
                                }).showToast();
                                setTimeout(
                                    function() {
                                        location.reload();;
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
                                        location.reload();;
                                    }, 2000);
                        }
                    }
                })
        }
        else{
            Toastify({
                text:"Invalid Process",
                duration: 3000,
                close:true,
                backgroundColor: "#f3616d",
                }).showToast();
        }

    })
})
