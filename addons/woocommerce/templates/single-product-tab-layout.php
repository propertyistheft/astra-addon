<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */

$product_tabs      = apply_filters( 'woocommerce_product_tabs', array() );
$product_tabs_type = astra_get_option( 'single-product-tabs-layout' );
$current_tab_class = 'accordion' === $product_tabs_type ? 'accordion' : 'distributed';

if ( ! empty( $product_tabs ) ) { ?>
	<div class="ast-woocommerce-<?php echo esc_attr( $current_tab_class ); ?> woocommerce-tabs ast-woocommerce-tabs">
	<?php
		$count = 1;
	foreach ( $product_tabs as $key => $product_tab ) {
		?>
			<?php $accordion_active = 1 === $count && 'accordion' === $product_tabs_type ? 'active' : ''; ?>
			<div class="ast-single-tab">
				<h3 class="ast-<?php echo esc_attr( $current_tab_class ); ?>-header ast-tab-header <?php echo esc_attr( $accordion_active ); ?>">
					<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					<?php
					if ( 'accordion' === $product_tabs_type ) {
						echo wp_kses( Astra_Builder_UI_Controller::fetch_svg_icon( 'plus', false ), Astra_Addon_Kses::astra_addon_svg_kses_protocols() );
						echo wp_kses( Astra_Builder_UI_Controller::fetch_svg_icon( 'minus', false ), Astra_Addon_Kses::astra_addon_svg_kses_protocols() );
					}
					?>
				</h3>
				<div class="ast-<?php echo esc_attr( $current_tab_class ); ?>-content <?php echo esc_attr( $accordion_active ); ?> woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<div class="ast-<?php echo esc_attr( $current_tab_class ); ?>-wrap">
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
					</div>
				</div>
			</div>
		<?php
		$count++;
	}
	?>
	<?php do_action( 'woocommerce_product_after_tabs' ); ?>
</div>
<?php } ?>
