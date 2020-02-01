@extends($layout)
@section('stylesheets')
  <link rel="stylesheet" href="/packages/jQuery-File-Upload-master/css/jquery.fileupload.css">
@stop
@section('scripts')
  <script src="/packages/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="/assets/js/pages/add.js?1"></script>
  <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
  <script src="/packages/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="/packages/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="/packages/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>
@stop

@section('content')
<div class="jumbotron">
  <h1>Pages Add</h1>
</div>
<div class="panel panel-default">

  <div class="panel-body">
  {!! Form::open(array('action' => 'PagesController@postAdd', 'class'=>'','role'=>"form")) !!}
    <div class="section-wrapper">
    <hr>


    <div class="form-group">
        <label class="radio-inline">
          <input class="page-type" type="radio" name="optradio" checked="checked" value="page">Page
        </label>
        <label class="radio-inline">
          <input class="page-type" type="radio" name="optradio" value="blog">Blog Post Entry
        </label>
    </div>

    <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
      <label class="control-label" for="title">Title</label>
      @if(isset($preview_session_data['page_title']))
        {!! Form::text('title', $preview_session_data['page_title'], array('class'=>'form-control', 'placeholder'=>'Title')) !!}
      @else
        {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title')) !!}
      @endif
        @foreach($errors->get('title') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="blog-section hide">

      <label class="control-label" for="title">Blog Thumbnail:  </label>
      <span class="btn btn-success fileinput-button">
      <i class="glyphicon glyphicon-plus"></i>
      <span>Select file...</span>
      <!-- The file input field used as target for the file upload widget -->
      <input id="fileupload" type="file" name="file">
      </span>

      <div id="blog-image" class="row hide" style="margin-top: 0;padding:0">
        <div class="col-md-4">
          <div class="thumbnail">
            <a href="/w3images/nature.jpg">
              <img id="image-url" alt="Nature" style="width:100%">
            </a>
          </div>
        </div>
      </div>

    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
      <label class="control-label" for="title">Description</label>
      {!! Form::textarea('description', null, ['class' => 'field form-control','size' => '30x3', 'placeholder'=>'Description']) !!}
    </div>


    <div class="third_section" id="keywordss">
      <div class="blackout wrapper">
        <label class="control-label" for="description">Keywords (Optional)</label>
        <i type="button" class="glyphicon glyphicon-info-sign" data-toggle="tooltip"
         data-placement="top" title="Keywords ..."></i>
        <div class="input-group">
          <span class="input-group-addon">Enter a keywords</span>
          <input type="text" class="form-control keyword-text">
          <span class="input-group-addon add-keyword">Add</span>
        </div>
        <div class="alert alert-danger hide" id="keyword-dup" role="alert">Duplicate data</div>
        <div class="panel panel-default">
          <div class="panel-body" id="keyword-group-wrapper">
            @if(isset($preview_session_data['page_keywords']))
              @foreach($preview_session_data['page_keywords'] as $keyskey => $keysval)
                  <span class="label label-success label-keyword new-zip {!! $keysval !!}"> 
                    <span class="this-keyword-t">{!! $keysval !!}</span> 
                    <i class="glyphicon glyphicon-trash delete-keyword"></i>
                  </span>
                  <input class="{!! $keysval !!}" type="hidden" name="keywords[{!! $keyskey !!}]" value="{!! $keysval !!}">
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
    </div>

  <!-- ##### -->
  <div class="section-wrapper">
    <h3 class="group-title">Contents</h3>
    <hr>


    {!! Form::textarea('content', null, ['class' => 'des field form-control','size' => '30x8', 'placeholder'=>'Description']) !!}




  </div>
  </div>
  <div class="panel-footer clearfix">
    <a href="{!! route('pages_index') !!} " class="btn btn-info">Back</a>
    <button class="btn btn-primary pull-right">Create Page</button>
  </div>
    {!! Form::close() !!}
</div>
@stop