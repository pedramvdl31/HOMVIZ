$(document).ready(function(){
	landing.pageLoad();
	landing.events();

});
landing = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

		$('[data-submenu]').submenupicker();
	},
	events: function() {

		$('.cocoon-tag').click(function(){
			window.open('http://cocoon-us.com/', '_blank');
		});

		$('#send_message').click(function(){
			var user_email = $('#user_email').val();
			var user_message = $('#user_message').val();
			if (!$.isBlank(user_email)) {
				if (isEmail(user_email)) {
					if (!$.isBlank(user_message)) {
						request.send_email(user_email,user_message);
					} else {
						alert('Cannot send empty message');
					}
				 } else {
					alert('Invalid Email Format');
				}

            } else {
            	alert('Please Enter Your Email');
            }

		});

		$('.wendyjomorrison').click(function(){
			window.open('http://wendyjomorrison.com/', '_blank');
		});
		$('.cocoon').click(function(){
			window.open('http://cocoon-us.com/', '_blank');
		});
		$('.jeanpaul').click(function(){
			window.open('http://cocoon-us.com/jean-paul/', '_blank');
		});
		$('.bbtr').click(function(){
			window.open('http://www.biodynamicbreath.com/', '_blank');
		});
        $(document).on('click','#like-us-btn',function(){
        	request.like_us();
        });
		$("#sound-btn").click(function(){
			var html = '<audio autoplay id="intro-song">'+
	            			'<source src="/assets/music/intro_song.mp3" type="audio/mpeg">'+
	          			'</audio>';
	        $('#audio-container').html(html)
			$('#sound-btn').addClass('hide');
			$('#mute-btn').removeClass('hide');
		});
		$("#mute-btn").click(function(){
				$('#intro-song').remove();
				$('#mute-btn').addClass('hide');
				$('#sound-btn').removeClass('hide');
		});

		$('.back-to-home').click(function(){
			window.location = "/";
		});
	}
}
request = {
		like_us: function(id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/like-us',
			{
				"_token": token
			},
			function(result){
				var status = result.status;
				var new_count = result.count;
				switch(status) {
					case 200: 
						$('#like_num').text(new_count);
					break;				
					case 400: 
						
					break;
					default:
					break;
				}

				}
				);
	},
		send_email: function(email,message) {
		var token = $('meta[name=csrf-token]').attr('content');
		$('#email_loading').removeClass('hide');
		$.post(
			'/send-email',
			{
				"_token": token,
				"email": email,
				"message": message
			},
			function(result){
				var status = result.status;
				$('#email_loading').addClass('hide');
				$('#user_email').val('');
				$('#user_message').val('');
				switch(status) {
					case 200: 
						alert('Successfully Sent.');
					break;				
					case 400: 
						alert('Oops Something went wrong!');
					break;
					default:
					break;
				}

				}
				);
	},
	landing: function(id) {
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

(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}