
function showAdd(one) {
    var token=$("#token").val();
     $.ajax({
         url:"show_buddy_feedback",
         type:"POST",
         data:{id:one,_token:token},
         beforeSend:(e)=>{
            console.log("Loading!....");
         },
         success:(response)=>{
             var res=JSON.parse(response);
             var fields=res.fields;
             var feedback=res.feedback_info;
             console.log(feedback)

            $("#buddy_feedback_tableId").empty();
            $("#textarea_div").empty();
             for(var i=0;feedback.length>i;i++){
                    if(i<=5)
                    {
                    var tr='<tr>';
                    var td1="<td>"+fields[i].id+"</td>";
                    var td2="<td><p class='word-warpped'>"+fields[i].Buddy_feedback_fields+"</p></td>";
                    var td3="<td><p "+(feedback[i]['response']=="1" ? 'style="color:green" class="fa fa-check"  ' : '')+"></p></td>";
                    var td4="<td><p "+(feedback[i]['response']=="2" ? 'style="color:green" class="fa fa-check"  ' : '')+"></p></td>";
                    var td5="<td><p "+(feedback[i]['response']=="3" ? 'style="color:green" class="fa fa-check"  ' : '')+"></p></td>";
                    var td6="<td><p "+(feedback[i]['response']=="4" ? 'style="color:green" class="fa fa-check"  ' : '')+"></p></td>";
                    var td7="<td><p "+(feedback[i]['response']=="5" ? 'style="color:green" class="fa fa-check"  ' : '')+"></p></td>";
                    if(feedback[i].remarks==null)
                    {
                         var feedback_remarks="--";
                    }
                    else{
                        var feedback_remarks=feedback[i].remarks;
                        // var feedback_remarks="Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column";
                    }
                    var td8="<td>"+feedback_remarks+"</td>";
                    $("#buddy_feedback_tableId").append(tr+td1+td2+td3+td4+td5+td6+td7+td8);
                    }
                     if(i>5){
                            if(feedback[i]["comments0"]==null){
                                var feedback1="--"
                            }
                            else{
                                var feedback1=feedback[i]["comments0"];
                            }
                            if(feedback[i]["comments1"]==null){
                                var feedback2="--"
                            }
                            else{
                                var feedback2=feedback[i]["comments1"];
                            }
                            if(feedback[i]["comments2"]==null){
                                var feedback3="--"
                            }
                            else{
                                var feedback3=feedback[i]["comments2"];
                            }

                             var div_data='<div class="row" style="margin-top: 40px;">\
                             <div class="col-md-12">\
                                 <h6>'+(i+1)+'). '+fields[i].Buddy_feedback_fields+'</h6>\
                             </div>\
                             <div class="col-md-4 text-center">\
                                 <div class="card">\
                                     <div class="card-body grid-showcase">\
                                         <p>'+feedback1+'</p>\
                                     </div>\
                                 </div>\
                             </div>\
                             <div class="col-md-4 text-center">\
                                 <div class="card">\
                                     <div class="card-body grid-showcase">\
                                         <p>'+feedback2+'</p>\
                                     </div>\
                                 </div>\
                             </div>\
                             <div class="col-md-4 text-center">\
                                 <div class="card">\
                                     <div class="card-body grid-showcase">\
                                         <p>'+feedback3+'</p>\
                                     </div>\
                                 </div>\
                             </div>\
                             ';

                             $("#textarea_div").append(div_data)








                        //           var div_data='<div class="row" style="margin-top: 40px;">\
                        //           <div class="col-md-12">\
                        //             <h6>'+(i+1)+'). '+fields[i].Buddy_feedback_fields+'</h6>\
                        //             <input type="hidden" id="field'+fields[i].id+'"  value="'+fields[i].id+'">\
                        //           </div>\
                        //             <div class="col-md-4 text-center">\
                        //             <div class="card">\
                        //                 <div class="card-body grid-showcase">\
                        //                     <p>'+feedback[i]["comments0"]+'</p>\
                        //                 </div>\
                        //             </div>\
                        //            </div>\
                        //            <div class="col-md-4 text-center">\
                        //             <div class="card">\
                        //                 <div class="card-body grid-showcase">\
                        //                     <p>'+feedback[i]["comments1"]+'</p>\
                        //                 </div>\
                        //             </div>\
                        //            </div>\
                        //            <div class="col-md-4 text-center">\
                        //             <div class="card">\
                        //                 <div class="card-body grid-showcase">\
                        //                     <p>'+feedback[i]["comments2"]+'</p>\
                        //                 </div>\
                        //             </div>\
                        //            </div>\
                        //         </div>';
                        //   $("#textarea_div").append(div_data)





                        // $("#buddy_feedback_tableId").append(tr+td1+td2+td3+td4+td5+td6+td7);
                     }
             }
         $('#edit-column-form').modal('show');
         }
     })



}
