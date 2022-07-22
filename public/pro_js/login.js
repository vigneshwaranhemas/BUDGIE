/*$(document).ready(function() {
    employeeid_valid();
});
function employeeid_valid(){

    var textInput = document.getElementById("employee_id").value;
    textInput = textInput.replace(/[&\/\-_=|\][;\#,+()$~%.'":*?<>{}@^!`]/g, "");
    document.getElementById("employee_id").value = textInput;
    if(textInput ==''){
        $("#employee_id").addClass("is-invalid");
        $("#btnLogin").attr("disabled", true);

    }
    else{
        $("#employee_id").addClass("is-valid");
        $("#employee_id").removeClass("is-invalid");
        $('#btnLogin').removeAttr("disabled");

    }
}*/
function password_valid(){

    var textInput = document.getElementById("login_password").value;
    if(textInput ==''){
        $("#login_password").removeClass("is-valid");
        $("#login_password").addClass("is-invalid");

        $("#btnLogin").attr("disabled", true);


    }
    else{
        $("#login_password").removeClass("is-invalid");

        $("#login_password").addClass("is-valid");
        $("#btnLogin").attr("disabled", false);


    }
}

function getEmpemail(data){

    var data = $("#employee_id").val();
    // alert(data)
    $.ajax({
            url:getemail_process_link,
            method:"POST",
            data: {"data": data,},
            dataType:"json",

            success:function(data) {
                // alert(data)
                if (data.email !="") {
                    $('#emp_email').val(data.email);
                }else{
                     Toastify({
                        text: "Email ID is Not Assigned for you Kaindly Contact HR...!",
                        duration: 4000,
                        close:true,
                        backgroundColor: "#f3616d",
                    }).showToast();
                    setTimeout(
                        function() {
                            // window.location = data.url;
                        }, 1000);


                }
            }
        });
    }

$(()=>{
$('#loginForm').submit(function(e) {
    // alert("asdasdasdas")
        $('#btnLogin').attr('disabled',true);

    var formData = new FormData(this);
    e.preventDefault();

       $.ajax({
            url:login_check_process_link,
            method:"POST",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",

            success:function(data) {
                    // console.log(data)
                if(data.logstatus =='success'){
                     // window.location = data.url;
                    Toastify({
                        text: "Login Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    setTimeout(
                        function() {
                            window.location = data.url;
                        }, 1000);

                }else if(data.logstatus =='already_login'){
                    $('#btnLogin').attr('disabled',false);
                    Toastify({
                        text: "This Emp ID is Login on Another Device",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                    }).showToast();
                    setTimeout(
                        function() {
                        }, 1000);

                }else{
                    $('#btnLogin').attr('disabled',false);
                    Toastify({
                        text: "Emp ID or Password are wrong",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                    }).showToast();
                    setTimeout(
                        function() {
                        }, 1000);
                }

            }
        });
    });
})

$(()=>{
$('#forgot_pass').submit(function(e) {
    $("#forgot_pass_but").text('Sending Mail...');
    $('#forgot_pass_but').attr('disabled',true);

    var formData = new FormData(this);
    e.preventDefault();

       $.ajax({
            url:forgot_pass_process_link,
            method:"POST",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",
             

            success:function(data) {
                if(data.error){
                $(".color-hider").hide();
                    var keys=Object.keys(data.error);
                    $.each( data.error, function( key, value ) {
                    $("#"+key+'_error').text(value)
                    $("#"+key+'_error').show();
                    });
                    $('#forgot_pass_but').attr('disabled',false);
                    $("#forgot_pass_but").text('Save');
               }
                if(data.response =='Updated'){
                   Toastify({
                       text: "Your password change like send to your mail..!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                        window.location = data.url;
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
                       }, 1000);

                   }

            }
        });
    });
})

$('#con_pass').submit(function(e) {

    // var params = new window.URLSearchParams(window.location.search);
    var token  = new_value
    $(this).attr('disabled','disabled');
    $("#btnLogin").text('Processing...');

    var formData = new FormData(this);
    formData.append( 'token', token );
    e.preventDefault();
       $.ajax({
            url:con_pass_process_link,
            method:"POST",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",

            success:function(data) {
                    // console.log(data)
                if(data.error){
                $(".color-hider").hide();
                    var keys=Object.keys(data.error);
                    $.each( data.error, function( key, value ) {
                    $("#"+key+'_error').text(value)
                    $("#"+key+'_error').show();
                    });
                    $(this).removeAttr('disabled');
                    $("#btnLogin").text('Save');
               }
                if(data.response =='Updated'){
                   Toastify({
                       text: "Updated successfully..! Please Login In Back!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                         window.location = data.url;
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

            }
        });
    });
