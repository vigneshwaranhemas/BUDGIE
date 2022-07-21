
$(document).ready(function(){
    get_team_members_list();
    get_user_list();
    get_experience_information();
});
function get_team_members_list(){
    $.ajax({
        url:my_team_members_list_link_page,
        method: "POST",
        dataType: "json",
        success: function(data) {
            // var m_name = data[index].m_name; 
             var html = '<option value="">-Select Team Member-</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].empID + "'>" + data[index].username+''+data[index].m_name+''+data[index].l_name + "</option>";
                }
                $('#team_members_list').html(html);
            }
        });
    }

$("#team_members_list").on('change', function() { 
    var team_member_name =$('#team_members_list').val();
    // alert(team_member_name)
    get_user_list(team_member_name);
});
function get_user_list(team_member_name) {

    // if (team_member_name!="") {
    $.ajax({
        url:my_team_tl_link,
        method: "POST",
        data:{"team_member_name":team_member_name},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if(data.success==1){
            var data=data.message;
            var html = '';
            for (let index = 0; index < data.length; index++) {

                html += '<div class="col-md-6 col-lg-6 col-xl-4 box-col-6">\
                 <div class="card custom-card">\
                    <div class="card-header pointer">\
                    <a onclick=my_team_profile_view("'+data[index].id+'");><img class="img-fluid" src="'+data[index].banner_img+'" alt="" style="margin-top: 16px;"></div>\
                    <div class="card-profile pointer"><img class="rounded-circle" src="'+data[index].img+'" alt=""></div>\
                    <div class="text-center profile-details pointer">\
                       <span class="italic">'+data[index].name+'</span><br>\
                       <span>'+data[index].id+'</span><br>\
                       <span>'+data[index].txt+'</span><br>\
                       <span>'+data[index].skill+'</span><br><br>\
                    </div></a>\
                        <div class="card-footer row">\
                           <div class="col-6 col-sm-6">\
                              <h6>Follower</h6>\
                              <h3 class="counter">2578</h3>\
                           </div>\
                           <div class="col-6 col-sm-6">\
                              <h6>Following</h6>\
                              <h3><span class="counter">26</span>K</h3>\
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

function get_experience_information() {
    $.ajax({
         url:my_team_experience_info_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            console.log(data)
            if(data.success==1){
            var data=data.message;
            var html = '';
            for (let index = 0; index < data.length; index++) {
                html += '<div class="col-6 col-sm-6">\
                              <h6>Experience</h6>\
                              <h3 class="counter">'+data[index].days+'</h3>\
                           </div>\
                           <div class="col-6 col-sm-6">\
                              <h6>Total Post</h6>\
                              <h3><span class="counter"></span>M</h3>\
                           </div>';
            }
            $('#exp_information').html(html);
         }
         else{
             $('#exp_information').html(data.message)
         }
        }

    });
}
function my_team_profile_view(emp_id){
    var encoded = btoa(emp_id);
    var encoded2 = btoa(encoded);
    window.location.href="my_team_profile_view?id="+encoded2;
}