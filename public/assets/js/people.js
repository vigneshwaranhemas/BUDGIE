"use strict";

$(document).ready(function() {
    
    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();
    
    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET", 
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "empty"){ 

                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{          
                                
                fetch_people_list_ul_li();
                fetch_everyone_details();
                fetch_starred_details();
                                            
            }
            
        }
    });
});

// $(".chat-right-aside").css('display', 'none');
// $(".chat-right-aside-star").css('display', 'block');
// $(".chat-right-aside").html("hi");

function fetch_people_list_ul_li(){

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "empty"){ 
                // alert("no 1")                               
                // $(".chat-right-aside").css('display', 'block');
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{          
                // alert("yes 1")
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data: {
                        people_filter_dept: people_filter_dept_value,
                        people_filter_design: people_filter_design_value,
                        people_filter_location: people_filter_location_value,
                        employee: employee,
                    },
                    // data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);

                        if(response == "empty"){ 
                            // alert("no")                               
                            // $(".chat-right-aside").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'block');
                        }else{          
                            // alert("yes")                               
            
                            // $(".chat-right-aside-employees-empty").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside").css('display', 'block');
            
                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);         
                                var doj = moment(value.doj).format('DD MMM YYYY');                        
                                var dob = moment(value.dob).format('DD MMM');                        
                                $("#people_doj_show").html(doj);                                
                                $("#people_dob_show").html(dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);                                

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });

                //Img List
                $.ajax({
                    url:"fetch_people_list_filter_img",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        // $("#people_show_img").append(""); 
                        $("#people_show_img").html(response); 
                    }               
                    
                });
                                            
            }
            
        }
    });
        
}

function fetch_starred_details(){
    
    
    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    //Star List
    $.ajax({
        url:"fetch_starred_customusers_list",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        cache: false,
        success:function(response)
        {
            // console.log(response);
            if(response == "empty"){                                
                // alert("no 2")          
                $("#people_starred_list_show").html(""); 
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');
            }else{          
                // alert("yes 2")                               
                $("#people_starred_list_show").html(response); 
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

                $(".chat-box .people-list ul li").removeClass("active");
                $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');

            }
            // $("#people_starred_list_show").html(resObject.responseJSON); 
        }               
        
    });
}

$(document).ready(function(){
    // $('ul li:first').addClass('has-border');
    
    $(".chat-box .people-list ul li").removeClass("active");
    $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');

});

function fetch_everyone_details(){

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();
    // console.log(people_filter_dept_value);
    //Star List
    $.ajax({
        url:"fetch_everyone_customusers_list",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);
            if(response == "empty"){                
                // alert("no 3")                               
                $("#people_everyone_list_show").html(''); 
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');
            }else{          
                // alert("yes 3")                               
                $("#people_everyone_list_show").html(response); 
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

            }
        }               
        
    });
}

