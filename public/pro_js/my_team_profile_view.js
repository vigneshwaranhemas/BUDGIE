
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$(document).ready(function(){ 
    profile_info_process();
});      


//fetch all data in profile textbox
function profile_info_process(id){
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_profile,
        method: "POST",
        data:{emp_id:emp_id},
        dataType: "json",
        success: function(data) {
           
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
             
          }
          
        }
    });
}
/*contact info in pop-up*/
$("#v-pills-messages-tab").on('click', function() {
    Contact_info_page();
});

function Contact_info_page(){
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: Contact_info_view_myteam_link,
        method: "POST",
        data:{emp_id:emp_id},
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



/*document information*/
$("#v-pills-Documents-tab").on('click', function() {
    documents_info();
});

function documents_info(){
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: documents_info_link,
        method: "POST",
        data:{emp_id:emp_id},
        dataType: "json",
        success: function(data) {
            // console.log(data[0].passport_photo)
                if (data !="") {

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
    account_info_hr();
});

function account_info_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_account_info_link,
        method: "POST",
        data:{emp_id:emp_id},
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
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_education_information_get_link,
        method: "POST",
        data:{emp_id:emp_id},
        dataType: "json",
        success: function(data) {
            console.log(data)
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
    experience_info();
});
function experience_info(){
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_experience_info_link,
        method: "POST",
        data:{emp_id:emp_id},
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
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_family_information_get_link,
        method: "POST",
        data:{emp_id:emp_id},
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

$("#v-pills-followup-tab").on('click', function() {
    followup_information();
});

function followup_information(){
    // alert("as")
    var params = new window.URLSearchParams(window.location.search);
    var something =params.get('id')
    var som1 = atob(something)
    var emp_id = atob(som1)

    $.ajax({
        url: my_team_followup_information_link,
        method: "POST",
        data:{emp_id:emp_id},
        dataType: "json",
        success: function(data) {
            if (data !="") {
                    html ='';
                for (let index = 0; index < data.length; index++) {
           var followup = moment(data[index].created_on).format('MM-DD-YYYY'); 
            // console.log(data[index].Department)
                    html +='<ul class="timeline">';
                    html +=    '<li>';
                    html +=     '<div class="direction-r">';
                    html +=        '<div class="flag-wrapper">';
                    html +=           '<h6 class="flag wbg">'+followup+'</h6>';
                    html +=           '<br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Department</h6>'+data[index].Department+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Designation</h6>'+data[index].Designation+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Reporting Manager</h6>'+data[index].sup_name+'</h6><br>';
                    html +=           '<h6 class="time-wrapper"><h6 class="time">Reviewer Name</h6>'+data[index].reviewer_name+'</h6><br>';
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