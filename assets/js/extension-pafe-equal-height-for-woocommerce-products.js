jQuery(document).ready(function( $ ) {
	function pafeEqualHeightForWoocommerceProducts() {

		$('[data-pafe-equal-height-for-woocommerce-products]').each(function(){
			var $ulProducts = $(this).find('ul.products'),
				$items = $ulProducts.find('.product'),
				itemsPerRows = ($ulProducts.css('grid-template-columns').match(/px/g) || []).length;

			$items.find('.woocommerce-loop-product__title').height('auto');

			if ($items.length > 0) {
				if (itemsPerRows > 0) {
					var rows = Math.ceil( $items.length / itemsPerRows );
					for (var j = 0; j < rows; j++) {
						var titleHeight = [],
							thumbnailHeight = [];
						
						for (var z = j*itemsPerRows; z < (j+1)*itemsPerRows; z++) {
							titleHeight.push($items.eq(z).find('.woocommerce-loop-product__title').height());
							thumbnailHeight.push($items.eq(z).find('.attachment-woocommerce_thumbnail').height());
						}

						var maxHeightTitle = Math.max.apply(Math, titleHeight),
							maxHeightThumbnail = Math.max.apply(Math, thumbnailHeight);

						for (var z = j*itemsPerRows; z < (j+1)*itemsPerRows; z++) {
							$items.eq(z).find('.woocommerce-loop-product__title').height(maxHeightTitle + 'px');
							$items.eq(z).find('.attachment-woocommerce_thumbnail').height(maxHeightThumbnail + 'px');
						}
					}
				}
			}

		});
		
	}
	pafeEqualHeightForWoocommerceProducts();
	$(window).on('resize', function() {
		pafeEqualHeightForWoocommerceProducts();
	});
});