$('.people_list_filter').change(function () {
    // alert(this.value)
    var employee = this.value;
    
    // $('#people_list_filter_everyone').select2({
    //     placeholder: 'Enter Emp. Name or ID...',
    //     allowClear: true
    // });

    var $this = $(".chat-box .chat-menu .nav-tabs #people_tab_li_2 a");

    //Find Active Tab
    if($this.hasClass('active')) {                        
        
        var $this = $(".people-list .list li");

        if ($this.hasClass("above_li")) {
            // var del_class = document.querySelectorAll('above_li');
            var del_class = $('.people-list .list .above_li');
            // console.log(del_class)
            del_class.remove();
        }
        
        fetch_everyone_details();

        var people_filter_dept_value = $('#people_filter_dept_value').val();
        var people_filter_design_value = $('#people_filter_design_value').val();
        var people_filter_location_value = $('#people_filter_location_value').val();

        $.ajax({
            url:"fetch_people_list_filter",
            type:"GET",
            data: {
                people_filter_dept: people_filter_dept_value,
                people_filter_design: people_filter_design_value,
                people_filter_location: people_filter_location_value,
                employee: employee,
            },
            // data : {employee: employee},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response);
                
                if(response == "empty"){
                    $(".chat-right-aside").css('display', 'none');                        
                    $(".chat-right-aside-star").css('display', 'none');
                    $(".chat-right-aside-employees-empty").css('display', 'block');
                }else{
                    // $(".chat-right-aside").css('display', 'block');                        
                    $(".chat-right-aside-star").css('display', 'none');
                    $(".chat-right-aside-employees-empty").css('display', 'none');
    
                    var rData = [];
                    rData = response;                   
                    $.each(rData, function (index, value) {
                                                                                                                                            
                        $("#people_name_show").html(value.username);
                        $("#people_empID_show").html(value.empID);
                        $("#people_designation_show").html(value.designation);
                        $("#people_dept_show").html(value.department);
                        $("#people_contact_show").html(value.contact_no);
                        $("#people_email_show").html(value.email);
                        $("#people_wl_show").html(value.worklocation);       
                        var doj = moment(value.doj).format('DD MMM YYYY');                        
                        var dob = moment(value.doj).format('DD-MM-YYYY');  
                        var dob_1 = moment(value.dob).format('DD MMM');
                        $("#people_doj_show").html(doj);                                
                        $("#people_dob_show").html(dob_1);                                                         
                        $(".chat-right-aside").css('display', 'block');  
                                                                                      
                        var $this = $(".list #people_everyone_list_show li");
                        let $uls = $('.list #people_everyone_list_show');
                        // console.log($uls);
                        //  $uls.empty();
                        if ($this.hasClass(value.empID)) {
                            // alert("y")

                            $(".list #people_everyone_list_show li").removeClass("active");
                            // $(".list #people_everyone_list_show #"+value.empID+"").addClass('active');   
                            $(".list #people_everyone_list_show ."+value.empID+"").addClass('active');   
                           
                            let $li = $(".list #people_everyone_list_show ."+value.empID+"");

                            // let $li = $(".list #people_everyone_list_show #"+value.empID+"");
                            // console.log($li);
                                                       
                            $li.addClass("above_li");
                            console.log($li);
                            $li.insertBefore($uls);
                            var $this = $(".list #people_everyone_list_show");
                                                        
                            if($this){

                                $(".list #people_everyone_list_show").hide();

                            }

                        }
                    });
                }
                
            }               
            
        });

    } else {

        var $this = $(".people-list .list li");

        if ($this.hasClass("above_li")) {
            // var del_class = document.querySelectorAll('above_li');
            var del_class = $('.people-list .list .above_li');
            // console.log(del_class)
            del_class.remove();
        }

        var people_filter_dept_value = $('#people_filter_dept_value').val();
        var people_filter_design_value = $('#people_filter_design_value').val();
        var people_filter_location_value = $('#people_filter_location_value').val();
                
        $.ajax({
            url:"fetch_people_list_filter_starred",
            type:"GET",
            data: {
                people_filter_dept: people_filter_dept_value,
                people_filter_design: people_filter_design_value,
                employee: employee,
                people_filter_location: people_filter_location_value,
            },
            // data : {employee: employee},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response);
    
                if(response == "empty"){
                    $(".chat-right-aside").css('display', 'none');                        
                    $(".chat-right-aside-star").css('display', 'block');
                    $(".chat-right-aside-employees-empty").css('display', 'none');
                }else{
                    // $(".chat-right-aside").css('display', 'block');                        
                    $(".chat-right-aside-star").css('display', 'none');
                    $(".chat-right-aside-employees-empty").css('display', 'none');
    
                    var rData = [];
                    rData = response;                   
                    $.each(rData, function (index, value) {
                                                                                                                                            
                        $("#people_name_show").html(value.username);
                        $("#people_empID_show").html(value.empID);
                        $("#people_designation_show").html(value.designation);
                        $("#people_dept_show").html(value.department);
                        $("#people_contact_show").html(value.contact_no);
                        $("#people_email_show").html(value.email);
                        $("#people_wl_show").html(value.worklocation);       
                        var doj = moment(value.doj).format('DD MMM YYYY');                        
                        var dob = moment(value.doj).format('DD-MM-YYYY');                        
                        var dob_1 = moment(response[0].dob).format('DD MMM');
                        $("#people_doj_show").html(doj);                                
                        $("#people_dob_show").html(dob_1);    
                        // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                        // // alert(star_icon)
                        // $("#people_star_i_show").html(star_icon);                                
                        $(".chat-right-aside").css('display', 'block');                                                            
    
                        // fetch_starred_details();
                        var $this = $(".list #people_starred_list_show li");
                        let $uls = $('.list #people_starred_list_show');

                        if ($this.hasClass(value.empID)) {
                            // alert("y")
                            $(".list #people_starred_list_show li").removeClass("active");
                            $(".list #people_starred_list_show ."+value.empID+"").addClass('active');                       
                            // $(".list #people_starred_list_show #"+value.empID+"").addClass('active');                       

                            let $li = $(".list #people_starred_list_show ."+value.empID+"");
                            // let $li = $(".list #people_everyone_list_show #"+value.empID+"");
                            // console.log($li);
                                                       
                            $li.addClass("above_li");
                            console.log($li);
                            $li.insertBefore($uls);
                            var $this = $(".list #people_starred_list_show");
                                                        
                            if($this){

                                $(".list #people_starred_list_show").hide();

                            }
                    
                        }else{
                            // alert('n')
                        }
                    });
                }
                
            }               
            
        });
        
    }      

    //Star List
    $.ajax({
        url:"fetch_people_list_filter_star",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#people_star_i_show").html(""); 
            $("#people_star_i_show").html(response); 
        }               
        
    });

    //Img List
    $.ajax({
        url:"fetch_people_list_filter_img",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);
            $("#people_show_img").html(response); 
        }               
        
    });

});

$('body').on('click','.people_star_add',function(){
    var emp_id = $(this).data('id');
    var username = $(this).data('username');
    // alert(emp_id)

    $.ajax({
        url:"fetch_people_star_add",
        type:"POST",
        data : { emp_id: emp_id },
        dataType : "JSON",
        success:function(response)
        {
            // console.log();  
            if(response.output == "star_addded"){

                $(".star_class_name").css("color", "#ffc717");
                // $("#star_class_name").css("color", "#ffc717");

                fetch_starred_details();
                fetch_everyone_details();

            }else{

                $(".star_class_name").css("color", "#6e7e96");                

                var $this = $(".chat-box .chat-menu .nav-tabs #people_tab_li_2 a");

                if ($this.hasClass('active')) {
                    // alert("y")
                    // fetch_starred_details();
                    fetch_everyone_details();

                } else {
                    // alert("n")
                    fetch_starred_details();
                    
                    var people_filter_dept_value = $('#people_filter_dept_value').val();
                    var people_filter_design_value = $('#people_filter_design_value').val();
                    var people_filter_location_value = $('#people_filter_location_value').val();

                    $.ajax({
                        url:"fetch_people_starred_first_empid",
                        type:"GET",
                        data: {
                            people_filter_dept: people_filter_dept_value,
                            people_filter_design: people_filter_design_value,
                            people_filter_location: people_filter_location_value,
                        },
                        dataType : "JSON",
                        success:function(response)
                        {
                            // alert(response)
                            if(response == "empty"){ 
                
                                $(".chat-right-aside").css('display', 'none');
                                $(".chat-right-aside-star").css('display', 'block');
                                $(".chat-right-aside-employees-empty").css('display', 'none');

                                // //Star List
                                var people_filter_dept_value = $('#people_filter_dept_value').val();
                                var people_filter_design_value = $('#people_filter_design_value').val();
                                var people_filter_location_value = $('#people_filter_location_value').val();

                                $.ajax({
                                    url:"fetch_starred_customusers_list",
                                    type:"GET",
                                    data: {
                                        people_filter_dept: people_filter_dept_value,
                                        people_filter_design: people_filter_design_value,
                                        people_filter_location: people_filter_location_value,
                                    },
                                    dataType : "JSON",
                                    cache: false,
                                    success:function(response)
                                    {
                                        if(response == "empty"){ 
                
                                            $("#people_starred_list_show").html(""); 

                                        }else{
                                            $("#people_starred_list_show").html(response); 
                                            $(".chat-box .people-list ul li").removeClass("active");
                                            $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
                                        }            
                                    }               
                                    
                                });
                
                            }else{

                                // //Star List
                                var people_filter_dept_value = $('#people_filter_dept_value').val();
                                var people_filter_design_value = $('#people_filter_design_value').val();
                                var people_filter_location_value = $('#people_filter_location_value').val();

                                $.ajax({
                                    url:"fetch_starred_customusers_list",
                                    type:"GET",
                                    data: {
                                        people_filter_dept: people_filter_dept_value,
                                        people_filter_design: people_filter_design_value,
                                        people_filter_location: people_filter_location_value,
                                    },
                                    dataType : "JSON",
                                    cache: false,
                                    success:function(response)
                                    {
                                        $("#people_starred_list_show").html(response);  
                                        $(".chat-box .people-list ul li").removeClass("active");
                                        $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
                                    }               
                                    
                                });

                                var people_filter_dept_value = $('#people_filter_dept_value').val();
                                var people_filter_design_value = $('#people_filter_design_value').val();
                                var people_filter_location_value = $('#people_filter_location_value').val();

                                $.ajax({
                                    url:"fetch_people_starred_first_empid",
                                    type:"GET",
                                    data: {
                                        people_filter_dept: people_filter_dept_value,
                                        people_filter_design: people_filter_design_value,
                                        people_filter_location: people_filter_location_value,
                                    },
                                    dataType : "JSON",
                                    success:function(response)
                                    {
                                            
                                        // alert("yes 1")
                                        $(".chat-right-aside-star").css('display', 'none');
                                        $(".chat-right-aside-employees-empty").css('display', 'none');
                                        $(".chat-right-aside").css('display', 'block');
                        
                                        var employee = response;
                                        
                                        $.ajax({
                                            url:"fetch_people_list_filter",
                                            type:"GET",
                                            data: {
                                                people_filter_dept: people_filter_dept_value,
                                                people_filter_design: people_filter_design_value,
                                                people_filter_location: people_filter_location_value,
                                                employee: employee,
                                            },
                                            // data : {employee: employee},
                                            dataType : "JSON",
                                            success:function(response)
                                            {
                                                // console.log(response);
                        
                                                if(response == "empty"){ 
                                                    // alert("no")                               
                                                    // $(".chat-right-aside").css('display', 'none');
                                                    // $(".chat-right-aside-star").css('display', 'none');
                                                    // $(".chat-right-aside-employees-empty").css('display', 'block');
                                                }else{          
                                                    // alert("yes")                               
                                    
                                                    // $(".chat-right-aside-employees-empty").css('display', 'none');
                                                    // $(".chat-right-aside-star").css('display', 'none');
                                                    // $(".chat-right-aside").css('display', 'block');
                                    
                                                    var rData = [];
                                                    rData = response;                   
                                                    $.each(rData, function (index, value) {
                                                                                                                                                                            
                                                        $("#people_name_show").html(value.username);
                                                        $("#people_empID_show").html(value.empID);
                                                        $("#people_designation_show").html(value.designation);
                                                        $("#people_dept_show").html(value.department);
                                                        $("#people_contact_show").html(value.contact_no);
                                                        $("#people_email_show").html(value.email);
                                                        $("#people_wl_show").html(value.worklocation);       
                                                        var doj = moment(value.doj).format('DD MMM YYYY');                        
                                                        var dob = moment(value.doj).format('DD-MM-YYYY');                        
                                                        var dob_1 = moment(value.dob).format('DD MMM');
                                                        $("#people_doj_show").html(doj);                                
                                                        $("#people_dob_show").html(dob_1);    
                                                        // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                                        // // alert(star_icon)
                                                        // $("#people_star_i_show").html(star_icon);                                
                        
                                                    });
                                                }
                                                
                                            }               
                                            
                                        });
                            
                                        //Star List
                                        $.ajax({
                                            url:"fetch_people_list_filter_star",
                                            type:"GET",
                                            data : {employee: employee},
                                            dataType : "JSON",
                                            success:function(response)
                                            {
                                                // console.log(response);
                                                $("#people_star_i_show").html(response); 
                                            }               
                                            
                                        });

                                        //Img List
                                        $.ajax({
                                            url:"fetch_people_list_filter_img",
                                            type:"GET",
                                            data : {employee: employee},
                                            dataType : "JSON",
                                            success:function(response)
                                            {
                                                console.log(response);
                                                $("#people_show_img").html(response); 
                                            }               
                                            
                                        });
                                                                        
                                        
                                        
                                    }
                                });
                            
                            }
                            
                        }
                    });

                }

                
            }   

        }               
        
    });
    // window.location.reload();                                                                                            

    

});

$('#people_tab_li_1').click(function () {  

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    fetch_starred_details();

    // alert("1")
    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            // console.log(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{
                $(".chat-right-aside-star").css('display', 'none');

                // alert("star tab 1 yes")
                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data: {
                        people_filter_dept: people_filter_dept_value,
                        people_filter_design: people_filter_design_value,
                        employee: employee,
                        people_filter_location: people_filter_location_value,
                    },
                    // data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // alert("no")
                            // $(".chat-right-aside").css('display', 'none');                        
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                        }else{
                            // alert("yes")

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);        
                                var doj = moment(value.doj).format('DD MMM YYYY');                        
                                var dob = moment(value.doj).format('DD-MM-YYYY');                        
                                var dob_1 = moment(response[0].dob).format('DD MMM');
                                $("#people_doj_show").html(doj);                                
                                $("#people_dob_show").html(dob_1);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);  
                                $(".chat-right-aside-star").css('display', 'none');
                                $(".chat-right-aside-employees-empty").css('display', 'none');                                  
                                $(".chat-right-aside").css('display', 'block');

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });

                //Img List
                $.ajax({
                    url:"fetch_people_list_filter_img",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_show_img").html(response); 
                    }               
                    
                });
            }
            
        }
    });
    
    $(".chat-box .people-list ul li").removeClass("active");
    $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');

    // $('.chat-box .people-list ul #people_starred_list_show li').first().css('background-color', '#7e37d8');

});

$('#people_tab_li_2').click(function () {

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    fetch_everyone_details();

    // alert("2")
    $.ajax({
        url:"fetch_people_everyone_first_empid",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            // alert(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');

            }else{

                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                
                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data: {
                        people_filter_dept: people_filter_dept_value,
                        people_filter_design: people_filter_design_value,
                        people_filter_location: people_filter_location_value,
                        employee: employee,
                    },
                    // data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // $(".chat-right-aside").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'block');
                        }else{
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);        
                                var doj = moment(value.doj).format('DD MMM YYYY');                        
                                var dob = moment(value.dob).format('DD MMM');                        
                                $("#people_doj_show").html(doj);                                
                                $("#people_dob_show").html(dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);                                
                                $(".chat-right-aside").css('display', 'block');
                                // $('.chat-box .people-list ul p li:first').addClass('active');
                                $(".chat-box .people-list ul li").removeClass("active");
                                $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
                                // $('.chat-box .people-list ul #people_everyone_list_show li').first().css('background-color', '#7e37d8');

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });

                //Img List
                $.ajax({
                    url:"fetch_people_list_filter_img",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_show_img").html(response); 
                    }               
                    
                });
            }
            
        }
    });
            
});

//Menu list active 
$('body').on('click','.people_list_ul_li',function(){

    $(".chat-box .people-list ul li").removeClass("active");

    $(this).addClass('active');

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();
    
    var employee = $(this).data('id');
    // alert(employee)
    
    $.ajax({
        url:"fetch_people_list_filter",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
            employee: employee,
        },
        // data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            if(response == "empty"){
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');
            }else{
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');

                var rData = [];
                rData = response;                   
                $.each(rData, function (index, value) {
                                                                                                                                        
                    $("#people_name_show").html(value.username);
                    $("#people_empID_show").html(value.empID);
                    $("#people_designation_show").html(value.designation);
                    $("#people_dept_show").html(value.department);
                    $("#people_contact_show").html(value.contact_no);
                    $("#people_email_show").html(value.email);
                    $("#people_wl_show").html(value.worklocation);        
                    var doj = moment(value.doj).format('DD MMM YYYY');                        
                    var dob = moment(value.dob).format('DD MMM');                        
                    $("#people_doj_show").html(doj);                                
                    $("#people_dob_show").html(dob);    
                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                    // // alert(star_icon)
                    // $("#people_star_i_show").html(star_icon);                                
                    $(".chat-right-aside").css('display', 'block');

                });
            }
            
        }               
        
    });

    //Star List
    $.ajax({
        url:"fetch_people_list_filter_star",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#people_star_i_show").html(response); 
        }               
        
    });

    //Img List
    $.ajax({
        url:"fetch_people_list_filter_img",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);
            $("#people_show_img").html(response); 
        }               
        
    });
});

//Filter
$('body').on('click','.icon-filter',function(){
    $('.div_filter').css('display', 'block');
});

$('body').on('click','.div_filter_close',function(){
    $('.div_filter').css('display', 'none');
});


$('body').on('click','#people_filter_reset',function(){
    // alert("reset")
    window.location.reload();  

    // $('#people_filter_dept').text("All");
    // $('#people_filter_design').val("All");
    // $('#people_filter_location').val("All");
    // $('#people_filter_dept_value').val("All");
    // $('#people_filter_design_value').val("All");
    // $('#people_filter_location_value').val("All");

    // var $this = $(".chat-box .chat-menu .nav-tabs #people_tab_li_2 a");

    // if ($this.hasClass('active')) {

    //     var people_filter_dept_value = $('#people_filter_dept_value').val();
    //     var people_filter_design_value = $('#people_filter_design_value').val();
    //     var people_filter_location_value = $('#people_filter_location_value').val();

    //     $.ajax({
    //         url:"fetch_people_everyone_first_empid",
    //         type:"GET",
    //         data: {
    //             people_filter_dept: people_filter_dept_value,
    //             people_filter_design: people_filter_design_value,
    //             people_filter_location: people_filter_location_value,
    //         },
    //         dataType : "JSON",
    //         success:function(response)
    //         {
    //             // console.log(response)
    //             // alert(response)
    //             if(response == "empty"){
    //                 // alert("star tab 1  no")
    //                 $(".chat-right-aside-employees-empty").css('display', 'block');
    //                 $(".chat-right-aside").css('display', 'none');                        
    //                 $(".chat-right-aside-star").css('display', 'none');

    //             }else{
    //                 // alert("star tab 2  no")
    //                 $(".chat-right-aside-employees-empty").css('display', 'none');
    //                 $(".chat-right-aside-star").css('display', 'none');
                    
    //                 var employee = response;
                
    //                 $.ajax({
    //                     url:"fetch_people_list_filter",
    //                     type:"GET",
    //                     data: {
    //                         people_filter_dept: people_filter_dept_value,
    //                         people_filter_design: people_filter_design_value,
    //                         people_filter_location: people_filter_location_value,
    //                         employee: employee,
    //                     },
    //                     // data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         // console.log(response);
    //                         if(response == "empty"){
    //                             $(".chat-right-aside").css('display', 'none');
    //                             $(".chat-right-aside-star").css('display', 'none');
    //                             $(".chat-right-aside-employees-empty").css('display', 'block');
    //                         }else{
    //                             $(".chat-right-aside-star").css('display', 'none');
    //                             $(".chat-right-aside-employees-empty").css('display', 'none');

    //                             var rData = [];
    //                             rData = response;                   
    //                             $.each(rData, function (index, value) {
                                                                                                                                                        
    //                                 $("#people_name_show").html(value.username);
    //                                 $("#people_empID_show").html(value.empID);
    //                                 $("#people_designation_show").html(value.designation);
    //                                 $("#people_dept_show").html(value.department);
    //                                 $("#people_contact_show").html(value.contact_no);
    //                                 $("#people_email_show").html(value.email);
    //                                 $("#people_wl_show").html(value.worklocation);      
    //                                 var doj = moment(value.doj).format('DD-MM-YYYY');                        
    //                                 var dob = moment(value.doj).format('DD-MM-YYYY');                        
    //                                 $("#people_doj_show").html(doj);                                
    //                                 $("#people_dob_show").html(dob);    
    //                                 // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
    //                                 // // alert(star_icon)
    //                                 // $("#people_star_i_show").html(star_icon);                                
    //                                 $(".chat-right-aside").css('display', 'block');
    //                                 $(".chat-box .people-list ul li").removeClass("active");
    //                                 $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
                                    
    //                             });
    //                         }
                            
    //                     }               
                        
    //                 });

    //                 //Star List
    //                 $.ajax({
    //                     url:"fetch_people_list_filter_star",
    //                     type:"GET",
    //                     data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         // console.log(response);
    //                         $("#people_star_i_show").html(response); 
    //                     }               
                        
    //                 });

    //                 //Img List
    //                 $.ajax({
    //                     url:"fetch_people_list_filter_img",
    //                     type:"GET",
    //                     data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         console.log(response);
    //                         $("#people_show_img").html(response); 
    //                     }               
                        
    //                 });
    //             }
                
    //         }
    //     });
            
    //     fetch_everyone_details();

    //     // $('.chat-box .people-list ul p li:first').addClass('active');
    //     // $(".chat-box .people-list ul li").removeClass("active");
    //     // $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
    //     // $('.chat-box .people-list ul #people_everyone_list_show li').first().css('background-color', '#7e37d8');

    // }else{
    //     var people_filter_dept_value = $('#people_filter_dept_value').val();
    //     var people_filter_design_value = $('#people_filter_design_value').val();
    //     var people_filter_location_value = $('#people_filter_location_value').val();
    
    //     fetch_starred_details();
    
    //     // alert("1")
    //     $.ajax({
    //         url:"fetch_people_starred_first_empid",
    //         type:"GET",
    //         data: {
    //             people_filter_dept: people_filter_dept_value,
    //             people_filter_design: people_filter_design_value,
    //             people_filter_location: people_filter_location_value,
    //         },
    //         dataType : "JSON",
    //         success:function(response)
    //         {
    //             // alert(response)
    //             // console.log(response)
    //             if(response == "empty"){
    //                 // alert("star tab 1  no")
    //                 $(".chat-right-aside").css('display', 'none');                        
    //                 $(".chat-right-aside-star").css('display', 'block');
    //                 $(".chat-right-aside-employees-empty").css('display', 'none');
    
    //             }else{
    //                 $(".chat-right-aside-star").css('display', 'none');
    
    //                 // alert("star tab 1 yes")
    //                 var employee = response;
                
    //                 $.ajax({
    //                     url:"fetch_people_list_filter",
    //                     type:"GET",
    //                     data: {
    //                         people_filter_dept: people_filter_dept_value,
    //                         people_filter_design: people_filter_design_value,
    //                         people_filter_location: people_filter_location_value,
    //                         employee: employee,
    //                     },
    //                     // data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         // console.log(response);
    //                         if(response == "empty"){
    //                             // alert("no")
    //                             // $(".chat-right-aside").css('display', 'none');                        
    //                             // $(".chat-right-aside-star").css('display', 'none');
    //                             // $(".chat-right-aside-employees-empty").css('display', 'none');
    
    //                         }else{
    //                             // alert("yes")
    
    //                             var rData = [];
    //                             rData = response;                   
    //                             $.each(rData, function (index, value) {
                                                                                                                                                        
    //                                 $("#people_name_show").html(value.username);
    //                                 $("#people_empID_show").html(value.empID);
    //                                 $("#people_designation_show").html(value.designation);
    //                                 $("#people_dept_show").html(value.department);
    //                                 $("#people_contact_show").html(value.contact_no);
    //                                 $("#people_email_show").html(value.email);
    //                                 $("#people_wl_show").html(value.worklocation);        
    //                                 var doj = moment(value.doj).format('DD-MM-YYYY');                        
    //                                 var dob = moment(value.doj).format('DD-MM-YYYY');                        
    //                                 $("#people_doj_show").html(doj);                                
    //                                 $("#people_dob_show").html(dob);    
    //                                 // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
    //                                 // // alert(star_icon)
    //                                 // $("#people_star_i_show").html(star_icon);  
    //                                 $(".chat-right-aside-star").css('display', 'none');
    //                                 $(".chat-right-aside-employees-empty").css('display', 'none');                                  
    //                                 $(".chat-right-aside").css('display', 'block');
    
    //                                 $(".chat-box .people-list ul li").removeClass("active");
    //                                 $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
                                    
    //                             });
    //                         }
                            
    //                     }               
                        
    //                 });
    
    //                 //Star List
    //                 $.ajax({
    //                     url:"fetch_people_list_filter_star",
    //                     type:"GET",
    //                     data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         console.log(response);
    //                         $("#people_star_i_show").html(response); 
    //                     }               
                        
    //                 });

    //                 //Img List
    //                 $.ajax({
    //                     url:"fetch_people_list_filter_img",
    //                     type:"GET",
    //                     data : {employee: employee},
    //                     dataType : "JSON",
    //                     success:function(response)
    //                     {
    //                         console.log(response);
    //                         $("#people_show_img").html(response); 
    //                     }               
                        
    //                 });
    //             }
                
    //         }
    //     });
        
    //     // $(".chat-box .people-list ul li").removeClass("active");
    //     // $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
    
    //     // $('.chat-box .people-list ul #people_starred_list_show li').first().css('background-color', '#7e37d8');
    
    // }

});

