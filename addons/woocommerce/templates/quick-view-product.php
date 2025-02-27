<?php
/**
 * WooCommerce - Quick View Product
 *
 * @package Astra Addon
 */

while ( have_posts() ) {
	the_post();
	if ( get_the_ID() === absint( $args['product_id'] ) ) { ?>
			<div class="ast-woo-product">
				<div id="product-<?php echo esc_attr( $args['product_id'] ); ?>" <?php post_class( 'product' ); ?>>
					<?php do_action( 'astra_woo_qv_product_image' ); ?>
					<div class="summary entry-summary">
						<div class="summary-content">
							<?php do_action( 'astra_woo_quick_view_product_summary', 'quick-view' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
} // end of the loop.
