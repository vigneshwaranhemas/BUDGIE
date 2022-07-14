$(document).ready(function (){

     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    get_side_bar();
});


//second

function test(one){
    var $this = $(".iconsidebar-menu");
    $('li').removeClass('open');
    $this.removeClass('iconbar-mainmenu-close');
    $(one).addClass('open');
}
 
function get_side_bar(){

 $.ajax({
        url: get_session_sidebar_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
          // console.log(data.sidebar_list)
          $('#sidebar_data').empty();

          $('#sidebar_data').append(data.sidebar_list);

        }
    });
}

