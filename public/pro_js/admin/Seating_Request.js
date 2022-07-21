
    function model_trigger(one,two,three){
        if($(three).prop('checked')){
             var status=1;
        }
        else{
            var status=0;
        }
        $("#hidden_seat").val(one);
        $("#hidden_status").val(two);
        $("#seat_status").val(status)
        $('#exampleModal').modal('show');
     }
      function model_trigger1(one,two,three){
        if($(three).prop('checked')){
            var status=1;
       }
       else{
           var status=0;
       }
        $("#hidden_seat1").val(one);
        $("#hidden_status1").val(two);
        $("#seat_status1").val(status)
        $('#exampleModal1').modal('show');
     }



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
          $("#StatusUpdateBtn").show();      
        }
        else{
          $("#StatusUpdateBtn").hide();   
        }
    });
})









$(()=>{
    $("#SeatingRequestBtn").on('click',()=>{
        var token=$("#token").val();
        $.ajax({
            url:Seating_url,
            type:"POST",
            data:{id:$("#hidden_seat").val(),_token:token,status:$("#hidden_status").val(),seat_value:$("#seat_status").val()},
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
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 1000);

                  }
                  else{
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 1000);

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
            data:{id:$("#hidden_seat1").val(),_token:token,status:$("#hidden_status1").val(),seat_value:$("#seat_status1").val()},
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
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 1000);

                  }
                  else{
                    Toastify({
                        text: res.Message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 1000);

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
                       $("#pre_loader").show();
                    // console.log("Loading!.....");
                    },
                    success:(response)=>{
                        $("#pre_loader").hide();
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
