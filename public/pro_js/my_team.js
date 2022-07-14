
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
                    <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/1.jpg" alt=""></div>\
                    <div class="card-profile"><img class="rounded-circle" src="'+data[index].img+'" alt=""></div>\
                    <div class="text-center profile-details">\
                       <h4>'+data[index].name+'</h4>\
                       <h6>'+data[index].txt+'</h6>\
                    </div>\
                    <div class="card-footer row">\
                       <div class="col-6 col-sm-6">\
                          <h6>Follower</h6>\
                          <h3 class="counter">9564</h3>\
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