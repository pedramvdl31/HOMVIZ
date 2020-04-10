@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="//d3js.org/d3.v4.min.js"></script>
  <script src="/AdminLTE-3.0.0/plugins/chart.js/Chart.min.js?v1"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="/assets/js/simulations/view.js?21"></script>
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
    var dataSeriesLabelPie = JSON.parse(<?php echo json_encode($dataSeriesLabelPie); ?>);
    var resourceLabel = JSON.parse(<?php echo json_encode($resourceLabel); ?>);
    var populationLabel = JSON.parse(<?php echo json_encode($populationLabel); ?>);
    var weekLabel = JSON.parse(<?php echo json_encode($weekLabel); ?>);
    var simnumber = JSON.parse(<?php echo json_encode($simnumber); ?>);

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

          @for ($i = 1; $i <= $simnumber; $i++)


            <div class="col-md-12">
              <div class="card card-outline card-primary collapsed-card">
                <div class="card-header">
                  <div class="card-title">

                    <h5>Simulation {{$i}}</h5>
                    
                  </div>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                <div class="card-body" style="display: none;">

                    @foreach($populationLabelview as $kpop => $pop)
                    
                      <div class="chart" style="margin-bottom: 25px">
                        <canvas id="lineChart-{{$i}}-{{$kpop}}" style="height:250px; min-height:250px"></canvas>
                      </div>

                    @endforeach

                    <div class="row">
                      <div class="col-md-12">

                        @foreach($populationLabelview as $kpop => $pop)

                          <div class="col-md-6" style="float: left">
                            <div class="chart" style="margin-bottom: 25px">
                              <canvas id="chart-area-0-{{$i}}-{{$kpop}}" class="chartjs" style="display: block; width: 100%; height: 185px;"></canvas>
                            </div>
                          </div>
                          <div class="col-md-6" style="float: left">
                            <div class="chart" style="margin-bottom: 25px">
                              <canvas id="chart-area-1-{{$i}}-{{$kpop}}" class="chartjs" style="display: block; width: 100%; height: 185px;"></canvas>
                            </div>
                          </div>

                        @endforeach


                      </div>
                    </div>


                </div>

              </div>
              <!-- /.card -->
            </div>

        @endfor
                        
      </div>

    </div><!-- /.container-fluid -->

  </div>








@stop