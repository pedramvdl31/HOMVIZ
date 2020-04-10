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
 

  months = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
  ];

  let mntcounter = 0;
  let innercounter = 0

  for (var j = 0; j <= weekLabel.length - 1; j++) {

    weekLabel[j] = months[mntcounter] +'-'+ weekLabel[j]

    innercounter=innercounter+1
  
    if (innercounter>=4) {
      innercounter=0
      mntcounter=mntcounter+1
      if (mntcounter==12) {
        mntcounter=0
      }
    }

  }

  var randomScalingFactor = function() {
    return Math.round(Math.random() * 100);
  };

  var chartColors = { red: "rgb(255, 99, 132)", orange: "rgb(255, 159, 64)", yellow: "rgb(255, 205, 86)", green: "rgb(75, 192, 192)", blue: "rgb(54, 162, 235)", purple: "rgb(153, 102, 255)", grey: "rgb(201, 203, 207)" };

  var color = Chart.helpers.color;


  for (var i = 0; i < simnumber; i++) {

    $.each(populationLabel, function( index, popoluation ) {

      var count = 0;
      
      var areaChartData = {
        labels:weekLabel,
        datasets:[]
      }

      $.each( dataSeriesLabel['simulation_'+i], function( key, value ) {

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
                      data                : dataSeriesLabel['simulation_'+i][key][popoluation]
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

      var lineChartCanvas = $('#lineChart-'+(i+1)+'-'+index).get(0).getContext('2d')
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

  }



  for (var i2= 0; i2 < simnumber; i2++) {

    $.each(populationLabel, function( index2, popoluation2 ) {


      for (var z = 0; z <= 1; z++) {

        var config = {
          data: {
            datasets: [{
              data: [],
              backgroundColor: [
                color(chartColors.red).alpha(0.5).rgbString(),
                color(chartColors.orange).alpha(0.5).rgbString(),
                color(chartColors.yellow).alpha(0.5).rgbString(),
                color(chartColors.green).alpha(0.5).rgbString(),
                color(chartColors.blue).alpha(0.5).rgbString(),
              ],
              label: 'My dataset'
            }],
            labels: resourceLabel
          },
          options: {
            responsive: true,
            legend: {
              position: 'right',
            },
            title: {
              display: true,
              text: popoluation2+' Population'
            },
            scale: {
              ticks: {
                beginAtZero: true
              },
              reverse: false
            },
            animation: {
              animateRotate: false,
              animateScale: true
            }
          }
        };
        
        $.each( resourceLabel, function( key2, value2 ) {

          console.log(value2)
          

          if (z==0) {
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['init'])
          } else {
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['final'])
          }

        });


        var ctx = document.getElementById('chart-area-'+z+'-'+(i2+1)+'-'+index2);
        window.myPolarArea = Chart.PolarArea(ctx, config);



      }

    });

  }


});