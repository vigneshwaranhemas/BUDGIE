$(()=>{
    $('#son').on('change',(e)=>{
        var val =$('#son').val();
     //   alert(val);
        if (val == "Son") {
          $('#sp_gender').val("Male");
         }
else{
    $('#sp_gender').val("Female");
}
        })
    })
    $(()=>{
        $('#son1').on('change',(e)=>{
            var val =$('#son1').val();
     //   alert(val);
        if (val == "Son") {
              $('#sp_gender1').val("Male");
             }
    else{
        $('#sp_gender1').val("Female");
    }
            })
        })
    // $(()=>{
    //     $('#daughter').on('click',(e)=>{
    //         if ($("#daughter").prop("checked")) {
    //           $('#sp_gender').val("Female");
    //          }
    
    //         })
    //     })
    //     $(()=>{
    //         $('#son1').on('click',(e)=>{
    //             if ($("#son1").prop("checked")) {
    //               $('#sp_gender1').val("Male");
    //              }
        
    //             })
    //         })
    //         $(()=>{
    //             $('#daughter1').on('click',(e)=>{
    //                 if ($("#daughter1").prop("checked")) {
    //                   $('#sp_gender1').val("Female");
    //                  }
            
    //                 })
    //             })
$('#add_medical_form').submit(function(e) {
    // alert("test");
        e.preventDefault();
        var form = $(this)[0];
         var formData = new FormData(form);
    
            $.ajax({  
                 url:save_medical_form_link, 
                 method:"POST",  
                // enctype: 'multipart/form-data',
                 data:formData,
                 cache:false,
                 contentType: false,
                 processData: false,
                 dataType:"json",
                 success:function(data) {
             
                     if(data.response =='success'){
     
                         Toastify({
                             text: "Added Successfully",
                             duration: 3000,
                             close:true,
                             backgroundColor: "#4fbe87",
                         }).showToast();
     
                         setTimeout(
                             function() {
                                window.open(data.redirect_url, '_blank').focus();
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