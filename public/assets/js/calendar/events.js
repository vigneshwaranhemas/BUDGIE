"use strict";
var basic_calendar = {
    init: function() {
        $('#cal-basic').fullCalendar({
            // defaultDate: '2016-06-12',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,listWeek'
            },
            // editable: true,
            disableDragging: true,
            editable: false,
            eventStartEditable: false,
            selectable: true,
            selectHelper: true,
            droppable: true,
            eventLimit: true,
            events: "fetch_all_event",  
            eventClick: function(arg) { //edit option     
                getEventDetail(arg.view, arg.start, arg.end); 
            },          
        });
            

    }
};

var getEventDetail = function (id, start, end) {
    // alert(start) "2022-03-30T15:30:00Z"
    // alert(id)
    $("#event_edit_id").val(id);
    
    //Get Attendees list
    $.ajax({
        url:"fetch_event_attendees_show",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);     
            $("#candicate_list_show").html(response);

        }               
        
    });  

    //Get category list
    $.ajax({
        url:"fetch_event_edit",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);                                                                                                    
            var rData = [];
            rData = response;                   
            $.each(rData, function (index, value) {
                                                                                                                                      
                $("#event_name_show").html(value.event_name);
                $("#where_show").html(value.where);
                $("#description_show").html(value.description);
                $("#category_name_show").html(value.category_name);
                $("#event_type_show").html(value.event_type);
                $("#attendees_filter_op_show").html(value.attendees_filter_op);
                $("#attendees_filter_show").html(value.attendees_filter);
                
                // var candicate_list = JSON.parse(value.candicate_list);
                // console.log(candicate_list.length);

                var start_date_time = value.start_date_time;
                var split = start_date_time.split(" ");

                const timeString = split[1];
                // Prepend any date. Use your birthday.
                const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                .toLocaleTimeString('en-US',
                    {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                );

                // console.log();
                $("#start_date_show").html(split[0]);
                $("#start_time_show").html(timeString12hr);

                var end_date_time = value.end_date_time;
                var split = end_date_time.split(" ");

                const timeString_end = split[1];
                // Prepend any date. Use your birthday.
                const timeString12hr_end = new Date('1970-01-01T' + timeString_end + 'Z')
                .toLocaleTimeString('en-US',
                    {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                );

                // console.log();
                $("#end_date_show").html(split[0]);
                $("#end_time_show").html(timeString12hr_end);

            });
                                
        }
       
        
    }); 

    $('#eventDetailModal').modal('show');

}

$('.toggle-filter').click(function () {
    $('#ticket-filters').slideToggle();
});

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

