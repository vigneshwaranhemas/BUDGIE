
    function model_trigger(one,two){
        $("#hidden_seat").val(one);
        $("#hidden_status").val(two);
        $('#exampleModal').modal('show');
     }
      function model_trigger1(one,two){
        $("#hidden_seat1").val(one);
        $("#hidden_status1").val(two);
        $('#exampleModal1').modal('show');
     }
$(()=>{
    $("#SeatingRequestBtn").on('click',()=>{
        var token=$("#token").val();
        $.ajax({
            url:Seating_url,
            type:"POST",
            data:{id:$("#hidden_seat").val(),_token:token,status:$("#hidden_status").val()},
            beforeSend:(e)=>{
                console.log("Loading!....")
            },
            success:function(response){
                  var res=JSON.parse(response);
                  if(res.success==1)
                  {
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                        }).showToast();

                  }
                  else{
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();

                  }
            }
        })
    })
})
$(()=>{
    $("#SeatingRequestBtn1").on('click',()=>{
        var token=$("#token").val();
        $.ajax({
            url:Seating_url,
            type:"POST",
            data:{id:$("#hidden_seat1").val(),_token:token,status:$("#hidden_status1").val()},
            beforeSend:(e)=>{
                console.log("Loading!....")
            },
            success:function(response){
                  var res=JSON.parse(response);
                  if(res.success==1)
                  {
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                        }).showToast();

                  }
                  else{
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();

                  }
            }
        })
    })
})




$(()=>{
    $('#StatusUpdateBtn').on('click',(e)=>{
        $("#StatusUpdateBtn").prop('disabled',true);
        var token=$("#token").val();
        e.preventDefault();
        var selected=[];
        var checkcount=0;
        $('#export-button tbody>tr').each(function () {
            var currrow=$(this).closest('tr');
            if(currrow.find('td:eq(1) input[type=checkbox]').is(':checked')){
                  var col1=currrow.find('td:eq(1) input[type=hidden]').val();
                   selected.push({
                     Off_empId:col1
                   });
                   checkcount++;
            }

        });
        if(checkcount>0)
        {
                    $.ajax({
                    url:Status_update,
                    type:"POST",
                    data:{empID:selected,_token:token},
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
                text:"Invalid Action",
                duration: 3000,
                close:true,
                backgroundColor: "#f3616d",
                }).showToast();
                setTimeout(
                    function() {
                        location.reload();;
                    }, 2000);
        }

    })
})
