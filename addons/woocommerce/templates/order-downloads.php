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
	<?php if ( isset( $args['show_title'] ) ) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'astra-addon' ); ?></h2>
	<?php endif; ?>

	<div class="ast-orders-table__row shop_table shop_table_responsive order_details">
		<?php foreach ( $args['downloads'] as $download ) : ?>
			<div class="ast-dl-single">
			<?php echo '<div class="ast-woo-order-image-wrap">' . get_the_post_thumbnail( $download['product_id'], apply_filters( 'astra_downloaded_product_image_size', array( 60, 60 ) ) ) . '</div>'; ?>

			<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
				<div class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
					<?php
					if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
						do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
					} else {
						switch ( $column_id ) {
							case 'download-product':
								if ( $download['product_url'] ) {
									echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
								} else {
									echo esc_html( $download['product_name'] );
								}
								break;
							case 'download-file':
								echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file alt">' . Astra_Builder_UI_Controller::fetch_svg_icon( 'download', false ) . esc_html( $download['download_name'] ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								break;
							case 'download-remaining':
								esc_html_e( 'Downloads Remaining: ', 'astra-addon' );
								echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'astra-addon' );
								break;
							case 'download-expires':
								esc_html_e( 'Expires: ', 'astra-addon' );
								if ( ! empty( $download['access_expires'] ) ) {
									echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>'; // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
								} else {
									esc_html_e( 'Never', 'astra-addon' );
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
