@extends($layout)
@section('stylesheets')
@stop
@section('scripts')

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


                              <div class="col-md-2">
                                <div class="card card-outline card-primary collapsed-card">
                                  <div class="card-header">
                                    <h3 class="card-title">{{$val->name}}</h3>

                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body" style="display: none;">
                                        <p class=" "><b>Number of weeks: </b> {{$val->numberofweeks}}</p>
                                        <p class=" "><b>Number of simulation: </b> {{$val->numberofsims}}</p>
                                        <p class=" "><b>Created by: </b> {{$val->creatorname}}</p>
                                        <p class=" "><b>Created at: </b> {{$val->created_at}}</p>
                                  </div>
                                  <!-- /.card-body -->

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


                                  <div class="card-footer" style="display: none;">

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

                          <a class="col-12 col-sm-6 col-md-2" href="/simulations/add">
                              <div class="info-box">
                                <span class="info-box-icon btn-primary elevation-1"><i class="fas fa-plus"></i></span>

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