$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function() {
    $('.summernote').summernote();
});

//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");

   e.preventDefault();

   var achievements_education = $('#achievements_education').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");
   var achievements_work = $('#achievements_work').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");

//    if(name !=""){
//         var test = name ;
//    }else{
//        alert("sadasdasd");
//    }
//    alert(achievements_education)

   $.ajax({
       url:add_welcome_aboard_process_link,
       method:"POST",
       data: $("#add_welcome_aboard").serialize() + "&achievements_education=" + achievements_education + "&achievements_work=" + achievements_work,
       dataType:"json",

       success:function(data) {
        //    alert('sdf')
           console.log(data);
           $('#btnSubmit').prop("disabled",false);
               $('#btnSubmit').html('Submit');

           if(data.response =='success'){

               $('#btnSubmit').prop("disabled",true);

                $('#btnSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');

               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                       window.location.href = "view_welcome_aboard";
                    // location.reload();
                   }, 2000);

           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                       location.reload();
                   }, 2000);

           }

       },
       error: function(response) {

        $('#name_error').text(response.responseJSON.errors.name);
        $('#designation_error').text(response.responseJSON.errors.designation);
        $('#department_error').text(response.responseJSON.errors.department);
        $('#today_date_error').text(response.responseJSON.errors.today_date);
        $('#work_in_error').text(response.responseJSON.errors.work_in);
        $('#work_designation_error').text(response.responseJSON.errors.work_designation);
        $('#work_years_error').text(response.responseJSON.errors.work_years);
        $('#joining_at_error').text(response.responseJSON.errors.joining_at);
        $('#joining_as_error').text(response.responseJSON.errors.joining_as);
        document.documentElement.scrollTop = 0;

        }

   });
    })
})

// Add eduational table
function additional_education(){
    var rowCount = $('#myTable tr').length;
    var cur_rowCount = rowCount + 1;
    var html = '<tr>';

            html +='<td>';
                html +='I did my <input class="input" type="text" name="did_my[]" id="did_my">';
                html +='from <input class="input" type="text" name="did_from[]" id="did_from">';
                html +='in <input class="input" type="text" name="did_in[]" id="did_in">';
                html +='<button class="btn btn-danger education" type="button" style="width: 10px; margin-left: 32px;"><i class="fa fa-times" aria-hidden="true" style="margin-left: -5px;"></i></button>';
            html +='</td>';

        html +='</tr>';
    $('#education-tb tr:last').after(html);
}

//  Education closest in table
$("#education-tb").on("click", ".education", function(event) {
    $(this).closest("tr").remove();
});

// Add work table
function additional_work(){
    var rowCount = $('#myTables tr').length;
    var cur_rowCount = rowCount + 1;
    var html = '<tr>';

            html +='<td>';
                html +='I worked at <input class="input" type="text" name="work_experience_at[]" id="work_experience_at">';
                html +='as <input class="input" type="text" name="work_experience_as[]" id="work_experience_as">';
                html +='for about <input class="input" type="text" name="work_experience_years[]" id="work_experience_years"> years';
                html +='<button class="btn btn-danger work" type="button" style="width: 10px; margin-left: 32px;"><i class="fa fa-times" aria-hidden="true" style="margin-left: -5px;"></i></button>';
            html +='</td>';

        html +='</tr>';
    $('#work-tb tr:last').after(html);
}

//  Work closest in table
$('#work-tb').on("click", ".work", function(event){
    $(this).closest("tr").remove();
});






