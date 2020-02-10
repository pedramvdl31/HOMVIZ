$(document).ready(function(){


  

   $(document).on("click","#showdetails",function() {

    $('#showdetailswrap').css('display','block')

  });

    var areaChartData = {
    labels  : ['Street', 'Shelter', 'Transitional Housing', 'Not Homeless'],
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
        data                : [28, 48, 40, 19]
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
        data                : [65, 59, 80, 81]
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
    datasetFill             : false,
    title: {
      display: true,
      text: 'Initial Population vs Final Population (Total)'
    }

  }
  var barChart = new Chart(barChartCanvas, {
    type: 'bar', 
    data: barChartData,
    options: barChartOptions
  })

  var areaChartData = {
    labels  : ['Street', 'Shelter', 'Transitional Housing', 'Not Homeless'],
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
        data                : [38, 18, 20, 49]
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
        data                : [45, 29, 30, 1]
      },
    ]
  }

  var barChartCanvas = $('#barChart2').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0
  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    title: {
      display: true,
      text: 'Initial Population vs Final Population (Male)'
    }

  }
  var barChart = new Chart(barChartCanvas, {
    type: 'bar', 
    data: barChartData,
    options: barChartOptions
  })

  var areaChartData = {
    labels  : ['Street', 'Shelter', 'Transitional Housing', 'Not Homeless'],
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
        data                : [28, 28, 10, 29]
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
        data                : [35, 49, 30, 22]
      },
    ]
  }

  var barChartCanvas = $('#barChart3').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0
  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    title: {
      display: true,
      text: 'Initial Population vs Final Population (Female)'
    }

  }
  var barChart = new Chart(barChartCanvas, {
    type: 'bar', 
    data: barChartData,
    options: barChartOptions
  })

  // LINE CHART 

  var areaChartData = {
    labels  : ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
    datasets: [
      {
        label               : 'Street',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [38, 48, 30, 19, 26, 27, 10, 10]
      },
      {
        label               : 'Shelter',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40, 20]
      },
      {
        label               : 'Transitional Housing',
        backgroundColor     : 'transparent',
        borderColor         : '#ff5d5d',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [21, 25, 21, 32, 35, 23, 28, 20]
      },
      {
        label               : 'Not Homeless',
        backgroundColor     : 'transparent',
        borderColor         : '#99fd99',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [60, 50, 59, 50, 35, 23, 28, 20]
      },
    ]
  }

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    tooltips: {
      mode: 'index',
      intersect: false
    },
    hover: {
      mode: 'index',
      intersect: false
    },
    title: {
      display: true,
      text: 'Total Population'
    }
  }

  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
  var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
  var lineChartData = jQuery.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, { 
    type: 'line',
    data: lineChartData, 
    options: lineChartOptions
  })

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    tooltips: {
      mode: 'index',
      intersect: false
    },
    hover: {
      mode: 'index',
      intersect: false
    },
    title: {
      display: true,
      text: 'Male Population'
    }
  }

  var areaChartData = {
  labels  : ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
  datasets: [
    {
      label               : 'Street',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : [38, 18, 20, 19, 26, 17, 10, 10]
    },
    {
      label               : 'Shelter',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(210, 214, 222, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [65, 59, 10, 21, 56, 55, 40, 20]
    },
    {
      label               : 'Transitional Housing',
      backgroundColor     : 'transparent',
      borderColor         : '#ff5d5d',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [21, 25, 21, 32, 35, 13, 18, 20]
    },
    {
      label               : 'Not Homeless',
      backgroundColor     : 'transparent',
      borderColor         : '#99fd99',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [40, 30, 29, 50, 15, 23, 28, 20]
    },
  ]
}

  var lineChartCanvas = $('#lineChart2').get(0).getContext('2d')
  var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
  var lineChartData = jQuery.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, { 
    type: 'line',
    data: lineChartData, 
    options: lineChartOptions
  })

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    tooltips: {
      mode: 'index',
      intersect: false
    },
    hover: {
      mode: 'index',
      intersect: false
    },
    title: {
      display: true,
      text: 'Female Population'
    }
  }
  var areaChartData = {
  labels  : ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
  datasets: [
    {
      label               : 'Street',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : [18, 28, 20, 39, 16, 17, 20, 20]
    },
    {
      label               : 'Shelter',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(210, 214, 222, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [25, 19, 10, 21, 0, 0, 40, 20]
    },
    {
      label               : 'Transitional Housing',
      backgroundColor     : 'transparent',
      borderColor         : '#ff5d5d',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [21, 25, 21, 32, 15, 12, 18, 20]
    },
    {
      label               : 'Not Homeless',
      backgroundColor     : 'transparent',
      borderColor         : '#99fd99',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [20, 30, 29, 22, 15, 23, 28, 20]
    },
  ]
}
  var lineChartCanvas = $('#lineChart3').get(0).getContext('2d')
  var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
  var lineChartData = jQuery.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, { 
    type: 'line',
    data: lineChartData, 
    options: lineChartOptions
  })


  // LINE CHART 

  // create data
  var data = [
    {name: "Population", children: [
      {name: "Male", value: 7},
      {name: "Female", value: 3},
      {name: "Other", value: 35}
    ]}
  ];

  // create a chart and set the data
  chart = anychart.sunburst(data, "as-tree");

  // set the calculation mode
  chart.calculationMode("parent-independent");

  // set the container id
  chart.container("containerSun");

  // initiate drawing the chart
  chart.draw();

    // create data
  var data = [
    {name: "Population", children: [
      {name: "Male", value: 3},
      {name: "Female", value: 30},
      {name: "Other", value: 25}
    ]}
  ];


      // create a chart and set the data
  chart2 = anychart.sunburst(data, "as-tree");

  // set the calculation mode
  chart2.calculationMode("parent-independent");

  // set the container id
  chart2.container("containerSun2");

  // initiate drawing the chart2
  chart2.draw();

  var xValues = ['Street', 'Shelter', 'Transitional Housing', 'Not Homeless'];

  var yValues = ['Street', 'Shelter', 'Transitional Housing', 'Not Homeless'];

  var zValues = [
  [1, 0 , 0, 0],
  [0.9, 0.6 , 0.7, 0.2],
  [0.5, 1 , 0.6, 0.9],
  [0.6, 1 , 0.3, 0.3],
  [0.6, 1 , 0.9, 0.8],
  [1, 1 , 0.8, 0.7]
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

});