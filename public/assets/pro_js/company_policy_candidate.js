$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_policy_category_candidate();
});

function get_policy_category_candidate(){

    $.ajax({
        url: get_policy_category_candidate_details_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            // console.log(data)


            if(data.length !=0){

                html="";

                for (let index = 0; index < data.length; index++) {
                    html += '<a  onclick = getVal("'+ data[index].cp_id+'")   class="list-group-item list-group-item-action" id="list-home-list_'+index+'"  data-toggle="list" href="#list-home" role="tab" aria-controls="list-home">' + data[index].policy_category + '</a>';
                }

                $('#small').html(html);
                $("#list-home-list_0").click();

            }
        }
    });
}

function getVal(cp_id) {
    // alert(cp_id)

    $.ajax({
        url: get_policy_information_candidate_details_link,
        method: "POST",
        data:{"cp_id":cp_id,},
        dataType: "json",
        success: function(data) {
            // console.log(data);
            if(data.length !=0){

                html = "";

                for (let index = 0; index < data.length; index++){
                    html += "<div class='tab-pane fade show active' id='list-home' role='tabpanel' aria-labelledby='list-home-list'>\
                            <div class='card-table'>\
                                <div class='list-group-items collapsed' data-toggle='collapse' data-target='#collapseicon_first"+data[index].id+"' aria-expanded='false' aria-controls='collapse11'>\
                                    <div class='row'>\
                                        <div class='col-md-8'>\
                                        <span class='arrow'></span>\
                                            <h5 class='top-left'> " +data[index].policy_title + " </h5>\
                                        </div>\
                                        <div class='col-md-4'>\
                                            <p class='last-right'> Last updated on " + moment(data[index].created_on).format('DD-MMM-YYYY') + "</p>\
                                        </div>\
                                    </div>\
                                    <p class='last-update'>" + data[index].policy_description + "</p>\
                                </div>\
                                <div class='collapse' id='collapseicon_first"+data[index].id+"' aria-labelledby='collapseicon_first' data-parent='#accordionoc' style='border: 1px solid rgba(0, 0, 0, 0.125);'>\
                                   <div class='card-body'>";

                                    var file="";
                                    var  nameArr = data[index].file_upload.split(/[ ,]+/);
                                    for (var i = nameArr.length - 1; i >= 0; i--) {
                                    var ext = nameArr[i].split('.')[1];

                                    if(ext == "doc"){
                                        // alert(data[index].file_upload)
                                        // alert(ext)
                                   html += "<a href='../company_policy_information/" + data[index].file_upload + "' download><button class='btn btn-primary'>" + data[index].file_upload + "<i class='fa fa-download' style='margin-left: 12px;'></i></button></a>";
                                }
                                    else if(ext == "pdf"){
                                        // alert(data[index].file_upload)
                                        // alert(ext)
                                        html += "<a href='../company_policy_information/" + data[index].file_upload + "' target='_blank'><button class='btn btn-primary'>" + data[index].file_upload + "<i class='fa fa-download' style='margin-left: 12px;'></i></button></a>";
                                    }
                                    html +="</div>\
                                </div>\
                            </div>\
                        </div>";
                }

                $('#nav-tabContent').html(html);
                }
            }
        }
    });

}
