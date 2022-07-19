
$(document).ready(function(){
    get_user_list();
});


function get_user_list() {
    $.ajax({
         url:my_team_tl_link,
        method: "GET",
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if(data.success==1){
            var data=data.message;
            var html = '';
            for (let index = 0; index < data.length; index++) {
                html += '<div class="col-md-6 col-lg-6 col-xl-4 box-col-6">\
                 <div class="card custom-card">\
                    <div class="card-header"><img class="img-fluid" src="'+data[index].banner_img+'" alt="" style="margin-top: 16px;"></div>\
                    <div class="card-profile"><img class="rounded-circle" src="'+data[index].img+'" alt=""></div>\
                    <div class="text-center profile-details">\
                       <span class="italic">'+data[index].name+'</span><br>\
                       <span>'+data[index].id+'</span><br>\
                       <span>'+data[index].txt+'</span><br>\
                       <span>'+data[index].skill+'</span><br>\
                    </div>\
                    <div class="card-footer row">\
                       <div class="col-6 col-sm-6">\
                          <h6>Experience</h6>\
                          <h3 class="counter">'+data[index].exp+'</h3>\
                       </div>\
                       <div class="col-6 col-sm-6">\
                          <h6>Total Post</h6>\
                          <h3><span class="counter">96</span>M</h3>\
                       </div>\
                    </div>\
                 </div>\
              </div>';
            }
            $('#my_teams').html(html);
         }
         else{
             $('#my_teams').html(data.message)
         }
        }

    });
}