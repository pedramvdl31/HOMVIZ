@extends($layout)
@section('stylesheets')
@stop
@section('scripts')

@stop

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Project {{$project_id}} Simulations</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

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


                              <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                                <div class="card bg-light" style="width: 100%;">
                                  <div class="card-header text-muted border-bottom-0">
                                    <h2 class="lead"><b>{{$val->name}}</b></h2>
                                  </div>
                                  <div class="card-body pt-0">
                                    <div class="row">
                                      <div class="col-12">
                                        
                                        <p class="text-muted text-sm"><b>Number of weeks: </b> {{$val->numberofweeks}}</p>
                                        <p class="text-muted text-sm"><b>Number of simulation: </b> {{$val->numberofsims}}</p>
     
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer">

                                    <div class="text-left" style="float: left;">
                                      
                                      <a href="/simulations/delete/{{$val->id}}/{{$project_id}}">
                                        
                                        <i class="fas fa-trash deletesubresource" style="cursor: pointer;"></i>

                                      </a>

                                    </div>

                                    <div class="text-right">
                                      <a href="/simulations/edit/{{$val->id}}" class="btn btn-sm bg-teal">
                                          Details
                                      </a>
                                      <a href="/simulations/view/{{$val->id}}" class="btn btn-sm btn-primary">
                                          Results
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            @endforeach

                          @endif

                          <a class="col-12 col-sm-6 col-md-3" href="/simulations/add/{{$project_id}}">
                              <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plus"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Add Simulation</span>
                                  <span class="info-box-number">
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                          </a>


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