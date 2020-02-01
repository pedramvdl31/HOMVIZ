@extends($layout)
@section('stylesheets')
<link rel="stylesheet" href="/assets/css/menus/add.css">
@stop
@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- The main application script -->
<script type="text/javascript" src="/packages/priceformat/priceformat.min.js"></script>
<script type="text/javascript" src="/assets/js/menus/add.js"></script>

@stop

@section('content')
<div class="jumbotron">
  <h1>Menus Add</h1>
</div>
<div class="panel panel-default">

  <div class="panel-body">
  {!! Form::open(array('action' => 'MenusController@postAdd', 'class'=>'','role'=>"form")) !!}


    <div class="form-group">
      <label class="control-label" for="id">Type:</label>
      {!! Form::select('type',$type_select,null, ['id'=>'type_select','class'=>'form-control','status'=>false]) !!}
      @foreach($errors->get('id') as $message)
      <span class='help-block'>{!! $message !!}</span>
      @endforeach
    </div>

    <div class="well hide all_sections" id="first_dropdown">
      <h3 style="color:black;margin-top:0">Level 1 Dropdown</h3>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
        <label class="control-label" for="title">Title</label>
        {!! Form::text('first_dropdown_title', null, array('class'=>'form-control all_forms', 'placeholder'=>'dropdown title')) !!}
          @foreach($errors->get('title') as $message)
              <span class='help-block'>{{ $message }}</span>
          @endforeach
      </div>
    </div>

    <div class="well hide all_sections" id="second_dropdown">
      <h3 style="color:black;margin-top:0">Level 2 Dropdown</h3>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
        <label class="control-label" for="title">Title</label>
        {!! Form::text('second_dropdown_title', null, array('class'=>'form-control all_forms', 'placeholder'=>'dropdown title')) !!}
          @foreach($errors->get('title') as $message)
              <span class='help-block'>{{ $message }}</span>
          @endforeach
      </div>
      <div class="form-group">
        <label class="control-label" for="id">It belongs under which Level 1 Dropdown?</label>
        {!! Form::select('first_dropdown_id',$first_dropdowns,null, ['id'=>'','class'=>'form-control all_forms','status'=>false]) !!}
        @foreach($errors->get('id') as $message)
        <span class='help-block'>{!! $message !!}</span>
        @endforeach
      </div> 
    </div>

    <div class="well hide all_sections" id="link_address">
      <h3 style="color:black;margin-top:0">Link Address</h3>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
        <label class="control-label" for="title">Title</label>
        {!! Form::text('link_title', null, array('class'=>'form-control all_forms', 'placeholder'=>'Link title')) !!}
          @foreach($errors->get('title') as $message)
              <span class='help-block'>{{ $message }}</span>
          @endforeach
      </div>
      <div class="form-group">
        <label class="control-label" for="id">Does it belong under a dropdown? if so select one</label>
        {!! Form::select('link_dropdown_id',$dropdowns,null, ['id'=>'','class'=>'form-control all_forms','status'=>false]) !!}
        @foreach($errors->get('id') as $message)
        <span class='help-block'>{!! $message !!}</span>
        @endforeach
      </div>
      <div class="form-group">
        <label class="control-label" for="id">Select page, If it links to an internal page</label>
        {!! Form::select('page_id',$pages,null, ['id'=>'','class'=>'form-control all_forms','status'=>false]) !!}
        @foreach($errors->get('id') as $message)
        <span class='help-block'>{!! $message !!}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
        <label class="control-label" for="title">Type in link address, if its an external URL Address</label>
        {!! Form::text('out_link', null, array('class'=>'form-control all_forms', 'placeholder'=>'www.google.com')) !!}
          @foreach($errors->get('title') as $message)
              <span class='help-block'>{{ $message }}</span>
          @endforeach
      </div>

    </div>


  </div>
  <div class="panel-footer clearfix">
    <a href="{!! route('menus_index') !!} " class="btn btn-info">Back</a>
    <button class="btn btn-primary pull-right">Add</button>
  </div>
    {!! Form::close() !!}
</div>
@stop