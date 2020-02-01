$(document).ready(function(){
	menu.pageLoad();
	menu.events();

});
menu = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {
		$("#type_select").change(function(){
				$('.all_forms').val('');
				$('.all_sections').addClass('hide');
				switch(parseInt($( "select option:selected" ).val())) {
					case 1: 
						$('#link_address').removeClass('hide');
					break;				
					case 2: 
						$('#first_dropdown').removeClass('hide');
					break;
					case 3: 
						$('#second_dropdown').removeClass('hide');
					break;
					default:
					break;
				}
		});
	}
}
request = {
	menu: function(id) {
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
function menuf(url)
{

}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}