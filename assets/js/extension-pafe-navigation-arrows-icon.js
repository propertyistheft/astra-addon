// Frontend

jQuery(document).ready(function( $ ) {

	$('[data-pafe-navigation-arrows-icon]').each(function(){
		var iconPrev = $(this).data('pafe-navigation-arrows-icon-previous'),
			iconNext = $(this).data('pafe-navigation-arrows-icon-next'),
			$slide = $(this).find('.elementor-slick-slider');

		if ($slide.length == 0) {
			$slide = $(this).find('.elementor-main-swiper');
		}

		if ($slide.length == 0) {
			$slide = $(this).find('.elementor-image-carousel-wrapper');
		}

		$slide.append('<div class="pafe-navigation-arrows-icon-arrows pafe-navigation-arrows-icon-arrows--previous"><i class="' + iconPrev + '"></div>' );
		$slide.append('<div class="pafe-navigation-arrows-icon-arrows pafe-navigation-arrows-icon-arrows--next"><i class="' + iconNext + '"></div>' );
	});

	$('[data-pafe-navigation-arrows-icon-image]').each(function(){
		var iconPrev = $(this).data('pafe-navigation-arrows-icon-previous'),
			iconNext = $(this).data('pafe-navigation-arrows-icon-next'),
			$slide = $(this).find('.elementor-slick-slider');
			
		if ($slide.length == 0) {
			$slide = $(this).find('.elementor-main-swiper');
		}

		if ($slide.length == 0) {
			$slide = $(this).find('.elementor-image-carousel-wrapper');
		}

		$slide.append('<div class="pafe-navigation-arrows-icon-arrows pafe-navigation-arrows-icon-arrows--previous"><img src="' + iconPrev + '"></div>' );
		$slide.append('<div class="pafe-navigation-arrows-icon-arrows pafe-navigation-arrows-icon-arrows--next"><img src="' + iconNext + '"></div>' );
	});

	$(document).on('click','.pafe-navigation-arrows-icon-arrows--previous', function(){
		if ($(this).closest('.swiper-container')[0] != undefined) {
			var swiperSlide = $(this).closest('.swiper-container')[0].swiper;
			swiperSlide.slidePrev();
		} else {
			$(this).parent().find('.slick-slider').slick('slickPrev');
		}
	});

	$(document).on('click','.pafe-navigation-arrows-icon-arrows--next', function(){
		if ($(this).closest('.swiper-container')[0] != undefined) {
			var swiperSlide = $(this).closest('.swiper-container')[0].swiper;
			swiperSlide.slideNext();
		} else {
			$(this).parent().find('.slick-slider').slick('slickNext');
		}
	});

});