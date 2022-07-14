
$(document).ready(function(){
    hr_to_profile();
    profile_banner_image();
    get_allemployees_list();
});
$("#v-pills-Working-Information-tab").on('click', function() {
    get_Department();
    get_Designation();
    get_worklocation();
    get_grade();
});

/*listing*/
    function get_allemployees_list() {
    $.ajax({
        url:get_emp_list_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
             // console.log(data[0].username+' '+data[0].m_name+' '+data[0].l_name)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username+' '+data[index].m_name+' '+data[index].l_name + "</option>";
            }
            $('#reporting_manager').html(html);
            $('#reviewer').html(html);
        }
    });
}
function get_Department() {
    $.ajax({
        url:get_Department_list_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
             // console.log(data[0].department)
            var html = '<option value="">Select Department</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].department+ "'>" + data[index].department+ "</option>";
            }
            $('#Department').html(html);
        }
    });
}
function get_Designation() {
    $.ajax({
        url:get_Designation_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
             // console.log(data[4].designation)
            var html = '<option value="">Select Designation</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].designation+ "'>" + data[index].designation+ "</option>";
            }
            $('#Designation').html(html);
        }
    });
}
function get_worklocation() {
    $.ajax({
        url:get_work_location_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
             console.log(data[2].worklocation)
            var html = '<option value="">Select Work Location</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].worklocation+ "'>" + data[index].worklocation+ "</option>";
            }
            $('#work_location').html(html);
        }
    });
}
function get_grade() {
    $.ajax({
        url:get_grade_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
             console.log(data[4].grade_name)
            var html = '<option value="">Select Grade</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].grade_name+ "'>" + data[index].grade_name+ "</option>";
            }
            $('#grade_val').html(html);
        }
    });
}
function profile_banner_image(){
     var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url: hr_profile_banner_image,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (Object.keys(data).length === 0) {
                $("#can_banner_img").attr('src',"../assets/images/other-images/profile-style-img3.png");
            }
            else{
                $("#can_banner_img").attr('src',"../banner/"+data.banner_image);
            }
        }
    });
}
function hr_to_profile(id){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    // alert(id)
    $.ajax({
        url:hr_id_card_varification_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
             // alert(data['profile']);
             
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
              $('#can_name').html(data['profile'].username + data['profile'].m_name +" " + data['profile'].l_name);
                    $('#can_name_1').html(data['profile'].username + data['profile'].m_name +" "+ data['profile'].l_name);
                    $('#can_designation_1').html(data['profile'].designation);
                    $('#can_email').html(data['profile'].email);
                    $('#can_dob').html(dob);
                    $('#can_dob_1').html(dob);
                    $('#can_cont').html(data['profile'].contact_no);
                    $('#can_blood_grp').html(data['profile'].blood_grp);
                    $('#gender').html(data['profile'].gender);
             $('#pro_name').html(data['profile'].username+' '+m_name+' '+(data['profile'].l_name));
             $('#can_name').html(data['profile'].username+' '+m_name+' '+(data['profile'].l_name));
             $('#email').html(data['profile'].email);
             $('#blood_grp').html(data['profile'].blood_grp);
             $('#dob').html(dob);
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
             $('#sec_bb_day').html(sec_dob_emp);
            $('#contact_no_1').html(data['profile'].contact_no);
            $('#emp_num_2').html(data['profile'].emp_num_2);
            $('#can_marital_status').html(data['profile'].marital_status);
            /*working info*/
            $('#doj').html(doj);
            $('#working_loc').html(data['profile'].worklocation);
            $('#can_department').html(data['profile'].department);
            $('#can_designation').html(data['profile'].designation);
            $('#grade').html(data['profile'].grade);
            $('#can_worklocation').html(data['profile'].worklocation);
            $('#can_payroll_status').html(data['profile'].payroll_status);
            

            /*hr info*/
            $('#sup_name').html(data['profile'].sup_name);
            $('#reviewer_name').html(data['profile'].reviewer_name);


            
          }
            if(data['image'].path != ""){
            $("#pro_img").attr('src',"../uploads/"+data['image'].path);
              }else {
                    $("#pro_img").attr('src',"../ID_card_photo/dummy.png");
                }
        }
    });
}
/*TAG INPUT */
$('#profile_but').on('click',function(){
    // alert("jhgsajd")
        var params = new window.URLSearchParams(window.location.search);
        var id=params.get('id')
        var empID=params.get('empID')
        // formData.append('emp_id', empID);
    $.ajax({
        url: tag_iput_val_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
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



/*skill*/
$('#add_profile_info').submit(function(e) {

        $('#doc_Submit').attr('disabled','disabled');
        $("#doc_Submit").text('Processing...');

   e.preventDefault();
        var formData = new FormData(document.getElementById("add_profile_info"));
        var params = new window.URLSearchParams(window.location.search);
        var id=params.get('id')
        var empID=params.get('empID')
        formData.append('emp_id', empID);

   $.ajax({
       url:add_skill_set_hr_sd_link,
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
$("#hr_info_text").on('click', function() {
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')

    $.ajax({
        url:hr_id_card_varification_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
             var sup_name_val= data['profile'].sup_emp_code;
             var reviewer_name_val= data['profile'].reviewer_emp_code;
            $('#reporting_manager').val(sup_name_val).select2();
            $('#reviewer').val(reviewer_name_val).select2();
        }
    });
});

/*HR Information*/
$('#Information_unit').submit(function(e) { 

     $("#exp_submit").attr('disabled',true);
     $("#exp_submit").text('Processing...');
        e.preventDefault();
    var formData = new FormData(this);
    var params = new window.URLSearchParams(window.location.search);
    var id = params.get('id')
    var empID = params.get('empID')
    var Reporting_val = $("#reporting_manager option:selected").text();
    var reviewer_val = $("#reviewer option:selected").text();
    formData.append('emp_id', empID);
    formData.append('Reporting_val', Reporting_val);
    formData.append('reviewer_val', reviewer_val);
    var reporting_manager = $("#reporting_manager").val();
    var reviewer = $("#reviewer").val();

if (reporting_manager !="" || reviewer !="") {

    $.ajax({
        url:hr_information_save_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
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
                $('#exp_submit').attr('disabled' , false);
                $('#exp_submit').html('Save'); 
           }
            if(data.response =='Update'){
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
            $('#exp_submit').attr('disabled' , false);
                $('#exp_submit').html('Save'); 

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
    }else{
        Toastify({
                       text: "Select any of one...",
                       duration: 3000,
                       close:true,
                       backgroundColor: "#f3616d",
                   }).showToast();

                   setTimeout(
                       function() {
                       }, 2000);

    }
});
/*Working information*/
$("#working_info_pop").on('click', function() {
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url:hr_id_card_varification_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
             /*value in popup*/
            var department =data['profile'].department;
            $('#Department').val(department).select2();
            var designation =data['profile'].designation;
            $('#Designation').val(designation).select2();
            var work_location =data['profile'].worklocation;
            $('#work_location').val(work_location).select2();
            $('#doj_pop').val(data['profile'].doj);
            $('#intake').val(data['profile'].payroll_status);
            $('#CTC').val(data['profile'].ctc_per_annual);
            $('#grade_val').val(data['profile'].grade);
            $('#rfh').val(data['profile'].RFH);
        }
    });
});
$('#add_working_information').submit(function(e) { 

     $("#work_info_submit").attr('disabled',true);
     $("#work_info_submit").text('Processing...');
        e.preventDefault();

    var formData = new FormData(this);
    var params = new window.URLSearchParams(window.location.search);
    var id = params.get('id')
    var empID = params.get('empID')
    
    formData.append('emp_id', empID);
    
    $.ajax({
        url:hr_working_information_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
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
                $('#exp_submit').attr('disabled' , false);
                $('#exp_submit').html('Save'); 
           }
            if(data.response =='Update'){
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
            $('#exp_submit').attr('disabled' , false);
                $('#exp_submit').html('Save'); 

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
/*contact info in pop-up*/
$("#v-pills-messages-tab").on('click', function() {
    Contact_info_hr();
});
function Contact_info_hr(id){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url: Contact_info_hr_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
                if (data !="") {
                    $('#p_addres_view').html(data[0].p_addres+','+data[0].p_district+','+data[0].p_town+','+data[0].p_State+'-'+data[0].p_pin+'.');
                    $('#c_addres_view').html(data[0].c_addres+','+data[0].c_district+','+data[0].c_town+','+data[0].c_State+'-'+data[0].c_pin+'.');
                    $('#p_email').html(data[0].p_email);
                }
            }
        });
    }
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

function Contact_information_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url: Contact_info_hr_get_link,
        method: "POST",
        data:{"id":id,"empID":empID},
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
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    formData.append('emp_id', empID);

    $.ajax({
        url:hr_update_contact_info_link,
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
/*account information*/
$("#v-pills-Account-information-tab").on('click', function() {
    account_info_hr();
});

function account_info_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var empID=params.get('empID')
    $.ajax({
        url: account_info_hr_link,
        method: "POST",
        data:{"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                    /*account information*/
                    $('#acc_name').html(data[0].acc_name);
                    $('#bank_name').html(data[0].bank_name);
                    $('#branch_name').html(data[0].branch_name);
                    $('#acc_number').html(data[0].acc_number);
                    $('#ifsc_code').html(data[0].ifsc_code);
                    $('#upi_id').html(data[0].upi_id);
                    $('#uan_num').html(data[0].uan_num);
                }
            }
        });
    }

/*education information*/
$("#v-pills-Education-tab").on('click', function() {
    education_information_hr();
});

function education_information_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var empID=params.get('empID')
    $.ajax({
        url: education_information_get_link,
        method: "POST",
        data:{"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                $('#education_td_hr').empty();
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
                    $('#education_td_hr').html(html);
                }
            }
        });
    }


/*Experience information*/
$("#v-pills-Experience-tab").on('click', function() {
    experience_info_hr();
});
function experience_info_hr(id,empID){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    // alert(empID)

    $.ajax({
        url: experience_info_hr_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
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
                        html +="<p>Experience : " +diff_date+ "</p>";
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
/*document information*/
$("#v-pills-Documents-tab").on('click', function() {
    documents_info();
});

function documents_info(){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url: documents_info_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
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

/*famil information */
$("#v-pills-Family-tab").on('click', function() {
    family_information();
});

function family_information(id,empID){
     var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var emp_id=params.get('empID')
    
    $.ajax({
        url: family_information_get_link,
        method: "POST",
        data:{"id":id,"emp_id":emp_id},
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
