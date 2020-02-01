$(document).ready(function(){

	$( "._atag" ).click(function() {
		console.log('cilick')
		if ($(this).attr('type') == "_blank") {
			window.open($(this).attr('link'), '_blank');
		} else {
			window.location.href = $(this).attr('link');
		}
		
	});

});
