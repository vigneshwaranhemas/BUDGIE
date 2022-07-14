
 $(document).ready(function() {
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.load('current', {'packages':['line']});
  google.charts.load('current', {'packages':['corechart']});

  bh_pie_rating_chart(); 
  bh_line_dept_rating_chart();
  bh_line_tl_chart();
  pie_reviewer_chart(); 

  // $("#pms_year,#pms_dept").on("change", function (e) {
  //   bh_line_dept_rating_chart();                
  // });  
  
  // $("#pms_pie_dept_filter,#pms_pie_year_filter").on("change", function (e) {
  //   bh_pie_rating_chart();                
  // });  
  
});

function dept_filter_reset(){
  $("#pms_year").val('').trigger('change');
  $("#pms_dept").val('').trigger('change');
  bh_line_dept_rating_chart();
  year_filter_op(); 
}

function rating_filter_clear(){  
  // $("#pms_pie_dept_filter").val('').trigger('change');
  $("#pms_pie_grade_filter_rep").val('').trigger('change');
  $("#pms_pie_man_filter").val('').trigger('change');
  $("#pms_pie_tl_filter").val('').trigger('change');
  $("#pms_pie_year_filter").val('').trigger('change');
  bh_pie_rating_chart();
  bh_pie_rating_chartjs();
}

function bh_pie_rating_chart(){
  
  var pms_year_filter = $("#pms_pie_year_filter").val();
  var pms_pie_man_filter = $("#pms_pie_man_filter").val();
  var pms_pie_grade_filter_rep = $("#pms_pie_grade_filter_rep").val();
  var pms_pie_tl_filter = $("#pms_pie_tl_filter").val();

  $.ajax({
    url:"bh_rating_chart",
    type:"GET",
    data: {
      pms_year_filter : pms_year_filter, 
      man : pms_pie_man_filter,
      grade : pms_pie_grade_filter_rep,
      tl : pms_pie_tl_filter,
    },
    dataType : "JSON",
    success:function(response)
    {  
      // console.log(response)
      google.charts.setOnLoadCallback(drawBasic);
      function drawBasic() {  
        if ($("#pie-chart2").length > 0) {
            
            // var data = google.visualization.arrayToDataTable([
            //     ['Task', 'Hours per Day'],
            //     ['SEE',     5],
            //     ['EE',      10],
            //     ['ME',  15],
            //     ['PME', 20],
            //     ['ND',    25]
            // ]);

            // console.log(data)

            var data = google.visualization.arrayToDataTable(eval(response));

            var options = {
                // title: 'By Reporting Manager Consolidated Rating',
                is3D: true,
                width: 600,
                height: 400,
                // colors: ["#06b5dd", "#7e37d8", "#fe80b2", "#80cf00" , "#fd517d"]
                colors: ["#008000", "#80cf00", "#FFA500", "#FF0000"]
            };
            var chart = new google.visualization.PieChart(document.getElementById('pie-chart2'));
            chart.draw(data, options);
        }
      }
    }
  });      
                          
}

