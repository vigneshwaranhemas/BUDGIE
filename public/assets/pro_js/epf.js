$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(()=>{
        $('#father_name').on('click',(e)=>{
            if ($("#father_name").prop("checked")) {
              //  alert("father_name");
                $("#f_name").prop('required',true);
                $("#s_name").prop('required',false);
             //   $("#s_name").val("no-val");
                $("#f_name").css("display","block");
                $("#s_name").css("display","none");
             }

            })
        })


        $(()=>{
            $('#spouse_name').on('click',(e)=>{   
        
        if ($("#spouse_name").prop("checked")) {
               // alert("spouse_name");
                $("#s_name").prop('required',true);
                $("#f_name").prop('required',false);
              //  $("#f_name").val("no-val");
                 $("#s_name").css("display","block");
                 $("#f_name").css("display","none");
             }
            

            })
        })

        $(()=>{
            $('.test_name').on('click',(e)=>{   
        // alert("test");
        if ($("#spouse_name").prop("checked") || $("#father_name").prop("checked"))  {
               
                return false;
             }
             else{
                 alert("Please click Father name/spouse name whichever is applicable!!!")
             }
            

            })
        })
        // Email id validation
        $(()=>{
            $('#email_id').on('keypress',(e)=>{   
               var val=  $('#email_id').val();
            var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(val);
            if(!re) {
              //  alert(val);
                $('#error_email').css("display","block");
            } else {
              
                $('#error_email').css("display","none");
            }
        })
    })
    // mobile no validation
    $(document).on('keyup', '#mob_no', (function() {
            var mobNum = $(this).val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
        
              //if (filter.test(mobNum)) {
                if(mobNum.length==10){
                     // alert("valid");
                      //$("#succ_msg").css("display","block");
                      $("#err_msg").css("display","none");
                      $('#btnSubmit').prop("disabled",false);
                   
                 } else {
                  //  alert('Please put 10  digit mobile number');
                   $("#err_msg").css("display","block");
                 //  $("#succ_msg").css("display","none");
                   $('#btnSubmit').prop("disabled",true);
                 
                  // $("#mobile-valid").addClass("hidden");
                   // return false;
                  }
             
        
        }));

        $(document).on('click', '#epf_yes', (function() {
            if ($("#epf_yes").prop("checked")){
            $(".pmd").prop('required',true);
           }
        }));
        $(document).on('click', '#epsyes', (function() {
                if ($("#epsyes").prop("checked")){
                $(".pmd").prop('required',true);
               }
            }));
            $(document).on('click', '#epf_no', (function() {
                if ($("#epf_no").prop("checked")){
                $(".pmd").prop('required',false);
               // $(".pmd").val("no-val");
               }
            }));
            $(document).on('click', '#epsno', (function() {
                if ($("#epsno").prop("checked")){
                $(".pmd").prop('required',false);
               // $(".pmd").val("no-val");
               }
            }));

        $(document).on('click', '#int_yes', (function() {
                if ($("#int_yes").prop("checked")){
                $(".sco").prop('required',true);
               }
            }));
            $(document).on('click', '#int_no', (function() {
                if ($("#int_no").prop("checked")){
                $(".sco").prop('required',false);
               // $(".sco").val("no-val");
               }
            }));
        $('#add_epf_form').submit(function(e) {
           // alert("test");
               e.preventDefault();
               var form = $(this)[0];
                var formData = new FormData(form);
           
                   $.ajax({  
                        url:save_epf_form_link, 
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
                                        window.location.href = "view_epf_form";
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