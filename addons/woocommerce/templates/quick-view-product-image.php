<?php
/**
 * WooCommerce - Product Images
 *
 * @package Astra Addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

?>
<div class="ast-qv-image-slider flexslider images">
	<div class="ast-qv-slides slides">
	<?php
	if ( has_post_thumbnail() ) {
		$astra_addon_image_attachment_ids = $product->get_gallery_image_ids();
		$astra_addon_image_props          = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );

		echo sprintf(
			'<li class="woocommerce-product-gallery__image">%s</li>',
			get_the_post_thumbnail(
				$post->ID,
				'shop_single',
				array(
					'title' => $astra_addon_image_props['title'],
					'alt'   => $astra_addon_image_props['alt'],
				)
			)
		);

		if ( $astra_addon_image_attachment_ids ) {
			$astra_addon_image_loop = 0;

			foreach ( $astra_addon_image_attachment_ids as $astra_addon_attachment_id ) {

				$astra_addon_image_props = wc_get_product_attachment_props( $astra_addon_attachment_id, $post );

				if ( ! $astra_addon_image_props['url'] ) {
					continue;
				}

				echo sprintf(
					'<li>%s</li>',
					wp_get_attachment_image( $astra_addon_attachment_id, 'shop_single', 0, $astra_addon_image_props )
				);

				$astra_addon_image_loop++;
			}
		}
	} else {
		echo sprintf( '<li><img src="%s" alt="%s" /></li>', esc_url_raw( wc_placeholder_img_src() ), esc_html__( 'Placeholder', 'astra-addon' ) );
	}
	?>
	</div>
</div>