function bh_line_dept_rating_chart(){

  var dept = $("#pms_dept").val();
  var year = $("#pms_year").val();

  if(dept == ""){
        
    $.ajax({
      url:"bh_line_dept_rating_chart",
      type:"GET",
      data:$("#deptFormFilter").serialize(),
      dataType : "JSON",
      success:function(response)
      {  
        // console.log()

        google.charts.setOnLoadCallback(drawBasic);
        function drawBasic() {                 
            if ($("#column-chart2").length > 0) {

              // var a = google.visualization.arrayToDataTable([
              // ['Department', "SEE", "EE", "ME", "PME", "ND"],
              // ['IT', 113, 400, 250, 345, 408],
              // ['Finace', 1170, 460, 300, 385, 498]
              // ]),

              // var a = google.visualization.arrayToDataTable([['Department', 'SEE','EE', 'ME', 'PME' , 'ND'],['Finance', 10, 3, 40, 50, 90],['Warehouse', 0, 0, 0, 0, 0]]),

              var a = google.visualization.arrayToDataTable(eval(response)),

              b = {
                chart: {
                    // title: "Department",
                    // subtitle: "Sales, Expenses, and Profit: 2014-2017"
                },
                bars: "horizontal",
                vAxis: {
                    format: "decimal"
                },
                height: 7000,
                width:'100%',
                colors: ["#FFD700", "#008000", "#80cf00", "#FFA500", "#FF0000"]
              },
              c = new google.charts.Bar(document.getElementById("column-chart2"));
              c.draw(a, google.charts.Bar.convertOptions(b))
          }
      }
      }
    });    

  }else{
    var len = dept.length + 1;
    var l = len+"00";

    $.ajax({
      url:"bh_line_dept_rating_chart",
      type:"GET",
      data:$("#deptFormFilter").serialize(),
      dataType : "JSON",
      success:function(response)
      {  
        // console.log(response)

        google.charts.setOnLoadCallback(drawBasic);
        function drawBasic() {                 
            if ($("#column-chart2").length > 0) {

              // var a = google.visualization.arrayToDataTable([
              // ['Department', "SEE", "EE", "ME", "PME", "ND"],
              // ['IT', 113, 400, 250, 345, 408],
              // ['Finace', 1170, 460, 300, 385, 498]
              // ]),

              // var a = google.visualization.arrayToDataTable([['Department', 'SEE','EE', 'ME', 'PME' , 'ND'],['Finance', 10, 3, 40, 50, 90],['Warehouse', 0, 0, 0, 0, 0]]),

              var a = google.visualization.arrayToDataTable(eval(response)),

              b = {
                chart: {
                    // title: "Department",
                    // subtitle: "Sales, Expenses, and Profit: 2014-2017"
                },
                bars: "horizontal",
                vAxis: {
                    format: "decimal"
                },
                height: l,
                width:'100%',
                colors: ["#FFD700", "#008000", "#80cf00", "#FFA500", "#FF0000"]
              },
              c = new google.charts.Bar(document.getElementById("column-chart2"));
              c.draw(a, google.charts.Bar.convertOptions(b))
          }
      }
      }
    });  

  }  
                          
}

function bh_line_tl_chart(){
  google.charts.setOnLoadCallback(drawBasic);
  function drawBasic() {                 
    if ($("#column-chart1").length > 0) {
        var a = google.visualization.arrayToDataTable([
          ["Year", "Rating"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Rajagopalan B", "ND"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["Madhan Raj S", "PME"],
          ["Lakshmi Narayanan", "ME"],
          ["Ganagavathy", "EE"],
          ["K. Praveena", "SEE"],
          ["Leelavinothan", "PME"]
        ]),
        b = {
          chart: {
            title: "Company Performance",
            subtitle: "Sales, Expenses, and Profit: 2014-2017"
          },
          bars: "vertical",
          vAxis: {
            format: "decimal"
          },
          height: 400,
          width:'100%',
            colors: ["#7e37d8", "#fe80b2", "#80cf00"]


        },
      c = new google.charts.Bar(document.getElementById("column-chart1"));
      c.draw(a, google.charts.Bar.convertOptions(b))
    }
  }
}

function pie_reviewer_chart(){
  google.charts.setOnLoadCallback(drawBasic);
  function drawBasic() {                      
    if ($("#pie-chart1").length > 0) {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Work',     5],
        ['Eat',      10],
        ['Commute',  15],
        ['Watch TV', 20],
        ['Sleep',    25]
      ]);
      var options = {
        title: 'My Daily Activities',
        width:'100%',
        height: 400,
      colors: ["#06b5dd", "#7e37d8", "#fe80b2", "#80cf00" , "#fd517d"]
      };
      var chart = new google.visualization.PieChart(document.getElementById('pie-chart1'));
      chart.draw(data, options);
  }
  }
}