//Getting Filter Datas
$('#peopleFilterForm').on('submit',function(event){
    event.preventDefault();    

    // Get Alll Text Box Id's
    var people_filter_dept = $('#people_filter_dept').val();
    var people_filter_design = $('#people_filter_design').val();
    var people_filter_location = $('#people_filter_location').val();
    // alert(people_filter_dept);     

    $('#people_filter_dept_value').val(people_filter_dept);
    $('#people_filter_design_value').val(people_filter_design);
    $('#people_filter_location_value').val(people_filter_location);

    var $this = $(".chat-box .chat-menu .nav-tabs #people_tab_li_2 a");

    if ($this.hasClass('active')) {

        var people_filter_dept_value = $('#people_filter_dept_value').val();
        var people_filter_design_value = $('#people_filter_design_value').val();
        var people_filter_location_value = $('#people_filter_location_value').val();

        fetch_everyone_details();

        $.ajax({
            url:"fetch_people_everyone_first_empid",
            type:"GET",
            data: {
                people_filter_dept: people_filter_dept_value,
                people_filter_design: people_filter_design_value,
                people_filter_location: people_filter_location_value,
            },
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response)
                // alert(response)
                if(response == "empty"){
                    // alert("star tab 1  no")
                    $(".chat-right-aside-employees-empty").css('display', 'block');
                    $(".chat-right-aside").css('display', 'none');                        
                    $(".chat-right-aside-star").css('display', 'none');

                }else{
                    // alert("star tab 2  no")
                    $(".chat-right-aside-employees-empty").css('display', 'none');
                    $(".chat-right-aside-star").css('display', 'none');
                    
                    var employee = response;
                
                    $.ajax({
                        url:"fetch_people_list_filter",
                        type:"GET",
                        data: {
                            people_filter_dept: people_filter_dept_value,
                            people_filter_design: people_filter_design_value,
                            people_filter_location: people_filter_location_value,
                            employee: employee,
                        },
                        // data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            // console.log(response);
                            if(response == "empty"){
                                $(".chat-right-aside").css('display', 'none');
                                $(".chat-right-aside-star").css('display', 'none');
                                $(".chat-right-aside-employees-empty").css('display', 'block');
                            }else{
                                $(".chat-right-aside-star").css('display', 'none');
                                $(".chat-right-aside-employees-empty").css('display', 'none');

                                var rData = [];
                                rData = response;                   
                                $.each(rData, function (index, value) {
                                                                                                                                                        
                                    $("#people_name_show").html(value.username);
                                    $("#people_empID_show").html(value.empID);
                                    $("#people_designation_show").html(value.designation);
                                    $("#people_dept_show").html(value.department);
                                    $("#people_contact_show").html(value.contact_no);
                                    $("#people_email_show").html(value.email);
                                    $("#people_wl_show").html(value.worklocation);      
                                    var doj = moment(value.doj).format('DD MMM YYYY');                        
                                    var dob = moment(value.doj).format('DD-MM-YYYY');
                                    var dob_1 = moment(value.dob).format('DD MMM');
                                    $("#people_doj_show").html(doj);                                
                                    $("#people_dob_show").html(dob_1);    
                                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                    // // alert(star_icon)
                                    // $("#people_star_i_show").html(star_icon);                                
                                    $(".chat-right-aside").css('display', 'block');
                                    $(".chat-box .people-list ul li").removeClass("active");
                                    $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
                                    
                                });
                            }
                            
                        }               
                        
                    });

                    //Star List
                    $.ajax({
                        url:"fetch_people_list_filter_star",
                        type:"GET",
                        data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            // console.log(response);
                            $("#people_star_i_show").html(response); 
                        }               
                        
                    });

                    //Img List
                    $.ajax({
                        url:"fetch_people_list_filter_img",
                        type:"GET",
                        data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            console.log(response);
                            $("#people_show_img").html(response); 
                        }               
                        
                    });
                }
                
            }
        });
            
        // $('.chat-box .people-list ul p li:first').addClass('active');
        // $(".chat-box .people-list ul li").removeClass("active");
        // $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
        // $('.chat-box .people-list ul #people_everyone_list_show li').first().css('background-color', '#7e37d8');

    }else{
        var people_filter_dept_value = $('#people_filter_dept_value').val();
        var people_filter_design_value = $('#people_filter_design_value').val();
        var people_filter_location_value = $('#people_filter_location_value').val();
    
        fetch_starred_details();
    
        // alert("1")
        $.ajax({
            url:"fetch_people_starred_first_empid",
            type:"GET",
            data: {
                people_filter_dept: people_filter_dept_value,
                people_filter_design: people_filter_design_value,
                people_filter_location: people_filter_location_value,
            },
            dataType : "JSON",
            success:function(response)
            {
                // alert(response)
                // console.log(response)
                if(response == "empty"){
                    // alert("star tab 1  no")
                    $(".chat-right-aside").css('display', 'none');                        
                    $(".chat-right-aside-star").css('display', 'block');
                    $(".chat-right-aside-employees-empty").css('display', 'none');
    
                }else{
                    $(".chat-right-aside-star").css('display', 'none');
    
                    // alert("star tab 1 yes")
                    var employee = response;
                
                    $.ajax({
                        url:"fetch_people_list_filter",
                        type:"GET",
                        data: {
                            people_filter_dept: people_filter_dept_value,
                            people_filter_design: people_filter_design_value,
                            people_filter_location: people_filter_location_value,
                            employee: employee,
                        },
                        // data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            // console.log(response);
                            if(response == "empty"){
                                // alert("no")
                                // $(".chat-right-aside").css('display', 'none');                        
                                // $(".chat-right-aside-star").css('display', 'none');
                                // $(".chat-right-aside-employees-empty").css('display', 'none');
    
                            }else{
                                // alert("yes")
    
                                var rData = [];
                                rData = response;                   
                                $.each(rData, function (index, value) {
                                                                                                                                                        
                                    $("#people_name_show").html(value.username);
                                    $("#people_empID_show").html(value.empID);
                                    $("#people_designation_show").html(value.designation);
                                    $("#people_dept_show").html(value.department);
                                    $("#people_contact_show").html(value.contact_no);
                                    $("#people_email_show").html(value.email);
                                    $("#people_wl_show").html(value.worklocation);        
                                    var doj = moment(value.doj).format('DD MMM YYYY');                        
                                    var dob = moment(value.doj).format('DD-MM-YYYY');  
                                    var dob_1 = moment(value.dob).format('DD MMM');                      
                                    $("#people_doj_show").html(doj);                                
                                    $("#people_dob_show").html(dob_1);    
                                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                    // // alert(star_icon)
                                    // $("#people_star_i_show").html(star_icon);  
                                    $(".chat-right-aside-star").css('display', 'none');
                                    $(".chat-right-aside-employees-empty").css('display', 'none');                                  
                                    $(".chat-right-aside").css('display', 'block');
    
                                    $(".chat-box .people-list ul li").removeClass("active");
                                    $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
                                    
                                });
                            }
                            
                        }               
                        
                    });
    
                    //Star List
                    $.ajax({
                        url:"fetch_people_list_filter_star",
                        type:"GET",
                        data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            console.log(response);
                            $("#people_star_i_show").html(response); 
                        }               
                        
                    });

                    //Img List
                    $.ajax({
                        url:"fetch_people_list_filter_img",
                        type:"GET",
                        data : {employee: employee},
                        dataType : "JSON",
                        success:function(response)
                        {
                            console.log(response);
                            $("#people_show_img").html(response); 
                        }               
                        
                    });
                }
                
            }
        });
        
        // $(".chat-box .people-list ul li").removeClass("active");
        // $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');
    
        // $('.chat-box .people-list ul #people_starred_list_show li').first().css('background-color', '#7e37d8');
    
    }

    // fetch_people_list_ul_li();
});

