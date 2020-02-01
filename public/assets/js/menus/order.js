$(document).ready(function(){
	menu.pageLoad();
	menu.events();

});
menu = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
		$('.dd').nestable({
			maxDepth:3
		});
		$('.dd').on('change', function() {
   	 		list_reindex();
		});
		list_reindex();
	},
	events: function() {

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
var updateOutput = function(e)
{
    var list   = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
    } else {
        output.val('JSON browser support required for this demo.');
    }
};

function list_reindex()
{
	$('.inputs').remove();
	$('.dd > ol > li').each(function (e) {
    	// $(this).children('.menu-order').val(e);
    	var this_id = $(this).attr('data-id');
		//SECOND TIER FORMS
		var form_one = '<input type="hidden" class="menu menu-group inputs" name="menu['+this_id+'][id]" value="'+this_id+'">';
		var form_two = '<input type="hidden" class="menu-order inputs" name="menu['+this_id+'][order]" value="'+e+'">';
		$(this).append(form_one);
		$(this).append(form_two);
	});
	$('.dd > ol > li > ol > li').each(function (e) {
		var this_id = $(this).attr('data-id');
		var parent_id = $(this).parents('.dd-item:first').attr('data-id');

		//SECOND TIER FORMS
		var form_one = '<input type="hidden" class="menu menu-group inputs" name="menu['+parent_id+'][secondtier]['+this_id+'][id]" value="'+this_id+'">';
		var form_two = '<input type="hidden" class="menu-order inputs" name="menu['+parent_id+'][secondtier]['+this_id+'][order]" value="'+e+'">';
		$(this).append(form_one);
		$(this).append(form_two);

	});

	$('.dd > ol > li > ol > li > ol > li').each(function (e) {
		var this_id = $(this).attr('data-id');
		var parent_id = $(this).parents('.dd-item:first').attr('data-id');
		var grand_parent_id = $(this).parents('.dd-item:last').attr('data-id');

		//SECOND TIER FORMS
		var form_one = '<input type="hidden" class="menu menu-group inputs" name="menu['+grand_parent_id+'][secondtier]['+parent_id+'][thirdtier]['+this_id+'][id]" value="'+this_id+'">';
		var form_two = '<input type="hidden" class="menu-order inputs" name="menu['+grand_parent_id+'][secondtier]['+parent_id+'][thirdtier]['+this_id+'][order]" value="'+e+'">';
		$(this).append(form_one);
		$(this).append(form_two);
	});
}