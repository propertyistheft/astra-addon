(function ($) {

	var total 			= parseInt( astra.infinite_total ) || '',
		count 			= parseInt( astra.infinite_count ) || '',
		ajax_url 		= astra.ajax_url || '',
		infinite_nonce 	= astra.infinite_nonce || '',
		pagination 		= astra.pagination || '',
		masonryEnabled  = astra.masonryEnabled || false,
		loadStatus 		= true,
		infinite_event 	= astra.infinite_scroll_event || '',
		loader 			= jQuery('.ast-pagination-infinite .ast-loader'),
		ast_post_type   = astra.astinfiniteposttype

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
					$('.ast-load-more').click(function(event) {
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
					$('.ast-load-more').hide();

					if( $('#main').find('article:last').length > 0 ) {
						var windowHeight50 = jQuery(window).outerHeight() / 1.25;
						$(window).scroll(function () {

							if( ( $(window).scrollTop() + windowHeight50 ) >= ( $('#main').find('article:last').offset().top ) ) {
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

			$('.ast-load-more').removeClass('.active').hide();
			loader.show();

			var data = {
				action : 'astra_pagination_infinite',
				page_no	: pageNumber,
				post_type : ast_post_type,
				nonce: infinite_nonce,
				query_vars: astra.query_vars,
				astra_infinite: 'astra_pagination_ajax',
			}

			$.post( ajax_url, data, function( data ) {

				$( window ).trigger('astAddedAjaxPosts');

				var boxes = $(data);

				//	Disable loader
				loader.hide();
				$('.ast-load-more').addClass('active').show();

				//	Append articles
				$('#main > .ast-row').append( boxes );

				var grid_layout 	= astra.grid_layout || '3';

				//	Append articles
				if( 1 == masonryEnabled && grid_layout > 1 ) {
					$('#main > .ast-row').masonry('appended', boxes, true);
					$('#main > .ast-row').imagesLoaded(function () {
						$('#main > .ast-row').masonry('reload');
					});
					$('#main > .ast-row').trigger('masonryItemAdded');
				}

				//	Add grid classes
				var msg 			= astra.no_more_post_message || '';
				//	Show no more post message
				if( count > total ) {
					$('.ast-pagination-infinite').html( '<span class="ast-load-more no-more active" style="display: inline-block;">' + msg + "</span>" );
				}

				$( window ).trigger('astBlogProAjaxPostsAdded');

				//	Complete the process 'loadStatus'
				loadStatus = true;
			});
		}
	}

})(jQuery);
