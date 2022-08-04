// Frontend

jQuery(document).ready(function( $ ) {
	$(document).on('click','[data-pafe-section-link]',function() {
		var link = $(this).data('pafe-section-link'),
			external = $(this).data('pafe-section-link-external'),
			linkAppend = '<a href="' + link + '" data-pafe-section-link-a style="display:none"></a>';

		if(external == 'on') {
			linkAppend = '<a href="' + link + '" target="_blank" data-pafe-section-link-a style="display:none"></a>';
		}

		if ($(this).find('[data-pafe-section-link-a]').length == 0) {
			$(this).append(linkAppend);
		}

		var alink = $(this).find('[data-pafe-section-link-a]');
		alink[0].click();	
	});
});