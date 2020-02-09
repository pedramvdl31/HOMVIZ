$(document).ready(function(){


  

   $(document).on("click","#showdetails",function() {

    $('#showdetailswrap').css('display','block')

  });

      var areaChartData = {
      labels  : ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'],
      datasets: [
        {
          label               : 'Final Population',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27]
        },
        {
          label               : 'Initial Population',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55]
        },
      ]
    }


    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })



    for (var i = 2; i <= 14; i++) {


      var barChartCanvas = $('#barChart'+i).get(0).getContext('2d')
      var barChartData = jQuery.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      var barChart = new Chart(barChartCanvas, {
        type: 'bar', 
        data: barChartData,
        options: barChartOptions
      })



    }



    // create data
    var data = [
      {name: "Population", children: [
        {name: "S1", children: [
          {name: "S2", value: 7},
          {name: "S3", value: 3},
          {name: "S4", value: 35},
          {name: "S5", value: 15}
        ]},
        {name: "S1", children: [
          {name: "S6", value: 12},
        ]},
        {name: "S2", value: 3},
        {name: "S6", value: 7}
      ]}
    ];

    // create a chart and set the data
    chart = anychart.sunburst(data, "as-tree");

    // set the calculation mode
    chart.calculationMode("parent-independent");

    // set the chart title
    chart.title().useHtml(true);
    chart.listen("chartDraw", function () {
    chart.title("Simulation " +
                chart.sort() + "<br><br>" + 
                "<span style='font-size:12; font-style:italic'>" +
                "State Movements</span>");
  });

  // set the container id
  chart.container("containerSun");

  // initiate drawing the chart
  chart.draw();


      // create a chart and set the data
  chart2 = anychart.sunburst(data, "as-tree");

    // set the calculation mode
    chart2.calculationMode("parent-independent");

    // set the chart2 title
    chart2.title().useHtml(true);
    chart2.listen("chart2Draw", function () {
    chart2.title("Simulation " +
                chart2.sort() + "<br><br>" + 
                "<span style='font-size:12; font-style:italic'>" +
                "State Movements</span>");
  });

  // set the container id
  chart2.container("containerSun2");

  // initiate drawing the chart2
  chart2.draw();

  var xValues = ['S1','S2','S3', 'S4', 'S5', 'S6'];

  var yValues = ['S1','S2','S3', 'S4', 'S5', 'S6'];

  var zValues = [
  [0, 0 , 0, 0, 0 , 0],
  [0.2, 0.1 , 0.2, 0.1, 0.6 , 0.5],
  [0.5, 1 , 0.1, 0.1, 1 , 0.5],
  [0.4, 1 , 0.3, 0.3, 1 , 0.5],
  [0.3, 1 , 0.4, 0.5, 1 , 0.5],
  [0, 1 , 0.5, 0.5, 1 , 0.5]
  ];

  var colorscaleValue = [
  [0, '#ff0000'],
  [1, '#00a100']
  ];

  var data = [{
  x: xValues,
  y: yValues,
  z: zValues,
  type: 'heatmap',
  colorscale: colorscaleValue,
  }];

  var layout = {
    annotations: [],
    xaxis: {
      ticks: '',
      side: 'top'
    },
    yaxis: {
      ticks: '',
      ticksuffix: ' ',
      width: 700,
      height: 700,
      autosize: true
    }
  };
  for ( var i = 0; i < yValues.length; i++ ) {
  for ( var j = 0; j < xValues.length; j++ ) {
    var currentValue = zValues[i][j];
    if (currentValue != 0.0) {
      var textColor = 'white';
    }else{
      var textColor = 'black';
    }
    var result = {
      xref: 'x1',
      yref: 'y1',
      x: xValues[j],
      y: yValues[i],
      text: zValues[i][j],
      font: {
        family: 'Arial',
        size: 12,
        color: 'rgb(50, 171, 96)'
      },
      showarrow: false,
      font: {
        color: textColor
      }
    };
    layout.annotations.push(result);
  }
  }

  Plotly.newPlot('myDiv', data, layout);
  Plotly.newPlot('myDiv2', data, layout);

});