jQuery(document).ready(function( $ ) {
	function pafeEqualHeight() {
		var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
			breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
			windowWidth = window.innerWidth;

		$('[data-pafe-equal-height]').height('auto');

		if( windowWidth >= breakPointLg ) {
			$('.pafe-equal-height-desktop').each(function(){
				var $elementSameSlug = $('[data-pafe-equal-height="' + $(this).data('pafe-equal-height') + '"]');
				var maxHeight = Math.max.apply(null, $elementSameSlug.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlug.height(maxHeight + 'px');
				if($(this).data('pafe-equal-height-widget-container') == 'yes') {
					$elementSameSlug.find('.elementor-widget-container').outerHeight(maxHeight + 'px');
				}
			});
		}

		if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {
			$('.pafe-equal-height-tablet').each(function(){
				var $elementSameSlug = $('[data-pafe-equal-height="' + $(this).data('pafe-equal-height') + '"]');
				var maxHeight = Math.max.apply(null, $elementSameSlug.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlug.height(maxHeight + 'px');
				if($(this).data('pafe-equal-height-widget-container') == 'yes') {
					$elementSameSlug.find('.elementor-widget-container').outerHeight(maxHeight + 'px');
				}
			});
		}

		if( windowWidth < breakPointMd ) {
			$('.pafe-equal-height-mobile').each(function(){
				var $elementSameSlug = $('[data-pafe-equal-height="' + $(this).data('pafe-equal-height') + '"]');
				var maxHeight = Math.max.apply(null, $elementSameSlug.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlug.height(maxHeight + 'px');
				if($(this).data('pafe-equal-height-widget-container') == 'yes') {
					$elementSameSlug.find('.elementor-widget-container').outerHeight(maxHeight + 'px');
				}
			});
		}
		
	}

	$(window).on('load resize', function() {
		pafeEqualHeight();
	});
});