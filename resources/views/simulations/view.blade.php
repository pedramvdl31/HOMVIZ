@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="//d3js.org/d3.v4.min.js"></script>
  <script src="/AdminLTE-3.0.0/plugins/chart.js/Chart.min.js?v1"></script>
  <script src="https://unpkg.com/chartjs-plugin-colorschemes"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="/assets/js/simulations/view.js?28"></script>
@stop

@section('content')

  <style type="text/css">
    
    label {
        display: inline-block;
        margin: 10px 0 0 10px;
    }

    .btn-app{
      margin: 0 !important;
      cursor: pointer;
    }

  .btn-app .fas {
    line-height: inherit;
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

    </div><!-- /.container-fluid -->
  </div>


  <div class="content">

    <div class="container-fluid">

        <div class="row">


          <div class="col-md-12">
              <div class="card card-outline card-primary callout callout-info">
                <div class="card-header">
                  <div class="card-title">
                    <h5>Simulation Details</h5>
                  </div>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">

                    <strong>Name</strong>
                    <p>{{$sim_info['name']}}</p>
                    
                    <strong>Simulation city</strong>
                    <p>{{$sim_info['city']}}</p>
                    
                    <strong>Number of weeks</strong>
                    <p>{{$sim_info['numberofweeks']}}</p>
                    
                    <strong>Number of simulations</strong>
                    <p>{{$sim_info['numberofsims']}}</p>
                    
                    <strong>Population type and count</strong>
                    <ul>
                      @foreach($sim_info['populattioncontent'] as $popckey => $popcval)

                        <li>{{$popckey}}: {{$popcval}}</li>
  
                      @endforeach
                    </ul>

                    <strong>Resources</strong>
                    <ul>
                      @foreach($sim_info['listofresources'] as $reslistval)

                        <li>{{$reslistval}}</li>
  
                      @endforeach
                    </ul>

                    <strong>States</strong>
                    <ul>
                      @foreach($sim_info['listofstates'] as $statelistval)

                        <li>{{$statelistval}}</li>
  
                      @endforeach
                    </ul>


                </div>
              </div>
          </div>


          @for ($i = 1; $i <= $simnumber; $i++)


            <div class="col-md-12">
              <div class="card card-outline card-primary callout callout-success">
                <div class="card-header">
                  <div class="card-title">

                    <h5>
                      
                      @if(isset($avg_msg))
                          
                        {{$avg_msg}}

                      @else

                        Simulation {{$i}}

                      @endif
                    
                    </h5>
                    
                  </div>

                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                    <div class="card-body">

                      <div class="col-md-12">
                        <div class="card card-outline card-primary">
                          <div class="card-header">
                            <div class="card-title">
                              <h5>Population, by number of weeks ({{$numberofweeks}} weeks) &nbsp;&nbsp;<i class="fas fa-chart-line" style="color:gray"></i></h5>
                            </div>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            @foreach($populationLabelview as $kpop => $pop)
                              <div class="chart" style="margin-bottom: 25px">
                                <canvas id="lineChart-{{$i}}-{{$kpop}}" style="height:250px; min-height:450px"></canvas>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">
                          <div class="card card-outline card-primary">
                            <div class="card-header">
                              <div class="card-title">
                                <h5>Initial Population VS. Final Population &nbsp;&nbsp;<i class="fas fa-chart-pie" style="color:gray"></i></h5>
                              </div>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">

                              <div class="row radarcharts radarpie">
                                <div class="col-md-12">
                                  @foreach($populationLabelview as $kpop => $pop)
                                    <div class="col-md-6" style="float: left">
                                      <div class="chart" style="margin-bottom: 25px">
                                        <canvas id="chart-area-0-{{$i}}-{{$kpop}}" class="chartjs" style="display: block; width: 100%; height: 485px;"></canvas>
                                      </div>
                                    </div>
                                    <div class="col-md-6" style="float: left">
                                      <div class="chart" style="margin-bottom: 25px">
                                        <canvas id="chart-area-1-{{$i}}-{{$kpop}}" class="chartjs" style="display: block; width: 100%; height: 485px;"></canvas>
                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                              </div>

                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                        <div class="card card-outline card-primary">
                          <div class="card-header">
                            <div class="card-title">
                              <h5>Initial Population VS. Final Population &nbsp;&nbsp;<i class="fas fa-chart-bar" style="color:gray"></i></h5>
                            </div>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="row barcharts radarpie">
                              <div class="col-md-12">
                                @foreach($populationLabelview as $kpop => $pop)
                                  <div class="chart" style="margin-bottom: 25px">
                                    <canvas id="chart-bar-{{$i}}-{{$kpop}}" class="chartjs" style="display: block; width: 100%; height: 385px;"></canvas>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                </div>
              </div>
            </div>

        @endfor
                        
      </div>

    </div><!-- /.container-fluid -->

  </div>








@stop