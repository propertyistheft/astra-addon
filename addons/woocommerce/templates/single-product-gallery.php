<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns            = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id  = $product->get_image_id();
$wrapper_classes    = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
$is_vertical_layout = 'vertical-slider' === astra_get_option( 'single-product-gallery-layout' );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $post_thumbnail_id ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'astra-addon' ) );
			$html .= '</div>';
		}
		$markup = apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
		echo wp_kses_post( $markup );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>

	<?php
	$attachment_ids  = $product->get_gallery_image_ids();
	$slider_disabled = $attachment_ids && $product->get_image_id() && count( $attachment_ids ) + 1 <= 4;
	?>
	<!-- Product gallery thumbnail -->
	<?php if ( $is_vertical_layout ) { ?>
		<div id="ast-gallery-thumbnails" class="<?php echo esc_attr( $slider_disabled ? 'slider-disabled' : '' ); ?>">
			<div class="ast-vertical-navigation-wrapper">
				<button id="ast-vertical-navigation-prev"></button>
				<button id="ast-vertical-navigation-next"></button>
			</div>
			<div id="ast-vertical-thumbnail-wrapper">
				<div id="ast-vertical-slider-inner" class="woocommerce-product-gallery-thumbnails__wrapper">
					<?php

					if ( $post_thumbnail_id ) {
						echo wp_kses_post( get_gallery_thumbnail( $post_thumbnail_id, 0 ) );
					}

					/**
					 *  Implement code inside do_action( 'woocommerce_product_thumbnails' ); without the 'woocommerce_single_product_image_thumbnail_html' filter
					 */
					if ( $attachment_ids && $product->get_image_id() ) {
						$slide_number = 1;
						foreach ( $attachment_ids as $attachment_id ) {
							echo wp_kses_post( get_gallery_thumbnail( $attachment_id, $slide_number ) );
							$slide_number++;
						}
					}
					?>
				</div>
			</div>
	</div>
	<?php } else { ?>
		<div class="ast-single-product-thumbnails <?php echo esc_attr( $slider_disabled ? 'slider-disabled' : '' ); ?>">
			<div class="woocommerce-product-gallery-thumbnails__wrapper">
				<?php

				if ( $post_thumbnail_id ) {
					echo wp_kses_post( get_gallery_thumbnail( $post_thumbnail_id, 0 ) );
				}

				/**
				 *  Implement code inside do_action( 'woocommerce_product_thumbnails' ); without the 'woocommerce_single_product_image_thumbnail_html' filter
				 */
				if ( $attachment_ids && $product->get_image_id() ) {
					$slide_number = 1;
					foreach ( $attachment_ids as $attachment_id ) {
						echo wp_kses_post( get_gallery_thumbnail( $attachment_id, $slide_number ) );
						$slide_number++;
					}
				}
				?>
			</div>
		</div>
	<?php } ?>
</div>

<?php

/**
 * Get HTML for gallery thumbnail.
 *
 * @since 3.9.0
 * @param int $attachment_id Attachment ID.
 * @param int $slide_number Slide Number.
 * @return html
 */
function get_gallery_thumbnail( $attachment_id, $slide_number ) {
	$gallery_thumbnail  = wc_get_image_size( 'gallery_thumbnail' );
	$wc_image_thumbnail = wc_get_image_size( 'woocommerce_thumbnail' );
	$thumbnail_size     = apply_filters( 'ast_gallery_thumbnail_size', array( max( $gallery_thumbnail['width'], $wc_image_thumbnail['width'] ), max( $gallery_thumbnail['height'], $wc_image_thumbnail['height'] ) ) );
	$thumbnail_src      = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$alt_text           = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$original_src       = wp_get_attachment_image_src( $attachment_id, 'full' );

	if ( empty( $thumbnail_src[0] ) || strpos( $thumbnail_src[0], '-100x100' ) !== false ) {
		$thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );
	}
	$image          = wp_get_attachment_image( $attachment_id, $thumbnail_size, false, array( 'data-original-src' => $original_src[0] ) );
	$is_first_slide = 0 === $slide_number ? 'flex-active-slide' : '';

	return '<div data-slide-number="' . esc_attr( $slide_number ) . '" data-thumb="' . esc_url( isset( $thumbnail_src[0] ) ? $thumbnail_src[0] : '' ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="ast-woocommerce-product-gallery__image ' . esc_attr( $is_first_slide ) . '">' . $image . '</div>';
}
