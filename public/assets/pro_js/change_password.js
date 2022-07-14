$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$('#changePassForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({  
        url:change_password_process_link, 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",

        success:function(data) {
            if(data.response =='Updated'){

                Toastify({
                    text: "Updated Sussssfully..! Please Login In Back..! ",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                setTimeout(
                    function() {
                        window.location.href = "../index.php";

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
                        location.reload();
                    }, 2000);

            }
            
        }  
    });  
});