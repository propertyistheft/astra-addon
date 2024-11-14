(function () {
	var total 			    = parseInt( astra.shop_infinite_total ) || '',
		count               = parseInt( astra.shop_infinite_count ) || '',
		pagination          = astra.shop_pagination || '',
		masonryEnabled      = false,
		loadStatus          = true,
		infinite_event      = astra.shop_infinite_scroll_event || '',
		revealEffectEnable      = astra.shopRevealEffectEnable || '',
		loader              = document.querySelector('.ast-shop-pagination-infinite .ast-loader');
		astShopLoadMore			= document.querySelector('.ast-shop-load-more');

	//	Is 'infinite' pagination?
	if ( typeof pagination === 'string' && pagination === 'infinite' ) {

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
					document.body.addEventListener('click',function(event) {
						if (event.target && event.target.classList.contains('ast-shop-load-more')) {
							event.preventDefault();
							// Added check if count and total are properly defined.
							if( count != 'undefined' && count != ''&& total != 'undefined' && total != '' ) {
								if ( count > total ) {
									return false;
								}
								NextloadArticles(count);
								count++;
							}
						}
					});
					break;

				case "scroll":
					const getLastProduct = () => document.querySelector(".product:last-child");

					window.addEventListener("scroll", function () {
						// Use the cached last product
						const lastProduct = getLastProduct();
						if (!lastProduct) return;

						const lastProductRect = lastProduct.getBoundingClientRect();

						const isLastProductVisible = lastProductRect.bottom <= window.innerHeight;

						// Check if the user is scrolling down and the last product is within view
						if (isLastProductVisible) {
							// Check if there are more products to load
							if (count <= total && loadStatus) {
								NextloadArticles(count);
								count++;
								loadStatus = false;
							}
						}
					});

					break;
			}
		}

		/**
		 * Append Posts via AJAX
		 *
		 * Perform masonry operations.
		 */
		const NextloadArticles = (pageNumber) => {
			if( astShopLoadMore ){
				astShopLoadMore.classList.remove('active');
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
					// Check if #main exists and use it, otherwise, query from the document
					var mainContainer = data.querySelector('#main') || data;
					var boxes = mainContainer.querySelectorAll('li.product'),
						productContainer = document.querySelector('.ast-woocommerce-container ul.products');

					if ( ! productContainer ) {
						var productContainer = document.querySelector('.elementor-widget-wc-archive-products ul.products');
					}

					//	Disable loader
					loader.style.display = 'none';
					if( astShopLoadMore ){
						astShopLoadMore.classList.add('active');
					} 

					//	Append articles
					
					for (var boxCount = 0; boxCount < boxes.length; boxCount++) {
						productContainer.append(boxes[boxCount]);
					}

					// Add grid classes
					var msg = astra.shop_no_more_post_message || '';

					//	Show no more post message
					if( count > total ) {
						document.querySelector('.ast-shop-pagination-infinite').innerHTML = '<span class="ast-shop-load-more no-more active" style="display: inline-block;">' + msg + "</span>";
					} else {
						var newNextTargetUrl = nextDestUrl.replace(/\/page\/[0-9]+/, '/page/' + (pageNumber + 1));
						pageUrlSelector.setAttribute('href', newNextTargetUrl);
					}

					// Complete the process 'loadStatus'
					loadStatus = true;

					document.dispatchEvent( new CustomEvent( "astraInfinitePaginationLoaded",  { "detail": {} }) );

					if( revealEffectEnable ) {
						fadin('.ast-fade-up', { delay: 200 });
					}
				}
		}
	}
})();
