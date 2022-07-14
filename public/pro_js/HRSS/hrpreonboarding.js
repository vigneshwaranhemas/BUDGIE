
function viewBuddyModel(one){
    var token=$("#token").val();
   $.ajax({
       url:"view_preonboarding",
       type:"POST",
       data:{id:one,_token:token},
       success:function(data){
        $("#candidate_onboardinfo").empty();
            var res=JSON.parse(data);
            for(var i=0;i<res.length;i++)
            {
                   if(res[i]["type"]==1)
                   {
                        var checked="checked";
                   }
                   else{
                       var checked="";
                   }
                 var tr='<tr>';
                 var td='<td><div>'+res[i]["preonboarding_process"]+'</div></td>';
                 var td1='<td><div class="custom-control custom-switch">\
                 <input type="checkbox" class=" js-switch packeges custom-control-input " id="switch3" '+checked+'>\
                 <label class="custom-control-label" for="switch3"></label></div></td>';
                 if(res[i]["date"]==null)
                 {

                     var date="--";
                 }
                 else{
                     var date=res[i]["date"];
                 }

                 var td2='<td>'+date+'</td>';
              $("#candidate_onboardinfo").append(tr+td+td1+td2);

            }
        $("#projectTimerModal").modal('show');

       }
   })


}
