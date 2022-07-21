
$(document).ready(function() {
    profile_info_process();
    profile_banner_image();
    get_state_list();
    Contact_info_page();
});
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

/*ifsc code validation*/
$(document).ready(function(){       
    $("#ifsc_code").change(function () {      
    var inputvalues = $(this).val();      
      var reg = /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/;    
            if (inputvalues.match(reg)) {    
                return true;    
            }else {    
                 $("#ifsc_code").val("");   
                 Toastify({
                   text: "You entered invalid IFSC code",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();
               setTimeout(
                   function() {
                   }, 2000);
                // alert("You entered invalid IFSC code");    
                document.getElementById("#ifsc_code").focus();    
                return false;    
            }    
        });          
    });
/*popup*/

/*banner image popup*/
$("#banner_img").on('click', function() {
    $.ajax({
        url: profile_banner_image_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            banner_img_popup(data.banner_image);
        }
    });
});
 function banner_img_popup(sample){
       $("#sample_view_ban").attr("src", "../banner/"+sample);
       $(".sample-preview_ban").modal('show');
   }

/*profile image popup*/
$("#profile_img").on('click', function() {
    $.ajax({
        url: display_image,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data['image'])
          if(data['image'] != ""){
            profile_img_popup(data['image'].path);
          }
        }
    });
});
 function profile_img_popup(sample){
       $("#sample_view_pro").attr("src", "../uploads/"+sample);
       $(".sample-preview_pro").modal('show');
   }

/*banner image upload*/
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 700,
            height: 200,
            type: 'rectangle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

/*$('#profile_but').on('click', function () {
  $.getScript("../assets/js/bootstrap-tagsinput.min.js");
});*/

$('#upload').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            // url: "/image-crop",
            url: banner_image_crop_link,
            type: "POST",
            data: {"image":resp},
            success: function (data) {
                // console.log(data)
            if(data.error){
                $(".color-hider").hide();
                    var keys=Object.keys(data.error);
                    $.each( data.error, function( key, value ) {
                    $("#"+key+'_error').text(value)
                    $("#"+key+'_error').show();
                    });
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
                /*html = '<img src="' + resp + '" />';
                $("#upload-demo-i").html(html);*/
            }
        });
    });
});
/*banner image end upload*/
$("#sameadd").on('click', function() {
       var c_State = document.getElementById('p_State').value;
       var c_district = document.getElementById('p_district').value;
      get_district_Current(c_State,c_district);
      var c_district = document.getElementById('p_district').value;
      var c_town = document.getElementById('p_town').value;
       get_town_name_Current(c_district,c_town);
       CopyAdd();

});

/*clone textbox value*/
    function CopyAdd() {
      var cb1 = document.getElementById('sameadd');
      var p_addres = document.getElementById('p_addres');
      var c_addres = document.getElementById('c_addres');
      var p_State = document.getElementById('p_State');
      var c_State = document.getElementById('c_State');
      var p_pin = document.getElementById('p_pin');
      var c_pin = document.getElementById('c_pin');

      if (cb1.checked) {
        var checkBox = document.getElementById("sameadd");
        var text = document.getElementById("text");

                c_addres.value = p_addres.value;
                c_State.value = p_State.value;
                c_pin.value = p_pin.value;
          if (checkBox.checked == true){
            text.style.display = "block";
          } else {
             text.style.display = "none";
          }
      }
    }


