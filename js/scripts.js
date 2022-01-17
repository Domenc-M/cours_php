(function($) {
	$(document).ready(function() {
		$("#connect").css('display', 'flex').hide();
		$("#to_connect p").on('click', function() {
			$(this).next().slideToggle().toggleClass('login_open');
		});
		$(".pass_btn").on('click', function() {
			var input = $(this).parent().children('input');
			var type = input.attr('type');
			if(type === 'password') {
				input.attr('type', 'text');
				$(this).hide();
				$(this).next().show();
			}
			else {
				input.attr('type', 'password');
				$(this).hide();
				$(this).prev().show();
			}
		});
		$(document).on('click', function(event) {
			if(!$(event.target).closest('#connect, #to_connect').length) {
				if($("#connect").hasClass('login_open')) {
					$("#to_connect p").trigger('click');
				}
			}
		});
		$(".delete_user").on('click', function() {
			$(".pop_up_bg").fadeIn(500);
		});
		$(".delete_response>div").on('click', function() {
			$(".pop_up_bg").fadeOut(500);
		});
		
	});
})(jQuery);
