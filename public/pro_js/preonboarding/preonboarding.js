


$(()=>{
    //save changes btn click event
       $("#SaveBtn").on('click',(e)=>{
           var onBoardData=[];
           e.preventDefault();
             $('#users-table tbody>tr').each(function () {
                   var col1=$(this).find("td:eq(1)").text();
                   if($(this).find('td:eq(2) input:checkbox').is(":checked"))
                   {
                        var col2="1";
                   }
                   else{
                       var col2="0";
                   }
                   var col3 = $(this).find('td:eq(3) input[type=date]').val();
                   if(col3==""){
                        col3=null;
                   }
                   else{
                       col3=col3;
                   }
                   onBoardData.push({
                        Process:col1,
                        verified:col2,
                        date:col3
                   })
             });
             var token=$("#token").val();

              console.log(onBoardData)

              $.ajax({
                   url:"PreOnBoarding_save",
                   // url:"{{'PreOnBoarding_save'}}",
                   type:"POST",
                   data:{onboard:onBoardData,_token:token},
                   beforeSend:function(response)
                   {
                        console.log(response);
                   },
                   success:function(data)
                   {
                      var res=JSON.parse(data);
                      console.log(res)
                      if(res.type==1){

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
                            backgroundColor: "#4fbe87",
                            }).showToast();
                            setTimeout(
                                function() {
                                    location.reload();;
                                }, 2000);


                      }
                   }
              })
       })

       $('#users-table tbody').on('change', '.checkbox_check', function() {
            var currrow=$(this).closest('tr');
            if(currrow.find("td:eq(2) [type=checkbox]").is(":checked"))
            {
                   currrow.find("td:eq(3) [type=date]").prop("disabled",false);
            }
            else{
                currrow.find("td:eq(3) [type=date]").prop("disabled",true);
            }

       });

   })



   //testing buddyfeedback insert

   $(()=>{
       $("#BuddyFeedbackBtn").on('click',()=>{
              var testing_data=[];
              var main_data=[];
              var empId=$('#sess_emp_id').val();
              var error=0;
                      for(var i=0; i<fields_info.length;i++){
                                 if(i>5){
                                      var id=i+Number(1);
                                      var fieldid=$("#field"+id).val();
                                      for (f = 0; f < document.getElementById('target'+id+'').getElementsByTagName('textarea').length; f++) {
                                          var data=document.getElementById('target'+id+'').getElementsByTagName('textarea')[f].value
                                          new_test_obj={};
                                          new_test_obj.comment=data
                                          new_test_obj.empID=empId;
                                          new_test_obj.fieldid=fieldid;
                                          testing_data.push(new_test_obj)
                                           if(f==2){
                                                  main_data.push({testing_data});
                                                  testing_data=[];
                                              }
                                      }
                                  }
                              }
                              var rowCount = $('#buddy_feedbacktable tr.countable_rows').length;
                                             var i=0;
                                             var j=0;
                                             var selected=[];
                                             var selected1=[];
                                             $('#buddy_feedbacktable tbody>tr').each(function () {
                                                 var currrow=$(this).closest('tr');
                                                 var col1=currrow.find('td:eq(1) input[type=hidden]').val();
                                                 var col5=currrow.find('td:eq(7) textarea').val();
                                                 if(col5==null)
                                                 {
                                                      col5="";
                                                 }
                                                   if(i<=5){
                                                     currrow.find('input[type="checkbox"]:checked').each(function(){
                                                         selected.push({
                                                             empId:empId,
                                                             fieldid:col1,
                                                             response:$(this).attr('value'),
                                                             remarks:col5,
                                                             comments0:"",
                                                             comments1:"",
                                                             comments2:"",
                                                         });
                                                      j++;
                                                     })
                                                   }
                                               });
                                               var token=$("#token").val();
                                               if(rowCount==j){
                                                       $.ajax({
                                                           url:"SaveBuddyFeedback",
                                                           type:"POST",
                                                           data:{buddy_data:selected,ar:main_data,_token:token},
                                                           beforeSend:function(data){
                                                               console.log("Loading!....");
                                                           },
                                                           success:function(response){
                                                               var res=JSON.parse(response);
                                                               if(res.status==1){
                                                                //    toastr.success(res.message);
                                                                //    setTimeout(() => {
                                                                //         location.reload();
                                                                //    }, 2000);

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
                                                                //    toastr.error(res.message);
                                                                //    setTimeout(() => {
                                                                //        location.reload();
                                                                //   }, 2000);
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
                                                    // alert("Please Give Response for all Questions")
                                                    // toastr.error("Please Give Response for all Questions");
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

       });
   })








