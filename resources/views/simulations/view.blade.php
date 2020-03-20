@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="//d3js.org/d3.v4.min.js"></script>

  
  <script src="/AdminLTE-3.0.0/plugins/chart.js/Chart.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="/assets/js/simulations/view.js?14"></script>
@stop

@section('content')

  <style type="text/css">
    

    label {
        display: inline-block;
        margin: 10px 0 0 10px;
    }


  </style>

  <script>
    
    var dataSeriesLabel = JSON.parse(<?php echo json_encode($dataSeriesLabel); ?>);
    var populationLabel = JSON.parse(<?php echo json_encode($populationLabel); ?>);
    var weekLabel = JSON.parse(<?php echo json_encode($weekLabel); ?>);

  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Simulation Result</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="content">

    <div class="container-fluid">

        <div class="row">


          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">



                      @foreach($populationLabelview as $kpop => $pop)
                      
                        <div class="chart" style="margin-bottom: 25px">
                          <canvas id="lineChart{{$kpop}}" style="height:250px; min-height:250px"></canvas>
                        </div>

                      @endforeach
                        
                    </div>

                </div>

            </div>

          </div>


        </div>

    </div><!-- /.container-fluid -->

  </div>




@stop