// Frontend

jQuery(document).ready(function( $ ) {

	function pafeParallaxElementNewVersion( $element, $options ) {
		var speed = parseFloat( $options.data('pafe-parallax-speed') ),
			bleed = parseFloat( $options.data('pafe-parallax-bleed') ),
			size = $element.css('background-size');

		var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
		if (iOS) {
			size = 'cover';
		}

		$element.parallaxie({ speed: speed, offset: bleed, size: size });
	}

	function pafeParallaxElement( $element, $options ) {
		var bg = $element.css('background-image').replace('url(','').replace(')','').replace(/\"/gi, ""),
			speed = parseFloat( $options.data('pafe-parallax-speed') ),
			bleed = parseFloat( $options.data('pafe-parallax-bleed') );

		$element.css({'background-image':'none'});
		$element.attr('data-pafe-background-image',bg);
		$element.pafeParallax({imageSrc: bg, speed: speed, bleed: bleed, zIndex: 1});
	}

	if($(".pafe-parallax-widget").length > 0) {
		$(".pafe-parallax-widget:not([data-pafe-parallax-new-version='']) .elementor-widget-container").each(function(){
			pafeParallaxElement( $(this), $(this).closest('.pafe-parallax-widget') );
		});

		$(".pafe-parallax-widget[data-pafe-parallax-new-version=''] .elementor-widget-container").each(function(){
			pafeParallaxElementNewVersion( $(this), $(this).closest('.pafe-parallax-widget') );
		});
	}

	if($(".pafe-parallax-column").length > 0) {
		$(".pafe-parallax-column:not([data-pafe-parallax-new-version='']) .elementor-column-wrap").each(function(){
			pafeParallaxElement( $(this), $(this).closest('.pafe-parallax-column') );
		});

		$(".pafe-parallax-column[data-pafe-parallax-new-version=''] .elementor-column-wrap").each(function(){
			pafeParallaxElementNewVersion( $(this), $(this).closest('.pafe-parallax-column') );
		});
	}

	if($(".pafe-parallax-section").length > 0) {
		$(".pafe-parallax-section:not([data-pafe-parallax-new-version=''])").each(function(){
			pafeParallaxElement( $(this), $(this) );
		});

		$(".pafe-parallax-section[data-pafe-parallax-new-version='']").each(function(){
			pafeParallaxElementNewVersion( $(this), $(this) );
		});
	}

});