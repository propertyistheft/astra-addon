/**
 * Handles WooCommerce Single Product Sticky Image.
 *
 * @since x.x.x
 */
(function () {
	document.addEventListener('DOMContentLoaded', function () {
		if (!astraAddon?.single_product_sticky_product_image) {
			// Bail early if disabled.
			return;
		}

		const productImage = document.querySelector('.woocommerce-product-gallery');
		const summaryElement = document.querySelector('.summary.entry-summary');

		if (!productImage) {
			// Bail early if we don't have product image div.
			return;
		}

		if (!summaryElement) {
			// Bail early if we don't have product summary div, because we need it to calculate the height dynamically.
			return;
		}

		const topOffset = `${astraAddon?.single_product_sticky_product_image_top_offset || 0}px`;

		const originalWrapper = productImage.parentElement;

		const saleTag = originalWrapper.querySelector('.ast-onsale-card');
		const wrapper = document.createElement('div');

		originalWrapper.prepend(wrapper);

		wrapper.setAttribute('class', 'ast-product-img-summary-wrapper ast-is-sticky-product-image');
		wrapper.style.position = 'relative';
		wrapper.style.height = `${summaryElement.scrollHeight}px`;

		productImage.style.position = 'sticky';
		productImage.style.top = topOffset;

		wrapper.appendChild(productImage);
		wrapper.appendChild(summaryElement);

		if (!!saleTag) {
			// Fix the sale tag sticky issue.
			productImage.appendChild(saleTag);
		}

		/**
		 * Handle the sticky prodcut image by screen size.
		 * This needs to be triggered on both document load and window resize.
		 * This way, we can make sure, sticky image does not block the contents
		 * or breaks the design.
		 *
		 * @since x.x.x
		 */
		const handleStickyImageByScreenSize = () => {
			if (+astraAddon.break_point > window.innerWidth) {
				/**
				 * If we are here, then we are in responsive mode.
				 * Reset Sticky Product Image for responsive devices.
				 */
				wrapper.style.height = 'auto';
				productImage.style.position = 'static';

				if (!!saleTag) {
					// Reset sale tag on responsive devices.
					originalWrapper.appendChild(saleTag);
				}
			} else {
				wrapper.style.height = `${summaryElement.scrollHeight}px`;
				productImage.style.position = 'sticky';

				if (!!saleTag) {
					productImage.appendChild(saleTag);
				}
			}
		}

		handleStickyImageByScreenSize();
		window.addEventListener("resize", handleStickyImageByScreenSize);

	});
})();
