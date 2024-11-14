(function () {

	var pagination 		= astra.pagination || '',
		masonryEnabled  = astra.masonryEnabled || false,
		revealEffectEnable  = astra.revealEffectEnable || false,
		loadStatus 		= true,
		infinite_event 	= astra.infinite_scroll_event || '';

	//	Is 'infinite' pagination?
	if ( typeof pagination === 'string' && pagination == 'infinite' ) {

		var in_customizer = false;

		// check for wp.customize return boolean
		if ( typeof wp !== 'undefined' ) {

			in_customizer =  typeof wp.customize !== 'undefined' ? true : false;

			if ( in_customizer ) {
				return;
			}
		}

		if ( typeof infinite_event === 'string' ) {
			switch( infinite_event ) {
				case 'click':
				document.addEventListener('click',function(event) {
					if( event.target.classList.contains('ast-load-more') ) {
					//	For Click
					const infinitePagination = document.querySelector('.ast-pagination-infinite');
					if( infinitePagination ) {
						let total = parseInt( document.querySelector('.ast-pagination-infinite').getAttribute('data-total') ) || '';
						let count = parseInt( document.querySelector('.ast-pagination-infinite').getAttribute('data-page') ) || '';
						if( count != 'undefined' && count != ''&& total != 'undefined' && total != '' ) {
								if ( count <= total ) {
									NextloadArticles(count);
									document.querySelector('.ast-pagination-infinite').setAttribute('data-page', count + 1 );
								}
							}
						}
					}
				});
				break;
				case 'scroll':
							const astLoadMore		= document.querySelector('.ast-load-more');
							var mainSelector = document.getElementById('main');
							var rect = mainSelector.getBoundingClientRect();
							var offset = {
								top: rect.top + window.scrollY,
								left: rect.left + window.scrollX,
							};
							if( astLoadMore ){
									astLoadMore.classList.remove('active');
							}
							if( mainSelector.querySelectorAll('article:last-child').length > 0 ) {

								var windowHeight50 = window.outerHeight / 1.25;
								window.addEventListener('scroll', function() {

									if( (window.scrollY + windowHeight50 ) >= ( offset.top ) ) {
										const infinitePagination = document.querySelector('.ast-pagination-infinite');
										if( infinitePagination ) {
											const total = parseInt( infinitePagination.getAttribute('data-total') ) || '';
											let count = parseInt( infinitePagination.getAttribute('data-page') ) || '';
	
											if (count <= total) {
												//	Pause for the moment ( execute if post loaded )
												if( loadStatus == true ) {
													NextloadArticles(count);
													infinitePagination.setAttribute('data-page', count + 1 );
													loadStatus = false;
												}
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
		const NextloadArticles = (pageNumber) => {
			const loader 			= document.querySelector('.ast-pagination-infinite .ast-loader');
			const astLoadMore		= document.querySelector('.ast-load-more');
			if( astLoadMore ){
				astLoadMore.classList.remove('active');
			}
			var pageUrlSelector = document.querySelector('a.next.page-numbers');
			var nextDestUrl = pageUrlSelector.getAttribute('href');
			loader.style.display = 'block';

			var request = new XMLHttpRequest();
				request.open('GET', nextDestUrl, true);
				request.send();
				request.onload = function() {
					var string = request.response;
					var data = new DOMParser().parseFromString(string, 'text/html');
					var boxes = data.querySelectorAll( 'article.ast-article-post' );

					//	Disable loader
					loader.style.display = 'none';
					if( astLoadMore ){
						astLoadMore.classList.add( 'active');
					}
					//	Append articles
					for (var boxCount = 0; boxCount < boxes.length; boxCount++) {
						document.querySelector('#main > .ast-row').append(boxes[boxCount]);
					}

					const gridLayout = astra.grid_layout;

					//	Append articles
					if( 1 == masonryEnabled && ( gridLayout.desktop > 1 || gridLayout.tablet > 1 || gridLayout.mobile > 1 ) ) {
						var grid = document.querySelector('#main > .ast-row');
						var msnry = new Masonry( grid, {});

						imagesLoaded( document.querySelector('#main > .ast-row'), function() {
							msnry.appended( boxes );
							msnry.reloadItems();
							msnry.layout();
						});
					}

					//	Add grid classes
					var msg 			= astra.no_more_post_message || '';
					//	Show no more post message
					const infinitePagination = document.querySelector('.ast-pagination-infinite');
					if( infinitePagination ) {
						const total = parseInt( infinitePagination.getAttribute('data-total') ) || '';
						let count = parseInt( infinitePagination.getAttribute('data-page') ) || '';
						if( count > total ) {
							infinitePagination.innerHTML = '<span class="ast-load-more no-more active" style="display: inline-block;">' + msg + "</span>";
						} else {
							var newNextTargetUrl = nextDestUrl.replace(/\/page\/[0-9]+/, '/page/' + (pageNumber + 1));
							pageUrlSelector.setAttribute('href', newNextTargetUrl);
						}
					}

					if( revealEffectEnable ) {
						fadin('.ast-fade-up', { delay: 200 });
					}

					//	Complete the process 'loadStatus'
					loadStatus = true;
				}
		}
	}

})();
