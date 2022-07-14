
$(document).ready(function(){
  add_goal_btn_login();
});


function add_goal_btn_login(){
    
  $.ajax({                   
      url:"add_goal_btn_login",
      type:"GET",
      dataType : "JSON",
      success:function(response)
      {
          if(response == "NAPS"){
              $('#pms_instruction_naps').css('display', 'block');
              $('#pms_instruction').css('display', 'none');
          }else{
              $('#pms_instruction').css('display', 'block');
              $('#pms_instruction_naps').css('display', 'none');
          }
      },
      error: function(error) {
          console.log(error);

      }                                              
          
  });

}

$('#check').click(function() {
  if ($(this).is(':checked')) {
    $('#submit').removeAttr('disabled');

  } else {
    $('#submit').attr('disabled', 'disabled');
  }
});

$('#check1').click(function() {
  if ($(this).is(':checked')) {
    $('#submit1').removeAttr('disabled');

  } else {
    $('#submit1').attr('disabled', 'disabled');
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
            console.log(data)
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

    $('#pms_status_1').submit(function(e) {  

      // $(this).attr('disabled','disabled');   
      // $(".pms_but").text('Processing...');   
      
          e.preventDefault();
            var formData = new FormData(this);
          $.ajax({  
              url:pms_conformation_sub_naps, 
              method:"POST",  
              data:formData,
              processData:false,
              cache:false,
              contentType:false,
              dataType:"json",
              success:function(data) {
              console.log(data)
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