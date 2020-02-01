@extends($layout)
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/assets/css/pages.css?ver0.1">
@stop
@section('scripts')

@stop

@section('content')

<style>
  h1,h2,h3,h4,h5{
    color:#777
  }
  .h2, h2 {
    font-size: 2rem !important;
  }
  .h1, h1 {
    font-size: 2.5rem !important;
  }
  h3 {
    font-size: 40px !important;
  }

  h4 {
    font-size: 26px !important;
  }
</style>

    <!--=== Breadcrumbs v3 ===-->
    <div class="breadcrumbs-v3 img-v1">
      <div class="container text-center">
        <h1>{{$title}}</h1>
      </div>
    </div>
    <!--=== End Breadcrumbs v3 ===-->

    <!--=== Content Part ===-->
    <div class="container content main-cont">
      <div class="row">
        <div class="col-md-12">
          {!!$page_content!!}
        </div>

      </div>
    </div><!--/container-->
    <!--=== End Content Part ===-->


@stop