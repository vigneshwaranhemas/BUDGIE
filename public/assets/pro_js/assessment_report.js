
 $(document).ready(function() {
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.load('current', {'packages':['line']});
    google.charts.load('current', {'packages':['corechart']});

    year_filter_op_ar();
    self_assessment_pie_chart();
    supervisor_status_pie_chart();  
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  });

  $("#pms_pie_year_filter_ar").on("change", function (e) {
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();            
  });

  $("#pms_pie_dept_filter").on("change", function (e) {
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  });

  function rating_filter_clear_ar(){
    $("#pms_pie_year_filter_ar").val('').trigger('change');
    $("#pms_pie_dept_filter").val('').trigger('change');
    $("#pms_pie_man_filter_ar").val('').trigger('change');
    $("#pms_pie_tl_filter_ar").val('').trigger('change');
    $("#pms_pie_grade_filter").val('').trigger('change');
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  }

  $("#pms_pie_man_filter_ar").on("change", function (e) {
    rev_tl_get_ar();
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  }); 

  $("#pms_pie_tl_filter_ar").on("change", function (e) {
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  });

  $("#pms_pie_grade_filter").on("change", function (e) {
    self_assessment_pie_chart();
    supervisor_status_pie_chart();
    reviewer_status_pie_chart();
    hr_status_pie_chart();
    bh_status_pie_chart();
  });

  function year_filter_op_ar(){
    $.ajax({
      url:"pms_report_year_filter_op",
      type:"GET",
      dataType : "JSON",
      success:function(response)
      {   
        $("#pms_pie_year_filter_ar").append("");
        $("#pms_pie_year_filter_ar").append(response);
      }
    });
  }

  function rev_tl_get_ar(){
  
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    $.ajax({
      url:"pms_pie_rev_filter_op",
      type:"GET",
      data: {reviewer: pms_pie_man_filter_ar},
      dataType : "JSON",
      success:function(response)
      {   
        // console.log(response)
        // $("#pms_pie_tl_filter").append("");
        $("#pms_pie_tl_filter_ar").html(response);
      }
    });
  }

  function self_assessment_pie_chart(){
    var pms_pie_year_filter_ar = $("#pms_pie_year_filter_ar").val();
    var pms_pie_dept_filter = $("#pms_pie_dept_filter").val();
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    var pms_pie_tl_filter_ar = $("#pms_pie_tl_filter_ar").val();
    var pms_pie_grade_filter = $("#pms_pie_grade_filter").val();
    // alert(pms_pie_grade_filter);
    $.ajax({
        url:"self_assessment_pie_chart_rating",
        type:"GET",
        data: { pms_year_filter : pms_pie_year_filter_ar,
                dept : pms_pie_dept_filter,
                man : pms_pie_man_filter_ar,
                tl : pms_pie_tl_filter_ar,
                grade : pms_pie_grade_filter
              },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {

                if ($("#pie-chart3").length > 0) {
                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Completed',     2],
                    //   ['Inprogress',      2]
                    // ]);
                    // console.log(data)
                    var data = google.visualization.arrayToDataTable(eval(response));
                    var options = {
                      // title: 'My Daily Activities',
                      pieHole: 0.4,
                      width: 580,
                      height: 400,
                      colors: ["#21A900", "#ED0000"]
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart3'));
                    chart.draw(data, options);
                }
            }
        }
    });

  }

  function supervisor_status_pie_chart(){
    var pms_pie_year_filter_ar = $("#pms_pie_year_filter_ar").val();
    var pms_pie_dept_filter = $("#pms_pie_dept_filter").val();
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    var pms_pie_tl_filter_ar = $("#pms_pie_tl_filter_ar").val();
    var pms_pie_grade_filter = $("#pms_pie_grade_filter").val();
    $.ajax({
        url:"get_supervisor_status_pie_chart",
        type:"GET",
        data: { pms_year_filter : pms_pie_year_filter_ar,
                dept : pms_pie_dept_filter,
                man : pms_pie_man_filter_ar,
                tl : pms_pie_tl_filter_ar,
                grade : pms_pie_grade_filter
              },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {

                if ($("#pie-chart4").length > 0) {
                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Completed',     2],
                    //   ['Inprogress',      2]
                    // ]);
                    // console.log(data)
                    var data = google.visualization.arrayToDataTable(eval(response));
                    var options = {
                      // title: 'My Daily Activities',
                      pieHole: 0.4,
                      width: 580,
                      height: 400,
                      colors: ["#21A900", "#ED0000"]
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart4'));
                    chart.draw(data, options);
                }
            }
        }
    });

  }

  function reviewer_status_pie_chart(){
    var pms_pie_year_filter_ar = $("#pms_pie_year_filter_ar").val();
    var pms_pie_dept_filter = $("#pms_pie_dept_filter").val();
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    var pms_pie_tl_filter_ar = $("#pms_pie_tl_filter_ar").val();
    var pms_pie_grade_filter = $("#pms_pie_grade_filter").val();
    $.ajax({
        url:"get_reviewer_status_pie_chart",
        type:"GET",
        data: { pms_year_filter : pms_pie_year_filter_ar,
                dept : pms_pie_dept_filter,
                man : pms_pie_man_filter_ar,
                tl : pms_pie_tl_filter_ar,
                grade : pms_pie_grade_filter
              },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {

                if ($("#pie-chart5").length > 0) {
                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Completed',     2],
                    //   ['Inprogress',      2]
                    // ]);
                    // console.log(data)
                    var data = google.visualization.arrayToDataTable(eval(response));
                    var options = {
                      // title: 'My Daily Activities',
                      pieHole: 0.4,
                      width: 580,
                      height: 400,
                      colors: ["#21A900", "#ED0000"]
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart5'));
                    chart.draw(data, options);
                }
            }
        }
    });

  }

  function hr_status_pie_chart(){
    var pms_pie_year_filter_ar = $("#pms_pie_year_filter_ar").val();
    var pms_pie_dept_filter = $("#pms_pie_dept_filter").val();
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    var pms_pie_tl_filter_ar = $("#pms_pie_tl_filter_ar").val();
    var pms_pie_grade_filter = $("#pms_pie_grade_filter").val();
    $.ajax({
        url:"get_hr_status_pie_chart",
        type:"GET",
        data: { pms_year_filter : pms_pie_year_filter_ar,
                dept : pms_pie_dept_filter,
                man : pms_pie_man_filter_ar,
                tl : pms_pie_tl_filter_ar,
                grade : pms_pie_grade_filter
              },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {

                if ($("#pie-chart6").length > 0) {
                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Completed',     2],
                    //   ['Inprogress',      2]
                    // ]);
                    // console.log(data)
                    var data = google.visualization.arrayToDataTable(eval(response));
                    var options = {
                      // title: 'My Daily Activities',
                      pieHole: 0.4,
                      width: 580,
                      height: 400,
                      colors: ["#21A900", "#ED0000"]
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart6'));
                    chart.draw(data, options);
                }
            }
        }
    });

  }

  function bh_status_pie_chart(){
    var pms_pie_year_filter_ar = $("#pms_pie_year_filter_ar").val();
    var pms_pie_dept_filter = $("#pms_pie_dept_filter").val();
    var pms_pie_man_filter_ar = $("#pms_pie_man_filter_ar").val();
    var pms_pie_tl_filter_ar = $("#pms_pie_tl_filter_ar").val();
    var pms_pie_grade_filter = $("#pms_pie_grade_filter").val();
    $.ajax({
        url:"get_bh_status_pie_chart",
        type:"GET",
        data: { pms_year_filter : pms_pie_year_filter_ar,
                dept : pms_pie_dept_filter,
                man : pms_pie_man_filter_ar,
                tl : pms_pie_tl_filter_ar,
                grade : pms_pie_grade_filter
              },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response)
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {

                if ($("#pie-chart7").length > 0) {
                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Completed',     2],
                    //   ['Inprogress',      2]
                    // ]);
                    // console.log(data)
                    var data = google.visualization.arrayToDataTable(eval(response));
                    var options = {
                      // title: 'My Daily Activities',
                      pieHole: 0.4,
                      width: 580,
                      height: 400,
                      colors: ["#21A900", "#ED0000"]
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart7'));
                    chart.draw(data, options);
                }
            }
        }
    });

  }
