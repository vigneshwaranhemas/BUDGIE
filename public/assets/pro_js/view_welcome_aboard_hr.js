$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    // alert("Hao");
    view_welcome_aboard_process();
    welcome_aboard_image_show();
});

// Data show
function view_welcome_aboard_process(){
var test_div="";
var params = new window.URLSearchParams(window.location.search);
var id=params.get('id')
$.ajax({
    url: get_welcome_aboard_details_hr_link,
    method: "POST",
    data: {id:id},
    dataType: "json",
    success: function(data) {
        // console.log(data.name)
        $('#data').text(data);
        get_data = [];

        get_data['get_education_my'] = data['get_education_my'];
        get_data['get_education_from'] = data['get_education_from'];
        get_data['get_education_in'] = data['get_education_in'];

        get_data['get_work_experience_at'] = data['get_work_experience_at'];
        get_data['get_work_experience_as'] = data['get_work_experience_as'];
        get_data['get_work_experience_years'] = data['get_work_experience_years'];

        //  console.log(get_data['get_education_my'])

        if(data.length !=0){

             test_div +="<p style='text-align: justify;'>Dear Newbie at HEMA’s!  We are delighted that you are onboard our inspiring HEMA’s bandwagon and we would like to share the joy with all our team mates!  Please help us with interesting information about you, which you would like our HEMA’s Fraternity Fellas to know. </p>\
            <p style='text-align: justify;'>Here’s a template which could be of help to you, to introduce yourself. Disclosing of Facts in this Sheet is entirely Voluntary.You may choose to answer/omit any queries listed in the DID YOU KNOW Section.</p>\
            <p>I "+data.name+"  have joined as "+data.designation+" at  "+data.department+"  today / on "+data.today_date+"</p>\
            <h5><b>EDUCATION (in chronological order, starting from the oldest to the latest)</b></h5>\
            ";


            html = "";
            html += "<table>";
            html += "<tbody>";
            for(let index = 0; index < get_data['get_education_my'].length; index++){

                test_div += "<p> I did my "+get_data['get_education_my'][index]+"\
                from "+get_data['get_education_from'][index]+"\
                in "+get_data['get_education_in'][index]+"</p>\
                ";
            }

            html +="</tbody>";
            html +="</table>";

            test_div +="<h5 style='margin-top: 37px;'><b>My Achievements in Education,which I’d like my peers to know : </b></h5>\
                <p>"+data.achievements_education+"\
                </p>\
            <h5><b>WORK EXPERIENCE  (in chronological order, starting from the oldest to the latest) </b></h5>\
            <p>I Started my professional Career in "+data.work_in+" and as "+data.work_designation+" and worked there for about "+data.work_years+" Years and </p>\
            ";

            html = "";
            html += "<table>";
            html += "<tbody>";
            for(let index = 0; index < get_data['get_work_experience_at'].length; index++){

                test_div += "<p> I did my "+get_data['get_work_experience_at'][index]+"\
                from "+get_data['get_work_experience_as'][index]+"\
                in "+get_data['get_work_experience_years'][index]+"</p>\
                ";
            }

            test_div += "<p style='margin-top: 33px;'>My Recent Work Experience before Joining HEMA’s was at "+data.joining_at+" As "+data.joining_as+"</p>\
            <h5><b>My Achievements at Work , which I’d like my peers to know : </b></h5>\
                    <p>"+data.achievements_work+"\
                    </p>\
            <h5><b>DID YOU KNOW SECTION: </b></h5>\
            <h5><b>Some Interesting facts about me, on the personal front, which I’d like to share with my peers : </b></h5>\
            <p>My favorite pastime/ pursuits "+data.my_favorite_pastime+" </p>\
            <p>My favorite hobbies "+data.my_favorite_hobbies+" </p>\
            <p>Three places Id love to visit "+data.my_favorite_places+" </p>\
            <p>Three Foods I relish "+data.my_favorite_foods+" </p>\
            <p>My Favorite Sports "+data.my_favorite_sports+" </p>\
            <p>My Favorite Movies "+data.my_favorite_movies+" </p>\
            <p>My Favorite "+data.my_favorite+" </p>\
            <p>My Extracurricular Specialities  "+data.my_extracurricular_specialities+" </p>\
            <p>My Career Aspirations "+data.my_career_aspirations+" </p>\
            <p>I can speak these Languages fluently "+data.languages+" </p>\
            <p>Some Interesting Facts about me that my peers can know! "+data.interesting_facts+" </p>\
            <p>My Motto ! "+data.my_motto+" </p>\
            <p>Books that I Read / Love to Recommend "+data.books+" </p>\
            ";

            $(".summernote").summernote('code',test_div);


        }
    }
});
}


// Image generator data show
function welcome_aboard_image_show(){

    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var image_div = "";

    $.ajax({
        url: get_welcome_aboard_image_show_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {
            if(data.image_path !=null){
                image_div += "<a href='../assets/images/image_generator/"+data['image_path']+".jpg' target='_blank'><img src='../assets/images/image_generator/"+data['image_path']+".jpg' alt='image_generator' style='width: -webkit-fill-available; margin-bottom: 60px;'></a>\
                ";
                image_div += "<div class='text-center'>\
                                <a href='../assets/images/image_generator/"+data['image_path']+".jpg' download>\
                                    <button class='btn btn-primary-gradien' type='button'>Download</button>\
                                </a>\
                            </div>\
                ";
                $("#image_div").html(image_div);
            }
            else{
                image_div = "";
                $("#image_div").html(image_div);
            }

        }
    });
}



