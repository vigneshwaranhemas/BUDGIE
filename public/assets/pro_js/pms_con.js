
$('#check').click(function() {
  if ($(this).is(':checked')) {
    $('#submit').removeAttr('disabled');

  } else {
    $('#submit').attr('disabled', 'disabled');
  }
});


$('#pms_status').submit(function(e) {  

    // $(this).attr('disabled','disabled');   
    // $(".pms_but").text('Processing...');   
    
        e.preventDefault();
          var formData = new FormData(this);
        $.ajax({  
            url:pms_conformation_sub, 
            method:"POST",  
            data:formData,
            processData:false,
            cache:false,
            contentType:false,
            dataType:"json",
            success:function(data) {
            //console.log(data)
                if(data.success ==1){
                   Toastify({
                       text: "Submit Sucessfully..!",
                       duration: 1000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                        window.location.href = "../index.php/goals";
                       }, 1000);
               }
               else{
                   Toastify({
                       text: "Request Failed..! Try Again",
                       duration: 1000,
                       close:true,
                       backgroundColor: "#f3616d",
                   }).showToast();

                   setTimeout(
                       function() {
                       }, 1000);

                   }
                
            },
        }); 
    });