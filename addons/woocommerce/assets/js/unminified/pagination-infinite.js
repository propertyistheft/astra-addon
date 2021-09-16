(function ($) {

	var total 			    = parseInt( astra.shop_infinite_total ) || '',
		count               = parseInt( astra.shop_infinite_count ) || '',
		pagination          = astra.shop_pagination || '',
		masonryEnabled      = false,
		loadStatus          = true,
		infinite_event      = astra.shop_infinite_scroll_event || '',
		loader              = jQuery('.ast-shop-pagination-infinite .ast-loader');

	//	Is 'infinite' pagination?
	if( typeof pagination != '' && pagination == 'infinite' ) {

		var in_customizer = false;

		// check for wp.customize return boolean
		if ( typeof wp !== 'undefined' ) {

			in_customizer =  typeof wp.customize !== 'undefined' ? true : false;

			if ( in_customizer ) {
				return;
			}
		}

		if(	typeof infinite_event != '' ) {
			switch( infinite_event ) {
				case 'click':
					$('.ast-shop-load-more').click(function(event) {
						event.preventDefault();
						//	For Click
						if( count != 'undefined' && count != ''&& total != 'undefined' && total != '' ) {
							if ( count > total )
								return false;
							NextloadArticles(count);
							count++;
						}
					});

					break;

				case 'scroll':
					$('.ast-shop-load-more').hide();

					if( $('#main').find('.product:last').length > 0 ) {
						var windowHeight50 = jQuery(window).outerHeight() / 1.25;
						$(window).scroll(function () {

							if( ( $(window).scrollTop() + windowHeight50 ) >= ( $('#main').find('.product:last').offset().top ) ) {
								if (count > total) {
									return false;
								} else {

									//	Pause for the moment ( execute if post loaded )
									if( loadStatus == true ) {
										NextloadArticles(count);
										count++;
										loadStatus = false;
									}
								}
							}
						});
					}

					break;
			}
		}

		/**
		 * Append Posts via AJAX
		 *
		 * Perform masonry operations.
		 */
		function NextloadArticles(pageNumber) {

			$('.ast-shop-load-more').removeClass('.active').hide();
			var nextDestUrl = $('a.next.page-numbers').attr( 'href' );

			loader.show();

			$.ajax({
				url         : nextDestUrl,
				dataType    : 'html',
				success     : function (data) {

					var obj  = $( data ),
						boxes = obj.find( 'li.product' ),
						product_container = $('#main > .ast-woocommerce-container ul.products');

					if ( ! product_container.length ) {
						var product_container = $('.elementor-widget-wc-archive-products ul.products');
					}

					//	Disable loader
					loader.hide();
					$('.ast-shop-load-more').addClass('active').show();

					//	Append articles
					product_container.append( boxes );

					var grid_layout 	= astra.grid_layout || '3';

					//	Append articles
					if( 1 == masonryEnabled && grid_layout > 1 ) {
						product_container.masonry('appended', boxes, true);
						product_container.imagesLoaded(function () {
							product_container.masonry('reload');
						});
						product_container.trigger('masonryItemAdded');
					}

					//	Add grid classes
					var msg = astra.shop_no_more_post_message || '';

					//	Show no more post message
					if( count > total ) {
						$('.ast-shop-pagination-infinite').html( '<span class="ast-shop-load-more no-more active" style="display: inline-block;">' + msg + "</span>" );
					} else {
						var newNextTargetUrl = nextDestUrl.replace(/\/page\/[0-9]+/, '/page/' + (pageNumber + 1));
						$('a.next.page-numbers').attr('href', newNextTargetUrl);
					}

					//	Complete the process 'loadStatus'
					loadStatus = true;
				}
			});
		}
	}

})(jQuery);
