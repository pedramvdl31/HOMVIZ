@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="//d3js.org/d3.v4.min.js"></script>

  <link href="https://cdn.anychart.com/releases/8.7.0/css/anychart-ui.min.css?hcode=a0c21fc77e1449cc86299c5faa067dc4" rel="stylesheet" type="text/css">
  <script src="https://cdn.anychart.com/releases/8.7.0/js/anychart-base.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/8.7.0/js/anychart-sunburst.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/8.7.0/js/anychart-exports.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="https://cdn.anychart.com/releases/8.7.0/js/anychart-ui.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
  <script src="/AdminLTE-3.0.0/plugins/chart.js/Chart.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="/assets/js/simulations/view.js?12"></script>
@stop

@section('content')

  <style type="text/css">
    

    label {
        display: inline-block;
        margin: 10px 0 0 10px;
    }


  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Simulation Result (DEMO)</h1>
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

                        <div class="row d-flex align-items-stretch center">

                          <div class="col-md-12" id="bars">  

                            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>

                          </div>

                        </div>

                    </div>

                </div>

            </div><!-- /.card -->

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">

                        <div class="row d-flex align-items-stretch center">

                          <div class="col-md-12" id="bars">  

                            <canvas id="barChart2" style="height:230px; min-height:230px"></canvas>

                          </div>

                        </div>

                    </div>

                </div>

            </div><!-- /.card -->

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">

                        <div class="row d-flex align-items-stretch center">

                          <div class="col-md-12" id="bars">  

                            <canvas id="barChart3" style="height:230px; min-height:230px"></canvas>

                          </div>

                        </div>

                    </div>

                </div>

            </div><!-- /.card -->

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">

                      <div class="chart">
                        <canvas id="lineChart" style="height:250px; min-height:250px"></canvas>
                      </div>
                        
                    </div>

                </div>

            </div>

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">
                      
                      <div class="chart">
                        <canvas id="lineChart2" style="height:250px; min-height:250px"></canvas>
                      </div>
                        
                    </div>

                </div>

            </div>

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                    <div class="card-body pb-0">
                      
                      <div class="chart">
                        <canvas id="lineChart3" style="height:250px; min-height:250px"></canvas>
                      </div>
                        
                    </div>

                </div>

            </div>

          </div>

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                  <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">Transition Probabilities</h3>
                  </div>

                  <div class="card-body pb-0">

                      <div class="row d-flex align-items-stretch center">

                        <div class="col-md-12" id="bars">  

                          <div id="myDiv"></div>

                        </div>

                      </div>
                      
                  </div>

                </div>

            </div><!-- /.card -->

          </div>


          <div class="col-lg-6">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                  <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">Initial Values</h3>
                  </div>

                  <div class="card-body pb-0">

                      <div class="row d-flex align-items-stretch center">

                        <div class="col-md-12" id="bars">  

                          <div id="containerSun" style="height: 400px"></div>

                        </div>

                      </div>
                      
                  </div>

                </div>

            </div><!-- /.card -->

          </div>

          <div class="col-lg-6">

            <div class="card card-primary card-outline">

                <div class="card card-solid" style="margin-bottom: 0">

                  <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">Final Values</h3>
                  </div>

                  <div class="card-body pb-0">

                      <div class="row d-flex align-items-stretch center">

                        <div class="col-md-12" id="bars">  

                          <div id="containerSun2" style="height: 400px"></div>

                        </div>

                      </div>
                      
                  </div>

                </div>

            </div><!-- /.card -->

          </div>

        </div>

    </div><!-- /.container-fluid -->

  </div>




@stop