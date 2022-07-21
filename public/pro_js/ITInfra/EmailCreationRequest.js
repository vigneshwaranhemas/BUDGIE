
$(()=>{


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
          $("#EmailStatusUpdateBtn").show();      
        }
        else{
          $("#EmailStatusUpdateBtn").hide();   
        }
    });
})



    $('#EmailStatusUpdateBtn').on('click',(e)=>{
        $("#EmailStatusUpdateBtn").prop('disabled',true);
        var token=$("#token").val();
        e.preventDefault();
        var selected=[];
        var checkcount=0;
        $('#export-button tbody>tr').each(function () {
            var currrow=$(this).closest('tr');
            if(currrow.find('td:eq(1) input[type=checkbox]').is(':checked')){
                  var col2=currrow.find('td:eq(2)').text();
                  var col3=currrow.find('td:eq(6) input[type=text]').val();
                   selected.push({
                     empID:col2,
                     Email:col3,
                   });
                checkcount++;
            }
        });
        if(checkcount>0)
        {
            $.ajax({
                url:it_url,
                type:"POST",
                data:{empID:selected,_token:token},
                beforeSend:(e)=>{
                //    console.log("Loading!.....");
                   $("#pre_loader").show();
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
                text: "Invalid Action!",
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