// function test() {
//     alert("clear")
//     $(".people_list_filter").val();
//     fetch_everyone_details();
// }  


$("#clearButton").click(function() {
    
    $("#people_list_filter_everyone").val('').trigger('change');
    
    var $this = $(".list #people_everyone_list_show");
                                                        
    if($this){

        $(".list #people_everyone_list_show").show();

    }
       
    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    fetch_everyone_details();

    // alert("2")
    $.ajax({
        url:"fetch_people_everyone_first_empid",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            // alert(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');

            }else{

                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                
                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data: {
                        people_filter_dept: people_filter_dept_value,
                        people_filter_design: people_filter_design_value,
                        people_filter_location: people_filter_location_value,
                        employee: employee,
                    },
                    // data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // $(".chat-right-aside").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'block');
                        }else{
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);        
                                var doj = moment(value.doj).format('DD MMM YYYY');                        
                                var dob = moment(value.dob).format('DD MMM');                        
                                $("#people_doj_show").html(doj);                                
                                $("#people_dob_show").html(dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);                                
                                $(".chat-right-aside").css('display', 'block');
                                // $('.chat-box .people-list ul p li:first').addClass('active');
                                $(".chat-box .people-list ul li").removeClass("active");
                                $('.chat-box .people-list ul #people_everyone_list_show li:first').addClass('active');
                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });

                //Img List
                $.ajax({
                    url:"fetch_people_list_filter_img",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_show_img").html(response); 
                    }               
                    
                });
            }
            
        }
    });
        
   
    // $('.chat-box .people-list ul #people_everyone_list_show li').first().css('background-color', '#7e37d8');

});


