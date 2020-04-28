@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="/assets/js/index.js?7"></script>
@stop

@section('content')

  <style type="text/css">
    
    i.fas.fa-trash.deletesubresource {
      color: #ff3a3a;
    }

  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Simulations</h1>
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
                        <div class="row d-flex align-items-stretch">

                          @if(isset($sim))

                            @foreach ($sim as $k => $val)

                              <div class="col-md-4 jobs" id="{{$val->id}}" status="{{$val->status}}">
                                <div class="card card-outline card-primary">
                                  <div class="card-header">
                                    <div class="card-title" style="width: 100%">

                                      <div class="row">
                                      
                                        <div class="col-11">
                                          <h5>{{$val->simulation_name}}&nbsp;&nbsp;<span class="statushtml">{!!$val->statusMessage!!}</span></h5>
                                        </div>

                                        <div class="col-1" style="float: right;">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>

                                      </div>

                                    </div>

                                    @if($val->status!=1)

                                      <div class="row">
                                        <div class="col-12">
                                          <div class="siminfoo">
                                            <p class="simname"></p>
                                            <div class="progress">
                                              <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  
                                    @endif
  
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body" style="">
                                        <p class=" "><b>Created by: </b> {{$val->creatorname}}</p>
                                        <p class=" "><b>Simulation Location: </b> {{$val->simulation_location}}</p>
                                        <p class=" "><b>Number of weeks: </b> {{$val->numberofweeks}}</p>
                                        <p class=" "><b>Number of simulation: </b> {{$val->numberofsims}}</p>
                                        <p class=" "><b>Created at: </b> {{$val->created_at}}</p>
                                  </div>

                                <style>

                                  .card-footer{
                                    border-top: 1px solid rgba(0,0,0,.125);
                                    padding: .75rem 1.25rem;
                                    position: relative;
                                    border-top-left-radius: .25rem;
                                    border-top-right-radius: .25rem;
                                    background-color: #fff
                                  }

                                </style>


                                  <div class="card-footer"">

                                    <div class="text-left" style="float: left;">
                                      
                                      <a href="/simulations/delete/{{$val->id}}" class="btn btn-sm btn-danger">
                                          Delete
                                      </a>

                                    </div>

                                    <div class="text-right">
                                      <a href="/simulations/view/{{$val->id}}" class="btn btn-sm btn-primary">
                                          Results
                                      </a>
                                    </div>
                                  </div>


                                </div>
                                <!-- /.card -->
                              </div>

                            @endforeach

                          @endif

                          <div class="col-md-3">
                            <div class="card card-outline card-primary">
                              <div class="card-header" style="display: block;">
                                <a href="/simulations/add"><i class="fas fa-plus text-primary"></i></a>&nbsp;&nbsp;<a href="/simulations/add">Add Simulation</a>
                              </div>
                            </div>
                          </div>


                        </div>

                    </div>
                    
                </div>

            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop