jQuery(document).ready(function($) {

	$('img.brand-image').load(function(){
		$('img.brand-image').each(function(){
			var height = $(this).height();
			console.log(height);
			var padding_height = ((262 - height) / 2) - 20;
			$(this).css('padding-top', padding_height);
			var view_all_margin = (((height + padding_height) - height) / 4);
			console.log(view_all_margin);
			$(this).parent().next('.view-all-boards').css('margin-top', view_all_margin);
		});
	});

	$('.expand').on('click touch', function(){
		$('.review-content').slideToggle();
	})

	$('.menu-toggle').on('click touch', function(){
		$('.main-navigation ul, .search-box').slideToggle();
	})

	$('.fancybox').fancybox();

});


