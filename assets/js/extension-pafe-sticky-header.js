jQuery(document).ready(function( $ ) {

	var lastScrollTop = 0;

	function pafeStickyHeader() {

		var breakPointMd = $('[data-pafe-break-point-md]').data('pafe-break-point-md'),
			breakPointLg = $('[data-pafe-break-point-lg]').data('pafe-break-point-lg'),
			windowScroll = $(window).scrollTop(),
			windowWidth = window.innerWidth;

		if( windowWidth >= breakPointLg ) {

			$('[data-pafe-sticky-header]').each(function(){
				if ($(this).data('pafe-sticky-header-on-desktop') == undefined) {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).css({'top': 0}); 
				}
			});

			$('[data-pafe-sticky-header-on-desktop]').each(function(){
				var offset = $(this).data('pafe-sticky-header-offset');
				if (windowScroll >= $(this).data('pafe-sticky-header-offset')) {
					$(this).addClass('pafe-sticky-header-fixed');
					if (offset == 0 && windowScroll > 0 || offset > 0) {
						$('body').addClass('pafe-sticky-header-on');
						$(this).addClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').addClass('pafe-sticky-header-active-element');

						if ($(this).data('pafe-sticky-header-show-on-scroll-up') != undefined) {
							if (windowScroll > lastScrollTop){
						        // Scroll Down
						        $(this).removeClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': '-' + $(this).outerHeight() + 'px','transition': 'all 0.3s ease-in-out 0s'});
						    } else {
						        // Scroll Up
						        $(this).addClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': 0,'transition': 'all 0.3s ease-in-out 0s'});
						    }
					    }
					}
					if (offset == 0 && windowScroll == 0) {
						$('body').removeClass('pafe-sticky-header-on');
						$(this).removeClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
						$(this).removeClass('pafe-sticky-header-show-on-scroll-up');
						$(this).css({'top': 0});
					}
				} else {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).removeClass('pafe-sticky-header-show-on-scroll-up');
					$(this).css({'top': 0});
				}

				$(this).find('.elementor-element').addClass('pafe-sticky-header-element');
			});
		}

		if( windowWidth >= breakPointMd && windowWidth < breakPointLg ) {

			$('[data-pafe-sticky-header]').each(function(){
				if ($(this).data('pafe-sticky-header-on-tablet') == undefined) {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).css({'top': 0});
				}
			});

			$('[data-pafe-sticky-header-on-tablet]').each(function(){
				var offset = $(this).data('pafe-sticky-header-offset');
				if (windowScroll >= $(this).data('pafe-sticky-header-offset')) {
					$(this).addClass('pafe-sticky-header-fixed');
					if (offset == 0 && windowScroll > 0 || offset > 0) {
						$('body').addClass('pafe-sticky-header-on');
						$(this).addClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').addClass('pafe-sticky-header-active-element');

						if ($(this).data('pafe-sticky-header-show-on-scroll-up') != undefined) {
							if (windowScroll > lastScrollTop){
						        // Scroll Down
						        $(this).removeClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': '-' + $(this).outerHeight() + 'px','transition': 'all 0.3s ease-in-out 0s'});
						    } else {
						        // Scroll Up
						        $(this).addClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': 0,'transition': 'all 0.3s ease-in-out 0s'});
						    }
					    }
					}
					if (offset == 0 && windowScroll == 0) {
						$('body').removeClass('pafe-sticky-header-on');
						$(this).removeClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
						$(this).css({'top': 0});
					}
				} else {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).css({'top': 0});
				}

				$(this).find('.elementor-element').addClass('pafe-sticky-header-element');
			});
		}

		if( windowWidth < breakPointMd ) {
			$('[data-pafe-sticky-header]').each(function(){
				if ($(this).data('pafe-sticky-header-on-mobile') == undefined) {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).css({'top': 0});
				}
			}); 

			$('[data-pafe-sticky-header-on-mobile]').each(function(){
				var offset = $(this).data('pafe-sticky-header-offset');
				if (windowScroll >= $(this).data('pafe-sticky-header-offset')) {
					$(this).addClass('pafe-sticky-header-fixed');
					if (offset == 0 && windowScroll > 0 || offset > 0) {
						$('body').addClass('pafe-sticky-header-on');
						$(this).addClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').addClass('pafe-sticky-header-active-element');

						if ($(this).data('pafe-sticky-header-show-on-scroll-up') != undefined) {
							if (windowScroll > lastScrollTop){
						        // Scroll Down
						        $(this).removeClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': '-' + $(this).outerHeight() + 'px','transition': 'all 0.3s ease-in-out 0s'});
						    } else {
						        // Scroll Up
						        $(this).addClass('pafe-sticky-header-show-on-scroll-up');
						        $(this).css({'top': 0,'transition': 'all 0.3s ease-in-out 0s'});
						    }
					    }
					}
					if (offset == 0 && windowScroll == 0) {
						$('body').removeClass('pafe-sticky-header-on');
						$(this).removeClass('pafe-sticky-header-active');
						$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
						$(this).css({'top': 0});
					}
				} else {
					$('body').removeClass('pafe-sticky-header-on');
					$(this).removeClass('pafe-sticky-header-fixed').removeClass('pafe-sticky-header-active');
					$(this).find('.elementor-element').removeClass('pafe-sticky-header-active-element');
					$(this).css({'top': 0});
				}

				$(this).find('.elementor-element').addClass('pafe-sticky-header-element');
			});
		}

		lastScrollTop = windowScroll;
		
	}

	$(window).on('load resize scroll', function() {
		pafeStickyHeader();
	});
}); 