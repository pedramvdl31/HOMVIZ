@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="/assets/js/index.js?8"></script>
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
          <h1> <a href="/simulations/add"><i class="fas fa-plus text-primary"></i></a>&nbsp;&nbsp;<a href="/simulations/add">Create a New Simulation</a></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">

    <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

              <div class="card-header">

                <div class="card-title">
                  Current Simulations
                </div>

              </div>

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
                                    <h5>{{$val->simulation_name}}</h5>
                                  </div>

                                  <div class="col-1" style="float: right;">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                  </div>

                                </div>

                              </div>

                              @if($val->status!=1)

                                <div class="row">
                                  <div class="col-12">
                                    <div class="siminfo">
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
                                  <p><b>Created by: </b> {{$val->creatorname}}</p>
                                  <p><b>Simulation Location: </b> {{$val->simulation_location}}</p>
                                  <p><b>Number of weeks: </b> {{$val->numberofweeks}}</p>
                                  <p><b>Number of simulation: </b> {{$val->numberofsims}}</p>
                                  <p><b>Created at: </b> {{$val->created_at}}</p>
                                  <p class="status"><b>Status: </b> <span class="statushtml">{!!$val->statusMessage!!}</span></p>
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
                                @if($val->status!=1)
                                  <a href="#" class="btn btn-sm btn-primary disabled result-btn">
                                      Results
                                  </a>
                                @else
                                  <a href="/simulations/view/{{$val->id}}" class="btn btn-sm btn-primary result-btn">
                                      Results
                                  </a>
                                @endif
                              </div>
                            </div>


                          </div>
                          <!-- /.card -->
                        </div>

                      @endforeach

                    @endif

                  </div>

              </div>
                    
            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop