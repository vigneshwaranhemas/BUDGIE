"use strict";

function getBirthdayFilter(){
    // implementation omitted
    return $("#birthdays_filter_user").val();
};

var basic_calendar = {
    init: function() {
        // var birthday_filter = getBirthdayFilter();

        $('#cal-basic').fullCalendar({
            // defaultDate: '2016-06-12',
            defaultDate: new Date(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,list'
            },
            // editable: true,
            disableDragging: true,
            editable: false,
            eventStartEditable: false,
            selectable: true,
            selectHelper: true,
            droppable: true,
            eventLimit: true,         
            events: function(start, end, callback, successCallback) {

                var birthday_filter = getBirthdayFilter();
                $.ajax({
                    url: 'fetch_birthdays_list',
                    // dataType: 'xml',
                    data: {                        
                        employee: birthday_filter
                    },
                    success: function(response) {
                        var events = [];
                        // $(doc).find('event').each(function() {
                            // events.push({
                            //     title: $(this).attr('title'),
                            //     start: $(this).attr('start') // will be parsed
                            // });
                        // });
                        // callback(response);

                        var filter = $("#birthdays_filter_user").val();

                        if(filter != ''){
                            // console.log(response[0].start);
                            loadDefaultDateFunction(response[0].start);
                        }

                        // var events = [];  

                        $.each(response, function (i, data)  
                        {  
                        // console.log(data.title);
                            events.push(  
                            {  
                                title: data.title,  
                                start: data.start,
                                empID: data.empID,
                                view: data.view,
                                // end: data.end, 
                            });          
                        
                            // $('#cal-basic').fullCalendar('defaultDate', data.start);    

                        });  

                        // events.push(response);   
                        // console.log(events)  
                        successCallback(events);
                    }
                });
            },       
            eventClick: function(arg) { //edit option   
                getEventDetail(arg.empID); 
            }, 
            // viewRender: function(view, element) {
            //     addFilter(view.title);
            // }
        });
    }
};

// $('#cal-basic').fullCalendar('render'); // this is needed if the calendar is not immediately visible on DOM ready

function loadDefaultDateFunction(startDate){
    $('#cal-basic').fullCalendar('gotoDate', startDate);
    
    $('#birthdays_filter_user').select2({
        placeholder: 'Select Employee...',
        allowClear: true,
    });

}

var getEventDetail = function (empID) {

    $('#birthdayDetailModalList').modal('show');
    
    //Get empID list
    $.ajax({
        url:"fetch_birthdays_list_empID",
        type:"GET",
        data : {empID: empID},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            // console.log(response[0].username); 
            $("#employee_name_show").text('');
            $("#employee_id_show").text('');
            $("#email_show").text('');
            $("#employee_designation_show").text('');
            $("#employee_doj_show").text('');
            $("#employee_dob_show").text('');
            $("#employee_wl_show").text('');
            $("#employee_ps_show").text('');
            // $("#employee_grade_show").text('');
            $("#occassion_file_show").text('');
            $("#employee_dept_show").text('');

            var date= response[0].doj;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate();
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var doj = dd+"-"+mm+"-"+yy;

            var date_dob= response[0].dob;
            var dt=new Date(date_dob.split("/").reverse().join("-"));
            var dd_dob=dt.getDate();
            var mm_dob=dt.getMonth()+1;
            var yy_dob=dt.getFullYear();
            var dob_1 = moment(response[0].dob).format('DD MMM');
            var dob = dob_1;

            var name = response[0].username+' <i class="icofont icofont-birthday-cake"  style="font-size: 25px;"></i>';
            $("#employee_name_show").append(name);
            $("#employee_id_show").append(response[0].empID);
            $("#employee_designation_show").append(response[0].designation);
            $("#email_show").append(response[0].email);
            $("#employee_doj_show").append(doj);
            $("#employee_dob_show").append(dob);
            $("#employee_wl_show").append(response[0].worklocation);
            $("#employee_ps_show").append(response[0].payroll_status);
            // $("#employee_grade_show").append(response[0].grade);                
            $("#employee_dept_show").append(response[0].department);                

            $.ajax({
                url:"fetch_birthdays_list_img",
                type:"GET",
                data : {employee: empID},
                dataType : "JSON",
                success:function(response)
                {
                    $("#brd_employee_img").html(response); 
                    
                }
            });

        }               
        
    });  

       
}

$('#birthdays_filter_user').change(function () {
    // alert(this.value)
    var employee = this.value;
    // alert(employee)
     var url = "fetch_birthdays_list";
    var fil = url+'?employee=' + employee;
    // alert(fil)
    $('#cal-basic').fullCalendar('refetchEvents', fil);    

    // $('#calendar').fullCalendar({ events: "fetch_birthdays_list?resourceid=1" });

    // calendar.refetchEvents();
    // var url = "{{url('fetch_birthdays_list')}}";
    // url: 'fetch_birthdays_list',
    //     method: 'GET',
    //     data: {
    //         employee: $("#birthdays_filter_user").val(),
    //     }
    
    // $.ajax({
    //     url:"fetch_birthdays_filter_user",
    //     type:"GET",
    //     data : {value: employee},
    //     dataType : "JSON",
    //     success:function(response)   
    //     {
    // var url = "fetch_birthdays_list";
    // url = url+'?employee=' + employee;
    // alert(url)
        
   
});


//View all option
function addFilter(date) {

    $.ajax({
        url:"fetch_birthdays_list_date",
        type:"GET",
        data : {date: date},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);

            var options = [];
            var rData = [];
            rData = response;

            //    remove old data
            $('#cal-basic').fullCalendar('removeEvents');

            // var events= [
            //         {
            //             title: 'Event 1',
            //             start: '2022-04-01',
            //             school: '1'
            //         },-
            //         {
            //             title: 'Event 2',
            //             start: '2022-04-02',
            //             school: '2'
            //         },
            //         {
            //             title: 'Event 3',
            //             start: '2022-05-03',
            //             school: '1'
            //         },
            //         {
            //             title: 'Event 4',
            //             start: '2022-05-04',
            //             school: '2'
            //         }
            //     ];               
                         
            //Getting new event json data
            $("#cal-basic").fullCalendar('addEventSource', response);
            // basic_calendar.fullCalendar('addEventSource', response);
            // basic_calendar.fullCalendar('refetchEvents');

        }               
        
    });  

    // $('#holidaysDetailModal').modal('show');
       
}

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