function profile_banner_image(){
    $.ajax({
        url: profile_banner_image_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            if (Object.keys(data).length === 0) {
                $("#banner_img").attr('src',"../assets/images/other-images/profile-style-img3.png");
            }
            else{
                $("#banner_img").attr('src',"../banner/"+data.banner_image);
            }
        }
    });
}
/*skill*/
$('#add_profile_info').submit(function(e) {

        $('#doc_Submit').attr('disabled','disabled');
        $("#doc_Submit").text('Processing...');

   e.preventDefault();
      var formData = new FormData(document.getElementById("add_profile_info"));
   $.ajax({
       url:add_skill_set_link,
       method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",

       success:function(data) {
         if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                $('#doc_Submit').attr('disabled' , false);
                $('#doc_Submit').html('Save');
           }
           // console.log(data);
           if(data.response =='Update'){
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
    })



/*contact info in pop-up*/
$("#v-pills-messages-tab").on('click', function() {
    Contact_info_page();
});

function Contact_info_page(){
    $.ajax({
        url: Contact_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
                if (data !="") {
                    $('#p_num_view').html(data['0'].phone_number);
                    $('#s_num_view').html(data['0'].s_number);
                    $('#p_email_view').html(data['0'].p_email);
                    $('#p_addres_view').html(data['0'].p_addres+','+data['0'].p_town+','+data['0']. p_district+','+data['0'].p_State+'-'+data['0'].p_pin);
                    $('#c_addres_view').html(data['0'].c_addres+','+data['0'].c_town+','+data['0']. c_district+','+data['0'].c_State+'-'+data['0'].c_pin);
                }
            }
        });
    }

function Contact_information(){
    $.ajax({
        url: Contact_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data['0'])
            if (data !="") {
                $('#phone_number').val(data['0'].phone_number);
                $('#s_number').val(data['0'].s_number);
                $('#p_email').val(data['0'].p_email);
                $('#p_addres').val(data['0'].p_addres);
                $('#p_State').val(data['0'].p_State);
                get_district(data['0'].p_State,data['0'].p_district);
                $('#p_district').val(data['0'].p_district);
                get_town_name(data['0'].p_district,data['0'].p_town);
                $('#p_town').val(data['0'].p_town);
                $('#c_addres').val(data['0'].c_addres);
                $('#c_State').val(data['0'].c_State);
                get_district_Current(data['0'].c_State,data['0'].c_district);
                $('#c_district').val(data['0'].c_district);
                get_town_name_Current(data['0'].c_district,data['0'].c_town);
                $('#c_town').val(data['0'].c_town);
                $('#p_pin').val(data['0'].c_pin);
                $('#c_pin').val(data['0'].p_pin);
                $('#State').val(data['0'].State);
            }

            }
        });
    }


