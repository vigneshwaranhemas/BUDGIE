$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_leave_masters();
});

function get_leave_masters(){

    $.ajax({
        url: get_leave_masters_details_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if(data.length !=0){

                if(data[0].lop_type == "1")
                {   $('#loss_of_pay').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#loss_of_pay').css('display', 'none'); }

                if(data[0].on_duty_type == "1")
                {   $('#on_duty').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#on_duty').css('display', 'none'); }

                if(data[0].prob_type == "1")
                {   $('#probationary_leave').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#probationary_leave').css('display', 'none'); }

                if(data[0].wfh_type == "1")
                {   $('#work_from_home').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#work_from_home').css('display', 'none'); }

                if(data[0].privilege_type == "1")
                {   $('#privilege_leave').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#privilege_leave').css('display', 'none'); }

                if(data[0].sick_type == "1")
                {   $('#sick_leave').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#sick_leave').css('display', 'none'); }

                if(data[0].casual_type == "1")
                {   $('#casual_leave').css('display', 'block'); }
                else if(data[0].lop_type == "0")
                { $('#casual_leave').css('display', 'none'); }

                $('#lop_granted').html(data[0].lop_granted);
                $('#lop_balance').html(data[0].lop_balance);

                $('#on_duty_granted').html(data[0].on_duty_granted);
                $('#on_duty_balance').html(data[0].on_duty_balance);

                $('#prob_granted').html(data[0].prob_granted);
                $('#prob_balance').html(data[0].prob_balance);

                $('#wfh_granted').html(data[0].wfh_granted);
                $('#wfh_balance').html(data[0].wfh_balance);

                $('#privilege_granted').html(data[0].privilege_granted);
                $('#privilege_balance').html(data[0].privilege_balance);

                $('#sick_granted').html(data[0].sick_granted);
                $('#sick_balance').html(data[0].sick_balance);

                $('#casual_granted').html(data[0].casual_granted);
                $('#casual_balance').html(data[0].casual_balance);

            }
        }
    });
}
