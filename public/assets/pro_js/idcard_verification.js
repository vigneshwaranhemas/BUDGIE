$(document).ready(function() {
    idcard_info_tvalue();
});
/*CSRF Token*/
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

function idcard_info_tvalue(){
    $.ajax({
        url: idcard_info_view_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            console.log(data[0])
                if (data !="") {
                   if(data[0].hr_action==0){
                       $("#pro_img_up").show();
                   }
                   else{
                       $('#pro_img_up').hide();
                   }

                    // $("#pro_img").attr('src',"../ID_card_photo/"+data[0].img_path+".jpg");
                    $("#pro_img").attr('src',"../ID_card_photo/"+data[0].img_path+".png ");
                    $('#f_name').val(data[0].username);
                    $('#m_name').val(data[0].m_name);/**/
                    $('#l_name').val(data[0].l_name);/**/
                    $('#working_loc').val(data[0].worklocation);
                    $('#emp_num_1').val(data[0].contact_no);
                    $('#emp_num_2').val(data[0].emp_num_2);/**/
                    $('#rel_emp').val(data[0].rel_emp);/**/
                    $('#name_rel_ship').val(data[0].name_rel_ship);/**/
                    $('#emrg_con_num').val(data[0].emrg_con_num);/**/
                    $('#doj').val(data[0].doj);
                    $('#blood_grp').val(data[0].blood_grp);/**/
                    $('#emp_code').val(data[0].empID);
                    $('#official_email').val(data[0].email);
                    $('#emp_dob').val(data[0].dob);
                    $('#p_email').val(data[0].p_email);
                }if (data[0].hr_id_remark !="") {
                     $('#hr_id_remark').html(data[0].hr_id_remark);
                }if (data[0].hr_action == 1 ) {
                    $("#btndis").hide();
                    $("#req_hr_change").html("<h2 style='color:brown;'>Waiting For HR Approval</h2>")
                }else if(data[0].hr_action == 0 || data[0].hr_action == 3){
                    $("#btndis").show();
                }else if(data[0].hr_action == 2 ){
                    $("#btndis").hide();
                    $("#req_hr_change").html("<h2 style='color:green;'>Your ID Card is Approved</h2>")
                 }
            }
        });
    }


    $('#idcard_info').submit(function(e) {
    // getElementById("btndis").disabled=true;


        e.preventDefault();
          var formData = new FormData(this);
        $.ajax({
            url:idcard_info_link,
            method:"POST",
            data:formData,
            processData:false,
            cache:false,
            contentType:false,
            dataType:"json",
            beforeSend:function(data){
                 $(this).attr('disabled','disabled');
                    $("#btndis").text('Processing...');
            },
            success:function(data) {

                // console.log(data)
            if(data.error)
               {
                $(".color-hider").hide();
                    var keys=Object.keys(data.error);
                    $.each( data.error, function( key, value ) {
                    $("#"+key+'_error').text(value)
                    $("#"+key+'_error').show();
                    });
                    $(this).removeAttr('disabled');
                    $("#btndis").text('Submit For Approval');

               }
                if(data.response =='insert'){
                   Toastify({
                       text: "Added Sucessfully..!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                        location.reload();
                       }, 2000);

               }else if(data.response =='Update'){
                   Toastify({
                       text: "Update Sucessfully..!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                        location.reload();
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
                       }, 2000);

                   }

            },
        });
    });
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#pro_img").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