$("#clearButtonStarred").click(function() {
    
    $("#people_list_filter_starred").val('').trigger('change');   
    var $this = $(".list #people_starred_list_show");

    if($this){
        $(".list #people_starred_list_show").show();
    }

    var people_filter_dept_value = $('#people_filter_dept_value').val();
    var people_filter_design_value = $('#people_filter_design_value').val();
    var people_filter_location_value = $('#people_filter_location_value').val();

    fetch_starred_details();

    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        data: {
            people_filter_dept: people_filter_dept_value,
            people_filter_design: people_filter_design_value,
            people_filter_location: people_filter_location_value,
        },
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            // console.log(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{
                $(".chat-right-aside-star").css('display', 'none');

                // alert("star tab 1 yes")
                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data: {
                        people_filter_dept: people_filter_dept_value,
                        people_filter_design: people_filter_design_value,
                        people_filter_location: people_filter_location_value,
                        employee: employee,
                    },
                    // data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // alert("no")
                            // $(".chat-right-aside").css('display', 'none');                        
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                        }else{
                            // alert("yes")

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);        
                                var doj = moment(value.doj).format('DD MMM YYYY');                        
                                var dob = moment(value.dob).format('DD MMM');                        
                                $("#people_doj_show").html(doj);                                
                                $("#people_dob_show").html(dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);  
                                $(".chat-right-aside-star").css('display', 'none');
                                $(".chat-right-aside-employees-empty").css('display', 'none');                                  
                                $(".chat-right-aside").css('display', 'block');

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });

                //Img List
                $.ajax({
                    url:"fetch_people_list_filter_img",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        $("#people_show_img").html(response); 
                    }               
                    
                });
            }
            
        }
    });
    
    $(".chat-box .people-list ul li").removeClass("active");
    $('.chat-box .people-list ul #people_starred_list_show li:first').addClass('active');

});
