$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $(document).ready(function(){
        // alert("Hao");
        view_epf_form();
    });
    
    // Data show
    function view_epf_form(){
    
    $.ajax({
        url: get_epf_form_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            console.log(data);
            //alert(data[0]['member_name']);
            $('#emp_name').val(data[0]['member_name']);
            $('#fsname').html("Spouse Name");
            if(data[0]['father_name'] != 'no_val'){
                $('#fsname').html("Father name");
                $('#f_name').val(data[0]['father_name']);
            }
            else{
                $('#fsname').html("Spouse Name");
                $('#f_name').val(data[0]['spouse_name']);
            }
            $('#dob').val(data[0]['dob']);
            $('#gender').val(data[0]['gender']);
            $('#m_status').val(data[0]['marry_status']);
            $('#email_id').val(data[0]['email_id']);
            $('#mob_no').val(data[0]['mob']);
            $('#epf').val(data[0]['epfs_status']);
            $('#eps').val(data[0]['eps_status']);
            if(data[0]['uan_number'] == "no_val"){
                $('#uan').val("");
            }
            else{
            $('#uan').val(data[0]['uan_number']);
            }

 if(data[0]['prev_pf_no'] == "no_val"){
    $('#ppf').val("");
            }
            else
            {
                $('#ppf').val(data[0]['prev_pf_no']);
            }
            if(data[0]['date_prev_exit'] == "no_val"){
                data[0]['date_prev_exit'] = "";
            }
            if(data[0]['scheme_cert_no'] == "no_val"){
                data[0]['scheme_cert_no'] = "";
            }
            if(data[0]['ppo'] == "no_val"){
                data[0]['ppo'] = "";
            }
           
            $('#pr_exit_date').val(data[0]['date_prev_exit']);
            $('#scn').val(data[0]['scheme_cert_no']);
            $('#ppo').val(data[0]['ppo']);

            $('#inter_worker').val(data[0]['int_work_status']);
            if(data[0]['coun_origin'] == "no_val"){
                data[0]['coun_origin'] = "";
            }
            if(data[0]['passport_no'] == "no_val"){
                data[0]['passport_no'] = "";
            }
            if(data[0]['val_passport_from'] == "no_val"){
                data[0]['val_passport_from'] = "";
            }
            if(data[0]['val_passport_to'] == "no_val"){
                data[0]['val_passport_to'] = "";
            }

            $('#sco').val(data[0]['coun_origin']);
            $('#passport_no').val(data[0]['passport_no']);
            $('#from_date').val(data[0]['val_passport_from']);
            $('#to_date').val(data[0]['val_passport_to']);

            $('#bank_account').val(data[0]['bank_account']);
            $('#aadhar').val(data[0]['aadhar_no']);
            if(data[0]['pan_no'] == "no_val"){
                data[0]['pan_no'] = "";
            }
            $('#pan').val(data[0]['pan_no']);
        }
    });
}