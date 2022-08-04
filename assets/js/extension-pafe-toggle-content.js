jQuery(document).ready(function( $ ) {

	$(document).on('click','[data-pafe-toggle-content-type="trigger-open"]',function(e){
		e.preventDefault();
		var slug = $(this).data('pafe-toggle-content-slug'),
			height = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]>div').height(),
			speed = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-speed'),
			easing = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-easing');
        if (height >= 0 && $(this).data('element_type') == 'container') {
			height = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').css({'height':'auto'}).height();
			$(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').css({'height':'0'});
		}

		$(this).addClass('inactive');
		$(document).find('[data-pafe-toggle-content-type="trigger-close"][data-pafe-toggle-content-slug="' + slug + '"]').addClass('active');
		$(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').animate({ height: height + 'px' }, speed, easing);
	});

	$(document).on('click','[data-pafe-toggle-content-type="trigger-close"]',function(e){
		e.preventDefault();
		var slug = $(this).data('pafe-toggle-content-slug'),
			height = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-height'),
			heightTablet = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-height-tablet'),
			heightMobile = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-height-mobile'),
			windowWidth = window.innerWidth,
			speed = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-speed'),
			easing = $(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').data('pafe-toggle-content-easing');

		$(this).removeClass('active').addClass('inactive');
		$(document).find('[data-pafe-toggle-content-type="trigger-open"][data-pafe-toggle-content-slug="' + slug + '"]').removeClass('inactive');

		if (windowWidth < $('.pafe-break-point').data('pafe-break-point-md') && heightMobile != '') {
			$(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').animate({ height: heightMobile }, speed, easing);
		}

		if (windowWidth >= $('.pafe-break-point').data('pafe-break-point-md') && windowWidth < $('.pafe-break-point').data('pafe-break-point-lg') && heightTablet != '') {
			$(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').animate({ height: heightTablet }, speed, easing);
		}

		if (windowWidth >= $('.pafe-break-point').data('pafe-break-point-lg') || windowWidth < $('.pafe-break-point').data('pafe-break-point-md') && heightMobile == '' || windowWidth >= $('.pafe-break-point').data('pafe-break-point-md') && windowWidth < $('.pafe-break-point').data('pafe-break-point-lg') && heightTablet == '') {
			$(document).find('[data-pafe-toggle-content-type="content"][data-pafe-toggle-content-slug="' + slug + '"]').animate({ height: height }, speed, easing);
		}
		
	});

});