@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
	@if(isset($message))
		<div class="alert alert-success" role="alert">
	      <strong>Well done!</strong> {!! $message !!}
	    </div>
	@endif
@stop