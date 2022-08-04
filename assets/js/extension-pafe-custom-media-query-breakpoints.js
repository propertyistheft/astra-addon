// Frontend

jQuery(document).ready(function( $ ) {

	$('[data-pafe-custom-media-query-breakpoints]').each(function(){
		var css = $(this).data('pafe-custom-media-query-breakpoints');

		$(this).append('<style>'+ css +'</style>');
	});

	$('.elementor-column[data-pafe-custom-media-query-breakpoints]').closest('.elementor-row').css({'flex-wrap':'wrap'});

});