$('#add_contact_info').submit(function(e) {
    $('#cont_Save').attr('disabled','disabled');
        $("#cont_Save").text('Processing...');

    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({
        url:add_contact_info_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                 $('#cont_Save').attr('disabled' , false);
                $('#cont_Save').html('Save');
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
/*listing*/
    function get_state_list() {
    $.ajax({
        url: state_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].state_name + "'>" + data[index].state_name + "</option>";
            }
            $('#p_State').html(html);
            $('#c_State').html(html);
        }
    });
}
     $("#p_State").on('change', function () {
            var p_State =document.getElementById('p_State').value;
            get_district(p_State);
        });
        $("#c_State").on('change', function () {
            var c_State =document.getElementById('c_State').value;
            // console.log(c_State)
            get_district_Current(c_State);
        });

    function get_district(p_State,p_district) {
        if (p_district =="") {
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"p_State":p_State},
            dataType: "json",
            success: function(data) {
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                }
                $('#p_district').html(html);
            }

        });
    }else{
        // alert("not_empty")
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"p_State":p_State},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    // console.log(data[index].district_name )
                    if (p_district == data[index].district_name ) {

                    html += "<option value='" + data[index].district_name + "' selected>" + data[index].district_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                    }
                }
                $('#p_district').html(html);

            }

        });
    }
    }

    function get_district_Current(c_State,c_district) {
        // console.log("text_"+c_district)
       if (c_district =="") {
        $.ajax({
            url: get_district_cur_link,
            method: "POST",
            data:{"c_State":c_State},
            dataType: "json",
            success: function(data) {
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                }
                $('#c_district').html(html);
            }

        });
    }else{
        // console.log(c_State)
        $.ajax({
            url: get_district_cur_link,
            method: "POST",
            data:{"c_State":c_State},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    console.log(data[index].district_name )
                        console.log("text"+c_district)
                    if (c_district == data[index].district_name ) {
                    html += "<option value='" + data[index].district_name + "' selected>" + data[index].district_name + "</option>";
                    }else{
                        // console.log(data[index].district_name )
                         html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                    }
                }
                $('#c_district').html(html);
            }

        });
    }
    }


    $("#p_district").on('change', function () {
        var p_district =document.getElementById('p_district').value;
        // alert(p_district)
        get_town_name(p_district);
    });
    $("#c_district").on('change', function () {
        var c_district =document.getElementById('c_district').value;
        // alert(c_district)
        get_town_name_Current(c_district);
    });




    function get_town_name(p_district,p_town) {
        if (p_town == "") {
        $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{ "p_district" : p_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                }
                $('#p_town').html(html);
            }

        });
    }else{
         $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{ "p_district" : p_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {

                    if (p_town == data[index].town_name ) {
                    html += "<option value='" + data[index].town_name + "' selected>" + data[index].town_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                    }
                }
                $('#p_town').html(html);
            }

        });
    }
    }
    function get_town_name_Current(c_district,c_town) {
        if (c_town == "") {
        $.ajax({
            url: get_town_name_curr_link,
            method: "POST",
            data:{ "c_district" : c_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                }
                $('#c_town').html(html);
            }

        });
    }else{
        // alert("asd")
         $.ajax({
            url: get_town_name_curr_link,
            method: "POST",
            data:{ "c_district" : c_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {

                    if (c_town == data[index].town_name ) {
                        html += "<option value='" + data[index].town_name + "' selected>" + data[index].town_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                    }
                }
                // alert(html)
                $('#c_town').html(html);
            }

        });
    }
    }

var $modal = $('#modal');
// var $profile_image = $('#profile_image');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e){
      var files = e.target.files;
      var done = function (url) {
        image.src = url;
        $modal.modal('show');
        };
      var reader;
      var file;
      var url;
      if (files && files.length > 0) {
        file = files[0];
        if (URL) {
        done(URL.createObjectURL(file));
        } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
        done(reader.result);
        };
        reader.readAsDataURL(file);
        }
      }
  });
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });


$("#crop").click(function(){
      canvas = cropper.getCroppedCanvas({
        width: 160,
        height: 160,
        type: 'circle'
      });
      canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
      var base64data = reader.result;
          $.ajax({
          type: "POST",
          dataType: "json",
          url: upload_images,
          data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
          success: function(data){
          // console.log(data.success);
          /*$modal.modal('hide');
          alert("Crop image successfully uploaded");
          location.reload();*/
          if(data.success =='insert'){

               Toastify({
                   text: "Image successfully uploaded..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    $modal.modal('hide');
                    location.reload();
                   }, 2000);

           }else if(data.success =='update'){

            Toastify({
                   text: "Successfully uploaded..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                   $modal.modal('hide');
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
                       location.reload();
                   }, 2000);

           }
          }
        });
      }
  });
})

