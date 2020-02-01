@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')


  {!! Form::open(array('action' => 'AdminsController@postWebModeChange', 'class'=>'','role'=>"form")) !!}
<div class="jumbotron">
  <h1>Website Mode</h1>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<h2>Mode:</h2>
		<div class="radio">
		  <label>
		    <input type="radio" name="optionsRadios" id="1" value="1" 
		    @if($sst==1)
		    	checked 
		    @endif

		    >
		    &nbspLive
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="optionsRadios" id="2" value="2"
		    @if($sst==2)
		    	checked 
		    @endif
		    >
		    &nbspUnder maintenance
		  </label>
		</div>
	</div>
	<div class="panel-footer clearfix">
		  <button class="btn btn-primary pull-right"> Save </button>
	</div>
</div>



    {!! Form::close() !!}

@stop