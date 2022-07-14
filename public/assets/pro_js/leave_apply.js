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
            console.log(data)
            if(data.length !=0){

                // $('#lop_granted').html(data[0].lop_granted);
                // $('#balance').html(data[0].lop_balance);

                $('#policy_category').on('change', function() {
                    var value = $(this).val();
                    // alert(value);
                    if(value == "loss_of_pay")
                    { $('#balance').html(data[0].lop_balance); }
                    else if(value == "on_duty")
                    { $('#balance').html(data[0].on_duty_balance); }
                    else if(value == "probationary_leave")
                    { $('#balance').html(data[0].prob_balance); }
                    else if(value == "work_from_home")
                    { $('#balance').html(data[0].wfh_balance); }
                    else if(value == "privilege_leave")
                    { $('#balance').html(data[0].privilege_balance); }
                    else if(value == "sick_leave")
                    { $('#balance').html(data[0].sick_balance); }
                    else if(value == "casual_leave")
                    { $('#balance').html(data[0].casual_balance); }

                  });

            }
        }
    });
}