/*remove a profile image */
$('.slide button').on('click',function(){
  $(this).parent('.slide').remove();
      $.ajax({
            url: remove_display_image_link,
            method: "POST",
            data:{},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data==1){
                   Toastify({
                       text: "Removed Sucessfully..!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();

                   setTimeout(
                       function() {
                        // location.reload();
                        $("#profile_img").attr('src',"../uploads/dummy.png");
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
/*remove remove_slide_pay */
$('.slide_pay button').on('click',function(){
  $(this).parent('.slide_pay').remove();
      $.ajax({
            url: remove_slide_pay_doc_link,
            method: "POST",
            data:{},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data==1){
                   Toastify({
                       text: "Removed Sucessfully..!",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#4fbe87",
                   }).showToast();
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
  
/*TAG INPUT */
$('#profile_but').on('click',function(){
    $.ajax({
        url: display_image,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
              var results = JSON.parse(data['profile'].skill_secondary);
              var skill_secondary=  String(results);
              $('#skill_secondary').tagsinput('add', skill_secondary);

              var skill_results = JSON.parse(data['profile'].skill);
              var skill=  String(skill_results);
              $('#skill').tagsinput('add', skill);

               $.getScript("../assets/js/bootstrap-tagsinput.min.js");
               $('#skillModal').modal('show');
            }    
        });
    });



//fetch all data in profile textbox
function profile_info_process(id){
    $.ajax({
        url: display_image,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            console.log(data)
            // console.log(data)
            if (data['image']== null) {
                $("#profile_img").attr('src',"../ID_card_photo/dummy.png");
            }
            
          if (data['profile'] != ""){
              var dob = moment(data['profile'].dob).format('DD-MM-YYYY');
              var doj = moment(data['profile'].doj).format('DD-MM-YYYY');
              var sec_dob_emp = moment(data['profile'].sec_dob_emp).format('DD-MM-YYYY');
              let skill = data['profile'].skill;
              var middle_name=  data['profile'].m_name;
              if (middle_name === null) {
                var m_name = "";
              }else{
                var m_name = data['profile'].m_name;
              }
              // alert(skill)
             $('#pro_name').html(data['profile'].username+' '+m_name+' '+(data['profile'].l_name));
             $('#can_name').html(data['profile'].username+' '+m_name+' '+(data['profile'].l_name));
             $('#email').html(data['profile'].email);
             $('#blood_grp').html(data['profile'].blood_grp);
             $('#dob').html(dob);
             // console.log('sdh');
             // console.log(data['profile']);
             if (data['profile'].language !="") { 
               var test=JSON.parse(data['profile'].language); 
               $("#language").val(test).select2(); 
             }else{
               $("#language").val(); 
             }

             if (data['profile'].skill !="") {
                var skill_var=JSON.parse(data['profile'].skill);
                $('#skill_txt').html(String(skill_var)); // here i represents index
             }else{
                $('#skill_txt').html("");
             }
             if (data['profile'].skill_secondary !="") {
                var skill_secondary_val=JSON.parse(data['profile'].skill_secondary);
                $('#skill_secondary_tx').html(String(skill_secondary_val)); // here i represents index
             }else{
                $('#skill_secondary_tx').html("");
             }
             if (data['profile'].language !="") {
                var language_text=JSON.parse(data['profile'].language);
                $('#language_text').html(String(language_text)); // here i represents index
             }else{
                $('#language_text').html("");
             }
             $('#aadhar_number').val(data['profile'].aadhar_number);
             $('#pan_number').val(data['profile'].pan_number);
             $('#aadhar_number_txt').html(data['profile'].aadhar_number);
             $('#pan_number_txt').html(data['profile'].pan_number);
             $('#sec_bb_day').html(sec_dob_emp);
             $('#contact_no').html(data['profile'].contact_no);
             $('#worklocation').html(data['profile'].worklocation);
             $('#designation').html(data['profile'].designation);
             $('#gender').html(data['profile'].gender);
             $('#dob_tx').html(dob);
             $('#payroll_status').html(data['profile'].payroll_status);
             $('#doj').html(doj);
             $('#habits_status').val(data['profile'].habits_status);
             $('#habits_status_txt').html(data['profile'].habits_status);

                var a = moment(data['profile'].doj);
                var b = moment();
                var years = a.diff(b, 'year');
                b.add(years, 'years');
                var months = a.diff(b, 'months');
                b.add(months, 'months');
                var days = a.diff(b, 'days');
                var diff_date = (years + ' Years ' + months + ' Months ' + days + ' Days');

             $('#diff_date_tx').html(diff_date);

             $('#worklocation_tx').html(data['profile'].worklocation);
             $('#department').html(data['profile'].department);
             $('#designation').html(data['profile'].designation);
             $('#grade').html(data['profile'].grade);
             $('#sup_name').html(data['profile'].sup_name);
             $('#reviewer_name').html(data['profile'].reviewer_name);
             $('#designation_tx').html(data['profile'].designation);
             $('#ctc_txt').html(data['profile'].ctc_per_annual);
             $('#age_can_txt').html(data['profile'].age_can);
             $('#marital_status_tx').html(data['profile'].marital_status);
             $('#birth_place_txt').html(data['profile'].place_birth_can);
             $('#religion_can_txt').html(data['profile'].religion_can);
             $('#height_can_txt').html(data['profile'].height_can);
             $('#weight_can_txt').html(data['profile'].weight_can);
             $('#identification_can_txt').html(data['profile'].identification_can);
             $('#HR_on_boarder').html(data['profile'].HR_on_boarder);
             $('#HR_Recruiter').html(data['profile'].HR_Recruiter);
             /*popup values*/
             $('#height_can').val(data['profile'].height_can);
             $('#weight_can').val(data['profile'].weight_can);
             $('#identification_can').val(data['profile'].identification_can);
             $('#place_birth_can').val(data['profile'].place_birth_can);
             $('#religion_can').val(data['profile'].religion_can);
             $('#age_can').val(data['profile'].age_can);
             $('#sec_dob_emp').val(data['profile'].sec_dob_emp);
             $('#username').val(data['profile'].username);
             $('#middle_name').val(data['profile'].m_name);
             $('#last_name').val(data['profile'].l_name);
             $('#blood_gr').val(data['profile'].blood_grp);
             $('#gender_emp').val(data['profile'].gender);
             $('#dob_emp').val(data['profile'].dob);
             $('#marital_status').val(data['profile'].marital_status);
          }
          if(data['image'].path != ""){
            $("#profile_img").attr('src',"../uploads/"+data['image'].path);
            $("#del").show();
          }else {
                $("#profile_img").attr('src',"../ID_card_photo/dummy.png");
            }

            // 

        }
    });
}

/*upload file in popup documents*/
$(()=>{
$('#add_documents_unit').submit(function(e) {

        $("#doc_Submit").attr('disabled','disabled');
        $("#doc_Submit").text('Processing...');

   e.preventDefault();
      var formData = new FormData(document.getElementById("add_documents_unit"));
   $.ajax({
       url:add_documents_unit_process_link,
       method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",

       success:function(data) {
         if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                 $('#doc_Submit').attr('disabled',false);
                $("#doc_Submit").text('Save');
           }
           // console.log(data);
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
    })
})

/*document information*/
$("#v-pills-Documents-tab").on('click', function() {
    documents_info();
});

function documents_info(){
    $.ajax({
        url: documents_info_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data[0].passport_photo)
                if (data !="") {

                    // $("#document_button").hide();

                    if (data[0].passport_photo !="") {
                        $("#passport_photo_data").attr("href", "../Documents/"+data[0].passport_photo);
                        // $("#passport_photo").attr("src", "../Documents/"+data[0].passport_photo);
                        $('#passport_photo_data').removeClass('disabled');
                    }else{
                        $('#passport_photo_data').addClass('disabled');
                        $('#passport_photo_data').text('No Data');
                    }if (data[0].Resume !="") {
                        $("#Resume_data").attr("href", "../Documents/"+data[0].Resume);
                        $('#Resume_data').removeClass('disabled');
                    }else{
                        $('#Resume_data').addClass('disabled');
                        $('#Resume_data').text('No Data');
                    }if (data[0].Payslips !="") {
                        $("#preview_data").attr("href", "../Documents/"+data[0].Payslips);
                        // $('#payslip_remove').show();
                        $('#preview_data').removeClass('disabled');
                    }else{
                        // alert("As")
                        $('#preview_data').addClass('disabled');
                        $('#preview_data').text('No Data');
                    }if (data[0].Relieving_letter !="") {
                        $("#Relieving_letter_data").attr("href", "../Documents/"+data[0].Relieving_letter);
                        $('#Relieving_letter_data').removeClass('disabled');
                    }else{
                        $('#Relieving_letter_data').addClass('disabled');
                        $('#Relieving_letter_data').text('No Data');
                    }if (data[0].Vaccination !="") {
                        $("#Vaccination_data").attr("href", "../Documents/"+data[0].Vaccination);
                        $('#Vaccination_data').removeClass('disabled');
                    }else{
                        $('#Vaccination_data').addClass('disabled');
                        $('#Vaccination_data').text('No Data');
                    }if (data[0].bank_passbook !="") {
                        $("#bank_passbook_data").attr("href", "../Documents/"+data[0].bank_passbook);
                        $('#bank_passbook_data').removeClass('disabled');
                    }else{
                        $('#bank_passbook_data').addClass('disabled');
                        $('#bank_passbook_data').text('No Data');
                    }if (data[0].blood_grp_proof !="") {
                        $("#blood_grp_proof_data").attr("href", "../Documents/"+data[0].blood_grp_proof);
                        $('#blood_grp_proof_data').removeClass('disabled');
                    }else{
                        $('#blood_grp_proof_data').addClass('disabled');
                        $('#blood_grp_proof_data').text('No Data');
                    }if (data[0].dob_proof !="") {
                        $("#dob_proof_data").attr("href", "../Documents/"+data[0].dob_proof);
                        $('#dob_proof_data').removeClass('disabled');
                    }else{
                        $('#dob_proof_data').addClass('disabled');
                        $('#dob_proof_data').text('No Data');
                    }if (data[0].pan !="") {
                        $("#pan_data").attr("href", "../Documents/"+data[0].pan);
                        $('#pan_data').removeClass('disabled');
                    }else{
                        $('#pan_data').addClass('disabled');
                        $('#pan_data').text('No Data');
                    }if (data[0].aadhaar_card_proof !="") {
                        $("#aadhaar_card_data").attr("href", "../Documents/"+data[0].aadhaar_card_proof);
                        $('#aadhaar_card_data').removeClass('disabled');
                    }else{
                        $('#aadhaar_card_data').addClass('disabled');
                        $('#aadhaar_card_data').text('No Data');
                    }if (data[0].signature !="") {
                        $("#signature_data").attr("href", "../Documents/"+data[0].signature);
                        $('#signature_data').removeClass('disabled');
                    }else{
                        $('#signature_data').addClass('disabled');
                        $('#signature_data').text('No Data');
                    }
                // $('#testing').append(html);
            }else{
                 $('#passport_photo_data').addClass('disabled');
                        $('#passport_photo_data').text('No Data');
                 $('#Resume_data').addClass('disabled');
                        $('#Resume_data').text('No Data');
                 $('#preview_data').addClass('disabled');
                        $('#preview_data').text('No Data');
                 $('#Relieving_letter_data').addClass('disabled');
                        $('#Relieving_letter_data').text('No Data');
                 $('#Vaccination_data').addClass('disabled');
                        $('#Vaccination_data').text('No Data');
                 $('#bank_passbook_data').addClass('disabled');
                        $('#bank_passbook_data').text('No Data');
                 $('#blood_grp_proof_data').addClass('disabled');
                        $('#blood_grp_proof_data').text('No Data');
                 $('#dob_proof_data').addClass('disabled');
                        $('#dob_proof_data').text('No Data');
                 $('#pan_data').addClass('disabled');
                        $('#pan_data').text('No Data');
                 $('#aadhaar_card_data').addClass('disabled');
                        $('#aadhaar_card_data').text('No Data');
                 $('#signature_data').addClass('disabled');
                        $('#signature_data').text('No Data');
            }
        }
    });
}
/*account information*/
$("#v-pills-Account-information-tab").on('click', function() {
    account_information();
});

function account_information(){
    $.ajax({
        url: account_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                    $('#acc_mobile').val(data['0'].acc_mobile);
                    $('#acc_name').val(data['0'].acc_name);
                    $('#acc_number').val(data['0'].acc_number);
                    $('#bank_name').val(data['0'].bank_name);
                    $('#branch_name').val(data['0'].branch_name);
                    $('#ifsc_code').val(data['0'].ifsc_code);
                    $('#con_acc_number').val(data['0'].con_acc_number);
                    $('#uan_num').val(data['0'].uan_num);
                    $('#upi_id').val(data['0'].upi_id);
                }
            }
        });
    }

$('#add_account_info').submit(function(e) {
    // alert("asdasd")

    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({
        url:account_info_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
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

/*education information*/
$("#v-pills-Education-tab").on('click', function() {
    education_information();
    get_qualification_list();
});

/*qualification*/
 function get_qualification_list() {
    $.ajax({
        url: get_qualification_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].Qualification + "'>" + data[index].Qualification + "</option>";
            }
            $('#qualification').html(html);
        }
    });
}
$("#qualification").on('change', function() {
    var qualificationVal = $('#qualification').val();

    if (qualificationVal =="SSLC"||qualificationVal =="HSC") {
        $('#course_hide').hide();
    }else{
        $('#course_hide').show();
    }
        $.ajax({
        url: get_course_link,
        method: "POST",
        data:{qualificationVal:qualificationVal},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].Course + "'>" + data[index].Course + "</option>";
            }
            $('#Course').html(html);  
        }

    });
});

function education_information(){
    $.ajax({
        url: education_information_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            if (data !="") {
                $('#education_td').empty();
                        html ='';
                    $.each(data, function (key, val) {
                        html +='<tr>';
                        html +='<td data-label="allcount">'+val.degree+'</td>';
                        html +='<td data-label="allcount">'+val.Course+'</td>';
                        html +='<td data-label="allcount">'+val.university+'</td>';
                        html +='<td data-label="allcount">'+val.edu_start_month+"-"+val.edu_start_year+'</td>';
                        html +='<td data-label="allcount">'+val.edu_end_month+"-"+val.edu_end_year+'</td>';
                        html +='<td data-label="allcount">'+val.percentage+'%</td>';
                        var ext = val.edu_certificate.split('.')[1];
                        if (ext=="pdf") {
                            html +='<td data-label="allcount"><a href="../education/'+ val.edu_certificate +'" target =_blank><img src="../assets/images/PDF-icon.png" height="50" width="50" alt=""></a></td>';
                        }else{

                            html +='<td data-label="allcount"><a href="../education/'+ val.edu_certificate +'" target =_blank><img src="../assets/images/doc-icon.jpg" height="50" width="50" alt=""></a></td>';
                        }
                    });
                    $('#education_td').html(html);
                }
            }
        });
    }

$('#add_education_unit').submit(function(e) {
    e.preventDefault();
        $('#edu_submit').attr('disabled',true);
        $("#edu_submit").text('Processing...');
      var formData = new FormData(this);
    $.ajax({
        url:education_information_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
            if(data.error){
                // alert("assa")
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                $('#edu_submit').attr('disabled',false);
                $("#edu_submit").text('Save');
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

/*Experience information*/
$("#v-pills-Experience-tab").on('click', function() {
    experience_info();
});

$("#currently_working").click(function () {
    if ($(this).is(":checked")) {
        $("#exp_end_on").addClass('disabled');
    } else {
        $("#exp_end_on").removeClass('disabled');
    }
});

$('#add_experience_unit').submit(function(e) { 

     $("#exp_submit").attr('disabled',true);
     $("#exp_submit").text('Processing...');

    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({
        url:experience_information_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
            if(data.error){
                // alert("assa")
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                $('#exp_submit').attr('disabled' , false);
                $('#exp_submit').html('Save'); 
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

function experience_info(){
    $.ajax({
        url: experience_info_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            $('#Experience_tbl').empty();
            if (data !="") {
                     html ="";
                     html_total ="";
                        html +="<div class='card-body'>";
                        html +="<div class='row people-grid-row'>";
                  for (let index = 0; index < data.length; index++) {
                    /*count*/
                        var a = moment(data[index].exp_start_month);
                        var b = moment(data[index].exp_end_month);
                        var years = a.diff(b, 'year');
                        b.add(years, 'years');
                        var months = a.diff(b, 'months');
                        b.add(months, 'months');
                        var days = a.diff(b, 'days');
                        var diff_date = (years + ' Years ' + months + ' Months ' + days + ' Days');

                        html +="<div class='col-md-3 col-lg-3 col-xl-4'>";
                        html +="<div class='card widget-profile'>";
                        html +="<div class='card-body rounded' style='box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);'>";
                        html +="<div class='pro-widget-content text-center'>";
                        html +="<div class='profile-info-widget'>";
                        html +="<a class='fa fa-suitcase' style='font-size:25px;color:black'></a>";
                        html +="<div class='profile-det-info'>";
                        html +='Job Title : <a href="../experience/'+  data[index].certificate +'" class="text-info" target =_blank > ' + data[index].job_title + '</a><br>';
                        html +="<p>Company Name :" + data[index].company_name + "</p>";
                        html +="<p>Begin On : " + data[index].exp_start_month + "</p>";
                        html +="<p>End On : " +data[index].exp_end_month + "</p>";
                        html +="<p>Exp : " +diff_date+ "</p>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                    // alert(html_total)
                    }
                        html +="</div>";
                        html +="</div>";
                    $('#Experience_tbl').append(html);
                }
            }
    });
}



/*famil information */
$("#v-pills-Family-tab").on('click', function() {
    family_information();
});


function family_information(){
    $.ajax({
        url: family_information_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            $('#education_td').empty();
            if (data !="") {
                    html ='';
                $.each(data, function (key, val) {
                    html +='<tr>';
                    html +='<td data-label="allcount">'+val.fm_name+'</td>';
                    html +='<td data-label="allcount">'+val.fm_gender+'</td>';
                    html +='<td data-label="allcount">'+val.fn_relationship+'</td>';
                    html +='<td data-label="allcount">'+val.fn_marital+'</td>';
                    html +='<td data-label="allcount">'+val.fn_blood_gr+'</td>';

                });
                $('#family_td').html(html);
                }
            }
        });
    }

$('#add_family_unit').submit(function(e) {
    e.preventDefault();
      var formData = new FormData(this);
        $('#fam_submit').attr('disabled',true);
        $("#fam_submit").text('Processing...');
    $.ajax({
        url:add_family_info_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
                $('#fam_submit').attr('disabled',false);
                $("#fam_submit").text('save');
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

           }else{
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

$("#v-pills-followup-tab").on('click', function() {
    followup_information();
});

function followup_information(){
    $.ajax({
        url: followup_information_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            if (data !="") {
                html ='';
                var verify_num=1;
                var verify_class="";
                for (let index = 0; index < data.length; index++) {
                var followup = moment(data[index].created_on).format('MM-DD-YYYY'); 
                
                     if(verify_num==1){
                        verify_num=2;
                        verify_class="direction-r";
                     }else{
                        verify_num=1;
                        verify_class="direction-l";
                     }
                    html +='<ul class="timeline">';
                    html +=    '<li>';
                    html +=     '<div class="'+verify_class+'">';
                    html +=        '<div class="flag-wrapper">';
                    html +=           '<h6 class="flag wbg">'+followup+'</h6>';
                    html +=           '<br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Department - </h6>'+data[index].Department+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Designation - </h6>'+data[index].Designation+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Reporting Manager - </h6>'+data[index].sup_name+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Reviewer Name - </h6>'+data[index].reviewer_name+'</h6><br>';
                    html +=        '</div>';
                    html +=     '</div>';
                    html +=  '</li>';
                    html += '</ul>';
                };
                $('#timeline_data').html(html);
                }
            }
        });
    }