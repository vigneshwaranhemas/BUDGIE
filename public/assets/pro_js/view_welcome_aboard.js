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
});

// Data show
function view_welcome_aboard_process(){

$.ajax({
    url: get_welcome_aboard_details_link,
    method: "POST",
    dataType: "json",
    success: function(data) {
        // console.log(data.name)
        get_data = [];

        get_data['get_education_my'] = data['get_education_my'];
        get_data['get_education_from'] = data['get_education_from'];
        get_data['get_education_in'] = data['get_education_in'];

        get_data['get_work_experience_at'] = data['get_work_experience_at'];
        get_data['get_work_experience_as'] = data['get_work_experience_as'];
        get_data['get_work_experience_years'] = data['get_work_experience_years'];

        //  console.log(get_data['get_education_my'])

        if(data.length !=0){
            $('#name').val(data.name);
            $('#designation').val(data.designation);
            $('#department').val(data.department);
            $('#designation').val(data.designation);
            $('#today_date').val(data.today_date);

            $('#did_my').empty();
            html = "";
            html += "<table>";
            html += "<tbody>";
            for(let index = 0; index < get_data['get_education_my'].length; index++){
                // console.log(get_data['get_education_my'])
                html += "<tr>";
                 html+= "<td class='madell' style='padding-bottom: 8px';>I did my <input class='input' type='text' value="+get_data['get_education_my'][index]+" readonly>\
                from <input class='input' type='text' value="+get_data['get_education_from'][index]+" readonly>\
                in <input class='input' type='text' value="+get_data['get_education_in'][index]+" readonly> </td>";
                html +="</tr>";
            }

            html +="</tbody>";
            html +="</table>";
            $('#did_my').append(html)

            $('#achievements_education').html(data.achievements_education);
            $('#work_in').val(data.work_in);
            $('#work_designation').val(data.work_designation);
            $('#work_years').val(data.work_years);

            $('#work_experience').empty();
            html = "";
            html += "<table>";
            html += "<tbody>";
            for(let index = 0; index < get_data['get_work_experience_at'].length; index++){
                // console.log(get_data['get_education_my'])
                html += "<tr>";
                 html+= "<td class='madell' style='padding-bottom: 8px';>I did my <input class='input' type='text' value="+get_data['get_work_experience_at'][index]+" readonly>\
                from <input class='input' type='text' value="+get_data['get_work_experience_as'][index]+" readonly>\
                in <input class='input' type='text' value="+get_data['get_work_experience_years'][index]+" readonly> </td>";
                html +="</tr>";
            }

            html +="</tbody>";
            html +="</table>";
            $('#work_experience').append(html)


            $('#joining_at').val(data.joining_at);
            $('#joining_as').val(data.joining_as);
            $('#achievements_work').html(data.achievements_work);
            $('#my_favorite_pastime').val(data.my_favorite_pastime);
            $('#my_favorite_hobbies').val(data.my_favorite_hobbies);
            $('#my_favorite_places').val(data.my_favorite_places);
            $('#my_favorite_foods').val(data.my_favorite_foods);
            $('#my_favorite_sports').val(data.my_favorite_sports);
            $('#my_favorite_movies').val(data.my_favorite_movies);
            $('#my_favorite').val(data.my_favorite);
            $('#my_extracurricular_specialities').val(data.my_extracurricular_specialities);
            $('#my_career_aspirations').val(data.my_career_aspirations);
            $('#languages').val(data.languages);
            $('#interesting_facts').val(data.interesting_facts);
            $('#my_motto').val(data.my_motto);
            $('#books').val(data.books);

        }
    }
});
}





