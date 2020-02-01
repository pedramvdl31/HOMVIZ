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
          <h1 class="m-0 text-dark">Projects</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
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


                          @if(isset($projects))

                            @foreach ($projects as $k => $project)


                              <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                                <div class="card bg-light" style="width: 100%;">
                                  <div class="card-header text-muted border-bottom-0">
                                    <h2 class="lead"><b>{{$project->name}}</b></h2>
                                  </div>
                                  <div class="card-body pt-0">
                                    <div class="row">
                                      <div class="col-12">
                                        
                                        <p class="text-muted text-sm"><b>About: </b> {{$project->description}}</p>
                                        <p class="text-muted text-sm"><b>Simulations: {{$project->simcount}}</b> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Project Leader: {{$project->leader}}</li>
                                        </ul>
                                      </div>
                                 <!-- <div class="col-5 text-center">
                                        <img src="/assets/img/1.jpg" alt="" class="img-fluid">
                                      </div> -->
                                    </div>
                                  </div>
                                  <div class="card-footer">

                                    <div class="text-left" style="float: left;">
                                      
                                      <a href="/projects/delete/{{$project->id}}">
                                        
                                        <i class="fas fa-trash deletesubresource" style="cursor: pointer;"></i>

                                      </a>

                                    </div>

                                    <div class="text-right">
                                      <a href="/projects/edit/{{$project->id}}" class="btn btn-sm bg-teal">
                                          Edit
                                      </a>
                                      <a href="/simulations/index/{{$project->id}}" class="btn btn-sm btn-primary">
                                          View Simulations List
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            @endforeach

                          @endif

                          <a class="col-12 col-sm-6 col-md-3" href="/projects/add">
                              <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plus"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Add Project</span>
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