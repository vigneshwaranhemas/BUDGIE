"use strict";

function getBirthdayFilter(){
    // implementation omitted
    return $("#holidays_state_filter").val();
};

var basic_calendar = {
    init: function() {
        $('#cal-basic').fullCalendar({
            // defaultDate: '2016-06-12',
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
            eventClick: function(arg) { //edit option   
                getEventDetail(arg.view, arg.start, arg.end); 
            }, 
            events: function(start, end, callback, successCallback) {
                var birthday_filter = getBirthdayFilter();
                $.ajax({
                    url: 'fetch_holidays_list',
                    // dataType: 'xml',
                    data: {                        
                        state: birthday_filter
                    },
                    success: function(response) {
                        var events = [];                        
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
                        });  

                        // events.push(response);   
                        // console.log(events)  
                        successCallback(events);
                    }
                });
            },       
            // events: "fetch_holidays_list",
            viewRender: function(view, element) {
                // console.log(view['title'])
                // console.log(view.title)
                addFilter(view.title);

            }
        });
    }
};


$('#holidays_state_filter').change(function () {
    // alert(this.value)
    var state = this.value;
    // alert(state)
    var url = "fetch_holidays_list";
    var fil = url+'?state=' + state;
    // alert(fil)
    $('#cal-basic').fullCalendar('refetchEvents', fil);    

});

//View all option
function addFilter(date) {

    $.ajax({
        url:"fetch_holidays_list_date",
        type:"GET",
        data : {date: date},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#calendarList").html("");

            var options = [];
            var rData = [];
            rData = response;
            var html = '';

            $.each(rData, function (index, value) {   

                html += '<div class="lnb-calendars-item">';
                html += '<label style="background-color: transparent;">';
                html += '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + value.id + '" checked="" data-original-title="" title="">';
                html += '<span class="kk" style="border-color: rgb(158, 95, 255); background-color: rgb(158, 95, 255);"></span>';
                html += '<span>' + value.occassion + '</span>';
                html += '</label>';
                html += '</div>';        
                options.push(html);                      
            });
                                 
            $("#calendarList").append(html);

        }               
        
    });  

    // $('#holidaysDetailModal').modal('show');
       
}

var getEventDetail = function (id, start, end) {
    // alert(start) //"2022-03-30T15:30:00Z"
    // alert(id)
    $("#holidays_show_id").val(id);
    
    //Get Holidays list
    $.ajax({
        url:"fetch_holidays_list_id",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            $("#occassion_show_list").text('');
            $("#description_show_list").text('');
            $("#occassion_file_show_list").text('');
            // $("#state_show_list").text('');
            $("#occassion_show_list").append(response[0].occassion);
            $("#description_show_list").append(response[0].description);                
            // $("#state_show_list").append(response[0].state);                

            var file = response[0].occassion_file;
            var ext = file.split('.')[1];    
            // alert(ext);
            if(ext=="jpg" || ext=="PNG" || ext=="png" || ext=="jpeg" || ext=="gif") {
                // alert("one");
                // var link = object[i].Value;

                var image = '<img onclick=sample_popup_viewer("'+file+'") class="img-sm image-layer-item image-size"   src="../holidays_file/'+file+'" style="cursor:pointer;width: 400px;height: 200px;">';
                // row.append($('<td>').html(image));
                $("#occassion_file_show_list").append(image);  
               
            }else if (ext=="pdf"|| ext=="doc" || ext=="docx" || ext=="xlsx" || ext=="csv"){
               
                var file = '<a href="/file_upload/'+file+'"  style="color:white;"  download><div class="badge bg-danger">'+file+'</div></a>';
                $("#occassion_file_show_list").append(file);  

            }else if(ext=="mp4") {

                var video = '';            
                video += '<video width="320" height="240" controls>';
                video += '<source src="../../holidays_file/'+file+'" type="video/ogg">';
                video += '</video>';

                $("#occassion_file_show_list").append(video);  
               
            } else{

                $("#occassion_file_show_list").append(" ");  

            }

        }               
        
    });  

     //Get Holidays list
     $.ajax({
        url:"fetch_holidays_state_list_id_show",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            $("#state_show_list").text('');
            $("#state_show_list").append(response);                  
        }
        
    }); 

    $('#holidaysDetailModalList').modal('show');
       
}

function convert(str) {
    var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

