<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 *
 * @since Astra Addon 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="ast-woo-grid-orders-container">
	<?php
	if ( isset( $args['show_title'] ) ) :
		$my_acccount_download_title = astra_get_option( 'my-account-download-text' );
		?>
		<h2 class="woocommerce-order-downloads__title"><?php echo esc_html( $my_acccount_download_title ); ?></h2>
	<?php endif; ?>

	<div class="ast-orders-table__row shop_table shop_table_responsive order_details">
		<?php foreach ( $args['downloads'] as $download ) : ?>
			<div class="ast-dl-single">
			<?php
				$product_filter_image_size = apply_filters( 'astra_downloaded_product_image_size', array( 60, 60 ) );
				$placeholder_image         = sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( $product_filter_image_size ) ), esc_html__( 'Awaiting product image', 'astra-addon' ) );
				$product_image             = get_the_post_thumbnail( $download['product_id'], $product_filter_image_size );
				$featured_image            = $product_image ? $product_image : $placeholder_image;
			?>
			<?php echo '<div class="ast-woo-order-image-wrap">' . wp_kses_post( $featured_image ) . '</div>'; ?>
			<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
				<div class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
					<?php
					if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
						do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
					} else {

						$download_remaining_text  = astra_get_option( 'my-account-download-remaining-text' ) . ' ';
						$download_expire_text     = astra_get_option( 'my-account-download-expire-text' ) . ' ';
						$download_expire_alt_text = astra_get_option( 'my-account-download-expire-alt-text' ) . ' ';

						switch ( $column_id ) {
							case 'download-product':
								if ( $download['product_url'] ) {
									echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
								} else {
									echo esc_html( $download['product_name'] );
								}
								break;
							case 'download-file':
								echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file alt">' . wp_kses( Astra_Builder_UI_Controller::fetch_svg_icon( 'download', false ), Astra_Addon_Kses::astra_addon_svg_kses_protocols() ) . esc_html( $download['download_name'] ) . '</a>';
								break;
							case 'download-remaining':
								echo esc_html( $download_remaining_text );
								echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'astra-addon' );
								break;
							case 'download-expires':
								echo esc_html( $download_expire_text );
								if ( ! empty( $download['access_expires'] ) ) {
									echo '<time datetime="' . esc_attr( gmdate( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
								} else {
									echo esc_html( $download_expire_alt_text );
								}
								break;
						}
					}
					?>
				</div>
			<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
