$(document).ready(function(){
	add.pageLoad();
	add.events();

});
add = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }

	  });
	  	tinymce.init({
			fontsize_formats: "8pt 10pt 12pt 14pt",
			selector: '.des',
			height: 500,
			theme: 'modern',
			fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 36pt",
			plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern jbimages'
			],
			toolbar1: 'insertfile undo redo | fontsizeselect | fontselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
			toolbar2: 'print preview media | forecolor backcolor emoticons',
			image_advtab: true,
			extended_valid_elements : "script[charset|defer|language|src|type],iframe[src|frameborder|style|scrolling|class|width|height|name|align]"
		});


	},
	events: function() {

		$('.page-type').change(function() {
			console.log(this.value);
			if (this.value=="blog") {
				$('.blog-section').removeClass('hide').addClass('show');
			} else {
				$('.blog-section').removeClass('show').addClass('hide');
			}
		});
		
		$('#fileupload').fileupload({
	        url: '/admins/pages/add-blog-image',
	        dataType: 'json',
	        done: function (e, data) {
				r = data.result;
				if(r.status == 200) {
					$('.fileinput-button').addClass('hide')
					$('#blog-image').removeClass('hide').addClass('show')
					var path = r.path;
					var new_input = create_input(path);
					$("#blog-image").append(new_input);
					$('#image-url').attr('src',path);
					$('#image-title').text(data.result.name);
				}

	        },
	        progressall: function (e, data) {
	            // var progress = parseInt(data.loaded / data.total * 100, 10);
	            // $('#progress .progress-bar').css(
	            //     'width',
	            //     progress + '%'
	            // );
	    }
    	}).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

	  	$('.keyword-text').keydown(function(event){
		    if(event.keyCode == 13) {
		    	event.preventDefault();
	            $('#keyword-dup').addClass('hide');
	            var this_text = $(this).val();
	            $(this).val('');
	            var dup = 0;
	            var obj = $('.label-keyword');
	            var count = $('.label-keyword').length;
	            $('.label-keyword').removeClass('new-zip');
	            if (!$.isBlank(this_text)) {
	                $('.this-keyword-t').each(function( index ) {
	                  if ($(this).text() == this_text) {
	                    dup = 1;
	                  };
	                });
	                if (dup == 0) {
	                    var label_html = '<span class="label label-success label-keyword new-zip '+this_text+'" > <span class="this-keyword-t">'+this_text+'</span> <i class="glyphicon glyphicon-trash delete-keyword"></i></span>';
	                    var input_html = '<input class="'+this_text+'" type="hidden" name="keywords['+count+this_text+']" value="'+this_text+'" >';
	                    $('#keyword-group-wrapper').append(label_html);
	                    $('#keyword-group-wrapper').append(input_html);
	                } else {
	                    $('#keyword-dup').removeClass('hide');
	                }
	            }
		    }
	  	});
        
        $(document).on('click', '.add-keyword', function() {
            $('#keyword-dup').addClass('hide');
            var this_text = $(this).parents('.input-group').find('.keyword-text').val();
            $(this).parents('.input-group').find('.keyword-text').val('');
            var dup = 0;
            var obj = $('.label-keyword');
            var count = $('.label-keyword').length;
            $('.label-keyword').removeClass('new-zip');
            if (!$.isBlank(this_text)) {
                $('.this-keyword-t').each(function( index ) {
                  if ($(this).text() == this_text) {
                    dup = 1;
                  };
                });
                if (dup == 0) {
                    var label_html = '<span class="label label-success label-keyword new-zip '+this_text+'" > <span class="this-keyword-t">'+this_text+'</span> <i class="glyphicon glyphicon-trash delete-keyword"></i></span>';
                    var input_html = '<input class="'+this_text+'" type="hidden" name="keywords['+count+this_text+']" value="'+this_text+'" >';
                    $('#keyword-group-wrapper').append(label_html);
                    $('#keyword-group-wrapper').append(input_html);
                } else {
                    $('#keyword-dup').removeClass('hide');
                }
            }
        });
        $(document).on('click', '.delete-keyword', function() {
            var this_text = $(this).parents('.label-keyword').find('.this-keyword-t').text();
            $('.'+this_text).remove();
        });
	}
}
request = {
	add: function(id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/',
			{
				"_token": token
			},
			function(result){
				var status = result.status;

				switch(status) {
					case 200: 
						
					break;				
					case 400: 
						
					break;
					default:
					break;
				}

				}
				);
	}
};
function addf(url)
{

}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);
function create_input(path) {
	var count = $(document).find('.images').length;
	return '<input class="images" name="image-path" type="hidden" value="'+path+'"/>';
}
