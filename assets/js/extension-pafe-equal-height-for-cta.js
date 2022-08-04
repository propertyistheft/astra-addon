jQuery(document).ready(function( $ ) {
	function pafeEqualHeightForCta() {
		var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
			breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
			windowWidth = window.innerWidth;

		$('[data-pafe-equal-height-for-cta] .elementor-cta__title').height('auto');
		$('[data-pafe-equal-height-for-cta] .elementor-cta__description').height('auto');

		if( windowWidth >= breakPointLg ) {
			$('.pafe-equal-height-for-cta-desktop').each(function(){
				var $elementSameSlugTitle = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__title');
				var maxHeightTitle = Math.max.apply(null, $elementSameSlugTitle.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugTitle.height(maxHeightTitle + 'px');

				var $elementSameSlugDescription = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__description');
				var maxHeightDescription = Math.max.apply(null, $elementSameSlugDescription.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugDescription.height(maxHeightDescription + 'px');
			});
		}

		if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {
			$('.pafe-equal-height-for-cta-tablet').each(function(){
				var $elementSameSlugTitle = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__title');
				var maxHeightTitle = Math.max.apply(null, $elementSameSlugTitle.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugTitle.height(maxHeightTitle + 'px');

				var $elementSameSlugDescription = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__description');
				var maxHeightDescription = Math.max.apply(null, $elementSameSlugDescription.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugDescription.height(maxHeightDescription + 'px');
			});
		}

		if( windowWidth < breakPointMd ) {
			$('.pafe-equal-height-for-cta-mobile').each(function(){
				var $elementSameSlugTitle = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__title');
				var maxHeightTitle = Math.max.apply(null, $elementSameSlugTitle.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugTitle.height(maxHeightTitle + 'px');

				var $elementSameSlugDescription = $('[data-pafe-equal-height-for-cta="' + $(this).data('pafe-equal-height-for-cta') + '"] .elementor-cta__description');
				var maxHeightDescription = Math.max.apply(null, $elementSameSlugDescription.map(function () {
				    return $(this).height();
				}).get());

				$elementSameSlugDescription.height(maxHeightDescription + 'px');
			});
		}
		
	}

	$(window).on('load resize', function() {
		pafeEqualHeightForCta();
	});
});