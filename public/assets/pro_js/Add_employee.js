$(()=>{
    $("#AddEmployeeBtn").on('click',(e)=>{
        e.preventDefault();
        var supervisor_id=$("#supervisor_name option:selected").text();
        var reviewer_id=$("#reviewer_name option:selected").text();
        var role=$('#candidate_role_type option:selected').text();
        $.ajax({
            url:"AddEmployee_info",
            type:"POST",
            data:$("#AddEmployeeForm").serialize()+ "&supervisor=" +supervisor_id +"&reviewer=" +reviewer_id  +"&role=" +role,
            beforeSend:(data)=>{
                console.log("Loading!..")
            },
            success:(response)=>{
                $(".color-hider").hide();
                if(response.error)
                {
                    var keys=Object.keys(response.error);
                    $.each(response.error, function( key, value ) {
                    $("#"+key+'_error').text(value)
                    $("#"+key+'_error').show();
               });
            }
            else{
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                setTimeout(
                    function() {
                        window.location.href="employee_list";
                    }, 2000);
            }
            }
        })
    })
})
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }reviewer_name
    return true;
}

//change event for reporting manager 
$(()=>{
    $("#supervisor_name").on('change',(e)=>{
        var supervisor=$("#supervisor_name option:selected" ).val();
        var data=emp_info;
        for(var i=0;i<data.length;i++){
             if(data[i].empID==supervisor){
                  $("#reviewer_name").val(data[i].sup_emp_code).trigger('change');
                  break;
             }
        }
    })
})



