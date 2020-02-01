@extends($layout)
@section('stylesheets')
<link rel="stylesheet" href="/assets/css/menus/add.css">
<link rel="stylesheet" href="/packages/Nestable-master/css.nestable.css">
@stop
@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/menus/order.js"></script>
<script type="text/javascript" src="/packages/Nestable-master/jquery.nestable.js"></script>

@stop

@section('content')
<div class="jumbotron">
  <h1>Menus Order</h1>
</div>
<div class="panel panel-default">

  
  {!! Form::open(array('action' => 'MenusController@postOrder', 'class'=>'','role'=>"form")) !!}
  <div class="panel-body">
    {!!$list_html!!}
  </div>
  <div class="panel-footer clearfix">
  	<button type="submit" class="pull-right btn btn-primary">Save</button>
  </div>
    {!! Form::close() !!}
</div>
@stop