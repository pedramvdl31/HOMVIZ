$(document).ready(function(){



  var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
  };

   $(document).on("click","#showdetails",function() {

    $('#showdetailswrap').css('display','block')

  });

  console.log(dataSeriesLabel)
  var colors = [
      {"backgroundColor":'transparent',
      "borderColor":'rgba(60,141,188,0.8)',
      "pointColor":'#3b8bba',
      "pointStrokeColor":'rgba(60,141,188,1)',
      "pointHighlightStroke":'rgba(60,141,188,1)'}
    ,
    
      {"backgroundColor":'transparent',
      "borderColor":'rgba(210, 214, 222, 1)',
      "pointColor":'#c1c7d1',
      "pointStrokeColor":'rgba(210, 214, 222, 1)',
      "pointHighlightStroke":'rgba(220,220,220,1))'}
    ,
    
      {"backgroundColor":'transparent',
      "borderColor":'#ff5d5d',
      "pointColor":'#c1c7d1',
      "pointStrokeColor":'rgba(210, 214, 222, 1)',
      "pointHighlightStroke":'rgba(220,220,220,1)'}
    ,
    
      {"backgroundColor":'transparent',
      "borderColor":'#99fd99',
      "pointColor":'#c1c7d1',
      "pointStrokeColor":'rgba(210, 214, 222, 1)',
      "pointHighlightStroke":'rgba(220,220,220,1)'}
    ,
    
      {"backgroundColor":'transparent',
      "borderColor":dynamicColors(),
      "pointColor":'#c1c7d1',
      "pointStrokeColor":dynamicColors(),
      "pointHighlightStroke":dynamicColors(),}
    ,

  ]


  $.each(populationLabel, function( index, popoluation ) {

    var areaChartData = {
      labels:weekLabel,
      datasets:[]
    }

    var count = 0;
    $.each( dataSeriesLabel, function( key, value ) {
      
      var pallet = null;

      if (count>3) {
        pallet = colors[4]
      } else {
        pallet = colors[count]
      }
      count = count + 1

      let line = {
                    label               : key,
                    backgroundColor     : pallet['backgroundColor'],
                    borderColor         : pallet['borderColor'],
                    pointRadius          : false,
                    pointColor          : pallet['pointColor'],
                    pointStrokeColor    : pallet['pointStrokeColor'],
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: pallet['pointHighlightStroke'],
                    data                : dataSeriesLabel[key][popoluation]
                  }

      areaChartData['datasets'].push(line)

    });

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
        text: popoluation+' Population'
      }
    }

    var lineChartCanvas = $('#lineChart'+index).get(0).getContext('2d')
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



  });




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





});