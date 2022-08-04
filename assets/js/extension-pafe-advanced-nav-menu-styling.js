jQuery(document).ready(function( $ ) {

	$('.pafe-advanced-nav-menu-styling-image').each(function(){
		var toggle = $(this).data('pafe-advanced-nav-menu-styling-image-toggle'),
		 	close = $(this).data('pafe-advanced-nav-menu-styling-image-close');
		$(this).find('.elementor-menu-toggle').append('<img class="pafe-advanced-nav-menu-styling-image-toggle" src="' + toggle + '">' + '<img class="pafe-advanced-nav-menu-styling-image-close" src="' + close + '">');
	});
});