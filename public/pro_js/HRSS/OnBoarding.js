function model_trigger(one){
    $('#emp_hidden_id').val(one);
    $('#exampleModal').modal('show');
}
function edit_modal(one){
    $("#can_hidden_id").val(one)
    $('#ConformationModal').modal('show');

  }
function user_documents(id)
{
    window.location.href="userdocuments?id="+id;
}
$(()=>{
    //Employee Id creation For Candidate Created By Hr
     $('#EmpIdCreationBtn').on('click',(e)=>{
         var token=$("#token").val();
        if($('#NewEmpId').val()==""){
            Toastify({
                text:"Please Enter the Employee Id",
                duration: 3000,
                close:true,
                backgroundColor: "#f3616d",
                }).showToast();
        }
        else{
            
                $.ajax({
                url:email_and_seat_request_url,
                type:"POST",
                data:{empID: $("#NewEmpId").val(),old_empID:$('#emp_hidden_id').val(),_token:token},
                beforeSend:(e)=>{
                     $("#pre_loader").show();
                    console.log("Loading!.....");
                },
                success:(response)=>{
                    var res=JSON.parse(response);
                    console.log(res);
                    $("#pre_loader").hide();
                    if(res.success==0)
                    {
                        Toastify({
                            text:res.message,
                            duration: 3000,
                            close:true,
                            backgroundColor: "#f3616d",
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
                            backgroundColor: "#4fbe87",
                            }).showToast();
                            setTimeout(
                                function() {
                                    location.reload();;
                                }, 2000);
                    }
                }
        })
        }
     })
})
//user document status update by vignesh
$(()=>{
     $("#DocStatusBtn").on('click',(e)=>{
         e.preventDefault();
         var doc_status = $('#userDocStatus').find(":selected").val();
            var id=$("#hidden_empId").val();
            $.ajax({
            url:DocumentStatusurl,
            type:"POST",
            data:{status:doc_status,id},
            beforeSend:(e)=>{
                console.log("Loading!...");
            },
            success:(response)=>{
                var res=JSON.parse(response);
                if(res.success==1)
                {
                    Toastify({
                        text:res.message,
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
     })

})
//candidate Onboard status update work by vignesh
$(()=>{
    $('#Candidate_Status_update').on('click',(e)=>{
        var cdID=$("#can_hidden_id").val();
        $.ajax({
            url:Candidate_status_update,
            type:"POST",
            data:{id:cdID},
            beforeSend:(e)=>{
                console.log("Loading!...");
            },
            success:(response)=>{
                var res=JSON.parse(response);
                if(res.success==1)
                {
                    Toastify({
                        text:res.message,
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
    })
})


//button change event
$(()=>{
    $('#export-button').on('change', 'tbody input.check_ckechbox', function () {
        var checkbox_count=[];
        $('#export-button tbody>tr').each(function () { 
                   var col1=$(this).find("td:eq(1) input[type=checkbox]");
                   if(col1.prop('checked')){
                       checkbox_count.push(col1.val());
                   }
        });    
        if(checkbox_count.length >0){
          $("#GenIdBtn").show();      
        }
        else{
          $("#GenIdBtn").hide();   
        }
    });
})


//Employee id Creation payroll hepl wise by vignesh
$(()=>{
     $('#GenIdBtn').on('click',(e)=>{
        e.preventDefault();
        var check_count=0;
        var emp_code=[];
        $("#export-button tbody>tr").each(function(){
            var currrow=$(this).closest('tr');
            if(currrow.find('td:eq(1) input[type=checkbox]').is(':checked')){
                          var col1=currrow.find('td:eq(2)').text();
                           emp_code.push({
                             empID:col1,
                           });
                           check_count++;
           }        
        })
       $.ajax({
            url:"Auto_employee_IdGeneration",
            type:"POST",
            data:{emp_id:emp_code},
            beforeSend:(data)=>{
                $("#GenIdBtn").attr('disabled',true);
                $("#pre_loader").show();
            },
            success:(response)=>{
                $("#pre_loader").hide();
                var res=JSON.parse(response)
                if(res.success==1)
                {
                    Toastify({
                        text:res.message,
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

        console.log(emp_code)





     })
})